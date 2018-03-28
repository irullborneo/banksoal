<?php
	include "../../include/koneksi.php";
	$idhapussiswa=$_GET['id'];
?>
<script type="text/javascript">
	$(document).ready(function(e) {
       	$(".btn-hapusdata-siswa").on("click",function(e){
			var id=$(this).attr("id");
			id=id.split("-");
			$.ajax({
				type:"POST",
				url:"include/kirim.php?kirim=datasiswa&aksi=hapus",
				data:"id="+id[1],
				success: function(response){
					if(response!=""){
						$("#status-hapusdata-siswa").attr("class","alert alert-warning");
						$("#sg-hapusdata-siswa").html("Gagal");
						$("#isi-hapusdata-siswa").html(response);
						$("#status-hapusdata-siswa").show("fade","",1000,hilanghapus);
					}
					else{
						$("#cari").val("");
						$("#table-siswa").load("include/tabel-siswa.php?baris=" + $("#banyak-baris-tampil").val() + "&kolom=" + $("#kolom-tampil").val() + "&urut=" + $("#naikturun-tampil").val() + "&paket=" + $("#paket-tampil").val() + "&p=1");
						$("#tmpat-paging-tblsiswa").load("include/paging-tabel-siswa.php?p=1&baris=" + $("#banyak-baris-tampil").val() + "&paket=" + $("#paket-tampil").val());
						$("#status-hapusdata-siswa").attr("class","alert alert-success");
						$("#sg-hapusdata-siswa").html("Sukses");
						$("#isi-hapusdata-siswa").html("1 baris data dihapus");
						$("#status-hapusdata-siswa").show("fade","",1000,hilanghapus);
					}
				}
			});
		});
		function hilanghapus(){
			setTimeout(function(){
				$("#status-hapusdata-siswa").hide("fade","",1000);
			},10000);
		}
    });
</script>
<div class="modal fade" id="hapus-data" role="dialog">
	<div class="modal-dialog">
	    <div class="modal-content">
	  	  <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Hapus Data Siswa</h4>
          </div>
          <div class="modal-body">
          	<p>Hapus data ini?</p>
          </div>
          <div class="modal-footer">
          	<button type="button" class="btn btn-danger btn-hapusdata-siswa" id="hapusdata-<?php echo $idhapussiswa;?>" data-dismiss="modal">Hapus</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
          </div>
		</div>
	</div>
</div>