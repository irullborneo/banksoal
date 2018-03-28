<script type="text/javascript">
$(document).ready(function(e) {
    $("#simpan-area").hide();
	tampilformedit();
	tampiillistsoal();
	$("#btn-edit-soalpelajaran").click(function(e) {
		$("#edit-area").hide();
        $("#simpan-area").show();
		$("#paketpelajaranpaket").removeAttr("disabled");
		$("#paketmatapelajaran").removeAttr("disabled");
		$("#paketpelajaranguru").removeAttr("disabled");
		$("#paketpelajaranuntuk").removeAttr("disabled");
		$("#paketpelajaranpaket").focus();
    });
	
	$("#btn-simpan-soalpelajaran").click(function(e) {
        $("#edit-area").show();
        $("#simpan-area").hide();
		$("#paketpelajaranpaket").attr("disabled","disabled");
		$("#paketmatapelajaran").attr("disabled","disabled");
		$("#paketpelajaranguru").attr("disabled","disabled");
		$("#paketpelajaranuntuk").attr("disabled","disabled");
		var datakirim= {
				id:$("#idsoaledit").val(),
				paket:$("#paketpelajaranpaket").val(),
				pelajaran:$("#paketmatapelajaran").val(),
				guru:$("#paketpelajaranguru").val(),
				untuk:$("#paketpelajaranuntuk").val()
		};
		$.ajax({
				type:"POST",
				data:datakirim,
				url:"include/kirim.php?kirim=datasoal&aksi=editsoalpelajaran",
				success: function(response){
					if(response!=""){
						$("#status-tambahdata-soal").attr("class","alert alert-warning");
						$("#sg-tambahdata-soal").html("Gagal");
						$("#isi-tambahdata-soal").html(response);
						$("#loading-tambahdata-soal").hide();
						$("#status-tambahdata-soal").show("fade","",1000,hilangtambah);
					}
					else{
						$("#status-tambahdata-soal").attr("class","alert alert-success");
						$("#sg-tambahdata-soal").html("Sukses");
						$("#isi-tambahdata-soal").html("Soal telah diedit");
						//$("#form-tambahdata-paketpelajaran").trigger("reset");
						tampilformedit();
						$("#loading-tambahdata-soal").hide();
						$("#status-tambahdata-soal").show("fade","",1000,hilangtambah);
					}
				}
			});
    });
	
	$("#btn-batal-soalpelajaran").click(function(e) {
        $("#edit-area").show();
        $("#simpan-area").hide();
		$("#paketpelajaranpaket").attr("disabled","disabled");
		$("#paketmatapelajaran").attr("disabled","disabled");
		$("#paketpelajaranguru").attr("disabled","disabled");
		$("#paketpelajaranuntuk").attr("disabled","disabled");
		tampilformedit()
    });
	
	 $("#btn-simpan-cerita").click(function(e) {
		var val=CKEDITOR.instances.editor1.getData();
		var datakirim={
			cerita:val
		};
        $.ajax({
			type:"POST",
			data:datakirim,
			url:"include/kirim.php?kirim=datasoal&aksi=tambahcerita",
			success: function(response){
				if(response!=""){
						$("#status-tambahdata-cerita").attr("class","alert alert-warning");
						$("#sg-tambahdata-cerita").html("Gagal");
						$("#isi-tambahdata-cerita").html(response);
						$("#status-tambahdata-cerita").show("fade","",1000,hilangtambah);
				}
				else{
					$("#status-tambahdata-cerita").attr("class","alert alert-success");
						$("#sg-tambahdata-cerita").html("Sukses");
						$("#isi-tambahdata-cerita").html("Cerita telah dibuat");
						//$("#form-tambahdata-paketpelajaran").trigger("reset");
						$("#tambah-cerita").trigger("reset");
						$("#loading-tambahdata-cerita").hide();
						$("#status-tambahdata-cerita").show("fade","",1000,hilangtambah);
				}
			}
		});
    });
	
	$("#li-daftar-cerita").click(function(e) {
        $("#daftar-cerita").load("include/tampil-daftar-cerita.php");
    });
	
	$("#li-daftar-gambar").click(function(e) {
        $("#daftar-gambar").load("include/tampil-daftar-gambar.php");
    });
	
	$("#tambah-soal-btn").click(function(e) {
        $("#form-tambah-listsoal").load("include/tampil-form-listsoal.php");
    });
	
	function tampiillistsoal(){
		var id=$(".form-horizontal").attr("id");
		id=id.split("-");
		$("#list-soal").load("include/tampil-list-soal.php?idpelajaran="+ id[2]);
	}
		
	function tampilformedit(){
		var id=$(".form-horizontal").attr("id");
		id=id.split("-");
		$(".form-edit-soal").load("include/tampil-edit-soal.php?edit="+ id[2]);
	}
	
	function hilangtambah(){
			setTimeout(function(){
				$("#status-tambahdata-soal").hide("fade","",1000);
				$("#status-tambahdata-cerita").hide("fade","",1000);
			},10000);
		}
	
	var options = { 
        beforeSend: function() 
        {
			var b=Number($("#banyak-gambar-upload").html()) + 1;
			$("#gambar-tempat").append("<div class=\"col-lg-3 col-md-3 col-sm-3\" id='col-"+b+"'><div id=\"progress-"+b+"\" class=\"progress-bar progress-bar-striped\" role=\"progressbar\" aria-valuenow=\"0\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width:0%\"><span id='persen-"+b+"' style='display:none'>100%</span></div></div>");
			
            $("#upload-gambar").attr("disabled",""); // Membuat button upload jadi tidak bisa terklik

        },
        uploadProgress: function(event, position, total, percentComplete) 
        {
			var u=Number($("#banyak-gambar-upload").html()) + 1;
			$("#progress-"+u).removeAttr("aria-valuenow");
			$("#progress-"+u).removeAttr("style");
			$("#progress-"+u).attr("aria-valuenow",percentComplete);
			$("#progress-"+u).attr("style","width:"+percentComplete+"%");
			$("#persen-"+u).removeAttr("style");
			$("#persen-"+u).html(percentComplete+"%");
			alert("df");
        },
        success:function(data, textStatus, jqXHR) { 
            if ( data.trim() == "error1"){
				var z=Number($("#banyak-gambar-upload").html()) + 1;
                $("#progress-"+z).hide();
				$("#col-"+z).remove();
                
				$("#status-tambahdata-gambar").attr("class","alert alert-warning");
				$("#sg-tambahdata-gambar").html("Peringatan");
				$("#isi-tambahdata-gambar").html("Format file tidak didukung");
				$("#status-tambahdata-gambar").show("fade","",1000,hilangtambah);
				
                $("#upload-gambar").removeAttr("disabled");
                $("#upload-gambar").html("Upload");
            } 
			else if ( data.trim() == "error2"){
				var z=Number($("#banyak-gambar-upload").html()) + 1;
                $("#progress-"+z).hide();
				$("#col-"+z).remove();
                
				$("#status-tambahdata-gambar").attr("class","alert alert-warning");
				$("#sg-tambahdata-gambar").html("Peringatan");
				$("#isi-tambahdata-gambar").html("Ukuran gambar terlalu besar, maksimum <code>500kb</code>");
				$("#status-tambahdata-gambar").show("fade","",1000,hilangtambah);
				
                $("#upload-gambar").removeAttr("disabled");
                $("#upload-gambar").html("Upload");
            }
			else {
				var i=Number($("#banyak-gambar-upload").html()) + 1;
				$("#banyak-gambar-upload").html(i);
				$("#persen-"+i).html("100%");
				setTimeout(function(){
					$("#progress-"+i).hide();
					$("#col-"+i).append("<img src='"+data+"' id='img-"+i+"' class='img img-thumbnail' style='width:100%' />");
				},500);
                $("#upload-gambar").removeAttr("disabled"); // Mengaktifkan kembali buton upload
                //Jika anda ingin menghilang progress bar setelah upload selesai hilangkan komentar script dibawah ini
                //$("#progress").hide();
                
            }
        },
        error: function()
        {
			$("#status-tambahdata-gambar").attr("class","alert alert-danger");
				$("#sg-tambahdata-gambar").html("ERROR");
				$("#isi-tambahdata-gambar").html("Tidak dapat mengupload");
				$("#status-tambahdata-gambar").show("fade","",1000,hilangtambah);
        }
         
    }; 

     // kirim form dengan opsi yang telah dibuat diatas
     $("#form-upload").ajaxForm(options);
	 
	 function hilangtambah(){
		setTimeout(function(){
			$("#status-tambahdata-gambar").hide("fade","",1000);
		},10000);
	}
});
</script>
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 panel" style="padding:5px; background-color:#CCC">
<div class="pull-left">
	<a href="./?p=data_soal" class="btn btn-warning">&laquo; Kembali</a>
