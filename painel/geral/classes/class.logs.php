<?
	class Logs {		
		#################################
		## VERIFICANDO O ULTIMO ACESSO ##
		#################################
		function ultimoAcesso($id_usuario=""){
			global $sqlGl;
			$condicao = array();
			if($id_usuario!=""){
				$condicao['id_area'] = $id_usuario;
			}
			$condicao['area'] = 'usuarios';
			$condicao['acao'] = 'entrou';
			
			$aValores = $sqlGl -> from("logs")->where($condicao)->orderBy('id DESC')->limit('1');
			$aValores = $aValores->fetch();

			return $aValores;
			
			
		}
		
		##################
		## ULTIMOS LOGS ##
		##################
		function ultimosLogs($limite=""){
			global $sqlGl;
			
			$aValores = $sqlGl -> from("logs")->orderBy('id DESC')->limit($limite);
			$aValores = $aValores->fetchAll();
			$aValores['num'] = count($aValores);
			
		
			return $aValores;
		}
		
		## GRAVA O LOG DE UM ALTERAÇÃO ##
		function gravaLog($usuario,$area,$id_area,$acao,$ip=""){			
			global $sqlGl;
			$aDados = array(
					array(
							'usuario' => $usuario,
							'area' => $area,
							'id_area' => $id_area,
							'acao' => $acao,
							'datahora' => date("Y-m-d H:i:s"),
							'ip' => $ip,
					)
			);
			$result = $sqlGl->insertInto('logs', $aDados);
			$lastInsert = $result->execute();
	
			//retorna o resultado da query para a câmada de controle
			return $lastInsert;
		}
	}
?>