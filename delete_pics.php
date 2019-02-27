<?php

require 'config.php';

$tablename = $params[4];
$fieldName = $params[5];

$fileName = "logs/log_" . date("Y-m-d-H-i-s") . ".txt";

$iterator = new FilesystemIterator('uploads/');

$text = "";

foreach ($iterator as $file) {

	$result = $db->prepare("select " . $fieldName . " from picture where ". $fieldName.  " = ?");

	$result->execute(array($file->getFileName()));

	if($result->rowCount() == 0){

		if(!is_dir("logs")){
			mkdir("logs");
		}

		$text .= $file->getFileName() . " deleted at ". date("d-m-Y H:i:s") . "\n";

		$log_file = fopen($fileName, "w");

		unlink("uploads/" . $file->getFileName());
	}
}


if(file_exists($fileName)){

	fwrite($log_file, $text );	
}

$text = "";