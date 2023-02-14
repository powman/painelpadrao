<script type="text/javascript">
    function validaFrmAltSecao(form, id_secao) {
        if (form.titulo.value == "") {
            document.getElementById('respostaAltSecao' + id_secao).innerHTML = 'Por favor, preencha o campo TÍTULO!';
            form.titulo.focus();
            return false;
        }
    }
</script>
<div align="center">
    <div class="resposta" id="respostaAltSecao<?php echo $secao->id; ?>"></div>
    <form action="ctrlSecao.php?acao=alteraSecao" name="frmAltSecao" id="frmAltSecao" method="post" enctype="multipart/form-data" target="iframeAltSecao<?php echo $secao->id; ?>" onsubmit="return validaFrmAltSecao(this,'<?php echo $secao->id; ?>');">
        <table width="450" cellpadding="0" cellspacing="0" class="frm_tabela">
            <tr>
                <td colspan="2" class="frm_titulo">Alteração de Seção</td>
            </tr>
            <tr>
                <td colspan="2" class="frm_separador"></td>
            </tr>
            <tr>
                <td class="frm_label" width="220">Título:</td>
                <td class="frm_input" width="410">
                    <input name="titulo" type="text" class="frm_txt" id="titulo" size="50" maxlength="255" value="<?php echo utf8_encode($secao->titulo); ?>" />
                </td>
            </tr>
            <tr>
                <td class="frm_label" width="220">Seção Pai:</td>
                <td class="frm_input" width="410">
                    <select name="id_secao" id="id_secao">
                        <option value="">Principal</option>
                        <?
                        for ($i = 0; $i < $secoes["num"]; $i++) {
                            if ($secao->id != $secoes[$i]->id) {
                        ?>
                                <option value="<?php echo $secoes[$i]->id; ?>" <?php if ($secao->id_secao == $secoes[$i]->id) echo "selected"; ?>>
                                    <?php echo utf8_encode($secoes[$i]->titulo); ?>
                                </option>
                        <?
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <fieldset>
                        <legend>Configurações</legend>
                        <table width="50%">
                            <tr>
                                <!--<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td class="frm_label" width="220">Banner:</td>
                                <td class="frm_input"><input type="checkbox" name="banner" id="banner" value="1" <?php if ($secao->banner == "1") echo "checked"; ?> /></td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td class="frm_label" width="220">Data:</td>
                                <td class="frm_input"><input type="checkbox" name="data" id="data" value="1" <?php if ($secao->data == "1") echo "checked"; ?> /></td>-->
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td class="frm_label" width="220">Fotos:</td>
                                <td class="frm_input"><input type="checkbox" name="fotos" id="fotos" value="1" <?php if ($secao->fotos == "1") echo "checked"; ?> /></td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td class="frm_label" width="220">Vídeos:</td>
                                <td class="frm_input"><input type="checkbox" name="videos" id="videos" value="1" <?php if ($secao->videos == "1") echo "checked"; ?> /></td>
                            </tr>
                        </table>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="frm_btn frm_bgDestaque">
                    <input type="hidden" name="id" id="id" value="<?php echo $secao->id; ?>" />
                    <input type="submit" name="btnAlt" value="Alterar" />
                    <!-- IFRAME ONDE SERÁ SUBMITADO O FORMULÁRIO DE ALTERAÇÃO DE SEÇÕES -->
                    <iframe name="iframeAltSecao<?php echo $secao->id; ?>" frameborder="0" width="0" height="0"></iframe>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="frm_separador"></td>
            </tr>
        </table>
    </form>
</div>