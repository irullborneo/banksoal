<?php
	include "../../include/koneksi.php";
	$kolom=$_GET['kolom'];
	switch($kolom){
		case "jenis_kelamin" ;
			$query=mysql_query("SELECT jenis_kelamin FROM guru WHERE sebagai='guru' GROUP BY jenis_kelamin ORDER BY jenis_kelamin ASC");
			echo "<option value=\"semua\">Semua</option>";
			while($hasil=mysql_fetch_array($query)){
				if($hasil[0]=="l") $jk="Laki-Laki";
				else $jk="Perempuan";
				echo "<option value='$hasil[0]'>".$jk."</option>";
			}
			break;
		case "id_sekolah" :
			$query=mysql_query("SELECT g.id_sekolah, s.nama_sekolah FROM guru as g, sekolah as s WHERE g.id_sekolah=s.id_sekolah AND sebagai='guru' GROUP BY g.id_sekolah ORDER BY jenis_kelamin ASC");
			echo "<option value=\"semua\">Semua</option>";
			while($hasil=mysql_fetch_array($query)){
				echo "<option value='$hasil[0]'>".$hasil[1]."</option>";
			}
			break;
		
	}
	
?>