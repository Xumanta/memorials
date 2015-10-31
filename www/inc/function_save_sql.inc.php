<?php
	// Sicherungsmuster für SQL eingaben als Funktion
	function save_sql($input) {
	
		$suchmuster = array();
		$suchmuster[0] = '/Ü/';
		$suchmuster[1] = '/ü/';
		$suchmuster[2] = '/Ä/';
		$suchmuster[3] = '/ä/';
		$suchmuster[4] = '/Ö/';
		$suchmuster[5] = '/ö/';
		$suchmuster[6] = '/ß/';

		$ersetzungen = array();
		$ersetzungen[0] = '&Uuml;';
		$ersetzungen[1] = '&uuml;';
		$ersetzungen[2] = '&Auml;';
		$ersetzungen[3] = '&auml;';
		$ersetzungen[4] = '&Ouml;';
		$ersetzungen[5] = '&ouml;';
		$ersetzungen[6] = '&szlig;';
	
		$erg = addslashes(preg_replace($suchmuster, $ersetzungen, $input));
		return $erg;
	}
?>