<?php

//Informações do Formalário
$nomedoformulario = 'Cadastrar Serviço';
$acaodoformulario = 'index.php?acao=cadastrar&ctrl=servico';
$avisodoformulario = 'Esta página você cadastra os serviços do site.';

//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario, $acaodoformulario, $avisodoformulario);

//Cria um input text
$objForm->sk_formText('Serviço', 'nome', '', true, 'Aqui você escreve o nome do serviço.');

//Verfica se o usuário e Administrador
if ($permissao->cadastrar == 1) {
	//Cria um input submit
	$objForm->sk_formSubmit();
}

//Final do Formulário
$objForm->sk_fimDoFormulario();

?>