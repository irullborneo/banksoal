<?php
	$aksi=$_GET['aksi'];
	switch($aksi){
		case "hapus" :
			$id=$_POST['id'];
			$hapus=mysql_query("DELETE FROM nilai WHERE id_nilai='$id'");
			break;
	}
?>