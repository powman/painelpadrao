<script type="text/javascript">
	function validaFrmCadSecao(form){
		if(form.titulo.value==""){
			document.getElementById('respostaCadSecao').innerHTML = 'Por favor, preencha o campo TÍTULO!';
			form.titulo.focus();
			return false;
		}
	}
</script>
<div align="center">
	<div class="resposta" id="respostaCadSecao"></div>
	<form action="ctrlSecao.php?acao=cadastraSecao" name="frmCadSecao" id="frmCadSecao" method="post" enctype="multipart/form-data" target="iframeCadSecao" onsubmit="return validaFrmCadSecao(this);">
        <table width="450" cellpadding="0" cellspacing="0" class="frm_tabela">
            <tr>
                <td colspan="2" class="frm_titulo">Cadastro de Seção</td>
            </tr>
            <tr>
                <td colspan="2" class="frm_separador"></td>
            </tr>
            <tr>
                <td class="frm_label" width="220">*Título:</td>
                <td class="frm_input" width="410">
                    <input name="titulo" type="text" class="frm_txt" id="titulo" size="50" maxlength="255"/>
                </td>
            </tr>
            <tr>
                <td class="frm_label" width="220">Seção Pai:</td>
                <td class="frm_input" width="410">
                    <select name="id_secao" id="id_secao">
                        <option value="">Principal</option>
                        <?
                            for($i=0;$i<$secoes["num"];$i++){
                        ?>
                        <option value="<?=$secoes[$i]->id;?>"><?=utf8_encode($secoes[$i]->titulo);?></option>
                        <?
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <fieldset>
                        <legend>Configurações</legend>
                        <table width="50%" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <!--<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td class="frm_label" width="220">Banner:</td>
                                <td class="frm_input"><input type="checkbox" name="banner" id="banner" value="1" /></td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td class="frm_label" width="220">Data:</td>
                                <td class="frm_input"><input type="checkbox" name="data" id="data" value="1" /></td>-->
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td class="frm_label" width="220">Fotos:</td>
                                <td class="frm_input"><input type="checkbox" name="fotos" id="fotos" value="1" /></td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td class="frm_label" width="220">Vídeos:</td>
                                <td class="frm_input"><input type="checkbox" name="videos" id="videos" value="1" /></td>
                            </tr>
                        </table>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="frm_separador"></td>
            </tr>
            <tr>
                <td colspan="2" class="frm_btn frm_bgDestaque">
                    <input type="submit" name="btnCad" value="Cadastrar" />
                    <!-- IFRAME ONDE SERÁ SUBMITADO O FORMULÁRIO DE CADASTRO DE SEÇÕES -->
                    <iframe name="iframeCadSecao" frameborder="0" width="0" height="0"></iframe>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="frm_separador"></td>
            </tr>
        </table>
    </form>
</div>