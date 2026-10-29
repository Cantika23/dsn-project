<?php

// require "http_request.php";
include "database.php";
include "penerimaan_paket_keluar.php";
include "log_courier.php";
include "fetch_cek_resi_api.php";

date_default_timezone_set("Asia/Jakarta"); //Set local timezone

$conn = establishConnection();

$parameter_list = [
    "awb" => "",
    "kurir" => "",
    "link" => ""
];

// $statusPaket = 5; //3 = diproses, 5 = diterima
// $noAWB = "NOT NULL";

$paketKeluar = getPenerimaanPaketKeluarDataWhereAWBNotNull($conn);

$apiKey = "daecf0e62eecb2daab15bcaff4c8b28a40bbd27b1899a44ecbd13c6d42973bfa";
$baseUrl = "https://api.binderbyte.com";
$params = "v1/track";

$jsonOut = ["status"=>200,"message"=>true];

// var_dump($paketKeluar);
// die();

if($paketKeluar != null && $paketKeluar != "No Data Found"){
    $jsonOut["data"] = [];
    // Proses input data ke log_courier
    foreach ($paketKeluar as $pk) {
        $courier = $pk['nama_kurir']; //penyedia jasa (e.g. JNE, TiKi, POS)
        $awb = $pk['no_awb'];
        $link = $baseUrl . $params;
    
        $parameter_list['awb'] = $awb;
        $parameter_list['kurir'] = strtolower($courier);
        $parameter_list['link'] = $link;
    
        $parameter = json_encode($parameter_list);
    
        $reqType = "REQ";
        $dateTime = date('Y-m-d H:i:s');
    
        // Insert to table log_courier (req_type = "REQ")
        $logStatus = insertDataToLogCourierTable($conn, $awb, $courier, $reqType, $dateTime, $parameter, NULL, NULL, NULL);
        // echo "REQUEST\r\n";
        // print_r($logStatus);
        // echo "\r\n\r\n";
    
    
        $track = fetchAPIFromBinderByte($baseUrl, $params, $apiKey, $courier, $awb);
    
        $reqType = "RESP";
        $dateTime = date('Y-m-d H:i:s');
    
        // ubah string JSON menjadi array
        $track = json_decode($track, TRUE);
    
        if ($track['status'] == 200) {
            $response = "success";
        } else {
            $response = "failed";
        }
        // $jsonOut["data"] = $track['data'];
        $jsonOut["message"] = "tanggal_terima successfully updated!";
        $content = json_encode($track);
    
        // Insert to table log_courier (req_type = "RESP")
        $logStatus = insertDataToLogCourierTable($conn, NULL, NULL, $reqType, $dateTime, NULL, $response, $content, NULL);
        // echo "RESPONSE\r\n";
        // print_r($logStatus);
        // echo "\r\n\r\n";
    
    
        $reqType = "UPDATE_TABLE";
        $dateTime = date('Y-m-d H:i:s');
        
        if ($response == "success") {
    
            $statusPaket = $track['data']['summary']['status'];
            $tanggalDiterima = $track['data']['summary']['date'];
            $awb = $track['data']['summary']['awb'];
            $namaPenerima = '';
            if ($statusPaket == "DELIVERED") {
                $namaPenerima = $track['data']['detail']['receiver'];
                $textQuery = $conn->real_escape_string(updatePenerimaanPaketKeluar($conn, $statusPaket, $awb, $tanggalDiterima, $namaPenerima, 2));
                
                $arrayData = [
                                "status_paket" => $statusPaket,
                                "tanggal_terima" => $tanggalDiterima,
                                "no_awb" => $awb,
                                "nama_penerima" => $namaPenerima
                            ];
                
                array_push($jsonOut["data"], $arrayData);
            } else {
                $textQuery = NULL;
            }
    
        }else if($response == "failed"){
            
            $textQuery = $conn->real_escape_string(updatePenerimaanPaketKeluar($conn, $statusPaket, $awb, $tanggalDiterima, $namaPenerima, 0));
            
        }
            $logStatus = insertDataToLogCourierTable($conn, NULL, NULL, $reqType, $dateTime, NULL, NULL, NULL, $textQuery);
            // echo "UPDATE_TABLE\r\n";
            // print_r($logStatus);
            // echo "\r\n\r\n";
    }
}else{
        $reqType = "GET_TABLE";
        $dateTime = date('Y-m-d H:i:s');
    
        $parameter = json_encode($parameter_list);
        
        // Insert to table log_courier (req_type = "REQ")
        $logStatus = insertDataToLogCourierTable($conn, NULL, NULL, $reqType, $dateTime, $parameter, NULL, 'no content', NULL);
        
        $jsonOut["status"] = 204;
        $jsonOut["message"] = "No tanggal_terima updated";
}

$content = json_encode($jsonOut);
header("Content-Type: application/json");
echo $content;
