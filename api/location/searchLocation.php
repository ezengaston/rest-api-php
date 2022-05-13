<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Locations.php';

$database = new Database();
$db = $database->connect();

$locations = new Locations($db);

$search = isset($_GET['search']) ? $_GET['search'] : null;

$result = $locations->searchLocation("%$search%");

if (is_null($result)) {
    echo json_encode(array(
        "message" => 'Not Found'
    ));
} else {
    echo json_encode(array("data" => $result));
}
