<?php 
	require_once("connection.php");
	require_once("Includes/functions.php");
	writeHeader("NMIMS - Update/Remove Item","");
	//Get values from server on select of drop down 
	if(isset($_GET))
	{
		$name=$_GET['iname'];
		$query="select * from item where iName='$name'";
		if($row=mysql_query($query, $connection))
		{	
			$result=mysql_fetch_assoc($row);
			$type=$result['iType'];
			$unit=$result['iUnit'];
			$threshold=$result['iThreshold'];
			$code=$result['iCode'];
		}
	}
	
		 
?>	
<style type="text/css">
	#updateForm
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
<div id="heading"><strong>Update/Remove Item</strong></div>
<form method="post" id="myform" action="addItem.php?update=<?php echo $code; ?>&name=<?php echo $name; ?>">
	<table id="updateForm" cellpadding="5" cellspacing="10" width="400" align="center">
		<tr class="tr1">
        	<td>Item Name</td>
            <td><input name="NAME" id="NAME" value="<?php echo $name; ?>" /></td>
        </tr>
        <tr class="tr2">
        	<td>Type</td>
        	<td><input type="text" name="TYPE" id="TYPE" value="<?php echo $type; ?>"/></td>    
       </tr>
       <tr class="tr1">
        	<td>Unit</td>
        	<td><input type="text" name="UNIT" id="UNIT" value="<?php echo $unit; ?>" /></td>    
       </tr>
       <tr class="tr2">
        	<td>Theshold</td>
        	<td><input type="text" name="THRESHOLD" id="THRESHOLD" value="<?php echo $threshold; ?>" /></td>    
       </tr>
       <tr class="tr1">
        	<td style="font-size:0.75em;"><input type="checkbox" name="DELETE" id="DELETE" value="true" />Delete Item </td>
            <td><input type="submit" name="SUBMIT" id="SUBMIT" value="Update Item"/></td>    
       </tr>
    </table>   
    	<div id="myform_errorloc" class="error_strings" align="center"></div>
            
</form>
<script type="text/javascript">
  var frmvalidator  = new Validator("myform");
  	frmvalidator.EnableOnPageErrorDisplaySingleBox();
 	frmvalidator.EnableMsgsTogether();


    frmvalidator.addValidation("NAME","req","Please enter Name");
	frmvalidator.addValidation("TYPE","req","Type Field is Empty");
	frmvalidator.addValidation("THRESHOLD","req","Threshold Field is Empty");
	frmvalidator.addValidation("THRESHOLD","numeric","Please enter a Numeric Value in Threshold");
	frmvalidator.addValidation("UNIT","req","Unit Field is Empty");


</script>
<?php 
	writeFooter();
?>	