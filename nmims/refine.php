<?php
	require_once("connection.php");
	require_once("Includes/functions.php");
	
	if(isset($_POST)&&$_GET['type']=="received")
	{
		$date1=$_POST['date'];
		$date2=$_POST['date1'];
		$redirectString="display.php?type=received&status=none&d1=$date1&d2=$date2";
		redirect($redirectString);
	}
	else if(isset($_POST)&&$_GET['type']=="given")
	{
		$date1=$_POST['date'];
		$date2=$_POST['date1'];
		$redirectString="display.php?type=given&status=none&d1=$date1&d2=$date2";
		redirect($redirectString);
	}
	else
	{
		redirect("index.php");
	}
?>	