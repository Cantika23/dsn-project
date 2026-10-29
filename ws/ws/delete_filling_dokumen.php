<?php 

include("koneksi.php");
if($_POST['id_filling_dokumen']) {
	$id_filling_dokumen = $_POST['id_filling_dokumen']; 
	$file = $_POST['file'];
	
	$uploaddir = $_SERVER['DOCUMENT_ROOT']. "/DSN/files/"; 
	if (is_file($uploaddir . $file)) {
		unlink($uploaddir . $file);
	}
		
	$result = mysqli_query($con_signin, "DELETE from filing_dokumen where id='$id_filling_dokumen' ");	
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