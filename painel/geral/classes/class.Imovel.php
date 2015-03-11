<?php
class Imovel {
	

	function cadastrar($form) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		
		$result = $sqlGl->insertInto('imoveis',$form);
		$lastInsert = $result->execute();

		//retorna o resultado da query para a câmada de controle
		return $lastInsert;
	}

	function cadastrarFoto($form) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		
		$result = $sqlGl->insertInto('imoveis_fotos',$form);
		$lastInsert = $result->execute();

		//retorna o resultado da query para a câmada de controle
		return $lastInsert;
	}

	function relacionarTipo($form) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		
		$result = $sqlGl->insertInto('imoveis_has_tipos',$form);
		$lastInsert = $result->execute();

		//retorna o resultado da query para a câmada de controle
		return $lastInsert;
	}

	function alterar($form) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$result = $sqlGl->update('imoveis')->set($form)->where('id', $form['id']);
		$result = $result->execute(true);

		//retorna o resultado da query para a câmada de controle
		return $result;
	}

	function alterarFoto($form) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$result = $sqlGl->update('imoveis_fotos')->set($form)->where('id', $form['id']);
		$result = $result->execute(true);

		//retorna o resultado da query para a câmada de controle
		return $result;
	}

	function deletar($id) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$result = $sqlGl->deleteFrom("imoveis")->where("id",$id);
		$result = $result->execute();

		//retorna o resultado da query para a câmada de controle
		return $result;
	}

	function deletarFotosRelacionadas($id) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$result = $sqlGl->deleteFrom("imoveis_fotos")->where("imoveis_id",$id);
		$result = $result->execute();

		//retorna o resultado da query para a câmada de controle
		return $result;
	}

	function deletarTiposRelacionados($id) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$result = $sqlGl->deleteFrom("imoveis_has_tipos")->where("imoveis_id",$id);
		$result = $result->execute();

		//retorna o resultado da query para a câmada de controle
		return $result;
	}

	function deletarFoto($id) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$result = $sqlGl->deleteFrom("imoveis_fotos")->where("id",$id);
		$result = $result->execute();

		//retorna o resultado da query para a câmada de controle
		return $result;
	}
	
	
	function listar($atributos=array(),$orderBy=null) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		
		$sai = "SELECT * FROM (SELECT
		imo.*,
		(SELECT GROUP_CONCAT(DISTINCT(it.nome) SEPARATOR '|')
		FROM imoveis_has_tipos iht, imoveis_tipos it
		WHERE iht.imoveis_id = imo.id AND it.id = iht.tipos_id) AS tipos_nome,
		(SELECT GROUP_CONCAT(DISTINCT(CAST(it2.id as CHAR)) SEPARATOR '|')
		FROM imoveis_has_tipos iht2, imoveis_tipos it2
		WHERE iht2.imoveis_id = imo.id AND it2.id = iht2.tipos_id) AS tipos_id,
		(SELECT bair.nome
		FROM bairros bair
		WHERE bair.id=imo.bairro_id) as bairro,
		(SELECT cid.nome
		FROM cidades cid
		WHERE cid.id=imo.cidade_id) as cidade,
		ic.nome as categoria,
		ims.nome as situacao_nome
		FROM
		imoveis imo
		LEFT JOIN imoveis_categorias ic on ic.id=imo.imoveis_categoria_id
		LEFT JOIN imoveis_situacao ims on ims.id=imo.imoveis_situacao_id
		LEFT JOIN estados est on est.uf=imo.estado
		) AS sl WHERE sl.id != '0'";
		
		$aValores = $sqlGl -> 
		            from("imoveis")
		            ->select('(SELECT GROUP_CONCAT(DISTINCT(it.nome) SEPARATOR \'|\') FROM imoveis_has_tipos iht, imoveis_tipos it WHERE iht.imoveis_id = imo.id AND it.id = iht.tipos_id) AS tipos_nome')
		            ->leftJoin('estados ON estados.uf = imoveis.estado')
		            ->leftJoin('imoveis_situacao ON imoveis_situacao.id = imoveis.imoveis_situacao_id')
		            ->leftJoin('imoveis_categorias ON imoveis_categorias.id = imoveis.imoveis_categoria_id')
		            ->where($atributos)
		            ->orderBy($orderBy);
		echo $aValores->getQuery() . "\n";
		$aValores = $aValores->fetchAll();
		
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function lista($atributos=array(),$orderBy=null) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;

		$aValores = $sqlGl -> from("imoveis")->where($atributos)->orderBy($orderBy);
		$aValores = $aValores->fetch();
		return $aValores;
	}

	function publicar($id, $status) {
		global $sqlGl;
		$result = $sqlGl->update('imoveis')->set('status',$status)->where('id', $id);
		$result = $result->execute(true);
		
		//retorna o resultado da query para a câmada de controle
		return $result;
	}

	## ORDEM DOS ARQUIVOS ##

	function pegarListagensParaAlterarBack($fromPosition, $toPosition) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$aValores = $sqlGl -> from("imoveis")->where('ordem <= :ordem1 && ordem >= :ordem2 ',array(':ordem1' => $fromPosition, ':ordem2' => $toPosition));
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function pegarListagensParaAlterarForward($fromPosition, $toPosition) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$aValores = $sqlGl -> from("imoveis")->where('ordem >= :ordem1 && ordem <= :ordem2 ',array(':ordem1' => $fromPosition, ':ordem2' => $toPosition));
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function alteraOrdem($id, $posicao) {
		global $sqlGl;
		$result = $sqlGl->update('imoveis')->set('ordem',$posicao)->where('id', $id);
		$result = $result->execute(true);
		
		//retorna o resultado da query para a câmada de controle
		return $result;
		
	}

}
?>


