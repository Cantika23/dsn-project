<?php 

include("koneksi.php");
if($_POST['id_user']) {
	$id_user = $_POST['id_user'];
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
	$created_date = date("Y-m-d");
	
	$query = "INSERT INTO filing_dokumen (id, no_box, kode_pt, kode_department, lokasi, tahun_pembuatan_dokumen, nama_dokumen, deskripsi, no_rak, no_gudang, masa_berlaku)
	VALUES ('NULL','$no_box','$kode_pt','$kode_department','$lokasi','$tahun_pembuatan_dokumen','$nama_dokumen','$deskripsi','$no_rak',IF('$no_gudang' = '', NULL, '$no_gudang'),IF('$masa_berlaku' = '', NULL, '$masa_berlaku')) ";
	
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