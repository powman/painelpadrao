<?php

//inclui a classe de not�cias e estância um objeto
include_once "classes/class.Imovel.php";
$objImovel = new Imovel();

//inclui a classe de not�cias e estância um objeto
include_once "classes/class.Correios.php";
$objCorreio = new Correios();

//inclui a classe de not�cias e estância um objeto
include_once "classes/class.Situacao.php";
$objSituacao = new Situacao();

//inclui a classe de not�cias e estância um objeto
include_once "classes/class.Tipo.php";
$objTipo = new Tipo();

$permissao = $objSecao->permissaoSecaoFixaUsuario("2",$objSession2->get('tlAdmLoginId'));

$secoes_fixas = $objSecao->listar_fixas();
$objUteis->encode($secoes_fixas);

//verifica qual a a��o est� sendo solicitada pela câmada de vis�o(formul�rios)
switch($_REQUEST['acao']){
	case "frmCad":
		$estados = $objCorreio->listar_estado();
		$objUteis->encode($estados);
		$categorias = $objImovel->listar_categoria(array("status" => 1));
		$objUteis->encode($categorias);
		$situacaoes = $objSituacao->listar(array("status" => 1));
		$objUteis->encode($situacaoes);
		$tipos = $objTipo->listar(array("status" => 1));
		$objUteis->encode($tipos);
		$abrePag = "../frms/frmCadImovel.php";
		break;
	case "cadastrar":
		$estado = $objCorreio->lista_estado(array(0 => " AND id = '".$_POST['estado']."' "));
		$objUteis->encode($estado);
		//monta o objeto com os dados do formul�rio
		$form['destaque'] 			            = $objPost->param['destaque'];
		$form['imoveis_categoria_id'] 			= $objPost->param['imoveis_categoria_id'];
		$form['imoveis_situacao_id'] 			= $objPost->param['imoveis_situacao_id'];
		$form['nome'] 			                = $objPost->param['nome'];
		$form['breve_descricao']			    = $objPost->param['breve_descricao'];
		$form['descricao']			            = $objPost->param['descricao'];
		$form['tags']			                = $objPost->param['tags'];
		$form['valor']			                = $objUteis->moedaFloat(str_replace("R$ ", "", $objPost->param['valor']));
		$form['condominio']			            = $objUteis->moedaFloat(str_replace("R$ ", "", $objPost->param['condominio']));
		$form['quartos']			            = $objPost->param['quartos'];
		$form['suites']			                = $objPost->param['suites'];
		$form['vagas']			                = $objPost->param['vagas'];
		$form['area_construida']			    = $objPost->param['area_construida'];
		$form['area_terreno']			        = $objPost->param['area_terreno'];
		$form['cep']			                = $objPost->param['cep'];
		$form['estado']			                = $estado->uf;
		$form['cidade_id']			            = $objPost->param['cidade'];
		$form['bairro_id']			            = $objPost->param['bairro'];
		$form['endereco']			            = $objPost->param['endereco'];
		$form['complemento']			        = $objPost->param['complemento'];
		$form['link_mapa']			            = $objPost->param['link_mapa'];
		$form['latitude']			            = $objPost->param['latitude'];
		$form['longitude']			            = $objPost->param['longitude'];
		$form['longitude']			            = $objPost->param['longitude'];
		$form['status']			                = 1;		

		//se tiver selecionado uma imagem
		if($objPost->param["img"]["name"] !=""){
			
		    // verifica se e imagem
			$formatoImg = $objUteis->formatoFile($objPost->param["img"]["name"]);
			if(!$objUteis->verificaImagem($formatoImg)) {
			    $objUteis->showResult("","Formato de arquivo inválido. apenas imagens .jpg, png, gif ou .jpeg",false,"mostraMensagem",'index.php?acao=listaImovel&ctrl=imovel');
				exit();
			}
			
			$dir = "arq_imovel/";
			if (! file_exists ( "arq_imovel" )) {
			    $objUteis->criaDir ( "arq_imovel" );
			}
			//Definir nome para imagem
			$nomeImg = "imovel_".date("dmYhis").".".$formatoImg;
			$temp = $dir.$nomeImg;
			//Fazendo o upload da imagem
			$objUteis->uploadArq($objPost->param["img"]["tmp_name"],$temp);

			//gera o nome
			$img = $nomeImg;
		}

		$form['foto_principal'] = $img;
		//inseri o registro no banco
			
		$objUteis->decode($form);
		$result = $objImovel->cadastrar($form);
		
		
		if ($result -> result) {
			for ($i = 0; $i < $objPost->param['uploadergaleria_count']; $i++) {
				$formatoImg = ".".$objUteis->formatoFile($objPost->param["uploadergaleria_" . $i . "_name"]);
		
				$form2['img'] = '/' . md5($objPost->param["uploadergaleria_" . $i . "_name"]).$formatoImg;
				$form2['imoveis_id'] = $result -> id;
		
				$objUteis -> decode($form2);
				$resulfoto = $objImovel -> cadastrarFoto($form2);
			}
		
			for ($i = 0; $i < count($objPost->param['tipos_id']); $i++) {
				
				$form3['imoveis_id'] = $result -> id;
				$form3['tipos_id'] = $objPost->param['tipos_id'][$i];
		
				$objUteis -> decode($form3);
				$resulcategoria = $objImovel -> relacionarTipo($form3);
			}
		
		}
		

		if($result->result){
			//grava log de a��o no sistema
			$objUteis->gravaLog($objSession2->get('tlAdmLoginNome'),utf8_decode("Imóvel"),$objSession2->get('tlAdmLoginId'),"Cadastrou",$_SERVER['REMOTE_ADDR']);
		}

		//mostra o resultado para o usu�rio
		$objUteis->showResult("Cadastrado com sucesso.","Erro ao cadastrar.",$result->result,"mostraMensagem",'index.php?acao=listar&ctrl=imovel');
		exit();
		break;
		

	case "cadastraFoto" :
	    
    	    if (!$objPost->param['id']) {
    	        $proximo_id = $objImovel->proximo_id();
    	    }else{
    	        $proximo_id = $objPost->param['id'];
    	    }
    	    
    	    $formatoImg = ".".$objUteis->formatoFile($objPost->param["file"]["name"]);
    	    // Definir nome para imagem
    	    $dir = "arq_imovel/".($proximo_id)."/";
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
    	        	
    	        $form['img'] = $img;
    	        $form['imoveis_id'] = $proximo_id;
    	        // inseri o registro no banco
    	        $objUteis->decode ( $form );
    	        $result = $objImovel->cadastrarFoto ( $form );
    	    }
    	    
    	    exit();
		break;
	case "listar":
		$condicao = array();
		$imovels = $objImovel->listar_imoveis();
		$objUteis->encode($imovels);
		$abrePag = "../frms/listaImovel.php";
		break;
	case "frmAlterar":
		$condicao = array();
		$condicao = array(
		        'id' => $objPost->param["id"]
		);
		$imovel = $objImovel->lista($condicao);
		$estados = $objCorreio->listar_estados();
		$objUteis->encode($estados);
		$cidades = $objCorreio->listar_cidades(array("uf" => $imovel->estado));
		$objUteis->encode($cidades);
		$bairros = $objCorreio->listar_bairros(array("cidade" => $imovel->cidade_id));
		$objUteis->encode($bairros);
		$categorias = $objImovel->listar_categorias(array(0 => " AND status = 1 "));
		$objUteis->encode($categorias);
		$situacaoes = $objSituacao->listar(array(0 => " AND status = 1 "));
		$objUteis->encode($situacaoes);
		$tipos = $objTipo->listar(array(0 => " AND status = 1 "));
		$objUteis->encode($tipos);
		$objUteis->encode($imovel);
		$abrePag = "../frms/frmAltImovel.php";
		break;
	case "alterar":
		//monta o objeto com os dados do formul�rio
		
		$estado = $objCorreio->lista_estado(array(0 => " AND id = '".$_POST['estado']."' "));
		$objUteis->encode($estado);
		//monta o objeto com os dados do formul�rio
		$form->id			= $_POST['id'];
		$form->destaque 			= $_POST['destaque'];
		$form->imoveis_categoria_id 			= $_POST['imoveis_categoria_id'];
		$form->imoveis_situacao_id 			= $_POST['imoveis_situacao_id'];
		$form->nome 			= $_POST['nome'];
		$form->breve_descricao			= $_POST['breve_descricao'];
		$form->descricao			= $_POST['descricao'];
		$form->tags			= $_POST['tags'];
		$form->valor			= $objUteis->moedaFloat(str_replace("R$ ", "", $_POST['valor']));
		$form->condominio			= $objUteis->moedaFloat(str_replace("R$ ", "", $_POST['condominio']));
		$form->quartos			= $_POST['quartos'];
		$form->suites			= $_POST['suites'];
		$form->vagas			= $_POST['vagas'];
		$form->area_construida			= $_POST['area_construida'];
		$form->area_terreno			= $_POST['area_terreno'];
		$form->cep			= $_POST['cep'];
		$form->estado			= $estado->uf;
		$form->cidade_id			= $_POST['cidade'];
		$form->bairro_id			= $_POST['bairro'];
		$form->endereco			= $_POST['endereco'];
		$form->complemento			= $_POST['complemento'];
		$form->link_mapa			= $_POST['link_mapa'];
		$form->latitude			= $_POST['latitude'];
		$form->longitude			= $_POST['longitude'];
		$form->longitude			= $_POST['longitude'];
		$form->status			= 1;	

		//se tiver selecionado uma imagem
		if($_FILES["img"]["name"]!=""){

			$formatoImg = ".".$objUteis->formatoFile($_FILES["img"]["name"]);


			if($formatoImg == ".jpg" || $formatoImg == ".JPG" || $formatoImg == ".jpeg" || $formatoImg == ".JPEG" || $formatoImg == ".png" || $formatoImg == ".PNG" || $formatoImg == ".gif" || $formatoImg == ".GIF") {
				
			}else{
				$objUteis->showResult("","Formato de arquivo inválido. apenas imagens .jpg, png, gif ou .jpeg",false,"mostraMensagem",'index.php?acao=listar&ctrl=imovels');
				exit();
			}

			//Retorna formato da imagem
			$dir = "../../../importacao/";
			$formatoImg = ".".$objUteis->formatoFile($_FILES["img"]["name"]);
			$img = "/".date("dmYhis").$formatoImg;
			//deleta a imagem antiga
			$objUteis->delFile($_POST['imgAntiga']);
			//Fazendo o upload da imagem
			$objUteis->uploadArq($_FILES["img"]["tmp_name"],$dir.$img);
			$form->foto_principal			= $img;
		}else{
			$form->foto_principal			= $_POST['imgAntiga'];
		}

		//altera o registro no banco
		$objUteis->decode($form);
		$result = $objImovel->alterar($form);
		
		
		if ($result -> result) {
			
			if(count($_POST['tipos_id']) > 0){
				$deletarRelacao = $objImovel->deletarTiposRelacionados($_REQUEST["id"]);
			}
			
			for ($i = 0; $i < count($_POST['tipos_id']); $i++) {
			
				$form3 -> imoveis_id = $_REQUEST["id"];
				$form3 -> tipos_id = $_POST['tipos_id'][$i];
			
				$objUteis -> decode($form3);
				$resulcategoria = $objImovel -> relacionarTipo($form3);
			}
		
		}

		if($result->result){
			//grava log de a��o no sistema
			$objUteis->gravaLog($_SESSION['i9s']['tlAdmLoginNome'],utf8_decode("Imovel"),$_SESSION['i9s']['tlAdmLoginId'],"Alterou",$_SERVER['REMOTE_ADDR']);
		}
			
		//mostra o resultado para o usu�rio
		$objUteis->showResult("Imovel alterado com sucesso","Erro ao alterar este imovel.",$result->result,"mostraMensagem",'index.php?acao=listar&ctrl=imovel');
		exit();

		break;
	case "deletar":
		
		$imovel = $objImovel->lista_imovel(array(0 => " AND id = ".$_REQUEST ['id']." "));
		$objUteis->encode($imovel);
		
