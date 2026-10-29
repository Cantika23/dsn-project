<?php
// include "database.php";

// di dalam file ini, akan dilakukan pengambilan data dari database "sql_aplikasigs_c" tabel "penerimaan_paket_keluar" dengan kondisi no_awb != null

function getPenerimaanPaketKeluarNewData($conn)
{

    $tableName = "penerimaan_paket_keluar";
    $columns = ['id', 'no_dokumen', 'tanggal_terima', 'tujuan_penerima', 'jenis_dokumen', 'no_hp_penerima', 'email_penerima', 'status', 'bukti_penerimaan', 'nama_penerima', 'jenis_pengirim', 'nama_kurir', 'no_awb', 'id_user', 'created_date', 'no_paket','status_sap'];

    if (empty($conn)) {
        $msg = "Database connection error";
    } elseif (empty($columns) || !is_array($columns)) {
        $msg = "columns Name must be defined in an indexed array";
    } elseif (empty($tableName)) {
        $msg = "Table Name is empty";
    } else {
        $columnName = implode(", ", $columns);
        $query = "SELECT " . $columnName . " FROM $tableName" . " WHERE (no_dokumen IS NOT NULL) AND (tanggal_terima IS NULL) " . " ORDER BY id ASC";
        // echo $query;

        $result = $conn->query($query);
        if ($result == true) {
            if ($result->num_rows > 0) {
                $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
                $msg = $row;
            } else {
                $msg = "No Data Found";
            }
        } else {
            $msg = mysqli_error($conn);
        }
    }
    return $msg;
}
