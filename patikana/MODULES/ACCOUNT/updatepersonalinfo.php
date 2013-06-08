<?php
session_start();
include 'dbconn.inc.php';
include 'api/User.php';
$names=$_POST['names'];
$age=$_POST['yob'];
$location=$_POST['location'];
$gender=$_POST['gender'];

$user=$_SESSION['user_allow'];
$u=new User();
$uid=$u->get_user_id($user);
$query="UPDATE users SET names='".$names."',yob='".$age."',location='".$location."',gender='".$gender."' WHERE user_id='".$uid."'  ";
$result=mysql_query($query);
if($result)
{
	header("Location: account.php?flag=update_sucess");
}
else{
	header("Location: account.php?flag=updatefail");
}
mysql_close();
?>