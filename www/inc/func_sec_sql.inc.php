<?php
	// Sicherungsmuster für SQL eingaben als Funktion
	function secure_sql($input) {
	
		$pattern = array();
		$pattern[0] = '/Ü/';
		$pattern[1] = '/ü/';
		$pattern[2] = '/Ä/';
		$pattern[3] = '/ä/';
		$pattern[4] = '/Ö/';
		$pattern[5] = '/ö/';
		$pattern[6] = '/ß/';

		$replacement = array();
		$replacement[0] = '&Uuml;';
		$replacement[1] = '&uuml;';
		$replacement[2] = '&Auml;';
		$replacement[3] = '&auml;';
		$replacement[4] = '&Ouml;';
		$replacement[5] = '&ouml;';
		$replacement[6] = '&szlig;';
	
		$erg = addslashes(preg_replace($pattern, $replacement, $input));
		return $erg;
	}
?>
