<?php


//Informações do Formalário
$nomedoformulario = 'Cadastrar Clientes';
$acaodoformulario = 'index.php?acao=cadastrar&ctrl=cliente';
$avisodoformulario = 'Esta página você cadastra os clientes.';

//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

//Cria um input text
$objForm->sk_formText('Nome','nome','',true,'Aqui você um titulo para o cliente.');

//Cria um input text
$objForm->sk_formTextUrl('Link','url','',false,'Aqui você escolhe um link para o cliente.');

$objForm->sk_formFile("Imagem",'imagem',false,'Tamanho 600px x 400px');

//Verfica se o usuário e Administrador
if($permissao->cadastrar == 1){
    //Cria um input submit
    $objForm->sk_formSubmit();
}

//Final do Formulário
$objForm->sk_fimDoFormulario();

?>