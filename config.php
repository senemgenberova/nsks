<?php

$params = [];

$config_file = fopen("config.txt", 'r');

while($line = fgets($config_file)){
	$param = trim(substr($line, strpos($line, "=") + 1)) ;
	array_push($params, $param);
}

fclose($config_file);

try{

	$db = new PDO("mysql:host=" . $params[0] . ";dbname=" . $params[1], $params[2], $params[3]);

}
catch(PDOException $e){
	die("Connection failed");
}