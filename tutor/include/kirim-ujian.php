<?php
	$aksi=$_GET['aksi'];
	switch($aksi){
		case "buat" :
			$ujian=$_POST['ujn'];
			$tanggalawal=$_POST['t1'];
			$tanggalakhir=$_POST['t2'];
			if(empty($ujian) || empty($tanggalawal) || empty($tanggalakhir)){
				echo "Form data tidak diisi";
			}
			else{
				mysql_query("INSERT INTO ujian_jadwal(jadwal_ujian, tgl_awal, tgl_akhir) VALUES('$ujian','$tanggalawal
				','$tanggalakhir')");
			}
			break;
			
		case "tambah":
			$idjadwal=$_POST['ju'];
			$soal=$_POST['s'];
			$banyak=$_POST['bs'];
			$waktu=$_POST['drs'];
			$jadwal=$_POST['jadwal'];
			if(empty($soal) || empty($banyak) || empty($waktu) || empty($jadwal) || empty($idjadwal)){
				echo "Form data tidak diisi";
			}
			else{
				mysql_query("INSERT INTO ujian(id_jadwal_ujian, id_soal_pelajaran, banyak_soal, waktu, jadwal_ujian) VALUES('$idjadwal','$soal','$banyak','$waktu','$jadwal')");
			}
			break;
		case "hapus" :
			$id=$_POST['idujian'];
			mysql_query("DELETE FROM ujian WHERE id_ujian='$id'");
			break;
			
		case "edit" :
			$id=$_POST['id'];
			$ujian=$_POST['ujn'];
			$tanggalawal=$_POST['t1'];
			$tanggalakhir=$_POST['t2'];
			if(empty($ujian) || empty($tanggalawal) || empty($tanggalakhir)){
				echo "Form data tidak diisi";
			}
			else{
				mysql_query("UPDATE ujian_jadwal SET jadwal_ujian='$ujian', tgl_awal='$tanggalawal', tgl_akhir='$tanggalakhir' WHERE id_jadwal_ujian='$id'");
			}
			break;
			
		case "hapusjadwal" :
			$id=$_POST['id'];
			$hapus=mysql_query("DELETE FROM ujian_jadwal WHERE id_jadwal_ujian='$id'");
			if($hapus){
			}
			else{
				echo "Tidak bisa menghapus data.";
			}
			break;
			
		case "hapuscheckbox":
			$id=explode(",",$_POST['id']);
			for($i=0;$i<count($id);$i++){
				$hapus=mysql_query("DELETE FROM ujian_jadwal WHERE id_jadwal_ujian='$id[$i]'");
				if($hapus){
					mysql_query("DELETE FROM ujian WHERE id_jadwal_ujian='$id[$i]'");
				}
				else{
					echo "Tidak bisa menghapus data.";
				}
			}
			break;
	};
?>