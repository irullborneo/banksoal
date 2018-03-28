<?php
	include "../../include/koneksi.php";
	$id=$_GET['id'];
	$queryeditguru=mysql_query("SELECT * FROM guru WHERE id_guru=$id");
	$editguru=mysql_fetch_array($queryeditguru);
	$lahir=explode("-",$editguru['tanggal_lahir']);
	$bulan=array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
	
?>
<script type="text/javascript">
	$(document).ready(function(e) {
        $("#loading-editdata-guru").hide();
		$("#btn-edit-guru").click(function(e) {
            $("#loading-editdata-guru").hide();
			var datakirim= {
				id:$("#idguru").val(),
				nip:$("#nipedit").val(),
				nama:$("#namaedit").val(),
				jk:$("input#jkmguruedit:checked").val(),
				alamat:$("#alamatguruedit").val(),
				tempatlahir:$("#tempatguruedit").val(),
				tgllahir:$("#thnguruedit").val() +"-"+ $("#blnguruedit").val() +"-"+ $("#tglguruedit").val(),
				user:$("#userguruedit").val(),
				sandi:$("#sandiguruedit").val(),
				sekolah:$("#sekolahguruedit").val(),
				pendidikan:$("#pendidikanakhirguruedit").val()
			};
			$.ajax({
				type:"POST",
				data:datakirim,
				url:"include/kirim.php?kirim=dataguru&aksi=edit",
				success: function(response){
					if(response!=""){
						$("#status-editdata-guru").attr("class","alert alert-warning");
						$("#sg-editdata-guru").html("Gagal");
						$("#isi-editdata-guru").html(response);
						$("#loading-editdata-guru").hide();
						$("#status-editdata-guru").show("fade","",1000,hilangedit);
					}
					else{
						$("#status-editdata-guru").attr("class","alert alert-success");
						$("#sg-editdata-guru").html("Sukses");
						$("#isi-editdata-guru").html("Data telah diubah");
						$("#form-editdata-guru").trigger("reset");
						var baris=$("#banyak-baris-tampil").val();
						var kolom=$("#kolom-tampil").val();
						var urut=$("#naikturun-tampil").val();
						var pilihkolom=$("#kolom-guru").val();
						var selectkolom=$("#select-pilih-guru").val();
						var strselectkolom="";
						var strp="";
						var cari="";
						if(pilihkolom!="semua"){
							strselectkolom="&selectkolom=" + selectkolom;
						}
						if($("#cari").val()!=""){
							cari="&cari=" + $("#cari").val();
						}
						var lin="?baris=" + baris + "&kolom=" + kolom + "&urut=" + urut + "&pilihkolom=" + pilihkolom +""+ strselectkolom +""+ cari;
						$("#tabel-guru").load("include/tabel-guru.php" + lin);
						$("#tmpat-paging-tblguru").load("include/paging-tabel-guru.php" + lin);
						
						$("#loading-editdata-guru").hide();
						$("#status-editdata-guru").show("fade","",1000,hilangedit);
					}
				}
			});
        });
		
		$("#nonipedit").click(function(e) {
            if($(this).is(':checked')){
				$("#nipedit").val("");
				$("#nipedit").attr("disabled","disabled");
				
			}
			else{
				$("#nipedit").removeAttr("disabled");
			}
        });
		
		function hilangedit(){
			setTimeout(function(){
				$("#status-editdata-guru").hide("fade","",1000);
			},10000);
		}
    });
