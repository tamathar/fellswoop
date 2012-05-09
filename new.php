<?php
require("connect.php");
session_start();
$username=$_SESSION['username'];

	$opponent = mysql_real_escape_string($_POST['opponent']); 
//$query="SELECT * FROM games where Player1='$username' or Player2='$username'";
$query="INSERT INTO games(Player1,Player2,turn,pieces,finished,gameId) VALUES ('$username', '$opponent','0','---------------------------WB------BW----------------------','0',NULL)";
$result=mysql_query($query);
	//$result1=mysql_fetch_array($result);
	//echo $result1['username'];
	
	echo $opponent;


	/*
 while($info =  mysql_fetch_assoc( $result))
 {if (($info['Player1']==$username))
	$opponent=$info['Player2'];
	
	else if (($info['Player2']==$username))
	$opponent=$info['Player1'];
 //echo $info["gameId"];
 //echo $info["username"];
 echo "<div>";
 echo $opponent;
// echo "\n";
 echo "</div>";
 }
 

//$h='hello';
//echo $h;
*/

?>