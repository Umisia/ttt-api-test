<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Game.php';


$database = new Database();
$db = $database->connect();

$game = new Game($db);
$username = isset($_GET['username']) ? $_GET['username'] : die();
$qresult = $game->read_by_username($username);
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
            'username' => $username,
        );

       array_push($games_arr['data'], $game_item);
    }
    echo json_encode($games_arr);

} else {
    echo json_encode(
        array('message' => 'no games found for user '.$username)
    );
}
?>