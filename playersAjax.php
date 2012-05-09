<?php
	require("connect.php");
	session_start();
	$username=$_SESSION['username'];
	$query="SELECT * FROM users WHERE name<>'$username';";

	$result=mysql_query($query) or die(mysql_error());
	
	$return = "<h2 style='text-align:center;'>Select an Opponent</h2>";
	
	while($info =  mysql_fetch_assoc( $result))
	{
		$return .= "<div class='player' id='" . $info['name'] . "'>";
		$return .= $info['name'] . "</div>";
	}
	
	echo $return;

?>