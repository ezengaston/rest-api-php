<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Users.php';

$database = new Database();
$db = $database->connect();

$users = new Users($db);

$search = isset($_GET['search']) ? $_GET['search'] : null;

$result = $users->searchUserByLocation("%$search%");

if (is_null($result)) {
    echo json_encode(array(
        "message" => 'Not Found'
    ));
} else {
    echo json_encode(array("data" => $result));
}
