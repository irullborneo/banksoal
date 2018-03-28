<script type="text/javascript">
$(document).ready(function(e) {
	tampilsekolah();
	
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
		$("#id-hapus-sekolah").html(str);
    });
	
	$("#btn-hapus-checkbox").click(function(e) {
		var value=$("#id-hapus-sekolah").html();
		$.ajax({
			type:"POST",
			url:"include/kirim.php?kirim=datasekolah&aksi=hapuscheckbox",
			data:"id=" + value,
			success: function(response){
				if(response!=""){
						$("#status-hapusdata-sekolah").attr("class","alert alert-warning");
						$("#sg-hapusdata-sekolah").html("Gagal");
						$("#isi-hapusdata-sekolah").html(response);
						$("#status-hapusdata-sekolah").show("fade","",1000,hilangtambah);
					}
					else{
						tampilsekolah();
						$("#status-hapusdata-sekolah").attr("class","alert alert-success");
						$("#sg-hapusdata-sekolah").html("Sukses");
						var baris=value.split(",");
						$("#isi-hapusdata-sekolah").html(baris.length + " baris data dihapus");
						$("#status-hapusdata-sekolah").show("fade","",1000,hilangtambah);
						
					}
			}
		});
		
    });
	
	$("#btn-tambah-sekolah").click(function(e) {
		var datakirim= {
			nama:$("#namapkmb").val(),
			alamat:$("#alamatpkmb").val(),
			telpon:$("#telpon").val()
		};
		$.ajax({
			type:"POST",
			data:datakirim,
			url:"include/kirim.php?kirim=datasekolah&aksi=tambah",
			success: function(response){
				if(response!=""){
					$("#status-tambahdata-sekolah").attr("class","alert alert-warning");
					$("#sg-tambahdata-sekolah").html("Gagal");
					$("#isi-tambahdata-sekolah").html(response);
					$("#status-tambahdata-sekolah").show("fade","",1000,hilangtambah);
				}
				else{
					$("#status-tambahdata-sekolah").attr("class","alert alert-success");
					$("#sg-tambahdata-sekolah").html("Sukses");
					$("#isi-tambahdata-sekolah").html("Data telah disimpan");
					$("#form-tambahdata-sekolah").trigger("reset");
					tampilsekolah();
					$("#status-tambahdata-sekolah").show("fade","",1000,hilangtambah);
				}
			}
		});
    });
	
	$("#btn-cetakdata-sekolah").click(function(e) {
        window.open("./cetak/cetak-tabel-sekolah.php?print=yes");
		return false;
    });
	
	function hilangtambah(){
		setTimeout(function(){
			$("#status-hapusdata-sekolah").hide("fade","",1000);
			$("#status-tambahdata-sekolah").hide("fade","",1000);
		},10000);
	}
	
   	function tampilsekolah(){
		$("#tabel-sekolah").load("include/tabel-sekolah.php");
		$("#tmpat-paging-sekolah").load("include/paging-tabel-sekolah.php");
	}
});
</script>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#form-tambah-sekolah" id="tambah-sekolah-btn" >Tambah Data</button> 
<button type="button" class="btn btn-primary" id="cetak-data-pelajaran" data-toggle="modal" data-target="#cetak-sekolah">Cetak</button><br /><br />
<table class="table table-striped table-hover">
	<thead>
    	<tr>
        	<th><input type="checkbox" name="checkbox-head" class="checkbox cbhead" /></th>
            <th>#</th>
            <th>PKBM</th>
            <th>Alamat</th>
            <th>Telepon</th>
            <th>Penanggung Jawab</th>
            <th>Aksi</th>
        </tr> 
    </thead>
    <tbody id="tabel-sekolah">
    </tbody>
</table>
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus-bnyakdata" id="btn-hapus-checkbox-dialog">Hapus</button><br />
<div id="status-hapusdata-sekolah" style="display:none">
	<strong id="sg-hapusdata-sekolah"></strong> : <span id="isi-hapusdata-sekolah"></span>
</div>
<div id="tmpat-paging-sekolah"></div>

<div id="tmpat-editsekolah"></div>
<div id="tmpat-hapussekolah"></div>

<div class="modal fade" id="hapus-bnyakdata" role="dialog">
	<div class="modal-dialog">
	    <div class="modal-content">
	  	  <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Hapus Data Sekolah</h4>
          </div>
          <div class="modal-body">
          	<div class="container-fluid">
          	<p>Hapus data dengan id <span id="id-hapus-sekolah"></span> ?</p>
            </div>
          </div>
          <div class="modal-footer">
          	<button type="button" class="btn btn-danger btn-hapusdata-sekolah" id="btn-hapus-checkbox" data-dismiss="modal">Hapus</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
          </div>
		</div>
	</div>
</div>
<?php
	include "include/aksi-tambahdata-sekolah.php";
?>

<div class="modal fade" id="cetak-sekolah" role="dialog">
	<div class="modal-dialog">
	    <div class="modal-content">
	  	  <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Cetak Data</h4>
          </div>
          <div class="modal-body">
          	<p>Cetak data ?</p>
          </div>
          <div class="modal-footer">
          	<a href="#" target="_blank" class="btn btn-primary" id="btn-cetakdata-sekolah">Cetak</a>
          </div>
		</div>
	</div>
</div>