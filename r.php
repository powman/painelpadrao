<?php
//ini_set("memory_limit","1000M");

//classe de conexão
include_once "sistemas/classes/class.conexao.php";

//classe de abstração de banco de dados
include_once "sistemas/classes/class.db.php";
$sqlGl = new gl_DB();

//classe que possui algumas funções utéis(Ex.: Conversão de datas, moedas, etc.)
include_once "sistemas/geral/classes/class.uteis.php";
$objUteis = new Uteis();

//inclui a classe de newsletters e estância um objeto
include_once "sistemas/geral/newsletter/classes/class.newsletter.php";
$objNews = new Newsletter();

//incluindo arquivos utilizado nos graficos
include_once("sistemas/geral/newsletter/graficos/charts.php");

if(isset($_GET["b"])){
    $objNews->confirmClick(base64_decode(urldecode($_GET["b"])));
}

if($_GET["a"]!="") {
    header("Location: ".base64_decode(urldecode($_GET["a"])));
} else exit();

?>