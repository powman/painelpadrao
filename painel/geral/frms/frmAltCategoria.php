    
<?php


//Informações do Formalário
$nomedoformulario = 'Alterar Categoria';
$acaodoformulario = 'index.php?acao=alterar&ctrl=categoria';
$avisodoformulario = 'Esta página você altera as categoria cadastrada';

//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

//Cria um input text
$objForm->sk_formText('Categoria','nome','',true,'Aqui você um titulo para o categoria.',$categoriaForm->nome);


//Cria um input hidden
$objForm->sk_formHidden('id',$categoriaForm->id);

//Verfica se o usuário e Administrador
if($permissao->alterar == 1){
    //Cria um input submit
    $objForm->sk_formSubmit();
}

//Final do Formulário
$objForm->sk_fimDoFormulario();

?>