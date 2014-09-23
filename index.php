<?php
ob_start();
include 'ctrl.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-Language" content="pt-BR" />
        <meta http-equiv="Cache-Control" content="no-cache" />
        <meta http-equiv="pragma" content="no-cache" />
        <meta name="robots" content="ALL" />
        <meta name="keywords" content="<?=$meta->tags?>" />
        <meta name="description" content="<?=$meta->descricao?>"/>
        <meta name="resource-types" content="document" />
        <meta name="revisit-after" content="1 day" />
        <meta name="distribution" content="Global" />
        <meta name="rating" content="General" />
        <meta name="author" content="Paulowebsite - Crialçao de sites" />
        <meta name="language" content="pt-br" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        
        <meta property="og:locale" content="pt_BR"/>
		<meta property="og:url" content="<?="http://".$_SERVER['SERVER_NAME'].$_SERVER ['REQUEST_URI']?>"/>
		<meta property="og:title" content="<?=$meta->og['title']?>"/>
		<meta property="og:site_name" content="<?=$meta->og['title']?>"/>
		<meta property="og:type" content="Site"/>
		<meta property="og:description" content="<?=$meta->og['description']?>"/>
		<meta property="og:image" content="<?=$meta->og['image']?>"/>
		<meta property="og:image:width" content="1200"/> 
		<meta property="og:image:height" content="630"/> 
		<meta property="og:type" content="website"/>

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        
        <!--#begin file input-->
	    <link href="<?= $path["site"] ?>css/all.css" rel="Stylesheet"/>
	    <!--End file input-->

        <?php ob_end_flush(); flush();?>
        <script>
			var pathSite = '<?= $path["site"] ?>';
        </script>
        
        
        
        <link rel="canonical" href="<?=isset($_SERVER['SCRIPT_URI'])?>" />

        <title><?=$titPag?></title>

    </head>
    <body>
        <div id="fb-root"></div>
        <div id="wrapper">
            <div id="geral" align="center">
                <div class="tudo">
                    <div id="topo">
                        <div id="page">
							<div id="header">
								<div>
									Topo
								</div>
							</div>
						</div>
                    </div>
                    <div id="conteudo" class="container" align="left">

                        <?php
                            include("$abrePag");
                        ?>
                    </div>
                    <div id="rodape">
                        rodape
                    </div>
                </div>
            </div>
        </div>
        <!-- Placed at the end of the document so the pages load faster -->
		<script src="<?= $path["site"] ?>js/scripts.js" type="text/javascript"></script>
    </body>
    

</html>
