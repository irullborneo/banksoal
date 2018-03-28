<?php
	include "../../include/koneksi.php";
	$idlihat=$_GET['id'];
?>
<div class="modal fade" id="lihat-data-paketpelajaran" role="dialog">
	<div class="modal-dialog modal-lg">
	    <div class="modal-content">
	  	  <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Lihat Data Paket Pelajaran</h4>
          </div>
          <div class="modal-body">
			<div class="container-fluid">
            	<table class="table table-striped">
            	<?php
					$menulihat=array('#','PAKET','MATA PELAJARAN','GURU','KKM','PENGINPUT','TANGGAL INPUT');
					$lihatpp=mysql_fetch_array(mysql_query("SELECT pp.id_paket_pelajaran, p.paket, mp.mata_pelajaran, g.nama, pp.kkm, pp.penginput, pp.tgl_input FROM paket_pelajaran as pp, paket as p, guru as g, mata_pelajaran as mp WHERE pp.id_paket=p.id_paket AND pp.id_pelajaran=mp.id_pelajaran AND pp.id_guru=g.id_guru AND pp.id_paket_pelajaran=$idlihat"));
					for($i=0;$i<count($menulihat);$i++){
						echo "<tr>
							<td>$menulihat[$i]</td>
						";
						if($i==5){
							$penginput=mysql_fetch_array(mysql_query("SELECT nama FROM guru WHERE id_guru=$lihatpp[$i]"));
							echo "<td>$penginput[0]</td>";
						}
						else if($i==6){
							$bulan=array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
							$tgl=explode("-",$lihatpp[$i]);
							echo "<td>".$tgl[2] ." ". $bulan[$tgl[1]] ." ". $tgl[0]."</td>";
						}
						else echo "<td>$lihatpp[$i]</td>";
						echo "
							
						</tr>";
					}
				?>
			</div>
          </div>
		</div>
	</div>
</div>