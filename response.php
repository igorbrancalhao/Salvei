<?php

/* * *************************************************************************
 * File Name				:response.php
 * File Created			:Wednesday, June 21, 2006
 * File Last Modified	:Wednesday, June 21, 2006
 * Copyright			:(C) 2001 AJ Square Inc
 * Email				:licence@ajsquare.net
 * Software Language	:PHP
 * Version Created		:V 4.3.2
 * Programmers worked	:S.Priya, B.ReenaKumari, K.Shanmuga priya
 * Modified By			:B.Reena
 * $Id                  :memberlist.php,v 1.36.2.12 2006/02/07 20:42:51 grahamje Exp $
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
$item_id = $_REQUEST['item_id'];
$qst_id = $_REQUEST['qst_id'];
$go_link = $_REQUEST['go_link'];
if (!isset($_SESSION['userid'])) {
    $link = "signin.php";
    $url = "response.php";
    echo '<meta http-equiv="refresh" content="0;url=' . $link . '?url=' . $url . '&item_id=' . $item_id . '">';
    echo "You have been Re-Directed, if not please <a href=$link?$url&item_id=$item_id>Click here</a>";
    exit();
}
$ask_sql = "select * from ask_question where qst_id=$qst_id";
$ask_res = mysql_query($ask_sql);
$ask_row = mysql_fetch_array($ask_res);
$from_qus_id = $ask_row[from_id];
$user_from_sql = "select * from user_registration where user_id=$from_qus_id";
$user_from_res = mysql_query($user_from_sql);
$user_from_rec = mysql_fetch_array($user_from_res);
$user_from = $user_from_rec['user_name'];

if ($ask_row[status] == "unread" or $ask_row[status] == "read")
    $message = $ask_row['question'];
else if ($ask_row['status'] == "reply")
    $message = $ask_row['answer'];

$sql = "select * from placing_item_bid where item_id=$item_id";
$res = mysql_query($sql);
$rec = mysql_fetch_array($res);
$canSend = $_POST['canSend'];

$user_sql = "select * from user_registration where user_id=$rec[user_id]";
$user_res = mysql_query($user_sql);
$user_rec = mysql_fetch_array($user_res);
$from_id = $_SESSION['userid'];

$email_sql = "select * from user_registration where user_id=$from_id";
$email_res = mysql_query($email_sql);
$email_rec = mysql_fetch_array($email_res);

$from = $email_rec['email'];
$seller_name = $user_rec['user_name'];
$buyer_name = $_SESSION['username'];
$product_name = $rec['item_title'];
if ($canSend == 1) {
    $answer = $_POST['message'];
    $to_id = $_POST['to_id'];
    $subject = $_POST['messagetype'];
    $question = $ask_row['question'];
    $fromid = $_SESSION['userid'];
    $qst_date = date("Y-m-d");
    if (empty($fromid))
        $err_flag = 1;
    if (empty($answer)) {
        $err_flag = 1;
        $err_response = "Enter a valid Information";
    }
    if ($err_flag != 1) {
        $ins_sql = "insert into ask_question(from_id,item_id,date,question,answer,to_id,status) values('$fromid','$item_id','$qst_date','$question','$answer','$to_id','reply')";
        $ins_row = mysql_query($ins_sql);
        $status = 1;
    }

    if ($status == 1) {
        $sell = "select * from user_registration where user_id=$rec[user_id]";
        $res = mysql_query($sell);
        if ($go_link)
            $link = "detail.php";
        else
            $link = "myauction.php";
        echo '<meta http-equiv="refresh" content="0;url=' . $link . '?item_id=' . $item_id . '">';
        echo "You have been Re-Directed, if not please <a href=$link?item_id=$item_id>Click here</a>";
        exit();
    }
    else if ($status == 2) {
        $msg = " Mail Sent failed .";
    }
}
$title = "Reply To Memeber";
require 'include/top.php';
require 'templates/response.tpl';
require 'include/footer.php';
?>

