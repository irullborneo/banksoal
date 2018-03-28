<?php
	include "../../include/koneksi.php";
	$id=$_GET['id'];
?>
<script type="text/javascript">
	$(document).ready(function(e) {
        $(".btn-hapusdata-soal").click(function(e) {
            var id=$(this).attr("id");
			id=id.split("-");
			$.ajax({
				type:"POST",
				url:"include/kirim.php?kirim=datasoal&aksi=hapussoal",
				data:"id="+id[2],
				success: function(response){
					if(response!=""){
						$("#status-hapusdata-soal").attr("class","alert alert-warning");
						$("#sg-hapusdata-soal").html("Gagal");
						$("#isi-hapusdata-soal").html(response);
						$("#status-hapusdata-soal").show("fade","",1000,hilanghapusppelajaran);
					}
					else{
						var baris=$("#banyak-baris-tampil").val();
			var kolom=$("#kolom-tampil").val();
			var urut=$("#naikturun-tampil").val();
			var pilihkolom=$("#pilih-kolom").val();
			var selectkolom=$("#select-pilih-kolom").val();
			var barisaktif= $("#aktif-soal-baris").html(); 
			var strselectkolom="";
			var strp="";
			if(pilihkolom!="semua"){
				strselectkolom="&selectkolom=" + selectkolom;
			}
			var lin="?baris=" + baris + "&kolom=" + kolom + "&urut=" + urut + "&pilihkolom=" + pilihkolom +""+ strselectkolom +"&barisaktif="+ barisaktif;
			$("#tabel-soal").load("include/tabel-soal.php" + lin);
			$("#tmpat-paging-tblsoal").load("include/paging-tabel-soal.php" + lin);
						$("#status-hapusdata-soal").attr("class","alert alert-success");
						$("#sg-hapusdata-soal").html("Sukses");
						$("#isi-hapusdata-soal").html("1 baris data dihapus");
						$("#status-hapusdata-soal").show("fade","",1000,hilanghapusppelajaran);
					}
				}
			});
        });
		function hilanghapusppelajaran(){
			setTimeout(function(){
				$("#status-hapusdata-soal").hide("fade","",1000);
			},10000);
		}
    });
</script>
<div class="modal fade" id="hapus-data-soal" role="dialog">
	<div class="modal-dialog">
	    <div class="modal-content">
	  	  <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Hapus Data Soal</h4>
          </div>
          <div class="modal-body">
          	<p>Hapus soal ini?</p>
          </div>
          <div class="modal-footer">
          	<button type="button" class="btn btn-danger btn-hapusdata-soal" id="hapusdata-soal-<?php echo $id;?>" data-dismiss="modal">Hapus</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
          </div>
		</div>
	</div>
</div>