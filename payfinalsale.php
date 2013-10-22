<?php

/* * *************************************************************************
 * File Name				:payfinalsale.php
 * File Created			:Wednesday, June 21, 2006
 * File Last Modified	:Wednesday, June 21, 2006
 * Copyright			:(C) 2001 AJ Square Inc
 * Email				:licence@ajsquare.net
 * Software Language	:PHP
 * Version Created		:V 4.3.2
 * Programmers worked	:S.Priya, B.ReenaKumari, K.Shanmuga priya
 * Modified By			:B.Reena
 * $Id                  : memberlist.php,v 1.36.2.12 2006/02/07 20:42:51 grahamje Exp $
 * ************************************************************************* */


/* * **************************************************************************

 *      Licence Agreement: 

 *     This program is a Commercial licensed software; 
 *     you are not authorized to redistribute it and/or modify/and or sell it under any publication 
 *     or license /or term it under the GNU General Public License as published by the Free Software Foundation;
 *     either user and developer versions of the License, or (at your option) 
 *     any later version is applicable for the same.

 * *************************************************************************** */
session_start();
require 'include/connect.php';
$userid = $_SESSION['userid'];
$item_title = $row['item_title'];
$payid = $row['payment_gateway'];
$fee_id = $_REQUEST['fee_id'];
$query = "select * from user_registration where user_id =" . $userid;
$table = mysql_query($query);
if ($seller_row = mysql_fetch_array($table)) {
    $seller_name = $seller_row['user_name'];
    $seller_email = $seller_row['email'];
}

$default_currency = "select * from admin_settings where set_id=59";
$default_res = mysql_query($default_currency);
$default_row = mysql_fetch_array($default_res);
$default_cur = $default_row['set_value'];

$default_currency_code = "select * from admin_settings where set_id=60";
$default_res_code = mysql_query($default_currency_code);
$default_row_code = mysql_fetch_array($default_res_code);
$default_cur_code = $default_row_code['set_value'];


$admin = "select * from admin_settings where set_id=1"; //sitename -> id=1
$admin_res = mysql_query($admin);
$admin_rec = mysql_fetch_array($admin_res);
$yoursite = $admin_rec[set_value];

$admin = "select * from admin_settings where set_id=3"; //sitename -> id=1
$admin_res = mysql_query($admin);
$admin_rec = mysql_fetch_array($admin_res);
$adminmail = $admin_rec['set_value'];

$egold_sql = "select * from admin_settings where set_id=48";
$egold_res = mysql_query($egold_sql);
$egold_row = mysql_fetch_array($egold_res);
$egoldno = $egold_row['set_value'];

$egold_sql = "select * from admin_settings where set_id=49";
$egold_res = mysql_query($egold_sql);
$egold_row = mysql_fetch_array($egold_res);
$egoldname = $egold_row['set_value'];

$intgold_sql = "select * from admin_settings where set_id=50";
$intgold_res = mysql_query($intgold_sql);
$intgold_row = mysql_fetch_array($intgold_res);
$intgoldno = $intgold_row['set_value'];

$paypal_sql = "select * from admin_settings where set_id=11";
$paypal_res = mysql_query($paypal_sql);
$paypal_row = mysql_fetch_array($paypal_res);
$paypalno = $paypal_row['set_value'];

$strom_sql = "select * from admin_settings where set_id=51";
$strom_res = mysql_query($strom_sql);
$strom_row = mysql_fetch_array($strom_res);
$stormpayno = $strom_row['set_value'];

$ebull_sql = "select * from admin_settings where set_id=52";
$ebull_res = mysql_query($ebull_sql);
$ebull_row = mysql_fetch_array($ebull_res);
$ebull_no = $ebull_row['set_value'];

$ebull_sql = "select * from admin_settings where set_id=52";
$ebull_res = mysql_query($ebull_sql);
$ebull_row = mysql_fetch_array($ebull_res);
$ebull_name = $ebull_row['set_value'];

$moneybooker_sql = "select * from admin_settings where set_id=53";
$moneybooker_res = mysql_query($moneybooker_sql);
$moneybooker_row = mysql_fetch_array($moneybooker_res);
$moneybooker = $moneybooker_row['set_value'];

$merkatobid_sql = "select * from admin_settings where set_id=55";
$merkatobid_res = mysql_query($merkatobid_sql);
$merkatobid_row = mysql_fetch_array($merkatobid_res);
$merkato_id = $merkatobid_row['set_value'];

$paypal_no = $row['payment_id'];
$fee_sql = "select * from auction_fees where fee_id=" . $fee_id;
$fee_res = mysql_query($fee_sql);
$fee_row = mysql_fetch_array($fee_res);
$item_id = $fee_row['item_id'];
$amount = $fee_row['finalsalevalue_fee'];
$amount = number_format($amount, 2, '.', '');

/* $_SESSION['amount']=$amount;
  $_SESSION['item_id']=$item_id;
  $_SESSION['payment_gateway']=$payid;
  $_SESSION['fee_id']=$fee_id;
  $_SESSION['fee_type']='Final Sale Value Fee'; */

require 'include/top.php';
require'templates/payfinalsale.tpl';
require 'include/footer.php';
