<script type="text/javascript">
    function validaFrmAltSessao(form, id_sessao) {
        document.getElementById('scrol_altSessao' + id_sessao).focus();
        if (form.nome.value == "") {
            document.getElementById('respostaAltSessao' + id_sessao).innerHTML = "Por favor, preencha o campo NOME!";
            form.nome.focus();
            return false;
        }
    }
</script>
<input type="text" class="remendoScroll" name="scrol_altSessao<?php echo $sessao->id; ?>" id="scrol_altSessao<?php echo $sessao->id; ?>" />
<div align="center" id="geral_alt_sessao<?php echo $sessao->id; ?>">
    <div class="resposta" id="respostaAltSessao<?php echo $sessao->id; ?>"></div>
    <form action="ctrlSessao.php?acao=alteraSessao" name="frmAltSessao" id="frmAltSessao" method="post" enctype="multipart/form-data" target="iframeAltSessao<?php echo $sessao->id; ?>" onsubmit="return validaFrmAltSessao(this,'<?php echo $sessao->id; ?>');">
        <table width="65%" cellpadding="0" cellspacing="0" class="frm_tabela">
            <tr>
                <td colspan="4" class="frm_titulo">Altera&ccedil;&atilde;o da Sess&atilde;o</td>
            </tr>
            <tr>
                <td colspan="4" class="frm_separador"></td>
            </tr>
            <tr>
                <td class="frm_label" width="25%">*Nome:</td>
                <td class="frm_input" width="75%" colspan="3">
                    <input type="text" name="nome" id="nome" class="frm_txt" maxlength="255" style="width:350px;" value="<?php echo utf8_encode($sessao->nome); ?>" />
                </td>
            </tr>
            <tr>
                <td colspan="4" class="frm_separador"></td>
            </tr>
            <tr>
                <td colspan="4" class="frm_btn frm_bgDestaque">
                    <input type="hidden" name="id" id="id" value="<?php echo $sessao->id; ?>" />
                    <input type="submit" name="btnAlt" value="Alterar" />
                    <!-- IFRAME ONDE SERÁ SUBMITADO O FORMULÁRIO DE CADASTRO DE CONSELHO REGIONAL -->
                    <iframe name="iframeAltSessao<?php echo $sessao->id; ?>" frameborder="0" width="0" height="0"></iframe>
                </td>
            </tr>
            <tr>
                <td colspan="4" class="frm_separador"></td>
            </tr>
        </table>
    </form>
</div>