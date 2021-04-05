<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$database = "metube_template";

$db = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME);

if($db === false){
  die("Error: connection error" . mysqli_connect_error());
}
?>
