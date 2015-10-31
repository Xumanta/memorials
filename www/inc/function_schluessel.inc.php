<?php
// Einseitige Verschlüsselung der Login-Daten
function schluessel($input) {
	
	$output1 = hash("haval256,5",$input);
	$output2 = md5($input);
	$output3 = base64_encode($input);
	$output4 = hash("gost",$input);
	$output5 = sha1($input);
	$roh_output = base64_encode($output1.$output2.$output3.$output4.$output5);
	$output = hash("whirlpool",$roh_output);
	return $output;

}	
?>