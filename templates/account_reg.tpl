<?php php
/***************************************************************************
 *File Name				:account_reg.tpl
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
 <script language="javascript">
 function sel(elementname)
{
var element_name=elementname;
if(element_name=="txtusername")
document.acount_reg.txtusername.focus();
if(element_name=="txtpass")
document.acount_reg.txtpass.focus();
if(element_name=="txtrepass")
document.acount_reg.txtrepass.focus();

}
 </script>
<table width="980" border="0" cellpadding="0" cellspacing="0" align="center">
 <tr><td valign="top">
<table border="0" align="center" cellpadding="0" cellspacing="0" width="958">
<tr width=100>
<td colspan=2 background="images/contentbg1.jpg" height="25">
<font class="detail3txt"><div align="left">
&nbsp;&nbsp;Register:Choose User Name & Password </div></font>
</td></tr>
 <tr><td valign="top">
<table border="0" align="center" cellpadding="5" cellspacing="0"  background="images/contentgrad.jpg" width="958" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom">
<tr><td colspan="2" class="detail9txtnormal">
1.&nbsp;Enter Your Personal Information&nbsp;&nbsp;<b>2.&nbsp;Choose Your Username & Password </b>
 &nbsp;&nbsp;3.&nbsp; Check Your Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class="errormsg">Fields marked with an asterisk (*) are required</font></td></tr>
 <tr><td class="table_topless_border" colspan="2"> 
 <table cellpadding="5" cellspacing="2"  width=100% > 
 <tr><td>
<?php  if($err_flag==1)
{ 
?>
<table width="100%" align="center">
<tr>
<td>
<img src="images/warning_39x35.gif"></td>
<td>
<font size=2 color="red">The following must be corrected before continuing:</font></td>
<?php  if(!empty($err_user))
 {
 ?>
<tr><td>&nbsp;</td><td class="detail9txtnormal"><a href="account_reg.php#txtusername" onclick="sel('txtusername')" class="header_text2">User Name</a> - <?php echo $err_user; ?></td></tr>
<?php  
}
?>
<?php  if(!empty($err_pass))
 {
 ?>
<tr><td>&nbsp;</td><td class="detail9txtnormal" ><a href="account_reg.php#txtpass" onclick="sel('txtpass')" class="header_text2">Password</a> - <?php echo $err_pass; ?></td></tr>
<?php  
}
?>
<?php  if(!empty($err_repass))
 {
 ?>
<tr><td>&nbsp;</td><td class="detail9txtnormal"><a href="account_reg.php#txtrepass" onclick="sel('txtrepass')" class="header_text2">Re-enter Password</a> - <?php echo $err_repass; ?></td></tr>
<?php  
}
?>
<?php  if(!empty($err_passcomp))
{
?>
<tr><td>&nbsp;</td><td class="detail9txtnormal"><a href="account_reg.php#txtrepass" onclick="sel('txtrepass')" class="header_text2">Password</a> - <?php echo $err_passcomp; ?></td></tr>
<?php  
}
?>

<tr><td colspan="2"><hr noshade class="hr_color" size="1"></td></tr>

</table>
<?php 
} 
?>
</td></tr>
   <tr><td><form action="account_reg.php" method="post" name="acount_reg">
   <table width="100%" cellpadding="2" cellspacing="2" align=center>
   <tr><td width=250 class="detail9txt">
 <?php  if(!empty($err_user))
 {?>
 <img src="images/warning_9x10.gif">&nbsp;<font color=red><?php echo $err_user ?></font>
 <br>
 <b><font size=2 color=red>User Name</font></b>
 <b><font color="#FF0000">*</font></b> 
 <?php 
  }
  else
  {
 ?>
   <b><font size=2>User Name</font></b>
   <b><font color="#FF0000">*</font></b>   
   <?php  }
   ?>
 </td>
   </tr>
 <tr><td width=250><input type="text" name="txtusername" class="txtmed" maxlength="10" value=<?php echo "$username"; ?>></td></tr>
 <tr>
 <td class="detail9txt">
 <?php  if(!empty($err_pass))
 {?>
 <img src="images/warning_9x10.gif">&nbsp;<font color=red><?php echo $err_pass ?></font>
 <br>
 <b><font size=2 color=red>Password</font></b>
 <b><font color="#FF0000">*</font></b>
 <?php 
  }
  else
  {
 ?>
 <b><font size=2>Password</font></b>
   <b><font color="#FF0000">*</font></b>
   <?php  }
   ?>   </td>
 </tr>
 <tr><td width=250 class="detail9txt">
 <input type="password" name="txtpass" class="txtmed" value=<?php echo $pass; ?>><br>
  6 character minimum.
 Enter a password that's easy for you to remember,<br> but hard for others to guess
 </td>
 </tr>
 
 <tr><td colspan="2" class="detail9txt"> 
 <?php  if(!empty($err_repass))
 {
 ?>
 <img src="images/warning_9x10.gif">&nbsp;<font color=red><?php echo $err_repass ?></font>
 <br>
 <b><font size=2 color=red>Re-enter Password</font></b>
 <b><font color="#FF0000">*</font></b>
 <?php 
  }
  else
  {
 ?>
 <b><font size=2>Re-enter Password</font></b>
   <b><font color="#FF0000">*</font></b>
   <?php  
   }
   ?></td>
 </tr>
  <tr><td colspan="2"><input type="password" name="txtrepass" class="txtmed" value=<?php echo $repass; ?>></td></tr>
  <tr><td width=100% colspan="2"><hr noshade class="hr_color" size="1"><br></td></tr>
 <input type="hidden" name=step value=2>
 <input type="hidden" name=user_id value="<?php echo $user_id;?>">
 <tr><td align="center">
 <input type="image" src="images/continue.gif" name="Image71" width="81" height="24" border="0" id="Image71" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image71','','images/continueo.gif',1)"/>
 </td></tr>
 </table>
 </form>
 </td></tr>
</table></td></tr>
</table></td></tr>
</table>
</td></tr>
</table>
 <?php  require 'include/footer.php'; ?>
 
 
 
 


 
 
 
 
 
 