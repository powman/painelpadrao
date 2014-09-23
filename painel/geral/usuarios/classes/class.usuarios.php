<?
	/*
	*	Título: Classe Usuários
	*	Função: Responsável por fazer a busca, cadastro,
	*			alteração e exclusão de usuários no banco de dados.
	*	Desenvolvido por: Paulo Henrique Pereira
	*	Data: 14/04/2014
	*	Atualizado em: 15/04/2014 por: Paulo Henrique Pereira
	*/
	class Usuarios{
	

		function cadastrar($usuario){
			//chamada ao objeto da classe de abstração de banco de dados
			global $sqlGl;
			$aDados = array(
					array(
							'nome' => $usuario['nome'],
							'senha' => md5($usuario["senha"]),
							'email' => $usuario["email"],
							'img' => $usuario["img"],
							'status' => $usuario["status"],
							'nivel' => $usuario["nivel"],
					)
			);
			$result = $sqlGl->insertInto('usuarios',$aDados);
			$lastInsert = $result->execute();
			
			//pega o id que foi inserido no banco
			$id = $lastInsert;
			
			if($id){
				
				for($i=0;$i<count($usuario['secao_fixa']);$i++){
					$aDados = array(
							array(
									'secao_fixa_id' => $usuario['secao_fixa'][$i],
									'usuarios_id' => $id,
							)
					);
					$result = $sqlGl->insertInto('permissao_secao_fixa',$aDados);
					$result->execute();
				}
	
				//se tiver permissão na seção fixa para cadastro da permissão de cadastro
				if($usuario['cadastrar_fixa']!=NULL){
					foreach($usuario['cadastrar_fixa'] as $key => $value){
						$aCond = array();
						$aCond['secao_fixa_id'] = $key;
						$aCond['usuarios_id'] = $id;
						
						$result = $sqlGl->update('permissao_secao_fixa')->set('cadastrar','1')->where($aCond);
						$result->execute(true);
					}
				}
				//se tiver permissão na seção fixa para alteração da permissão de alteração
				if($usuario['alterar_fixa']!=NULL){
					foreach($usuario['alterar_fixa'] as $key => $value){
						$aCond = array();
						$aCond['secao_fixa_id'] = $key;
						$aCond['usuarios_id'] = $id;
						
						$result = $sqlGl->update('permissao_secao_fixa')->set('alterar','1')->where($aCond);
						$result->execute(true);
					}
				}
				//se tiver permissão na seção fixa para exclusão da permissão de exclusão
				if($usuario['excluir_fixa']!=NULL){
					foreach($usuario['excluir_fixa'] as $key => $value){
						$aCond = array();
						$aCond['secao_fixa_id'] = $key;
						$aCond['usuarios_id'] = $id;
						
						$result = $sqlGl->update('permissao_secao_fixa')->set('excluir','1')->where($aCond);
						$result->execute(true);
					}
				}
				//se tiver permissão na seção fixa para exclusão da permissão de exclusão
				if($usuario['publicar_fixa']!=NULL){
					foreach($usuario['publicar_fixa'] as $key => $value){
						$aCond = array();
						$aCond['secao_fixa_id'] = $key;
						$aCond['usuarios_id'] = $id;
						
						$result = $sqlGl->update('permissao_secao_fixa')->set('publicar','1')->where($aCond);
						$result->execute(true);
					}
				}
			}
			
			//retorna o resultado da query para a câmada de controle
			return $result;
		}
		
		//função responsável por fazer a alteração do usuário no banco de dados
		function alterar($usuario){
			//chamada ao objeto da classe de abstração de banco de dados
			global $sqlGl;
			
			$aDados = array(
							'nome' => $usuario['nome'],
							'img' => $usuario["img"],
							'status' => $usuario["status"],
							'nivel' => $usuario["nivel"],
					);
			
			$aCond = array();
			$aCond['id'] = $usuario['id'];
			
			$result = $sqlGl->update('usuarios')->set($aDados)->where($aCond);
			$result->execute(true);
			
			if($usuario['secao_fixa']){
				$result = $sqlGl->deleteFrom("permissao_secao_fixa")->where("usuarios_id",$usuario['id']);
				$result = $result->execute();
			}
			
			for($i=0;$i<count($usuario['secao_fixa']);$i++){
				$aDados2 = array(
						array(
								'secao_fixa_id' => $usuario['secao_fixa'][$i],
								'usuarios_id' => $usuario['id'],
								'cadastrar' => '0',
								'alterar' => '0',
								'excluir' => '0',
								'publicar' => '0'
						)
				);

				$result = $sqlGl->insertInto('permissao_secao_fixa',$aDados2);
				$result->execute();
			}
			
			if($usuario['cadastrar_fixa']!=NULL){
				foreach($usuario['cadastrar_fixa'] as $key => $value){
					
					$aCond = array();
					$aCond['secao_fixa_id'] = $key;
					$aCond['usuarios_id'] = $usuario['id'];
					
					$result = $sqlGl->update('permissao_secao_fixa')->set('cadastrar','1')->where($aCond);
					$result->execute(true);
				}
			}
			
			
			if($usuario['alterar_fixa']!=NULL){
				foreach($usuario['alterar_fixa'] as $key => $value){
					$aCond = array();
					$aCond['secao_fixa_id'] = $key;
					$aCond['usuarios_id'] = $usuario['id'];
						
					$result = $sqlGl->update('permissao_secao_fixa')->set('alterar','1')->where($aCond);
					$result->execute(true);
				}
			}
			
			if($usuario['excluir_fixa']!=NULL){
				foreach($usuario['excluir_fixa'] as $key => $value){
					$aCond = array();
					$aCond['secao_fixa_id'] = $key;
					$aCond['usuarios_id'] = $usuario['id'];
					
					$result = $sqlGl->update('permissao_secao_fixa')->set('excluir','1')->where($aCond);
					$result->execute(true);
				}
			}			
			
			if($usuario['publicar_fixa']!=NULL){
				foreach($usuario['publicar_fixa'] as $key => $value){
					$aCond = array();
					$aCond['secao_fixa_id'] = $key;
					$aCond['usuarios_id'] = $usuario['id'];
						
					$result = $sqlGl->update('permissao_secao_fixa')->set('publicar','1')->where($aCond);
					$result->execute(true);
				}
			}
			
			//retorna o resultado da query para a câmada de controle
			return $result;
		}
		
		//função responsável por fazer a exclus�o do usuário no banco de dados
		function deletar($id){
			global $sqlGl;
			$result = $sqlGl->deleteFrom("usuarios")->where("id",$id);
			$result = $result->execute();
	
			//retorna o resultado da query para a câmada de controle
			return $result;
		}
		
		//função responsável por fazer a busca dos usuários no banco de dados
		function listar($nivel=""){
			global $sqlGl;
			$cond = array();
			//se tiver pedindo nivel
			if($nivel!=""){
				$cond['nivel']=$nivel;
			}
			
			$aValores = $sqlGl -> from("usuarios")->where($cond)->orderBy('id');
			$aValores = $aValores->fetchAll();
			$aValores['num'] = count($aValores);
		
			return $aValores;
		}
		

		function usuarioById($id){
			global $sqlGl;
			
			$aValores = $sqlGl -> from("usuarios")->where('id',$id);
			$aValores = $aValores->fetch();
			
			return $aValores;
		}
		
		//função responsável por fazer a busca do usuário pelo seu login
		function usuarioByLogin($login){
			//chamada ao objeto da classe de abstração de banco de dados
			global $sqlGl;
			
			$aValores = $sqlGl -> from("usuarios")->where('email',$login);
			$aValores = $aValores->fetch();
			
			return $aValores;
		}


		function usuarioByEmail($email){
			global $sqlGl;
			
			$aValores = $sqlGl -> from("usuarios")->where('email',$email);
			$aValores = $aValores->fetch();
			
			return $aValores;
		}
		function usuarioBySenha($email,$senha){
			global $sqlGl;
			
			$aValores = $sqlGl -> from("usuarios")->where(array('email' => $email, 'senha' => md5($senha)));
			$aValores = $aValores->fetch();
			
			return $aValores;
		}
		
		function logar($email,$senha){
			global $sqlGl;
			
			$aValores = $sqlGl -> from("usuarios")->where(array('email' => $email, 'senha' => md5($senha)));
			$aValores = $aValores->fetch();
			
			return $aValores;
		}
		
		//função responsável por fazer a alteração de senha do usuário
		function alterarSenha($usuario){
			//chamada ao objeto da classe de abstração de banco de dados
			global $sqlGl;
				
			$result = $sqlGl->update('usuarios')->set('senha',md5($usuario['senha']))->where('id',$usuario['id']);
			$result->execute(true);
	
			//retorna o resultado da query para a câmada de controle
			return $result;
		}
		
		//função responsável por fazer a alteração do email do usuário
		function alterarEmail($usuario){
			//chamada ao objeto da classe de abstração de banco de dados
			global $sqlGl;
		
			$result = $sqlGl->update('usuarios')->set('email',$usuario['email'])->where('id',$usuario['id']);
			$result->execute(true);
		
			//retorna o resultado da query para a câmada de controle
			return $result;
		}
	}
?>