<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Locations.php';

$database = new Database();
$db = $database->connect();

$locations = new Locations($db);

$results = $locations->getAll();

$num = $results->rowCount();

if ($num > 0) {
    $locations_arr = array('data' => array());

    while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
        $location = array(
            'id' => $row['id'],
            'location_name' => $row['location_name']
        );

        array_push($locations_arr['data'], $location);
    }

    echo json_encode($locations_arr);
} else {
    echo json_encode(array('message' => 'No results found'));
}
