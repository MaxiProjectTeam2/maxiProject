<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Topic Choose</title>
  <link rel="stylesheet" href="/CSS/bootstrap.min.css">
  <link rel="stylesheet" href="/CSS/stylesheet.css">
  <link rel="stylesheet" href="CSS/audioplayer.css" />
  <link href="http://vjs.zencdn.net/5.8.8/video-js.css" rel="stylesheet">
  <script src="http://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
  <script src="/JavaScript/jquery.min.js"></script>
  <script src="/JavaScript/bootstrap.min.js"></script>
  <script>
    (function(doc){var addEvent='addEventListener',type='gesturestart',qsa='querySelectorAll',scales=[1,1],meta=qsa in doc?doc[qsa]('meta[name=viewport]'):[];function fix(){meta.content='width=device-width,minimum-scale='+scales[0]+',maximum-scale='+scales[1];doc.removeEventListener(type,fix,true);}if((meta=meta[meta.length-1])&&addEvent in doc){fix();scales=[.25,1.6];doc[addEvent](type,fix,true);}}(document));
  </script>

</head>

<body>
  <div id="banner">
    <h2 id="title">Choose your topic please</h2>
  </div> <!-- banner -->

  <div id="navigation">
  	<a href="patientLogin.html"><button class="ybutton">Exit</button></a>
  </div>

  <div id="main">
	  <?php

	  	require_once("database.php");

	  	if($_GET["topic"]!=null) {

			$inputTopic = $_GET["topic"];?>

      <script>
      document.getElementById("title").innerHTML = "<?php echo $inputTopic;?>";
      </script>

      <?php

      $inputType = $_GET["type"];


			// query to find all topics of type "input"
			$findSubTopics = "SELECT COUNT(DISTINCT subtopic) ";
			$findSubTopics .= "as total FROM content ";
			$findSubTopics .= "WHERE contentTypeID = ";
			$findSubTopics .= $inputType;
			$findSubTopics .= " AND topic = '";
			$findSubTopics .= $inputTopic . "'";

			// "resource" object - collection of rows
			$subTopicQuery = $db->query($findSubTopics);
			$noOfSubTopics = $db->fetch_assoc($subTopicQuery);

			// randomly pick 5 subTopics - need to change if less are available
			$subTopicIndices = range(1, $noOfSubTopics['total']);
			shuffle($topicIndices);


			$getSubTopic1 = "SELECT DISTINCT subtopic as subTopic1 FROM content WHERE contentTypeID = "
				. $inputType . " AND topic = '" . $inputTopic . "' LIMIT ";
			$getSubTopic1 .= strval($subTopicIndices[0] - 1) . ", " . strval($subTopicIndices[0] . ";");

			$subTopic1 = $db->query($getSubTopic1);

			// this is a random subtopic (from all the photos in $inputTopic)
			$subTopicA = $db->fetch_assoc($subTopic1);

      $getContent1 = "SELECT contentID as ID FROM content WHERE topic = '";
      $getContent1 .= $inputTopic . "' AND subTopic = '";
      $getContent1 .= $subTopicA['subTopic1'] . "' AND contentTypeID = '";
      $getContent1 .= $_GET["type"] . "' ORDER BY RAND() LIMIT 1;";

      $content1 = $db->query($getContent1);
      $contentA = $db->fetch_assoc($content1);

			echo "<a href=\"topicPage.php?contentID=" . $contentA['ID'] . "&amp;patientID=" . $_GET["patientID"] . "\"><button class=\"bbutton\">" . $subTopicA['subTopic1'] . "</button></a>";

			if ($subTopicIndices[1] != null) {
				$getSubTopic2 = "SELECT DISTINCT subtopic as subTopic2 FROM content WHERE contentTypeID = "
					. $inputType . " AND topic = '" . $inputTopic . "' LIMIT ";
				$getSubTopic2 .= strval($subTopicIndices[1] - 1) . ", " . strval($subTopicIndices[1] . ";");

				$subTopic2 = $db->query($getSubTopic2);

				// this is a random subtopic (from all the photos in $inputTopic)
				$subTopicB = $db->fetch_assoc($subTopic2);

        $getContent2 = "SELECT contentID as ID FROM content WHERE topic = '";
        $getContent2 .= $inputTopic . "' AND subTopic = '";
        $getContent2 .= $subTopicB['subTopic2'] . "' AND contentTypeID = '";
        $getContent2 .= $_GET["type"] . "' ORDER BY RAND() LIMIT 1;";

        $content2 = $db->query($getContent2);
        $contentB = $db->fetch_assoc($content2);

  			echo "<a href=\"topicPage.php?contentID=" . $contentB['ID'] . "&amp;patientID=" . $_GET["patientID"] . "\"><button class=\"bbutton\">" . $subTopicB['subTopic2'] . "</button></a>";
			}

	  		if ($subTopicIndices[2] != null) {

				$getSubTopic3 = "SELECT DISTINCT subtopic as subTopic3 FROM content WHERE contentTypeID = "
					. $inputType . " AND topic = '" . $inputTopic . "' LIMIT ";
				$getSubTopic3 .= strval($subTopicIndices[2] - 1) . ", " . strval($subTopicIndices[2] . ";");

				$subTopic3 = $db->query($getSubTopic3);

				// this is a random subtopic (from all the photos in $inputTopic)
				$subTopicC = $db->fetch_assoc($subTopic3);

        $getContent3 = "SELECT contentID as ID FROM content WHERE topic = '";
        $getContent3 .= $inputTopic . "' AND subTopic = '";
        $getContent3 .= $subTopicC['subTopic3'] . "' AND contentTypeID = '";
        $getContent3 .= $_GET["type"] . "' ORDER BY RAND() LIMIT 1;";

        $content3 = $db->query($getContent3);
        $contentC = $db->fetch_assoc($content3);

  			echo "<a href=\"topicPage.php?contentID=" . $contentC['ID'] . "&amp;patientID=" . $_GET["patientID"] . "\"><button class=\"bbutton\">" . $subTopicC['subTopic3'] . "</button></a>";
			}

	  		if ($subTopicIndices[3] != null) {

				$getSubTopic4 = "SELECT DISTINCT subtopic as subTopic4 FROM content WHERE contentTypeID = "
					. $inputType . " AND topic = '" . $inputTopic . "' LIMIT ";
				$getSubTopic4 .= strval($subTopicIndices[3] - 1) . ", " . strval($subTopicIndices[3] . ";");

				$subTopic4 = $db->query($getSubTopic4);

				// this is a random subtopic (from all the photos in $inputTopic)
				$subTopicD = $db->fetch_assoc($subTopic4);

        $getContent4 = "SELECT contentID as ID FROM content WHERE topic = '";
        $getContent4 .= $inputTopic . "' AND subTopic = '";
        $getContent4 .= $subTopicD['subTopic4'] . "' AND contentTypeID = '";
        $getContent4 .= $_GET["type"] . "' ORDER BY RAND() LIMIT 1;";

        $content4 = $db->query($getContent4);
        $contentD = $db->fetch_assoc($content4);

  			echo "<a href=\"topicPage.php?contentID=" . $contentD['ID'] . "&amp;patientID=" . $_GET["patientID"] . "\"><button class=\"bbutton\">" . $subTopicD['subTopic4'] . "</button></a>";
			}

	  		if ($subTopicIndices[4] != null) {
				$getSubTopic5 = "SELECT DISTINCT subtopic as subTopic5 FROM content WHERE contentTypeID = "
					. $inputType . " AND topic = '" . $inputTopic . "' LIMIT ";
				$getSubTopic5 .= strval($subTopicIndices[4] - 1) . ", " . strval($subTopicIndices[4] . ";");

				$subTopic5 = $db->query($getSubTopic5);

				// this is a random subtopic (from all the photos in $inputTopic)
				$subTopicE = $db->fetch_assoc($subTopic5);

        $getContent5 = "SELECT contentID as ID FROM content WHERE topic = '";
        $getContent5 .= $inputTopic . "' AND subTopic = '";
        $getContent5 .= $subTopicE['subTopic5'] . "' AND contentTypeID = '";
        $getContent5 .= $_GET["type"] . "' ORDER BY RAND() LIMIT 1;";

        $content5 = $db->query($getContent5);
        $contentE = $db->fetch_assoc($content5);

  			echo "<a href=\"topicPage.php?contentID=" . $contentE['ID'] . "&amp;patientID=" . $_GET["patientID"] . "\"><button class=\"bbutton\">" . $subTopicE['subTopic5'] . "</button></a>";
			}


	  	}
	  ?>

    <div id="Caption">
    <?php
      if($_GET["contentID"]!=null){

        $contentID= $_GET["contentID"];
        $getTitle = "SELECT caption from content WHERE contentID=$contentID";
        $titleQuery = $db->query($getTitle);
        $title = $db->fetch_assoc($titleQuery);
        echo "</br>";
        echo $title['caption'];
        echo "</br>";

      	$viewID = "SELECT MAX(ViewId) as max FROM rtooldb.viewHistory";
      	$max = $db->query($viewID);
      	while($row = $max->fetch_assoc()){
      		$viewId = $row["max"];
      		$viewId = $viewId + 1;
      	}

      	$sql = "INSERT INTO viewHistory (patient_patientID, content_contentID, startTime,endTime,ViewId) ";
        $sql .= "VALUES (". $_GET["patientID"] . "," . $_GET["contentID"] . ", 0, 1," . $viewId . ");";
      	$db->insert($sql);


        ?>

        </div>

        <div id="container">
        <?php
          $getPath = "SELECT Filename,contentTypeID from content WHERE contentID=$contentID";
          $pathQuery = $db->query($getPath);
          $path = $db->fetch_assoc($pathQuery);

          if($path['contentTypeID'] == 1){
            ?>
            <div id="picturePlayer">
              <img src="<?php echo $path['Filename']?>" alt="Mountain View" style="width:50%;height:50%;center;">
            </div>
          <?php
          }
          elseif($path['contentTypeID'] == 2){
            ?>
            <div id="audioplayer">
              <video width="640" height="360" controls>
                <source src="<?php echo $path['Filename']?>" type="video/mp4" />
                <source src="__VIDEO__.OGV" type="video/ogg" />
                  <!-- fallback to Flash: -->
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
            <?php
          }
          else{
            ?>
            <div id="audioplayer">
              <audio preload="auto" controls>
                <source src="<?php echo $path['Filename']?>">
                <source src="*.ogg">
                <source src="*.wav">
              </audio>
              <script src="./JavaScript/jquery.js"></script>
              <script src="./JavaScript/audioplayer.js"></script>
              <script>$( function() { $( 'audio' ).audioPlayer(); } );</script>
            </div>
            <?php
          }


      } ?>

      </div>



  </div>

  <div id="footer">

	  <?php


  		$findTopics = "SELECT COUNT(DISTINCT topic) ";
  		$findTopics .= "as total FROM content;";

  		// "resource" object - collection of rows
  		$topicQuery = $db->query($findTopics); // exchange for num_rows?
	  	$noOfTopics = $db->fetch_assoc($topicQuery);

	  	// randomly pick 3 topics
	  	$topicIndices = range(1,$noOfTopics['total']);
	  	shuffle($topicIndices);

	  	$getTopic1 = "SELECT DISTINCT topic as topic1 FROM content LIMIT ";
	  	$getTopic1 .= strval($topicIndices[0]-1) . ", " . strval($topicIndices[0] . ";");
	  	$getTopic2 = "SELECT DISTINCT topic as topic2 FROM content LIMIT ";
	  	$getTopic2 .= strval($topicIndices[1]-1) . ", " . strval($topicIndices[1] . ";");
	  	$getTopic3 = "SELECT DISTINCT topic as topic3 FROM content LIMIT ";
	  	$getTopic3 .= strval($topicIndices[2]-1) . ", " . strval($topicIndices[2] . ";");

	  	$topic1 = $db->query($getTopic1);
	  	$topicA = $db->fetch_assoc($topic1);

	  	$topic2 = $db->query($getTopic2);
	  	$topicB = $db->fetch_assoc($topic2);

	  	$topic3 = $db->query($getTopic3);
	  	$topicC = $db->fetch_assoc($topic3);

	  	$db->close_connection();

	  ?>

  	<div class = "row">
  		<div class="col-md-4">
  			 <div class="dropup">
   				<button class="btn btn-primary dropdown-toggle form-control" type="button" id="menu1" data-toggle="dropdown"><?php echo $topicA['topic1']?><span class="caret"></span></button>
    			<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
					<li role="presentation"><a role="menuitem" tabindex="-1" href="topicPage.php?type=2&amp;topic=<?php echo $topicA['topic1']?>&amp;patientID=<?php echo $_GET["patientID"]?>">Video</a></li>
					<li role="presentation"><a role="menuitem" tabindex="-1" href="topicPage.php?type=1&amp;topic=<?php echo $topicA['topic1']?>&amp;patientID=<?php echo $_GET["patientID"]?>">Photograph</a></li>
					<li role="presentation"><a role="menuitem" tabindex="-1" href="topicPage.php?type=3&amp;topic=<?php echo $topicA['topic1']?>&amp;patientID=<?php echo $_GET["patientID"]?>">Music</a></li>
    			</ul>
			</div>
  		</div>
  		<div class="col-md-4">
  			 <div class="dropup">
   				<button class="btn btn-primary dropdown-toggle form-control" type="button" id="menu1" data-toggle="dropdown"><?php echo $topicB['topic2']?><span class="caret"></span></button>
    			<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
					<li role="presentation"><a role="menuitem" tabindex="-1" href="topicPage.php?type=2&amp;topic=<?php echo $topicB['topic2']?>&amp;patientID=<?php echo $_GET["patientID"]?>">Video</a></li>
					<li role="presentation"><a role="menuitem" tabindex="-1" href="topicPage.php?type=1&amp;topic=<?php echo $topicB['topic2']?>&amp;patientID=<?php echo $_GET["patientID"]?>">Photograph</a></li>
					<li role="presentation"><a role="menuitem" tabindex="-1" href="topicPage.php?type=3&amp;topic=<?php echo $topicB['topic2']?>&amp;patientID=<?php echo $_GET["patientID"]?>">Music</a></li>
    			</ul>
			</div>
  		</div>
  		<div class="col-md-4">
  			 <div class="dropup">
   				<button class="btn btn-primary dropdown-toggle form-control" type="button" id="menu1" data-toggle="dropdown"><?php echo $topicC['topic3']?><span class="caret"></span></button>
    			<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
					<li role="presentation"><a role="menuitem" tabindex="-1" href="topicPage.php?type=2&amp;topic=<?php echo $topicC['topic3']?>&amp;patientID=<?php echo $_GET["patientID"]?>">Video</a></li>
					<li role="presentation"><a role="menuitem" tabindex="-1" href="topicPage.php?type=1&amp;topic=<?php echo $topicC['topic3']?>&amp;patientID=<?php echo $_GET["patientID"]?>">Photograph</a></li>
					<li role="presentation"><a role="menuitem" tabindex="-1" href="topicPage.php?type=3&amp;topic=<?php echo $topicC['topic3']?>&amp;patientID=<?php echo $_GET["patientID"]?>">Music</a></li>
    			</ul>
			</div>
  		</div>
  	</div>



  </div>

</body>
</html>
