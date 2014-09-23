<?/*<div id="geral_ls_log" align="center">
    <div id="respostalsLog" class="resposta"></div>
    <table width="97%" cellpadding="0" cellspacing="0" class="lista_tabela">
    	<tr class="lista_titulo">
        	<td colspan="6">Logs</td>
      	</tr>
        <tr>
                <td class="lista_subTit">USU&Aacute;RIO</td>
                <td class="lista_subTit">A&Ccedil;&Atilde;O</td>
                <td class="lista_subTit">&Aacute;REA</td>
                <td class="lista_subTit">ID</td>
                <td class="lista_subTit">IP</td>
                <td class="lista_subTit">DATA</td>
            </tr>
		<!-- INI - LISTAGEM DOS LOGS CADASTRADOS -->
		<?
			for($i=0;$i<$logs["num"];$i++){
                if($i%2==0){
                    $bg = "lista_linha";
                }else{
                    $bg = "lista_linha2";
                }
		?>
        <tr class="<?=$bg;?>">
            <td><?=utf8_encode($logs[$i]->usuario);?></td>
            <td><?=utf8_encode($logs[$i]->acao);?></td>
            <td><?=utf8_encode($logs[$i]->area);?></td>
            <td><?=$logs[$i]->id_area;?></td>
            <td><?=$logs[$i]->ip;?></td>
            <td><? $data = $objUteis->dataHora($logs[$i]->datahora); echo $data["data"]." &agrave;s ".$data["hora"];?></td>
        </tr>
		<?
            }
		?>
		<!-- FIM - LISTAGEM DOS LOGS CADASTRADOS -->
    </table>
</div>
<div class="lista_cont"><?=$logs["num"];?> resultados</div>
 *
 * >
 
<div style="padding-bottom:20px; padding-top:20px;">
        <table cellpadding="5" cellspacing="8">
            <tr>
                <td align="left"><b>Nome do Usu&aacute;rio:</b></td>
                <td align="left"> &emsp;<?=utf8_encode($_SESSION['i9s']['tlAdmLoginNome']);?></td>
            </tr>
            <tr>
                <td align="left"><b>Login do Usu&aacute;rio:</b></td>
                <td align="left"> &emsp;<?=utf8_encode($_SESSION['i9s']['tlAdmLoginUsuario']);?></td>
            </tr>
            <tr>
                <td align="left"><b>Endere&ccedil;o IP:</b></td>
                <td align="left"> &emsp;<?=$_SERVER['REMOTE_ADDR'];?></td>
            </tr>
            <tr>
                <td align="left"><b>Data/Hora Atual:</b></td>
                <td align="left"> &emsp;<?=date("d/m/Y")." &agrave;s ".date("H:i:s");?></td>
            </tr>
        </table>
</div>
        <form name="formListar" id="formListar" method="post" action="">
            <div class="title" style="padding-bottom:20px;">
                <h6>Logs</h6>
            </div>
            <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
                <thead>
                    <tr>
                        <td width="*">USU&Aacute;RIO</td>
                        <td width="*">A&Ccedil;&Atilde;O</td>
                        <td width="*">&Aacute;REA</td>
                        <td width="*">ID</td>
                        <td width="*">IP</td>
                        <td width="*">DATA</td>
                    </tr>
                </thead>
                <tbody>
                    <?
			for($i=0;$i<$logs["num"];$i++){

                    ?>
                    <tr>
                        <td align="center">
                            <?=$logs[$i]->usuario;?>
                        </td>
                        <td align="center">
                             <?=$logs[$i]->acao;?>
                        </td>
                        <td align="center">
                             <?=$logs[$i]->area;?>
                        </td>
                        <td align="center">
                             <?=$logs[$i]->id_area;?>
                        </td>
                        <td align="center">
                             <?=$logs[$i]->ip;?>
                        </td>
                        <td align="center">
                             <? $data = $objUteis->dataHora($logs[$i]->datahora); echo $data["data"]." &agrave;s ".$data["hora"];?>
                        </td>
                    </tr>
                    <?}?>
                </tbody>
            </table>
        </form>

*/
?>
    <!-- Main content wrapper -->
<div class="wrapper">

    <!-- Dynamic table -->
    <div class="widget">
        <div class="title"><img src="images/icons/dark/fullscreen.png" alt="" class="titleIcon" /><h6>Listar Logs</h6></div>
        <table cellpadding="0" cellspacing="0" border="0" class="display withCheck dTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>USU&Aacute;RIO</th>
                    <th>A&Ccedil;&Atilde;O</th>
                    <th>&Aacute;REA</th>
                    <th>ID</th>
                    <th>IP</th>
                    <th>DATA</th>
                </tr>
            </thead>
            <tbody>
                <?
			for($i=0;$i<$logs['num'];$i++){
                                if($logs[$i]->usuario == "Administrador"){
                            continue;
                          }
                    ?>
                <tr class="gradeA">
                    <td align="center">
                            <?=$logs[$i]->id;?>
                    </td>
                    <td align="center">
                            <?=$logs[$i]->usuario;?>
                    </td>
                    <td align="center">
                            <?=$logs[$i]->acao;?>
                    </td>
                    <td align="center">
                            <?=$logs[$i]->area;?>
                    </td>
                    <td align="center">
                            <?=$logs[$i]->id_area;?>
                    </td>
                    <td align="center">
                            <?=$logs[$i]->ip;?>
                    </td>
                    <td align="center">
                            <? $data = $objUteis->dataHora($logs[$i]->datahora); echo $data["data"]." &agrave;s ".$data["hora"];?>
                    </td>
                </tr>
                <?}?>
            </tbody>
        </table>
    </div>

</div>