// 		$fotos = $objImovel->listar_fotos(array(0 => " AND imoveis_id = ".$_REQUEST ['id']." "));
// 		$objUteis->encode($fotos);
		
		
		
// 		for($i=0;$i<$fotos["num"];$i++){
				
// 			$objUteis->delFile($fotos[$i]->img);
// 		}
		
		// deleta o registro no banco
		//$result2 = $objImovel->deletarFotosRelacionadas ( $_REQUEST ['id'] );
		$result3 = $objImovel->deletarTiposRelacionados ( $_REQUEST ['id'] );
		$result = $objImovel->deletar ( $_REQUEST ['id'] );
		
		if ($result) {	
			
// 			$objUteis->delFile($imovel->foto_principal);
			
			// grava log de aï¿½ï¿½o no sistema
			$objUteis->gravaLog ( $_SESSION ['i9s'] ['tlAdmLoginNome'], utf8_decode ( "Imóvel" ), $_SESSION ['i9s'] ['tlAdmLoginId'], "Deletou", $_SERVER ['REMOTE_ADDR'] );
		}
		if (! $result) {
			$resposta->situacao = "error";
			$resposta->msg = "Erro ao deletar este imovel.";
		} else {
			$resposta->situacao = "sucess";
			$resposta->msg = "Imovel deletado com sucesso.";
		}
		
		echo json_encode ( $resposta );
		
		exit ();
		
		
		break;
		

	case "deletarFoto":
			//deleta a foto
			$result = $objImovel->deletarFoto($_REQUEST['id']);
			if($result){
				//deleta o arquivo
				//$objUteis->delFile($_REQUEST['img']);
			}
			//grava log de aÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o no sistema
			$objUteis->gravaLog($_SESSION['i9s']['tlAdmLoginNome'],"foto do imóvel",$_REQUEST['id'],"deletou foto",$_SERVER['REMOTE_ADDR']);
		
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
		//deleta o registro no banco
		$result = $objImovel->publicar_imovel($_REQUEST['id'],$_REQUEST['status']);

		if($result){
			//verifica o status
			if($_REQUEST['status']=="1"){
				$act = "ativou";
				$staturs = "publicado";
			}else{
				$act = "desativou";
				$staturs = "despublicado";
			}
			//grava log de a��o no sistema
		}

		//verifica o resultado
		if($result){
			//grava log de a��o no sistema
			$objUteis->gravaLog($_SESSION['i9s']['tlAdmLoginNome'],utf8_decode("Imóvel"),$_SESSION['i9s']['tlAdmLoginId'],"Publicou",$_SERVER['REMOTE_ADDR']);
		}

		if (!$result) {
			$resposta->situacao = "error";
			$resposta->msg = "Erro ao $staturs este imóvel.";

		} else {
			$resposta->situacao = "sucess";
			$resposta->msg = "Imóvel $staturs com sucesso.";
		}

		echo json_encode($resposta);
		exit();
		break;

	case "alterarOrdem":
		$id = $_REQUEST["id"];
		$fromPosition = $_REQUEST["fromPosition"];
		$toPosition = $_REQUEST["toPosition"];
		$direction = $_REQUEST["direction"];


		$listagens = $objImovel->listar();
		$objUteis->encode($listagens);

		for($i=0;$i<$listagens["num"];$i++){
			$resultaff = $objImovel->alteraOrdem($listagens[$i]->id,$i);
		}

		if($direction == "forward"){

			$listagens = $objImovel->pegarListagensParaAlterarForward($fromPosition,$toPosition);
			$objUteis->encode($listagens);

			for($i=0;$i<$listagens["num"];$i++){

				$listagens[$i]->ordem --;
				if($listagens[$i]->id == $id){
					$listagens[$i]->ordem =  $toPosition;
				}

				$result = $objImovel->alteraOrdem($listagens[$i]->id,$listagens[$i]->ordem);

			}

		}

		if($direction == "back"){

			$listagens = $objImovel->pegarListagensParaAlterarBack($fromPosition,$toPosition);
			$objUteis->encode($listagens);

			for($i=0;$i<$listagens["num"];$i++){


				$listagens[$i]->ordem ++;
				if($listagens[$i]->id == $id){
					$listagens[$i]->ordem =  $toPosition;
				}

				$result = $objImovel->alteraOrdem($listagens[$i]->id,$listagens[$i]->ordem);

			}

		}

		if($result){
			echo "Ordem alterada com sucesso";
		}else{
			echo "Erro ao alterar esta ordem";
		}

		exit();


		break;
		
		
		## XML IMOVEIS GOIAS
		
		case "importa":
			$abrePag = "../frms/importarImoveis.php";
		break;
		
		case "cadastrarXml":
			
		
			//se tiver selecionado uma imagem
			if($_FILES["xml"]["name"] !=""){
					
				$formatoImg = ".".$objUteis->formatoFile($_FILES["xml"]["name"]);
		
		
				if($formatoImg == ".XML" || $formatoImg == ".xml") {
		
		
				}else{
					$objUteis->showResult("","Formato de arquivo inválido. apenas xml",false,"mostraMensagem",'index.php?acao=importa&ctrl=imovel');
					exit();
		
				}
					
				//Retorna formato da imagem
				$formatoImg = $objUteis->formatoFile($_FILES["xml"]["name"]);
				//Definir nome para imagem
				$dir = "arq_imovel/";
				if(!file_exists("arq_imovel")) {
					$objUteis->criaDir("arq_imovel");
				}
				$nomeImg = "xml_".date("dmYhis").".".$formatoImg;
				$temp = $dir.$nomeImg;
				//Fazendo o upload da imagem
				$objUteis->uploadArq($_FILES["xml"]["tmp_name"],$temp);
		
				//gera thumb
				$img = $dir.$nomeImg;
			}
			
			echo "<script>parent.enviaImovelXml('".$img."');</script>";
			
			exit();
		break;
		case "cadastrarXmlJson":

				$xml = simplexml_load_file($_REQUEST["xml"], NULL, LIBXML_NOCDATA); /* Lê o arquivo XML e recebe um objeto com as informações */
				 
				$imovelXml= $xml->imovel;
				 
				$erro = array();
				$qtdeCadastrado = 0;
				$aQtdeCadastrado = array();
				$aTodosImoveis = array();
				$qtdeErros = 0;
				$qtdeImoveisJaCadastrados = 0;
				
				$imoveisTodos = $objImovel->listar_imoveis(array(0 => " AND imoveis_categoria_id = 1 "));
				$objUteis->encode($imoveisTodos);
				
				for($i=0;$i<$imoveisTodos["num"];$i++){
					$aTodosImoveis[] = $imoveisTodos[$i]->id_importacao;
				}
				
				for($i=0;$i<count($imovelXml);$i++){
					
					$imovel = $objImovel->lista_imovel(array(0 => " AND id_importacao = '".$imovelXml[$i]->id."' "));
					$objUteis->encode($imovel);

					if(!$imovel->id){
						$cidade = $objImovel->lista_cidade(array(0 => " AND nome = '".utf8_decode($imovelXml[$i]->cidade)."' "));
						$objUteis->encode($cidade);
				
						$bairro = $objImovel->lista_bairro(array(0 => " AND cidade = '".utf8_decode($cidade->id)."' ", 1 => " AND nome like '%".utf8_decode($imovelXml[$i]->bairro)."%' "));
						$objUteis->encode($bairro);
						 
						if(!$bairro->id){
							$erro[] = "<p>Bairro com referência errada ou não existe o campo bairro para este imóvel <strong>".$imovelXml[$i]->id."</strong> </p> ";
							$qtdeErros ++;
							//continue;
							$form[$i]->bairro_id = 0;
						}else{
							$form[$i]->bairro_id = utf8_decode($bairro->id);
						}
						
						if(!$cidade->id){
							$erro[] = "<p>Cidade com referência errada ou não existe o campo cidade para este imóvel <strong>".$imovelXml[$i]->id."</strong> </p> ";
							$qtdeErros ++;
							//continue;
							$form[$i]->cidade_id = 0;
						}else{
							$form[$i]->cidade_id = utf8_decode($cidade->id);
						}
						 
						$form[$i]->nome = utf8_decode($imovelXml[$i]->nome);
						$form[$i]->id_importacao = utf8_decode($imovelXml[$i]->id);
						$form[$i]->breve_descricao = utf8_decode($objUteis->limitaCarac($imovelXml[$i]->descricao,250));
						$form[$i]->descricao = utf8_decode($imovelXml[$i]->descricao);
						$form[$i]->valor = utf8_decode($imovelXml[$i]->valor);
						$form[$i]->condominio = utf8_decode($imovelXml[$i]->valor_condominio);
						$form[$i]->tags = utf8_decode($imovelXml[$i]->tags);
						$form[$i]->quartos = utf8_decode($imovelXml[$i]->qtde_quartos_max);
						$form[$i]->suites = utf8_decode($imovelXml[$i]->qtde_suites_max);
						$form[$i]->vagas = utf8_decode($imovelXml[$i]->qtde_garagens_max);
						$form[$i]->latitude = utf8_decode($imovelXml[$i]->latitude);
						$form[$i]->longitude = utf8_decode($imovelXml[$i]->longitude);
						$form[$i]->estado = utf8_decode($imovelXml[$i]->uf);
						$form[$i]->endereco = utf8_decode($imovelXml[$i]->endereco);
						$form[$i]->status = utf8_decode($imovelXml[$i]->status);
						$form[$i]->imoveis_categoria_id = 1;
						$form[$i]->imoveis_situacao_id = 3;
						 
						if(!empty($imovelXml[$i]->foto_principal)){
							$form[$i]->foto_principal = $imovelXml[$i]->foto_principal;
						}else{
							$form[$i]->foto_principal = "img/sem_foto.gif";
						}
						 
						## Cadastrar Area do terreno e area construida
						$medidas = $imovelXml[$i]->imovel_medidas->imovel_medida;
						for($j=0;$j<count($medidas);$j++){
							## área do terreno
							if($medidas[$j]->medida_nome_id == "1"){
								$form[$i]->area_terreno = $medidas[$j]->valor_max;
								 
								## área construída
							}else if($medidas[$j]->medida_nome_id == "2"){
								$form[$i]->area_construida = $medidas[$j]->valor_max;
							}
							 
							 
						}
						 
						$result = $objImovel->cadastrar($form[$i]);
				
						$fotos = $imovelXml[$i]->fotos->foto;
						$tipos = $imovelXml[$i]->categorias->categoria_id;
				
						 
						if($result->result){
							$qtdeCadastrado ++;
							## Cadastrar Fotos dos imóveis
							for($j=0;$j<count($fotos);$j++){
								if(!empty($fotos[$j]->imagem)){
									
									$form2[$j]->img = $fotos[$j]->imagem;
									//$form2[$j]->img_importada = "http://www.leonardolobo.com.br/importacao/".$fotos[$j]->imagem;
									$form2[$j]->imoveis_id = $result->id;
				
									$objImovel->cadastrarFoto($form2[$j]);
								}
							}
				
				
							## Cadastrar Tipos de imóveis
							for($j=0;$j<count($tipos);$j++){
								$form3[$j]->tipos_id = $tipos[$j];
								$form3[$j]->imoveis_id = $result->id;
						   
								$objImovel->relacionarTipo($form3[$j]);
							}
					   
						}
				
					}else{
						$qtdeImoveisJaCadastrados ++;
						
						$aQtdeCadastrado[] = $imovelXml[$i]->id;
						
						$deletar = $objImovel->deletar($imovel->id);
						
						$cidade = $objImovel->lista_cidade(array(0 => " AND nome = '".utf8_decode($imovelXml[$i]->cidade)."' "));
						$objUteis->encode($cidade);
						
						$bairro = $objImovel->lista_bairro(array(0 => " AND cidade = '".utf8_decode($cidade->id)."' ", 1 => " AND nome like '%".utf8_decode($imovelXml[$i]->bairro)."%' "));
						$objUteis->encode($bairro);
							
						if(!$bairro->id){
							//$erro[] = "<p>Bairro com referência errada ou não existe o campo bairro para este imóvel <strong>".$imovelXml[$i]->id."</strong> </p> ";
							//$qtdeErros ++;
							//continue;
							$form[$i]->bairro_id = 0;
						}else{
							$form[$i]->bairro_id = utf8_decode($bairro->id);
						}
						
						if(!$cidade->id){
							//$erro[] = "<p>Cidade com referência errada ou não existe o campo cidade para este imóvel <strong>".$imovelXml[$i]->id."</strong> </p> ";
							//$qtdeErros ++;
							//continue;
							$form[$i]->cidade_id = 0;
						}else{
							$form[$i]->cidade_id = utf8_decode($cidade->id);
						}
							
						$form[$i]->nome = utf8_decode($imovelXml[$i]->nome);
						$form[$i]->id_importacao = utf8_decode($imovelXml[$i]->id);
						$form[$i]->breve_descricao = utf8_decode($objUteis->limitaCarac($imovelXml[$i]->descricao,250));
						$form[$i]->descricao = utf8_decode($imovelXml[$i]->descricao);
						$form[$i]->valor = utf8_decode($imovelXml[$i]->valor);
						$form[$i]->condominio = utf8_decode($imovelXml[$i]->valor_condominio);
						$form[$i]->tags = utf8_decode($imovelXml[$i]->tags);
						$form[$i]->quartos = utf8_decode($imovelXml[$i]->qtde_quartos_max);
						$form[$i]->suites = utf8_decode($imovelXml[$i]->qtde_suites_max);
						$form[$i]->vagas = utf8_decode($imovelXml[$i]->qtde_garagens_max);
						$form[$i]->latitude = utf8_decode($imovelXml[$i]->latitude);
						$form[$i]->longitude = utf8_decode($imovelXml[$i]->longitude);
						$form[$i]->estado = utf8_decode($imovelXml[$i]->uf);
						$form[$i]->endereco = utf8_decode($imovelXml[$i]->endereco);
						$form[$i]->status = utf8_decode($imovelXml[$i]->status);
						$form[$i]->imoveis_categoria_id = 1;
						$form[$i]->imoveis_situacao_id = 3;
						$form[$i]->destaque = $imovel->destaque;
							
						if(!empty($imovelXml[$i]->foto_principal)){
							$form[$i]->foto_principal = $imovelXml[$i]->foto_principal;
						}else{
							$form[$i]->foto_principal = "img/sem_foto.gif";
						}
							
						## Cadastrar Area do terreno e area construida
						$medidas = $imovelXml[$i]->imovel_medidas->imovel_medida;
						for($j=0;$j<count($medidas);$j++){
						## área do terreno
						if($medidas[$j]->medida_nome_id == "1"){
							$form[$i]->area_terreno = $medidas[$j]->valor_max;
									
								## área construída
							}else if($medidas[$j]->medida_nome_id == "2"){
								$form[$i]->area_construida = $medidas[$j]->valor_max;
						}
						
						
						}
								
							$result = $objImovel->cadastrar($form[$i]);
				
							$fotos = $imovelXml[$i]->fotos->foto;
							$tipos = $imovelXml[$i]->categorias->categoria_id;
				
								
							if($result->result){
							## Cadastrar Fotos dos imóveis
							for($j=0;$j<count($fotos);$j++){
							if(!empty($fotos[$j]->imagem)){
								
							$form2[$j]->img = $fotos[$j]->imagem;
								$form2[$j]->imoveis_id = $result->id;
				
								$objImovel->cadastrarFoto($form2[$j]);
							}
							}
				
				
							## Cadastrar Tipos de imóveis
							for($j=0;$j<count($tipos);$j++){
							$form3[$j]->tipos_id = $tipos[$j];
							$form3[$j]->imoveis_id = $result->id;
								
							$objImovel->relacionarTipo($form3[$j]);
							}
				
							}
						
					}
				}
				
				$aImoveisADeletar = array();
				$qtdeImovelOrfao = 0;
				for($j=0;$j<count($aTodosImoveis);$j++){
					if(!in_array($aTodosImoveis[$j], $aQtdeCadastrado)){
						$aImoveisADeletar[] = $aTodosImoveis[$j];
						$qtdeImovelOrfao++;
					}
				}
				
				$erro[] = "<h6>Quantidade de imóveis cadastrados <strong>".$qtdeCadastrado." imóveis</strong></h6> ";
				$erro[] = "<h6>Quantidade de imóveis com erro <strong style='color:red;'>".$qtdeErros." imóveis</strong></h6> ";
				$erro[] = "<h6>Quantidade de imóveis já cadastrados <strong style='color:red;'>".$qtdeImoveisJaCadastrados." imóveis</strong></h6> ";
				$erro[] = "<h6>Quantidade de imóveis orfãos <strong style='color:red;'>".$qtdeImovelOrfao." imóveis</strong></h6> ";
				
				$objUteis->delFile($_REQUEST["xml"]);
				
				$resposta->situacao = "sucess";
				$resposta->imoveldeletar = $aImoveisADeletar;
				$resposta->imoveldeletarQtde = count($aImoveisADeletar);
				$resposta->msg = "Importado com sucesso!";
				$resposta->tipo_erro = $erro;
				$resposta->qtdeErro = count($erro);
		
				echo json_encode($resposta);
			
			exit();
		break;
		case "deletarImoveisOrfao":
			
				$aImoveisDeletar = explode(',',$_REQUEST['arrayImovel']);
				$countImoveisDeletar = count($aImoveisDeletar);
				$deletarFotos = $_REQUEST['deletarFoto'];
				
				for($i=0;$i<$countImoveisDeletar;$i++){
					$result = $objImovel->deletarImportacao($aImoveisDeletar[$i]);
					if($deletarFotos){
						if(file_exists('../../../importacao/00000'.$aImoveisDeletar[$i])  ){
							$objUteis->delDir('../../../importacao/00000'.$aImoveisDeletar[$i]);
						}else if(file_exists('../../../importacao/0000'.$aImoveisDeletar[$i])  ){
							$objUteis->delDir('../../../importacao/0000'.$aImoveisDeletar[$i]);
						}else if(file_exists('../../../importacao/000'.$aImoveisDeletar[$i])  ){
							$objUteis->delDir('../../../importacao/000'.$aImoveisDeletar[$i]);
						}else if(file_exists('../../../importacao/00'.$aImoveisDeletar[$i])  ){
							$objUteis->delDir('../../../importacao/00'.$aImoveisDeletar[$i]);
						}else if(file_exists('../../../importacao/0'.$aImoveisDeletar[$i])  ){
							$objUteis->delDir('../../../importacao/0'.$aImoveisDeletar[$i]);
						}else if(file_exists('../../../importacao/'.$aImoveisDeletar[$i])  ){
							$objUteis->delDir('../../../importacao/'.$aImoveisDeletar[$i]);
						}
					}
				}

				$objUteis->gravaLog($_SESSION['i9s']['tlAdmLoginNome'],utf8_decode("Imóveis Orfão"),$_SESSION['i9s']['tlAdmLoginId'],"Deletou",$_SERVER['REMOTE_ADDR']);
				$resposta->situacao = "sucess";
				$resposta->msg = "Imóveis deletado com sucesso!";
		
				echo json_encode($resposta);
			
			exit();
		break;

}
