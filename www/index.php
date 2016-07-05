<?php

require_once 'config.php';
require_once 'db_connect.inc.php';

if (isset($_REQUEST["searchword"])) {
    // Searching
    $search_word = strtolower(addslashes($_REQUEST["searchword"]));
    $sql_AllMemorials = "SELECT memorials.id, name, street, zip, description, city FROM memorials INNER JOIN memorialkeyword INNER JOIN keywords ON memorials.id = memorialkeyword.memorialid AND memorialkeyword.wordid = keywords.id WHERE keywords.word = '".$search_word."';";
    $sql_GetAllMem = mysqli_query($db_connection, $sql_AllMemorials);
    $counter = 0;
    while ($fetchMem = mysqli_fetch_array($sql_GetAllMem)) {

        $sql_KeyForMem = "SELECT word FROM memorials INNER JOIN memorialkeyword INNER JOIN keywords ON memorials.id = memorialkeyword.memorialid AND memorialkeyword.wordid = keywords.id WHERE memorials.id = ".$fetchMem["id"].";";
        $sql_GetKeysMem = mysqli_query($db_connection, $sql_KeyForMem);

        $sql_PicForMem = "SELECT picsum FROM memorials INNER JOIN memorialspictures INNER JOIN pictures ON memorials.id = memorialspictures.memorialid AND memorialspictures.picid = pictures.id WHERE memorials.id = ".$fetchMem["id"]." LIMIT 1;";
        $sql_GetPicsMem = mysqli_query($db_connection, $sql_PicForMem);

        $sql_AllPicOfMem = "SELECT picsum FROM memorials INNER JOIN memorialspictures INNER JOIN pictures ON memorials.id = memorialspictures.memorialid AND memorialspictures.picid = pictures.id WHERE memorials.id = ".$fetchMem["id"].";";
        $sql_GetAllPicOfMem = mysqli_query($db_connection, $sql_AllPicOfMem);
        $picount = 0;
        while ($temppicfetch = mysqli_fetch_array($sql_GetAllPicOfMem)) {
            $pictures[$picount] = $temppicfetch["picsum"];
            $picount++;
        }
        unset($temppicfetch); unset($picount);

        if (($counter % 2) == 0 ) {
            $sidebar[$counter] = $fetchMem['name'];
            $printing_memorials .= '
            <div class="row memorial-row" id="memorial-'.$counter.'">
            <div class="col-xs-8 col-sm-6 memorial-col">
            <h2>'.$fetchMem["name"].'</h2>
            <p>'.$fetchMem["description"].'</p>
            <h3>Anschrift</h3>
            <address>
            '.$fetchMem["street"].'<br />
            '.$fetchMem["zip"].'<br />
            '.$fetchMem["city"].'
            </address>

            <h3>Stichw&ouml;rter</h3>
            ';
            while ($fetchKey = mysqli_fetch_array($sql_GetKeysMem)) {
                $printing_memorials .= '
                <a href="#"><span class="label label-primary">'.$fetchKey["word"].'</span></a>
                ';
            }
			
			$printing_memorials .= '
            </div>
			<div class="col-xs-8 col-sm-6 memorials-image-col">';
            while ($fetchPic = mysqli_fetch_array($sql_GetPicsMem)) {
                $printing_memorials .= '

                <!---<div class="col-xs-8 col-sm-6">--->
                <a data-toggle="lightbox" href="upload/'.$fetchPic["picsum"].'.jpg" data-gallery="image-gallery" data-title="'.$fetchMem["name"].'" >
                <img class="img-circle memorials-image" src="upload/thumbs/thumb-'.$fetchPic["picsum"].'.jpg" alt="...">
                </a>
                <!---</div>--->
                ';
            }
            $printing_memorials .= '
            </div>
            </div>
            ';
        } else {
            $printing_memorials .= '
            <div class="row memorial-row" id="memorial-'.$counter.'">';

            while ($fetchPic = mysqli_fetch_array($sql_GetPicsMem)) {
                $printing_memorials .= '

                <div class="col-xs-8 col-sm-6 memorials-image-col">
                <a data-toggle="lightbox" href="upload/'.$fetchPic["picsum"].'.jpg" data-gallery="image-gallery" data-title="'.$fetchMem["name"].'" >
                <img class="img-circle memorials-image" src="upload/thumbs/thumb-'.$fetchPic["picsum"].'.jpg" alt="...">
                </a>
                </div>
                ';
            }

            $sidebar[$counter] = $fetchMem['name'];
            $printing_memorials .= '
            <div class="col-xs-8 col-sm-6 memorial-col">
            <h2>'.$fetchMem["name"].'</h2>
            <p>'.$fetchMem["description"].'</p>
            <h3>Anschrift</h3>
            <address>
            '.$fetchMem["street"].'<br />
            '.$fetchMem["zip"].'<br />
            '.$fetchMem["city"].'
            </address>

            <h3>Stichw&ouml;rter</h3>
            ';
            while ($fetchKey = mysqli_fetch_array($sql_GetKeysMem)) {
                $printing_memorials .= '
                <a href="#"><span class="label label-primary">'.$fetchKey["word"].'</span></a>
                ';
            }

            $printing_memorials .= '
            </div>
            </div>
            ';
        }
        $counter++;
    }

} else {

    // Not Searching
    $sql_AllMemorials = "SELECT * FROM `memorials`;";
    $sql_GetAllMem = mysqli_query($db_connection, $sql_AllMemorials);
    $counter = 0;
    $printing_memorials = '';
    while ($fetchMem = mysqli_fetch_array($sql_GetAllMem)) {

        $sql_KeyForMem = "SELECT word FROM memorials INNER JOIN memorialkeyword INNER JOIN keywords ON memorials.id = memorialkeyword.memorialid AND memorialkeyword.wordid = keywords.id WHERE memorials.id = ".$fetchMem["id"].";";
        $sql_GetKeysMem = mysqli_query($db_connection, $sql_KeyForMem);

        $sql_PicForMem = "SELECT picsum FROM memorials INNER JOIN memorialspictures INNER JOIN pictures ON memorials.id = memorialspictures.memorialid AND memorialspictures.picid = pictures.id WHERE memorials.id = ".$fetchMem["id"]." LIMIT 1;";
        $sql_GetPicsMem = mysqli_query($db_connection, $sql_PicForMem);

        $sql_AllPicOfMem = "SELECT picsum FROM memorials INNER JOIN memorialspictures INNER JOIN pictures ON memorials.id = memorialspictures.memorialid AND memorialspictures.picid = pictures.id WHERE memorials.id = ".$fetchMem["id"].";";
        $sql_GetAllPicOfMem = mysqli_query($db_connection, $sql_AllPicOfMem);
        $picount = 0;
        while ($temppicfetch = mysqli_fetch_array($sql_GetAllPicOfMem)) {
            $pictures[$picount] = $temppicfetch["picsum"];
            $picount++;
        }
        unset($temppicfetch); unset($picount);

        if (($counter % 2) == 0 ) {
            $printing_memorials .= '
            <div class="row memorial-row" id="memorial-'.$counter.'">';



            $sidebar[$counter] = $fetchMem['name'];
            $printing_memorials .= '
            <div class="col-xs-8 col-sm-6 memorial-col">
            <h2>'.$fetchMem["name"].'</h2>
            <p>'.$fetchMem["description"].'</p>
            <h3>Anschrift</h3>
            <address>
            '.$fetchMem["street"].'<br />
            '.$fetchMem["zip"].'<br />
            '.$fetchMem["city"].'
            </address>

            <h3>Stichw&ouml;rter</h3>
            ';
            while ($fetchKey = mysqli_fetch_array($sql_GetKeysMem)) {
                $printing_memorials .= '
                <a href="#"><span class="label label-primary">'.$fetchKey["word"].'</span></a>
                ';
            }

            $printing_memorials .= '
            </div>
			<div class="col-xs-8 col-sm-6 memorials-image-col">';
            while ($fetchPic = mysqli_fetch_array($sql_GetPicsMem)) {
                $printing_memorials .= '

                <a data-toggle="lightbox" href="upload/'.$fetchPic["picsum"].'.jpg" data-gallery="image-gallery" data-title="'.$fetchMem["name"].'" >
                <img class="img-circle memorials-image" src="upload/thumbs/thumb-'.$fetchPic["picsum"].'.jpg" alt="...">
                </a>
                </div>
                ';
            }
            $printing_memorials .= '</div>';

        } else {
            $printing_memorials .= '
            <div class="row memorial-row" id="memorial-'.$counter.'">';

            while ($fetchPic = mysqli_fetch_array($sql_GetPicsMem)) {
                $printing_memorials .= '

                <div class="col-xs-8 col-sm-6 memorials-image-col">
                <a data-toggle="lightbox" href="upload/'.$fetchPic["picsum"].'.jpg" data-gallery="image-gallery" data-title="'.$fetchMem["name"].'" >
                <img class="img-circle memorials-image" src="upload/thumbs/thumb-'.$fetchPic["picsum"].'.jpg" alt="...">
                </a>
                </div>
                ';
            }

            $sidebar[$counter] = $fetchMem['name'];
            $printing_memorials .= '
            <div class="col-xs-8 col-sm-6 memorial-col">
            <h2>'.$fetchMem["name"].'</h2>
            <p>'.$fetchMem["description"].'</p>
            <h3>Anschrift</h3>
            <address>
            '.$fetchMem["street"].'<br />
            '.$fetchMem["zip"].'<br />
            '.$fetchMem["city"].'
            </address>

            <h3>Stichw&ouml;rter</h3>
            ';
            while ($fetchKey = mysqli_fetch_array($sql_GetKeysMem)) {
                $printing_memorials .= '
                <a href="#"><span class="label label-primary">'.$fetchKey["word"].'</span></a>
                ';
            }

            $printing_memorials .= '
            </div>
            </div>
            ';
        }
        $counter++;
    }
}

