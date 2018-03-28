<?php
	include "../../include/koneksi.php";
	$id=$_GET['id'];
	$queryeditpaketpelajaran=mysql_query("SELECT * FROM paket_pelajaran WHERE id_paket_pelajaran=$id");
	$editpaketpelajaran=mysql_fetch_array($queryeditpaketpelajaran);
	
?>
<script type="text/javascript">
	$(document).ready(function(e) {
        $("#loading-editdata-paketpelajaran").hide();
		$("#btn-editdata-paketpelajaran").click(function(e) {
            $("#loading-editdata-paketpelajaran").show();
			var datakirim={
				id:$("#paketpelajaranidedit").val(),
				paket:$("#paketpelajaranpaketedit").val(),
				pelajaran:$("#paketmatapelajaranedit").val(),
				guru:$("#paketpelajaranguruedit").val(),
				kkm:$("#paketpelajarankkmedit").val()
			};
			$.ajax({
				type:"POST",
				data:datakirim,
				url:"include/kirim.php?kirim=datapaketpelajaran&aksi=edit",
				success: function(response){
					if(response!=""){
					$("#status-editdata-paketpelajaran").attr("class","alert alert-warning");
					$("#sg-editdata-paketpelajaran").html("Gagal");
					$("#isi-editdata-paketpelajaran").html(response);
					$("#loading-editdata-paketpelajaran").hide();
					$("#status-editdata-paketpelajaran").show("fade","",1000,hilangedit);
				}
				else{
					$("#status-editdata-paketpelajaran").attr("class","alert alert-success");
					$("#sg-editdata-paketpelajaran").html("Sukses");
					$("#isi-editdata-paketpelajaran").html("Data telah disimpan");
					//$("#tabel-paketpelajaran").load("include/tabel-paketpelajaran.php");
					var baris=$("#banyak-baris-tampil").val();
					var kolom=$("#kolom-tampil").val();
					var urut=$("#naikturun-tampil").val();
					var pilihkolom=$("#pilih-kolom").val();
					var selectkolom=$("#select-pilih-kolom").val();
					var strselectkolom="";
					var strp="";
					if(pilihkolom!="semua"){
						strselectkolom="&selectkolom=" + selectkolom;
					}
					var lin="?baris=" + baris + "&kolom=" + kolom + "&urut=" + urut + "&pilihkolom=" + pilihkolom +""+ strselectkolom;
					$("#tabel-paketpelajaran").load("include/tabel-paketpelajaran.php" + lin);
					$("#tmpat-paging-tblpaketpelajaran").load("include/paging-tabel-paketpelajaran.php" + lin);
					$("#loading-editdata-paketpelajaran").hide();
					$("#status-editdata-paketpelajaran").show("fade","",1000,hilangedit);
				}
				}
			});
        });
		function hilangedit(){
		setTimeout(function(){
			$("#status-editdata-paketpelajaran").hide("fade","",1000);
		},10000);
	}
    });
	
</script>
<div class="modal fade" id="form-edit-paketpelajaran" role="dialog">
	<div class="modal-dialog">
	    <div class="modal-content">
	  	  <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Edit Data Paket Pelajaran</h4>
          </div>
          <div class="modal-body">
          	<div class="container-fluid">
            	<div id="status-editdata-paketpelajaran" style="display:none">
                	<strong id="sg-editdata-paketpelajaran"></strong> : <span id="isi-editdata-paketpelajaran"></span> 
                </div>
                <form class="form-horizontal" id="form-editdata-paketpelajaran" role="form">
                	<div class="form-group">
                    	<label for="paketpelajaranidedit" class="control-label">#</label>
                        <input type="number" name="paketpelajaranidedit" class="form-control" id="paketpelajaranidedit" value="<?php echo $editpaketpelajaran['id_paket_pelajaran']?>" disabled />
                    </div>
                	<div class="form-group">
                    	<label for="paketpelajaranpaketedit" class="control-label">Paket</label>
                        <select name="paketpelajaranpaketedit" class="form-control" id="paketpelajaranpaketedit">
                        	<?php
								$querypaketpelajaranpilih=mysql_query("SELECT * FROM paket");
								while($paketpelajaranpilih=mysql_fetch_array($querypaketpelajaranpilih)){
									if($editpaketpelajaran['id_paket']==$paketpelajaranpilih['id_paket']){
										echo "<option value='$paketpelajaranpilih[id_paket]' selected>$paketpelajaranpilih[paket]</option>";
									}
									else
									echo "<option value='$paketpelajaranpilih[id_paket]'>$paketpelajaranpilih[paket]</option>";
								}
							?>
                        </select>
                    </div>
                    <div class="form-group">
                    	<label for="paketmatapelajaranedit" class="control-label">Mata Pelajaran</label>
                        <select name="paketmatapelajaranedit" class="form-control" id="paketmatapelajaranedit">
                        	<?php
								$querypaketmatapelajaran=mysql_query("SELECT * FROM mata_pelajaran");
								while($paketmatapelajaran=mysql_fetch_array($querypaketmatapelajaran)){
									if($editpaketpelajaran['id_pelajaran']==$paketmatapelajaran['id_pelajaran'])
										echo "<option value='$paketmatapelajaran[id_pelajaran]' selected>$paketmatapelajaran[mata_pelajaran]</option>";
									else
										echo "<option value='$paketmatapelajaran[id_pelajaran]'>$paketmatapelajaran[mata_pelajaran]</option>";
								}
							?>
                        </select>
                    </div>
                    <div class="form-group">
                    	<label for="paketpelajaranguruedit" class="control-label">Guru</label>
                        <select name="paketpelajaranguruedit" class="form-control" id="paketpelajaranguruedit">
                        	<?php
								$querypaketpelajaranguru=mysql_query("SELECT * FROM guru WHERE sebagai='guru'");
								while($paketpelajaranguru=mysql_fetch_array($querypaketpelajaranguru)){
									if($editpaketpelajaran['id_guru']==$paketpelajaranguru['id_guru'])
										echo "<option value='$paketpelajaranguru[id_guru]' selected>$paketpelajaranguru[nama]</option>";
									else
										echo "<option value='$paketpelajaranguru[id_guru]'>$paketpelajaranguru[nama]</option>";
								}
							?>
                        </select>
                    </div>
                    <div class="form-group">
                    	<label for="paketpelajarankkmedit" class="control-label">Guru</label>
                        <input type="number" name="paketpelajarankkmedit" class="form-control" id="paketpelajarankkmedit" value="<?php echo $editpaketpelajaran['kkm']?>" />
                    </div>
                </form>
            </div>
          </div>
          <div class="modal-footer">
          <img src="../img/loading.gif" style="width:20px; height:20px" id="loading-editdata-paketpelajaran" />
          	<button type="button" class="btn btn-primary btn-hapusdata-paket" id="btn-editdata-paketpelajaran">Edit</button>
          </div>
		</div>
	</div>
</div>