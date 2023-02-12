<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/User.php';


$database = new Database();
$db = $database->connect();

$user = new User($db);
$user->name = isset($_GET['name']) ? $_GET['name'] : die();

if($user->get_user_id_by_username()){
    $user_arr = array(
        'id' => $user->id,
    );
    print_r(json_encode($user_arr));
} else {
    print_r(json_encode(array('id' => -1)));
}


?>