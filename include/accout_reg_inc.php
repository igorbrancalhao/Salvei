<?php 
/***************************************************************************
 *File Name				:account_reg_inc.php
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
<?php 
session_start();
require 'include/connect.php';
/*
 file name:account_reg.php;
 date	  :4.7.05
 Created by:priya
 Rights reserved by AJ Square inc
*/
$step=$_POST[step];
$user_id=$_REQUEST[user_id];
if($step==2)
{ 
  $user_id=$_POST[user_id];
  $username=$_POST[txtusername];
  $pass=$_POST[txtpass];
  $repass=$_POST[txtrepass];
  if(empty($username))
  {
   $err_user_sql="select * from error_message where err_id=16";
   $err_user_res=mysql_query($err_user_sql);
   $err_user_row=mysql_fetch_array($err_user_res);
   $err_user=$err_user_row[err_msg];
  $err_flag=1;
  }
  else
  {
  $sql="select * from user_registration where user_name='$username'";
  $res=mysql_query($sql);
  $chk=mysql_num_rows($res);
  if($chk!=0)
  {
   $err_user_sql="select * from error_message where err_id=17";
   $err_user_res=mysql_query($err_user_sql);
   $err_user_row=mysql_fetch_array($err_user_res);
   $err_user=$err_user_row[err_msg];
//   $err_user="Already Exist";
  $err_flag=1;
  }
  }
  if(empty($pass))
  {
   $err_pass_sql="select * from error_message where err_id=23";
   $err_pass_res=mysql_query($err_pass_sql);
   $err_pass_row=mysql_fetch_array($err_pass_res);
   $err_pass=$err_pass_row[err_msg];
   $err_flag=1;
  }
  else
  {
  if(strlen($pass)<6)
  {
   $err_pass_sql="select * from error_message where err_id=19";
   $err_pass_res=mysql_query($err_pass_sql);
   $err_pass_row=mysql_fetch_array($err_pass_res);
   $err_pass=$err_pass_row[err_msg];
   $err_flag=1;
  }
  }
  if(empty($repass))
  {
   $err_repass_sql="select * from error_message where err_id=22";
   $err_repass_res=mysql_query($err_repass_sql);
   $err_repass_row=mysql_fetch_array($err_repass_res);
   $err_repass=$err_repass_row[err_msg];
   $err_flag=1;
  }
  else
  {
  if(strlen($repass)<6 )
  {
   $err_repass_sql="select * from error_message where err_id=19";
   $err_repass_res=mysql_query($err_repass_sql);
   $err_repass_row=mysql_fetch_array($err_repass_res);
   $err_repass=$err_repass_row[err_msg];
   $err_flag=1;
  }
}

if(!empty($repass) && !empty($repass))
{
if($pass!=$repass)
{
 $err_passcomp="Your password entries must match. Please check both.";
 $err_flag=1;
}
}

  
    if($err_flag!=1)
  {
   	$secret=md5($username); 
    $veri_code=substr($secret,0,6);
 	$ses_sql="select * from user_registration where user_id='$user_id'";
	$ses_res=mysql_query($ses_sql);
	$ses_row=mysql_fetch_array($ses_res);
	 $_SESSION[user_id]=$user_id;
	 $_SESSION[accout]=$ses_row[original_account];
	if($ses_row[original_account]==2)
	{
	 $admin_sql="select * from admin_setings where set_id=34";
	 $admin_res=mysql_query($admin_sql);
	 $admin_row=mysql_fetch_array($admin_res);
     $member_fee=$admin_row[set_value];
	 }
	else if($ses_row[original_account]==3)
	{
     $admin_sql="select * from admin_settings where set_id=33";
	 $admin_res=mysql_query($admin_sql);
	 $admin_row=mysql_fetch_array($admin_res);
	 $member_fee=$admin_row[set_value];
	 }
	 $_SESSION[amount]=$member_fee;
	 $_SESSION[p1]=$repass;
	$repass1=crypt($repass);
	
   $sql="update user_registration set user_name='$username',password='$repass1',veri_code='$veri_code',intro_id='$_SESSION[introid]' where user_id=$user_id";
   $res=mysql_query($sql);
   if(empty($res))
   {
   $del_sql="delete from user_registration where user_id=$user_id";
   mysql_query($del_sql);
   }
   $user_sql="select * from user_registration where user_id='$user_id'";
   $user_res=mysql_query($user_sql);
   $user_rec=mysql_fetch_array($user_res);
      if($user_rec[original_account]==2 or $user_rec[original_account]==3)
     {
     echo '<meta http-equiv="refresh" content="0;url=payment.php">';
     echo "You have been Re-Directed,if not please <a href=payment_reg.php>Click here</a>";
     exit(); 
	 }
	 else
	 {
	 //echo '<meta http-equiv="refresh" content="0;url=verification_reg.php?user_id='.$user_id.'">';
     echo '<meta http-equiv="refresh" content="0;url=verification_reg.php?user_id='.$user_id.'">';
     echo "You have been Re-Directed, if not please <a href=verification_reg?user_id=$user_id>Click here</a>";
     exit(); 
	 }
   }
} 
?>