<?php
	include "../../include/koneksi.php";
	$baris=10;
	if(isset($_GET['p'])){
		$p=abs($_GET['p']);
	}else $p=1;
	
	$awal=($p-1)*$baris;
	
	$queryujian=mysql_query("SELECT id_jadwal_ujian, jadwal_ujian, tgl_awal, tgl_akhir FROM ujian_jadwal ORDER BY tgl_awal DESC limit $awal,$baris");
	
	while($ujian=mysql_fetch_array($queryujian)){
		$tgl_awal=explode(" ",$ujian['tgl_awal']);
		$tgl_akhir=explode(" ",$ujian['tgl_akhir']);
		
		//$tgl1=explode("-",$tgl_awal[0]);
		//$tgl2=explode("-",$tgl_akhir[0]);
		echo "<tr>
			<td><input type='checkbox' name='checkbox-body' class='checkbox cbbody' value='$ujian[id_jadwal_ujian]' /></td>
			<td>$ujian[id_jadwal_ujian]</td>
			<td>$ujian[jadwal_ujian]</td>
			<td>".date("d/m/Y", strtotime($tgl_awal[0]))." Sampai ".date("d/m/Y", strtotime($tgl_akhir[0]))."</td>
			<td>
				<div class=\"row\" style=\"margin:0; padding:0;\">
					<div class=\"col-md-6 col-sm-6 col-xs-6\"><img src=\"../img/DeleteRed.png\" style=\"width:15px; height:15px; cursor:pointer\" alt=\"Hapus\" title=\"Hapus\" class=\"hapus-icon-jadwal\" id='hapus-jadwal-$ujian[id_jadwal_ujian]' data-toggle=\"modal\" data-target=\"#hapus-data-jadwal\" /></div>
					<div class=\"col-md-6 col-sm-6 col-xs-6\"><img src=\"../img/file_edit.png\" style=\"width:15px; height:15px; cursor:pointer\" alt=\"Edit\" title=\"Edit\" class=\"edit-icon-jadwal\" id='edit-jadwal-$ujian[id_jadwal_ujian]' data-toggle=\"modal\" data-target=\"#form-edit-jadwal\"  /></div>   					
				</div>
			</td>
		</tr>
		";
	}
?>

<script type="text/javascript">
$(document).ready(function(e) {
	$(".hapus-icon-jadwal").mouseover(function(e) {
        var id=$(this).attr("id");
		id=id.split("-");
		$("#tmpat-hapusjadwal").load("include/aksi-hapusdata-ujian.php?id=" + id[2]);
    });
	
	$(".edit-icon-jadwal").mouseover(function(e) {
        var id=$(this).attr("id");
		id=id.split("-");
		$("#tmpat-editjadwal").load("include/aksi-editdata-ujian.php?id=" + id[2]);
    });
});
</script>