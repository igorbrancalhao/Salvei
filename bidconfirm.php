<?php
/***************************************************************************
 *File Name				:bidconfirm.php
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
session_start();
error_reporting(0);
require 'include/connect.php';
$item_id=$_GET['item_id']; 
$max_bid=$_GET['max_bid']; 
$sql="select * from placing_item_bid where item_id=$item_id";
$res=mysql_query($sql);
$row=mysql_fetch_array($res);
$userid=$_SESSION[userid];
$highest_bid="select max(bidding_amount) as amt from placing_bid_item where item_id=$item_id and deleted='No'";
$highet_res=mysql_query($highest_bid);
$highest_row=mysql_fetch_array($highet_res);
$highest_bid_amt=$highest_row[amt];

$higher_id="select * from placing_bid_item where bidding_amount=$highest_bid_amt and item_id=$item_id and deleted='No'";
$higher_res=mysql_query($higher_id);
$higher_row=mysql_fetch_array($higher_res);
$higher_userid=$higher_row[user_id];


if($row[payment_gateway])
{
$pay="select * from payment_gateway where gateway_id=$row[payment_gateway]";
$pay_res=mysql_query($pay);
$pay_rec=mysql_fetch_array($pay_res); 
}
$title="Bidding";
require 'include/top.php';
require'templates/bidconfirm.tpl'; 
require'include/footer.php';
?>