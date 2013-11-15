<?php
require_once("connection.php");
require_once("Includes/functions.php");
?>
<html>
<head>
</head>
<body>
<?php
if(isset($_POST['rId']))
{
	
	if(isset($_POST['DELETE']))
	{
		$delete = $_POST['DELETE'];
		$id = $_POST['rId'];

		$query="select * from received where rId=$id";
		$result = mysql_query($query,$connection);
		$row = mysql_fetch_assoc($result);

		$iName = $row['iName'];
		$oldQuantity = $row['rQuantity'];//This is old Quantity

		$query2 = "select cQuantity from current where iName='$iName'";
		$result2 = mysql_query($query2,$connection);
		$row2=mysql_fetch_assoc($result2);

		$currentQuantity = $row2['cQuantity'];//This is Current Quantity

		$currentQuantity = $currentQuantity - $oldQuantity;

		$query="update current set cQuantity=$currentQuantity where iName='$iName'";
		$result=mysql_query($query,$connection);

		$query="delete from received where rId='$id'";
		$result=mysql_query($query,$connection);

		$link="display.php?type=received&status=none";
		redirect($link);
	}
	else
	{
		$id = $_POST['rId'];

		$query="select * from received where rId=$id";
		$result = mysql_query($query,$connection);
		$row = mysql_fetch_assoc($result);

		$iName = $row['iName'];
		$oldQuantity = $row['rQuantity'];//This is old Quantity
		$rRemarks = $_POST['rRemarks'];
		$rDate = $_POST['rDate'];

		echo " id $id
		iname $iName
		quantity $oldQuantity
		remarks $rRemarks
		";

		$query2 = "select cQuantity from current where iName='$iName'";
		$result2 = mysql_query($query2,$connection);
		$row2=mysql_fetch_assoc($result2);

		$currentQuantity = $row2['cQuantity'];//This is Current Quantity

		$newQuantity = $_POST['rQuantity'];

		$currentQuantity = $currentQuantity - $oldQuantity + $newQuantity;

		$query="update current set cQuantity=$currentQuantity where iName='$iName'";
		$result=mysql_query($query,$connection);

		$query="update received set rQuantity=$newQuantity, rRemarks='$rRemarks', rDate='$rDate', rId=$id where rId=$id";
		$result=mysql_query($query,$connection);

		$link="display.php?type=received&status=none";
		redirect($link);
	}
}
?>
</body>
</html>
