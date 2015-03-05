<?
/*
 *	Título: Controle da Classe
 *	Funçãoo: Responsável por fazer a solicitação de cadastro,
 *			alteração e exclusão do objeto (obs.: e suas respectivas fotos).
 *	Desenvolvido por: Paulo Henrique Pereira
 */

//inclui a classe do objeto
include_once "classes/class.Cliente.php";
$objCliente = new Cliente();

$permissao = $objSecao->permissaoSecaoFixaUsuario("8",$objSession2->get('tlAdmLoginId'));

//verifica qual a ação está sendo solicitada pela câmada de visão(formulários)
switch ($_REQUEST['acao']) {
case "frmCad":
	// inclui o arquivo
	$abrePag = "../frms/frmCadCliente.php";
	break;
case "cadastrar":
	//monta o array dos post
	$form['nome'] = $objPost->param['nome'];
	$form['url'] = $objPost->param['url'];
	
	//se tiver selecionado uma imagem
	if($objPost->param["imagem"]["name"] !=""){
			
		$formatoImg = ".".$objUteis->formatoFile($objPost->param["imagem"]["name"]);
		if($formatoImg == ".jpg" || $formatoImg == ".JPG" || $formatoImg == ".jpeg" || $formatoImg == ".JPEG" || $formatoImg == ".png" || $formatoImg == ".PNG" || $formatoImg == ".gif" || $formatoImg == ".GIF") {
	
		}else{
			$objUteis->showResult("","Formato de arquivo inválido. apenas imagens .jpg, png, gif ou .jpeg",false,"mostraMensagem",'index.php?acao=listar&ctrl=cliente');
			exit();
	
		}
			
		//Retorna formato da imagem
		$formatoImg = $objUteis->formatoFile($objPost->param["imagem"]["name"]);
		//Definir nome para imagem
		$dir = "arq_cliente/";
		if(!file_exists("arq_cliente")) {
			$objUteis->criaDir("arq_cliente");
		}
		$nomeImg = "cliente_".time().".".$formatoImg;
		$temp = $dir.$nomeImg;
		//Fazendo o upload da imagem
		$objUteis->uploadArq($objPost->param["imagem"]["tmp_name"],$temp);
	
		//gera thumb
		$img = $dir.$nomeImg;
	}
	
	$form['imagem'] = $img;
	
	//Cadastra os dados
	$objUteis->decode($form);
	$result = $objCliente->cadastrar($form);

	// verifica se cadastrou
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Cliente"),
						$objSession2->get('tlAdmLoginId'), "Cadastrou",
						$_SERVER['REMOTE_ADDR']);
	}

	//mostra o resultado para o usuário
	$objUteis
			->showResult("Cadastrado com sucesso.",
					"Erro ao cadastrar.", $result,
					"mostraMensagem",
					'index.php?acao=listar&ctrl=cliente');
	exit();
	break;
case "listar":
	// lista todos os dados do banco de dados
	$condicao = array();
	$clientes = $objCliente->listar();
	$objUteis->encode($clientes);
	// inclui o formulario
	$abrePag = "../frms/listaCliente.php";
	break;
case "frmAlterar":
	// lista o dados no banco de dados pelo id
	$condicao = array(
		'id' => $objPost->param["id"]
	);
	$clienteForm = $objCliente->lista($condicao);
	$objUteis->encode($clienteForm);
	// inclui o formulario
	$abrePag = "../frms/frmAltCliente.php";
	break;
case "alterar":
	//monta o array para alterar
	$form = array();
	$form['id'] = $objPost->param['id'];
	$form['nome'] = $objPost->param['nome'];
	$form['url'] = $objPost->param['url'];
	
	//se tiver selecionado uma imagem
	if($objPost->param["imagem"]["name"]!=""){
	
		$formatoImg = ".".$objUteis->formatoFile($objPost->param["imagem"]["name"]);
		if($formatoImg == ".jpg" || $formatoImg == ".JPG" || $formatoImg == ".jpeg" || $formatoImg == ".JPEG" || $formatoImg == ".png" || $formatoImg == ".PNG" || $formatoImg == ".gif" || $formatoImg == ".GIF") {

		}else{
			$objUteis->showResult("","Formato de arquivo inválido. apenas imagens .jpg, png, gif ou .jpeg",false,"mostraMensagem",'index.php?acao=listar&ctrl=cliente');
			exit();
		}
	
		//Retorna formato da imagem
		$formatoImg = ".".$objUteis->formatoFile($objPost->param["imagem"]["name"]);
		//Definir nome para imagem
		$dir = "arq_cliente/";
		if(!file_exists("arq_cliente")) {
			$objUteis->criaDir("arq_cliente");
		}
		$nomeImg = "cliente_".time()."".$formatoImg;
		$temp = $dir.$nomeImg;
		//deleta a imagem antiga
		$objUteis->delFile($objPost->param['imgAntiga']);
		//Fazendo o upload da imagem
		$objUteis->uploadArq($objPost->param["imagem"]["tmp_name"],$temp);
		$form['imagem']			= $dir.$nomeImg;
	}else{
		$form['imagem']			= $objPost->param['imgAntiga'];
	}

	//altera o registro no banco
	$objUteis->decode($form);
	$result = $objCliente->alterar($form);
	
	// verifica se foi alterado
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Cliente"),
						$objSession2->get('tlAdmLoginId'), "Alterou",
						$_SERVER['REMOTE_ADDR']);
	}

	//mostra o resultado para o usuário
	$objUteis
			->showResult("Alterado com sucesso",
					"Erro ao alterar.", $result,
					"mostraMensagem",
					'index.php?acao=listar&ctrl=cliente');
	exit();

	break;
case "deletar":
	//deleta o registro no banco
	$result = $objCliente->deletar($objPost->param['id']);
	
	// verifica se foi deletado
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Cliente"),
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

case "publicar":
	//publica o objeto
	$result = $objCliente->publicar($objPost->param['id'], $objPost->param['status']);
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
						utf8_decode("Cliente"),
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