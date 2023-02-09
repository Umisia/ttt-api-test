<?php

header('Access-Control-Allow-Origin: *'); 
header("Content-Type: application/json; charset=UTF-8"); 

$json = file_get_contents('php://input');
$datar = json_decode($json);

$p1 = $datar -> player1;
$p2 = $datar -> player2;
echo $p1;
echo $p2;
?>
