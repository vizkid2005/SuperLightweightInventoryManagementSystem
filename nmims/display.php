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
	$query="";
	$type="";
	$query1="";
	
	if(isset($_GET))
	{
		if($_GET['type']=='item')
		{
			$type="Items";
			$query="select * from item order by iName";
			$query2="select cQuantity from current order by iName";
			$result2=mysql_query($query2,$connection);
			
		}
		if($_GET['type']=='received')
		{
			$type="Received";
			if(isset($_GET['d1']))
			{
				$d1=$_GET['d1'];
				$d2=$_GET['d2'];
				$query="select * from received where rDate between '$d1' and '$d2' order by dateAdded desc limit 0,40";
			}
			else
				$query="select * from received order by dateAdded desc";
			
		}
		if($_GET['type']=='given')
		{
			$type="Issued";
			if(isset($_GET['d1']))
			{
				$d1=$_GET['d1'];
				$d2=$_GET['d2'];
				$query="select * from given where gDate between '$d1' and '$d2' order by dateAdded desc limit 0,40";
			}
			else
			$query="select * from given order by dateAdded desc";
			
		}
		if($_GET['type']=='consumer')
		{
			$type="Consumers";
			$query="select * from consumer order by dateadded desc";
			//$query1="select * from lab by dateadded desc";
			$query1="select * from lab order by dateModified desc";
			
		}
		$result1;
		$result=mysql_query($query, $connection);
		
		if($_GET['type']=='consumer')
		{
			$result1=mysql_query($query1, $connection);
		}
	}
	
	

?>

