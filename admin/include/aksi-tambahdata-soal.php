<script type="text/javascript">
$(document).ready(function(e) {
    $(".form-control").change(function(e) {
        var form=$(this).attr("id");
		var val=$(this).val();
		if(form=="paketpelajaranpaket"){
			$("#paketmatapelajaran").load("include/tampil-kolom-tambahsoal.php?kolom=" + val +"&form="+ form);
			$("#matapelajaran_soal").show();
		}
		else if(form=="paketmatapelajaran"){
			$("#paketpelajaranguru").load("include/tampil-kolom-tambahsoal.php?kolom=" + val +"&form="+ form +"&paket="+ $("#paketpelajaranpaket").val() );
			$("#guru_soal").show();
			$("#btn-tambah-soal").removeAttr("disabled");
		}

    });
});
</script>
<div class="modal fade" id="form-tambah-soal" role="dialog">
	<div class="modal-dialog">
	    <div class="modal-content">
	  	  <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Buat Soal</h4>
          </div>
          <div class="modal-body">
          	<div class="container-fluid">
            	<div id="status-tambahdata-soal" style="display:none">
                	<strong id="sg-tambahdata-soal"></strong> : <span id="isi-tambahdata-soal"></span> 
                </div>
                <?php
					if($admin['sebagai']=="admin"){
				?>
                <form class="form-horizontal" id="form-tambahdata-soal" role="form">
                	<div class="form-group">
                    	<label for="paketpelajaranpaket" class="control-label">Paket</label>
                        <select name="paketpelajaranpaket" class="form-control" id="paketpelajaranpaket">
                        	<optgroup>
                            	<option>--Pilih--</option>
                            </optgroup>
                        	<?php
								$querypaketpelajaranpilih=mysql_query("SELECT p.id_paket, p.paket FROM paket as p, paket_pelajaran as pp WHERE p.id_paket=pp.id_paket GROUP BY p.id_paket");
								while($paketpelajaranpilih=mysql_fetch_array($querypaketpelajaranpilih)){
									echo "<option value='$paketpelajaranpilih[0]'>$paketpelajaranpilih[1]</option>";
								}
							?>
                        </select>
                    </div>
                    
                    <div class="form-group" id="matapelajaran_soal" style="display:none">
                    	<label for="paketmatapelajaran" class="control-label">Mata Pelajaran</label>
                        <select name="paketmatapelajaran" class="form-control" id="paketmatapelajaran">
                        </select>
                    </div>
                    
                    <div class="form-group" id="guru_soal" style="display:none">
                    	<label for="paketpelajaranguru" class="control-label">Guru</label>
                        <select name="paketpelajaranguru" class="form-control" id="paketpelajaranguru">
                        </select>
                    </div>
                </form>
                <?php
					}
					else if($admin['sebagai']=="guru"){
					}
				?>
            </div>
          </div>
          <div class="modal-footer">
          <img src="../img/loading.gif" style="width:20px; height:20px" id="loading-tambahdata-soal" />
          	<button type="button" class="btn btn-primary" id="btn-tambah-soal" disabled >Simpan</button>
          </div>
		</div>
	</div>
</div>