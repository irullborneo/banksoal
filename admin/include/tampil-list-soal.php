<script type="text/javascript">
$(document).ready(function(e) {
    $(".btn-edit-listsoal").click(function(e) {
		var id=$(this).attr("id");
		id=id.split("-");
		$("#form-tambah-listsoal").load("include/tampil-edit-listsoal.php?id=" + id[2]);
		var edit=$("#idsoaledit").val();
		window.location="./?p=data_soal&edit="+edit+"#form-tambah-listsoal";
    });
	
	$(".btn-hapus-listsoal").mouseover(function(e) {
		var id=$(this).attr("id");
		id=id.split("-");
        $("#tempat-hapus-listsoal").load("include/aksi-hapusdata-listsoal.php?id="+ id[2]);
    });
	
});
$(function() { 
		var float_nav_offset_top = $('#scrollnav').offset().top; 
		var float_nav = function(){ 
			var scroll_top = $(window).scrollTop();
			if (scroll_top > float_nav_offset_top){ 
				$('#scrollnav').css({ 'position': 'fixed', 'top':60}); 
			} else { 
				$('#scrollnav').css({ 'position': 'relative', 'top':0
			}); 
		} 
	}; 
	float_nav(); 
	$(window).scroll(function() { 
		float_nav(); 
	}); 
	}); 
