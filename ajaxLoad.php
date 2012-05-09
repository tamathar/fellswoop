<?php
	
  //Connecting to the server
require("connect.php");

	
	$response = "";
	
	$result = mysql_query("SELECT * FROM games WHERE gameId=" . $_POST['gameId']) or die(mysql_error());

	$row = mysql_fetch_array($result);
	
	$response .= $row['Player1'] . "," . $row['Player2'] . "," . $row['turn'] . "," . $row['pieces'] . "," . $row['finished'] . "," . $row['gameId'];
	
	echo $response;
?>