<?php
	include "../../include/koneksi.php";
	$ideditsiswa=$_GET['id'];
	$queryeditsiswa=mysql_query("SELECT * FROM siswa WHERE id_siswa='$ideditsiswa'");
	$editsiswa=mysql_fetch_array($queryeditsiswa);
	$tgllhrsiswa=explode("-",$editsiswa['tanggal_lahir']);
	$bulan=array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
?>
<script type="text/javascript">
$(document).ready(function(e) {
	$("#loading-editdata-siswa").hide();
    $("#generate-btn-edit").click(function(e) {
        $.ajax({
			url:"include/generate.php",
			success: function(response){
				var generate=response.split("-");
				$("#usermuridedit").val(generate[0]);
				$("#sandimuridedit").val(generate[1])
			}
		});
    });
	
	$("#editdata-siswa-btn").on("click",function(e){
		$("#loading-editdata-siswa").show();
		var datakirimedit= {
			id:$("#idmuridedit").val(),
			nis:$("#nismuridedit").val(),
			nama:$("#namamuridedit").val(),
			jk:$("input#jkmuridedit:checked").val(),
			user:$("#usermuridedit").val(),
			pass:$("#sandimuridedit").val(),
			paket:$("#paketmuridedit").val(),
			tempat:$("#tempatmuridedit").val(),
			tgl:$("#tglmuridedit").val(),
			bln:$("#blnmuridedit").val(),
			thn:$("#thnmuridedit").val(),
			alamat:$("#alamatmuridedit").val(),
			sekolah:$("#sekolahmuridedit").val(),
			pendidikanakhir:$("#pendidikanakhirmuridedit").val()			
		};
		
		$.ajax({
			type:"POST",
			data:datakirimedit,
			url:"include/kirim.php?kirim=datasiswa&aksi=edit",
			success: function(response){
				if(response!=""){
					$("#status-editdata-siswa").attr("class","alert alert-warning");
					$("#sg-editdata-siswa").html("Gagal");
					$("#isi-editdata-siswa").html(response);
					$("#loading-editdata-siswa").hide();
					$("#status-editdata-siswa").show("fade","",1000,hilang);
				}
				else{
					$("#status-editdata-siswa").attr("class","alert alert-success");
					$("#sg-editdata-siswa").html("Sukses");
					$("#isi-editdata-siswa").html("Data telah diedit");
					$("#cari").val("");
					$("#table-siswa").load("include/tabel-siswa.php?baris=" + $("#banyak-baris-tampil").val() + "&kolom=" + $("#kolom-tampil").val() + "&urut=" + $("#naikturun-tampil").val() + "&paket=" + $("#paket-tampil").val() + "&p=1" + "&sekolah=" + $("#sekolah-tampil").val());
	$("#tmpat-paging-tblsiswa").load("include/paging-tabel-siswa.php?p=1&baris=" + $("#banyak-baris-tampil").val() + "&paket=" + $("#paket-tampil").val() + "&sekolah=" + $("#sekolah-tampil").val());
					$("#loading-editdata-siswa").hide();
					$("#status-editdata-siswa").show("fade","",1000,hilangedit);
				}
			}
		});
	});
	function hilangedit(){
			setTimeout(function(){
				$("#status-editdata-siswa").hide("fade","",1000);
			},10000);
		}
});
</script>
<div class="modal fade" id="form-edit-data" role="dialog">
	<div class="modal-dialog modal-lg">
	    <div class="modal-content">
	  	  <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Edit Data Siswa</h4>
          </div>
          <div class="modal-body">
			<div class="container-fluid">
            	<div id="status-editdata-siswa" style="display:none">
                	<strong id="sg-editdata-siswa"></strong> : <span id="isi-editdata-siswa"></span> 
                </div>
                <form class="form-horizontal" role="form">
                	<div class="row">
                    	<div class="col-sm-5">
                            <div class="form-group">
                                <label for="idmuridedit" class="control-label">ID</label>
                                    <input type="text" class="form-control" id="idmuridedit" name="idmuridedit" disabled="disabled" value="<?php echo $editsiswa['id_siswa']?>" />
                            </div>
                            
                            <div class="form-group">
                                <label for="namamuridedit" class="control-label">Nama</label>
                                <input type="text" class="form-control" id="namamuridedit" maxlength="75" name="namamuridedit" value="<?php echo $editsiswa['nama'] ?>"/>
                            </div>
                             <div class="form-group">
                             	<?php
									if($editsiswa['jenis_kelamin']=="l"){
										echo "
										<label class=\"radio-inline\"><input type=\"radio\" value=\"l\" name=\"jkmuridedit\" id=\"jkmuridedit\" checked />Laki-Laki</label>
                                		<label class=\"radio-inline\"><input type=\"radio\" value=\"p\" name=\"jkmuridedit\" id=\"jkmuridedit\" />Perempuan</label>
										";
									}
									else{
										echo "
										<label class=\"radio-inline\"><input type=\"radio\" value=\"l\" name=\"jkmuridedit\" id=\"jkmuridedit\"  />Laki-Laki</label>
                                		<label class=\"radio-inline\"><input type=\"radio\" value=\"p\" name=\"jkmuridedit\" id=\"jkmuridedit\" checked/>Perempuan</label>
										";
									}
								?>
                                
                            </div>
                            <div class="form-group">
                                <label for="usermuridedit" class="control-label">Username</label>
                                <input type="text" class="form-control" id="usermuridedit" maxlength="6" name="usermuridedit" value="<?php echo $editsiswa['username'] ?>"/>
                            </div>
                            <div class="form-group">
                                <label for="sandimuridedit" class="control-label">Password</label>
                                <input type="text" class="form-control" id="sandimuridedit" maxlength="4" name="sandimuridedit" value="<?php echo $editsiswa['password'] ?>"/>
                                <button type="button" class="btn btn-group btn-info btn" id="generate-btn-edit">Generate</button><span class="info"> Acak username dan password</span>
                            </div>
                            <div class="form-group">
                                <label for="paketmuridedit" class="control-label">Paket</label>
                                    <select class="form-control" id="paketmuridedit" name="paketmuridedit">
                                        <?php
                                            $querypaket=mysql_query("SELECT * FROM paket");
                                            while($paket=mysql_fetch_array($querypaket)){
												if($editsiswa['id_paket']==$paket['id_paket']){
													 echo "<option value='$paket[id_paket]' selected>Paket $paket[paket]</option>";
												}
												else{
													echo "<option value='$paket[id_paket]'>Paket $paket[paket]</option>";
												}
                                                
                                            }
                                        ?>
                                    </select>
                            </div>
                        </div><div class="col-sm-1"></div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="tempatmuridedit" class="control-label">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempatmuridedit" maxlength="75" name="tempatmuridedit" value="<?php echo $editsiswa['tempat_lahir'] ?>"/>
                            </div>
                            <div class="form-group">
                                <label for="tgl1muridedit" class="control-label">Tanggal Lahir</label>
                                <div class="form-inline container">
                                    <div class="form-group">
                                        <select class="form-control" id="tglmuridedit" name="tglmuridedit">
                                            <optgroup>
                                                <option value="">Tanggal</option>
                                            </optgroup> 
                                            <?php
                                                for($i=1;$i<32;$i++){
													if($tgllhrsiswa[2]==$i)
														echo "<option value='$i' selected>$i</option>";
													else
                                                    	echo "<option value='$i'>$i</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" id="blnmuridedit" name="blnmuridedit">
                                            <optgroup>
                                            <option value="">Bulan</option>
                                            </optgroup> 
                                            <?php
                                                for($i=0;$i<count($bulan);$i++){
                                                    $vbln=$i+1;
													if($tgllhrsiswa[1]==$vbln)
														echo "<option value=\"$vbln\" selected>$bulan[$i]</option>";													else
                                                    	echo "<option value=\"$vbln\">$bulan[$i]</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" id="thnmuridedit" name="thnmuridedit">
                                            <optgroup>
                                            <option value="">Tahun</option>
                                            </optgroup> 
                                            <?php
                                                $vthn=date("Y")-50;
                                                for($i=$vthn;$i<=date("Y");$i++){
													if($tgllhrsiswa[0]==$i)
														echo "<option value='$i' selected>$i</option>";
													else
                                                   		echo "<option value='$i'>$i</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="form-group">
                                <label for="alamatmuridedit" class="control-label">Alamat</label>
                                <textarea class="form-control" rows="3" id="alamatmuridedit" name="alamatmuridedit"><?php echo $editsiswa['alamat_siswa'] ?></textarea>
                            </div>
                            
                            <div class="form-group" style="display:none">
                                <label for="sekolahmuridedit" class="control-label">PKBM</label>
                                <select class="form-control" id="sekolahmuridedit" name="sekolahmuridedit">
                                    <?php
										$querysekolahedit=mysql_query("SELECT * FROM sekolah");
										while($sekolahedit=mysql_fetch_array($querysekolahedit)){
											if($editsiswa['id_sekolah']==$sekolahedit['id_sekolah'])
												echo "<option value='$sekolahedit[id_sekolah]' selected=\"selected\">$sekolahedit[nama_sekolah]</option>";
											else
												echo "<option value='$sekolahedit[id_sekolah]'>$sekolahedit[nama_sekolah]</option>";
										}
									?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pendidikanakhirmuridedit" class="control-label">Pendidikan Terakhir</label>
                                 <input type="text" class="form-control" id="pendidikanakhirmuridedit" name="pendidikanakhirmuridedit" maxlength="15" value="<?php echo $editsiswa['pendidikan_akhir'] ?>" />
                            </div>
                            </div></div>
                        </form>
			</div>
          </div>
          <div class="modal-footer">
          	<img src="../img/loading.gif" style="width:20px; height:20px" id="loading-editdata-siswa" />
          	<button type="button" class="btn btn-primary" id="editdata-siswa-btn" >Edit</button>
          </div>
		</div>
	</div>
</div>