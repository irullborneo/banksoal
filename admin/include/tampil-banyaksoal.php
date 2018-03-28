<?php
	include "../../include/koneksi.php";
	$id=$_GET['id'];
	$banyaksoal=mysql_num_rows(mysql_query("SELECT * FROM soal WHERE id_soal_pelajaran='$id'"));
	
?>
<script type="text/javascript">
$(document).ready(function(e) {
    $( "#slider-soal" ).slider({
			range: "min",
			value: Number($("#totalsoal").html()),
			min: 1,
			max: Number($("#totalsoal").html()),
			slide: function( event, ui ) {
				$( "#banyaksoal" ).val( ui.value );
			}
		});
	$( "#banyaksoal" ).val( $( "#slider-soal" ).slider( "value" ));
});
</script>
<label for="banyaksoal">Banyak Soal</label>
<input type="text" id="banyaksoal" style="border:0; color:#f6931f; font-weight:bold;" readonly  />
<div id="slider-soal"></div>
<div id="totalsoal" style="display:none"><?php echo $banyaksoal ?></div>