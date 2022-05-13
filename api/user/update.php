<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-Width');

include_once '../../config/Database.php';
include_once '../../models/Users.php';

$database = new Database();
$db = $database->connect();

$users = new Users($db);

$data = json_decode(file_get_contents("php://input"));

$users->id = $data->id;
$users->name = $data->name;
$users->email = $data->email;
$users->location_id = $data->location_id;

if ($users->update()) {
    echo json_encode(array('message' => 'User Updated'));
} else {
    echo json_encode(array('message' => 'User Not Updated'));
}
