<?php
/***************************************************************************
 *File Name				:addnew.php
 *File Created				:Wednesday, June 21, 2006
 * File Last Modified			:Wednesday, June 21, 2006
 * Copyright				:(C) 2001 AJ Square Inc
 * Email				:licence@ajsquare.net
 * Software Language			:PHP
 * Version Created			:V 4.3.2
 * Programmers worked	        	:S.Priya, B.ReenaKumari, K.Shanmuga priya
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
<?php session_start();
require 'include/connect.php';
require 'include/top.php'; 
?>
<?php
$step=$_POST[step];
if($step==1)
{
$first=$_POST[txtfirst];
$last=$_POST[txtlast];
$address=$_POST[txtaddress];
$city=$_POST[txtcity];
$state=$_POST[cbostate];
$country=$_POST[cbocountry];
$code=$_POST[txtzipcode];
$primary=$_POST[txtprimary];
$primary1=$_POST[txtprimary1];
$primary2=$_POST[txtprimary2];
$secondary=$_POST[txtsecondary];
$secondary1=$_POST[txtsecondary1];
$email=$_POST[txtemail];
$reemail=$_POST[txtreemail];
$username1=$_POST[txtusername];
$pass=$_POST[txtpass];
$repass=$_POST[txtrepass]; 
$member_type=$_POST[member_type];
$validEmailExpr= "^[0-9a-z~!#$%&_-]([.]?[0-9a-z~!#$%&_-])*"."@[0-9a-z~!#$%&_-]([.]?[0-9a-z~!#$%&_-])*$";
if(empty($username1))
  {
  $err_user="Please enter this information";
  $err_flag=1;
  }
  else
  {
  $sql="select * from user_registration where user_name='$username1'";
  $res=mysql_query($sql);
  $chk=mysql_num_rows($res);
  if($chk!=0)
  {
  $err_user="Already Exist";
  $err_flag=1;
  }
  }
  
  if(empty($pass))
  {
  $err_pass="Please enter this information";
    $err_flag=1;
  }
  else
  {
  if(strlen($pass)<6)
  {
      $err_pass="Please Choose 6 characters";
	      $err_flag=1;
  }
  }
  if(empty($repass))
  {
  $err_repass="Please enter this information";
    $err_flag=1;
  }
  else
  {
  if(strlen($repass)<6 )
  {
      $err_repass="Please Choose password with minimum 6 characters";
	      $err_flag=1;
	    }
		
			
		}
		if(!empty($pass) and !empty($repass))
		{
			if($pass!=$repass)
			{
				$err_repass="Password and Retype password must be same";
				$err_flag=1;
			}
		}

 

  if(empty($first))
  {
  $err_first="Please enter this information";
  $err_flag=1;
  }
  if(is_numeric($first))
  {
  	$err_first="Your first name is invalid";
  $err_flag=1;
  }
  if(empty($last))
  {
  $err_last="Your last name is invalid";
    $err_flag=1;
  }
  if(is_numeric($last))
  {
  	$err_last="Please enter this information";
  $err_flag=1;
  }
  if(empty($address))
  {
  $err_add="Please enter this information";
    $err_flag=1;
  }
    if(empty($city))
	{
	  $err_city="Please enter this information";
	    $err_flag=1;
	  }
 if(empty($state))
 {
   $err_state="Please enter this information";
     $err_flag=1;
   }
 if(empty($country))
 {
  $err_country="Please enter this information";
    $err_flag=1;
 }
 if(empty($code))
 {
   $err_code="Please enter this information";
     $err_flag=1;
 }
 if( strlen($code)>6 )
 {
  $err_code="Your Zipcode is invalid";
    $err_flag=1;
 }
   if(empty($primary))
   {
     $err_primary="Please enter this information";
	   $err_flag=1;
   }
   if(!is_numeric($primary))
   {
    $err_primary="Your Primary Phoneno is invalid";
    $err_flag=1;
	}
	if(empty($primary1))
   {
     $err_primary="Please enter this information";
	   $err_flag=1;
   }
   if(!is_numeric($primary1))
   {
    $err_primary="Your Primary Phoneno is invalid";
    $err_flag=1;
	}
	if(empty($primary2))
   {
     $err_primary="Please enter this information";
	   $err_flag=1;
   }
   if(!is_numeric($primary2))
   {
    $err_primary="Your Primary Phoneno is invalid";
    $err_flag=1;
	}
   if(empty($secondary))
   {
    $err_secondary="Please enter this information";
    $err_flag=1;
	}
    if(!is_numeric($secondary))
	{
      $err_secondary="Your Secondary Phoneno is invalid";
	  $err_flag=1;
	  }
	  if(empty($secondary1))
   {
    $err_secondary="Please enter this information";
    $err_flag=1;
	}
    if(!is_numeric($secondary1))
	{
      $err_secondary="Your Secondary Phoneno is invalid";
	  $err_flag=1;
	  }
   if(empty($email))
   {
    $err_email="Please enter this information";
    $err_flag=1;
	}
  else
   {
    if(!eregi($validEmailExpr,$email))
	{
	 $err_email="Your Email address id invalid ";
	 $err_flag=1;
	}
	}
   if(empty($reemail))
   {
  $err_reemail="Please enter this information";
    $err_flag=1;
	}
  else
  {
    if(!eregi($validEmailExpr,$reemail))
	{
	 $err_reemail="Your Email address id invalid ";
	 $err_flag=1;
	}
	}
   
   if(empty($err_email) && empty($err_reemail))
	{
	if($email!=$reemail)
	{
	   $err_email="Your email entries must match. Please check both.";
	   $err_remail="Your email entries must match. Please check both.";
	   $err_flag=1;
	}
	}
     
   if($err_flag!=1)
  {
  	$home_phone=$primary."-".$primary1."-".$primary2;
	$work_phone=$secondary."-".$secondary1;
  $date_of_registration=date('Y-m-d');
   $sql="insert into user_registration(user_name,member_account,password,email,first_name,last_name,address,city,state,pin_code,country,home_phone,work_phone,status,date_of_registration)";
    $sql.= "values('$username1','$member_type','$pass','$reemail','$first','$last','$address','$city','$state','$code','$country','$home_phone','$work_phone','Active','$date_of_registration')";
   $res=mysql_query($sql);
   if($res)
   {
   $user_id=mysql_insert_id();
   echo '<meta http-equiv="refresh" content="0;url=user.php">';
   }
   } 
} //step==1
 
$state_sql="select * from state_master where country_id=38 ";
$state_res=mysql_query($state_sql);
$country_sql="select * from country_master";
$country_res=mysql_query($country_sql);
?>
<form name=reg action="addnew.php" method=post>
<html>
<head>
<title>Registration:enter information</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="style/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<table border="0" align="center" cellpadding="0" cellspacing="0" width="100%" background="images/bg08.jpg">
<tr>
<td style="padding-left:10px">
<table border="0" cellpadding="0" cellspacing="0" width="80%>
<tr><td width="93" style="padding-left:120px">
	<table id="Table_01" width="93"  border="0" cellpadding="0" cellspacing="0">
                  <tr>
                      <td><img src="images/index_02_03_03_01.jpg" width="93" height="26" alt=""></td>
                    </tr>
                    <tr>
 <td><a href="user.php"><img src="images/index_02_03_03_02.jpg" width="93" height="70" alt="" border="0" title="UserManagement"></a></td>
                    </tr>
                    <tr>
                      <td><a href="site.php"><img src="images/index_02_03_03_03.jpg" width="93" height="71" alt="" border="0" title="GeneralSettings"></a></td>
                    </tr>
                    <tr>
  <td><a href="site.php?page=style"><img src="images/index_02_03_03_04.jpg" width="93" height="73" alt="" border="0" title="StyleSettings"></a></td>
                    </tr>
                <tr>
  <td><a href="report.php?page=out"><img src="images/index_02_03_03_05.jpg" width="93" height="71" alt="" border="0" title="DetailReport"></a></td>
                    </tr>
                    <tr>
  <td><a href="store_manager.php"><img src="images/index_02_03_03_06.jpg" width="93" height="70" alt="" border="0" title="StoreManager"></a></td>
                    </tr>
                    <tr>
                      <td><a href="bulk_load.php"><img src="images/index_02_03_03_07.jpg" width="93" height="66" alt="" border="0" title="BulkLoader"></a></td>
                    </tr>
                </table></td>
</td>
<td>
<table border="0" width="96%" align="center" class="tablebox">

<tr height=40 bgcolor="#CCCCCC">
  <td class="style1" colspan="2" style="color:#000000; text-align:center"><b>Add New User</b> </td></tr> 


 
 <tr bgcolor="eeeee1"><td>
 <?php if(!empty($err_first))
 {?>
 <img src="../images/warning_9x10.gif">&nbsp;<font color=red face=verdana><?php= $err_first ?></font>
 <br>
 <b><font color=red face=verdana>First name</font></b>
 <?php
  }
  else
  {
 ?>
   <b><font >First name</font></b>
   <?php }
   ?>
 </td>
   <td ><input type="text" name="txtfirst" style="width:250 " class="txtmed" maxlength="25" value="<?php= $first; ?>"></td>
 <tr bgcolor="eeeee1">
 <td>
 <?php if(!empty($err_last))
 {?>
 <img src="../images/warning_9x10.gif">&nbsp;<font color=red face=verdana><?php= $err_last ?></font>
 <br>
 <b><font color=red face=verdana>Last name</font></b>
 <?php
  }
  else
  {
 ?>
 <b><font>Last name</font></b>
   <?php }
   ?>
   </td> <td><input type="text" name="txtlast" style="width:250px" class="txtmed" maxlength="25" value=<?php= $last; ?>></td></tr>
    <tr bgcolor="eeeee1"><td width=293>
 <?php if(!empty($err_user))
 {?>
 <img src="../images/warning_9x10.gif">&nbsp;<font color=red face=verdana><?php= $err_user ?></font>
 <br>
 <b><font color=red face=verdana>User name</font></b>
 <?php
  }
  else
  {
 ?>
   <b><font >User name</font></b>
   <?php }
   ?>
 </td><td width=302><input type="text" name="txtusername" maxlength="20" style="width:250 " class="txtmed" value=<?php= $username1; ?>></td></tr>
  <tr bgcolor="eeeee1">
 <td>
 <?php if(!empty($err_pass))
 {?>
 <img src="../images/warning_9x10.gif">&nbsp;<font color=red face=verdana><?php= $err_pass ?></font>
 <br>
 <b><font color=red face=verdana>Password</font></b>
 <?php
  }
  else
  {
 ?>
 <b><font>Password</font></b>
   <?php }
   ?>
   </td>
 <td width=302>
        <input type="password" name="txtpass" style="width:250 " maxlength="20" class="txtmed" value=<?php= $pass; ?>>
      <br>Minimum 6 Character long.</td></tr>
 
 
 <tr bgcolor="eeeee1"><td > 
 <?php if(!empty($err_repass))
 {
 ?>
 <img src="../images/warning_9x10.gif">&nbsp;<font color=red face=verdana><?php= $err_repass ?></font>
 <br>
 <b><font color=red face=verdana>Re-enter Password</font></b>
 <?php
  }
  else
  {
 ?>
 <b><font>Re-enter Password</font></b>
   <?php 
   }
   ?></td>
 <td ><input type="password" name="txtrepass" style="width:250 " maxlength="20" class="txtmed" value=<?php= $repass; ?>></td></tr>
 <tr bgcolor="eeeee1">
 <td >
 <?php if(!empty($err_email))
 {
 ?>
 <img src="../images/warning_9x10.gif">&nbsp;<font color=red face=verdana><?php= $err_email ; ?></font>
 <br>
 <b><font color=red face=verdana>Email Address</font></b>
 <?php
  }
  else
  {
 ?>
   <b><font>Email Address</font></b>
   <?php
   }
   ?>
 </td>

 <td width=302><input type="text" name="txtemail" style="width:250 " maxlength="50" class="txtbig" value=<?php= $email; ?>></td>
 </tr>
 <tr bgcolor="eeeee1"><td>
   <?php if(!empty($err_reemail))
 {?>
 <img src="../images/warning_9x10.gif">&nbsp;<font color=red face=verdana><?php= $err_reemail ; ?></font>
 <br>
 <b><font color=red face=verdana>Re-enter Email</font></b>
 <?php
  }
  else
  {
 ?>
   <b><font>Re-enter Email</font></b>
   <?php
   }
   ?>
  </td><td width=302><input type="text" name="txtreemail" style="width:250 " maxlength="50" class="txtbig" value=<?php= $reemail; ?>>
 <br>
    </td>
 </tr>
 <tr bgcolor="eeeee1"><td>
 <?php if(!empty($err_primary))
 {?>
 <img src="../images/warning_9x10.gif">&nbsp;<font color=red face=verdana><?php= $err_primary ?></font>
 <br>
 <b><font color=red face=verdana>Primary telephone</font></b>
 <?php
  }
  else
  {
 ?>
   <b><font>Primary telephone</font></b>
   <?php
   }
   ?></td><td>
 <input type="text" name="txtprimary" class="txtmed" maxlength="3" size="7" value="<?php= $primary; ?>" >-<input type="text" name="txtprimary1" class="txtmed" maxlength="5" size="7" value="<?php= $primary1; ?>" >-<input type="text" name="txtprimary2" class="txtmed"  maxlength="10" size="13" value="<?php= $primary2; ?>"></td></tr>
 <tr bgcolor="eeeee1">
   <td>
   <?php if(!empty($err_secondary))
 {?>
 <img src="../images/warning_9x10.gif">&nbsp;<font color=red face=verdana><?php= $err_secondary ; ?></font>
 <br>
 <b><font color=red face=verdana>Secondary telephone</font></b>
 <?php
  }
  else
  {
 ?>
   <b><font>Secondary telephone</font></b>
   <?php
   }
   ?></td>
 
 <td width="302"><input type="text" name="txtsecondary" class="txtmed" size="7" maxlength="4" value=<?php= $secondary; ?>>-<input type="text" name="txtsecondary1" class="txtmed" maxlength="10" size="25" value=<?php= $secondary1; ?>></td></tr>
  
 

  
 <tr bgcolor="eeeee1"><td>
 <?php if(!empty($err_add))
 {
 ?>
 <img src="../images/warning_9x10.gif">&nbsp;<font color=red face=verdana><?php= $err_add ?></font>
 <br>
 <b><font color=red face=verdana>Street Address</font></b>
 <?php
  }
  else
  {
 ?>
 <b><font>Street Address</font></b>
   <?php 
   }
   ?></td><td ><input type="text" name="txtaddress" style="width:250 " maxlength="200" class="txtbig" value=<?php= $address; ?>></td> </tr>
 
 <tr bgcolor="eeeee1"><td >
 <?php if(!empty($err_city))
 {
 ?>
 <img src="../images/warning_9x10.gif">&nbsp;<font color=red face=verdana><?php= $err_city ?></font>
 <br>
 <b><font color=red face=verdana>City</font></b>
 <?php
  }
  else
  {
 ?>
 <b><font>City</font></b></td>
 <?php } ?>
 <td ><input type="text" name="txtcity" class="txtbig" style="width:250 " maxlength="25" value=<?php= $city; ?>></td></tr>
 <tr bgcolor="eeeee1"><td>
 <?php if(!empty($err_state))
 {?>
 <img src="../images/warning_9x10.gif">&nbsp;<font color=red face=verdana><?php= $err_state ?></font>
 <br>
 <b><font color=red face=verdana>State</font></b>
 <?php
  }
  else
  {
 ?>
   <b><font>State</font></b>
   <?php
   }
   ?> 
   </td>
   <td>
   <input type="text" name="cbostate" class="txtbig" style="width:250 " maxlength="25" value=<?php= $state; ?> >
   </td>
   </tr>
   <tr bgcolor="eeeee1">
   <td>
   <?php if(!empty($err_code))
 {?>
 <img src="../images/warning_9x10.gif">&nbsp;<font color=red face=verdana><?php= $err_code ?></font>
 <br>
 <b><font color=red face=verdana>Zip\Postal Code</font></b>
 <?php
  }
  else
  {
 ?>
   <b><font>Zip\Postal Code</font></b>
   <?php
   }
   ?>
</td><td><input type="text" name="txtzipcode" style="width:250 " maxlength="15" class="txtsmall" value=<?php= $code; ?>></td></tr>

<tr bgcolor="eeeee1">
<td width="293">
 <?php if(!empty($err_country))
 {
 ?>
 <img src="../images/warning_9x10.gif">&nbsp;<font color=red face=verdana><?php= $err_country ?></font>
 <br>
 <b><font color=red face=verdana>Country</font></b>
 <?php
  }
  else
  {
 ?>
   <b><font>Country</font></b>
   <?php
   }
   ?>
</td><td><select name=cbocountry  style="width:250 ">
<option value="0" >Select</option>
  <?php while($country_row=mysql_fetch_array($country_res))
  { 
   if(trim($country_row['country_id'])==trim($country))
  {
   ?>
     <option value="<?php= $country_row['country_id'] ?>" selected><?php= $country_row['country']?></option>
  <?php
  }
  else
  {
  ?>
     <option value="<?php= $country_row['country_id'] ?>"><?php= $country_row['country']?></option>
  <?php
  }
  }
  ?>
  
   
  </select></td> </tr>
 
 
 
 
 

  
 <input type="hidden" name=step value=2>
 <input type="hidden" name=user_id value="<?php= $user_id;?>">
 
 <input type="hidden" name=step value=1>
 <tr bgcolor="#eeeee1"><td colspan="6" style="text-align:center"><input type="submit" value="Register" name=submit class="button"></td></tr>
 </form>
</table>
</td></tr></table>
</td></tr>
</table>
<?php require'include/footer.php'; ?>   
</body>
</html>
