<?php

include "database.php";
include "penerimaan_paket_keluar.php";
include "log_courier.php";

date_default_timezone_set("Asia/Jakarta"); //Set local timezone

$conn = establishConnection();

// Create array to be JSON OUT
$listData = ["success" => true, "status" => 200, "message" => "No new data!"];

// API Configuration
// $jsonPath = 'http://192.168.220.32:8000/zcommercial/get_packlist?sap-client=300';
// $username = 'it-rfc';
// $password = 'ThinkPad123Dev';

try {
    // Process GET TABLE
    $reqType = "GET_TABLE";
    $dateTime = date('Y-m-d H:i:s');


    // Check if the JSON decoding was successful
    $paketKeluar = getPenerimaanPaketKeluarNewData($conn);

    // Insert to table log_courier (req_type = "JSON_IN")
    $logStatus = insertDataToLogCourierTable($conn, NULL, NULL, $reqType, $dateTime, NULL, NULL, json_encode($paketKeluar), NULL);
    if ($paketKeluar === null) {
        // No data retrieved from the API
        $listData["message"] = "No new data!";
    } else {
        $listData["data"] = [];
        // Loop through the objects in the JSON array
        foreach ($paketKeluar as $item) {
            $noDokumen = $item['no_dokumen'];
            $noPaket = $item['no_paket'];
            $jenisDokumen = $item['jenis_dokumen'];
            $namaPenerima = $item['nama_penerima'];
            $noHpPenerima = $item['no_hp_penerima'];
            $emailPenerima = $item['email_penerima'];
            $tujuanPenerima = $item['tujuan_penerima'];
            $createdDate = $item['created_date'];
            $idUser = $item['id_user'];
            $statusSap = $item['status_sap'];

            // Data doesn't exist in the database, insert it
            $getData = [
                'no_dokumen' => $noDokumen,
                'no_paket' => $noPaket,
                'jenis_dokumen' => (int)$jenisDokumen,
                'nama_penerima' => $namaPenerima,
                'no_hp_penerima' => $noHpPenerima,
                'email_penerima' => $emailPenerima,
                'tujuan_penerima' => $tujuanPenerima,
                'created_date' => $createdDate,
                'status_sap' => $statusSap,
                'id_user' => (int)$idUser
            ];

            $reqType = "UPDATE_JSON";
            $dateTime = date('Y-m-d H:i:s');
            $content = json_encode($getData);

            // Insert to table log_courier (req_type = "INSERT_TABLE")
            $logStatus = insertDataToLogCourierTable($conn, NULL, NULL, $reqType, $dateTime, NULL, NULL, $content, NULL);

            $listData["message"] = "Append new data to JSON.";
            array_push($listData["data"], $getData);
        }
    }
} catch (Exception $e) {
    $listData["success"] = false;
    $listData["status"] = 500;
    $listData["message"] = $e->getMessage();
}

$reqType = "JSON_OUT";
$dateTime = date('Y-m-d H:i:s');
$content = json_encode($listData);

// Insert to table log_courier (req_type = "JSON_OUT")
$logStatus = insertDataToLogCourierTable($conn, NULL, NULL, $reqType, $dateTime, NULL, NULL, $content, NULL);

header("Content-Type: application/json");
echo $content;
