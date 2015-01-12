<?php


//Informações do Formalário
$nomedoformulario = 'Cadastrar Ftp';
$acaodoformulario = 'index.php?acao=cadastrar-ftp&ctrl=cpanel';
$avisodoformulario = 'Esta página você cadastra os ftp para a sua hospedagem.';

//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

$objForm->sk_formTextSliderByte('Espaço em Disco','quota',50,5000,50);

$objForm->sk_formText('Usuário','user','255',true,'Aqui você escolhe o caminho da pasta ftp, padrão public_html.');

$objForm->sk_formTags('Diretório','dir','255',true,'Aqui você escolhe o caminho da pasta.');

$objForm->sk_formTextPassword('Senha','senha','255',true,'Aqui você escreve a senha do email.');

//Verfica se o usuário e Administrador
if($objSession2->get('tlAdmLoginNivel') == 1){
    //Cria um input submit
    $objForm->sk_formSubmit();
}

//Final do Formulário
$objForm->sk_fimDoFormulario();

?>