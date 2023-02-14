<!-- Main content wrapper -->
<div class="wrapper">

    <!-- Dynamic table -->
    <div class="widget">
        <div class="title"><img src="images/icons/dark/fullscreen.png" alt="" class="titleIcon" />
            <h6>Listar Usuários</h6>
        </div>
        <table cellpadding="0" cellspacing="0" border="0" class="display withCheck dTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOME</th>
                    <th>EMAIL</th>
                    <th>AÇÃO</th>
                </tr>
            </thead>
            <tbody>
                <?
                for ($i = 0; $i < $usuarios["num"]; $i++) {

                ?>
                    <tr class="gradeA">
                        <td align="center">
                            <?php echo $usuarios[$i]->id; ?>
                        </td>
                        <td align="center">
                            <?php echo $usuarios[$i]->nome; ?>
                        </td>
                        <td align="center">
                            <?php echo $usuarios[$i]->email; ?>
                        </td>
                        <td class="actBtns">
                            <?
                            if ($usuarios[$i]->id != 1 && $objSession2->get('tlAdmLoginId') == $usuarios[$i]->id || $objSession2->get('tlAdmLoginId') == 1) {
                                if ($permissao->alterar == "1") {
                            ?>
                                    <a href="index.php?acao=frmAltUsuario&ctrl=usuarios&id=<?php echo $usuarios[$i]->id ?>" title="Editar" class="tipS">
                                        <img src="images/icons/control/16/pencil.png" alt="" />
                                    </a>
                            <?

                                }
                            }

                            ?>
                            <?
                            if ($usuarios[$i]->id != 1 && $objSession2->get('tlAdmLoginId') == $usuarios[$i]->id || $objSession2->get('tlAdmLoginId') == 1) {
                                if ($permissao->excluir == "1") {
                            ?>
                                    <a style="display:<?php echo $objSession2->get('tlAdmLoginId') == 1 && $objSession2->get('tlAdmLoginId') == $usuarios[$i]->id ? "none" : "" ?>;" href="javascript:;" title="Excluir" onclick="confirmDelGeral('index.php?acao=deletarUsuario&ctrl=usuarios&id=<?php echo $usuarios[$i]->id; ?>','index.php?acao=listaUsuarios&ctrl=usuarios');" class="tipS">
                                        <img src="images/icons/control/16/clear.png" alt="" />
                                    </a>
                            <?

                                }
                            }

                            ?>

                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</div>