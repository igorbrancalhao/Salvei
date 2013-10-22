<?php

/* * *************************************************************************
 * File Name				:subscribe_to_store.php
 * File Created				:Wednesday, June 21, 2006
 * File Last Modified			:Wednesday, June 21, 2006
 * Copyright				:(C) 2001 AJ Square Inc
 * Email				:licence@ajsquare.net
 * Software Language			:PHP
 * Version Created			:V 4.3.2
 * Programmers worked	        	:S.Priya, B.ReenaKumari, K.Shanmuga priya
 * $Id                                  : memberlist.php,v 1.36.2.12 2006/02/07 20:42:51 grahamje Exp $
 *
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
error_reporting(0);
require 'include/connect.php';
$userid = $_SESSION['userid'];

$admin = "select * from admin_settings where set_id=1"; //sitename -> id=1
$admin_res = mysql_query($admin);
$admin_rec = mysql_fetch_array($admin_res);
$yoursite = $admin_rec['set_value'];

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

$select_cur = "select * from admin_settings where set_id=59";
$selectqry_cur = mysql_query($select_cur);
$fetch_cur = mysql_fetch_array($selectqry_cur);
$currency_admin = $fetch_cur['set_value'];

$select_curcode = "select * from admin_settings where set_id=60";
$selectqry_curcode = mysql_query($select_curcode);
$fetch_curcode = mysql_fetch_array($selectqry_curcode);
$currencycode_admin = $fetch_curcode['set_value'];
$default_cur_code = $currencycode_admin;

$secpay_mechant = "select * from admin_settings where set_id=65";
$secpay_mechant_res = mysql_query($secpay_mechant);
$secpay_mechant_fetch = mysql_fetch_array($secpay_mechant_res);
$sec_merchant = $secpay_mechant_fetch['set_value'];

$secpay_trans = "select * from admin_settings where set_id=66";
$secpay_trans_res = mysql_query($secpay_trans);
$secpay_trans_fetch = mysql_fetch_array($secpay_trans_res);
$sec_trans = $secpay_trans_fetch['set_value'];

$google_mechant = "select * from admin_settings where set_id=63";
$google_mechant_res = mysql_query($google_mechant);
$google_mechant_fetch = mysql_fetch_array($google_mechant_res);
$google_merchant = $google_mechant_fetch['set_value'];

$google_trans = "select * from admin_settings where set_id=64";
$google_trans_res = mysql_query($google_trans);
$google_trans_fetch = mysql_fetch_array($google_trans_res);
$google_trans = $google_trans_fetch['set_value'];



$sql_store = "select * from storefronts where user_id=" . $_SESSION['userid'];
$sql_qry_store = mysql_query($sql_store);
$sql_fetch_store = mysql_fetch_array($sql_qry_store);
$planid = $sql_fetch_store['planid'];
$_SESSION[store_id] = $sql_fetch_store['id'];
$fee_sql = "select * from plan where plan_id=" . $planid;
$fee_res = mysql_query($fee_sql);
$fee_rows = mysql_num_rows($fee_res);
if ($fee_rows > 0) {
    $fee_row = mysql_fetch_array($fee_res);
    $amount = $fee_row['amount'];
    $plan_flag = 1;
} else {
    $plan_flag = 0;
}


$sql_payment_mode = "select * from payment_mode where pay_id=1";
$sqlqry_payment_mode = mysql_query($sql_payment_mode);
$sqlfetch_payment_mode = mysql_fetch_array($sqlqry_payment_mode);
$payid = $sqlfetch_payment_mode['payment_id'];
$_SESSION['amount'] = $amount;
$_SESSION['payment_gateway'] = $payid;
$_SESSION['fee_type'] = 'Store_Renew';

require 'include/top.php';
require 'templates/store_renew.tpl';
require 'include/footer.php';
