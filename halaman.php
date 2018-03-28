<?php
	include "include/koneksi.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Soal | Bank Soal Sistem Kolaborasi Kurkulum 2013</title>
<link rel="shortcut icon" href="img/icon.png" />
<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.10.4.custom.css" />
<link rel="stylesheet" type="text/css" href="css/style-halaman.css" />
<script type="text/javascript" src="jquery/jquery-2.0.2.js"></script>
<script type="text/javascript" src="jquery/bootstrap.js"></script>
<script type="text/javascript" src="jquery/jquery-ui-1.10.4.custom.js"></script>
</head>
<?php
error_reporting(0);
	session_start();
	if(isset($_SESSION['untuk'])){
?>
<script type="text/javascript">
	$(document).ready(function(e) {
		$("#tempat-nomor-soal").load("include/nomor-soal.php");
		$("#soal-ulangan").load("include/soal.php?no=1",function(e) {
            $("#loading").fadeOut("fast");
        });
		var detik = $("#waktu-detik").html();
       	var menit = $("#waktu-menit").html();
       	var jam = $("#waktu-jam").html();
		function hitung() {
          	/** setTimout(hitung, 1000) digunakan untuk 
	   		*  mengulang atau merefresh halaman selama 1000 (1 detik) */
	   		setTimeout(hitung,1000);
 
		  	/** Menampilkan Waktu Timer pada Tag #Timer di HTML yang tersedia */
			if(jam<1) $('#waktu-sisa').html( menit + ':' + detik);
		   	else $('#waktu-sisa').html( jam + ':' + menit + ':' + detik);
 
		  	/** Melakukan Hitung Mundur dengan Mengurangi variabel detik - 1 */
		   	detik --;
 
		  /** Jika var detik < 0
		   *  var detik akan dikembalikan ke 59
		   *  Menit akan Berkurang 1
		   */
		   if(detik < 0) {
		      detik = 59;
		      menit --;
 
		      /** Jika menit < 0
		       *  Maka menit akan dikembali ke 59
		       *  Jam akan Berkurang 1
		       */
		       if(menit < 0) {
 			 	 menit = 59;
			  		jam --;
 
		  		/** Jika var jam < 0
		   		*  clearInterval() Memberhentikan Interval 
		   		*  Dan Halaman akan membuka http://tahukahkau.com/
		   		*/
		   			if(jam < 0) { 
                      	clearInterval();
 		      			window.location="./nilai.php";
                   }
	       		}
	   		} 		
        }
 		/** Menjalankan Function Hitung Waktu Mundur */
        hitung();
    });
	
	function pilih(ini){
		var no = ini.name.split("-");
		var jawab= ini.value;
		$.ajax({
			type:"POST",
			data:"jawab="+jawab+"&nomer="+no[1],
			url:"include/kirim.php?kirim=jawab",
			success: function(response){
				$("#tempat-nomor-soal").load("include/nomor-soal.php");
			}
		});
	}
</script>
<?php 
	}
