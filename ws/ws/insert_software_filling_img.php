<?php 

include("koneksi.php");
if($_POST['id_user']) {
	$id_user = $_POST['id_user']; 
	$foto = $_POST['foto'];
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
	
	$query = "INSERT INTO filing_dokumen ( no_box, kode_pt, kode_department, lokasi, tahun_pembuatan_dokumen, nama_dokumen, deskripsi, no_rak, no_gudang, file, masa_berlaku, created_date)
	VALUES ('$no_box','$kode_pt','$kode_department','$lokasi','$tahun_pembuatan_dokumen','$nama_dokumen','$deskripsi','$no_rak',IF('$no_gudang' = '', NULL, '$no_gudang'),'$foto',IF('$masa_berlaku' = '', NULL, '$masa_berlaku'),'$created_date') ";
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