</div>
<div id="edit-area" class="pull-right">
	<button class="btn btn-primary" id="btn-edit-soalpelajaran">Edit</button>
</div>
<div id="simpan-area" class="pull-right">
	<button class="btn btn-success" id="btn-simpan-soalpelajaran">Simpan</button>
    <button class="btn btn-danger" id="btn-batal-soalpelajaran">Batal</button>
</div>
</div>
</div>

<form class="form-horizontal form-edit-soal" id="form-soal-<?php echo $_GET['edit']?>" role="form">

</form>
<div id="status-tambahdata-soal" style="display:none">
   <strong id="sg-tambahdata-soal"></strong> : <span id="isi-tambahdata-soal"></span> 
</div>
<hr />
<button type="button" class="btn btn-primary" id="tambah-soal-btn" >Tambah Soal</button> 
<button type="button" class="btn btn-primary" id="cerita-data-soal" data-toggle="modal" data-target="#cerita-data">Kelola Cerita</button>
<button type="button" class="btn btn-primary" id="gambar-data-soal" data-toggle="modal" data-target="#gambar-data">Kelola Gambar</button>
<br /><br />
<div id="form-tambah-listsoal">
</div><br />
<div id="status-tambahdata-listsoal" style="display:none">
	<strong id="sg-tambahdata-listsoal"></strong> : <span id="isi-tambahdata-listsoal"></span> 
