<?php 
	require_once("connection.php");
	require_once("Includes/functions.php");
	writeHeader("NMIMS - Display","<link href=\"Styles/calendar.css\" rel=\"stylesheet\" type=\"text/css\" >
        <script src=\"Scripts/calendar.js\" type=\"text/javascript\"></script>
        <script type=\"text/javascript\">
            function init() {
                calendar.set(\"date\");
				calendar.set(\"date1\");
            }
        </script>");
?>
<style type="text/css">
	p{
		color:#443266;
	}
	.addform
			{
				color:#443266;	
			}
			tr
			{
				cell-padding: 20px;
				font-size: 12px;
				font-family: Verdana, Geneva, sans-serif;
				text-align: center;
				background-color: #C3C3E5;
			}
				
			tr.tr2
			{
				background-color: #443266;	
			}
			tr.tr1
			{
				background-color: #8c489f;	
			}
	.heading {
		color:#443266;
		text-align:center;
		font-size: 24px;
		font-family:Verdana, Geneva, sans-serif;
		padding:10px;
		margin:10px;
	}
	.subHeading
	{
		color:#443266;
		text-align:left;
		font-size: 18px;
		font-family:Verdana, Geneva, sans-serif;
		padding:10px;
		margin:10px;
	}
	#SUBMIT {
		background-color:#F1F0FF;
		border-radius:10px;
		color:#443266;
		/*padding:10px;*/
	}
	#SUBMIT:hover {
		background-color:#443266;
		border-radius:10px;
		color:#F1F0FF;
		/*padding:10px;*/
	}
</style>
<?php
	if(isset($_GET['type']))
	{
		$type=$_GET['type'];
		//Display according to Consumer Name
		if($type=='consumer')
		{
			$cname=$_GET['cname'];
			echo "<div class=\"subHeading\">Past Issues to $cname</div>";
			$query="select * from given where gTo='$cname' order by gDate desc limit 0,40";
			$result=mysql_query($query,$connection);
			echo "<table class=\"addform\" cellpadding=\"2\" cellspacing=\"2\" width=\"650\" align=\"center\">
							 <tr>
								 <td>Date</td>
								 <td>Item Name</td>
								 <td>Lab</td>
								 <td>Quantity</td>
								 <td>Remarks</td>
							 </tr>";
			if($result==true)				 
			while($row = mysql_fetch_array($result))
			{	
				
				$quantity=$row['gQuantity'];
				$iname=$row['iName'];
				$lab=$row['gLab'];
				$remarks=$row['gRemarks'];
				$date=new DateTime($row['gDate']);
				$date=$date->format('d-m-Y');
				
				echo "<tr>
						 <td>$date</td>
						 <td>$iname</td>
						 <td>$lab</td>
						 <td>$quantity</td>
						 <td>$remarks</td>
					  </tr>";
			}
			echo "</table>";		
		}
		//Display according to Lab Name
		if($type=='lab')
		{
			$lname=$_GET['lname'];
			echo "<div class=\"subHeading\">Past Issues to $lname</div>";
			$query="select * from given where gLab='$lname' order by gDate desc limit 0,40";
			$result=mysql_query($query,$connection);
			echo "<table class=\"addform\" cellpadding=\"2\" cellspacing=\"2\" width=\"650\" align=\"center\">
							 <tr>
								 <td>Date</td>
								 <td>Item Name</td>
								 <td>Quantity</td>
								 <td>Given To</td>
								 <td>Remarks</td>
							 </tr>";
			if($result==true)				 
			while($row = mysql_fetch_array($result))
			{	
				
				$quantity=$row['gQuantity'];
				$iname=$row['iName'];
				$remarks=$row['gRemarks'];
				$gto=$row['gTo'];
				$date=new DateTime($row['gDate']);
				$date=$date->format('d-m-Y');
				
				echo "<tr>
						 <td>$date</td>
						 <td>$iname</td>
						 <td>$quantity</td>
						 <td>$gto</td>
						 <td>$remarks</td>
					  </tr>";
			}
			echo "</table>";		
		}
		//Display according to Item Name
		if($type=='item')
		{
			$iname=$_GET['iname'];
			echo "<div class=\"subHeading\">Past Issues for $iname</div>";
			$query="select * from given where iName='$iname' order by gDate desc limit 0,40";
			$result=mysql_query($query,$connection);
			echo "<table class=\"addform\" cellpadding=\"2\" cellspacing=\"2\" width=\"650\" align=\"center\">
							 <tr>
								 <td>Date</td>
								 <td>Quantity</td>
								 <td>Given To</td>
								 <td>Lab</td>
								 <td>Remarks</td>
							 </tr>";
			if($result==true)				 
			while($row = mysql_fetch_array($result))
			{	
				
				$quantity=$row['gQuantity'];
				$iname=$row['iName'];
				$lab=$row['gLab'];
				$givento=$row['gTo'];
				$remarks=$row['gRemarks'];
				$date=new DateTime($row['gDate']);
				$date=$date->format('d-m-Y');
				
				echo "<tr>
						 <td>$date</td>
						 <td>$quantity</td>
						 <td>$givento</td>
						 <td>$lab</td>
						 <td>$remarks</td>
					  </tr>";
			}
			echo "</table>";		
		}
		
	}
	writeFooter();
?>	