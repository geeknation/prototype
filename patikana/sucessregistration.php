<?php
session_start();
?>
<html>
<head>
	<script type="text/javascript" src="jquery_ptk/jquery.js"></script>
	<script type="text/javascript" src="jquery_ptk/jqueryui.js"></script>
 	<link rel="stylesheet" type="text/css" href="jquery_ptk/css/jquery.css"/>
	<script type="text/javascript" src="livepage.js"></script>
	<link rel="stylesheet" href="bootstrap.css" type="text/css"/>
	<style type="text/css">
		#diag
		{
			width:60%;
			height:100%;
			margin:0 auto;
		}

	</style>
</head>
	<body>
		<?php
			include "header.php";
		?>
		<div id="wrap">
			<div id="diag">
				<div class="alert alert-success">
					<strong><h4 style="margin-left:2%">Sucessful registration!</h4></strong>
					<ul class="nav nav-list">
						<li class="divider"/>
					</ul>
					<span style="padding-left:2%">You have succesfully registered an account</span> 
				</div>
				<ul class="nav pull-right"> 
					<li>
						<button class="btn-primary btn-large" value="Login" class="login_user">Login</button>
					</li>
				</ul>
			</div>


		</div>
		<div class='login_dialog'>

		</div>
	</body>
</html>