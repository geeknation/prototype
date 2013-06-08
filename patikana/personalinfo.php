<?php
session_start();
?>
<link rel="stylesheet" type="text/css" href="bootstrap.css"/>
<script type="text/javascript" src="jquery_ptk/jquery.js"></script>
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
		var year=$("#year").is(":selected");
		var month=$("#year").is(":selected");
		var day=$("#year").is(":selected");
		
		
		var yob = day+"/"+month+"/"+year;
		var gender = $("#gender").val();

		if(names == '' || location == '' || age == '' || gender == '') {
			$("#error").addClass("error").text("no fields should be left blank");
		} else {
			$("#editform").submit();
		}
	});

</script>
<div class="edit_link" style="margin-top:0%; float:right;width:95%;margin-right:1%;">
	<b><h3><u style="float: left">Personal information</u></h3></b>
</div>
<p/>
<?php
include 'dbconn.inc.php';
//include "ptk_functions.php";
require_once 'api/User.php';
$u = new User();
$user = $_SESSION['user_allow'];
$userid = $u -> get_user_id($user);

$query = "SELECT * FROM users where user_id='" . $userid . "'";

$result = mysql_query($query);

$content = '';
$age = $u -> get_user_age($userid);
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

$userid = $u -> get_user_id($user);
$displaynames = $u -> get_user_names($userid);
$displaylocation = $u -> get_user_location($userid);
$displayage = $u -> get_yob($userid);
$displaygender = $u -> get_user_gender($userid);
?>
<ul class="nav nav-list">
	<li class="divider"></li>
</ul>
<div class="hero">
	<h4>Edit Personal Information</h4>
</div>
<form method="post" action="updatepersonalinfo.php" id="editform" class="hidden">
	<div id="editformdiv">
		<table align="center">
			<tr>
				<td>Names:</td>
				<td>
				<input type="text" name="names" id="names" value="<?php echo $displaynames;?>"/>
				</td>
			</tr>
			<tr>
				<td>Location:</td>
				<td>
				<input type="text" name="location" id="location" value="<?php echo $displaylocation ?>"/>
				</td>
			</tr>
			<tr>
				<td class="fieldtitle">Year of birth:</td>
				<td>
				<select id="day" name="day" size="1" style="width:50px">
					<?php
					for ($i = 1; $i <= 31; $i++) {
						echo "<option>" . $i . "</option>";
					}
					?>
				</select> &nbsp;&nbsp;
				<select id="month" name="month" size="1" style="width:70px">
					<?php
					$months = array("Jan", "Feb", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
					for ($i = 0; $i < count($months); $i++) {
						echo "<option>" . $months[$i] . "</option>";
					}
					?>
				</select> &nbsp;&nbsp;
				<select id="year" name="year" size="1" style="width:70px">
					<?php
					for ($i = 1970; $i <= date("Y", time()) - 18; $i++) {
						echo "<option>" . $i . "</option>";
					}
					?>
				</select></td>
			</tr>
			<tr>
				<td>Gender:</td>
				<td> choosen gender was:&nbsp;<b><?php $gender
				?></b>
				<p/>
				<select name="gender" id="gender">
					<option>male </option>
					<option>female</option>
				</select></td>
			</tr>
		</table>
		<input type="submit" value="Save changes" class="btn btn-success btn-large" id="savechanges"/>
	</div>
</form>
