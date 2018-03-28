<?php
	include "../../include/koneksi.php";
	$baris=$_GET['baris'];
	$kolom=$_GET['kolom'];
	$urut=$_GET['urut'];
	$pilihkolom=$_GET['pilihkolom'];
	$selectkolom=$_GET['selectkolom'];
	
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
	if(isset($_GET['p'])){
		$p=abs($_GET['p']);
	}else $p=1;
	
	$awal=($p-1)*$baris;
	
	$querypaketpelajaran=mysql_query("SELECT pp.id_paket_pelajaran, p.paket, mp.mata_pelajaran, g.nama, pp.kkm FROM paket_pelajaran as pp, guru as g, paket as p, mata_pelajaran as mp WHERE pp.id_paket=p.id_paket AND pp.id_pelajaran=mp.id_pelajaran AND pp.id_guru=g.id_guru $strpilih ORDER BY $kolom $urut limit $awal,$baris");
	while($paketpelajaran=mysql_fetch_array($querypaketpelajaran)){
		echo "<tr>
			<td><input type='checkbox' name='checkbox-body' class='checkbox cbbody' value='$paketpelajaran[0]' /></td>
			<td>$paketpelajaran[0]</td>
			<td>$paketpelajaran[1]</td>
			<td>$paketpelajaran[2]</td>
			<td>$paketpelajaran[3]</td>
			<td>$paketpelajaran[4]</td>
			<td>
				<div class=\"row\" style=\"margin:0; padding:0;\">
					<div class=\"col-xs-2\"><img src=\"../img/DeleteRed.png\" style=\"width:15px; height:15px; cursor:pointer\" alt=\"Hapus\" title=\"Hapus\" class=\"hapus-icon-paketpelajaran\" id='hapus-paketpelajaran-$paketpelajaran[0]' data-toggle=\"modal\" data-target=\"#hapus-data-paketpelajaran\" /></div>
					<div class=\"col-xs-2\"><img src=\"../img/file_edit.png\" style=\"width:15px; height:15px; cursor:pointer\" alt=\"Edit\" title=\"Edit\" class=\"edit-icon-paketpelajaran\" id='edit-paketpelajaran-$paketpelajaran[0]' data-toggle=\"modal\" data-target=\"#form-edit-paketpelajaran\"  /></div>   					<div class=\"col-xs-4\"><img src=\"../img/view.png\" style=\"width:15px; height:15px; cursor:pointer\" alt=\"Lihat\" title=\"Lihat\" class=\"lihat-icon-paketpelajaran\" id='lihat-paketpelajaran-$paketpelajaran[0]' data-toggle=\"modal\" data-target=\"#lihat-data-paketpelajaran\"/></div>
				</div>
			</td>
		</tr>";
	}
?>

<script type="text/javascript">
$(document).ready(function(e) {
	$(".edit-icon-paketpelajaran").on("mouseover",function(e){
		var id=$(this).attr("id");
		id=id.split("-");
		$("#tmpat-editpaketpelajaran").load("include/aksi-editdata-paketpelajaran.php?id=" + id[2]);
	});
	
	$(".hapus-icon-paketpelajaran").on("mouseover",function(e){
		var id=$(this).attr("id");
		id=id.split("-");
		$("#tmpat-hapuspaketpelajaran").load("include/aksi-hapusdata-paketpelajaran.php?id=" + id[2]);
	});
	
	$(".lihat-icon-paketpelajaran").on("mouseover",function(e){
		var id=$(this).attr("id");
		id=id.split("-");
		$("#tmpat-lihatpaketpelajaran").load("include/aksi-lihatdata-paketpelajaran2.php?id=" + id[2]);
	});
});
</script>