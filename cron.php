<?php

/* * *************************************************************************
 * File Name				:cron.php
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
require 'include/connect.php';

function getDateDifference($dateFrom, $dateTo, $unit = 'd') { // User defined function 
    $difference = null;
    $dateFromElements = split(' ', $dateFrom);
    $dateToElements = split(' ', $dateTo);
    $dateFromDateElements = split('-', $dateFromElements[0]);
    $dateFromTimeElements = split(':', $dateFromElements[1]);
    $dateToDateElements = split('-', $dateToElements[0]);
    $dateToTimeElements = split(':', $dateToElements[1]);
    // Get unix timestamp for both dates
    $date1 = mktime($dateFromTimeElements[0], $dateFromTimeElements[1], $dateFromTimeElements[2], $dateFromDateElements[1], $dateFromDateElements[0], $dateFromDateElements[2]);
    $date2 = mktime($dateToTimeElements[0], $dateToTimeElements[1], $dateToTimeElements[2], $dateToDateElements[1], $dateToDateElements[0], $dateToDateElements[2]);
    if ($date1 > $date2) {
        return null;
    }

    $diff = $date2 - $date1;

    $days = 0;
    $hours = 0;
    $minutes = 0;
    $seconds = 0;

    if ($diff % 86400 <= 0) {  // there are 86,400 seconds in a day
        $days = $diff / 86400;
    }

    if ($diff % 86400 > 0) {
        $rest = ($diff % 86400);
        $days = ($diff - $rest) / 86400;

        if ($rest % 3600 > 0) {
            $rest1 = ($rest % 3600);
            $hours = ($rest - $rest1) / 3600;

            if ($rest1 % 60 > 0) {
                $rest2 = ($rest1 % 60);
                $minutes = ($rest1 - $rest2) / 60;
                $seconds = $rest2;
            } else {
                $minutes = $rest1 / 60;
            }
        } else {
            $hours = $rest / 3600;
        }
    }

    switch ($unit) {
        case 'd':
        case 'D':

            $partialDays = 0;

            $partialDays += ($seconds / 86400);
            $partialDays += ($minutes / 1440);
            $partialDays += ($hours / 24);

            $difference = $days + $partialDays;

            break;

        case 'h':
        case 'H':

            $partialHours = 0;

            $partialHours += ($seconds / 3600);
            $partialHours += ($minutes / 60);

            $difference = $hours + ($days * 24) + $partialHours;

            break;

        case 'm':
        case 'M':

            $partialMinutes = 0;

            $partialMinutes += ($seconds / 60);

            $difference = $minutes + ($days * 1440) + ($hours * 60) + $partialMinutes;

            break;

        case 's':
        case 'S':

            $difference = $seconds + ($days * 86400) + ($hours * 3600) + ($minutes * 60);

            break;

        case 'a':
        case 'A':

            $difference = array(
                "days" => $days,
                "hours" => $hours,
                "minutes" => $minutes,
                "seconds" => $seconds
            );

            break;
    }
    return $difference;
}

$admin = "select * from admin_settings where set_id=3"; //sitename -> id=1
$admin_res = mysql_query($admin);
$admin_rec = mysql_fetch_array($admin_res);
$mail_from = $admin_rec['set_value'];

$site_query = "select * from admin_settings where set_id=1";
$site_table = mysql_query($site_query);
$site_row = mysql_fetch_array($site_table);
$site_name = $site_row['set_value'];

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



$query = "select * from storefronts where to_days(now()) - to_days(store_end_date)>=0";
$table = mysql_query($query);
if (mysql_num_rows($table) != 0) {
    while ($row = mysql_fetch_array($table)) {
        $up_sql = "update storefronts set status='disable',statususer='inactive' where id=" . $row['id'];
        mysql_query($up_sql);
    }
}

$query = "SELECT * FROM `placing_item_bid` WHERE status='Active' and to_days(now()) - to_days(expire_date)>=0";
//$query="SELECT * FROM `placing_item_bid` WHERE status='Active' and item_id=252";
$table = mysql_query($query);
if (mysql_num_rows($table) != 0) {
    $date = date("Y-m-d");
    while ($item_detail_row = mysql_fetch_array($table)) {
        $expire_date = $item_detail_row['expire_date'];
        $item_id = $item_detail_row['item_id'];
        require 'ends.php';
        $reserve_price = $item_detail_row['reserve_price'];
        if ($string_difference == "Duration Expired") {
            $del_query = "update placing_item_bid set status='Closed' where item_id = " . $item_detail_row['item_id'];
            mysql_query($del_query);

            $up_del = "delete from want_it_now where responseed_itemid=" . $item_id;
            $upsql_del = mysql_query($up_del);

            $item_query = "select * from placing_bid_item where item_id =" . $item_detail_row['item_id'] . " and user_pos='No' and deleted='No' order by quantity DESC , bidding_amount DESC ";
            $item_tab = mysql_query($item_query);
            $size = mysql_num_rows($item_tab);
            // if no higer bider process end
            if ($size >= 1) {
                $item_query_det = "select * from placing_bid_item where item_id =" . $item_detail_row['item_id'] . " and user_pos='No' and deleted='No' order by quantity DESC , bidding_amount DESC";
                $item_tab_det = mysql_query($item_query_det);
                $higher_item_det_row = mysql_fetch_array($item_tab_det);
                $single_amount = $higher_item_det_row['bidding_amount'];
                $del_query = "update placing_item_bid set  sale_price='$single_amount' where item_id = " . $item_detail_row['item_id'];
                mysql_query($del_query);
                $higher_item_row = mysql_fetch_array($item_tab);
                $higher_user_id = $higher_item_row['user_id'];
                $higher_quantity = $higher_item_row['quantity'];
                $higher_bid_id = $higher_item_row['bid_id'];
                $amt = $higher_item_row['bidding_amount'];
                if (($reserve_price) && ($reserve_price != 0) && ($reserve_price != '0.00') && (!empty($reserve_price))) {
                    if ($reserve_price <= $higher_item_row['bidding_amount']) {
                        // ------------------------------------ mail to seller ----------------------------------------
                        $useremailid = "select * from user_registration where user_id=" . $item_detail_row['user_id'];
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

                        $querybuy = "select * from user_registration where user_id = '$higher_user_id'";
                        $tablebuy = mysql_query($querybuy);
                        $rowbuy = mysql_fetch_array($tablebuy);
                        $buyname = $rowbuy['user_name'];

                        $country_sql = "select * from country_master where country_id=" . $rowbuy['country'];
                        $country_sqlqry = mysql_query($country_sql);
                        $country_fetch = mysql_fetch_array($country_sqlqry);
                        $country = $country_fetch['country'];

                        $buyer_detail = "<tr><td>Buyer Name</td><td> $buyname </td></tr>";
                        $buyer_detail.="<tr><td>Quantity</td><td>$higher_quantity</td></tr>";
                        $buyer_detail.="<tr><td>Price</td><td>" . $item_detail_row['currency'] . " " . $amt . "</td></tr>";
                        $buyer_detail.="<tr><td>Buyer Address</td><td>" . $rowbuy['address'] . "<br>" . $rowbuy['city'] . "<br>" . $rowbuy['state'] . "<br>$country";
                        $buyer_detail.="<br>" . $rowbuy['pin_code'] . "</td></tr>";
                        $buyer_detail.="<tr><td>Buyer mailid</td><td>" . $rowbuy['email'] . "</td></tr>";

                        $message = str_replace("NAME", $seller_name, $message);
                        $message = str_replace("<ITEM_TITLE>", $item_detail_row['item_title'], $message);
                        $message = str_replace("<GET_VIEW_ITEM>", "$site_name/detail.php?item_id=" . $item_id, $message);
                        $message = str_replace("<Buyer Details>", $buyer_detail, $message);
                        $message = str_replace("<sitename>", $site_name, $message);
                        $message = str_replace("<imgh>", $mailheader, $message);
                        $message = str_replace("<imgf>", $mailfooter, $message);


                        $headers = "MIME-Version: 1.0\n";
                        $headers .= "Content-type: text/html; charset=iso-8859-1\n";
                        $headers .= "From: " . $mail_from . "\n";

                        $mail = mail($mail_to, $subject, $message, $headers);


                        // ------------------------------------ end (mail to seller) ----------------------------------------
                        // ------------------------------------ mail to Buyer ----------------------------------------


                        $buy_query = "select * from mail_subjects where mail_id=5";
                        $buy_table = mysql_query($buy_query);
                        $buy_row = mysql_fetch_array($buy_table);
                        $buy_message = $buy_row['mail_message'];
                        $subject = $buy_row['mail_subject'];
                        $mail_from = $buy_row['mail_from'];


                        $query = "select * from user_registration where user_id='$higher_user_id'";
                        $mytable = mysql_query($query);
                        $myrow = mysql_fetch_array($mytable);
                        $higher_user_name = $myrow['user_name'];
                        $mail_to = $myrow['email'];

                        $buy_message = str_replace("NAME", $higher_user_name, $buy_message);
                        $buy_message = str_replace("<ITEM_TITLE>", $item_detail_row['item_title'], $buy_message);
                        $buy_message = str_replace("<cur>", $item_detail_row['currency'], $buy_message);
                        $buy_message = str_replace("<SALE_PRICE>", $amt, $buy_message);
                        $buy_message = str_replace("<QUANTITY>", $higher_quantity, $buy_message);
                        $buy_message = str_replace("<SHIPPING_COST>", $item_detail_row['currency'] . " " . $item_detail_row['shipping_cost'], $buy_message);
                        $buy_message = str_replace("<SALE_TAX>", $item_detail_row['tax'], $buy_message);
                        $buy_message = str_replace("<GET_VIEW_ITEM>", "$site_name/detail.php?item_id=" . $item_detail_row['item_id'], $buy_message);
                        $buy_message = str_replace("<sitename>", $site_name, $buy_message);
                        $buy_message = str_replace("<imgh>", $mailheader, $buy_message);
                        $buy_message = str_replace("<imgf>", $mailfooter, $buy_message);


                        $headers = "MIME-Version: 1.0\n";
                        $headers .= "Content-type: text/html; charset=iso-8859-1\n";
                        $headers .= "From: " . $mail_from . "\n";
                        $mail = mail($mail_to, $subject, $buy_message, $headers);


                        // ------------------------------------ end (mail to Buyer) ----------------------------------------
                        //----------------final sale value fee calculation-------------------------
                        $finalvalue_admin_sql = "select * from admin_settings where set_id=56"; //sitename -> id=1
                        $finalvalue_admin_res = mysql_query($finalvalue_admin_sql);
                        $finalvalue_admin_rec = mysql_fetch_array($finalvalue_admin_res);
                        $finalvaluefeecalculation = $finalvalue_admin_rec[set_value];

                        if ($finalvaluefeecalculation == "Yes" || $finalvaluefeecalculation == 'yes') {
                            $closing_price = $amt;
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


                            $auctionfees_sql = "select * from auction_fees where item_id=" . $item_detail_row['item_id'];
                            $auctionfees_sqlqry = mysql_query($auctionfees_sql);
                            $auctionfees_row = mysql_num_rows($auctionfees_sqlqry);
                            if ($auctionfees_row > 0) {
                                $ins_final_sql = "update auction_fees set finalsalevalue_fee='$final_fee' where item_id=" . $item_detail_row['item_id'];
                                mysql_query($ins_final_sql);
                            } else {
                                $ins_final_sql = "insert into auction_fees(finalsalevalue_fee,item_id) values('$final_fee','$item_detail_row[item_id]')";
                                mysql_query($ins_final_sql);
                            }
                        }

                        //----------------End of Final Sale Value Fee Calculation-------------------------
                        /// -------------------   mail send to seller my messeges     -------------------------------------------------------------

                        $date = date("Y-m-d");

                        $inbox_sql = "insert into ask_question(from_id,item_id,date,question,to_id,status) values('1','$item_detail_row[item_id]','$date','$message','$seller_id','unread')";
                        mysql_query($inbox_sql);



                        /// -------------------    end of mail send to seller my messeges   --------------------------------------------------
// updation

                        $solddate = date("Y-m-d G:i:s");
                        //nowcheck//$update_query ="update placing_bid_item set 		user_pos='Yes',bidding_amount='$single_amount',sale_date='$solddate',quantity=$higher_quantity  where user_id='$higher_user_id' and item_id=$item_detail_row[item_id]";
                        $update_query = "update placing_bid_item set user_pos='Yes' where user_id='$higher_user_id' and item_id=$item_detail_row[item_id]";
                        mysql_query($update_query);

                        $update_query = "update placing_item_bid set Quantity=Quantity-$higher_quantity,quantity_sold=quantity_sold+$higher_quantity  where item_id=$item_detail_row[item_id]";
                        mysql_query($update_query);

                        $update_query = "update placing_bid_item set sale_date='$solddate' where item_id=$item_detail_row[item_id]";
                        mysql_query($update_query);
                    } //  if($reserve_price <= $higher_item_row[bidding_amount])
                    else if ($reserve_price > $higher_item_row['bidding_amount']) {
                        // mail to buyer (reserve price has not been met )
                        $mail_query = "select * from mail_subjects where mail_id=11";
                        $mail_table = mysql_query($mail_query);
                        if ($mail_row = mysql_fetch_array($mail_table)) {
                            $message = $mail_row['mail_message'];
                            $subject = $mail_row['mail_subject'];
                            $mailfrom = $mail_row['mail_from'];
                        }

                        $sql_buyers = "select * from placing_bid_item where item_id=" . $item_detail_row['item_id'] . " group by user_id";
                        $sqlqry_buyers = mysql_query($sql_buyers);
                        while ($fetch_buyers = mysql_fetch_array($sqlqry_buyers)) {
                            $user_email = "select * from user_registration where user_id=" . $fetch_buyers['user_id'];
                            $user_email_res = mysql_query($user_email);
                            $user_email_row = mysql_fetch_array($user_email_res);
                            $bidder_name = $user_email_row['user_name'];
                            $mail_to = $user_email_row['email'];

                            $item_id = $item_detail_row['item_id'];
                            $item_title = $item_detail_row['item_title'];

                            $message = str_replace("<username>", $bidder_name, $message);
                            $message = str_replace("<itemname>", $item_title, $message);
                            $message = str_replace("<itemid>", $item_id, $message);
                            $message = str_replace("<imgh>", $mailheader, $message);
                            $message = str_replace("<imgf>", $mailfooter, $message);


                            $headers = "MIME-Version: 1.0\n";
                            $headers .= "Content-type: text/html; charset=iso-8859-1\n";
                            $headers .= "From: " . $mail_from . "\n";

                            mail($mail_to, $subject, $message, $headers);
                        }
                        // mail to Seller  //
                        $mail_query = "select * from mail_subjects where mail_id=13";
                        $mail_table = mysql_query($mail_query);
                        if ($mail_row = mysql_fetch_array($mail_table)) {
                            $message = $mail_row['mail_message'];
                            $subject = $mail_row['mail_subject'];
                            $mail_from = $mail_row['mail_from'];
                        }
                        $user_email = "select * from user_registration where user_id=" . $item_detail_row['user_id'];
                        $user_email_res = mysql_query($user_email);
                        $user_email_row = mysql_fetch_array($user_email_res);
                        $seller_name = $user_email_row['user_name'];
                        $sell_mail_to = $user_email_row['email'];

                        $item_id = $item_detail_row['item_id'];
                        $item_title = $item_detail_row['item_title'];

                        $message = str_replace("<username>", $seller_name, $message);
                        $message = str_replace("<itemname>", $item_title, $message);
                        $message = str_replace("<itemid>", $item_id, $message);
                        $message = str_replace("<imgh>", $mailheader, $message);
                        $message = str_replace("<imgf>", $mailfooter, $message);


                        $headers = "MIME-Version: 1.0\n";
                        $headers .= "Content-type: text/html; charset=iso-8859-1\n";
                        $headers .= "From: " . $mail_from . "\n";

                        mail($sell_mail_to, $subject, $message, $headers);
                    }
                }   // if($reserve_price)
                else { // mail to seller (reserve price has not been met)
                    // ------------------------------------ mail to seller ----------------------------------------
                    $useremailid = "select * from user_registration where user_id=" . $item_detail_row['user_id'];
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

                    $querybuy = "select * from user_registration where user_id = '$higher_user_id'";
                    $tablebuy = mysql_query($querybuy);
                    $rowbuy = mysql_fetch_array($tablebuy);
                    $buyname = $rowbuy['user_name'];

                    $country_sql = "select * from country_master where country_id=" . $rowbuy['country'];
                    $country_sqlqry = mysql_query($country_sql);
                    $country_fetch = mysql_fetch_array($country_sqlqry);
                    $country = $country_fetch['country'];

                    $buyer_detail = "<tr><td>Buyer Name</td><td> $buyname </td></tr>";
                    $buyer_detail.="<tr><td>Quantity</td><td>$higher_quantity</td></tr>";
                    $buyer_detail.="<tr><td>Price</td><td>" . $item_detail_row['currency'] . " " . $amt . "</td></tr>";
                    $buyer_detail.="<tr><td>Buyer Address</td><td>" . $rowbuy['address'] . "<br>" . $rowbuy['city'] . "<br>" . $rowbuy['state'] . "<br>$country";
                    $buyer_detail.="<br>" . $rowbuy['pin_code'] . "</td></tr>";
                    $buyer_detail.="<tr><td>Buyer mailid</td><td>" . $rowbuy['email'] . "</td></tr>";

                    $message = str_replace("NAME", $seller_name, $message);
                    $message = str_replace("<ITEM_TITLE>", $item_detail_row['item_title'], $message);
                    $message = str_replace("<GET_VIEW_ITEM>", "$site_name/detail.php?item_id=" . $item_id, $message);
                    $message = str_replace("<Buyer Details>", $buyer_detail, $message);
                    $message = str_replace("<sitename>", $site_name, $message);
                    $message = str_replace("<imgh>", $mailheader, $message);
                    $message = str_replace("<imgf>", $mailfooter, $message);


                    $headers = "MIME-Version: 1.0\n";
                    $headers .= "Content-type: text/html; charset=iso-8859-1\n";
                    $headers .= "From: " . $mail_from . "\n";

                    $mail = mail($mail_to, $subject, $message, $headers);


                    // ------------------------------------ end (mail to seller) ----------------------------------------
                    // ------------------------------------ mail to Buyer ----------------------------------------


                    $buy_query = "select * from mail_subjects where mail_id=5";
                    $buy_table = mysql_query($buy_query);
                    $buy_row = mysql_fetch_array($buy_table);
                    $buy_message = $buy_row['mail_message'];
                    $subject = $buy_row['mail_subject'];
                    $mail_from = $buy_row['mail_from'];


                    $query = "select * from user_registration where user_id='$higher_user_id'";
                    $mytable = mysql_query($query);
                    $myrow = mysql_fetch_array($mytable);
                    $higher_user_name = $myrow['user_name'];
                    $mail_to = $myrow['email'];

                    $buy_message = str_replace("NAME", $higher_user_name, $buy_message);
                    $buy_message = str_replace("<ITEM_TITLE>", $item_detail_row['item_title'], $buy_message);
                    $buy_message = str_replace("<cur>", $item_detail_row['currency'], $buy_message);
                    $buy_message = str_replace("<SALE_PRICE>", $amt, $buy_message);
                    $buy_message = str_replace("<QUANTITY>", $higher_quantity, $buy_message);
                    $buy_message = str_replace("<SHIPPING_COST>", $item_detail_row['currency'] . " " . $item_detail_row['shipping_cost'], $buy_message);
                    $buy_message = str_replace("<SALE_TAX>", $item_detail_row['tax'], $buy_message);
                    $buy_message = str_replace("<GET_VIEW_ITEM>", "$site_name/detail.php?item_id=" . $item_id, $buy_message);
                    $buy_message = str_replace("<sitename>", $site_name, $buy_message);
                    $buy_message = str_replace("<imgh>", $mailheader, $buy_message);
                    $buy_message = str_replace("<imgf>", $mailfooter, $buy_message);


                    $headers = "MIME-Version: 1.0\n";
                    $headers .= "Content-type: text/html; charset=iso-8859-1\n";
                    $headers .= "From: " . $mail_from . "\n";
                    $mail = mail($mail_to, $subject, $buy_message, $headers);


                    // ------------------------------------ end (mail to Buyer) ----------------------------------------
                    //----------------final sale value fee calculation-------------------------
                    $finalvalue_admin_sql = "select * from admin_settings where set_id=56"; //sitename -> id=1
                    $finalvalue_admin_res = mysql_query($finalvalue_admin_sql);
                    $finalvalue_admin_rec = mysql_fetch_array($finalvalue_admin_res);
                    $finalvaluefeecalculation = $finalvalue_admin_rec[set_value];

                    if ($finalvaluefeecalculation == "Yes" || $finalvaluefeecalculation == "yes") {
                        $closing_price = $amt;
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


                        $auctionfees_sql = "select * from auction_fees where item_id=" . $item_detail_row['item_id'];
                        $auctionfees_sqlqry = mysql_query($auctionfees_sql);
                        $auctionfees_row = mysql_num_rows($auctionfees_sqlqry);
                        if ($auctionfees_row > 0) {
                            $ins_final_sql = "update auction_fees set finalsalevalue_fee='$final_fee' where item_id=" . $item_detail_row['item_id'];
                            mysql_query($ins_final_sql);
                        } else {
                            $ins_final_sql = "insert into auction_fees(finalsalevalue_fee,item_id) values('$final_fee','$item_detail_row[item_id]')";
                            mysql_query($ins_final_sql);
                        }
                    }

                    //----------------End of Final Sale Value Fee Calculation-------------------------
                    /// -------------------   mail send to seller my messeges     -------------------------------------------------------------

                    $date = date("Y-m-d");
                    $inbox_sql = "insert into ask_question(from_id,item_id,date,question,to_id,status) values('1','$item_id','$date','$message','$seller_id','unread')";
                    mysql_query($inbox_sql);

                    /// -------------------    end of mail send to seller my messeges   --------------------------------------------------


                    $solddate = date("Y-m-d G:i:s");
                    //nowcheck//	$update_query ="update placing_bid_item set 		user_pos='Yes',bidding_amount='$single_amount',sale_date='$solddate',quantity=$higher_quantity  where user_id='$higher_user_id' and item_id=".$item_detail_row['item_id'];
                    $update_query = "update placing_bid_item set user_pos='Yes' where user_id='$higher_user_id' and item_id=" . $item_detail_row['item_id'];
                    mysql_query($update_query);
                    $update_query = "update placing_item_bid set Quantity=Quantity-$higher_quantity,quantity_sold=quantity_sold+$higher_quantity  where item_id=" . $item_detail_row['item_id'];
                    mysql_query($update_query);

                    $update_query = "update placing_bid_item set sale_date='$solddate' where item_id=$item_detail_row[item_id]";
                    mysql_query($update_query);
                }
            } //  if($size >= 1)
            else { // no bidder  
                // Mail to Seller(Item closing mail) //
                $mail_query = "select * from mail_subjects where mail_id=12";
                $mail_table = mysql_query($mail_query);
                if ($mail_row = mysql_fetch_array($mail_table)) {
                    $message = $mail_row['mail_message'];
                    $subject = $mail_row['mail_subject'];
                    $mail_from = $mail_row['mail_from'];
                }

                $user_email = "select * from user_registration where user_id=" . $item_detail_row['user_id'];
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
            } // no bidder  
        } // $string_diference
    } //if(mysql_num_rows($table)!=0)
}








/* Automatic Relisting */
/* function AddDays($date,$interval) 
  {
  if (!isset($date))
  $date = date("Y-m-d");
  $elts = explode("-", $date);
  $inter=$interval*24*3600;
  $dcour=mktime(1,0,0,$elts[1],$elts[2],$elts[0]);
  $dres=$dcour+$inter;
  $date1=date("Y-m-d",$dres);
  $sec=date("G:i:s");
  $ret_date="$date1"." "."$sec";
  return $ret_date;
  }

  $query="SELECT * FROM `placing_item_bid` WHERE status='Closed' and Quantity>0 and quantity_sold=0 and no_of_repost >= 1";
  $tab=mysql_query($query);
  while($rowrelist=mysql_fetch_array($tab))
  {
  $date=$rowrelist['expire_date'];
  $dur=$rowrelist['duration'];
  $expiredate=adddays($date,$dur);
  $item_id= $rowrelist['item_id'];
  $query="update placing_item_bid set expire_date='$expiredate',status='Active',no_of_repost=no_of_repost - 1 where item_id=".$item_id;
  mysql_query($query);
  } */

//---------------------  old item clean up---------------------------------------


/* $admin_old_items="select * from admin_settings where set_id=20";
  $admin_old_res=mysql_query($admin_old_items);
  $admin_old_row=mysql_fetch_array($admin_old_res);

  $old="select * from placing_item_bid where (todays(now()) - todays(expire_date) ) >= ".$admin_old_row['set_value'];
  $old_res=mysql_query($old);
  while($old_row=mysql_fetch_array(old_res))
  {
  $del="delete  from placing_item_bid where item_id=".$old_row[item_id];
  $del_sql=mysql_query($del);

  $del="delete  from placing_bid_item where item_id=".$old_row[item_id];
  $del_sql=mysql_query($del);

  } */

// ----------------------------------------------------------------------
?>