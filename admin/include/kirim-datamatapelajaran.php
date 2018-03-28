<?php
	$aksi=$_GET['aksi'];
	switch($aksi){
		case 'tambah' :
			$pelajaran=$_POST['pelajaran'];
			if($pelajaran!=""){
				mysql_query("INSERT INTO mata_pelajaran(mata_pelajaran) VALUES('$pelajaran')");
			}
			else{
				echo "Form data tidak diisi";
			}
		
		case 'edit' :
			$pelajaran=$_POST['pelajaran'];
			$id=$_POST['id'];
			if($pelajaran!=""){
				mysql_query("UPDATE mata_pelajaran SET mata_pelajaran='$pelajaran' WHERE id_pelajaran=$id");
			}
			else{
				echo "Form data tidak diisi";
			}
			break;
		
		case 'hapus':
			$id=$_POST['id'];
			$hapus=mysql_query("DELETE FROM mata_pelajaran WHERE id_pelajaran='$id'");
			if($hapus){
			}
			else{
				echo "Tidak bisa menghapus data.";
			}
		break;
	}
?>