<?php
	
	$connection = mysql_connect('localhost', 'root', 'password');
	if(!$connection) {
	    die('Could not connect: ' . mysql_error());
	}
	
	$db = mysql_select_db('othello', $connection);
	if(!$db) {
	    die ('Can\'t use db : ' . mysql_error());
	}

	
	$response = "";
	
	$result = mysql_query("SELECT * FROM games WHERE gameId=" . $_POST['gameId']) or die(mysql_error());

	$row = mysql_fetch_array($result);
	
	$response .= $row['Player1'] . "," . $row['Player2'] . "," . $row['turn'] . "," . $row['pieces'] . "," . $row['finished'] . "," . $row['gameId'];
	
	echo $response;
?>