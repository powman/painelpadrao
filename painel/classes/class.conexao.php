<?php	
	include dirname(__FILE__)."/../geral/inc/config.php";
	
	include dirname(__FILE__)."/pdo/FluentPDO.php";	
	
	$config = new Config();
	$atributosDeConexao = $config->AtributosConfig();

	$aParametros = array();
	$aParametros['host'] = $atributosDeConexao["banco"]["local"]["host"];
	$aParametros['user'] = $atributosDeConexao["banco"]["local"]["user"];
	$aParametros['passwd'] = $atributosDeConexao["banco"]["local"]["senha"];
	$aParametros['DBType'] = $atributosDeConexao["banco"]["local"]["type"];
	$aParametros['port'] = $atributosDeConexao["banco"]["local"]["port"];
	$aParametros['dbName'] = $atributosDeConexao["banco"]["local"]["banco"];
	 
	$pdo = new PDO($aParametros['DBType'].":host=".$aParametros['host'].";port=".$aParametros['port'].";dbname=".$aParametros['dbName'], $aParametros['user'],$aParametros['passwd']);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	$pdo->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
	$pdo->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
	$sqlGl = new FluentPDO($pdo);