<div class="modal fade" id="form-tambah-paketpelajaran" role="dialog">
	<div class="modal-dialog">
	    <div class="modal-content">
	  	  <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Tambah Data Paket Pelajaran</h4>
          </div>
          <div class="modal-body">
          	<div class="container-fluid">
            	<div id="status-tambahdata-paketpelajaran" style="display:none">
                	<strong id="sg-tambahdata-paketpelajaran"></strong> : <span id="isi-tambahdata-paketpelajaran"></span> 
                </div>
                <form class="form-horizontal" id="form-tambahdata-paketpelajaran" role="form">
                	<div class="form-group">
                    	<label for="paketpelajaranpaket" class="control-label">Paket</label>
                        <select name="paketpelajaranpaket" class="form-control" id="paketpelajaranpaket">
                        	<?php
								$querypaketpelajaranpilih=mysql_query("SELECT * FROM paket");
								while($paketpelajaranpilih=mysql_fetch_array($querypaketpelajaranpilih)){
									echo "<option value='$paketpelajaranpilih[id_paket]'>$paketpelajaranpilih[paket]</option>";
								}
							?>
                        </select>
                    </div>
                    <div class="form-group">
                    	<label for="paketmatapelajaran" class="control-label">Mata Pelajaran</label>
                        <select name="paketmatapelajaran" class="form-control" id="paketmatapelajaran">
                        	<?php
								$querypaketmatapelajaran=mysql_query("SELECT * FROM mata_pelajaran");
								while($paketmatapelajaran=mysql_fetch_array($querypaketmatapelajaran)){
									echo "<option value='$paketmatapelajaran[id_pelajaran]'>$paketmatapelajaran[mata_pelajaran]</option>";
								}
							?>
                        </select>
                    </div>
                    <div class="form-group" style="display:none">
                    	<label for="paketpelajaranguru" class="control-label">Guru</label>
                        <select name="paketpelajaranguru" class="form-control" id="paketpelajaranguru">
                        	<?php
								$querypaketpelajaranguru=mysql_query("SELECT * FROM guru WHERE sebagai='guru'");
								while($paketpelajaranguru=mysql_fetch_array($querypaketpelajaranguru)){
									if($paketpelajaranguru['id_guru']==$admin['id_guru']){
										echo "<option value='$paketpelajaranguru[id_guru]' selected=\"selected\">$paketpelajaranguru[nama]</option>";
									}
								}
							?>
                        </select>
                    </div>
                    <div class="form-group">
                    	<label for="paketpelajarankkm" class="control-label">KKM</label>
                        <input type="number" name="paketpelajarankkm" class="form-control" id="paketpelajarankkm" value="75" />
                    </div>
                </form>
            </div>
          </div>
          <div class="modal-footer">
          <img src="../img/loading.gif" style="width:20px; height:20px" id="loading-tambahdata-paketpelajaran" />
          	<button type="button" class="btn btn-primary btn-hapusdata-paket" id="btn-tambah-paketpelajaran">Simpan</button>
          </div>
		</div>
	</div>
</div>