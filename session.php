<?php
session_start();

if (isset($_SESSION["userid"]) && $_SESSION["userid"] === true){
    if($_POST['username'] == "" || $_POST['password'] == "") {
    $login_error = "One or more fields are missing.";
  }
  else {
      header('Location: browse.php');
      exit;
  }
}
?>
