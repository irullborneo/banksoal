<?php
	include "../../include/koneksi.php";
	$data=explode("-",$_GET['data']);
	$ujian=$data[0];
	$sekolah=$data[1];
	$mp=$data[2];
	
	$queryheadp=mysql_query("SELECT p.id_paket, p.paket FROM nilai as n, ujian as u, soal_pelajaran as sp, paket_pelajaran as pp, paket as p, sekolah as se, siswa as si WHERE n.id_ujian=u.id_ujian AND u.id_soal_pelajaran=sp.id_soal_pelajaran AND sp.id_paket_pelajaran=pp.id_paket_pelajaran AND pp.id_paket=p.id_paket AND se.id_sekolah='$sekolah' AND si.id_paket=p.id_paket AND si.id_siswa=n.id_siswa AND pp.id_pelajaran='$mp' AND u.id_jadwal_ujian='$ujian' GROUP BY p.id_paket ORDER BY p.id_paket ASC");
?>
<script type="text/javascript">
$(document).ready(function(e) {
    $(".btn-cetak-nilaini").click(function(e) {
        var data=$(this).attr("id");
		data=data.split("-");
		var u=data[1];
		var s=data[2];
		var mp=data[3];
		var p=$("#paket-cetak").val();
		var datakirim=u +"-"+ s +"-"+ mp +"-"+ p;
		window.open("./cetak/cetak-nilai-matapelajaran.php?print=yes&data="+ datakirim);
		return false;
    });
});
</script>
<div class="modal fade" id="cetak-nilai" role="dialog">
	<div class="modal-dialog">
	    <div class="modal-content">
	  	  <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Cetak Data</h4>
          </div>
          <div class="modal-body">
          	<div class="container-fluid">
            	<form class="form-horizontal" id="form-cetak-nilai" role="form">
                	<div class="form-group">
                    	<label for="paket-cetak" class="control-label">Paket</label>
                        <select id="paket-cetak" name="paket-cetak" class="form-control">
                        	<option value="semua">Semua</option>
                            <?php
								while($paket=mysql_fetch_array($queryheadp)){
									echo "<option value=\"$paket[0]\">Paket $paket[1]</option>";
								}
							?>
                        </select>
                    </div>
                </form>
            </div>
          </div>
          <div class="modal-footer">
          	<a href="#" target="_blank" class="btn btn-primary btn-cetak-nilaini" id="cetak-<?php echo $_GET['data'] ?>">Cetak</a>
          </div>
		</div>
	</div>
</div>