<?php
	include "../../include/koneksi.php";
	$baris=5;
	$total=mysql_num_rows(mysql_query("SELECT * FROM mata_pelajaran"));
	$halaman=ceil($total/$baris);
	if(isset($_GET['p'])){
		$p=abs($_GET['p']);
	}else $p=1;
	
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
					echo "<li><a style=\"cursor:pointer\" class='menupaging-pelajaran' id='menupaging-pelajaran-$i'>".$i."</a></li>";
				else
					echo "<li><a style=\"cursor:pointer\" class='menupaging-pelajaran' id='menupaging-pelajaran-$i'>".$i."</a></li>";
			}
			$spage=$i;
		}
	}
	echo "</ul></div>";
?>

<script type="text/javascript">
$(document).ready(function(e) {
    $(".menupaging-pelajaran").click(function(e) {
        var id=$(this).attr("id");
		id=id.split("-");
		$("#tabel-matapelajaran").load("include/tabel-matapelajaran.php?p=" + id[2]);
		$("#tmpat-paging-tblpelajaran").load("include/paging-tabel-pelajaran.php?p=" + id[2]);

    });
});
</script>