<?php


//Informações do Formalário
$nomedoformulario = 'Cadastrar Email';
$acaodoformulario = 'index.php?acao=cadastrar-email&ctrl=cpanel';
$avisodoformulario = 'Esta página você cadastra os email para a sua hospedagem.';

//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

//Cria as opção do Select
$options = array(
    0 => '<option value="Fale Conosco">Fale Conosco</option>'
);

//Cria um input text Email
$objForm->sk_formText('Email','email','',true,'Aqui você escolhe um email válido para o recebimento.');

//Cria um input text Email
$objForm->sk_formTextPassword('Senha','senha','255',true,'Aqui você escolhe um email válido para o recebimento.');

//Verfica se o usuário e Administrador
if($objSession2->get('tlAdmLoginNivel') == 1){
    //Cria um input submit
    $objForm->sk_formSubmit();
}

//Final do Formulário
$objForm->sk_fimDoFormulario();

?>