<?php 

include("koneksi.php");
 
 // Add pagination parameters
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 100;
$offset = ($page - 1) * $limit;

$result = mysqli_query($con_signin, "select filing_dokumen.*, m_kode_pt.nama as value1, m_kode_pt.nama_lengkap as value2, m_kode_department.nama as value3, m_kode_department.nama_lengkap as value4, 
m_gudang.nama as value5, m_gudang.keterangan as value6,
m_notifikasi_expired.jenis_dokumen as value7, m_notifikasi_expired.interval as value8 from filing_dokumen 
LEFT JOIN m_kode_pt ON filing_dokumen.kode_pt=m_kode_pt.id 
LEFT JOIN m_kode_department ON filing_dokumen.kode_department=m_kode_department.id
LEFT JOIN m_gudang ON filing_dokumen.no_gudang=m_gudang.id
LEFT JOIN m_notifikasi_expired ON filing_dokumen.masa_berlaku=m_notifikasi_expired.id 
order by filing_dokumen.id DESC
LIMIT $offset, $limit");

// $arr  = []; 
// //, userlevels.userlevelname FROM  user LEFT JOIN userlevels ON user.level=userlevels.userlevelid
// while ($rec = mysqli_fetch_assoc($result)) {
//     $arr[] = array_map('utf8_encode', $rec);
// }
// echo '{"filing_dokumen":' . json_encode($arr) . '}';
// mysqli_close($connect);


if (!$result) {
    // Handle query error
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Database query failed: ' . mysqli_error($con_signin)]);
    mysqli_close($con_signin);
    exit;
}

// Stream the JSON response
header('Content-Type: application/json; charset=utf-8');
echo '{"status":"success","filing_dokumen":[';

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