?>
<script type="text/javascript">
$(document).ready(function(e) {
    $(".list-group-item").click(function(e) {
		var id=$(this).attr("id");
		id=id.split("-");
		$(".list-item-"+id[2]).removeClass("active");
		$(this).addClass("active");
		$("#tempat-listpelajaran-"+id[2]).load("include/tampil-list-soalpelajaran.php?id="+ $(this).attr("id"));
    });
	
	$(".list-soalpelajaran").click(function(e) {
        var id=$(this).attr("id");
		id=id.split("-");
		if(id[2]>0){
			var datakirim={
				i:id[1],
				u:id[3]
			};
			$.ajax({
				type:"POST",
				data:datakirim,
				url:"include/tentukan-soal.php",
				success: function(response){
					window.location="./";
				}
				
			});
		}
		else{
			alert("Tidak ada soal pada mata pelajaran ini");
		}
    });
			
		$("#ujian-btn").click(function(e) {
            window.location="./login.php";
        });
		
		$("#keluar-btn").click(function(e) {
            window.location="logout.php";
        });

});
</script>
<body>
    
	<nav id="theme-header" class="navbar navbar-default navbar-fixed-top" role="navigation">
    	<div class="container">
        	<div class="navbar-header">
            	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                	<?php
						if(isset($_SESSION['ujian'])){
							$waktu=mysql_fetch_array(mysql_query("SELECT * FROM ujian WHERE id_ujian='$_SESSION[ujian]'"));
							$jam=intval(floor($waktu['waktu']/60));
							$menit=$waktu['waktu']%60;
							echo "<span class=\"sr-only\">Toggle navigation<div id=\"waktu-jam\">$jam</div><div id=\"waktu-menit\">$menit</div><div id=\"waktu-detik\">00</div></span>
							";
						}
						else{
							echo "<span class=\"sr-only\">Toggle navigation<div id=\"waktu-jam\">1</div><div id=\"waktu-menit\">30</div><div id=\"waktu-detik\">00</div></span>
							";
						}
					?>
            		<span class="sr-only">Toggle navigation<div id="waktu-jam">1</div><div id="waktu-menit">30</div><div id="waktu-detik">00</div></span>
            		<span class="icon-bar"></span>
            		<span class="icon-bar"></span>
            		<span class="icon-bar"></span>
          		</button>
                <?php
					if(isset($_SESSION['id_siswa']) && isset($_SESSION['paket'])){
						$siswa=mysql_fetch_array(mysql_query("SELECT * FROM siswa WHERE id_siswa='$_SESSION[id_siswa]'"));
						echo "<a class=\"navbar-brand\" style=\"color:#FFF\" href=\"#\">".ucwords($siswa['nama'])."</a>";
					}
					else{
						echo "<a class=\"navbar-brand\" style=\"color:#FFF\" href=\"#\">Bank Soal Sistem Kolaborasi Kurkulum 2013</a>";
					}
				?>
            </div>
            <div style="position:absolute; left:50%">
            	<ul class="nav navbar-nav">
                	<li><a href="#" id="waktu-sisa"></a> <img id="loading" src="img/loading.gif" id="loading" style="display:none" /></li>
                </ul>
                
            </div>
            <div id="navbar" class="navbar-collapse collapse">
            	<ul class="nav navbar-nav navbar-right">
                	<?php
						if(isset($_SESSION['id_siswa']) && isset($_SESSION['paket']) && empty($_SESSION['untuk'])){
							echo "<li><a><span id=\"keluar-btn\" class=\"btn btn-danger\">Keluar</span></a></li>";
						}
						else if(isset($_SESSION['untuk'])){
							echo "<li><a><span id=\"selesai-btn\" data-toggle=\"modal\" data-target=\"#dialog-selesai\" class=\"btn btn-primary\">Selesai</span></a></li>";
						}
						else{
							
					?>
            		<li id="ujian-btn" ><a><span class="btn btn-primary">Ujian</span></a></li>
                    <?php
						}
					?>
          		</ul>
            </div> 
        </div>
    </nav>
