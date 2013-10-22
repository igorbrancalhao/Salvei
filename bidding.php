<?php

/* * *************************************************************************
 * File Name				:bidconfirm.php
 * File Created			:Wednesday, June 21, 2006
 * File Last Modified	:Wednesday, June 21, 2006
 * Copyright			:(C) 2001 AJ Square Inc
 * Email				:licence@ajsquare.net
 * Software Language	:PHP
 * Version Created		:V 4.3.2
 * Programmers worked	:S.Priya, B.ReenaKumari, K.Shanmuga priya
 * Modified By          :B.Reena
 * $Id                  : memberlist.php,v 1.36.2.12 2006/02/07 20:42:51 grahamje Exp $
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
$title = "Bidding";
require 'include/top.php';
require 'include/connect.php';
$flag = $_POST['flag'];
$max_bid = $_POST['max_bid'];
$item_id = $_REQUEST['item_id'];
$chk = $_REQUEST['chk'];
$qty = $_POST['qty'];

if (empty($_SESSION['userid'])) {
    echo '<meta http-equiv="refresh" content="0;url=signin.php?url=bidding.php&item_id=' . $item_id . '">';
    exit();
}
if ($item_id == '') {
    echo '<meta http-equiv="refresh" content="0;url=sorry.php">';
    exit();
}

$sql_user_status = "select status from user_registration where user_id=" . $_SESSION['userid'];
$sqlqry_user_status = mysql_query($sql_user_status);
$sqlfetch_user_status = mysql_fetch_array($sqlqry_user_status);
$userstatus = $sqlfetch_user_status[0];
if ($userstatus == 'suspended') {
    echo '<meta http-equiv="refresh" content="0;url=suspendmode.php">';
    exit();
}



$user_id = $_SESSION['userid'];
if ($_SESSION['userid']) {
    $member_acc = "select * from user_registration where user_id=" . $_SESSION['userid'];
    $memebr_rec = mysql_query($member_acc);
    $member_res = mysql_fetch_array($memebr_rec);
} //if($_SESSION[userid])
$sql_user = "select * from placing_item_bid where item_id=$item_id ";
$res_user = mysql_query($sql_user);
$row_user = mysql_fetch_array($res_user);
if ($row_user['selling_method'] == "auction" or $row_user['selling_method'] == "dutch_auction") {

    $bid_sql = "select * from placing_bid_item where item_id=$item_id and deleted='No'";
    $bid_res = mysql_query($bid_sql);
    $bid_row = mysql_fetch_array($bid_res);
    if (!empty($bid_row['item_id'])) {
        $bid_sql1 = "select MAX(bidding_amount) as amt from placing_bid_item where item_id=$item_id and deleted='No'";
        $bid_res1 = mysql_query($bid_sql1);
        $bid_row1 = mysql_fetch_array($bid_res1);
        $noofbids = mysql_num_rows($bid_res);
        $max_bid_amt_dis = $bid_row1[0];
//$max_bid_amt_dis=$row_user['min_bid_amount']+($noofbids*$row_user[bid_increment]);
    } else {
        $max_bid_amt_dis = $row_user['min_bid_amount'];
    }

    if ($flag == 1) {
        if (isset($user_id)) {
            if ($row_user['user_id'] == $user_id) {
                $err_flag = 1;
                $select_sql = "select * from error_message where err_id =34";
                $select_tab = mysql_query($select_sql);
                $select_row = mysql_fetch_array($select_tab);
                $err_message = '<b>' . $select_row['err_msg'] . '</b>';
            } else if ($row_user['user_id'] != $user_id) {
                $bid_sql = "select * from placing_bid_item where item_id=$item_id and deleted='No'";
                $bid_res = mysql_query($bid_sql);
                $bid_row = mysql_fetch_array($bid_res);
                if (mysql_num_rows($bid_res) > 0) {
                    $bid_sql1 = "select MAX(bidding_amount) as amt from placing_bid_item where item_id=$item_id and deleted='No'";
                    $bid_res1 = mysql_query($bid_sql1);
                    $bid_row1 = mysql_fetch_array($bid_res1);
                    $max_bid_amt = $bid_row1['amt'] + $row_user['bid_increment'];
                    $noofbids = mysql_num_rows($bid_res);
                } else {
                    $max_bid_amt = $row_user['min_bid_amount'] + $row_user['bid_increment'];
                }
                if (!is_numeric($max_bid)) {
                    $err_flag = 1;
                    $select_sql = "select * from error_message where err_id =27";
                    $select_tab = mysql_query($select_sql);
                    $select_row = mysql_fetch_array($select_tab);
                    $err_message = '<b>' . $select_row['err_msg'] . '</b>';
                }
            }



            if ($err_flag != 1) {
                $query_site = "select * from admin_settings where set_id = 1";
                $table_site = mysql_query($query_site);
                $fetch_site = mysql_fetch_array($table_site);
                $site_name = $fetch_site['set_value'];

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

                if ($max_bid >= $max_bid_amt) {
                    $date1 = date('Y-m-d');
                    $ex = "select * from placing_bid_item where user_id=$user_id and item_id=$item_id and deleted='No'";
                    $ex_res = mysql_query($ex);
                    $ex_row = mysql_num_rows($ex_res);
                    $high_bid_inc_sql = "select * from placing_bid_item where item_id=$item_id and bidding_amount > $max_bid and deleted='No'";
                    $high_bid_inc_res = mysql_query($high_bid_inc_sql);
                    $high_bid_inc_row = mysql_num_rows($high_bid_inc_res);
                    if ($high_bid_inc_row > 0) {
                        while ($high_bid_inc_result = mysql_fetch_array($high_bid_inc_res)) {
                            $dup_amt = $row_user['bid_increment'];
                            $highest_id_sql = "select max(bidding_amount) from placing_bid_item where item_id=$item_id and user_id=" . $high_bid_inc_result['user_id'] . " and deleted='No'";
                            $highest_id_res = mysql_query($highest_id_sql);
                            $highest_id_row = mysql_fetch_array($highest_id_res);
                            $highest_amt = $highest_id_row[0];

                            $highest_id_sql = "select * from placing_bid_item where item_id=$item_id and  bidding_amount=$highest_amt and user_id=" . $high_bid_inc_result[user_id] . " and deleted='No'";
                            $highest_id_res = mysql_query($highest_id_sql);
                            $highest_id_row = mysql_fetch_array($highest_id_res);
                            $highest_id = $highest_id_row['bid_id'];

                            $update_higher = "update placing_bid_item set duplicate_bidding_amt=$max_bid where bid_id=$highest_id";
                            mysql_query($update_higher);
                        }
                    }


// end of higher bid increment

                    $bid_ins = "insert into placing_bid_item(item_id,user_id,bidding_amount,bidding_date,quantity,duplicate_bidding_amt) values($item_id,$user_id,$max_bid,'$date1',$qty,'$max_bid')";
                    $ins = mysql_query($bid_ins);

                    // Updation of current price //

                    $up_curprice = "update placing_item_bid set cur_price='$max_bid' where item_id=$item_id";
                    $upqry_curprice = mysql_query($up_curprice);



// check the bid
                    $chk = $_POST['chk'];
                    if ($chk == 'chk') {
                        $updsql = "update placing_bid_item set checkbid='yes' where item_id=$item_id and user_id=$user_id";
                        $updexe = mysql_query($updsql);
                    }




                    if (($row_user['reserve_price']) && ($row_user['reserve_price'] != '0.00')) {
                        if ($row_user['reserve_price'] <= $max_bid) {

                            $reserve_query = "select * from mail_subjects where mail_id=9";
                            $reserve_table = mysql_query($reserve_query);
                            if ($reserve_row = mysql_fetch_array($reserve_table)) {
                                $message = $reserve_row['mail_message'];
                                $subject = $reserve_row['mail_subject'];
                                $admin_mail_id = $reserve_row['mail_from'];
                            }

                            $query = "select * from user_registration where user_id =" . $row_user['user_id'];
                            $table = mysql_query($query);
                            if ($sell_row = mysql_fetch_array($table)) {
                                $seller_name = $sell_row['user_name'];
                                $seller_email = $sell_row['email'];
                                $mail_to = $seller_email;
                            }

                            /* $query="select * from admin_settings where set_id = 3";
                              $table=mysql_query($query);
                              if($row1=mysql_fetch_array($table))
                              $admin_mail_id = $row1['set_value']; */


                            $message = str_replace("<sellername>", $seller_name, $message);
                            $message = str_replace("<itemname>", $row_user['item_title'], $message);
                            $message = str_replace("<itemid>", $item_id, $message);
                            $message = str_replace("ITEM_ID", $item_id, $message);
                            $message = str_replace("ITEM_TITLE", $row_user['item_title'], $message);
                            $message = str_replace("SALE_PRICE", $row_user['currency'] . " " . $max_bid, $message);
                            $message = str_replace("RESERVE_PRICE", $row_user['currency'] . " " . $row_user['reserve_price'], $message);
                            $message = str_replace("<sitename>", $site_name, $message);
                            $message = str_replace("<imgh>", $mailheader, $message);
                            $message = str_replace("<imgf>", $mailfooter, $message);


                            $headers = "MIME-Version: 1.0\n";
                            $headers .= "Content-type: text/html; charset=iso-8859-1\n";
                            $headers .= "From: " . $admin_mail_id . "\n";

                            $mail = mail($mail_to, $subject, $message, $headers);
                        }
                    }

