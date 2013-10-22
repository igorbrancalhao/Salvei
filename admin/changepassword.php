<?php
/***************************************************************************
 *File Name				:changepassword.php
 *File Created				:Wednesday, June 21, 2006
 * File Last Modified			:Wednesday, June 21, 2006
 * Copyright				:(C) 2001 AJ Square Inc
 * Email				:licence@ajsquare.net
 * Software Language			:PHP
 * Version Created			:V 4.3.2
 * Programmers worked	        	:S.Priya, B.ReenaKumari, K.Shanmuga priya,A.G. Sridevi Lakshmi
 * $Id                                  : memberlist.php,v 1.36.2.12 2006/02/07 20:42:51 grahamje Exp $
 *
 ***************************************************************************/
 

/****************************************************************************
 
*      Licence Agreement: 
 
*     This program is a Commercial licensed software; 
*     you are not authorized to redistribute it and/or modify/and or sell it under any publication 
*     or license /or term it under the GNU General Public License as published by the Free Software Foundation;
*     either user and developer versions of the License, or (at your option) 
*     any later version is applicable for the same.
 
*****************************************************************************/
 ?>
<?php
session_start();
?>

<?php
if(strlen($_SESSION["adminuser"])==0)
{
echo '<meta http-equiv="refresh" content="0; url=index.php">';
exit();
}
require 'include/connect.php';

require 'include/top.php';
if(strlen($_POST['btn_Save'])) 
{
	$opass=$_POST['txtOPass'];
	$npass=$_POST['txtNPass'];
	$rpass=$_POST['txtRPass'];
	if($opass=='') $o_flag=1;
	if($npass=='') $n_flag=1;
	if($npass!=$rpass) $r_flag=1;
	if($o_flag!=1 && $n_flag!=1 && $r_flag!=1) {
	$npass=crypt($npass);
	$select="select * from admin where admin_id=1";
	$selectqry=mysql_query($select);
	$fetch=mysql_fetch_array($selectqry);
	$password=$fetch['password'];
		$opass=crypt($opass,$password);
		$chk_sql="select * from admin where password='$opass' and admin_id=1";
		$chk_res=mysql_query($chk_sql);
		if(mysql_num_rows($chk_res)>0) {
			$up_sql="update admin set password='$npass' where password='$opass'";
			 $up_res=mysql_query($up_sql);
			if($up_res) $suc_flag=1;
			else $err_flag=1;
			
			$cat=$npass;
		
		}
		else {
			$wrong_pass=1;
		}
	}
}
?>


<table border="0" align="0"  width="100%" height="100" bgcolor="#cecfc8" cellpadding="0" cellspacing="0">
<tr><td>
<table border="0" align="center" cellpadding="0" cellspacing="0" width="760" bgcolor="#E8E8E8" height="100%">
<tr><td colspan="2" class="txt_users" height=24 valign="middle"><center><br />Change Password<br /><br /></center></td></tr>
<tr><td>
<table border="0" align="center" cellpadding="0" cellspacing="2" width="80%" class="border2">
<form name="frmPass" action="<?php $_SERVER['PHP_SELF']?>" method="post">

<?php
	if($suc_flag==1) {
?>
<tr bgcolor="#eeeee1">
<td colspan="2"><b>Thank You, Your Password has been Sucessfully Changed</b></td>
</tr>
<?php
	}
	if($err_flag==1) {
?>
<tr bgcolor="#eeeee1">
<td colspan="2"><font color="red">Sorry, There is a Problem in Changing your Password now, Try Again Later</td>
</tr>
<?php
	}
	if($wrong_pass==1) {
?>
<tr bgcolor="#eeeee1">
<td colspan="2"><font color="red">The Password you have Provided does not match with your Old Password</td>
</tr>
<?php
	}
	if($o_flag==1 || $n_flag==1 || $r_flag==1) {
?>
<tr bgcolor="#eeeee1">
<td colspan="2"><font color="red">Please Fill the Information denoted in Red</font></td>
</tr>
<?php
	}
?>
<tr bgcolor="#eeeee1">
<td><?php if($o_flag==1) echo '<font color=red>';?><b>Old Password</b></td>
<td><input type="password" name="txtOPass" class="text"></td>
</tr>
<tr bgcolor="#eeeee1">
<td><?php if($n_flag==1) echo '<font color=red>';?><b>New Password</b></td>
<td><input type="password" name="txtNPass" class="text"></td>
</tr>
<tr bgcolor="#eeeee1">
<td><?php if($r_flag==1) echo '<font color=red>';?><b>Confirm New Password</b></td>
<td><input type="password" name="txtRPass" class="text"></td>
</tr>
<tr bgcolor="#eeeee1"><td colspan="2" style="text-align:center"><input type="submit" name="btn_Save" value=" Change " class="button" onclick="return val();"></td></tr>
</table>
</td></tr></table>
</form>
<?php
	require 'include/footer1.php';
?>
<script language="javascript">
function val()
{
	if(frmPass.txtOPass.value=="")
	{
		alert("Please Enter the Old Password");
		frmPass.txtOPass.focus();
		return false;
	}
	if(frmPass.txtNPass.value=="")
	{
		alert("Please Enter the New Password");
		frmPass.txtNPass.focus();
		return false;
	}	
	if(frmPass.txtRPass.value=="")
	{
		alert("Please Enter the Confirm New Password");
		frmPass.txtRPass.focus();
		return false;
	}		
	if(frmPass.txtNPass.value!=frmPass.txtRPass.value)
	{
		alert("Mismatched New and Confirm Passwords");
		frmPass.txtNPass.value="";
		frmPass.txtRPass.value="";
		frmPass.txtNPass.focus();
		return false;
	}
	return true;
}
</script>