<script>
$(document).ready(function() {
	tampilkan();
		
	$("#btn-buat-ujian").click(function(e) {
       var tgl1=$("#tgljdwujian1").val();
	   var bln1=$("#blnujdwjian1").val();
	   var thn1=$("#thnjdwujian1").val();
	   var tanggal1=thn1 +"-"+ bln1 +"-"+ tgl1 +" 00:00:00";
	   var tgl2=$("#tgljdwujian2").val();
	   var bln2=$("#blnujdwjian2").val();
	   var thn2=$("#thnjdwujian2").val();
	   var tanggal2=thn2 +"-"+ bln2 +"-"+ tgl2 +" 00:00:00";
	   var ujian=$("#ujianjdw").val();
	   
	   var datakirim={
		   ujn:ujian,
		   t1:tanggal1,
		   t2:tanggal2
	   }
	   $.ajax({
			type:"POST",
			data:datakirim,
			url:"include/kirim.php?kirim=ujian&aksi=buat",
			success: function(response){
				if(response!=""){
					$("#status-buatdata-ujian").attr("class","alert alert-warning");
					$("#sg-buatdata-ujian").html("Gagal");
					$("#isi-buatdata-ujian").html(response);
					$("#status-buatdata-ujian").show("fade","",1000,hilangtambah);
				}
				else{
					$("#status-buatdata-ujian").attr("class","alert alert-success");
					$("#sg-buatdata-ujian").html("Sukses");
					$("#isi-buatdata-ujian").html("Ujian telah disimpan");
					$("#form-buat-ujianjdw").trigger("reset");
					tampilkan();
					$("#status-buatdata-ujian").show("fade","",1000,hilangtambah);
				}
			}
		});
	   
    });
	
	$("#tambah-data-btn").mouseover(function(e) {
        $("#tmpat-tambahujian").load("include/aksi-tambahdata-ujian2.php");
    });
	
	$(".cbhead").change(function(e) {
		if($(".cbbody").attr("checked")==undefined){
			$(".cbbody").attr("checked","checked");
		}
		else{
			$(".cbbody").removeAttr("checked");
			$(".cbbody").attr("checked","");
		}
	});
	
	$("#btn-hapus-checkbox-dialog").mouseover(function(e) {
        var values = new Array();
		$.each($("input[name='checkbox-body']:checked"), function() {
  			values.push($(this).val());
		});
		var str="";
		for(var i =0; i<values.length; i++){
			if(i!=0){
				str +=",";
			}
			
			str += values[i];
		}
		$("#id-hapus-ujian").html(str);
    });
	
	$("#btn-hapus-checkbox").click(function(e) {
		var value=$("#id-hapus-ujian").html();
		$.ajax({
			type:"POST",
			url:"include/kirim.php?kirim=ujian&aksi=hapuscheckbox",
			data:"id=" + value,
			success: function(response){
				if(response!=""){
						$("#status-hapusdata-jadwal").attr("class","alert alert-warning");
						$("#sg-hapusdata-jadwal").html("Gagal");
						$("#isi-hapusdata-jadwal").html(response);
						$("#status-hapusdata-jadwal").show("fade","",1000,hilangtambah);
					}
					else{
						tampilkan();
						$("#status-hapusdata-jadwal").attr("class","alert alert-success");
						$("#sg-hapusdata-jadwal").html("Sukses");
						var baris=value.split(",");
						$("#isi-hapusdata-jadwal").html(baris.length + " baris data dihapus");
						$("#status-hapusdata-jadwal").show("fade","",1000,hilangtambah);
						
					}
			}
		});
		
    });
	
	$(".ujian").change(function(e) {
		var v=$(this).val();
		$.ajax({
			type:"POST",
			url:"include/kirim.php?kirim=ujian&aksi=diujikan",
			data:"va=" + v,
			success: function(response){
			}
		});
		v=v.split("-");
		if(v[1]==1){
			$(this).val(v[0]+"-0");
		}
		else{
			$(this).val(v[0]+"-1");
		}
    });
	
	function hilangtambah(){
		setTimeout(function(){
			$("#status-tambahdata-ujian").hide("fade","",1000);
			$("#status-buatdata-ujian").hide("fade","",1000);
		},10000);
	}
	function tampilkan(){
		$("#tempat-kalender-ujian").load("include/tampil-kalender-ujian.php");
		$("#tabel-ujian").load("include/tabel-ujian.php");
		$("#tmpat-paging-jadwal").load("include/paging-tabel-ujian.php");
	}

});

