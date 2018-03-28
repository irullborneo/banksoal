<?php
	include "../../include/koneksi.php";
	$kolom=$_GET['kolom'];
	if($kolom=="tgl_input")
		$query=mysql_query("SELECT tgl_input FROM soal_pelajaran GROUP BY tgl_input ORDER BY tgl_input ASC");
	else if($kolom=="paket")
		$query=mysql_query("SELECT p.paket, p.id_paket FROM paket as p, paket_pelajaran as pp, soal_pelajaran as sp WHERE p.id_paket=pp.id_paket AND sp.id_paket_pelajaran=pp.id_paket_pelajaran GROUP BY p.paket ORDER BY p.paket ASC");
	else if($kolom=="mata_pelajaran")
		$query=mysql_query("SELECT mp.mata_pelajaran, mp.id_pelajaran FROM mata_pelajaran as mp, paket_pelajaran as pp, soal_pelajaran as sp WHERE mp.id_pelajaran=pp.id_pelajaran AND sp.id_paket_pelajaran=pp.id_paket_pelajaran GROUP BY mp.mata_pelajaran ORDER BY mp.mata_pelajaran ASC");
	else if($kolom=="guru")
		$query=mysql_query("SELECT g.nama, g.id_guru FROM guru as g, paket_pelajaran as pp, soal_pelajaran as sp WHERE g.id_guru=pp.id_guru AND sp.id_paket_pelajaran=pp.id_paket_pelajaran GROUP BY g.nama ORDER BY g.nama ASC");
		
		echo "<option value=\"semua\">Semua</option>";
	while($hasil=mysql_fetch_array($query)){
		if($kolom=="tgl_input"){
			$tgl=explode("-",$hasil[0]);
			echo "<option value='$hasil[0]'>".$tgl[2]."/".$tgl[1]."/".$tgl[0]."</option>";
		}
		else{
			echo "<option value='$hasil[1]'>".$hasil[0]."</option>";
		}
	}
?>