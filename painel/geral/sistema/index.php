<?

include_once "../inc/protege.php";

//classe de post
include_once "../classes/session/post.class.php";
$objPost = new gp();


	//classe de session
	include_once "../classes/session/class.eyesecuresession.inc.php";
	$objSession2 = new EyeSecureSession('session123');

	
	$permissao = null;
	$abrePag = null;
	
    //classe de conex�o
    include_once "../../classes/class.conexao.php";

    //classe que possui algumas funções utéis(Ex.: Conversão de datas, moedas, etc.)
    include_once "../classes/class.uteis.php";
    $objUteis = new Uteis();

    //classe de se��o
    include_once "../classes/class.secao.php";
    $objSecao = new Secao();
    
    //inclui a classe de formularios
    include_once "../classes/class.form.php";
    $objForm = new Form();
    
    //inclui a classe dos correios
    include_once "../classes/class.Correios.php";
    $objCorreios = new Correios();

    if(!isset($objPost->param["ctrl"])){
       include '../ctrlLogs.php';
    }
	
    if(isset($objPost->param["ctrl"])){
	    if($objPost->param["ctrl"] == "configuracoes"){
	
	       include '../ctrlConfiguracao.php';
	    }
    }
    
    if(isset($objPost->param["ctrl"])){
    	if($objPost->param["ctrl"] == "cpanel"){
    
    		include '../ctrlCpanel.php';
    	}
    }
    
    if(isset($objPost->param["ctrl"])){
	    if($objPost->param["ctrl"] == "modulo"){
	       include '../ctrlModulo.php';
	    }
    }
    
    if(isset($objPost->param["ctrl"])){
    	if($objPost->param["ctrl"] == "usuarios"){
    		include '../usuarios/ctrlUsuarios.php';
    	}
    }
    
    $secoes_fixas = $objSecao->listar_fixas();
    $objUteis->encode($secoes_fixas);

    for($i=0;$i<$secoes_fixas["num"];$i++){
    $sem_acento = $objUteis->nameArq(utf8_decode($secoes_fixas[$i]->titulo));
	    if(isset($objPost->param["ctrl"])){
	        if($objPost->param["ctrl"] == $sem_acento){
	           include "{$secoes_fixas[$i]->ctrl}";
	        }
	    }
    }

    if($objSession2->get('tlAdmLoginId')){

    ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<title>Painel Administrativo</title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="css/multiUpload.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="js/jquery.js"></script>

<script type="text/javascript" src="js/plugins/spinner/ui.spinner.js"></script>
<script type="text/javascript" src="js/plugins/spinner/jquery.mousewheel.js"></script>

<script type="text/javascript" src="js/jqueryui.js"></script>

<script type="text/javascript" src="js/plugins/charts/excanvas.min.js"></script>
<script type="text/javascript" src="js/plugins/charts/jquery.flot.js"></script>
<script type="text/javascript" src="js/plugins/charts/jquery.flot.orderBars.js"></script>
<script type="text/javascript" src="js/plugins/charts/jquery.flot.pie.js"></script>
<script type="text/javascript" src="js/plugins/charts/jquery.flot.resize.js"></script>
<script type="text/javascript" src="js/plugins/charts/jquery.sparkline.min.js"></script>

<script type="text/javascript" src="js/plugins/forms/uniform.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.cleditor.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.validationEngine-en.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.validationEngine.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="js/plugins/forms/autogrowtextarea.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.dualListBox.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.inputlimiter.min.js"></script>
<script type="text/javascript" src="js/plugins/forms/chosen.jquery.min.js"></script>

<script type="text/javascript" src="js/plugins/wizard/jquery.form.js"></script>
<script type="text/javascript" src="js/plugins/wizard/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/plugins/wizard/jquery.form.wizard.js"></script>

<script type="text/javascript" src="js/plugins/uploader/plupload.js"></script>
<script type="text/javascript" src="js/plugins/uploader/plupload.html5.js"></script>
<script type="text/javascript" src="js/plugins/uploader/plupload.html4.js"></script>
<script type="text/javascript" src="js/plugins/uploader/jquery.plupload.queue.js"></script>

<script type="text/javascript" src="js/plugins/tables/datatable.js"></script>
<script type="text/javascript" src="js/plugins/tables/tablesort.min.js"></script>
<script type="text/javascript" src="js/plugins/tables/resizable.min.js"></script>

<script type="text/javascript" src="js/plugins/ui/jquery.tipsy.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.collapsible.min.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.progress.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.timeentry.min.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.colorpicker.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.jgrowl.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.breadcrumbs.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.sourcerer.js"></script>

<script type="text/javascript" src="js/plugins/calendar.min.js"></script>
<script type="text/javascript" src="js/plugins/elfinder.min.js"></script>

<script type="text/javascript" src="js/plugins/redactor/redactor.js"></script>
<script type="text/javascript" src="js/plugins/forms/upload.min.js"></script>
<script type="text/javascript" src="js/plugins/forms/myupload.js"></script>
<script type="text/javascript" src="js/jquery.blockUI.js"></script>
<script type="text/javascript" src="js/jquery.price_format.1.8.min.js"></script>


<script type="text/javascript" src="js/custom.js"></script>

<script src="js/plugins/ckeditor/ckeditor.js"></script>

<script src="js/gmap3.min.js"></script>
<script src="js/jquery.formToWizard.js"></script>


</head>

<body>

<?php 
$configuracao = Config::AtributosConfig(); ?>

<!-- Left side content -->
<div id="leftSide">
    <div class="logo"><a href="<?=$configuracao["siteDesenvolvedor"]?>" target="_blank"><img src="<?php echo $configuracao['urllogo']; ?>" alt="" width='82' /></a></div>

    <div class="sidebarSep mt0"></div>

    <!-- Sidebar profile -->
    <div class="sideProfile">
    	<a href="../gt.php?img=sistema/<?=$objSession2->get('tlAdmLoginImg')?>&h=250" title="<?=$objSession2->get('tlAdmLoginNome')?>" rel="lightbox" class="profileFace"><img src="../gt.php?img=sistema/<?=$objSession2->get('tlAdmLoginImg')?>&h=36" alt="" /></a>
        <span>Olá <strong><?=$objSession2->get('tlAdmLoginNome')?></strong></span>
        <div class="clear"></div>
        <div class="sidedd">
        	<span class="goUser">Selecione a ação</span>
        	<ul class="sideDropdown">
                <?if($permissao->cadastrar=="1"){?>
            	<li><a href="index.php?acao=frmCadUsuario&ctrl=usuarios" title=""><img src="images/icons/topnav/profile.png" alt="" />Criar Novo Usuário</a></li>
                <?}?>
                <li><a href="index.php?acao=listaUsuarios&ctrl=usuarios" title=""><img src="images/icons/topnav/tasks.png" alt="" />Listar Usuários</a></li>
                <?
                        if($objSession2->get('tlAdmLoginNivel') == 1){
                             ?>
                <li><a href="index.php?acao=listar&ctrl=configuracoes" title=""><img src="images/icons/topnav/settings.png" alt="" />Formulários</a></li>
                <li><a href="index.php?acao=listar&ctrl=modulo" title=""><img src="images/icons/topnav/settings.png" alt="" />Módulo</a></li>
                <?if($configuracao["whm"]['dominio'] && $configuracao["whm"]['user'] && $configuracao["whm"]['pass'] && $configuracao["whm"]['userCpanelCliente']){?>
                <li><a href="index.php?acao=listar&ctrl=cpanel" title=""><img src="images/icons/topnav/settings.png" alt="" />Hospedagem do Site</a></li>
                <?php }?>
                <?}?>
                <li><a href="index.php?acao=sair&ctrl=usuarios" title=""><img src="images/icons/topnav/logout.png" alt="" />Deslogar</a></li>
            </ul>
        </div>
    </div>
    <div class="sidebarSep"></div>

    <!-- Left navigation -->
    <ul id="menu" class="nav">
        <li class="dash"><a href="index.php" title=""><span>Início</span></a></li>
        <?
        if($objSession2->get('tlAdmLoginNivel') == 1){
             ?>
        <?
                if($objSession2->get('tlAdmLoginNivel') == 1 && $configuracao["whm"]['dominio'] && $configuracao["whm"]['user'] && $configuracao["whm"]['pass'] && $configuracao["whm"]['userCpanelCliente']){
                     ?>     
        <li><a href="#" title="" class="exp"><span style="background-image:url('images/icons/light/create.png')">Hospedagem do Site</span></a>
            <ul class="sub">
                
                <li><a href="index.php?acao=listar&ctrl=cpanel" title="">Detalhes</a></li>
                <?php if($configuracao['permissao']['emailCpanel']): ?>
                <li><a href="index.php?acao=criar-email&ctrl=cpanel" title="">-- Criar Email</a></li>
                <li><a href="index.php?acao=listar-emails&ctrl=cpanel" title="">-- Listar Emails</a></li>
                <?php endif;?>
                <?php if($configuracao['permissao']['ftpCpanel']): ?>
                    <li><a href="index.php?acao=criar-ftp&ctrl=cpanel" title="">-- Criar Ftp</a></li>
                    <li><a href="index.php?acao=listar-ftp&ctrl=cpanel" title="">-- Listar Ftp</a></li>
                <?php endif;?>
                
            </ul>
        </li>
        <?}?>
        <?php if($configuracao['permissao']['formulario']): ?>
        <li><a href="#" title="" class="exp"><span style="background-image:url('images/icons/light/create.png')">Formulários</span></a>
            <ul class="sub">
                <?
                        if($objSession2->get('tlAdmLoginNivel') == 1){
                             ?>
                <?php if($configuracao['permissao']['formularioCriar']): ?>
                <li><a href="index.php?acao=frmCad&ctrl=configuracoes" title="">Cadastrar email de recebimento</a></li>
                <?php endif;?>
                <?}?>
                <?php if($configuracao['permissao']['formularioListar']): ?>
                <li><a href="index.php?acao=listar&ctrl=configuracoes" title="">Listar emails de recebimento</a></li>
                <?php endif;?>
            </ul>
        </li>
        <?php endif;?>
        <?php if($configuracao['permissao']['modulo']): ?>
        <li><a href="#" title="" class="exp"><span style="background-image:url('images/icons/light/cog3.png')">Módulos</span></a>
            <ul class="sub">
                <?
                        if($objSession2->get('tlAdmLoginNivel') == 1){
                             ?>
                <?php if($configuracao['permissao']['moduloCriar']): ?>
                <li><a href="index.php?acao=frmCad&ctrl=modulo" title="">Cadastrar módulo</a></li>
                <?php endif;?>
                <?}?>
                <?php if($configuracao['permissao']['moduloListar']): ?>
                <li><a href="index.php?acao=listar&ctrl=modulo" title="">Listar módulos</a></li>
                <?php endif;?>
            </ul>
        </li>
        <?php endif;?>
        <?}?>
        <?
        
        for($i=0;$i<$secoes_fixas["num"];$i++){
            $sem_acento = $objUteis->nameArq(utf8_decode($secoes_fixas[$i]->titulo));
            $permissao2 = $objSecao->permissaoSecaoFixaUsuario($secoes_fixas[$i]->id,$objSession2->get('tlAdmLoginId'));
            $menus = $objSecao->listar_menu_by_secao_fixa($secoes_fixas[$i]->id);
            $objUteis->encode($menus);
            ?>
        <?if(count($menus) &&  isset($permissao2->id) &&  $permissao2->id){?>
        <li><a href="#" title="" class="exp"><span style="background-image:url('<?=$secoes_fixas[$i]->img?>')"><?=$secoes_fixas[$i]->menu?></span></a>
            <ul class="sub">
                <?for($j=0;$j<$menus["num"];$j++){?>
                <li><a href="<?=$menus[$j]->url?>" title=""><?=$menus[$j]->titulo?></a></li>
                <?}?>
            </ul>
        </li>
        <?}?>
        <?}?>
    </ul>

    <div class="sidebarSep"></div>

</div>


<!-- Right side -->
<div id="rightSide">

    <!-- Top fixed navigation -->
    <div class="topNav">
        <div class="wrapper">
            <div class="welcome"><a href="../gt.php?img=sistema/<?=$objSession2->get('tlAdmLoginImg')?>&h=250" title="<?=$objSession2->get('tlAdmLoginNome')?>" rel="lightbox"><img src="../gt.php?img=sistema/<?=$objSession2->get('tlAdmLoginImg')?>&h=16" alt="" /></a><span>Bem vindo, <?=$objSession2->get('tlAdmLoginNome')?>!</span></div>
            <div class="userNav">
                <ul>
                    <?if(isset($permissao->cadastrar) && $permissao->cadastrar=="1"){?>
                    <li><a href="index.php?acao=frmCadUsuario&ctrl=usuarios" title="Criar Novo Usuário"><img src="images/icons/topnav/profile.png" alt="" /><span>Criar Novo Usuário</span></a></li>
                    <?}?>
                    <li><a href="index.php?acao=listaUsuarios&ctrl=usuarios" title="Listar Usuários"><img src="images/icons/topnav/tasks.png" alt="" /><span>Listar Usuários</span></a></li>
                    <?
                        if($objSession2->get('tlAdmLoginNivel') == 1){
                             ?>
                    <li><a href="index.php?acao=listar&ctrl=configuracoes" title="Configurações"><img src="images/icons/light/create.png" alt="" /><span>Formulários</span></a></li>
                    <li><a href="index.php?acao=listar&ctrl=modulo" title="Módulo"><img src="images/icons/light/cog3.png" alt="" /><span>Módulos</span></a></li>
                    <?}?>
                    <li><a href="index.php?acao=sair&ctrl=usuarios" title="Deslogar"><img src="images/icons/topnav/logout.png" alt="" /><span>Deslogar</span></a></li>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
    </div>

    <!-- Responsive header -->
    <div class="resp">
        <div class="respHead">
            <a href="index.html" title=""><img src="images/loginLogo.png" alt="" /></a>
        </div>

        <div class="cLine"></div>
        <div class="smalldd">
            <span class="goTo"><img src="images/icons/light/frames.png" alt="" />Menu</span>
            <ul class="smallDropdown">
                
                <li><a href="index.php" title=""><img src="images/icons/light/home.png" alt="" />Início</a></li>
                <?
                if($objSession2->get('tlAdmLoginNivel') == 1){
                     ?>
                <?
               if($objSession2->get('tlAdmLoginNivel') == 1 && $configuracao["whm"]['dominio'] && $configuracao["whm"]['user'] && $configuracao["whm"]['pass'] && $configuracao["whm"]['userCpanelCliente']){
                     ?>     
                <li><a href="#" title="" class="exp"><img src="images/icons/light/create.png" alt="" />Hospedagem do Site</a>
                    <ul class="sub">
                        
                        <li><a href="index.php?acao=listar&ctrl=cpanel" title="">Detalhes</a></li>
                        <?php if($configuracao['permissao']['emailCpanel']): ?>
                        <li><a href="index.php?acao=criar-email&ctrl=cpanel" title="">-- Criar Email</a></li>
                        <li><a href="index.php?acao=listar-emails&ctrl=cpanel" title="">-- Listar Emails</a></li>
                        <?php endif;?>
                        <?php if($configuracao['permissao']['ftpCpanel']): ?>
                            <li><a href="index.php?acao=criar-ftp&ctrl=cpanel" title="">-- Criar Ftp</a></li>
                            <li><a href="index.php?acao=listar-ftp&ctrl=cpanel" title="">-- Listar Ftp</a></li>
                        <?php endif;?>
                        
                    </ul>
                </li>
                <?}?>
                <?php if($configuracao['permissao']['formulario']): ?>
                <li><a href="#" title="" class="exp"><img src="images/icons/light/create.png" alt="" />Formulários</a>
                    <ul class="sub">
                        <?
                        if($objSession2->get('tlAdmLoginNivel') == 1){
                             ?>
                        <?php if($configuracao['permissao']['formularioCriar']): ?>     
                        <li><a href="index.php?acao=frmCad&ctrl=configuracoes" title="">Cadastrar email de recebimento</a></li>
                        <?php endif;?>
                        <?}?>
                        <?php if($configuracao['permissao']['formularioListar']): ?>
                        <li><a href="index.php?acao=listar&ctrl=configuracoes" title="">Listar emails de recebimento</a></li>
                        <?php endif;?>
                    </ul>
                </li>
                <?php endif;?>
                <?php if($configuracao['permissao']['modulo']): ?>
                <li><a href="#" title="" class="exp"><img src="images/icons/light/cog3.png" alt="" />Módulos</a>
                    <ul class="sub">
                        <?
                        if($objSession2->get('tlAdmLoginNivel') == 1){
                             ?>
                        <?php if($configuracao['permissao']['moduloCriar']): ?>
                        <li><a href="index.php?acao=frmCad&ctrl=modulo" title="">Cadastrar módulo</a></li>
                        <?php endif;?>
                        <?}?>
                        <?php if($configuracao['permissao']['moduloListar']): ?>
                        <li><a href="index.php?acao=listar&ctrl=modulo" title="">Listar módulos</a></li>
                        <?php endif;?>
                    </ul>
                </li>
                <?php endif;?>
                <?php }?>
                <?for($i=0;$i<$secoes_fixas["num"];$i++){
                    $sem_acento = $objUteis->nameArq(utf8_decode($secoes_fixas[$i]->titulo));
                    $permissao2 = $objSecao->permissaoSecaoFixaUsuario($secoes_fixas[$i]->id,$objSession2->get('tlAdmLoginId'));
                    $menus = $objSecao->listar_menu_by_secao_fixa($secoes_fixas[$i]->id);
                    $objUteis->encode($menus);
                    ?>
                <?if(count($menus) &&  isset($permissao2->id) &&  $permissao2->id){?>
                <li><a href="<?=$menus[$j]->url?>" title="" class="exp"><img src="<?=$secoes_fixas[$i]->img?>" alt="" /><?=$secoes_fixas[$i]->menu?></a>
                    <ul class="sub">
                        <?for($j=0;$j<$menus["num"];$j++){?>
                        <li><a href="<?=$menus[$j]->url?>" title=""><?=$menus[$j]->titulo?></a></li>
                        <?}?>
                    </ul>
                </li>
                <?}?>
                <?}?>
            </ul>
        </div>
        <div class="cLine"></div>
    </div>

    <!-- Title area -->
    <div class="titleArea">
        <div class="wrapper">
            <div class="pageTitle">
                <h5>Painel de Manutenção de Conteúdo</h5>
                <span>Bem vindo ao Sistema de Atualização e Manutenção de Conteúdo.<br />
                Em caso de dificuldade entre em contato.</span>
            </div>
            <div class="clear"></div>
        </div>
    </div>

    <div class="line"></div>

    <!-- Main content wrapper -->
    <div class="wrapper">

        <?php
        	if($abrePag){
            	include("$abrePag");
            }
        ?>

    </div>

    <!-- Footer line -->
    <div id="footer">
        <div class="wrapper">Todos direitos reservados a <a href="<?=$configuracao["siteDesenvolvedor"]?>" target="_blank" title=""><?=$configuracao["siteDesenvolvedor"]?></a></div>
    </div>

</div>

<div class="clear"></div>

</body>
</html>

<?}else{?>
	<script type='text/javascript'>window.location ='../../index.php';</script>
<?}?>

