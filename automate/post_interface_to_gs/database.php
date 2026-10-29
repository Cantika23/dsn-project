<?php

function establishConnection()
{
    $hostName = "localhost";
    $userName = "sql_aplikasigs_c";
    $password = "zdma3cKNKNLfERrk";
    $databaseName = "sql_aplikasigs_c";

    $conn = new mysqli($hostName, $userName, $password, $databaseName);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}
