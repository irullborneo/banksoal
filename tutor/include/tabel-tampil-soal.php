<?php
	include "../../include/koneksi.php";
	if(empty($_GET['id'])){
		$getid=mysql_fetch_array(mysql_query("SELECT id_soal_pelajaran FROM soal_pelajaran ORDER BY id_soal_pelajaran DESC limit 1"));
		$id=$getid[0];
	}
	else{
		$id=$_GET['id'];
	}
	$bulan=array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
	$penginput=mysql_fetch_array(mysql_query("SELECT sp.id_soal_pelajaran, g.nama, sp.tgl_input FROM soal_pelajaran as sp, guru as g WHERE sp.penulis=g.id_guru AND sp.id_soal_pelajaran=$id"));
	$tgl=explode("-",$penginput[2]);
	$banyaksoal=mysql_num_rows(mysql_query("SELECT * FROM soal WHERE id_soal_pelajaran=$penginput[0]"));
	echo "<div class=\"pull-left\">
		<h4>Penginput : $penginput[1]</h4>
		<h4>Tanggal   : $tgl[2] ".$bulan[$tgl[1]]." $tgl[0]</h4>
		</div>
		<div class=\"pull-right\">
		<h4>Banyak Soal : $banyaksoal</h4>
	</div>
	";
?>
<br /><br /><br />
<table class="table table-hover">
   	<thead>
       	<tr>
           	<th>No</th>
           	<th>Tipe</th>
           	<th>Cerita</th>
           	<th>Soal</th>
           	<th>Pilihan</th>
            <th>Gambar</th>
            <th>Aksi</th>
       </tr>
	</thead>
        
    <tbody>
    <?php
		$querysoal=mysql_query("SELECT id_soal, id_soal_cerita, tipe_soal, soal, pilihan, jawab, gambar FROM soal WHERE id_soal_pelajaran='$id' ORDER BY id_soal ASC");
		$no=1;
		while($soal=mysql_fetch_array($querysoal)){
			if($soal[2]=="ganda"){
				echo "<tr>";
			}
			else{
				echo "<tr class='active'>";
			}
			echo "
           		<td>$no</td>
            	<td>$soal[2]</td>
            	<td>";
				$ceksoal=mysql_num_rows(mysql_query("SELECT soal_cerita FROM soal_cerita WHERE id_soal_cerita=$soal[1] limit 1"));
				$cerita=mysql_fetch_array(mysql_query("SELECT soal_cerita FROM soal_cerita WHERE id_soal_cerita=$soal[1] limit 1"));
				if($ceksoal==1)
					echo $cerita[0];
			echo "</td>
            	<td>$soal[3]</td>
            	<td>";
				if($soal[2]=="ganda"){
					echo "<ol type=\"a\" style='margin:0;padding:0;'>";
					$pilihan=explode('|',$soal[4]);
					for($i=0;$i<count($pilihan);$i++){
						$ab=explode(">",$pilihan[$i]);
						if($ab[0]==$soal[5])
							echo "<li id=\"$soal[0]-$ab[0]\" style=\"font-weight:bold\">$ab[1]</li>";
						else
							echo "<li id=\"$soal[0]-$ab[0]\">$ab[1]</li>";
					}
					echo "</ol>";
				}
				else{
					$cekbok=explode("|",$soal[4]);
					$jawab=explode("|",$soal[5]);
					foreach($cekbok as $val){
						if(in_array($val, $jawab))
							echo "<span class=\"label label-success\">$val</span> ";
						else
							echo "<span class=\"label label-primary\">$val</span> ";
					}
					
				}
			echo "</td>
            	<td>";
				if($soal[6]!=""){
					echo "<img class=\"img-rounded img-responsive\" src=\"$soal[6]\" style=\"width:60px; height:60px;\" />";
				}
			echo "</td>
	        	<td>
           		<div class=\"row\" style=\"margin:0; padding:0;\">
            	   	<div class=\"col-xs-6\"><img src=\"../img/DeleteRed.png\" style=\"width:15px; height:15px\" alt=\"Hapus\" title=\"Hapus\" /></div>
					<div class=\"col-xs-6\"><img src=\"../img/file_edit.png\" style=\"width:15px; height:15px\" alt=\"Edit\" title=\"Edit\" /></div>
           		</div>
           		
		   		</td>
			</tr>
			";
			$no++;
		}
	?>
	</tbody>
</table>