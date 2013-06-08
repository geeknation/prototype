<?php
/*
session_start();
include 'backend/api_ptk_backend.php';
$adminfrontend15 = new PatikanaAdmin();
$adminfrontend15 -> ptk_visitor_counter();
$adminfrontend15 -> pageviews('1', 'itsmine.php');*/
?><br/>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Patikana</title>
		<script type="text/javascript" src="jquery_ptk/js/jquery.js"></script>
		<script type="text/javascript" src="jquery_ptk/js/jqueryui.js"></script>
		<script type="text/javascript" src="livepage.js"></script>
		<script type="text/javascript" src="itsmine.js"></script>
		<link rel="stylesheet" href="index.css" type="text/css"/>
		<link rel="stylesheet" href="bootstrap/css/bootstrap.css" type="text/css"/>
		
		<style type="text/css">
			#wrap{
				background-color:#f7f7f9 !important;
			}
			.verifyform
			{
				width:100%;
				height:inherit;
				background-color:#f7f7f9;
				margin:0 auto;
				text-align:center;
				margin-top:10%;
			}
			#attemptnames{
				width:70%;
				height:30px;
				margin-bottom:20px;
			}
			#verifybutton{
				margin-bottom:20px;
				width:150px;
			}
			#prompt{
				color:#FF0000; 
				
			}
			
		</style>
	</head>
	<body onload="document.verifyform.attemptnames.focus()">
		
		<?php
			include "header.php";
		?>
		<div id="wrap">
			
				<div class="verifyform">
					<br/>Before you get the location of this document, we first have to verify that
					the document with the number<?php
					echo "&nbsp;&nbsp;<b>".$_GET['idnumber']."</b>&nbsp;&nbsp;";
					?>it's actually your lost document. 
				</p>
				<p>
					What are the names on the lost document?<p/> Type in the names into the text box 
					below<b> seperated by spaces</b><i> (not case sensitive)</i>
					
					
				</p>
				<?php
				$docnumber=$_GET['idnumber'];
				$itemtype=$_GET['itemtype'];
				?>
				<div id="prompt">
					<?php
					if(isset($_GET['error'])){
						if($_GET['error']=='nomatch'){
							echo "the names you typed dont match the names on this document";
						}
					}
					?>
				</div>
				<form name="verifyform" method="post" action="verifyowner.php" id="verifyform">
					<input type="text" name="attemptnames" id="attemptnames"/><p/>
					<input type="hidden" value="<?php echo $docnumber;?>" name="docnumber"/>
					<input type="hidden" value="<?php echo $itemtype; ?>" name="itemtype"/>
					<input type="button" id="verifybutton" value="Verify document" class="btn btn-success"/>
				</form>
			</div>
			
			
			
		
		<p/>
		
		</div>
		<?php 
			include "footer.php";
		?>
		<div class='error_dialog'></div>
	</body>
</html>