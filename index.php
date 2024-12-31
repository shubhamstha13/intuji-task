<?php
include 'db.php';
header("Content-Type: application/json");

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

switch ($request) {
    case '/intuji/database-setup':
        if($method == 'GET'){
            require 'install.php';
        }else{
            echo json_encode(['message' => 'Invalid request method']);
        }
        break;
        
    case '/intuji/database-seed':
        if($method == 'GET'){
            
        }else{
            echo json_encode(['message' => 'Invalid request method']);
        }
        break;

    case '/intuji/weather/realtime?location=' . $_GET['location']:
        if($method == 'GET'){
            weatherRealtime($_GET['location']);
        }else{
            echo json_encode(['message' => 'Invalid request method']);
        }
        break;
        
    default:
        echo json_encode(['message' => 'Invalid request url.']);
        break;
}

function weatherRealtime($location){
    $location_id = $db_connect->query("SELECT id FROM location WHERE name=$location");
    $result = $conn->query("SELECT locations.name as location, temperature , `condition`, humidity ,wind_speed from weather_realtime JOIN locations where locations.id = $location_id");
    $data = $result->fetch_assoc();
    echo json_encode($data);
}  