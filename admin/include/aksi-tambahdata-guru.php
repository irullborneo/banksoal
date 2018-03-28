<div class="modal fade" id="form-tambah-guru" role="dialog">
	<div class="modal-dialog modal-lg">
	    <div class="modal-content">
	  	  <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Tambah Data Tutor</h4>
          </div>
          <div class="modal-body">
          	<div class="container-fluid">
            	<div id="status-tambahdata-guru" style="display:none">
                	<strong id="sg-tambahdata-guru"></strong> : <span id="isi-tambahdata-guru"></span> 
                </div>
                <form class="form-horizontal" id="form-tambahdata-guru" role="form">
                	<div class="row">
                    	<div class="col-sm-5">
                			<div class="form-group">
                    			<label for="nip" class="control-label">NIP</label>
                    		    <input type="text" name="nip" class="form-control" id="nip" maxlength="22" disabled />
                                <input type="checkbox" class="nonip" id="nonip" checked> <label for="nonip">tanpa nip</label>
                    		</div>
                    
                   			 <div class="form-group">
                    			<label for="nama" class="control-label">Nama</label>
                    		    <input type="text" name="nama" class="form-control" id="nama" maxlength="85" />
                   			 </div>
                    
                    		<div class="form-group">
                    			<label class="radio-inline"><input type="radio" value="l" name="jkmguru" id="jkmguru" checked />Laki-Laki</label>
                    		    <label class="radio-inline"><input type="radio" value="p" name="jkmguru" id="jkmguru" />Perempuan</label>
               	    		</div>
                    		
                            <div class="form-group">
                                <label for="tempatguru" class="control-label">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempatguru" name="tempatguru" maxlength="75" />
                            </div>
                            <div class="form-group">
                                <label for="tgl1guru" class="control-label">Tanggal Lahir</label>
                                <div class="form-inline container">
                                    <div class="form-group">
                                        <select class="form-control" id="tglguru" name="tglguru">
                                            <optgroup>
                                                <option value="">Tanggal</option>
                                            </optgroup> 
                                            <?php

                                                for($i=1;$i<32;$i++){
                                                    	echo "<option value='$i'>$i</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" id="blnguru" name="blnguru">
                                            <optgroup>
                                            <option value="">Bulan</option>
                                            </optgroup> 
                                            <?php
                                                for($i=0;$i<count($bulan);$i++){
                                                    $vbln=$i+1;
                                                    echo "<option value=\"$vbln\">$bulan[$i]</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" id="thnguru" name="thnguru">
                                            <optgroup>
                                            <option value="">Tahun</option>
                                            </optgroup> 
                                            <?php
                                                $vthn=date("Y")-50;
                                                for($i=$vthn;$i<=date("Y");$i++){
                                                   		echo "<option value='$i'>$i</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                    	</div><div class="col-sm-1"></div>
                        
                        <div class="col-sm-6">
                        	<div class="form-group">
                  				<label for="alamatguru" class="control-label">Alamat</label>
                        		<textarea class="form-control" rows="3" id="alamatguru" name="alamatguru"></textarea>
               	    		</div>
                    
                   			<div class="form-group">
                    			<label for="sekolahguru" class="control-label">PKBM</label>
                        		<select class="form-control" id="sekolahguru" name="sekolahguru">
                            		<?php
										$querysekolah=mysql_query("SELECT * FROM sekolah");
										while($sekolah=mysql_fetch_array($querysekolah)){
											echo "<option value='$sekolah[id_sekolah]'>$sekolah[nama_sekolah]</option>";
										}
									?>
                    			</select>
                    		</div>
                    
                    		<div class="form-group">
                 	   			<label for="pendidikanakhirguru" class="control-label">Pendidikan Terakhir</label>
                       			<input type="text" class="form-control" id="pendidikanakhirguru" name="pendidikanakhirguru" maxlength="30" />
          	        		</div>
                		</div>
                	</div>
                </form>
            </div>
          </div>
          <div class="modal-footer">
          <img src="../img/loading.gif" style="width:20px; height:20px" id="loading-tambahdata-guru" />
          	<button type="button" class="btn btn-primary btn-hapusdata-paket" id="btn-tambah-guru">Simpan</button>
          </div>
		</div>
	</div>
</div>