<?php
/* * *************************************************************************
 * File Name				:unpaiddispute.php
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
error_reporting(0);
require 'include/connect.php';

if (empty($_SESSION[username])) {
    $link = "signin.php";
    $url = "myauction.php";
    echo '<meta http-equiv="refresh" content="0;url=' . $link . '?url=' . $url . '">';
    echo "You have been Re-Directed, if not please <a href=$link?$url>Click here</a>";
    exit();
}

$bid_id = $_REQUEST[bid_id];
$bid_sql = "select * from placing_bid_item where  bid_id=" . $bid_id;
$bid_res = mysql_query($bid_sql);
$bid = mysql_fetch_array($bid_res);
$bid_date = $bid['bidding_date'];
$buyerid = $bid['user_id'];

$sell_sql = "select * from placing_item_bid where  item_id=" . $bid[item_id];
$sell_res = mysql_query($sell_sql);
$sell = mysql_fetch_array($sell_res);


$user_sql = "select * from user_registration where user_id=" . $sell[user_id];
$user_res = mysql_query($user_sql);
$user = mysql_fetch_array($user_res);

$admin = "SELECT * FROM `admin_settings` WHERE set_id=58";
$admin_res = mysql_query($admin);
$admin_row = mysql_fetch_array($admin_res);

$elasped_admin = "SELECT * FROM `admin_settings` WHERE set_id=20";
$elasped_res = mysql_query($elasped_admin);
$elasped_row = mysql_fetch_array($elasped_res);


//$title="Better Things Better Price";
require 'include/index_top.php';
?>

<table width="958" cellpadding="0" cellspacing="0" border=0 align="center">
    <tr width=100>
        <td colspan=2 background="images/contentbg1.jpg" height="25">
            <font class="detail3txt"><div align="left">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Report an Unpaid Item Dispute </b>
            </div></font> 
        </td></tr>
    <tr><td><table style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom"  background="images/contentgrad.jpg">
                <?php
                $sqlitem = "select max(bidding_amount) from placing_bid_item where item_id=" . $bid[item_id];
                $sqlitem = mysql_query($sqlitem);
                $sqlitem = mysql_fetch_array($sqlitem);
                $biditem = $sqlitem['0'];


                $sql1 = "select to_days(now())-to_days(sale_date) from placing_bid_item where item_id=" . $bid[item_id] . " and bidding_amount=" . $biditem;
                $qry1 = mysql_query($sql1);
                $fetch1 = mysql_fetch_array($qry1);
                $fetchdays = $fetch1['0'];
                $disputedays = $admin_row['set_value'];
                $user_sql = "select * from user_registration where user_id=" . $_SESSION[userid];
                $user_qry = mysql_query($user_sql);
                $user_row = mysql_fetch_array($user_qry);
                if ($user_row[status] == "suspended") {
                    ?>
                    <tr><td align="center" class="banner1"><font color="#FF0000">Sorry your account is suspended.</font></td></tr>
                    <?php
                } else {

                    if (($fetchdays > $disputedays) or ($disputedays == 0)) {
                        $flag = 1;
                    }
                    if ($flag == 1) {
                        ?>

                        <tr><td style="padding-left:5px" class="banner1"> <b>Transaction:</b> <?php = $sell[item_title] ?> (#<?php = $bid[item_id] ?>) sold by <?php = $user[user_name] ?> on
                                <?php
                                $custom_date = explode(" ", $bid_date);
                                $custom_date1 = $custom_date[0];
                                $custom_time = $custom_date[1];
                                $custom_date3 = substr($custom_date1, "-2");
                                $custom_date2 = explode("-", $custom_date1);
                                $custom_date1 = $custom_date2[0];
                                $custom_date2 = $custom_date2[1];
                                $custom_date4 = $custom_date3 . "-" . "$custom_date2" . "-" . "$custom_date1" . " " . "$custom_time";
                                echo $custom_date[0];
                                ?>.    </td></tr>
                        <tr><td style="padding-left:5px" class="banner1">Use this form to:     </td></tr>
                        <tr><td style="padding-left:5px" class="banner1" > <ul type="disc" style="line-height:normal"><li >Report an Unpaid Item dispute: <?php = $_SESSION[site_name] ?> will send an Unpaid Item reminder to your buyer, encouraging them to complete the transaction. If the buyer still does not pay, you can use this form to file for a Final Value Fee credit.</li>  <li>
                                        Request a Final Value Fee credit for returned item or uncompleted transaction: If you and the buyer have resolved the dispute (for example, the buyer has returned the item, or you and the buyer have mutually agreed not to complete the transaction).</li></ul> </td></tr>
                        <tr><td style="padding-left:5px" class="banner1"><b>Please note:</b>   </td></tr>
                        <tr><td style="padding-left:5px" class="banner1"><ul type="disc" style="line-height:normal"><li > Only transactions with a winning buyer are eligible for a Final Value Fee credit.   </li> <li>Some disputes can be reported immediately after the item closes, but most require a <?php = $admin_row[set_value] ?> day waiting period. You cannot report a dispute if more than <?php = $elasped_row[set_value] ?> days have elapsed. </li></ul>   </td></tr>
                        <tr><td style="padding-left:5px" class="banner1" >  If you meet these conditions, please fill in the item number below and click <b> Continue </b> to report an Unpaid Item dispute. </td></tr>

                        <tr><td style="padding-left:10px" class="banner1"><b> Item number </b> </td></tr>

                        <form name="form1" action="report_unpaid_dispute.php"  method=post>
                            <tr>
                                <td style="padding-left:10px" class="banner1"> 
                                    <input type="text" name="txtitemnumber" value=<?php = $bid[item_id] ?> disabled="disabled">
                                    <input type="hidden" name="bid_id" value=<?php = $bid_id ?> />
                                </td></tr>
                            <tr><td style="padding-left:50px"><input type="submit" name=btnsubmit value="Continue"> </td></tr>
                        </form>

                        <?php
                    } else {
                        ?>
                        <tr><td><table border=0 align="center" cellpadding="0" cellspacing="3" width="90%">
                                    <tr><td class="banner1"><font color="#FF0000">You must wait <?php = $admin_row[set_value] ?> <?php
                                            if ($admin_row[set_value] == 1) {
                                                echo "day";
                                            } else {
                                                echo "days";
                                            }
                                            ?> to open a dispute</font>
                                        </td></tr>
                                </table></td></tr>
                        <?php
                    }
                }
                ?>
            </table></td></tr>
</table></td></tr>
<?php require 'include/footer.php'; ?>
