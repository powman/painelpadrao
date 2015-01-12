<!-- Main content wrapper -->
<div class="wrapper">

    <!-- Dynamic table -->
    <div class="widget">
        <div class="title"><img src="images/icons/dark/full2.png" alt="" class="titleIcon" /><h6>FTP</h6></div>                          
        <table cellpadding="0" cellspacing="0" border="0" class="display dTable">
        <thead>
        <tr>
            <th>Ftp</th>
            <th>Login</th>
            <th>Espaço em Disco</th>
            <th>Espaço em Disco Usado</th>
            <th>Diretório</th>
            <th>Pode deletar?</th>
            <th>Ação</th>
        </tr>
        </thead>
        <tbody>
        <?php for($i=0;$i<count($aFtps["data"]);$i++):
        $aDadosValues = array('anonymous','fest_logs','ftp');
        if(!in_array($aFtps["data"][$i]['login'],$aDadosValues)){
        ?>
        <tr class="gradeA odd">
            <td class="center">
                <?php echo 'ftp.'.$conf["whm"]['dominioCpanelCliente'];?>
            </td>
            <td class="center">
                <?php echo $aFtps["data"][$i]['serverlogin'];?>
            </td>
            <td class="center">
                <?php echo $aFtps["data"][$i]['humandiskquota'];?>
            </td>
            <td class="center">
                <?php echo $aFtps["data"][$i]['humandiskused'];?>
            </td>
            <td class="center">
                <?php echo is_array($aFtps["data"][$i]['reldir']) ? $aFtps["data"][$i]['dir'] : $aFtps["data"][$i]['reldir'];?>
            </td>
            <td class="center">
                <?php echo $aFtps["data"][$i]['deleteable'] ? '<img alt="" src="images/icons/control/16/check.png">' : '<img alt="" src="images/icons/control/16/clear.png">';?>
            </td>
            <td class="center">
                <?php if($aFtps["data"][$i]['login'] != $conf["whm"]['userCpanelCliente']){?>
                <a class="tipS" href="index.php?acao=alterar-ftp&ctrl=cpanel&user=<?php echo $aFtps["data"][$i]['login'];?>" original-title="Editar">
                    <img alt="" src="images/icons/control/16/pencil.png">
                </a>
                
                <a class="tipS"  href="javascript:;" onclick="confirmDelGeral('index.php?acao=deletar-ftp&ctrl=cpanel&user=<?php echo $aFtps["data"][$i]['login'];?>','index.php?acao=listar-ftp&ctrl=cpanel');" original-title="Excluir">
                    <img alt="" src="images/icons/control/16/clear.png">
                </a>
                <?php }?>
            </td>
        </tr>
        <?php 
        }
        endfor;
        ?>
        </tbody>
        </table>  
    </div>

</div>