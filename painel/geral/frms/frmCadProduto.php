<?php


//Informações do Formalário
$nomedoformulario = 'Cadastrar Produto';
$acaodoformulario = 'index.php?acao=cadastrar&ctrl=produto';
$avisodoformulario = 'Esta página você cadastra os produtos.';

//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

$objForm->sk_inicioWizard('Dados do produto');


$objForm->sk_formCheckbox('Destaque','destaque',false,false,'Aqui você escolhe se o produto e destaque na página principal.',1);
$options = array();

for($i=0;$i<$categorias["num"];$i++){
	$options[] = '<option value="'.$categorias[$i]->id.'">'.$categorias[$i]->nome.'</option>';
}
/**
 * Cria um input text
 */
$objForm->sk_formSelect('Selecione uma categoria','categoria_id',$options,true,'Aqui você escolhe uma categoria para o produto.');

//Cria um input text
$objForm->sk_formText('Nome','nome','',true,'Aqui você um nome para o produto.');

$objForm->sk_formFile("Imagem",'imagem',true,'Imagem Principal');

$objForm->sk_formTextUrl('Vídeo Youtube','video','',false,'Aqui você escolhe o vídeo do produto com o link do youtube.');

$objForm->sk_formTextHTML('Descrição','texto',false,'Descrição da produto.');

$objForm->sk_fimWizard();

$objForm->sk_inicioWizard('Fotos');

$objForm->sk_montaMultUploadGaleria('','index.php?acao=cadastraFoto&ctrl=produto','','','uploadergaleria','jpg,gif,png','Apenas imagens',800,600,100);

//Verfica se o usuário e Administrador
if($permissao->cadastrar == 1){
    //Cria um input submit
    $objForm->sk_formSubmit();
}

$objForm->sk_fimWizard();

//Final do Formulário
$objForm->sk_fimDoFormulario();

?>