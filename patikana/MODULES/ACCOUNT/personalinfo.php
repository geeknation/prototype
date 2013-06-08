<?php
session_start();

?>
<link rel="stylesheet" type="text/css" href="bootstrap.css"/>
<script>
			$(document).ready(function() {
				$('#editpersonalinfo').click(function() {
					$("#editform").removeClass("hidden").show().scrollTop();
				});

				$("tr").attr("height", "70px");
				$("td").css("text-align", "left");
			});
			$("#savechanges").click(function() {

				var names = $("#names").val();
				var location = $("#location").val();
				var age = $("#age").val();
				var gender = $("#gender").val();

				if(names == '' || location == '' || age == '' || gender == '') {
					$("#error").addClass("error").text("no fields should be left blank");
				} else {
					$("#editform").submit();
				}
			});

		</script>
		<div class="edit_link" style="margin-top:5%; float:right;width:100%;margin-right:1%;"><a href="javascript:" id="editpersonalinfo" class="btn-success btn-large" style="float:right">Edit this information</a></div>
		<b><h2><u style="float: left">Personal information</u></h2></b>
		<p/>
		<?php
		include 'dbconn.inc.php';
		//include "ptk_functions.php";
		require_once 'api/User.php';
		$u=new User();
		$user =$_SESSION['user_allow'];
		$userid = $u->get_user_id($user);

		$query = "SELECT * FROM users where user_id='" . $userid . "'";

		$result = mysql_query($query);

		$content = '';
		$age=$u->get_user_age($userid);
		echo "<div class='info_static'><table width='500' id='infotable' align='center'>";
		while ($row = mysql_fetch_array($result)) {
			$names = $row['names'];
			$location = $row['location'];
			$gender = $row['gender'];
			$content .= <<<EOD
	<tr height="50">
	<td><b>Names<b/></td>
	<td>$names</td>
	</tr>
	<tr height="50">
	<td><b>Location:</b></td>
	<td>$location</td>
	</tr>
	<tr height="50">
	<td><b>Age</b></td>
	<td>$age</td>
	</tr>
	<tr height="50">
	<td><b>Gender</b></td>
	<td>$gender</td>
	</tr>
	
EOD;
		}
		echo $content;

		echo "<table/></div>";
	?>

<div id="updatesucess" class="alert-success"></div>
<div id="error" class="alert-error"></div>

		
		<?php

		$userid = $u->get_user_id($user);
		$displaynames = $u->get_user_names($userid);
		$displaylocation = $u->get_user_location($userid);
		$displayage = $u->get_yob($userid);
		$displaygender = $u->get_user_gender($userid);

?>
<form method="post" action="updatepersonalinfo.php" id="editform" class="hidden">
<div id="editformdiv">
<table align="center">
<tr>
<td>Names:</td>
<td>
<input type="text" name="names" id="names" value="<?php echo $displaynames; ?>"/>
</td>
</tr>
<tr>
<td>Location:</td>
<td>
<input type="location" name="location" id="location" value="<?php echo $displaylocation ?>"/>
</td>
</tr>
<tr>
<td>Year Of Birth:</td>
<td>
<input type="text" name="age" id="age" value="<?php echo $displayage ?>"/>
</td>
</tr>
<tr>
<td>Gender:</td>
<td>
choosen gender was:&nbsp;<b><?php $gender ?></b><p/> 
<select name="gender" id="gender">
<option>male </option>
<option>female</option>
</select></td>
</tr>
</table>
<input type="button" value="Save changes" class="btn-primary btn-large" id="savechanges"/>
</div>
</form>
