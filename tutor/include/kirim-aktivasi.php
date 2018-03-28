<?php
	$aksi=$_GET['aksi'];
	switch($aksi){
		case "aktif" :
			$kode=$_POST['kodeaktiv'];
			$cekkode=mysql_num_rows(mysql_query("SELECT * FROM guru_aktivasi WHERE kode_aktivasi='$kode' AND konfirmasi='0'"));
			if($cekkode==1){
				$admin=mysql_fetch_array(mysql_query("SELECT id_guru, id_guru_aktivasi FROM guru_aktivasi WHERE kode_aktivasi='$kode' AND konfirmasi='0'"));
				
				echo $admin['id_guru'];
				
			}
			else{
				echo "notice1";
			}
			break;
			
		case "login" :
			$idguru=$_POST['idguru'];
			$user=$_POST['user'];
			$pass1=$_POST['pass1'];
			$pass2=$_POST['pass2'];
			
			if($pass1==$pass2){
				if(empty($user) || empty ($pass1)){
					echo "Form tidak diisi.";
				}
				else{
					$cekuser=mysql_num_rows(mysql_query("SELECT * FROM guru WHERE sebagai='guru' AND username='$user'"));
					if($cekuser>0){
						echo "Username tidak tersedia";
					}
					else{
						session_start();
						mysql_query("UPDATE guru SET username='$user', password='$pass1' WHERE id_guru='$idguru'");
						$_SESSION['id_admin']=$idguru;
						mysql_query("UPDATE guru_aktivasi SET konfirmasi='1' WHERE id_guru='$idguru'");
						$cekinputadminlogin=mysql_query("INSERT INTO guru_login(id_guru, tgl_login) VALUES('$idguru','$datetime')");
					}
				}
			}
			else{
				echo "Password yang dimasukkan tidak sama.";
			}
			
			
			break;
	}
	
?>