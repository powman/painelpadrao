<?php


//Informações do Formalário
$nomedoformulario = 'Cadastrar Email';
$acaodoformulario = 'index.php?acao=cadastrar-email&ctrl=cpanel';
$avisodoformulario = 'Esta página você cadastra os email para a sua hospedagem.';

//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

$objForm->sk_formTextSliderByte('Espaço em Disco','quota',50,900,50);

$objForm->sk_formTextEmail('Email','email','255',true,'Aqui você escolhe um email válido para cadastro.',"@".$conf["whm"]['dominioCpanelCliente']);

$objForm->sk_formTextPassword('Senha','senha','255',true,'Aqui você escreve a senha do email.');

//Verfica se o usuário e Administrador
if($objSession2->get('tlAdmLoginNivel') == 1){
    //Cria um input submit
    $objForm->sk_formSubmit();
}

//Final do Formulário
$objForm->sk_fimDoFormulario();

?>