<?php

// include "penerimaan_paket_keluar.php";
include "http_request.php";
// date('Y-m-d H:i:s') to input datetime

function fetchAPIFromBinderByte($baseUrl, $params, $apiKey, $courier, $awb)
{
    // $courier = "tiki";
    // $awb = "030217319046";

    return http_request($baseUrl . "/" . $params . "?api_key=" . $apiKey . "&courier=" . $courier . "&awb=" . $awb);
}
