<?php
	include "../../include/koneksi.php";
	$baris=$_GET['baris'];
	$kolom=$_GET['kolom'];
	$urut=$_GET['urut'];
	$paket=$_GET['paket'];
	$sekolah=$_GET['sekolah'];
	$total=mysql_num_rows(mysql_query("SELECT * FROM siswa"));
	$halaman=ceil($total/$baris);
	$p=abs($_GET['p']);
	
	$awal=($p-1)*$baris;
	
	if($paket=="semua"){
		$paket="";
	}
	else{
		$paket="AND s.id_paket=$paket";
	}
	
	if($sekolah=="semua")
		$sekolah="";
	else $sekolah="AND s.id_sekolah=$sekolah";
	
	$cari=$_GET['cari'];
	if(isset($cari)){
		$cari="AND nama like '%$cari%'";
	}
	
	$querysiswa=mysql_query("SELECT s.id_siswa, s.nama, s.username, s.password, p.paket, se.nama_sekolah, s.jenis_kelamin FROM siswa as s, paket as p, sekolah as se WHERE s.id_paket=p.id_paket AND s.id_sekolah=se.id_sekolah $paket $sekolah $cari ORDER BY s.$kolom $urut limit $awal,$baris" );
	while($siswa=mysql_fetch_array($querysiswa)){
		if($siswa[6]=="l") $jk="Laki-Laki";
		else $jk="Perempuan";
		echo "<tr id=\"baris-siswa-$siswa[0]\">
		<td><input type='checkbox' name='checkbox-body' class='checkbox cbbody' value='$siswa[0]' /></td>
		<td>$siswa[0]</td>
		<td>$siswa[1]</td>
		<td>$jk</td>
		<td>$siswa[4]</td>
		<td>$siswa[5]</td>
		<td>$siswa[2]</td>
		<td>$siswa[3]</td>
		<td>
    		<div class=\"row\" style=\"margin:0; padding:0;\">
       			<div class=\"col-xs-4\"><img src=\"../img/DeleteRed.png\" style=\"width:15px; height:15px; cursor:pointer\" alt=\"Hapus\" title=\"Hapus\" class=\"hapus-icon\" id='hapus-siswa-$siswa[0]' data-toggle=\"modal\" data-target=\"#hapus-data\" /></div>
          		<div class=\"col-xs-4\"><img src=\"../img/file_edit.png\" style=\"width:15px; height:15px; cursor:pointer\" alt=\"Edit\" title=\"Edit\" class=\"edit-icon\" id='edit-siswa-$siswa[0]' data-toggle=\"modal\" data-target=\"#form-edit-data\"  /></div>
           		<div class=\"col-xs-4\"><img src=\"../img/view.png\" style=\"width:15px; height:15px; cursor:pointer\" alt=\"Lihat\" title=\"Lihat\" class=\"lihat-icon\" id='lihat-siswa-$siswa[0]' data-toggle=\"modal\" data-target=\"#form-lihat-data\"/></div>    
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
		$("#tmpat-editsiswa").load("include/aksi-editdata-siswa.php?id=" + id[2]);
	});
	$(".lihat-icon").on("mouseover",function(e){
		var id=$(this).attr("id");
		id=id.split("-");
		$("#tmpat-lihatsiswa").load("include/aksi-lihatdata-siswa.php?id=" + id[2]);
	});
	$(".hapus-icon").on("mouseover",function(e){
		var id=$(this).attr("id");
		id=id.split("-");
		$("#tmpat-hapussiswa").load("include/aksi-hapusdata-siswa.php?id=" + id[2]);
	});
    
});
</script>