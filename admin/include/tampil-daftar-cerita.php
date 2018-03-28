<?php
	include "../../include/koneksi.php";
?>
<script type="text/javascript">
$(document).ready(function(e) {
    $("#btn-edit-cerita").click(function(e) {
		$("#edit-cerita").load("include/tampil-edit-cerita.php?id=" + $("#aktif-cerita").html() );
    });
	
	$("#btn-hapus-cerita").click(function(e) {
		var id=$("#aktif-cerita").html();
		var datakirim={
			id:id
		};
		var r = confirm("Hapus Data?");
		if (r == true) {
		$.ajax({
			type:"POST",
			data:datakirim,
			url:"include/kirim.php?kirim=datasoal&aksi=hapuscerita",
			success: function(response){
				if(response!=""){
					$("#status-hapus-cerita").attr("class","alert alert-warning");
						$("#sg-hapus-cerita").html("Gagal");
						$("#isi-hapus-cerita").html(response);
						$("#status-hapus-cerita").show("fade","",1000,hilanghapus);
				}
				else{
					$("#status-hapus-cerita").attr("class","alert alert-success");
						$("#sg-hapus-cerita").html("Sukses");
						$("#isi-hapus-cerita").html("Cerita telah dihapus");
						//$("#form-tambahdata-paketpelajaran").trigger("reset");
						$("#daftar-cerita").load("include/tampil-daftar-cerita.php");
						$("#status-hapus-cerita").show("fade","",1000,hilangtambah);
				}
			}
		});
		}
		else{
		}
    });
	
	function hilanghapus(){
			setTimeout(function(){
				$("#status-hapus-cerita").hide("fade","",1000);
			},10000);
		}
		
	$(".well").click(function(e) {
        var id=$(this).attr("id");
		id=id.split("-");
		$("#aktif-cerita").html(id[1]);
		$(".well").removeAttr("style");
		$(".well").attr("style","font-size:10px; cursor:pointer;");
		$(this).attr("style","font-size:10px; cursor:pointer; box-shadow:0px 0px 10px #3F0");
		$("#btn-edit-cerita").removeAttr("disabled");
		$("#btn-hapus-cerita").removeAttr("disabled");
    });
});
</script>
<div  style="margin-top:10px;">
</div>
<div class="pull-right">
<button type="button" id="btn-hapus-cerita" class="btn btn-danger" disabled><span class="glyphicon glyphicon-remove-sign"></span> Hapus</button>
<button type="button" id="btn-edit-cerita" class="btn btn-primary" data-toggle="tab" href="#edit-cerita" disabled><span class="glyphicon glyphicon-edit"></span> Edit</button>
</div>
<div  style="clear:both">
</div>
<div class="row" style="margin-top:10px;">
<?php
	$querycerita=mysql_query("SELECT id_soal_cerita, awal_cerita FROM soal_cerita ORDER BY id_soal_cerita DESC");
	while($cerita=mysql_fetch_array($querycerita)){
		echo "<div class=\"col-lg-3 col-md-3 col-sm-4\">
			<div class=\"well\" id=\"cerita-$cerita[0]\" style=\"font-size:10px; cursor:pointer;\">
			$cerita[1]...
			</div>
		</div>";
	}
?>
</div>
<div id="status-hapus-cerita" style="display:none">
	<strong id="sg-hapus-cerita"></strong> : <span id="isi-hapus-cerita"></span> 
</div>
