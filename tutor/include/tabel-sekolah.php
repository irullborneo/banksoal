<?php
	include "../../include/koneksi.php";
	$baris=10;
	if(isset($_GET['p'])){
		$p=abs($_GET['p']);
	}else $p=1;
	
	$awal=($p-1)*$baris;
	
	$querysekolah=mysql_query("SELECT id_sekolah, nama_sekolah, alamat, telpon, id_guru FROM sekolah ORDER BY id_sekolah DESC limit $awal,$baris");
	while($sekolah=mysql_fetch_array($querysekolah)){
		echo "<tr>
		<td><input type='checkbox' name='checkbox-body' class='checkbox cbbody' value='$sekolah[0]' /></td>
		<td>$sekolah[0]</td>
		<td>$sekolah[1]</td>
		<td>$sekolah[2]</td>
		<td>$sekolah[3]</td>
		<td>";
		if($sekolah[4]!=0){
			$guru=mysql_fetch_array(mysql_query("SELECT nama FROM guru WHERE id_guru='$sekolah[4]'"));
			echo $guru['nama'];
		}
		else{
			echo "-";
		}
		echo "</td>
		<td>
				<div class=\"row\" style=\"margin:0; padding:0;\">
					<div class=\"col-md-6 col-sm-6 col-xs-6\"><img src=\"../img/DeleteRed.png\" style=\"width:15px; height:15px; cursor:pointer\" alt=\"Hapus\" title=\"Hapus\" class=\"hapus-icon-sekolah\" id='hapus-sekolah-$sekolah[0]' data-toggle=\"modal\" data-target=\"#hapus-data-sekolah\" /></div>
					<div class=\"col-md-6 col-sm-6 col-xs-6\"><img src=\"../img/file_edit.png\" style=\"width:15px; height:15px; cursor:pointer\" alt=\"Edit\" title=\"Edit\" class=\"edit-icon-sekolah\" id='edit-sekolah-$sekolah[0]' data-toggle=\"modal\" data-target=\"#form-edit-sekolah\"  /></div>   					
				</div>
			</td>
		</tr>";
	}
	
?>

<script type="text/javascript">
$(document).ready(function(e) {
	$(".hapus-icon-sekolah").mouseover(function(e) {
        var id=$(this).attr("id");
		id=id.split("-");
		$("#tmpat-editsekolah").load("include/aksi-hapusdata-sekolah.php?id=" + id[2]);
    });
	
	$(".edit-icon-sekolah").mouseover(function(e) {
        var id=$(this).attr("id");
		id=id.split("-");
		$("#tmpat-editsekolah").load("include/aksi-editdata-sekolah.php?id=" + id[2]);
    });
});
</script>