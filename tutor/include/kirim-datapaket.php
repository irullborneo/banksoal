<?php
	$aksi=$_GET['aksi'];
	switch($aksi){
		case 'tambah' :
			$paket=$_POST['paket'];
			if($paket!=""){
				mysql_query("INSERT INTO paket(paket) VALUES('$paket')");
			}
			else{
				echo "Form data tidak diisi";
			}
		break;
		
		case 'edit' :
			$paket=$_POST['paket'];
			$id=$_POST['id'];
			if($paket!=""){
				mysql_query("UPDATE paket SET paket='$paket' WHERE id_paket=$id");
			}
			else{
				echo "Form data tidak diisi";
			}
			break;
		
		case 'hapus' :
			$id=$_POST['id'];
			$hapus=mysql_query("DELETE FROM paket WHERE id_paket='$id'");
			if($hapus){
			}
			else{
				echo "Tidak bisa menghapus data.";
			}
			break;
	}
?>