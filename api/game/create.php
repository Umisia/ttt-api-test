<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Game.php';


$database = new Database();
$db = $database->connect();

$game = new Game($db);

$data = json_decode(file_get_contents("php://input")); 

$game->userid = $data->userid;
$game->result = $data->result;

if($game->create()){
    $game_arr = array (
        'id' => $game->id
    );
    print_r(json_encode($game_arr));
} else {
    echo json_encode(array('message' => 'game not created'));
}


?>