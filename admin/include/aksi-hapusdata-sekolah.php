<?php
	include "../../include/koneksi.php";
	$id=$_GET['id'];
?>
<script type="text/javascript">
	$(document).ready(function(e) {
        $(".btn-hapusdata-sekolah").click(function(e) {
            var id=$(this).attr("id");
			id=id.split("-");
			$.ajax({
				type:"POST",
				url:"include/kirim.php?kirim=datasekolah&aksi=hapus",
				data:"id="+id[2],
				success: function(response){
					if(response!=""){
						$("#status-hapusdata-sekolah").attr("class","alert alert-warning");
						$("#sg-hapusdata-sekolah").html("Gagal");
						$("#isi-hapusdata-sekolah").html(response);
						$("#status-hapusdata-sekolah").show("fade","",1000,hilanghapusppelajaran);
					}
					else{
						$("#tabel-sekolah").load("include/tabel-sekolah.php");
						$("#tmpat-paging-sekolah").load("include/paging-tabel-sekolah.php");
						$("#status-hapusdata-sekolah").attr("class","alert alert-success");
						$("#sg-hapusdata-sekolah").html("Sukses");
						$("#isi-hapusdata-sekolah").html("1 baris data dihapus");
						$("#status-hapusdata-sekolah").show("fade","",1000,hilanghapusppelajaran);
					}
				}
			});
        });
		function hilanghapusppelajaran(){
			setTimeout(function(){
				$("#status-hapusdata-sekolah").hide("fade","",1000);
			},10000);
		}
    });
</script>
<div class="modal fade" id="hapus-data-sekolah" role="dialog">
	<div class="modal-dialog">
	    <div class="modal-content">
	  	  <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Hapus Data Sekolah</h4>
          </div>
          <div class="modal-body">
          	<p>Hapus data ini?</p>
          </div>
          <div class="modal-footer">
          	<button type="button" class="btn btn-danger btn-hapusdata-sekolah" id="hapusdata-sekolah-<?php echo $id;?>" data-dismiss="modal">Hapus</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
          </div>
		</div>
	</div>
</div>