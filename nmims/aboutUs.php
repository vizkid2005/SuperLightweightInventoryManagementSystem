<?php 
	require_once("Includes/functions.php");
	$moreScripts="<script type=\"application/javascript\" src=\"Scripts/slides.jquery.js\"></script>
				  <script> $(function(){
                				$(\"#slides\").slides();
								generateNextPrev: true
           					 });
				  </script>";
				  
	writeHeader("NMIMS - About the Developers",$moreScripts);
?>
<style type="text/css" media="screen">
            .slides_container {
				margin-left:auto;
				margin-right:auto;
				margin-top:20px;
				margin-bottom:20px;
                width:650px;
                height:400px;
            }
            .slides_container div {
                width:650px;
                height:400px;
                display:block;
            }
			#slides a {
				display:inline;
			}
			#heading {
				color:#8C489F;
				text-align:center;
				font-size:20px;
				font-family:Verdana, Geneva, sans-serif;
			}
</style>
<div id="heading">
<h3>The Developers</h3>
</div>
<div id="slides">
            <div class="slides_container">
                <div>
                    <img src="Imgs/huzefaPic.png">
                </div>
                <div>
                    <img src="Imgs/hatimPic.png">
                </div>
                <div>
                    <img src="Imgs/aamirPic.png">
                </div>
            </div>
            <div style="width:70px; margin-left:auto; margin-right:auto;"><a href="#" class="prev"><img src="Imgs/prevArrow.png"  /></a> <a href="#" class="next"><img src="Imgs/nextArrow.png"  /></a>
</div>
</div>
<?php 
	writeFooter();
?>	