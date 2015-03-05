    
<?php


//Informações do Formalário
$nomedoformulario = 'Alterar Cliente';
$acaodoformulario = 'index.php?acao=alterar&ctrl=cliente';
$avisodoformulario = 'Esta página você altera o cliente cadastrado.';


//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

//Cria um input text
$objForm->sk_formText('Nome','nome','',true,'Aqui você um titulo para o cliente.',$clienteForm->nome);

//Cria um input text
$objForm->sk_formTextUrl('Link','url','',false,'Aqui você escolhe um link para o cliente.',$clienteForm->url);

$objForm->sk_formFile("Imagem",'imagem',false,'Tamanho 600px x 400px',$clienteForm->imagem);

//Cria um input hidden
$objForm->sk_formHidden('id',$clienteForm->id);

//Cria um input hidden
$objForm->sk_formHidden('imgAntiga',$clienteForm->imagem);

//Verfica se o usuário e Administrador
if($permissao->alterar == 1){
    //Cria um input submit
    $objForm->sk_formSubmit();
}

//Final do Formulário
$objForm->sk_fimDoFormulario();

?>