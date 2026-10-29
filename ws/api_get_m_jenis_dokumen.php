<?php 

include("koneksi.php");
 
$result = mysqli_query($con_signin, "select * from m_jenis_dokumen order by id DESC");
$arr  = [];
while ($rec = mysqli_fetch_assoc($result)) {
    $arr[] = array_map('utf8_encode', $rec);
}
echo '{"m_jenis_dokumen":' . json_encode($arr) . '}';
mysqli_close($connect);
?>