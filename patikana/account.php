<?php
session_start();
?>
<html>
	<head>
		<script type="text/javascript" src="jquery_ptk/jquery.js"></script>
		<script type="text/javascript" src="jquery_ptk/jqueryui.js"></script>
		<script type="text/javascript" src="jquery_ptk/bootstrap.js"></script>
		
		<link rel="stylesheet" type="text/css" href="bootstrap.css">
		<link rel="stylesheet" type="text/css" href="jquery_ptk/jquery.css">
		<link rel="stylesheet" type="text/css" href="flat-ui.css">
		<link rel="stylesheet" type="text/css" href="accounts.css"/>
		<script type="text/javascript">
			jQuery(document).ready(function() {
				$("ul#sidemenulist>li").click(function(){
					$("ul#sidemenulist>li").removeClass("active");
					$(this).addClass("active");
				});
				$(".tab-content").load("personalinfo.php");
				$("#li_myinfo a").click(function(e) {
					e.preventDefault();
					$(".tab-content").load("personalinfo.php");

				});
				$("#li_accinfo a").click(function(e) {
					e.preventDefault();
					$(".tab-content").load("accinfo.php");
				});
				$("#li_mycollection a").click(function(e) {
					e.preventDefault();
					$(".tab-content").load("mycollections.php");
				});
			});

		</script>
	</head>
	<body>
		<?php
		include "header.php";
		?>
		<div id="wrap" style="border-left:#ccc solid thin;border-right:#ccc solid thin;margin-top:-1.5%;">
			<div id="operation_check">
				<?php
				if (isset($_GET['flag'])) {
					$flag = $_GET['flag'];
					if ($flag == "update_sucess") {
						echo "<div class='alert alert-success'>changes sucessful</div>";
					} else {
						echo "<div class='alert alert-danger'>changes not sucessfull</div>";
					}
				}
				?>
			</div>
			<div class="tabs-left">
				<ul class="nav nav-pills nav-stacked" id="sidemenulist">
					<li class="active" id="li_myinfo">
						<a href="#" id="myinfo">My Information</a>
					</li>
					<li id="li_accinfo">
						<a href="#" id="accinfo">Account Information</a>
					</li>
					<li id="li_mycollection">
						<a href="#" id="mycollection">My collection</a>
					</li>
					</ul>
					<ul class="nav">
						<li class="divider-vertical"></li>
					</ul>
				
			</div>
			<div class="tab-content" id="content-loader" style="padding-top:0%;"></div>
		</div>
		<div id="logout_dialogbox"></div>
	</body>
</html>
