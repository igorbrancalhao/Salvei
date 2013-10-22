<?php

/* * *************************************************************************
 * File Name				:close.php
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
$item_id = $_REQUEST['item_id'];
//  admin detail
$site_query = "select * from admin_settings where set_id=1";
$site_table = mysql_query($site_query);
$site_row = mysql_fetch_array($site_table);
$site_name = $site_row['set_value'];

$site_query = "select * from admin_settings where set_id=3";
$site_table = mysql_query($site_query);
$site_row = mysql_fetch_array($site_table);
$admin_mail = $site_row['set_value'];
$mail_from = $admin_mail;

//Fetching mail header image
$queryheader = "select * from admin_settings where set_id = 61";
$tableheader = mysql_query($queryheader);
$rowheader = mysql_fetch_array($tableheader);
$mailheader = $site_name . "/" . $rowheader['set_value'];

//Fetching mail footer image
$queryfooter = "select * from admin_settings where set_id = 62";
$tablefooter = mysql_query($queryfooter);
$rowfooter = mysql_fetch_array($tablefooter);
$mailfooter = $site_name . "/" . $rowfooter['set_value'];

// item detail 
$item_detail_query = "select * from placing_item_bid where item_id =" . $item_id;
$item_detail_table = mysql_query($item_detail_query);
$item_detail_row = mysql_fetch_array($item_detail_table);
$item_title = $item_detail_row['item_title'];
$currency = $item_detail_row['currency'];
$item_shipping_cost = $currency . $item_detail_row['shipping_cost'];
$item_shipping_route = $item_detail_row['shipping_route'];
$item_shipping_tax = $currency . $item_detail_row['tax'];
//bid detail 
$item_query = "select * from placing_bid_item where item_id =$item_id and user_pos='No' and deleted='No' order by quantity DESC , bidding_amount DESC";
$item_tab = mysql_query($item_query);
$size = mysql_num_rows($item_tab);

if ($size >= 1) {
    if ($item_detail_row['Quantity'] > 1) {
        $item_row = mysql_fetch_array($item_tab);
        $amt = $item_row['bidding_amount'];
        $higher_quantity_id = $item_row['item_id'];
        $single_amount = $item_row['bidding_amount'];
        $qty = $item_row['quantity'];
        $user_id = $item_row['user_id'];


        $sin_item_detail_query = "select * from placing_item_bid where item_id =" . $item_id;
        $sin_item_detail_table = mysql_query($sin_item_detail_query);
        $sin_item_detail_row = mysql_fetch_array($sin_item_detail_table);
        if ($sin_item_detail_row['Quantity'] != 0) {
            $solddate = date("Y-m-d G:i:s");
            if ($flag != 1) {
                $update_query = "update placing_bid_item set user_pos='Yes',quantity=$qty where item_id=" . $item_id . " and user_id=" . $user_id;
                $up_status = mysql_query($update_query);
            }
            if ($up_status)
                $flag = 1;
            $update_date = "update placing_bid_item set sale_date='$solddate' where item_id=$item_id";
            mysql_query($update_date);

            /* $update_query ="update placing_item_bid set Quantity=Quantity-$qty,quantity_sold=quantity_sold+$qty , sale_price='$amt' where item_id=".$item_id; */
            $update_query = "update placing_item_bid set Quantity=0,quantity_sold=$qty,sale_price='$amt' where item_id=" . $item_id;
            $up_status = mysql_query($update_query);

            $close_item_sql = "select * from placing_item_bid where item_id=$item_id";
            $close_item_qry = mysql_query($close_item_sql);
            if ($close_item_row = mysql_fetch_array($close_item_qry))
                $close_item_qty = $close_item_row['Quantity'];
            if ($close_item_qty == 0) {
                $update_close_sql = "update placing_item_bid set status='Closed' where item_id='$item_id'";
                mysql_query($update_close_sql);
            }

            $up_del = "delete from want_it_now where responseed_itemid=" . $item_id;
            $upsql_del = mysql_query($up_del);

            // mail to seller 
            $useremailid = "select * from user_registration where user_id=" . $_SESSION['userid'];
            $user_email_res = mysql_query($useremailid);
            $user_email_row = mysql_fetch_array($user_email_res);
            $seller_name = $user_email_row['user_name'];
            $mail_to = $user_email_row['email'];

            $mail_query = "select * from mail_subjects where mail_id=18";
            $mail_table = mysql_query($mail_query);
            if ($mail_row = mysql_fetch_array($mail_table)) {
                $message = $mail_row['mail_message'];
                $subject = $mail_row['mail_subject'];
                $mail_from = $mail_row['mail_from'];
            }

            $querybuy = "select * from user_registration where user_id = '$user_id'";
            $tablebuy = mysql_query($querybuy);
            $rowbuy = mysql_fetch_array($tablebuy);
            $buyname = $rowbuy['user_name'];

            $country_sql = "select * from country_master where country_id=" . $rowbuy['country'];
            $country_sqlqry = mysql_query($country_sql);
            $country_fetch = mysql_fetch_array($country_sqlqry);
            $country = $country_fetch['country'];

            $buyer_detail = "<tr><td>Buyer Name</td><td> $buyname </td></tr>";
            $buyer_detail.="<tr><td>Quantity</td><td>$qty</td></tr>";
            $buyer_detail.="<tr><td>Price</td><td>" . $item_detail_row['currency'] . " " . $amt . "</td></tr>";
            $buyer_detail.="<tr><td>Buyer Address</td><td>" . $rowbuy['address'] . "<br>" . $rowbuy['city'] . "<br>" . $rowbuy['state'] . "<br>$country";
            $buyer_detail.="<br>" . $rowbuy['pin_code'] . "</td></tr>";
            $buyer_detail.="<tr><td>Buyer mailid</td><td>" . $rowbuy['email'] . "</td></tr>";

            $seller_name = $_SESSION['username'];
            $message = str_replace("NAME", $_SESSION['username'], $message);
            $message = str_replace("<ITEM_TITLE>", $item_detail_row['item_title'], $message);
            $message = str_replace("<GET_VIEW_ITEM>", "$site_name/detail.php?item_id=" . $item_id, $message);
            $message = str_replace("<Buyer Details>", $buyer_detail, $message);
            $message = str_replace("<sitename>", "$site_name", $message);
            $message = str_replace("<imgh>", $mailheader, $message);
            $message = str_replace("<imgf>", $mailfooter, $message);

            $headers = "MIME-Version: 1.0\n";
            $headers .= "Content-type: text/html; charset=iso-8859-1\n";
            $headers .= "From: " . $mail_from . "\n";

            mail($mail_to, $subject, $message, $headers);

            //End of mail to seller//
