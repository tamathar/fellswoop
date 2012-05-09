<?php
	session_start();
	require("connect.php");
	
	$username=$_SESSION['username'];
	$query="SELECT * FROM games where Player1='$username' or Player2='$username'";

	$result=mysql_query($query) or die(mysql_error());

	echo "<h2 style='text-align:center'>Current Games</h2>";
	
	while($info =  mysql_fetch_assoc( $result))
	{
		if (($info['Player1']==$username))
			$opponent=$info['Player2'];
		else if (($info['Player2']==$username))
			$opponent=$info['Player1'];
	
		echo "<div class='game' id='" . $info['gameId'] . "'>";
		echo "<div style='float:left;'>Opponent: " . $opponent . "</div><div style='float:right;'>" . "Turn: ";
		if($info['turn'] == 0)
		{
			if($username == $info['Player1'])
				echo "You";
			else
				echo $info['Player1'];
		}
		else
		{
			if($username == $info['Player2'])
				echo "You";
			else
			echo $info['Player2'];
		}
			
		
		echo "</div></div><br/>";
		echo "\n";
	}
	
	//$h='hello';
	//echo $h;


?>