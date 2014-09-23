<?php

// This is a simplified example, which doesn't cover security of uploaded files. 
// This example just demonstrate the logic behind the process.

// files storage folder
$dir = '../arquivos/images/';

move_uploaded_file($_FILES['file']['tmp_name'], $dir.$_FILES['file']['name']);
					
$array = array(
	'filelink' => "sistema/".$dir.$_FILES['file']['name'],
	'filename' => $_FILES['file']['name']
);

echo stripslashes(json_encode($array));
	
?>