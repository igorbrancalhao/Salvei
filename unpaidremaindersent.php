<?php
/* * *************************************************************************
 * File Name				:unpaidremaindersent.php
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

if (empty($_SESSION['username'])) {
    $link = "signin.php";
    $url = "myauction.php";
    echo '<meta http-equiv="refresh" content="0;url=' . $link . '?url=' . $url . '">';
    echo "You have been Re-Directed, if not please <a href=$link?$url>Click here</a>";
    exit();
}

$bid_id = $_SESSION['dispute_bid_id'];

$bid_sql = "select * from placing_bid_item where  bid_id=" . $bid_id;
$bid_res = mysql_query($bid_sql);
$bid = mysql_fetch_array($bid_res);
$bid_date = $bid['bidding_date'];
$buyerid = $bid['user_id'];

$sell_sql = "select * from placing_item_bid where  item_id=" . $bid['item_id'];
$sell_res = mysql_query($sell_sql);
$sell = mysql_fetch_array($sell_res);

$user_sql = "select * from user_registration where user_id=" . $bid['user_id'];
$user_res = mysql_query($user_sql);
$user = mysql_fetch_array($user_res);

$admin = "SELECT * FROM `admin_settings` WHERE set_id=63";
$admin_res = mysql_query($admin);
$admin_row = mysql_fetch_array($admin_res);

//$title="Better Things Better Price";
require 'include/index_top.php';
?>
<table width="958" cellpadding="0" cellspacing="0" border=0 align="center">
    <tr width=100>
        <td colspan=2 background="images/contentbg1.jpg" height="25">
            <font class="detail3txt"><div align="left">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Unpaid Item Reminder Sent </b>
            </div></font> </td></tr>
    <tr><td colspan="2" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom"  background="images/contentgrad.jpg">
            <table cellpadding="5" cellspacing="5" border=0 align="center">
                <tr><td style="padding-left:10px" class="banner1">An unpaid item reminder has been sent to <a href="feedback.php?user_id=<?php = $user[user_id] ?>" class="style1" style="padding-left:0px"><?php = $user[user_name] ?></a> for the following item:<?php = $sell[item_title] ?> (#<?php = $bid[item_id] ?>) 
                    </td></tr>
                <tr><td style="padding-left:10px" class="banner1">
                        You will need to take additional action before your Final Value Fee is credited. If the buyer does not respond, you will be eligible to receive a Final Value Fee credit 
                        <?php
                        if ($admin_row['set_value'] > 0) {
                            echo $admin_row[set_value];

                            if ($admin_row[set_value] > 1)
                                echo "days";
                            else
                                echo "day";
                        }
                        ?> after this reminder is sent. Learn about this process in eBay's Unpaid Item Policy. 
                    </td></tr> 
                <tr><td style="padding-left:10px" class="banner1"> You will need to take additional action before your Final Value Fee is credited. If the buyer does not respond, you will be eligible to receive a Final Value Fee credit  
                        <?php
                        if ($admin_row[set_value] > 0) {
                            echo $admin_row[set_value];
                            if ($admin_row[set_value] > 1)
                                echo "days";
                            else
                                echo "day";
                        }
                        ?>after this reminder is sent. Learn about this process in <?php = $_SESSION['site_name'] ?>'s </td></tr>
                <tr><td style="padding-left:10px"> </td></tr>

                <tr><td><hr></td></tr>

                <tr><td style="padding-left:10px" class="banner1"> <b> Where would you like to go? </b></td></tr>
                <tr><td style="padding-left:20px"> <a href="viewdispute.php?type=unpaid" class="banner1" style="text-decoration:underline">View Dispute Console</a></td></tr>
                <tr><td style="padding-left:20px"> <a href="myauction.php" class="banner1" style="text-decoration:underline">My auction</a></td></tr>
            </table></td></tr>
</table></td></tr>
<?php require 'include/footer.php'; ?>
