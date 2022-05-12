<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-Width');

include_once '../../config/Database.php';
include_once '../../models/Locations.php';

$database = new Database();
$db = $database->connect();

$locations = new Locations($db);

$data = json_decode(file_get_contents("php://input"));

$locations->id = $data->id;
$locations->location_name = $data->location_name;

if ($locations->update()) {
    echo json_encode(array('message' => 'Location Updated'));
} else {
    echo json_encode(array('message' => 'Location Not Updated'));
}
