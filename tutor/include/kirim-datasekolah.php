<?php
	$aksi=$_GET['aksi'];
	switch($aksi){
		case "hapuscheckbox" :
			$id=explode(",",$_POST['id']);
			for($i=0;$i<count($id);$i++){
				$hapus=mysql_query("DELETE FROM sekolah WHERE id_sekolah='$id[$i]'");
				if($hapus){
				}
				else{
					echo "Tidak bisa menghapus data.";
				}
			}
			break;
			
		case "tambah" :
			$nama=$_POST['nama'];
			$alamat=$_POST['alamat'];
			$telpon=$_POST['telpon'];
			if(empty($nama) || empty($alamat) || empty($telpon)){
				echo "Form data tidak diisi";
			}
			else{
				if(mysql_query("INSERT INTO sekolah(tgl_input, nama_sekolah, alamat, telpon) VALUES('".$date."','$nama','$alamat','$telpon')")){
				}
				else{
					echo "Data yang Anda masukkan salah";
				}
			}
			break;
		
		case "edit":
			$id=$_POST['id'];
			$sekolah=$_POST['sekolah'];
			$alamat=$_POST['alamat'];
			$telpon=$_POST['telpon'];
			$guru=$_POST['guru'];
			if(empty($sekolah) || empty($alamat) || empty($telpon)){
				echo "Form data tidak diisi $id | $sekolah | $alamat | $telpon | $guru";
			}
			else{
				if(empty($guru)){
					echo "Masukkan data guru <a href=\"./?p=data_guru\">di sini</a>";
				}
				else{
					if(mysql_query("UPDATE sekolah SET nama_sekolah='$sekolah', alamat='$alamat', telpon='$telpon', id_guru='$guru' WHERE id_sekolah='$id'")){
					}
					else{
						echo "Data yang Anda masukkan salah";
					}
				}
			}
			break;
			
		case "hapus" :
			$id=$_POST['id'];
			$hapus=mysql_query("DELETE FROM sekolah WHERE id_sekolah='$id'");
			if($hapus){
			}
			else{
				echo "Tidak bisa menghapus data.";
			}
			break;
	}
?>