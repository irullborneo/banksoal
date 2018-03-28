<?php
	include "../../include/koneksi.php";
	$baris=$_GET['baris'];
	$kolom=$_GET['kolom'];
	$urut=$_GET['urut'];
	$pilihkolom=$_GET['pilihkolom'];
	$selectkolom=$_GET['selectkolom'];
	
	if($pilihkolom=="semua"){
		$strpilih="";
	}
	else if($pilihkolom=="tgl_input")
		$strpilih="AND sp.tgl_input=".$selectkolom;
	else if($pilihkolom=="paket")
		$strpilih="AND p.id_paket=".$selectkolom;
	else if($pilihkolom=="mata_pelajaran")
		$strpilih="AND mp.mata_pelajaran=".$selectkolom;
	else if($pilihkolom=="guru")
		$strpilih="AND g.id_guru=".$selectkolom;
	
	$total=mysql_num_rows(mysql_query("SELECT * FROM paket_pelajaran as pp, guru as g, mata_pelajaran as mp, paket as p, soal_pelajaran as sp WHERE pp.id_paket=p.id_paket AND pp.id_pelajaran=mp.id_pelajaran AND pp.id_guru=g.id_guru AND pp.id_paket_pelajaran=sp.id_paket_pelajaran $strpilih"));
	$halaman=ceil($total/$baris);
	if(isset($_GET['p'])){
		$p=abs($_GET['p']);
	}else $p=1;
	
	$awal=($p-1)*$baris;
	$querysoal=mysql_query("SELECT sp.id_soal_pelajaran, sp.tgl_input, p.paket, mp.mata_pelajaran, g.nama, sp.penulis, sp.untuk FROM soal_pelajaran as sp, paket_pelajaran as pp, paket as p, mata_pelajaran as mp, guru as g WHERE sp.id_paket_pelajaran=pp.id_paket_pelajaran AND pp.id_paket=p.id_paket AND pp.id_pelajaran=mp.id_pelajaran AND pp.id_guru=g.id_guru ORDER BY $kolom $urut limit $awal,$baris");
			while($soal=mysql_fetch_array($querysoal)){
				echo "<tr style=\"cursor:pointer\" id='baris-soal-$soal[0]' class=\"baris-soal\">";
				echo "
					<td><input type='checkbox' name='checkbox-body' class='checkbox cbbody' value='$soal[0]' /></td>
            		<td>$soal[0]</td>
               	 	<td>$soal[1]</td>
               	 	<td>$soal[2]</td>
                	<td>$soal[3]</td>
            	    <td>$soal[4]</td>
				";
				$penginput=mysql_fetch_array(mysql_query("SELECT nama FROM guru WHERE id_guru='$soal[5]'"));
				$jumlahsoal=mysql_num_rows(mysql_query("SELECT * FROM soal WHERE id_soal_pelajaran='$soal[0]'"));
				echo "
					<td>$penginput[nama]</td>
					<td>$jumlahsoal</td>
					<td>$soal[6]</td>
	    	        <td>
		               	<div class=\"row\" style=\"margin:0; padding:0;\">
					<div class=\"col-xs-6\"><img src=\"../img/DeleteRed.png\" style=\"width:15px; height:15px; cursor:pointer\" alt=\"Hapus\" title=\"Hapus\" class=\"hapus-icon-paketpelajaran\" id='hapus-soal-$soal[0]' data-toggle=\"modal\" data-target=\"#hapus-data-soal\" /></div>
					
					<div class=\"col-xs-6\"><img src=\"../img/file_edit.png\" style=\"width:15px; height:15px; cursor:pointer\" alt=\"Edit\" title=\"Edit\" class=\"edit-icon-soal\" id='edit-soal-$soal[0]'/></div> 
				</div>
	       	        </td>
        	    </tr>
				";
			}
?>

<script type="text/javascript">
$(document).ready(function(e) {
	$(".edit-icon-soal").click(function(e) {
		var id=$(this).attr("id");
		id=id.split("-");
        window.location="./?p=data_soal&edit=" + id[2];
    });
	
	$(".hapus-icon-paketpelajaran").mouseover(function(e) {
        var id=$(this).attr("id");
		id=id.split("-");
		$("#tempat-hapus-soal").load("include/aksi-hapusdata-soal.php?id="+ id[2]);
    });
});
</script>