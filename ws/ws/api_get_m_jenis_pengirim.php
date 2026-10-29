<?php 

include("koneksi.php");
 
$result = mysqli_query($con_signin, "select * from m_jenis_pengirim order by id DESC");
$arr  = [];
while ($rec = mysqli_fetch_assoc($result)) {
    $arr[] = array_map('utf8_encode', $rec);
}
echo '{"m_jenis_pengirim":' . json_encode($arr) . '}';
mysqli_close($connect);
?>