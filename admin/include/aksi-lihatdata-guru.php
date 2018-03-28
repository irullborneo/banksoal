<?php
	include "../../include/koneksi.php";
	$id=$_GET['id'];
	$queryquru=mysql_query("SELECT g.id_guru, g.nip, g.nama, g.jenis_kelamin, g.tempat_lahir, g.tanggal_lahir, g.alamat, s.nama_sekolah, g.pendidikan_akhir, g.username, g.password FROM guru as g, sekolah as s WHERE g.id_sekolah=s.id_sekolah AND g.id_guru=$id");
	$guru=mysql_fetch_array($queryquru);
	$bulan=array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
	
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
            		<tr>
                    	<td class="col-sm-3">ID</td>
                        <td class="col-sm-9"><?php echo $guru[0] ?></td>
                    </tr>
                    <tr>
                    	<td class="col-sm-3">NIP</td>
                        <td class="col-sm-9"><?php echo $guru[1] ?></td>
                    </tr>
                    <tr>
                    	<td class="col-sm-3">NAMA</td>
                        <td class="col-sm-9"><?php echo $guru[2] ?></td>
                    </tr>
                    <tr>
                    	<td class="col-sm-3">JENIS KELAMIN</td>
                        <td class="col-sm-9">
							<?php 
								if($guru[3]=="l") echo "Laki-Laki";
								else echo "Perempuan"; 
							?>
                        </td>
                    </tr>
                    <tr>
                    	<td class="col-sm-3">TTL</td>
                        <td class="col-sm-9">
							<?php 
								$lahir=explode("-",$guru[5]);
								echo $guru[4] . ", ". $lahir[2] . " " . $bulan[$lahir[1]] ." ". $guru[0];
							?>
                        </td>
                    </tr>
                    <tr>
                    	<td class="col-sm-3">ALAMAT</td>
                        <td class="col-sm-9"><?php echo $guru[6] ?></td>
                    </tr>
                    <tr>
                    	<td class="col-sm-3">PKBM</td>
                        <td class="col-sm-9"><?php echo $guru[7] ?></td>
                    </tr>
                    <tr>
                    	<td class="col-sm-3">PENDIDIKAN AKHIR</td>
                        <td class="col-sm-9"><?php echo $guru[8] ?></td>
                    </tr>
                    <tr>
                    	<td class="col-sm-3">USERNAME</td>
                        <td class="col-sm-9"><?php echo $guru[9] ?></td>
                    </tr>
                    <tr>
                    	<td class="col-sm-3">PASSWORD</td>
                        <td class="col-sm-9"><?php echo $guru[10] ?></td>
                    </tr>
                    <tr>
                    	<td>Kode Aktivasi</td>
                        <td><?php $kode=mysql_fetch_array(mysql_query("SELECT kode_aktivasi FROM guru_aktivasi WHERE id_guru='$id'"));
						echo $kode[0]
                        ?></td>
                    </tr>
                </table>
                <button type="button" id="cetak-aktivasi-<?php echo $id?>" class="btn btn-primary btn-cetak-aktivasi">Cetak Kode Aktivasi</button>
			</div>
          </div>

		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(e) {
    $(".btn-cetak-aktivasi").click(function(e) {
        var id=$(this).attr("id");
		id=id.split("-");
		window.open("./cetak/cetak-aktivasi-guru.php?print=yes&data=" + id[2]);
    });
});
</script>