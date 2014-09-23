<?php


//Informações do Formalário
$nomedoformulario = 'Cadastrar Configuração de formulário';
$acaodoformulario = 'index.php?acao=cadastrar&ctrl=configuracoes';
$avisodoformulario = 'Esta página você cadastra os emails das pessoas que vão receber os dados do formulário das páginas cadastradas.';

//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

//Cria as opção do Select
$options = array(
    0 => '<option value="Fale Conosco">Fale Conosco</option>'
);

//Inicia o Wizard
$objForm->sk_inicioWizard('Página de recebimento do formulário');

//Cria um Select input
$objForm->sk_formSelect('Página','tipo',$options,true,"Aqui você escolhe um nome para o usuário que vai receber o email da página.");

//Fim do Wizard
$objForm->sk_fimWizard();

//Cria um Wizard
$objForm->sk_inicioWizard('Dados da pessoa');

//Cria um input text
$objForm->sk_formText('Nome','nome','',true,'Aqui você escolhe um nome para o usuário que vai receber o email da página.');

//Cria um input text Email
$objForm->sk_formTextEmail('Email','email','',true,'Aqui você escolhe um email válido para o recebimento.');

//Verfica se o usuário e Administrador
if($objSession2->get('tlAdmLoginNivel') == 1){
    //Cria um input submit
    $objForm->sk_formSubmit();
}

//Final do Wizard
$objForm->sk_fimWizard();

//Final do Formulário
$objForm->sk_fimDoFormulario();

?>