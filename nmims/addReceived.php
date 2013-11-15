<?php
require_once("connection.php");
require_once("Includes/functions.php");

?>
<?php
if(isset($_POST))
{
	//$id=$_POST['RID'];
	$date=$_POST['date'];
	$iname=$_POST['NAME'];
	$quantity=intval($_POST['QUANTITY']);
	$remarks=$_POST['REMARKS'];	
	$query="select * from received where rDate='$date' and iName='$iname' and rQuantity='$quantity'";
	$result=mysql_query($query, $connection);
	if(mysql_num_rows($result)>0&&!isset($_GET))
	{
		redirect("display.php?type=received&status=duplicate");
	}
	else
	{
		if(isset($_GET['id']))
		{
			$oldId=$_GET['id'];
			$oldQuantity=$_GET['oldQuantity'];
			$query="update received set rId='$id',
										iName='$iname',
										rQauntity='$quantity,'
										rDate='$date',
										rRemarks='$remarks'
										where rId='$oldId' ";
		}
		else
			$query="insert into received(iName,rQuantity,rDate,rRemarks) values('$iname','$quantity','$date','$remarks')";
			
		echo $query;	
		$result=mysql_query($query, $connection);
		echo $result;
		if(mysql_affected_rows()==1)
		{
			if(isset($_GET))
			{
				$query="update current set cQuantity=cQuantity-$oldQuantity+$quantity where iName='$iname'";
			}
				$query="update current set cQuantity=cQuantity+$quantity where iName='$iname'";
			echo $query;
			$result=mysql_query($query, $connection);
			if(mysql_affected_rows()==1)
			{
				
				redirect("display.php?type=received&status=success");
			}
		}
		//Done !!!
	}
}

?>
