<?php
require_once("connection.php");
require_once("Includes/functions.php");
?>
<?php

if(isset($_POST))
{
	$gdate=$_POST['date'];
	$iname=$_POST['NAME'];
	$quantity=$_POST['QUANTITY'];
	$gto=$_POST['GTO'];
	$glab=$_POST['LAB'];
	$remarks=$_POST['REMARKS'];
	
			$query="select cQuantity from current where iName='$iname'";
			$result=mysql_query($query, $connection);
			$row=mysql_fetch_array($result);
			
			if($row['cQuantity']>=$quantity)
			{
				
				$query="update current set cQuantity=cQuantity-$quantity where iName='$iname'";
				$result=mysql_query($query, $connection);
				if(mysql_affected_rows()==1)
				{
					$query="insert into given(gDate,iName,gQuantity,gTo,gLab,gRemarks) values('$gdate','$iname','$quantity','$gto','$glab','$remarks')";
					$result=mysql_query($query, $connection);
					redirect("display.php?type=given&status=success");
				}
				else
				{
					echo "some error occured";
				}
			}
			else
			{
				redirect("display.php?type=given&status=lessStock");
			}
	
	
}

?>