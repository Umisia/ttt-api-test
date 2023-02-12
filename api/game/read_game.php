<?php 

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Game.php';


$database = new Database();
$db = $database->connect();
$game = new Game($db);

$game->id = isset($_GET['gameid']) ? $_GET['gameid'] : die();
$qresult = $game->read_game_by_id();
$num = $qresult->rowCount();

if($num >0){
    $games_arr = array();
    $games_arr['data'] = array();

    while($row = $qresult->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $game_item = array(
            'gameid' => $gameid,
            'userid' => $userid,
            'gameresult' => $gameresult,
            'field' => $field,
            'symbol' => $symbol,
        );

       array_push($games_arr['data'], $game_item);
    }
    echo json_encode($games_arr);

} else {
    echo json_encode(
        array('message' => 'game not found')
    );
}


?>