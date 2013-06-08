<?php
session_start();
?>
<!DOCTYPE  HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta name="description" content="How It Works,How patikana Works"/>
		<script type="text/javascript" src="jquery_ptk/jquery.js"></script>
		<script type="text/javascript" src="jquery_ptk/jqueryui.js"></script>
		<script type="text/javascript" src="jquery_ptk/bootstrap.js"></script>
		
		<link rel="stylesheet" href="bootstrap.css" type="text/css"/>
		<style type="text/css">
			#wrap{
				width:65%;
				margin:0 auto;
				border-left:solid thin #ccc;
				border-right:solid thin #ccc;
				margin-top:-1.5%;
				padding:1%;
			}
			
			#visual_explanation{
				margin:0 auto;
				padding-top:3%;
				padding-bottom:3%;
				text-align: center;
			}
			
		</style>
	</head>
	<body>
		<?php
		include "header.php";
		?>
		<div id="wrap">
			<div id="visual_explanation">
				<img src="images/howitworks.jpg" alt="how patikana works" width="600" height="600"/>	
			</div>
			<div id="theory">
				1)&nbsp; When you lose an item, e.g National ID,Laptop etc ,a registered user on our platform
				finds it, uploads the location.<p/>
				2)&nbsp;You search the item on Patikana Platform to get the location of your recovered item. Remember that you have to give a unique 
				description of your item. e.g ID number laptop serial number.
				<p/>
				<b>Note:</b><br/>
				The person uploading the items does not physically collect the items.
				The location given by the platform is considered to be prone to deviations based on the user who uploaded the item.
				
			</div>
		</div>
	</body>
</html>