<?php
	mysql_connect("localhost","root","") or die ("<script>alert(\"Tidak Terkoneksi dengan Database\");</script>");
	mysql_select_db("banksoal") or die("<script>alert(\"Database Tidak Ada\");</script>");
?>