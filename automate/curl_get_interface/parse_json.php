<?php

function parseJsonInterface($jsonPath)
{
    $ch = curl_init();

    $headers = [
        "Accept: application/json",
        "Content-Type: application/json",
    ];

    curl_setopt($ch, CURLOPT_URL, $jsonPath);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //note: untuk penggunaan sementara

    $response = curl_exec($ch);
    $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);


    if ($response === false) {
        $errorCode = curl_errno($ch);
        // if ($errorCode == CURLE_OPERATION_TIMEOUTED) {
        //     return ["success" => false, "status" => 504, "message" => "Gateway Timeout"];
        // } else {
        //     return ["success" => false, "status" => 500, "message" => "cURL Error: " . curl_error($ch)];
        // }
        if ($errorCode == CURLE_OPERATION_TIMEOUTED) {
            return ["success" => false, "status" => $statusCode, "message" => "Gateway Timeout"];
        } else {
            return ["success" => false, "status" => $statusCode, "message" => "cURL Error: " . curl_error($ch)];
        }
    }

    curl_close($ch);

    return $response;
}
