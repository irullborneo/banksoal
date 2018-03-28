<script type="text/javascript">
$(document).ready(function(e) {
	$(".loading-siswa").hide();
    $(".lihat-siswa").click(function(e) {
       var id= $(this).attr("id");
	   var identity=id.split("-");
	   $("#loadingsiswa-"+identity[1]+"-"+identity[2]).show();
	   $.ajax({
		   type:"POST",
		   data:"id="+id,
		   url:"include/aksi-lihatdata-siswa2.php?aksi=lihatsemua",
		   success: function(response){
			   if(response!=""){
				   $("#tabel-"+identity[1]+"-"+identity[2]).html(response);
				   $("#siswa-"+identity[1]+"-"+identity[2]).hide();
				   $("#kembali-"+identity[1]+"-"+identity[2]).show();
				   $(".loading-siswa").hide();
			   }
			   else{
				   alert("Gagal Memuat data");
			   }
		   }
	   })
    });
	
	$(".kembali-siswa").click(function(e) {
         var id= $(this).attr("id");
		 var identity=id.split("-");
		 $("#loadingsiswa-"+identity[1]+"-"+identity[2]).show();
		 $.ajax({
		   type:"POST",
		   data:"id="+id,
		   url:"include/aksi-lihatdata-siswa2.php?aksi=kembali",
		   success: function(response){
			   if(response!=""){
				   $("#tabel-"+identity[1]+"-"+identity[2]).html(response);
				   $("#siswa-"+identity[1]+"-"+identity[2]).show();
				   $("#kembali-"+identity[1]+"-"+identity[2]).hide();
				   $(".loading-siswa").hide();
			   }
			   else{
				   alert("Gagal Memuat data");
			   }
		   }
	   })
    });
});
</script>
<?php
	$total=totalbadge("siswa");
	$bulan=array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
	if($total>0){
		$querytglsiswabadge=mysql_query("SELECT tgl_input FROM siswa WHERE lihat='0000-00-00' GROUP BY tgl_input");
		echo "<div class=\"panel panel-success\" style=\"cursor:pointer\" data-toggle=\"modal\" data-target=\"#lihat-badge-paketpelajaran\" >
			<div class=\"panel-heading\">PEMBERITAHUAN</div>
   			<div class=\"panel-body\">$total data telah ditambahkan di Paket Pelajaran pada ";
		$koma=false;
		while($tglsiswabadge=mysql_fetch_array($querytglsiswabadge)){
			if($koma) echo ", ";
			$tglsiswa=explode("-",$tglsiswabadge[0]);
			echo $tglsiswa[2] ." ". $bulan[$tglsiswa[1]] ." ". $tglsiswa[0];
			$koma=true;
		}
		echo "</div>
		</div>
		<div class=\"modal fade\" id=\"lihat-badge-paketpelajaran\" role=\"dialog\">
			<div class=\"modal-dialog modal-lg\">
	    		<div class=\"modal-content\">
	  	  			<div class=\"modal-header\">
	          			<button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
	          			<h4 class=\"modal-title\">PEMBERITAHUAN</h4>
          			</div>
          			<div class=\"modal-body\">
					<div class=\"container-fluid\">
						
		";
		$querybadgetgl=mysql_query("SELECT tgl_input FROM siswa WHERE lihat='0000-00-00' GROUP BY tgl_input");
		while($badgetgl=mysql_fetch_array($querybadgetgl)){
			$tglb=explode("-",$badgetgl[0]);
			echo "<h4 class=\"sub-header\">$tglb[2] ".$bulan[$tglb[1]] ." $tglb[0]</h4>";
			echo "<table class=\"table table-striped table-bordered\">
				<thead>
					<tr>
						<th>#</th>
						<th>NAMA</th>
						<th>Jenis Kelamin</th>
						<th>PAKET</th>
						<th>USERNAME</th>
						<th>PASSWORD</th>
						<th>SEKOLAH</th>
						<th>PENGINPUT</th>
					</tr>
				</thead>
				<tbody>";
			$querybadge=mysql_query("SELECT s.id_siswa, s.nama, s.jenis_kelamin, p.paket, s.username, s.password, sk.nama_sekolah, s.id_input FROM siswa as s, paket as p, sekolah as sk WHERE s.id_paket=p.id_paket AND s.id_sekolah=sk.id_sekolah AND tgl_input='$badgetgl[0]' AND lihat='0000-00-00'");
			while($badge=mysql_fetch_array($querybadge)){
				if($badge[2]=="l") $jk="Laki-Laki";
				else $jk="Perempuan";
				echo "<tr>
					<td>$badge[0]</td>
					<td>$badge[1]</td>
					<td>$jk</td>
					<td>$badge[3]</td>
					<td>$badge[4]</td>
					<td>$badge[5]</td>
					<td>$badge[6]</td>
					<td>";
					$penginput=mysql_fetch_array(mysql_query("SELECT nama FROM guru WHERE id_guru=$badge[7]"));
					echo $penginput[0];
				echo "</td>
				</tr>";
			}
			echo "</tbody></table>";
		}
		echo "
					</div>
    	      		</div>
				</div>
			</div>
		</div>";
	}
	
	$querycaritanggalpp=mysql_query("SELECT tgl_input FROM siswa WHERE id_input='$admin[id_guru]' GROUP BY tgl_input ORDER BY tgl_input DESC");
	$caritanggalpp=mysql_fetch_array($querycaritanggalpp);
	$banyakdata=mysql_num_rows(mysql_query("SELECT * FROM siswa WHERE id_input='$admin[id_guru]' AND tgl_input='$caritanggalpp[0]'"));
	$tglinputpp=explode("-",$caritanggalpp[0]);
	echo "<div class=\"panel panel-info\">
	<div class=\"panel-heading\">INFO</div>
    <div class=\"panel-body\">
	";
	if($banyakdata>0){ 
		echo "Anda telah menambahkan $banyakdata data terakhir kali pada ".$tglinputpp[2] ." ". $bulan[$tglinputpp[1]] ." ". $tglinputpp[0];
		
	}
	else {
		echo "Anda belum menambahkan data. ";
	}
	echo "
	<br /><hr />
	<a href=\"cetak/cetak-form-siswa.php?print=yes\" target=\"_blank\" class=\"btn btn-primary\" id=\"btn-cetakformulir-siswa\">Cetak</a> Formulir untuk data siswa
	</div>
