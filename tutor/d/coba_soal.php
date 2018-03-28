<?php
	include "../../include/koneksi.php" ;
	
	$querysoal=mysql_query("SELECT t.tipe, t.soal_ke, t.soal_cerita, s.soal, s.pilihan, s.jawab, s.gambar FROM tipe_soal as t, soal as s WHERE t.id_tipe=s.id_tipe");
	echo "<ol>";
	while($soal=mysql_fetch_array($querysoal)){
		
		if(isset($soal[2])){
			echo "<div style=\"margin:10px;0;5px;0\">$soal[2]</div>";
		}
		echo "
			<li>$soal[3]
				
			</li>
		";
	}
	echo "</ol>";
?>

<ol>
	<li>
    	satuduaksjdliaini ib lib 
        	<ul>
            	<li>skk</li><li>skk</li><li>skk</li><li>skk</li>
            </ul>
    </li>
    <li>
    	satuduaksjdliaini ib lib 
        	<ul>
            	<li>skk</li><li>skk</li><li>skk</li><li>skk</li>
            </ul>
    </li>
    <div style="margin:10px;0;5px;0">aslghaeiosghofisop jnop ihnoi nhoi bhoi nbloinh ohoi </div>
    <li>
    	satuduaksjdliaini ib lib 
        	<ul>
            	<li>skk</li><li>skk</li><li>skk</li><li>skk</li>
            </ul>
    </li>
    <li>
    	satuduaksjdliaini ib lib 
        	<ul>
            	<li>skk</li><li>skk</li><li>skk</li><li>skk</li>
            </ul>
    </li>
</ol>