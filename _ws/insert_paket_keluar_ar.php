<?php 

include("koneksi.php");
if($_POST['id_user']) {
	$id_user = $_POST['id_user']; 
	$no_dokumen = $_POST['no_dokumen'];
	$tanggal_terima = $_POST['tanggal_terima'];
	$jenis_dokumen = $_POST['jenis_dokumen'];
	$tujuan_penerima = $_POST['tujuan_penerima'];
	$no_hp_penerima = $_POST['no_hp_penerima'];
	$email_penerima = $_POST['email_penerima'];
	$status = $_POST['status'];
	$jenis_pengirim = $_POST['jenis_pengirim'];
	$nama_penerima = $_POST['nama_penerima'];
	$nama_kurir = $_POST['nama_kurir'];
	$no_awb = $_POST['no_awb'];
	$created_date = date("Y-m-d");	
	$no_paket = $_POST['no_paket'];
	
	$query = "INSERT INTO penerimaan_paket_keluar (id, no_dokumen, no_paket, tanggal_terima, nama_penerima, jenis_dokumen, no_hp_penerima, email_penerima, status, tujuan_penerima, jenis_pengirim, nama_kurir, no_awb, id_user, created_date)
	VALUES ('NULL','$no_dokumen','$no_paket',IF('$tanggal_terima' = '', NULL, '$tanggal_terima'),'$nama_penerima','$jenis_dokumen','$no_hp_penerima','$email_penerima',IF('$status' = '', NULL, '$status'),'$tujuan_penerima',IF('$jenis_pengirim' = '', NULL, '$jenis_pengirim'),'$nama_kurir','$no_awb','$id_user','$created_date') ";
	
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