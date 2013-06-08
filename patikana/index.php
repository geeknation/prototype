<?php
session_start();
?>
<!DOCTYPE  HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>Patikana|Search for your Lost Documents</title>
		<link rel="stylesheet" type="text/css" href="bootstrap.css">
		<link rel="stylesheet" type="text/css" href="jquery_ptk/jquery.css">
		<link rel="stylesheet" type="text/css" href="flat-ui.css">
		<link rel="stylesheet" type="text/css" href="template.css">
		<link rel="stylesheet" type="text/css" href="main.css">
		<link rel="stylesheet" type="text/css" href="suggest.css">
	</head>
	<body>
		<!-- <div class="navbar">
			<span>PATIKANA</span>
			<br/>
			<span id="tagline">find your lost documents</span>
		</div> -->
		<?php
		include "header.php";
		?>
		<div id="wrap">
			<div class="searchholder">
				<form>
					<input type="text" class="search" name="parameter" id="q" placeholder="e.g. national id number, school id number" onblur="setTimeout('removeSuggestions()',200);" onkeyup="getSuggestions(this.value);"/>
					<input type="button" class="button btn-large" value="" onclick="searchId(form.parameter.value)" id="searchbutton"/>
					<div id="s" class="suggestions"></div>
				</form>
			</div>
			<div class="mainpanel">
				<div id="leftpanel">
					<div id="livestream">
						<h4 style="padding-left: 1%;"> Recent Activity&nbsp;<img src="images/category.png" height="4" style="height: 20px;"/></h4>
						<input type="hidden" value='' id="loadscrollpointer"/>
						<input type="hidden" value='' id="recordsdisplayed"/>
						<div id="livestreamcontent"></div>
					</div>
				</div>
				<div id="sidepane">
					<div class="sidepanel">
						<div class="header">
							Header
						</div>
						<hr/>
						<ul class="nav nav-stacked nav-pills">
							<?php
							if (isset($_SESSION['user_allow'])){
								echo '
									
								
								';
							}else{
								echo '
								
									<li>
									<a href="#createaccount" id="register_form_link">Create account</a>
								</li>
							
								';
							}
							?>
							<li>
								<a href="#reportlost" id="announcelost">I Lost my Document</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<?php
		include "dialogdivs.html";
		?>
		<input type="hidden" value='' id="loadscrollpointer"/>
		<input type="hidden" value='' id="recordsdisplayed"/>
		<input type="hidden" value='' id="last_count"/>
		<script type="text/javascript" src="jquery_ptk/jquery.js"></script>
		<script type="text/javascript" src="jquery_ptk/jqueryui.js"></script>
		<script type="text/javascript" src="livepage.js"></script>
		<script type="text/javascript" src="suggest.js"></script>
		<script type="text/javascript" src="search_ids.js"></script>
	</body>
</html>