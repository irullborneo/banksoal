<?php
	$total=totalbadge("soal_pelajaran");
	if($total>0){
		$querytglppbadge=mysql_query("SELECT tgl_input FROM soal_pelajaran WHERE lihat='0000-00-00' GROUP BY tgl_input");
		echo "
			<div class=\"panel panel-success\" style=\"cursor:pointer\" id=\"notice-soal\" >
				<div class=\"panel-heading\">PEMBERITAHUAN</div>
				<div class=\"panel-body\"><a href=\"?p=data_soal\">$total soal telah dibuat</a></div>
			</div>
		";
	}
	$bulan=array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
	$querycaritanggalu=mysql_query("SELECT tgl_input FROM soal_pelajaran WHERE penulis='$admin[id_guru]' GROUP BY tgl_input ORDER BY tgl_input DESC");
	$caritanggalu=mysql_fetch_array($querycaritanggalu);
	$banyakdata=mysql_num_rows(mysql_query("SELECT * FROM soal_pelajaran WHERE penulis='$admin[id_guru]' AND tgl_input='$caritanggalu[0]'"));
	$tglinputu=explode("-",$caritanggalu[0]);
	echo "<div class=\"panel panel-info\">
	<div class=\"panel-heading\">INFO</div>
    <div class=\"panel-body\">
	";
	if($banyakdata>0){ 
		echo "Anda telah menambahkan $banyakdata data terakhir kali pada ".$tglinputu[2] ." ". $bulan[$tglinputu[1]] ." ". $tglinputu[0];
		
	}
	else {
		echo "Anda belum menambahkan data. ";
	}
	echo "
	</div>
</div>
	
	
	<div class=\"panel-group\" id=\"sekolah-group\">
	";
	$in="in";
	$querysekolah=mysql_query("SELECT pp.id_pelajaran, mp.mata_pelajaran, pp.id_paket_pelajaran FROM soal_pelajaran as sp, paket_pelajaran as pp, mata_pelajaran as mp WHERE sp.id_paket_pelajaran=pp.id_paket_pelajaran AND pp.id_pelajaran=mp.id_pelajaran GROUP BY pp.id_pelajaran ORDER BY mp.mata_pelajaran ASC");
	while($sekolah=mysql_fetch_array($querysekolah)){
		echo "<div class=\"panel panel-default\">
			<div class=\"panel-heading\">
				<a data-toggle=\"collapse\" data-parent=\"#sekolah-group\" href=\"#sekolah-$sekolah[0]\"><h3 class=\"sub-header panel-title\">".ucwords($sekolah[1])."</h3></a>
			</div>
			
			<div id=\"sekolah-$sekolah[0]\" class=\"panel-collapse collapse $in\">
				<div class=\"panel-body\">
					<div class=\"row\">
		";
		$in="";
		$querypaket=mysql_query("SELECT p.id_paket, p.paket FROM paket as p, paket_pelajaran as pp WHERE p.id_paket=pp.id_paket AND pp.id_paket_pelajaran=$sekolah[2] GROUP BY p.id_paket ORDER by p.id_paket ASC");
		while($paket=mysql_fetch_array($querypaket)){
			echo "<div class=\"col-sm-4\">
				<div class=\"panel panel-success\">
					<div class=\"panel-heading\">
						<h3 class=\"panel-title\">PAKET $paket[1]</h3>
					</div>
					<div class=\"panel-body\">
						<ol type='1' style=\"margin:0 0 0 15px; padding:0\">
			";
			$querysoal=mysql_query("SELECT sp.id_soal_pelajaran FROM soal_pelajaran as sp, paket_pelajaran as pp WHERE sp.id_paket_pelajaran=pp.id_paket_pelajaran AND pp.id_paket_pelajaran='$sekolah[2]' ORDER BY sp.id_soal_pelajaran");
			while($soal=mysql_fetch_array($querysoal)){
				$banyaksoal=mysql_num_rows(mysql_query("SELECT * FROM soal WHERE id_soal_pelajaran='$soal[0]'"));
				echo "<li><a href=\"./?p=data_soal&edit=$soal[0]\">$banyaksoal Soal</a></li>
				";
			}
			echo "
						</ol>
					</div>
				</div>

			</div>
			";
		}
		echo "
					</div>
				</div>
			</div>
			
		</div>
		";
	}
	echo "
	</div>
	";

?>