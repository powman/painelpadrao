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

//verifica qual a ação está sendo solicitada pela câmada de visão(formulários)
switch ($_REQUEST['acao']) {
case "frmCad":
	// inclui o arquivo
	$abrePag = "../frms/frmCadCpanel.php";
	break;
case "listar":
	$xmlapi = new xmlapi('pixelgo.com.br', 'pixel821', '5fpRvWnB.TCA');
	print_r($xmlapi->accountsummary("destiny"));

	//print $xmlapi->accountsummary("destiny");

	
break;
case "cadastrar-conta":

	    $whm = new xmlapi('pixelgo.com.br', 'pixel821', '5fpRvWnB.TCA');
	 
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
    print_r($response);
	
break;
case "lista-dados-conta":

	$xmlapi = new xmlapi('pixelgo.com.br', 'pixel821', '5fpRvWnB.TCA');
	print_r($xmlapi->accountsummary("destiny"));
	
break;

}
?>