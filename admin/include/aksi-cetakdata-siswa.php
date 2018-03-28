<div class="modal fade" id="cetak-data" role="dialog">
	<div class="modal-dialog">
	    <div class="modal-content">
	  	  <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Cetak Data Siswa</h4>
          </div>
          <div class="modal-body">
          	<form class="form-inline" role="form">
           	<div class="form-group">
          		<label for="pilih-cetak-datasiswa">Cetak</label> 
            	<select name="pilih-cetak-datasiswa" id='pilih-cetak-datasiswa'>
            		<option value="kartu_ujian" selected>Kartu Ujian</option>
            	    <option value="data_siswa">Data Siswa</option>
            	</select>
            </div>
            <div id="form-datasiswa-cetak" class="form-group">
          		<label for="kolom-tampil-cetak">Dengan Urutan</label>
          		<select name="kolom-tampil-cetak" id="kolom-tampil-cetak">
					<option value="id_siswa" selected="selected">#</option>
				    <option value="nis">NIS</option>
    				<option value="nama">NAMA</option>
                    <option value="jenis_kelamin">JENIS KELAMIN</option>
   					<option value="id_paket">PAKET</option>
                    <option value="id_sekolah">SEKOLAH</option>
				</select> 
				<select name="naikturun-tampil-cetak" id="naikturun-tampil-cetak">
					<option value="asc" selected="selected">Naik</option>
    				<option value="desc">Turun</option>
				</select>
			</div>
            <div class="form-group">
            	<label for="paket-tampil-cetak">Pada paket</label>
				<select name="paket-tampil-cetak" id="paket-tampil-cetak">
					<option value="semua" selected="selected">Semua</option>
				<?php
					$querytampilpaket=mysql_query("SELECT id_paket, paket FROM paket ORDER BY id_paket ASC");
					while($tampilpaket=mysql_fetch_array($querytampilpaket)){
						echo "<option value='$tampilpaket[id_paket]'>$tampilpaket[paket]</option>";
					}
				?>
				</select>
            </div>
            <div class="form-group">
            	<label for="sekolah-tampil-cetak">di sekolah</label>
                <select name="sekolah-tampil-cetak" id="sekolah-tampil-cetak">
					<option value="semua" selected="selected">Semua</option>
				    <?php
						$querycetaksekolah=mysql_query("SELECT id_sekolah, nama_sekolah FROM sekolah ORDER BY nama_sekolah ASC");
						while($cetaksekolah=mysql_fetch_array($querycetaksekolah)){
							echo "<option value='$cetaksekolah[id_sekolah]'>$cetaksekolah[nama_sekolah]</option>";
						}
					?>
				</select>
            </div>
            </form>
          </div>
          <div class="modal-footer">
          	<a href="#" target="_blank" class="btn btn-primary" id="btn-cetakdata-siswa">Cetak</a>
          </div>
		</div>
	</div>
</div>