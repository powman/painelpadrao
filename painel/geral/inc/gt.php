<?php
define(PATH_IMG, '../');
$largura = $_REQUEST['w'];
$altura = $_REQUEST['h'];

//$image_file = str_replace('..', '', $_REQUEST['img']); 
$image_file = $_REQUEST['img'];
$origem = PATH_IMG.$image_file; 

$ext = split("[/\\.]",strtolower($origem)); 
$n = count($ext)-1; 
$ext = $ext[$n];

switch(strtoupper($ext)){ 
	case 'JPEG': 
		$tn_formato = 'jpg'; 
		break;
	case 'JPG': 
		$tn_formato = 'jpg'; 
		break; 
	case 'PNG': 
		$tn_formato = 'png'; 
		break;
	case 'GIF': 
		$tn_formato = 'gif';
		break; 
}


$arr = split("[/\\]",$origem); 
$n = count($arr)-1; 
$arra = explode('.',$arr[$n]); 
$n2 = count($arra)-1; 
$tn_name = str_replace('.'.$arra[$n2],'',$arr[$n]); 
//$destino = $destino.$pre.$tn_name.'.'.$tn_formato; 

if ($ext == 'jpg' || $ext == 'jpeg'){ 
	$im = imagecreatefromjpeg($origem); 
}elseif($ext == 'png'){ 
	$im = imagecreatefrompng($origem); 
}elseif($ext == 'gif'){
	$im = imagecreatefromgif($origem);
}

## INI CÁLCULO DO TAMANHO DA IMAGEM ## 
$w = imagesx($im); 
$h = imagesy($im); 
if ($w > $h){ 
	$nw = $largura; 
	$nh = ($h * $largura)/$w; 
}else{ 
	$nh = $altura; 
	$nw = ($w * $altura)/$h; 
}
## FIM CÁLCULO DO TAMANHO DA IMAGEM ##			

if(function_exists('imagecopyresampled')){ 
	if(function_exists('imageCreateTrueColor')){ 
		$ni = imagecreatetruecolor($nw,$nh); 
	}else{ 
		$ni    = imagecreate($nw,$nh); 
	} 
	if($tn_formato=='png'){
		imagealphablending($ni, false);
		$colorTransparent = imagecolorallocatealpha($ni, 0, 0, 0, 127);
		imagefill($ni, 0, 0, $colorTransparent);
		imagesavealpha($ni, true);
		//imagepng($ni,$destino);
	}
	if(!@imagecopyresampled($ni,$im,0,0,0,0,$nw,$nh,$w,$h)){ 
		imagecopyresized($ni,$im,0,0,0,0,$nw,$nh,$w,$h);
	} 
}else{ 
	$ni = imagecreate($nw,$nh); 
	imagecopyresized($ni,$im,0,0,0,0,$nw,$nh,$w,$h); 
}

if($tn_formato=='jpg'){ 
	//imagejpeg($ni,$destino,100); 
	header("Content-type: image/jpeg");
	imagejpeg($ni);
}elseif($tn_formato=='png'){
	//imagepng($ni,$destino);
	header("Content-type: image/png");
	imagepng($ni);
}elseif($tn_formato=='gif'){
	//imagepng($ni,$destino);
	header("Content-type: image/gif");
	imagegif($ni);
}
?>