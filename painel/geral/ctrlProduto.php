<?
/*
 *	Título: Controle da Classe
 *	Funçãoo: Responsável por fazer a solicitação de cadastro,
 *			alteração e exclusão do objeto (obs.: e suas respectivas fotos).
 *	Desenvolvido por: Paulo Henrique Pereira
 */

//inclui a classe do objeto
include_once "classes/class.Produto.php";
$objProduto = new Produto();

//inclui a classe do objeto
include_once "classes/class.Categoria.php";
$objCategoria = new Categoria();

$permissao = $objSecao->permissaoSecaoFixaUsuario("7",$objSession2->get('tlAdmLoginId'));

//verifica qual a ação está sendo solicitada pela câmada de visão(formulários)
switch ($_REQUEST['acao']) {
case "frmCad":
	$categorias = $objCategoria->listar(array('status' => 1));
	$objUteis->encode($categorias);
	// inclui o arquivo
	$abrePag = "../frms/frmCadProduto.php";
	break;
case "cadastrar":
	//monta o array dos post
	$form['categoria_id'] = $objPost->param['categoria_id'];
	$form['nome'] = $objPost->param['nome'];
	$form['video'] = $objPost->param['video'];
	$form['texto'] = $objPost->param['texto'];
	$form['destaque'] = $objPost->param['destaque'];
	$form['status'] = 1;
	
	//se tiver selecionado uma imagem
	if($objPost->param["imagem"]["name"] !=""){
			
		$formatoImg = ".".$objUteis->formatoFile($objPost->param["imagem"]["name"]);
		if($formatoImg == ".jpg" || $formatoImg == ".JPG" || $formatoImg == ".jpeg" || $formatoImg == ".JPEG" || $formatoImg == ".png" || $formatoImg == ".PNG" || $formatoImg == ".gif" || $formatoImg == ".GIF") {
			
	
		}else{
			$objUteis->showResult("","Formato de arquivo inválido. apenas imagens .jpg, png, gif ou .jpeg",false,"mostraMensagem",'index.php?acao=listar&ctrl=produto');
			exit();
	
		}
			
		//Retorna formato da imagem
		$formatoImg = $objUteis->formatoFile($objPost->param["imagem"]["name"]);
		//Definir nome para imagem
		$dir = "arq_produto/";
		if(!file_exists("arq_produto")) {
			$objUteis->criaDir("arq_produto");
		}
		$nomeImg = "produto_".time().".".$formatoImg;
		$temp = $dir.$nomeImg;
		//Fazendo o upload da imagem
		$objUteis->uploadArq($objPost->param["imagem"]["tmp_name"],$temp);
	
		//gera thumb
		$img = $dir.$nomeImg;
	}
	
	$form['imagem'] = $img;
	
	//Cadastra os dados
	$objUteis->decode($form);
	$result = $objProduto->cadastrar($form);
	
	
	if ($result) {
		for ($i = 0; $i < $objPost->param['uploadergaleria_count']; $i++) {
			$formatoImg = ".".$objUteis->formatoFile($objPost->param["uploadergaleria_" . $i . "_name"]);
			
			$form2[] = array(
				'nome'	=> $objPost->param["uploadergaleria_" . $i . "_name"],
				'img'	=> 'arq_produto/'.$result."/" . md5($objPost->param["uploadergaleria_" . $i . "_name"]).$formatoImg,
				'produto_id' => $result
			);
	
			
		}
	
	}

	// verifica se cadastrou
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Produto"),
						$objSession2->get('tlAdmLoginId'), "Cadastrou",
						$_SERVER['REMOTE_ADDR']);
	}

	//mostra o resultado para o usuário
	$objUteis
			->showResult("Cadastrado com sucesso.",
					"Erro ao cadastrar.", $result,
					"mostraMensagem",
					'index.php?acao=listar&ctrl=produto');
	exit();
break;
case "cadastraFoto" :
	if (!$objPost->param['id']) {
		$proximo_id = $objProduto->proximo_id();
	}else{
		$proximo_id = $objPost->param['id'];
	}

	$formatoImg = ".".$objUteis->formatoFile($objPost->param["file"]["name"]);
	// Definir nome para imagem
	$dir = "arq_produto/".($proximo_id)."/";
	if (! file_exists ( $dir )) {
		$objUteis->criaDir ( $dir );
	}
	$nomeImg = $objPost->param["file"] ["name"];
	$temp = $dir . md5($objPost->param["file"] ["name"]).$formatoImg;
	// Fazendo o upload da imagem
	$result = $objUteis->uploadArq ($objPost->param["file"] ["tmp_name"], $temp );

	// gera thumb
	$img = $dir . md5($objPost->param["file"] ["name"]).$formatoImg;

	if ($proximo_id) {
			
		$form['nome'] = $objPost->param["file"] ["name"];
		$form['img'] = $img;
		$form['produto_id'] = $proximo_id;
		// inseri o registro no banco
		$objUteis->decode ( $form );
		$result = $objProduto->cadastrarFoto ( $form );
	}

	exit();
