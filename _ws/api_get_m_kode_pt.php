<?php 

include("koneksi.php");
 
$result = mysqli_query($con_signin, "select * from m_kode_pt order by id DESC");
$arr  = [];
while ($rec = mysqli_fetch_assoc($result)) {
    $arr[] = array_map('utf8_encode', $rec);
}
echo '{"m_kode_pt":' . json_encode($arr) . '}';
mysqli_close($connect);
?>