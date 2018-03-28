<?php
	include "../../include/koneksi.php";
	$id=$_GET['edit'];
	$edit=mysql_fetch_array(mysql_query("SELECT sp.id_soal_pelajaran, pp.id_paket, pp.id_pelajaran, pp.id_guru FROM paket_pelajaran as pp, soal_pelajaran as sp WHERE pp.id_paket_pelajaran=sp.id_paket_pelajaran AND sp.id_soal_pelajaran=$id"));
?>

<script type="text/javascript">
$(document).ready(function(e) {
    $(".form-control").change(function(e) {
        var form=$(this).attr("id");
		var val=$(this).val();
		if(form=="paketpelajaranpaket"){
			$("#paketmatapelajaran").load("include/tampil-kolom-tambahsoal.php?kolom=" + val +"&form="+ form);
		}
		else if(form=="paketmatapelajaran"){
			$("#paketpelajaranguru").load("include/tampil-kolom-tambahsoal.php?kolom=" + val +"&form="+ form +"&paket="+ $("#paketpelajaranpaket").val() );
		}

    });
});
</script>
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6">
    	<div class="form-group">
        	<label for="idsoaledit" class="control-label">ID</label>
            <input type="text" class="form-control" id="idsoaledit" name="idsoaledit" disabled="disabled" value="<?php echo $edit[0] ?>" />
        </div>
        
    	<div class="form-group">
           	<label for="paketpelajaranpaket" class="control-label">Paket</label>
            <select name="paketpelajaranpaket" class="form-control" id="paketpelajaranpaket" disabled="disabled">
          	<?php
				$querypaketpelajaranpilih=mysql_query("SELECT p.id_paket, p.paket FROM paket as p, paket_pelajaran as pp WHERE p.id_paket=pp.id_paket GROUP BY p.id_paket");
				while($paketpelajaranpilih=mysql_fetch_array($querypaketpelajaranpilih)){
					if($edit[1]==$paketpelajaranpilih[0])
						echo "<option value='$paketpelajaranpilih[0]' selected=\"selected\">$paketpelajaranpilih[1]</option>";
					else
						echo "<option value='$paketpelajaranpilih[0]'>$paketpelajaranpilih[1]</option>";
				}
			?>
            </select>
        </div>
        
    </div>
    <div class="col-lg-1 col-md-1 col-sm-1"></div>
    <div class="col-lg-5 col-md-5 col-sm-5">
    	<div class="form-group" id="matapelajaran_soal" disabled="disabled">
           	<label for="paketmatapelajaran" class="control-label">Mata Pelajaran</label>
            <select name="paketmatapelajaran" class="form-control" id="paketmatapelajaran" disabled="disabled">
            <?php
				$querypaketpelajaran=mysql_query("SELECT mp.id_pelajaran, mp.mata_pelajaran FROM mata_pelajaran as mp, paket_pelajaran as pp WHERE mp.id_pelajaran=pp.id_pelajaran AND pp.id_paket=$edit[1] GROUP BY mp.id_pelajaran");
				while($matapelajaran=mysql_fetch_array($querypaketpelajaran)){
					if($edit[2]==$matapelajaran[0])
						echo "<option value='$matapelajaran[0]' selected=\"selected\">$matapelajaran[1]</option>";
					else
						echo "<option value='$matapelajaran[0]'>$matapelajaran[1]</option>";
				}
			?>
            </select>
        </div>
                    
        <div class="form-group" id="guru_soal" disabled="disabled">
            <label for="paketpelajaranguru" class="control-label">Guru</label>
            <select name="paketpelajaranguru" class="form-control" id="paketpelajaranguru" disabled="disabled">
            <?php
				$querypelajaranguru=mysql_query("SELECT g.id_guru, g.nama FROM guru as g, paket_pelajaran as pp WHERE g.id_guru=pp.id_guru AND pp.id_paket=$edit[1] AND pp.id_pelajaran=$edit[2] GROUP BY g.id_guru");
				while($pelajaranguru=mysql_fetch_array($querypelajaranguru)){
					if($edit[3]==$pelajaranguru[0])
						echo "<option value='$pelajaranguru[0]' selected=\"selected\">$pelajaranguru[1]</option>";
					else
						echo "<option value='$pelajaranguru[0]'>$pelajaranguru[1]</option>";
				}
			?>
            </select>
        </div>
        <div class="form-group" id="guru_soal" disabled="disabled">
        	<label for="paketpelajaranuntuk" class="control-label">Untuk</label>
            <select name="paketpelajaranuntuk" class="form-control" id="paketpelajaranuntuk" disabled="disabled">
            	<?php
					$ar=array("ujian","latihan");
					for($i=0;$i<count($ar);$i++){
						if($ar[$i]==$edit[4]){
							echo "<option value='$ar[$i]' selected=\"selected\">$ar[$i]</option>";
						}
						else{
							echo "<option value='$ar[$i]'>$ar[$i]</option>";
						}
					}
				?>
            </select>
        </div>
    </div>
</div>