<?php
	$print=$_GET['print'];
	if($print=="yes"){
	include"../../include/koneksi.php";
	$data=explode("-",$_GET['data']);
		$kolom=$data[0];
		$urut=$data[1];
		$paket=$data[2];
		$sekolah=$data[3];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tabel Warga Belajar | Bank Soal Sistem Kolaborasi Kurkulum 2013</title>
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
		$str="";
		$date=date("Y-m-d");
		$date=explode("-",$date);
		if($date[1]<=6) $str=$date[0]-1 ."/".$date[0];
		else $str=$date[0] ."/". ($date[0] + 1);
		
		if($sekolah=="semua")
			$sekolah="";
		else{
			$querycrisekolah=mysql_query("SELECT nama_sekolah FROM sekolah WHERE id_sekolah=$sekolah");
			$crisekolah=mysql_fetch_array($querycrisekolah);
			$sekolah="AND s.id_sekolah=$sekolah";
			$strsekolah="Di PKBM ". ucwords($crisekolah[0]) ."<br />";
		}
		
		echo "<h2 class='page-header text-center'>Data Siswa Peserta Ujian Kejar Paket Kurikulum 2013<br />$strsekolah Tahun Pelajaran $str</h2>";
		if($paket=="semua"){
			$paket="";
		}
		else{
			$paket="AND s.id_paket=$paket";
		}
		$querycetaksiswa=mysql_query("SELECT s.id_siswa, s.nama, p.paket, s.username, s.password, s.tempat_lahir, s.tanggal_lahir, s.alamat_siswa, s.jenis_kelamin FROM siswa as s, paket as p, sekolah as se WHERE s.id_paket=p.id_paket AND s.id_sekolah=se.id_sekolah $paket $sekolah ORDER BY $kolom $urut");
	
		$bulan=array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
	?>
    <table class="table table-bordered" style="font-size:10pt">
		<thead>
	    	<tr>
            	<th>NO</th>
	        	<th>ID</th>
	            <th>Nama</th>
                <th>Jenis Kelamin</th>
	            <th>Paket</th>
	            <th>TTL</th>
	            <th>ALAMAT</th>
	        </tr>
	    </thead>
	    <tbody>
	    	<?php
				$no=1;
				while($cetaksiswa=mysql_fetch_array($querycetaksiswa)){
					$tgl=explode("-",$cetaksiswa[6]);
					if($cetaksiswa[8]=="l") $jk="Laki-Laki";
					else $jk="Perempuan";
					echo "<tr>
					<td>$no</td>
					<td>$cetaksiswa[0]</td>
					<td>$cetaksiswa[1]</td>
					<td>$jk</td>
					<td>$cetaksiswa[2]</td>
					<td>".$cetaksiswa[5].", ".$tgl[2]." ".$bulan[$tgl[1]-1]." ".$tgl[0]."</td>
					<td>$cetaksiswa[7]</td>
					</tr>";
					$no++;
				}
				
			?>
    	</tbody>
	</table>
    <div class="pull-right" style="font-size:10pt; margin-top:50px;">
    	<div class="text-left">
        	Banjarmasin,   
			<?php 
				$tgl=date("Y-m");
				$tgl=explode("-",$tgl);
				$b=$bulan[$tgl[1]-1];
				echo " ". $b ." ". $tgl[0];
			?>
            <br />
            Penanggung Jawab,<br /><br /><br /><br /><br />
            ..........<br />
            NIP. 
        </div>
    </div>
</div>
</body>
</html>


<?php
	}
?>
