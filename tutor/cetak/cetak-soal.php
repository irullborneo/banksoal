<?php
	$print=$_GET['print'];
	if($print=="yes"){
	include"../../include/koneksi.php";
	$data=explode("-",$_GET['data']);
		$id=$data[0];
		$banyak=$data[1];
		$kuncijawab=$data[2];
		
	$soalpelajaran=mysql_fetch_array(mysql_query("SELECT sp.id_soal_pelajaran, mp.mata_pelajaran, p.paket, sp.tgl_input FROM soal_pelajaran as sp, paket_pelajaran as pp, mata_pelajaran as mp, paket as p WHERE sp.id_paket_pelajaran=pp.id_paket_pelajaran AND pp.id_paket=p.id_paket AND pp.id_pelajaran=mp.id_pelajaran AND sp.id_soal_pelajaran='$id'"));
	$bulan=array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
	$hari=array("","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu");
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Soal <?php echo $soalpelajaran[1] ?>| Bank Soal Sistem Kolaborasi Kurkulum 2013</title>
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
	<div class="container">
    	<?php
			$strdate="";
			$date=date("Y-m-d");
			$date=explode("-",$date);
			if($date[1]<=6) $strdate=$date[0]-1 ."/".$date[0];
			else $strdate=$date[0] ."/". ($date[0] + 1);
		?>
    	<h3 class="text-center" style="border:5px double #000; padding:10px;0; border-radius:20px;">SOAL UJIAN<br />KEJAR PAKET KURIKULUM 2013<br />TAHUN PELAJARAN <?php echo $strdate?></h3>
        <div class="pull-left">
        <table>
        	<tr>
            	<td>MATA PELAJARAN </td>
                <td>:</td>
                <td><?php echo $soalpelajaran[1] ?></td>
            </tr>
            <tr>
            	<td>PAKET </td>
                <td style="padding-right:10px">:</td>
                <td><?php echo $soalpelajaran[2] ?></td>
            </tr>
        </table>
        </div>
        <div class="pull-right">
        <table>
        	<tr>
            	<td>TANGAL </td>
                <td style="padding-right:10px">:</td>
                <td>
				<?php
					 $h=date("N", strtotime($soalpelajaran[3]));
					 $tgl=date("d", strtotime($soalpelajaran[3]));
					 $bln=date("m", strtotime($soalpelajaran[3]));
					 $thn=date('Y', strtotime($soalpelajaran[3]));
					 echo $hari[$h].",<br />$tgl ". $bulan[intval($bln)] ." ". $thn;
				?>
                </td>
            </tr>
        </table>
        </div>
    </div>
    <hr />
    <?php
		$srtsoal="";
		$querysoal=mysql_query("SELECT id_soal_cerita, tipe_soal, soal, tipe_jawab, pilihan, jawab, id_soal_gambar, id_soal FROM soal WHERE id_soal_pelajaran='$soalpelajaran[0]' ORDER BY RAND(), id_soal_cerita ASC");
		while($soal=mysql_fetch_array($querysoal)){
			$t=true;
			$str=explode("-",$arr);
			for($i=0;$i<count($str);$i++){
				if($soal[7]==$str[$i]){
					$t=false;
				}
			}
			if($t){
				if($soal[0]>0){
					$querycerita=mysql_query("SELECT id_soal_cerita, tipe_soal, soal, tipe_jawab, pilihan, jawab, id_soal_gambar, id_soal FROM soal WHERE id_soal_pelajaran='$soalpelajaran[0]' AND id_soal_cerita='$soal[0]' ORDER BY id_soal ASC");
					$strip="-";
					$awal=false;
					$arr="";
					while($cerita=mysql_fetch_array($querycerita)){
						$srtsoal.="-$cerita[7] $cerita[0]";
						if($awal){
							$arr.=$strip ."". $cerita[7];
						}
						else{
							$arr.=$cerita[7];
						}
						$awal=true;
					}
				}
				else{
					$srtsoal.="-$soal[7] $soal[0]";
				}
			}
		}
		
		function tampilsoal($i, $j){
			$soal=mysql_fetch_array(mysql_query("SELECT tipe_soal, soal, tipe_jawab, pilihan, jawab, id_soal_gambar FROM soal WHERE id_soal='$i'"));
			if($soal['id_soal_gambar']>0){
				$gambar=mysql_fetch_array(mysql_query("SELECT soal_gambar FROM soal_gambar WHERE id_soal_gambar='$soal[id_soal_gambar]'"));
				echo "<div class=\"img\" style=\"margin:10px;0;5px;0\"><img src=\"../../$gambar[0]\" class=\"img img-thumbnail\" style=\"width:220px;\" /></div>";
			}
			echo "<li>$soal[soal]
			";
			if($soal['tipe_soal']=="ganda"){
				echo "<ol type=\"a\">";
				$pilihan=explode("|",$soal['pilihan']);
				if($soal['tipe_jawab']=="text"){
					for($s=0;$s<count($pilihan);$s++){
						$pilih=explode(">",$pilihan[$s]);
						echo "<li>$pilih[1]</li>";
					}
				}
				else{
					for($s=0;$s<count($pilihan);$s++){
						$pilih=explode(">",$pilihan[$s]);
						$gambar=mysql_fetch_array(mysql_query("SELECT soal_gambar FROM soal_gambar WHERE id_soal_gambar='$pilih[1]'"));
						echo "
						<li><img src=\"../../$gambar[0]\" class=\"img img-thumbnail\" style=\"width:100px;\" /></li>";
					}
				}
				echo "</ol>";
			}
			else{
				echo "<div style='margin-bottom:5px'>";
				$pilihan=explode("|",$soal['pilihan']);
				for($s=0;$s<count($pilihan);$s++){
					echo "<input type=\"checkbox\" id=\"pilih".$i."-$pilihan[$s]\" /> <label for=\"pilih".$i."-$pilihan[$s]\" style='margin-right:15px'>$pilihan[$s]</label>";
				}
				echo "</div>";
			}
			
			if($j=="jawab"){
				echo "<div style=\"font-weight:bold; margin-bottom:15px\">JAWABAN:
				";
				$jawab=explode("|",$soal['jawab']);
				$awal=false;
				for($s=0;$s<count($jawab);$s++){
					if($awal){
						echo ",";
					}
					echo " $jawab[$s]";
					$awal=true;
				}
				echo "
				</div>";
			}
			echo "
			</li>";
		}
		
		$srtsoal=explode("-",$srtsoal);
		$tr=true;
		$strcerita='';
		echo "<ol type=\"1\" style=\"margin-top:20px;\">";
		$hs="";
		for($i=1;$i<=$banyak;$i++){
			
			$idcerita=explode(" ",$srtsoal[$i]);
			if($hs!=$idcerita[1]){
				$tr=true;
			}
			if($idcerita[1]>0){
				if($tr){
					$cerita=mysql_fetch_array(mysql_query("SELECT soal_cerita FROM soal_cerita WHERE id_soal_cerita='$idcerita[1]'"));
					for($u=$i;$u<=$banyak;$u++){
						$awalcerita=$i;
						$ic=explode(" ",$srtsoal[$u]);
						if($ic[1]!=$idcerita[1] || $u==$banyak){
							if($u==$banyak){
								$akhircerita=$u;
							}else{
							$akhircerita=$u-1;
							}
							break;
						}
					}
					if($awalcerita==$akhircerita){
						echo "<div style=\"font-weight:bold; margin-top:20px;\">Pertanyaan untuk soal no. $awalcerita</div>";
					}
					else{
						echo "<div style=\"font-weight:bold; margin-top:20px;\">Pertanyaan untuk soal no. $awalcerita sampai $akhircerita</div>";
					}
					echo "
					<div style=\"margin:10px;0;5px;0\">$cerita[0]</div>";
					
					
						$tr=false;
					
					$hs=$idcerita[1];
				}
				tampilsoal($idcerita[0], $kuncijawab);
			}
			else{
				$tr=true;
				tampilsoal($idcerita[0], $kuncijawab);
			}
		}
		echo "</ol>";
	?>
</div>
</body>
</html>
<?php } ?>