<?php
	// Sicherungsmuster f�r SQL eingaben als Funktion
	function save_sql($input) {
	
		$suchmuster = array();
		$suchmuster[0] = '/�/';
		$suchmuster[1] = '/�/';
		$suchmuster[2] = '/�/';
		$suchmuster[3] = '/�/';
		$suchmuster[4] = '/�/';
		$suchmuster[5] = '/�/';
		$suchmuster[6] = '/�/';

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