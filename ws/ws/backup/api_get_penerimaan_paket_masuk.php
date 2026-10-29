<?php 

include("koneksi.php");
 
$result = mysqli_query($con_signin, "select penerimaan_paket_masuk.*, m_jenis_dokumen.jenis_dokumen as value1, m_status_penerimaan.status as value2, m_employee.employee_name as value3, m_employee.employee_name as value4 from penerimaan_paket_masuk 
LEFT JOIN m_jenis_dokumen ON penerimaan_paket_masuk.jenis_dokumen=m_jenis_dokumen.id 
LEFT JOIN m_status_penerimaan ON penerimaan_paket_masuk.status=m_status_penerimaan.id
LEFT JOIN user ON penerimaan_paket_masuk.nama_penerima=user.id
LEFT JOIN m_employee ON penerimaan_paket_masuk.nama_penerima=m_employee.id 
order by penerimaan_paket_masuk.id DESC;");
$arr  = []; 
//, userlevels.userlevelname FROM  user LEFT JOIN userlevels ON user.level=userlevels.userlevelid
while ($rec = mysqli_fetch_assoc($result)) {
    $arr[] = array_map('utf8_encode', $rec);
}
echo '{"penerimaan_paket_masuk":' . json_encode($arr) . '}';
mysqli_close($connect);
?>