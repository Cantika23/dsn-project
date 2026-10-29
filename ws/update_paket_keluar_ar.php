<?php 

include("koneksi.php");
if($_POST['id_paket_keluar']) {
	$id_paket_keluar = $_POST['id_paket_keluar']; 
	$no_dokumen = $_POST['no_dokumen'];
	$tanggal_terima = $_POST['tanggal_terima'];
	$tujuan_penerima = $_POST['tujuan_penerima'];
	$jenis_dokumen = $_POST['jenis_dokumen'];
	$no_hp_penerima = $_POST['no_hp_penerima'];
	$email_penerima = $_POST['email_penerima'];
	$status = $_POST['status'];
	$jenis_pengirim = $_POST['jenis_pengirim'];
	$nama_penerima = $_POST['nama_penerima'];
	$nama_kurir = $_POST['nama_kurir'];
	$no_awb = $_POST['no_awb'];
	$no_paket = $_POST['no_paket'];
	
	$result = mysqli_query($con_signin, "update penerimaan_paket_keluar SET no_dokumen='$no_dokumen', no_paket='$no_paket', tanggal_terima=IF('$tanggal_terima' = '', NULL, '$tanggal_terima'), jenis_dokumen=IF('$jenis_dokumen' = '-1', NULL, '$jenis_dokumen'),
		email_penerima='$email_penerima', tujuan_penerima='$tujuan_penerima', jenis_pengirim='$jenis_pengirim', nama_kurir='$nama_kurir', no_awb='$no_awb', 
		status=IF('$status' = '-1', NULL, '$status'), nama_penerima='$nama_penerima' WHERE id='$id_paket_keluar'");	
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