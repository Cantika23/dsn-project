<?php 

include("koneksi.php");
 
$result = mysqli_query($con_signin, "select filing_dokumen.*, m_kode_pt.nama as value1, m_kode_pt.nama_lengkap as value2, m_kode_department.nama as value3, m_kode_department.nama_lengkap as value4, 
m_gudang.nama as value5, m_gudang.keterangan as value6,
m_notifikasi_expired.jenis_dokumen as value7, m_notifikasi_expired.interval as value8 from filing_dokumen 
LEFT JOIN m_kode_pt ON filing_dokumen.kode_pt=m_kode_pt.id 
LEFT JOIN m_kode_department ON filing_dokumen.kode_department=m_kode_department.id
LEFT JOIN m_gudang ON filing_dokumen.no_gudang=m_gudang.id
LEFT JOIN m_notifikasi_expired ON filing_dokumen.masa_berlaku=m_notifikasi_expired.id 
order by filing_dokumen.id DESC");
$arr  = []; 
//, userlevels.userlevelname FROM  user LEFT JOIN userlevels ON user.level=userlevels.userlevelid
while ($rec = mysqli_fetch_assoc($result)) {
    $arr[] = array_map('utf8_encode', $rec);
}
echo '{"filing_dokumen":' . json_encode($arr) . '}';
mysqli_close($connect);
?>