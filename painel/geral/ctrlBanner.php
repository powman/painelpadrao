<?php
/*
 *	Título: Controle da Classe
 *	Funçãoo: Responsável por fazer a solicitação de cadastro,
 *			alteração e exclusão do objeto (obs.: e suas respectivas fotos).
 *	Desenvolvido por: Paulo Henrique Pereira
 */

//inclui a classe do objeto
include_once "classes/class.Banner.php";
$objBanner = new Banner();

$permissao = $objSecao->permissaoSecaoFixaUsuario("4",$objSession2->get('tlAdmLoginId'));

//verifica qual a ação está sendo solicitada pela câmada de visão(formulários)
switch ($_REQUEST['acao']) {
case "frmCad":
	// inclui o arquivo
	$abrePag = "../frms/frmCadBanner.php";
	break;
case "cadastrar":
	//monta o array dos post
	$form['titulo'] = $objPost->param['titulo'];
	$form['url'] = $objPost->param['url'];
	
	//se tiver selecionado uma imagem
	if($objPost->param["imagem"]["name"] !=""){
			
		$formatoImg = ".".$objUteis->formatoFile($objPost->param["imagem"]["name"]);
		if($formatoImg == ".jpg" || $formatoImg == ".JPG" || $formatoImg == ".jpeg" || $formatoImg == ".JPEG" || $formatoImg == ".png" || $formatoImg == ".PNG" || $formatoImg == ".gif" || $formatoImg == ".GIF") {
			$verificaTamanho = $objUteis->TamanhodaImagem($objPost->param["imagem"]["tmp_name"]);
			if($verificaTamanho["largura"] != "1110" && $verificaTamanho["altura"] != "200"){

				$objUteis->showResult("","A Largura e altura da imagem não confere. Largura: 1110 - Altura: 200",false,"mostraMensagem",'index.php?acao=listar&ctrl=banner');
				exit();
			}
	
		}else{
			$objUteis->showResult("","Formato de arquivo inválido. apenas imagens .jpg, png, gif ou .jpeg",false,"mostraMensagem",'index.php?acao=listar&ctrl=banner');
			exit();
	
		}
			
		//Retorna formato da imagem
		$formatoImg = $objUteis->formatoFile($objPost->param["imagem"]["name"]);
		//Definir nome para imagem
		$dir = "arq_banner/";
		if(!file_exists("arq_banner")) {
			$objUteis->criaDir("arq_banner");
		}
		$nomeImg = "banner_".time().".".$formatoImg;
		$temp = $dir.$nomeImg;
		//Fazendo o upload da imagem
		$objUteis->uploadArq($objPost->param["imagem"]["tmp_name"],$temp);
	
		//gera thumb
		$img = $dir.$nomeImg;
	}
	
	$form['imagem'] = $img;
	
	//Cadastra os dados
	$objUteis->decode($form);
	$result = $objBanner->cadastrar($form);

	// verifica se cadastrou
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Banner"),
						$objSession2->get('tlAdmLoginId'), "Cadastrou",
						$_SERVER['REMOTE_ADDR']);
	}

	//mostra o resultado para o usuário
	$objUteis
			->showResult("Cadastrado com sucesso.",
					"Erro ao cadastrar.", $result,
					"mostraMensagem",
					'index.php?acao=listar&ctrl=banner');
	exit();
	break;
case "listar":
	// lista todos os dados do banco de dados
	$condicao = array();
	$banners = $objBanner->listar();
	$objUteis->encode($banners);
	// inclui o formulario
	$abrePag = "../frms/listaBanner.php";
	break;
case "frmAlterar":
	// lista o dados no banco de dados pelo id
	$condicao = array(
		'id' => $objPost->param["id"]
	);
	$bannerForm = $objBanner->lista($condicao);
	$objUteis->encode($bannerForm);
	// inclui o formulario
	$abrePag = "../frms/frmAltBanner.php";
	break;
case "alterar":
	//monta o array para alterar
	$form = array();
	$form['id'] = $objPost->param['id'];
	$form['titulo'] = $objPost->param['titulo'];
	$form['url'] = $objPost->param['url'];
	
	//se tiver selecionado uma imagem
	if($objPost->param["imagem"]["name"]!=""){
	
		$formatoImg = ".".$objUteis->formatoFile($objPost->param["imagem"]["name"]);
		if($formatoImg == ".jpg" || $formatoImg == ".JPG" || $formatoImg == ".jpeg" || $formatoImg == ".JPEG" || $formatoImg == ".png" || $formatoImg == ".PNG" || $formatoImg == ".gif" || $formatoImg == ".GIF") {
			$verificaTamanho = $objUteis->TamanhodaImagem($objPost->param["imagem"]["tmp_name"]);
			if($verificaTamanho["largura"] != "1110" && $verificaTamanho["altura"] != "200"){

				$objUteis->showResult("","A Largura e altura da imagem não confere. Largura: 1110 - Altura: 200",false,"mostraMensagem",'index.php?acao=listar&ctrl=banner');
				exit();
				}
		}else{
			$objUteis->showResult("","Formato de arquivo inválido. apenas imagens .jpg, png, gif ou .jpeg",false,"mostraMensagem",'index.php?acao=listar&ctrl=banner');
			exit();
		}
	
		//Retorna formato da imagem
		$formatoImg = ".".$objUteis->formatoFile($objPost->param["imagem"]["name"]);
		//Definir nome para imagem
		$dir = "arq_banner/";
		if(!file_exists("arq_banner")) {
			$objUteis->criaDir("arq_banner");
		}
		$nomeImg = "banner_".time()."".$formatoImg;
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
	$result = $objBanner->alterar($form);
	
	// verifica se foi alterado
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Banner"),
						$objSession2->get('tlAdmLoginId'), "Alterou",
						$_SERVER['REMOTE_ADDR']);
	}

	//mostra o resultado para o usuário
	$objUteis
			->showResult("Alterado com sucesso",
					"Erro ao alterar.", $result,
					"mostraMensagem",
					'index.php?acao=listar&ctrl=banner');
	exit();

	break;
case "deletar":
	//deleta o registro no banco
	$result = $objBanner->deletar($objPost->param['id']);
	
	// verifica se foi deletado
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Banner"),
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
	$result = $objBanner->publicar($objPost->param['id'], $objPost->param['status']);
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
						utf8_decode("Banner"),
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
