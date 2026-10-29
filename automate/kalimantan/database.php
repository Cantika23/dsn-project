<?php

function establishConnection()
{
    $hostName = "localhost";
    
    // QA
    // $userName = "sql_aplikasigs_c";
    // $password = "zdma3cKNKNLfERrk";
    // $databaseName = "sql_aplikasigs_c";
    
    // Production
    $userName = "gs_prod_kalimantan";
    $password = "3EC8pNKP8XWhL33J";
    $databaseName = "gs_prod_kalimantan";

    $conn = new mysqli($hostName, $userName, $password, $databaseName);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}
