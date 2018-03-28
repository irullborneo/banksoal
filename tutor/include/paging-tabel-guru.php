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
	
	$cari=$_GET['cari'];
	if(isset($cari)){
		$cari="AND g.nama like '%$cari%'";
	}
	
	if($pilihkolom=="semua" || $selectkolom=="semua"){
		$strpilih="";
	}
	else if($pilihkolom=="jenis_kelamin")
		$strpilih="AND g.jenis_kelamin='".$selectkolom."'";
	else if($pilihkolom=="id_sekolah")
		$strpilih="AND g.id_sekolah=".$selectkolom;
	else if($pilihkolom=="pendidikan_akhir")
		$strpilih="AND g.pendidikan_akhir=".$selectkolom;
	
	$total=mysql_num_rows(mysql_query("SELECT * FROM guru as g, sekolah as sk WHERE g.id_sekolah=sk.id_sekolah AND sebagai='guru' $strpilih $cari"));
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
					echo "<li><a style=\"cursor:pointer\" class='menupaging-guru' id='menupaging-guru-$i'>".$i."</a></li>";
				else
					echo "<li><a style=\"cursor:pointer\" class='menupaging-guru' id='menupaging-guru-$i'>".$i."</a></li>";
			}
			$spage=$i;
		}
	}
	echo "</ul></div>";
?>

<script type="text/javascript">
$(document).ready(function(e) {
    $(".menupaging-guru").click(function(e) {
        var id=$(this).attr("id");
		id=id.split("-");
		var baris=$("#banyak-baris-tampil").val();
			var kolom=$("#kolom-tampil").val();
			var urut=$("#naikturun-tampil").val();
			var pilihkolom=$("#kolom-guru").val();
			var selectkolom=$("#select-pilih-guru").val();
			var strselectkolom="";
			var strp="";
			var cari="";
			if(pilihkolom!="semua"){
				strselectkolom="&selectkolom=" + selectkolom;
			}
			if($("#cari").val()!=""){
				cari="&cari=" + $("#cari").val();
			}
			var lin="?baris=" + baris + "&kolom=" + kolom + "&urut=" + urut + "&pilihkolom=" + pilihkolom +""+ strselectkolom +""+ cari +"&p="+ id[2];
			$("#tabel-guru").load("include/tabel-guru.php" + lin);
			$("#tmpat-paging-tblguru").load("include/paging-tabel-guru.php" + lin);
    });
	
	
});
</script>