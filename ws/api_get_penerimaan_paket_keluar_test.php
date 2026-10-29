<?php
include("koneksi.php");

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 100;
$count_only = isset($_GET['count_only']) && $_GET['count_only'] == '1';
$offset = ($page - 1) * $limit;

// Search & filters
$search = isset($_GET['q']) ? mysqli_real_escape_string($con_signin, trim($_GET['q'])) : '';
$filter_jenis_dokumen = isset($_GET['jenis_dokumen']) ? (int)$_GET['jenis_dokumen'] : 0;

// WHERE clause
$where_conditions = [];
if ($search !== '') {
    $where_conditions[] = "(penerimaan_paket_keluar.no_dokumen LIKE '%$search%' OR " .
                         "penerimaan_paket_keluar.nama_penerima LIKE '%$search%' OR " .
                         "penerimaan_paket_keluar.no_hp_penerima LIKE '%$search%' OR " .
                         "penerimaan_paket_keluar.no_paket LIKE '%$search%')";
}
if ($filter_jenis_dokumen > 0) {
    $where_conditions[] = "penerimaan_paket_keluar.jenis_dokumen = $filter_jenis_dokumen";
}
$where_clause = empty($where_conditions) ? '' : 'WHERE ' . implode(' AND ', $where_conditions);

// Count total records
$count_query = "SELECT COUNT(*) as total_count FROM penerimaan_paket_keluar 
                LEFT JOIN m_jenis_dokumen ON penerimaan_paket_keluar.jenis_dokumen = m_jenis_dokumen.id 
                LEFT JOIN m_status_penerimaan ON penerimaan_paket_keluar.status = m_status_penerimaan.id 
                LEFT JOIN m_jenis_pengirim ON penerimaan_paket_keluar.jenis_pengirim = m_jenis_pengirim.id 
                $where_clause";
$count_result = mysqli_query($con_signin, $count_query);
$total_count = 0;
if ($count_result) {
    $count_row = mysqli_fetch_assoc($count_result);
    $total_count = (int)$count_row['total_count'];
    mysqli_free_result($count_result);
}

if ($count_only) {
    $response = ['status' => 'success', 'total_count' => $total_count];
    mysqli_close($con_signin);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($response);
    exit;
}

// Fetch data
$query = "SELECT penerimaan_paket_keluar.*, 
                 m_jenis_dokumen.jenis_dokumen AS value1, 
                 m_status_penerimaan.status AS value2, 
                 m_jenis_pengirim.jenis_pengirim AS value3 
          FROM penerimaan_paket_keluar 
          LEFT JOIN m_jenis_dokumen ON penerimaan_paket_keluar.jenis_dokumen = m_jenis_dokumen.id 
          LEFT JOIN m_status_penerimaan ON penerimaan_paket_keluar.status = m_status_penerimaan.id 
          LEFT JOIN m_jenis_pengirim ON penerimaan_paket_keluar.jenis_pengirim = m_jenis_pengirim.id 
          $where_clause 
          ORDER BY penerimaan_paket_keluar.no_dokumen ASC";
if ($limit > 0) {
    $query .= " LIMIT $limit OFFSET $offset";
}

$result = mysqli_query($con_signin, $query);
if (!$result) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Database query failed: ' . mysqli_error($con_signin)]);
    mysqli_close($con_signin);
    exit;
}

$response = [
    'status' => 'success',
    'penerimaan_paket_keluar' => [],
    'total_count' => $total_count
];

while ($row = mysqli_fetch_assoc($result)) {
    $response['penerimaan_paket_keluar'][] = array_map('utf8_encode', $row);
}
mysqli_free_result($result);

mysqli_close($con_signin);
header('Content-Type: application/json; charset=utf-8');
echo json_encode($response);
?>