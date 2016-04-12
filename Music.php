<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./CSS/bootstrap.min.css">
    <link rel="stylesheet" href="./CSS/stylesheet.css">
    <link rel="stylesheet" href="CSS/audioplayer.css" />
    <script src="./JavaScript/jquery.min.js"></script>
    <script src="./JavaScript/bootstrap.min.js"></script>
    <script>
        (function(doc){var addEvent='addEventListener',type='gesturestart',qsa='querySelectorAll',scales=[1,1],meta=qsa in doc?doc[qsa]('meta[name=viewport]'):[];function fix(){meta.content='width=device-width,minimum-scale='+scales[0]+',maximum-scale='+scales[1];doc.removeEventListener(type,fix,true);}if((meta=meta[meta.length-1])&&addEvent in doc){fix();scales=[.25,1.6];doc[addEvent](type,fix,true);}}(document));
    </script>


</head>

<body>

<div id="navigation">
    <a href="patientLogin.html"><button class="ybutton" href="#">Exit</button></a>
</div>

<div id="Caption">
    <?php
    require_once("database.php");
    $contentID= $_GET["contentID"];
    $getTitle = "SELECT caption from content WHERE contentID=$contentID";
    $titleQuery = $db->query($getTitle);
    $title = $db->fetch_assoc($titleQuery);
    echo "</br>";
    echo $title['caption'];
    ?>

</div> <!-- banner -->

<div id="container">
    <?php
    $getPath = "SELECT Filename from content WHERE contentID=$contentID";
    $pathQuery = $db->query($getPath);
    $path = $db->fetch_assoc($pathQuery);
    ?>

    <div id="audioplayer">
        <audio preload="auto" controls>
            <source src="<?php echo $path['Filename']?>">
            <source src="audio/BlueDucks_FourFlossFiveSix.ogg">
            <source src="audio/BlueDucks_FourFlossFiveSix.wav">
        </audio>
        <script src="js/jquery.js"></script>
        <script src="js/audioplayer.js"></script>
        <script>$( function() { $( 'audio' ).audioPlayer(); } );</script>
    </div>

</div>
<div id="footer">
    <div class = "row">
        <div class="col-md-4">
            <div class="dropup">
                <button class="btn btn-primary dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Childhood<span class="caret"></span></button>
                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="topicPage-Vedio.html">Video</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#	">Photograph</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="topicPage-Music.html">Music</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="dropup">
                <button class="btn btn-primary dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Childhood<span class="caret"></span></button>
                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="topicPage-Vedio.html">Video</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#	">Photograph</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="topicPage-Music.html">Music</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="dropup">
                <button class="btn btn-primary dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Childhood<span class="caret"></span></button>
                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="topicPage-Vedio.html">Video</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#	">Photograph</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="topicPage-Music.html">Music</a></li>
                </ul>
            </div>
        </div>
    </div>



</div>



</body>
</html>