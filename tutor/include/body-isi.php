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

		case 'siswa' :
			echo "<h1 class='page-header'>$header</h1>";
			include "page-siswa.php";
			
			break;
			
		case 'data_siswa' :
			echo "<h1 class='page-header'>$header</h1>";
			include "page-datasiswa.php";
			break;
		
		case "paket_pelajaran" :
			echo "<h1 class='page-header'>$header</h1>";
			include "page-paketpelajaran.php";
			
			break;
			
		case 'data_paket_pelajaran' :
			echo "<h1 class='page-header'>$header</h1>";
			include "page-datapaketpelajaran.php";
			break;
		
		case 'soal' :
			echo "<h1 class='page-header'>$header</h1>";
			include "page-soal.php";
			
			break;
			
		case 'data_soal' :
			echo "<h1 class='page-header'>$header</h1>";
			if(empty($_GET['edit']))
				include "page-datasoal.php";
			else
				include "page-editsoal.php";
			break;
			
			
		case 'nilai' :
			echo "<h1 class='page-header'>$header</h1>";
			include "page-nilai.php";
			break;
		
			
		case 'import_siswa' :
			echo "<h1 class='page-header'>Import Data Siswa</h1>";
			include "page-importdatasiswa.php";
			break;
		default :
			echo "Halaman tidak ada";
	}
?>