</div>
<hr />
<div id="list-soal">
</div>

<div class="modal fade" id="cerita-data" role="dialog">
	<div class="modal-dialog modal-lg">
	    <div class="modal-content">
	  	  <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Kelola Cerita</h4>
          </div>
          <div class="modal-body">
          	<div class="container-fluid">
            	<ul class="nav nav-tabs">
                	<li class="active"><a data-toggle="tab" href="#tambah-cerita">Tambah</a></li>
                    <li><a data-toggle="tab" id="li-daftar-cerita" href="#daftar-cerita">Daftar</a></li>
                </ul>
                
                <div class="tab-content">
                	<div id="tambah-cerita" class="tab-pane fade in active">
                    	<h3 class="sub-header">Tambah Cerita</h3>
                        <form id="tambah-cerita">
                    	<textarea id="editor1" rows="20" class="col-sm-12"></textarea>
                         <script type="text/javascript">
						 	CKEDITOR.replace( 'editor1' );
						 </script>
                         <br /><br />
                         <button type="button" class="btn btn-primary" id='btn-simpan-cerita'>Simpan</button>
                         </form>
                         <br /><br />
                         <div id="status-tambahdata-cerita" style="display:none">
                			<strong id="sg-tambahdata-cerita"></strong> : <span id="isi-tambahdata-cerita"></span> 
                		</div>
                    </div>
                    <div id="daftar-cerita" class="tab-pane fade">
                    	
                    </div>
                    
                    <div id="edit-cerita" class="tab-pane fade">
                    
                    </div>
                </div>
                <div id="aktif-cerita" style="display:none"></div>
          </div>
		</div>
	</div>
    </div>
</div>


<div class="modal fade" id="gambar-data" role="dialog">
	<div class="modal-dialog modal-lg">
	    <div class="modal-content">
	  	  <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Kelola Gambar</h4>
          </div>
          <div class="modal-body">
          	<div class="container-fluid">
            	<ul class="nav nav-tabs">
                	<li class="active"><a data-toggle="tab" href="#tambah-gambar">Tambah</a></li>
                    <li><a data-toggle="tab" id="li-daftar-gambar" href="#daftar-gambar">Daftar</a></li>
                </ul>
                
                <div class="tab-content">
                	<div id="tambah-gambar" class="tab-pane fade in active">
                    	<div id="unggah-gambar">
                        	<h3 class="sub-header">Unggah Gambar</h3>
                            <p>
        						<span class="text-info">
        						Gambar yang dapat diunggah yaitu dengan ekstensi <code>jpg</code>, <code>png</code>, dan <code>gif</code> dengan ukuran gambar kurang dari 500kb <code>(<500kb)</code>
        						</span>
        					</p>
                    		<form id="form-upload" method="post" action="include/kirim.php?kirim=datasoal&aksi=tambahgambar" enctype="multipart/form-data">
   								<input type="file" class="form-control"  name="gambar" id="gambar" /><br />
   								<button style="cursor:pointer" type="submit" class="btn btn-primary" id="upload-gambar">Unggah</button>

							</form>
                            <br />
                            <div id="status-tambahdata-gambar" style="display:none">
                				<strong id="sg-tambahdata-gambar"></strong> : <span id="isi-tambahdata-gambar"></span>                			</div>
                        </div>
                        <div id="banyak-gambar-upload" style="display:none">0</div>
                        <div id="gambar-terbaru">
                        	<h3 class="sub-header">Gambar Terbaru</h3>
                        	<div class="row" id="gambar-tempat">
                            	
                        	</div>
                        </div>
                    </div>
                    <div id="daftar-gambar" class="tab-pane fade">
                    </div>
                </div>
            </div>
          </div>
		</div>
	</div>
</div>

<div id="tempat-pilih-media">
</div>

<div id="tempat-ganda-gambar">
</div>

<div id="tempat-hapus-listsoal">
</div>