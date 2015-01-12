<?php


//Informações do Formalário
$nomedoformulario = 'Alterar Ftp';
$acaodoformulario = 'index.php?acao=altera-ftp&ctrl=cpanel';
$avisodoformulario = 'Esta página você altera as cota do ftp.';

//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

if($aFtpsAtual['login'] != $conf["whm"]['userCpanelCliente'])
$objForm->sk_formTextSliderByte('Espaço em Disco','quota',50,5000,50,$aFtpsAtual['diskquota']);

$objForm->sk_formHidden('user',$aFtpsAtual['login']);

if($aFtpsAtual['login'] != $conf["whm"]['userCpanelCliente'])
$objForm->sk_formTextPassword('Senha','senha','255',false,'Aqui você escreve a senha do ftp.');

//Verfica se o usuário e Administrador
if($objSession2->get('tlAdmLoginNivel') == 1){
    //Cria um input submit
    $objForm->sk_formSubmit();
}

//Final do Formulário
$objForm->sk_fimDoFormulario();

?>