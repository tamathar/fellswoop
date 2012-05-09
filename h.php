<?php
require("connect.php");

$query="SELECT username FROM users";

$result=mysql_query($query);
	//$result1=mysql_fetch_array($result);
	//echo $result1['username'];
	
 while($info =  mysql_fetch_assoc( $result))
 {
 echo $info["username"];
 echo "\n";
 }

//$h='hello';
//echo $h;

?>