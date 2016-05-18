<?php require_once("../includes/db_connection.php"); ?>
<?php

  function redirect_to($new_location) {
    header("Location: " . $new_location);
    exit;
  }

  function mysql_prep($string) {
    global $connection;
    
    $escaped_string = mysqli_real_escape_string($connection, $string);
    return $escaped_string;
  }
  
  function confirm_query($result_set) {
    if (!$result_set) {
      die("Database query failed.");
    }
  }

  function form_errors($errors=array()) {
    $output = "";
    if (!empty($errors)) {
      $output .= "<div class=\"alert alert-danger fade in\">";
	  $output .= "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>";
      $output .= "Please fix the following errors:";
      $output .= "<ul class=\"list-group\">";
      foreach ($errors as $key => $error) {
        $output .= "<li class=\"list-group-item\">";
        $output .= htmlentities($error);
        $output .= "</li>";
      }
      $output .= "</ul>";
      $output .= "</div>";
    }
    return $output;
  }
  
  function find_all_admins() {
    global $connection;
    
    $query  = "SELECT * ";
    $query .= "FROM admins ";
    $query .= "ORDER BY username ASC";
    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);
    return $admin_set;
  }
  
    function find_all_content() {
    global $connection;
    
    $query  = "SELECT * ";
    $query .= "FROM content ";
    $query .= "ORDER BY caption ASC";
    $content_set = mysqli_query($connection, $query);
    confirm_query($content_set);
    return $content_set;
  }
  
    function find_all_patients() {
    global $connection;
    
    $query  = "SELECT * ";
    $query .= "FROM patient ";
    $query .= "ORDER BY surname ASC";
    $patient_set = mysqli_query($connection, $query);
    confirm_query($patient_set);
    return $patient_set;
  }
	

  
  function find_admin_by_id($admin_id) {
    global $connection;
    
    $safe_admin_id = mysqli_real_escape_string($connection, $admin_id);
    
    $query  = "SELECT * ";
    $query .= "FROM admins ";
    $query .= "WHERE id = {$safe_admin_id} ";
    $query .= "LIMIT 1";
    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);
    if($admin = mysqli_fetch_assoc($admin_set)) {
      return $admin;
    } else {
      return null;
    }
  }

    function find_content_by_id($contentid) {
    global $connection;
    
    $safe_content_id = mysqli_real_escape_string($connection, $contentid);
    
    $query  = "SELECT * ";
    $query .= "FROM content ";
    $query .= "WHERE contentid = {$safe_content_id} ";
    $query .= "LIMIT 1";
    $content_set = mysqli_query($connection, $query);
    confirm_query($content_set);
    if($content = mysqli_fetch_assoc($content_set)) {
      return $content;
    } else {
      return null;
    }
  }
  
    function find_patient_by_id($patient_id) {
    global $connection;
    
    $safe_patient_id = mysqli_real_escape_string($connection, $patient_id);
    
    $query  = "SELECT * ";
    $query .= "FROM patient ";
    $query .= "WHERE patientid = '{$safe_patient_id}' ";
    $query .= "LIMIT 1";
    $patient_set = mysqli_query($connection, $query);
    confirm_query($patient_set);
    if($patient = mysqli_fetch_assoc($patient_set)) {
      return $patient;
    } else {
      return null;
    }
  }
  
  function find_admin_by_username($username) {
    global $connection;
    
    $safe_username = mysqli_real_escape_string($connection, $username);
    
    $query  = "SELECT * ";
    $query .= "FROM admins ";
    $query .= "WHERE username = '{$safe_username}' ";
    $query .= "LIMIT 1";
    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);
    if($admin = mysqli_fetch_assoc($admin_set)) {
      return $admin;
    } else {
      return null;
    }
  }
   
  // equal password_hash();
  function password_encrypt($password){
	$hash_format = "$2y$10$";
	$salt_length=22;
	$salt = generate_salt($salt_length);
	$format_and_salt=$hash_format.$salt;
	$hash= crypt($password,$format_and_salt);
	return $hash;
  }
  
  function generate_salt($length){
	  $unique_random_string =md5(uniqid(mt_rand(),true));
	  $base64_string = base64_encode($unique_random_string);
	  $modified_based64_string = str_replace('+',".",$base64_string);
	  $salt = substr($modified_based64_string,0,$length);
	  
	  return $salt;
  }
  
  //equal password_verify
  function password_check($password,$existing_hash){
	  $hash= crypt($password,$existing_hash);
	  if($hash == $existing_hash)
	  {
		  return true;
	  }else{
		  return false;
	  }
  }
  
  function attempt_login($username,$password){
	  $admin = find_admin_by_username($username);
	  if ($admin){
		  if(password_check($password,$admin["hashed_password"])){
			  return $admin;
			  
		  }else{
			  return false;
		  }
	  }else{
		  
	  }
  }
  
  function logged_in(){
	  
	  return isset($_SESSION['admin_id']);
  }
  
  function confirm_logged_in(){
	if(!isset($_SESSION['admin_id'])){
		redirect_to("login.php");
	}
  }

   function find_picture_by_patientid($patientid){
	   global $connection;
	  $safe_patientid = mysqli_real_escape_string($connection, $patientid);
    
    $query  = "SELECT photoFile ";
    $query .= "FROM patient ";
    $query .= "WHERE patientid = '{$safe_patientid}' ";

    $path = mysqli_query($connection, $query);
    confirm_query($path);
	 if($path = mysqli_fetch_assoc($path)) {
      return $path["photoFile"];
    } else {
      return null;
    }
 }
 
    function check_priority_by_username($username){
	global $connection;
    
  $safe_username = mysqli_real_escape_string($connection, $username);
    
    $query  = "SELECT priority ";
    $query .= "FROM admins ";
    $query .= "WHERE username = '{$username}' ";

    $priority = mysqli_query($connection, $query);
    confirm_query($priority);
	$priority = mysqli_fetch_assoc($priority);
	//"2" is admin which can add/delete content
	//"3" is the end-user which only have read-access;
	if($priority["priority"]=="2"){
	return true;}
	else {
	return false;}
  }
  
    function find_all_music() {
    
	global $connection;
    $query  = "SELECT * ";
    $query .= "FROM content ";
    $query .= "WHERE contentType = \"music\" ";
    $music_set = mysqli_query($connection, $query);
    confirm_query($music_set);
	return $music_set;
  }
  
     function find_all_image() {
    
	global $connection;
    $query  = "SELECT * ";
    $query .= "FROM content ";
    $query .= "WHERE contentType = \"picture\" ";
    $image_set = mysqli_query($connection, $query);
    confirm_query($image_set);
	return $image_set;
  }
  
      function find_all_video($context) {
    
	global $connection;
    $query  = "SELECT * ";
    $query .= "FROM content ";
    $query .= "WHERE contentType = \"{$context}\" ";
    $content_set = mysqli_query($connection, $query);
    confirm_query($content_set);
	return $content_set;
  } 
?>
