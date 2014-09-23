<?php
//Dados da Tabela
$dadosDaTabela = array(
    0 => 'ID',
    1 => 'PÁGINA',
    2 => 'NOME',
    3 => 'E-MAIL'
);

//Campos para puxar na listagem
$campos = array(
    0 => 'id',
    1 => 'tipo',
    2 => 'nome',
    3 => 'email'
);

//Verifica a permissão do usuário
if($objSession2->get('tlAdmLoginNivel') == 1){
    $publicar = 1;
    $alterar = 1;
    $excluir = 1;
}else{
    $publicar = 0;
    $alterar = 0;
    $excluir = 0;
}

//Inicia a listagem do formulário
$objForm->sk_formListar('E-mails de Recebimento de Contato',$dadosDaTabela,$configuracaos,$campos,'configuracoes',$publicar,$alterar,$excluir);

?>
 