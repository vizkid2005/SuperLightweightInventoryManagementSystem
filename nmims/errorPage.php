<?php 
	require_once("Includes/functions.php");			  
	writeHeader("NMIMS - 404 Error","");
?>
<style type="text/css" media="screen">
            
            
			#box {
				font-family:Verdana, Geneva, sans-serif;
				color:#8C489F;
				font-size:18px;
			}
			#image
			{
				width:200px;
				padding:0px;
				clear:both;
				margin-left:auto;
				margin-right:auto;	
				margin-top:20px;
				margin-bottom:30px;
			}
			#heading {
				color:#8C489F;
				text-align:center;
				font-size:24px;
				font-family:Verdana, Geneva, sans-serif;
			}
			#text
			{
				width:500px;
				margin-left:auto;
				margin-right:auto;	
				margin-bottom:100px;
			}
			
</style>
<div id="heading">
<h3>Oops!! Page Not Found</h3>
</div>
<div id="box">
	<div id="image">
    	<img src="Imgs/404Img.png" width="300" />
    </div>
    <div id="text">
        You`re Looking for something <br/>that does not,has not,will not,might not<br/> or must not exist.
    </div> 
</div>
<?php 
	writeFooter();
?>	