</script>
<?php
	include "../../include/koneksi.php";
	$querysoal=mysql_query("SELECT id_soal, id_soal_cerita, tipe_soal, soal, tipe_jawab, pilihan, jawab, persen_benar, id_soal_gambar FROM soal WHERE id_soal_pelajaran='$_GET[idpelajaran]' ORDER BY id_soal DESC");
	$no=1;
	echo "<div class=\"row\">
		<div class=\"col-lg-10 col-md-10 col-sm-10 col-xs-10\">
	";
	while($soal=mysql_fetch_array($querysoal)){
		echo "<div class=\"panel panel-default\" id=\"listsoal$no\"><div class=\"panel-body\">
			<div class=\"row\">
				<div class=\"col-lg-1 col-md-1 col-sm-1 col-xs-1\">$no</div>
				
				<div class=\"col-lg-10 col-md-10 col-sm-10 col-xs-10\">
					<div class=\"row\">
		";
					if($soal['id_soal_cerita']!=0){
						$cerita=mysql_fetch_array(mysql_query("SELECT soal_cerita FROM soal_cerita WHERE id_soal_cerita='$soal[id_soal_cerita]'"));
						echo "<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">$cerita[soal_cerita]</div><br /> <hr /><hr />";
					}
		echo "
						<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">$soal[soal] ?</div>
						
		";
						if($soal['id_soal_gambar']==0){
							echo "<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">
							";
							if($soal['tipe_soal']=="ganda"){
								echo "<ol type=\"a\" >";
								if($soal['tipe_jawab']=="text"){
									$pilihan=explode('|',$soal['pilihan']);
									for($i=0;$i<count($pilihan);$i++){
										$ab=explode(">",$pilihan[$i]);
										if($ab[0]==$soal['jawab'])
											echo "<li id=\"$soal[0]-$ab[0]\" style=\"font-weight:bold\">$ab[1]</li>";
										else
											echo "<li id=\"$soal[0]-$ab[0]\">$ab[1]</li>";
									}
								}
								else if($soal['tipe_jawab']=="gambar"){
									$pilihan=explode('|',$soal['pilihan']);
									echo "<br /><div class=\"row\">";
									for($i=0;$i<count($pilihan);$i++){
										$ab=explode(">",$pilihan[$i]);
										$gbr=mysql_fetch_array(mysql_query("SELECT soal_gambar FROM soal_gambar WHERE id_soal_gambar='$ab[1]'"));
										if($ab[0]==$soal['jawab'])
											echo "<div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-12\"><li id=\"$soal[0]-$ab[0]\" style=\"font-weight:bold\"><img src=\"../$gbr[soal_gambar]\" class=\"img img-thumbnail\" style=\"width:120px\" /></li></div>";
										else
											echo "<div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-12\"><li id=\"$soal[0]-$ab[0]\"><img src=\"../$gbr[soal_gambar]\" class=\"img img-thumbnail\" style=\"width:120px\" /></li></div>";
									}
									echo "</div>";
								}
								echo "</ol>";
							}
							else if($soal['tipe_soal']=="checkbox"){
								$cekbok=explode("|",$soal['pilihan']);
								$jawab=explode("|",$soal['jawab']);
								echo "<br />";
								foreach($cekbok as $val){
									if(in_array($val, $jawab))
										echo "<span class=\"label label-success\">$val</span> ";
									else
										echo "<span class=\"label label-primary\">$val</span> ";
								}
							}
							echo "
							</div>";
						}
						else{
							$gambar=mysql_fetch_array(mysql_query("SELECT soal_gambar FROM soal_gambar WHERE id_soal_gambar='$soal[id_soal_gambar]'"));
							echo "<div class=\"col-lg-8 col-md-8 col-sm-8 col-xs-10\">
							";
							echo "<ol type=\"a\" >";
								if($soal['tipe_jawab']=="text"){
									$pilihan=explode('|',$soal['pilihan']);
									for($i=0;$i<count($pilihan);$i++){
										$ab=explode(">",$pilihan[$i]);
										if($ab[0]==$soal['jawab'])
											echo "<li id=\"$soal[0]-$ab[0]\" style=\"font-weight:bold\">$ab[1]</li>";
										else
											echo "<li id=\"$soal[0]-$ab[0]\">$ab[1]</li>";
									}
								}
								else if($soal['tipe_jawab']=="gambar"){
									$pilihan=explode('|',$soal['pilihan']);
									echo "<br /><div class=\"row\">";
									for($i=0;$i<count($pilihan);$i++){
										$ab=explode(">",$pilihan[$i]);
										$gbr=mysql_fetch_array(mysql_query("SELECT soal_gambar FROM soal_gambar WHERE id_soal_gambar='$ab[1]'"));
										if($ab[0]==$soal['jawab'])
											echo "<div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-12\"><li id=\"$soal[0]-$ab[0]\" style=\"font-weight:bold\"><img src=\"../$gbr[soal_gambar]\" class=\"img img-thumbnail\" style=\"width:120px\" /></li></div>";
										else
											echo "<div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-12\"><li id=\"$soal[0]-$ab[0]\"><img src=\"../$gbr[soal_gambar]\" class=\"img img-thumbnail\" style=\"width:120px\" /></li></div>";
									}
									echo "</div>";
								}
								echo "</ol>";
							echo "
							</div>
							<div class=\"col-lg-4 col-md-4 col-sm-4 col-xs-2\">
								<img src=\"../$gambar[soal_gambar]\" class=\"img img-thumbnail\" style=\"width:100%\" />
							</div>
							";
						}
		echo "
					</div>
				</div>
				
			</div>
		</div>
			<div class=\"panel-footer\">
				<div class=\"pull-left\">
				 <b>Jawaban: 
		";
		if($soal['tipe_soal']=="checkbox"){
			foreach($cekbok as $val){
				if(in_array($val, $jawab))
					echo "<span class=\"label label-success\">$val</span> ";
			}
		}
		else if($soal['tipe_soal']=="ganda"){
			if($soal['tipe_jawab']=="text"){
				for($i=0;$i<count($pilihan);$i++){
					$ab=explode(">",$pilihan[$i]);
					if($ab[0]==$soal['jawab'])
						echo "$ab[0]. $ab[1]";
				}
			}
			else if($soal['tipe_jawab']=="gambar"){
				for($i=0;$i<count($pilihan);$i++){
					$ab=explode(">",$pilihan[$i]);
					$gbr=mysql_fetch_array(mysql_query("SELECT soal_gambar FROM soal_gambar WHERE id_soal_gambar='$ab[1]'"));
					if($ab[0]==$soal['jawab'])
						echo "$ab[0] <img src=\"../$gbr[soal_gambar]\" class=\"img img-thumbnail\" style=\"width:40px; height:40px\" />";
				}
			}
		}
		echo "
				 </b>
		";
		if($soal['tipe_soal']=="checkbox"){
			echo "<br /><b>Persen Benar: $soal[persen_benar]%</b>";
		}
		echo "
				</div>
				<div class=\"pull-right\">
					<button type=\"button\" class=\"btn btn-primary btn-edit-listsoal\" id=\"edit-listsoal-$soal[id_soal]\">Edit</button>
					<button type=\"button\" class=\"btn btn-danger btn-hapus-listsoal\" id=\"hapus-listsoal-$soal[id_soal]\" data-toggle=\"modal\" data-target=\"#hapus-data-listsoal\">Hapus</button>
				</div>
				<div style=\"clear:both\"></div>
			</div>
		</div>";
		$no++;
	}
	echo "
		</div>
		<nav class=\"col-lg-2 col-md-2 col-sm-2\" id=\"myScrollspy\">
			<ul class=\"nav nav-pills nav-stacked\" id=\"scrollnav\" style=\"max-height:400px;overflow:auto\">
	";
			for($i=1;$i<$no;$i++){
				if($i==1)
					echo "<li class=\"active\"><a href=\"#listsoal$i\">Nomer $i</a></li>";
				else
					echo "<li><a href=\"#listsoal$i\">Nomer $i</a></li>";
			}
	echo "
			</ul>
		</nav>
	</div>
	";
?>
