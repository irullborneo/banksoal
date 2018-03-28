<?php
	session_start();
	unset($_SESSION['id_siswa']);
	unset($_SESSION['paket']);
	session_destroy();
	header ("location: ./login.php");
?>