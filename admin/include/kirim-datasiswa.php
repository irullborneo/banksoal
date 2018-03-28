<?php
	$aksi=$_GET['aksi'];
	switch($aksi){
		case "tambah" :
			$nama=$_POST['nama'];
			$jk=$_POST['jk'];
			$user=$_POST['user'];
			$pass=$_POST['pass'];
			$paket=$_POST['paket'];
			$tempat=$_POST['tempat'];
			$tgl=$_POST['tgl'];
			$bln=$_POST['bln'];
			$thn=$_POST['thn'];
			$alamat=$_POST['alamat'];
			$sekolah=$_POST['sekolah'];
			$pendidikanakhir=$_POST['pendidikanakhir'];
			if(empty($nama) || empty($jk) || empty($user) || empty($pass) || empty($paket) || empty($tempat) || empty($tgl) || empty($bln) || empty($thn) || empty($alamat) || empty($sekolah) || empty($pendidikanakhir)){
				echo "Form data tidak diisi";
			}
			else{
				$tgllahir="$thn-$bln-$tgl";
				if(mysql_query("INSERT INTO siswa(nama, jenis_kelamin, username, password, id_paket, tempat_lahir, tanggal_lahir, alamat_siswa, id_sekolah, pendidikan_akhir, id_input, tgl_input) VALUES('$nama','$jk','$user','$pass','$paket','$tempat','$tgllahir','$alamat','$sekolah','$pendidikanakhir','$_SESSION[id_admin]','$date')")){
				}
				else
					echo "Data yang Anda masukkan salah";

			}
			
			break;
			
		case "edit" :
			$id=$_POST['id'];
			$nama=$_POST['nama'];
			$jk=$_POST['jk'];
			$user=$_POST['user'];
			$pass=$_POST['pass'];
			$paket=$_POST['paket'];
			$tempat=$_POST['tempat'];
			$tgl=$_POST['tgl'];
			$bln=$_POST['bln'];
			$thn=$_POST['thn'];
			$alamat=$_POST['alamat'];
			$sekolah=$_POST['sekolah'];
			$pendidikanakhir=$_POST['pendidikanakhir'];
			if(empty($nama) || empty($jk) || empty($user) || empty($pass) || empty($paket) || empty($tempat) || empty($tgl) || empty($bln) || empty($thn) || empty($alamat) || empty($sekolah) || empty($pendidikanakhir)){
				echo "Form data tidak diisi";
			}
			else{
				
					$tgllahir="$thn-$bln-$tgl";
					if(mysql_query("UPDATE siswa SET nama='$nama', jenis_kelamin='$jk', username='$user', password='$pass', id_paket='$paket', tempat_lahir='$tempat', tanggal_lahir='$tgllahir', alamat_siswa='$alamat', id_sekolah='$sekolah', pendidikan_akhir='$pendidikanakhir' WHERE id_siswa='$id'")){
				}
				else{
					echo "Data yang Anda masukkan salah";
				}
			}
			
			break;
		case "hapus" :
			$id=$_POST['id'];
			$hapus=mysql_query("DELETE FROM siswa WHERE id_siswa='$id'");
			if($hapus){
			}
			else{
				echo "Tidak bisa menghapus data.";
			}
			break;
			
		case "hapuscheckbox" :
			$id=explode(",",$_POST['id']);
			for($i=0;$i<count($id);$i++){
				$hapus=mysql_query("DELETE FROM siswa WHERE id_siswa='$id[$i]'");
				if($hapus){
				}
				else{
					echo "Tidak bisa menghapus data.";
				}
			}
			break;
		default :
			break;
	}
?>