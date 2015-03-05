
<?php

//Informações do Formalário
$nomedoformulario = 'Alterar Serviço';
$acaodoformulario = 'index.php?acao=alterar&ctrl=servico';
$avisodoformulario = 'Esta página você altera os serviços cadastrados.';

//Inicia o Formulário
$objForm->sk_iniciaFormulario($nomedoformulario, $acaodoformulario, $avisodoformulario);

//Cria um input text
$objForm->sk_formText('Serviço', 'nome', '', true, 'Aqui você escreve o nome do serviço..', $servicoForm->nome);

//Cria um input hidden
$objForm->sk_formHidden('id', $servicoForm->id);

//Verfica se o usuário e Administrador
if ($permissao->alterar == 1) {
	//Cria um input submit
	$objForm->sk_formSubmit();
}

//Final do Formulário
$objForm->sk_fimDoFormulario();

?>