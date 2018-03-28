<script type="text/javascript">
$(document).ready(function(e) {
    $("#nonipedit").click(function(e) {
            if($(this).is(':checked')){
				$("#nipedit").val("");
				$("#nipedit").attr("disabled","disabled");
				
			}
			else{
				$("#nipedit").removeAttr("disabled");
			}
        });
		
	$("#sandigurubaru1").keyup(function(e) {
        var v1=$(this).val();
		var v2=$("#sandigurubaru2").val();
		if(v1=="" && v2==""){
			$("#kesamaan-password").empty();
		}
		
		else if(v1==v2){
			$("#kesamaan-password").removeClass("text-danger");
			$("#kesamaan-password").addClass("text-success");
			$("#kesamaan-password").html("Sama");
		}
		
		else{
			$("#kesamaan-password").removeClass("text-success");
			$("#kesamaan-password").addClass("text-danger");
			$("#kesamaan-password").html("Tidak Sama");
		}
    });	
	
	$("#sandigurubaru2").keyup(function(e) {
        var v1=$(this).val();
		var v2=$("#sandigurubaru1").val();
		if(v1=="" && v2==""){
			$("#kesamaan-password").empty();
		}
		
		else if(v1==v2){
			$("#kesamaan-password").removeClass("text-danger");
			$("#kesamaan-password").addClass("text-success");
			$("#kesamaan-password").html("Sama");
		}
		
		else{
			$("#kesamaan-password").removeClass("text-success");
			$("#kesamaan-password").addClass("text-danger");
			$("#kesamaan-password").html("Tidak Sama");
		}
    });			
	
	$(".btn-simpan-profil").click(function(e) {
		var i=$(this).attr("id");
		i=i.split("-");
        var datakirim= {
			id:i[2],
			nip:$("#nipedit").val(),
			nama:$("#namaedit").val(),
			jk:$("input#jkmguruedit:checked").val(),
			alamat:$("#alamatguruedit").val(),
			tempatlahir:$("#tempatguruedit").val(),
			tgllahir:$("#thnguruedit").val() +"-"+ $("#blnguruedit").val() +"-"+ $("#tglguruedit").val(),
			user:$("#userguruedit").val(),
			sandi1:$("#sandigurubaru1").val(),
			sandi2:$("#sandigurubaru2").val(),
			sandi3:$("#sandiguruedit").val(),
			pendidikan:$("#pendidikanakhirguruedit").val()
		};
		
		$.ajax({
			type:"POST",
			data:datakirim,
			url:"include/kirim.php?kirim=dataguru&aksi=profil",
			success: function(response){
				if(response!=""){
					$("#status-simpan-guru").attr("class","alert alert-warning");
					$("#sg-simpan-guru").html("Gagal");
					$("#isi-simpan-guru").html(response);
					$("#loading-simpan-guru").hide();
					$("#status-simpan-guru").show("fade","",1000,hilangedit);
				}
				else{
					$("#sandigurubaru1").val("");
					$("#sandigurubaru2").val("");
					$("#sandiguruedit").val("");
					$("#status-simpan-guru").attr("class","alert alert-success");
					$("#sg-simpan-guru").html("Sukses");
					$("#isi-simpan-guru").html("Profil sudah di simpan");
					$("#loading-simpan-guru").hide();
					$("#status-simpan-guru").show("fade","",1000,hilangedit);
				}
			}
		});
    });
	
	function hilangedit(){
			setTimeout(function(){
				$("#status-simpan-guru").hide("fade","",1000);
			},10000);
		}
	
});
</script>
<?php
	$bulan=array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
?>
<form class="form-horizontal" id="form-tambahdata-guru" role="form">
	<div class="row">
    	<div class="col-sm-5">
        	<div class="form-group">
            <label for="nipedit" class="control-label">NIP</label>
            	<?php
					if(empty($admin['nip'])){
						echo "<input type=\"text\" name=\"nipedit\" class=\"form-control\" id=\"nipedit\" maxlength=\"22\" disabled />
             	           <input type=\"checkbox\" name=\"nonipedit\" id=\"nonipedit\" checked> <label for=\"nonipedit\">tanpa nip</label>
						";
					}
					else{
						echo "<input type=\"text\" name=\"nipedit\" class=\"form-control\" id=\"nipedit\" maxlength=\"22\" value=\"$admin[nip]\" />
                    	    <input type=\"checkbox\" name=\"nonipedit\" id=\"nonipedit\" /> <label for=\"nonipedit\">tanpa nip</label>
						";
					}
				?>
        	</div>
            
            <div class="form-group">
            	<label for="namaedit" class="control-label">Nama</label>
            	<input type="text" name="namaedit" class="form-control" id="namaedit" maxlength="85" value="<?php echo $admin['nama']; ?>" />
            </div>
            
            <div class="form-group">
            	<?php
					if($admin['jenis_kelamin']=="l"){
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
            	<input type="text" class="form-control" id="tempatguruedit" name="tempatguruedit" maxlength="75" value="<?php echo $admin['tempat_lahir'] ?>" />
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
								$lahir=explode("-",$admin['tanggal_lahir']);
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
            
        </div>
        <div class="col-sm-1"></div>
        <div class="col-sm-6">
        	<div class="form-group">
            	<label for="alamatguruedit" class="control-label">Alamat</label>
            	<textarea class="form-control" rows="3" id="alamatguruedit" name="alamatguruedit"><?php echo $admin['alamat'] ?></textarea>
        	</div>
            
            <div class="form-group">
            	<label for="pendidikanakhirguruedit" class="control-label">Pendidikan Terakhir</label>
            	<input type="text" class="form-control" id="pendidikanakhirguruedit" name="pendidikanakhirguruedit" maxlength="30" value="<?php echo $admin['pendidikan_akhir'] ?>" />
          	</div>
            
            <div class="form-group">
            	<label for="userguruedit" class="control-label">Username</label>
            	<input type="text" class="form-control" id="userguruedit" name="userguruedit" maxlength="20" value="<?php echo $admin['username'] ?>" />
      		</div>
            
            <div class="form-group">
            	<label for="sandigurubaru1" class="control-label">Password Baru</label>
            	<input type="password" class="form-control" id="sandigurubaru1" name="sandigurubaru1" maxlength="12" placeholder="Password baru" /><br />
                <input type="password" class="form-control" id="sandigurubaru2" name="sandigurubaru2" maxlength="12" placeholder="Ulang Password" /><br />
                <span style="font-weight:bold">Password: </span><span style="font-weight:bold" id="kesamaan-password"></span>
        	</div>
            
            <div class="form-group">
            	<label for="sandiguruedit" class="control-label">Password Lama</label>
            	<input type="password" class="form-control" id="sandiguruedit" name="sandiguruedit" maxlength="12" placeholder="Password lama" />
        	</div>
            
        </div>
    </div>
    
    <div class="pull-right">
    	<button type="button" class="btn btn-primary btn-simpan-profil" id="simpan-profil-<?php echo $admin['id_guru'] ?>">Simpan</button>
    </div>
    <div class="clearfix"></div><br /><br />
</form>

<div id="status-simpan-guru" style="display:none">
	<strong id="sg-simpan-guru"></strong> : <span id="isi-simpan-guru"></span>
</div>