<?php
	error_reporting(1);
	include "../../include/koneksi.php";
	$baris=$_GET['baris'];
	$kolom=$_GET['kolom'];
	$urut=$_GET['urut'];
	$pilihkolom=$_GET['pilihkolom'];
	$selectkolom=$_GET['selectkolom'];
	
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
	
	$total=mysql_num_rows(mysql_query("SELECT * FROM guru as g, sekolah as sk WWHERE g.id_sekolah=sk.id_sekolah"));
	$halaman=ceil($total/$baris);
	if(isset($_GET['p'])){
		$p=abs($_GET['p']);
	}else $p=1;
	
	$awal=($p-1)*$baris;
		
	$queryguru=mysql_query("SELECT g.id_guru, g.nip, g.nama, g.jenis_kelamin, sk.nama_sekolah, g.alamat, g.pendidikan_akhir FROM guru as g, sekolah as sk WHERE sebagai='guru' AND g.id_sekolah=sk.id_sekolah $strpilih $cari ORDER BY $kolom $urut limit $awal,$baris");
	while($guru=mysql_fetch_array($queryguru)){
		if($guru[3]=="l") $jk="Laki-Laki";
		else $jk="Perempuan";
		echo "<tr>
			<td><input type=\"checkbox\" name=\"checkbox-body\" class=\"checkbox cbbody\" value=\"$guru[0]\" /></td>
			<td>$guru[0] </td>
			<td>$guru[1]</td>
			<td>$guru[2]</td>
			<td>$jk</td>
			<td>$guru[4]</td>
			<td>$guru[5]</td>
			<td>$guru[6]</td>
			<td>
                <div class=\"row\" style=\"margin:0; padding:0;\">
                   	<div class=\"col-xs-4\"><img src=\"../img/DeleteRed.png\" style=\"width:15px; height:15px; cursor:pointer\" alt=\"Hapus\" title=\"Hapus\" class='hapus-dataguru' id='hapus-dataguru-$guru[0]' data-toggle=\"modal\" data-target=\"#form-hapus-guru\" /></div>
                    <div class=\"col-xs-4\"><img src=\"../img/file_edit.png\" style=\"width:15px; height:15px; cursor:pointer\" alt=\"Edit\" title=\"Edit\" class='edit-dataguru' id='edit-dataguru-$guru[0]' data-toggle=\"modal\" data-target=\"#form-editdata-guru\" /></div>
                    <div class=\"col-xs-4\"><img src=\"../img/view.png\" style=\"width:15px; height:15px; cursor:pointer\" alt=\"Lihat\" title=\"Lihat\" class='lihat-dataguru' id='lihat-dataguru-$guru[0]'  data-toggle=\"modal\" data-target=\"#form-lihat-data\" /></div>
                </div>
         	</td>
		</tr>
		";
	}
?>

<script type="text/javascript">
$(document).ready(function(e) {
	$(".edit-dataguru").on("mouseover",function(e){
		var id=$(this).attr("id");
		id=id.split("-");
		$("#dialog-editguru").load("include/aksi-editdata-guru.php?id=" + id[2]);
	});
	
	$(".hapus-dataguru").on("mouseover",function(e){
		var id=$(this).attr("id");
		id=id.split("-");
		$("#dialog-hapusguru").load("include/aksi-hapusdata-guru.php?id=" + id[2]);
	});
	
	$(".lihat-dataguru").on("mouseover",function(e){
		var id=$(this).attr("id");
		id=id.split("-");
		$("#dialog-lihatguru").load("include/aksi-lihatdata-guru.php?id=" + id[2]);
	});
});
</script>
