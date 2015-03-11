<?php
class Tipo {

	function cadastrar($form) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;

		$campos = $valores = "";

		foreach ($form as $campo => $valor) {
			$campos .= "" . $campo . ",";
			$valores .= "'" . mysql_real_escape_string($valor) . "',";

		}

		$campos = substr($campos, 0, strlen($campos) - 1);
		$valores = substr($valores, 0, strlen($valores) - 1);

		//inseri a curriculum no banco de dados
		$result = $sqlGl->DBInsertData("imoveis_tipos($campos)", $valores);

		$rs->result = $result;
		$rs->id = $sqlGl->returnId();

		//fecha a conexão
		$sqlGl->DBClose();

		//retorna o resultado da query para a câmada de controle
		return $rs;
	}

	function alterar($form) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;

		$params = "";

		foreach ($form as $campo => $valor) {
			$params .= "$campo='" . mysql_real_escape_string($valor) . "', ";
		}

		$params = substr($params, 0, strlen($params) - 2);

		//altera o curriculum no banco de dados
		$result = $sqlGl->DBUpdate("imoveis_tipos", $params, "id=" . $form->id);

		$rs->result = $result;
		//fecha a conexão
		$sqlGl->DBClose();

		//retorna o resultado da query para a câmada de controle
		return $rs;
	}

	function deletar($id) {
		//chamada ao objeto da classe de abstração de banco de dados
		global $sqlGl;

		//apaga o registro do banco de dados
		$result = $sqlGl->DBDeleteData("imoveis_tipos", "WHERE id='" . $id . "'");

		//fecha a conexão
		$sqlGl->DBClose();

		//retorna o resultado da query para a câmada de controle
		return $result;
	}
	
	
	function listar($atributos=array()) {
		//chamada ao objeto da classe de abstra��o de banco de dados
		global $sqlGl;
	
		$condicao = "";
	
		for($i=0;$i<count($atributos);$i++){
			$condicao .= $atributos[$i];
		}
	
		//$result = $sqlGl->DBSelect("empreendimentos e","e.*"," WHERE 1 $condicao");
		//$result = $sqlGl -> DBSelectGen("SELECT * FROM imoveis WHERE 1 $condicao ORDER BY $orderBy $limite");
		$result = $sqlGl -> DBSelectGen('
			SELECT * FROM imoveis_tipos WHERE 1 '.$condicao.'
		');
	
	
		//monta o objeto com os valores do banco de dados
		$i = 0;
		while ($dados = $sqlGl -> DBFetchArray()) {
			foreach ($dados as $campo => $valor) {
				if($valor != null){
					$curriculums[$i] -> {$campo} = $valor;
				}
			}
			$i++;
		}
		$curriculums["num"] = $i;
	
		//fecha a conex�o
		$sqlGl -> DBClose();
	
		return $curriculums;
	}
	
	
	function verifica_relacao_tipos_imoveis($atributos=array()) {
		//chamada ao objeto da classe de abstra��o de banco de dados
		global $sqlGl;
	
		$condicao = "";
	
		for($i=0;$i<count($atributos);$i++){
			$condicao .= $atributos[$i];
		}
	
		//$result = $sqlGl->DBSelect("empreendimentos e","e.*"," WHERE 1 $condicao");
		//$result = $sqlGl -> DBSelectGen("SELECT * FROM imoveis WHERE 1 $condicao ORDER BY $orderBy $limite");
		$result = $sqlGl -> DBSelectGen('
			SELECT * FROM imoveis_has_tipos WHERE 1 '.$condicao.'
		');
	
	
		//monta o objeto com os valores do banco de dados
		$i = 0;
		while ($dados = $sqlGl -> DBFetchArray()) {
			foreach ($dados as $campo => $valor) {
				if($valor != null){
					$curriculums[$i] -> {$campo} = $valor;
				}
			}
			$i++;
		}
		$curriculums["num"] = $i;
	
		//fecha a conex�o
		$sqlGl -> DBClose();
	
		return $curriculums;
	}

	function lista($atributos=array()) {
		//chamada ao objeto da classe de abstra��o de banco de dados
		global $sqlGl;
		
		$condicao = "";
		
		for($i=0;$i<count($atributos);$i++){
			$condicao .= $atributos[$i];
		}

		$result = $sqlGl -> DBSelectGen('
			SELECT * FROM imoveis_tipos WHERE 1 '.$condicao.'
		');

		//monta o objeto not�cia com os valores do banco de dados
		$dados = $sqlGl -> DBFetchArray();
		if ($dados) {
			foreach ($dados as $campo => $valor) {
				$curriculum -> {$campo} = $valor;

			}
		}

		//fecha a conex�o
		$sqlGl -> DBClose();

		return $dados ? $curriculum : null;
	}

	function publicar($id, $status) {
		global $sqlGl;

		$result = $sqlGl
				->DBUpdate("imoveis_tipos", "status='" . $status . "'",
						"id='" . $id . "'");

		return $result;
	}

	function alteraOrdem($id, $posicao) {
		global $sqlGl;
		$result = $sqlGl
				->DBUpdate("imoveis_tipos", "ordem='" . $posicao . "'", "id="
						. $id);
		//fecha a conexão
		$sqlGl->DBClose();
		return $result;
	}

}
?>