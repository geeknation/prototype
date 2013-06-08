<?php
session_start();
require_once("api/User.php");
$u=new User();
?>
<script type="text/javascript">
	$(document).ready(function() {
		$("input[type=text]").css('border', 'solid thin #00FF99;');

		$("#savechanges").click(function() {
			var prefusername = $("#prefusername").val();
			var passone = $("#prefpass").val();
			var passtwo = $("#prefpass1").val();
			
			if(prefusername == '') {
				$('#error').addClass("alert alert-error").html("please enter a username");
			} else if(passone == '' || passtwo == '') {
				$('#error').addClass("error").html("please enter a password and confirm the password");
			} else if(passone != passtwo) {
				$('#error').addClass("error").html("please ensure the passwords are matching");
			} 
			else {

				$.post('updateinfo.php', {
					prefusername : prefusername,
					pass : passone
				}, function(data) {

					if( data = "updatesucessful") {

						if($("#error").is(":visible")) {
							$("#error").hide();
							$("#updatesucess").addClass("alert alert-success").text("changes made sucesfully");
						} else {
							$("#updatesucess").addClass("alert alert-success").text("changes made sucesfully");
						}

					}
				});
			}
		});
	});

</script>
		<?php
		$user = $_SESSION['user_allow'];
		$uid = $u->get_user_id($user);
		
		$query = "SELECT username FROM login WHERE user_id='" . $uid . "'";

		$result = mysql_query($query);

		$content = '';
		while ($row = mysql_fetch_array($result)) {
			$username = $row['username'];

			$content .= <<<EOD
<div class='info_static'>
<div id="error"></div>
<div id="updatesucess"></div>
<table align="center" height="300">
<tr>
<td><b>Username:</b></td>
<td>$username</td>
</tr>

<tr>
<form method='post'>
<td><b>change your account information:</b></td>
<tr>
<td>type to change your username:</td>
<td><input type="text" name="prefusername" id="prefusername" placeholder="$user"/></td>
</tr>
<tr>
<td>type to change your password:</td>
<td><input type="password" name="prefpass" id="prefpass"/></td>
</tr>
<tr>
<td>confirm password</td>
<td><input type="password" name="prefpass1" id="prefpass1"/></td>
</tr>
<td><input type="button" value="Save changes" class="btn btn-success btn-large" id="savechanges"/></td>
</form>
</tr>
</table>
</div>
EOD;
	}

		echo $content;
		?>