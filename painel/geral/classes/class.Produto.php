<?php
class Produto {
	

	function cadastrar($form) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		
		$result = $sqlGl->insertInto('produto',$form);
		$lastInsert = $result->execute();

		//retorna o resultado da query para a câmada de controle
		return $lastInsert;
	}
	
	function cadastrarFoto($form) {
		
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
	
		$result = $sqlGl->insertInto('produto_foto',$form);
		$lastInsert = $result->execute();
	
		//retorna o resultado da query para a câmada de controle
		return $lastInsert;
	}

	function alterar($form) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$result = $sqlGl->update('produto')->set($form)->where('id', $form['id']);
		$result = $result->execute(true);

		//retorna o resultado da query para a câmada de controle
		return $result;
	}

	function deletar($id) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$result = $sqlGl->deleteFrom("produto")->where("id",$id);
		$result = $result->execute();

		//retorna o resultado da query para a câmada de controle
		return $result;
	}
	
	function deletarFoto($id) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$result = $sqlGl->deleteFrom("produto_foto")->where("id",$id);
		$result = $result->execute();
	
		//retorna o resultado da query para a câmada de controle
		return $result;
	}
	
	
	function listar($atributos=array(),$select=array(),$limit=null,$offsset=null,$orderBy=null,$pesquisa=array()) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		
		$aValores = $sqlGl-> from("produto")
		    ->where($atributos)
		    ->limit($limit)
		    ->orderBy($orderBy);
		if(count($select) <= 0){
    		$aValores->select(null);
    		$aValores->select(array('*', '(select count(id) from produto) as total'));
		}else{
		    $aValores->select(null);
		    $aValores->select($select);
		}
		if($offsset){
			$aValores->offset($offsset);
		}
		if(count($pesquisa) > 0){
    		foreach ($pesquisa as $key => $value){
    		    $aValores->where($value['condicao'],$value['valor']);
    		}
		}
		$sqlRetorno =  $aValores->getQuery();   
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
		$aValores['sql'] = $sqlRetorno;
		if(!$select){
		    $aValores['total'] = $aValores[0]->total;
		}
	
		return $aValores;
	}

	function lista($atributos=array(),$select=array(),$limit=null,$offsset=null,$orderBy=null,$pesquisa=array()) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;

	    $aValores = $sqlGl-> from("produto")
		    ->where($atributos)
		    ->limit($limit)
		    ->orderBy($orderBy);
		if(count($select) <= 0){
    		$aValores->select(null);
    		$aValores->select(array('*', '(select count(id) from produto) as total'));
		}else{
		    $aValores->select(null);
		    $aValores->select($select);
		}
		if($offsset){
			$aValores->offset($offsset);
		}
		if(count($pesquisa) > 0){
    		foreach ($pesquisa as $key => $value){
    		    $aValores->where($value['condicao'],$value['valor']);
    		}
		}
		$aValores = $aValores->fetch();
		if(!$select){
		    $aValores->total = $aValores->total;
		}
		
		return $aValores;
	}
	
	function listar_fotos($atributos=array(),$orderBy=null) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
	
		$aValores = $sqlGl -> from("produto_foto")->where($atributos)->orderBy($orderBy);
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function publicar($id, $status) {
		global $sqlGl;
		$result = $sqlGl->update('produto')->set('status',$status)->where('id', $id);
		$result = $result->execute(true);
		
		//retorna o resultado da query para a câmada de controle
		return $result;
	}

	## ORDEM DOS ARQUIVOS ##

	function pegarListagensParaAlterarBack($fromPosition, $toPosition) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$aValores = $sqlGl -> from("produto")->where('ordem <= :ordem1 && ordem >= :ordem2 ',array(':ordem1' => $fromPosition, ':ordem2' => $toPosition));
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function pegarListagensParaAlterarForward($fromPosition, $toPosition) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;
		$aValores = $sqlGl -> from("produto")->where('ordem >= :ordem1 && ordem <= :ordem2 ',array(':ordem1' => $fromPosition, ':ordem2' => $toPosition));
		$aValores = $aValores->fetchAll();
		$aValores['num'] = count($aValores);
	
		return $aValores;
	}

	function alteraOrdem($id, $posicao) {
		global $sqlGl;
		$result = $sqlGl->update('produto')->set('ordem',$posicao)->where('id', $id);
		$result = $result->execute(true);
		
		//retorna o resultado da query para a câmada de controle
		return $result;
		
	}
	
	function proximo_id() {
		//chamada ao objeto da classe de abstraÃ§Ã£o de banco de dados
		global $sqlGl;
		
		$pdo = $sqlGl->getPdo();
		
		$stmt = $pdo->query("SHOW TABLE STATUS LIKE 'produto'");
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
	
		return $res['auto_increment'];
	}

}
?>