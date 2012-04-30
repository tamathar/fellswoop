<?php
require("connect.php");
session_start();
$username=$_SESSION['username'];
$query="SELECT * FROM games where Player1='$username' or Player2='$username'";

$result=mysql_query($query);
	//$result1=mysql_fetch_array($result);
	//echo $result1['username'];
	
	


	
 while($info =  mysql_fetch_assoc( $result))
 {if (($info['Player1']==$username))
	$opponent=$info['Player2'];
	
	else if (($info['Player2']==$username))
	$opponent=$info['Player1'];
 //echo $info["gameId"];
 //echo $info["username"];
 echo "<a id='" . $info['gameId'] . "'>";
 echo $opponent . " " . $info['gameId'];
// echo "\n";
 echo "</a><br/>";
 }

//$h='hello';
//echo $h;

?>