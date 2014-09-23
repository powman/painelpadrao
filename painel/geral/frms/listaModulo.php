<?php
/**
 * Dados da Tabela
 */
$dadosDaTabela = array(
    0 => 'ID',
    1 => 'TÍTULO',
    2 => 'CTRL',
    3 => 'IMG',
    4 => 'MENU'
);

for($i=0;$i<$modulos["num"];$i++){
  $menus = $objModulo->listarMenusBySecao($modulos[$i]->id);
  $objUteis->encode($menus);
  $modulos[$i]->img = "<img src='".$modulos[$i]->img."'/>"; 
  $modulos[$i]->menus = '';
  for($j=0;$j<$menus["num"];$j++){
  	 
     $separador = $j == $menus["num"] -1 ? "" : " - ";
     $modulos[$i]->menus .= $menus[$j]->titulo.$separador;  
  }
     
}

/**
 * Campos para puxar na listagem
 */
$campos = array(
    0 => 'id',
    1 => 'menu',
    2 => 'ctrl',
    3 => 'img',
    4 => 'menus'
);

/**
 * Verifica a permissão do usuário
 */
if($objSession2->get('tlAdmLoginNivel') == 1){
    $publicar = 0;
    $alterar = 1;
    $excluir = 1;
}else{
    $publicar = 0;
    $alterar = 0;
    $excluir = 0;
}

/**
 * Inicia a listagem do formulário
 */
$objForm->sk_formListar('Módulos',$dadosDaTabela,$modulos,$campos,'modulo',$publicar,$alterar,$excluir,'','index.php?acao=alterarOrdem&ctrl=modulo');

?>
 