    
<?php


//Informações do Formalário
$nomedoformulario = 'Alterar Empresa';
$acaodoformulario = 'index.php?acao=alterar&ctrl=empresa';
$avisodoformulario = 'Esta página você altera os empresa cadastrado';


//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

//Cria um input text
$objForm->sk_formText('Título','titulo','',true,'Aqui você coloca um título para o Serviços.',$empresaForm->titulo);

$objForm->sk_formFile('Imagem','img',true,'Aqui você coloca a imagem principal.',$empresaForm->img,'index.php?acao=deletarImg&ctrl=empresa&id='.$empresaForm->id,'index.php?acao=frmAlterar&ctrl=empresa&id='.$empresaForm->id);

$objForm->sk_formTextHTML('Texto','texto',false,'Texto do Serviços.',$empresaForm->texto);

//Cria um input hidden
$objForm->sk_formHidden('id',$empresaForm->id);


//Verfica se o usuário e Administrador
if($permissao->alterar == 1){
    //Cria um input submit
    $objForm->sk_formSubmit();
}

//Final do Formulário
$objForm->sk_fimDoFormulario();

?>