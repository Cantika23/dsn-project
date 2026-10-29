<?php 

include("koneksi.php");
  
 // Add pagination parameters
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 100;
$offset = ($page - 1) * $limit;

$result = mysqli_query($con_signin, "select penerimaan_paket_keluar.*, m_jenis_dokumen.jenis_dokumen as value1, m_status_penerimaan.status as value2, m_jenis_pengirim.jenis_pengirim as value3 from penerimaan_paket_keluar 
LEFT JOIN m_jenis_dokumen ON penerimaan_paket_keluar.jenis_dokumen=m_jenis_dokumen.id 
LEFT JOIN m_status_penerimaan ON penerimaan_paket_keluar.status=m_status_penerimaan.id 
LEFT JOIN m_jenis_pengirim ON penerimaan_paket_keluar.jenis_pengirim=m_jenis_pengirim.id 
order by penerimaan_paket_keluar.id DESC
LIMIT $offset, $limit");

if (!$result) {
    // Handle query error
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Database query failed: ' . mysqli_error($con_signin)]);
    mysqli_close($con_signin);
    exit;
}


// $arr  = []; 
// while ($rec = mysqli_fetch_assoc($result)) {
//     $arr[] = array_map('utf8_encode', $rec);
// }
// echo '{"penerimaan_paket_keluar":' . json_encode($arr) . '}';
// mysqli_close($connect);


// Stream the JSON response
header('Content-Type: application/json; charset=utf-8');
echo '{"status":"success","penerimaan_paket_keluar":[';

$first = true;
while ($rec = mysqli_fetch_assoc($result)) {
    if (!$first) {
        echo ',';
    }
    // Encode each row individually and output it
    echo json_encode(array_map('utf8_encode', $rec));
    $first = false;
    // Flush output buffer to reduce memory usage
    ob_flush();
    flush();
}

echo ']}';

// Clean up
mysqli_free_result($result);
mysqli_close($con_signin);
?>