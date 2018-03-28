<?php
	session_start();
	unset($_SESSION['id_guru']);
	session_destroy();
	header("Location: ./");
?>