<script type="text/javascript">
	function validaFrmCadSessao(form){
		document.getElementById('scroll_cadSessao').focus();
		if(form.nome.value==""){
			document.getElementById('respostaCadSessao').innerHTML = "Por favor, preencha o campo NOME!";
			form.nome.focus();
			return false;
		}
	}
</script>
<input type="text" class="remendoScroll" name="scroll_cadSessao" id="scroll_cadSessao" />
<div align="center" id="geral_cad_sessao">
	<div class="resposta" id="respostaCadSessao"></div>
	<form action="ctrlSessao.php?acao=cadastraSessao" name="frmCadSessao" id="frmCadSessao" method="post" enctype="multipart/form-data" target="iframeCadSessao" onsubmit="return validaFrmCadSessao(this);">
    <table width="65%" cellpadding="0" cellspacing="0" class="frm_tabela">
        <tr>
        	<td colspan="4" class="frm_titulo">Cadastro de Sess&atilde;o</td>
        </tr>
        <tr>
        	<td colspan="4" class="frm_separador"></td>
        </tr>
		<tr>
			<td class="frm_label" width="25%">*Nome:</td>
			<td class="frm_input" width="75%" colspan="3">
				<input type="text" name="nome" id="nome" class="frm_txt" maxlength="255" style="width:350px;" />
			</td>
		</tr>
        <tr>
        	<td colspan="4" class="frm_separador"></td>
        </tr>
        <tr>
            <td colspan="4" class="frm_btn frm_bgDestaque">
                <input type="submit" name="btnAlt" value="Cadastrar" />
                <!-- IFRAME ONDE SERÁ SUBMITADO O FORMULÁRIO DE CADASTRO DE CONSELHO REGIONAL -->
                <iframe name="iframeCadSessao" frameborder="0" width="0" height="0"></iframe>
            </td>
        </tr>
        <tr>
            <td colspan="4" class="frm_separador"></td>
        </tr>
    </table>
    </form>
</div>