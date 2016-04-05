<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Topic Choose</title>
  <link rel="stylesheet" href="/CSS/bootstrap.min.css">
  <link rel="stylesheet" href="/CSS/stylesheet.css">
  <script src="/JavaScript/jquery.min.js"></script>
  <script src="/JavaScript/bootstrap.min.js"></script>

</head>

<body>
  <div id="banner">
    <h2>Choose your topic please</h2>
  </div> <!-- banner -->

  <div id="navigation">
  	<a href="patientLogin.html"><button class="ybutton">Exit</button></a>
  </div>

  <div id="main">
	  <?php

	  	require_once("database.php");

	  	if($_GET["topic"]!=null) {

			$inputTopic = $_GET["topic"];
			echo "<br/> user's choice: " . $inputTopic;
			if ($_GET["type"] == "video")
				$inputType = 2;
			else if ($_GET["type"] == "photo")
				$inputType = 1;
			else
				$inputType = 3;


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

				$getSubTopic2 = "SELECT DISTINCT subtopic as subTopic2 FROM content WHERE contentTypeID = "
					. $inputType . " AND topic = '" . $inputTopic . "' LIMIT ";
				$getSubTopic2 .= strval($subTopicIndices[1] - 1) . ", " . strval($subTopicIndices[1] . ";");

				$subTopic2 = $db->query($getSubTopic2);

				// this is a random subtopic (from all the photos in $inputTopic)
				$subTopicB = $db->fetch_assoc($subTopic2);

				$getSubTopic3 = "SELECT DISTINCT subtopic as subTopic3 FROM content WHERE contentTypeID = "
					. $inputType . " AND topic = '" . $inputTopic . "' LIMIT ";
				$getSubTopic3 .= strval($subTopicIndices[2] - 1) . ", " . strval($subTopicIndices[2] . ";");

				$subTopic3 = $db->query($getSubTopic3);

				// this is a random subtopic (from all the photos in $inputTopic)
				$subTopicC = $db->fetch_assoc($subTopic3);

				$getSubTopic4 = "SELECT DISTINCT subtopic as subTopic4 FROM content WHERE contentTypeID = "
					. $inputType . " AND topic = '" . $inputTopic . "' LIMIT ";
				$getSubTopic4 .= strval($subTopicIndices[3] - 1) . ", " . strval($subTopicIndices[3] . ";");

				$subTopic4 = $db->query($getSubTopic4);

				// this is a random subtopic (from all the photos in $inputTopic)
				$subTopicD = $db->fetch_assoc($subTopic4);

				$getSubTopic5 = "SELECT DISTINCT subtopic as subTopic5 FROM content WHERE contentTypeID = "
					. $inputType . " AND topic = '" . $inputTopic . "' LIMIT ";
				$getSubTopic5 .= strval($subTopicIndices[4] - 1) . ", " . strval($subTopicIndices[4] . ";");

				$subTopic5 = $db->query($getSubTopic5);

				// this is a random subtopic (from all the photos in $inputTopic)
				$subTopicE = $db->fetch_assoc($subTopic5);


			echo "<br/> subtopics are: " . $subTopicA['subTopic1'] . $subTopicB['subTopic2']
				. . $subTopicC['subTopic3'] . $subTopicD['subTopic4'] . $subTopicE['subTopic5'];

	  	}
	  ?>
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
					<li role="presentation"><a role="menuitem" tabindex="-1" href="topicPage.php?type=video&amp;topic=<?php echo $topicA['topic1']?>">Video</a></li>
					<li role="presentation"><a role="menuitem" tabindex="-1" href="topicPage.php?type=photo&amp;topic=<?php echo $topicA['topic1']?>">Photograph</a></li>
					<li role="presentation"><a role="menuitem" tabindex="-1" href="topicPage.php?type=music&amp;topic=<?php echo $topicA['topic1']?>">Music</a></li>
    			</ul>
			</div>
  		</div>
  		<div class="col-md-4">
  			 <div class="dropup">
   				<button class="btn btn-primary dropdown-toggle form-control" type="button" id="menu1" data-toggle="dropdown"><?php echo $topicB['topic2']?><span class="caret"></span></button>
    			<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
					<li role="presentation"><a role="menuitem" tabindex="-1" href="topicPage.php?type=video&amp;topic=<?php echo $topicB['topic2']?>">Video</a></li>
					<li role="presentation"><a role="menuitem" tabindex="-1" href="topicPage.php?type=photo&amp;topic=<?php echo $topicB['topic2']?>">Photograph</a></li>
					<li role="presentation"><a role="menuitem" tabindex="-1" href="topicPage.php?type=music&amp;topic=<?php echo $topicB['topic2']?>">Music</a></li>
    			</ul>
			</div>
  		</div>
  		<div class="col-md-4">
  			 <div class="dropup">
   				<button class="btn btn-primary dropdown-toggle form-control" type="button" id="menu1" data-toggle="dropdown"><?php echo $topicC['topic3']?><span class="caret"></span></button>
    			<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
					<li role="presentation"><a role="menuitem" tabindex="-1" href="topicPage.php?type=video&amp;topic=<?php echo $topicC['topic3']?>">Video</a></li>
					<li role="presentation"><a role="menuitem" tabindex="-1" href="topicPage.php?type=photo&amp;topic=<?php echo $topicC['topic3']?>">Photograph</a></li>
					<li role="presentation"><a role="menuitem" tabindex="-1" href="topicPage.php?type=music&amp;topic=<?php echo $topicC['topic3']?>">Music</a></li>
    			</ul>
			</div>
  		</div>
  	</div>



  </div>

</body>
</html>