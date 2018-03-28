<?php
	include "../../include/koneksi.php";
?>
<script type="text/javascript">
$(document).ready(function(e) {
	$("#btn-hapus-gambar").click(function(e) {
		var id=$("#aktif-gambar").html();
		var datakirim={
			id:id
		};
		var r = confirm("Hapus Data?");
		if (r == true) {
		$.ajax({
			type:"POST",
			data:datakirim,
			url:"include/kirim.php?kirim=datasoal&aksi=hapusgambar",
			success: function(response){
				if(response!=""){
					$("#status-hapus-gambar").attr("class","alert alert-warning");
						$("#sg-hapus-gambar").html("Gagal");
						$("#isi-hapus-gambar").html(response);
						$("#status-hapus-gambar").show("fade","",1000,hilanghapusgambar);
				}
				else{
					$("#status-hapus-gambar").attr("class","alert alert-success");
						$("#sg-hapus-gambar").html("Sukses");
						$("#isi-hapus-gambar").html("Gambar telah dihapus");
						//$("#form-tambahdata-paketpelajaran").trigger("reset");
						$("#daftar-gambar").load("include/tampil-daftar-gambar.php");
						$("#status-hapus-gambar").show("fade","",1000,hilanghapusgambar);
				}
			}
		});
		}
		else{
		}
    });
	
	$(".daftar-gambar").click(function(e) {
        var id=$(this).attr("id");
		id=id.split("-");
		$("#aktif-gambar").html(id[1]);
		$(".daftar-gambar").removeAttr("style");
		$(".daftar-gambar").attr("style","cursor:pointer;");
		$(this).attr("style","font-size:10px; cursor:pointer; box-shadow:0px 0px 10px #3F0");
		$("#btn-hapus-gambar").removeAttr("disabled");
    });
	
    function hilanghapusgambar(){
			setTimeout(function(){
				$("#status-hapus-gambar").hide("fade","",1000);
			},10000);
		}
});
</script>
<div  style="margin-top:10px;">
</div>
<div class="pull-right">
<button type="button" id="btn-hapus-gambar" class="btn btn-danger" disabled><span class="glyphicon glyphicon-remove-sign"></span> Hapus</button>
</div>
<div  style="clear:both">
</div>
<div class="row" style="margin-top:10px;">
<?php
	$querygambar=mysql_query("SELECT id_soal_gambar, soal_gambar FROM soal_gambar ORDER BY id_soal_gambar DESC");
	while($gambar=mysql_fetch_array($querygambar)){
		echo "<div class=\"col-lg-2 col-md-2 col-sm-3\">
			<div class=\"img daftar-gambar\" id=\"gambar-$gambar[0]\" style=\"cursor:pointer;\">
			<img src=\"../$gambar[1]\" class=\"img img-thumbnail\" style=\"width:100%\" />
			</div>
		</div>";
	}
?>
</div>
<div id="status-hapus-gambar" style="display:none">
	<strong id="sg-hapus-gambar"></strong> : <span id="isi-hapus-gambar"></span> 
</div>
<div id="aktif-gambar" style="display:none"></div>