<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/User.php';

$database = new Database();
$db = $database->connect();

$user = new User($db);

$data = json_decode(file_get_contents("php://input"));

$user->name = $data->name;

if($user->create()){
        $user_arr = array(
            'id' => $user->id
        );
        print_r(json_encode($user_arr));
} else {
    echo json_encode(array('message' => 'user not created'));
}


?>
