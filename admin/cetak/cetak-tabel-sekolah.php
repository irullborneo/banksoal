<?php
	$print=$_GET['print'];
	if($print=="yes"){
	include "../../include/koneksi.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tabel PKBM | Bank Soal Sistem Kolaborasi Kurkulum 2013</title>
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
		
		echo "<h2 class=\"page-header text-center\">Data Pusat Kegiatan Belajar Masyarakat (PKBM)<br />Tahun $date[0]</h2>";
	?>
    
    <table class="table table-bordered" style="font-size:10pt">
    	<thead>
        	<tr>
            	<th>No</th>
                <th>PKBM</th>
                <?php
					$querypaket=mysql_query("SELECT paket FROM paket ORDER BY id_paket");
					while($paket=mysql_fetch_array($querypaket)){
						echo "<th>Paket<br />$paket[0]</th>";
					}
				?>
                <th>Jumlah<br />Warga Belajar</th>
                <th>Jumlah<br />Tutor</th>
                <th>Penanggung<br />Jawab</th>
                <th>No. Telpon</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
        <?php
			$querysekolah=mysql_query("SELECT se.id_sekolah, se.nama_sekolah, g.nama, se.telpon, se.alamat FROM sekolah as se, guru as g WHERE se.id_guru=g.id_guru ORDER BY se.nama_sekolah ASC");
			$no=1;
			while($sekolah=mysql_fetch_array($querysekolah)){
				echo "<tr>
					<td>$no</td>
					<td>$sekolah[1]</td>
				";
				$queryp=mysql_query("SELECT id_paket FROM paket ORDER BY id_paket");
				while($p=mysql_fetch_array($queryp)){
					$laki=mysql_num_rows(mysql_query("SELECT * FROM siswa as si, paket as p WHERE si.id_paket=p.id_paket AND si.id_paket='$p[0]' AND si.id_sekolah='$sekolah[0]' AND si.jenis_kelamin='l'"));
					$perempuan=mysql_num_rows(mysql_query("SELECT * FROM siswa as si, paket as p WHERE si.id_paket=p.id_paket AND si.id_paket='$p[0]' AND si.id_sekolah='$sekolah[0]' AND si.jenis_kelamin='p'"));
					$jlh=mysql_num_rows(mysql_query("SELECT * FROM siswa as si, paket as p WHERE si.id_paket=p.id_paket AND si.id_paket='$p[0]' AND si.id_sekolah='$sekolah[0]'"));
					echo "<td><p>L = $laki</p>
					<p>P = $perempuan</p>
					<p>J = $jlh</p>
					</td>
					";
				}
				$banyaksiswa=mysql_num_rows(mysql_query("SELECT * FROM siswa WHERE id_sekolah='$sekolah[0]'"));
				$banyakguru=mysql_num_rows(mysql_query("SELECT * FROM guru WHERE id_sekolah='$sekolah[0]'"));
				echo "
					<td>$banyaksiswa</td>
					<td>$banyakguru</td>
					<td>$sekolah[2]</td>
					<td>$sekolah[3]</td>
					<td>$sekolah[4]</td>
				</tr>
				";
				$no++;
			}
		?>
        </tbody>
    </table>
    
</div>
</body>
</html>
<?php } ?>