<?php
	$formatgambar= array("csv","CSV");
	$path="../tmp/";
	$size=524288;
	
	function generate($u){
		$pengacak = 'abcdefghijklmnopqrstuvwxyz1234567890';
		$string = '';
		for($i = 0; $i < $u; $i++) {
   			$pos = rand(0, strlen($pengacak)-1);
   			$string .= $pengacak{$pos};
   		}
    	return $string;
	}
	
	function getExtension($str){
		$i = strrpos($str,".");
    	if (!$i) { return ""; } 
   		$l = strlen($str) - $i;
   		$ext = substr($str,$i+1,$l);
   		return $ext;
	}
	
	$nama=$_FILES['file-import']['name'];
	$ukuran=$_FILES['file-import']['size'];
	if(strlen($nama)){
		
		if($ukuran<$size){
			$i=getExtension($nama);
			
			if(in_array($i,$formatgambar)){
				$namagmr=time().substr(str_replace(" ", "_", $txt), 5).".".$i;
				$tmp=$_FILES['file-import']['tmp_name'];
				if(move_uploaded_file($tmp, $path.$namagmr)){
					if (($handle = fopen($path.$namagmr, "r")) !== FALSE) {
						$importhead=1;
						
						echo "<div class='alert' id='status-import' role='alert'>
        					<strong id='status-import-hasil'></strong>: <span id='isi-status-import-active'></span>
        				</div>
						<table class='table table-hover'>
							<thead>
								<tr>
									<th>NAMA</th>
									<th>JENIS KELAMIN</th>
									<th>USERNAME</th>
									<th>PASSWORD</th>
									<th>PAKET</th>
									<th>TEMPAT LAHIR</th>
									<th>TANGGAL LAHIR</th>
									<th>ALAMAT</th>
									<th>SEKOLAH</th>
									<th>PENDIDIKAN AKHIR</th>
								</tr>
							</thead>
							<tbody>
						";
						$padabaris="";
						$banyakbaris=0;
						$banyaksalah=0;
						$couneror=true;
      					while (($data = fgetcsv($handle, 1000, $_POST['pemisah-kolom'])) !== FALSE) {
							if($importhead>0){
								$importhead=0;
								continue;
							}
        					$num = count($data);
							$cekrow=true;
							$stringqueryimportsiswa="INSERT INTO siswa(nama, jenis_kelamin, username, password, id_paket, tempat_lahir, tanggal_lahir, alamat_siswa, id_sekolah, pendidikan_akhir, id_input, tgl_input) VALUES(";
							$colomn=0;
							echo "<tr>";
        					for ($c=0; $c < $num; $c++) {
								if($colomn>=1){ $stringqueryimportsiswa.=",";}
								$colomn++;
								if($c==2){
									$usernamesiswa=generate(6);
									echo "<td>".$usernamesiswa."</td>";
									$stringqueryimportsiswa.="'$usernamesiswa'";
								}
								else if($c==3){
									$passwordsiswa=generate(4);
									echo "<td>".$passwordsiswa."</td>";
									$stringqueryimportsiswa.="'$passwordsiswa'";
								}
								else if($c==4){
									$querymaxpaket=mysql_query("SELECT * FROM paket ORDER BY id_paket DESC limit 1");
									$maxpaket=mysql_fetch_array($querymaxpaket);
									if($data[$c]>=1 && $data[$c]<=$maxpaket['id_paket']){
										echo "<td>$data[$c]</td>";
										$stringqueryimportsiswa.="'$data[$c]'";
									}
									else{
										echo "<td>Salah</td>";
										$couneror=false;
										$cekrow=false;
									}
								}
								else if($c==6){
									if(strpos($data[$c],"/") !==""){
										$cektglsiswa=explode("/",$data[$c]);
										if(($cektglsiswa[0]>=1 && $cektglsiswa[0]<=31) && ($cektglsiswa[1]>=1 && $cektglsiswa[1]<=12)){
											echo "<td>$data[$c]</td>";
											$stringqueryimportsiswa.="'$cektglsiswa[2]-$cektglsiswa[1]-$cektglsiswa[0]'";
										}
										else {
											echo "<td>Salah1</td>";
											$couneror=false;
											$cekrow=false;
										}
									}
									else{
										echo "<td>Salah</td>";
										$couneror=false;
										$cekrow=false;
									}
								}
								else if($c==8){
									$querymaxsekolah=mysql_query("SELECT * FROM paket ORDER BY id_paket DESC limit 1");
									$maxsekolah=mysql_fetch_array($querymaxsekolah);
									if($data[$c]>=1 && $data[$c]<=$maxsekolah['id_paket']){
										$sekolahimport=mysql_fetch_array(mysql_query("SELECT nama_sekolah FROM sekolah WHERE id_sekolah='$data[$c]'"));
										echo "<td>$sekolahimport[0]</td>";
										$stringqueryimportsiswa.="'$data[$c]'";
									}
									else{
										echo "<td>Salah</td>";
										$couneror=false;
										$cekrow=false;
									}
								}
								else{
           							echo "<td>$data[$c]</td>";
									$stringqueryimportsiswa.="'$data[$c]'";
								}
        					}
							echo "</tr>";
							$stringqueryimportsiswa.=",'$_SESSION[id_admin]','$date')";
							$banyakbaris++;
							if(!$cekrow){
								$padabaris.= "$banyakbaris ";
							}
							else{
								mysql_query($stringqueryimportsiswa);
							}
							
    					}
						echo "</tbody></table> 
						";
						if($couneror){
							echo "<div id='status-import-hidden' style='display:none'>Sukses</div>
								<div id='isi-status-import' style='display:none'>$banyakbaris baris telah diimport</div>
								<div id='class-status-import' style='display:none'>alert alert-success</div>
							";
						}
						else{
							echo "<div id='status-import-hidden' style='display:none'>Gagal</div>
								<div id='isi-status-import' style='display:none'>Data yang diimport tidak sesuai pada baris $padabaris</div>
								<div id='class-status-import' style='display:none'>alert alert-warning</div>
							";
						}
						unlink($path."".$namagmr);
					}
				}
				else{
					echo "error4";
				}
			}
			else{
				echo "error1";
			}
			
		}
		else{
			echo "error3";
		}
		
	}
	else{
		echo "error2";
	}
?>