<?php
	$print=$_GET['print'];
	if($print=="yes"){
	include"../../include/koneksi.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tabel Paket | Bank Soal Sistem Kolaborasi Kurkulum 2013</title>
<link rel="shortcut icon" href="../../img/icon.png" />
<link rel="stylesheet" type="text/css" href="../../css/bootstrap.css" />
<script type="text/javascript" src="../../jquery/jquery-2.0.2.js"></script>
<script type="text/javascript" src="../../jquery/bootstrap.js"></script>
</head>
<script type="text/javascript">
	print();
</script>
<body>
<div class="container visible-print">
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
            	<th>#</th>
                <th>Paket</th>
           	</tr>
        </thead>
        <tbody>
        	<?php
				$querycetakpaket=mysql_query("SELECT * FROM paket");
				while($cetakpaket=mysql_fetch_array($querycetakpaket)){
					echo "<tr>
						<td>$cetakpaket[id_paket]</td>
						<td>$cetakpaket[paket]</td>
					</tr>";
				}
			?>
        </tbody>
    </table>
</div>
</body>
</html>


<?php
	}
?>
