<?php
	session_start();

  	$query = "SELECT * from media";
  	$result = mysql_query( $query );
  	if (!$result)
  	{
  	   die ("Could not query the media table in the database: <br />". mysql_error());
  	}

?>
