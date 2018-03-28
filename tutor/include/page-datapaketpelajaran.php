<script type="text/javascript">
$(document).ready(function(e) {
	$("#cari").attr("disabled","disabled");
    $("#tabel-paket").load("include/tabel-paket.php");
	$("#tmpat-paging-tblpaket").load("include/paging-tabel-paket.php");
	
	$("#tabel-matapelajaran").load("include/tabel-matapelajaran.php");
	$("#tmpat-paging-tblpelajaran").load("include/paging-tabel-pelajaran.php");
	
	tampilpaketpelajaran();
	//$("#tabel-paketpelajaran").load("include/tabel-paketpelajaran.php");
	//$("#tmpat-paging-tblpaketpelajaran").load("include/paging-tabel-paketpelajaran.php");
	
	$("#loading-tambahdata-paket").hide();
	$("#loading-tambahdata-pelajaran").hide();
	$("#loading-tambahdata-paketpelajaran").hide();
	$("#btn-tambah-paket").click(function(e) {
		$("#loading-tambahdata-paket").show();
        $.ajax({
			type:"POST",
			data:"paket=" + $("#paket").val(),
			url:"include/kirim.php?kirim=datapaket&aksi=tambah",
			success: function(response){
				if(response!=""){
					$("#status-tambahdata-paket").attr("class","alert alert-warning");
					$("#sg-tambahdata-paket").html("Gagal");
					$("#isi-tambahdata-paket").html(response);
					$("#loading-tambahdata-paket").hide();
					$("#status-tambahdata-paket").show("fade","",1000,hilangtambah);
				}
				else{
					$("#status-tambahdata-paket").attr("class","alert alert-success");
					$("#sg-tambahdata-paket").html("Sukses");
					$("#isi-tambahdata-paket").html("Data telah disimpan");
					$("#form-tambahdata-paket").trigger("reset");
					$("#tabel-paket").load("include/tabel-paket.php");
					$("#loading-tambahdata-paket").hide();
					$("#status-tambahdata-paket").show("fade","",1000,hilangtambah);
				}
			}
		});
    });
	
	$("#btn-tambah-pelajaran").click(function(e) {
		$("#loading-tambahdata-pelajaran").show();
        $.ajax({
			type:"POST",
			data:"pelajaran=" + $("#pelajaran").val(),
			url:"include/kirim.php?kirim=datapelajaran&aksi=tambah",
			success: function(response){
				if(response!=""){
					$("#status-tambahdata-pelajaran").attr("class","alert alert-warning");
					$("#sg-tambahdata-pelajaran").html("Gagal");
					$("#isi-tambahdata-pelajaran").html(response);
					$("#loading-tambahdata-pelajaran").hide();
					$("#status-tambahdata-pelajaran").show("fade","",1000,hilangtambah);
				}
				else{
					$("#status-tambahdata-pelajaran").attr("class","alert alert-success");
					$("#sg-tambahdata-pelajaran").html("Sukses");
					$("#isi-tambahdata-pelajaran").html("Data telah disimpan");
					$("#form-tambahdata-pelajaran").trigger("reset");
					$("#tabel-matapelajaran").load("include/tabel-matapelajaran.php");
					$("#loading-tambahdata-pelajaran").hide();
					$("#status-tambahdata-pelajaran").show("fade","",1000,hilangtambah);
				}
			}
		});
    });
	
	$("#btn-tambah-paketpelajaran").click(function(e) {
        $("#loading-tambahdata-paketpelajaran").show();
		var datakirim= {
			paket:$("#paketpelajaranpaket").val(),
			pelajaran:$("#paketmatapelajaran").val(),
			guru:$("#paketpelajaranguru").val(),
			kkm:$("#paketpelajarankkm").val()
		};
		$.ajax({
			type:"POST",
			data:datakirim,
			url:"include/kirim.php?kirim=datapaketpelajaran&aksi=tambah",
			success: function(response){
				if(response!=""){
					$("#status-tambahdata-paketpelajaran").attr("class","alert alert-warning");
					$("#sg-tambahdata-paketpelajaran").html("Gagal");
					$("#isi-tambahdata-paketpelajaran").html(response);
					$("#loading-tambahdata-paketpelajaran").hide();
					$("#status-tambahdata-paketpelajaran").show("fade","",1000,hilangtambah);
				}
				else{
					$("#status-tambahdata-paketpelajaran").attr("class","alert alert-success");
					$("#sg-tambahdata-paketpelajaran").html("Sukses");
					$("#isi-tambahdata-paketpelajaran").html("Data telah disimpan");
					//$("#form-tambahdata-paketpelajaran").trigger("reset");
					tampilpaketpelajaran();
					$("#loading-tambahdata-paketpelajaran").hide();
					$("#status-tambahdata-paketpelajaran").show("fade","",1000,hilangtambah);
				}
			}
		});
    });
	
	$("#pilih-kolom").change(function(e) {
        if($(this).val()=="semua"){
			$("#select-pilih-kolom").hide();
		}
		else{
			$("#select-pilih-kolom").show();
			$("#select-pilih-kolom").load("include/tampil-kolom-paketpelajaran.php?kolom=" + $(this).val());
		}
    });
	
	$("#tampilan-data-paketpelajaran").click(function(e) {        
		 tampilpaketpelajaran();
    });
	
	$("#btn-cetakdata-paket").click(function(e) {
        window.open("./cetak/cetak-tabel-paket.php?print=yes");
    });
	
	$("#btn-cetakdata-pelajaran").click(function(e) {
        window.open("./cetak/cetak-tabel-matapelajaran.php?print=yes");
    });
	
	$("#btn-cetakdata-paketpelajaran").click(function(e) {
        window.open("./cetak/cetak-tabel-paketpelajaran.php?print=yes");
		return false;
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
		$("#id-hapus-paketpelajaran").html(str);
    });
	
	$("#btn-hapus-checkbox").click(function(e) {
		var value=$("#id-hapus-paketpelajaran").html();
		$.ajax({
			type:"POST",
			url:"include/kirim.php?kirim=datapaketpelajaran&aksi=hapuscheckbox",
			data:"id=" + value,
			success: function(response){
				if(response!=""){
						$("#status-hapusdata-paketpelajaran").attr("class","alert alert-warning");
						$("#sg-hapusdata-paketpelajaran").html("Gagal");
						$("#isi-hapusdata-paketpelajaran").html(response);
						$("#status-hapusdata-paketpelajaran").show("fade","",1000,hilangtambah);
					}
					else{
						tampilpaketpelajaran();
						$("#status-hapusdata-paketpelajaran").attr("class","alert alert-success");
						$("#sg-hapusdata-paketpelajaran").html("Sukses");
						var baris=value.split(",");
						$("#isi-hapusdata-paketpelajaran").html(baris.length + " baris data dihapus");
						$("#status-hapusdata-paketpelajaran").show("fade","",1000,hilangtambah);
						
					}
			}
		});
		
    });
	
	function hilangtambah(){
		setTimeout(function(){
			$("#status-tambahdata-paket").hide("fade","",1000);
			$("#status-tambahdata-pelajaran").hide("fade","",1000);
			$("#status-tambahdata-paketpelajaran").hide("fade","",1000);
			$("#status-hapusdata-paketpelajaran").hide("fade","",1000);
		},10000);
	}
	
	function tampilpaketpelajaran(){
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
	}
});
</script>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#form-tambah-paketpelajaran" id="tambah-paketpelajaran-btn" >Tambah Data</button> 
<button type="button" class="btn btn-primary" id="cetak-data-pelajaran" data-toggle="modal" data-target="#cetak-paketpelajaran">Cetak</button><br /><br />
<button type="button" class="btn btn-default" id="tampilan-data-paketpelajaran">Tampilkan</button> : <input type="text" maxlength="4" style="width:30px; text-align:right" class="text" id="banyak-baris-tampil" name="banyak-baris-tampil" value="15" /> baris dengan urutan  
<select name="kolom-tampil" id="kolom-tampil">
	<option value="id_paket_pelajaran" selected="selected">#</option>
    <option value="paket">PAKET</option>
    <option value="mata_pelajaran">MATA PELAJARAN</option>
    <option value="guru">GURU</option>
    <option value="kkm">KKM</option>
