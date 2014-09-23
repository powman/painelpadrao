<?
    include '../inc/config.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<title>Painel Administrativo</title>
<link href="../sistema/css/main.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="../sistema/js/jquery.js"></script>

<script type="text/javascript" src="../sistema/js/plugins/spinner/ui.spinner.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/spinner/jquery.mousewheel.js"></script>

<script type="text/javascript" src="../sistema/js/jqueryui.js"></script>

<script type="text/javascript" src="../sistema/js/plugins/charts/excanvas.min.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/charts/jquery.sparkline.min.js"></script>

<script type="text/javascript" src="../sistema/js/plugins/forms/uniform.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/forms/jquery.cleditor.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/forms/jquery.validationEngine-en.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/forms/jquery.validationEngine.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/forms/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/forms/autogrowtextarea.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/forms/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/forms/jquery.dualListBox.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/forms/jquery.inputlimiter.min.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/forms/chosen.jquery.min.js"></script>

<script type="text/javascript" src="../sistema/js/plugins/wizard/jquery.form.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/wizard/jquery.validate.min.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/wizard/jquery.form.wizard.js"></script>

<script type="text/javascript" src="../sistema/js/plugins/uploader/plupload.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/uploader/plupload.html5.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/uploader/plupload.html4.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/uploader/jquery.plupload.queue.js"></script>

<script type="text/javascript" src="../sistema/js/plugins/tables/datatable.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/tables/tablesort.min.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/tables/resizable.min.js"></script>

<script type="text/javascript" src="../sistema/js/plugins/ui/jquery.tipsy.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/ui/jquery.collapsible.min.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/ui/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/ui/jquery.progress.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/ui/jquery.timeentry.min.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/ui/jquery.colorpicker.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/ui/jquery.jgrowl.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/ui/jquery.breadcrumbs.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/ui/jquery.sourcerer.js"></script>

<script type="text/javascript" src="../sistema/js/plugins/calendar.min.js"></script>
<script type="text/javascript" src="../sistema/js/plugins/elfinder.min.js"></script>

<script type="text/javascript" src="../sistema/js/plugins/redactor/redactor.js"></script>

<script type="text/javascript" src="../sistema/js/custom.js"></script>

<script src="../sistema/js/plugins/ckeditor/ckeditor.js"></script>

</head>

<body class="nobg loginPage">

<?php $configuracao = Config::AtributosConfig(); ?>

<!-- Top fixed navigation -->
<div class="topNav">
    <div class="wrapper">
        <div class="userNav">
            <ul>
                <li><a href="<?php echo $configuracao["siteCliente"]?>" title=""><img src="../sistema/images/icons/topnav/mainWebsite.png" alt="" /><span>Voltar para o Website</span></a></li>
                <li><a href="<?php echo $configuracao["siteDesenvolvedor"]?>" title=""><img src="../sistema/images/icons/topnav/messages.png" alt="" /><span>Desenvolverdor</span></a></li>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
</div>


<!-- Main content wrapper -->
<div class="loginWrapper">
    <div class="loginLogo" style="display:none;"><img src="../sistema/images/loginLogo.png" alt="" /></div>
    <div class="widget" id='logarPainel'>
        <div class="title"><img src="../sistema/images/icons/dark/files.png" alt="" class="titleIcon" /><h6>Acesso Restrito</h6></div>
        <form action="javascript:;" id="frmLogarPaginaInicial" class="form">
            <fieldset>
                <div class="formRow">
                    <label for="login">Usuário / email:</label>
                    <div class="loginInput"><input type="text" name="email" class="validate[required,custom[email]]" id="email" /></div>
                    <div class="clear"></div>
                </div>
                
                <div class="formRow">
                    <label for="pass">Senha:</label>
                    <div class="loginInput"><input type="password" name="senha" class="validate[required]" id="pass" /></div>
                    <div class="clear"></div>
                </div>
                
                <div class="loginControl">
                    <div class="rememberMe">
                    	<a href="javascript:;" id="clicarEsqueciSenha">
							Esqueci minha senha.                    	
                    	</a>
                    </div>
                    <input type="hidden" value="<?=$_SERVER['REMOTE_ADDR'];?>" name="ip" />
                    <input type="submit" value="Logar" class="dredB logMeIn" />
                    <div class="clear"></div>
                </div>
            </fieldset>
        </form>
    </div>
    <div class="widget" style="display: none;" id="esqueciSenha">
        <div class="title"><img src="../sistema/images/icons/dark/files.png" alt="" class="titleIcon" /><h6>Esqueci minha senha</h6></div>
        <form action="javascript:;" id="frmEsquecerSenhaPaginaInicial" class="form">
            <fieldset>
                <div class="formRow">
                    <label for="login">Usuário / email:</label>
                    <div class="loginInput"><input type="text" name="email" class="validate[required,custom[email]]" id="email" /></div>
                    <div class="clear"></div>
                </div>
                
                <div class="loginControl">
                	<div class="rememberMe">
                    	<a href="javascript:;" id="clicarVoltarSenha">
							Voltar                   	
                    	</a>
                    </div>	
                    <input type="submit" value="Recuperar Senha" class="dredB logMeIn" />
                    <div class="clear"></div>
                </div>
            </fieldset>
        </form>
    </div>
</div>    

<!-- Footer line -->
<div id="footer">
    <div class="wrapper">Todos os direitos reservados. <a href="<?php echo $configuracao["siteCliente"]?>" target="_blank" title=""><?php echo $configuracao["nomeCliente"]?></a></div>
</div>

<script>
	$('#clicarEsqueciSenha').click(function(){
		$('#esqueciSenha').fadeIn();
		$('#logarPainel').css('display','none');
	});

	$('#clicarVoltarSenha').click(function(){
		$('#logarPainel').fadeIn();
		$('#esqueciSenha').css('display','none');
	});
</script>


</body>
</html>