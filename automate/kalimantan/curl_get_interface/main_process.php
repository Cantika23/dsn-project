
<?php

include "database.php";
include "penerimaan_paket_keluar.php";
include "log_courier.php";
include "parse_json.php";


function outputJsonResponse($data)
{
    header("Content-Type: application/json");
    echo json_encode($data);
    exit(); // Terminate the script
}


date_default_timezone_set("Asia/Jakarta"); //Set local timezone

$conn = establishConnection();

// API Configuration
// $jsonPath = 'https://devapps.dsngroup.co.id/interface_gs/api/send/gs'; // turn off the curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1) in parse_json.php
$jsonPath = 'https://apps.dsngroup.co.id/interface_gs/api/send/gs'; // turn off the curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1) in parse_json.php
// $jsonPath = 'http://127.0.0.1:8000/api/send/gs'; // turn off the curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1) in parse_json.php

// $jsonPath = 'https://gs.dsngroup.co.id/json/interface.json'; // turn on the curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1) in parse_json.php

try {
    // Fetch JSON data from the API
    // $jsonContents = parseJsonInterface($jsonPath, $username, $password);
    $jsonContents = parseJsonInterface($jsonPath);

    // Process the JSON data
    if ($jsonContents === null) {
        $listData = ["success" => true, "status" => 200, "message" => "No data retrieved."];
        outputJsonResponse($listData);
    }

    if (is_array($jsonContents) && isset($jsonContents['success']) && !$jsonContents['success']) {
        $responseData = [
            "success" => false,
            "status" => $jsonContents['status'],
            "message" => $jsonContents['message']
        ];

        $logStatus = insertDataToLogCourierTable($conn, NULL, NULL, "INTF_IN", date('Y-m-d H:i:s'), NULL, NULL, json_encode($responseData), NULL);
        outputJsonResponse($responseData);
    }

    // Check if the JSON decoding was successful
    $data = json_decode($jsonContents, true);


    if ($data === null) {
        $listData = ["success" => true, "status" => 200, "message" => "Data is null."];

        // Insert to table log_courier (req_type = "INTF_IN")
        $logStatus = insertDataToLogCourierTable($conn, NULL, NULL, "INTF_IN", date('Y-m-d H:i:s'), NULL, NULL, json_encode($listData), NULL);

        outputJsonResponse($listData);
    }

    if (empty($data)) {
        // No data retrieved from the API
        $listData = ["success" => true, "status" => 200, "message" => "No data retrieved."];

        // Insert to table log_courier (req_type = "INTF_IN")
        $logStatus = insertDataToLogCourierTable($conn, NULL, NULL, "INTF_IN", date('Y-m-d H:i:s'), NULL, NULL, json_encode($listData), NULL);

        outputJsonResponse($listData);
    }

    if (strtolower($data["message"]) == "no new data!") {
        $emptyResponse = [
            "success" => true,
            "status" => 200,
            "message" => "No new data from Interface.",
            "data_length" => 0
        ];

        $logStatus = insertDataToLogCourierTable($conn, NULL, NULL, "INTF_IN", date('Y-m-d H:i:s'), NULL, NULL, json_encode($emptyResponse), NULL);
        outputJsonResponse($emptyResponse);
    }

    $logContents = [
        "success" => true,
        "status" => 200,
        "message" => "Data retrieved.",
        "data_length" => count($data)
    ];

    // Insert to table log_courier (req_type = "INTF_IN")
    $logStatus = insertDataToLogCourierTable($conn, NULL, NULL, "INTF_IN", date('Y-m-d H:i:s'), NULL, NULL, json_encode($logContents), NULL);

    $listData = ["success" => true, "status" => 200, "response" => []];

    // Loop through the objects in the JSON array
    foreach ($data['data'] as $item) {
        if ($item === null) {
            $listData = ["success" => true, "status" => 200, "message" => "Data is null."];

            // Insert to table log_courier (req_type = "INTF_IN")
            $logStatus = insertDataToLogCourierTable($conn, NULL, NULL, "INTF_IN", date('Y-m-d H:i:s'), NULL, NULL, json_encode($listData), NULL);

            outputJsonResponse($listData);
        }

        $noDokumen = $item['no_dokumen'];

        // Check if the data already exists in the database
        $paketKeluar = getPenerimaanPaketKeluarData($conn, $noDokumen);
        $textQuery = "";

        $response = [
            "no_dokumen" => $noDokumen,
            "message" =>  ""
        ];

        if ($paketKeluar["msg"] == "No Data Found") {
            // Data doesn't exist in the database, insert it
            $insertData = [
                'no_dokumen' => $noDokumen,
                'no_paket' => $item['no_paket'],
                'jenis_dokumen' => $item['jenis_dokumen'],
                'nama_penerima' => $item['nama_penerima'],
                'no_hp_penerima' => $item['no_hp_penerima'],
                'email_penerima' => $item['email_penerima'],
                'created_date' => $item['created_date'],
                'tujuan_penerima' => $item['tujuan_penerima'],
                'status_sap' => $item['status_sap'],
                'id_user' => $item['id_user']
                // 'id_user' => 263
            ];

            $textQuery = $conn->real_escape_string(insertPenerimaanPaketKeluar($conn, $insertData));

            // Insert to table log_courier (req_type = "INSERT_TABLE")
            $logStatus = insertDataToLogCourierTable($conn, NULL, NULL, "INSERT_TABLE", date('Y-m-d H:i:s'), NULL, NULL, json_encode($insertData), $textQuery);

            $response["message"] = "Data successfully inserted!";
        } else if ($paketKeluar["msg"] == "Data Found") {

            // Data already exists in the database, update it if necessary
            $textQuery = $conn->real_escape_string(updatePenerimaanPaketKeluar($conn, $item));

            // Insert to table log_courier (req_type = "INSERT_TABLE")
            $logStatus = insertDataToLogCourierTable($conn, NULL, NULL, "UPDATE_TABLE", date('Y-m-d H:i:s'), NULL, NULL, json_encode($item), $textQuery);

            $response["message"] = "Data successfully updated!";
        }

        array_push($listData["response"], $response);
    }

    // Insert to table log_courier (req_type = "RESP_GS")
    $logStatus = insertDataToLogCourierTable($conn, NULL, NULL, "RESP_GS", date('Y-m-d H:i:s'), NULL, NULL, json_encode($listData), NULL);

    outputJsonResponse($listData);
} catch (Exception $e) {
    $errorResponse = [
        "success" => false,
        "status" => 500,
        "message" => "Error: " . $e->getMessage()
    ];

    // Insert to table log_courier (req_type = "RESP_GS")
    $logStatus = insertDataToLogCourierTable($conn, NULL, NULL, "RESP_GS", date('Y-m-d H:i:s'), NULL, NULL, json_encode($errorResponse), NULL);

    outputJsonResponse($errorResponse);
}