function tampilujian(id){
	$("#tempat-lihat-ujian").load("include/tampil-ujian.php?id="+ id);
}
</script>
<?php
	$queryjadwal=mysql_query("SELECT jadwal_ujian, tgl_awal, tgl_akhir FROM ujian_jadwal WHERE tgl_awal like '%".date("Y-m")."%'");
	while($jadwal=mysql_fetch_array($queryjadwal)){
		$tgl_awal=explode(" ", $jadwal['tgl_awal']);
		$tgl_akhir=explode(" ", $jadwal['tgl_akhir']);
		if(date("Y-m-d", strtotime($tgl_awal[0])) < date("Y-m-d")  && date("Y-m-d", strtotime($tgl_akhir[0])) > date("Y-m-d")){
			echo "<div class=\"alert alert-success\" role=\"alert\">
			<strong>Ujian $jadwal[jadwal_ujian] </strong>sedang berlangsung
			</div>
			";
		}
	}
	
	$banyakdata=mysql_num_rows(mysql_query("SELECT * FROM ujian WHERE jadwal_ujian like '%".date("Y-m")."%'"));
	$tglujian=mysql_fetch_array(mysql_query("SELECT jadwal_ujian FROM ujian WHERE jadwal_ujian like '%".date("Y-m")."%' ORDER BY jadwal_ujian ASC"));
	$tanggal2=explode(" ",$tglujian['jadwal_ujian']);
	$tanggal=explode("-",$tanggal2[0]);
	$waktu=explode(":",$tanggal2[1]);
	$bulan=array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
	echo "<div class=\"panel panel-info\">
	<div class=\"panel-heading\">INFO</div>
    <div class=\"panel-body\">
	";
	if($banyakdata>0){ 
		
		echo "Ujian akan dilaksanakan pada bulan ini pada tanggal ". $tanggal[2] ." ". $bulan[$tanggal[1]] ." ". $tanggal[0];
		
	}
	else {
		echo "Tidak ada ujian pada bulan ini";
	}
	echo "
	</div>
</div>
	";
?>
<div class="row">
<div class="col-md-6">
<button type="button" class="btn btn-primary" id="buat-data-btn" data-toggle="modal" data-target="#form-buat-ujian">Buat Jadwal</button> 
<button type="button" class="btn btn-primary" id="tambah-data-btn" data-toggle="modal" data-target="#form-tambah-ujian">Tambah Ujian</button> 
<br /><br /><br />
<table class="table table-striped table-hover">
	<thead>
    	<tr>
        	<th><input type="checkbox" name="checkbox-head" class="checkbox cbhead" /></th>
        	<th>#</th>
            <th>Ujian</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody id="tabel-ujian">
    </tbody>
</table>
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus-bnyakdata" id="btn-hapus-checkbox-dialog">Hapus</button><br />
<div id="status-hapusdata-jadwal" style="display:none">
	<strong id="sg-hapusdata-jadwal"></strong> : <span id="isi-hapusdata-jadwal"></span>
</div>
<div id="tmpat-paging-jadwal"></div>
</div>
<div class="col-md-6">
<h3 class="sub-header">Ujian Hari Ini</h3>
	<table class="table table-striped table-hover">
    	<thead>
        	<tr>
            	<th>Jam</th>
            	<th>Mata Pelajaran</th>
                <th>Paket</th>
                <th>Ujian</th>
            </tr>
        </thead>
        <tbody>
        <?php
			$hari=date("Y-m-d");
			$querymph=mysql_query("SELECT s.jadwal_ujian, mp.mata_pelajaran, p.paket, s.id_ujian, s.diujikan FROM ujian as s, soal_pelajaran as sp, paket_pelajaran as pp, mata_pelajaran as mp, paket as p WHERE s.id_soal_pelajaran=sp.id_soal_pelajaran AND sp.id_paket_pelajaran=pp.id_paket_pelajaran AND pp.id_pelajaran=mp.id_pelajaran AND pp.id_paket=p.id_paket AND s.jadwal_ujian like '%$hari%' ORDER BY s.jadwal_ujian ASC, p.id_paket ASC");
			while($mph=mysql_fetch_array($querymph)){
				if($mph[4]==1){
					$check="checked";
				}
				else{
					$check="";
				}
				echo "<tr>
					<td>".date("H;i",strtotime($mph[0]))."</td>
					<td>$mph[1]</td>
					<td>$mph[2]</td>
					<td><input type='checkbox' class='ujian' name='s' value='$mph[3]-$mph[4]' $check /></td>
				</tr>";
			}
		?>
        </tbody>
    </table>
</div>
</div>

<div id="tmpat-editjadwal"></div>
<div id="tmpat-hapusjadwal"></div>

