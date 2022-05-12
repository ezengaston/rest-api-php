<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Locations.php';

$database = new Database();
$db = $database->connect();

$locations = new Locations($db);

$locations->id = isset($_GET['id']) ? intval($_GET['id']) : null;

$locations->getSingle();

if (is_null($locations->location_name)) {
    echo json_encode(array(
        "message" => 'Not Found'
    ));
} else {
    echo json_encode(array(
        "data" => array(
            'id' => $locations->id,
            'location_name' => $locations->location_name
        )
    ));
}