<?php
// class Imovel {

// 	function cadastrar($form) {
// 		//chamada ao objeto da classe de abstração de banco de dados
// 		global $sqlGl;

// 		$campos = $valores = "";

// 		foreach ($form as $campo => $valor) {
// 			$campos .= "" . $campo . ",";
// 			$valores .= "'" . mysql_real_escape_string($valor) . "',";

// 		}

// 		$campos = substr($campos, 0, strlen($campos) - 1);
// 		$valores = substr($valores, 0, strlen($valores) - 1);

// 		//inseri a curriculum no banco de dados
// 		$result = $sqlGl -> DBInsertData("imoveis($campos)", $valores);

// 		$rs -> result = $result;
// 		$rs -> id = $sqlGl -> returnId();

// 		//fecha a conexão
// 		$sqlGl -> DBClose();

// 		//retorna o resultado da query para a câmada de controle
// 		return $rs;
// 	}

// 	function cadastrarFoto($form) {
// 		//chamada ao objeto da classe de abstração de banco de dados
// 		global $sqlGl;

// 		$campos = $valores = "";

// 		foreach ($form as $campo => $valor) {
// 			$campos .= "" . $campo . ",";
// 			$valores .= "'" . mysql_real_escape_string($valor) . "',";

// 		}

// 		$campos = substr($campos, 0, strlen($campos) - 1);
// 		$valores = substr($valores, 0, strlen($valores) - 1);

// 		//inseri a curriculum no banco de dados
// 		$result = $sqlGl -> DBInsertData("imoveis_fotos($campos)", $valores);

// 		$rs -> result = $result;
// 		$rs -> id = $sqlGl -> returnId();

// 		//fecha a conexão
// 		$sqlGl -> DBClose();

// 		//retorna o resultado da query para a câmada de controle
// 		return $rs;
// 	}

// 	function relacionarTipo($form) {
// 		//chamada ao objeto da classe de abstração de banco de dados
// 		global $sqlGl;

// 		$campos = $valores = "";

// 		foreach ($form as $campo => $valor) {
// 			$campos .= "" . $campo . ",";
// 			$valores .= "'" . mysql_real_escape_string($valor) . "',";

// 		}

// 		$campos = substr($campos, 0, strlen($campos) - 1);
// 		$valores = substr($valores, 0, strlen($valores) - 1);

// 		//inseri a curriculum no banco de dados
// 		$result = $sqlGl -> DBInsertData("imoveis_has_tipos($campos)", $valores);

// 		$rs -> result = $result;
// 		$rs -> id = $sqlGl -> returnId();

// 		//fecha a conexão
// 		$sqlGl -> DBClose();

