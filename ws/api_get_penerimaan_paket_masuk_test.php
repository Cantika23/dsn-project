<?php
include("koneksi.php");

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 100;
$count_only = isset($_GET['count_only']) && $_GET['count_only'] == '1';
$offset = ($page - 1) * $limit;

// Search & filters
$search = isset($_GET['q']) ? mysqli_real_escape_string($con_signin, trim($_GET['q'])) : '';
$filter_nama_penerima = isset($_GET['nama_penerima']) ? mysqli_real_escape_string($con_signin, trim($_GET['nama_penerima'])) : '';
$filter_jenis_dokumen = isset($_GET['jenis_dokumen']) ? (int)$_GET['jenis_dokumen'] : 0;
$filter_nama_pengirim = isset($_GET['nama_pengirim']) ? mysqli_real_escape_string($con_signin, trim($_GET['nama_pengirim'])) : '';

// WHERE clause
$where_conditions = [];
if ($search !== '') {
    $where_conditions[] = "(m_employee.employee_name LIKE '%$search%' OR " .
                         "penerimaan_paket_masuk.no_dokumen LIKE '%$search%' OR " .
                         "penerimaan_paket_masuk.no_hp_penerima LIKE '%$search%' OR " .
                         "penerimaan_paket_masuk.nama_pengirim LIKE '%$search%' OR " .
                         "penerimaan_paket_masuk.no_paket LIKE '%$search%')";
}
if ($filter_nama_penerima !== '') {
    $where_conditions[] = "penerimaan_paket_masuk.nama_penerima = '$filter_nama_penerima'";
}
if ($filter_jenis_dokumen > 0) {
    $where_conditions[] = "penerimaan_paket_masuk.jenis_dokumen = $filter_jenis_dokumen";
}
if ($filter_nama_pengirim !== '') {
    $where_conditions[] = "penerimaan_paket_masuk.nama_pengirim LIKE '%$filter_nama_pengirim%'";
}
$where_clause = empty($where_conditions) ? '' : 'WHERE ' . implode(' AND ', $where_conditions);

// Count total records
$count_query = "SELECT COUNT(*) as total_count FROM penerimaan_paket_masuk 
                LEFT JOIN m_employee ON penerimaan_paket_masuk.nama_penerima = m_employee.id 
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
$query = "SELECT penerimaan_paket_masuk.*, 
                 m_jenis_dokumen.jenis_dokumen AS value1, 
                 m_status_penerimaan.status AS value2, 
                 m_employee.employee_name AS value3, 
                 (SELECT employee_name FROM m_employee WHERE m_employee.id = user.id_pegawai) AS value4 
          FROM penerimaan_paket_masuk 
          LEFT JOIN m_jenis_dokumen ON penerimaan_paket_masuk.jenis_dokumen = m_jenis_dokumen.id 
          LEFT JOIN m_status_penerimaan ON penerimaan_paket_masuk.status = m_status_penerimaan.id 
          LEFT JOIN user ON penerimaan_paket_masuk.id_user = user.id 
          LEFT JOIN m_employee ON penerimaan_paket_masuk.nama_penerima = m_employee.id 
          $where_clause 
          ORDER BY penerimaan_paket_masuk.no_dokumen ASC";
if ($limit > 0) {
    $query .= " LIMIT $limit OFFSET $offset";
}

$result = mysqli_query($con_signin, $query);
$response = [
    'status' => 'success',
    'penerimaan_paket_masuk' => [],
    'total_count' => $total_count
];

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $response['penerimaan_paket_masuk'][] = $row;
    }
    mysqli_free_result($result);
} else {
    $response = ['status' => 'error', 'message' => mysqli_error($con_signin)];
}

mysqli_close($con_signin);
header('Content-Type: application/json; charset=utf-8');
echo json_encode($response);


// include("koneksi.php");

// // Database connection (assuming $con_signin is defined)
// $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
// $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 100;
// $offset = ($page - 1) * $limit;

// // Search parameter
// $search = isset($_GET['q']) ? mysqli_real_escape_string($con_signin, trim($_GET['q'])) : '';

// // Filter parameters
// $filter_nama_penerima = isset($_GET['nama_penerima']) ? mysqli_real_escape_string($con_signin, trim($_GET['nama_penerima'])) : '';
// $filter_jenis_dokumen = isset($_GET['jenis_dokumen']) ? (int)$_GET['jenis_dokumen'] : 0;
// $filter_nama_pengirim = isset($_GET['nama_pengirim']) ? mysqli_real_escape_string($con_signin, trim($_GET['nama_pengirim'])) : '';

