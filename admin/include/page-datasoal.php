<script type="text/javascript">
	$(document).ready(function(e) {
		tampilsoal();
		$("#loading-tambahdata-soal").hide();
        $("#tampil-soal").load("include/tabel-tampil-soal.php");
				
		$("#pilih-kolom").change(function(e) {
        	if($(this).val()=="semua"){
				$("#select-pilih-kolom").hide();
			}
			else{
				$("#select-pilih-kolom").show();
				$("#select-pilih-kolom").load("include/tampil-kolom-soal.php?kolom=" + $(this).val());
			}
    	});
		
		$("#tampilan-data-soal").click(function(e) {
            tampilsoal();
        });
		
		$("#btn-tambah-soal").click(function(e) {
      	  $("#loading-tambahdata-soal").show();
			var datakirim= {
				paket:$("#paketpelajaranpaket").val(),
				pelajaran:$("#paketmatapelajaran").val(),
				guru:$("#paketpelajaranguru").val(),
			};
			$.ajax({
				type:"POST",
				data:datakirim,
				url:"include/kirim.php?kirim=datasoal&aksi=buat",
				success: function(response){
					if(response=="notice1"){
						$("#status-tambahdata-soal").attr("class","alert alert-warning");
						$("#sg-tambahdata-soal").html("Gagal");
						$("#isi-tambahdata-soal").html("Form data tidak diisi");
						$("#loading-tambahdata-soal").hide();
						$("#status-tambahdata-soal").show("fade","",1000,hilangtambah);
					}
					else if(response=="notice2"){
						$("#status-tambahdata-soal").attr("class","alert alert-warning");
						$("#sg-tambahdata-soal").html("Gagal");
						$("#isi-tambahdata-soal").html("Data tidak Valid");
						$("#loading-tambahdata-soal").hide();
						$("#status-tambahdata-soal").show("fade","",1000,hilangtambah);
					}
					else if(response=="notice3"){
						$("#status-tambahdata-soal").attr("class","alert alert-warning");
						$("#sg-tambahdata-soal").html("Gagal");
						$("#isi-tambahdata-soal").html("Data tidak bisa tersimpan coba sekali lagi");
						$("#loading-tambahdata-soal").hide();
						$("#status-tambahdata-soal").show("fade","",1000,hilangtambah);
					}
					else{
						$("#status-tambahdata-soal").attr("class","alert alert-success");
						$("#sg-tambahdata-soal").html("Sukses");
						$("#isi-tambahdata-soal").html("Soal telah dibuat");
						//$("#form-tambahdata-paketpelajaran").trigger("reset");
						tampilsoal();
						$("#loading-tambahdata-soal").hide();
						$("#status-tambahdata-soal").show("fade","",1000,lanjut(response));
					}
				}
			});
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
		$("#id-hapus-soal").html(str);
    });
	
	$("#btn-hapus-checkbox").click(function(e) {
		var value=$("#id-hapus-soal").html();
		$.ajax({
			type:"POST",
			url:"include/kirim.php?kirim=datasoal&aksi=hapuscheckbox",
			data:"id=" + value,
			success: function(response){
				if(response!=""){
						$("#status-hapusdata-soal").attr("class","alert alert-warning");
						$("#sg-hapusdata-soal").html("Gagal");
						$("#isi-hapusdata-soal").html(response);
						$("#status-hapusdata-soal").show("fade","",1000,hilangtambah);
					}
					else{
						tampilsoal();
						$("#status-hapusdata-soal").attr("class","alert alert-success");
						$("#sg-hapusdata-soal").html("Sukses");
						var baris=value.split(",");
						$("#isi-hapusdata-soal").html(baris.length + " baris data dihapus");
						$("#status-hapusdata-soal").show("fade","",1000,hilangtambah);
						
					}
			}
		});
		
    });
	
	$("#cetak-data-soal").mouseover(function(e) {
        $("#tempat-cetak-soal").load("include/aksi-cetakdata-soal.php");
    });
	
	
		
		function lanjut(val){
			var i= val;
			setTimeout(function(){
				window.location="./?p=data_soal&edit=" + i;
			},3000);
		}
		
		function hilangtambah(){
			setTimeout(function(){
				$("#status-tambahdata-soal").hide("fade","",1000);
				$("#status-hapusdata-soal").hide("fade","",1000);
			},10000);
		}
		
		function tampilsoal(){
			var baris=$("#banyak-baris-tampil").val();
			var kolom=$("#kolom-tampil").val();
			var urut=$("#naikturun-tampil").val();
			var pilihkolom=$("#pilih-kolom").val();
			var selectkolom=$("#select-pilih-kolom").val();
			var barisaktif= $("#aktif-soal-baris").html(); 
			var strselectkolom="";
			var strp="";
			if(pilihkolom!="semua"){
				strselectkolom="&selectkolom=" + selectkolom;
			}
			var lin="?baris=" + baris + "&kolom=" + kolom + "&urut=" + urut + "&pilihkolom=" + pilihkolom +""+ strselectkolom +"&barisaktif="+ barisaktif;
			$("#tabel-soal").load("include/tabel-soal.php" + lin);
			$("#tmpat-paging-tblsoal").load("include/paging-tabel-soal.php" + lin);
		}
    });
