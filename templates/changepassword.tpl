<?php
/***************************************************************************
 *File Name				:changepassword.tpl
 *File Created			:Wednesday, June 21, 2006
 * File Last Modified	:Wednesday, June 21, 2006
 * Copyright			:(C) 2001 AJ Square Inc
 * Email				:licence@ajsquare.net
 * Software Language	:PHP
 * Version Created		:V 4.3.2
 * Programmers worked	:S.Priya, B.ReenaKumari, K.Shanmuga priya
 * Modified By			:B.Reena
 * $Id                  : memberlist.php,v 1.36.2.12 2006/02/07 20:42:51 grahamje Exp $
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
<table width=958 align="center" cellpadding="0" cellspacing="0" >
<tr><td background="images/contentbg1.jpg" colspan=2 height="25"><font class="detail3txt"><div align="left">&nbsp;&nbsp;Personal Information:: Change Password 
&nbsp;&nbsp;</div></b></font></td>
</tr> 
<tr><td>
<table width=958 align="center" cellpadding="5" cellspacing="0"  background="images/contentgrad.jpg" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom">
 <tr>
<?
$mode=$_POST['mode'];
if($mode==cansave)
{
$username=$_SESSION[username];
$password=$_POST["txtPassword"];
$npassword=$_POST["txtPasswordNew"];
$confirmpassword=$_POST['txtConfirmPassword'];

if($password=='')
{

$select_sql="select * from error_message where err_id =49";
$select_tab=mysql_query($select_sql);
$select_row=mysql_fetch_array($select_tab);
$err = $select_row[err_msg];

//$err="please Enter your Old Password";
}
if($npassword=='')
{
$select_sql="select * from error_message where err_id =50";
$select_tab=mysql_query($select_sql);
$select_row=mysql_fetch_array($select_tab);
$err = $select_row[err_msg];

//$err="Please Enter New Password";
}
if ($npassword!=$confirmpassword)
{
$select_sql="select * from error_message where err_id =51";
$select_tab=mysql_query($select_sql);
$select_row=mysql_fetch_array($select_tab);
$err = $select_row[err_msg];

//$err="Confirm Password does not match with New Password.Please Re-enter";
}

          
if($err) {
echo "<td  valign=top colspan=2 align=center class=errormsg><br>"; 
echo "<center><font color=red>".$err."</font><br><br></td></tr>";
}

else
{

$sql="select * from user_registration where user_name='$username'";
$result=mysql_query($sql);
if(mysql_num_rows($result)>0) {
$row=mysql_fetch_array($result);
$fetchpass=$row['password'];
$passwordold=crypt($password,$fetchpass);
$newpass=crypt($npassword);
//if($row['password']==$passwordold) {
$chk_sql="select * from user_registration where password='$passwordold' and user_name='$username'";
		$chk_res=mysql_query($chk_sql);
		if(mysql_num_rows($chk_res)>0) {

$sq="update user_registration set user_name='".$username."',password='".$newpass."' where user_name='$username'";
$re=mysql_query($sq);
}

else {
$select_sql="select * from error_message where err_id =52";
$select_tab=mysql_query($select_sql);
$select_row=mysql_fetch_array($select_tab);
$err = $select_row[err_msg];

//$err="Invalid Password";
}
}
else {
$select_sql="select * from error_message where err_id =53";
$select_tab=mysql_query($select_sql);
$select_row=mysql_fetch_array($select_tab);
$err = $select_row[err_msg];

//$err="Invalid Username";
}
?>
<?
echo "<td  valign=top colspan=2 align=center><br>";

if($err) {
echo "<center><font color=red class=errormsg>".$err."</font><br><br>";
}
else {
echo "<center><font color=red class=errormsg>Your Password has been Successfully Changed.</font><br><br>";
}
echo "</td></tr>";


}
}
?>
            <?
$sql="select user_name,password from user_registration where user_name='$username'";
$res=mysql_query($sql);
$row=mysql_fetch_array($res);
?>
    <tr><td>         
      <table align="center" border="0" cellpadding="5" cellspacing="2" width="75%" >
        <form name=form1 method=post action=changepassword.php >
                
                 <tr>
                  <td align="right" class="detail9txt">Old Password</td>
                  <td><input type=password name=txtPassword class="txtmid"></td></tr>
				<tr>
                  <td align="right" class="detail9txt">New Password</td>
                  <td><input type=password name=txtPasswordNew class="txtmid"></td></tr>
                <tr>
                  <td align="right" class="detail9txt">ConfirmPassword</td>
                  <td><input type=password name=txtConfirmPassword class="txtmid"></td></tr>
                <tr>
                  <td>
                  <td>
				  <input type="image" src="images/change.gif" name="Image79" width="62" height="22" border="0" id="Image79" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image79','','images/changeo.gif',1)" value="Change"/></tr>
               	<input type="hidden" name="mode" value="cansave">
              </form>
            </table>
      	</td></tr>
		

	</table></td></tr>
	</table>
	</td></tr>
	</table>




