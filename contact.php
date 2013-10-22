<?php
/***************************************************************************
 *File Name				:contact.php
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
session_start();
require 'include/connect.php';

$query_site="select * from admin_settings where set_id = 1";
$table_site=mysql_query($query_site);
$fetch_site=mysql_fetch_array($table_site);
$site_name = $fetch_site['set_value'];

//Fetching mail header image
$queryheader="select * from admin_settings where set_id = 61";
$tableheader=mysql_query($queryheader);
$rowheader=mysql_fetch_array($tableheader);
$mailheader = $site_name."/".$rowheader['set_value'];

//Fetching mail footer image
$queryfooter="select * from admin_settings where set_id = 62";
$tablefooter=mysql_query($queryfooter);
$rowfooter=mysql_fetch_array($tablefooter);
$mailfooter = $site_name."/".$rowfooter['set_value'];

$flag=$_POST['flagsend'];
if($flag==1)
	{
	$name=$_POST['txtName'];
	$email=$_POST['txtEmail'];
	$company=$_POST['txtCname'];
	$purpose=$_POST['cboPurpose'];
	$priority=$_POST['cboPriority'];
	$subject=$_POST['txtSubject'];
	$message=$_POST['textfield'];
	$re_user    = "^[a-z0-9\._-]+"; 
$re_delim   = "@"; 
$re_domain  = "[a-z0-9][a-z0-9_-]*(\.[a-z0-9_-]+)*"; 
$re_tld     = "\.([a-z]{2}|aero|arpa|biz|com|coop|edu|gov|info|" . "int|mil|museum|name|net|org|pro)$"; 
$validEmailExpr=$re_user.$re_delim.$re_domain.$re_tld;
if(!empty($email))
{
 if(!eregi($validEmailExpr,$email))
	{
   $err_email_sql="select * from error_message where err_id=13";
   $err_email_res=mysql_query($err_email_sql);
   $err_email_row=mysql_fetch_array($err_email_res);
   $err_email=$err_email_row[err_msg];
   $err_flag=1;
	}
	}
	if(strlen($name)==0)
	{
	$nameflag="Please enter this Information";
	$err_flag=1;
	}
	if(strlen($email)==0) 
	{
	$emailflag="Please enter this Information";
	$err_flag=1;
	}
	if(strlen($subject)==0)
	{
	$subjectflag="Please enter this Information";
	$err_flag=1;
	}
	if(strlen($message)==0)
	{
	$messageflag="Please enter this Information";
	$err_flag=1;
	}
	if($err_flag!=1)
	{
	 	
	$mailfrom=$email;
	$mailSubject=$subject;
	$admin_mail="SELECT * FROM `admin_settings` WHERE set_id=3";
	$admin_mail_row=mysql_query($admin_mail);
	$admin_mail_res=mysql_fetch_array($admin_mail_row);
	$mailTo=$admin_mail_res['set_value'];
	
	$Message="<table width=700 style=\"border-left:1px solid #CCCCCC;border-top:1px solid #CCCCCC; 
border-right:1px solid #cccccc; border-bottom:1px solid #cccccc\"><tr><td><img src='<imgh>'></td></tr>";
	$Message .="<tr><td>Company Name:".$company."</td></tr>";
	$Message .="<tr><td>Purpose:".$purpose."</td></tr>";
	$Message .="<tr><td>Priority:".$priority. "</td></tr>";
	$Message .="<tr><td ><font color=blue>Message:".$message."</blue></td></tr>";
	$Message .="<tr><td><img src='<imgf>'></td></tr></table>";
	$Message=str_replace("<imgh>" , $mailheader , $Message);
    $Message=str_replace("<imgf>" , $mailfooter , $Message);
	$mailBody = $Message;
		
	$headers  = "MIME-Version: 1.0\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\n";
	$headers .= "From: ".$mailfrom."\n";	
	
    if(mail($mailTo,$mailSubject,$mailBody,$headers))
				$status = 1;
				



}
}
if($status==1)
{  
require 'templates/sucess_contact.tpl';
}
else
{
if($status==1)
{
$sel_sql="select * from error_message where err_id =25";
$sel_tab=mysql_query($sel_sql);
$sel_row=mysql_fetch_array($sel_tab);
echo '<b>'.$sel_row['err_msg'].'</b>';
}

$title="Contact Us";
require 'include/top.php';
require 'templates/contact.tpl';
require 'include/footer.php';
}
?>
