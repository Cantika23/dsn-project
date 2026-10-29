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
	$foto = $_POST['foto']; 
	$no_paket = $_POST['no_paket'];
	$nama_pengirim = $_POST['nama_pengirim'];
	$keterangan = $_POST['keterangan'];
	
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
	
	
	$result = mysqli_query($con_signin, "update penerimaan_paket_masuk SET no_dokumen='$no_dokumen', no_paket='$no_paket', nama_pengirim='$nama_pengirim', keterangan='$keterangan', tanggal_terima=IF('$tanggal_terima' = '', NULL, '$tanggal_terima'), jenis_dokumen='$jenis_dokumen', no_hp_penerima='$no_hp_penerima',
		email_penerima='$email_penerima', status=IF('$status' = '-1', NULL, '$status'),nama_penerima=IF('$nama_penerima' = '', NULL, '$nama_penerima'), bukti_penerimaan='$foto', diterima_oleh='$diterima_oleh' WHERE id='$id_paket_masuk'");	
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