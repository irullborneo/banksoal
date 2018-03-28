<script type="text/javascript">
$(document).ready(function(e) {
	$(".hapus-icon-nilai").mouseover(function(e) {
        var id=$(this).attr("id");
		id=id.split("-");
		$("#tempat-hapusdata-nilai").load("include/aksi-hapusdata-nilai.php?id="+id[2]);
    });
	
	$(".btn-cetak-nilai").mouseover(function(e) {
        var id=$(this).attr("id");
		id=id.split("-");
		var mp=id[3];
		var sekolah=id[2];
		var ujian=id[1];
		var data=ujian +"-"+ sekolah +"-"+ mp;
		$("#tempat-cetak-nilai").load("include/aksi-cetakdata-nilai.php?data="+ data);
    });
});
</script>
<?php
	include "../../include/koneksi.php";
	$id=$_GET['id'];
	session_start();
	$queryadmin=mysql_query("SELECT * FROM guru WHERE id_guru='$_SESSION[id_admin]'");
	$admin=mysql_fetch_array($queryadmin);
	
	echo "<ul class=\"nav nav-tabs\">
		<li class=\"active\"><a data-toggle=\"tab\" href=\"#matapelajaran\">Mata Pelajaran</a></li>
		<li><a data-toggle=\"tab\" href=\"#wargabelajar\">Warga Belajar</a></li>
	</ul>
	
	<div class=\"tab-content\">
		<div id=\"matapelajaran\" class=\"tab-pane fade in active\">
		<div class=\"panel-group\" id=\"matapelajaran-group\">
	";
	$in="in";
	$queryheadmp=mysql_query("SELECT mp.id_pelajaran, mp.mata_pelajaran FROM nilai as n, ujian as u, soal_pelajaran as sp, paket_pelajaran as pp, mata_pelajaran as mp, guru as g WHERE n.id_ujian=u.id_ujian AND u.id_soal_pelajaran=sp.id_soal_pelajaran AND sp.id_paket_pelajaran=pp.id_paket_pelajaran AND pp.id_pelajaran=mp.id_pelajaran AND u.id_jadwal_ujian='$id' AND pp.id_guru=g.id_guru AND g.id_guru='$admin[id_guru]' GROUP BY mp.id_pelajaran ORDER BY mp.mata_pelajaran ASC");
	while($headmp=mysql_fetch_array($queryheadmp)){
		echo "<div class=\"panel panel-default\" style=\"margin-top:20px;\">
			<div class=\"panel-heading\">
				<a data-toggle=\"collapse\" data-parent=\"#matapelajaran-group\" href=\"#sekolah".$admin['id_sekolah']."-matapelajaran".$headmp[0]."\"><h3 class=\"sub-header panel-title\">".ucwords($headmp[1])."</h3></a>
			</div>
			
			<div id=\"sekolah".$admin['id_sekolah']."-matapelajaran".$headmp[0]."\" class=\"panel-collapse collapse $in\">
				<div class=\"panel-body\">
					<button type=\"button\" class=\"btn btn-primary btn-cetak-nilai\" id=\"nilai-$id-$admin[id_sekolah]-$headmp[0]\" data-toggle=\"modal\" data-target=\"#cetak-nilai\">Cetak</button>
					<div class=\"row\">
		";
		
		$in="";
		$queryheadp=mysql_query("SELECT p.id_paket, p.paket, g.nama FROM nilai as n, ujian as u, soal_pelajaran as sp, paket_pelajaran as pp, paket as p, guru as g, sekolah as se, siswa as si WHERE n.id_ujian=u.id_ujian AND u.id_soal_pelajaran=sp.id_soal_pelajaran AND sp.id_paket_pelajaran=pp.id_paket_pelajaran AND pp.id_paket=p.id_paket AND g.id_sekolah=se.id_sekolah AND se.id_sekolah='$admin[id_sekolah]' AND si.id_paket=p.id_paket AND si.id_siswa=n.id_siswa AND pp.id_pelajaran='$headmp[0]' GROUP BY p.id_paket ORDER BY p.id_paket ASC");
		while($headp=mysql_fetch_array($queryheadp)){
			echo "<div class=\"col-md-6 col-sm-6\">
					<h4 class=\"sub-header\">Paket $headp[1]</h4>
					<table class=\"table table-striped table-hover\">
						<thead>
							<tr>
								<th>NO</th>
								<th>NAMA</th>
								<th>NILAI</th>
								<th>AKSI</th>
							</tr>
						</thead>
						<tbody>
				";
				$no=1;
				$querysiswa=mysql_query("SELECT si.nama, n.nilai, n.id_nilai, pp.kkm FROM nilai as n, ujian as u, soal_pelajaran as sp, paket_pelajaran as pp, paket as p, mata_pelajaran as mp, sekolah as se, siswa as si WHERE n.id_ujian=u.id_ujian AND u.id_soal_pelajaran=sp.id_soal_pelajaran AND sp.id_paket_pelajaran=pp.id_paket_pelajaran AND pp.id_paket=p.id_paket AND pp.id_pelajaran=mp.id_pelajaran AND si.id_sekolah=se.id_sekolah AND pp.id_paket='$headp[0]' AND n.id_siswa=si.id_siswa AND pp.id_pelajaran='$headmp[0]' AND se.id_sekolah='$admin[id_sekolah]' ORDER BY si.nama ASC");
				while($siswa=mysql_fetch_array($querysiswa)){
					if($siswa[1]<$siswa[3]){
						echo "<tr class=\"label-danger\" id=\"nilai-$siswa[2]\">";
					}
					else{
						echo "<tr id=\"nilai-$siswa[2]\">";
					}
					echo "
						<td>$no</td>
						<td>$siswa[0]</td>
						<td>$siswa[1]</td>
						<td><img src=\"../img/DeleteRed.png\" style=\"width:15px; height:15px; cursor:pointer\" alt=\"Hapus\" title=\"Hapus\" class=\"hapus-icon-nilai\" id='hapus-nilai-$siswa[2]' data-toggle=\"modal\" data-target=\"#hapus-data-nilai\" /></td>
					</tr>
					";
					$no++;
				}
				$querysiswamax=mysql_fetch_array(mysql_query("SELECT n.nilai FROM nilai as n, ujian as u, soal_pelajaran as sp, paket_pelajaran as pp, paket as p, mata_pelajaran as mp, sekolah as se, siswa as si WHERE n.id_ujian=u.id_ujian AND u.id_soal_pelajaran=sp.id_soal_pelajaran AND sp.id_paket_pelajaran=pp.id_paket_pelajaran AND pp.id_paket=p.id_paket AND pp.id_pelajaran=mp.id_pelajaran AND si.id_sekolah=se.id_sekolah AND pp.id_paket='$headp[0]' AND n.id_siswa=si.id_siswa AND pp.id_pelajaran='$headmp[0]' AND se.id_sekolah='$isisekolah[id_sekolah]' ORDER BY n.nilai DESC limit 1"));
				$querysiswamin=mysql_fetch_array(mysql_query("SELECT n.nilai FROM nilai as n, ujian as u, soal_pelajaran as sp, paket_pelajaran as pp, paket as p, mata_pelajaran as mp, sekolah as se, siswa as si WHERE n.id_ujian=u.id_ujian AND u.id_soal_pelajaran=sp.id_soal_pelajaran AND sp.id_paket_pelajaran=pp.id_paket_pelajaran AND pp.id_paket=p.id_paket AND pp.id_pelajaran=mp.id_pelajaran AND si.id_sekolah=se.id_sekolah AND pp.id_paket='$headp[0]' AND n.id_siswa=si.id_siswa AND pp.id_pelajaran='$headmp[0]' AND se.id_sekolah='$isisekolah[id_sekolah]' ORDER BY n.nilai ASC limit 1"));
				$querysiswaavg=mysql_query("SELECT n.nilai FROM nilai as n, ujian as u, soal_pelajaran as sp, paket_pelajaran as pp, paket as p, mata_pelajaran as mp, sekolah as se, siswa as si WHERE n.id_ujian=u.id_ujian AND u.id_soal_pelajaran=sp.id_soal_pelajaran AND sp.id_paket_pelajaran=pp.id_paket_pelajaran AND pp.id_paket=p.id_paket AND pp.id_pelajaran=mp.id_pelajaran AND si.id_sekolah=se.id_sekolah AND pp.id_paket='$headp[0]' AND n.id_siswa=si.id_siswa AND pp.id_pelajaran='$headmp[0]' AND se.id_sekolah='$isisekolah[id_sekolah]'");
				$bsiswa=0;
				$sumsiswa=0;
				while($siswaavg=mysql_fetch_array($querysiswaavg)){
					$sumsiswa=$sumsiswa+$siswaavg[0];
					$bsiswa++;
				}
				if($no>1){
					echo "
					<tr style=\"font-weight:bold\">
						<td colspan=\"2\">Nilai Tertinggi</td>
						<td colspan=\"2\" class=\"text-center\">$querysiswamax[0]</td>
					</tr>
					<tr style=\"font-weight:bold\">
						<td colspan=\"2\">Nilai Terendah</td>
						<td colspan=\"2\" class=\"text-center\">$querysiswamin[0]</td>
					</tr>
					<tr style=\"font-weight:bold\">
						<td colspan=\"2\">Nilai Rata-rata</td>
						<td colspan=\"2\" class=\"text-center\">".$sumsiswa/$bsiswa."</td>
					</tr>
					";
				}
				echo "
						</tbody>
					</table>
					<div class=\"row\" style=\"margin-top:20px\">
						<div class=\"col-md-3 col-sm-3\">&nbsp;</div>
						<div class=\"col-md-4 col-sm-4\">&nbsp;</div>
						<div class=\"col-md-5 col-sm-5 text-center\">
							<span style=\"font-weight:bold\">Pengajar,</span><br /><br />
							$headp[2]
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
		</div>
		<div id=\"wargabelajar\" class=\"tab-pane fade in\">
			<div class=\"panel-group\" id=\"siswa-group\" style=\"margin-top:20px\">
	";
	$ni="in";
	$querysi=mysql_query("SELECT si.id_siswa, si.nama FROM nilai as n, ujian as u, soal_pelajaran as sp, paket_pelajaran as pp, paket as p, sekolah as se, siswa as si WHERE n.id_ujian=u.id_ujian AND u.id_soal_pelajaran=sp.id_soal_pelajaran AND sp.id_paket_pelajaran=pp.id_paket_pelajaran AND pp.id_paket=p.id_paket AND p.id_paket=si.id_paket AND si.id_sekolah=se.id_sekolah AND se.id_sekolah='$admin[id_sekolah]' AND si.id_siswa=n.id_siswa AND u.id_jadwal_ujian='$id' GROUP BY si.id_siswa ORDER BY si.nama ASC");
	while($si=mysql_fetch_array($querysi)){
		echo "<div class=\"panel panel-default\">
				<div class=\"panel-heading\">
					<a data-toggle=\"collapse\" data-parent=\"#siswa-group\" href=\"#sekolah".$isisekolah['id_sekolah']."-$si[0]\"><h3 class=\"sub-header panel-title\">".$si[1]."</h3></a>
				</div>
				
				<div id=\"sekolah".$isisekolah['id_sekolah']."-$si[0]\" class=\"panel-collapse collapse $ni\">
					<div class=\"panel-body\">
						<div class=\"row\">
						<div class=\"col-md-7 col-sm-7\">
						<table class=\"table table-striped table-hover\">
							<thead>
								<tr>
									<th>NO</th>
									<th>MATA PELAJARAN</th>
									<th>NILAI</th>
								</tr>
							</thead>
							<tbody>
			";
			$ni="";
			$n=1;
			$querymp=mysql_query("SELECT mp.mata_pelajaran, n.nilai, pp.kkm FROM nilai as n, ujian as u, soal_pelajaran as sp, paket_pelajaran as pp, mata_pelajaran as mp, siswa as si, sekolah as se WHERE n.id_ujian=u.id_ujian AND u.id_soal_pelajaran=sp.id_soal_pelajaran AND sp.id_paket_pelajaran=pp.id_paket_pelajaran AND pp.id_pelajaran=mp.id_pelajaran AND si.id_siswa=n.id_siswa AND si.id_siswa='$si[0]' AND si.id_sekolah=se.id_sekolah AND se.id_sekolah='$admin[id_sekolah]' ORDER BY mp.mata_pelajaran ASC");
			while($mp=mysql_fetch_array($querymp)){
				if($mp[1]<$mp[2]){
						echo "<tr style=\"font-weight:bold;  background-color: #d9534f;\">";
					}
					else{
						echo "<tr>";
					}
				echo "
					<td>$n</td>
					<td>$mp[0]</td>
					<td>$mp[1]</td>
				</tr>
				";
				$n++;
			}
			$querympavg=mysql_query("SELECT n.nilai FROM nilai as n, ujian as u, soal_pelajaran as sp, paket_pelajaran as pp, mata_pelajaran as mp, siswa as si, sekolah as se WHERE n.id_ujian=u.id_ujian AND u.id_soal_pelajaran=sp.id_soal_pelajaran AND sp.id_paket_pelajaran=pp.id_paket_pelajaran AND pp.id_pelajaran=mp.id_pelajaran AND si.id_siswa=n.id_siswa AND si.id_siswa='$si[0]' AND si.id_sekolah=se.id_sekolah AND se.id_sekolah='$admin[id_sekolah]'");
			$bavg=0;
			$avg=0;
			while($mpavg=mysql_fetch_array($querympavg)){
				$avg=$avg+$mpavg[0];
				$bavg++;
			}
			echo "
							</tbody>
						</table>
						</div>
						
						<div class=\"col-md-5 col-sm-5\">
							<table class=\"table table-striped table-hover\" style=\"font-weight:bold\">
								<tr>
									<th>JUMLAH</th><td>".$avg."</td>
								</tr>
								<tr>
									<th>RATA-RATA</th><td>".$avg/$bavg."</td>
								</tr>
							</table>
						</div>
						
						</div>
					</div>
				</div>
			</div>
			";
			$ni="";
	}
	echo "
			</div>
		</div>
	</div>
	";
?>

<div id="tempat-hapusdata-nilai"></div>
<div id="tempat-cetak-nilai"></div>