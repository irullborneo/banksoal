<?php
	include "../../include/koneksi.php";
	$kolom=$_GET['kolom'];
	if($kolom=="paket")
		$query=mysql_query("SELECT p.paket, pp.id_paket FROM paket_pelajaran as pp, paket as p WHERE pp.id_paket=p.id_paket GROUP BY pp.id_paket ORDER BY p.paket ASC");
	else if($kolom=="mata_pelajaran")
		$query=mysql_query("SELECT mp.mata_pelajaran, pp.id_pelajaran FROM paket_pelajaran as pp, mata_pelajaran as mp WHERE pp.id_pelajaran=mp.id_pelajaran GROUP BY pp.id_pelajaran ORDER BY mp.mata_pelajaran ASC");
	else if($kolom=="guru")
		$query=mysql_query("SELECT g.nama, pp.id_guru FROM paket_pelajaran as pp, guru as g WHERE pp.id_guru=g.id_guru GROUP BY pp.id_guru ORDER BY g.nama ASC");
		
		echo "<option value=\"semua\">Semua</option>";
	while($hasil=mysql_fetch_array($query)){
		echo "<option value='$hasil[1]'>".$hasil[0]."</option>";
	}
?>