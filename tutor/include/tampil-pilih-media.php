<?php
	include "../../include/koneksi.php";
	$media=$_GET['media'];
?>
<script type="text/javascript">
$(document).ready(function(e) {
    $(".list-cerita").click(function(e) {
         var id=$(this).attr("id");
		id=id.split("-");
		$(".btn-pilih-media").attr("id","pilih-"+id[1]+"-"+id[2]);
		$(".list-cerita").removeAttr("style");
		$(".list-cerita").attr("style","font-size:10px; cursor:pointer;");
		$(this).attr("style","font-size:10px; cursor:pointer; box-shadow:0px 0px 10px #3F0");
		$(".btn-pilih-media").removeAttr("disabled");
    });
	
	$(".daftar-gambar").click(function(e) {
        var id=$(this).attr("id");
		id=id.split("-");
		$(".btn-pilih-media").attr("id","pilih-"+id[1]+"-"+id[2]);
		$(".daftar-gambar").removeAttr("style");
		$(".daftar-gambar").attr("style","cursor:pointer;");
		$(this).attr("style","cursor:pointer; box-shadow:0px 0px 10px #3F0");
		$(".btn-pilih-media").removeAttr("disabled");
    });
	
	$(".btn-pilih-media").click(function(e) {
        var id=$(this).attr("id");
		id=id.split("-");
		$("#btn-pilih-"+id[1]).hide();
		if(id[1]=="cerita"){
			$(".selected-close-cerita").attr("id","close-"+id[1]+"-"+id[2]+"");
			$(".selected-close-cerita").html("&times;");
			$(".selected-close-cerita").show();
		$("#pilihan-"+id[1]).append("<div class=\"well list-cerita\" id=\"selected-cerita-"+id[2]+"\" style=\"font-size:10px; cursor:pointer;\">"+ $("#media-cerita-"+id[2]).html() +"</div>");
		}
		else if(id[1]=="gambar"){
			$(".selected-close-gambar").attr("id","close-"+id[1]+"-"+id[2]+"");
			$(".selected-close-gambar").html("&times;");
			$(".selected-close-gambar").show();
			$("#pilihan-"+id[1]).append("<div class=\"img daftar-gambar\" id=\"media-gambar-"+id[2]+"\" style=\"cursor:pointer;\"><img src='"+ $("#list-gambar-"+id[2]).attr("src") +"' class=\"img img-thumbnail\" style=\"width:100%\" /></div>");
		}
    });
	
});
</script>
<div class="modal fade" id="pilih-data" role="dialog">
	<div class="modal-dialog modal-lg">
	    <div class="modal-content">
	  	  <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
              <?php
			  	if($media=="cerita")
				echo "<h4 class=\"modal-title\">Pilih Cerita</h4>";
				else if($media=="gambar")
				echo "<h4 class=\"modal-title\">Pilih Gambar</h4>";
			  ?>
	          
          </div>
          <div class="modal-body">
          	<div class="container-fluid">
            	<div class="row" style="margin-top:10px;">
            	<?php
					if($media=="cerita"){
						$querycerita=mysql_query("SELECT id_soal_cerita, awal_cerita FROM soal_cerita ORDER BY id_soal_cerita DESC");
						while($cerita=mysql_fetch_array($querycerita)){
							echo "<div class=\"col-lg-3 col-md-3 col-sm-4\">
								<div class=\"well list-cerita\" id=\"media-cerita-$cerita[0]\" style=\"font-size:10px; cursor:pointer;\">
								$cerita[1]...
								</div>
							</div>";
						}
					}
					
					else if($media=="gambar"){
						$querygambar=mysql_query("SELECT id_soal_gambar, soal_gambar FROM soal_gambar ORDER BY id_soal_gambar DESC");
						while($gambar=mysql_fetch_array($querygambar)){
							echo "<div class=\"col-lg-2 col-md-2 col-sm-3\">
								<div class=\"img daftar-gambar\" id=\"media-gambar-$gambar[0]\" style=\"cursor:pointer;\">
								<img src=\"../$gambar[1]\" id=\"list-gambar-$gambar[0]\" class=\"img img-thumbnail\" style=\"width:100%\" />
								</div>
							</div>";
						}
					}
				?>
                </div>
            </div>
          </div>
          <div class="modal-footer">
          	<button type="button" class="btn btn-primary btn-pilih-media" data-dismiss="modal" disabled="disabled">Pilih</button>
          </div>
		</div>
	</div>
</div>