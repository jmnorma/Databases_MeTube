<?php
require_once "config.php";
require_once "session.php";

$error = '';
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])){
  $username = trim($_POST['email']);
  $password = trim($_POST['password']);

  if ($_POST['username'] == "" || $_POST['password'] == ""){
    $login_error = "A required field is missing from login";
  }
  if (empty($login_error)){
    if($query = $db->prepare("SELECT * FROM users WHERE username = ?")){
      $query->bind_param('s', $username);
      $query->execute();
      $row = $query->fetch();
      if($row){
        if(password_verify($password, $row['password'])){
          $_SESSION["userid"] = $row['id'];
          $_SESSION["user"] = $row;

          header("location: welcome.php");
          exit;
        } else{
          $login_error = "Password not valid";
        }
      } else{
        $login_error = "User does not exist with given username.";
      }
    }
    $query->close();
  }
  mysqli_close($db);
}
 ?>


 <?php
   if(isset($login_error))
    {  echo "<div id='passwd_result'>".$login_error."</div>";}
 ?>
