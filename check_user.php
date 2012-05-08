<?php
	session_start();
	require "connect.php";
	require_once "sdk/src/facebook.php";
	
	$facebook = new facebook(
	array(
		'appId'  => '394565850573684',
		'secret' => '4ef12047f4dd402b76ca6a1b68bf8502',
	));
	
	$user = $facebook->getUser();
	
	if($user){
		try
		{
			$user_profile = $facebook->api('/me');
			$userid = $user_profile['id'];
			$name = $user_profile['name'];			
		}
		catch (FacebookApiException $e) 
		{
			$login = $facebook->getLoginUrl();
			header ("Location: $login");
		}
		
		//$result = mysql_query("SELECT * FROM users WHERE userid = '" . $userid . "');") or die(mysql_error());
		
		
		mysql_query("INSERT INTO  users (userid, name) VALUES ('" . $userid . "',  '" . $name . "') ON DUPLICATE KEY UPDATE userid=userid;") or die(mysql_error());
		$_SESSION['username'] = $name;
	}
?>