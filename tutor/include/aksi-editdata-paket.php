<?php
	include "../../include/koneksi.php";
	$id=$_GET['id'];
	$queryeditpaket=mysql_query("SELECT * FROM paket WHERE id_paket=$id");
	$editpaket=mysql_fetch_array($queryeditpaket);
?>
<script type="text/javascript">
	$(document).ready(function(e) {
		$("#loading-editdata-paket").hide();
        $("#btn-edit-paket").on("click",function(e){
			$("#loading-editdata-paket").show();
			var data={
				id:$("#idpaketedit").val(),
				paket:$("#paketedit").val()
			};
			$.ajax({
			type:"POST",
			data:data,
			url:"include/kirim.php?kirim=datapaket&aksi=edit",
			success: function(response){
				if(response!=""){
					$("#status-editdata-paket").attr("class","alert alert-warning");
					$("#sg-editdata-paket").html("Gagal");
					$("#isi-editdata-paket").html(response);
					$("#loading-editdata-paket").hide();
					$("#status-editdata-paket").show("fade","",1000,hilangedit);
				}
				else{
					$("#status-editdata-paket").attr("class","alert alert-success");
					$("#sg-editdata-paket").html("Sukses");
					$("#isi-editdata-paket").html("Data telah disimpan");
					$("#form-editdata-paket").trigger("reset");
					$("#tabel-paket").load("include/tabel-paket.php");
					$("#loading-editdata-paket").hide();
					$("#status-editdata-paket").show("fade","",1000,hilangedit);
				}
			}
		});
		});
		function hilangedit(){
		setTimeout(function(){
			$("#status-editdata-paket").hide("fade","",1000);
		},10000);
	}
    });
</script>
<div class="modal fade" id="form-edit-datapaket" role="dialog">
	<div class="modal-dialog">
	    <div class="modal-content">
	  	  <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Edit Data Paket</h4>
          </div>
          <div class="modal-body">
          	<div class="container-fluid">
            	<div id="status-editdata-paket" style="display:none">
                	<strong id="sg-editdata-paket"></strong> : <span id="isi-editdata-paket"></span> 
                </div>
            	<form class="form-horizontal" id="form-tambahdata-paket" role="form">
                	<div class="form-group">
                    	 <label for="idpaketedit" class="control-label">#</label>
                         <input type="text" class="form-control" id="idpaketedit" name="idpaketedit" maxlength="1" value="<?php echo $editpaket['id_paket']?>" disabled />
                    </div>
                	<div class="form-group">
                    	 <label for="paketedit" class="control-label">PAKET</label>
                         <input type="text" class="form-control" id="paketedit" name="paketedit" maxlength="15" value="<?php echo $editpaket['paket']?>" />
                    </div>
                </form>
            </div>
          </div>
          <div class="modal-footer">
          <img src="../img/loading.gif" style="width:20px; height:20px" id="loading-editdata-paket" />
          	<button type="button" class="btn btn-primary btn-hapusdata-siswa" id="btn-edit-paket">Edit</button>
          </div>
		</div>
	</div>
</div>