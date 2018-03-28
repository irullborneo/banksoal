<script type="text/javascript">
$(document).ready(function(e) {
    $(".list-soalpelajaran").click(function(e) {
        var id=$(this).attr("id");
		id=id.split("-");
		if(id[2]>0){
			var datakirim={
				i:id[1],
				u:id[3]
			};
			$.ajax({
				type:"POST",
				data:datakirim,
				url:"include/tentukan-soal.php",
				success: function(response){
					window.location="./";
				}
				
			});
		}
		else{
			alert("Tidak ada soal pada mata pelajaran ini");
		}
    });
});
</script>
<?php
	include "koneksi.php";
	$id=$_GET['id'];
	$id=explode("-",$id);
	$paket=$id[2];
	if($id[1]=="semua"){
		$mp="";
	}
	else{
		$mp="AND pp.id_pelajaran='$id[1]'";
	}
	
	$querysoal=mysql_query("SELECT sp.id_soal_pelajaran, mp.mata_pelajaran, sp.tgl_input FROM soal_pelajaran as sp, paket_pelajaran as pp, mata_pelajaran as mp WHERE sp.id_paket_pelajaran=pp.id_paket_pelajaran AND pp.id_pelajaran=mp.id_pelajaran AND pp.id_paket='$paket' AND sp.untuk='latihan' $mp ORDER BY sp.tgl_input DESC");
	$banyaksoal=mysql_num_rows($querysoal);
	if($banyaksoal>0){
		echo "<div class=\"row\">";
		while($soal=mysql_fetch_array($querysoal)){
			$banyks=mysql_num_rows(mysql_query("SELECT * FROM soal WHERE id_soal_pelajaran='$soal[0]'"));
			echo "<div class=\"col-lg-1 col-md-2 col-sm-2 col-xs-2 text-center navbar-text list-soalpelajaran\" style=\"margin-bottom:20px; cursor:pointer\" id=\"soal-$soal[0]-$banyks\">
				<img src=\"img/soal.jpg\" class=\"img img-responsive\" /><span style='font-size:12px'>".date("d/m/Y", strtotime($soal[2]))."<br/>".ucwords($soal[1])."</span>
			</div>
			";
		}
		echo "</div>";
	}
	else{
		echo "<div class=\"alert alert-warning\">Soal tidak tersedia</div>";
	}
	
?>