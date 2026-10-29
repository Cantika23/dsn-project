<?php 

include("koneksi.php");
 
$result = mysqli_query($con_signin, "select DISTINCT user.id id,
m_employee.orgname,m_employee.nik,m_employee.employee_name,m_employee.company_code,m_employee.company_name,m_employee.organization_name,m_employee.email,m_employee.phone1,m_employee.phone2
from user 
LEFT JOIN m_employee ON user.nama_user=m_employee.id where user.id <> 1 order by m_employee.id DESC ");
$arr  = [];
while ($rec = mysqli_fetch_assoc($result)) {
    $arr[] = array_map('utf8_encode', $rec);
}
echo '{"m_employee":' . json_encode($arr) . '}';
mysqli_close($connect);
?>