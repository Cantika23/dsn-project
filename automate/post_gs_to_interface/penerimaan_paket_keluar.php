<?php
function getPenerimaanPaketKeluarForInterface($conn)
{

    $tableName = "penerimaan_paket_keluar";
    $columns = ['id', 'no_dokumen', 'tanggal_terima', 'tujuan_penerima', 'jenis_dokumen', 'no_hp_penerima', 'email_penerima', 'status', 'bukti_penerimaan', 'nama_penerima', 'jenis_pengirim', 'nama_kurir', 'no_awb', 'id_user', 'created_date', 'no_paket', 'status_sap'];
    $dataArray = ["msg" => ""];

    if (empty($conn)) {
        $dataArray["msg"] = "Database connection error";
    } else {
        $columnName = implode(", ", $columns);
        $query = "SELECT " . $columnName . " FROM $tableName" . " WHERE (no_dokumen IS NOT NULL) AND (status_sap != 3) " . " ORDER BY id ASC";

        $result = $conn->query($query);
        if ($result == true) {
            if ($result->num_rows > 0) {
                $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
                $dataArray["data_length"] = mysqli_num_rows($result);
                $dataArray["data"] = $row;
                $dataArray["msg"] = "Data Found";
            } else {
                $dataArray["msg"] = "No Data Found";
            }
        } else {
            $dataArray["msg"] = mysqli_error($conn);
        }
    }
    return $dataArray;
}

function updatePenerimaanPaketKeluar($conn, $data)
{

    if (empty($conn)) {
        $msg = "Database connection error";
    } else {
        $query = "UPDATE penerimaan_paket_keluar SET `status_sap` = " . $data['status_sap'] . ", `jenis_dokumen` = " . $data['jenis_dokumen'] . ", `no_hp_penerima` = '" . $data['no_hp_penerima'] . "', `email_penerima` = '" . $data['email_penerima'] . "', `nama_penerima` = '" . $data['nama_penerima'] . "', `id_user` = " . $data['id_user'] . ", `created_date` = '" . $data['created_date'] . "', `no_paket` = '" . $data['no_paket'] . "' WHERE `no_dokumen` = '" . $data['no_dokumen'] . "';";
        $result = $conn->query($query);
        if ($result == true) {
            $msg = $query;
        } else {
            $msg = mysqli_error($conn);
        }
    }
    return $msg;
}
