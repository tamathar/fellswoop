<?php
	
	$connection = mysql_connect('localhost', 'root', 'password');
	if(!$connection) {
	    die('Could not connect: ' . mysql_error());
	}
	
	$db = mysql_select_db('othello', $connection);
	if(!$db) {
	    die ('Can\'t use db : ' . mysql_error());
	}

	mysql_query("INSERT INTO games (`Player1`, `Player2`) VALUES ('" . $_POST['player'] . "','" . $_POST['opponent'] . "');") or die(mysql_error());
	
	$response = "";
	
	$result = mysql_query("SELECT * FROM games WHERE Player1='" . $_POST['player'] . "' AND Player2='" . $_POST['opponent'] . "';") or die(mysql_error());

	$row = mysql_fetch_array($result);
	echo $row['gameId'];
	
?>