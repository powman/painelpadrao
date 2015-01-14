<?php


//Informações do Formalário
$nomedoformulario = 'Alterar Email';
$acaodoformulario = 'index.php?acao=altera-email&ctrl=cpanel';
$avisodoformulario = 'Esta página você altera as cota do email.';

//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

$objForm->sk_formTextSliderByte('Espaço em Disco','quota',50,900,50,$aEmails['data']['diskquota']);

$objForm->sk_formHidden('email',$aEmails['data']['user']);

$objForm->sk_formTextPassword('Senha','senha','255',false,'Aqui você escreve a senha do email, Letras e números, não pode ser sequencial','',8);

//Verfica se o usuário e Administrador
if($objSession2->get('tlAdmLoginNivel') == 1){
    //Cria um input submit
    $objForm->sk_formSubmit();
}

//Final do Formulário
$objForm->sk_fimDoFormulario();

?>