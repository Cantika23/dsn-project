<?php

include "database.php";
include "penerimaan_paket_keluar.php";
include "log_courier.php";

function outputJsonResponse($data)
{
    header("Content-Type: application/json");
    echo json_encode($data);
    exit();
}

date_default_timezone_set("Asia/Jakarta"); //Set local timezone

$conn = establishConnection();

try {
    // Process GET TABLE
    $reqType = "GET_TABLE";
    $dateTime = date('Y-m-d H:i:s');


    // Check if the JSON decoding was successful
    $paketKeluar = getPenerimaanPaketKeluarForInterface($conn);
    $logContent = ["success" => true, "status" => 200, "message" => "Get data from table", "data_length" => $paketKeluar["data_length"]];

    // Insert to table log_courier (req_type = "JSON_IN")
    $logStatus = insertDataToLogCourierTable($conn, NULL, NULL, $reqType, $dateTime, NULL, NULL, json_encode($logContent), NULL);

    if ($paketKeluar["msg"] == "No Data Found") {
        $listData = [
            "success" => true,
            "status" => 200,
            "message" => "No new data!"
        ];
        outputJsonResponse($listData);
    }

    $listData = [
        "success" => true,
        "status" => 200,
        "message" => "Data found",
        "data" => []
    ];

    // Loop through the objects in the JSON array
    foreach ($paketKeluar["data"] as $item) {
        $noDokumen = $item['no_dokumen'];
        $noAWB = $item['no_awb'];
        $tanggalTerima = $item['tanggal_terima'];
        $statusSap = $item['status_sap'];
        $idUser = $item['id_user'];

        // Data doesn't exist in the database, insert it
        $getData = [
            'no_dokumen' => $noDokumen,
            'tanggal_terima' => $tanggalTerima,
            'no_awb' => $noAWB,
            'status_sap' => (int)$statusSap,
            'id_user' => (int)$idUser
        ];

        // Insert to table log_courier (req_type = "UPDATE_JSON")
        $logStatus = insertDataToLogCourierTable($conn, NULL, NULL, "UPDATE_JSON", date('Y-m-d H:i:s'), NULL, NULL, json_encode($getData), NULL);

        $listData["message"] = "Append new data to JSON.";
        array_push($listData["data"], $getData);
    }

    // Insert to table log_courier (req_type = "GS_OUT")
    $logStatus = insertDataToLogCourierTable($conn, NULL, NULL, "GS_OUT", date('Y-m-d H:i:s'), NULL, NULL,  json_encode($listData), NULL);
    outputJsonResponse($listData);
} catch (Exception $e) {
    $errorResponse = [
        "success" => false,
        "status" => 500,
        "message" => "Error exception with message: " . $e->getMessage()
    ];
    outputJsonResponse($errorResponse);
}
