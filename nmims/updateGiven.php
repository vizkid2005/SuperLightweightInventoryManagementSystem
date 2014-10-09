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

		echo $_POST['iName'];
		echo "</br>".$row['iName'];

		if(strcasecmp($row['iName'],$_POST['iName'])!=0)
		{
			//Quantity remains unchanged
			if($_POST['gQuantity'] == $row['gQuantity']){
				$qAdd = $row['gQuantity'];
				echo $qAdd;
				$qRemove = $_POST['gQuantity'];
				echo $qRemove;
				$name = $row['iName'];
				echo $name;
				$query = "update current set cQuantity=cQuantity+$qAdd where iName='$name'";
				$result= mysql_query($query,$connection);

				$nameOld = $row['iName'];
				$name = $_POST['iName'];
				echo $name;
				$query = "update current set cQuantity=cQuantity-$qRemove where iName='$name'";
				$result= mysql_query($query,$connection);

				$query = "update given set iName='$name' where gId=$id";
				echo "</br>   $query";
				$result= mysql_query($query,$connection);

			}

			else
			{
				echo "</br>"."in the else part";
				$qAdd = $row['gQuantity'];
				echo "</br>".$qAdd;
				$qRemove = $_POST['gQuantity'];
				echo "</br>".$qRemove;


				$name = $row['iName'];
				echo "</br>".$name;
				$query = "update current set cQuantity= cQuantity+ $qAdd where iName='$name'";
				echo "</br>".$query;
				$result= mysql_query($query,$connection);
				if($result != false)
				{
					echo "</br>"."Added back original quantity";
				}
				
				$name = $_POST['iName'];
				echo "</br>".$name;
				/*$query = "update current set cQuantity=cQuantity-$qAdd where iName='$name'";
				$result= mysql_query($query,$connection);*/

				$query = "update current set cQuantity=cQuantity-$qRemove where iName='$name'";
				echo "</br>".$query;
				$result= mysql_query($query,$connection);
				if($result != false)
				{
					echo "</br>"."Removed new quantity";
				}

				$query = "update given set iName='$name' where gId=$id";
				echo "</br>".$query;

				$result= mysql_query($query,$connection);
				if($result != false)
				{
					echo "</br>"."Updated the name entry";
				}
			}
			$link="display.php?type=given&status=none";
			redirect($link);
		}
		else
		{
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
}
?>