</script>
<?php
	$dataawalquery=mysql_fetch_array(mysql_query("SELECT id_soal_pelajaran FROM soal_pelajaran ORDER BY id_soal_pelajaran DESC limit 1"));
	echo "<div id='aktif-soal-baris' style=\"display:none\">$dataawalquery[0]</div>";
?>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#form-tambah-soal" id="tambah-data-btn" >Buat Soal</button> 
<button type="button" class="btn btn-primary" id="cetak-data-soal" data-toggle="modal" data-target="#cetak-soal">Cetak</button>
<br /><br />
<button type="button" class="btn btn-default" id="tampilan-data-soal">Tampilkan</button> : <input type="text" maxlength="4" style="width:30px; text-align:right" class="text" id="banyak-baris-tampil" name="banyak-baris-tampil" value="5" /> baris dengan urutan 
<select name="kolom-tampil" id="kolom-tampil">
	<option value="sp.id_soal_pelajaran" selected="selected">#</option>
    <option value="sp.tgl_input">TANGGAL</option>
    <option value="p.id_paket">PAKET</option>
     <option value="mp.id_pelajaran">MATA PELAJARAN</option>
    <option value="g.id_guru">TUTOR</option>
</select> 
<select name="naikturun-tampil" id="naikturun-tampil">
	<option value="asc">Naik</option>
    <option value="desc" selected="selected">Turun</option>
</select> 
Menampilkan
<select name="pilih-kolom" id="pilih-kolom">
	<option value="semua" selected="selected">SEMUA</option>
	<option value="tgl_input">TANGGAL</option>
    <option value="paket">PAKET</option>
    <option value="mata_pelajaran">MATA PELAJARAN</option>
    <option value="guru">TUTOR</option>
</select>
<select name="select-pilih-kolom" id="select-pilih-kolom" style="display:none">

</select>
<div class="table-responsive">
    <table class="table table-hover">
    	<thead>
        	<tr>
            	<th><input type="checkbox" name="checkbox-head" class="checkbox cbhead" /></th>
            	<th>#</th>
            	<th>Tanggal</th>
            	<th>Paket</th>
            	<th>Mata Pelajaran</th>
            	<th>Tutor</th>
                <th>Penginput</th>
                <th>Jumlah Soal</th>
                <th>Untuk</th>
                <th>Aksi</th>
            </tr>
        </thead>
        
	    <tbody id="tabel-soal">

       	</tbody>
   	</table>
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus-bnyakdata" id="btn-hapus-checkbox-dialog">Hapus</button><br />
    <br />
    <div id="status-hapusdata-soal" style="display:none">
	<strong id="sg-hapusdata-soal"></strong> : <span id="isi-hapusdata-soal"></span>
</div>
<br />
    <div id="tmpat-paging-tblsoal"></div>
</div>
<!--
<div id="tampil-soal" style="margin-top:120px; max-height:550px; overflow:auto">    
   	
</div>
-->
<?php
	include "include/aksi-tambahdata-soal.php";
?>
<div id="tempat-hapus-soal">
</div>

<div class="modal fade" id="hapus-bnyakdata" role="dialog">
	<div class="modal-dialog">
	    <div class="modal-content">
	  	  <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Hapus Data Soal</h4>
          </div>
          <div class="modal-body">
          	<div class="container-fluid">
          	<p>Hapus data dengan id <span id="id-hapus-soal"></span> ?</p>
            </div>
          </div>
          <div class="modal-footer">
          	<button type="button" class="btn btn-danger btn-hapusdata-siswa" id="btn-hapus-checkbox" data-dismiss="modal">Hapus</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
          </div>
		</div>
	</div>
</div>


<div id="tempat-cetak-soal">
</div>