// For Printing all Keywords
$sql_AllKeywords = "SELECT * FROM keywords;";
$sql_GetKeys = mysqli_query($db_connection, $sql_AllKeywords);
$printing_keywords = '';
while ($fetchAKeys = mysqli_fetch_array($sql_GetKeys)) {
    $printing_keywords .= '<a href="'.basename(__FILE__).'?searchword='.$fetchAKeys["word"].'"><span class="label label-primary label-sidebar">'.$fetchAKeys["word"].'</span></a> ';
}

$printing_lister = '';
// For Printing the shown Sidebar data
for ($i = 0; $i < count($sidebar); $i++) {
    $printing_lister .= "<li class=\"memorials-sidebar-item\"><a href=\"#memorial-".$i."\">".$sidebar[$i]."</a></li> ";
}

$printing_pictures = '';
// All Images from Shown Memorials
for ($ii = 0; $ii < count($pictures); $ii++) {
    $printing_pictures .= "<div data-toggle=\"lightbox\" data-gallery=\"image-gallery\" data-remote=\"upload/".$pictures[$ii].".jpg\" data-title=\"Image ".$ii."\"></div>";
}

?>
<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Startseite</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/ekko-lightbox.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/oswald.css" rel="stylesheet">


  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <div class="memorials-masthead">
        <div class="container">
            <nav class="memorials-nav">
                <a class="memorials-nav-item active" href="<?= basename(__FILE__); ?>">Home</a>
                <a class="memorials-nav-item" href="#">&Uuml;ber</a>
                <a class="memorials-nav-item" href="#">Anmelden</a>

                <form class="navbar-form navbar-right" method="post" action="<?= basename(__FILE__); ?>">

                    <div class="input-group ">
                        <input type="text" class="form-control" id="searchword" placeholder="Suchen nach...">
                      <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">Los!</button>
                      </span>
                    </div>

                </form>

            </nav>
        </div>
    </div>

    <div class="container">

        <div class="memorials-header">
            <h1 class="memorials-title">Denkmal ein Denkmal</h1>
            <p class="memorials-description">Denkmale im Kreis D&uuml;sseldorf</p>
        </div>

        <div class="row">
            <!-- Content Begin -->
            <div class="col-md-8 memorials-main">

                <?php
                print $printing_memorials;
                ?>

            </div>
            <!-- Content End -->

            <!-- Sidebar Begin -->
            <div class="col-md-3 col-md-offset-1 memorials-sidebar">
                <h2>&Uuml;bersicht</h2>
                <ol class="list-unstyled">
                    <?php
                    print $printing_lister;
                    ?>
                </ol>
                <h2>Alle Stichworte</h2>
                <div>
                    <?php
                    print $printing_keywords;
                    ?>
                </div>
            </div>
            <!-- Sidebar End -->
        </div>

        <div id="memorial-images">

            <?php
            print $printing_pictures;
            ?>

        </div>

    </div>

    <footer class="memorials-footer">
        <p>Diese Website wurde realisiert mit PHP, MySQL & Bootstrap</p>
        <p>
        <p><a href="#">Zum Anfang der Seite</a></p>
    </footer>

    <!-- Bootstrap and JQuery JavaScript
======================================================================================-->
    <script src="js/jquery-1.11.3.min.js"></script>
    <script src="js/ekko-lightbox.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>$(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox();
});</script>
  </body>
</html>