</div>

	<div class=\"panel-group\" id=\"siswa-group\">
	";
	
	$in="in";
	$querysekolah=mysql_query("SELECT sk.nama_sekolah, s.id_sekolah FROM siswa as s, sekolah as sk WHERE s.id_sekolah=sk.id_sekolah GROUP BY s.id_sekolah ORDER BY sk.nama_sekolah");
	while($sekolah=mysql_fetch_array($querysekolah)){
		echo "<div class=\"panel panel-default\">
    			<div class=\"panel-heading\">
					<a data-toggle=\"collapse\" data-parent=\"#siswa-group\" href=\"#sekolah-$sekolah[1]\"><h3 class=\"sub-header panel-title\">PKBM ".ucwords($sekolah[0])."</h3></a>
				</div>
				<div id=\"sekolah-$sekolah[1]\" class=\"panel-collapse collapse $in\">
					<div class=\"panel-body\">
						
						<div class=\"row\">
		";
		$in="";
		$querypaket=mysql_query("SELECT p.paket, s.id_paket FROM siswa as s, paket as p WHERE s.id_paket=p.id_paket AND s.id_sekolah='$sekolah[1]' GROUP BY s.id_paket");
		while($paket=mysql_fetch_array($querypaket)){
			echo "<div class=\"col-sm-6\">
				<h4 class=\"sub-header\">PAKET $paket[0] <img src=\"../img/loading.gif\" style='width:20px; height:20px' class='loading-siswa' id='loadingsiswa-$paket[1]-$sekolah[1]' /></h4>
				<table class=\"table table-striped table-hover\">
					<thead>
						<tr>
							<th>#</th>
							<th>NAMA</th>
							<th>JENIS KELAMIN</th>
							<th>USIA</th>
						</tr>
					</thead>
					<tbody  id=\"tabel-$paket[1]-$sekolah[1]\">
			";
			$querysiswa=mysql_query("SELECT id_siswa, nama, jenis_kelamin, tanggal_lahir FROM siswa WHERE id_paket=$paket[1] AND id_sekolah=$sekolah[1] ORDER BY id_siswa DESC limit 5");
			while($siswa=mysql_fetch_array($querysiswa)){
				if($siswa[2]=="l") $jk="Laki-Laki";
				else $jk="Perempuan";
				
				$tgl_lahir=explode("-",$siswa[3]);
				$usia=date("Y") - $tgl_lahir[0];
				
				echo "<tr>
					<td>$siswa[0]</td>
					<td>$siswa[1]</td>
					<td>$jk</td>
					<td>$usia</td>
					
				</tr>";
			}
			echo "
					</tbody>
				</table>
			";
			$banyaksiswa=mysql_num_rows(mysql_query("SELECT id_siswa, nama, jenis_kelamin, tanggal_lahir FROM siswa WHERE id_paket=$paket[1] AND id_sekolah=$sekolah[1] ORDER BY id_siswa DESC"));
			echo "Ada $banyaksiswa data siswa<br /><br />";
			if($banyaksiswa>5){
				echo "<button type=\"button\" class=\"btn btn-primary lihat-siswa\" id='siswa-$paket[1]-$sekolah[1]'>Lihat Semua</button>
				<button type=\"button\" class=\"btn btn-primary kembali-siswa\" id=\"kembali-$paket[1]-$sekolah[1]\" style=\"display:none\">Kembali</button>
				";
			}
			echo "
			</div>
			";
		}
		
		echo "
			</div></div></div></div>
		";
		
	}
?>
</div>

