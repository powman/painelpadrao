<?php

// O objeto gp tem como intensão pegar variaveis get e post
// como explicado melhor abaixo:
class gp
{
	public $param = array();
	function __construct()
	{
		$this->gp($_REQUEST, $_FILES);
	}



	function gp($REQUEST, $FILES)
	{
		if (isset($REQUEST) && count($REQUEST)) {

			$this->rec_parameters('request');
		}

		if (isset($FILES) && count($FILES)) {
			$this->rec_parameters('files');
		}
	}

	// Parmetros: nenhum.
	// Retorno: retorna null se a variavel é vazia.
	// Variáveis alteradas: nehuma.
	function rec_parameters($param)
	{
		if ($param == 'request') {
			$index = array_keys($_REQUEST);
			$metod = $_REQUEST;
		} else if ($param == 'files') {
			$index = array_keys($_FILES);
			$metod = $_FILES;
		}
		if (count($index) != 0) {
			for ($n = 0; $n < count($index); $n++) {
				$this->param[$index[$n]] = $metod[$index[$n]];
			}
		} else {
			$this->param = NULL;
		}
	}
}
