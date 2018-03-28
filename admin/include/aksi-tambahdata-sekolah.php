<div class="modal fade" id="form-tambah-sekolah" role="dialog">
	<div class="modal-dialog">
	    <div class="modal-content">
	  	  <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Tambah Data Sekolah</h4>
          </div>
          <div class="modal-body">
          	<div class="container-fluid">
            	<div id="status-tambahdata-sekolah" style="display:none">
                	<strong id="sg-tambahdata-sekolah"></strong> : <span id="isi-tambahdata-sekolah"></span> 
                </div>
                <form class="form-horizontal" id="form-tambahdata-sekolah" role="form">
                	<div class="row">
                    <div class="col-md-6 col-sm-6">
                	<div class="form-group">
                    	<label for="namapkmb" class="control-label">PKBM</label>
                        <input type="text" name="namapkmb" class="form-control" id="namapkmb" maxlength="75" />
                    </div>
                    <div class="form-group">
                    	<label for="alamatpkmb" class="control-label">Alamat</label>
                        <textarea class="form-control" id="alamatpkmb" rows="3"></textarea>
                    </div>
                    </div><div class="col-md-1 col-sm-1"></div>
                    <div class="col-md-5 col-sm-5">
                    <div class="form-group">
                    	<label for="telpon" class="control-label">No. Telpon</label>
                        <input type="number" name="telpon" class="form-control" id="telpon" maxlength="14" />
                    </div>
                    </div></div>
                </form>
            </div>
          </div>
          <div class="modal-footer">
          	<button type="button" class="btn btn-primary" id="btn-tambah-sekolah">Simpan</button>
          </div>
		</div>
	</div>
</div>