<?php
	$aksi=$_GET['aksi'];
	switch($aksi){
		case "tambah" :
			$nip=$_POST['nip'];
			$nama=$_POST['nama'];
			$jk=$_POST['jk'];
			$alamat=$_POST['alamat'];
			$sekolah=$_POST['sekolah'];
			$pendidikan=$_POST['pendidikan'];
			$tempatlahir=$_POST['tempatlahir'];
			$tgllahir=$_POST['tgllahir'];
			
			$cekuser=mysql_num_rows(mysql_query("SELECT * FROM guru WHERE sebagai='guru' AND username='$user'"));
			
			if(empty($nama) || empty($jk) || empty($alamat) || empty($sekolah) || empty($pendidikan) || empty($tempatlahir) || empty($tgllahir)){
				echo "Form data tidak diisi";
			}
			else{
				if(mysql_query("INSERT INTO guru(nip, nama, jenis_kelamin, tempat_lahir, tanggal_lahir, alamat, id_sekolah, sebagai, pendidikan_akhir, tgl_input) VALUES('$nip','$nama','$jk','$tempatlahir','$tgllahir','$alamat','$sekolah','guru','$pendidikan','".$date."')")){
					function generate($u){
						$pengacak = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
						$string = '';
						for($i = 0; $i < $u; $i++) {
   							$pos = rand(0, strlen($pengacak)-1);
   							$string .= $pengacak{$pos};
   						}
    					return $string;
					}
					
					$idguru=mysql_fetch_array(mysql_query("SELECT id_guru FROM guru ORDER BY id_guru DESC"));
					mysql_query("INSERT INTO guru_aktivasi(id_guru, kode_aktivasi, konfirmasi) VALUES('$idguru[0]','".generate(9)."','0')");
				}
				else{
					echo "Data yang Anda masukkan salah";
				}
			}
			
			break;
			
		case "edit" :
			$id=$_POST['id'];
			$nip=$_POST['nip'];
			$nama=$_POST['nama'];
			$jk=$_POST['jk'];
			$alamat=$_POST['alamat'];
			$user=$_POST['user'];
			$sandi=$_POST['sandi'];
			$sekolah=$_POST['sekolah'];
			$pendidikan=$_POST['pendidikan'];
			$tempatlahir=$_POST['tempatlahir'];
			$tgllahir=$_POST['tgllahir'];
			
			$cekuser=mysql_num_rows(mysql_query("SELECT * FROM guru WHERE sebagai='guru' AND username='$user' AND id_guru!=$id"));
			
			if(empty($nama) || empty($jk) || empty($alamat) || empty($user) || empty($sandi) || empty($sekolah) || empty($pendidikan) || empty($tempatlahir) || empty($tgllahir)){
				echo "Form data tidak diisi";
			}
			else if($cekuser>0){
				echo "Username tidak tersedia";
			}
			else{
				if(mysql_query("UPDATE guru SET nip='$nip', nama='$nama', jenis_kelamin='$jk', tempat_lahir='$tempatlahir', tanggal_lahir='$tgllahir', alamat='$alamat', id_sekolah='$sekolah', pendidikan_akhir='$pendidikan', username='$user', password='$sandi' WHERE id_guru='$id'")){
				}
				else{
					echo "Data yang Anda masukkan salah";
				}
			}
			break;
		
		case "hapus" :
			$id=$_POST['id'];
			$hapus=mysql_query("DELETE FROM guru WHERE id_guru='$id'");
			if($hapus){
				mysql_query("DELETE FROM guru_aktivasi WHERE id_guru='$id'");
			}
			else{
				echo "Tidak bisa menghapus data.";
			}
			break;
			
		case "hapuscheckbox" :
			$id=explode(",",$_POST['id']);
			for($i=0;$i<count($id);$i++){
				$hapus=mysql_query("DELETE FROM guru WHERE id_guru='$id[$i]'");
				if($hapus){
					mysql_query("DELETE FROM guru_aktivasi WHERE id_guru='$id[$i]'");
				}
				else{
					echo "Tidak bisa menghapus data.";
				}
			}
			break;
			
		case "profil" :
			$id=$_POST['id'];
			$nip=$_POST['nip'];
			$nama=$_POST['nama'];
			$jk=$_POST['jk'];
			$alamat=$_POST['alamat'];
			$user=$_POST['user'];
			$sandi1=$_POST['sandi1'];
			$sandi2=$_POST['sandi2'];
			$sandi3=$_POST['sandi3'];
			$pendidikan=$_POST['pendidikan'];
			$tempatlahir=$_POST['tempatlahir'];
			$tgllahir=$_POST['tgllahir'];
			$usernam=mysql_fetch_array(mysql_query("SELECT username FROM guru WHERE id_guru='$id'"));
			
			$cekpassword=mysql_num_rows(mysql_query("SELECT * FROM guru WHERE id_guru='$id' AND password='$sandi3'"));
			
			if($sandi3==""){
				echo "Masukkan Password sekarang.";
			}
			else if($cekpassword==1){
				if($sandi1==$sandi2){
					if($usernam[0]==$user){
						$cekuser=0;
					}
					else{
						$cekuser=mysql_num_rows(mysql_query("SELECT * FROM guru WHERE username='$user'"));
					}
					
					if(empty($nama) || empty($jk) || empty($alamat) || empty($pendidikan) || empty($tempatlahir) || empty($tgllahir) || empty($user)){
						echo "Form data tidak diisi ";
					}
					else if($cekuser>0){
						echo "Username tidak tersedia";
					}
					else{
						if($sandi1==""){
							$sandi=$sandi3;
						}
						else{
							$sandi=$sandi1;
						}
						if(mysql_query("UPDATE guru SET nip='$nip', nama='$nama', jenis_kelamin='$jk', tempat_lahir='$tempatlahir', tanggal_lahir='$tgllahir', alamat='$alamat', id_sekolah='$sekolah', pendidikan_akhir='$pendidikan', username='$user', password='$sandi' WHERE id_guru='$id'")){
						}
						else{
							echo "Data yang Anda masukkan salah";
						}
					}
				}
				else{
					echo "Password baru tidak sama";
				}
			}
			else{
				echo "Password yang anda masukkan salah";
			}
			
			break;
	}
?>