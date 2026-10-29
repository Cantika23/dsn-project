<?php 

include("koneksi.php");
 
$result = mysqli_query($con_signin, "select * from m_notifikasi_expired order by id DESC");
$arr  = [];
while ($rec = mysqli_fetch_assoc($result)) {
    $arr[] = array_map('utf8_encode', $rec);
}
echo '{"m_notifikasi_expired":' . json_encode($arr) . '}';
mysqli_close($connect);
?>