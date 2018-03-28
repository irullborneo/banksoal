<?php
	session_start();
	if(isset($_SESSION['id_siswa'])){
		header ("location: ./");
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Masuk | Bank Soal Sistem Kolaborasi Kurkulum 2013</title>
<link rel="shortcut icon" href="img/icon.png" />
<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.10.4.custom.css" />
<link rel="stylesheet" type="text/css" href="css/signin.css" />
<script type="text/javascript" src="jquery/jquery-2.0.2.js"></script>
<script type="text/javascript" src="jquery/bootstrap.js"></script>
<script type="text/javascript" src="jquery/jquery-ui-1.10.4.custom.js"></script>
</head>
<script type="text/javascript">
	$(document).ready(function(e) {
        aturTengah();
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
	function hilang(){
		setTimeout(function(){
			$("#notice").hide("bounce","",1000);
		},5000);
	}
	function ceklogin(form){
		var username = form.username.value;
		var password = form.password.value;
		if(username=="" || password==""){
			$("#notice").html("Masukkan Username dan Password");
			form.username.focus();
			$("#notice").show("bounce","",1000,hilang);
		}
		else{
			$("#loading").fadeIn();
			$("#overlay-loading").fadeTo("normal",0.1);
			$.ajax({
				type:"POST",
				data:"username="+username+"&password="+password,
				url:"include/ceklogin.php",
				success: function(response){
					if(response==""){
						window.location="./";
					}
					else{
						$("#loading").fadeOut();
						$("#overlay-loading").hide();
						$("#notice").html(response);
						form.username.focus();
						$("#notice").show("bounce","",1000,hilang);
					}
				}
			});
		}
		return false;
	}
</script>

<body>
<div id="notice" class="alert alert-warning"></div>
<div id="loading"><img src="img/loading.gif" /></div>
<div id="overlay-loading"></div>
<div class="form-login">
	<form class="form-signin" method="post" onsubmit="return ceklogin(this)" role="form">
        <h2 class="form-signin-heading">Masuk Warga Belajar</h2>
        <label for="username" class="sr-only">Username</label>
        <input type="text" name="username" id="username" class="form-control" placeholder="Username" autofocus />
        <label for="password" class="sr-only">Password</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Password" />
        <input class="btn btn-lg btn-primary btn-block" type="submit" value="Masuk" />
	</form>
</div> <!-- /container -->
</body>
</html>