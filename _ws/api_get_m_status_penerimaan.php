<?php 

include("koneksi.php");
 
$result = mysqli_query($con_signin, "select * from m_status_penerimaan order by id DESC");
$arr  = [];
while ($rec = mysqli_fetch_assoc($result)) {
    $arr[] = array_map('utf8_encode', $rec);
}
echo '{"m_status_penerimaan":' . json_encode($arr) . '}';
mysqli_close($connect);
?>