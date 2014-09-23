<?php
class String 
{
    /**
     * Função que limita o tamanho do texto
     * @param $str $tam $ret
     * @return String
     */
	public static function limitarCarac($str,$tam,$ret=true)
	{
		$comp = $ret==true?'...':'';
		return strlen($str)<$tam?$str:substr($str,0,$tam).$comp;
	}


}


?>
