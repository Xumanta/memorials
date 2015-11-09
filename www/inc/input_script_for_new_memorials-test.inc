<?php
# Maybe as Function with Params to give ?

if (isset($_POST["name"]) & isset($_POST["street"]) & isset($_POST["zip"]) & isset($_POST["city"]) & isset($_POST["description"]) /* & isset(PICs/KeyWords) */) {
	// New Names and SQL Security
	$name = addslashes($_POST["name"]);
	$street = addslashes($_POST["street"]);
	$zip = addslashes($_POST["zip"]);
	$city = addslashes($_POST["city"]);
	$description = addslashes($_POST["description"]);
	$keywords = strtolower(addslashes($_POST["keywords"]));
	// Creating 1. SQL Statement(s)
	$sql_memInput = "INSERT INTO memorials (name, street, zip, city, description) VALUES
	('".$name."', '".$street."', '".$zip."', '".$city."', '".$description."');";
	$sql_getMemId = "SELECT id FROM memorials WHERE name = '".$name."'' and zip = '".$zip."';";
	// Execute SQL
	$sql_memRet = mysqli_query($db, $sql_memInput.$sql_getMemId);

	// Gets memorial ID
	while ($fetcher = mysqli_fetch_array($sql_memRet)) {
		$memorialID = $fetcher["id"];
	}

	// Gets all Keywords for comparing
	$sql_getKeyword = "SELECT * FROM keywords;";
	$sql_alreadyKw = mysqli_query($db, $sql_getKeyword);
	$counter = 0;
	$fetcher = "";
	$alreadyKw = array();
	while ($fetcher = mysqli_fetch_array($sql_alreadyKw)) {
		$alreadyKw[$counter] = array('id' => $fetcher["id"], 'word' => $fetcher["word"]);
		counter++;
	}

	// Gets all Pictures for comparing
	$sql_getPics = "SELECT * FROM pictures;";
	$sql_alreadyPic = mysqli_query($db, $sql_getKeyword);
	$counter = 0;
	$fetcher = "";
	$alreadyPic = array();
	while ($fetcher = mysqli_fetch_array($sql_alreadyPic)) {
		$alreadyPic[$counter] = array('id' => $fetcher["id"], 'picsum' => $fetcher["picsum"], 'title' => $fetcher["title"]);
		counter++;
	}

	// Given Keywords to an array
	$temp = preg_replace(" ", ",", $keywords);
	$keywords = explode(",", preg_replace(",,", ",", $temp));
	unset($temp);

	// Comparing Keywords
	$sql_linkMemKey = "";
	for ($counter = 0, $counter < count($keywords), $counter++) {
		$tmp_word1 = $keywords[$counter];
		$tmp_found = false;
		for ($counter2 = 0, $counter2 < count($alreadyKw), $counter2++) {
			$tmp_word2 = $alreadyKw[$counter2['word']];
			if ($tmp_word1 == $tmp_word2) {
				// If Words are similar...
				$tmp_found = true;
				$sql_linkMemKey .= "INSERT INTO memorialkeyword (wordid, memorialid) VALUES (".$alreadyKw[$counter2['id']].",".$memorialID.");";
				break;
			}
		}
		if (!$tmp_found) {
			$sql_linkMemKey .= "INSERT INTO keywords (word) VALUES ('".$tmp_word1."''); INSERT INTO memorialkeyword (wordid, memorialid) VALUES ((SELECT id FROM keywords WHERE word = '".$tmp_word1."'),".$memorialID.");";
		}
	}

	// Comparing Pics ...
	
	// ...
}


?>