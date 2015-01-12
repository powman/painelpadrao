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
case "listar":
    $user = $conf["whm"]['userCpanelCliente'];
    $xmlapi = new xmlapi($conf["whm"]['dominio'], $conf["whm"]['user'], $conf["whm"]['pass']);
    $aDados = json_decode(json_encode((array)$xmlapi->accountsummary($user)), TRUE);

    $abrePag = "../frms/cpanel/listaCpanel.php";

break;

// Bloco Email

case "criar-email":
	// inclui o arquivo
	$abrePag = "../frms/cpanel/frmCadEmail.php";
break;
case "alterar-email":
    $xmlapi = new xmlapi($conf["whm"]['dominio'], $conf["whm"]['user'], $conf["whm"]['pass']);
    
    // Todos os Emails
    $params = array(
            'domain' => $conf["whm"]['dominioCpanelCliente'],
            'nearquotaonly' => 0,
            'no_validate' => 0,
            'regex' => $objPost->param['user']
    
    );
    $funcao = $xmlapi->api2_query($conf["whm"]['userCpanelCliente'],'Email','listpopswithdisk',$params);
    $aEmails = json_decode(json_encode((array)$funcao), TRUE);
    
    // Fim Todos os Emails
    // inclui o arquivo
    $abrePag = "../frms/cpanel/frmAltEmail.php";
break;
case "cadastrar-email":
        $params = array('password'=> $objPost->param['senha'], 'quota'=>$objPost->param['quota'], 'email' => str_replace("@".$conf["whm"]['dominioCpanelCliente'], '', $objPost->param['email']), 'domain' => $conf["whm"]['dominioCpanelCliente']);
	    $xmlapi = new xmlapi($conf["whm"]['dominio'], $conf["whm"]['user'], $conf["whm"]['pass']);
	    $addEmail = $xmlapi->api2_query($conf["whm"]['userCpanelCliente'],'Email','addpop',$params);
	    $addEmail = json_decode(json_encode((array)$addEmail), TRUE);
	 
	    if($addEmail['data']['result']){
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
        		        'index.php?acao=listar-emails&ctrl=cpanel');
	    }
	    else{
	        
	       //mostra o resultado para o usuário
    	    $objUteis
        		->showResult("Cadastrado com sucesso.",
        		        "Erro ao cadastrar.", false,
        		        "mostraMensagem",
        		        'index.php?acao=listar-emails&ctrl=cpanel');
	    }
	    
	    exit();
	
break;
case "listar-emails":
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
	$abrePag = "../frms/cpanel/listaEmail.php";

break;
case "deletar-email":
    $params = array(
        'domain' => $conf["whm"]['dominioCpanelCliente'], 
        'email' => $objPost->param['email']
    );
    $xmlapi = new xmlapi($conf["whm"]['dominio'], $conf["whm"]['user'], $conf["whm"]['pass']);
    $delEmail = $xmlapi->api2_query($conf["whm"]['userCpanelCliente'],'Email','delpop',$params);
    $delEmail = json_decode(json_encode((array)$delEmail), TRUE);

    // verifica se foi deletado
    if ($delEmail['data']['result']) {
        //grava log de ação no sistema
        $objUteis
        ->gravaLog($objSession2->get('tlAdmLoginNome'),
                utf8_decode("Email"),
                $objSession2->get('tlAdmLoginId'), "Deletou",
                $_SERVER['REMOTE_ADDR']);
    }
    //mostra o resultado para o usuário via json
    $resposta = array();
    if (!$delEmail['data']['result']) {
        $resposta['situacao'] = "error";
        $resposta['msg'] = "Erro ao deletar.";

    } else {
        $resposta['situacao'] = "sucess";
        $resposta['msg'] = "Deletado com sucesso.";
    }

    echo json_encode($resposta);

    exit();
