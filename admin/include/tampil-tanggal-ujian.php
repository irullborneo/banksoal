<?php
	include "../../include/koneksi.php";
	$id=$_GET['id'];
	$jadwal=mysql_fetch_array(mysql_query("SELECT tgl_awal, tgl_akhir FROM ujian_jadwal WHERE id_jadwal_ujian='$id'"));
	$tgl_awal=explode(" ",$jadwal['tgl_awal']);
	$tgl_akhir=explode(" ",$jadwal['tgl_akhir']);
	$tgl1=explode("-",$tgl_awal[0]);
	$tgl2=explode("-",$tgl_akhir[0]);
?>
<div class="form-group">
	<label for="tgl1ujian" class="control-label">Tanggal Ujian</label>
	<div class="form-inline container">
	   	<div class="form-group">
       		<select class="form-control" id="tglujian" name="tglujian">
        	<?php
			date_default_timezone_set("Asia/Makassar");
			$date=date("Y-n-d");
			$date=explode("-",$date);
      		for($i=$tgl1[2];$i<=$tgl2[2];$i++){
				echo "<option value='$i'>$i</option>";
			}
			?>
			</select>
		</div>

		<div class="form-group">
        	<select class="form-control" id="blnujian" name="blnujian">
            <?php
			$bulan=array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
            for($i=$tgl1[1];$i<=$tgl2[1];$i++){
            	$vbln=$tgl1[1]-1;
				echo "<option value=\"$tgl1[1]\">$bulan[$vbln]</option>";
            }
            ?>
            </select>
		</div>
        
		<div class="form-group">
			<select class="form-control" id="thnujian" name="thnujian">
			<?php
				for($i=$tgl1[0];$i<=$tgl2[0];$i++){
					echo "<option value='$i'>$i</option>";
				}
			?>
			</select>
		 </div>
	</div>
</div>