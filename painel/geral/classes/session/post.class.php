<?
	
	// O objeto gp tem como intensão pegar variaveis get e post
	// como explicado melhor abaixo:
	class gp{
		
		public $param = array();
		
		function gp(){
			if(isset($_GET) && count($_GET)){
				$this->rec_parameters('get');
			}
			if(isset($_POST) && count($_POST)){
				$this->rec_parameters('post');
				
			}

			if(isset($_FILES) && count($_FILES)){
				$this->rec_parameters('files');
			
			}
		}
		
		// Parmetros: nenhum.
		// Retorno: retorna null se a variavel é vazia.
		// Variáveis alteradas: nehuma.
		function rec_parameters($param){
			if($param == 'post'){
				$index = array_keys($_POST);
				$metod = $_POST;
			}else if($param == 'get'){
				$index = array_keys($_GET);
				$metod = $_GET;
			}else if($param == 'files'){
				$index = array_keys($_FILES);
				$metod = $_FILES;
			}
			if(count($index)!=0){
				for($n=0;$n<count($index);$n++){
					$this->param[$index[$n]] = $metod[$index[$n]];
				}
			}else{
				$this->param = NULL;
			}
		}
			
	}
	
?>