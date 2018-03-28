<script type="text/javascript">
$(document).ready(function(e) {
	$("#cari").attr("disabled","disabled");
    $(".paketpelajaran").mouseover(function(e) {
        var id=$(this).attr("id");
		id=id.split("-");
		$("#tmpat-lihatpaketpelajaran").load("include/aksi-lihatdata-paketpelajaran.php?id=" + id[1]);
    });
});
</script>
<?php
	$querycaritanggalpp=mysql_query("SELECT tgl_input FROM paket_pelajaran WHERE penginput='$admin[id_guru]' GROUP BY tgl_input ORDER BY tgl_input DESC");
	$caritanggalpp=mysql_fetch_array($querycaritanggalpp);
	$banyakdata=mysql_num_rows(mysql_query("SELECT * FROM paket_pelajaran WHERE penginput='$admin[id_guru]' AND tgl_input='$caritanggalpp[0]'"));
	$tglinputpp=explode("-",$caritanggalpp[0]);
	$bulan=array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
	$total=totalbadge("paket_pelajaran");
	if($total>0){
		$querytglppbadge=mysql_query("SELECT tgl_input FROM paket_pelajaran WHERE lihat='0000-00-00' GROUP BY tgl_input");
		echo "<div class=\"panel panel-success\" style=\"cursor:pointer\" data-toggle=\"modal\" data-target=\"#lihat-badge-paketpelajaran\" >
			<div class=\"panel-heading\">PEMBERITAHUAN</div>
   			<div class=\"panel-body\">$total data telah ditambahkan di Paket Pelajaran pada ";
		$koma=false;
		while($tglppbadge=mysql_fetch_array($querytglppbadge)){
			if($koma) echo ", ";
			$tglpp=explode("-",$tglppbadge[0]);
			echo $tglpp[2] ." ". $bulan[$tglpp[1]] ." ". $tglpp[0];
			$koma=true;
		}
		echo "</div>
		</div>
		<div class=\"modal fade\" id=\"lihat-badge-paketpelajaran\" role=\"dialog\">
			<div class=\"modal-dialog modal-lg\">
	    		<div class=\"modal-content\">
	  	  			<div class=\"modal-header\">
	          			<button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
	          			<h4 class=\"modal-title\">PEMBERITAHUAN</h4>
          			</div>
          			<div class=\"modal-body\">
					<div class=\"container-fluid\">
						
		";
		$querybadgetgl=mysql_query("SELECT tgl_input FROM paket_pelajaran WHERE lihat='0000-00-00' GROUP BY tgl_input");
		while($badgetgl=mysql_fetch_array($querybadgetgl)){
			$tglb=explode("-",$badgetgl[0]);
			echo "<h4 class=\"sub-header\">$tglb[2] ".$bulan[$tglb[1]] ." $tglb[0]</h4>";
			echo "<table class=\"table table-striped table-bordered\">
				<thead>
					<tr>
						<th>#</th>
						<th>PAKET</th>
						<th>MATA PELAJARAN</th>
						<th>GURU</th>
						<th>PENGINPUT</th>
						<th>KKM</th>
					</tr>
				</thead>
				<tbody>";
			$querybadge=mysql_query("SELECT pp.id_paket_pelajaran, p.paket, mp.mata_pelajaran, g.nama, pp.penginput, pp.kkm FROM paket_pelajaran as pp, paket as p, mata_pelajaran as mp, guru as g WHERE pp.id_paket=p.id_paket AND pp.id_pelajaran=mp.id_pelajaran AND pp.id_guru=g.id_guru AND pp.tgl_input='$badgetgl[0]' AND pp.lihat='0000-00-00' ORDER BY pp.id_paket_pelajaran ASC");
			while($badge=mysql_fetch_array($querybadge)){
				echo "<tr>
					<td>$badge[0]</td>
					<td>$badge[1]</td>
					<td>$badge[2]</td>
					<td>$badge[3]</td>
					<td>";
					$penginput=mysql_fetch_array(mysql_query("SELECT nama FROM guru WHERE id_guru=$badge[4]"));
					echo $penginput[0];
				echo "</td>
					<td>$badge[5]</td>
				</tr>";
			}
			echo "</tbody></table>";
		}
		echo "
					</div>
    	      		</div>
				</div>
			</div>
		</div>";
	}
	echo "<div class=\"panel panel-info\">
	<div class=\"panel-heading\">INFO</div>
    <div class=\"panel-body\">
	";
	if($banyakdata>0){ 
		echo "Anda telah menambahkan $banyakdata data terakhir kali pada ".$tglinputpp[2] ." ". $bulan[$tglinputpp[1]] ." ". $tglinputpp[0];
		
	}
	else {
		echo "Anda belum menambahkan data. ";
	}
	echo "
	</div>
</div>
	";
?>
<table class="table table-striped table-bordered">
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
					$id=mysql_fetch_array(mysql_query("SELECT * FROM paket_pelajaran WHERE id_paket=$paket1[id_paket] AND id_pelajaran=$paketpelajaran[0]"));
					$total=mysql_num_rows(mysql_query("SELECT * FROM paket_pelajaran WHERE id_paket=$paket1[id_paket] AND id_pelajaran=$paketpelajaran[0]"));
					if($total>=1){
						echo "<td class=\"label-primary paketpelajaran\" style=\"color:#fff; cursor:pointer\" id=\"paket-$id[id_paket_pelajaran]\" data-toggle=\"modal\" data-target=\"#form-lihat-data\">&nbsp;</td>";
					}
					else{
						echo "<td class=\"label-danger\">&nbsp;</td>";
					}
				}
				echo "
				</tr>
				";
				$no++;
			}
		?>
    </tbody>
</table>
<div id="tmpat-lihatpaketpelajaran"></div>