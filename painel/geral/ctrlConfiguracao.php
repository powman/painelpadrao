<?
/*
 *	Título: Controle da Classe
 *	Funçãoo: Responsável por fazer a solicitação de cadastro,
 *			alteração e exclusão do objeto (obs.: e suas respectivas fotos).
 *	Desenvolvido por: Paulo Henrique Pereira
 */

//inclui a classe do objeto
include_once "classes/class.Configuracao.php";
$objConfiguracao = new Configuracao();

$permissao = $objSecao->permissaoSecaoFixaUsuario("1",$objSession2->get('tlAdmLoginId'));

//verifica qual a ação está sendo solicitada pela câmada de visão(formulários)
switch ($_REQUEST['acao']) {
case "frmCad":
	// inclui o arquivo
	$abrePag = "../frms/frmCadConfiguracao.php";
	break;
case "cadastrar":
	//monta o array dos post
	$form['nome'] = $objPost->param['nome'];
	$form['email'] = $objPost->param['email'];
	$form['tipo'] = $objPost->param['tipo'];
	$form['status'] = 1;
	
	//Cadastra os dados
	$objUteis->decode($form);
	$result = $objConfiguracao->cadastrar($form);

	// verifica se cadastrou
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Configuração"),
						$objSession2->get('tlAdmLoginId'), "Cadastrou",
						$_SERVER['REMOTE_ADDR']);
	}

	//mostra o resultado para o usuário
	$objUteis
			->showResult("Configuracão cadastrada com sucesso.",
					"Erro ao cadastrar esta configuração.", $result,
					"mostraMensagem",
					'index.php?acao=listar&ctrl=configuracoes');
	exit();
	break;
case "listar":
	// lista todos os dados do banco de dados
	$condicao = array();
	$configuracaos = $objConfiguracao->listar();
	$objUteis->encode($configuracaos);
	// inclui o formulario
	$abrePag = "../frms/listaConfiguracao.php";
	break;
case "frmAlterar":
	// lista o dados no banco de dados pelo id
	$condicao = array(
		'id' => $objPost->param["id"]
	);
	$configuracaoForm = $objConfiguracao->lista($condicao);
	$objUteis->encode($configuracaoForm);
	// inclui o formulario
	$abrePag = "../frms/frmAltConfiguracao.php";
	break;
case "alterar":
	//monta o array para alterar
	$form = array();
	$form['id'] = $objPost->param['id'];
	$form['nome'] = $objPost->param['nome'];
	$form['email'] = $objPost->param['email'];
	$form['tipo'] = $objPost->param['tipo'];
	$form['status'] = 1;

	//altera o registro no banco
	$objUteis->decode($form);
	$result = $objConfiguracao->alterar($form);
	
	// verifica se foi alterado
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Configuração"),
						$objSession2->get('tlAdmLoginId'), "Alterou",
						$_SERVER['REMOTE_ADDR']);
	}

	//mostra o resultado para o usuário
	$objUteis
			->showResult("Configuração alterada com sucesso",
					"Erro ao alterar esta configuração, nenhuma alteração foi feita no formulário.", $result,
					"mostraMensagem",
					'index.php?acao=listar&ctrl=configuracoes');
	exit();

	break;
case "deletar":
	//deleta o registro no banco
	$result = $objConfiguracao->deletar($objPost->param['id']);
	
	// verifica se foi deletado
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Configuração"),
						$objSession2->get('tlAdmLoginId'), "Deletou",
						$_SERVER['REMOTE_ADDR']);
	}
	//mostra o resultado para o usuário via json
	$resposta = array();
	if (!$result) {
		$resposta['situacao'] = "error";
		$resposta['msg'] = "Erro ao deletar esta configuração.";

	} else {
		$resposta['situacao'] = "sucess";
		$resposta['msg'] = "Configuração deletada com sucesso.";
	}

	echo json_encode($resposta);

	exit();
	break;

case "publicar":
	//publica o objeto
	$result = $objConfiguracao->publicar($objPost->param['id'], $objPost->param['status']);
	//verifica o resultado
	$staturs = '';
	if ($result) {
		//verifica o status
		if ($objPost->param['status'] == "1") {
			$act = "ativou";
			$staturs = "Publicado";
		} else {
			$act = "desativou";
			$staturs = "Despublicado";
		}
	}
	// verifica se foi publicado
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Configuração"),
						$objSession2->get('tlAdmLoginId'), "Publicou",
						$_SERVER['REMOTE_ADDR']);
	}
	//mostra o resultado para o usuario via json
	$resposta = array();
	if (!$result) {
		$resposta['situacao'] = "error";
		$resposta['msg'] = "Erro ao publicar.";

	} else {
		$resposta['situacao'] = "sucess";
		$resposta['msg'] = "$staturs com sucesso.";
	}

	echo json_encode($resposta);
	exit();
	break;

}
?>