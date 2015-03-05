<?php

//Informações do Formalário
$nomedoformulario = 'Alterar Equipe';
$acaodoformulario = 'index.php?acao=alterar&ctrl=equipe';
$avisodoformulario = 'Esta página você altera a equipe do site.';

//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario, $acaodoformulario, $avisodoformulario);

//Cria um input text
$objForm->sk_formText('Nome', 'nome', '', true, 'Aqui você escreve o nome do funcionario.',$equipeForm->nome);

//Cria um input text Email
$objForm->sk_formTextEmail('Email', 'email', '', false, 'Aqui você escreve um email do funcionario.',$equipeForm->email);

//Cria um input text Email
$objForm->sk_formText('Cargo', 'cargo', '', true, 'Aqui você escreve o cargo do funcionário.',$equipeForm->cargo);

$objForm->sk_formFile("Imagem", 'imagem', false, 'Aqui voce coloca a imagem do funcionario.',$equipeForm->imagem);

//Cria um input hidden
$objForm->sk_formHidden('id',$equipeForm->id);

//Cria um input hidden
$objForm->sk_formHidden('imgAntiga',$equipeForm->imagem);

//Verfica se o usuário e Administrador
if ($permissao->alterar == 1) {
	//Cria um input submit
	$objForm->sk_formSubmit();
}

//Final do Formulário
$objForm->sk_fimDoFormulario();

?>