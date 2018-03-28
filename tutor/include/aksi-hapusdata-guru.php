<?php
	include "../../include/koneksi.php";
	$id=$_GET['id'];
?>

<script type="text/javascript">
	$(document).ready(function(e) {
        $(".btn-hapusdata-guru").click(function(e) {
            var id=$(this).attr("id");
			id=id.split("-");
			$.ajax({
				type:"POST",
				url:"include/kirim.php?kirim=dataguru&aksi=hapus",
				data:"id="+id[1],
				success: function(response){
					if(response!=""){
						$("#status-hapusdata-guru").attr("class","alert alert-warning");
						$("#sg-hapusdata-guru").html("Gagal");
						$("#isi-hapusdata-guru").html(response);
						$("#status-hapusdata-guru").show("fade","",1000,hilanghapusppelajaran);
					}
					else{
						var baris=$("#banyak-baris-tampil").val();
						var kolom=$("#kolom-tampil").val();	
						var urut=$("#naikturun-tampil").val();
						var pilihkolom=$("#kolom-guru").val();
						var selectkolom=$("#select-pilih-guru").val();
						var strselectkolom="";
						var strp="";
						var cari="";
						if(pilihkolom!="semua"){
							strselectkolom="&selectkolom=" + selectkolom;
						}
						if($("#cari").val()!=""){
							cari="&cari=" + $("#cari").val();
						}
						var lin="?baris=" + baris + "&kolom=" + kolom + "&urut=" + urut + "&pilihkolom=" + pilihkolom +""+ strselectkolom +""+ cari;
						$("#tabel-guru").load("include/tabel-guru.php" + lin);
						$("#tmpat-paging-tblguru").load("include/paging-tabel-guru.php" + lin);
						
						$("#status-hapusdata-guru").attr("class","alert alert-success");
						$("#sg-hapusdata-guru").html("Sukses");
						$("#isi-hapusdata-guru").html("1 baris data dihapus");
						$("#status-hapusdata-guru").show("fade","",1000,hilanghapusguru);
					}
				}
			});
        });
		
		function hilanghapusguru(){
			setTimeout(function(){
				$("#status-hapusdata-guru").hide("fade","",1000);
			},10000);
		}
    });
</script>
<div class="modal fade" id="form-hapus-guru" role="dialog">
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
          	<button type="button" class="btn btn-danger btn-hapusdata-guru" id="guru-<?php echo $id;?>" data-dismiss="modal">Hapus</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
          </div>
		</div>
	</div>
</div>