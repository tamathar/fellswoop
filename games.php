<?php
	session_start();
	require("connect.php");

	$username=$_SESSION['username'];
	$status = $_POST['status'];
	
	if($status != 0)
	{
		$result = mysql_query("SELECT * FROM users where name='$username';") or die(mysql_error());
		$info = mysql_fetch_assoc($result);
		echo $info['wins'] . "</h3>";
	}
	$query="SELECT * FROM games where (Player1='$username' or Player2='$username') and finished='$status';";

	$result=mysql_query($query) or die(mysql_error());

	
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