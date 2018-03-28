<?php
	include "koneksi.php";
	$kirim=$_GET['kirim'];
	session_start();
	switch($kirim){
		case "jawab" :
			$jawab=$_POST['jawab'];
			$nomer=$_POST['nomer'];
			$is=$nomer;
			$_SESSION["jawab-".$is]=$jawab;
			echo $_SESSION["jawab-".$is];
			break;
			
	}
?>