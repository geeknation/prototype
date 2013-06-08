<?php
//login.php
session_start();
include 'dbconn.inc.php';
$user = mysql_real_escape_string(addslashes($_POST['username']));
$pass = mysql_real_escape_string(addslashes($_POST['password']));
$rememberme = 0;//$_POST['rememberme'];
$query = "SELECT username, password FROM login WHERE username='" . $user . "' AND password='" . md5($pass) . "'";
$result = mysql_query($query);
$rows = mysql_num_rows($result);
$row = mysql_fetch_array($result);
$auth = 0;
if ($rows > 0) {
	if (strcmp(md5($pass), $row['password']) == 0 and strcmp($user, $row['username']) == 0) {
		$auth = 1;
		//set the session and accept user AND REDIRECT BACK TO THE SEARCH PAGE
		if ($rememberme == 1 || $rememberme == TRUE) {
			setcookie("username", $user, time() + 20000000);
			$_SESSION['user_allow'] = $user;
			$time = time() + 60 * 60 * 24 * 365;
			echo 'yes';
		} else {
			$_SESSION['user_allow'] = $user;
			$time = time() + 60 * 60 * 24 * 365;
			echo 'yes';
		}
	} else {
		echo "no";
	}
} else {
	$auth = 0;
	echo 'no';
}
if (isset($_GET['user']) and isset($_GET['c'])) {
	$user = $_GET['user'];	//fetch the auth number
	$username = $_GET['c'];	//fetch the cookie
	if ((int)$user == 1) {
		$_SESSION['user_allow'] = $c;
		header("location: Home.php");
	}
}?>