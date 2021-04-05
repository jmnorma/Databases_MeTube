<?php
if(isset($_POST['newMessage'])){
  $msg = $_POST['message'];
  $query = "INSERT INTO messages (sending_user, receiving_user, content)
            VALUES ($_SESSION[user_id], $_POST[sendTo], '$msg')";
  
}
 ?>
