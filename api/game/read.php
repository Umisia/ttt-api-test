<?php 

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Game.php';


$database = new Database();
$db = $database->connect();

$game = new Game($db);
$qresult = $game->read();

$num = $qresult->rowCount();

if($num >0){
    $games_arr = array();
    $games_arr['data'] = array();

    while($row = $qresult->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        if ($result === 0) {
            $result = "lost";
        } else if ($result === 1) {
            $result = "won";
        } else if ($result === 2) {
            $result = "draw";
        } else if ($result === 3) {
            $result = "not finished";
        }
        
        $game_item = array(
            'id' => $id,
            'userid' => $userid,
            'result' => $result
        );
        array_push($games_arr['data'], $game_item);
    }
    echo json_encode($games_arr);

} else {
    echo json_encode(
        array('message' => 'no games found')
    );
}

?>