<?php session_start();
/***************************************************************************
 *File Name				:close_dispute_seller.php
 *File Created				:Friday, July 13, 2007
 * File Last Modified			:Friday, July 13, 2007
 * Copyright				:(C) 2001 AJ Square Inc
 * Email				:licence@ajsquare.net
 * Software Language			:PHP
 * Version Created			:V 4.3.2
 * Programmers worked	        	:V.Sri Vidhya
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
 if(empty($_SESSION['username']))
{ 
$link="signin.php";
$url="myauction.php";
echo '<meta http-equiv="refresh" content="0;url='.$link.'?url='.$url.'">';
echo "You have been Re-Directed, if not please <a href=$link?$url>Click here</a>";
exit();
}

require 'include/connect.php';
require 'include/top.php';
$item_id=$_REQUEST['item_id'];
if(!empty($_SESSION['username']))
{
if(empty($item_id))
{
echo '<meta http-equiv="refresh" content="0;url=myauction.php">';
echo "You have been Re-Directed, if not please <a href=myauction.php>Click here</a>";
exit();
}
}

//sitenmae
$site_sql=mysql_query("select * from admin_settings where set_id=1");
$site_qry=mysql_fetch_array($site_sql);
$site=$site_qry['set_value'];

//Fetching mail header image
$queryheader="select * from admin_settings where set_id = 61";
$tableheader=mysql_query($queryheader);
$rowheader=mysql_fetch_array($tableheader);
$mailheader = $site."/".$rowheader['set_value'];

//Fetching mail footer image
$queryfooter="select * from admin_settings where set_id = 62";
$tablefooter=mysql_query($queryfooter);
$rowfooter=mysql_fetch_array($tablefooter);
$mailfooter = $site."/".$rowfooter['set_value'];

$user_id=$_REQUEST['buyer_id'];
$cansave=$_POST['cansave'];
//fetching days for close dispute set by admin
$close_admin_sql=mysql_query("select * from admin_settings where set_id=63");
$close_admin_qry=mysql_fetch_array($close_admin_sql);
$adminvalue=$close_admin_qry['set_value'];

//userstatus
$user_sql="select * from user_registration where user_id=".$_SESSION['userid'];
$user_res=mysql_query($user_sql);
$user=mysql_fetch_array($user_res);
 //sitename
 $sitename_sql=mysql_query("select * from admin_settings where set_id=1");
 $sitename_qry=mysql_fetch_array($sitename_sql);
 $site_name=$sitename_qry['set_value'];
 //seller name
 $seller_name=$_SESSION['username'];
 //buyer name
 $dis_sql=mysql_query("select * from disputeconsole where itemid=$item_id and dispute_by=".$_SESSION['userid']);
 $dis_qry=mysql_fetch_array($dis_sql);
 $dis_id=$dis_qry['dispute_to'];
 $item_sql=mysql_query("select * from placing_item_bid where item_id=$item_id");
 $item_qry=mysql_fetch_array($item_sql);
 $item_title=$item_qry['item_title'];
 $buyer_sql="select * from user_registration where user_id=$dis_id";
 $buyer_qry=mysql_query($buyer_sql);
 $buyer_row=mysql_fetch_array($buyer_qry);
 $buyer_name=$buyer_row['user_name'];
 
 if($cansave==1)
 {
 $close=$_POST[close];
 if(empty($close))
 {
 $err_msg="Please select an option to close the dispute";
 $err_flag=1;
 }
 if($err_flag!=1)
 {
 
 

//mail for other party that the dispute has been closed.
$mail_sql="select * from mail_subjects where mail_id=28";
$mail_qry=mysql_query($mail_sql);
$mail_row=mysql_fetch_array($mail_qry);
$subject=$mail_row['mail_subject'];
$mail_from=$mail_row['mail_from'];
$mail_to=$buyer_row['email'];
$message=$mail_row['mail_message'];
$message=str_replace("<user>",$buyer_name,$message);
$message=str_replace("<title1>",$item_title,$message);
$message=str_replace("<number>",$item_id,$message);
$message=str_replace("<site>",$site,$message);
$message=str_replace("<imgh>" , $mailheader , $message);
$message=str_replace("<imgf>" , $mailfooter , $message);

$headers  = "MIME-Version: 1.0\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\n";
$headers .= "From: ". $mail_from."\n";
mail($mail_to,$subject,$message,$headers);

 
 //mail to admin to refund the fee
 if($close=="2" or $close=="3")
 {
 //default currency
 $cur_sql=mysql_query("select * from admin_settings where set_id=59");
 $cur_fetch=mysql_fetch_array($cur_sql);
 $default_cur=$cur_fetch['set_value'];
 $finalfee_sql=mysql_query("select * from auction_fees where item_id=$item_id");
 $finalfee_rows=mysql_num_rows($finalfee_sql);
 if($finalfee_rows > 0)
 {
 $final_fee=0;
 while($finalfee_fetch=mysql_fetch_array($finalfee_sql))
 {
 $final_fee=$final_fee+$finalfee_fetch['finalsalevalue_fee'];
 }
 }
$final_fee=number_format($final_fee,2,'.','');
//adminmailid
$admin_sql=mysql_query("select * from admin_settings where set_id=3");
$admin_qry=mysql_fetch_array($admin_sql);
$mail_to_admin=$admin_qry['set_value']; 

$mail_sql=mysql_query("select * from mail_subjects where mail_id=24");
$mail_qry=mysql_fetch_array($mail_sql);
$subject=$mail_qry['mail_subject'];
$mail_from=$mail_qry['mail_from'];
$message=$mail_qry['mail_message'];
$message=str_replace("<buyer>",$buyer_name,$message);
$message=str_replace("<itemtitle>",$item_title,$message);
$message=str_replace("<number>",$item_id,$message);
$message=str_replace("<seller>",$seller_name,$message);
$message=str_replace("<amount>",$final_fee,$message);
$message=str_replace("<currency>",$default_cur,$message);
$message=str_replace("<sitename>",$site_name,$message);
$message=str_replace("<imgh>" , $mailheader , $message);
$message=str_replace("<imgf>" , $mailfooter , $message);


$headers  = "MIME-Version: 1.0\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\n";
$headers .= "From: ". $mail_from."\n";

if(mail($mail_to_admin,$subject,$message,$headers))
{
$status=1;
}
 }
 if($close=="1" or $close=="2" or $close=="3")
 {
  $close_dis_sql="update disputeconsole set dispute_status='closed' where itemid=$item_id and dispute_by=".$_SESSION['userid'];

 $close_dis_qry=mysql_query($close_dis_sql);
 if($close=="2")
 {
 $update_status_sql="update disputeconsole set dispute_close_status='eligible' where itemid=$item_id and dispute_by=".$_SESSION['userid'];
 mysql_query($update_status_sql);
 }
 if($close=="3" or $close=="1")
 {
 $update_status_sql="update disputeconsole set dispute_close_status='notapplicable' where itemid=$item_id and dispute_by=".$_SESSION['userid'];
 mysql_query($update_status_sql);
 }
 
 if($close_dis_qry)
 {
 echo '<meta http-equiv="refresh" content="0;url=myauction.php?mode=sell&status=Active">';
 exit();
 }
 }
 }
 }
 require 'templates/close_dispute_seller.tpl';
 ?>