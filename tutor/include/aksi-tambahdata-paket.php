<div class="modal fade" id="form-tambah-datapaket" role="dialog">
	<div class="modal-dialog">
	    <div class="modal-content">
	  	  <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Tambah Data Paket</h4>
          </div>
          <div class="modal-body">
          	<div class="container-fluid">
            	<div id="status-tambahdata-paket" style="display:none">
                	<strong id="sg-tambahdata-paket"></strong> : <span id="isi-tambahdata-paket"></span> 
                </div>
            	<form class="form-horizontal" id="form-tambahdata-paket" role="form">
                	<div class="form-group">
                    	 <label for="paket" class="control-label">PAKET</label>
                         <input type="text" class="form-control" id="paket" name="paket" maxlength="15" />
                    </div>
                </form>
            </div>
          </div>
          <div class="modal-footer">
          <img src="../img/loading.gif" style="width:20px; height:20px" id="loading-tambahdata-paket" />
          	<button type="button" class="btn btn-primary" id="btn-tambah-paket">Simpan</button>
          </div>
		</div>
	</div>
</div>