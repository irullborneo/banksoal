<?php
	session_start();
	if(empty($_SESSION['untuk'])){
		header ("location: ./");
	}
	date_default_timezone_set("Asia/Singapore");
	include "include/koneksi.php";
	$soal=explode("-",$_SESSION['soal']);
	$waktu_akhir=date("H:i:s");
	$waktu_awal=$_SESSION['waktu'];
	$durasi_waktu=intval(strtotime($waktu_akhir)) - intval(strtotime($waktu_awal));
	$modday=($durasi_waktu%86400);
	$jam=intval(floor($modday/3600));
	$menit=intval(floor(($modday%3600)/60));
	$detik=($modday&60);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Nilai | Bank Soal Sistem Kolaborasi Kurkulum 2013</title>
<link rel="shortcut icon" href="img/icon.png" />
<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="css/style-nilai.css" />
<script type="text/javascript" src="jquery/jquery-2.0.2.js"></script>
<script type="text/javascript" src="jquery/bootstrap.js"></script>
</head>
<script type="text/javascript">
$(document).ready(function(e) {
    $("#btn-menu-utama").click(function(e) {
        window.location="./";
    });
	
	$(".btn-sp").click(function(e) {
        var id=$(this).attr("id");
		id=id.split("-");
			var datakirim={
				i:id[1]
			};
			$.ajax({
				type:"POST",
				data:datakirim,
				url:"include/tentukan-soal.php",
				success: function(response){
					window.location="./";
				}
				
			});
    });
});
</script>

<body>
<?php
	$benar=0;
	$salah=0;
	for($i=1;$i<count($soal);$i++){
		$s=mysql_fetch_array(mysql_query("SELECT * FROM soal WHERE id_soal='$soal[$i]'"));
		if($s['tipe_soal']=="ganda"){
			if($s['jawab']==$_SESSION['jawab-'.$i]){
				$benar++;
			}
			else{
				$salah++;
			}
		}
		else{
			$v=0;
			$jawab=explode("|",$_SESSION['jawab-'.$i]);
			$bj=explode("|",$s['jawab']);
			for($u=0;$u<count($bj);$u++){
				if(in_array($jawab[$u],$bj)){
					$v++;
				}
				
				
			}
			$b=($v/count($bj))*100;
			if($b>=$s['persen_benar']){
					$benar++;
				}
				else{
					$salah++;
				}
		}
	}
?>
	<div id="nilai-soal" align="center">
    	NILAI:
        <?php
			$nilai=number_format(($benar/(count($soal)-1))*100);
			if($nilai>=90) echo "<div id=\"score\" class=\"nilai-90\">$nilai</div>";
			else if($nilai>=80) echo "<div id=\"score\" class=\"nilai-80\">$nilai</div>";
			else if($nilai>=70) echo "<div id=\"score\" class=\"nilai-70\">$nilai</div>";
			else if($nilai>=60) echo "<div id=\"score\" class=\"nilai-60\">$nilai</div>";
			else if($nilai>=50) echo "<div id=\"score\" class=\"nilai-50\">$nilai</div>";
			else if($nilai>=40) echo "<div id=\"score\" class=\"nilai-40\">$nilai</div>";
			else if($nilai>=30) echo "<div id=\"score\" class=\"nilai-30\">$nilai</div>";
			else if($nilai>=20) echo "<div id=\"score\" class=\"nilai-20\">$nilai</div>";
			else echo "<div id=\"score\" class=\"nilai-lain\">$nilai</div>";
		?>
        
	</div>
    <div class="pemisah"></div>
    <div class="container" id="nilai">
    	<div class="well well-lg">
        	<div class="row">
            	<div class="col-lg-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                	<p>Soal: <?php echo (count($soal)-1)?></p>
                    <p>Benar: <?php echo $benar?></p>
                    <p>Salah: <?php echo $salah?></p>
                </div>
                <div class="col-lg-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                	<p>Durasi: 
                    <?php
						if($jam>0){
							echo $jam." Jam ";
						}
						if($menit>0){
							echo $menit." Menit ";
						}
						echo $detik." detik"; 
					?>
                    </p>
                    <p>Waktu Mulau: <?php echo $waktu_awal?></p>
                    <p>Waktu Selesai: <?php echo $waktu_akhir ?></p>
                </div>
            </div>
        </div>
    </div>
    <?php
		if($_SESSION['untuk']=="ujian"){
			mysql_query("INSERT INTO nilai(id_siswa, id_ujian, nilai) VALUES('$_SESSION[id_siswa]','$_SESSION[ujian]','$nilai')");
		}
		else{
	?>
    <div class="text-center" style="margin-top:40px;">
    	<?php
			$sp=mysql_fetch_array(mysql_query("SELECT id_soal_pelajaran FROM soal WHERE id_soal='$soal[1]'"));
        ?>
    	<button type="button" id="sp-<?php echo $sp[0] ?>" class="btn btn-primary btn-lg btn-sp">Coba Lagi</button>
        <button type="button" id="btn-menu-utama" class="btn btn-danger btn-lg">Menu Utama</button>
    </div>
    <?php
		}
	?>
</body>
</html>
<?php
	
	unset($_SESSION["waktu"]);
	unset($_SESSION["soal"]);
	unset($_SESSION['untuk']);
	for($i=0;$i<count($soal);$i++){
		unset($_SESSION["jawab-".$i]);
	}
	session_destroy();
?>