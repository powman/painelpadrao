<!-- Main content wrapper -->
<div class="wrapper">

    <!-- Dynamic table -->
    <div class="widget">
        <div class="title"><img src="images/icons/dark/full2.png" alt="" class="titleIcon" /><h6>Emails</h6></div>                          
        <table cellpadding="0" cellspacing="0" border="0" class="display dTable">
        <thead>
        <tr>
            <th>Usuário</th>
            <th>Domínio</th>
            <th>Login</th>
            <th>Espaço em Disco</th>
            <th>Espaço em Disco Usado</th>
            <th>Ação</th>
        </tr>
        </thead>
        <tbody>
        <?php for($i=0;$i<count($aEmails["data"]);$i++):?>
        <tr class="gradeA odd">
            <td class="center">
                <?php echo $aEmails["data"][$i]['user'];?>
            </td>
            <td class="center">
                <?php echo $aEmails["data"][$i]['domain'];?>
            </td>
            <td class="center">
                <?php echo $aEmails["data"][$i]['login'];?>
            </td>
            <td class="center">
                <?php echo $aEmails["data"][$i]['humandiskquota'];?>
            </td>
            <td class="center">
                <?php echo $aEmails["data"][$i]['humandiskused'];?>
            </td>
            <td class="center">
                <a class="tipS" href="index.php?acao=alterar-email&ctrl=cpanel&user=<?php echo $aEmails["data"][$i]['user'];?>" original-title="Editar">
                    <img alt="" src="images/icons/control/16/pencil.png">
                </a>
                <a class="tipS"  href="javascript:;" onclick="confirmDelGeral('index.php?acao=deletar-email&ctrl=cpanel&email=<?php echo $aEmails["data"][$i]['user'];?>','index.php?acao=listar-emails&ctrl=cpanel');" original-title="Excluir">
                    <img alt="" src="images/icons/control/16/clear.png">
                </a>
                <a class="tipS"  href="http://www.<?php echo $conf["whm"]['dominioCpanelCliente'];?>/webmail" target="_blank" original-title="Acessar Email">
                    <img alt="" src="images/icons/control/16/email.png">
                </a>
            </td>
        </tr>
        <?php endfor;?>
        </tbody>
        </table>  
    </div>

</div>