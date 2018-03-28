<?php
	$username=$_POST['username'];
	$password=$_POST['password'];
	session_start();
	$queryceklogin=mysql_query("SELECT * FROM guru WHERE username='$username' AND password='$password' AND sebagai='admin'");
	$ceklogin=mysql_num_rows($queryceklogin);
	if($ceklogin==1){
		$admin=mysql_fetch_array($queryceklogin);
		$_SESSION['id_admin']=$admin['id_guru'];
		$cekinputadminlogin=mysql_query("INSERT INTO guru_login(id_guru, tgl_login) VALUES('$admin[id_guru]','$datetime')");
	}
	else{
		echo "Username/password yang Anda masukkan salah";
	}
?>