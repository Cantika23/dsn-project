<?php
include("koneksi.php");

// Pagination parameters
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 100;
$count_only = isset($_GET['count_only']) && $_GET['count_only'] == '1';
$offset = ($page - 1) * $limit;

// Search & filters
$search = isset($_GET['q']) ? mysqli_real_escape_string($con_signin, trim($_GET['q'])) : '';
$kode_pt = isset($_GET['kode_pt']) ? (int)$_GET['kode_pt'] : 0;
$kode_department = isset($_GET['kode_department']) ? (int)$_GET['kode_department'] : 0;
$tahun = isset($_GET['tahun']) ? (int)$_GET['tahun'] : 0;
$deskripsi = isset($_GET['deskripsi']) ? mysqli_real_escape_string($con_signin, trim($_GET['deskripsi'])) : '';

// WHERE clause
$where_conditions = [];
if ($search !== '') {
    $where_conditions[] = "(filing_dokumen.no_box LIKE '%$search%' OR " .
                         "filing_dokumen.deskripsi LIKE '%$search%' OR " .
                         "filing_dokumen.lokasi LIKE '%$search%')";
}
if ($kode_pt > 0) {
    $where_conditions[] = "filing_dokumen.kode_pt = $kode_pt";
}
if ($kode_department > 0) {
    $where_conditions[] = "filing_dokumen.kode_department = $kode_department";
}
if ($tahun > 0) {
    $where_conditions[] = "filing_dokumen.tahun_pembuatan_dokumen = $tahun";
}
if ($deskripsi !== '') {
    $where_conditions[] = "filing_dokumen.deskripsi LIKE '%$deskripsi%'";
}
$where_clause = empty($where_conditions) ? '' : 'WHERE ' . implode(' AND ', $where_conditions);

// Count total records
$count_query = "SELECT COUNT(*) as total_count FROM filing_dokumen 
                LEFT JOIN m_kode_pt ON filing_dokumen.kode_pt = m_kode_pt.id 
                LEFT JOIN m_kode_department ON filing_dokumen.kode_department = m_kode_department.id
                LEFT JOIN m_gudang ON filing_dokumen.no_gudang = m_gudang.id
                LEFT JOIN m_notifikasi_expired ON filing_dokumen.masa_berlaku = m_notifikasi_expired.id 
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
$query = "SELECT filing_dokumen.*, 
                 m_kode_pt.nama AS value1, 
                 m_kode_pt.nama_lengkap AS value2, 
                 m_kode_department.nama AS value3, 
                 m_kode_department.nama_lengkap AS value4, 
                 m_gudang.nama AS value5, 
                 m_gudang.keterangan AS value6, 
                 m_notifikasi_expired.jenis_dokumen AS value7, 
                 m_notifikasi_expired.interval AS value8 
          FROM filing_dokumen 
          LEFT JOIN m_kode_pt ON filing_dokumen.kode_pt = m_kode_pt.id 
          LEFT JOIN m_kode_department ON filing_dokumen.kode_department = m_kode_department.id
          LEFT JOIN m_gudang ON filing_dokumen.no_gudang = m_gudang.id
          LEFT JOIN m_notifikasi_expired ON filing_dokumen.masa_berlaku = m_notifikasi_expired.id 
          $where_clause 
          ORDER BY filing_dokumen.no_box ASC";
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
    'filing_dokumen' => [],
    'total_count' => $total_count
];

while ($row = mysqli_fetch_assoc($result)) {
    $response['filing_dokumen'][] = array_map('utf8_encode', $row);
}
mysqli_free_result($result);

mysqli_close($con_signin);
header('Content-Type: application/json; charset=utf-8');
echo json_encode($response);
?>