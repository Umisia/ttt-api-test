<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Move.php';


$database = new Database();
$db = $database->connect();

$move = new Move($db);

$data = json_decode(file_get_contents("php://input")); 

$move->gameid = $data->gameid;
$move->field = $data->field;
$move->symbol = $data->symbol;

if($move->register()){
    echo json_encode(array('message' => 'move registered'));
} else {
    echo json_encode(array('message' => 'move not registered'));
}


?>