<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Users.php';

$database = new Database();
$db = $database->connect();

$users = new Users($db);

$results = $users->getAll();

$num = $results->rowCount();

if ($num > 0) {
    $users_arr = array('data' => array());

    while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
        $user = array(
            'id' => $row['id'],
            'name' => $row['name'],
            'email' => $row['email'],
            'location_id' => $row['location_id']
        );

        array_push($users_arr['data'], $user);
    }

    echo json_encode($users_arr);
} else {
    echo json_encode(array('message' => 'No results found'));
}
