<script type="text/javascript">
$(document).ready(function(e) {
    $("#close-soal").click(function(e) {
        $("#form-tambah-listsoal").empty();
    });
	
	$("#btn-tmbah-ganda").click(function(e) {
        var g="0 a b c d e f g h i j k l m n o p q r s t u v w x y z";
		g=g.split(" ");
		var b=Number($("#banyak-ganda").html());
		$("#ganda-text").append("<li id='text-"+ (b+1) +"' style=\"margin:10px 0;\"> <input type=\"radio\" name='text-ganda' value=\""+ g[b+1] +"\" /><input type=\"text\" id=\"text2-ganda-"+ (b+1) +"\" name=\"text2-ganda-"+ (b+1) +"\" class=\"form-control\" /></li>");
		$("#ganda-gambar").append("<li id='gambar-"+ (b+1) +"' style=\"margin:10px 0;\" ><input type=\"radio\" name='gambar-ganda' value=\""+ g[b+1] +"\" /> <button type=\"button\" id=\"gambar2-ganda-"+ (b+1) +"\" name=\"gambar2-ganda-"+ (b+1) +"\" class=\"btn btn-default btn-pilih-gambar\" onmouseover=\"pilihGambar('gambar2-ganda-"+ (b+1) +"')\" data-toggle=\"modal\" data-target=\"#ganda-data\">Pilih Gambar</button><div id=\"letak-gambar-"+ (b+1) +"\"></div></li>");
		$("#banyak-ganda").html(b+1);
		if(b==2){
			$("#btn-kurang-ganda").removeAttr("disabled");
		}
		
    });
	
	$("#btn-kurang-ganda").click(function(e) {
        var b=Number($("#banyak-ganda").html());
		$("#text-" + b).remove();
		$("#gambar-" + b).remove();
		if(b==3){
			$(this).attr("disabled","disabled");
			
		}
		$("#banyak-ganda").html(b-1);
    });
	
	$("#tipe-jawaban").change(function(e) {
        if($(this).val()=="text"){
			$("#ganda-gambar").attr("style","display:none");
			$("#ganda-text").removeAttr("style");
		}
		else if($(this).val()=="gambar"){
			$("#ganda-text").attr("style","display:none");
			$("#ganda-gambar").removeAttr("style");
		}
    });
	
	$("#checkbox-buat").keypress(function(e) {
        var val=$(this).val();
		if(e.which==13 && val!=""){
			var no=Number($("#banyak-checkbox").html());
			$("#checkbox-tempat").append("<input type='checkbox' id='checkbox-"+ (no+1) +"' name='checkbox-jwb' class='cbjawab' value='"+val+"' /> <label for=\"checkbox-"+ (no+1) +"\" style='margin-right:15px'>"+val+"</label>");
			$(this).val("");
			$("#banyak-checkbox").html(no+1);
		}
    });
	
	$("#tipe").change(function(e) {
        if($(this).val()=="ganda"){
			$("#checkbox").attr("style","display:none");
			$("#ganda").removeAttr("style");
		}
		else if($(this).val()=="checkbox"){
			$("#ganda").attr("style","display:none");
			$("#checkbox").removeAttr("style");
		}
    });
	
	$( "#slider-persen" ).slider({
			range: "min",
			value: Number($("#persen-edit").html()),
			min: 1,
			max: 100,
			slide: function( event, ui ) {
				$( "#persen-benar" ).val( ui.value + "%" );
			}
		});
	$( "#persen-benar" ).val( $( "#slider-persen" ).slider( "value" ) + "%");
	
	$("#btn-pilih-gambar").mouseover(function(e) {
        $("#tempat-pilih-media").load("include/tampil-pilih-media.php?media=gambar");
    });
	$("#btn-pilih-cerita").mouseover(function(e) {
        $("#tempat-pilih-media").load("include/tampil-pilih-media.php?media=cerita");
    });
	
	$(".selected-close").click(function(e) {
        var id=$(this).attr("id");
		id=id.split("-");
		$(this).hide();
		$("#btn-pilih-"+id[1]).show();
		if(id[1]=="cerita"){
			$("#selected-cerita-"+id[2]).remove();
			$(this).html("no");
		}
		else if(id[1]=="gambar"){
			$("#media-gambar-"+id[2]).remove();
			$(this).html("no");
		}
    });
	
	$(".btn-pilih-gambar").mouseover(function(e) {
        $("#btn-pilih-aktif").html($(this).attr("id"));
		$("#tempat-ganda-gambar").load("include/tampil-ganda-media.php");
    });
	
	function loadgambar(){
		$("#tempat-ganda-gambar").load("include/tampil-ganda-media.php");
	}
	
	$("#btn-save-listsoal").click(function(e) {
        var tipesoal=$("#tipe").val();
		var soal=$("#soal").val();
		var g=$(".daftar-gambar").attr("id");
		if(g != undefined){
			g=g.split("-");
			var gambar=g[2];
		}
		var c=$(".list-cerita").attr("id");
		if(c != undefined){
			c=c.split("-");
			var cerita=c[2];
		}
		var tipejawaban=$("#tipe-jawaban").val();
		var banyakganda=Number($("#banyak-ganda").html());
		var textganda="";
		var strip=false;
		var jwbganda="";
		if(tipejawaban=="text"){
			for(var i=1;i<=banyakganda;i++){
				if(strip){
					textganda+="|";
				}
				textganda+=$("#text2-ganda-"+i).val();
				strip=true;
			}
			jwbganda=$("input[name='text-ganda']:checked").val();
		}
		
		else if(tipejawaban=="gambar"){
			for(var u=1;u<=banyakganda;u++){
				
				if(strip){
					textganda+="|";
				}
				var tg=$(".gandapilih-gambar-"+u).attr("id");
				tg=tg.split("-");
				textganda+=tg[2];
				strip=true;
			}
			jwbganda=$("input[name='gambar-ganda']:checked").val();
		}
		var checkbox="";
		var banyakcheckbox=Number($("#banyak-checkbox").html());
		var strip2=false;
		for(var k=1;k<=banyakcheckbox;k++){
			if(strip2){
				checkbox+="|";
			}
			checkbox+=$("#checkbox-"+k).val();
			strip2=true;
		}
		var persen=$("#persen-benar").val();
		persen=persen.replace("%","");
		
		var jawabcheckbox= new Array();
		$.each($("input[name='checkbox-jwb']:checked"), function() {
  			jawabcheckbox.push($(this).val());
		});
		jwbcb="";
		var strip3=false;
		for(var i =0; i<jawabcheckbox.length; i++){
			if(strip3){
				jwbcb +="|";
			}
			
			jwbcb += jawabcheckbox[i];
			strip3=true;
		}
		var jwb="";
		var pilihan="";
		if(tipesoal=="ganda"){
			pilihan=textganda;
			jwb=jwbganda;
		}
		else if(tipesoal=="checkbox"){
			pilihan=checkbox;
			jwb=jwbcb.replace("&", "&amp;").replace(">", "&gt;").replace("<", "&lt;").replace("\"", "&quot;").replace("'", "&#039;");
		}
		
		if($(".selected-close-gambar").html()=="no"){
			gambar="";
		}
		
		if($(".selected-close-cerita").html()=="no"){
			cerita="";
		}
		soal=soal.replace("&", "&amp;").replace(">", "&gt;").replace("<", "&lt;").replace("\"", "&quot;").replace("'", "&#039;");
		pilihan=pilihan.replace("&", "&amp;").replace(">", "&gt;").replace("<", "&lt;").replace("\"", "&quot;").replace("'", "&#039;");
		var datakirim={
			id:$("#idlistsoal").val(),
			soalpelajaran:$("#idsoaledit").val(),
			sl:soal,
			cr:cerita,
			gm:gambar,
			tipesl:tipesoal,
			tipejwb:tipejawaban,
			plhn:pilihan,
			jawab:jwb,
			prsn:persen
		};
		$.ajax({
			type:"POST",
			data:datakirim,
			url:"include/kirim.php?kirim=datasoal&aksi=editbarissoal",
			success: function(response){
				if(response!=""){
					$("#status-tambahdata-listsoal").attr("class","alert alert-warning");
					$("#sg-tambahdata-listsoal").html("Gagal");
					$("#isi-tambahdata-listsoal").html(response);
					$("#status-tambahdata-listsoal").show("fade","",1000,hilangtambah);
				}
				else{
					$("#status-tambahdata-listsoal").attr("class","alert alert-success");
					$("#sg-tambahdata-listsoal").html("Sukses");
					$("#isi-tambahdata-listsoal").html("Soal telah diperbaharui");
					//$("#form-tambahdata-paketpelajaran").trigger("reset");
					$("#status-tambahdata-listsoal").show("fade","",1000,hilangtambah);
					$("#form-tambah-listsoal").load("include/tampil-form-listsoal.php");
					var idz=$(".form-horizontal").attr("id");
		idz=idz.split("-");
		$("#list-soal").load("include/tampil-list-soal.php?idpelajaran="+ idz[2]);
				}
			}
		});
    });
	
	function hilangtambah(){
		setTimeout(function(){
			$("#status-tambahdata-listsoal").hide("fade","",1000);
		},10000);
	}
	
});


