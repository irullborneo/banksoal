<?php
	include "../../include/koneksi.php";
	$kolom=$_GET['kolom'];
	$form=$_GET['form'];
	$paket=$_GET['paket'];
	if($form=="paketpelajaranpaket"){
		$query=mysql_query("SELECT mp.id_pelajaran, mp.mata_pelajaran FROM mata_pelajaran as mp, paket_pelajaran as pp WHERE mp.id_pelajaran=pp.id_pelajaran AND pp.id_paket=$kolom GROUP BY mp.mata_pelajaran ORDER BY mp.mata_pelajaran ASC");
	}
	else if($form=="paketmatapelajaran"){
		$query=mysql_query("SELECT g.id_guru, g.nama FROM guru as g, paket_pelajaran as pp WHERE g.id_guru=pp.id_guru AND pp.id_paket=$paket AND pp.id_pelajaran=$kolom GROUP BY g.nama ORDER BY g.nama ASC");
	}
	
	while($hasil=mysql_fetch_array($query)){
		echo "<option value='$hasil[0]'>".$hasil[1]."</option>";
	}
?>