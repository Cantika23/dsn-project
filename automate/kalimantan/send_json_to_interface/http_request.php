<?php

function httpPost($url, $data)
{
    $curl = curl_init();

    $headers = array(
        "Accept: application/json",
        "Content-Type: application/json",
    );

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

    $resp = curl_exec($curl);
    $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    if ($statusCode !== 200) {
        throw new Exception('API request failed with status code ' . $statusCode);
    }

    curl_close($curl);

    return $resp;
}
