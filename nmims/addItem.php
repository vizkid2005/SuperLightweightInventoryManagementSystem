<?php
require_once("connection.php");
require_once("Includes/functions.php");
?>
<?php
if(isset($_POST))
{
	$name=$_POST['NAME'];
	$type=$_POST['TYPE'];
	$unit=$_POST['UNIT'];
	$threshold=$_POST['THRESHOLD'];
	$delete="";
	if(isset($_POST['DELETE']))
	{
		$delete=$_POST['DELETE'];
	}
	$query="";
	$query="select iname from item where iname='$name'";
	$result=mysql_query($query, $connection);
	//Checks for duplicates
	if(mysql_num_rows($result)>0&&!isset($_GET['update']))
	{
		if($delete!='true')
			redirect("addItemForm.php?status=duplicate");
	}
	else
	{
		//This query deleltes or updates existing item
		if(isset($_GET['update']))
		{
			$code=$_GET['update'];
			$oldname=$_GET['name'];
			$query="update item set iName='$name',
									iType='$type',
									iUnit='$unit',
									iThreshold=$threshold
									where iCode=$code";
			if($delete=='true')
			{
				$query="delete from item where iName='$oldname'";
			}
		}
		//This query adds new Item
		else
		{
			$query="insert into item(itype,iname,iunit,ithreshold) values('$type','$name','$unit','$threshold')";
		}
		
		$result=mysql_query($query, $connection);
		if(mysql_affected_rows()==1)
		{	
			if(isset($_GET['update']))
			{	
				$query="update current set iName='$name' where iName='$oldname'";
				if($delete=='true')
				{
					$query="delete from current where iName='$oldname'";
				}
			}
			else
			{
				$query="insert into current(iname,cquantity) values('$name',0)";
			}
			$result=mysql_query($query, $connection);
			echo "Here is ok  ";
			if(mysql_affected_rows()==1)
			{
				echo "Ok here 2";
				if(isset($_GET['update']))
				{
					if($delete=='true')
					{
						redirect("display.php?update=deleted&name=$name&type=item");
					}
					else
					{
						redirect("display.php?update=success&name=$name&type=item");
					}
				}
				else
				{
				redirect("display.php?type=item&status=success");
					//Redirect to display the added item
					//Work is left on that
				}
			}
			else //Redirects to item list if changes are successful
			{
				redirect("display.php?type=item&status=success");
			}
		}
		else //Redirects to item list if no changes int he input values ie: no rows are affected
		{
			redirect("display.php?type=item&status=success");
		}
			
	}
}

?>