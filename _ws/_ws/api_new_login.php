<?php

include("koneksi.php");

if (!empty($_POST['username']) && !empty($_POST['password'])) {
    if ($_POST['username'] && $_POST['password']) {
        $username = $_POST['username'];
        $password = $_POST['password'];
		$qry = "SELECT user.id,user.username, user.level, m_employee.employee_name nama_user, user.email email, m_employee.company_code company_code, m_employee.company_name company_name, m_employee.organization_name organization_name, userlevels.userlevelname FROM  user 
		LEFT JOIN userlevels ON user.level=userlevels.userlevelid 
		LEFT JOIN m_employee ON user.npk=m_employee.nik  
		WHERE user.username like binary '$username' AND user.password='$password'";
		$result = mysqli_query($con_signin, $qry);	
		if (mysqli_num_rows($result)) {
			while ($rec = mysqli_fetch_assoc($result)) {
				$response[] = array_map('utf8_encode', $rec);
			}
			echo '{"login_response":' . json_encode($response) . '}';
		} else {			
			$response[] = array_map('utf8_encode', array('error' => 'True'));
			echo '{"login_response":' . json_encode($response) . '}';
		}
    }  
}
mysqli_close($connect);
?>