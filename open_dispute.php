<?php
/* * *************************************************************************
 * File Name				:open_dispute.php
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

if (!isset($_SESSION[username])) {
$link = "signin.php";
$url = "myauction.php";
echo '<meta http-equiv="refresh" content="0;url=' . $link . '?url=' . $url . '">';
echo "You have been Re-Directed, if not please <a href=$link?$url>Click here</a>";
exit();
}

if ($_REQUEST[bid_id])
$bid_id = $_REQUEST[bid_id];
else
$bid_id = $_SESSION[dispute_bid_id];

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


if ($_REQUEST[flag]) {
$day = $_REQUEST[cboday];
$month = $_REQUEST[cbomonth];
$year = $_REQUEST[txtYear];
$dob = $year . "-" . $month . "-" . $day;
$payment = $_REQUEST[payment];

if (empty($_REQUEST[cboDisputeReason])) {
$err_reason = 1;
$err_flag = 1;
}

if (empty($payment)) {
$err_payment = 1;
$err_flag = 1;
}

if (empty($day)) {
$err_day = 1;
$err_flag = 1;
}
if (empty($month)) {
$err_month = 1;
$err_flag = 1;
}
if (empty($year)) {
$err_year = 1;
$err_flag = 1;
}
if (empty($err_day) and empty($err_year) and empty($err_month)) {
$chk_year = date("Y-m-d");
$chk_dob = "$year" . "-" . "$month" . "-" . "$day";
if ($chk_dob < $bid_date) {
$err_dob = 1;
$err_flag = 1;
}
}

if ($err_flag != 1) {

$_SESSION[dispute_bid_id] = $bid_id;
$_SESSION[DisputeReason] = $_REQUEST[cboDisputeReason];
$_SESSION[DisputeExplanation] = $_REQUEST[cboDisputeExplanation];
$_SESSION[dis_payment_date] = $chk_dob;
$_SESSION[payment] = $payment;


if ($_REQUEST[cboDisputeReason] == "I have not received the item") {
//$link="reviewdispute.php";
$link = "disputedescription.php";
} else {
$link = "disputedescription.php";
}
echo '<meta http-equiv="refresh" content="0;url=' . $link . '">';
echo "You have been Re-Directed, if not please <a href=$link>Click here</a>";
exit();
}
}

//$title="Better Things Better Price";
require 'include/index_top.php';
?>


<table width="958" cellpadding="0" cellspacing="0" border=0 align="center">
    <tr width=100>
        <td colspan=2 background="images/contentbg1.jpg" height="25">
            <font class="detail3txt"><div align="left">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Open a Dispute: Describe Dispute </div>
            </font> </td></tr>
    <tr><td style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom"  background="images/contentgrad.jpg"><table border="0" align="center" cellpadding="3" cellspacing="0" width="100%" >
                <?php
                if ($err_flag == 1) {
                ?>
                <tr><td style="padding-left:10px" class="banner1"> Please enter your explanation in highlighted fields  below   </td> </tr>
                <tr><td style="padding-left:10px" class="banner1"> 
                        <ul type="disc">
                            <?php
                            if ($err_reason == 1) {
                            ?>
                            <li>
                                <font color="#FF0000">
                                Please select a reason for opening this dispute </font> 
                            </li>
                            <?php
                            }
                            ?>

                            <?php
                            if ($err_payment == 1) {
                            ?>
                            <li>
                                <font color="#FF0000">
                                Please select payment gateway.
                                </font> 
                            </li>
                            <?php
                            }
                            ?>


                            <?php
                            if ($err_dob == 1 || $err_month == 1 || $err_year == 1 || $err_day == 1) {
                            ?>
                            <li>
                                <font color="#FF0000">
                                Payment date must be after end of transaction. 

                                </font> 
                            </li>
                            <?php
                            }
                            ?>

                        </ul> </td> </tr>
                <?php
                }
                ?>
                <tr>
                    <td style="padding-left:10px" class="banner1">We're sorry that you're having difficulty with this transaction. We've developed the Item Not Received or Significantly Not as Described process to help buyers and sellers resolve their problems through direct communication on <?php = $_SESSION[site_name] ?> Web site.   
                    </td>
                </tr>
                <tr><td style="padding-left:10px" class="banner1"> 
                        Open a dispute for the transaction above if you paid for the item but didn't receive it, or you paid for and received the item, but it was significantly different from the item description.   
                    </td></tr>

                <tr>
                    <td style="padding-left:10px" class="banner1"> The best way to solve transaction problems on <?php = $_SESSION[site_name] ?> is direct and open communication between buyers and sellers. There are some instances, however, where a transaction may actually take longer than usual time. </td>
                </tr>
                <tr><td style="padding-left:10px" class="banner1"><b>International Transactions:</b> Shipping and customs for international transactions can take time. International bank transfers can also take up to 14 days to complete. Please make sure to ask the seller for an estimate of the shipping time.      </td></tr>
                <tr><td style="padding-left:10px" class="banner1"><b> Outdated Contact Information: </b> Please verify that your <?php = $_SESSION[site_name] ?> email account is updated and working. The seller may actually be trying to contact you but can't because they have the wrong information.  
                    </td></tr>
                <tr>
                    <td style="padding-left:10px" class="banner1">
                        If any of these instances apply to your transaction, you may wish to click "Cancel" below and wait for some more days. If you still want to file the dispute on <?php = $_SESSION[site_name] ?>, click Continue.  
                    </td>
                </tr>

                <tr><td style="padding-left:10px" class="banner1"> <b> Report an Item not received:</b> <?php = $sell[item_title] ?> (#<?php = $bid[item_id] ?>) sold by <?php = $user[user_name] ?> on
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
                <form name="form1" action="open_dispute.php"  method=post>
                    <tr><td style="padding-left:10px" class="banner1"> <b>
                                <?php
                                if ($err_reason == 1) {
                                ?>
                                <font color="#FF0000">
                                Please select a reason for opening this dispute </font> 
                                <?php
                                } else {
                                ?> 
                                Please select a reason for opening this dispute
                                <?php
                                }
                                ?>
                            </b> </td></tr>
                    <tr>
                        <td style="padding-left:10px" class="banner1"> 
                            <select name="cboDisputeReason"><option value="0">-- Select One --</option>
                                <?php
                                if ($_REQUEST[cboDisputeReason] == "I have not received the item") {
                                ?>
                                <option value="I have not received the item" selected="selected">I have not received the item.</option>
                                <?php
                                } else {
                                ?>
                                <option value="I have not received the item">I have not received the item.</option>
                                <?php
                                }
                                ?>
                                <?php
                                if ($_REQUEST[cboDisputeReason] == "The item I received is significantly different from the item description") {
                                ?>
                                <option value="The item I received is significantly different from the item description">The item I received is significantly different from the item description</option>
                                <?php
                                } else {
                                ?>
                                <option value="The item I received is significantly different from the item description">The item I received is significantly different from the item description</option>
                                <?php
                                }
                                ?>

                            </select>
                        </td></tr>
                    <tr><td style="padding-left:10px" class="banner1">
                            <b>
                                <?php if ($err_payment == 1) { ?>
                                <font color="#FF0000">
                                How did you pay for the transaction? </font> 
                                <?php
                                } else {
                                ?> 
                                How did you pay for the transaction?
                                <?php
                                }
                                ?></b>
                        </td></tr>

                    <tr><td style="padding-left:10px" class="banner1">
                            <?php
                            $pay_sql = "select * from payment_gateway";
                            $pay_res = mysql_query($pay_sql);
                            ?>
                            <select name="payment" onChange="pay_refresh()">
                                <option value="">Select</option>
                                <?php
                                $count = 1;
                                while ($pay_row = mysql_fetch_array($pay_res)) {
                                $count = $count + 1;
                                if ($pay_row[gateway_id] == $payment) {
                                ?>
                                <option value="<?php = $pay_row['gateway_id']; ?>" selected><?php = $pay_row[payment_gateway]; ?> </option>
                                <?php
                                } else {
                                ?>
                                <option value="<?php = $pay_row['gateway_id']; ?>"><?php = $pay_row[payment_gateway]; ?> </option>
                                <?php
                                }
                                ?>

                                <?php
                                }
                                $count1 = $count + 1;
                                $_SESSION['countpay'] = $count1;
                                ?>
                                <option value="<?php = $count1; ?>">Others</option>
                            </select>
                        </td></tr>
                    <tr><td style="padding-left:10px" class="banner1">
                            <?php
                            if (!empty($err_day) or!empty($err_month) or!empty($err_year) or!empty($err_dob)) {
                            ?>
                            <font size=2 color=red><?php = $err_email; ?></font>
                            <br>
                            <b><font size=2 color=red>Payment Date</font></b>
                            <?php
                            } else {
                            ?>
                            <b><font size=2>Payment Date</font></b>
                            <?php
                            }
                            ?>
                        </td></tr>
                    <tr><td style="padding-left:10px" class="banner1">

                            <select name=cbomonth>
                                <option value=0> Month </option>
                                <?php
                                for ($i = 1;
                                $i <= 12;
                                $i++) {
                                if ($month == $i) {
                                ?>
                                <option value=<?php = $i ?> selected > <?php = $i ?> </option>
                                <?php
                                } else {
                                ?>
                                <option value=<?php = $i ?> > <?php = $i ?> </option>
                                <?php
                                }
                                }
                                ?>
                            </select> - <select name=cboday>
                                <option value=0> Day </option>
                                <?php
                                for ($i = 1;
                                $i <= 31;
                                $i++) {
                                if ($day == $i) {
                                ?>
                                <option value=<?php = $i ?> selected> <?php = $i ?> </option>
                                <?php
                                } else {
                                ?>
                                <option value=<?php = $i ?> > <?php = $i ?> </option>
                                <?php
                                }
                                }
                                ?>
                            </select>  -
                            <input type="text" name="txtYear" style="font-size:12px;font-family:arial;width:40;height:20" maxlength=4 value="<?php = $year ?>">
                        </td>
                    </tr>

                    <input type="hidden" name="bid_id" value=<?php = $bid_id ?> />
                    <input type="hidden" name="flag" value=1 />
                    <tr><td><hr></td></tr>
                    <tr><td style="padding-left:10px"><input type="submit" name=btnsubmit value="Continue">&nbsp;&nbsp;<a href="myauction.php" class="style1">Cancel</a> </td></tr>
                </form>
            </table></td></tr>
</table>
<?php require 'include/footer.php'; ?>
