<?php
	include "../../include/koneksi.php";
	$idlihatsiswa=$_GET['id'];
	$querylihatsiswa=mysql_query("SELECT s.id_siswa, s.nama, s.jenis_kelamin, s.username, s.password, p.paket, s.tempat_lahir, s.tanggal_lahir, s.alamat_siswa, se.nama_sekolah, s.pendidikan_akhir, g.nama, s.tgl_input FROM siswa as s, guru as g, paket as p, sekolah as se WHERE id_siswa='$idlihatsiswa' AND s.id_paket=p.id_paket AND s.id_input=g.id_guru AND s.id_sekolah=se.id_sekolah");
	$lihatiswa=mysql_fetch_array($querylihatsiswa);
	$bulan=array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
	$judullihat=array("ID","NAMA","JENIS KELAMIN","USERNAME","PASSWORD","PAKET","TEMPAT LAHIR","TANGGAL LAHIR","ALAMAT","SEKOLAH","PENDIDIKAN AKHIR","NAMA PENGINPUT","TANGGAL INPUT");
	
?>
<div class="modal fade" id="form-lihat-data" role="dialog">
	<div class="modal-dialog">
	    <div class="modal-content">
	  	  <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Lihat Data Siswa</h4>
          </div>
          <div class="modal-body">
			<div class="container-fluid">
            	<table class="table table-striped">
            	<?php
					for($i=0;$i<count($judullihat);$i++){
						echo "<tr>
							<td class=\"col-sm-3\">$judullihat[$i]</td>
						";
						if($i==2 || $i==7 || $i==10)
							echo "<td class=\"col-sm-9\">".strtoupper($lihatiswa[$i])."</td>";
						else if($i==3){
							echo "<td class=\"col-sm-9\">";
							if($lihatiswa[$i]=="l") echo "Laki-Laki";
							else
							echo "Perempuan";
							echo "</td>";
						}
							
						else if($i==7){
							$tgllhrsiswa=explode("-",$lihatiswa[$i]);
							echo "<td class=\"col-sm-9\">".$tgllhrsiswa[2]." ". $bulan[$tgllhrsiswa[1]-1] ." ".$tgllhrsiswa[0]."</td>";
						}
						else if($i==11){
							$pisahdatetime=explode(" ",$lihatiswa[$i]);
							$tglinput=explode("-",$pisahdatetime[0]);
							$waktuinput=explode(":",$pisahdatetime[1]);
							
							echo "<td class=\"col-sm-9\">".$tglinput[2] ." ". $bulan[$tglinput[1]-1] ." ". $tglinput[0] ." ". $pisahdatetime[1] . "</td>";						}
						else
							echo "<td class=\"col-sm-9\">$lihatiswa[$i]</td>";
						echo "</tr>";
					}
				?>
                </table>
			</div>
          </div>

		</div>
	</div>
</div>