<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Untitled Document</title>
		<style type="text/css">
			#wrap{
			margin:0 auto;
			width:980px;
			height:auto;
			}
			#logo{
			background-color:#6F9;
			background: -webkit-gradient(linear, left top, left bottom, from(#6F9), to(#0F6));
			text-align:center;
			}

			#main{
			text-align:center;
			height:auto;
			}
			#getstarted
			{
			background-color:#6F9;
			background: -webkit-gradient(linear, left top, left bottom, from(#6F9), to(#0F6));
			width:200px;
			height:90px;
			text-align:center;
			}
			b.info{
			font-weight:bold;
			font-size:24px;
			}
			#start{
			text-decoration:none;
			}
			#footer{
			text-align:center;
			font-weight:bolder;
		</style>
	</head>
	<body>
		<div id="wrap">
			<div id="logo">
				<h3><img src="mainlogo.png" alt="patikana"></h3>
			</div>
			<div id="main">
				<b class="info">Welcome to patikana web search,this is a site that allows people to  help find lost items</b>
				<p/>
				<a href="Home.php" id="start">
				<button id="getstarted">
					lets get started
				</button></a>
				<?php
				if (stripos(strtolower($_SERVER["HTTP_USER_AGENT"]), 'opera') || stripos(strtolower($_SERVER["HTTP_USER_AGENT"]), 'android') || stripos(strtolower($_SERVER["HTTP_USER_AGENT"]), 'iphone') || stripos(strtolower($_SERVER["HTTP_USER_AGENT"]), 'blackberry') || stripos(strtolower($_SERVER['HTTP_USER_AGENT']), 'ipod') || stripos(strtolower($_SERVER['HTTP_USER_AGENT']), 'nokia')) {
					header("Location: http://m.patikana.co.ke");
				} else if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),"wap") || strpos(strtolower($_SERVER['HTTP_USER_AGENT']),"wml")) {
					header("Location: http://m.patikana.co.ke/wml/");
				} else {
					header("Location: http://www.patikana.co.ke/Home.php");
				}
				?>
			</div>
			<div id="footer">
				&copy;2011
			</div>
		</div>
	</body>
</html>
