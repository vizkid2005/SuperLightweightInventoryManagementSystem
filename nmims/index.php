<?php 
	require_once("Includes/functions.php");
	require_once("connection.php");
	writeHeader("NMIMS - HOME","");
?>	
<?php
	if(isset($_GET['id']))
	{
		$id=$_GET['id'];
		$status=$_GET['status'];
		
		echo "$status";
	}
?>
<style type="text/css">
	#heading {
		color:#8C489F;
		padding:5px;
		clear:both;
		margin:20px;
		margin-bottom:0px;
		font-size:20px;
	}
	#mainContent {
		color:#8C489F;
		padding:10px;
		margin-left:30px;
		font-size:18px;
	}
	#aboutUs
	{
		font-size:14px;
	}
	#aboutUs a {
		text-decoration:none;
		display:inline;
		color:#443266;
	}
	#highlight
	{
		color:#443266;
	}
	#inStock
	{
	background-color: #99FF99;
	color: #00CC00;
	width: 700px;
	padding: 10px;
	padding-top: 1px;
	}
	#getMore
	{
		background-color:#FFC2E0;
		color:red;
		width:700px;
		padding:10px;
		padding-top:1px;
	}
</style>
<div id="heading">
<h3>Welcome to NMIMS - Nafisa Mapari's Inventory Management System</h3>
</div>
<div id="mainContent">
<p>
This Software allows you to manage incoming and outgoing consumable items.<br/>
You can <span id="highlight">Add,Update/Delete</span> and <span id="highlight">View</span> Items in a tabulated and organised manner<br/>
Go ahead, Start Exploring ...
</p>
<img src="Imgs/indexBackground.png" alt="Back Ground Image Here" />
<p id="aboutUs">
In case you have any queries/difficulties feel free to contact us <a href="aboutUs.php">here</a></br>
<b>Click <a href="backup.php?arg1=localhost&arg2=root&arg3=&arg4=nmims">Here</a> for Backup.</b> 
</p>
</div>

<?php 
$date = date(DATE_RFC850);
$date= str_replace(' ','',$date);
echo $date;
$query="select distinct(item.iName) from item,current where current.cQuantity<=item.iThreshold and item.iName=current.iName";

$result=mysql_query($query,$connection);
if(mysql_num_rows($result)==0)
{
	echo "<div id=\"inStock\"><h3>Inventory is Sufficiently Stocked</h3></div>";
}
else
{
	echo "<div id=\"getMore\">";	
	echo "<h3>Looks like you're running short on : </h3>";
	echo "<ul>";
	while($row=mysql_fetch_array($result))
	{
		$name=$row['iName'];
		echo "<li>$name</li>";
	}
	
	echo "</ul></div>";
}
?>


<?php 
	writeFooter();
?>	