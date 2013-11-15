<?php
require_once("connection.php");
require_once("Includes/functions.php");
?>
<?php
if(isset($_POST))
{
	$name=$_POST['NAME'];
	if(!isset($_GET['type']))
		$type=$_POST['TYPE'];
	else
		$type='Lab';	
	$remarks=$_POST['REMARKS'];
	$update=false;
	$delete="";
	if(isset($_GET['name']))
	{
		$update=true;
		$oldname=$_GET['name'];
	}
	if(isset($_POST['DELETE']))
	{
		$delete=$_POST['DELETE'];
	}
	$query="";
	if($type=='Lab'&&!$update)
	{
		$query="select lname from lab where lname='$name'";
	}
	else
	{
		$query="select cname from consumer where cname='$name'";
	}
		
	$result=mysql_query($query, $connection);
	if(mysql_num_rows($result)>0&&!$update)
	{
		redirect("addConsumerForm.php?status=duplicate");
	}
	else
	{
		if($type=="Lab")
		{
			if($update)
			{
				$query="update lab set lName='$name',
									   lRemarks='$remarks'
								   where lName='$oldname'";
				if($delete=='true')
				{
					$query="delete from lab where lname='$oldname'";
				}
								   
			}
			else
			{
				$query="insert into lab(lname,lremarks) values('$name','$remarks')";
			}
		}
		else
		{
			if($update)
			{
				$query="update consumer set cName='$name',
									   cRemarks='$remarks',
									   cType='$type'
								   where cName='$oldname'";
				if($delete=='true')
				{
					$query="delete from consumer where cName='$oldname'";
				}
			}
			else
			{
				$query="insert into consumer(cname,ctype,cremarks) values('$name','$type','$remarks')";
			}
		}
		
	
	if($result=mysql_query($query, $connection))
	{
	}
	else
	{
		echo "Duplicate Found";
	}
	if(mysql_affected_rows()==1)
	{
		if($delete=='true')
				{
					redirect("display.php?type=consumer&status=deleted&name=$name");
				}
		if($type=="Lab")
		{
			redirect("display.php?type=consumer&status=success&name=$name");		
		}
		redirect("display.php?type=consumer&status=success&name=$name");
		//Redirect to display the added consumer
		//Work is left on that
	}
	else
	{
		redirect("display.php?type=consumer&status=none");
	}
	
  }
}

?>