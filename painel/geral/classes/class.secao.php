<?
	/*
	*	Título: Classe Seção Dinâmica
	*	Função: Responsável por fazer a busca, cadastro,
	*			alteração e exclusão de seção dinâmica no banco de dados.
	*	Desenvolvido por: Paulo Henrique Pereira
	*/
	class Secao{
		
		//função responsável por fazer a busca de todas as seções fixas(sistemas personalizados) no banco de dados
		function listar_fixas(){
			//chamada ao objeto da classe de abstração de banco de dados
			global $sqlGl;
			$aValores = $sqlGl -> from("secao_fixa")->orderBy('ordem ASC');
			$aValores = $aValores->fetchAll();
			$aValores['num'] = count($aValores);
			
			return $aValores;
		}

		//função responsável por fazer a busca de todas as seções fixas(sistemas personalizados) no banco de dados
		function listar_menu_by_secao_fixa($id_secao_fixa){
			//chamada ao objeto da classe de abstração de banco de dados
			global $sqlGl;
			
			$aValores = $sqlGl -> from("secao_fixa_menu")->where('secao_fixa_id',$id_secao_fixa)->orderBy('id');
			$aValores = $aValores->fetchAll();
			$aValores['num'] = count($aValores);
			
			return $aValores;
		}
		
		//função responsável por fazer a busca das seções fixas pelo id do usuário
		function secaoFixaPorUsuario($id_usuario){
			//chamada ao objeto da classe de abstração de banco de dados
			global $sqlGl;
			
			$aValores = $sqlGl -> from("permissao_secao_fixa")->leftJoin('secao_fixa')->where(array('permissao_secao_fixa.usuarios_id' => $id_usuario))->orderBy('secao_fixa.titulo');
			$aValores = $aValores->fetchAll();
			$aValores['num'] = count($aValores);
				
			return $aValores;
		}
		
		function permissaoSecaoFixaUsuario($id_secao_fixa,$id_usuario){
			//chamada ao objeto da classe de abstração de banco de dados
			global $sqlGl;
			
			$aValores = $sqlGl -> from("permissao_secao_fixa")->where(array('usuarios_id' => $id_usuario,'secao_fixa_id' => $id_secao_fixa));
			$aValores = $aValores->fetch();
			return $aValores;
		}
	}
?>