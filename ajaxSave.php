<?php
	
  //Connecting to the server
require("connect.php");

	
	$query = "UPDATE games SET finished='" . $_POST['done'];
	$query .= "', turn='" . $_POST['turn'] . "', pieces='" . $_POST['layout'] . "' WHERE gameId=" . $_POST['gameId'];

	mysql_query($query) or die(mysql_error());
	
	echo $_POST['gameId'];
?>