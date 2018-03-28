<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Aktifkan Akun | Bank Soal Sistem Kolaborasi Kurkulum 2013</title>
<link rel="shortcut icon" href="../img/icon.png" />
<link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />
<script type="text/javascript" src="../jquery/jquery-2.0.2.js"></script>
<script type="text/javascript" src="../jquery/bootstrap.js"></script>
</head>
<script type="text/javascript">
$(document).ready(function(e) {
	aturTengah();
	$("#kodeaktivasi").focus();
	
	$("#btn-aktivasi-guru").click(function(e) {
         var kode=$("#kodeaktivasi").val();
		 var datakirim= {
			 kodeaktiv:kode,
		 };
		 $.ajax({
			type:"POST",
			data:datakirim,
			url:"include/kirim.php?kirim=aktivasiguru&aksi=aktif",
			success: function(response){
				if(response=="notice1"){
					$("#status-aktivasi-guru").attr("class","alert alert-warning");
						$("#sg-aktivasi-guru").html("Gagal");
						$("#isi-aktivasi-guru").html("Kode yang anda masukkan salah");
						$("#loading-aktivasi-guru").hide();
						$("#status-aktivasi-guru").show("fade","",1000,hilangtambah());
				}
				else{
					$("#status-aktivasi-guru").attr("class","alert alert-success");
						$("#sg-aktivasi-guru").html("Sukses");
						$("#isi-aktivasi-guru").html("Akun telah diaktifkan");
						//$("#form-tambahdata-paketpelajaran").trigger("reset");
						$("#loading-aktivasi-guru").hide();
						$(".btn-simpan-guru").attr("id","simpan-guru-"+response);
						$("#status-aktivasi-guru").show("fade","",1000,hilangtambah());
						$("#form-aktivasi-guru").hide();
						$("#form-login-guru").show();
				}
			}
		 });
    });
	
	$("#password").keyup(function(e) {
        var p1=$(this).val();
		var p2=$("#password1").val();
		if(p1=="" && p2==""){
			$("#kesamaan-password").empty();
		}
		
		else if(p1==p2){
			$("#kesamaan-password").removeClass("text-danger");
			$("#kesamaan-password").addClass("text-success");
			$("#kesamaan-password").html("Sama");
		}
		
		else{
			$("#kesamaan-password").removeClass("text-success");
			$("#kesamaan-password").addClass("text-danger");
			$("#kesamaan-password").html("Tidak Sama");
		}
		
    });
	
	$("#password1").keyup(function(e) {
        var p1=$(this).val();
		var p2=$("#password").val();
		if(p1=="" && p2==""){
			$("#kesamaan-password").empty();
		}
		
		else if(p1==p2){
			$("#kesamaan-password").removeClass("text-danger");
			$("#kesamaan-password").addClass("text-success");
			$("#kesamaan-password").html("Sama");
		}
		
		else{
			$("#kesamaan-password").removeClass("text-success");
			$("#kesamaan-password").addClass("text-danger");
			$("#kesamaan-password").html("Tidak Sama");
		}
		
    });
	
	$(".btn-simpan-guru").click(function(e) {
        var id=$(this).attr("id");
		id=id.split("-");
		var datakirim= {
			 idguru:id[2],
			 user:$("#username").val(),
			 pass1:$("#password").val(),
			 pass2:$("#password1").val()
		 };
		  $.ajax({
			type:"POST",
			data:datakirim,
			url:"include/kirim.php?kirim=aktivasiguru&aksi=login",
			success: function(response){
				if(response!=""){
					$("#status-aktivasi-guru").attr("class","alert alert-warning");
						$("#sg-aktivasi-guru").html("Gagal");
						$("#isi-aktivasi-guru").html(response);
						$("#loading-aktivasi-guru").hide();
						$("#status-aktivasi-guru").show("fade","",1000,hilangtambah());
				}
				else{
					$("#status-aktivasi-guru").attr("class","alert alert-success");
						$("#sg-aktivasi-guru").html("Sukses");
						$("#isi-aktivasi-guru").html("Akun telah di Simpan");
						//$("#form-tambahdata-paketpelajaran").trigger("reset");
						$("#loading-aktivasi-guru").hide();
						$("#status-aktivasi-guru").show("fade","",1000,lanjut());

				}
			}
		 });
    });
	
	function hilangtambah(){
			setTimeout(function(){
				$("#status-aktivasi-guru").hide("fade","",1000);
			},3000);
		}
		
	function lanjut(){
			setTimeout(function(){
				window.location="./";
			},3000);
		}
});
	$(window).resize(function(e) {
        aturTengah();
    });
	function aturTengah(){
		var halaman = $(window).height();
		var konten = $(".form-login").height();
		konten = (halaman/2) - (konten/2);
		$(".form-login").css("margin-top", konten + "px");
	}
</script>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Tutor Bank Soal</a>
        </div>
      </div>
    </nav>
    
    <div class="container">
    	<div class="form-login" style="font-size:24px">
    		<form class="form-horizontal form-signin" id="form-aktivasi-guru" role="form">
        		<div class="row">
                	<div class="col-lg-2 col-md-2 col-sm-1">&nbsp;
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12">
                    	<div class="form-group">
        					<label for="kodeaktivasi" class="control-label">Kode Aktivasi</label>
        					<input type="text" name="kodeaktivasi" class="form-control" id="kodeaktivasi" maxlength="9" />	<br />
                            <button type="button" class="btn btn-lg btn-primary" id="btn-aktivasi-guru">Aktifkan</button> <br /><br />
                            
        				</div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-1">&nbsp;
                    </div>
            	</div>
        		
        	</form>
            
            
            <form class="form-horizontal form-signin" id="form-login-guru" style="display:none"  role="form">
            	<div class="row">
                	<div class="col-lg-2 col-md-2 col-sm-1">&nbsp;
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12">
            			<div class="form-group">
                			<label for="username" class="control-label">Username Baru</label>
                	    	<input type="text" name="username" class="form-control" id="username" maxlength="20" placeholder="masukkan username" />
                		</div>
               			<div class="form-group">
                			<label for="password" class="control-label">Password Baru</label>
                    		<input type="password" name="password" class="form-control" id="password" maxlength="12" placeholder="masukkan password" /><br />	
    	                	<input type="password" name="password1" class="form-control" id="password1" maxlength="12" placeholder="ulang password" />
                            <div style="font-weight:bold">Password: <span id="kesamaan-password"></span></div><br />
                            <button type="button" class="btn btn-lg btn-primary btn-simpan-guru">Simpan</button>
        	        	</div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-1">&nbsp;
                    </div>
            	</div>
            </form>
            <div id="status-aktivasi-guru" style="display:none; font-size:12px">
                				<strong id="sg-aktivasi-guru"></strong> : <span id="isi-aktivasi-guru"></span> 
                			</div>
        </div>
    </div>
</body>
</html>