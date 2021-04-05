<?php
require_once "config.php";
require_once "session.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])){
  $username = trim($_POST['username']);
  $pasword = trim($_POST['password']);
  $confirm_password = trim($_POST["confirm_password"]);
  $password_hash = password_hash($password, PASSWORD_BCRYPT);

  if($query = $db->prepare("SELECT * FROM users WHERE username = ?")){
    $reg_error='';

  $query->execute();
  $query->store_result();

    if($query->num_rows > 0){
      $reg_error = "This username is already in use"
    }else{
      if(strlen($password)<6){
        $reg_error = "Password length must be at least 6"
      }
    if($password != $confirm_password)){
      $reg_error = "Password did not match"
    }
      if (empty($error)){
        $insertQuery = $db->prepare("INSERT INTO users (username, password) VALUES (?, ?);");
        $insertQuery->bind_param("ss", $username, $password_hash);
        $result = $insertQuery->execute();
        if($result){
          $reg_error = "Registration Successful"
        }else{
          $reg_error = "Issue creating account"
        }
      }
    }
  }
  $query->close();
  $insertQuery->close();
  mysqli_close($db);
}
 ?>

<?php
 if(isset($reg_error))
  {  echo "<div id='passwd_result'>".$reg_error."</div>";}
?>
