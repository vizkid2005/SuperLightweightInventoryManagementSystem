<?php 
	require_once("Includes/functions.php");
	writeHeader("NMIMS - Add Consumer","");
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
<div id="heading"><strong>Add Consumer</strong></div>
<form method="post" action="addConsumer.php" name="myform" id="myform">
	<table id="addform" cellpadding="5" cellspacing="10" width="400" align="center">
		<tr class="tr1">
        	<td>Consumer Name</td>
            <td><input type="text" name="NAME" id="NAME" /></td>
        </tr>
        <tr class="tr2">
        	<td>Type</td>
        	<td><select name="TYPE" id="TYPE">
            		<option>Teaching</option>
                    <option>Non-Teaching</option>
                    <option>Lab</option>
                 </select>
           	</td>    
       </tr>
       <tr class="tr1">
       		<td>Remarks</td>
        	<td><input type="text" name="REMARKS" id="REMARKS" /></td>    
       </tr>
       <tr class="tr1">
        	<td colspan="2"><input type="submit" name="SUBMIT" id="SUBMIT" value="Add Consumer"/></td>    
       </tr>
    </table>   
    <div id="myform_errorloc" class="error_strings" align="center"></div>
            
</form>
<script type="text/javascript">
  var frmvalidator  = new Validator("myform");
  	frmvalidator.EnableOnPageErrorDisplaySingleBox();
 	frmvalidator.EnableMsgsTogether();

    frmvalidator.addValidation("NAME","req","Please enter Name");
</script>
<?php 
	writeFooter();
?>	