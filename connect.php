<?php

  //Connecting to the server
 $con = mysql_connect("localhost","root","password");    // machine name, username and password
 
  if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
  
  //select database
  
		mysql_select_db("othello",  $con);
		
?>