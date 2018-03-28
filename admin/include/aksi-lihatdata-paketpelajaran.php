<?php
	include "../../include/koneksi.php";
	$idlihat=$_GET['id'];
	$queryid=mysql_query("SELECT * FROM paket_pelajaran WHERE id_paket_pelajaran=$idlihat");
	$idpp=mysql_fetch_array($queryid);
?>
<div class="modal fade" id="form-lihat-data" role="dialog">
	<div class="modal-dialog">
	    <div class="modal-content">
	  	  <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Lihat Data Paket Pelajaran</h4>
          </div>
          <div class="modal-body">
			<div class="container-fluid">
            	<?php
					$querybanyakguru=mysql_query("SELECT pp.id_guru, g.nama, pp.id_paket_pelajaran FROM paket_pelajaran as pp, guru as g WHERE pp.id_paket=$idpp[id_paket] AND pp.id_pelajaran=$idpp[id_pelajaran] AND pp.id_guru=g.id_guru GROUP BY pp.id_guru");
					while($banyakguru=mysql_fetch_array($querybanyakguru)){
						echo "<h4 class=\"sub-header\">$banyakguru[1]</h4>
							<table class=\"table table-striped\">
								<thead>
									<tr>
										<th>NO</th>
										<th>PAKET</th>
										<th>MATA PELAJARAN</th>
										<th>KKM</th>
									</tr>
								</thead>
								<tbody>
						";
						$no=1;
						$querybanyakpp=mysql_query("SELECT p.paket, mp.mata_pelajaran, pp.kkm FROM paket_pelajaran as pp, paket as p, mata_pelajaran as mp WHERE pp.id_guru='$banyakguru[0]' AND pp.id_paket=p.id_paket AND pp.id_pelajaran=mp.id_pelajaran AND pp.id_paket_pelajaran='$banyakguru[2]'");
						while($banyakpp=mysql_fetch_array($querybanyakpp)){
							echo "<tr>
								<td>$no</td>
								<td>$banyakpp[0]</td>
								<td>$banyakpp[1]</td>
								<td>$banyakpp[2]</td>
							</tr>";
							$no++;
						}
						echo "</tbody></table><br />";
					}
				?>
			</div>
          </div>
		</div>
	</div>
</div>