// 		//retorna o resultado da query para a câmada de controle
// 		return $rs;
// 	}

// 	function alterar($form) {
// 		//chamada ao objeto da classe de abstração de banco de dados
// 		global $sqlGl;

// 		$params = "";

// 		foreach ($form as $campo => $valor) {
// 			$params .= "$campo='" . mysql_real_escape_string($valor) . "', ";
// 		}

// 		$params = substr($params, 0, strlen($params) - 2);

// 		//altera o curriculum no banco de dados
// 		$result = $sqlGl -> DBUpdate("imoveis", $params, "id=" . $form -> id);

// 		$rs -> result = $result;
// 		//fecha a conexão
// 		$sqlGl -> DBClose();

// 		//retorna o resultado da query para a câmada de controle
// 		return $rs;
// 	}

// 	function alterarFoto($form) {
// 		//chamada ao objeto da classe de abstração de banco de dados
// 		global $sqlGl;

// 		$params = "";

// 		foreach ($form as $campo => $valor) {
// 			$params .= "$campo='" . mysql_real_escape_string($valor) . "', ";
// 		}

// 		$params = substr($params, 0, strlen($params) - 2);

// 		//altera o curriculum no banco de dados
// 		$result = $sqlGl -> DBUpdate("imoveis_fotos", $params, "id=" . $form -> id);

// 		$rs -> result = $result;
// 		//fecha a conexão
// 		$sqlGl -> DBClose();

// 		//retorna o resultado da query para a câmada de controle
// 		return $rs;
// 	}

// 	function deletar($id) {
// 		//chamada ao objeto da classe de abstração de banco de dados
// 		global $sqlGl;

// 		//apaga o registro do banco de dados
// 		$result = $sqlGl -> DBDeleteData("imoveis", "WHERE id='" . $id . "'");

// 		//fecha a conexão
// 		$sqlGl -> DBClose();

// 		//retorna o resultado da query para a câmada de controle
// 		return $result;
// 	}
	

// 	function deletarImportacao($id) {
// 		//chamada ao objeto da classe de abstração de banco de dados
// 		global $sqlGl;
	
// 		//apaga o registro do banco de dados
// 		$result = $sqlGl -> DBDeleteData("imoveis", "WHERE id_importacao='" . $id . "' and imoveis_categoria_id = 1 ");
	
// 		//fecha a conexão
// 		$sqlGl -> DBClose();
	
// 		//retorna o resultado da query para a câmada de controle
// 		return $result;
// 	}
	
// 	function deletarFotosRelacionadas($idImovel) {
// 		//chamada ao objeto da classe de abstração de banco de dados
// 		global $sqlGl;
	
// 		//apaga o registro do banco de dados
// 		$result = $sqlGl -> DBDeleteData("imoveis_fotos", "WHERE imoveis_id='" . $idImovel . "'");
	
// 		//fecha a conexão
// 		$sqlGl -> DBClose();
	
// 		//retorna o resultado da query para a câmada de controle
// 		return $result;
// 	}
	
// 	function deletarTiposRelacionados($idImovel) {
// 		//chamada ao objeto da classe de abstração de banco de dados
// 		global $sqlGl;
	
// 		//apaga o registro do banco de dados
// 		$result = $sqlGl -> DBDeleteData("imoveis_has_tipos", "WHERE imoveis_id='" . $idImovel . "'");
	
// 		//fecha a conexão
// 		$sqlGl -> DBClose();
	
// 		//retorna o resultado da query para a câmada de controle
// 		return $result;
// 	}
	
// 	function deletarFoto($id){
// 		//chamada ao objeto da classe de abstraÃƒÂ§ÃƒÂ£o de banco de dados
// 		global $sqlGl;
	
// 		//apaga o registro do banco de dados
// 		$result = $sqlGl->DBDeleteData("imoveis_fotos","WHERE id='".$id."'");
	
// 		//fecha a conexÃƒÂ£o
// 		$sqlGl->DBClose();
	
// 		//retorna o resultado da query para a cÃƒÂ¢mada de controle
// 		return $result;
// 	}

// 	function listar_imoveis($atributos=array()) {
// 		//chamada ao objeto da classe de abstração de banco de dados
// 		global $sqlGl;	

