<?php
	include "../../include/koneksi.php";
	$baris=5;
	$total=mysql_num_rows(mysql_query("SELECT * FROM paket"));
	$halaman=ceil($total/$baris);
	if(isset($_GET['p'])){
		$p=abs($_GET['p']);
	}else $p=1;
	
	$awal=($p-1)*$baris;
	
	$querypaket=mysql_query("SELECT * FROM paket limit $awal,$baris");
	while($paket=mysql_fetch_array($querypaket)){
		echo "<tr>
			<td>$paket[id_paket]</td>
			<td>$paket[paket]</td>
			<td>
    			<div class=\"row\" style=\"margin:0; padding:0;\">
     				<div class=\"col-xs-2\"><img src=\"../img/DeleteRed.png\" style=\"width:15px; height:15px; cursor:pointer\" alt=\"Hapus\" title=\"Hapus\" class=\"hapus-icon\" id='hapus-paket-$paket[id_paket]' data-toggle=\"modal\" data-target=\"#hapus-data\" /></div>
        			<div class=\"col-xs-2\"><img src=\"../img/file_edit.png\" style=\"width:15px; height:15px; cursor:pointer\" alt=\"Edit\" title=\"Edit\" class=\"edit-icon\" id='edit-paket-$paket[id_paket]' data-toggle=\"modal\" data-target=\"#form-edit-datapaket\"  /></div>   
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
		$("#tmpat-editpaket").load("include/aksi-editdata-paket.php?id=" + id[2]);
	});
	$(".hapus-icon").on("mouseover",function(e){
		var id=$(this).attr("id");
		id=id.split("-");
		$("#tmpat-hapuspaket").load("include/aksi-hapusdata-paket.php?id=" + id[2]);
	});
});
</script>
