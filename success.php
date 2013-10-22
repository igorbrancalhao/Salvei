<?php

/* * *************************************************************************
 * File Name				:success.php
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
require 'include/top.php';

$amount = $_GET['amt'];
$payment_gateway = $_GET['pid'];
$userid = $_GET['usrd'];
$item_id = $_GET['itid'];

if ($amount != '') {

    /* $amount=$_SESSION['amount'];
      $payment_gateway=$_SESSION['payment_gateway'];
      $item_id=$_SESSION['item_id'];
      $userid=$_SESSION['userid']; */


    if ($payment_gateway == "3") {
        $paid_amount = $_POST['PAYMENT_AMOUNT'];
        $batch_number = $_POST['PAYMENT_BATCH_NUM'];
        $payer_account = $_POST['PAYER_ACCOUNT'];
    }
    if ($payment_gateway == "2") {
        $paid_amount = $_POST['AMOUNT'];
        $batch_number = $_POST['TRANSACTION_ID'];
        $buyer_accountid = $_POST['BUYERACCOUNTID'];
    }
    if ($payment_gateway == "1") {
        $paid_amount = $_POST['mc_gross'];
        $batch_number = $_POST['txn_id'];
    }
    if ($payment_gateway == "6") {
        $paid_amount = $_POST['AMOUNT'];
        $batch_number = $_POST['TRANSACTION_ID'];
        $buyer_accountid = $_POST['PAYER_NAME'];
    }
    if ($payment_gateway == "5") {
        $paid_amount = $_POST['AMOUNT'];
        $batch_number = $_POST['TRANSACTION_ID'];
        $buyer_accountid = $_POST['ATIP_ACCOUNT'];
    }
    if ($payment_gateway == "4") {
        $paid_amount = $_POST['AMOUNT'];
        $batch_number = $_POST['TRANSACTION_ID'];
    }

    $trans_date = date('Y-m-d');
    if ($amount == $paid_amount) {
        $up_sql = "update placing_item_bid set status='Active' where item_id=$item_id";
        mysql_query($up_sql);

        $ins_sql = "insert into admin_earnings(user_id,payment_date,amount,type,item_id) values('$userid','$trans_date','$amount','feature_fee',$item_id)";
        $ins_sqlqry = mysql_query($ins_sql);

        $insert_query = "insert into pay_transaction(trans_amount,itemid,user_id,trans_batchnumber,trans_date,trans_type) values($amount,'$item_id','$userid','$batch_number','$trans_date','Featured Listing Fee')";
        $insert_result = mysql_query($insert_query);
        $sucess_flag = 1;
    } else {
        $failureflag = 1;
    }
    $_SESSION['amount'] = '';
    $_SESSION['item_id'] = '';
    $_SESSION['payment_gateway'] = '';
} else
    $failureflag = 1;
require 'templates/success_payment.tpl';
require 'include/footer.php';
?>
