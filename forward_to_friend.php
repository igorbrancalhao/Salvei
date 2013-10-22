<?php
/***************************************************************************
 *File Name				:forward_to_friend.php
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
error_reporting(0);
require 'include/connect.php';
$cansend=$_POST['canSend'];
$user_sql="select * from user_registration where user_id=".$_SESSION['userid'];
$user_recordset=mysql_query($user_sql);
$user_record=mysql_fetch_array($user_recordset);

$site_query="select * from admin_settings where set_id=1";
$site_table=mysql_query($site_query);
$site_row=mysql_fetch_array($site_table);
$yoursite=$site_row['set_value'];

//Fetching mail header image
$queryheader="select * from admin_settings where set_id = 61";
$tableheader=mysql_query($queryheader);
$rowheader=mysql_fetch_array($tableheader);
$mailheader =$yoursite."/".$rowheader['set_value'];

//Fetching mail footer image
$queryfooter="select * from admin_settings where set_id = 62";
$tablefooter=mysql_query($queryfooter);
$rowfooter=mysql_fetch_array($tablefooter);
$mailfooter =$yoursite."/".$rowfooter['set_value'];

$item_id=$_REQUEST['item_id'];
$item_sql="select * from placing_item_bid where item_id=$item_id";
$item_recordset=mysql_query($item_sql);
$item_record=mysql_fetch_array($item_recordset);
if($cansend==1) 
{
$message=$_POST['message'];
$item_id=$_POST['item_id'];
$from=$_REQUEST['mailfrom'];
$mailto=$_POST['mailto'];

$mail_sql="select * from mail_subjects where mail_id = 2";
$mail_result = mysql_query($mail_sql);
$mail_row = mysql_fetch_array($mail_result);
$mailmsg=$mail_row['mail_message'];

if(($item_record['selling_method']=='dutch_auction') || ($item_record['selling_method']=='auction') || ($item_record['selling_method']=='fix'))
$path="$yoursite"."/detail.php?item_id="."$item_id";
if($item_record['selling_method']=='ads')
$path="$yoursite"."/classifide_ad.php?item_id="."$item_id";
if($item_record['selling_method']=='want_it_now')
$path="$yoursite"."/wantitnowdes.php?item_id="."$item_id";



if(!empty($_SESSION['username']))
$username=$_SESSION['username'];
else
$username="Your friend";

$subject="$username " ."sent you this $yoursite item :"."$item_record[item_title]"."(# $item_id)";
$mailmsg = ereg_replace("<username>",$username,$mailmsg);
$mailmsg = ereg_replace("<msg>",$message,$mailmsg);
$mailmsg = ereg_replace("<page>",$path,$mailmsg);
$mailmsg=str_replace("<imgh>" , $mailheader , $mailmsg);
$mailmsg=str_replace("<imgf>" , $mailfooter , $mailmsg);


$headers  = "MIME-Version: 1.0\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\n";
$headers .= "From: ". $from."\n";

  if(mail($mailto,$subject,$mailmsg,$headers))
				$status = 1; 
		 	else
				$status = 2;   
		} 
if($status==1)
 {
 
	$title="Email to a Friend";
	require 'include/top.php';
	require 'templates/forward_friend_success.tpl'; 
	require  'include/footer.php' ;
    exit();
}
else if($status==2)
{
	$title="Email to a Friend";
	require 'include/top.php';
    require 'templates/forward_friend_failure.tpl';
	require  'include/footer.php' ;
    exit();
}

$title="Email to a Friend";
require 'include/top.php';
require 'templates/forward_to_friend.tpl';
require 'include/footer.php';
?>

