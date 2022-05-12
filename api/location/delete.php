<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-Width');

include_once '../../config/Database.php';
include_once '../../models/Locations.php';

$database = new Database();
$db = $database->connect();

$locations = new Locations($db);

$data = json_decode(file_get_contents("php://input"));

$locations->id = $data->id;

if ($locations->delete()) {
    echo json_encode(array('message' => 'Location Deleted'));
} else {
    echo json_encode(array('message' => 'Location Not Deleted'));
}
