<?php
# Maybe as Function with Params to give ?

if (isset($_POST["name"]) & isset($_POST["street"]) & isset($_POST["zip"]) & isset($_POST["city"]) & isset($_POST["description"]) /* & isset(PICs/KeyWords) */) {
	// New Names and SQL Security
	$name = addslashes($_POST["name"]);
	$street = addslashes($_POST["street"]);
	$zip = addslashes($_POST["zip"]);
	$city = addslashes($_POST["city"]);
	$description = addslashes($_POST["description"]);
	// Creating 1. SQL Statement(s)
	$sql_memInput = "INSERT INTO memorials (name, street, zip, city, description) VALUES
	('".$name."', '".$street."', '".$zip."', '".$city."', '".$description."');";
	$sql_getMemId = "SELECT id FROM memorials WHERE name = '".$name."'' and zip = '".$zip."';";
	// Execute SQL
	$sql_memRet = mysqli_query($db, $sql_memInput.$sql_getMemId);

	while ($fetcher = mysqli_fetch_array($sql_memRet)) {
		$memorialID = $fetcher["id"];
	}


	
	// ..
}


?>