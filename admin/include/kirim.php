<?php
	session_start();
	include"../../include/koneksi.php";
	$kirim=$_GET['kirim'];
	date_default_timezone_set("Asia/Singapore");
	$datetime=date('Y-m-d H:i:s');
	$date=date("Y-m-d");
	switch($kirim){
		case "importsiswa" :
			include "kirim-importsiswa.php";
			break;
		
		case "ceklogin" :
			include "kirim-ceklogin.php";
			break;
			
		case "datasiswa" :
			include "kirim-datasiswa.php";
			break;
			
		case "datapaket" :
			include "kirim-datapaket.php";
			break;
		case "datapelajaran":
			include "kirim-datamatapelajaran.php";
			break;
		case "datapaketpelajaran" :
			include "kirim-datapaketpelajaran.php";
			break;
		case "dataguru" :
			include "kirim-dataguru.php";
			break;
		case "datasoal" :
			include "kirim-datasoal.php";
			break;
		case "ujian":
			include "kirim-ujian.php";
			break;
			
		case "datasekolah" :
			include "kirim-datasekolah.php";
			break;
		case "nilai" :
			include "kirim-nilai.php";
			break;
		default :
			break;
	}
?>