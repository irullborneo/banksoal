<?php
	$bulan=array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
?>
<script type="text/javascript">
	$(document).ready(function(e) {
        //$("#tabel-guru").load("include/tabel-guru.php");
		//$("#tmpat-paging-tblguru").load("include/paging-tabel-guru.php");
		tampilguru();
		$("#loading-tambahdata-guru").hide();
		$("#kolom-guru").change(function(e) {
    	    if($(this).val()==""){
				$("#select-pilih-guru").hide();
			}
			else{
				$("#select-pilih-guru").show();
				$("#select-pilih-guru").load("include/tampil-kolom-guru.php?kolom=" + $(this).val());
			}
    	});
		
		$("#nonip").click(function(e) {
            if($(this).is(':checked')){
				$("#nip").val("");
				$("#nip").attr("disabled","disabled");
				
			}
			else{
				$("#nip").removeAttr("disabled");
			}
        });
		
		$("#tampilan-data-guru").click(function(e) {
            tampilguru();
        });
		
		$("#btn-tambah-guru").click(function(e) {
			$("#loading-tambahdata-guru").show();
            var datakirim= {
				nip:$("#nip").val(),
				nama:$("#nama").val(),
				jk:$("input#jkmguru:checked").val(),
				alamat:$("#alamatguru").val(),
				tempatlahir:$("#tempatguru").val(),
				tgllahir:$("#thnguru").val() +"-"+ $("#blnguru").val() +"-"+ $("#tglguru").val(),
				sekolah:$("#sekolahguru").val(),
				pendidikan:$("#pendidikanakhirguru").val()
			};
			$.ajax({
				type:"POST",
				data:datakirim,
				url:"include/kirim.php?kirim=dataguru&aksi=tambah",
				success: function(response){
					if(response!=""){
						$("#status-tambahdata-guru").attr("class","alert alert-warning");
						$("#sg-tambahdata-guru").html("Gagal");
						$("#isi-tambahdata-guru").html(response);
						$("#loading-tambahdata-guru").hide();
						$("#status-tambahdata-guru").show("fade","",1000,hilangtambah);
					}
					else{
						$("#status-tambahdata-guru").attr("class","alert alert-success");
						$("#sg-tambahdata-guru").html("Sukses");
						$("#isi-tambahdata-guru").html("Data telah disimpan");
						$("#form-tambahdata-guru").trigger("reset");
						tampilguru();
						$("#loading-tambahdata-guru").hide();
						$("#status-tambahdata-guru").show("fade","",1000,hilangtambah);
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
			$("#id-hapus-guru").html(str);
	    });
		
		$("#btn-hapus-checkbox").click(function(e) {
			var value=$("#id-hapus-paketpelajaran").html();
			$.ajax({
				type:"POST",
				url:"include/kirim.php?kirim=dataguru&aksi=hapuscheckbox",
				data:"id=" + value,
				success: function(response){
					if(response!=""){
							$("#status-hapusdata-guru").attr("class","alert alert-warning");
							$("#sg-hapusdata-guru").html("Gagal");
							$("#isi-hapusdata-guru").html(response);
							$("#status-hapusdata-guru").show("fade","",1000,hilangtambah);
						}
						else{
							tampilguru();
							$("#status-hapusdata-guru").attr("class","alert alert-success");
							$("#sg-hapusdata-guru").html("Sukses");
							var baris=value.split(",");
							$("#isi-hapusdata-guru").html(baris.length + " baris data dihapus");
							$("#status-hapusdata-guru").show("fade","",1000,hilangtambah);
							
						}
				}
			});
		
    	});
		
		$("#btn-hapus-checkbox").click(function(e) {
			var value=$("#id-hapus-guru").html();
			$.ajax({
				type:"POST",
				url:"include/kirim.php?kirim=dataguru&aksi=hapuscheckbox",
				data:"id=" + value,
				success: function(response){
					if(response!=""){
						$("#status-hapusdata-guru").attr("class","alert alert-warning");
						$("#sg-hapusdata-guru").html("Gagal");
						$("#isi-hapusdata-guru").html(response);
						$("#status-hapusdata-guru").show("fade","",1000,hilangtambah);
					}
					else{
						tampilguru();
						$("#status-hapusdata-guru").attr("class","alert alert-success");
						$("#sg-hapusdata-guru").html("Sukses");
						var baris=value.split(",");
						$("#isi-hapusdata-guru").html(baris.length + " baris data dihapus");
						$("#status-hapusdata-guru").show("fade","",1000,hilangtambah);
						
					}
				}
			});
		
	    });
		
		$("#btn-cetak-guru").click(function(e) {
            window.open("./cetak/cetak-tabel-guru.php?print=yes&data=" + $("#cetak-guru-pkbm").val());
        });
		
		function hilangtambah(){
			setTimeout(function(){
				$("#status-tambahdata-guru").hide("fade","",1000);
				$("#status-hapusdata-guru").hide("fade","",1000);
				$("#status-hapusdata-guru").hide("fade","",1000);
			},10000);
		}
		
		function tampilguru(){
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
		}
    });
</script>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#form-tambah-guru" id="tambah-guru-btn" >Tambah Data</button> 
<button type="button" class="btn btn-primary" id="cetak-data-guru" data-toggle="modal" data-target="#cetak-guru">Cetak</button><br /><br />

<button type="button" class="btn btn-default" id="tampilan-data-guru">Tampilkan</button> : <input type="text" maxlength="4" style="width:30px; text-align:right" class="text" id="banyak-baris-tampil" name="banyak-baris-tampil" value="15" /> baris dengan urutan  
<select name="kolom-tampil" id="kolom-tampil">
	<option value="id_guru" selected="selected">#</option>
    <option value="nama">NAMA</option>
    <option value="jenis_kelamin">JENIS KELAMIN</option>
    <option value="id_sekolah">PKBM</option>
</select> 
<select name="naikturun-tampil" id="naikturun-tampil">
	<option value="asc">Naik</option>
    <option value="desc" selected="selected">Turun</option>
</select>
Menampilkan Kolom 
<select name="kolom-guru" id="kolom-guru">
	<option value="">SEMUA</option>
    <option value="jenis_kelamin">JENIS KELAMIN</option>
    <option value="id_sekolah">PKBM</option>
</select>
<select name="select-pilih-guru" id="select-pilih-guru" style="display:none">

</select>
<div class="table-responsive">
	<table class="table table-striped table-hover">
    	<thead>
        	<tr>
            	<th><input type="checkbox" name="checkbox-head" class="checkbox cbhead" /></th>
            	<th>#</th>
            	<th>NIP</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>PKBM</th>
            	<th>Alamat</th>
                <th>Pendidikan Akhir</th>
                <th>Aksi</th>
            </tr>
        </thead>
        
        <tbody id="tabel-guru">
        </tbody>
    </table>
</div>
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus-bnyakdata" id="btn-hapus-checkbox-dialog">Hapus</button><br />
<div id="status-hapusdata-guru" style="display:none">
	<strong id="sg-hapusdata-guru"></strong> : <span id="isi-hapusdata-guru"></span>
</div>
<div id="tmpat-paging-tblguru"></div>

<div id="dialog-editguru"></div>
<div id="dialog-hapusguru"></div>
<div id="dialog-lihatguru"></div>
<?php
	include "include/aksi-tambahdata-guru.php";
?>

<div class="modal fade" id="hapus-bnyakdata" role="dialog">
	<div class="modal-dialog">
	    <div class="modal-content">
	  	  <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Hapus Data Siswa</h4>
          </div>
          <div class="modal-body">
          	<div class="container-fluid">
          	<p>Hapus data dengan id <span id="id-hapus-guru"></span> ?</p>
            </div>
          </div>
          <div class="modal-footer">
          	<button type="button" class="btn btn-danger btn-hapusdata-siswa" id="btn-hapus-checkbox" data-dismiss="modal">Hapus</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
          </div>
		</div>
	</div>
</div>



<div class="modal fade" id="cetak-guru" role="dialog">
	<div class="modal-dialog">
	    <div class="modal-content">
	  	  <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Cetak Data</h4>
          </div>
          <div class="modal-body">
          	<div class="container-fluid">
                <form class="form-horizontal" id="form-tambahdata-sekolah" role="form">
                	<div class="form-group">
                    <label for="cetak-guru-pkbm" class="control-label">Cetak: </label>
                    <select id="cetak-guru-pkbm" name="cetak-guru-pkbm" class="form-control">
                    	<option value="semua">Semua</option>
                        <?php
						$querysekolah=mysql_query("SELECT id_sekolah, nama_sekolah FROM sekolah ORDER BY nama_sekolah ASC");
						while($sekolah=mysql_fetch_array($querysekolah)){
							echo "<option value=\"$sekolah[0]\">$sekolah[1]</option>
							";
						}
						?>
                    </select>
                    </div>
                </form>
            </div>
          </div>
          <div class="modal-footer">
          	<button type="button" class="btn btn-primary" id="btn-cetak-guru">Cetak</button>
          </div>
		</div>
	</div>
</div>