break;
case "listar":
	// lista todos os dados do banco de dados
	$condicao = array();
	$produtos = $objProduto->listar();
	$objUteis->encode($produtos);
	// inclui o formulario
	$abrePag = "../frms/listaProduto.php";
	break;
case "frmAlterar":
    $categorias = $objCategoria->listar(array('status' => 1));
	$objUteis->encode($categorias);
	// lista o dados no banco de dados pelo id
	$condicao = array(
		'id' => $objPost->param["id"]
	);
	$produtoForm = $objProduto->lista($condicao);
	$produtoForm->fotos = $objProduto->listar_fotos(array('produto_id' => $produtoForm->id));
	$objUteis->encode($produtoForm);
	
	
	// inclui o formulario
	$abrePag = "../frms/frmAltProduto.php";
	break;
case "alterar":
	//monta o array para alterar
	$form = array();
	$form['id'] = $objPost->param['id'];
	$form['categoria_id'] = $objPost->param['categoria_id'];
	$form['nome'] = $objPost->param['nome'];
	$form['video'] = $objPost->param['video'];
	$form['texto'] = $objPost->param['texto'];
	$form['destaque'] = $objPost->param['destaque'];
	$form['status'] = 1;
	
	//se tiver selecionado uma imagem
	if($objPost->param["imagem"]["name"]!=""){
	
		$formatoImg = ".".$objUteis->formatoFile($objPost->param["imagem"]["name"]);
		if($formatoImg == ".jpg" || $formatoImg == ".JPG" || $formatoImg == ".jpeg" || $formatoImg == ".JPEG" || $formatoImg == ".png" || $formatoImg == ".PNG" || $formatoImg == ".gif" || $formatoImg == ".GIF") {
			
		}else{
			$objUteis->showResult("","Formato de arquivo inválido. apenas imagens .jpg, png, gif ou .jpeg",false,"mostraMensagem",'index.php?acao=listar&ctrl=produto');
			exit();
		}
	
		//Retorna formato da imagem
		$formatoImg = ".".$objUteis->formatoFile($objPost->param["imagem"]["name"]);
		//Definir nome para imagem
		$dir = "arq_produto/";
		if(!file_exists("arq_produto")) {
			$objUteis->criaDir("arq_produto");
		}
		$nomeImg = "produto_".time()."".$formatoImg;
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
	$result = $objProduto->alterar($form);
	
	// verifica se foi alterado
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Produto"),
						$objSession2->get('tlAdmLoginId'), "Alterou",
						$_SERVER['REMOTE_ADDR']);
	}

	//mostra o resultado para o usuário
	$objUteis
			->showResult("Alterado com sucesso",
					"Erro ao alterar.", $result,
					"mostraMensagem",
					'index.php?acao=listar&ctrl=produto');
	exit();

	break;
case "deletar":
	
	$produto = $objProduto->lista(array('id' => $objPost->param['id']));
	$objUteis->encode($produto);
	
	$fotos = $objProduto->listar_fotos(array('produto_id' => $objPost->param['id']));
	$objUteis->encode($fotos);
	
	for($i=0;$i<$fotos["num"];$i++){
		$objUteis->delFile($fotos[$i]->img);
	}
	
	$objUteis->delFile($produto->imagem);
	
	//deleta o registro no banco
	$result = $objProduto->deletar($objPost->param['id']);
	
	// verifica se foi deletado
	if ($result) {
		//grava log de ação no sistema
		$objUteis
				->gravaLog($objSession2->get('tlAdmLoginNome'),
						utf8_decode("Produto"),
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

case "deletarFoto":
	//deleta a foto
	$result = $objProduto->deletarFoto($_REQUEST['id']);
	if($result){
		//deleta o arquivo
		$objUteis->delFile($_REQUEST['img']);
	}
	//grava log de aÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â§ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â£o no sistema
	$objUteis->gravaLog($objSession2->get('tlAdmLoginNome'),"foto do produto",$_REQUEST['id'],"deletou foto",$_SERVER['REMOTE_ADDR']);

	if (!$result) {
		$resposta->situacao = "error";
		$resposta->msg = "Erro ao deletar esta foto.";

	} else {
		$resposta->situacao = "sucess";
		$resposta->msg = "Foto deletada com sucesso.";
	}

	echo json_encode($resposta);

	exit();
break;

case "publicar":
	//publica o objeto
	$result = $objProduto->publicar($objPost->param['id'], $objPost->param['status']);
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
						utf8_decode("Produto"),
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