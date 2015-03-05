<?php


//Informações do Formalário
$nomedoformulario = 'Cadastrar Categorias';
$acaodoformulario = 'index.php?acao=cadastrar&ctrl=categoria';
$avisodoformulario = 'Esta página você cadastra as categoria.';

//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

//Cria um input text
$objForm->sk_formText('Categoria','nome','',true,'Aqui você um titulo para o categoria.');

//Verfica se o usuário e Administrador
if($permissao->cadastrar == 1){
    //Cria um input submit
    $objForm->sk_formSubmit();
}

//Final do Formulário
$objForm->sk_fimDoFormulario();

?>