<script type="text/javascript">
	$(document).ready(function(e) {
		$("#loading-import").hide();
		var imporfile={
			beforeSend: function() {
   		        $("#btn-import-siswa").attr("disabled",""); // Membuat button upload jadi tidak bisa terklik

        	},
			
			uploadProgress: function(event, position, total, percentComplete) {
            	  $("#loading-import").show();
        	},
			
			success:function(data, textStatus, jqXHR) { 
				$("#btn-import-siswa").removeAttr("disabled");
				$("#loading-import").hide();
            if ( data.trim() == "error1" || data.trim() == "error2" || data.trim() == "error3" || data.trim() == "error4"){
                switch(data.trim()){
					case "error1" :
						$("#isi-error").html("Ekstensi atau format file yg diunggah salah.");
						break;
					case "error2" :
						$("#isi-error").html("File tidak ada, pilih file yg ingin di unggah");
						break;
					case "error3" :
						$("#isi-error").html("Ukuran file yg diunggah lebih dari 500kb");
						break;
					case "error4" :
						$("#isi-error").html("File gagal terunggah, coba sekali lagi.");
						break;
				}
				
				$("#alert-import-file").show("fade","",1000,hilang);
				
            } else {
                $("#hasil-import-data-siswa").html(data);
				$("#status-import").attr("class",$("#class-status-import").html());
				$("#status-import-hasil").html($("#status-import-hidden").html());
				$("#isi-status-import-active").html($("#isi-status-import").html());
            }
        },
        error: function()
        {
            $("#isi-error").html("Tidak dapat mengupload");

        }
		};
		
        $("#form-import-data-siswa").ajaxForm(imporfile);
		function hilang(){
			setTimeout(function(){
				$("#alert-import-file").hide("fade","",1000);
			},10000);
		}
    });
</script>

<div id="form-import-data">
    	<form id="form-import-data-siswa" enctype="multipart/form-data" action="include/kirim.php?kirim=importsiswa" method="post" name="form-import-data-siswa" role="form" >
    	<p>
        <span class="text-info">
        Import data dengan file yang ber-ekstensi Comma Separated Values <code>(.csv)</code>.
		Ukuran file harus <span class="text text-alert">kurang dari 500kb <code>(<500kb)</code></span><br  />
        File tersebut dapat di unduh <a href="./include/download.php" class="text-alert"><b>di sini.</b></a>
        </span>
        </p>
        <p>
        <span class="text-info">
        <label for="file-import" class="control-label">Silahkan pilih file di komputer </label> <input type="file" id="file-import" name="file-import"/>
        </span>
        </p>
        <p>
        <span class="text-info">
        <label for="pemisah-kolom" class="control-label">Dengan pemisah antara kolom : </label> <input type="text" id="pemisah-kolom" style="width:30px" name="pemisah-kolom" value=";" maxlength="1" />
        </span>
        </p>
        <br />
        <input type="submit" class="btn btn-primary" id="btn-import-siswa" value="Import" /><img src="../img/loading.gif" style="width:20px; height:20px" id="loading-import" />
        </form><br />

	    <div class="alert alert-danger" style="display:none" id="alert-import-file" role="alert">
        	<strong>ERROR </strong>: <span id="isi-error">Gagal</span>
        </div>
</div>
<hr />

<div id="hasil-import-data-siswa"></div>