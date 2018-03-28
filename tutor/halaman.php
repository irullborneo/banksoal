<?php
	session_start();
	if(empty($_SESSION['id_admin'])){
		header ("location: ./login.php");
	}
	include "../include/koneksi.php";
	$queryadmin=mysql_query("SELECT * FROM guru WHERE id_guru='$_SESSION[id_admin]'");
	$admin=mysql_fetch_array($queryadmin);
	if($admin['sebagai']=="guru"){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tutor <?php echo $admin['nama']; ?> | Bank Soal Sistem Kolaborasi Kurkulum 2013</title>
<link rel="shortcut icon" href="../img/icon.png" />
<link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="../css/jquery-ui-1.10.4.custom.css" />
<link rel="stylesheet" type="text/css" href="css/halaman-style-admin.css" />
<link rel="stylesheet" type="text/css" href="css/eventCalendar.css" />
<link rel="stylesheet" type="text/css" href="css/eventCalendar_theme_responsive.css" />
<script type="text/javascript" src="../jquery/jquery-2.0.2.js"></script>
<script type="text/javascript" src="../jquery/bootstrap.js"></script>
<script type="text/javascript" src="../jquery/jquery-ui-1.10.4.custom.js"></script>
<script type="text/javascript" src="../jquery/jquery.form.js"></script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="../jquery/jquery.eventCalendar.js"></script>
</head>
<script>
function get(property){
var url=window.location.search;
  url=url.substring(1).split('&');
  for(var i=0;i < url.length;i++){
    var data=url[i].split('=');
    if(data[0] == property){
      return data[1];
    }
  }
}
$(document).ready(function(e) {
	$(".hapus-icon").on("click",function(e){
		bootbox.confirm("Hapus data ?", function(hasil){
		});
	});
	
	
	$(".edit-icon").on("click",function(e){
		bootbox.dialog({
			title: "Edit Data Siswa",
			size:"large",
			message: $("#form-edit").html(),
			buttons : {
				success: {
					label : "Simpan",
					callback: function(){
					}
				}
			}
		});
	});
	
	$("#import-data-siswa").on("click",function(e){
		window.location="./?p=import_siswa";
	});
	
	$("#tambah-data-btn").on("click",function(e){
		bootbox.dialog({
			title: "Edit Data Siswa",
			size:"large",
			message: $("#form-tambah-data").html(),
			buttons : {
				success: {
					label : "Simpan",
					callback: function(){
					}
				}
			}
		});
	});
	
	$("#cari").on("keyup",function(e){
		switch(get('p')){
			case 'data_siswa' :
				$("#table-siswa").load("include/tabel-siswa.php?baris=" + $("#banyak-baris-tampil").val() + "&kolom=" + $("#kolom-tampil").val() + "&urut=" + $("#naikturun-tampil").val() + "&paket=" + $("#paket-tampil").val() + "&p=1&cari=" + $("#cari").val() + "&sekolah=" + $("#sekolah-tampil").val());
				$("#tmpat-paging-tblsiswa").load("include/paging-tabel-siswa.php?p=1&baris=" + $("#banyak-baris-tampil").val() + "&paket=" + $("#paket-tampil").val() + "&cari=" + $("#cari").val() + "&sekolah=" + $("#sekolah-tampil").val());
				break;
			case 'data_guru' :
				var baris=$("#banyak-baris-tampil").val();
				var kolom=$("#kolom-tampil").val();
				var urut=$("#naikturun-tampil").val();
				var pilihkolom=$("#kolom-guru").val();
				var selectkolom=$("#select-pilih-guru").val();
				var strselectkolom="";
				var strp="";
				var cari=$("#cari").val();
				if(pilihkolom!="semua"){
					strselectkolom="&selectkolom=" + selectkolom;
				}
				
				var lin="?baris=" + baris + "&kolom=" + kolom + "&urut=" + urut + "&pilihkolom=" + pilihkolom +""+ strselectkolom +"&cari="+ cari;
				$("#tabel-guru").load("include/tabel-guru.php" + lin);
				$("#tmpat-paging-tblguru").load("include/paging-tabel-guru.php" + lin);
				break;
		}
	});
	
});
</script>

<body data-spy="scroll" data-target="#myScrollspy">
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Tutor <?php echo $admin['nama']; ?> | Bank Soal</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
        	<ul class="nav navbar-nav navbar-right">
        	<?php
				$querymenu=mysql_query("SELECT menu, link FROM menu WHERE (login='semua' OR login='guru') AND tempat='atas' ORDER BY level ASC");
				$pagenow=$_GET['p'];
				if(empty($pagenow)) $pagenow="./";
				while($menu1=mysql_fetch_array($querymenu)){
					$menu=explode("-",$menu1['menu']);
					$link=explode("-",$menu1['link']);
					for($i=0;$i<count($menu);$i++){
						if($link[$i]=="?p=" . $pagenow || $link[$i]==$pagenow)
							echo "<li><a href='#' class='aktif-menu'>$menu[$i]</a></li>";
						else
							echo "<li><a href='$link[$i]'>$menu[$i]</a></li>";
					}
				}
			?>
          	</ul>
            <?php
				if($_GET['p']=="data_guru" || $_GET['p']=="data_siswa"){
					echo "<form class=\"navbar-form navbar-right\">
            			<input type=\"text\" class=\"form-control\" id=\"cari\" placeholder=\"Cari...\">
          			</form>
					";
				}
			?>
          
        </div>
      </div>
    </nav>
    
    <div class="container-fluid">
    	<div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
        	<?php
				include "include/function.php";
				
				$querymenu2=mysql_query("SELECT menu, link FROM menu WHERE (login='semua' OR login='guru') AND tempat='bawah' ORDER BY level ASC");
				while($menu2=mysql_fetch_array($querymenu2)){
					$menu=explode("-",$menu2['menu']);
					$link=explode("-",$menu2['link']);
					echo "<ul class='nav nav-sidebar'>";
					for($i=0;$i<count($menu);$i++){
						if($link[$i]=="?p=".$pagenow || $link[$i]==$pagenow){
							echo "<li class='active'><a href='#'>$menu[$i]";
							
							
							echo "</a></li>";
						}
						else{
							echo "<li><a href='$link[$i]'>$menu[$i]
							";
							
							
							echo "</a></li>";
						}
					}
					echo "</ul>";
				}
			?>
        </div>
        
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <?php require "include/body-isi.php";
			?>
        </div>
    </div>
</body>
</html>
<?php
	}
?>