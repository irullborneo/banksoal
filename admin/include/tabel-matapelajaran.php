<?php
	include "../../include/koneksi.php";
	$baris=5;
	$total=mysql_num_rows(mysql_query("SELECT * FROM paket"));
	$halaman=ceil($total/$baris);
	if(isset($_GET['p'])){
		$p=abs($_GET['p']);
	}else $p=1;
	
	$awal=($p-1)*$baris;
	
	
	$querymatapelajaran=mysql_query("SELECT * FROM mata_pelajaran limit $awal,$baris");
	while($matapelajaran=mysql_fetch_array($querymatapelajaran)){
		echo "<tr>
			<td>$matapelajaran[id_pelajaran]</td>
			<td>$matapelajaran[mata_pelajaran]</td>
			<td>
				<div class=\"row\" style=\"margin:0; padding:0;\">
					<div class=\"col-xs-2\"><img src=\"../img/DeleteRed.png\" style=\"width:15px; height:15px; cursor:pointer\" alt=\"Hapus\" title=\"Hapus\" class=\"hapus-icon\" id='hapus-matapelajaran-$matapelajaran[id_pelajaran]' data-toggle=\"modal\" data-target=\"#hapus-data-pelajaran\" /></div>
					<div class=\"col-xs-2\"><img src=\"../img/file_edit.png\" style=\"width:15px; height:15px; cursor:pointer\" alt=\"Edit\" title=\"Edit\" class=\"edit-icon\" id='edit-matapelajaran-$matapelajaran[id_pelajaran]' data-toggle=\"modal\" data-target=\"#form-edit-datapelajaran\"  /></div>   
				</div>
			</td>
		</tr>
		";
	}
?>

<script type="text/javascript">
	$(document).ready(function(e) {
        $(".edit-icon").on("mouseover",function(e){
			var id=$(this).attr("id");
			id=id.split("-");
			$("#tmpat-editpelajaran").load("include/aksi-editdata-pelajaran.php?id=" + id[2]);
		});
		
		$(".hapus-icon").on("mouseover",function(e){
			var id=$(this).attr("id");
			id=id.split("-");
			$("#tmpat-hapuspelajaran").load("include/aksi-hapusdata-pelajaran.php?id=" + id[2]);
		});
    });
</script>