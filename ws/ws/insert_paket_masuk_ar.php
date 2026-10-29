<?php 

include("koneksi.php");
if($_POST['id_user']) {
	$id_user = $_POST['id_user']; 
	$no_dokumen = $_POST['no_dokumen'];
	$tanggal_terima = $_POST['tanggal_terima'];
	$jenis_dokumen = $_POST['jenis_dokumen'];
	$no_hp_penerima = $_POST['no_hp_penerima'];
	$email_penerima = $_POST['email_penerima'];
	$status = $_POST['status'];
	$diterima_oleh = $_POST['diterima_oleh'];
	$nama_penerima = $_POST['nama_penerima'];
	$created_date = $_POST['created_date'];
	$no_paket = $_POST['no_paket'];
	$nama_pengirim = $_POST['nama_pengirim'];
	$keterangan = $_POST['keterangan'];
	$created_date2 = date("Y-m-d");
	if(empty($created_date)){
		$created_date = $created_date2;
	}
	
	$query = "INSERT INTO penerimaan_paket_masuk (no_dokumen, no_paket, nama_pengirim, keterangan, tanggal_terima, nama_penerima, jenis_dokumen, no_hp_penerima, email_penerima, status, diterima_oleh, id_user, created_date)
	VALUES ('$no_dokumen','$no_paket','$nama_pengirim','$keterangan', IF('$tanggal_terima' = '', NULL, '$tanggal_terima'),IF('$nama_penerima' = '', NULL, '$nama_penerima'),'$jenis_dokumen','$no_hp_penerima','$email_penerima',IF('$status' = '-1', NULL, '$status'),'$diterima_oleh','$id_user','$created_date') ";
	
	$insert = mysqli_query($con_signin, $query) or die("Error, insert query failed : $query ");
    $last_id = mysqli_insert_id($con_signin);
    if ($insert) {
			$status = array("error" => $last_id, "created_date" => $created_date);
			echo json_encode($status);
    } else{
            $response = array('error' => 'True');
            echo json_encode($response);
    }
	
}
mysqli_close($connect);
?>