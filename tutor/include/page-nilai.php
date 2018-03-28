<script type="text/javascript">
$(document).ready(function(e) {
    $("#tempat-nilai").load("include/tampil-nilai.php?id="+ $("#ujian").val() );
	$("#ujian").change(function(e) {
        $("#tempat-nilai").load("include/tampil-nilai.php?id="+ $(this).val() );
    });
});
</script>
<form class="form-horizontal" role="form">
	<label for="ujian" class="control-label">Ujian</label>
    <select id="ujian" name="ujian" class="form-control">
    <?php
		$queryujian=mysql_query("SELECT id_jadwal_ujian, jadwal_ujian, tgl_awal, tgl_akhir FROM ujian_jadwal ORDER BY tgl_awal DESC");
		while($ujian=mysql_fetch_array($queryujian)){
			$tgl_awal=explode(" ",$ujian['tgl_awal']);
			echo "<option value=\"$ujian[id_jadwal_ujian]\">$ujian[jadwal_ujian] (Tanggal ".date("d/m/Y", strtotime($tgl_awal[0])).")</option>";
		}
	?>
    </select>
</form>
<div id="tempat-nilai" style="margin-top:20px">
</div>