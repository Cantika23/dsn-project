<?php 

include("koneksi.php");
if($_POST['id_filling_dokumen']) {
	$foto = $_POST['foto']; 
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
	
	// 
	 
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
	
	$result = mysqli_query($con_signin, "update filing_dokumen SET no_box='$no_box', kode_pt='$kode_pt', kode_department='$kode_department', lokasi='$lokasi', tahun_pembuatan_dokumen='$tahun_pembuatan_dokumen',
		nama_dokumen='$nama_dokumen', deskripsi='$deskripsi', no_rak='$no_rak', no_gudang=IF('$no_gudang' = '', NULL, '$no_gudang'), file='$foto', 
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