// Buyer mail message
            $buy_query = "select * from mail_subjects where mail_id=5";
            $buy_table = mysql_query($buy_query);
            $buy_row = mysql_fetch_array($buy_table);
            $buy_message = $buy_row['mail_message'];
            $subject = $buy_row['mail_subject'];
            $mail_from = $buy_row['mail_from'];

            $query = "select * from user_registration where user_id='$user_id'";
            $mytable = mysql_query($query);
            $myrow = mysql_fetch_array($mytable);
            $higher_user_name = $myrow['user_name'];
            $mail_to = $myrow['email'];

            $buy_message = str_replace("NAME", $higher_user_name, $buy_message);
            $buy_message = str_replace("<ITEM_TITLE>", $item_detail_row['item_title'], $buy_message);
            $buy_message = str_replace("<cur>", $item_detail_row['currency'], $buy_message);
            $buy_message = str_replace("<SALE_PRICE>", $amt, $buy_message);
            $buy_message = str_replace("<QUANTITY>", $qty, $buy_message);
            $buy_message = str_replace("<SHIPPING_COST>", $item_detail_row['currency'] . " " . $item_detail_row['shipping_cost'], $buy_message);
            $buy_message = str_replace("<SALE_TAX>", $item_detail_row['tax'] . "%", $buy_message);
            $buy_message = str_replace("<GET_VIEW_ITEM>", "$site_name/detail.php?item_id=" . $item_id, $buy_message);
            $buy_message = str_replace("<sitename>", $site_name, $buy_message);
            $buy_message = str_replace("<imgh>", $mailheader, $buy_message);
            $buy_message = str_replace("<imgf>", $mailfooter, $buy_message);

            $headers = "MIME-Version: 1.0\n";
            $headers .= "Content-type: text/html; charset=iso-8859-1\n";
            $headers .= "From: " . $mail_from . "\n";
            mail($mail_to, $subject, $buy_message, $headers);

