<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Move.php';

$database = new Database();
$db = $database->connect();

$move = new Move($db);
$move->gameid = isset($_GET['gameid']) ? $_GET['gameid'] : die();
$qresult = $move->read_available();
$num = $qresult->rowCount();

if($num >0){
    $moves_arr = array();
    $moves_arr['data'] = array();

    while($row = $qresult->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $move_item = array(
            'field' => $field,
            'symbol' => $symbol
        );

       array_push($moves_arr['data'], $move_item);
    }
    echo json_encode($moves_arr);

} else {
    echo json_encode(
        array('message' => 'no moves recorder')
    );
}


?>