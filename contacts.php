<?php
require_once "config.php";

session_start();

$db = new mysqli($dbhost, $dbuser, $dbpass, $database)

if(!isset($_SESSION['user_id'])){
  echo "<p class=\"errorText\">It looks like you are not signed in</p>";
  return;
}
if(isset($_POST['add'])){
  //new id to add
  $contact_name = $_POST['contact_username'];
  $query = "SELECT user_id FROM users WHERE username='$contact_name'";
  if(!($result = mysql_query($query))) {
    die("<p class="error">SQL Query Validation Error</p>");
  }
  if(mysql_num_rows($result) == 0) {
    echo "<p class="error">No user found by that name!</p>";
  }else{
    $row = mysqli_fetch_assoc($result);
    $contact_user_id = $row['user_id'];
    $cur_user_id = $_SESSION['user_id'];
    if($query = $db->prepare("SELECT contact_id FROM contacts WHERE user_reciever='$cur_user_id' AND user_sender = '$contact_user_id'")){
      $add_error = '';
    $query->execute();
    $query->store_result();
    if(query->num_rows >0){
      $add_error = "Contact already existing";
    }
    if(empty($add_error)){
      $insertQuery = $db->prepare("INSERT INTO contacts(user_sender, user_reciever) VALUES ($cur_user_id, $contact_user_id)");
      $insertQuery->bind_param("ss", $cur_user_id, $contact_user_id);
      $result = $insertQuery->execute();
      $insertQuery->store_result();
      if($result){
        $add_error = "User successfully added as a contact";
      }else{
        $add_error = "Issue adding contact to contact list";
      }
    }
  }
}
}else if(isset($_POST['remove'])){
  if($query = $db->prepare("SELECT user_id FROM users WHERE username='$_POST[deleteuser]'")){
    $remove_error = '';
    $query->execute();
    $query->store_result();
    $result = $query->fetch();
    if($query->num_rows == 0){
      $remove_error = "User does not exist";
    }else{
      $reciever_user_id = $row['user_reciever'];
      $cur_user_id = $row['user_sender'];
      if($query = $db->prepare("DELETE FROM contacts WHERE user_reciever=$reciever_user_id and user_sender=$cur_user_id")){
        $remove_error = '';
        $success = $query->execute();
        if($success){
          $remove_error = "Contact was successfully removed";
        }else{
          $remove_error = "Issue with removing contact";
        }
        $query->store_result();
      }
    }
  }
}
 ?>
