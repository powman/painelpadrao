<?php

//Informações do Formalário
$nomedoformulario = 'Cadastrar Equipe';
$acaodoformulario = 'index.php?acao=cadastrar&ctrl=equipe';
$avisodoformulario = 'Esta página você cadastra a equipe do site.';

//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario, $acaodoformulario, $avisodoformulario);

//Cria um input text
$objForm->sk_formText('Nome', 'nome', '', true, 'Aqui você escreve o nome do funcionario.');

//Cria um input text Email
$objForm->sk_formTextEmail('Email', 'email', '', false, 'Aqui você escreve um email do funcionario.');

//Cria um input text Email
$objForm->sk_formText('Cargo', 'cargo', '', true, 'Aqui você escreve o cargo do funcionário.');

$objForm->sk_formFile("Imagem", 'imagem', true, 'Aqui voce coloca a imagem do funcionario.');

//Verfica se o usuário e Administrador
if ($permissao->cadastrar == 1) {
	//Cria um input submit
	$objForm->sk_formSubmit();
}

//Final do Formulário
$objForm->sk_fimDoFormulario();

?>