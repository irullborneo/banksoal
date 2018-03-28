<?php
	include "../../include/koneksi.php";
	$id=$_GET['id'];
	$queryeditpelajaran=mysql_query("SELECT * FROM mata_pelajaran WHERE id_pelajaran=$id");
	$editpelajaran=mysql_fetch_array($queryeditpelajaran);
?>
<script type="text/javascript">
	$(document).ready(function(e) {
		$("#loading-editdata-pelajaran").hide();
        $("#btn-edit-pelajaran").on("click",function(e){
			$("#loading-editdata-pelajaran").show();
			var data={
				id:$("#idpaketpelajaran").val(),
				pelajaran:$("#pelajaranedit").val()
			};
			$.ajax({
			type:"POST",
			data:data,
			url:"include/kirim.php?kirim=datapelajaran&aksi=edit",
			success: function(response){
				if(response!=""){
					$("#status-editdata-pelajaran").attr("class","alert alert-warning");
					$("#sg-editdata-pelajaran").html("Gagal");
					$("#isi-editdata-pelajaran").html(response);
					$("#loading-editdata-pelajaran").hide();
					$("#status-editdata-pelajaran").show("fade","",1000,hilangedit);
				}
				else{
					$("#status-editdata-pelajaran").attr("class","alert alert-success");
					$("#sg-editdata-pelajaran").html("Sukses");
					$("#isi-editdata-pelajaran").html("Data telah disimpan");
					$("#form-editdata-pelajaran").trigger("reset");
					$("#tabel-matapelajaran").load("include/tabel-matapelajaran.php");
					$("#loading-editdata-pelajaran").hide();
					$("#status-editdata-pelajaran").show("fade","",1000,hilangedit);
				}
			}
		});
		});
		function hilangedit(){
		setTimeout(function(){
			$("#status-editdata-paket").hide("fade","",1000);
			$("#status-editdata-pelajaran").hide("fade","",1000);
		},10000);
	}
    });
</script>
<div class="modal fade" id="form-edit-datapelajaran" role="dialog">
	<div class="modal-dialog">
	    <div class="modal-content">
	  	  <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Edit Data Mata Pelajaran</h4>
          </div>
          <div class="modal-body">
          	<div class="container-fluid">
            	<div id="status-editdata-pelajaran" style="display:none">
                	<strong id="sg-editdata-pelajaran"></strong> : <span id="isi-editdata-pelajaran"></span> 
                </div>
            	<form class="form-horizontal" id="form-tambahdata-pelajaran" role="form">
                	<div class="form-group">
                    	 <label for="idpaketpelajaran" class="control-label">#</label>
                         <input type="text" class="form-control" id="idpaketpelajaran" name="idpaketpelajaran" maxlength="4" value="<?php echo $editpelajaran['id_pelajaran']?>" disabled />
                    </div>
                	<div class="form-group">
                    	 <label for="pelajaranedit" class="control-label">Mata Pelajaran</label>
                         <input type="text" class="form-control" id="pelajaranedit" name="pelajaranedit" maxlength="75" value="<?php echo $editpelajaran['mata_pelajaran']?>" />
                    </div>
                </form>
            </div>
          </div>
          <div class="modal-footer">
          <img src="../img/loading.gif" style="width:20px; height:20px" id="loading-editdata-pelajaran" />
          	<button type="button" class="btn btn-primary btn-hapusdata-siswa" id="btn-edit-pelajaran">Edit</button>
          </div>
		</div>
	</div>
</div>