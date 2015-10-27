<?php
if (isset($_POST[""])) { // Damit nicht immer alles ausgegeben wird
            $sqlAus = "SELECT * FROM `memorials`"; // SELECT Befehl
			$teildb = mysqli_query($db, $sqlAus);
			while ($fetched = mysqli_fetch_array($teildb))
            {
                $content .= "<div class=\"attraktion\">
                        <center><h4>".$fetched['name']."</h4></center>
                        <p><b>Adresse:</b><br> ".$fetched['street']."<br>".$fetched['zip']." ".$fetched['city']."</p><br>
                        <p><b>Kurzbeschreibung:</b><br>".$fetched['description']."</p>
                    </div>";
            }
        } else {
            $sucht = strtolower(addslashes($_POST["Suche"]));
            $sqlSearch = "SELECT name , street , zip , description , city FROM memorials m INNER JOIN memorialkeyword mk INNER JOIN keywords k ON m.id = mk.memorialid AND mk.wordid = k.id WHERE k.word = '$sucht';";
            $tabelle = mysqli_query($db, $sqlSearch);
            while ($fetch = mysqli_fetch_array($tabelle)) {
                $content .= "<div class=\"attraktion\">
                        <center><h4>".$fetched['name']."</h4></center>
                        <p><b>Adresse:</b><br> ".$fetched['street']."<br>".$fetched['zip']." ".$fetched['city']."</p><br>
                        <p><b>Kurzbeschreibung:</b><br>".$fetched['description']."</p>
                    </div>";
            }
        }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Denkmäler</title>
    <link rel="stylesheet" href="">
</head>
<body>
    <div class="header">
        
        <div class="container">
            <div class="logo">
                <img src="">
            </div>
            
            <a href="index_en.php"><img class="language" src="images/flag_en.png"></a>
            <a href="#"><img class="language" src="images/flag_ger.png"></a>

            <div class="search">
                <form action="index.php" method="POST">
                    <input type="image" src="images/search_icon.svg" name="Suche_start" value="">
                    <input type="text" name="Suche" placeholder="Suche nach Orten...">
                </form>
            </div>
        </div>
    </div>
    
    <div class="content">
		<?php
        print $content;
    	?>
    </div>
</body>
</html>