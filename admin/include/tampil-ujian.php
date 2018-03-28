<?php
	include "../../include/koneksi.php";
	$id=$_GET['id'];
	$ujian=mysql_fetch_array(mysql_query("SELECT u.id_ujian, u.banyak_soal, u.waktu, u.jadwal_ujian, p.paket, mp.mata_pelajaran, u.id_jadwal_ujian from ujian as u, soal_pelajaran as sp, paket_pelajaran as pp, mata_pelajaran as mp, paket as p WHERE u.id_soal_pelajaran=sp.id_soal_pelajaran AND sp.id_paket_pelajaran=pp.id_paket_pelajaran AND pp.id_paket=p.id_paket AND pp.id_pelajaran=mp.id_pelajaran AND u.id_ujian='$id'"));
	$tgl=explode(" ",$ujian[3]);
	$tanggal=explode("-",$tgl[0]);
	$waktu=explode(":",$tgl[1]);
	$selesai=mktime(intval($waktu[0]), intval($waktu[1])+$ujian[2], intval($waktu[2]), $tanggal[1], $tanggal[2], $tanggal[0]);
?>
<script type="text/javascript">
$(document).ready(function(e) {
    $(".btn-hapusdata-ujian").click(function(e) {
        var id=$(this).attr("id");
		id=id.split("-");
		datakirim={
			idujian:id[2]
		}
		$.ajax({
			type:"POST",
			data:datakirim,
			url:"include/kirim.php?kirim=ujian&aksi=hapus",
			success: function(response){
				if(response!=""){
				}
				else{
					$("#tempat-kalender-ujian").load("include/tampil-kalender-ujian.php");
					$("#tempat-lihat-ujian").empty();
				}
			}
		});
    });
});
</script>
<h3 class="sub-header">Ujian <?php 
	$u=mysql_fetch_array(mysql_query("SELECT jadwal_ujian FROM ujian_jadwal WHERE id_jadwal_ujian='$ujian[6]'"));
	echo $u['jadwal_ujian'];
?></h3>
<p>PAKET <?php echo $ujian[4] ?></p>
<p>Mata Pelajaran <?php echo $ujian[5] ?></p>
<p>Jam <?php echo $waktu[0] .":". $waktu[1] ." - ". date("H:i",$selesai)?></p>
<p>Durasi <?php echo $ujian[2] ." Menit"?></p>
<p>Jumlah Soal yang diujikan ada  <?php echo $ujian[1] ." Soal"?></p>
<div class="pull-right">
<button type="button" class="btn btn-danger" id="btn-hapus-ujian" data-toggle="modal" data-target="#hapus-data-ujian">Hapus</button>
</div>

<div class="modal fade" id="hapus-data-ujian" role="dialog">
	<div class="modal-dialog">
	    <div class="modal-content">
	  	  <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Hapus Ujian</h4>
          </div>
          <div class="modal-body">
          	<p>Hapus ujian ini?</p>
          </div>
          <div class="modal-footer">
          	<button type="button" class="btn btn-danger btn-hapusdata-ujian" id="hapusdata-ujian-<?php echo $id;?>" data-dismiss="modal">Hapus</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
          </div>
		</div>
	</div>
</div>
