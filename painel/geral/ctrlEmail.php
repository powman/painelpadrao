<?php
/*
 *	Título: Controle da Classe
 *	Funçãoo: Responsável por fazer a solicitação de cadastro,
 *			alteração e exclusão do objeto (obs.: e suas respectivas fotos).
 *	Desenvolvido por: Paulo Henrique Pereira
 */

//inclui a classe do objeto
include_once "classes/class.Email.php";
$objEmail = new Email();

include_once "classes/class.csv.php";
$objCsv = new CSV();

//verifica qual a ação está sendo solicitada pela câmada de visão(formulários)
switch ($_REQUEST['acao']) {
case "listar":
	// lista todos os dados do banco de dados
	$condicao = array();
	$emails = $objEmail->listar();
	$objUteis->encode($emails);
	// inclui o formulario
	$abrePag = "../frms/listaEmail.php";
	break;
case "deletar":
	//deleta o registro no banco
	$result = $objEmail->deletar($objPost->param['id']);
	
	// verifica se foi deletado
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Email"),
						$objSession2->get('tlAdmLoginId'), "Deletou",
						$_SERVER['REMOTE_ADDR']);
	}
	//mostra o resultado para o usuário via json
	$resposta = array();
	if (!$result) {
		$resposta['situacao'] = "error";
		$resposta['msg'] = "Erro ao deletar.";

	} else {
		$resposta['situacao'] = "sucess";
		$resposta['msg'] = "Deletado com sucesso.";
	}

	echo json_encode($resposta);

	exit();
break;
case 'criar_csv':

	$newss = $objEmail->listar();
	$objUteis->encode($newss);

	// set headings
	$objCsv->setHeading('Nome', 'Email');

	for($i=0;$i<$newss["num"];$i++){
		// add a line of data
		$objCsv->addLine($newss[$i]->nome, $newss[$i]->email);

	}
	$objCsv->output("D","emails.csv");
	$objCsv->clear();

	exit();

break;

}