function batalgambarjg(ids){
		$("#ganda-gambar-"+ids).remove();
		$("#gambar2-ganda-"+ids).show();
		$("#selectedganda-close-"+ids).remove();
	}
function pilihGambar(id){
		document.getElementById("btn-pilih-aktif").innerHTML=id;
		loadgambar();
		
}

function batalgambar(id){
	var jk=id;
	batalgambarjg(jk);
	
}
</script>
<?php
	include "../../include/koneksi.php";
	$id=$_GET['id'];
	$listsoal=mysql_fetch_array(mysql_query("SELECT id_soal, id_soal_pelajaran, id_soal_cerita, tipe_soal, soal, tipe_jawab, pilihan, jawab, persen_benar, id_soal_gambar FROM soal WHERE id_soal='$id'"));
?>
<button type="button" class="close" id="close-soal">&times;</button>
<form id="form-listsoal" class="form-horizontal" role="form">
	<div class="form-group">
    	<label for="tipe" class="control-label">ID</label>
        <input type="text" class="form-control" id="idlistsoal" name="idlistsoal" value="<?php echo $listsoal['id_soal'] ?>" disabled="disabled"  />
    </div>
	<div class="form-group">
    	<label for="tipe" class="control-label">TIPE</label>
        <select id="tipe" name="tipe" class="form-control">
        	<?php
				if($listsoal['tipe_soal']=="ganda"){
					echo "<option value=\"ganda\" selected>GANDA</option>
            <option value=\"checkbox\">CHECKBOX</option>
					";
				}
				else if($listsoal['tipe_soal']=="checkbox"){
					echo "<option value=\"ganda\" selected>GANDA</option>
            <option value=\"checkbox\" selected>CHECKBOX</option>
					";
				}
			?>
        </select>
    </div>
	<div class="row">
    <div class="col-lg-6 col-md-6 col-md-6">
		<div class="form-group">
    		<label for="soal" class="control-label">SOAL</label>
        	<textarea class="form-control" rows="5" id="soal" name="soal"><?php echo $listsoal['soal']; ?></textarea>
            <br /><br />
           	<div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6" id="pilihan-gambar">
            <?php
				if($listsoal['id_soal_gambar']==0){
					echo "<button type=\"button\" class=\"btn btn-default\" id=\"btn-pilih-gambar\" data-toggle=\"modal\" data-target=\"#pilih-data\">Pilih Gambar</button>
            <button type=\"button\" class=\"close selected-close selected-close-gambar\" style=\"display:none\">no</button><br />
					";
				}
				else{
					$gambarurl=mysql_fetch_array(mysql_query("SELECT soal_gambar FROM soal_gambar WHERE id_soal_gambar='$listsoal[id_soal_gambar]'"));
					echo "<button type=\"button\" class=\"btn btn-default\" id=\"btn-pilih-gambar\" data-toggle=\"modal\" data-target=\"#pilih-data\" style=\"display:none\">Pilih Gambar</button>
					<button type=\"button\" class=\"close selected-close selected-close-gambar\" id=\"close-gambar-$listsoal[id_soal_gambar]\">&times;</button><br />
					<div class=\"img daftar-gambar\" id=\"media-gambar-".$listsoal['id_soal_gambar']."\" style=\"cursor:pointer;\"><img src='../$gambarurl[soal_gambar]' class=\"img img-thumbnail\" style=\"width:100%\" /></div>
					";
				}
			?>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6" id="pilihan-cerita">
            <?php
				if($listsoal['id_soal_cerita']==0){
					echo "<button type=\"button\" class=\"btn btn-default\" id=\"btn-pilih-cerita\" data-toggle=\"modal\" data-target=\"#pilih-data\">Pilih Cerita</button>
            <button type=\"button\" class=\"close selected-close selected-close-cerita\" style=\"display:none\">no</button><br />
					";
				}
				else{
					$cerita=mysql_fetch_array(mysql_query("SELECT awal_cerita FROM soal_cerita WHERE id_soal_cerita='$listsoal[id_soal_cerita]'"));
					echo "<button type=\"button\" class=\"btn btn-default\" id=\"btn-pilih-cerita\" data-toggle=\"modal\" data-target=\"#pilih-data\" style=\"display:none\">Pilih Cerita</button>
            <button type=\"button\" class=\"close selected-close selected-close-cerita\" id=\"close-cerita-$listsoal[id_soal_cerita]\" >&times;</button><br />
					<div class=\"well list-cerita\" id=\"selected-cerita-".$listsoal['id_soal_cerita']."\" style=\"font-size:10px; cursor:pointer;\">$cerita[awal_cerita]</div>
					";
				}
			?>
            </div>
            </div>
    	</div>
    </div>
    <div class="col-lg-1 col-md-1 col-md-1"></div>
    <div class="col-lg-5 col-md-5 col-md-5">
    	<div class="form-group">
        	<?php
				if($listsoal['tipe_soal']=="ganda")
					echo "<div id=\"ganda\">";
				else
					echo "<div id=\"ganda\" style=\"display:none\">";
			?>
            
            <label for="tipe-jawaban" class="control-label">TIPE JAWABAN</label>
            <select id="tipe-jawaban" class="form-control" name="tipe-jawaban">
            	<?php
					if($listsoal['tipe_jawab']=="text"){
						echo "<option value=\"text\" selected>TEXT</option>
                <option value=\"gambar\">GAMBAR</option>
						";
					}
					else{
						echo "<option value=\"text\">TEXT</option>
                <option value=\"gambar\" selected>GAMBAR</option>
						";
					}
				?>
            	
            </select>
            	<?php
					if($listsoal['tipe_jawab']=="text"){
						echo "<ol type=\"A\" id=\"ganda-text\" class=\"form form-inline\">";
					}
					else{
						echo "<ol type=\"A\" id=\"ganda-text\" class=\"form form-inline\" style=\"display:none\">";
					}
					$ganda=array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
					
					$no=explode("|",$listsoal['pilihan']);
					$n=1;
					for($i=0;$i<count($no);$i++){
						echo "<li id='text-$n' style=\"margin:10px 0;\" >
						";
							if($listsoal['jawab']==$ganda[$i]){
								echo "<input type=\"radio\" name='text-ganda' value=\"$ganda[$i]\" checked=\"checked\" />";
							}
							else{
								echo "<input type=\"radio\" name='text-ganda' value=\"$ganda[$i]\" />";
							}
							
						if($listsoal['tipe_jawab']=="text"){
							$pilihantext=explode(">",$no[$i]);
						echo "
							<input type=\"text\" id=\"text2-ganda-$n\" name=\"text2-ganda-$n\" class=\"form-control\"  value=\"$pilihantext[1]\"/>";
						
						}
						else{
							echo "
							<input type=\"text\" id=\"text2-ganda-$n\" name=\"text2-ganda-$n\" class=\"form-control\" />";
						}
						echo "</li>";
						$n++;
					}
				?>
                
                </ol>
                
            	<?php
					if($listsoal['tipe_jawab']=="gambar"){
						echo "<ol type=\"A\" id=\"ganda-gambar\">";
					}
					else{
						echo "<ol type=\"A\" id=\"ganda-gambar\" style=\"display:none\">";
					}
					$ganda=array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
					$no=explode("|",$listsoal['pilihan']);
					$n=1;
					for($i=0;$i<count($no);$i++){
						echo "<li id='gambar-$n' style=\"margin:10px 0;\" >
						";
							if($listsoal['jawab']==$ganda[$i]){
								echo "<input type=\"radio\" name='gambar-ganda' value=\"$ganda[$i]\" checked=\"checked\" />";
							}
							else{
								echo "<input type=\"radio\" name='gambar-ganda' value=\"$ganda[$i]\" />";
							}
							
						if($listsoal['tipe_jawab']=="gambar"){
							$pilihangambar=explode(">",$no[$i]);
							$urlgambar=mysql_fetch_array(mysql_query("SELECT id_soal_gambar, soal_gambar FROM soal_gambar WHERE id_soal_gambar='$pilihangambar[1]'"));
							echo "
							<button type=\"button\" id=\"gambar2-ganda-$n\" name=\"gambar2-ganda-$n\" class=\"btn btn-default btn-pilih-gambar\" data-toggle=\"modal\" data-target=\"#ganda-data\" style=\"display:none\">Pilih Gambar</button>
							<button type=\"button\" class=\"close selectedganda-close \" id=\"selectedganda-close-$n\" onclick=\"batalgambar('$n')\">&times;</button>
							<div class=\"img daftarganda-gambar\" id=\"ganda-gambar-$n\" style=\"cursor:pointer;\">
							<img src='../$urlgambar[soal_gambar]' id=\"gandapilih-gambar-$urlgambar[id_soal_gambar]\" class=\"img img-thumbnail gandapilih-gambar-$n\" style=\"width:100%\" />
							</div>
							";
						}
						else{
							echo "
							<button type=\"button\" id=\"gambar2-ganda-$n\" name=\"gambar2-ganda-$n\" class=\"btn btn-default btn-pilih-gambar\" data-toggle=\"modal\" data-target=\"#ganda-data\">Pilih Gambar</button>";
						}
						echo "
							<div id=\"letak-gambar-$n\"></div>
						</li>";
						$n++;
					}
				?>
                
                </ol>
                <button type="button" class="btn btn-primary" id="btn-tmbah-ganda">Tambah</button>
                <button type="button" class="btn btn-warning" id="btn-kurang-ganda">Kurang</button>
                <div id="banyak-ganda" style="display:none"><?php echo count($no) ?></div>
                <div id="btn-pilih-aktif" style="display:none"></div>
            </div>
            <?php
				if($listsoal['tipe_soal']=="checkbox")
					echo "<div id=\"checkbox\">";
				else{
					echo "<div id=\"checkbox\" style=\"display:none\">";
				}
			?>
            
            	<label for="checkbox-buat" class="control-label" >CHECKBOX</label>
            	<input type="text" class="form-control form-lg" id="checkbox-buat" />
				<br />
                <div id="checkbox-tempat">
                <?php
					if($listsoal['tipe_soal']=="checkbox"){
						$checkbox=explode("|",$listsoal['pilihan']);
						$jwbchecbox=explode("|",$listsoal['jawab']);
						for($i=0;$i<count($checkbox);$i++){
							if(in_array($checkbox[$i],$jwbchecbox)){
								echo "<input type='checkbox' id='checkbox-". ($i+1) ."' name='checkbox-jwb' class='cbjawab' value='$checkbox[$i]' checked=\"checked\" /> <label for=\"checkbox-". ($i+1) ."\" style='margin-right:15px'>$checkbox[$i]</label>";
							}
							else{
								echo "<input type='checkbox' id='checkbox-". ($i+1) ."' name='checkbox-jwb' class='cbjawab' value='$checkbox[$i]' /> <label for=\"checkbox-". ($i+1) ."\" style='margin-right:15px'>$checkbox[$i]</label>";
							}
							
						}
					}
				?>
                </div>
                <br /><br /><br />
                <p><label for="persen-benar">Kebenaran: </label>
                	<input type="text" id="persen-benar" style="border:0; color:#f6931f; font-weight:bold;"  />
                </p>
                <div id="slider-persen"></div>
                <div id="persen-edit" style="display:none">
                <?php
				echo $listsoal['persen_benar'];
				?>
                </div>
                <div id="banyak-checkbox" style="display:none">
                <?php
				if($listsoal['tipe_soal']=="checkbox"){
					echo count($checkbox);
				}
				else{
					echo 0;
				}
				?>
                </div>
            </div>
        </div>
    </div>
    </div>
    <button type="button" class="btn btn-lg btn-success" id="btn-save-listsoal">Selesai</button>
</form>

