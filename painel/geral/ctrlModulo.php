<?
/*
 *	Título: Controle da Classe
 *	Funçãoo: Responsável por fazer a solicitação de cadastro,
 *			alteração e exclusão do objeto (obs.: e suas respectivas fotos).
 *	Desenvolvido por: Paulo Henrique Pereira
 */

//inclui a classe do objeto
include_once "classes/class.Modulo.php";
$objModulo = new Modulo();

$permissao = $objSecao->permissaoSecaoFixaUsuario("1",$objSession2->get('tlAdmLoginId'));

//verifica qual a ação está sendo solicitada pela câmada de visão(formulários)
switch ($objPost->param['acao']) {
case "frmCad":
	// inclui o arquivo
	$abrePag = "../frms/frmCadModulo.php";
	break;
case "cadastrar":
	//monta o array dos post
	$form = array();
	$form['titulo'] = $objPost->param["titulo"];
	$form['menu'] = $objPost->param["menu"];
	$form['ctrl'] = $objPost->param['ctrlModulo'];
	$form['img'] = $objPost->param['img'];
	
	//Cadastra os dados
	$objUteis->decode($form);
	$result = $objModulo->cadastrar($form);
	
	//Cadastra subtipos
	$form2 = array();
	for ($i = 0; $i < count($objPost->param["tituloform"]); $i++) {
		$form2['secao_fixa_id'] = $result;
		$form2['titulo'] = $objPost->param["tituloform"][$i];
		$form2['url'] = $objPost->param["url"][$i];

		$objUteis->decode($form2);
		$result2 = $objModulo->cadastrarMenu($form2);
	}

	// verifica se cadastrou
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Módulo"),
						$objSession2->get('tlAdmLoginId'), "Cadastrou",
						$_SERVER['REMOTE_ADDR']);
	}

	//mostra o resultado para o usuário
	$objUteis
			->showResult("Módulo cadastrado com sucesso.",
					"Erro ao cadastrar este módulo.", $result2,
					"mostraMensagem", 'index.php?acao=listar&ctrl=modulo');
	exit();
	break;
case "listar":
	// lista todos os dados do banco de dados
	$condicao = array();
	$modulos = $objModulo->listar('','ordem ASC');
	$objUteis->encode($modulos);
	// inclui o formulario
	$abrePag = "../frms/listaModulo.php";
	break;
case "frmAlterar":
	// lista o dados no banco de dados pelo id
	$modulo = $objModulo->moduloById($objPost->param['id']);
	$objUteis->encode($modulo);
	// inclui o formulario
	$abrePag = "../frms/frmAltModulo.php";
	break;
case "alterar":
	//monta o array para alterar
	$form['id'] = $objPost->param['id'];
	$form['titulo'] = $objPost->param['titulo'];
	$form['menu'] = $objPost->param['menu'];
	$form['ctrl'] = $objPost->param['ctrlModulo'];
	$form['img'] = $objPost->param['img'];

	//altera o registro no banco
	$objUteis->decode($form);
	$result = $objModulo->alterar($form);

	if($result){
		//monta o array para alterar os subtipos
		if (count($objPost->param["tituloform"])) {
			$objModulo->limparRelacao($objPost->param['id']);
		
			for ($i = 0; $i < count($objPost->param["tituloform"]); $i++) {
				if ($objPost->param["tituloform"][$i] && $objPost->param["url"][$i] != "") {
					$form2['secao_fixa_id'] = $objPost->param['id'];
					$form2['titulo'] = $objPost->param["tituloform"][$i];
					$form2['url'] = $objPost->param["url"][$i];
		
					$objUteis->decode($form2);
					$result = $objModulo->cadastrarMenu($form2);
				}
			}
		}
	}

	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Módulo"),
						$objSession2->get('tlAdmLoginId'), "Alterou",
						$_SERVER['REMOTE_ADDR']);
	}

	//mostra o resultado para o usuário
	$objUteis
			->showResult("Módulo alterado com sucesso",
					"Erro ao alterar este módulo, ou nenhum dados foi alterado no formulário.", $result,
					"mostraMensagem", 'index.php?acao=listar&ctrl=modulo');
	exit();

	break;
case "deletar":
	//deleta o registro no banco
	$result = $objModulo->deletar($_REQUEST['id']);
	// verifica se foi deletado
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Módulo"),
						$objSession2->get('tlAdmLoginId'), "Deletou",
						$_SERVER['REMOTE_ADDR']);
	}
	$resposta = array();
	if (!$result) {
		$resposta['situacao'] = "error";
		$resposta['msg'] = "Erro ao deletar este módulo.";

	} else {
		$resposta['situacao'] = "sucess";
		$resposta['msg'] = "Módulo deletado com sucesso.";
	}

	echo json_encode($resposta);

	exit();
	break;

case "alterarOrdem":
	$id = $objPost->param["id"];
	$fromPosition = $objPost->param["fromPosition"];
	$toPosition = $objPost->param["toPosition"];
	$direction = $objPost->param["direction"];

	$listagens = $objModulo->listar('','ordem ASC');
	$objUteis->encode($listagens);

	for ($i = 0; $i < $listagens["num"]; $i++) {
		$resultaff = $objModulo->alteraOrdem($listagens[$i]->id, $i);
	}

	if ($direction == "forward") {

		$listagens = $objModulo->pegarListagensParaAlterarForward($fromPosition, $toPosition);
		$objUteis->encode($listagens);

		for ($i = 0; $i < $listagens["num"]; $i++) {

			$listagens[$i]->ordem--;
			if ($listagens[$i]->id == $id) {
				$listagens[$i]->ordem = $toPosition;
			}

			$result = $objModulo->alteraOrdem($listagens[$i]->id,$listagens[$i]->ordem);

		}

	}

	if ($direction == "back") {

		$listagens = $objModulo->pegarListagensParaAlterarBack($fromPosition, $toPosition);
		$objUteis->encode($listagens);

		for ($i = 0; $i < $listagens["num"]; $i++) {

			$listagens[$i]->ordem++;
			if ($listagens[$i]->id == $id) {
				$listagens[$i]->ordem = $toPosition;
			}

			$result = $objModulo->alteraOrdem($listagens[$i]->id,$listagens[$i]->ordem);

		}

	}

	if ($result) {
		echo "Ordem alterada com sucesso";
	} else {
		echo "Erro ao alterar esta ordem";
	}

	exit();

	break;

}
?>