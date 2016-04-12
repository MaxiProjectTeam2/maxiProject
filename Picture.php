<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./CSS/bootstrap.min.css">
    <link rel="stylesheet" href="./CSS/stylesheet.css">
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
    $getTitle = "SELECT caption from content WHERE contentID=3";
    $titleQuery = $db->query($getTitle);
    $title = $db->fetch_assoc($titleQuery);
    echo "</br>";
    echo $title['caption'];
    ?>

</div> <!-- banner -->

<div id="container">
    <?php
    $getPath = "SELECT Filename from content WHERE contentID=3";
    $pathQuery = $db->query($getPath);
    $path = $db->fetch_assoc($pathQuery);
    ?>

    <div id="picturePlayer">
        <img src="<?php echo $path['Filename']?>" alt="Mountain View" style="width:50%;height:50%;center;">
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
