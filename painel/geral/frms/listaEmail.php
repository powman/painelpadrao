<div>
     <a href="index.php?acao=criar_csv&ctrl=email" title="" class="button greyishB" style="margin: 40px 5px 5px 0px;"><span>EXPORTAR CSV</span></a>
</div>
<?php
//Dados da Tabela
$dadosDaTabela = array(
    0 => 'ID',
    1 => 'NOME',
	2 => 'EMAIL'
);

//Campos para puxar na listagem
$campos = array(
    0 => 'id',
    1 => 'nome',
	2 => 'email'
		
);

$publicar = 0;
$alterar = 0;
$excluir = 0;

/**
 * Verifica a permissÃ£o do usuÃ¡rio
 */
if($permissao->publicar=="1"){
    $publicar = 1;
}
if($permissao->alterar=="1"){
    $alterar = 1;
}
if($permissao->excluir=="1"){
    $excluir = 1;
}

//Inicia a listagem do formulário
$objForm->sk_formListar('Emails',$dadosDaTabela,$emails,$campos,'email',$publicar,$alterar,$excluir);

?>
 