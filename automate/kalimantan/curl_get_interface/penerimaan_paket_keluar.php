<?php

function getPenerimaanPaketKeluarData($conn, $noDokumen)
{
    $tableName = "penerimaan_paket_keluar";
    $dataArray = ["msg" => ""];

    if (empty($conn)) {
        $dataArray["msg"] = "Database connection error";
    } else {
        $query = "SELECT * FROM " . $tableName . " WHERE `no_dokumen` = '" . $noDokumen . "' ORDER BY id ASC";
        $result = $conn->query($query);

        if ($result == true) {
            if ($result->num_rows > 0) {
                $row = mysqli_fetch_all($result, MYSQLI_ASSOC);

                // $dataArray["data"] = $row;
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
        $query = "UPDATE penerimaan_paket_keluar SET `jenis_dokumen` = " . $data['jenis_dokumen'] . ", `no_hp_penerima` = '" . $data['no_hp_penerima'] . "', `email_penerima` = '" . $data['email_penerima'] . "', `nama_penerima` = '" . $data['nama_penerima'] . "', `id_user` = " . $data['id_user'] . ", `created_date` = '" . $data['created_date'] . "', `no_paket` = '" . $data['no_paket'] . "', `status_sap` = " . strval($data['status_sap']) . " WHERE `no_dokumen` = '" . $data['no_dokumen'] . "';";
        $result = $conn->query($query);

        if ($result == true) {
            $msg = $query;
        } else {
            $msg = mysqli_error($conn);
        }
    }

    return $msg;
}

function insertPenerimaanPaketKeluar($conn, $data)
{
    if (empty($conn)) {
        $msg = "Database connection error";
    } else {
        $query = "INSERT INTO penerimaan_paket_keluar (no_dokumen, jenis_dokumen, no_hp_penerima, email_penerima, nama_penerima, no_paket, tujuan_penerima, created_date, id_user, status_sap) VALUES('" . $data['no_dokumen'] . "'," . $data['jenis_dokumen'] . ",'" . $data['no_hp_penerima'] . "','" . $data['email_penerima'] . "','" . $data['nama_penerima'] . "','" . $data['no_paket'] . "','" . $data['tujuan_penerima'] . "','" . $data['created_date'] . "'," . $data['id_user'] . "," . $data['status_sap'] . ")";
        $result = $conn->query($query);

        if ($result == true) {
            $msg = $query;
        } else {
            $msg = mysqli_error($conn);
        }
    }

    return $msg;
}
