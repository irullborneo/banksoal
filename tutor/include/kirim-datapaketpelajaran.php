<?php
	$aksi=$_GET['aksi'];
	switch($aksi){
		case "tambah" :
			$paket=$_POST['paket'];
			$pelajaran=$_POST['pelajaran'];
			$guru=$_POST['guru'];
			$kkm=$_POST['kkm'];
			if(empty($paket) || empty($pelajaran) || empty($guru) || empty($kkm)){
				echo "Form data tidak diisi";
			}
			else{
				if(mysql_query("INSERT INTO paket_pelajaran(id_paket, id_pelajaran, id_guru, kkm, tgl_input, penginput) VALUES('$paket','$pelajaran','$guru','$kkm','$date','$_SESSION[id_admin]')")){
				}
				else{
					echo "Data tidak bisa tersimpan coba sekali lagi";
				}
			}
			break;
		
		case "edit" :
			$id=$_POST['id'];
			$paket=$_POST['paket'];
			$pelajaran=$_POST['pelajaran'];
			$guru=$_POST['guru'];
			$kkm=$_POST['kkm'];
			if(empty($id) || empty($paket) || empty($pelajaran) || empty($guru) || empty($kkm)){
				echo "Form data tidak diisi";
			}
			else{
				if(mysql_query("UPDATE paket_pelajaran SET id_paket=$paket, id_pelajaran=$pelajaran, id_guru=$guru, kkm=$kkm WHERE id_paket_pelajaran=$id")){
				}
				else{
					echo "Data tidak bisa diedit coba sekali lagi";
				}
			}
			break;
		
		case "hapus" :
			$id=$_POST['id'];
			$hapus=mysql_query("DELETE FROM paket_pelajaran WHERE id_paket_pelajaran='$id'");
			if($hapus){
			}
			else{
				echo "Tidak bisa menghapus data.";
			}
			break;
			
		case "hapuscheckbox" :
			$id=explode(",",$_POST['id']);
			for($i=0;$i<count($id);$i++){
				$hapus=mysql_query("DELETE FROM paket_pelajaran WHERE id_paket_pelajaran='$id[$i]'");
				if($hapus){
				}
				else{
					echo "Tidak bisa menghapus data.";
				}
			}
			break;
	}
?>