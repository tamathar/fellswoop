<?php
	require("connect.php");
	
	$query="SELECT * FROM users WHERE name='" . $_POST['user'] . "';";

	$result=mysql_query($query) or die(mysql_error());
	
	$info =  mysql_fetch_assoc( $result)

	$wins = $info['wins'] + 1;
	
	mysql_query("UPDATE  pnigelco_fellswoop.users SET  'wins'='" . $wins . "' WHERE  'name' =  '" . $info['name'] . "');") or die(mysql_error());
?>