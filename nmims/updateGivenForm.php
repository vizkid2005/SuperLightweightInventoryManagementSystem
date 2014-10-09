<?php 
	require_once("Includes/functions.php");
	require_once("connection.php");
	writeHeader("NMIMS - Issue Item","<link href=\"Styles/calendar.css\" rel=\"stylesheet\" type=\"text/css\" >
        <script src=\"Scripts/calendar.js\" type=\"text/javascript\"></script>
        <script type=\"text/javascript\">
            function init() {
                calendar.set(\"date\");
            }
        </script>");
		$query="select iName from item";
		$result=mysql_query($query,$connection);

		if(isset($_GET))
	{		
			$id=$_GET['gid'];
			
			$query="select * from given where gId='$id'";
			if($row=mysql_query($query, $connection))
			{	
				$result2=mysql_fetch_assoc($row);
				$date=$result2['gDate'];
				$iname=$result2['iName'];
				$remarks=$result2['gRemarks'];
				$oldQuantity=$result2['gQuantity'];
				$glab = $result2['gLab'];
				$gto = $result2['gTo'];
			}
		
	}
?>	

<style type="text/css">
	#addform
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
	#heading {
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
echo "
<div id=\"heading\"><strong>Issue Item</strong></div>
<form method=\"post\" action=\"updateGiven.php\" id=\"myform\" name=\"myform\">
	
    <table id=\"addform\" cellpadding=\"5\" cellspacing=\"10\" width=\"400\" align=\"center\">
         <tr class=\"tr1\">
        	<td>Issued ID</td>
        	<td><input type=\"text\" name=\"gId\" value=\"$id\" id=\"gId\" /></td>    
       </tr>
        <tr class=\"tr2\">
        	<td>Date</td>
            <td><input id=\"gDate\" name=\"gDate\" type=\"text\" value=\"$date\" onMouseOver=\"init()\"></td>
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
		echo "		
                </select></td>
        </tr>
        <tr class=\"tr2\">
        	<td>Quantity</td>
        	<td><input type=\"text\" name=\"gQuantity\" value=\"$oldQuantity\" id=\"gQuantity\" /></td>    
       </tr>		
	   			
       <tr class=\"tr1\">
        	<td>Given To</td>
        	<td><select id=\"gTo\" name=\"gTo\" type=\"text\"> ";
					
					$query="select cName from consumer";
					$result=mysql_query($query,$connection);
				
                	while($row=mysql_fetch_array($result))
					{
						echo "<option value=\"$row[cName]\" ";
						if($row['cName']==$gto)
						{
							echo "selected=\"true\"";
						}
						echo ">$row[cName]</option>";
					}
                echo "
            </td>    
       </tr>
       <tr class=\"tr2\">
        	<td>LAB</td>
        	<td><select id=\"gLab\" name=\"gLab\" type=\"text\">";
				 $query="select lName from lab";
					$result=mysql_query($query,$connection);
				
                	while($row=mysql_fetch_array($result))
					{
						echo "<option value=\"$row[lName]\" ";
						if($row['lName']==$glab)
						{
							echo "selected=\"true\"";
						}
						echo ">$row[lName]</option>";
					}
                echo "</td>    
       </tr>
       <tr class=\"tr1\">
        	<td>Remarks</td>
        	<td><input id=\"gRemarks\" name=\"gRemarks\" value=\"$remarks\" type=\"text\"></td>    
       </tr>
       <tr class=\"tr2\">
       		<td style=\"font-size:0.75em;\"><input type=\"checkbox\" name=\"DELETE\" id=\"DELETE\" value=\"true\" />Delete Entry</td>
        	<td><input type=\"submit\" name=\"SUBMIT\" id=\"SUBMIT\" value=\"Modify Entry\"/></td>    
       </tr>
    </table>   
    <div id=\"myform_errorloc\" class=\"error_strings\" align=\"center\"></div>
            
</form>
<script type=\"text/javascript\">
  var frmvalidator  = new Validator(\"myform\");
  	frmvalidator.EnableOnPageErrorDisplaySingleBox();
 	frmvalidator.EnableMsgsTogether();

	frmvalidator.addValidation(\"date\",\"req\",\"Date Field is Empty\");
	frmvalidator.addValidation(\"QUANTITY\",\"req\",\"Quantity Field is Empty\");
	frmvalidator.addValidation(\"QUANTITY\",\"numeric\",\"Please enter a Numeric Value in QUANTITY\");


</script>";
 
	writeFooter();
?>	