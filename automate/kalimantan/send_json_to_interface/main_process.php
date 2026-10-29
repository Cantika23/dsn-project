<?php

include "database.php";
include "penerimaan_paket_keluar.php";
include "log_courier.php";
include "http_request.php";

function outputJsonResponse($data)
{
    header("Content-Type: application/json");
    echo json_encode($data);
    exit(); // Terminate the script
}

date_default_timezone_set("Asia/Jakarta"); // Set local timezone

$conn = establishConnection();

// $apiPath = 'https://devapps.dsngroup.co.id/interface_gs/api/receive/gs';
$apiPath = 'https://apps.dsngroup.co.id/interface_gs/api/receive/gs';
// $apiPath = 'http://127.0.0.1:8000/api/receive/gs';

try {
    $paketKeluar = getPenerimaanPaketKeluarProcessedKurir($conn);
    $reqType = "GET_TABLE";

    $logData = [
        "success" => true,
        "status" => 200,
        "message" => "$reqType process",
        "data_length" => $paketKeluar === "No Data Found" ? 0 : count($paketKeluar)
    ];

    insertDataToLogCourierTable($conn, NULL, NULL, $reqType, date('Y-m-d H:i:s'), NULL, NULL, json_encode($logData), NULL);

    if ($paketKeluar === null || $paketKeluar === "No Data Found") {
        $responseData = [
            "success" => true,
            "status" => 200,
            "message" => "No new data."
        ];

        insertDataToLogCourierTable($conn, NULL, NULL, $reqType, date('Y-m-d H:i:s'), NULL, NULL, json_encode($responseData), NULL);
        outputJsonResponse($responseData);
    } else {
        $postData = [];
        foreach ($paketKeluar as $item) {
            $getData = [
                'no_dokumen' => strval($item['no_dokumen']),
                'tanggal_terima' => $item['tanggal_terima'],
                'nama_penerima' => $item['nama_penerima'],
                'no_awb' => $item['no_awb'],
                'nama_kurir' => $item['nama_kurir'],
                'jenis_pengirim' => $item['jenis_pengirim'],
                'status_sap' => (int)$item['status_sap']
            ];

            $reqType = "UPDATE_JSON";
            insertDataToLogCourierTable($conn, NULL, NULL, $reqType, date('Y-m-d H:i:s'), NULL, NULL, json_encode($getData), NULL);

            array_push($postData, $getData);
        }

        $response = httpPost($apiPath, json_encode($postData));

        // Handle 504 Gateway Timeout
        if (strpos($response, 'API request failed with status code 504') !== false) {
            $logData = [
                "success" => false,
                "status" => 504,
                "message" => "504 Gateway Timeout"
            ];

            insertDataToLogCourierTable($conn, NULL, NULL, $reqType, date('Y-m-d H:i:s'), NULL, NULL, json_encode($logData), NULL);
            outputJsonResponse($logData);
        }


        $decodedResponse = json_decode($response);
        $reqType = "RESP_INTF";


        if ($response === null || $decodedResponse->response === null || empty($decodedResponse->response)) {
            $logData = [
                "success" => false,
                "status" => 500,
                "message" => "HTTP POST return null response or decoded JSON response is empty"
            ];

            insertDataToLogCourierTable($conn, NULL, NULL, $reqType, date('Y-m-d H:i:s'), NULL, NULL, json_encode($logData), NULL);
            outputJsonResponse($logData);
        } else {
            $responseData = [
                "success" => true,
                "status" => 200,
                "message" => "POST data success.",
                "data_length" => count($decodedResponse->response),
                "response" => []
            ];

            foreach ($decodedResponse->response as $item) {
                $updatePaketKeluar = "Status_sap not updated.";

                if (!$item->data_found) {
                    $responseMessage = "$item->no_dokumen not found in Interface database";
                } else if (!$item->is_updated) {
                    $responseMessage = "Failed to update $item->no_dokumen in Interface database";
                } else {
                    $currentStatusSap = getStatusSapByNoDokumen($conn, $item->no_dokumen);

                    if (empty($currentStatusSap)) {
                        $responseMessage = "$item->no_dokumen doesn't exist in GS database";
                    } else if ((int)$currentStatusSap["status_sap"] === 2) {
                        $updatePaketKeluar = updateStatusSapByNoDokumen($conn, $item->no_dokumen, 3);
                        $responseMessage = strval($updatePaketKeluar);
                    } else {
                        $responseMessage = "$item->no_dokumen in GS database with status_sap 0 or 1 will not be updated to 3";
                    }
                }

                array_push($responseData["response"], [
                    "no_dokumen" => $item->no_dokumen,
                    "message" => $responseMessage
                ]);
            }

            $reqType = "RESP_GS";

            $logData = [
                "success" => true,
                "status" => 200,
                "message" => "$reqType process",
                "data_length" => count($responseData["response"])
            ];

            insertDataToLogCourierTable($conn, NULL, NULL, $reqType, date('Y-m-d H:i:s'), NULL, NULL, json_encode($logData), NULL);
            outputJsonResponse($responseData);
        }
    }
} catch (Throwable $e) {
    $responseData = [
        "success" => false,
        "status" => 500,
        "message" => $e->getMessage()
    ];

    $reqType = "RESP_ERR";

    insertDataToLogCourierTable($conn, NULL, NULL, $reqType, date('Y-m-d H:i:s'), NULL, NULL, json_encode($responseData), NULL);
    outputJsonResponse($responseData);
}