<div class="container-fluid">
	<?php
		if(isset($_SESSION['untuk'])){
			echo "<div id=\"soal-ulangan\"></div>
			<div id=\"tempat-nomor-soal\" class=\"nomer-soal\"></div>
			
			<div class=\"modal fade\" id=\"dialog-selesai\" role=\"dialog\">
				<div class=\"modal-dialog\">
	    			<div class=\"modal-content\">
	  	  				<div class=\"modal-header\">
	          				<button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
	          					<h4 class=\"modal-title\">Selesai</h4>
          					</div>
          				<div class=\"modal-body\">
          					<div class=\"container-fluid\">
            				Selesai Mengerjakan ?
            				</div>
          				</div>
          				<div class=\"modal-footer\">
          					<a href=\"./nilai.php\" class=\"btn btn-primary\" id=\"btn-tambah-paket\">Selesai</a>
          				</div>
					</div>
				</div>
			</div>
			
			";
		}
		else if(isset($_SESSION['id_siswa']) && isset($_SESSION['paket'])){
			echo "<h1 class=\"page-header\">Pilih Mata Pelajaran</h1>";
			$hari=date("Y-m-d");
			$querysoal=mysql_query("SELECT sp.id_soal_pelajaran, mp.mata_pelajaran, sp.tgl_input, u.id_ujian FROM soal_pelajaran as sp, paket_pelajaran as pp, mata_pelajaran as mp, ujian as u WHERE u.id_soal_pelajaran=sp.id_soal_pelajaran AND sp.id_paket_pelajaran=pp.id_paket_pelajaran AND pp.id_pelajaran=mp.id_pelajaran AND pp.id_paket='$_SESSION[paket]' AND sp.untuk='ujian' AND u.jadwal_ujian like '%$hari%' AND u.diujikan='1'");
			$banyaksoal=mysql_num_rows($querysoal);
			$wa=0;
			if($banyaksoal>0){
				echo "<div class=\"row\">";
				
				while($soal=mysql_fetch_array($querysoal)){
					$bnyknilai=mysql_num_rows(mysql_query("SELECT * FROM nilai WHERE id_siswa='$_SESSION[id_siswa]' AND id_ujian='$soal[3]'"));
					if($bnyknilai<1){
						$banyks=mysql_num_rows(mysql_query("SELECT * FROM soal WHERE id_soal_pelajaran='$soal[0]'"));
						echo "<div class=\"col-lg-1 col-md-2 col-sm-2 col-xs-2 text-center navbar-text list-soalpelajaran\" style=\"margin-bottom:20px; cursor:pointer\" id=\"soal-$soal[0]-$banyks-$soal[3]\">
							<img src=\"img/soal.jpg\" class=\"img img-responsive\" /><span style='font-size:12px'>".date("d/m/Y", strtotime($soal[2]))."<br/>".ucwords($soal[1])."</span>
						</div>
						";
						$wa++;
					}
					
				}
				echo "</div>";
			}
			else if($wa<1){
				echo "<div class=\"alert alert-warning\">Soal tidak tersedia </div>";
			}
			else{
				echo "<div class=\"alert alert-warning\">Soal tidak tersedia</div>";
			}
		}
		else{
	?>
	<ul class="nav nav-tabs">
    	<?php
			$querypaket=mysql_query("SELECT id_paket, paket FROM paket ORDER BY id_paket ASC");
			$aktif="class=\"active\"";
			while($paket=mysql_fetch_array($querypaket)){
				echo "<li $aktif ><a data-toggle=\"tab\" href=\"#paket-$paket[0]\">Paket $paket[1]</a></li>";
				$aktif="";
			}
		?>
    </ul>
    <div class="tab-content">
    	<?php
			$queryp=mysql_query("SELECT id_paket, paket FROM paket ORDER BY id_paket ASC");
			$aktif="active";
			while($p=mysql_fetch_array($queryp)){
				echo "<div id=\"paket-$p[0]\" class=\"tab-pane fade in $aktif \">
					<div class=\"row\" style=\"margin-top:20px\">
						<div class=\"col-lg-2 col-md-3 col-sm-4 col-xs-5 pre-scrollable\">
							<ul class=\"list-group\">
								<li class=\"list-group-item list-item-$p[0] active\" id=\"matapelajaran-semua-$p[0]\" style=\"cursor:pointer\">Semua</li>
				";
				$querymp=mysql_query("SELECT id_pelajaran, mata_pelajaran FROM mata_pelajaran ORDER by mata_pelajaran ASC");
				while($mp=mysql_fetch_array($querymp)){
					echo "<li class=\"list-group-item list-item-$p[0]\" id=\"matapelajaran-$mp[0]-$p[0]\" style=\"cursor:pointer\">$mp[1]</li>";
				}
				echo "
							</ul>
						</div>
						<div class=\"col-lg-10 col-md-9 col-sm-8\" id=\"tempat-listpelajaran-$p[0]\">
							
				";
				$querysoal=mysql_query("SELECT sp.id_soal_pelajaran, mp.mata_pelajaran, sp.tgl_input FROM soal_pelajaran as sp, paket_pelajaran as pp, mata_pelajaran as mp WHERE sp.id_paket_pelajaran=pp.id_paket_pelajaran AND pp.id_pelajaran=mp.id_pelajaran AND pp.id_paket='$p[0]' AND sp.untuk='latihan' ORDER BY sp.tgl_input DESC");
				$banyaksoal=mysql_num_rows($querysoal);
				if($banyaksoal>0){
					echo "<div class=\"row\">";
					while($soal=mysql_fetch_array($querysoal)){
						$banyks=mysql_num_rows(mysql_query("SELECT * FROM soal WHERE id_soal_pelajaran='$soal[0]'"));
						echo "<div class=\"col-lg-1 col-md-2 col-sm-2 col-xs-2 text-center navbar-text list-soalpelajaran\" style=\"margin-bottom:20px; cursor:pointer\" id=\"soal-$soal[0]-$banyks\">
							<img src=\"img/soal.jpg\" class=\"img img-responsive\" /><span style='font-size:12px'>".date("d/m/Y", strtotime($soal[2]))."<br/>".ucwords($soal[1])."</span>
						</div>
						";
					}
					echo "</div>";
				}
				else{
					echo "<div class=\"alert alert-warning\">Soal tidak tersedia</div>";
				}
				echo "
						</div>
					</div>
				</div>
				";
				$aktif="";
			}
		?>
    </div>
    <?php
		}
	?>
</div>
</body>
</html>