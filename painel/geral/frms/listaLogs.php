<!-- Main content wrapper -->
<div class="wrapper">

    <!-- Dynamic table -->
    <div class="widget">
        <div class="title"><img src="images/icons/dark/fullscreen.png" alt="" class="titleIcon" />
            <h6>Listar Logs</h6>
        </div>
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
                for ($i = 0; $i < $logs['num']; $i++) {
                    if ($logs[$i]->usuario == "Administrador") {
                        continue;
                    }
                ?>
                    <tr class="gradeA">
                        <td align="center">
                            <?php echo $logs[$i]->id; ?>
                        </td>
                        <td align="center">
                            <?php echo $logs[$i]->usuario; ?>
                        </td>
                        <td align="center">
                            <?php echo $logs[$i]->acao; ?>
                        </td>
                        <td align="center">
                            <?php echo $logs[$i]->area; ?>
                        </td>
                        <td align="center">
                            <?php echo $logs[$i]->id_area; ?>
                        </td>
                        <td align="center">
                            <?php echo $logs[$i]->ip; ?>
                        </td>
                        <td align="center">
                            <?php $data = $objUteis->dataHora($logs[$i]->datahora);
                            echo $data["data"] . " &agrave;s " . $data["hora"]; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</div>