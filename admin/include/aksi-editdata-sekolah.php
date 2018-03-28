<?php
	include "../../include/koneksi.php";
	$id=$_GET['id'];
	$querysekolah=mysql_query("SELECT * FROM sekolah WHERE id_sekolah=$id");
	$sekolah=mysql_fetch_array($querysekolah);
	
?>
<script type="text/javascript">
$(document).ready(function(e) {
	$("#btn-editdata-sekolah").click(function(e) {
        var datakirim={
			id:$("#sekolahidedit").val(),
			sekolah:$("#sekolahedit").val(),
			alamat:$("#alamatpkmbedit").val(),
			telpon:$("#telponedit").val(),
			guru:$("#idguru").val()
		};
		$.ajax({
			type:"POST",
			data:datakirim,
			url:"include/kirim.php?kirim=datasekolah&aksi=edit",
			success: function(response){
				if(response!=""){
					$("#status-editdata-sekolah").attr("class","alert alert-warning");
					$("#sg-editdata-sekolah").html("Gagal");
					$("#isi-editdata-sekolah").html(response);
					$("#status-editdata-sekolah").show("fade","",1000,editsekolah);
				}
				else{
					$("#status-editdata-sekolah").attr("class","alert alert-success");
					$("#sg-editdata-sekolah").html("Sukses");
					$("#isi-editdata-sekolah").html("Data telah disimpan");
					$("#tabel-sekolah").load("include/tabel-sekolah.php");
					$("#tmpat-paging-sekolah").load("include/paging-tabel-sekolah.php");
					$("#status-editdata-sekolah").show("fade","",1000,editsekolah);
				}
			}
		});
    });
	
	function editsekolah(){
		setTimeout(function(){
			$("#status-editdata-sekolah").hide("fade","",1000);
		},10000);
	}
});
</script>
<div class="modal fade" id="form-edit-sekolah" role="dialog">
	<div class="modal-dialog">
	    <div class="modal-content">
	  	  <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Edit Data Sekolah</h4>
          </div>
          <div class="modal-body">
          	<div class="container-fluid">
            	<div id="status-editdata-sekolah" style="display:none">
                	<strong id="sg-editdata-sekolah"></strong> : <span id="isi-editdata-sekolah"></span> 
                </div>
                <form class="form-horizontal" id="form-editdata-sekolah" role="form">
                	<div class="row">
                    <div class="col-md-6 col-sm-6">
                	<div class="form-group">
                    	<label for="idsekolahedit" class="control-label">#</label>
                        <input type="number" name="sekolahidedit" class="form-control" id="sekolahidedit" value="<?php echo $sekolah['id_sekolah']?>" disabled />
                    </div>
                	<div class="form-group">
                    	<label for="sekolahedit" class="control-label">PKBM</label>
                        <input type="text" name="sekolahedit" class="form-control" id="sekolahedit" value="<?php echo $sekolah['nama_sekolah']?>" />
                    </div>
                    <div class="form-group">
                    	<label for="alamatpkmbedit" class="control-label">Alamat</label>
                        <textarea class="form-control" id="alamatpkmbedit" rows="3"><?php echo $sekolah['alamat']?></textarea>
                    </div>
                    </div><div class="col-md-1 col-sm-1"></div>
                    <div class="col-md-5 col-sm-5">
                    <div class="form-group">
                    	<label for="telponedit" class="control-label">No. Telpon</label>
                        <input type="number" name="telponedit" class="form-control" id="telponedit" maxlength="14" value="<?php echo $sekolah['telpon']?>" />
                    </div>
                    
                    <div class="form-group">
                    	<label for="idguru" class="control-label">Penanggung Jawab</label>
                        <select name="idguru" id="idguru" class="form-control">
                        <?php
							$queryguru=mysql_query("SELECT id_guru, nama FROM guru WHERE id_sekolah='$id'");
							while($guru=mysql_fetch_array($queryguru)){
								if($sekolah['id_guru']==$guru['id_guru']){
									echo "<option value=\"$guru[id_guru]\" selected=\"selected\">$guru[nama]</option>";
								}
								else{
									echo "<option value=\"$guru[id_guru]\">$guru[nama]</option>";
								}
							}
						?>
                        </select>
                    </div>
                    </div></div>
                </form>
            </div>
          </div>
          <div class="modal-footer">
          	<button type="button" class="btn btn-primary btn-hapusdata-paket" id="btn-editdata-sekolah">Edit</button>
          </div>
		</div>
	</div>
</div>