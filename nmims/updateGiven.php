<?php
require_once("connection.php");
require_once("Includes/functions.php");
?>
<?php
if(isset($_POST['gId']))
{
	
	if(isset($_POST['DELETE']))
	{
		$delete = $_POST['DELETE'];
		$id = $_POST['gId'];

		$query="select * from given where gId=$id";
		$result = mysql_query($query,$connection);
		$row = mysql_fetch_assoc($result);

		$iName = $row['iName'];
		$oldQuantity = $row['gQuantity'];//This is old Quantity
		echo "ok here";

		$query2 = "select cQuantity from current where iName='$iName'";
		$result2 = mysql_query($query2,$connection);
		$row2=mysql_fetch_assoc($result2);
		echo "ok here2";
		$currentQuantity = $row2['cQuantity'];//This is Current Quantity

		$currentQuantity = $currentQuantity + $oldQuantity;

		$query="update current set cQuantity=$currentQuantity where iName='$iName'";
		$result=mysql_query($query,$connection);
		echo "ok here3";
		$query="delete from given where gId='$id'";
		$result=mysql_query($query,$connection);
		echo "ok here4";
		$link="display.php?type=given&status=none";
		redirect($link);
	}
	else
	{
		$id = $_POST['gId'];

		$query="select * from given where gId=$id";
		$result = mysql_query($query,$connection);
		$row = mysql_fetch_assoc($result);

		$iName = $row['iName'];
		$oldQuantity = $row['gQuantity'];//This is old Quantity

		$query2 = "select cQuantity from current where iName='$iName'";
		$result2 = mysql_query($query2,$connection);
		$row2=mysql_fetch_assoc($result2);

		$currentQuantity = $row2['cQuantity'];//This is Current Quantity

		$newQuantity = $_POST['gQuantity'];

		$currentQuantity = $currentQuantity + $oldQuantity - $newQuantity;

		$query="update current set cQuantity=$currentQuantity where iName='$iName'";
		$result=mysql_query($query,$connection);


		$gTo=$_POST['gTo'];
		$gDate=$_POST['gDate'];
		$gLab=$_POST['gLab'];
		$gRemarks=$_POST['gRemarks'];

		$query="update given set gQuantity=$newQuantity, gTo='$gTo', gLab='$gLab', gDate='$gDate', gRemarks='$gRemarks' where gId='$id'";
		$result=mysql_query($query,$connection);

		$link="display.php?type=given&status=none";
		redirect($link);
	}
}
?>
