
<?php
//Dados da Tabela
$dadosDaTabela = array(
	0 => 'ID',
	1 => 'NOME',
	2 => 'EMAIL',
	3 => 'CARGO',
);

//Campos para puxar na listagem
$campos = array(
	0 => 'id',
	1 => 'nome',
	2 => 'email',
	3 => 'cargo',

);

$publicar = 0;
$alterar = 0;
$excluir = 0;

/**
 * Verifica a permissÃ£o do usuÃ¡rio
 */
if ($permissao->publicar == "1") {
	$publicar = 1;
}
if ($permissao->alterar == "1") {
	$alterar = 1;
}
if ($permissao->excluir == "1") {
	$excluir = 1;
}

//Inicia a listagem do formulário
$objForm->sk_formListar('Serviços', $dadosDaTabela, $equipes, $campos, 'equipe', $publicar, $alterar, $excluir);

?>
