<?php
/***************************************************************************
 *File Name				:verification_reginterest.php
 *File Created			:Wednesday, June 21, 2006
 * File Last Modified	:Wednesday, June 21, 2006
 * Copyright			:(C) 2001 AJ Square Inc
 * Email				:licence@ajsquare.net
 * Software Language	:PHP
 * Version Created		:V 4.3.2
 * Programmers worked	:S.Priya, B.ReenaKumari, K.Shanmuga priya
 * Modified By			:B.Reena 
 * $Id                  : memberlist.php,v 1.36.2.12 2006/02/07 20:42:51 grahamje Exp $
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
/*
 file name:verification_reg.php;
 date	  :11.2.06
 Created by:priya
 Modified By: B.Reena
 Rights reserved by AJ Square inc
*/
session_start();
error_reporting(0);
require 'include/connect.php';

    $userid=$_SESSION['user_id'];
	if(empty($userid))
	{
		  echo '<meta http-equiv="refresh" content="0;url=sorry.php">';
          exit();  
	}
    $user_sql = "select * from user_registration where user_id = ".$userid;
	$user_result = mysql_query($user_sql);
	$user_row = mysql_fetch_array($user_result);
    $verification_code=$user_row['veri_code'];
    $username=$user_row['user_name'];
	$password=$user_row['password'];

    $admin_sql="select * from admin_settings where set_id=1";
	$get_res=mysql_query($admin_sql);
	$get_row=mysql_fetch_array($get_res);
    $yoursite=$get_row['set_value'];
	
	//Fetching mail header image
    $queryheader="select * from admin_settings where set_id = 61";
    $tableheader=mysql_query($queryheader);
    $rowheader=mysql_fetch_array($tableheader);
    $mailheader = $yoursite."/".$rowheader['set_value'];

    //Fetching mail footer image
    $queryfooter="select * from admin_settings where set_id = 62";
    $tablefooter=mysql_query($queryfooter);
    $rowfooter=mysql_fetch_array($tablefooter);
    $mailfooter = $yoursite."/".$rowfooter['set_value'];
	

	$sql="select * from mail_subjects where mail_id =1";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
    $mailto=$user_row['email'];
	$mailfrom = $row["mail_from"];
	$mailsubject = $row["mail_subject"];
	$mailbody = $yoursite."/".$row["mail_message"];
	
	
    $mailbody = ereg_replace("<vcode>",$verification_code,$mailbody);
	$mailbody = ereg_replace("<url>",$yoursite,$mailbody);
	$mailbody = ereg_replace("<username>",$username,$mailbody);
	$mailbody = ereg_replace("<password>",$_SESSION['p1'],$mailbody);
    $mailbody = ereg_replace("<userid>",$userid,$mailbody);
	$mailbody=str_replace("<imgh>" , $mailheader , $mailbody);
    $mailbody=str_replace("<imgf>" , $mailfooter , $mailbody);
			
	$headers  = "MIME-Version: 1.0\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\n";
	$headers .= "From: ". $mailfrom."\n";
	mail($mailto,$mailsubject,$mailbody,$headers);
	
$title="Registration";		
require 'include/top.php';
require 'templates/verification_reg.tpl';
require 'include/footer.php';
?>
