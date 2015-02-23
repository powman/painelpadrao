<?php
//http://192.168.7.206/sites/_www.excelencia.com.br/novo/imagem/150x150/js/nivo/demo/images/toystory3.jpg
//192.168.7.206/sites/_www.excelencia.com.br/novo/imagem_water/150x150/js/nivo/demo/images/toystory3.jpg




include('painel/geral/classes/thumb/ImageTools.class.php');

// ensure there was a thumb in the URL
if (!$_GET['thumb']) {
    //error('no thumb');
}

// get the thumbnail from the URL
$thumb = strip_tags(htmlspecialchars($_GET['thumb']));

// get the image and size
$thumb_array = explode('/', $thumb);
$size = array_shift($thumb_array);
$image = '' . implode('/', $thumb_array);
list($width, $height) = explode('x', $size);

$image = base64_decode($image);
$image_mime = image_type_to_mime_type(exif_imagetype($image));

if($image_mime == 'application/octet-stream'){
	$image	= "img/sem_foto.gif";
}

$img = new ImageTools($image);
if($width && $height){
	$img->resizeNewByWidth($width,$height,$width); // new width, new height
}else if($width){
	$img->resizeWidth($width); // new width
}else if($height){
	$img->resizeHeight($height); // new height
}
$img->showImage();
$img->destroy();

exit();
?>
