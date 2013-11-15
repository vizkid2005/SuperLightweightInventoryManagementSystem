<?php 
	require_once("connection.php");
	require_once("Includes/functions.php");
	writeHeader("NMIMS - Update/Remove Consumer","");
	//Get values from server on select of drop down 
	
	if(isset($_GET))
	{
		if(isset($_GET['type']))
		{
			$name=$_GET['cname'];
			$query="select * from lab where lName='$name'";
			if($row=mysql_query($query, $connection))
			{	
				$result=mysql_fetch_assoc($row);
				$name=$result['lName'];
				$remarks=$result['lRemarks'];
				
			}
		}
		else
		{
			
			$name=$_GET['cname'];
			$query="select * from consumer where cName='$name'";
			if($row=mysql_query($query, $connection))
			{	
				$result=mysql_fetch_assoc($row);
				$type=$result['cType'];
				$remarks=$result['cRemarks'];
				
			}
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
if(!isset($_GET['type']))
{
echo "

	<div class=\"heading\"><strong>Update/Remove Consumer</strong></div>
	<form method=\"post\" id=\"myform2\" action=\"addConsumer.php?name=$name\">
		<table class=\"updateForm\" cellpadding=\"5\" cellspacing=\"10\" width=\"400\" align=\"center\">
			<tr class=\"tr1\">
				<td>Consumer Type</td>
				<td><select name=\"TYPE\" id=\"TYPE\" value=\"$type\">
						<option ";
						if($type=='Teaching')
									   {
										   echo "selected=\"true\"";
									   }
							   echo ">Teaching</option>
						<option ";
						 if($type=='Non-Teaching')
									   {
										   echo "selected=\"true\"";
									   }
								echo ">Non-Teaching</option>
						<option ";
						 if($type=='Lab')
									   {
										   echo "selected=\"true\"";
									   }
								echo ">Lab</option>
					 </select></td>    
		   </tr>
			<tr class=\"tr2\">
				<td>Consumer Name</td>
				<td><input type=\"text\" name=\"NAME\" id=\"NAME\"  value=\"$name\"/></td>
			</tr>
			
		   <tr class=\"tr1\">
				<td>Remarks</td>
				<td><input type=\"text\" name=\"REMARKS\" id=\"REMARKS\"  value=\"$remarks\"/></td>    
		   </tr>
		   <tr class=\"tr2\">
				<td style=\"font-size:0.75em;\"><input type=\"checkbox\" name=\"DELETE\" id=\"DELETE\" value=\"true\"/>Delete Item </td>
				<td><input type=\"submit\" name=\"SUBMIT\" id=\"SUBMIT\" value=\"Update Item\"/></td>    
		   </tr>
		</table>
		<div id=\"myform2_errorloc\" class=\"error_strings\" align=\"center\"></div>
		</form>
		<script type=\"text/javascript\">
 		 var frmvalidator  = new Validator(\"myform2\");
  		frmvalidator.EnableOnPageErrorDisplaySingleBox();
 		frmvalidator.EnableMsgsTogether();

    frmvalidator.addValidation(\"NAME\",\"req\",\"Please enter Name\");
</script>   
	  ";  
}
else
{
	
echo "<div class=\"heading\"><strong>Update/Remove Lab</strong></div>
<form method=\"post\" id=\"myform\" action=\"addConsumer.php?name=$name&type=lab\">
	<table class=\"updateForm\" cellpadding=\"5\" cellspacing=\"10\" width=\"400\" align=\"center\">
		<tr class=\"tr1\">
        	<td>Lab Name</td>
            <td><input type=\"text\" name=\"NAME\" id=\"NAME\"  value=\"$name\"/></td>
        </tr>
       <tr class=\"tr2\">
        	<td>Remarks</td>
        	<td><input type=\"text\" name=\"REMARKS\" id=\"REMARKS\"  value=\"$remarks\"/></td>    
       </tr>
       <tr class=\"tr1\">
        	<td style=\"font-size:0.75em;\"><input type=\"checkbox\" name=\"DELETE\" id=\"DELETE\" value=\"true\"/>Delete Item </td>
            <td><input type=\"submit\" name=\"SUBMIT\" id=\"SUBMIT\" value=\"Update Item\"/></td>    
       </tr>
	   
    </table> 
	<div id=\"myform_errorloc\" class=\"error_strings\" align=\"center\"></div>
	</form>
	<script type=\"text/javascript\">
 	 var frmvalidator  = new Validator(\"myform\");
  		frmvalidator.EnableOnPageErrorDisplaySingleBox();
 		frmvalidator.EnableMsgsTogether();

   	 frmvalidator.addValidation(\"NAME\",\"req\",\"Please enter Name\");
	</script>

	";
	
	
}
?>            


<?php 
	writeFooter();
?>	