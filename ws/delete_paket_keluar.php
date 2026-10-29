<?php 

include("koneksi.php");
if($_POST['id_paket_keluar']) {
	$id_paket_keluar = $_POST['id_paket_keluar']; 
	$bukti_penerimaan = $_POST['bukti_penerimaan'];
	
	$uploaddir = $_SERVER['DOCUMENT_ROOT']. "/DSN/files/"; 
	if (is_file($uploaddir . $bukti_penerimaan)) {
		unlink($uploaddir . $bukti_penerimaan);
	}
		
	$result = mysqli_query($con_signin, "DELETE from penerimaan_paket_keluar where id='$id_paket_keluar' ");	
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