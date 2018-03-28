<?php
	include "../../include/koneksi.php";
	$idhapuspaket=$_GET['id'];
?>
<script type="text/javascript">
	$(document).ready(function(e) {
        $(".btn-hapusdata-paket").click(function(e) {
            var id=$(this).attr("id");
			id=id.split("-");
			$.ajax({
				type:"POST",
				url:"include/kirim.php?kirim=datapaket&aksi=hapus",
				data:"id="+id[1],
				success: function(response){
					if(response!=""){
						$("#status-hapusdata-paket").attr("class","alert alert-warning");
						$("#sg-hapusdata-paket").html("Gagal");
						$("#isi-hapusdata-paket").html(response);
						$("#status-hapusdata-paket").show("fade","",1000,hilanghapuspaket);
					}
					else{
						$("#tabel-paket").load("include/tabel-paket.php");
						$("#status-hapusdata-paket").attr("class","alert alert-success");
						$("#sg-hapusdata-paket").html("Sukses");
						$("#isi-hapusdata-paket").html("1 baris data dihapus");
						$("#status-hapusdata-paket").show("fade","",1000,hilanghapuspaket);
					}
				}
			});
        });
		function hilanghapuspaket(){
			setTimeout(function(){
				$("#status-hapusdata-paket").hide("fade","",1000);
			},10000);
		}
    });
</script>
<div class="modal fade" id="hapus-data" role="dialog">
	<div class="modal-dialog">
	    <div class="modal-content">
	  	  <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Hapus Data Paket</h4>
          </div>
          <div class="modal-body">
          	<p>Hapus data ini?</p>
          </div>
          <div class="modal-footer">
          	<button type="button" class="btn btn-danger btn-hapusdata-paket" id="hapusdata-<?php echo $idhapuspaket;?>" data-dismiss="modal">Hapus</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
          </div>
		</div>
	</div>
</div>