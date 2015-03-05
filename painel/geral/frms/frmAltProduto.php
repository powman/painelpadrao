    
<?php


//Informações do Formalário
$nomedoformulario = 'Alterar Produto';
$acaodoformulario = 'index.php?acao=alterar&ctrl=produto';
$avisodoformulario = 'Esta página você altera o produto cadastrado.';

$options = array();

for($i=0;$i<$categorias["num"];$i++){
	$options[] = '<option '.($categorias[$i]->id == $produtoForm->categoria_id ? "selected='selected'" : "").' value="'.$categorias[$i]->id.'">'.$categorias[$i]->nome.'</option>';
}

//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

$objForm->sk_inicioWizard('Dados do produto');

$objForm->sk_formCheckbox('Destaque','destaque',($produtoForm->destaque ? true : false),false,'Aqui você escolhe se o produto e destaque na página principal.',1);

$objForm->sk_formSelect('Selecione uma categoria','categoria_id',$options,true,'Aqui você escolhe uma categoria para o produto.',true);

//Cria um input text
$objForm->sk_formText('Nome','nome','',true,'Aqui você o nome do produto.',$produtoForm->nome);

$objForm->sk_formFile("Imagem",'imagem',false,'Imagem principal',$produtoForm->imagem);

$objForm->sk_formTextUrl('Vídeo Youtube','video','',false,'Aqui você escolhe o vídeo do produto com o link do youtube.',$produtoForm->video);

$objForm->sk_formTextHTML('Descrição','texto',false,'Descrição da produto.',$produtoForm->texto);

$objForm->sk_fimWizard();

$objForm->sk_inicioWizard('Fotos');

$objForm->sk_montaMultUploadGaleria($produtoForm->id,'index.php?acao=cadastraFoto&ctrl=produto',$produtoForm->fotos,'index.php?acao=deletarFoto&ctrl=produto');

//Cria um input hidden
$objForm->sk_formHidden('id',$produtoForm->id);

//Cria um input hidden
$objForm->sk_formHidden('imgAntiga',$produtoForm->imagem);

//Verfica se o usuário e Administrador
if($permissao->alterar == 1){
    //Cria um input submit
    $objForm->sk_formSubmit();
}

$objForm->sk_fimWizard();

//Final do Formulário
$objForm->sk_fimDoFormulario();

?>