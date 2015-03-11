<?php
class Correios {
	
	
	function listar_estado($atributos=array(),$orderBy=null, $limit=null) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		
		$aValores = $sqlGl -> from("estados")->where($atributos)->orderBy($orderBy)->limit($limit);
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}
	
	function lista_estado($atributos=array(),$orderBy=null) {
	    //chamada ao objeto da classe de abstração de banco de dados
	    global $sqlGl;
	
	    $aValores = $sqlGl -> from("estados")->where($atributos);
	    $aValores = $aValores->fetch();
	    return $aValores;
	}
	
	function listar_cidade($atributos=array(),$orderBy=null, $limit=null) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		
		$aValores = $sqlGl -> from("cidades")->where($atributos)->limit($limit);
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}
	
	function lista_cidade($atributos=array(),$orderBy=null) {
	    //chamada ao objeto da classe de abstração de banco de dados
	    global $sqlGl;
	
	    $aValores = $sqlGl -> from("cidades")->where($atributos);
	    $aValores = $aValores->fetch();
	    return $aValores;
	}
	
	function listar_bairro($atributos=array(),$orderBy=null, $limit=null) {
	    //chamada ao objeto da classe de abstração de banco de dados
	    global $sqlGl;
	
	    $aValores = $sqlGl ->from("bairros")
	                       ->select('cidades.nome as cidade_nome')
	                       ->leftJoin('cidades ON cidades.id = bairros.cidade')
	                       ->where($atributos)
	                       ->limit($limit);
	    $aValores = $aValores->fetchAll();
	    $aValores['num'] = count($aValores);
	    
	   
	
	    return $aValores;
	}
	
	function lista_bairro($atributos=array(),$orderBy=null) {
	    //chamada ao objeto da classe de abstração de banco de dados
	    global $sqlGl;
	
	    $aValores = $sqlGl ->from("bairros")
	                       ->select('cidades.nome as cidade_nome')
	                       ->leftJoin('cidades ON cidades.id = bairros.cidade')
	                       ->where($atributos);
	    $aValores = $aValores->fetch();
	    return $aValores;
	}
	
	function listar_endereco($atributos=array(),$orderBy=null, $limit=null) {
	    //chamada ao objeto da classe de abstração de banco de dados
	    global $sqlGl;
	
	    $aValores = $sqlGl -> from("enderecos")->where($atributos)->limit($limit);
	    $aValores = $aValores->fetchAll();
	    $aValores['num'] = count($aValores);
	
	    return $aValores;
	}
	
	function lista_endereco($atributos=array(),$orderBy=null) {
	    //chamada ao objeto da classe de abstração de banco de dados
	    global $sqlGl;
	
	    $aValores = $sqlGl -> from("enderecos")->where($atributos);
	    $aValores = $aValores->fetch();
	    return $aValores;
	}
	
// 	function listar_bairros($atributos=array(),$orderBy=null) {
	
// 	    global $sqlGl;
	
// 	    $pdo = $sqlGl->getPdo();
	
// 	    $aValores = $pdo->query("
// 	                SELECT sl.* FROM (	
// 						SELECT 
// 							b.*, c.cidades as cidade_nome 
// 						FROM 
// 							bairros b 
// 							LEFT JOIN cidades c ON c.id = b.cidade
// 						WHERE 1
// 				    ) as sl WHERE 1
// 	            ");
// 	    $aValores = $stmt->fetchAll(PDO::FETCH_ASSOC);
// 	    $aValores['num'] = count($aValores);

// 	    return $res;
	
// 	}

	## ORDEM DOS ARQUIVOS ##

	function pegarListagensParaAlterarBack($fromPosition, $toPosition) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$aValores = $sqlGl -> from("usuario")->where('ordem <= :ordem1 && ordem >= :ordem2 ',array(':ordem1' => $fromPosition, ':ordem2' => $toPosition));
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function pegarListagensParaAlterarForward($fromPosition, $toPosition) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$aValores = $sqlGl -> from("usuario")->where('ordem >= :ordem1 && ordem <= :ordem2 ',array(':ordem1' => $fromPosition, ':ordem2' => $toPosition));
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function alteraOrdem($id, $posicao) {
		global $sqlGl;
		$result = $sqlGl->update('usuario')->set('ordem',$posicao)->where('id', $id);
		$result = $result->execute(true);
		
		//retorna o resultado da query para a câmada de controle
		return $result;
		
	}

}
?>