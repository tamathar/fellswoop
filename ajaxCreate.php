<?php
	
  //Connecting to the server
require("connect.php");

	mysql_query("INSERT INTO games (`Player1`, `Player2`) VALUES ('" . $_POST['player'] . "','" . $_POST['opponent'] . "');") or die(mysql_error());
	
	$response = "";
	
	$result = mysql_query("SELECT * FROM games WHERE Player1='" . $_POST['player'] . "' AND Player2='" . $_POST['opponent'] . "';") or die(mysql_error());

	$row = mysql_fetch_array($result);
	echo $row['gameId'];
	
?>