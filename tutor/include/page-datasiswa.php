<?php
	$bulan=array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
?>
<script type="text/javascript">
$(document).ready(function(e){
	$("#table-siswa").load("include/tabel-siswa.php?baris=" + $("#banyak-baris-tampil").val() + "&kolom=" + $("#kolom-tampil").val() + "&urut=" + $("#naikturun-tampil").val() + "&paket=" + $("#paket-tampil").val() + "&p=1" + "&sekolah=" + $("#sekolah-tampil").val() );
	$("#tmpat-paging-tblsiswa").load("include/paging-tabel-siswa.php?p=1&baris=" + $("#banyak-baris-tampil").val() + "&paket=" + $("#paket-tampil").val() + "&sekolah=" + $("#sekolah-tampil").val());
});
$(document).ready(function(e) {
	
	$("#loading-tambahdata-siswa").hide();
    $(".cbbody").on("change",function(e){
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
	
	$("#generate-btn").click(function(e) {
        $.ajax({
			url:"include/generate.php",
			success: function(response){
				var generate=response.split("-");
				$("#usermurid").val(generate[0]);
				$("#sandimurid").val(generate[1])
			}
		});
    });
	
	$("#tambahdata-siswa-btn").on("click",function(e){
		$("#loading-tambahdata-siswa").show();
		var datakirim= {
			nis:$("#nismurid").val(),
			nama:$("#namamurid").val(),
			jk:$("input#jkmurid:checked").val(),
			user:$("#usermurid").val(),
			pass:$("#sandimurid").val(),
			paket:$("#paketmurid").val(),
			tempat:$("#tempatmurid").val(),
			tgl:$("#tglmurid").val(),
			bln:$("#blnmurid").val(),
			thn:$("#thnmurid").val(),
			alamat:$("#alamatmurid").val(),
			sekolah:$("#sekolahmurid").val(),
			pendidikanakhir:$("#pendidikanakhirmurid").val()
		};
		
		$.ajax({
			type:"POST",
			data:datakirim,
			url:"include/kirim.php?kirim=datasiswa&aksi=tambah",
			success: function(response){
				if(response!=""){
					$("#status-tambahdata-siswa").attr("class","alert alert-warning");
					$("#sg-tambahdata-siswa").html("Gagal");
					$("#isi-tambahdata-siswa").html(response);
					$("#loading-tambahdata-siswa").hide();
					$("#status-tambahdata-siswa").show("fade","",1000,hilang);
				}
				else{
					$("#status-tambahdata-siswa").attr("class","alert alert-success");
					$("#sg-tambahdata-siswa").html("Sukses");
					$("#isi-tambahdata-siswa").html("Data telah disimpan");
					$("#form-tambahdata-siswa").trigger("reset");
					$("#cari").val("");
					$("#table-siswa").load("include/tabel-siswa.php?baris=" + $("#banyak-baris-tampil").val() + "&kolom=" + $("#kolom-tampil").val() + "&urut=" + $("#naikturun-tampil").val() + "&paket=" + $("#paket-tampil").val() + "&p=1" + "&sekolah=" + $("#sekolah-tampil").val());
	$("#tmpat-paging-tblsiswa").load("include/paging-tabel-siswa.php?p=1&baris=" + $("#banyak-baris-tampil").val() + "&paket=" + $("#paket-tampil").val() + "&sekolah=" + $("#sekolah-tampil").val());
					$("#loading-tambahdata-siswa").hide();
					$("#status-tambahdata-siswa").show("fade","",1000,hilang);
				}
			}
		});
		
	});
	
	$("#tampilan-data-siswa").click(function(e) {
        var baris=$("#banyak-baris-tampil").val();
		var kolom=$("#kolom-tampil").val();
		var urut=$("#naikturun-tampil").val();
		var paket=$("#paket-tampil").val();
		$("#table-siswa").load("include/tabel-siswa.php?baris=" + $("#banyak-baris-tampil").val() + "&kolom=" + $("#kolom-tampil").val() + "&urut=" + $("#naikturun-tampil").val() + "&paket=" + $("#paket-tampil").val() + "&p=1" + "&sekolah=" + $("#sekolah-tampil").val());
		$("#tmpat-paging-tblsiswa").load("include/paging-tabel-siswa.php?p=1&baris=" + $("#banyak-baris-tampil").val() + "&paket=" + $("#paket-tampil").val() + "&sekolah=" + $("#sekolah-tampil").val() );
    });
	
	$("#btn-hapus-checkbox").click(function(e) {
		var value=$("#id-hapus-siswa").html();
		$.ajax({
			type:"POST",
			url:"include/kirim.php?kirim=datasiswa&aksi=hapuscheckbox",
			data:"id=" + value,
			success: function(response){
				if(response!=""){
						$("#status-hapusdata-siswa").attr("class","alert alert-warning");
						$("#sg-hapusdata-siswa").html("Gagal");
						$("#isi-hapusdata-siswa").html(response);
						$("#status-hapusdata-siswa").show("fade","",1000,hilanghapus);
					}
					else{
						$("#cari").val("");
						$("#table-siswa").load("include/tabel-siswa.php?baris=" + $("#banyak-baris-tampil").val() + "&kolom=" + $("#kolom-tampil").val() + "&urut=" + $("#naikturun-tampil").val() + "&paket=" + $("#paket-tampil").val() + "&p=1" + "&sekolah=" + $("#sekolah-tampil").val());
						$("#tmpat-paging-tblsiswa").load("include/paging-tabel-siswa.php?p=1&baris=" + $("#banyak-baris-tampil").val() + "&paket=" + $("#paket-tampil").val() + "&sekolah=" + $("#sekolah-tampil").val());
						$("#status-hapusdata-siswa").attr("class","alert alert-success");
						$("#sg-hapusdata-siswa").html("Sukses");
						var baris=value.split(",");
						$("#isi-hapusdata-siswa").html(baris.length + " baris data dihapus");
						$("#status-hapusdata-siswa").show("fade","",1000,hilanghapusall);
						
					}
			}
		});
		
    });
	
	function hilanghapusall(){
		setTimeout(function(){
			$("#status-hapusdata-siswa").hide("fade","",1000);
		},10000);
	}
	
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
		$("#id-hapus-siswa").html(str);
    });
	
	$("#btn-cetakdata-siswa").click(function(e) {
		var data="";
		var kolom=$("#kolom-tampil-cetak").val();
		var urut=$("#naikturun-tampil-cetak").val();
		var paket=$("#paket-tampil-cetak").val();
		var pilih =$("#pilih-cetak-datasiswa").val();
		var sekolah=$("#sekolah-tampil-cetak").val();
		if(pilih=="data_siswa"){
			data=kolom +"-"+ urut +"-"+ paket +"-"+ sekolah;
        	window.open("./cetak/cetak-tabel-siswa.php?print=yes&data=" + data);
		}
		else if(pilih=="kartu_ujian"){
			data=kolom +"-"+ urut +"-"+ paket +"-"+ sekolah;
			window.open("./cetak/cetak-kartu-siswa.php?print=yes&data=" + data);
		}
		else{
			alert("Error");
		}
		return false;
    });
	
	function hilang(){
			setTimeout(function(){
				$("#status-tambahdata-siswa").hide("fade","",1000);
			},10000);
		}
});
</script>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#form-tambah-data" id="tambah-data-btn" >Tambah Data</button> 
<button type="button" class="btn btn-primary" id="import-data-siswa">Import</button>
<button type="button" class="btn btn-primary" id="cetak-data-siswa" data-toggle="modal" data-target="#cetak-data">Cetak</button>
<br /><br />
<button type="button" class="btn btn-default" id="tampilan-data-siswa">Tampilkan</button> : <input type="text" maxlength="4" style="width:30px; text-align:right" class="text" id="banyak-baris-tampil" name="banyak-baris-tampil" value="15" /> baris dengan urutan  
<select name="kolom-tampil" id="kolom-tampil">
	<option value="id_siswa" selected="selected">#</option>
    <option value="nama">NAMA</option>
     <option value="jenis_kelamin">JENIS KELAMIN</option>
    <option value="id_paket">PAKET</option>
