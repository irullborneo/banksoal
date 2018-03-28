<?php
	function totalbadge($kolom){
		$total=mysql_num_rows(mysql_query("SELECT * FROM $kolom WHERE lihat='0000-00-00'"));
		return $total;
	}
?>