<?php

  //Connecting to the server
 $con = mysql_connect("mysql3.000webhost.com","a1704801_tam","Erodae5") or die(mysql_error());    // machine name, username and password
 
  if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
  
  //select database
  
		mysql_select_db("a1704801_tds09b",  $con);
		
?>