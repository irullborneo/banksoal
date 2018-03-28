<?php
	include "../../include/koneksi.php";
	$id=$_GET['id'];
?>
<script type="text/javascript">
	$(document).ready(function(e) {
        $(".btn-hapusdata-listsoal").click(function(e) {
            var id=$(this).attr("id");
			id=id.split("-");
			$.ajax({
				type:"POST",
				url:"include/kirim.php?kirim=datasoal&aksi=hapusbarissoal",
				data:"id="+id[2],
				success: function(response){
					if(response==""){
						var id=$(".form-horizontal").attr("id");
		id=id.split("-");
		$("#list-soal").load("include/tampil-list-soal.php?idpelajaran="+ id[2]);
					}

				}
			});
        });

    });
</script>
<div class="modal fade" id="hapus-data-listsoal" role="dialog">
	<div class="modal-dialog">
	    <div class="modal-content">
	  	  <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Hapus</h4>
          </div>
          <div class="modal-body">
          	<p>Hapus soal ini?</p>
          </div>
          <div class="modal-footer">
          	<button type="button" class="btn btn-danger btn-hapusdata-listsoal" id="hapusdata-listsoal-<?php echo $id;?>" data-dismiss="modal">Hapus</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
          </div>
		</div>
	</div>
</div>