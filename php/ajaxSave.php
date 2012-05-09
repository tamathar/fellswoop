<?php
	
	$connection = mysql_connect('localhost', 'root', 'password');
	if(!$connection) {
	    die('Could not connect: ' . mysql_error());
	}
	
	$db = mysql_select_db('othello', $connection);
	if(!$db) {
	    die ('Can\'t use db : ' . mysql_error());
	}

	
	$query = "UPDATE games SET finished='" . $_POST['done'];
	$query .= "', turn='" . $_POST['turn'] . "', pieces='" . $_POST['layout'] . "' WHERE gameId=" . $_POST['gameId'];

	mysql_query($query) or die(mysql_error());
	
	echo $_POST['gameId'];
?>