<?php
session_start();
require_once ("api/Documents.php");
$docnumber = $_GET['docnumber'];
$doc = new Documents();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title> Found document details </title>
		<script type="text/javascript" src="jquery_ptk/js/jquery.js"></script>
		<script type="text/javascript" src="jquery_ptk/js/jqueryui.js"></script>
		<link rel="stylesheet" href="bootstrap/css/bootstrap.css" type="text/css"/>
		<link rel="stylesheet" href="index.css" type="text/css"/>
		<style type="text/css">
			.appear {
				width: 70%;
				border: #f5f5f5 solid thin;
				margin: 0 auto;
				margin-bottom: 2%;
				background-color: #F7F7F9;
			}
			#lostdetails {
			}
			#wrap {
				padding-top: 4%;
				padding-bottom: 4%;
			}
			.heading {
				width: 70%;
				font-size: large;
				text-transform: capitalize;
				color: #009900;
				margin: 0 auto;
				text-align: left;
			}
			#confirm_box {
				margin: 0 auto;
				width:60%;
				text-align: center;	
				color:#008800;
			}
		</style>
		<script type="text/javascript">
			$(document).ready(function() {

	var yes = $("#doc_confirm_yes");
	var no = $("#doc_confirm_no");
	var page_flag = $("#page_flag").val();
	var docnumber = $("#doc_number").val();
	
	yes.bind('click', function() {

		$(".confirm_box").html('Please wait...');
		//set up query

		//send data.
		$.post('confirmownership.php', {
			docnumber : docnumber
		}, function(data) {
			if( data == 'locked') {
				$("#confirm_box").fadeOut('fast').fadeIn(200, function() {
					$(this).html("You have fully claimed your Document").removeClass().addClass("alert alert-success");
				})
			} else {
				$("#confirm_box").html("An error occured in confirming");
			}
		});
	});

	no.bind('click', function() {
		$("#confirm_box").html('Please wait...');
		$('#confirm_box').fadeOut('fast').fadeIn(200, function() {
			$(this).html('You have choosen to ignore').removeClass().addClass('alert alert-info');
		});
	});
	
	/*$.get('confirmownership.php', {
		checklock : '1',
		pageflag : page_flag,
		docno:docnumber
	}, function(data) {
		if(data=='locked'){
			$(".confirm_box").html("You have fully claimed your Document").css('background-color', '#00FF00');
		}
	});*/
});

		</script>
	</head>
	<body>
		<?php
		include "header.php";
		?>
		<div id="wrap">
			<section>
				<?php

				$doc -> recoverItem($docnumber,"pc");
				?>
				<input type="hidden" value="<?php echo $docnumber?>" id="doc_number"/>
			</section>
			<div id="confirm_box" class="alert alert-warning">
				<p class="prompt_text">
					Is this Document Yours? If yes..Please click on Yes otherwise click no.
				</p>
				<button class="btn btn-success" id="doc_confirm_yes">
					Yes
				</button>
				&nbsp;&nbsp;&nbsp;
				<button class="btn btn-danger" id="doc_confirm_no">
					No
				</button>
			</div>
		</div>
	</body>
</html>
