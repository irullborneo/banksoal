<?php
	$print=$_GET['print'];
	if($print=="yes"){
	include"../../include/koneksi.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Formulir Data Siswa | Bank Soal Sistem Kolaborasi Kurkulum 2013</title>
<link rel="shortcut icon" href="../../img/icon.png" />
<link rel="stylesheet" type="text/css" href="../../css/bootstrap.css" />
<script type="text/javascript" src="../../jquery/jquery-2.0.2.js"></script>
<script type="text/javascript" src="../../jquery/bootstrap.js"></script>
</head>
<script type="text/javascript">
	print();
</script>
<body>
<div class="container visible-print" style="font-size:14pt; font-family:'Times New Roman', Times, serif">
	<h1 class="page-header text-center">Formulir Data Siswa</h1>
    <table border="0" style="line-height:40px;">
    	<tr>
        	<td>NAMA</td><td> : </td><td>&nbsp;</td>
        </tr>
        <tr>
        	<td>JENIS KELAMIN</td><td> :* </td><td>Laki-Laki / Perempuan</td>
        </tr>
        <tr>
        	<td>PAKET</td><td> :* </td><td>
            <?php
				$querypaket=mysql_query("SELECT * FROM paket ORDER BY id_paket");
				$slice=false;
				while($paket=mysql_fetch_array($querypaket)){
					if($slice) echo " / ";
					echo $paket['paket'];
					$slice=true;
				}
			?>
            </td>
        </tr>
        <tr>
        	<td>TEMPAT TANGGAL LAHIR</td><td> : </td><td>&nbsp;</td>
        </tr>
        <tr>
        	<td>ALAMAT</td><td> : </td><td>&nbsp;</td>
        </tr>
        <tr>
        	<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
        </tr>
        <tr>
        	<td>SEKOLAH</td><td> : </td><td>&nbsp;</td>
        </tr>
        <tr>
        	<td>PENDIDIKAN AKHIR</td><td> : </td><td>&nbsp;</td>
        </tr>
    </table>
    <br /><br /><br />
    <div class="info" style="border-bottom:1px solid #999">Catatan :</div>
    <div class="info" >* : Coret yang tidak perlu</div>
</div>
</body>
</html>


<?php
	}
?>
