<?php
include "../../include/koneksi.php";

$jadwalquery=mysql_query("SELECT id_jadwal_ujian, jadwal_ujian, tgl_awal, tgl_akhir FROM ujian_jadwal");
$arr = array();
while($jadwal=mysql_fetch_array($jadwalquery)){
	$j=explode(" ",$jadwal['tgl_awal']);
	$tanggal=explode("-",$j[0]);
	$tgl=$tanggal[2];
	$bln=$tanggal[1];
	$thn=$tanggal[0];
	$i=0;
	
	$j2=explode(" ",$jadwal['tgl_akhir']);
	do{
		$jdw=date("Y-m-d H:i:s", mktime(0, 0, 0, $bln, ($tgl+$i),$thn));
		$wdj=explode(" ",$jdw);
		$temp = array(
			"date" => $jdw,
			"title" => "",
			"description" => ""
		);
		array_push($arr, $temp);
		$query = mysql_query("SELECT u.jadwal_ujian, u.banyak_soal, u.waktu, mp.mata_pelajaran, p.paket, u.id_ujian from ujian as u, soal_pelajaran as sp, paket_pelajaran as pp, mata_pelajaran as mp, paket as p WHERE u.id_soal_pelajaran=sp.id_soal_pelajaran AND sp.id_paket_pelajaran=pp.id_paket_pelajaran AND pp.id_paket=p.id_paket AND pp.id_pelajaran=mp.id_pelajaran AND u.id_jadwal_ujian='$jadwal[id_jadwal_ujian]' AND u.jadwal_ujian like '%$wdj[0]%'");
		while($ujian=mysql_fetch_array($query)){
			$temp = array(
				"date" => $ujian[0],
				"title" => "<span style=\"cursor:pointer\" onclick=\"tampilujian('$ujian[5]')\">".$ujian[3] ." (Paket ". $ujian[4] .")</span>",
				"description" => "Banyak soal yang diujikan yaitu: ".$ujian[1]."<br />Dengan waktu pengerjaan: ". $ujian[2]." Menit"
			);
			array_push($arr, $temp);
		}
		
		$i++;
	}while($jdw!=$jadwal['tgl_akhir']);
	
}
$data = json_encode($arr);
echo $data;
/*$result = mysql_query($query) or die(mysql_error());

while ($row = mysql_fetch_array($result)) {
    $temp = array(
        "date" => $row[0],       
        "title" => "<span style=\"cursor:pointer\" onclick=\"tampilujian('$row[5]')\">".$row[3] ." (Paket ". $row[4] .")</span>",
        "description" => "Banyak soal yang diujikan yaitu: ".$row[1]."<br />Dengan waktu pengerjaan: ". $row[2]." Menit"
); 

    
}*/

?>