<div class="heading"><strong>Display <?php echo $type; ?></strong></div>
<div>
    	<?php
			if($type=='Items')
			{
				
				echo "<table class=\"addform\" cellpadding=\"2\" cellspacing=\"2\" width=\"650\" align=\"center\">
						 <tr>
						 <td>Item Code</td>
						 <td>Item Type</td>
						 <td><b>Item Name</b></td>
						 <td>Item Unit</td>
						 <td>Item Threshold</td>
						 <td><b>Current Stock</b></td>
						 <td>Date Last Modified</td>
					 </tr>";
				while($row = mysql_fetch_array($result))
				{	
				$row2=mysql_fetch_array($result2);
					$icode=$row['iCode'];
					$itype=$row['iType'];
					$iname=$row['iName'];
					$iunit=$row['iUnit'];
					$ithreshold=$row['iThreshold'];
					$date=$row['dateAdded']; 
					$current=$row2['cQuantity'];
					
					echo "<tr>
							 <td>$icode</td>
							 <td>$itype</td>
							 <td><b><a href=\"displayWise.php?type=item&iname=$iname\">$iname</a></b></td>
							 <td>$iunit</td>
							 <td>$ithreshold</td>
							 <td><b>$current</b></td>
							 <td><b><a href=\"updateItemForm.php?iname=$iname\">$date</a></b></td>
						  </tr>";
				}
				
			}
			if($type=='Consumers')
			{
				/*if(isset($_GET['cname']))
				{
					$cname=$_GET['cname'];
					$newquery="select * from given where gTo='$cname' and gLab='NA' order by gDate desc limit 0,40";
					$newresult=mysql_query($newquery,$connection);
					echo "<div class=\"subHeading\">Past Issues to $cname</div>";
					echo "<table class=\"addform\" cellpadding=\"2\" cellspacing=\"2\" width=\"650\" align=\"center\">
							 <tr>
							 <td>Date</td>
							 <td>Item Name</td>
							 <td>Quantity</td>
							 <td>Remarks</td>
						 </tr>";
					while($row = mysql_fetch_array($newresult))
					{	
						
						$quantity=$row['gQuantity'];
						$iname=$row['iName'];
						$remarks=$row['gRemarks'];
						$date=$row['gDate']; 
						
						echo "<tr>
								 <td>$date</td>
								 <td>$iname</td>
								 <td>$quantity</td>
								 <td>$remarks</td>
							  </tr>";
					}	 
					
				}
				else if(isset($_GET['lname']))
				{
					$lname=$_GET['lname'];
					$newquery="select * from given where gLab='$lname' order by gDate desc limit 0,40";
					$newresult=mysql_query($newquery,$connection);
					echo "<div class=\"subHeading\">Past Issues to $lname</div>";
					echo "<table class=\"addform\" cellpadding=\"2\" cellspacing=\"2\" width=\"650\" align=\"center\">
							 <tr>
							 <td>Date</td>
							 <td>Item Name</td>
							 <td>Quantity</td>
							 <td>Given To</td>
							 <td>Remarks</td>
						 </tr>";
					while($row = mysql_fetch_array($newresult))
					{	
						
						$quantity=$row['gQuantity'];
						$iname=$row['iName'];
						$remarks=$row['gRemarks'];
						$date=$row['gDate']; 
						$gto=$row['gTo']; 
						
						echo "<tr>
								 <td>$date</td>
								 <td>$iname</td>
								 <td>$quantity</td>
								 <td>$gto</td>
								 <td>$remarks</td>
							  </tr>";
					}
				}
				else
				{*/
					echo "<table class=\"addform\" cellpadding=\"2\" cellspacing=\"2\" width=\"650\" align=\"center\">
							 <tr>
							 <td>Consumer Name</td>
							 <td>Consumer Type</td>
							 <td>Remarks</td>
							 <td>Date Last Modified</td>
						 </tr>";
						 
					while($row = mysql_fetch_array($result))
					{	
						
						$ctype=$row['cType'];
						$cname=$row['cName'];
						$remarks=$row['cRemarks'];
						$date=$row['dateAdded']; 
						
						echo "<tr>
								 <td><a href=\"displayWise.php?type=consumer&cname=$cname\">$cname</a></td>
								 <td>$ctype</td>
								 <td>$remarks</td>
								 <td><a href=\"updateConsumerForm.php?cname=$cname\">$date</a></td>
							  </tr>";
					}
				
					echo "</table>
					<br/><br/>
					<div class=\"heading\"><strong>Display Labs</strong></div>
					<table class=\"addform\" cellpadding=\"2\" cellspacing=\"2\" width=\"650\" align=\"center\"> ";
					echo "<tr>
							 <td>Lab Name</td>
							 <td>Remarks</td>
							 <td>Date Last Modified</td>
						 </tr>";
						 
					while($row = mysql_fetch_array($result1))
					{	
						
						
						$lname=$row['lName'];
						$remarks=$row['lRemarks'];
						$date=$row['dateModified']; 
						
						echo "<tr>
								 <td><a href=\"displayWise.php?type=lab&lname=$lname\">$lname</a></td>
								 <td>$remarks</td>
								 <td><a href=\"updateConsumerForm.php?cname=$lname&type=lab\">$date</a></td>
							  </tr>";
					}
				}
			//}
			
			if($type=='Received')
			{
				echo "<div >
						<p> Refine your Search : </p>
						<form method=\"post\" action=\"refine.php?type=received\" class=\"Refine\">
						<table id=\"refine\">
							<tr>
								<td>From : </td>
								<td><input id=\"date\" name=\"date\" onMouseOver=\"init()\" /></td>
							</tr>
							<tr>
								<td>To : </td>
								<td><input id=\"date1\" name=\"date1\" onMouseOver=\"init()\" /></td>
							</tr>  
							<tr>
								<td colspan=\"2\"><input type=\"submit\" name=\"SUBMIT\" id=\"SUBMIT\" value=\"Search\"/></td>
						</table> 
						</form>
						</div>";
						
				if($_GET['status']=='duplicate')
				{
					echo "<p class=\"heading\">Duplicate Entry Found !!!</p>";
				}
				echo "<table class=\"addform\" cellpadding=\"2\" cellspacing=\"2\" width=\"650\" align=\"center\">
						 <tr>
						 <td>Date</td>
						 <td>Receipt ID</td>
						 <td>Item Name</td>
						 <td>Quantity</td>
						 <td>Date Last Modified</td>
					 </tr>";
				while($row = mysql_fetch_array($result))
				{	
					
					$id=$row['rId'];
					$date=new DateTime($row['rDate']);
					$date=$date->format('d-m-Y');
					$item=$row['iName'];
					$dateModified=$row['dateAdded'];
					$quantity=$row['rQuantity'];
					
					echo "<tr>
							 <td>$date</td>
							 <td>$id</td>
							 <td>$item</td>
							 <td>$quantity</td>
							 <td><a href=\"updateReceivedForm.php?rId=$id\" >$dateModified</a></td>
						  </tr>";
				}
				echo "<tr><td colspan=\"5\"><a href=\"display.php?type=received&status=all\">Display All</a></td></tr>";
			}
			
			if($type=='Issued')
			{
				echo "<div >
						<p> Refine your Search : </p>
						<form method=\"post\" action=\"refine.php?type=given\" class=\"Refine\">
						<table id=\"refine\">
							<tr>
								<td>From : </td>
								<td><input id=\"date\" name=\"date\" onMouseOver=\"init()\" /></td>
							</tr>
							<tr>
								<td>To : </td>
								<td><input id=\"date1\" name=\"date1\" onMouseOver=\"init()\" /></td>
							</tr>  
							<tr>
								<td colspan=\"2\"><input type=\"submit\" name=\"SUBMIT\" id=\"SUBMIT\" value=\"Search\"/></td>
						</table> 
						</form>
						</div>";
						
				if($_GET['status']=='lessStock')
				{
					echo "<p class=\"heading\">Not Enough Stock Available</p>";
				}
				echo "<table class=\"addform\" cellpadding=\"2\" cellspacing=\"2\" width=\"650\" align=\"center\">
						 <tr>
						 <td>Date</td>
						 <td>Issued ID</td>
						 <td>Item Name</td>
						 <td>Quantity</td>
						 <td>Given To</td>
						 <td>Lab</td>
						 <td>Date Last Modified</td>
					 </tr>";
				while($row = mysql_fetch_array($result))
				{	
					
					$id=$row['gId'];
					$date=new DateTime($row['gDate']);
					$date=$date->format('d-m-Y');
					$item=$row['iName'];
					$dateModified=$row['dateAdded'];
					$quantity=$row['gQuantity'];
					$gto=$row['gTo'];
					$glab=$row['gLab'];
					
					echo "<tr>
							 <td>$date</td>
							 <td>$id</td>
							 <td>$item</td>
							 <td>$quantity</td>
							 <td>$gto</td>
							 <td>$glab</td>
							 <td><a href=\"updateGivenForm.php?gid=$id\" >$dateModified</a></td>
						  </tr>";
				}
				echo "<tr><td colspan=\"7\"><a href=\"display.php?type=given&status=all\">Display All</a></td></tr>";
			}
		?>				  		
    </table>   
<?php 
	writeFooter();
?>	