    
<?php


//Informações do Formalário
$nomedoformulario = 'Alterar Banner';
$acaodoformulario = 'index.php?acao=alterar&ctrl=banner';
$avisodoformulario = 'Esta página você altera o banner cadastrado.';


//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

//Cria um input text
$objForm->sk_formText('Titulo','titulo','',true,'Aqui você um titulo para o banner.',$bannerForm->titulo);

//Cria um input text
$objForm->sk_formTextUrl('Link','url','',false,'Aqui você escolhe um link para o banner.',$bannerForm->url);

$objForm->sk_formFile("Imagem",'imagem',false,'Tamanho 1110px x 200px',$bannerForm->imagem);

//Cria um input hidden
$objForm->sk_formHidden('id',$bannerForm->id);

//Cria um input hidden
$objForm->sk_formHidden('imgAntiga',$bannerForm->imagem);

//Verfica se o usuário e Administrador
if($permissao->alterar == 1){
    //Cria um input submit
    $objForm->sk_formSubmit();
}

//Final do Formulário
$objForm->sk_fimDoFormulario();

?>