// 		$condicao = "";
		
// 		for($i=0;$i<count($atributos);$i++){
// 			$condicao .= $atributos[$i];
// 		}

// 		//$result = $sqlGl->DBSelect("empreendimentos e","e.*"," WHERE 1 $condicao");
// 		//$result = $sqlGl -> DBSelectGen("SELECT * FROM imoveis WHERE 1 $condicao ORDER BY $orderBy $limite");
// 		$result = $sqlGl -> DBSelectGen("
// 			SELECT * FROM (SELECT
// 				imo.*,
// 				(SELECT GROUP_CONCAT(DISTINCT(it.nome) SEPARATOR '|')
// 			             FROM imoveis_has_tipos iht, imoveis_tipos it 
// 			            WHERE iht.imoveis_id = imo.id AND it.id = iht.tipos_id) AS tipos_nome,
// 				(SELECT GROUP_CONCAT(DISTINCT(CAST(it2.id as CHAR)) SEPARATOR '|')
// 			             FROM imoveis_has_tipos iht2, imoveis_tipos it2 
// 			            WHERE iht2.imoveis_id = imo.id AND it2.id = iht2.tipos_id) AS tipos_id,
// 				(SELECT bair.nome  
// 					FROM bairros bair 
// 					WHERE bair.id=imo.bairro_id) as bairro, 
// 				(SELECT cid.nome  
// 					FROM cidades cid 
// 					WHERE cid.id=imo.cidade_id) as cidade, 
// 				ic.nome as categoria,
// 				ims.nome as situacao_nome
// 			FROM
// 				imoveis imo
// 				LEFT JOIN imoveis_categorias ic on ic.id=imo.imoveis_categoria_id
// 				LEFT JOIN imoveis_situacao ims on ims.id=imo.imoveis_situacao_id
// 				LEFT JOIN estados est on est.uf=imo.estado
// 			) AS sl WHERE sl.id != '0'
// 			".$condicao."
// 		");
		
		
// 		//monta o objeto com os valores do banco de dados
// 		$i = 0;
// 		while ($dados = $sqlGl -> DBFetchArray()) {
// 			foreach ($dados as $campo => $valor) {
// 				if($valor != null){
// 					$curriculums[$i] -> {$campo} = $valor;
// 				}
// 			}
// 			$i++;
// 		}
// 		$curriculums["num"] = $i;

// 		//fecha a conexão
// 		$sqlGl -> DBClose();

// 		return $curriculums;
// 	}

// 	function lista_imovel($atributos=array()) {
// 		//chamada ao objeto da classe de abstração de banco de dados
// 		global $sqlGl;
		
// 		$condicao = "";
		
// 		for($i=0;$i<count($atributos);$i++){
// 			$condicao .= $atributos[$i];
// 		}

// 		$result = $sqlGl -> DBSelectGen("
// 			SELECT * FROM (SELECT
// 				imo.*,
// 				(SELECT GROUP_CONCAT(DISTINCT(it.nome) SEPARATOR '|')
// 			             FROM imoveis_has_tipos iht, imoveis_tipos it 
// 			            WHERE iht.imoveis_id = imo.id AND it.id = iht.tipos_id) AS tipos_nome,
// 				(SELECT GROUP_CONCAT(DISTINCT(CAST(it2.id as CHAR)) SEPARATOR '|')
// 			             FROM imoveis_has_tipos iht2, imoveis_tipos it2 
// 			            WHERE iht2.imoveis_id = imo.id AND it2.id = iht2.tipos_id) AS tipos_id,
// 				(SELECT bair.nome  
// 					FROM bairros bair 
// 					WHERE bair.id=imo.bairro_id) as bairro, 
// 				(SELECT cid.nome  
// 					FROM cidades cid 
// 					WHERE cid.id=imo.cidade_id) as cidade, 
// 				ic.nome as categoria,
// 				ims.nome as situacao_nome
// 			FROM
// 				imoveis imo
// 				LEFT JOIN imoveis_categorias ic on ic.id=imo.imoveis_categoria_id
// 				LEFT JOIN imoveis_situacao ims on ims.id=imo.imoveis_situacao_id
// 				LEFT JOIN estados est on est.uf=imo.estado
// 			) AS sl WHERE sl.id != '0'
// 			".$condicao."
// 		");

