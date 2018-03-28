<?php
	$p=$_GET['p'];
	$l="?p=".$p;
	if(empty($p)) $l="./";
	$header="";
	$pagequery=mysql_query("SELECT menu,link FROM menu WHERE link like '%$l%'");
	$page=mysql_fetch_array($pagequery);
	$m=explode("-",$page['menu']);
	$lin=explode("-",$page['link']);
	for($i=0;$i<count($m);$i++){
		if($lin[$i]==$l){
			$header=$m[$i];
		}
	}
	
	switch($p){
		case "" :
			echo "<h1 class='page-header'>$header</h1>";
			include "page-beranda.php";
			break;
			
		case "profil" :
			echo "<h1 class='page-header'>$header</h1>";
			include "page-profil.php";
			break;
			
		case 'guru' :
			echo "<h1 class='page-header'>$header</h1>";
			include "page-guru.php";
			break;
		case 'data_guru' :
			echo "<h1 class='page-header'>$header</h1>";
			include "page-dataguru.php";
			break;
		
		case 'data_sekolah' :
			echo "<h1 class='page-header'>$header</h1>";
			include "page-datasekolah.php";
			break;
			
		case 'siswa' :
			echo "<h1 class='page-header'>$header</h1>";
			include "page-siswa.php";
			$total=totalbadge("siswa");
			if($total>0){
				$date=date("Y-m-d");
				mysql_query("UPDATE siswa SET lihat='$date' WHERE lihat='0000-00-00'");
			}
			break;
			
		case 'data_siswa' :
			echo "<h1 class='page-header'>$header</h1>";
			include "page-datasiswa.php";
			break;
		
		case "paket_pelajaran" :
			echo "<h1 class='page-header'>$header</h1>";
			include "page-paketpelajaran.php";
			$total=totalbadge("paket_pelajaran");
			if($total>0){
				$date=date("Y-m-d");
				mysql_query("UPDATE paket_pelajaran SET lihat='$date' WHERE lihat='0000-00-00'");
			}
			break;
			
		case 'data_paket_pelajaran' :
			echo "<h1 class='page-header'>$header</h1>";
			include "page-datapaketpelajaran.php";
			break;
		
		case 'soal' :
			echo "<h1 class='page-header'>$header</h1>";
			include "page-soal.php";
			$total=totalbadge("soal_pelajaran");
			if($total>0){
				$date=date("Y-m-d");
				mysql_query("UPDATE soal_pelajaran SET lihat='$date' WHERE lihat='0000-00-00'");
			}
			break;
			
		case 'data_soal' :
			echo "<h1 class='page-header'>$header</h1>";
			if(empty($_GET['edit']))
				include "page-datasoal.php";
			else
				include "page-editsoal.php";
			break;
			
		case 'ujian' :
			echo "<h1 class='page-header'>$header</h1>";
			include "page-ujian.php";
			$total=totalbadge("ujian");
			if($total>0){
				$date=date("Y-m-d");
				mysql_query("UPDATE ujian SET lihat='$date' WHERE lihat='0000-00-00'");
			}
			break;
			
		case 'nilai' :
			echo "<h1 class='page-header'>$header</h1>";
			include "page-nilai.php";
			break;
		
		case 'pengaturan_bank_soal' :
			echo "<h1 class='page-header'>$header</h1>";
			break;
			
		case 'import_siswa' :
			echo "<h1 class='page-header'>Import Data Siswa</h1>";
			include "page-importdatasiswa.php";
			break;
		default :
			echo "Halaman tidak ada";
	}
?>