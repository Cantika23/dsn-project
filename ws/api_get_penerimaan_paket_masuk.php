<?php 

include("koneksi.php");
 
 // Add pagination parameters
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 100;
$offset = ($page - 1) * $limit;
 
$result = mysqli_query($con_signin, "select penerimaan_paket_masuk.*, m_jenis_dokumen.jenis_dokumen as value1, m_status_penerimaan.status as value2, m_employee.employee_name as value3, (select employee_name from m_employee where m_employee.id=user.id_pegawai) as value4 from penerimaan_paket_masuk 
LEFT JOIN m_jenis_dokumen ON penerimaan_paket_masuk.jenis_dokumen=m_jenis_dokumen.id 
LEFT JOIN m_status_penerimaan ON penerimaan_paket_masuk.status=m_status_penerimaan.id
LEFT JOIN user ON penerimaan_paket_masuk.nama_penerima=user.id
LEFT JOIN m_employee ON penerimaan_paket_masuk.nama_penerima=m_employee.id 
order by penerimaan_paket_masuk.id DESC
LIMIT $offset, $limit");

// echo "select penerimaan_paket_masuk.*, m_jenis_dokumen.jenis_dokumen as value1, m_status_penerimaan.status as value2, m_employee.employee_name as value3, (select employee_name from m_employee where m_employee.id=user.id_pegawai) as value4 from penerimaan_paket_masuk 
// LEFT JOIN m_jenis_dokumen ON penerimaan_paket_masuk.jenis_dokumen=m_jenis_dokumen.id 
// LEFT JOIN m_status_penerimaan ON penerimaan_paket_masuk.status=m_status_penerimaan.id
// LEFT JOIN user ON penerimaan_paket_masuk.nama_penerima=user.id
// LEFT JOIN m_employee ON penerimaan_paket_masuk.nama_penerima=m_employee.id 
// order by penerimaan_paket_masuk.id DESC
// LIMIT $offset, $limit";

// $arr  = []; 
// //, userlevels.userlevelname FROM  user LEFT JOIN userlevels ON user.level=userlevels.userlevelid
// while ($rec = mysqli_fetch_assoc($result)) {
//     $arr[] = array_map('utf8_encode', $rec);
// }
// echo '{"penerimaan_paket_masuk":' . json_encode($arr) . '}';
// mysqli_close($connect);

// Execute the query
// $result = mysqli_query($con_signin, $query);

if (!$result) {
    // Handle query error
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Database query failed: ' . mysqli_error($con_signin)]);
    mysqli_close($con_signin);
    exit;
}

// Stream the JSON response
header('Content-Type: application/json; charset=utf-8');
echo '{"status":"success","penerimaan_paket_masuk":[';

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