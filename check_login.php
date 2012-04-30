


<?php

  //Connecting to the server
require("connect.php");
		
		
			session_start();
		
		
		$username = mysql_real_escape_string($_POST['username']);  
$_SESSION['username'] = $username;

$password = mysql_real_escape_string($_POST['password']);  
	
//
$query="SELECT username, password FROM users WHERE username='$username' and password='$password'";

$result=mysql_query($query);
	
	//echo $result['password'];
	
	$result1=mysql_fetch_array($result);

	 if (($result1['username']!=$username))
		{
			echo $username . ' does not exist';
		}
			else if (($result1['password']!= $password) )
		{
			echo 'password incorrect for ' . $username;
		}
		
		

	

		else
	{
			echo 1;
	}

?>

