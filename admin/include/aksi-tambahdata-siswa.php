<div class="modal fade" id="form-tambah-data" role="dialog">
	<div class="modal-dialog modal-lg">
	    <div class="modal-content">
	  	  <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Tambah Data Siswa</h4>
          </div>
          <div class="modal-body">
			<div class="container-fluid">
            	<div id="status-tambahdata-siswa" style="display:none">
                	<strong id="sg-tambahdata-siswa"></strong> : <span id="isi-tambahdata-siswa"></span> 
                </div>
                <form class="form-horizontal" name="form-tambahdata-siswa" id="form-tambahdata-siswa" role="form">
                	<div class="row">
                    	<div class="col-sm-5">
                            <div class="form-group">
                                <label for="namamurid" class="control-label">Nama</label>
                                <input type="text" class="form-control" id="namamurid" name="namamurid" maxlength="75" />
                            </div>
                            <div class="form-group">
                                <label class="radio-inline"><input type="radio" value="l" name="jkmurid" id="jkmurid" checked />Laki-Laki</label>
                                <label class="radio-inline"><input type="radio" value="p" name="jkmurid" id="jkmurid" />Perempuan</label>
                            </div>
                            <div class="form-group">
                                <label for="usermurid" class="control-label">Username</label>
                                <input type="text" class="form-control" id="usermurid" name="usermurid" maxlength="6" />
                            </div>
                            <div class="form-group">
                                <label for="sandimurid" class="control-label">Password</label>
                                <input type="text" class="form-control" id="sandimurid" name="sandimurid" maxlength="4" />
                                <button type="button" class="btn btn-group btn-info btn" id="generate-btn">Generate</button><span class="info"> Acak username dan password</span>
                            </div>
                            <div class="form-group">
                                <label for="paketmurid" class="control-label">Paket</label>
                                    <select class="form-control" id="paketmurid" name="paketmurid">
                                        <?php
                                            $querypaket=mysql_query("SELECT * FROM paket");
                                            while($paket=mysql_fetch_array($querypaket)){
												echo "<option value='$paket[id_paket]'>Paket $paket[paket]</option>";
                                            }
                                        ?>
                                    </select>
                            </div>
                        </div><div class="col-sm-1"></div>
                        <div class="col-sm-6">
                            
                            <div class="form-group">
                                <label for="tempatmurid" class="control-label">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempatmurid" name="tempatmurid" maxlength="75" />
                            </div>
                            <div class="form-group">
                                <label for="tgl1murid" class="control-label">Tanggal Lahir</label>
                                <div class="form-inline container">
                                    <div class="form-group">
                                        <select class="form-control" id="tglmurid" name="tglmurid">
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
                                        <select class="form-control" id="blnmurid" name="blnmurid">
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
                                        <select class="form-control" id="thnmurid" name="thnmurid">
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
                            <div class="form-group">
                                <label for="alamatmurid" class="control-label">Alamat</label>
                                <textarea class="form-control" rows="3" id="alamatmurid" name="alamatmurid"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="sekolahmurid" class="control-label">PKBM</label>
                                <select class="form-control" id="sekolahmurid" name="sekolahmurid">
                                    <?php
										$querysekolah=mysql_query("SELECT * FROM sekolah");
										while($sekolah=mysql_fetch_array($querysekolah)){
											echo "<option value='$sekolah[id_sekolah]'>$sekolah[nama_sekolah]</option>";
										}
									?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pendidikanakhirmurid" class="control-label">Pendidikan Terakhir</label>
                                 <input type="text" class="form-control" id="pendidikanakhirmurid" name="pendidikanakhirmurid" maxlength="15" />
                            </div>
                            </div></div>
                        </form>
			</div>
          </div>
          <div class="modal-footer">
          	<img src="../img/loading.gif" style="width:20px; height:20px" id="loading-tambahdata-siswa" />
          	<button type="button" class="btn btn-primary" id="tambahdata-siswa-btn">Tambah</button>
          </div>
		</div>
	</div>
</div>
