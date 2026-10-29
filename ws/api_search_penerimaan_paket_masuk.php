<?php
include("koneksi.php");

$search = isset($_GET['q']) ? mysqli_real_escape_string($con_signin, trim($_GET['q'])) : '';
$count_only = isset($_GET['count_only']) && $_GET['count_only'] == '1';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 100;
$offset = ($page - 1) * $limit;

$where_conditions = [];
if ($search !== '') {
    $where_conditions[] = "(m_employee.employee_name LIKE '%$search%' OR " .
                         "penerimaan_paket_masuk.no_dokumen = '$search' OR " .
                         "penerimaan_paket_masuk.no_hp_penerima = '$search' OR " .
                         "penerimaan_paket_masuk.no_paket = '$search')";
}
$where_clause = empty($where_conditions) ? '' : 'WHERE ' . implode(' AND ', $where_conditions);

$count_query = "SELECT COUNT(*) as total_count FROM penerimaan_paket_masuk 
                LEFT JOIN m_employee ON penerimaan_paket_masuk.nama_penerima = m_employee.id 
                $where_clause";
$count_result = mysqli_query($con_signin, $count_query);
$total_count = 0;
if ($count_result) {
    $count_row = mysqli_fetch_assoc($count_result);
    $total_count = (int)$count_row['total_count'];
}

if ($count_only) {
    $response = ['status' => 'success', 'total_count' => $total_count];
    mysqli_close($con_signin);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($response);
    exit;
}

$query = "SELECT penerimaan_paket_masuk.*, 
                 m_jenis_dokumen.jenis_dokumen AS value1, 
                 m_status_penerimaan.status AS value2, 
                 m_employee.employee_name AS value3, 
                 (SELECT employee_name FROM m_employee WHERE m_employee.id = user.id_pegawai) AS value4 
          FROM penerimaan_paket_masuk 
          LEFT JOIN m_jenis_dokumen ON penerimaan_paket_masuk.jenis_dokumen = m_jenis_dokumen.id 
          LEFT JOIN m_status_penerimaan ON penerimaan_paket_masuk.status = m_status_penerimaan.id 
          LEFT JOIN user ON penerimaan_paket_masuk.nama_penerima = user.id 
          LEFT JOIN m_employee ON penerimaan_paket_masuk.nama_penerima = m_employee.id 
          $where_clause 
          ORDER BY penerimaan_paket_masuk.id DESC";
if ($total_count > 100 && $limit > 0) {
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
}
mysqli_close($con_signin);
header('Content-Type: application/json; charset=utf-8');
echo json_encode($response);
?>