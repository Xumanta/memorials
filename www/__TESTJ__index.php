<?php
# INCLUDE FILES ARE MISSING FOR NOW!!!

if (isset($_REQUEST["searchword"])) {
    // Searching
    $search_word = strtolower(addslashes($_REQUEST["searchword"]));
    $sql_AllMemorials = "SELECT memorials.id, name, street, zip, description, city FROM memorials INNER JOIN memorialkeyword INNER JOIN keywords ON memorials.id = memorialkeyword.memorialid AND memorialkeyword.wordid = keywords.id WHERE keywords.word = '.$search_word.';";
    $sql_GetAllMem = mysqli_query($db, $sql_AllMemorials);
    $counter = 0;
    while ($fetchMem = mysqli_fetch_array($sql_GetAllMem)) {

        $sql_KeyForMem = "SELECT word FROM memorials INNER JOIN memorialkeyword INNER JOIN keywords ON memorials.id = memorialkeyword.memorialid AND memorialkeyword.wordid = keywords.id WHERE memorials.id = ".$fetchMem["id"].";";
        $sql_GetKeysMem = mysqli_query($db, $sql_KeyForMem);

        $sql_PicForMem = "SELECT picsum FROM memorials INNER JOIN memorialspictures INNER JOIN pictures ON memorials.id = memorialspictures.memorialid AND memorialspictures.picid = pictures.id WHERE memorials.id = ".$fetchMem["id"]." LIMIT 1;";
        $sql_GetPicsMem = mysqli_query($db, $sql_PicForMem);

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
            while ($fetchPic = mysqli_fetch_array($sql_GetPicsMem)) {
                $printing_memorials .= '

                <div class="col-xs-8 col-sm-6">
                <a data-toggle="lightbox" href="upload/'.$fetchPic["picsum"].'.jpg" data-gallery="image-gallery" data-title="'.$fetchMem["name"].'" >
                <img class="img-circle memorials-image" src="upload/thumbs/thumb-'.$fetchPic["picsum"].'.jpg" alt="...">
                </a>
                </div>
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
    }

} else {

    // Not Searching
    $sql_AllMemorials = "SELECT * FROM `memorials`;";
    $sql_GetAllMem = mysqli_query($db, $sql_AllMemorials);
    $counter = 0;
    while ($fetchMem = mysqli_fetch_array($sql_GetAllMem)) {

        $sql_KeyForMem = "SELECT word FROM memorials INNER JOIN memorialkeyword INNER JOIN keywords ON memorials.id = memorialkeyword.memorialid AND memorialkeyword.wordid = keywords.id WHERE memorials.id = ".$fetchMem["id"].";";
        $sql_GetKeysMem = mysqli_query($db, $sql_KeyForMem);

        $sql_PicForMem = "SELECT picsum FROM memorials INNER JOIN memorialspictures INNER JOIN pictures ON memorials.id = memorialspictures.memorialid AND memorialspictures.picid = pictures.id WHERE memorials.id = ".$fetchMem["id"]." LIMIT 1;";
        $sql_GetPicsMem = mysqli_query($db, $sql_PicForMem);

        if (($counter % 2) == 0 ) {
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
            while ($fetchPic = mysqli_fetch_array($sql_GetPicsMem)) {
                $printing_memorials .= '

                <div class="col-xs-8 col-sm-6">
                <a data-toggle="lightbox" href="upload/'.$fetchPic["picsum"].'.jpg" data-gallery="image-gallery" data-title="'.$fetchMem["name"].'" >
                <img class="img-circle memorials-image" src="upload/thumbs/thumb-'.$fetchPic["picsum"].'.jpg" alt="...">
                </a>
                </div>
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
    }
}

$sql_AllKeywords = "SELECT * FROM keywords;";
$sql_GetKeys = mysqli_query($db, $sql_AllKeywords);
while ($fetchAKeys = mysqli_fetch_array($sql_GetKeys)) {
    $printing_keywords .= '<a href="index.php?searchword='.$fetchAKeys["word"].'"><span class="label label-primary label-sidebar">'.$fetchAKeys["word"].'</span></a>';
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
                <a class="memorials-nav-item active" href="#">Home</a>
                <a class="memorials-nav-item" href="#">&Uuml;ber</a>
                <a class="memorials-nav-item" href="#">Anmelden</a>

                <form class="navbar-form navbar-right" method="post" action="__TESTJ__index.php">

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
                    <li class="memorials-sidebar-item"><a href="#">Glockelspiel</a></li>
                    <li class="memorials-sidebar-item"><a href="#">Hoppeditz</a></li>
                    <li class="memorials-sidebar-item"><a href="#">Gedenktafel KZ-Außenlager</a></li>
                    <li class="memorials-sidebar-item"><a href="#">Moritz Sommer Gedenktafel</a></li>
                    <li class="memorials-sidebar-item"><a href="#">Richtstätte Aktion Rheinland</a></li>
                    <li class="memorials-sidebar-item"><a href="#">Felix Mendelssohn-Bartholdy Skulptur</a></li>
                    <li class="memorials-sidebar-item"><a href="#">Ehra</a></li>
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
            <div data-toggle="lightbox" data-gallery="image-gallery" data-remote="upload/16FAD5148F14193239376F72ABB0AC9792BF997E.jpg" data-title="Image 1"></div>
            <div data-toggle="lightbox" data-gallery="image-gallery" data-remote="upload/617CB7066F4DA706B6C7D0BC3DFD93451E12AC4C.jpg" data-title="Image 2"></div>
            <div data-toggle="lightbox" data-gallery="image-gallery" data-remote="upload/2ADB589742150AB0016B15CB4DE27191388BD64B.jpg" data-title="Image 3"></div>
            <div data-toggle="lightbox" data-gallery="image-gallery" data-remote="upload/4AAC79AD630ED1BC2671AB7095D8845E07EA97E1.jpg" data-title="Image 4"></div>
            <div data-toggle="lightbox" data-gallery="image-gallery" data-remote="upload/A3D2204938F02E7BD0513EF2C076B2DAD3138C14.jpg" data-title="Image 5"></div>
            <div data-toggle="lightbox" data-gallery="image-gallery" data-remote="upload/B82B4824652A95C03FD0ADE96F2451C1907D9862.jpg" data-title="Image 6"></div>
            <div data-toggle="lightbox" data-gallery="image-gallery" data-remote="upload/FA29C94A9CD0E0A49911A108523758E8C3338836.jpg" data-title="Image 7"></div>
            <div data-toggle="lightbox" data-gallery="image-gallery" data-remote="upload/C3203F4049336216AB6E8C3764BFD81855BC461A.jpg" data-title="Image 8"></div>
            <div data-toggle="lightbox" data-gallery="image-gallery" data-remote="upload/B37911CD52482DB22B0CCB517268209709589FC8.jpg" data-title="Image 9"></div>
            <div data-toggle="lightbox" data-gallery="image-gallery" data-remote="upload/42C26E45A59C352B5F73C148914DB19C0D8CD7DA.jpg" data-title="Image 10"></div>
            <div data-toggle="lightbox" data-gallery="image-gallery" data-remote="upload/B83024537B662F16929E9F4D62D1D03BE60F9CD7.jpg" data-title="Image 11"></div>
            <div data-toggle="lightbox" data-gallery="image-gallery" data-remote="upload/163CE8049AD40D588C67EF34FC43B6EAB2CF0E6B.jpg" data-title="Image 12"></div>
            <div data-toggle="lightbox" data-gallery="image-gallery" data-remote="upload/78BC38D62D8D69C4B138789179C7980A92FDB0F0.jpg" data-title="Image 13"></div>
            <div data-toggle="lightbox" data-gallery="image-gallery" data-remote="upload/D347615DB901D8B72F21C724DEACCDB36854AE4A.jpg" data-title="Image 14"></div>
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