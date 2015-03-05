<?php


//Informações do Formalário
$nomedoformulario = 'Cadastrar Banners';
$acaodoformulario = 'index.php?acao=cadastrar&ctrl=banner';
$avisodoformulario = 'Esta página você cadastra os banners.';

//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

//Cria um input text
$objForm->sk_formText('Título','titulo','',true,'Aqui você um titulo para o banner.');

//Cria um input text
$objForm->sk_formTextUrl('Link','url','',false,'Aqui você escolhe um link para o banner.');

$objForm->sk_formFile("Imagem",'imagem',true,'Tamanho 1110px x 200px');

//Verfica se o usuário e Administrador
if($permissao->cadastrar == 1){
    //Cria um input submit
    $objForm->sk_formSubmit();
}

//Final do Formulário
$objForm->sk_fimDoFormulario();

?>