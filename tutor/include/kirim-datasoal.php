<?php
	$aksi=$_GET['aksi'];
	switch($aksi){
		case "buat":
			$pp=$_POST['pp'];
			$guru=$_POST['guru'];

					if(mysql_query("INSERT INTO soal_pelajaran(id_paket_pelajaran, penulis, tgl_input, untuk) VALUES('$pp','$_SESSION[id_admin]','$date','ujian')")){
						$id=mysql_fetch_array(mysql_query("SELECT id_soal_pelajaran FROM soal_pelajaran ORDER BY id_soal_pelajaran DESC"));
						echo $id[0];
					}
					else{
						echo "notice3";
					}

			break;
		
		case "editsoalpelajaran" :
			$id=$_POST['id'];
			$paket=$_POST['paket'];
			$pelajaran=$_POST['pelajaran'];
			$guru=$_POST['guru'];
			$untuk=$_POST['untuk'];
			if(empty($id) || empty($paket) || empty($pelajaran) || empty($guru)){
				echo "Form data tidak diisi";
			}
			else{
				$ceksoal=mysql_num_rows(mysql_query("SELECT * FROM paket_pelajaran WHERE id_paket=$paket AND id_pelajaran=$pelajaran AND id_guru=$guru"));
				if($ceksoal==1){
					$idpaketsoal=mysql_fetch_array(mysql_query("SELECT id_paket_pelajaran FROM paket_pelajaran WHERE id_paket=$paket AND id_pelajaran=$pelajaran AND id_guru=$guru"));
					if(mysql_query("UPDATE soal_pelajaran SET id_paket_pelajaran=$idpaketsoal[0], untuk='$untuk' WHERE id_soal_pelajaran=$id")){
					}
					else{
						echo "Data tidak bisa diedit coba sekali lagi";
					}
				}
				else{
					echo "Data Paket Pelajaran tidak ada";
				}
			}
			break;
		
		case "tambahcerita" :
			$cerita=$_POST['cerita'];
			if(empty($cerita)){
				echo "Form data tidak diisi";
			}
			else{
				mysql_query("INSERT INTO soal_cerita(soal_cerita, awal_cerita) VALUES('$cerita','$cerita')");
			}
			break;
		
		case "editcerita":
			$cerita=$_POST['cerita'];
			$id=$_POST['id'];
			if(empty($cerita)){
				echo "Form data tidak diisi";
			}
			else{
				mysql_query("UPDATE soal_cerita SET soal_cerita='$cerita', awal_cerita='$cerita' WHERE id_soal_cerita=$id");
			}
			break;
			
		case "hapuscerita" :
			$id=$_POST['id'];
			if(mysql_query("DELETE FROM soal_cerita WHERE id_soal_cerita=$id")){
			}
			else{
				echo "Data tidak bisa dihapus";
			}
			break;
			
		case "tambahgambar" :
			$path="../../gambar/";
			function getExtension($str){

         		$i = strrpos($str,".");
         		if (!$i) { return ""; } 

         		$l = strlen($str) - $i;
        		$ext = substr($str,$i+1,$l);
         		return $ext;
 			}
			$formatgambar= array("png", "gif", "PNG","GIF","jpg","jpeg","JPG");
			$filename=$_FILES['gambar']['name'];
			$ext = pathinfo( $filename, PATHINFO_EXTENSION );
			if(strlen($filename)){
				$i=getExtension($filename);
				if(in_array($i,$formatgambar)){
					if( $_FILES['gambar']['size'] < 524288 ) {
						$namagmr=time().substr(str_replace(" ", "_", $txt), 5).".".$i;
						$tmp=$_FILES['gambar']['tmp_name'];
						move_uploaded_file($tmp, $path.$namagmr);
						$linkgambar="../gambar/".$namagmr;
						mysql_query("INSERT INTO soal_gambar(soal_gambar) VALUES('gambar/$namagmr')");
						echo $linkgambar;
						
					}
					else{
						echo "error2";
					}
				}
				else{
					echo "error1";
				}
			}
			break;
			
		case "hapusgambar" :
			$id=$_POST['id'];
			if(mysql_query("DELETE FROM soal_gambar WHERE id_soal_gambar=$id")){
			}
			else{
				echo "Data tidak bisa dihapus";
			}
			break;
		
		case "tambahbarissoal":
			$abc="a b c d e f g h i j k l m n o p q r s t u v w x y z";
			$ab=explode(" ",$abc);
			$idsoalpelajaran=$_POST['soalpelajaran'];
			$soal=$_POST['sl'];
			$cerita=$_POST['cr'];
			$gambar=$_POST['gm'];
			$tipesoal=$_POST['tipesl'];
			$tipejawab=$_POST['tipejwb'];
			$pilihan=$_POST['plhn'];
			$jawab=$_POST['jawab'];
			$persen=$_POST['prsn'];
			if(empty($soal) || empty($pilihan) || empty($jawab)){
				if(empty($soal))
					echo "Form Soal Belum diisi, ";
				
				if(empty($pilihan))
					echo "Pilihan belum diisi, ";
				
				if(empty($jawab))
					echo "Jawaban belum dipilih.";
			}
			else{
				if($tipesoal=="ganda"){
					$persen=100;
					$pilih=explode("|",$pilihan);
					$p="";
					for($i=0;$i<count($pilih);$i++){
						if($i>=1){
							$p.="|";
						}
						$p.=$ab[$i].">".$pilih[$i];
					}
					$j=$jawab;
					
				}
				else if($tipesoal=="checkbox"){
					$pilih=explode("|",$pilihan);
					$p="";
					for($i=0;$i<count($pilih);$i++){
						if($i>=1){
							$p.="|";
						}
						$p.=$pilih[$i];
					}
					
					$jwb=explode("|",$jawab);
					$j="";
					for($i=0;$i<count($jwb);$i++){
						if($i>=1){
							$j.="|";
						}
						$j.=$jwb[$i];
					}
					$tipejawab="text";
				}
				
				mysql_query("INSERT INTO soal(id_soal_pelajaran, id_soal_cerita, tipe_soal, soal, tipe_jawab, pilihan, jawab, persen_benar, id_soal_gambar) VALUES('$idsoalpelajaran','$cerita','$tipesoal','$soal','$tipejawab','$p','$j','$persen','$gambar')");
			}
			break;
		
		case "editbarissoal":
			$abc="a b c d e f g h i j k l m n o p q r s t u v w x y z";
			$ab=explode(" ",$abc);
			$idsoalpelajaran=$_POST['soalpelajaran'];
			$soal=$_POST['sl'];
			$cerita=$_POST['cr'];
			$gambar=$_POST['gm'];
			$tipesoal=$_POST['tipesl'];
			$tipejawab=$_POST['tipejwb'];
			$pilihan=$_POST['plhn'];
			$jawab=$_POST['jawab'];
			$persen=$_POST['prsn'];
			$id=$_POST['id'];
			if(empty($soal) || empty($pilihan) || empty($jawab)){
				if(empty($soal))
					echo "Form Soal Belum diisi, ";
				
				if(empty($pilihan))
					echo "Pilihan belum diisi, ";
				
				if(empty($jawab))
					echo "Jawaban belum dipilih.";
			}
			else{
				if($tipesoal=="ganda"){
					$persen=100;
					$pilih=explode("|",$pilihan);
					$p="";
					for($i=0;$i<count($pilih);$i++){
						if($i>=1){
							$p.="|";
						}
						$p.=$ab[$i].">".$pilih[$i];
					}
					$j=$jawab;
					
				}
				else if($tipesoal=="checkbox"){
					$pilih=explode("|",$pilihan);
					$p="";
					for($i=0;$i<count($pilih);$i++){
						if($i>=1){
							$p.="|";
						}
						$p.=$pilih[$i];
					}
					
					$jwb=explode("|",$jawab);
					$j="";
					for($i=0;$i<count($jwb);$i++){
						if($i>=1){
							$j.="|";
						}
						$j.=$jwb[$i];
					}
					$tipejawab="text";
				}
				
				mysql_query("UPDATE soal SET id_soal_cerita='$cerita', tipe_soal='$tipesoal', soal='$soal', tipe_jawab='$tipejawab', pilihan='$p', jawab='$j', persen_benar='$persen', id_soal_gambar='$gambar' WHERE id_soal='$id'");
			}
			break;
		case "hapusbarissoal":
			$id=$_POST['id'];
			mysql_query("DELETE FROM soal WHERE id_soal='$id'");
			break;
			
		case "hapussoal":
			$id=$_POST['id'];
			mysql_query("DELETE FROM soal_pelajaran WHERE id_soal_pelajaran='$id'");
			mysql_query("DELETE FROM soal WHERE id_soal_pelajaran='$id'");
			break;
			
		case "hapuscheckbox" :
			$id=explode(",",$_POST['id']);
			for($i=0;$i<count($id);$i++){
				$hapus=mysql_query("DELETE FROM soal_pelajaran WHERE id_soal_pelajaran='$id[$i]'");
				if($hapus){
				}
				else{
					echo "Tidak bisa menghapus data.";
				}
			}
			break;
	}
?>