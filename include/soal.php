<script type="text/javascript">
$(document).ready(function(e) {
	$(".pilihan-checkbox").change(function(e) {
		var id=$(this).attr("id");
		id=id.split("-");
        var values = new Array();
		$.each($("input[name='pilih-"+id[2]+"']:checked"), function() {
  			values.push($(this).val());
		});
		var str="";
		for(var i =0; i<values.length; i++){
			if(i!=0){
				str +="|";
			}
			
			str += values[i];
		}
		$.ajax({
			type:"POST",
			data:"jawab="+str+"&nomer="+id[2],
			url:"include/kirim.php?kirim=jawab",
			success: function(response){
				$("#tempat-nomor-soal").load("include/nomor-soal.php");
			}
		});
    });
});
</script>
<?php
	include "koneksi.php";
	session_start();
	$no=$_GET['no'];
	$soal=explode("-",$_SESSION['soal']);
	$id_soal=$soal[$no];
	$querysoal=mysql_query("SELECT * FROM soal WHERE id_soal='$id_soal'");
	$tampilkan=mysql_fetch_array($querysoal);
	if($tampilkan['id_soal_cerita']>0){
		$cerita=mysql_fetch_array(mysql_query("SELECT soal_cerita FROM soal_cerita WHERE id_soal_cerita='$tampilkan[id_soal_cerita]'"));
		echo "<blockquote>$cerita[0]</blockquote>";
	}
	if($tampilkan['id_soal_gambar']>0){
		$gambar=mysql_fetch_array(mysql_query("SELECT soal_gambar FROM soal_gambar WHERE id_soal_gambar='$tampilkan[id_soal_gambar]'"));
		echo "<img src=\"$gambar[0]\" class=\"img img-responsive\" />";
	}
	echo "<div id=\"soal-pertanyaan\">
		<span style='float:left;margin-right:20px;' id=\"no-soal\">
		$no.
		</span>
		<div style=\"margin-left:40px;\">
			<span>$tampilkan[soal] </span>
			<div>
	";
	if($tampilkan['tipe_soal']=="ganda"){
		echo "<ol type=\"a\">";
		$pilihan=explode("|",$_SESSION['pilihan-'.$no]);
		if($tampilkan['tipe_jawab']=="text"){
			for($s=0;$s<count($pilihan);$s++){
				$pilih=explode(">",$pilihan[$s]);
				if($_SESSION['jawab-'.$no]==$pilih[0]){
					echo "<li><input onChange=\"pilih(this)\" type=\"radio\" name=\"soal-$no\" value=\"$pilih[0]\" id=\"pilihan-$pilih[0]\" class='pilihan-jawaban' checked /> <label for=\"pilihan-$pilih[0]\">$pilih[1]</label></li>";
				}
				else{
					echo "<li><input onChange=\"pilih(this)\" type=\"radio\" name=\"soal-$no\" value=\"$pilih[0]\" id=\"pilihan-$pilih[0]\" class='pilihan-jawaban' /> <label for=\"pilihan-$pilih[0]\">$pilih[1]</label></li>";
				}
				
			}
		}
		else{
			for($s=0;$s<count($pilihan);$s++){
				$pilih=explode(">",$pilihan[$s]);
				$gambar=mysql_fetch_array(mysql_query("SELECT soal_gambar FROM soal_gambar WHERE id_soal_gambar='$pilih[1]'"));
				if($_SESSION['jawab-'.$no]==$pilih[0]){
					echo "<li><input onChange=\"pilih(this)\" type=\"radio\" name=\"soal-$no\" value=\"$pilih[0]\" id=\"pilihan-$pilih[0]\" class='pilihan-jawaban' checked /> <label for=\"pilihan-$pilih[0]\"><img src=\"$gambar[0]\" class=\"img img-thumbnail\" style=\"width:330px;\" /></label></li>";
				}
				else{
					echo "<li><input onChange=\"pilih(this)\" type=\"radio\" name=\"soal-$no\" value=\"$pilih[0]\" id=\"pilihan-$pilih[0]\" class='pilihan-jawaban' /> <label for=\"pilihan-$pilih[0]\"><img src=\"$gambar[0]\" class=\"img img-thumbnail\" style=\"width:330px;\" /></label></li>";
				}
				
			}
		}
		echo "</ol>";
	}
	else{
		$pilihan=explode("|",$_SESSION['pilihan-'.$no]);
		$jawaban=explode("|",$_SESSION['jawab-'.$no]);
		for($s=0;$s<count($pilihan);$s++){
			if(in_array($pilihan[$s],$jawaban)){
				echo "<input type=\"checkbox\" class=\"pilihan-checkbox\" name=\"pilih-$no\" id=\"pilih-$pilihan[$s]-$no\" value=\"$pilihan[$s]\" checked /> <label for=\"pilih-$pilihan[$s]-$no\" style='margin-right:15px'>$pilihan[$s]</label>";
			}
			else{
				echo "<input type=\"checkbox\" class=\"pilihan-checkbox\" name=\"pilih-$no\" id=\"pilih-$pilihan[$s]-$no\" value=\"$pilihan[$s]\" /> <label for=\"pilih-$pilihan[$s]-$no\" style='margin-right:15px'>$pilihan[$s]</label>";
			}
		}
	}
	echo "
			</div>
		</div>
		<div class=\"clearfix\"></div>
	</div>"; 
?>