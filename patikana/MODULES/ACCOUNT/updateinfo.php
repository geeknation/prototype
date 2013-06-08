<?php
session_start();
include 'dbconn.inc.php';
include 'ptk_functions.php';

$username=htmlentities(htmlspecialchars(mysql_real_escape_string(addslashes($_POST['prefusername']))));
$pass=htmlentities(htmlspecialchars(mysql_real_escape_string(addslashes($_POST['pass']))));

$user=$_SESSION['user_allow'];
$u=new User();
$uid=$u->get_user_id($user);

$query="UPDATE login SET username='".$username."',password='".md5($pass)."' WHERE user_id='".$uid."'";

$result=mysql_query($query);

$_SESSION['user_allow']=$username;

if($result)
{
	header("Location: account.php?flag=update_sucess");
}
else{
	header("Location: account.php?flag=updatefail");
}
?>