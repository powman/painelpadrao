<?php
define(PATH_IMG, '');
$logoMarca = "img/marcaDAgua/logo.png";
$largura = $_REQUEST['w'];
$altura = $_REQUEST['h'];



if(!file_exists($_REQUEST["img"])) {
    $img = imagecreate($_REQUEST["w"], $_REQUEST["h"]);
    //imagecolorallocate($img, 150, 100, 100);
    imagecolorallocate($img, 200, 200, 200);
    $logo = imagecreate($_REQUEST["w"], $_REQUEST["h"]);
    header('Cache-Control: public, must-revalidate, max-age=3600');
    header('Content-Type: image/png');
    imagejpeg($img);
    exit;
}

//$image_file = str_replace('..', '', $_REQUEST['img']);
$image_file = $_REQUEST['img'];
$origem = PATH_IMG.$image_file;

$ext = explode(".",strtolower($origem));
$n = count($ext)-1;
$ext = $ext[$n];

switch(strtoupper($ext)) {
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


$arr = explode("[/\\]",$origem);
$n = count($arr)-1;
$arra = explode('.',$arr[$n]);
$n2 = count($arra)-1;
$tn_name = str_replace('.'.$arra[$n2],'',$arr[$n]);
//$destino = $destino.$pre.$tn_name.'.'.$tn_formato;

if ($ext == 'jpg' || $ext == 'jpeg') {
    $im = imagecreatefromjpeg($origem);
}elseif($ext == 'png') {
    $im = imagecreatefrompng($origem);
}elseif($ext == 'gif') {
    $im = imagecreatefromgif($origem);
}

$logo = imagecreatefrompng($logoMarca);

## INI C�LCULO DO TAMANHO DA IMAGEM ##
$w = imagesx($im);
$h = imagesy($im);

$largura = isset($_REQUEST['w'])?$_REQUEST['w']:($w * $_REQUEST["h"])/$h;
$altura = isset($_REQUEST['h'])?$_REQUEST['h']:($h * $_REQUEST["w"])/$w;

$wLogo = imagesx($logo);
$hLogo = imagesy($logo);


if($largura==$_REQUEST['w']) {
    if ($w < $h) {
    $nw = $largura;
    $nh = ($h * $largura)/$w;
    }else {
        $nh = $altura;
    $nw = ($w * $altura)/$h;
    }
} else if ($altura==$_REQUEST['h']){
    if ($w > $h) {
    $nw = $largura;
    $nh = ($h * $largura)/$w;
    } else {
        $nh = $altura;
    $nw = ($w * $altura)/$h;
    }
}

$logoF = imagecreatetruecolor(170,85);
imagealphablending($logoF, true);
$colorTransparent = imagecolorallocatealpha($logoF, 0, 0, 0, 127);
imagefill($logoF, 0, 0, $colorTransparent);
imagesavealpha($logoF, true);

if ($wLogo > $hLogo) {
    $nwLogo = 125;
    $nhLogo = ($hLogo * 125)/$wLogo;
    $nhLogo = 100;
}else {
    $nhLogo = 100;
    $nwLogo = ($wLogo * 100)/$hLogo;
}



## FIM C�LCULO DO TAMANHO DA IMAGEM ##

if(function_exists('imagecopyresampled')) {
    if(function_exists('imageCreateTrueColor')) {
        $ni = imagecreatetruecolor($nw,$nh);
    }else {
        $ni    = imagecreate($nw,$nh);
    }
    if($tn_formato=='png') {
        imagealphablending($ni, false);
        $colorTransparent = imagecolorallocatealpha($ni, 0, 0, 0, 127);
        imagefill($ni, 0, 0, $colorTransparent);
        imagesavealpha($ni, true);


    //imagepng($ni,$destino);
    }
    if(!@imagecopyresampled($ni,$im,0,0,0,0,$nw,$nh,$w,$h)) {
        imagecopyresized($ni,$im,0,0,0,0,$nw,$nh,$w,$h);
    }
}else {
    $ni = imagecreate($nw,$nh);
    imagecopyresized($ni,$im,0,0,0,0,$nw,$nh,$w,$h);
}
if($_REQUEST["download"]==1) {
    header('Content-Disposition: attachment; filename="' . "imagem.".$tn_formato . '"');
    header('Expires: 0');
    header('Pragma: no-cache');
}
header('Cache-Control: public, must-revalidate, max-age=3600');

if($tn_formato=='jpg') {
//imagejpeg($ni,$destino,100);
    header("Content-type: image/jpeg");
    if($_REQUEST["l"]==="1") {
        if($nh>$wLogo*2 && $nh>$hLogo*2) {
        //imagecopyresized($logoF, $logo, 0, 0, 0, 0,150 , 85, $wLogo, $hLogo);

            imagecopymerge($ni,$logo,$nw-110,$nh-82,0,0,116,85,65);
            //imagecopymergegray($ni,$logo,445,390,0,0,99,52,100);
        }
    }
    //imagecopymergegray($ni,$logo,445,390,0,0,99,52,100);
    imagejpeg($ni,NULL,85);
}elseif($tn_formato=='png') {
//imagepng($ni,$destino);
    header("Content-type: image/png");
    //imagecopymerge($ni,$logo,0,0,0,0,$nwLogo,$nhLogo,100);
    imagepng($ni);
}elseif($tn_formato=='gif') {
//imagepng($ni,$destino);
    header("Content-type: image/gif");

    imagegif($ni);
}

imagedestroy($logoF);
imagedestroy($ni);

?>