</script>
<div class="modal fade" id="form-editdata-guru" role="dialog">
	<div class="modal-dialog modal-lg">
	    <div class="modal-content">
	  	  <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Edit Data Tutor</h4>
          </div>
          <div class="modal-body">
          	<div class="container-fluid">
            	<div id="status-editdata-guru" style="display:none">
                	<strong id="sg-editdata-guru"></strong> : <span id="isi-editdata-guru"></span> 
                </div>
                <form class="form-horizontal" id="form-editdata-guru" role="form">
                	<div class="row">
                    	<div class="col-sm-5">
                        	<div class="form-group">
                    			<label for="idguru" class="control-label">ID</label>
                    			<input type="text" class="form-control" id="idguru" name="idguru" maxlength="3" value="<?php echo $id ?>" disabled />
                    		</div>
                            
                			<div class="form-group">
                    			<label for="nipedit" class="control-label">NIP</label>
                                <?php
									if(empty($editguru['nip'])){
										echo "<input type=\"text\" name=\"nipedit\" class=\"form-control\" id=\"nipedit\" maxlength=\"22\" disabled />
                                <input type=\"checkbox\" name=\"nonipedit\" id=\"nonipedit\" checked> <label for=\"nonipedit\">tanpa nip</label>
										";
									}
									else{
										echo "<input type=\"text\" name=\"nipedit\" class=\"form-control\" id=\"nipedit\" maxlength=\"22\" value=\"$editguru[nip]\" />
                                <input type=\"checkbox\" name=\"nonipedit\" id=\"nonipedit\" /> <label for=\"nonipedit\">tanpa nip</label>
										";
									}
								?>
                    		</div>
                    
                   			 <div class="form-group">
                    			<label for="namaedit" class="control-label">Nama</label>
                    		    <input type="text" name="namaedit" class="form-control" id="namaedit" maxlength="85" value="<?php echo $editguru['nama']; ?>" />
                   			 </div>
                    
                    		<div class="form-group">
                            	<?php
									if($editguru['jenis_kelamin']=="l"){
										echo "
										<label class=\"radio-inline\"><input type=\"radio\" value=\"l\" name=\"jkmguruedit\" id=\"jkmguruedit\" checked />Laki-Laki</label>
                                		<label class=\"radio-inline\"><input type=\"radio\" value=\"p\" name=\"jkmguruedit\" id=\"jkmguruedit\" />Perempuan</label>
										";
									}
									else{
										echo "
										<label class=\"radio-inline\"><input type=\"radio\" value=\"l\" name=\"jkmguruedit\" id=\"jkmguruedit\" />Laki-Laki</label>
                                		<label class=\"radio-inline\"><input type=\"radio\" value=\"p\" name=\"jkmguruedit\" id=\"jkmguruedit\" checked />Perempuan</label>
										";
									}
								?>
               	    		</div>
                    		
                            <div class="form-group">
                                <label for="tempatguruedit" class="control-label">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempatguruedit" name="tempatguruedit" maxlength="75" value="<?php echo $editguru['tempat_lahir'] ?>" />
                            </div>
                            <div class="form-group">
                                <label for="tgl1guruedit" class="control-label">Tanggal Lahir</label>
                                <div class="form-inline container">
                                    <div class="form-group">
                                        <select class="form-control" id="tglguruedit" name="tglguruedit">
                                            <optgroup>
                                                <option value="">Tanggal</option>
                                            </optgroup> 
                                            <?php

                                                for($i=1;$i<32;$i++){
													if($lahir[2]==$i){
														echo "<option value='$i' selected>$i</option>";
													}
													else{
														echo "<option value='$i'>$i</option>";
													}
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" id="blnguruedit" name="blnguruedit">
                                            <optgroup>
                                            <option value="">Bulan</option>
                                            </optgroup> 
                                            <?php
                                                for($i=0;$i<count($bulan);$i++){
                                                    $vbln=$i+1;
													if($lahir[1]==$vbln){
														echo "<option value=\"$vbln\" selected>$bulan[$i]</option>";
													}
													else{
														echo "<option value=\"$vbln\">$bulan[$i]</option>";
													}
                                                    
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" id="thnguruedit" name="thnguruedit">
                                            <optgroup>
                                            <option value="">Tahun</option>
                                            </optgroup> 
                                            <?php
                                                $vthn=date("Y")-50;
                                                for($i=$vthn;$i<=date("Y");$i++){
													if($lahir[0]==$i){
														echo "<option value='$i' selected>$i</option>";
													}
													else{
														echo "<option value='$i'>$i</option>";
													}
                                                   	
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                    	</div><div class="col-sm-1"></div>
                        
                        <div class="col-sm-6">
                        	<div class="form-group">
                  				<label for="alamatguruedit" class="control-label">Alamat</label>
                        		<textarea class="form-control" rows="3" id="alamatguruedit" name="alamatguruedit"><?php echo $editguru['alamat'] ?></textarea>
               	    		</div>
                            
                   			<div class="form-group">
                    			<label for="userguruedit" class="control-label">Username</label>
                    			<input type="text" class="form-control" id="userguruedit" name="userguruedit" maxlength="20" value="<?php echo $editguru['username'] ?>" />
                    		</div>
                    		<div class="form-group">
                    			<label for="sandiguruedit" class="control-label">Password</label>
                    			<input type="text" class="form-control" id="sandiguruedit" name="sandiguruedit" maxlength="12" value="<?php echo $editguru['password'] ?> " />
                    		</div>
                    
                   			<div class="form-group">
                    			<label for="sekolahguruedit" class="control-label">PKBM</label>
                        		<select class="form-control" id="sekolahguruedit" name="sekolahguruedit">
                            		<?php
										$querysekolah=mysql_query("SELECT * FROM sekolah");
										while($sekolah=mysql_fetch_array($querysekolah)){
											if($editguru['id_sekolah']==$sekolah['id_sekolah']){
												echo "<option value='$sekolah[id_sekolah]' selected>$sekolah[nama_sekolah]</option>";
											}
											else{
												echo "<option value='$sekolah[id_sekolah]'>$sekolah[nama_sekolah]</option>";
											}
											
										}
									?>
                    			</select>
                    		</div>
                    
                    		<div class="form-group">
                 	   			<label for="pendidikanakhirguruedit" class="control-label">Pendidikan Terakhir</label>
                       			<input type="text" class="form-control" id="pendidikanakhirguruedit" name="pendidikanakhirguruedit" maxlength="30" value="<?php echo $editguru['pendidikan_akhir'] ?>" />
          	        		</div>
                		</div>
                	</div>
                </form>
            </div>
          </div>
          <div class="modal-footer">
          <img src="../img/loading.gif" style="width:20px; height:20px" id="loading-editdata-guru" />
          	<button type="button" class="btn btn-primary" id="btn-edit-guru">Edit</button>
          </div>
		</div>
	</div>
</div>