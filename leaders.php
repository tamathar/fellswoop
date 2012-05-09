<?php

	require "connect.php";
	
	$return = "<h1 style='align: center'>Top Scorers</h1><table id='leaders'><tr><td>Player</td><td>Wins</td></tr>";
	
	$result = mysql_query("SELECT * FROM users ORDER BY wins DESC;") or die(mysql_error());

	while($row = mysql_fetch_array($result))
	{
		$return .= "<tr><td>" . $row['name'] . "</td><td>" . $row['wins'] . "</td></tr>";

	}
	$return .= "</table>";
	
	echo $return;
?>