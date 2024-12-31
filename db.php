<?php

/**
  * Open a connection via PDO to create a
  * new database and table with structure.
  *
  */

require "config.php";

 // Create connection
$db_connect = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($db_connect->connect_error) {
    die("Connection failed: " . $db_connect->connect_error);
}