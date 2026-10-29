<?php
// include "database.php";

// di dalam file ini, akan dilakukan pengambilan data dari database "sql_aplikasigs_c" tabel "penerimaan_paket_keluar" dengan kondisi no_awb != null

function getPenerimaanPaketKeluarDataWhereAWBNotNull($conn)
{

    $tableName = "penerimaan_paket_keluar";
    $columns = ['id', 'no_dokumen', 'tanggal_terima', 'tujuan_penerima', 'jenis_dokumen', 'no_hp_penerima', 'email_penerima', 'status', 'bukti_penerimaan', 'nama_penerima', 'jenis_pengirim', 'nama_kurir', 'no_awb', 'id_user', 'created_date', 'no_paket'];

    if (empty($conn)) {
        $msg = "Database connection error";
    } elseif (empty($columns) || !is_array($columns)) {
        $msg = "columns Name must be defined in an indexed array";
    } elseif (empty($tableName)) {
        $msg = "Table Name is empty";
    } else {
        $columnName = implode(", ", $columns);
        $query = "SELECT " . $columnName . " FROM $tableName" . " WHERE (no_awb IS NOT NULL) AND (nama_kurir IS NOT NULL) AND (tanggal_terima IS NULL) AND (status_sap IS NULL OR status_sap != 0)" . " ORDER BY id ASC";
        
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

function updatePenerimaanPaketKeluar($conn,  $statusPaket, $noAWB, $tanggalDiterima, $namaPenerima, $statusSap)
{
    $statusPaket = trim($statusPaket);

    // if (strtolower($statusPaket) == strtolower("DELIVERED"))

    if (strtolower($statusPaket) == strtolower("ON PROGRESS")) {
        $status = 3;
    } else {
        $status = 4;
    }

    if (empty($conn)) {
        $msg = "Database connection error";
    } else { 
        if($statusSap == 0){
            $query = "UPDATE penerimaan_paket_keluar SET `status_sap` = 0 WHERE `no_awb` = '" . $noAWB . "';";
        }else{
        $query = "UPDATE penerimaan_paket_keluar SET `status` = " . $status . ", `tanggal_terima` = '" . $tanggalDiterima . "', `nama_penerima` = '" . $namaPenerima . "', `status_sap` = 2 WHERE `no_awb` = '" . $noAWB . "';";
        }
        $result = $conn->query($query);
        if ($result == true) {
            $msg = $query;
        } else {
            $msg = mysqli_error($conn);
        }
    }
    return $msg;
}
