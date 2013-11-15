<?php	
//Create Connection to Database
	$connection = mysql_connect("localhost","root","");
	if(!$connection)
	{
		die("Database Connection Failed : ".mysql_error());
	}
	else
	{
		
	}
//Select Desired Database
	$db_select = mysql_select_db("nmims",$connection);
	if(!$db_select)
	{
		die("Database Connection Failed : ".mysql_error());
	}	
	else
	{
		
	}
?>