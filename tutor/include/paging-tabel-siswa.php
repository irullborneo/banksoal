<?php
	include "../../include/koneksi.php";
	$baris=$_GET['baris'];
	$paket=$_GET['paket'];
	$sekolah=$_GET['sekolah'];
	if($paket=="semua"){
		$paket="";
	}
	else{
		$paket="WHERE id_paket=$paket";
	}
	
	if($sekolah=="semua")
		$sekolah="";
	else{
		if($paket=="")
			$sekolah="WHERE id_sekolah=$sekolah";
		else
			$sekolah="AND id_sekolah=$sekolah";
	}
	
	
	$cari=$_GET['cari'];
	if(isset($cari)){
		if($paket=="" && $sekolah=="")
			$cari="WHERE nama like '%$cari%'";
		else
			$cari="AND nama like '%$cari%'";
	}
	
	
	$total=mysql_num_rows(mysql_query("SELECT * FROM siswa $paket $sekolah $cari"));
	$halaman=ceil($total/$baris);
	$p=abs($_GET['p']);
	
	$spage="";
	$paging=4;
	echo "<br /><span class=\"text text-info\">$baris baris dari $total baris data yang ada.</span><br /><br /><div  class=\"text-center\"><ul class='pagination pagination-lg'>";
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
					echo "<li><a style=\"cursor:pointer\" class='menupaging' id='menupaging-$i'>".$i."</a></li>";
				else
					echo "<li><a style=\"cursor:pointer\" class='menupaging' id='menupaging-$i'>".$i."</a></li>";
			}
			$spage=$i;
		}
	}
	echo "</ul></div>";
?>

<script type="text/javascript">
$(document).ready(function(e) {
    $(".menupaging").click(function(e) {
        var id=$(this).attr("id");
		id=id.split("-");
		$("#table-siswa").load("include/tabel-siswa.php?baris=" + $("#banyak-baris-tampil").val() + "&kolom=" + $("#kolom-tampil").val() + "&urut=" + $("#naikturun-tampil").val() + "&paket=" + $("#paket-tampil").val() + "&p=" + id[1] + "&cari=" + $("#cari").val() + "&sekolah=" + $("#sekolah-tampil").val());
		$("#tmpat-paging-tblsiswa").load("include/paging-tabel-siswa.php?p=" + id[1] + "&baris=" + $("#banyak-baris-tampil").val() + "&paket=" + $("#paket-tampil").val() + "&cari=" + $("#cari").val() + "&sekolah=" + $("#sekolah-tampil").val());
    });
});

</script>