break;
case "altera-email":
    $xmlapi = new xmlapi($conf["whm"]['dominio'], $conf["whm"]['user'], $conf["whm"]['pass']);
    $result = false;
    if($objPost->param['quota']){
        $params = array('quota'=>$objPost->param['quota'], 'email' => $objPost->param['email'], 'domain' => $conf["whm"]['dominioCpanelCliente']);
        $editEmail = $xmlapi->api2_query($conf["whm"]['userCpanelCliente'],'Email','editquota',$params);
        $editEmail = json_decode(json_encode((array)$editEmail), TRUE);
    
        if($editEmail['data']['result']){
            //grava log de ação no sistema
            $objUteis
        				->gravaLog($objSession2->get('tlAdmLoginNome'),
        				        utf8_decode("Conta de Email"),
        				        $objSession2->get('tlAdmLoginId'), "Alterou a Cota",
        				        $_SERVER['REMOTE_ADDR']);
            $result = true;
    
            
        }
    }
    
    if($objPost->param['senha']){
        $params = array('password'=>$objPost->param['senha'], 'email' => $objPost->param['email'], 'domain' => $conf["whm"]['dominioCpanelCliente']);
        $editEmail = $xmlapi->api2_query($conf["whm"]['userCpanelCliente'],'Email','passwdpop',$params);
        $editEmail = json_decode(json_encode((array)$editEmail), TRUE);
        
        if($editEmail['data']['result']){
            //grava log de ação no sistema
                $objUteis
                ->gravaLog($objSession2->get('tlAdmLoginNome'),
                        utf8_decode("Conta de Email"),
                        $objSession2->get('tlAdmLoginId'), "Alterou a Senha",
                        $_SERVER['REMOTE_ADDR']);
            
            $result = true;
        }
    }
    
    if($result){
        //mostra o resultado para o usuário
        $objUteis
        ->showResult("Alterado com sucesso.",
                "Erro ao cadastrar.", $result,
                "mostraMensagem",
                'index.php?acao=listar-emails&ctrl=cpanel');
    }
     
    exit();

break;

// FIM bloco Email


case "criar-ftp":
    // inclui o arquivo
    $abrePag = "../frms/cpanel/frmCadFtp.php";
break;
case "listar-ftp":
    $xmlapi = new xmlapi($conf["whm"]['dominio'], $conf["whm"]['user'], $conf["whm"]['pass']);
    $aFtps = json_decode(json_encode((array)$xmlapi->listftpwithdisk($conf["whm"]['userCpanelCliente'])), TRUE);

    // Fim Todos os Emails
    $abrePag = "../frms/cpanel/listaFtp.php";

break;

case "cadastrar-ftp":
    if($objPost->param['dir']){
        $params = array(
            'pass'=> $objPost->param['senha'], 
            'quota'=>$objPost->param['quota'], 
            'user' => $objPost->param['user'], 
            'homedir' => '/public_html/'.str_replace(",", "/", $objPost->param['dir'])
        );
        $xmlapi = new xmlapi($conf["whm"]['dominio'], $conf["whm"]['user'], $conf["whm"]['pass']);
        $addEmail = $xmlapi->api2_query($conf["whm"]['userCpanelCliente'],'Ftp','addftp',$params);
        $addEmail = json_decode(json_encode((array)$addEmail), TRUE);
    
        if($addEmail['data']['result']){
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
                    'index.php?acao=listar-ftp&ctrl=cpanel');
        }
        else{
             
            //mostra o resultado para o usuário
            $objUteis
            ->showResult("Cadastrado com sucesso.",
                    "Erro ao cadastrar.", false,
                    "mostraMensagem",
                    'index.php?acao=listar-ftp&ctrl=cpanel');
        }
    }
     
    exit();

break;

