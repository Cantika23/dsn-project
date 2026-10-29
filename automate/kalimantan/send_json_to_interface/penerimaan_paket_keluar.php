<?php
// include "database.php";

// di dalam file ini, akan dilakukan pengambilan data dari database "sql_aplikasigs_c" tabel "penerimaan_paket_keluar" dengan kondisi no_awb != null

function getPenerimaanPaketKeluarProcessedKurir($conn)
{

    $tableName = "penerimaan_paket_keluar";
    $columns = ['id', 'no_dokumen', 'tanggal_terima', 'tujuan_penerima', 'jenis_dokumen', 'no_hp_penerima', 'email_penerima', 'status', 'bukti_penerimaan', 'nama_penerima', 'jenis_pengirim', 'nama_kurir', 'no_awb', 'id_user', 'created_date', 'no_paket', 'status_sap'];

    if (empty($conn)) {
        $msg = "Database connection error";
    } elseif (empty($columns) || !is_array($columns)) {
        $msg = "columns Name must be defined in an indexed array";
    } elseif (empty($tableName)) {
        $msg = "Table Name is empty";
    } else {
        $columnName = implode(", ", $columns);
        $query = "SELECT " . $columnName . " FROM $tableName" . " WHERE (no_dokumen IS NOT NULL) AND (status_sap != 3) " . " ORDER BY id ASC";
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

function getStatusSapByNoDokumen($conn, $noDokumen)
{
    $tableName = "penerimaan_paket_keluar";

    if (empty($conn)) {
        $msg = "Database connection error";
    } else {
        $query = "SELECT status_sap FROM $tableName" . " WHERE no_dokumen = '" . $noDokumen . "' ORDER BY id ASC";
        // echo $query;

        $result = $conn->query($query);
        if ($result == true) {
            if ($result->num_rows > 0) {
                // $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
                $row = $result->fetch_assoc();
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

function updateStatusSapByNoDokumen($conn, $noDokumen, $newStatusSap)
{
    if (empty($conn)) {
        $msg = "Database connection error";
    } else {
        $query = "UPDATE penerimaan_paket_keluar SET `status_sap` = " . $newStatusSap . " WHERE `no_dokumen` = '" . strval($noDokumen) . "';";
        $result = $conn->query($query);

        if ($result == true) {
            $msg = $query;
        } else {
            $msg = mysqli_error($conn);
        }
    }

    return $msg;
}
