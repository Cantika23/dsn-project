<?php

function insertDataToLogCourierTable($conn, $awb, $courier, $reqType, $dateTime, $parameter, $response, $content, $textQuery)
{


    $sql = "INSERT INTO log_courier (awb, kurir, req_type, datetime, parameter, response, content, text_query) VALUES ('$awb', '$courier', '$reqType', '$dateTime', '$parameter', '$response', '$content', '$textQuery')";
    if (mysqli_query($conn, $sql)) {
        if ($reqType == "REQ") {
            $status = "New record created successfully ($reqType) with parameter => '$parameter'";
        } else if ($reqType == "RESP") {
            $status = "New record created successfully ($reqType) with content => '$content'";
        } else {
            $status = "New record created successfully ($reqType) with textQuery => '$textQuery'";
        }
        return $status;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// function getLogCourier($conn, $columns)
// {
//     $tableName = 'log_courier';

//     if (empty($conn)) {
//         $msg = "Database connection error";
//     } elseif (empty($columns) || !is_array($columns)) {
//         $msg = "columns Name must be defined in an indexed array";
//     } elseif (empty($tableName)) {
//         $msg = "Table Name is empty";
//     } else {
//         $columnName = implode(", ", $columns);
//         $query = "SELECT " . $columnName . " FROM $tableName ORDER BY id ASC";
//         $result = $conn->query($query);
//         if ($result == true) {
//             if ($result->num_rows > 0) {
//                 $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
//                 $msg = $row;
//             } else {
//                 $msg = "No Data Found";
//             }
//         } else {
//             $msg = mysqli_error($conn);
//         }
//     }
//     return $msg;
// }
