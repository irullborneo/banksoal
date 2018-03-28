<?php
	include "../../include/koneksi.php";
	$idlihatsiswa=$_POST['id'];
	$idlihat=explode("-",$idlihatsiswa);
	$aksi=$_GET['aksi'];
	switch($aksi){
		case "lihatsemua" :
			$querylihatsiswa=mysql_query("SELECT * FROM siswa WHERE id_paket='$idlihat[1]' AND id_sekolah='$idlihat[2]' ORDER BY id_siswa DESC");
			while($lihatiswa=mysql_fetch_array($querylihatsiswa)){
				if($lihatiswa['jenis_kelamin']=="l") $jk="Laki-Laki";
					else $jk="Perempuan";
								
					$usia=explode("-",$lihatiswa['tanggal_lahir']);
					$usia=date("Y") - $usia[0];
					echo "<tr>
						<td>$lihatiswa[id_siswa]</td>
						<td>$lihatiswa[nama]</td>
						<td>$jk</td>
						<td>$usia</td>
					</tr>
					";
			}
			break;
		case "kembali" :
			$querylihatsiswa=mysql_query("SELECT * FROM siswa WHERE id_paket='$idlihat[1]' AND id_sekolah='$idlihat[2]' ORDER BY id_siswa DESC limit 5");
			while($lihatiswa=mysql_fetch_array($querylihatsiswa)){
				if($lihatiswa['jenis_kelamin']=="l") $jk="Laki-Laki";
					else $jk="Perempuan";
								
					$usia=explode("-",$lihatiswa['tanggal_lahir']);
					$usia=date("Y") - $usia[0];
					echo "<tr>
						<td>$lihatiswa[id_siswa]</td>
						<td>$lihatiswa[nama]</td>
						<td>$jk</td>
						<td>$usia</td>
					</tr>
					";
			}
			break;
	}
?>
