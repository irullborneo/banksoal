<?php
	$print=$_GET['print'];
	if($print=="yes"){
	include"../../include/koneksi.php";
	session_start();
	$queryadmin=mysql_query("SELECT * FROM guru WHERE id_guru='$_SESSION[id_admin]'");
	$admin=mysql_fetch_array($queryadmin);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tabel Paket Pelajaran | Bank Soal Sistem Kolaborasi Kurkulum 2013</title>
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
		
		echo "<h2 class='page-header text-center'>Data Paket Kurikulum 2013<br />Tahun Pelajaran $str</h2>";
	?>
    <table class="table table-bordered" style="font-size:10pt">
    	<thead>
        	<tr>
            	<th>No</th>
                <th>Mata Pelajaran</th>
                <?php
					$querypaket=mysql_query("SELECT paket FROM paket");
					while($paket=mysql_fetch_array($querypaket)){
						echo "<th>Paket<br />$paket[paket]</th>";
					}
				?>
           	</tr>
            
        </thead>
        <tbody>
        	<?php
				$no=1;
				$querypaketpelajaran=mysql_query("SELECT id_pelajaran, mata_pelajaran FROM mata_pelajaran ORDER BY id_pelajaran ASC");
				while($paketpelajaran=mysql_fetch_array($querypaketpelajaran)){
					echo "<tr>
						<td>$no</td>
						<td style=\"font-weight:bold\">$paketpelajaran[1]</td>
					";
					$querypaket1=mysql_query("SELECT * FROM paket");
					while($paket1=mysql_fetch_array($querypaket1)){
						$id=mysql_fetch_array(mysql_query("SELECT g.id_guru FROM paket_pelajaran as pp, guru as g WHERE pp.id_paket=$paket1[id_paket] AND pp.id_pelajaran=$paketpelajaran[0] AND pp.id_guru=g.id_guru AND g.id_sekolah='$admin[id_sekolah]'"));
						$total=mysql_num_rows(mysql_query("SELECT * FROM paket_pelajaran as pp, guru as g WHERE pp.id_paket=$paket1[id_paket] AND pp.id_pelajaran=$paketpelajaran[0] AND pp.id_guru=g.id_guru AND g.id_sekolah='$admin[id_sekolah]'"));
						if($total>=1){
							echo "<td class=\"label-primary paketpelajaran\" style=\"color:#fff; cursor:pointer\" id=\"paket-$id[id_paket_pelajaran]\" data-toggle=\"modal\" data-target=\"#form-lihat-data\">";
						if($total>1){
							$querybanyakid=mysql_query("SELECT g.id_guru FROM paket_pelajaran as pp, guru as g WHERE pp.id_paket=$paket1[id_paket] AND pp.id_pelajaran=$paketpelajaran[0] AND pp.id_guru=g.id_guru AND g.id_sekolah='$admin[id_sekolah]'");
							while($banyakid=mysql_fetch_array($querybanyakid)){
								echo "$banyakid[0] ";
							}
						}
						else{
								echo "$id[0] ";
						}
						echo "
						</td>";
						}
						else{
							echo "<td class=\"label-danger\">-</td>";
						}
					}
					echo "
					</tr>
					";
					$no++;
				}
			?>
        </tbody>
    </table><br /><br />
	
    <?php
		echo "
				<table class=\"table table-bordered\" style=\"font-size:10pt\">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>Mata Pelajaran</th>
							<th>KKM</th>
						</tr>
					</thead>
					<tbody>
				";
				$querypaketdetail=mysql_query("SELECT g.id_guru, g.nama, mp.mata_pelajaran, pp.kkm FROM paket_pelajaran as pp, guru as g, mata_pelajaran as mp WHERE pp.id_guru=g.id_guru AND pp.id_pelajaran=mp.id_pelajaran AND g.id_sekolah='$admin[id_sekolah]' ORDER BY g.id_guru ASC");
				while($paketdetail=mysql_fetch_array($querypaketdetail)){
					echo "<tr>
						<td>$paketdetail[0]</td>
						<td>$paketdetail[1]</td>
						<td>$paketdetail[2]</td>
						<td>$paketdetail[3]</td>
					</tr>
					";
					$no++;
				}
				echo "
					</tbody>
				</table>
			";

?>
</div>
</body>
</html>


<?php
	}
?>
