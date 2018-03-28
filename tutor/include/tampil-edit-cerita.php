<?php
	include "../../include/koneksi.php";
	$id=$_GET['id'];
	$cerita=mysql_fetch_array(mysql_query("SELECT soal_cerita FROM soal_cerita WHERE id_soal_cerita=$id"));
?>
<script type="text/javascript">
	CKEDITOR.replace( 'editor2' );
$(document).ready(function(e) {
    $(".edit-cerita").click(function(e) {
        var val=CKEDITOR.instances.editor2.getData();
		var id=$(this).attr("id");
		id=id.split("-");
		var datakirim={
			cerita:val,
			id:id[2]
		};
		$.ajax({
			type:"POST",
			data:datakirim,
			url:"include/kirim.php?kirim=datasoal&aksi=editcerita",
			success: function(response){
				if(response!=""){
						$("#status-edit-cerita").attr("class","alert alert-warning");
						$("#sg-edit-cerita").html("Gagal");
						$("#isi-edit-cerita").html(response);
						$("#status-edit-cerita").show("fade","",1000,hilangedit);
				}
				else{
					$("#status-edit-cerita").attr("class","alert alert-success");
						$("#sg-edit-cerita").html("Sukses");
						$("#isi-edit-cerita").html("Cerita telah diedit");
						//$("#form-tambahdata-paketpelajaran").trigger("reset");
						$("#daftar-cerita").load("include/tampil-daftar-cerita.php");
						$("#status-edit-cerita").show("fade","",1000,hilangedit);
				}
			}
		});
    });
	function hilangedit(){
			setTimeout(function(){
				$("#status-edit-cerita").hide("fade","",1000);
			},10000);
		}
});
</script>
<h3 class="sub-header">Edit Cerita</h3>
<form id="tambah-cerita">
	<textarea id="editor2" rows="20" class="col-sm-12">
    	<?php echo $cerita[0] ?>
    </textarea>
</form>
<br /><br />
<button type="button" id="edit-cerita-<?php echo $id ?>" class="btn btn-success edit-cerita">Edit</button>
<button type="button" id="kembali-cerita" data-toggle="tab" href="#daftar-cerita" class="btn btn-danger">Kembali</button>
<br /><br />
<div id="status-edit-cerita" style="display:none">
	<strong id="sg-edit-cerita"></strong> : <span id="isi-edit-cerita"></span> 
</div>
