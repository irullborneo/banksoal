<div class="panel-group" id="guru-group">
<?php
	$in="in";
	$querysekolah=mysql_query("SELECT id_sekolah, nama_sekolah, id_guru FROM sekolah ORDER BY nama_sekolah ASC");
	while($sekolah=mysql_fetch_array($querysekolah)){
		echo "<div class=\"panel panel-default\">
			<div class=\"panel-heading\">
				<a data-toggle=\"collapse\" data-parent=\"#guru-group\" href=\"#sekolah-$sekolah[0]\"><h3 class=\"sub-header panel-title\">PKBM ".ucwords($sekolah[1])."</h3></a>
			</div>
			
			<div id=\"sekolah-$sekolah[0]\" class=\"panel-collapse collapse $in\">
				<div class=\"panel-body\">
					<ul class=\"nav nav-tabs\">
						<li class=\"active\"><a data-toggle=\"tab\" href=\"#table-tutor-$sekolah[0]\">Tabel Tutor</a></li>
						<li><a data-toggle=\"tab\" href=\"#aktiv-tutor-$sekolah[0]\">Aktivitas Tutor</a></li>
					</ul>
					<div class=\"tab-content\" style=\"margin-top:20px;\">
						<div id=\"table-tutor-$sekolah[0]\" class=\"tab-pane fade in active\">
		";

		echo "
					<table class=\"table table-striped table-hover\">
						<thead>
							<tr>
								<th>NO</th>
								<th>NIP</th>
								<th>NAMA</th>
								<th>L/P</th>
								<th>PENDIDIKAN TERAKHIR</th>
								<th>MATA PELAJARAN</th>
								<th>ALAMAT</th>
							</tr>
						</thead>
						<tbody>
		";
		$queryguru=mysql_query("SELECT id_guru, nip, nama, jenis_kelamin, pendidikan_akhir, alamat FROM guru WHERE id_sekolah='$sekolah[0]' GROUP BY id_guru ORDER BY nama ASC");
		$no=1;
		while($guru=mysql_fetch_array($queryguru)){
			$aktif=mysql_fetch_array(mysql_query("SELECT konfirmasi FROM guru_aktivasi WHERE id_guru='$guru[0]'"));
			if($aktif[0]==0){
				echo "<tr style=\"background-color:#faebcc\">";
			}
			else{
				echo "<tr>";
			}
			echo "
				<td>$no</td>
				<td>$guru[nip]</td>
				<td>$guru[nama]</td>
				<td>".ucwords($guru['jenis_kelamin'])."</td>
				<td>$guru[pendidikan_akhir]</td>
				<td>
			";
			$querymp="SELECT mp.mata_pelajaran FROM paket_pelajaran as pp, mata_pelajaran as mp WHERE pp.id_pelajaran=mp.id_pelajaran AND pp.id_guru='$guru[id_guru]' GROUP BY mp.id_pelajaran ORDER BY mp.mata_pelajaran ASC";
			$banyakmp=mysql_num_rows(mysql_query($querymp));
			if($banyakmp>0){
				echo "<ol type=\"1\">";
				$querymp2=mysql_query($querymp);
				while($mp=mysql_fetch_array($querymp2)){
					echo "<li>$mp[0]</li>";
				}
				echo "</ol>";
			}
			else{
				echo "-";
			}
			echo "
				</td>
				<td>$guru[alamat]</td>
			</tr>
			";
			$no++;
		}
		
		$querytanggung="SELECT nama FROM guru WHERE id_guru='$sekolah[2]'";
		$tanggung=mysql_fetch_array(mysql_query($querytanggung));
		echo "
						</tbody>
					</table>
					<div class=\"row\" style=\"margin-top:20px\">
						<div class=\"col-md-3 col-sm-3\">&nbsp;</div>
						<div class=\"col-md-4 col-sm-4\">&nbsp;</div>
						<div class=\"col-md-5 col-sm-5 text-center\">
							<span style=\"font-weight:bold\">Penanggung Jawab,</span><br /><br />
							$tanggung[0]
						</div>
					</div>
					</div>
					<div id=\"aktiv-tutor-$sekolah[0]\" class=\"tab-pane fade\">
						<h3 class=\"sub-header\">LOG IN</h3>
						<div class=\"row\">
							<div class=\"col-md-7 col-sm-6\">
								<table class=\"table table-striped table-hover\">
									<thead>
										<tr>
											<th>NO</th>
											<th>NAMA</th>
											<th>BANYAK LOGIN</th>
											<th>TERAKHIR LOGIN</th>
										</tr>
									</thead>
									<tbody>
		";
		$bulan=array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		$querylogin=mysql_query("SELECT g.nama, count(g.nama), g.id_guru FROM guru as g, guru_login as gl WHERE g.id_guru=gl.id_guru AND g.id_sekolah='$sekolah[0]' GROUP BY g.id_guru");
		$no=1;
		while($login=mysql_fetch_array($querylogin)){
			$tgl_login=mysql_fetch_array(mysql_query("SELECT tgl_login FROM guru_login WHERE id_guru='$login[2]' ORDER BY id_guru_login DESC limit 1"));
			$tgl=explode(" ",$tgl_login[0]);
			$tgl2=explode("-",$tgl[0]);
			echo "<tr>
				<td>$no</td>
				<td>$login[0]</td>
				<td>$login[1]</td>
				<td>".$tgl2[2]." ".$bulan[intval($tgl2[1])]." $tgl2[0] $tgl[1]</td>
			</tr>
			";
			$no++;
		}
		echo "
									</tbody>
								</table>
							</div>
							<div class=\"col-md-5 col-sm-6\">
								<ul class=\"list-group\">
		";
		$querymasuk=mysql_query("SELECT g.nama, gl.tgl_login FROM guru as g, guru_login as gl WHERE g.id_guru=gl.id_guru AND g.id_sekolah='$sekolah[0]' ORDER BY gl.id_guru_login DESC");
		while($masuk=mysql_fetch_array($querymasuk)){
			$tgl=explode(" ",$masuk[1]);
			$msk=explode("-",$tgl[0]);
			echo "<li class=\"list-group-item\" style=\"cursor:pointer\">
			<h4 class=\"list-group-item-heading\">$masuk[0]</h4>
			<p class=\"list-group-item-text\">".$msk[2]." ".$bulan[intval($msk[1])]." ".$msk[0]." $tgl[1]</p>
			</li>
			";
		}
		echo "
								</ul>
							</div>
						</div>
						<h3 class=\"sub-header\">INPUT DATA</h3>
							<div class=\"row\">
								<div class=\"col-md-4\">
									<h4 class=\"sub-header\">Paket Pelajaran</h4>
									<table class=\"table table-striped table-hover\">
										<thead>
											<tr>
												<th>NAMA</th>
												<th>BANYAK<br />DATA</th>
											</tr>
										</thead>
										<tbody>
		";
		$queryinputpp=mysql_query("SELECT g.id_guru, g.nama, count(pp.penginput) FROM guru as g, paket_pelajaran as pp WHERE g.id_guru=pp.penginput AND g.id_sekolah='$sekolah[0]' GROUP BY pp.penginput");
		while($inputpp=mysql_fetch_array($queryinputpp)){
			echo "<tr>
				<td>$inputpp[1]</td>
				<td>$inputpp[2]</td>
			</tr>
			";
		}
		echo "
										</tbody>
									</table>
								</div>
								
								<div class=\"col-md-4\">
									<h4 class=\"sub-header\">Warga Belajar</h4>
									<table class=\"table table-striped table-hover\">
										<thead>
											<tr>
												<th>NAMA</th>
												<th>BANYAK<br />DATA</th>
											</tr>
										</thead>
										<tbody>
		";
		$queryinputpp=mysql_query("SELECT g.id_guru, g.nama, count(si.id_input) FROM guru as g, siswa as si WHERE g.id_guru=si.id_input AND g.id_sekolah='$sekolah[0]' GROUP BY si.id_input");
		while($inputpp=mysql_fetch_array($queryinputpp)){
			echo "<tr>
				<td>$inputpp[1]</td>
				<td>$inputpp[2]</td>
			</tr>
			";
		}
		echo "
										</tbody>
									</table>
								</div>
								
								<div class=\"col-md-4\">
									<h4 class=\"sub-header\">Soal</h4>
									<table class=\"table table-striped table-hover\">
										<thead>
											<tr>
												<th>NAMA</th>
												<th>BANYAK<br />DATA</th>
											</tr>
										</thead>
										<tbody>
		";
		$queryinputpp=mysql_query("SELECT g.id_guru, g.nama, count(sp.penulis) FROM guru as g, soal_pelajaran as sp WHERE g.id_guru=sp.penulis AND g.id_sekolah='$sekolah[0]' GROUP BY sp.penulis");
		while($inputpp=mysql_fetch_array($queryinputpp)){
			echo "<tr>
				<td>$inputpp[1]</td>
				<td>$inputpp[2]</td>
			</tr>
			";
		}
		echo "
										</tbody>
									</table>
								</div>
							</div>
					</div>
					</div>
				</div>
			</div>
		</div>
		";
		$in="";
	}
?>
</div>
