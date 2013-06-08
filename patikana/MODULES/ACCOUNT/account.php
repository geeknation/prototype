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

				$(".tab-content").load("personalinfo.php");
				$("#li_myinfo a").click(function(e) {
					e.preventDefault();
					$(this).tab('show');
					$(".tab-content").load("personalinfo.php");

				});
				$("#li_accinfo a").click(function(e) {
					e.preventDefault();
					$(this).tab('show');
					$(".tab-content").load("accinfo.php");
				});
				$("#li_mycollection a").click(function(e) {
					e.preventDefault();
					$(this).tab('show');
					$(".tab-content").load("mycollections.php");
				});
			});

		</script>
	</head>
	<body>
		<?php
		include "header.php";
		?>
		<div id="wrap">
			<div id="operation_check">
				<?php
				if (isset($_GET['flag'])) {
					$flag = $_GET['flag'];
					if ($flag == "update_sucess") {
						echo "<div class='update_sucess'>changes sucessful</div>";
					} else {
						echo "<div class='update_fail'>changes not sucessfull</div>";
					}
				}
				?>
			</div>
			<div class="tabbable tabs-left">
				<ul class="nav nav-tabs" id="sidemenulist">
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
				<div class="tab-content" id="content-loader"></div>
			</div>
		</div>
		<div id="logout_dialogbox"></div>
	</body>
</html>