// mail to buyer(outbid)
                    $sql = "select *from placing_bid_item where checkbid='yes' and item_id=$item_id and deleted='No' and user_id!=$user_id group by user_id";
                    $exe = mysql_query($sql);
                    while ($ret = mysql_fetch_array($exe)) {
                        $sql1 = "select * from user_registration where user_id=" . $ret['user_id'];
                        $exe1 = mysql_query($sql1);
                        $selret = mysql_fetch_array($exe1);
                        $emailid = $selret['email'];
                        $receiver = $selret['user_name'];

                        $mail_query = "select * from mail_subjects where mail_id=14";
                        $mail_res = mysql_query($mail_query);
                        if ($outbid_mail_row = mysql_fetch_array($mail_res)) {
                            $message = $outbid_mail_row['mail_message'];
                            $subject = $outbid_mail_row['mail_subject'];
                            $fromid = $outbid_mail_row['mail_from'];
                        }

                        $message = str_replace("<user>", $receiver, $message);
                        $message = str_replace("<item_id>", $item_id, $message);
                        $message = str_replace("<sitename>", $site_name, $message);
                        $message = str_replace("<imgh>", $mailheader, $message);
                        $message = str_replace("<imgf>", $mailfooter, $message);

                        $headers = "MIME-Version: 1.0\n";
                        $headers .= "Content-type: text/html; charset=iso-8859-1\n";
                        $headers .= "From: " . $fromid . "\n";
                        mail($emailid, $subject, $message, $headers);
// End of Outbid mail
                    }

                    $alert_ins = "insert into user_alert(item_id,seller_id,buyer_id,date,alert_type) values($item_id,$row_user[user_id],'$_SESSION[userid]','$date1','R')";
                    $alert_exe = mysql_query($alert_ins);

                    echo '<meta http-equiv="refresh" content="0;url=bidconfirm.php?item_id=' . $item_id . '&max_bid=' . $max_bid . '">';
                    echo "<font size=+1 color=#003366>Loading....</font>";
                    exit();
                } else { //if($max_bid>=$max_bid_amt)
                    if (empty($err)) {
                        $select_sql = "select * from error_message where err_id =47";
                        $select_tab = mysql_query($select_sql);
                        $select_row = mysql_fetch_array($select_tab);
                        $err = '<b>' . $select_row['err_msg'] . '</b>';
                    }
                }
            } // if($err_flag!=1)
            else {
                $err_flag == 0;
            }
        }
    }

    $sql = "select * from placing_item_bid where item_id=$item_id";
    $res = mysql_query($sql);
    $row = mysql_fetch_array($res);
    $count = $row['Quantity'] - $row['quantity_sold'];
    require 'templates/main_bid.tpl';
} else { // if($row_user[selling_method]=="auction")
    require 'fixed_price_sale.php';
}
?>
<script language="javascript">
    function validate()
    {
        if (document.bid.max_bid.value == "")
        {
            alert("Please enter the Max bid amount");
            document.bid.max_bid.focus();
            return false;
        }
        if (document.bid.qty.value == "Quantity")
        {
            alert("Please select the Quantity");
            document.bid.qty.focus();
            return false;
        }
        document.bid.flag.value = 1;
        return true;
    }

    function quick(s1)
    {
//window.location.href="quick.php?item_id="+s1;
        if (document.bid.qty.value == "Quantity")
        {
            alert("Please select the Quantity");
            document.bid.qty.focus();
            return false;
        }
        document.bid.action = "quick.php";
        document.bid.submit();
    }
</script>
<?php

require 'include/footer.php';
?>
