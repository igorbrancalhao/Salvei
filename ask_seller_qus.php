<?php
/***************************************************************************
 *File Name				:ask_seller_qus.php
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
$title="Ask Question";
require 'include/top.php';
require 'include/connect.php';
$type=$_REQUEST['type'];
if(!empty($_GET['item_id']))
$item_id=$_GET['item_id'];
else
$item_id=$_POST['item_id'];
$go_link=$_REQUEST['go_link'];

$admin_cat_sort="select * from admin_settings where set_id=45";
$admin_cat_res=mysql_query($admin_cat_sort);
$admin_cat_row=mysql_fetch_array($admin_cat_res);


$sqlsite="select * from admin_settings where set_id=1";
$sqlsiteqry=mysql_query($sqlsite);
$sqlsitefetch=mysql_fetch_array($sqlsiteqry);
$site=$sqlsitefetch['set_value'];
	
$admin_sql="select * from admin_settings where set_id=3";
$get_res=mysql_query($admin_sql);
$get_row=mysql_fetch_array($get_res);
$from=$get_row['set_value'];


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


	
if(($admin_cat_row[2]==2) and ($_SESSION['username']) and ($mode==2))
{
	$url="ask_seller_qus.php";
	echo '<meta http-equiv="refresh" content="0;url='.$url.'?item_id='.$item_id.'">';
	exit();
}
	
$sql="select * from placing_item_bid where item_id=$item_id";
$res=mysql_query($sql);
$rec=mysql_fetch_array($res);
$canSend=$_POST['canSend'];

$user_sql="select * from user_registration where user_id=".$rec['user_id'];
$user_res=mysql_query($user_sql);
$user_rec=mysql_fetch_array($user_res);
$from_id=$_SESSION[userid];
$email_sql="select * from user_registration where user_id=$from_id";
$email_res=mysql_query($email_sql);
$email_rec=mysql_fetch_array($email_res);


$seller_name=$user_rec['user_name'];
$buyer_name=$_SESSION['username'];
$product_name=$rec['item_title'];
if($canSend==1)
{
$question=$_POST['message'];
$to_id=$_POST['to_id'];
$subject=$_POST['messagetype'];
$fromid=$_SESSION['userid'];
$qst_date=date("Y-m-d");

if(empty($subject))
{
$err_flag=1;
$err_subject="Enter a valid Information";
}

if(empty($question))
{
$err_flag=1;
$err_message="Enter a valid Information";
}

if($err_flag!=1)
{
	 $ins_sql="insert into ask_question(from_id,item_id,date,question,to_id) values('$fromid','$item_id','$qst_date','$question','$to_id');";
	$ins_row=mysql_query($ins_sql);
	$status=1;

    
	
	$sql="select * from mail_subjects where mail_id = 3";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	$mailsubject = $row['mail_subject'];
	$mailbody = $row['mail_message'];
	$mailto=$user_rec['email'];
	
	$mailbody = ereg_replace("<seller_name>",$seller_name,$mailbody);
	$mailbody = ereg_replace("<question>",$question,$mailbody);
	$mailbody = ereg_replace("<product_name>",$product_name,$mailbody);
	$mailbody = ereg_replace("<buyer_name>",$buyer_name,$mailbody); 
	$mailbody = ereg_replace("<sitename>",$site,$mailbody); 
	$mailbody=str_replace("<imgh>" , $mailheader , $mailbody);
    $mailbody=str_replace("<imgf>" , $mailfooter , $mailbody);
      
    $headers  = "MIME-Version: 1.0\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\n";
	$headers .= "From: ". $from."\n";
	if(mail($mailto,$subject,$mailbody,$headers))
		$status = 1; 
	else
	$status = 2;   
}
		
if($status==1)
{
	$sell="select * from user_registration where user_id=".$rec['user_id'];
	$res=mysql_query($sell);
	if($go_link)
	$link="detail.php";
	else
	$link="myauction.php";
	$msg="Your question has been sent to $user_rec[user_name]";
}
  if($status==2)
{
	$msg="Mail Sent failed .";
} 
}
require 'templates/ask_seller_qus.tpl';
require 'include/footer.php';
?>

