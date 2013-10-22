<?php require 'include/connect.php'; 
$sel=mysql_query("select * from user_registration where user_name='testuser'");
$s=mysql_fetch_array($sel);
{
	echo $s['user_name']."-".$s['password'];
	echo '<br>';
}
?>