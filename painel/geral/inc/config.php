<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	header('Content-Type: text/html; charset=utf-8');
	/* caminho dos paths */
	if (($_SERVER['SERVER_NAME'] == '192.168.7.206') || ($_SERVER['SERVER_NAME'] == 'localhost')) {
		$path["site"] = "/sites/painelPadrao/site/painelpadrao/";
	}else{
		$path["site"] = "/";
	}
	
	/* outros paths */
	$path["classes"] = "painel/geral/classes/";
	$path["geral"] = "painel/geral/";
	$path["newsletter"] = "painel/geral/newsletter/";
	
	class Config{
		
		public $allConfig;
		
		public static function AtributosConfig(){
		
			//banco de dados local principal (o banco auxiliar é esse mais o sufixo _aux)
			$allConfig["banco"]["local"]["host"]  = "localhost";
			$allConfig["banco"]["local"]["user"]  = "root";
			$allConfig["banco"]["local"]["senha"] = "mysql";
			$allConfig["banco"]["local"]["banco"] = "padrao_pdo";
			$allConfig["banco"]["local"]["port"] = "3306";
			$allConfig["banco"]["local"]["type"] = "mysql";
			
			## INI - site do desenvolvedor ##
			$allConfig["siteDesenvolvedor"] = "http://www.netsuprema.com.br/";
			
			## INI - Nome do cliente ##
			$allConfig["nomeCliente"] = "Netsuprema";
			
			## INI - Site do cliente ##
			$allConfig["siteCliente"] = "http://www.netsuprema.com.br/";
			
			## INI - Site do cliente ##
			$allConfig["urllogo"] = "";
			//$allConfig["urllogo"] = "http://pixelgo.com.br/img/marca.png";
			
			$allConfig["smtp"]['host'] = 'smtplw.com.br';
			$allConfig["smtp"]['user'] = 'sincopecasgoias';
			$allConfig["smtp"]['senha'] = 'apPgsxsN6915';
			$allConfig["smtp"]['port'] = '587';
			$allConfig["smtp"]['from'] = 'newsletter@sincopecas-go.com.br';
			$allConfig["smtp"]['fromName'] = 'Netsuprema';
			
			
// 			$allConfig["whm"]['dominioCpanelCliente'] = 'adugo.com.br';
// 			$allConfig["whm"]['userCpanelCliente'] = 'adugocom';
// 			$allConfig["whm"]['dominio'] = 'netsuprema.com.br';
// 			$allConfig["whm"]['user'] = 'netsupre';
// 			$allConfig["whm"]['pass'] = 'adm@2015@n49tsuprema';
			$allConfig["permissao"]['emailCpanel'] = false;
			$allConfig["permissao"]['ftpCpanel'] = false;
			$allConfig["permissao"]['formulario'] = true;
			$allConfig["permissao"]['formularioCriar'] = true;
			$allConfig["permissao"]['formularioListar'] = true;
			$allConfig["permissao"]['modulo'] = true;
			$allConfig["permissao"]['moduloCriar'] = true;
			$allConfig["permissao"]['moduloListar'] = true;
			
			return $allConfig;
		
		}
	}

	