case "alterar-ftp":
    $xmlapi = new xmlapi($conf["whm"]['dominio'], $conf["whm"]['user'], $conf["whm"]['pass']);
    
    $aFtps = json_decode(json_encode((array)$xmlapi->listftpwithdisk($conf["whm"]['userCpanelCliente'])), TRUE);
    foreach ($aFtps['data'] as $values){
        if($values['login'] ==  $objPost->param['user']){
            $aFtpsAtual['login'] = $values['login'];
            $aFtpsAtual['dir'] = $values['dir'];
            $aFtpsAtual['reldir'] = $values['reldir'];
            $aFtpsAtual['diskquota'] = $values['diskquota'];
            $aFtpsAtual['diskused'] = $values['diskused'];
            $aFtpsAtual['humandiskquota'] = $values['humandiskquota'];
            $aFtpsAtual['humandiskused'] = $values['humandiskused'];
            $aFtpsAtual['serverlogin'] = $values['serverlogin'];
        }
    }

    // Fim Todos os Emails
    // inclui o arquivo
    $abrePag = "../frms/cpanel/frmAltFtp.php";
break;

case "altera-ftp":
    $xmlapi = new xmlapi($conf["whm"]['dominio'], $conf["whm"]['user'], $conf["whm"]['pass']);
    $result = false;
    if($objPost->param['quota']){
        $params = array('quota'=>$objPost->param['quota'], 'user' => $objPost->param['user']);
        $editEmail = $xmlapi->api2_query($conf["whm"]['userCpanelCliente'],'Ftp','setquota',$params);
        $editEmail = json_decode(json_encode((array)$editEmail), TRUE);

        if($editEmail['data']['result']){
            //grava log de ação no sistema
            $objUteis
        				->gravaLog($objSession2->get('tlAdmLoginNome'),
        				        utf8_decode("FTP"),
        				        $objSession2->get('tlAdmLoginId'), "Alterou a Cota",
        				        $_SERVER['REMOTE_ADDR']);
            $result = true;


        }
    }
    
   

    if($objPost->param['senha']){
        
        $params = array('pass' => $objPost->param['senha'], 'user' => $objPost->param['user']);
        $editEmail = $xmlapi->api2_query($conf["whm"]['userCpanelCliente'],'Ftp','passwd',$params);
        $editEmail = json_decode(json_encode((array)$editEmail), TRUE);

        if($editEmail['data']['result']){
            //grava log de ação no sistema
            $objUteis
            ->gravaLog($objSession2->get('tlAdmLoginNome'),
                    utf8_decode("FTP"),
                    $objSession2->get('tlAdmLoginId'), "Alterou a Senha",
                    $_SERVER['REMOTE_ADDR']);

            $result = true;
        }
    }

    if($result){
        //mostra o resultado para o usuário
        $objUteis
        ->showResult("Alterado com sucesso.",
                "Erro ao cadastrar.", $result,
                "mostraMensagem",
                'index.php?acao=listar-ftp&ctrl=cpanel');
    }
     
    exit();

break;

case "deletar-ftp":
    $params = array(
        'user' => $objPost->param['user'],
        'destroy' => 1
    );
    $xmlapi = new xmlapi($conf["whm"]['dominio'], $conf["whm"]['user'], $conf["whm"]['pass']);
    $delFtp = $xmlapi->api2_query($conf["whm"]['userCpanelCliente'],'Ftp','delftp',$params);
    $delFtp = json_decode(json_encode((array)$delFtp), TRUE);

    // verifica se foi deletado
    if ($delFtp['data']['result']) {
        //grava log de ação no sistema
        $objUteis
        ->gravaLog($objSession2->get('tlAdmLoginNome'),
                utf8_decode("Ftp"),
                $objSession2->get('tlAdmLoginId'), "Deletou",
                $_SERVER['REMOTE_ADDR']);
    }
    //mostra o resultado para o usuário via json
    $resposta = array();
    if (!$delFtp['data']['result']) {
        $resposta['situacao'] = "error";
        $resposta['msg'] = "Erro ao deletar.";

    } else {
        $resposta['situacao'] = "sucess";
        $resposta['msg'] = "Deletado com sucesso.";
    }

    echo json_encode($resposta);

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

case "lista-dados-conta":

	$xmlapi = new xmlapi('pixelgo.com.br', 'pixel821', '5fpRvWnB.TCA');
	print_r($xmlapi->accountsummary("destiny"));
	
break;

}
?>