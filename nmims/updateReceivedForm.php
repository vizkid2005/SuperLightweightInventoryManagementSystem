<?php 
	require_once("connection.php");
	require_once("Includes/functions.php");
	writeHeader("NMIMS - Update/Remove Received Item","");
	//Get values from server on select of drop down 
	
	if(isset($_GET))
	{		
			$id=$_GET['rId'];
			
			$query="select * from received where rId='$id'";
			if($row=mysql_query($query, $connection))
			{	
				$result=mysql_fetch_assoc($row);
				$date=$result['rDate'];
				$iname=$result['iName'];
				$remarks=$result['rRemarks'];
				$oldQuantity=$result['rQuantity'];
			}
		
	}
?>	
<style type="text/css">
	.updateForm
			{
				color:#FFFFFF;	
			}
			tr
			{
				cell-padding: 20px;
				font-size: 18px;
				font-family: Verdana, Geneva, sans-serif;
				text-align: center;
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
if(isset($_GET['rId']))
{
echo "

	<div class=\"heading\"><strong>Update/Remove Received Item</strong></div>
	<form method=\"post\" id=\"myform2\" action=\"updateReceived.php\">
		<table class=\"updateForm\" cellpadding=\"5\" cellspacing=\"10\" width=\"400\" align=\"center\">
		<tr class=\"tr1\">
        	<td>Receipt ID</td>
        	<td><input type=\"text\" name=\"rId\" id=\"rId\" value=\"$id\" /></td>    
       </tr>
       <tr class=\"tr2\">
        	<td>Date</td>
            <td><input id=\"rDate\" name=\"rDate\" type=\"text\" value=\"$date\" onMouseOver=\"init()\"></td>
       </tr>
        <tr class=\"tr1\">
        	<td>Item Name</td>
            <td><select id=\"iName\" name=\"iName\" type=\"text\">";
					$query="select iName from item order by iName ASC";
					$result=mysql_query($query,$connection);
				
                	while($row=mysql_fetch_array($result))
					{
						echo "<option value=\"$row[iName]\" ";
						if($row['iName']==$iname)
						{
							echo "selected=\"true\"";
						}
						echo ">$row[iName]</option>";
					}
				
              echo  "</select>	
            </td>
        </tr>
        <tr class=\"tr2\">
        	<td>Quantity</td>
        	<td><input type=\"number\" name=\"rQuantity\" id=\"rQuantity\" value=\"$oldQuantity\"/></td>    
       </tr>
       <tr class=\"tr1\">
        	<td>Remarks</td>
        	<td><input type=\"text\" name=\"rRemarks\" id=\"rRemarks\" value=\"$remarks\"/></td>    
       </tr>
       <tr class=\"tr2\">
       		<td style=\"font-size:0.75em;\"><input type=\"checkbox\" name=\"DELETE\" id=\"DELETE\" value=\"true\" />Delete Entry</td>
        	<td><input type=\"submit\" name=\"SUBMIT\" id=\"SUBMIT\" value=\"Modify Entry\"/></td>    
       </tr>
    </table> 
       <div id=\"myform_errorloc\" class=\"error_strings\" align=\"center\"></div>         
</form>";  
}
?>

<?php 
	writeFooter();
?>	