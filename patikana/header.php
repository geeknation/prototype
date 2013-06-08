<?php
global $user;
if (isset($_SESSION['user_allow'])) {
	$user = $_SESSION['user_allow'];
}
?>
<link rel="icon" href="images/favicon.ico" type="image/ico"/>
<script type="text/javascript" src="jquery_ptk/jquery.js"></script>
<script type="text/javascript" src="jquery_ptk/bootstrap-collapse.js"></script>
<script type="text/javascript" src="jquery_ptk/bootstrap-dropdown.js"></script>
<style type="text/css">
</style>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".dropdown-toggle").dropdown();
	});
</script>
<div class="navbar">
		<div class="navbar-inner" style="">
			<ul style="margin-right:1%;margin-left:0%" class="nav">
				<li>
					<!-- <b><h2 id="logo">PATIKANA<img src="images/maginf.png" width="30" height="30"/></h2>
						<i style="padding-top:-4%;">find you lost documents</i>
					</b>
					 -->
				</li>
				
			</ul>
			
			<ul class="nav">
				<li class="active">
					<a href="index.php"> <img src="icons/home-icon_32x32px.png" width="20" height="20">&nbsp;Home </a>
				</li>
				<li>
					<a href="howitworks.php"><img class="ico" src='icons/settings-02-icon_32x32px.png' width="20" height="20"/>&nbsp;How it works</a>
				</li>
				<!-- <li style="color: #000 !important;">
					<a href="#"><img class="ico" src='images/found.png' width="20" height="20"/>&nbsp;I Found something</a>
				</li> -->
				<!-- <li>
					<a href="#" id="lostsomething" class="announcelostdialog"><img src="images/lost.png" width="20" height="20">I lost Something</a>
				</li> -->
			</ul>
			<ul class="nav pull-right" style="margin-right:1%;">
				<li class="divider-vertical"/>
				<?php
				if (isset($_SESSION['user_allow'])) {
					echo '
<li>
<a class="dropdown-toggle">Welcome&nbsp;' . $user . ' &nbsp;&nbsp;Account <b class="caret"></b></a>
<ul class="dropdown-menu">
<li>

<a href="javascript:" id="logoutlink"><img src="images/control_power_blue.png">&nbsp;&nbsp;&nbsp;Logout</a>
</li>
<li>
<a href="account.php" title="Change settings" id="changesettings"><img src="images/bullet_user.png" class="ico" style="margin-left:-12%"/>&nbsp;&nbsp;My Account</a>
</li>
</ul>
</li>
';
				}else{
					echo '
						<li><a href="#" id="login_user">Login</a>
					';
				}
				?>
			</ul>
		</div>
</div>
