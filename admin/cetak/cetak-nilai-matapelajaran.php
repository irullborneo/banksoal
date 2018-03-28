<?php
	$print=$_GET['print'];
	if($print=="yes"){
	include"../../include/koneksi.php";
	$data=explode("-",$_GET['data']);
		$ujian=$data[0];
		$sekolah=$data[1];
		$matapelajaran=$data[2];
		$paket=$data[3];
	
	
	if($paket=="semua"){
		$paket="";
		$order="ORDER BY p.id_paket ASC, si.nama ASC";
	}
	else{
		$p=mysql_fetch_array(mysql_query("SELECT paket FROm paket WHERE id_paket='$paket'"));
		$paket=" AND pp.id_paket='$paket'";
		$order="ORDER BY si.nama ASC";
	}
	
	$querysiswa=mysql_query("SELECT si.nama, n.nilai, p.paket, si.jenis_kelamin FROM nilai as n, ujian as u, soal_pelajaran as sp, paket_pelajaran as pp, paket as p, mata_pelajaran as mp, sekolah as se, siswa as si WHERE n.id_ujian=u.id_ujian AND u.id_soal_pelajaran=sp.id_soal_pelajaran AND sp.id_paket_pelajaran=pp.id_paket_pelajaran AND pp.id_paket=p.id_paket AND pp.id_pelajaran=mp.id_pelajaran AND si.id_sekolah=se.id_sekolah $paket AND n.id_siswa=si.id_siswa AND pp.id_pelajaran='$matapelajaran' AND se.id_sekolah='$sekolah' AND u.id_jadwal_ujian='$ujian' $order");
	
	$mp=mysql_fetch_array(mysql_query("SELECT mata_pelajaran FROM mata_pelajaran WHERE id_pelajaran='$matapelajaran'"));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Nilai <?php echo $mp[0]; ?> | Bank Soal Sistem Kolaborasi Kurkulum 2013</title>
<link rel="shortcut icon" href="../../img/icon.png" />
<link rel="stylesheet" type="text/css" href="../../css/bootstrap.css" />
<script type="text/javascript" src="../../jquery/jquery-2.0.2.js"></script>
<script type="text/javascript" src="../../jquery/bootstrap.js"></script>
</head>
<script type="text/javascript">
	print();
</script>
<body>
<div class="container-fluid visible-print">
	<?php
		$strdate="";
		$date=date("Y-m-d");
		$date=explode("-",$date);
		if($date[1]<=6) $strdate=$date[0]-1 ."/".$date[0];
		else $strdate=$date[0] ."/". ($date[0] + 1);
	?>
	<h3 class="text-center">Nilau Ujian<br />Mata Pelajaran <?php echo $mp[0] ?><br />Tahun Pelajaran <?php echo $strdate ?></h3>
    <hr />
    <?php
		if($paket!=""){
			echo "<table>
				<tr><td>Paket</td><td style=\"padding-right:10px;\"> : </td><td>$p[0]</td></tr>
			</table>";
		}	
	?>
    
    <table class="table table-bordered" style="font-size:10pt">
    	<thead>
        	<tr>
            	<th>No</th>
                <th>Nama</th>
                <th>L/P</th>
                <?php
					if($paket==""){
						echo "<th>Paket</th>";
					}
                ?>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
        <?php
			$no=1;
			while($siswa=mysql_fetch_array($querysiswa)){
				echo "<tr>
					<td>$no</td>
					<td>$siswa[0]</td>
					<td>".ucwords($siswa[3])."</td>
				";
				if($paket==""){
					echo "<td>$siswa[2]</td>";
				}
				echo "
					<td>$siswa[1]</td>
				</tr>
				";
				$no++;
			}
		?>
        </tbody>
    </table>
    <?php
		$querysiswamax=mysql_fetch_array(mysql_query("SELECT n.nilai FROM nilai as n, ujian as u, soal_pelajaran as sp, paket_pelajaran as pp, paket as p, mata_pelajaran as mp, sekolah as se, siswa as si WHERE n.id_ujian=u.id_ujian AND u.id_soal_pelajaran=sp.id_soal_pelajaran AND sp.id_paket_pelajaran=pp.id_paket_pelajaran AND pp.id_paket=p.id_paket AND pp.id_pelajaran=mp.id_pelajaran AND si.id_sekolah=se.id_sekolah $paket AND n.id_siswa=si.id_siswa AND pp.id_pelajaran='$matapelajaran' AND se.id_sekolah='$sekolah' AND u.id_jadwal_ujian='$ujian' ORDER BY  n.nilai DESC limit 1"));
		$querysiswamin=mysql_fetch_array(mysql_query("SELECT n.nilai FROM nilai as n, ujian as u, soal_pelajaran as sp, paket_pelajaran as pp, paket as p, mata_pelajaran as mp, sekolah as se, siswa as si WHERE n.id_ujian=u.id_ujian AND u.id_soal_pelajaran=sp.id_soal_pelajaran AND sp.id_paket_pelajaran=pp.id_paket_pelajaran AND pp.id_paket=p.id_paket AND pp.id_pelajaran=mp.id_pelajaran AND si.id_sekolah=se.id_sekolah $paket AND n.id_siswa=si.id_siswa AND pp.id_pelajaran='$matapelajaran' AND se.id_sekolah='$sekolah' AND u.id_jadwal_ujian='$ujian' ORDER BY  n.nilai ASC limit 1"));
		$querysiswaavg=mysql_query("SELECT n.nilai FROM nilai as n, ujian as u, soal_pelajaran as sp, paket_pelajaran as pp, paket as p, mata_pelajaran as mp, sekolah as se, siswa as si WHERE n.id_ujian=u.id_ujian AND u.id_soal_pelajaran=sp.id_soal_pelajaran AND sp.id_paket_pelajaran=pp.id_paket_pelajaran AND pp.id_paket=p.id_paket AND pp.id_pelajaran=mp.id_pelajaran AND si.id_sekolah=se.id_sekolah $paket AND n.id_siswa=si.id_siswa AND pp.id_pelajaran='$matapelajaran' AND se.id_sekolah='$sekolah' AND u.id_jadwal_ujian='$ujian'");
		
		$bsiswa=0;
		$sumsiswa=0;
		while($siswaavg=mysql_fetch_array($querysiswaavg)){
			$sumsiswa=$sumsiswa+$siswaavg[0];
			$bsiswa++;
		}
		
		echo "<div class=\"row\" style=\"margin-top:20px;\">
			<div class=\"col-md-4 col-sm-4\">
			<table class=\"table table-bordered\" style=\"font-size:10pt\">
    			<tr>
    		    	<td>Nilai Terendah</td><td>$querysiswamin[0]</td>
	    	    </tr>
				<tr>	
					<td>Nilai Tertinggi</td><td>$querysiswamax[0]</td>
				</tr>
				<tr>	
					<td>Rata-Rata</td><td>".($sumsiswa/$bsiswa)."</td>
				</tr>
    		</table>
			</div>
		</div>
		";
		
		if($paket!=""){
			$bulan=array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
			$tanggal=date("Y-m-d");
			$tgl=explode("-",$tanggal);
			echo "<div class=\"row\" style=\"margin-top:20px;\">
				<div class=\"col-md-4 col-sm-4\">&nbsp;
				</div>
				<div class=\"col-md-4 col-sm-4\">&nbsp;
				</div>
				<div class=\"col-md-4 col-sm-4\">
				Banjarmasin, $tgl[2] ".$bulan[intval($tgl[1])] ." $tgl[0] <br />Tutor,<br /><br /><br /><br />
			";
			$guru=mysql_fetch_array(mysql_query("SELECT g.nama, g.nip FROM guru as g, paket_pelajaran as pp, sekolah as se WHERE g.id_sekolah=se.id_sekolah AND pp.id_guru=g.id_guru AND pp.id_paket='$data[3]' AND pp.id_pelajaran='$matapelajaran' limit 1"));
			echo "$guru[0]<br />NIP. $guru[1]
				</div>
			</div>
			";
		}
	?>
   
    
</div>
</body>
</html>
<?php
	}
?>