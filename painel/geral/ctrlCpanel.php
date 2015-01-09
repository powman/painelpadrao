<?
/*
 *	Título: Controle da Classe
 *	Funçãoo: Responsável por fazer a solicitação de cadastro,
 *			alteração e exclusão do objeto (obs.: e suas respectivas fotos).
 *	Desenvolvido por: Paulo Henrique Pereira
 */

//inclui a classe do objeto
include_once "classes/cpanel/xmlapi.php";

$permissao = $objSecao->permissaoSecaoFixaUsuario("1",$objSession2->get('tlAdmLoginId'));

$conf = Config::AtributosConfig();
$objUteis->encode($conf);

//verifica qual a ação está sendo solicitada pela câmada de visão(formulários)
switch ($_REQUEST['acao']) {
case "criar-email":
	// inclui o arquivo
	$abrePag = "../frms/cpanel/frmCadEmail.php";
	break;
case "listar":
    $user = $conf["whm"]['userDominio'];
	$xmlapi = new xmlapi($conf["whm"]['dominio'], $conf["whm"]['user'], $conf["whm"]['pass']);
	
	// Todos os Emails
	$params = array(
	        'domain' => $conf["whm"]['dominioCpanelCliente'],
	        'nearquotaonly' => 0,
	        'no_validate' => 0
	         
	);
	$funcao = $xmlapi->api2_query($conf["whm"]['userCpanelCliente'],'Email','listpopswithdisk',$params);
	$aEmails = json_decode(json_encode((array)$funcao), TRUE);
	
	// Fim Todos os Emails
	
	
	
	$aDados = json_decode(json_encode((array)$xmlapi->accountsummary($user)), TRUE);
	$aFtps = json_decode(json_encode((array)$xmlapi->listftp($user)), TRUE);
	
	$abrePag = "../frms/cpanel/listaCpanel.php";
	
break;
case "cadastrar-email":
        $params = array('password'=> $objPost->param['senha'], 'quota'=>250, 'email' => $objPost->param['email'], 'domain' => $conf["whm"]['dominioCpanelCliente']);
        print_r($params);
	    $xmlapi = new xmlapi($conf["whm"]['dominio'], $conf["whm"]['user'], $conf["whm"]['pass']);
	    $addEmail = $xmlapi->api2_query($conf["whm"]['userCpanelCliente'],'Email','addpop',$params);
	    print_r($addEmail);
	 
	    if($addEmail['cpanelresult']['data']->result){
	        //grava log de ação no sistema
    		$objUteis
    				->gravaLog($objSession2->get('tlAdmLoginNome'),
    						utf8_decode("Conta de Email"),
    						$objSession2->get('tlAdmLoginId'), "Cadastrou",
    						$_SERVER['REMOTE_ADDR']);
    		
    		//mostra o resultado para o usuário
    	    $objUteis
        		->showResult("Cadastrado com sucesso.",
        		        "Erro ao cadastrar.", true,
        		        "mostraMensagem",
        		        'index.php?acao=listar&ctrl=cpanel');
	    }
	    else{
	        
	        echo "Error creating email account:\n".$addEmail['cpanelresult']['data'][0]['reason'];
	        exit();
	    }
	    
	    exit();
	
break;
case "cadastrar-conta":

	    $whm = new xmlapi('netsuprema.eti.br', 'netsupre', 'adm@2015@n49tsuprema');
	 
	    $acc['domain'] = $_POST['dominio'];
	    $acc['username'] = $_POST['usuario'];
	    $acc['password'] = $_POST['senha'];
	    $acc['contactemail'] = $_POST['email'];
	    $acc['msel'] = $_POST['plano'];
	 
	    $verifica = $whm->createacct($acc);
	 
	    if($verifica->result->status != 0){
	        echo 'Conta para o domínio <strong>'. $acc['domain'] .'</strong> foi criado com sucesso!';
	    }
	    else{
	        echo 'Erro ao tentar criar conta. Tente novamente! Erro: ' . $verifica->result->statusmsg;
	    }
	
break;
case "listar-emails":

	$xmlapi = new xmlapi('pixelgo.com.br', 'pixel821', '5fpRvWnB.TCA');
	$xmlapi->set_port('2087'); 
    $response = $xmlapi->xmlapi_query('cpanel', array( 'cpanel_xmlapi_user' => 'destiny', 'cpanel_xmlapi_module' => 'Email', 'cpanel_xmlapi_func' => 'listpopswithdisk', 'cpanel_xmlapi_apiversion' => 2));
	
break;
case "lista-dados-conta":

	$xmlapi = new xmlapi('pixelgo.com.br', 'pixel821', '5fpRvWnB.TCA');
	print_r($xmlapi->accountsummary("destiny"));
	
break;

}
?>