<?php
require_once("db.php");
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

    case '/intuji/weather/generate':
        if($method == 'POST'){
            weatherGenerate();
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

    case '/intuji/weather/forecast?location=' . $_GET['location']:
        if($method == 'GET'){
            weatherForecast($_GET['location']);
        }else{
            echo json_encode(['message' => 'Invalid request method']);
        }
        break;
  
    case '/intuji/weather/airquality?location=' . $_GET['location']:
        if($method == 'GET'){
            airQuality($_GET['location']);
        }else{
            echo json_encode(['message' => 'Invalid request method']);
        }
        break;
        
    default:
        echo json_encode(['message' => 'Invalid request url.']);
        break;
}

function weatherRealtime($conn,$location){
    $location_id = $conn->query("SELECT id FROM location WHERE name=$location");
    $result = $conn->query("SELECT locations.name as location, temperature , `condition`, humidity ,wind_speed from weather_realtime JOIN locations where locations.id = $location_id");
    $data = $result->fetch_assoc();
    echo json_encode($data);
}  

function weatherForecast($conn,$location){
    $location_id = $conn->query("SELECT id FROM location WHERE name=$location");
    $result = $conn->query("SELECT locations.name as location, `date` , max_temp as maximum_temperature ,min_temp as minimum_temperature , `condition` from weather_forecast JOIN locations where locations.id = $location_id AND date > date(now() - INTERVAL 3 day)");
    $data = $result->fetch_assoc();
    echo json_encode($data);
}  

function airQuality($conn,$location){
    $location_id = $conn->query("SELECT id FROM location WHERE name=$location");
    $result = $conn->query("SELECT locations.name as location, aqi , description from weather_forecast JOIN locations where locations.id = $location_id");
    $data = $result->fetch_assoc();
    echo json_encode($data);
}  

function weatherGenerate(){
    
}