// 		//monta o objeto notícia com os valores do banco de dados
// 		$dados = $sqlGl -> DBFetchArray();
// 		if ($dados) {
// 			foreach ($dados as $campo => $valor) {
// 				$curriculum -> {$campo} = $valor;

// 			}
// 		}
		
// 		$curriculum->fotos = $this->listar_fotos(array(0 => " AND imoveis_id = ".$curriculum->id." "));

// 		//fecha a conexão
// 		$sqlGl -> DBClose();

// 		return $dados ? $curriculum : null;
// 	}
	
	
// 	function listar_fotos($atributos=array()) {
// 		//chamada ao objeto da classe de abstração de banco de dados
// 		global $sqlGl;	

// 		$condicao = "";
		
// 		for($i=0;$i<count($atributos);$i++){
// 			$condicao .= $atributos[$i];
// 		}

// 		//$result = $sqlGl->DBSelect("empreendimentos e","e.*"," WHERE 1 $condicao");
// 		//$result = $sqlGl -> DBSelectGen("SELECT * FROM imoveis WHERE 1 $condicao ORDER BY $orderBy $limite");
// 		$result = $sqlGl -> DBSelectGen("SELECT * FROM imoveis_fotos WHERE 1 $condicao");


// 		//monta o objeto com os valores do banco de dados
// 		$i = 0;
// 		while ($dados = $sqlGl -> DBFetchArray()) {
// 			foreach ($dados as $campo => $valor) {
// 				if($valor != null){
// 					$curriculums[$i] -> {$campo} = $valor;
// 				}
// 			}
// 			$i++;
// 		}
// 		$curriculums["num"] = $i;

// 		//fecha a conexão
// 		$sqlGl -> DBClose();

// 		return $curriculums;
// 	}
	
	
// 	function listarRelacaoTiposByImovel($atributos=array()) {
// 		//chamada ao objeto da classe de abstração de banco de dados
// 		global $sqlGl;	

// 		$condicao = "";
		
// 		for($i=0;$i<count($atributos);$i++){
// 			$condicao .= $atributos[$i];
// 		}

// 		//$result = $sqlGl->DBSelect("empreendimentos e","e.*"," WHERE 1 $condicao");
// 		//$result = $sqlGl -> DBSelectGen("SELECT * FROM imoveis WHERE 1 $condicao ORDER BY $orderBy $limite");
// 		$result = $sqlGl -> DBSelectGen("SELECT * FROM imoveis_has_tipos WHERE 1 $condicao");


// 		//monta o objeto com os valores do banco de dados
// 		$i = 0;
// 		while ($dados = $sqlGl -> DBFetchArray()) {
// 			foreach ($dados as $campo => $valor) {
// 				if($valor != null){
// 					$curriculums[$i] -> {$campo} = $valor;
// 				}
// 			}
// 			$i++;
// 		}
// 		$curriculums["num"] = $i;

// 		//fecha a conexão
// 		$sqlGl -> DBClose();

// 		return $curriculums;
// 	}

// 	function publicar_imovel($id, $status) {
// 		global $sqlGl;

// 		$result = $sqlGl -> DBUpdate("imoveis", "status='" . $status . "'", "id='" . $id . "'");

// 		return $result;
// 	}
	
// 	function inserir_visualizacao($idimovel,$qtde = null) {
// 		global $sqlGl;

// 		$result = $sqlGl -> DBUpdate("imoveis", "visualizacoes = ".$qtde." ", "id='" . $idimovel . "'");

// 		return $result;
// 	}

// 	function alteraOrdem($id, $posicao) {
// 		global $sqlGl;
// 		$result = $sqlGl -> DBUpdate("imoveis", "ordem='" . $posicao . "'", "id=" . $id);
// 		//fecha a conexão
// 		$sqlGl -> DBClose();
// 		return $result;
// 	}
	
	
		
	
// 	## IMOVEIS TIPO
	
	
// 	function listar_tipos($atributos=array()) {
// 		//chamada ao objeto da classe de abstração de banco de dados
// 		global $sqlGl;

// 		$condicao = "";
		
