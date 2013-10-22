<?php
/***************************************************************************
 *File Name				:reviewdetails.php
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
$title="Buyer To Seller Payment";
require 'include/top.php';
require 'include/connect.php';

if(!isset($_SESSION['userid']))
{ 
$link="signin.php";
$url="myauction.php";
echo '<meta http-equiv="refresh" content="0;url='.$link.'?url='.$url.'">';
exit();
}
   
   
$default_currency="select * from admin_settings where set_id=59";
$default_res=mysql_query($default_currency);
$default_row=mysql_fetch_array($default_res);
$default_cur=$default_row['set_value'];

$default_currency_code="select * from admin_settings where set_id=60";
$default_res_code=mysql_query($default_currency_code);
$default_row_code=mysql_fetch_array($default_res_code);
$default_cur_code=$default_row_code['set_value'];
   
   $item_id=$_REQUEST['item_id'];
   $_SESSION['item_id']=$item_id;
   $sql_user1="select * from placing_item_bid where item_id=$item_id";
   $res_user1=mysql_query($sql_user1);
   $row=mysql_fetch_array($res_user1);
   $currency_sell=$row['currency'];
   $cur_code_sql="select * from currency_master where currency='$currency_sell'";
   $cur_code_sqlqry=mysql_query($cur_code_sql);
   $cur_code_fetch=mysql_fetch_array($cur_code_sqlqry);
   $cur_code=$cur_code_fetch['currency_code'];
   $query="select * from user_registration where user_id =".$row['user_id'];
   $table=mysql_query($query);
   if($seller_row=mysql_fetch_array($table))
   {
   $seller_name=$seller_row['user_name'];  
   $seller_email=$seller_row['email']; 
   }
   $bid_sql="select * from placing_bid_item where item_id= $item_id and user_id=".$_SESSION['userid'];
   $bid_res=mysql_query($bid_sql);
   $bid_det=mysql_fetch_array($bid_res);
   
   $bid_sql1="select max(bidding_amount) from placing_bid_item where item_id= $item_id and user_id=".$_SESSION['userid']." and user_pos='Yes'";
   $bid_res1=mysql_query($bid_sql1);
   $bid_det1=mysql_fetch_array($bid_res1);
   
    $totalprice=($bid_det['quantity'] * $row['sale_price']);
    $_SESSION['totalprice']=$totalprice;
	$buyer_det_sql="select * from user_registration where user_id=".$bid_det['user_id'];
	$buyer_det_sqlqry=mysql_query($buyer_det_sql);
	$buyer_det_fetch=mysql_fetch_array($buyer_det_sqlqry);
	
	$buy_query="select * from user_registration where user_id =".$row['user_id'];
    $buy_res=mysql_query($buy_query);
    $buyer_row=mysql_fetch_array($buy_res);
	$admin="select * from admin_settings where set_id=1"; //sitename -> id=1
	$admin_res=mysql_query($admin);
	$admin_rec=mysql_fetch_array($admin_res);
	$yoursite=$admin_rec['set_value'];
	$payid=$row['payment_gateway'];
	$pricing= $row['sale_price'] * $bid_det['quantity'];
	$shipping=$row['shipping_cost'];
	$tax=($pricing*$row['tax']/100);
	
	require'templates/reviewdetails.tpl';
    require 'include/footer.php';					
?>
