<?php

/* * *************************************************************************
 * File Name				:download.php
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

function cleanData(&$str) {
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\n/", "\\n", $str);
}

# file name for download 
$filename = "Openedauction" . date('Ymd') . ".xls";
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");

require 'include/connect.php';
require 'include/getdatedifference.php';
$mode = $_REQUEST['mode'];
$id = $_REQUEST['id'];
$datefrm = $_REQUEST['txtdatefrom'];
$dateto = $_REQUEST['txtdateto'];
// $mode="Closed";
//$id="2";

$admin = "select * from admin_settings where set_id=1"; //sitename -> id=1
$admin_res = mysql_query($admin);
$admin_rec = mysql_fetch_array($admin_res);
$site_name = $admin_rec[set_value];

$member_sql = "select * from user_registration where user_id=$id";
$member_result = mysql_query($member_sql);
$member_row = mysql_fetch_array($member_result);
$username = $member_row['user_name'];
$sell_sql = "select * from placing_item_bid where user_id=$id and status='Active'";
if ($mode == 'Active') {
    if (!empty($datefrm) and $dateto) {
        $sell_sql = "select * from placing_item_bid where user_id=$id and status='Active' and selling_method!='want_it_now' and selling_method!='ads' and  bid_starting_date between '$datefrm' and '$dateto' group by item_id ";
    } else if ($datefrm) {
        $sell_sql = "select * from placing_item_bid where user_id=$id and status='Active' and selling_method!='want_it_now' and selling_method!='ads'  and  bid_starting_date='$datefrm' group by item_id ";
    } else if ($dateto) {
        $sell_sql = "select * from placing_item_bid where user_id=$id and status='Active' and selling_method!='want_it_now' and selling_method!='ads'  and  bid_starting_date='$dateto' group by item_id ";
    } else {
        $sell_sql = "select * from placing_item_bid where user_id=$id and status='Active' and selling_method!='want_it_now' and selling_method!='ads'  ";
    }
} else if ($mode == 'sold') {

    if (!empty($datefrm) and $dateto) {

        //	select * from placing_bid_item a,placing_item_bid b where b.user_id=$user_id and a.item_id=b.item_id and quantity_sold > 0 and b.selling_method!='want_it_now' and (user_pos='Yes' or user_pos='Delete') group by b.item_id order by  sale_date desc

        $sell_sql = "select * from placing_bid_item a,placing_item_bid b where b.selling_method!='want_it_now' and  b.user_id=$id and a.item_id=b.item_id and (a.user_pos='Yes' or a.user_pos='Delete') and  sale_date between '$datefrm' and '$dateto' group by a.item_id order by  sale_date desc";
    } else if ($datefrm) {
        $sell_sql = "select * from placing_bid_item a,placing_item_bid b where b.selling_method!='want_it_now' and  b.user_id=$id and a.item_id=b.item_id and (a.user_pos='Yes' or a.user_pos='Delete') and sale_date='$datefrm' group by a.item_id order by  sale_date desc";
    } else if ($dateto) {
        $sell_sql = "select * from placing_bid_item a,placing_item_bid b where b.selling_method!='want_it_now' and  b.user_id=$id and a.item_id=b.item_id and (a.user_pos='Yes' or a.user_pos='Delete') and sale_date='$dateto' group by a.item_id ";
    } else {
        $sell_sql = "select * from placing_bid_item a,placing_item_bid b where b.selling_method!='want_it_now' and  b.user_id=$id and a.item_id=b.item_id and (a.user_pos='Yes' or a.user_pos='Delete') group by a.item_id ";
    }
} else if ($mode == 'Closed') {
    if (!empty($datefrm) and $dateto) {
        $sell_sql = "select * from placing_item_bid where user_id=$id and status='Closed' and quantity_sold=0 and selling_method!='want_it_now' and  bid_starting_date between '$datefrm' and '$dateto' group by item_id ";
    } else if ($datefrm) {
        $sell_sql = "select * from placing_item_bid where user_id=$id and status='Closed' and quantity_sold=0 and selling_method!='want_it_now' and bid_starting_date='$datefrm' group by item_id ";
    } else if ($dateto) {
        $sell_sql = "select * from placing_item_bid where user_id=$id and status='Closed' and quantity_sold=0 and selling_method!='want_it_now' and bid_starting_date='$dateto' group by item_id ";
    } else {
        $sell_sql = "select * from placing_item_bid where user_id=$id and status='Closed' and selling_method!='want_it_now' and quantity_sold=0 group by item_id ";
    }
}


$res = mysql_query($sell_sql);
$num = mysql_num_rows($res);



if ($num <= 0) {
    echo "No Records Found";
} else {
    $i = 0;
    while ($row = mysql_fetch_array($res)) {

        $user_sql = "select * from user_registration where user_id=" . $row['user_id'];
        $user_res = mysql_query($user_sql);
        $user = mysql_fetch_array($user_res);
        $item_id = $row['item_id'];
        $bid_sql = "select * from placing_bid_item where item_id=" . $item_id . " and deleted='No'";
        $bid_res = mysql_query($bid_sql);
        $bid = mysql_fetch_array($bid_res);
        $total_bid = mysql_num_rows($bid_res);
        $bid_date = $bid['bidding_date'];
        $current_price = $row['cur_price'];
        $tot_sql = "select count(*) from placing_bid_item where item_id=" . $item_id . " and deleted='No'";
        $tot_res = mysql_query($tot_sql);
        $tot = mysql_fetch_array($tot_res);
        $expire_date = $row['expire_date'];
        $url = "$site_name" . "detail.php?item_id=$item_id";



        if ($mode == 'sold') {
            $val[] = array("Item_title" => $row['item_title'], "Date_Sold" => $row['sale_date'], "Sale_Amount" => $row['sale_price'], "Quantity" => $row['quantity_sold'], "Sales Tax" => $row['tax'] . "%", "shipping Amount" => $row['shipping_route'], "No_of_Bids" => $total_bid, "Auction_Url" => $url);
        } else {
            $val[] = array("Item_title" => $row['item_title'], "Auction_Start_Date" => $row['bid_starting_date'], "Auction_End_Date" => $row['expire_date'], "No_of_Bids" => $total_bid, "Auction_Url" => $url);
        }
    }


    $flag = false;
    foreach ($val as $row) {

        if (!$flag) {
            # display field/column names as first row 
            echo implode("\t", array_keys($row)) . "\n";
            $flag = true;
        }

        array_walk($row, 'cleanData');
        echo implode("\t", array_values($row)) . "\n";
    }
    exit;
}
?>