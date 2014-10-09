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
		$query="select iName from item order by iName ASC";
		$result=mysql_query($query,$connection);
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
<div id="heading"><strong>Issue Item</strong></div>
<form method="post" action="addGiven.php" id="myform" name="myform">
	
    <table id="addform" cellpadding="5" cellspacing="10" width="400" align="center">
        <tr class="tr1">
        	<td>Date</td>
            <td><input id="date" name="date" type="text" onMouseOver="init()"></td>
       </tr>
       <tr class="tr2">     
        	<td>Item Name</td>
            <td><select id="NAME" name="NAME" type="text">
            	<?php
                	while($row=mysql_fetch_array($result))
					{
						echo "<option value=\"$row[iName]\">$row[iName]</option>";
					}
				?>
                </select></td>
        </tr>
        <tr class="tr1">
        	<td>Quantity</td>
        	<td><input type="text" name="QUANTITY" id="QUANTITY" /></td>    
       </tr>		
	   			
       <tr class="tr2">
        	<td>Given To</td>
        	<td><select id="GTO" name="GTO" type="text">
				 <?php $query="select cName from consumer";
                    $result=mysql_query($query,$connection);
                    while($row=mysql_fetch_array($result))
                    {
                        echo "<option value=\"$row[cName]\">$row[cName]</option>";
                    }
                ?>
            </td>    
       </tr>
       <tr class="tr1">
        	<td>LAB</td>
        	<td><select id="LAB" name="LAB" type="text">
				 <?php $query="select lName from lab";
                    $result=mysql_query($query,$connection);
                    while($row=mysql_fetch_array($result))
                    {
                        echo "<option value=\"$row[lName]\">$row[lName]</option>";
                    }
                ?></td>    
       </tr>
       <tr class="tr2">
        	<td>Remarks</td>
        	<td><input id="REMARKS" name="REMARKS" type="text"></td>    
       </tr>
       <tr class="tr1">
        	<td colspan="2"><input type="submit" name="SUBMIT" id="SUBMIT" value="Issue Item"/></td>    
       </tr>
    </table>   
    <div id="myform_errorloc" class="error_strings" align="center"></div>
            
</form>
<script type="text/javascript">
  var frmvalidator  = new Validator("myform");
  	frmvalidator.EnableOnPageErrorDisplaySingleBox();
 	frmvalidator.EnableMsgsTogether();

	frmvalidator.addValidation("date","req","Date Field is Empty");
	frmvalidator.addValidation("QUANTITY","req","Quantity Field is Empty");
	frmvalidator.addValidation("QUANTITY","numeric","Please enter a Numeric Value in QUANTITY");


</script>
<?php 
	writeFooter();
?>	