// 		for($i=0;$i<count($atributos);$i++){
// 			$condicao .= $atributos[$i];
// 		}

// 		//$result = $sqlGl->DBSelect("empreendimentos e","e.*"," WHERE 1 $condicao");
// 		$result = $sqlGl -> DBSelectGen("SELECT * FROM imoveis_tipos WHERE 1 $condicao");

// 		//monta o objeto com os valores do banco de dados
// 		$i = 0;
// 		while ($dados = $sqlGl -> DBFetchArray()) {
// 			foreach ($dados as $campo => $valor) {
// 				$curriculums[$i] -> {$campo} = $valor;
// 			}
// 			$i++;
// 		}
// 		$curriculums["num"] = $i;

// 		//fecha a conexão
// 		$sqlGl -> DBClose();

// 		return $curriculums;
// 	}
	
		
	
// 	## CIDADES GERAL
	
	
// 	function listar_cidades($atributos=array()) {
// 		//chamada ao objeto da classe de abstração de banco de dados
// 		global $sqlGl;

// 		$condicao = "";
		
// 		for($i=0;$i<count($atributos);$i++){
// 			$condicao .= $atributos[$i];
// 		}

// 		//$result = $sqlGl->DBSelect("empreendimentos e","e.*"," WHERE 1 $condicao");
// 		$result = $sqlGl -> DBSelectGen("SELECT * FROM cidades WHERE 1 $condicao");

// 		//monta o objeto com os valores do banco de dados
// 		$i = 0;
// 		while ($dados = $sqlGl -> DBFetchArray()) {
// 			foreach ($dados as $campo => $valor) {
// 				$curriculums[$i] -> {$campo} = $valor;
// 			}
// 			$i++;
// 		}
// 		$curriculums["num"] = $i;

// 		//fecha a conexão
// 		$sqlGl -> DBClose();

// 		return $curriculums;
// 	}
	
	
// 	# LISTA CIDADE
	
	
// 	function lista_cidade($atributos=array()) {
// 		//chamada ao objeto da classe de abstração de banco de dados
// 		global $sqlGl;
	
// 		$condicao = "";
	
// 		for($i=0;$i<count($atributos);$i++){
// 			$condicao .= $atributos[$i];
// 		}
	
// 		$result = $sqlGl -> DBSelectGen("SELECT * FROM cidades WHERE 1 $condicao");
	
// 		//monta o objeto notícia com os valores do banco de dados
// 		$dados = $sqlGl -> DBFetchArray();
// 		if ($dados) {
// 			foreach ($dados as $campo => $valor) {
// 				$curriculum -> {$campo} = $valor;
	
// 			}
// 		}
	
// 		//fecha a conexão
// 		$sqlGl -> DBClose();
	
// 		return $dados ? $curriculum : null;
// 	}
	
		
	
// 	## BAIRROS GERAL
	
	
// 	function listar_bairros($atributos=array()) {
// 		//chamada ao objeto da classe de abstração de banco de dados
// 		global $sqlGl;

// 		$condicao = "";
		
// 		for($i=0;$i<count($atributos);$i++){
// 			$condicao .= $atributos[$i];
// 		}

// 		//$result = $sqlGl->DBSelect("empreendimentos e","e.*"," WHERE 1 $condicao");
// 		$result = $sqlGl -> DBSelectGen("SELECT * FROM bairros WHERE 1 $condicao");

// 		//monta o objeto com os valores do banco de dados
// 		$i = 0;
// 		while ($dados = $sqlGl -> DBFetchArray()) {
// 			foreach ($dados as $campo => $valor) {
// 				$curriculums[$i] -> {$campo} = $valor;
// 			}
// 			$i++;
// 		}
// 		$curriculums["num"] = $i;

// 		//fecha a conexão
// 		$sqlGl -> DBClose();

// 		return $curriculums;
// 	}
	
	
// 	# LISTA BAIRRO
	
	
// 	function lista_bairro($atributos=array()) {
// 		//chamada ao objeto da classe de abstração de banco de dados
// 		global $sqlGl;
	
// 		$condicao = "";
	
// 		for($i=0;$i<count($atributos);$i++){
// 			$condicao .= $atributos[$i];
// 		}
	
