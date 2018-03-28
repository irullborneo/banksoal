<?php
	include "../../include/koneksi.php";
	$id=$_GET['id'];
?>
<script type="text/javascript">
	$(document).ready(function(e) {
        $(".btn-hapusdata-paketpelajaran").click(function(e) {
            var id=$(this).attr("id");
			id=id.split("-");
			$.ajax({
				type:"POST",
				url:"include/kirim.php?kirim=datapaketpelajaran&aksi=hapus",
				data:"id="+id[2],
				success: function(response){
					if(response!=""){
						$("#status-hapusdata-paketpelajaran").attr("class","alert alert-warning");
						$("#sg-hapusdata-paketpelajaran").html("Gagal");
						$("#isi-hapusdata-paketpelajaran").html(response);
						$("#status-hapusdata-paketpelajaran").show("fade","",1000,hilanghapusppelajaran);
					}
					else{
						var baris=$("#banyak-baris-tampil").val();
					var kolom=$("#kolom-tampil").val();
					var urut=$("#naikturun-tampil").val();
					var pilihkolom=$("#pilih-kolom").val();
					var selectkolom=$("#select-pilih-kolom").val();
					var strselectkolom="";
					var strp="";
					if(pilihkolom!="semua"){
						strselectkolom="&selectkolom=" + selectkolom;
					}
					var lin="?baris=" + baris + "&kolom=" + kolom + "&urut=" + urut + "&pilihkolom=" + pilihkolom +""+ strselectkolom;
					$("#tabel-paketpelajaran").load("include/tabel-paketpelajaran.php" + lin);
					$("#tmpat-paging-tblpaketpelajaran").load("include/paging-tabel-paketpelajaran.php" + lin);
						$("#status-hapusdata-paketpelajaran").attr("class","alert alert-success");
						$("#sg-hapusdata-paketpelajaran").html("Sukses");
						$("#isi-hapusdata-paketpelajaran").html("1 baris data dihapus");
						$("#status-hapusdata-paketpelajaran").show("fade","",1000,hilanghapusppelajaran);
					}
				}
			});
        });
		function hilanghapusppelajaran(){
			setTimeout(function(){
				$("#status-hapusdata-paketpelajaran").hide("fade","",1000);
			},10000);
		}
    });
</script>
<div class="modal fade" id="hapus-data-paketpelajaran" role="dialog">
	<div class="modal-dialog">
	    <div class="modal-content">
	  	  <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Hapus Data Paket Pelajaran</h4>
          </div>
          <div class="modal-body">
          	<p>Hapus data ini?</p>
          </div>
          <div class="modal-footer">
          	<button type="button" class="btn btn-danger btn-hapusdata-paketpelajaran" id="hapusdata-paketpelajaran-<?php echo $id;?>" data-dismiss="modal">Hapus</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
          </div>
		</div>
	</div>
</div>