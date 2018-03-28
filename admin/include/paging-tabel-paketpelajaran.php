<?php
	include "../../include/koneksi.php";
	$baris=$_GET['baris'];
	$kolom=$_GET['kolom'];
	$urut=$_GET['urut'];
	$pilihkolom=$_GET['pilihkolom'];
	$selectkolom=$_GET['selectkolom'];
	
	if(isset($_GET['p'])){
		$p=abs($_GET['p']);
	}else $p=1;
	
	
	if($pilihkolom=="semua"){
		$strpilih="";
	}
	else if($pilihkolom=="paket")
		$strpilih="AND pp.id_paket=".$selectkolom;
	else if($pilihkolom=="mata_pelajaran")
		$strpilih="AND pp.id_pelajaran=".$selectkolom;
	else if($pilihkolom=="guru")
		$strpilih="AND pp.id_guru=".$selectkolom;
	
	$total=mysql_num_rows(mysql_query("SELECT * FROM paket_pelajaran as pp, guru as g, mata_pelajaran as mp, paket as p WHERE pp.id_paket=p.id_paket AND pp.id_pelajaran=mp.id_pelajaran AND pp.id_guru=g.id_guru $strpilih"));
	$halaman=ceil($total/$baris);

	
	$spage="";
	$paging=2;
	
	echo "<br /><span class=\"text text-info\">$baris baris dari $total baris data yang ada.</span><br /><br /><div  class=\"text-center\"><ul class='pagination'>";
	
	for($i=1;$i<=$halaman;$i++){
		if((($i>=$p-$paging) && ($i<=$p+$paging)) || ($i==1) || ($i==$halaman)){
			if(($spage==1) && ($i!=2))
				echo "<li><a href=\"#\">...</a></li>";
			if(($spage!=($halaman-1)) && ($i == $halaman))
				echo "<li><a>...</a></li>";
			if($p==$i)
				echo "<li class=\"disabled\"><a>".$i."</a></li>";
			else{
				if($i==1)
					echo "<li><a style=\"cursor:pointer\" class='menupaging-paketpelajaran' id='menupaging-paketpelajaran-$i'>".$i."</a></li>";
				else
					echo "<li><a style=\"cursor:pointer\" class='menupaging-paketpelajaran' id='menupaging-paketpelajaran-$i'>".$i."</a></li>";
			}
			$spage=$i;
		}
	}
	echo "</ul></div>";
?>

<script type="text/javascript">
$(document).ready(function(e) {
    $(".menupaging-paketpelajaran").click(function(e) {
        var id=$(this).attr("id");
		id=id.split("-");
		var baris=$("#banyak-baris-tampil").val();
		var kolom=$("#kolom-tampil").val();
		var urut=$("#naikturun-tampil").val();
		var pilihkolom=$("#pilih-kolom").val();
		var selectkolom=$("#select-pilih-kolom").val();
		var strselectkolom="";
		var strp="";
		if(pilihkolom!="semua"){
			strselectkolom="&selectkolom=" + selectkolom;
		}
		var lin="&baris=" + baris + "&kolom=" + kolom + "&urut=" + urut + "&pilihkolom=" + pilihkolom +""+ strselectkolom;
		$("#tabel-paketpelajaran").load("include/tabel-paketpelajaran.php?p=" + id[2] +""+ lin);
		$("#tmpat-paging-tblpaketpelajaran").load("include/paging-tabel-paketpelajaran.php?p=" + id[2] +""+ lin);

    });
	
	
});
</script>