// 		$result = $sqlGl -> DBSelectGen("SELECT * FROM bairros WHERE 1 $condicao");
	
// 		//monta o objeto notícia com os valores do banco de dados
// 		$dados = $sqlGl -> DBFetchArray();
// 		if ($dados) {
// 			foreach ($dados as $campo => $valor) {
// 				$curriculum -> {$campo} = $valor;
	
// 			}
// 		}
	
// 		//fecha a conexão
// 		$sqlGl -> DBClose();
	
// 		return $dados ? $curriculum : null;
// 	}
	
// 	#CIDADES IMOVEIS
		
	
	
// 	function listar_correios($atributos=array()) {
// 		//chamada ao objeto da classe de abstração de banco de dados
// 		global $sqlGl;	

// 		$condicao = "";
		
// 		for($i=0;$i<count($atributos);$i++){
// 			$condicao .= $atributos[$i];
// 		}

// 		//$result = $sqlGl->DBSelect("empreendimentos e","e.*"," WHERE 1 $condicao");
// 		//$result = $sqlGl -> DBSelectGen("SELECT * FROM imoveis WHERE 1 $condicao ORDER BY $orderBy $limite");
// 		$result = $sqlGl -> DBSelectGen("
// 			SELECT * FROM (SELECT
// 				imo.*,
// 				(SELECT GROUP_CONCAT(DISTINCT(it.nome) SEPARATOR '|')
// 			             FROM imoveis_has_tipos iht, imoveis_tipos it 
// 			            WHERE iht.imoveis_id = imo.id AND it.id = iht.tipos_id) AS tipos_nome,
// 				(SELECT GROUP_CONCAT(DISTINCT(CAST(it2.id as CHAR)) SEPARATOR '|')
// 			             FROM imoveis_has_tipos iht2, imoveis_tipos it2 
// 			            WHERE iht2.imoveis_id = imo.id AND it2.id = iht2.tipos_id) AS tipos_id,
// 				ic.nome as categoria,
// 				ims.nome as situacao_nome,
// 				bair.nome as bairro,
// 				cid.nome as cidade
// 			FROM
// 				imoveis imo
// 				LEFT JOIN imoveis_categorias ic on ic.id=imo.imoveis_categoria_id
// 				LEFT JOIN imoveis_situacao ims on ims.id=imo.imoveis_situacao_id
// 				LEFT JOIN estados est on est.uf=imo.estado
// 				LEFT JOIN cidades cid on cid.id=imo.cidade_id
// 				LEFT JOIN bairros bair on bair.id=imo.bairro_id
// 			) AS sl WHERE sl.id != '0'	
				
// 			".$condicao."
// 		");


// 		//monta o objeto com os valores do banco de dados
// 		$i = 0;
// 		while ($dados = $sqlGl -> DBFetchArray()) {
// 			foreach ($dados as $campo => $valor) {
// 				if($valor != null){
// 					$curriculums[$i] -> {$campo} = $valor;
// 				}
// 			}
// 			$i++;
// 		}
// 		$curriculums["num"] = $i;

// 		//fecha a conexão
// 		$sqlGl -> DBClose();

// 		return $curriculums;
// 	}
		
	
	
// 		## IMOVEIS CATEGORIAS
	
	
// 	function listar_categorias($atributos=array()) {
// 		//chamada ao objeto da classe de abstração de banco de dados
// 		global $sqlGl;

// 		$condicao = "";
		
// 		for($i=0;$i<count($atributos);$i++){
// 			$condicao .= $atributos[$i];
// 		}

// 		//$result = $sqlGl->DBSelect("empreendimentos e","e.*"," WHERE 1 $condicao");
// 		$result = $sqlGl -> DBSelectGen("SELECT * FROM imoveis_categorias WHERE 1 $condicao");

// 		//monta o objeto com os valores do banco de dados
// 		$i = 0;
// 		while ($dados = $sqlGl -> DBFetchArray()) {
// 			foreach ($dados as $campo => $valor) {
// 				$curriculums[$i] -> {$campo} = $valor;
// 			}
// 			$i++;
// 		}
// 		$curriculums["num"] = $i;

// 		//fecha a conexão
// 		$sqlGl -> DBClose();

// 		return $curriculums;
// 	}
	

// }
?>