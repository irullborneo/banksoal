<?php
	function generate($u){
		$pengacak = 'abcdefghijklmnopqrstuvwxyz1234567890';
		$string = '';
		for($i = 0; $i < $u; $i++) {
   			$pos = rand(0, strlen($pengacak)-1);
   			$string .= $pengacak{$pos};
   		}
    	return $string;
	}
	
	echo generate(6) ."-". generate(4);
?>