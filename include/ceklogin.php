<?php
	include "koneksi.php";
	$username=$_POST['username'];
	$password=$_POST['password'];
	session_start();
	$queryceklogin=mysql_query("SELECT * FROM siswa WHERE username='$username' AND password='$password'");
	$ceklogin=mysql_num_rows($queryceklogin);
	if($ceklogin==1){
		$admin=mysql_fetch_array($queryceklogin);
		$_SESSION['id_siswa']=$admin['id_siswa'];
		$_SESSION['paket']=$admin['id_paket'];
	}
	else{
		echo "Username/password yang Anda masukkan salah";
	}
?>