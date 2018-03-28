<?php
	$print=$_GET['print'];
	if($print=="yes"){
	include"../../include/koneksi.php";
	$data=explode("-",$_GET['data']);
	$data=explode("-",$_GET['data']);
		$kolom=$data[0];
		$urut=$data[1];
		$paket=$data[2];
		$sekolah=$data[3];
		
	if($sekolah=="semua")
			$sekolah="";
		else{
			$sekolah="AND s.id_sekolah=$sekolah";
		}
	if($paket=="semua"){
			$paket="";
		}
		else{
			$paket="AND s.id_paket=$paket";
		}
		
		$str="";
		$date=date("Y-m-d");
		$date=explode("-",$date);
		if($date[1]<=6) $str=$date[0]-1 ."/".$date[0];
		else $str=$date[0] ."/". ($date[0] + 1);
	$bulan=array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
	$hari=array("","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Kartu Siswa | Bank Soal Sistem Kolaborasi Kurkulum 2013</title>
<link rel="shortcut icon" href="../../img/icon.png" />
<link rel="stylesheet" type="text/css" href="../../css/bootstrap.css" />
<script type="text/javascript" src="../../jquery/jquery-2.0.2.js"></script>
<script type="text/javascript" src="../../jquery/bootstrap.js"></script>
<script type="text/javascript" src="../../jquery/jquery-printme.js"></script>
</head>
<script type="text/javascript">
	print();
</script>
<body>
<div class="container-fluid visible-print">
	<?php
		echo "<div style=\"height:1187px\">";
		$querycetaksiswa=mysql_query("SELECT s.id_siswa, s.nama, p.paket, s.username, s.password, s.tempat_lahir, s.tanggal_lahir, se.id_sekolah, se.nama_sekolah, se.alamat, se.telpon, p.id_paket FROM siswa as s, paket as p, sekolah as se WHERE s.id_paket=p.id_paket AND s.id_sekolah=se.id_sekolah $paket $sekolah ORDER BY $kolom $urut");
		while($cetaksiswa=mysql_fetch_array($querycetaksiswa)){
			$tgl=explode("-",$cetaksiswa[6]);
	?>
	<div style="border:1px solid #000; padding-bottom:10px;">
		<div class="row">
        	<div class="col-xs-6">
            	<div class="container-fluid">
            	<h4 class="text-center">Pusat Kegiatan Belajar Masyarakat<br  /><?php echo ucwords($cetaksiswa[8]) ?><br />Tahun Pelajaran <?php echo $str ?></h4>
            	<div class="text-center" style="font-size:9px; font-style:italic; border-bottom:1px solid #000"><?php echo $cetaksiswa[9] ?> No. Telpon <span class="glyphicon glyphicon-phone-alt"></span> <?php echo $cetaksiswa[10] ?></div>
            	<div style="font-size:8pt; margin-top:10px;">
            	    <table border="0">
            	    	<tr><td>NAMA</td><td width="5px"> : </td><td><?php echo $cetaksiswa[1] ?></td></tr>
            	        <tr><td>PAKET</td><td> : </td><td><?php echo $cetaksiswa[2] ?></td></tr>
            	        <tr><td>TTL</td><td> : </td><td><?php echo $cetaksiswa[5].", ". $tgl[2] ." ". $bulan[intval($tgl[1])] ." ". $tgl[0] ?></td></tr>
            	        <tr><td>USERNAME</td><td> : </td><td><?php echo $cetaksiswa[3] ?></td></tr>
            	        <tr><td>PASSWORD</td><td> : </td><td><?php echo $cetaksiswa[4] ?></td></tr>
            	    </table>
            	    <br />
            	    <div class="pull-right">
            	    	<div class="text-center">
            	        	Banjarmasin,    <?php echo $bulan[intval($date[1])] ." ". $date[0] ?><br />
            		        Penanggung Jawab,
               	 		    <br /><br />
                            <?php
								$tanggung=mysql_fetch_array(mysql_query("SELECT g.nama, g.nip FROM guru as g, sekolah as se WHERE se.id_guru=g.id_guru AND se.id_sekolah='$cetaksiswa[7]'")); 
								echo $tanggung[0] ."<br />NIP. ". $tanggung[1];
								
								$j=mysql_fetch_array(mysql_query("SELECT jadwal_ujian, tgl_awal, tgl_akhir, id_jadwal_ujian FROM ujian_jadwal ORDER BY tgl_awal DESC limit 1"));
							?>
                    	   
                    	</div>
                	</div>
            	</div>
                </div>
            </div>
            <div class="col-xs-6">
            	<div class="container-fluid">
                	<h5 class="text-center" style="border-bottom:1px solid #000">Jadwal Ujian <?php echo $j[0] ?> Paket <?php echo $cetaksiswa[2]; ?> Kurikulum 2013<br />Tahun Pelajaran <?php echo $str; ?></h5>
                    <div style="font-size:5pt;">
                    <table class="table">
                    	<thead>
                        	<tr>
                            	<th>No</th>
                                <th>Hari/Tgl.</th>
                                <th>Waktu</th>
                                <th>Mata Pelajaran</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
							$jadwal=explode(" ",$j[1]);
							$tanggal=explode("-",$jadwal[0]);
							$tgl=$tanggal[2];
							$bln=$tanggal[1];
							$thn=$tanggal[0];
							$i=0;
							$no=1;
							do{
								$jdw=date("Y-m-d H:i:s", mktime(0, 0, 0, $bln, ($tgl+$i),$thn));
								$wdj=explode(" ",$jdw);
								$banyakujian=mysql_num_rows(mysql_query("SELECT * FROM ujian as u, soal_pelajaran as sp, paket_pelajaran as pp WHERE u.id_soal_pelajaran=sp.id_soal_pelajaran AND sp.id_paket_pelajaran=pp.id_paket_pelajaran AND pp.id_paket='$cetaksiswa[11]' AND u.id_jadwal_ujian='$j[3]'"));
								$tgl1=explode("-",$wdj[0]);
								if($banyakujian>1){
									$rowspan="rowspan=\"$banyakujian\"";
								}
								else{
									$rowspan="";
								}
								$queryujian=mysql_query("SELECT u.jadwal_ujian, u.waktu FROM ujian as u, soal_pelajaran as sp, paket_pelajaran as pp WHERE u.id_soal_pelajaran=sp.id_soal_pelajaran AND sp.id_paket_pelajaran=pp.id_paket_pelajaran AND pp.id_paket='$cetaksiswa[11]' AND u.jadwal_ujian like '%$wdj[0]%'");
								echo "<tr>
									<td>$no $banyakujian</td>
									<td>".$hari[date("N", strtotime($wdj[0]))].", $tgl1[2] ".$bulan[intval($tgl1[1])]." $tgl1[0]</td>
									<td>
								";
								while($ujian=mysql_fetch_array($queryujian)){
									$tgl_ujian=explode(" ",$ujian[0]);
									$t=explode("-",$tgl_ujian[0]);
									$w=explode(":",$tgl_ujian[1]);
									$waktu_akhir=date("H:i", mktime($w[0], ($w[1]+$ujian[1]), $w[2], $t[1], $t[2], $t[0]));
									echo "<p>".$w[0].":".$w[1]." - ".$waktu_akhir."</p>";
								}
								echo "
									</td>
									<td>
								";
								$querymp=mysql_query("SELECT mp.mata_pelajaran FROM ujian as u, soal_pelajaran as sp, paket_pelajaran as pp, mata_pelajaran as mp WHERE u.id_soal_pelajaran=sp.id_soal_pelajaran AND sp.id_paket_pelajaran=pp.id_paket_pelajaran AND pp.id_pelajaran=mp.id_pelajaran AND pp.id_paket='$cetaksiswa[11]' AND u.jadwal_ujian like '%$wdj[0]%'");
								while($mp=mysql_fetch_array($querymp)){
									echo "<p>$mp[0]</p>";
								}
								echo "
									</td>
								</tr>";
								$i++;
								$no++;
							}while($jdw!=$j[2])
						?>
                        </tbody>
                    </table>
                    </div>
                </div>
           </div>
        </div>
       
	</div>
    <br />
     <?php
	 	if(($i+1)%3==0){
			echo "</div><div style=\"height:1187px\">";
		}
		}echo "</div>";
	?>
</div>
</body>
</html>
<?php }?>