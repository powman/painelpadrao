    
<?php


//Informações do Formalário
$nomedoformulario = 'Alterar Configuração de formulário';
$acaodoformulario = 'index.php?acao=alterar&ctrl=configuracoes';
$avisodoformulario = 'Esta página você cadastra os emails das pessoas que vão receber os dados do formulário das páginas cadastradas.';


//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

//Cria as opção do Select
$faleConosco = $configuracaoForm->tipo == "Fale Conosco" ? "selected='selected'" : "";
$options = array(
    0 => '<option value="Fale Conosco" '.$faleConosco.'>Fale Conosco</option>'
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
$objForm->sk_formText('Nome','nome','',true,'Aqui você escolhe um nome para o usuário que vai receber o email da página.',$configuracaoForm->nome);

//Cria um input text Email
$objForm->sk_formTextEmail('Email','email','',true,'Aqui você escolhe um email válido para o recebimento.',$configuracaoForm->email);

//Cria um input hidden
$objForm->sk_formHidden('id',$configuracaoForm->id);

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