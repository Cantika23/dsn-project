<?php 

include("koneksi.php");
if($_POST['id_paket_masuk']) {
	$id_paket_masuk = $_POST['id_paket_masuk']; 
	$no_dokumen = $_POST['no_dokumen'];
	$tanggal_terima = $_POST['tanggal_terima'];
	$jenis_dokumen = $_POST['jenis_dokumen'];
	$no_hp_penerima = $_POST['no_hp_penerima'];
	$email_penerima = $_POST['email_penerima'];
	$status = $_POST['status'];
	$diterima_oleh = $_POST['diterima_oleh'];
	$nama_penerima = $_POST['nama_penerima'];
	
	$no_paket = $_POST['no_paket'];
	$nama_pengirim = $_POST['nama_pengirim'];
	$keterangan = $_POST['keterangan'];
	
	$result = mysqli_query($con_signin, "update penerimaan_paket_masuk SET no_dokumen='$no_dokumen', no_paket='$no_paket', nama_pengirim='$nama_pengirim', keterangan='$keterangan', tanggal_terima=IF('$tanggal_terima' = '', NULL, '$tanggal_terima'), jenis_dokumen='$jenis_dokumen', no_hp_penerima='$no_hp_penerima',
		email_penerima='$email_penerima', status=IF('$status' = '-1', NULL, '$status'), nama_penerima=IF('$nama_penerima' = '', NULL, '$nama_penerima'), diterima_oleh='$diterima_oleh' WHERE id='$id_paket_masuk'");	
	if ($result) {
			$response = array('error' => 'False');
			echo json_encode($response);	
	} else{
		$response = array('error' => 'True');
		echo json_encode($response);
	}
	
}
mysqli_close($connect);
?>