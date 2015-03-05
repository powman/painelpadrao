<?
/*
 *	Título: Controle da Classe
 *	Funçãoo: Responsável por fazer a solicitação de cadastro,
 *			alteração e exclusão do objeto (obs.: e suas respectivas fotos).
 *	Desenvolvido por: Paulo Henrique Pereira
 */

//inclui a classe do objeto
include_once "classes/class.Empresa.php";
$objEmpresa = new Empresa();

$permissao = $objSecao->permissaoSecaoFixaUsuario("3",$objSession2->get('tlAdmLoginId'));

//verifica qual a ação está sendo solicitada pela câmada de visão(formulários)
switch ($_REQUEST['acao']) {

case "frmAlterar":
	// lista o dados no banco de dados pelo id
	$condicao = array(
		'id' => $objPost->param["id"]
	);
	$empresaForm = $objEmpresa->lista($condicao);
	$objUteis->encode($empresaForm);
	// inclui o formulario
	$abrePag = "../frms/frmAltEmpresa.php";
break;
case "alterar":
	//monta o array para alterar
	$form = array();
	$form['id'] = $objPost->param['id'];
	$form['titulo'] = $objPost->param['titulo'];
	$form['texto'] = $objPost->param['texto'];
	$form['status'] = 1;
	
	
	//se tiver selecionado uma imagem
	

	//altera o registro no banco
	$objUteis->decode($form);
	$result = $objEmpresa->alterar($form);
	
	//verifica se foi alterado
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Empresa"),
						$objSession2->get('tlAdmLoginId'), "Alterou",
						$_SERVER['REMOTE_ADDR']);
	}

	//mostra o resultado para o usuário
	$objUteis
			->showResult("Alterado com sucesso",
					"Erro ao alterar.", $result,
					"mostraMensagem",
					'index.php?acao=frmAlterar&ctrl=empresa&id='.$objPost->param['id']);
	exit();

break;

}
?>