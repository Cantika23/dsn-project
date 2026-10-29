<?php 

include("koneksi.php");
if($_POST['id_filling_dokumen']) {
	$id_filling_dokumen = $_POST['id_filling_dokumen']; 
	$no_box = $_POST['no_box'];
	$kode_pt = $_POST['kode_pt'];
	$kode_department = $_POST['kode_department'];
	$lokasi = $_POST['lokasi'];
	$tahun_pembuatan_dokumen = $_POST['tahun_pembuatan_dokumen'];
	$nama_dokumen = $_POST['nama_dokumen'];
	$deskripsi = $_POST['deskripsi'];
	$no_rak = $_POST['no_rak'];
	$no_gudang = $_POST['no_gudang'];
	$masa_berlaku = $_POST['masa_berlaku'];
	
	
	$result = mysqli_query($con_signin, "update filing_dokumen SET no_box='$no_box', kode_pt='$kode_pt', kode_department='$kode_department', lokasi='$lokasi', tahun_pembuatan_dokumen='$tahun_pembuatan_dokumen',
		nama_dokumen='$nama_dokumen', deskripsi='$deskripsi', no_rak='$no_rak', no_gudang=IF('$no_gudang' = '', NULL, '$no_gudang'),  
		masa_berlaku=IF('$masa_berlaku' = '', NULL, '$masa_berlaku')  WHERE id='$id_filling_dokumen'");	
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