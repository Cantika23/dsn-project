<?php 

include("koneksi.php");
if($_POST['id_user']) {
	$id_user = $_POST['id_user']; 
	$foto = $_POST['foto']; 
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
             
		$file_path = $_SERVER['DOCUMENT_ROOT']. "/files/".basename($_FILES['image']['name']); 

		///// $file_path = getcwd(). "/sales_order/".basename($_FILES['image']['name']); 
		move_uploaded_file($_FILES['image']['tmp_name'], $file_path);
    }
	
	$query = "INSERT INTO penerimaan_paket_masuk (no_dokumen, no_paket, nama_pengirim, keterangan, tanggal_terima, nama_penerima, jenis_dokumen, no_hp_penerima, email_penerima, status, bukti_penerimaan, diterima_oleh, id_user, created_date)
	VALUES ('$no_dokumen','$no_paket','$nama_pengirim','$keterangan',IF('$tanggal_terima' = '', NULL, '$tanggal_terima'),IF('$nama_penerima' = '', NULL, '$nama_penerima'),'$jenis_dokumen','$no_hp_penerima','$email_penerima',IF('$status' = '-1', NULL, '$status'), '$foto','$diterima_oleh','$id_user','$created_date') ";
	
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