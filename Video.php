<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./CSS/bootstrap.min.css">
    <link rel="stylesheet" href="./CSS/stylesheet.css">
    <link href="http://vjs.zencdn.net/5.8.8/video-js.css" rel="stylesheet">
    <script src="http://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
    <script src="./JavaScript/jquery.min.js"></script>
    <script src="./JavaScript/bootstrap.min.js"></script>



</head>

<body>

<div id="navigation">
    <a href="patientLogin.html"><button class="ybutton" href="#">Exit</button></a>
</div>

<div id="Caption">
    <?php
    require_once("database.php");
    $getTitle = "SELECT caption from content WHERE contentID=2";
    $titleQuery = $db->query($getTitle);
    $title = $db->fetch_assoc($titleQuery);
    echo "</br>";
    echo $title['caption'];
    ?>

</div> <!-- banner -->

<div id="container">
    <?php
    $getPath = "SELECT Filename from content WHERE contentID=2";
    $pathQuery = $db->query($getPath);
    $path = $db->fetch_assoc($pathQuery);
    ?>

    <div id="audioplayer">
        <video width="640" height="360" controls>
            <source src="<?php echo $path['Filename']?>" type="video/mp4" />
            <source src="__VIDEO__.OGV" type="video/ogg" />
<!--            <!-- fallback to Flash: -->
            <object width="640" height="360" type="application/x-shockwave-flash" data="__FLASH__.SWF">
                <!-- Firefox uses the `data` attribute above, IE/Safari uses the param below -->
                <param name="movie" value="__FLASH__.SWF" />
                <param name="flashvars" value="controlbar=over&amp;image=__POSTER__.JPG&amp;file=__VIDEO__.MP4" />
                <!-- fallback image. note the title field below, put the title of the video there -->
                <img src="__VIDEO__.JPG" width="640" height="360" alt="__TITLE__"
                     title="<?php echo $path['caption']?>" />
            </object>
        </video>
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
