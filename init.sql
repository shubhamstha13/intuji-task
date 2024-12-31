CREATE DATABASE intuji;
use intuji;
  CREATE TABLE locations (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    latitude DECIMAL(10,6),
    longitude DECIMAL(10,6)
  );
  
  CREATE TABLE weather_realtime (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    location_id INT(11) NOT NULL,
    -- FOREIGN KEY (location_id) REFERENCES locations(id),
    temperature DECIMAL(5, 2) NOT NULL,
    `condition` VARCHAR(255) NOT NULL,
    humidity INT(11) NOT NULL,
    wind_speed DECIMAL(5,2) NOT NULL,
    updated_at TIMESTAMP
  );
  
  CREATE TABLE weather_forecast (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    location_id INT(11) NOT NULL,
    -- FOREIGN KEY (location_id) REFERENCES locations(id),
    date TIMESTAMP NOT NULL,
    min_temp DECIMAL(5,2) NOT NULL,
    max_temp DECIMAL(5,2) NOT NULL,
    `condition` VARCHAR(255) NOT NULL
  );
  
  CREATE TABLE air_quality (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    location_id INT(11) NOT NULL,
    -- FOREIGN KEY (location_id) REFERENCES locations(id),
    aqi INT(11) NOT NULL,
    description VARCHAR(255) NOT NULL
  );