//End of mail to buyer //
        }
    } // if($item_detail_row[quantity] > 1)
    else if ($item_detail_row['Quantity'] == 1) {
        $item_row = mysql_fetch_array($item_tab);
        $user_id = $item_row['user_id'];
        $amt = $item_row['bidding_amount'];
        $qty = $item_detail_row['Quantity'];
        $solddate = date("Y-m-d G:i:s");

        if ($flag != 1) {
            $update_query = "update placing_bid_item set user_pos='Yes',quantity=$qty where item_id=" . $item_id . " and user_id=" . $user_id;
            $up_status = mysql_query($update_query);
        }

        if ($up_status)
            $flag = 1;
        $update_date = "update placing_bid_item set sale_date='$solddate' where item_id=$item_id";
        mysql_query($update_date);

        $update_query = "update placing_item_bid set status='Closed',quantity=0,quantity_sold=1,sale_price='$amt' where item_id=" . $item_id;
        mysql_query($update_query);

        $up_del = "delete from want_it_now where responseed_itemid=" . $item_id;
        $upsql_del = mysql_query($up_del);

        // Mail to buyer //
        $buy_query = "select * from mail_subjects where mail_id=5";
        $buy_table = mysql_query($buy_query);
        $buy_row = mysql_fetch_array($buy_table);
        $buy_message = $buy_row['mail_message'];
        $mail_from = $buy_row['mail_from'];
        $subject = $buy_row['mail_subject'];

        $query = "select * from user_registration where user_id='$user_id'";
        $mytable = mysql_query($query);
        $myrow = mysql_fetch_array($mytable);
        $higher_user_name = $myrow['user_name'];
        $mail_to = $myrow['email'];

        $buy_message = str_replace("NAME", $higher_user_name, $buy_message);
        $buy_message = str_replace("<ITEM_TITLE>", $item_detail_row['item_title'], $buy_message);
        $buy_message = str_replace("<cur>", $item_detail_row['currency'], $buy_message);
        $buy_message = str_replace("<SALE_PRICE>", $amt, $buy_message);
        $buy_message = str_replace("<QUANTITY>", $qty, $buy_message);
        $buy_message = str_replace("<SHIPPING_COST>", $item_detail_row['currency'] . " " . $item_detail_row['shipping_cost'], $buy_message);
        $buy_message = str_replace("<SALE_TAX>", $item_detail_row['tax'] . "%", $buy_message);
        $buy_message = str_replace("<GET_VIEW_ITEM>", "$site_name/detail.php?item_id=" . $item_id, $buy_message);
        $buy_message = str_replace("<sitename>", $site_name, $buy_message);
        $buy_message = str_replace("<imgh>", $mailheader, $buy_message);
        $buy_message = str_replace("<imgf>", $mailfooter, $buy_message);

        $headers = "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\n";
        $headers .= "From: " . $mail_from . "\n";
        mail($mail_to, $subject, $buy_message, $headers);


//End of mail to buyer //
// mail to seller 

        $useremailid = "select * from user_registration where user_id=" . $_SESSION['userid'];
        $user_email_res = mysql_query($useremailid);
        $user_email_row = mysql_fetch_array($user_email_res);
        $seller_name = $user_email_row['user_name'];
        $mail_to = $user_email_row['email'];

        $mail_query = "select * from mail_subjects where mail_id=18";
        $mail_table = mysql_query($mail_query);
        if ($mail_row = mysql_fetch_array($mail_table)) {
            $message = $mail_row['mail_message'];
            $subject = $mail_row['mail_subject'];
            $mail_from = $mail_row['mail_from'];
        }

        $querybuy = "select * from user_registration where user_id = '$user_id'";
        $tablebuy = mysql_query($querybuy);
        $rowbuy = mysql_fetch_array($tablebuy);
        $buyname = $rowbuy['user_name'];

        $country_sql = "select * from country_master where country_id=" . $rowbuy['country'];
        $country_sqlqry = mysql_query($country_sql);
        $country_fetch = mysql_fetch_array($country_sqlqry);
        $country = $country_fetch['country'];

        $buyer_detail = "<tr><td>Buyer Name</td><td> $buyname </td></tr>";
        $buyer_detail.="<tr><td>Quantity</td><td>$qty</td></tr>";
        $buyer_detail.="<tr><td>Price</td><td>" . $item_detail_row['currency'] . " " . $amt . "</td></tr>";
        $buyer_detail.="<tr><td>Buyer Address</td><td>" . $rowbuy['address'] . "<br>" . $rowbuy['city'] . "<br>" . $rowbuy['state'] . "<br>$country";
        $buyer_detail.="<br>" . $rowbuy['pin_code'] . "</td></tr>";
        $buyer_detail.="<tr><td>Buyer mailid</td><td>" . $rowbuy['email'] . "</td></tr>";

        $seller_name = $_SESSION['username'];
        $message = str_replace("NAME", $_SESSION['username'], $message);
        $message = str_replace("<ITEM_TITLE>", $item_detail_row['item_title'], $message);
        $message = str_replace("<GET_VIEW_ITEM>", "$site_name/detail.php?item_id=" . $item_id, $message);
        $message = str_replace("<Buyer Details>", $buyer_detail, $message);
        $message = str_replace("<sitename>", "$site_name", $message);
        $message = str_replace("<imgh>", $mailheader, $message);
        $message = str_replace("<imgf>", $mailfooter, $message);

        $headers = "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\n";
        $headers .= "From: " . $mail_from . "\n";

        mail($mail_to, $subject, $message, $headers);
// End of mail to seller //
    } //else if($item_detail_row[quantity]==1) 
    //----------------final sale value fee calculation-------------------------
    $finalvalue_admin_sql = "select * from admin_settings where set_id=56"; //sitename -> id=1
    $finalvalue_admin_res = mysql_query($finalvalue_admin_sql);
    $finalvalue_admin_rec = mysql_fetch_array($finalvalue_admin_res);
    $finalvaluefeecalculation = $finalvalue_admin_rec[set_value];

    if ($finalvaluefeecalculation == "Yes" || $finalvaluefeecalculation == "yes") {
        $closing_price = $amt * $qty;
        $endfee_qry = "select * from finalsalevalue_feemaster where $closing_price between closingprice_from and closingprice_to";
        $endfee_exeqry = mysql_query($endfee_qry);
        $endfee_row = mysql_num_rows($endfee_exeqry);
        if ($endfee_row > 0) {
            $endfee_fetch = mysql_fetch_array($endfee_exeqry);
            $endfee_per = $endfee_fetch['percentage'];
        } else {
            $endfee_qry = "select * from finalsalevalue_feemaster order by fid desc";
            $endfee_exeqry = mysql_query($endfee_qry);
            $endfee_fetch = mysql_fetch_array($endfee_exeqry);
            $endfee_per = $endfee_fetch['percentage'];
        }

        $final_fee = ($closing_price * $endfee_per) / 100;


        $auctionfees_sql = "select * from auction_fees where item_id='$item_id'";
        $auctionfees_sqlqry = mysql_query($auctionfees_sql);
        $auctionfees_row = mysql_num_rows($auctionfees_sqlqry);
        if ($auctionfees_row > 0) {
            $ins_final_sql = "update auction_fees set finalsalevalue_fee='$final_fee' where item_id='$item_id'";
            mysql_query($ins_final_sql);
        } else {
            $ins_final_sql = "insert into auction_fees(finalsalevalue_fee,item_id) values('$final_fee','$item_id')";
            mysql_query($ins_final_sql);
        }
    }
    //------------------end of final sale value fee--------------------------
} // if($size > 1)
else if ($size == 0) { // no bidder
    $upsql = "update placing_item_bid set status='Closed' where item_id=" . $item_id;
    mysql_query($upsql);
    $solddate = date("Y-m-d G:i:s");
    $upsql = "update placing_bid_item set sale_date='$solddate' where item_id=" . $item_id;
    mysql_query($upsql);

    $up_del = "delete from want_it_now where responseed_itemid=" . $item_id;
    $upsql_del = mysql_query();

// Mail to Seller(Item closing mail) //
    $mail_query = "select * from mail_subjects where mail_id=12";
    $mail_table = mysql_query($mail_query);
    if ($mail_row = mysql_fetch_array($mail_table)) {
        $message = $mail_row['mail_message'];
        $subject = $mail_row['mail_subject'];
        $mail_from = $mail_row['mail_from'];
    }

    $user_email = "select * from user_registration where user_id=" . $_SESSION['userid'];
    $user_email_res = mysql_query($user_email);
    $user_email_row = mysql_fetch_array($user_email_res);
    $seller_name = $user_email_row['user_name'];
    $mail_to = $user_email_row['email'];

    $item_id = $item_detail_row['item_id'];
    $item_title = $item_detail_row['item_title'];

    $message = str_replace("<sitename>", $site_name, $message);
    $message = str_replace("<sitename>", $site_name, $message);
    $message = str_replace("<username>", $seller_name, $message);
    $message = str_replace("<item_name>", $item_title, $message);
    $message = str_replace("<itemid>", $item_id, $message);
    $message = str_replace("<imgh>", $mailheader, $message);
    $message = str_replace("<imgf>", $mailfooter, $message);

    $headers = "MIME-Version: 1.0\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\n";
    $headers .= "From: " . $mail_from . "\n";
    mail($mail_to, $subject, $message, $headers);

    // End of Mail to Seller(Item closing mail) //
}  //else if($size==0) 
echo '<meta http-equiv="refresh" content="0;url=myauction.php?mode=sell&status=Active">';
exit();
?>