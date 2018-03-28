<script type="text/javascript">
$(document).ready(function(e) {
	$(".number-soal").click(function(e) {
		$(".number-soal").removeClass("number-selected");
		$("#loading").fadeIn("fast");
		$("#soal-ulangan").load("include/soal.php?no=" + $(this).html(),function(e){
				$("#loading").fadeOut("fast");
			});
		$(this).addClass("number-selected");
	});
});
</script>
<?php
	session_start();
	$soal=explode("-",$_SESSION['soal']);
	echo "
	<div style=\"margin:auto\">
	";
	for($i=1;$i<count($soal);$i++){
		if($_SESSION['jawab-'.$i]=="" && $i==1){
			echo "<div class=\"number-soal belum-jawab number-selected\">".$i."</div>";
		}
		else if($_SESSION['jawab-'.$i]==""){
			echo "<div class=\"number-soal belum-jawab\">".$i."</div>";
		}
		else{
			echo "<div class=\"number-soal sudah-jawab\">".$i."</div>";
		}
		
		if($i%10==0){
			echo "<br /><br />";
		}
	}
	echo "<div class=\"clear\"></div>
	</div>
	";
?>