<?php
	include "../../include/koneksi.php";
	$idhapuspelajaran=$_GET['id'];
?>
<script type="text/javascript">
	$(document).ready(function(e) {
        $(".btn-hapusdata-pelajaran").click(function(e) {
            var id=$(this).attr("id");
			id=id.split("-");
			$.ajax({
				type:"POST",
				url:"include/kirim.php?kirim=datapelajaran&aksi=hapus",
				data:"id="+id[2],
				success: function(response){
					if(response!=""){
						$("#status-hapusdata-pelajaran").attr("class","alert alert-warning");
						$("#sg-hapusdata-pelajaran").html("Gagal");
						$("#isi-hapusdata-pelajaran").html(response);
						$("#status-hapusdata-pelajaran").show("fade","",1000,hilanghapuspelajaran);
					}
					else{
						$("#tabel-matapelajaran").load("include/tabel-matapelajaran.php");
						$("#status-hapusdata-pelajaran").attr("class","alert alert-success");
						$("#sg-hapusdata-pelajaran").html("Sukses");
						$("#isi-hapusdata-pelajaran").html("1 baris data dihapus");
						$("#status-hapusdata-pelajaran").show("fade","",1000,hilanghapuspelajaran);
					}
				}
			});
        });
		function hilanghapuspelajaran(){
			setTimeout(function(){
				$("#status-hapusdata-pelajaran").hide("fade","",1000);
			},10000);
		}
    });
</script>
<div class="modal fade" id="hapus-data-pelajaran" role="dialog">
	<div class="modal-dialog">
	    <div class="modal-content">
	  	  <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Hapus Data Pelajaran</h4>
          </div>
          <div class="modal-body">
          	<p>Hapus data ini?</p>
          </div>
          <div class="modal-footer">
          	<button type="button" class="btn btn-danger btn-hapusdata-pelajaran" id="hapusdata-pelajaran-<?php echo $idhapuspelajaran;?>" data-dismiss="modal">Hapus</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
          </div>
		</div>
	</div>
</div>