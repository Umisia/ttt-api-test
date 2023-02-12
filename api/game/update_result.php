<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PATCH');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Game.php';

$database = new Database();
$db = $database->connect();

$game = new Game($db);

$data = json_decode(file_get_contents("php://input")); 

$game->id = $data->id;
$gresult= $data->result;


if($game->update_result($gresult)){
    $game_arr = array (
        'id' => $game->id,
        'result' => $gresult
    );
    print_r(json_encode($game_arr));
} else {
    echo json_encode(array('message' => 'game not created'));
}


?>