<?php
	$print=$_GET['print'];
	if($print=="yes"){
	include "../../include/koneksi.php";
	$data=$_GET['data'];
	$guru=mysql_fetch_array(mysql_query("SELECT * FROM guru WHERE id_guru='$data'"));
	
	$bulan=array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
	$hari=array("","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Aktivasi Tutor | Bank Soal Sistem Kolaborasi Kurkulum 2013</title>
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
	<div class="row" style="border-bottom:4px double #000; padding-bottom:10px; margin-bottom:20px;">
    	<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
        	<img src="../../img/icon.png" style="width:60px; height:60px" class="pull-left" />
            <span style="font-size:18px; font-weight:bold; margin-left:15px" class="pull-left">APLIKASI BANK SOAL KEJAR PAKET<br />KOLABORASI SISTEM KURIKULUM 2013 BERBASIS WEB
            </span>
            <div style="clear:both"></div>
        </div>
    </div>
    
    <div class="pull-left">
    Kepada Yth.<br />
    <?php echo $guru['nama'] ?><br />
    di <?php 
		$sekolah=mysql_fetch_array(mysql_query("SELECT nama_sekolah FROM sekolah WHERE id_sekolah='$guru[id_sekolah]'"));
		echo $sekolah[0];
	?>
    <br />Kota Banjarmasin - Kalimantan Selatan
    </div>
    
    <div class="pull-right">
    	<?php
			$tgl=date("Y-m-d-N");
			$tgl=explode("-",$tgl);
		?>
    	<table>
        	<tr>
            	<td style="padding-right:10px;">No. Surat</td>
                <td>. . ./. . ./<?php echo $tgl[0]?></td>
            </tr>
        	<tr>
            	<td >Tanggal</td>
                <td><?php echo $hari[$tgl[3]] .", ". $tgl[2] ." ". $bulan[intval($tgl[1])] ." ". $tgl[0] ?></td>
            </tr>
            <tr>
            	<td>Perihal</td>
                <td>Aktivasi akun tutor</td>
            </tr>
        </table>
    </div>
    <div class="clearfix" style="margin-bottom:40px;"></div>
    Dengan hormat,<br /><br />
    <p>Dengan diterbitkannya surat ini maka akun tutor telah dibuat dengan data tutor sebagai:</p>
    <table style="margin-left:20px;">
    	<tr>
        	<td style="padding-right:20px;">Nama</td>
            <td><?php echo $guru['nama'] ?></td>
        </tr>
        <tr>
        	<td>TTL</td>
            <td><?php echo $guru['tempat_lahir'] .", ";
			$tgl_lahir=explode("-",$guru['tanggal_lahir']);
			echo $tgl_lahir[2] ." ". $bulan[intval($tgl_lahir[1])] ." ". $tgl_lahir[0];
            ?></td>
        </tr>
        <tr>
        	<td>Alamat</td>
            <td><?php echo $guru['alamat'] ?></td>
        </tr>
    </table><br />
    <p>Untuk mengaktifkan akun anda silahkan masukkan kode aktivasi di halaman masuk akun tutor.</p>
    <div style="font-weight:bold; font-size:24px; margin:20px">
    Kode Aktivasi : <?php $kode=mysql_fetch_array(mysql_query("SELECT kode_aktivasi FROM guru_aktivasi WHERE id_guru='$data'"));
	echo $kode[0]
	?>
    </div>
    <p>Kami ucapkan Selamat dan Terima kasih telah berpartisipasi dalam Pengembangan Mutu Pendidikan Nasional. </p>
    <div class="pull-right text-left" style="margin-top:40px;">
    	Banjarmasin, <?php echo $tgl[2] ." ". $bulan[intval($tgl[1])] ." ". $tgl[0] ?><br />
        Admin,<br /><br /><br />
        <?php session_start();
			$queryadmin=mysql_query("SELECT * FROM guru WHERE id_guru='$_SESSION[id_admin]'");
			$admin=mysql_fetch_array($queryadmin);
			echo $admin['nama']."<br />NIP. ". $admin['nip'];
		?>
    </div>
</div>
</body>
</html>
<?php } ?>