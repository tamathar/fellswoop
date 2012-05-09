<?php
	require("connect.php");
	
	$user = $_POST['user'];
	
	$query="SELECT * FROM users WHERE name='" . $_POST['user'] . "';";

	$result=mysql_query($query) or die(mysql_error());
	
	$info =  mysql_fetch_assoc( $result);

	$wins = $info['wins'];
	$wins += 1;
	
	mysql_query("UPDATE  pnigelco_fellswoop.users SET  wins='" . $wins . "' WHERE  name='" . $info['name'] . "';") or die(mysql_error());
	
	
	require_once "sdk/src/facebook.php";
	
	$facebook = new facebook(
	array(
		'appId'  => '394565850573684',
		'secret' => '4ef12047f4dd402b76ca6a1b68bf8502',
		'cookie' => true
	));
	

	
	if(! $facebook->getUser())
	{
			$login = $facebook->getLoginUrl(array(‘req_perms’ => ‘publish_stream’));
			header ("Location: $login");
	}
	
	$destination = "/" . $info['userid'] . "/feed";
	$description = "$user has beaten his/her opponent in Fellswoop! Think you can do better? Follow the link to challenge $user now...";
	$status = $facebook->api($destination, 'POST', array('link' => 'apps.facebook.com/fellswoop', 'picture' => 'pnigel.com/fellswoop/images/fellswoop.png', 'name' => 'Victory in Fellswoop', 'description' => $description));	
	echo $status;
?>