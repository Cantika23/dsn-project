<?php 

include("koneksi.php");
if($_POST['id_paket_masuk']) {
	$id_paket_masuk = $_POST['id_paket_masuk']; 
	$diterima_oleh = $_POST['diterima_oleh'];
    $foto = $_POST['foto']; 
    $status = $_POST['status'];
	$tanggal_terima = $_POST['tanggal_terima'];
	$update_by = $_POST['update_by'];
	
	
    if(isset($_FILES['image'])){
		$path = $_FILES['image']['name'];
		$ext = pathinfo($path, PATHINFO_EXTENSION);

		if(in_array($ext, ["jpg","jpeg"])) {
			$image = imagecreatefromstring(file_get_contents($_FILES['image']['tmp_name']));
            $exif = exif_read_data($_FILES['image']['tmp_name']);
            if(!empty($exif['Orientation'])) {
                
//                $imageResource = imagecreatefromjpeg($_FILES['image']['tmp_name']);
//                switch ($exif['Orientation']) {
//                    case 3:
//                        $image = imagerotate($imageResource, 180, 0);
//                        break;
//                    case 6:
//                        $image = imagerotate($imageResource, -90, 0);
//                        break;
//                    case 8:
//                        $image = imagerotate($imageResource, 90, 0);
//                        break;
//                    default:
//                        $image = $imageResource;
//                }
//                imagejpeg($image, $_FILES['image']['name'], 90);
        
                switch($exif['Orientation']) {
                        case 8:
                                $image = imagerotate($image,90,0);
                                break;
                        case 3:
                                $image = imagerotate($image,180,0);
                                break;
                        case 6:
                                $image = imagerotate($image,-90,0);
                                break;
                }
                
                
            }
		}
             
		$file_path = $_SERVER['DOCUMENT_ROOT']. "/DSN/files/".basename($_FILES['image']['name']); 

		///// $file_path = getcwd(). "/sales_order/".basename($_FILES['image']['name']); 
		move_uploaded_file($_FILES['image']['tmp_name'], $file_path);
    }
	
	$result = mysqli_query($con_signin, "update penerimaan_paket_masuk SET bukti_penerimaan='$foto', tanggal_terima=IF('$tanggal_terima' = '', NULL, '$tanggal_terima'), status=IF('$status' = '-1', NULL, '$status'), diterima_oleh='$diterima_oleh', update_by='$update_by' WHERE id='$id_paket_masuk'");	
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