</select> 
<select name="naikturun-tampil" id="naikturun-tampil">
	<option value="asc">Naik</option>
    <option value="desc" selected="selected">Turun</option>
</select>
Menampilkan
<select name="pilih-kolom" id="pilih-kolom">
	<option value="semua" selected="selected">SEMUA</option>
	<option value="paket">PAKET</option>
    <option value="mata_pelajaran">MATA PELAJARAN</option>
    <option value="guru">GURU</option>
</select>
<select name="select-pilih-kolom" id="select-pilih-kolom" style="display:none">

</select>
<table class="table table-striped table-hover">
	<thead>
    	<tr>
        	<th><input type="checkbox" name="checkbox-head" class="checkbox cbhead" /></th>
        	<th>#</th>
            <th>Paket</th>
            <th>Mata Pelajaran</th>
            <th>Guru</th>
            <th>KKM</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody id="tabel-paketpelajaran">
    </tbody>
</table>
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus-bnyakdata" id="btn-hapus-checkbox-dialog">Hapus</button><br />
<div id="status-hapusdata-paketpelajaran" style="display:none">
	<strong id="sg-hapusdata-paketpelajaran"></strong> : <span id="isi-hapusdata-paketpelajaran"></span>
</div>
<div id="tmpat-paging-tblpaketpelajaran"></div>

<div id="tmpat-editpaket"></div>
<div id="tmpat-editpelajaran"></div>
<div id="tmpat-editpaketpelajaran"></div>

<div id="tmpat-hapuspaket"></div>
<div id="tmpat-hapuspelajaran"></div>
<div id="tmpat-hapuspaketpelajaran"></div>

<div id="tmpat-lihatpaketpelajaran"></div>

<div class="modal fade" id="hapus-bnyakdata" role="dialog">
	<div class="modal-dialog">
	    <div class="modal-content">
	  	  <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Hapus Data Warga Belajar</h4>
          </div>
          <div class="modal-body">
          	<div class="container-fluid">
          	<p>Hapus data dengan id <span id="id-hapus-paketpelajaran"></span> ?</p>
            </div>
          </div>
          <div class="modal-footer">
          	<button type="button" class="btn btn-danger btn-hapusdata-siswa" id="btn-hapus-checkbox" data-dismiss="modal">Hapus</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
          </div>
		</div>
	</div>
</div>

<?php
	include "include/aksi-tambahdata-paket.php";
	include "include/aksi-tambahdata-pelajaran.php";
	include "include/aksi-tambahdata-paketpelajaran.php";
	
	include "include/aksi-cetakdata-paket.php";
	include "include/aksi-cetakdata-matapelajaran.php";
	include "include/aksi-cetakdata-paketpelajaran.php";
?>