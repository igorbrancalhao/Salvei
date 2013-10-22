<?php
/* * *************************************************************************
 * File Name				:enterresponsetobuyer.php
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

if (!isset($_SESSION['username'])) {
$link = "signin.php";
$url = "myauction.php";
echo '<meta http-equiv="refresh" content="0;url=' . $link . '?url=' . $url . '">';
echo "You have been Re-Directed, if not please <a href=$link?$url>Click here</a>";
exit();
}

//sitename
$site_sql = mysql_query("select * from admin_settings where set_id=1");
$site_fetch = mysql_fetch_array($site_sql);
$site = $site_fetch['set_value'];

//Fetching mail header image
$queryheader = "select * from admin_settings where set_id = 61";
$tableheader = mysql_query($queryheader);
$rowheader = mysql_fetch_array($tableheader);
$mailheader = $site . "/" . $rowheader['set_value'];

//Fetching mail footer image
$queryfooter = "select * from admin_settings where set_id = 62";
$tablefooter = mysql_query($queryfooter);
$rowfooter = mysql_fetch_array($tablefooter);
$mailfooter = $site . "/" . $rowfooter['set_value'];

$bid_id = $_REQUEST['bid_id'];
$dispute_id = $_REQUEST['dispute_id'];
if (isset($_SESSION['username'])) {
if (empty($bid_id) or empty($dispute_id)) {
echo '<meta http-equiv="refresh" content="0;url=myauction.php">';
exit();
}
}

$bid_sql = "select * from placing_bid_item where  bid_id=" . $bid_id;
$bid_res = mysql_query($bid_sql);
$bid = mysql_fetch_array($bid_res);
$bid_date = $bid['bidding_date'];
$buyerid = $bid['user_id'];

$sell_sql = "select * from placing_item_bid where  item_id=" . $bid['item_id'];
$sell_res = mysql_query($sell_sql);
$sell = mysql_fetch_array($sell_res);
$itemtitle = $sell['item_title'];
$itemid = $sell['item_id'];

$user_sql = "select * from user_registration where user_id=" . $bid['user_id'];
$user_res = mysql_query($user_sql);
$user = mysql_fetch_array($user_res);
$user_sql1 = "select * from user_registration where user_id=" . $sell['user_id'];
$user_res1 = mysql_query($user_sql1);
$user1 = mysql_fetch_array($user_res1);

$dispute_sql = "select * from disputeconsole where dispute_id=" . $dispute_id;
$dispute_res = mysql_query($dispute_sql);
$dispute_row = mysql_fetch_array($dispute_res);

if ($_SESSION[userid] != $dispute_row['dispute_by']) {
$mail_user_sql = "select * from user_registration where user_id=" . $dispute_row['dispute_by'];
} else if ($_SESSION[userid] != $dispute_row['dispute_to']) {
$mail_user_sql = "select * from user_registration where user_id=" . $dispute_row['dispute_to'];
}
$mail_res_user = mysql_query($mail_user_sql);
$mail_user_fetch = mysql_fetch_array($mail_res_user);

$admin = "SELECT * FROM `admin_settings` WHERE set_id=58";
$admin_res = mysql_query($admin);
$admin_row = mysql_fetch_array($admin_res);

$elasped_admin = "SELECT * FROM `admin_settings` WHERE set_id=20";
$elasped_res = mysql_query($elasped_admin);
$elasped_row = mysql_fetch_array($elasped_res);

if ($_REQUEST[flag] == 1) {

//mail for reply
$mail_sql = "select * from mail_subjects where mail_id=27";
$mail_qry = mysql_query($mail_sql);
$mail_row = mysql_fetch_array($mail_qry);
$subject = $mail_row['mail_subject'];
$subject = str_replace("<disputeid>", $dispute_id, $subject);

$mail_from = $mail_row['mail_from'];
$mail_to = $mail_user_fetch['email'];
$username1 = $mail_user_fetch['user_name'];

$message = $mail_row['mail_message'];
$message = str_replace("<user>", $username1, $message);
$message = str_replace("<title1>", $itemtitle, $message);
$message = str_replace("<number>", $itemid, $message);
$message = str_replace("<site>", $site, $message);
$message = str_replace("<imgh>", $mailheader, $message);
$message = str_replace("<imgf>", $mailfooter, $message);

$headers = "MIME-Version: 1.0\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\n";
$headers .= "From: " . $mail_from . "\n";

mail($mail_to, $subject, $message, $headers);

$date = date("Y-m-d G:i:s");

$ins_sql = "INSERT INTO `dispute_process` (`dispute_id` , `dispute_by` , `dispute_explanations` ,dispute_date) VALUES ('$dispute_id', '$_SESSION[userid]', '$_REQUEST[txtresponse]','$date')";
$ins_res = mysql_query($ins_sql);
if ($ins_res) {
$res_success = 1;
}
} else if ($_REQUEST[closeflag] == "close") {
$up = "update disputeconsole set dispute_status='closed' where dispute_id=$dispute_id";
$up_res = mysql_query($up);
if ($up_res) {
$upsucess = 1;
}
}


require 'include/index_top.php';
if ($res_success == 1) {
?>
<table width="958" cellpadding="0" cellspacing="0" border=0 align="center">
    <tr width=100>
        <td colspan=2 background="images/contentbg1.jpg" height="25">
            <font class="detail3txt"><div align="left">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Response Entered Successfully</div></font>
        </td></tr>
    <tr><td style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom"  background="images/contentgrad.jpg">
            <table align="center" cellpadding="3" cellspacing="3" width="100%">
                <tr><td style="padding-left:5px" class="banner1" >
                        <b>Transaction:</b> <?php = $sell[item_title] ?> (#<?php = $bid[item_id] ?>) sold by <?php = $user[user_name] ?> on
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
                        ?> .</td></tr> 
                <tr><td style="padding-left:5px" class="banner1"><b> Dispute Status: </b>
                        Other's Party action Needed
                    </td></tr> 
                <tr><td style="padding-left:5px" class="banner1">
                        Your response has been entered successfully.we will inform the seller that their response is needed.
                    </td></tr> 


                <tr><td><hr></td></tr>
                <tr><td class="banner1" style="text-decoration:underline"> <b> Where would you like to go? </b></td></tr>
                <tr><td style="padding-left:20px"> <a href="viewdispute.php?type=notreceived" class="banner1" style="text-decoration:underline">View Dispute Console</a></td></tr>
                <tr><td style="padding-left:20px">
                        <a href="myauction.php" class="banner1" style="text-decoration:underline">My Auction</a></td></tr>
            </table></td></tr>
</table></td></tr>
<?php
require 'include/footer.php';
exit();
} else if ($upsucess == 1) {
?>
<table width="958" cellpadding="0" cellspacing="0" border=0 align="center">
    <tr width=100>
        <td colspan=2 background="images/contentbg1.jpg" height="25">
            <font class="detail3txt"><div align="left">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dispute Console Closed Successfully</div>
            </font> </td></tr>
    <tr><td style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom"  background="images/contentgrad.jpg">
            <table align="center" cellpadding="3" cellspacing="3" width="100%">
                <tr><td style="padding-left:5px" class="banner1" >
                        <b>Transaction:</b> <?php = $sell[item_title] ?> (#<?php = $bid[item_id] ?>) sold to <?php = $user[user_name] ?> on
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
                        ?> .</td></tr> 
                <tr><td style="padding-left:10px" class="banner1"><b> Dispute Status: </b>
                        Other's Party action Needed
                    </td></tr> 
                <tr><td style="padding-left:10px" class="banner1">
                        Your response has been entered successfully.we will inform the seller that their response is needed.
                    </td></tr> 


                <tr><td><hr></td></tr>
                <tr><td style="text-decoration:underline" class="banner1" > <b> Where would you like to go? </b></td></tr>
                <tr><td style="text-decoration:underline"> <a href="viewdispute.php?type=notreceived" class="banner1">View Dispute Console</a></td></tr>
                <tr><td style="text-decoration:underline"> <a href="myauction.php" class="banner1">My Auction</a></td></tr>
            </table></td></tr>
</table></td></tr>
<?php
require 'include/footer.php';
exit();
}
?>


<table width="958" cellpadding="0" cellspacing="0" border=0 align="center">
    <tr width=100>
        <td colspan=2 background="images/contentbg1.jpg" height="25">
            <font class="detail3txt"><div align="left">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Enter Response </div>
            </font> </td></tr>
    <tr><td style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom"  background="images/contentgrad.jpg">
            <table align="center" cellpadding="3" cellspacing="3" width="100%">
                <tr><td style="padding-left:5px" class="banner1" > <b>Transaction:</b> <?php = $sell['item_title'] ?> (#<?php = $bid['item_id'] ?>) sold to <?php = $user['user_name'] ?> on
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
                        ?> .</td></tr>

                <tr><td style="padding-left:5px" class="banner1"> <?php = $_SESSION['site_name'] ?>  user <?php = $sell['user_name'] ?> has notified us of an Unpaid Item dispute regarding this item. </td></tr>


                <tr><td style="padding-left:5px" class="banner1"><b> Dispute Status: </b>
                        <?php
                        if ($dispute_row['dispute_status'] == "open") {
                        ?>
                        Your action Needed
                        <?php
                        }
                        ?>

                    </td></tr>
                <tr><td>
                        <table cellpadding="5" cellspacing="2" width=100%>
                            <tr><td width="39%"><table>
                                        <form name="form1" action="enterresponsetobuyer.php"  method=post>
                                            <tr><td style="padding-left:15px" class="banner1"> 
                                                    <b>Enter Your Response</b>
                                                </td></tr>
                                            <tr><td style="padding-left:10px"> 
                                                    <textarea name="txtresponse" cols="40" rows="5">
                                                    </textarea>
                                                </td></tr>
                                            <tr>
                                                <td style="padding-left:10px"> 
                                                    <input type="hidden" name="bid_id" value=<?php = $bid_id ?> />
                                                    <input type="hidden" name="dispute_id" value=<?php = $dispute_id ?> />
                                                </td></tr>
                                            <input type="hidden" name="flag" value=1 />
                                            <tr><td style="padding-left:10px">
                                                    <input type="submit" name=btnsubmit value="Submit">
                                                </td></tr>
                                        </form></table></td>
                                <td  width=1> <table height=150><tr><td bgcolor="#cccccc"> </td></tr></table></td>
                                <td width="60%">
                                    <table>
                                        <tr><td class="banner1"><b>Close This Dispute</b>  
                                            </td></tr>
                                        <tr><td class="banner1">
                                                <ul type="disc">
                                                    <li>You and the buyer are satisfied</li>
                                                    <li>You Don't want to communicate with or wait for the buyer</li>
                                                    <li>You both agree not to complete the transaction</li>
                                                    <li>Buyer returned the item </li>
                                                </ul>

                                            </td></tr>
                                        <tr><td>
                                                <form name="review_form" action="close_dispute_seller.php"  method=post>
                                                    <input type="hidden" name=closeflag value="close">
                                                    <input type="hidden" name="bid_id" value=<?php = $bid_id ?> />
                                                    <input type="hidden" name="dispute_id" value=<?php = $dispute_id ?> />
                                                    <input type="hidden" name="item_id"  value="<?php = $bid[item_id] ?>" />
                                                    <input type="submit" value="Close Dispute" />
                                                </form>
                                            </td></tr>
                                    </table>
                                </td>

                            </tr> </table></td></tr>



                <tr><td style="padding-left:10px">
                        <table cellpadding="0" cellspacing="0" border="0" width=95%>
                            <tr><td style="padding-left:10px" bgcolor="#B8DEEE" class="banner1"><b>Previous Message</b> </td> </tr>
                            <br />

                            <?php
                            $dispute_sql_1 = "select * from dispute_process where dispute_id=" . $dispute_row[dispute_id] . " order by process_id desc";
                            $dispute_res_1 = mysql_query($dispute_sql_1);
                            if (mysql_num_rows($dispute_res_1) > 0) {
                            ?>
                            <tr><td>
                                    <table cellpadding="0" cellspacing="0" border="0" width=100% class="table_border1">
                                        <?php
                                        while ($dispute_row_1 = mysql_fetch_array($dispute_res_1)) {

                                        $user_sql = "select * from user_registration where user_id=" . $dispute_row_1['dispute_by'];
                                        $user_res = mysql_query($user_sql);
                                        $user = mysql_fetch_array($user_res);
                                        ?>
                                        <tr><td valign="top" style="padding-left:10px" colspan="2" class="banner1"><font size="2" color="#CC99FF"><b>
                                                    <?php = $user['user_name'] ?></b></font>
                                            </td></tr>

                                        <tr><td valign="top" style="padding-left:10px" width="80%" class="banner1">
                                                <?php = $dispute_row_1['dispute_explanations'] ?>
                                                <?php
                                                $dispute_display_date = explode(" ", $dispute_row_1['dispute_date']);
                                                ?>
                                            </td><td align="right" style="padding-right:5px" class="banner1" ><?php = $dispute_display_date[0]; ?></td></tr>
                                        <tr><td style="border-bottom:#999999" colspan="2">&nbsp;</td></tr>

                                        <?php
                                        }
                                        ?>
                                    </table>
                                </td></tr>
                            <?php
                            }
                            ?>

                            <tr><td valign="top"  style="padding-left:10px" class="banner1" ><b>
                                        <?php = $_SESSION[site_name] ?></b>
                                </td></tr>
                            <tr><td style="padding-left:10px" class="banner1">An Unpaid Item dispute has been opened for the following item:  <?php = $sell[item_title] ?> (#<?php = $bid[item_id] ?>) </td></tr>
                            <tr><td style="padding-left:10px" class="banner1">Reason given for Unpaid Item:<?php = $dispute_row[dispute_reason] ?> </td></tr>
                            <tr><td style="padding-left:10px" class="banner1">Buyer actions reported by seller:<?php = $dispute_row[dispute_explanation] ?> </td></tr>
                        </table>
                    </td></tr>
            </table>
        </td></tr>
</table>
</td></tr>

<?php require 'include/footer.php'; ?>

