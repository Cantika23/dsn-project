<?php

/**
 * using mysqli_connect for database connection
 */

$server = "localhost";
$username ="zaenal";
$password = "181299Sinta!";
$database ="gs_prod";

$connect = mysqli_connect($server,$username,$password,$database);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}