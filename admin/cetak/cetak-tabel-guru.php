<?php
	$print=$_GET['print'];
	if($print=="yes"){
	include "../../include/koneksi.php";
	$data=$_GET['data'];
	if($data=="semua"){
		$id="";
	}
	else{
		$id="AND se.id_sekolah='$data'";
	}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tabel Tutor | Bank Soal Sistem Kolaborasi Kurkulum 2013</title>
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
		$strsekolah="";
		if($data!="semua"){
			$querycrisekolah=mysql_query("SELECT nama_sekolah FROM sekolah WHERE id_sekolah='$data'");
			$crisekolah=mysql_fetch_array($querycrisekolah);
			$strsekolah="Di PKBM ". ucwords($crisekolah[0]);
		}
		
		echo "<h2 class=\"page-header text-center\">Daftar Tutor $strsekolah<br />Program Kejar Paket Kurikulum 2013<br />Tahun Pelajaran $str</h2>";
		
		
	?>
    <table class="table table-bordered" style="font-size:10pt">
    	<thead>
        	<tr>
            	<th>NO</th>
                <th>NAMA</th>
                <th>L/P</th>
                <th>PENDIDIKAN<br />AKHIR</th>
                <th>MATA PELAJARAN</th>
                <th>PKBM</th>
                <th>ALAMAT</th>
            </tr>
        </thead>
        <tbody>
        <?php
			$querysekolah=mysql_query("SELECT g.id_guru, g.nama, g.jenis_kelamin, g.pendidikan_akhir, g.alamat, se.nama_sekolah FROM guru as g, sekolah as se WHERE g.id_sekolah=se.id_sekolah $id ORDER BY g.nama ASC");
			$no=1;
			while($sekolah=mysql_fetch_array($querysekolah)){
				echo "<tr>
					<td>$no</td>
					<td>$sekolah[1]</td>
					<td>".ucwords($sekolah[2])."</td>
					<td>$sekolah[3]</td>
					<td><ol type=\"1\">
				";
				$querymp=mysql_query("SELECT mp.mata_pelajaran FROM paket_pelajaran as pp, mata_pelajaran as mp WHERE pp.id_pelajaran=mp.id_pelajaran AND pp.id_guru='$sekolah[0]' GROUP BY mp.id_pelajaran ORDER BY mp.mata_pelajaran ASC");;
				while($mp=mysql_fetch_array($querymp)){
					echo "<li>$mp[0]</li>
					";
				}
				echo "</ol>
					</td>
					<td>".ucwords($sekolah[5])."</td>
					<td>$sekolah[4]</td>
				</tr>
				";
				$no++;
			}
		?>
        </tbody>
    </table>
    <?php
		if($data!="semua"){
		$bulan=array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		$penanggung=mysql_fetch_array(mysql_query("SELECT g.nama, g.nip FROM guru as g, sekolah as se WHERE se.id_guru=g.id_guru AND se.id_sekolah='$data'"));
	?>
    <div class="row" style="margin-top:20px">
		<div class="col-md-3 col-sm-3">&nbsp;</div>
		<div class="col-md-5 col-sm-5">&nbsp;</div>
		<div class="col-md-4 col-sm-4">
			Banjarmasin,<?php echo "   ".$bulan[intval($date[1])] ." ". $date[0] ?><br />Penanggung Jawab,<br /><br /><br />
			<?php echo $penanggung[0] ."<br />NIP.". $penanggung[1] ?>
		</div>
	</div>
    <?php }?>
</div>
</body>
</html>
<?php }?>