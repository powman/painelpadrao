<?
$content = utf8_encode($objUteis->nameArq($secao->titulo));
?>
<?
	if($secao->status=="1"){
?>
<a href="javascript:;" onclick="return confirmPublicaSecao('publica_<?php echo $content;?>','ctrlSecao.php?acao=publicarSecao&amp;local=home&amp;id=<?php echo $secao->id;?>&amp;status=0');">
	<img src="img/seta_sub.gif" class="imgSubMenu" />
	Status: <img src="img/frms/status_onP.gif" alt="ativo" />
</a>
<?
	}elseif($secao->status=="2"){
?>
<a href="javascript:;" onclick="criaAba('publica_conteudoSecao_<?php echo $secao->id;?>','Publica��<?php echo <?=$objUteis->jschars(utf8_encode($secao->titulo));?>','ctrlSecao.php?acao=frmPubConteudoSecao&amp;<?php echo <?=$secao->id;?>');">
	<img src="img/seta_sub.gif" class="imgSubMenu" />
	Status: <img src="img/frms/status_neutroP.gif" alt="aguardando publica��o" />
</a>
<?
	}else{
?>
<a href="javascript:;" onclick="return confirmPublicaSecao('publica_<?php echo $content;?>','ctrlSecao.php?acao=publicarSecao&amp;local=home&amp;id=<?php echo $secao->id;?>&amp;status=1');">
	<img src="img/seta_sub.gif" class="imgSubMenu" />
	Status: <img src="img/frms/status_offP.gif" alt="inativo" />
</a>
<?
	}
?>