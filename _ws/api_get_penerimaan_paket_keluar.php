<?php 

include("koneksi.php");
 
$result = mysqli_query($con_signin, "select penerimaan_paket_keluar.*, m_jenis_dokumen.jenis_dokumen as value1, m_status_penerimaan.status as value2, m_jenis_pengirim.jenis_pengirim as value3 from penerimaan_paket_keluar 
LEFT JOIN m_jenis_dokumen ON penerimaan_paket_keluar.jenis_dokumen=m_jenis_dokumen.id 
LEFT JOIN m_status_penerimaan ON penerimaan_paket_keluar.status=m_status_penerimaan.id 
LEFT JOIN m_jenis_pengirim ON penerimaan_paket_keluar.jenis_pengirim=m_jenis_pengirim.id 
order by penerimaan_paket_keluar.id DESC");
$arr  = []; 
while ($rec = mysqli_fetch_assoc($result)) {
    $arr[] = array_map('utf8_encode', $rec);
}
echo '{"penerimaan_paket_keluar":' . json_encode($arr) . '}';
mysqli_close($connect);
?>