</select> 
<select name="naikturun-tampil" id="naikturun-tampil">
	<option value="asc">Naik</option>
    <option value="desc" selected="selected">Turun</option>
</select>
 pada paket 
<select name="paket-tampil" id="paket-tampil">
	<option value="semua" selected="selected">Semua</option>
	<?php
		$querytampilpaket=mysql_query("SELECT id_paket, paket FROM paket ORDER BY id_paket ASC");
		while($tampilpaket=mysql_fetch_array($querytampilpaket)){
			echo "<option value='$tampilpaket[id_paket]'>$tampilpaket[paket]</option>";
		}
	?>
</select>
<select name="sekolah-tampil" id="sekolah-tampil" style="display:none">
	<option value="semua" selected="selected">Semua</option>
    <?php
		$querytampilsekolah=mysql_query("SELECT id_sekolah, nama_sekolah FROM sekolah ORDER BY nama_sekolah ASC");
		while($tampilsekolah=mysql_fetch_array($querytampilsekolah)){
			if($tampilsekolah['id_sekolah']==$admin['id_sekolah']){
				echo "<option value='$tampilsekolah[id_sekolah]' selected=\"selected\">$tampilsekolah[nama_sekolah]</option>";
			}
			else{
				echo "<option value='$tampilsekolah[id_sekolah]'>$tampilsekolah[nama_sekolah]</option>";
			}
		}
	?>
</select>
<div class="table-responsive">
	<form name="checkbox-form">
	<table class="table table-striped table-hover">
    	<thead>
        	<tr>
            	<th><input type="checkbox" name="checkbox-head" class="checkbox cbhead" /></th>
                <th>#</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
            	<th>Paket</th>
                <th>PKBM</th>
            	<th>Username</th>
            	<th>Password</th>
                <th>Aksi</th>
            </tr>
        </thead>
        
        <tbody id="table-siswa">
        </tbody>
    </table>
    </form>
</div>
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus-bnyakdata" id="btn-hapus-checkbox-dialog">Hapus</button><br />
<div id="status-hapusdata-siswa" style="display:none">
	<strong id="sg-hapusdata-siswa"></strong> : <span id="isi-hapusdata-siswa"></span>
</div>
<div id="tmpat-paging-tblsiswa"></div>


<div id="tmpat-editsiswa"></div>

<div id="tmpat-lihatsiswa"></div>

<div id="tmpat-hapussiswa"></div>

<div class="modal fade" id="hapus-bnyakdata" role="dialog">
	<div class="modal-dialog">
	    <div class="modal-content">
	  	  <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Hapus Data Siswa</h4>
          </div>
          <div class="modal-body">
          	<div class="container-fluid">
          	<p>Hapus data dengan id <span id="id-hapus-siswa"></span> ?</p>
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
	include "aksi-tambahdata-siswa.php";
	include "aksi-cetakdata-siswa.php";
?>