<div class="row">
	<div class="col-md-4 col-sm-4" id="tempat-kalender-ujian">
	</div>
    
    <div class="col-md-1 col-sm-1">
    </div>
    
    <div class="col-md-7 col-sm-7">
    	<div id="tempat-lihat-ujian">
        </div>
    </div>
</div>

<div id="tmpat-tambahujian"></div>

<div class="modal fade" id="form-buat-ujian" role="dialog">
	<div class="modal-dialog">
	    <div class="modal-content">
	  	  <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Tambah Ujian</h4>
          </div>
          <div class="modal-body">
          	<div class="container-fluid">
            	<div id="status-buatdata-ujian" style="display:none">
                	<strong id="sg-buatdata-ujian"></strong> : <span id="isi-buatdata-ujian"></span> 
                </div>
            	<form class="form-horizontal" id="form-buat-ujianjdw" role="form">
                	<div class="form-group">
                    	<label for="ujianjdw" class="control-label" >Ujian</label>
                        <input type="text" name="ujianjdw" class="form-control" id="ujianjdw" maxlength="25" />
                    </div>
                    <div class="form-group">
                    	<label for="jdwujian" class="control-label">Jadwal Ujian</label>
                    </div>
                	<div class="row">
                    <div class="col-md-5 col-sm-5">
                        <div class="form-group">
                             <div class="form-inline container">
                                <div class="form-group">
                                    <select class="form-control" id="tgljdwujian1" name="tgljdwujian1">
                                    <?php
                                        date_default_timezone_set("Asia/Makassar");
                                        $date=date("Y-n-d");
                                        $date=explode("-",$date);
                                        for($i=1;$i<32;$i++){
                                            if($date[2]==$i)
                                            echo "<option value='$i' selected=\"selected\">$i</option>";
                                            else
                                            echo "<option value='$i'>$i</option>";
                                        }
                                    ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" id="blnujdwjian1" name="blnujdwjian1">
                                    <?php
                                        $bulan=array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                                        for($i=0;$i<count($bulan);$i++){
                                            $vbln=$i+1;
                                            if($date[1]==$vbln)
                                            echo "<option value=\"$vbln\" selected=\"selected\">$bulan[$i]</option>";
                                            else
                                            echo "<option value=\"$vbln\">$bulan[$i]</option>";
                                        }
                                    ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" id="thnjdwujian1" name="thnjdwujian2">
                                    <?php
                                        $vthn=$date[0]+15;
                                        for($i=$date[0];$i<=$vthn;$i++){
                                            if($i==$date[0])
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
                                    <select class="form-control" id="tgljdwujian2" name="tgljdwujian2">
                                    <?php
                                        date_default_timezone_set("Asia/Makassar");
                                        $date=date("Y-n-d");
                                        $date=explode("-",$date);
                                        for($i=1;$i<32;$i++){
                                            if($date[2]==$i)
                                            echo "<option value='$i' selected=\"selected\">$i</option>";
                                            else
                                            echo "<option value='$i'>$i</option>";
                                        }
                                    ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" id="blnujdwjian2" name="blnujdwjian2">
                                    <?php
                                        $bulan=array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                                        for($i=0;$i<count($bulan);$i++){
                                            $vbln=$i+1;
                                            if($date[1]==$vbln)
                                            echo "<option value=\"$vbln\" selected=\"selected\">$bulan[$i]</option>";
                                            else
                                            echo "<option value=\"$vbln\">$bulan[$i]</option>";
                                        }
                                    ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" id="thnjdwujian2" name="thnjdwujian2">
                                    <?php
                                        $vthn=$date[0]+15;
                                        for($i=$date[0];$i<=$vthn;$i++){
                                            if($i==$date[0])
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
          	<button type="button" class="btn btn-primary" id="btn-buat-ujian" >Tambah</button>
          </div>
		</div>
	</div>
</div>

<div class="modal fade" id="hapus-bnyakdata" role="dialog">
	<div class="modal-dialog">
	    <div class="modal-content">
	  	  <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Hapus jadwal Ujian</h4>
          </div>
          <div class="modal-body">
          	<div class="container-fluid">
          	<p>Hapus data dengan id <span id="id-hapus-ujian"></span> ?</p>
            </div>
          </div>
          <div class="modal-footer">
          	<button type="button" class="btn btn-primary btn-hapusdata-ujian" id="btn-hapus-checkbox" data-dismiss="modal">Hapus</button>
            <button type="button" class="btn btn-warning" data-dismiss="modal">Tidak</button>
          </div>
		</div>
	</div>
</div>