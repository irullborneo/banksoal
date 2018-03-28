<?php
	include "koneksi.php";
	$id=$_POST['i'];
	session_start();
	$srtsoal="";
	date_default_timezone_set("Asia/Singapore");
		$querysoal=mysql_query("SELECT id_soal_cerita, tipe_soal, soal, tipe_jawab, pilihan, jawab, id_soal_gambar, id_soal FROM soal WHERE id_soal_pelajaran='$id' ORDER BY RAND(), id_soal_cerita ASC");
		$awal=false;
					$arr="";
		while($soal=mysql_fetch_array($querysoal)){
			$t=true;
			$str=explode("-",$arr);
			for($i=0;$i<count($str);$i++){
				if($soal[7]==$str[$i]){
					$t=false;
				}
			}
			if($t){
				if($soal[0]>0){
					$querycerita=mysql_query("SELECT id_soal_cerita, tipe_soal, soal, tipe_jawab, pilihan, jawab, id_soal_gambar, id_soal FROM soal WHERE id_soal_pelajaran='$id' AND id_soal_cerita='$soal[0]' ORDER BY id_soal ASC");
					$strip="-";
					
					while($cerita=mysql_fetch_array($querycerita)){
						$srtsoal.="-$cerita[7]";
						if($awal){
							$arr.=$strip ."". $cerita[7];
						}
						else{
							$arr.=$cerita[7];
						}
						$awal=true;
					}
				}
				else{
					$srtsoal.="-$soal[7]";
				}
			}
		}
		
		if(isset($_SESSION['id_siswa']) && isset($_SESSION['paket'])){
			$waktu=mysql_fetch_array(mysql_query("SELECT banyak_soal FROM ujian WHERE id_ujian='$_POST[u]'"));
			$ba=$waktu[0];
			$so=explode("-",$srtsoal);
			for($i=1;$i<=$ba;$i++){
				$tsrsoal.="-$so[$i]";
			}
			$_SESSION['soal']=$tsrsoal;
			$srtsoal=explode("-",$tsrsoal);
		}
		else{
			$_SESSION['soal']=$srtsoal;
			$srtsoal=explode("-",$srtsoal);
		}
		
		
		$_SESSION['waktu']=date("H:i:s");
		
		
		$banyak=count($srtsoal);
		for($i=1;$i<$banyak;$i++){
			$soal=mysql_fetch_array(mysql_query("SELECT pilihan FROM soal WHERE id_soal='$srtsoal[$i]'"));
			$pilihan=explode("|",$soal[0]);
			shuffle($pilihan);
			$g="";
			$strpilihan="";
			for($u=0;$u<count($pilihan);$u++){
				$strpilihan.=$g."".$pilihan[$u];
				$g="|";
			}
			$_SESSION['pilihan-'.$i]=$strpilihan;
			$_SESSION['jawab-'.$i]="";
		}
		
		if(isset($_SESSION['id_siswa']) && isset($_SESSION['paket'])){
			$_SESSION['untuk']="ujian";
			$_SESSION['ujian']=$_POST['u'];
		}
		else{
			$_SESSION['untuk']="latihan";
		}
		
?>