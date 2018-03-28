<?php
	include "../../include/koneksi.php";
	$baris=10;
	if(isset($_GET['p'])){
		$p=abs($_GET['p']);
	}else $p=1;
	
	$total=mysql_num_rows(mysql_query("SELECT * FROM ujian_jadwal"));
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
					echo "<li><a style=\"cursor:pointer\" class='menupaging-jadwal' id='menupaging-jadwal-$i'>".$i."</a></li>";
				else
					echo "<li><a style=\"cursor:pointer\" class='menupaging-jadwal' id='menupaging-jadwal-$i'>".$i."</a></li>";
			}
			$spage=$i;
		}
	}
	echo "</ul></div>";
?>

<script type="text/javascript">
$(document).ready(function(e) {
    $(".menupaging-jadwal").click(function(e) {
        var id=$(this).attr("id");
		id=id.split("-");
		$("#tabel-ujian").load("include/tabel-ujian.php?p="+ id[2]);
		$("#tmpat-paging-jadwal").load("include/paging-tabel-ujian.php?p="+ id[2]);
    });
	
	
});
</script>