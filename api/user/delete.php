<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-Width');

include_once '../../config/Database.php';
include_once '../../models/Users.php';

$database = new Database();
$db = $database->connect();

$users = new Users($db);

$data = json_decode(file_get_contents("php://input"));

$users->id = $data->id;

if ($users->delete()) {
    echo json_encode(array('message' => 'User Deleted'));
} else {
    echo json_encode(array('message' => 'User Not Deleted'));
}
