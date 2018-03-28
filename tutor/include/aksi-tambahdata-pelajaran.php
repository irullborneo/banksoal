<div class="modal fade" id="form-tambah-datapelajaran" role="dialog">
	<div class="modal-dialog">
	    <div class="modal-content">
	  	  <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Tambah Data Mata Pelajaran</h4>
          </div>
          <div class="modal-body">
          	<div class="container-fluid">
            	<div id="status-tambahdata-pelajaran" style="display:none">
                	<strong id="sg-tambahdata-pelajaran"></strong> : <span id="isi-tambahdata-pelajaran"></span> 
                </div>
            	<form class="form-horizontal" id="form-tambahdata-pelajaran" role="form">
                	<div class="form-group">
                    	 <label for="pelajaran" class="control-label">Mata Pelajaran</label>
                         <input type="text" class="form-control" id="pelajaran" name="pelajaran" maxlength="75" />
                    </div>
                </form>
            </div>
          </div>
          <div class="modal-footer">
          <img src="../img/loading.gif" style="width:20px; height:20px" id="loading-tambahdata-pelajaran" />
          	<button type="button" class="btn btn-primary" id="btn-tambah-pelajaran">Simpan</button>
          </div>
		</div>
	</div>
</div>