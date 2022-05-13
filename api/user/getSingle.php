<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Users.php';

$database = new Database();
$db = $database->connect();

$users = new Users($db);

$users->id = isset($_GET['id']) ? intval($_GET['id']) : null;

$results = $users->getSingle();

if (is_null($users->name)) {
    echo json_encode(array(
        "message" => 'Not Found'
    ));
} else {
    echo json_encode(array(
        "data" => array(
            'id' => $users->id,
            'name' => $users->name,
            'email' => $users->email,
            'location_id' => $users->location_id
        )
    ));
}
