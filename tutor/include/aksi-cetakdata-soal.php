<?php
	include "../../include/koneksi.php";
?>
<script type="text/javascript">
$(document).ready(function(e) {
    $("#soal-cetak").change(function(e) {
        $("#banyak-soal-cetak").load("include/tampil-banyaksoal.php?id="+ $(this).val() );
    });
	
	$("#btn-cetakdata-soal").click(function(e) {
        var soal=$("#soal-cetak").val();
		var banyak=$("#banyaksoal").val();
		var jawab=$("input[name='jawab-soal']:checked").val();
		if(jawab==undefined){
			jawab="tidak";
		}
		if(banyak==undefined){
			banyak=0;
		}
		
		if(soal!="tidak"){
			var data=soal +"-"+ banyak +"-"+ jawab;
			window.open("./cetak/cetak-soal.php?print=yes&data=" + data);
		}
		
		return false;
    });
});
</script>
<div class="modal fade" id="cetak-soal" role="dialog">
	<div class="modal-dialog">
	    <div class="modal-content">
	  	  <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Cetak Data</h4>
          </div>
          <div class="modal-body">
          	<div class="container-fluid">
            	<form class="form-horizontal" id="form-cetak-soal" role="form">
                	<div class="form-group">
                    	<label for="soal-cetak" class="control-label">Soal</label>
                        <select id="soal-cetak" name="soal-cetak" class="form-control">
                        	<optgroup>
                            	<option value="tidak">Pilih Soal</option>
                            </optgroup>
                        <?php
							$querysoal=mysql_query("SELECT sp.id_soal_pelajaran, mp.mata_pelajaran, p.paket, sp.tgl_input FROM soal_pelajaran as sp, paket_pelajaran as pp, mata_pelajaran as mp, paket as p WHERE sp.id_paket_pelajaran=pp.id_paket_pelajaran AND pp.id_paket=p.id_paket AND pp.id_pelajaran=mp.id_pelajaran ORDER BY sp.id_soal_pelajaran DESC");
							while($soal=mysql_fetch_array($querysoal)){
								echo "<option value=\"$soal[0]\">$soal[1] Paket $soal[2] ".date("d/m/Y", strtotime($soal[3]))."</option>
								";
							}
						?>
                        </select>
                    </div>
                    <div class="form-group" id="banyak-soal-cetak">
                    </div>
                </form>
            </div>
          </div>
          <div class="modal-footer">
          	<div class="pull-left"><input type="checkbox" value="jawab" id="jawab-soal" name="jawab-soal" /> <label for="jawab-soal">Dengan Kunci Jawaban</label></div>
          	<a href="#" target="_blank" class="btn btn-primary" id="btn-cetakdata-soal">Cetak</a>
          </div>
		</div>
	</div>
</div>