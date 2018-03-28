<?php
	include "../../include/koneksi.php";
	
?>
<script type="text/javascript">
$(document).ready(function(e) {
    $("#btn-tambah-ujian").click(function(e) {
       var tgl=$("#tglujian").val();
	   var bln=$("#blnujian").val();
	   var thn=$("#thnujian").val();
	   var tanggal=thn +"-"+ bln +"-"+ tgl;
	   var jam=$("#jamujian").val();
	   var menit=$("#menitujian").val();
	   var waktu=jam +":"+ menit +":00";
	   var durasi=$("#durasiujian").val();
	   var soal=$("#soalujian").val();
	   var banyaksoal=$("#banyaksoal").val();
	   
	   var datakirim={
		   ju:$("#ujian").val(),
		   s:soal,
		   bs:banyaksoal,
		   drs:durasi,
		   jadwal:tanggal +" "+ waktu
	   }
	   $.ajax({
			type:"POST",
			data:datakirim,
			url:"include/kirim.php?kirim=ujian&aksi=tambah",
			success: function(response){
				if(response!=""){
					$("#status-tambahdata-ujian").attr("class","alert alert-warning");
					$("#sg-tambahdata-ujian").html("Gagal");
					$("#isi-tambahdata-ujian").html(response);
					$("#loading-tambahdata-ujian").hide();
					$("#status-tambahdata-ujian").show("fade","",1000,hilangtambah);
				}
				else{
					$("#status-tambahdata-ujian").attr("class","alert alert-success");
					$("#sg-tambahdata-ujian").html("Sukses");
					$("#isi-tambahdata-ujian").html("Ujian telah disimpan");
					$("#form-tambahdata-ujian").trigger("reset");
					awallihat();
					$("#tempat-kalender-ujian").load("include/tampil-kalender-ujian.php");
					$("#status-tambahdata-ujian").show("fade","",1000,hilangtambah);
				}
			}
		});
	   
    });
	awallihat();
	$("#ujian").change(function(e) {
		var id=$(this).val();
		if(id>0){
			$("#tmpat-tanggal-ujian").show();
			$("#tmpat-jam-ujian").show();
			$("#tmpat-durasi-ujian").show();
			$("#tmpat-soal-ujian").show();
        	$("#tmpat-tanggal-ujian").load("include/tampil-tanggal-ujian.php?id="+ id);
		} 
		else{
			awallihat();
		}
    });
	
	$("#soalujian").change(function(e) {
        $("#banyaksoaldiv").load("include/tampil-banyaksoal.php?id="+ $(this).val());
    });
	
	function hilangtambah(){
		setTimeout(function(){
			$("#status-tambahdata-ujian").hide("fade","",1000);
		},10000);
	}
	function awallihat(){
		$("#tmpat-tanggal-ujian").hide();
		$("#tmpat-jam-ujian").hide();
		$("#tmpat-durasi-ujian").hide();
		$("#tmpat-soal-ujian").hide();
	}
});
</script>
<div class="modal fade" id="form-tambah-ujian" role="dialog">
	<div class="modal-dialog">
	    <div class="modal-content">
	  	  <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Tambah Ujian</h4>
          </div>
          <div class="modal-body">
          	<div class="container-fluid">
            	<div id="status-tambahdata-ujian" style="display:none">
                	<strong id="sg-tambahdata-ujian"></strong> : <span id="isi-tambahdata-ujian"></span> 
                </div>
            	<form class="form-horizontal" id="form-tambahdata-ujian" role="form">
                	<div class="form-group">
                    	<label for="ujian" class="control-label">Ujian</label>
                        <select id="ujian" name="ujian" class="form-control">
                        	<optgroup>
                            	<option value="0">-- Pilih Ujian --</option>
                            </optgroup>
                        <?php
							$queryujian=mysql_query("SELECT id_jadwal_ujian, jadwal_ujian, tgl_akhir FROM ujian_jadwal ORDER BY tgl_akhir DESC");
							while($ujian=mysql_fetch_array($queryujian)){
								$tgl_akhir=explode(" ",$ujian['tgl_akhir']);
								if(date("Y-m-d", strtotime($tgl_akhir[0])) > date("Y-m-d")){
									echo "<option value=\"$ujian[id_jadwal_ujian]\">$ujian[jadwal_ujian]</option>";
								}
							}
						?>
                        </select>
                    </div>
                	<div class="row">
                    <div class="col-md-6 col-sm-6" id="tmpat-tanggal-ujian">
                	
                    </div>
                    <div class="col-md-6 col-sm-6" id="tmpat-jam-ujian">
                    <div class="form-group">
                      	<label for="wktujian" class="control-label" >Waktu Ujian</label>
                        <div class="form-inline container">
                        	<div class="form-group">
                            <?php
								$jam=date("G");
								$menit=date("i");
							?>
                            	<label for="jamujian" class="control-label" >Jam</label>
                                <input type="number" min="1" max="12" name="jamujian" id="jamujian" class="form-control" value="<?php echo $jam ?>" />
                                <label for="menitujian" class="control-label" >Menit</label>
                                <input type="number" min="1" max="60" name="menitujian" id="menitujian" class="form-control" value="<?php echo $menit ?>" />
                            </div>
                        </div>
                    </div>
                    </div></div>
                    <div class="form-group" id="tmpat-durasi-ujian">
                    	<label for="durasiujian" class="control-label" >Durasi Ujian: </label>
                        <input type="number" min="1" max="240" name="durasiujian" id="durasiujian" value="90" /> <label for="durasiujian">Menit</label>
                    </div>
                  	<div class="form-group" id="tmpat-soal-ujian">
                		<label for="soalujian" class="control-label" >Soal</label>
                	    <select class="form-control" id="soalujian" name="soalujian">
                        	<optgroup>
                                            <option value="">Soal Ujian</option>
                            </optgroup> 
                	    <?php
							$querysoal=mysql_query("SELECT sp.id_soal_pelajaran, p.paket, mp.mata_pelajaran, sp.tgl_input FROM soal_pelajaran as sp, paket_pelajaran as pp, paket as p, mata_pelajaran as mp WHERE sp.id_paket_pelajaran=pp.id_paket_pelajaran AND pp.id_paket=p.id_paket AND pp.id_pelajaran=mp.id_pelajaran AND sp.untuk='ujian' ORDER BY sp.id_soal_pelajaran DESC");
							while($soal=mysql_fetch_array($querysoal)){
								echo "<option value=\"$soal[0]\">$soal[2] - Paket $soal[1] ($soal[3])</option>";
							}
						?>
                	    </select>
                	</div>
                    <div class="form-group" id="banyaksoaldiv">
                    		
                    </div>
                </form>
            </div>
          </div>
          <div class="modal-footer">
          	<button type="button" class="btn btn-primary" id="btn-tambah-ujian" >Tambah</button>
          </div>
		</div>
	</div>
</div>