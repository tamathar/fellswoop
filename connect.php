<?php

  //Connecting to the server
 $con = mysql_connect("localhost","pnigelco_code","St@rSp@ngled") or die(mysql_error());    // machine name, username and password
 
  if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
  
  //select database
  
		mysql_select_db("pnigelco_fellswoop",  $con);

?>