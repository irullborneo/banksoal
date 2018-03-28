<?php
	$queryjadwal=mysql_query("SELECT jadwal_ujian, tgl_awal, tgl_akhir FROM ujian_jadwal WHERE tgl_awal like '%".date("Y-m")."%'");
	while($jadwal=mysql_fetch_array($queryjadwal)){
		$tgl_awal=explode(" ", $jadwal['tgl_awal']);
		$tgl_akhir=explode(" ", $jadwal['tgl_akhir']);
		if(date("Y-m-d", strtotime($tgl_awal[0])) < date("Y-m-d")  && date("Y-m-d", strtotime($tgl_akhir[0])) > date("Y-m-d")){
			echo "<div class=\"alert alert-success\" role=\"alert\">
			<strong>Ujian $jadwal[jadwal_ujian] </strong>sedang berlangsung
			</div>
			";
		}
	}
?>

<div class="row">
	<div class="col-lg-3 col-md-4 col-sm-6">
    	<div class="panel panel-primary">
        	<div class="panel-heading">
            	<div class="row">
            		<div class="col-xs-6" style="font-size:24px; margin-top:10px; font-weight:bold; line-height:20px">
                    	Data<br />PKBM
                	</div>
                	<div class="col-xs-6 text-right">
                    	<?php
							$querysekolah="SELECT * FROM sekolah ORDER BY id_sekolah DESC";
							$banyaksekolah=mysql_num_rows(mysql_query($querysekolah));
							$tglinputsekolah=mysql_fetch_array(mysql_query($querysekolah));
						?>
                    	<div style="font-size:45px; margin-top:10px"><?php echo $banyaksekolah ?></div>
                        <div style="margin-top:10px; font-size:15px">Terakhir: <?php echo date("d/m/Y", strtotime($tglinputsekolah['tgl_input']))?></div>
                	</div>
            	</div>
            </div>
            
            <div class="panel-footer">
            	<a href="./?p=data_guru"><span class="pull-left">Lihat Detail</span>
            	<span class="pull-right">&raquo;</span></a>
            	<div class="clearfix"></div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-4 col-sm-6">
    	<div class="panel panel-primary">
        	<div class="panel-heading">
            	<div class="row">
            		<div class="col-xs-6" style="font-size:24px; margin-top:10px; font-weight:bold; line-height:20px">
                    	Data<br />Tutor
                	</div>
                	<div class="col-xs-6 text-right">
                    	<?php
							$querytutor="SELECT * FROM guru WHERE sebagai='guru' ORDER BY id_guru DESC";
							$banyaktutor=mysql_num_rows(mysql_query($querytutor));
							$tglinputtutor=mysql_fetch_array(mysql_query($querytutor));
						?>
                    	<div style="font-size:45px; margin-top:10px"><?php echo $banyaktutor ?></div>
                        <div style="margin-top:10px; font-size:15px">Terakhir: <?php echo date("d/m/Y", strtotime($tglinputtutor['tgl_input']))?></div>
                	</div>
            	</div>
            </div>
            
            <div class="panel-footer">
            	<a href="./?p=data_guru"><span class="pull-left">Lihat Detail</span>
            	<span class="pull-right">&raquo;</span></a>
            	<div class="clearfix"></div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-4 col-sm-6">
    	<div class="panel panel-primary">
        	<div class="panel-heading">
            	<div class="row">
            		<div class="col-xs-6" style="font-size:15px; margin-top:10px; font-weight:bold; line-height:20px">
                    	Data Warga<br />Belajar
                	</div>
                	<div class="col-xs-6 text-right">
                    	<?php
							$querysiswa="SELECT * FROM siswa ORDER BY id_siswa DESC";
							$banyaksiswa=mysql_num_rows(mysql_query($querysiswa));
							$tglinputsiswa=mysql_fetch_array(mysql_query($querysiswa));
						?>
                    	<div style="font-size:45px; margin-top:10px"><?php echo $banyaksiswa ?></div>
                        <div style="margin-top:10px; font-size:15px">Terakhir: <?php echo date("d/m/Y", strtotime($tglinputsiswa['tgl_input']))?></div>
                	</div>
            	</div>
            </div>
            
            <div class="panel-footer">
            	<a href="./?p=data_siswa"><span class="pull-left">Lihat Detail</span>
            	<span class="pull-right">&raquo;</span></a>
            	<div class="clearfix"></div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-4 col-sm-6">
    	<div class="panel panel-primary">
        	<div class="panel-heading">
            	<div class="row">
            		<div class="col-xs-6" style="font-size:24px; margin-top:10px; font-weight:bold; line-height:20px">
                    	Data<br />Soal
                	</div>
                	<div class="col-xs-6 text-right">
                    	<?php
							$querysoal="SELECT * FROM soal_pelajaran ORDER BY id_soal_pelajaran DESC";
							$banyaksoal=mysql_num_rows(mysql_query($querysoal));
							$tglinputsoal=mysql_fetch_array(mysql_query($querysoal));
						?>
                    	<div style="font-size:45px; margin-top:10px"><?php echo $banyaksoal ?></div>
                        <div style="margin-top:10px; font-size:15px">Terakhir: <?php echo date("d/m/Y", strtotime($tglinputsoal['tgl_input']))?></div>
                	</div>
            	</div>
            </div>
            
            <div class="panel-footer">
            	<a href="./?p=data_soal"><span class="pull-left">Lihat Detail</span>
            	<span class="pull-right">&raquo;</span></a>
            	<div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-12">
    	<div class="panel panel-default">
        	<div class="panel-heading">
            	<h3 class="panel-title">Ujian Hari Ini</h3>
            </div>
            <div class="panel-body">
            	<table class="table table-striped table-hover">
                	<thead>
        				<tr>
            				<th>Jam</th>
          	 			 	<th>Mata Pelajaran</th>
           			     	<th>Paket</th>
            			    <th>Ujian</th>
           				</tr>
        			</thead>
                    <tbody>
                    <?php
						$hari=date("Y-m-d");
						$querymph=mysql_query("SELECT s.jadwal_ujian, mp.mata_pelajaran, p.paket, s.id_ujian, s.diujikan FROM ujian as s, soal_pelajaran as sp, paket_pelajaran as pp, mata_pelajaran as mp, paket as p WHERE s.id_soal_pelajaran=sp.id_soal_pelajaran AND sp.id_paket_pelajaran=pp.id_paket_pelajaran AND pp.id_pelajaran=mp.id_pelajaran AND pp.id_paket=p.id_paket AND s.jadwal_ujian like '%$hari%' ORDER BY s.jadwal_ujian ASC, p.id_paket ASC");
						while($mph=mysql_fetch_array($querymph)){
							if($mph[4]==1){
								$check="checked";
							}
							else{
								$check="";
							}
							echo "<tr>
								<td>".date("H;i",strtotime($mph[0]))."</td>
								<td>$mph[1]</td>
								<td>$mph[2]</td>
								<td><input type='checkbox' class='ujian' name='s' value='$mph[3]-$mph[4]' $check /></td>
							</tr>";
						}
					?>
                    </tbody>
                </table>
            </div>
        </div>
        
    	<div class="panel panel-default">
        	<div class="panel-heading">
            	<h3 class="panel-title">Tutor belum diaktifkan</h3>
            </div>
            <div class="panel-body">
            	<table class="table">
                	<thead>
                    	<tr>
                        	<th>#</th>
                            <th>Nama</th>
                            <th>PKBM</th>
                            <th>Cetak</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
						$querykodeguru=mysql_query("SELECT g.nama, se.nama_sekolah, g.id_guru FROM guru as g, sekolah as se, guru_aktivasi as ga WHERE ga.id_guru=g.id_guru AND g.id_sekolah=se.id_sekolah AND ga.konfirmasi='0' ORDER BY ga.id_guru_aktivasi DESC");
						while($kodeguru=mysql_fetch_array($querykodeguru)){
							echo "<tr>
								<td>$kodeguru[2]</td>
								<td>$kodeguru[0]</td>
								<td>$kodeguru[1]</td>
								<td><a class='btn btn-primary' target=\"_blank\" href='./cetak/cetak-aktivasi-guru.php?print=yes&data=$kodeguru[2]'>Cetak</a></td>
							</tr>
							";
						}
					?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="panel panel-default">
        	<div class="panel-heading">
               	<h3 class="panel-title">Jadwal Ujian</h3>
            </div>
            <div class="panel-body">
        		<div class="row">
        			<div class="col-lg-2 col-md-2 col-sm-1">&nbsp;
            		</div>
            		<div class="col-lg-8 col-md-8 col-sm-10">
                    	<div id="eventCalendarHumanDate"></div>
                	</div>
            		<div class="col-lg-2 col-md-2 col-sm-1">&nbsp;
            		</div>
        		</div>
        	</div>
		</div>
        
    </div>
    
    <div class="col-lg-6 col-md-6 col-sm-12">
    	<div class="panel-group" id="sekolah-group">
        	<?php
				$querys=mysql_query("SELECT id_sekolah, tgl_input, nama_sekolah, alamat, telpon, id_guru FROM sekolah ORDER BY nama_sekolah ASC");
				$in='in';
				while($se=mysql_fetch_array($querys)){
					echo "<div class=\"panel panel-default\">
						<div class=\"panel-heading\">
							<a data-toggle=\"collapse\" data-parent=\"#sekolah-group\" href=\"#sekolah-$se[0]\"><h3 class=\"sub-header panel-title\">PKBM ".ucwords($se[2])."</h3></a>
						</div>
						
						<div id=\"sekolah-$se[0]\" class=\"panel-collapse collapse $in\">
							<div class=\"panel-body\">
								<table>
									<tr style=\"line-height:30px;\">
										<td>Nama PKBM</td>
										<td style=\"padding-right:20px;\">:</td>
										<td>$se[2]</td>
									<tr>
									<tr style=\"line-height:30px;\">
										<td valign=\"top\">Jumlah<br />Warga Belajar</td>
										<td valign=\"top\">:</td>
										<td>
											<table>
					";
					$queryp=mysql_query("SELECT id_paket, paket FROM paket ORDER BY id_paket ASC");
					$no=1;
					$total=0;
					while($pa=mysql_fetch_array($queryp)){
						$banyaklaki=mysql_num_rows(mysql_query("SELECT * FROM siswa WHERE id_sekolah='$se[0]' AND id_paket='$pa[0]' AND jenis_kelamin='l'"));
						$banyakperempuan=mysql_num_rows(mysql_query("SELECT * FROM siswa WHERE id_sekolah='$se[0]' AND id_paket='$pa[0]' AND jenis_kelamin='p'"));
						$jlh=$banyaklaki + $banyakperempuan;
						$total=$total + $jlh;
						echo "<tr>
							<td valign=\"top\">Paket $pa[1]</td>
							<td style=\"padding-bottom:10px;\">: L = $banyaklaki<br />
							: P = $banyakperempuan<br />
							: JLH = $jlh</td>
						</tr>
						";
						
						$no++;
					}
					echo "					 
											</table>
											Total Jumlah = $total
										</td>
									</tr>
									<tr style=\"line-height:30px;\">
					";
					$banyakgurulaki=mysql_num_rows(mysql_query("SELECT * FROM guru WHERE id_sekolah='$se[0]' AND jenis_kelamin='l'"));
					$banyakguruperempuan=mysql_num_rows(mysql_query("SELECT * FROM guru WHERE id_sekolah='$se[0]' AND jenis_kelamin='p'"));
					$jlhguru= $banyakgurulaki + $banyakguruperempuan;
					echo "
										<td valign=\"top\" >Jumlah Tutor</td>
										<td valign=\"top\">:</td>
										<td>L = $banyakgurulaki<br />
										P = $banyakguruperempuan<br />
										JLH = $jlhguru</td>
									</tr>
									<tr style=\"line-height:30px;\">
										<td>Alamat</td>
										<td>:</td>
										<td>$se[3]</td>
									</tr>
									<tr style=\"line-height:30px;\">
										<td>Telpon</td>
										<td>:</td>
										<td>$se[4]</td>
									</tr>
									<tr style=\"line-height:30px;\">
										<td>Penanggung Jawab</td>
										<td>:</td>
										<td>
					";
					$tanggung=mysql_fetch_array(mysql_query("SELECT nama FROM guru WHERE id_guru='$se[5]'"));
					echo "					$tanggung[0]
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					";
					$in='';
				}
			?>
        </div>
    </div>
</div>

<script>
$(document).ready(function(e) {
    $("#eventCalendarHumanDate").eventCalendar({
		eventsjson: 'json/kalender.php',
		jsonDateFormat: 'human',  // 'YYYY-MM-DD HH:MM:SS'
	});
	
	$(".ujian").change(function(e) {
		var v=$(this).val();
		$.ajax({
			type:"POST",
			url:"include/kirim.php?kirim=ujian&aksi=diujikan",
			data:"va=" + v,
			success: function(response){
			}
		});
		v=v.split("-");
		if(v[1]==1){
			$(this).val(v[0]+"-0");
		}
		else{
			$(this).val(v[0]+"-1");
		}
    });
});
</script>
