<?php
	include "../../include/koneksi.php";
	$media=$_GET['media'];
?>
<script type="text/javascript">
$(document).ready(function(e) {

	
	$(".daftarganda-gambar").click(function(e) {
        var id=$(this).attr("id");
		id=id.split("-");
		$(".btn-ganda-media").attr("id","pilih-"+id[1]+"-"+id[2]);
		$(".daftarganda-gambar").removeAttr("style");
		$(".daftarganda-gambar").attr("style","cursor:pointer;");
		$(this).attr("style","cursor:pointer; box-shadow:0px 0px 10px #3F0");
		$(".btn-ganda-media").removeAttr("disabled");
    });
	
	$(".btn-ganda-media").click(function(e) {
        var id=$(this).attr("id");
		id=id.split("-");
		var ids=$("#btn-pilih-aktif").html();
		ids=ids.split("-");
		//$("#btn-pilih-"+id[1]).hide();
		$("#gambar2-ganda-"+ids[2]).hide();
		$("#gambar-"+ids[2]).append("<button type=\"button\" class=\"close selectedganda-close \" id=\"selectedganda-close-"+ids[2]+"\" onclick=\"batalgambar('"+ids[2]+"')\">&times;</button><div class=\"img daftarganda-gambar\" id=\"ganda-gambar-"+ids[2]+"\" style=\"cursor:pointer;\"><img src='"+ $("#listganda-gambar-"+id[2]).attr("src") +"' id=\"gandapilih-gambar-"+id[2]+"\" class=\"img img-thumbnail gandapilih-gambar-"+ids[2]+"\" style=\"width:100%\" /></div>");
    });
	
});
</script>
<div class="modal fade" id="ganda-data" role="dialog">
	<div class="modal-dialog modal-lg">
	    <div class="modal-content">
	  	  <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="moda--title">Pilih Gambar</h4>
	          
          </div>
          <div class="modal-body">
          	<div class="container-fluid">
            	<div class="row" style="margin-top:10px;">
            	<?php
					
						$querygambar=mysql_query("SELECT id_soal_gambar, soal_gambar FROM soal_gambar ORDER BY id_soal_gambar DESC");
						while($gambar=mysql_fetch_array($querygambar)){
							echo "<div class=\"col-lg-2 col-md-2 col-sm-3\">
								<div class=\"img daftarganda-gambar\" id=\"gambarganda-gambar-$gambar[0]\" style=\"cursor:pointer;\">
								<img src=\"../$gambar[1]\" id=\"listganda-gambar-$gambar[0]\" class=\"img img-thumbnail\" style=\"width:100%\" />
								</div>
							</div>";
						}

				?>
                </div>
            </div>
          </div>
          <div class="modal-footer">
          	<button type="button" class="btn btn-primary btn-ganda-media" data-dismiss="modal" disabled="disabled">Pilih</button>
          </div>
		</div>
	</div>
</div>