// // Build WHERE clause
// $where_conditions = [];
// if ($search !== '') {
//     $where_conditions[] = "(penerimaan_paket_masuk.nama_penerima LIKE '%$search%' OR " .
//                          "penerimaan_paket_masuk.no_dokumen LIKE '%$search%' OR " .
//                          "penerimaan_paket_masuk.no_hp_penerima LIKE '%$search%' OR " .
//                          "penerimaan_paket_masuk.nama_pengirim LIKE '%$search%' OR " .
//                          "penerimaan_paket_masuk.no_paket LIKE '%$search%')";
// }
// if ($filter_nama_penerima !== '') {
//     $where_conditions[] = "penerimaan_paket_masuk.nama_penerima = '$filter_nama_penerima'";
// }
// if ($filter_jenis_dokumen > 0) {
//     $where_conditions[] = "penerimaan_paket_masuk.jenis_dokumen = $filter_jenis_dokumen";
// }
// if ($filter_nama_pengirim !== '') {
//     $where_conditions[] = "penerimaan_paket_masuk.nama_pengirim LIKE '%$filter_nama_pengirim%'";
// }

// $where_clause = empty($where_conditions) ? '' : 'WHERE ' . implode(' AND ', $where_conditions);

// // Count total matching records
// $count_query = "SELECT COUNT(*) as total_count 
//                 FROM penerimaan_paket_masuk 
//                 $where_clause";
// $count_result = mysqli_query($con_signin, $count_query);
// $total_count = 0;
// if ($count_result) {
//     $count_row = mysqli_fetch_assoc($count_result);
//     $total_count = (int)$count_row['total_count'];
//     mysqli_free_result($count_result);
// }

// // Main query for paginated data
// $query = "SELECT penerimaan_paket_masuk.*, 
//                  m_jenis_dokumen.jenis_dokumen AS value1, 
//                  m_status_penerimaan.status AS value2, 
//                  m_employee.employee_name AS value3, 
//                  (SELECT employee_name FROM m_employee WHERE m_employee.id = user.id_pegawai) AS value4 
//           FROM penerimaan_paket_masuk 
//           LEFT JOIN m_jenis_dokumen ON penerimaan_paket_masuk.jenis_dokumen = m_jenis_dokumen.id 
//           LEFT JOIN m_status_penerimaan ON penerimaan_paket_masuk.status = m_status_penerimaan.id 
//           LEFT JOIN user ON penerimaan_paket_masuk.nama_penerima = user.id 
//           LEFT JOIN m_employee ON penerimaan_paket_masuk.nama_penerima = m_employee.id 
//           $where_clause 
//           ORDER BY penerimaan_paket_masuk.id DESC 
//           LIMIT $limit OFFSET $offset";

// $result = mysqli_query($con_signin, $query);

// $response = ['status' => 'success', 'penerimaan_paket_masuk' => [], 'total_count' => $total_count];
// if ($result) {
//     while ($row = mysqli_fetch_assoc($result)) {
//         $response['penerimaan_paket_masuk'][] = $row;
//     }
//     mysqli_free_result($result);
// } else {
//     $response = ['status' => 'error', 'message' => mysqli_error($con_signin)];
// }

// mysqli_close($con_signin);
// header('Content-Type: application/json; charset=utf-8');
// echo json_encode($response);

// if (!$result) {
//     http_response_code(500);
//     echo json_encode(['status' => 'error', 'message' => 'Database query failed: ' . mysqli_error($con_signin)]);
//     exit;
// }


// // Stream the JSON response
// header('Content-Type: application/json; charset=utf-8');
// echo '{"status":"success","penerimaan_paket_masuk":[';

// $first = true;
// while ($rec = mysqli_fetch_assoc($result)) {
//     if (!$first) {
//         echo ',';
//     }
//     // Encode each row individually and output it
//     echo json_encode(array_map('utf8_encode', $rec));
//     $first = false;
//     // Flush output buffer to reduce memory usage
//     ob_flush();
//     flush();
// }

// echo ']}';

// // Clean up
// mysqli_free_result($result);
// mysqli_close($con_signin);
?>