<?php
	include "../../include/koneksi.php";
	$id=$_GET['id'];
?>
<script type="text/javascript">
	$(document).ready(function(e) {
        $(".btn-hapusdata-jadwal").click(function(e) {
            var id=$(this).attr("id");
			id=id.split("-");
			$.ajax({
				type:"POST",
				url:"include/kirim.php?kirim=ujian&aksi=hapusjadwal",
				data:"id="+id[2],
				success: function(response){
					if(response!=""){
						$("#status-hapusdata-jadwal").attr("class","alert alert-warning");
						$("#sg-hapusdata-jadwal").html("Gagal");
						$("#isi-hapusdata-jadwal").html(response);
						$("#status-hapusdata-jadwal").show("fade","",1000,hilanghapusppelajaran);
					}
					else{
						$("#tempat-kalender-ujian").load("include/tampil-kalender-ujian.php");
						$("#tabel-ujian").load("include/tabel-ujian.php");
						$("#tmpat-paging-jadwal").load("include/paging-tabel-ujian.php");
						$("#status-hapusdata-jadwal").attr("class","alert alert-success");
						$("#sg-hapusdata-jadwal").html("Sukses");
						$("#isi-hapusdata-jadwal").html("1 baris data dihapus");
						$("#status-hapusdata-jadwal").show("fade","",1000,hilanghapusppelajaran);
					}
				}
			});
        });
		function hilanghapusppelajaran(){
			setTimeout(function(){
				$("#status-hapusdata-jadwal").hide("fade","",1000);
			},10000);
		}
    });
</script>
<div class="modal fade" id="hapus-data-jadwal" role="dialog">
	<div class="modal-dialog">
	    <div class="modal-content">
	  	  <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Hapus Data Jadwal Ujian</h4>
          </div>
          <div class="modal-body">
          	<p>Hapus data ini?</p>
          </div>
          <div class="modal-footer">
          	<button type="button" class="btn btn-danger btn-hapusdata-jadwal" id="hapusdata-jadwal-<?php echo $id;?>" data-dismiss="modal">Hapus</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
          </div>
		</div>
	</div>
</div>