<?php

function redirect($link)
{
	header("Location: ".$link);
	exit();
}	

function writeHeader($title,$moreSrcipts)
{
	//Make dyanamic title also
	echo "<html>
	<head>
		<script type=\"text/javascript\" src=\"Scripts/jquery.js\"></script>
		<script type=\"text/javascript\">
			$(\"#left > ul > li > ul\").click(function(){
			 
				if(false == $(this).next().is(':visible')) {
					$('#left ul').slideUp(300);
				}
				$(this).next().slideToggle(300);
			});
		</script>
		<link rel=\"stylesheet\" type=\"text/css\" href=\"Styles/commonStyle.css\">
			$moreSrcipts
		
		<title>$title</title>
		
		<script language=\"JavaScript\" src=\"gen_validatorv4.js\" type=\"text/javascript\" xml:space=\"preserve\"></script>
		 <style type=\"text/css\" xml:space=\"preserve\">
		.error_strings{ font-family:Verdana; font-size:15px; color:red; background-color:inherit;}
</style>
	</head>

<body>
    <div id=\"center\">
    <div id=\"header\"><a href=\"index.php\"><img src=\"Imgs/headerImg.png\"/></a></div>
    <div id=\"content\">
        <div id=\"left\">
            <ul id=\"accordion\">
                <li><div>Items</div>
                    <ul>
                        <li><a href=\"addItemForm.php\">Add</a></li>
                        <li><a href=\"display.php?type=item&status=none\">View</a></li>
                    </ul>
                </li>
                <li><div>Consumers</div>
                    <ul>
                        <li><a href=\"addConsumerForm.php\">Add</a></li>
                        <li><a href=\"display.php?type=consumer&status=none\">View</a></li>
                    </ul>
                </li>
				<li><div>Received</div>
                    <ul>
                        <li><a href=\"receivedForm.php\">Add</a></li>
                        <li><a href=\"display.php?type=received&status=none\">View</a></li>
                    </ul>
                </li>
				<li><div>Issued</div>
                    <ul>
                        <li><a href=\"givenForm.php\">Add</a></li>
                        <li><a href=\"display.php?type=given&status=none\">View</a></li>
                    </ul>
                </li>
            </ul>                     
        </div>
        
    <div id=\"right\"> ";
}

function writeFooter()
{
	echo "</div>
	</div>
	<div id=\"footer\"><h3 style=\"color: #443266; column-gap: normal;\"><pre>   &copy;2014 MakeShift Developers,  ALL RIGHTS RESERVED</pre></h3></div>
	</div>
	
	</body>
	<script>
	$(\"#accordion > li > div\").click(function(){
	 
		if(false == $(this).next().is(':visible')) {
			$('#accordion ul').slideUp(300);
		}
		$(this).next().slideToggle(300);
	});
	</script>
	</html>";
}

function changeDate($inDate)
{
	$dateSplit= explode("-",$inDate);
	$outDate= $dateSplit[2]+"-"+$dateSplit[1]+"-"+$dateSplit[0];
	return $outDate;
}
?>	
