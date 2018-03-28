<?php
	include "../../include/koneksi.php";
	$id=$_GET['id'];
	$queryujian=mysql_query("SELECT * FROM ujian_jadwal WHERE id_jadwal_ujian=$id");
	$ujian=mysql_fetch_array($queryujian);
?>
<script type="text/javascript">
$(document).ready(function(e) {
    $("#btn-editdata-jadwal").click(function(e) {
       var tgl1=$("#tgljdwujian1edit").val();
	   var bln1=$("#blnujdwjian1edit").val();
	   var thn1=$("#thnjdwujian1edit").val();
	   var tanggal1=thn1 +"-"+ bln1 +"-"+ tgl1 +" 00:00:00";
	   var tgl2=$("#tgljdwujian2edit").val();
	   var bln2=$("#blnujdwjian2edit").val();
	   var thn2=$("#thnjdwujian2edit").val();
	   var tanggal2=thn2 +"-"+ bln2 +"-"+ tgl2 +" 00:00:00";
	   var ujian=$("#ujianjdwedit").val();
	   
	   var datakirim={
		   id:$("#ujianjdwid").val(),
		   ujn:ujian,
		   t1:tanggal1,
		   t2:tanggal2
	   }
	   $.ajax({
			type:"POST",
			data:datakirim,
			url:"include/kirim.php?kirim=ujian&aksi=edit",
			success: function(response){
				if(response!=""){
					$("#status-editdata-jadwal").attr("class","alert alert-warning");
					$("#sg-editdata-jadwal").html("Gagal");
					$("#isi-editdata-jadwal").html(response);
					$("#status-editdata-jadwal").show("fade","",1000,editjadwal);
				}
				else{
					$("#status-editdata-jadwal").attr("class","alert alert-success");
					$("#sg-editdata-jadwal").html("Sukses");
					$("#isi-editdata-jadwal").html("Jadwal Ujian telah diedit");
					$("#tempat-kalender-ujian").load("include/tampil-kalender-ujian.php");
					$("#tabel-ujian").load("include/tabel-ujian.php");
					$("#status-editdata-jadwal").show("fade","",1000,editjadwal);
				}
			}
		});
	   
    });
	
	function editjadwal(){
		setTimeout(function(){
			$("#status-editdata-jadwal").hide("fade","",1000);
		},10000);
	}
});
</script>
<div class="modal fade" id="form-edit-jadwal" role="dialog">
	<div class="modal-dialog">
	    <div class="modal-content">
	  	  <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Edit Jadwal Ujian</h4>
          </div>
          <div class="modal-body">
          	<div class="container-fluid">
            	<div id="status-editdata-jadwal" style="display:none">
                	<strong id="sg-editdata-jadwal"></strong> : <span id="isi-editdata-jadwal"></span> 
                </div>
                <form class="form-horizontal" id="form-editdata-jadwal" role="form">
                	<div class="form-group">
                    	<label for="ujianjdwid" class="control-label" >#</label>
                        <input type="text" name="ujianjdwid" class="form-control" id="ujianjdwid" value="<?php echo $ujian['id_jadwal_ujian'] ?>" readonly/>
                    </div>
                	<div class="form-group">
                    	<label for="ujianjdwedit" class="control-label" >Ujian</label>
                        <input type="text" name="ujianjdwedit" class="form-control" id="ujianjdwedit" maxlength="25" value="<?php echo $ujian['jadwal_ujian'] ?>" />
                    </div>
                    <div class="form-group">
                    	<label for="jdwujianedit" class="control-label">Jadwal Ujian</label>
                    </div>
                    
                    <div class="row">
                    <div class="col-md-5 col-sm-5">
                        <div class="form-group">
                             <div class="form-inline container">
                                <div class="form-group">
                                    <select class="form-control" id="tgljdwujian1edit" name="tgljdwujian1edit">
                                    <?php
										$tgl_awal=explode(" ",$ujian['tgl_awal']);
										$tgl1=explode("-",$tgl_awal[0]);
                                        date_default_timezone_set("Asia/Makassar");
                                        $date=date("Y-n-d");
                                        $date=explode("-",$date);
                                        for($i=1;$i<32;$i++){
                                            if($tgl1[2]==$i)
                                            echo "<option value='$i' selected=\"selected\">$i</option>";
                                            else
                                            echo "<option value='$i'>$i</option>";
                                        }
                                    ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" id="blnujdwjian1edit" name="blnujdwjian1edit">
                                    <?php
                                        $bulan=array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                                        for($i=0;$i<count($bulan);$i++){
                                            $vbln=$i+1;
                                            if($tgl1[1]==$vbln)
                                            echo "<option value=\"$vbln\" selected=\"selected\">$bulan[$i]</option>";
                                            else
                                            echo "<option value=\"$vbln\">$bulan[$i]</option>";
                                        }
                                    ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" id="thnjdwujian1edit" name="thnjdwujian1edit">
                                    <?php
                                        $vthn=$date[0]+15;
                                        for($i=$date[0];$i<=$vthn;$i++){
                                            if($i==$tgl1[0])
                                            echo "<option value='$i' selected=\"selected\">$i</option>";
                                            else
                                            echo "<option value='$i'>$i</option>";
                                        }
                                    ?>
                                    </select>
                                </div>
                             </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2"><h5>Sampai</h5></div>
                    <div class="col-md-5 col-sm-5">
                    	<div class="form-group">
                             <div class="form-inline container">
                                <div class="form-group">
                                    <select class="form-control" id="tgljdwujian2edit" name="tgljdwujian2edit">
                                    <?php
                                        date_default_timezone_set("Asia/Makassar");
										$tgl_akhir=explode(" ", $ujian['tgl_akhir']);
										$tgl2=explode("-", $tgl_akhir[0]);
                                        $date=date("Y-n-d");
                                        $date=explode("-",$date);
                                        for($i=1;$i<32;$i++){
                                            if($tgl2[2]==$i)
                                            echo "<option value='$i' selected=\"selected\">$i</option>";
                                            else
                                            echo "<option value='$i'>$i</option>";
                                        }
                                    ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" id="blnujdwjian2edit" name="blnujdwjian2edit">
                                    <?php
                                        $bulan=array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                                        for($i=0;$i<count($bulan);$i++){
                                            $vbln=$i+1;
                                            if($tgl2[1]==$vbln)
                                            echo "<option value=\"$vbln\" selected=\"selected\">$bulan[$i]</option>";
                                            else
                                            echo "<option value=\"$vbln\">$bulan[$i]</option>";
                                        }
                                    ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" id="thnjdwujian2edit" name="thnjdwujian2edit">
                                    <?php
                                        $vthn=$date[0]+15;
                                        for($i=$date[0];$i<=$vthn;$i++){
                                            if($i==$tgl2[0])
                                            echo "<option value='$i' selected=\"selected\">$i</option>";
                                            else
                                            echo "<option value='$i'>$i</option>";
                                        }
                                    ?>
                                    </select>
                                </div>
                             </div>
                        </div>
                    </div>
                    </div>
                    
                </form>
            </div>
          </div>
          <div class="modal-footer">
          	<button type="button" class="btn btn-primary btn-hapusdata-paket" id="btn-editdata-jadwal">Edit</button>
          </div>
		</div>
	</div>
</div>
