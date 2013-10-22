<?php
/* * *************************************************************************
 * File Name				:enterresnotreceived.php
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

if (empty($_SESSION[username])) {
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


$bid_id = $_REQUEST[bid_id];
$dispute_id = $_REQUEST[dispute_id];
if (isset($_SESSION[username])) {
if (empty($bid_id) or empty($dispute_id)) {
echo '<meta http-equiv="refresh" content="0;url=myauction.php">';
exit();
}
}
//$userid=$_SESSION[userid];

$bid_sql = "select * from placing_bid_item where  bid_id=" . $bid_id;
$bid_res = mysql_query($bid_sql);
$bid = mysql_fetch_array($bid_res);
$bid_date = $bid['bidding_date'];
$buyerid = $bid['user_id'];

$sell_sql = "select * from placing_item_bid where  item_id=" . $bid[item_id];
$sell_res = mysql_query($sell_sql);
$sell = mysql_fetch_array($sell_res);
$itemtitle = $sell['item_title'];


$user_sql = "select * from user_registration where user_id=" . $bid[user_id];
$user_res = mysql_query($user_sql);
$user = mysql_fetch_array($user_res);

$dispute_sql = "select * from disputeconsole where dispute_id=" . $dispute_id;
$dispute_res = mysql_query($dispute_sql);
$dispute_row = mysql_fetch_array($dispute_res);

if ($_SESSION[userid] != $dispute_row['dispute_by']) {
$mail_user_sql = "select * from user_registration where user_id=" . $dispute_row[dispute_by];
} else if ($_SESSION['userid'] != $dispute_row['dispute_to']) {
$mail_user_sql = "select * from user_registration where user_id=" . $dispute_row[dispute_to];
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
$date = date("Y-m-d G:i:s");

//mail to seller for reply

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
$message = str_replace("<number>", $bid[item_id], $message);
$message = str_replace("<site>", $site, $message);
$message = str_replace("<imgh>", $mailheader, $message);
$message = str_replace("<imgf>", $mailfooter, $message);

$headers = "MIME-Version: 1.0\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\n";
$headers .= "From: " . $mail_from . "\n";

mail($mail_to, $subject, $message, $headers);

$ins_sql = "INSERT INTO `dispute_process` (`dispute_id` , `dispute_by` , `dispute_explanations` ,dispute_date) VALUES ('$dispute_id', '$_SESSION[userid]', '$_REQUEST[txtresponse]','$date')";
$ins_res = mysql_query($ins_sql);
if ($ins_res) {
$res_success = 1;
}
} else if ($_REQUEST['closeflag'] == "close") {
$up = "update disputeconsole set dispute_status='closed' where dispute_id=$dispute_id";
$up_res = mysql_query($up);
if ($up_res) {
$upsucess = 1;
}
}
?>
<?php
$title = "Better Things Better Price";
require 'include/detail_top.php';
if ($res_success == 1) {
?>
<table width="958" cellpadding="0" cellspacing="0" border=0 align="center">
    <tr width=100>
        <td colspan=2 background="images/contentbg1.jpg" height="25">
            <font class="detail3txt"><div align="left">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Response Sent</div> </td></tr>
    <tr><td style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom"  background="images/contentgrad.jpg">
            <table align="center" cellpadding="3" cellspacing="3" width="100%">
                <tr><td style="padding-left:10px" class="banner1">
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
                        Thank you. Your response has been entered successfully.we will inform the <?php = $user[user_name] ?>  that their response is needed.
                    </td></tr> 
                <tr><td><hr></td></tr>


                <tr><td style="padding-left:10px" class="banner1"> <b> Where would you like to go? </b></td></tr>
                <tr><td style="padding-left:20px"> <a href="viewdispute.php?type=notreceived" class="style1">Back to Dispute Console</a></td></tr>
                <tr><td style="padding-left:20px"> <a href="myauction.php" class="style1">My Auction</a></td></tr>
            </table>
        </td></tr>
</table>
</td></tr>
</table>
<?php
require 'include/footer.php';
exit();
} else if ($upsucess == 1) {
?>
<table width="958" cellpadding="0" cellspacing="0" border=0 align="center">
    <tr width=100>
        <td colspan=2 background="images/contentbg1.jpg" height="25">
            <font class="detail3txt"><div align="left">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dispute Console Closed Successfully</div> </td></tr>
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
            </table>
        </td></tr>
    <tr><td><hr></td></tr>
    <tr><td style="padding-left:10px" class="banner1"> <b> Where would you like to go? </b></td></tr>
    <tr><td style="padding-left:20px"> <a href="viewdispute.php?type=notreceived" class="style1">Back to Dispute Console</a></td></tr>
    <tr><td style="padding-left:20px"> <a href="myauction.php" class="style1">My Auction</a></td></tr>
</table>
<?php
require 'include/footer.php';
exit();
}
?>


<table width="958" cellpadding="0" cellspacing="0" border=0 align="center">
    <tr width=100>
        <td colspan=2 background="images/contentbg1.jpg" height="25">
            <font class="detail3txt"><div align="left">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;View Dispute: Respond </div> </td></tr>
    <tr><td style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom"  background="images/contentgrad.jpg">
            <table align="center" cellpadding="3" cellspacing="3" width="100%">
                <tr><td style="padding-left:10px" class="banner1" > <b>Transaction:</b> <?php = $sell[item_title] ?> (#<?php = $bid[item_id] ?>) sold to <?php = $user[user_name] ?> on
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

                <tr><td style="padding-left:10px" class="banner1"> 

                        <?php = $_SESSION[site_name] ?>  user <?php = $user[user_name] ?> purchased the item listed above from you on <?php = $custom_date[0] ?> and says it was not received. As a result, <?php = $user[user_name] ?>  has opened an Item Not Received dispute.   </td></tr>


                <tr><td style="padding-left:10px" class="banner1"><b> Dispute Status: </b>
                        <?php
                        if ($dispute_row[dispute_status] == "open") {
                        ?>
                        Your action Needed
                        <?php
                        }
                        ?>
                    </td></tr>
                <tr><td style="padding-left:10px" class="banner1"> 
                        Please enter your response below.  <?php = $_SESSION[site_name] ?>  will then send this information to <?php = $user[user_name] ?>.
                    </td></tr>
                <tr><td>
                        <table cellpadding="5" cellspacing="2" width=100%>
                            <tr><td width="39%"><table>
                                        <form name="form1" action="enterresnotreceived.php"  method=post>
                                            <tr><td style="padding-left:10px" class="banner1"> 
                                                    <b>Enter Your Response</b>
                                                </td></tr>
                                            <tr><td style="padding-left:10px" class="banner1"> 
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
                            </tr> </table></td></tr>



                <tr><td>
                        <table cellpadding="0" cellspacing="0" border="0" width=96% class="table_border1" align="center">
                            <tr><td style="padding-left:10px" bgcolor="#CCCCCC" class="banner1"><b>Previous Message</b> </td> </tr>
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

                                        $user_sql = "select * from user_registration where user_id=" . $dispute_row_1[dispute_by];
                                        $user_res = mysql_query($user_sql);
                                        $user = mysql_fetch_array($user_res);
                                        ?>
                                        <tr><td valign="top" style="padding-left:10px" colspan="2" class="banner1"><font size="2" color="#CC99FF"><b>
                                                    <?php = $user[user_name] ?></b></font>
                                            </td></tr>

                                        <tr><td valign="top" style="padding-left:10px" width="80%" >
                                                <?php = $dispute_row_1[dispute_explanations] ?>
                                                <?php
                                                $disdate = explode(" ", $dispute_row_1[dispute_date]);
                                                ?>
                                            </td><td align="right" style="padding-right:5px" class="banner1"><?php = $disdate[0] ?></td></tr>
                                        <tr><td style="border-bottom:#999999" colspan="2">&nbsp;</td></tr>

                                        <?php
                                        }
                                        ?>
                                    </table>
                                </td></tr>
                            <?php
                            }
                            ?>
                            <tr><td valign="top"  style="padding-left:10px" >
                                    <table width="100%"><tr><td class="banner1">
                                                <b>
                                                    <?php = $user[user_name] ?></b>
                                            </td><td align="right" class="banner1"><?php = $dispute_row[dispute_date] ?> </td></tr></table></td></tr>
                            <tr><td style="padding-left:10px" class="banner1">
                                    <?php
                                    if ($dispute_row[dispute_reason] == "I have not received the item") {
                                    ?>
                                    Item Not Received:
                                    <?php
                                    } else {
                                    ?>
                                    Item Significantly Not As Described:
                                    <?php
                                    }
                                    ?>
                                    <?php = $sell[item_title] ?> (#<?php = $bid[item_id] ?>) </td></tr>
                            <tr><td style="padding-left:10px" class="banner1">Payment Method: <?php = $dispute_row[payment_gateway] ?> </td></tr>
                            <tr><td style="padding-left:10px" class="banner1">Payment Date: <?php = $dispute_row[payment_date] ?> </td></tr>
                            <?php
                            if ($dispute_row[dispute_explanation]) {
                            ?>
                            <tr><td style="padding-left:10px" class="banner1">Addtional Information: <?php = $dispute_row[dispute_explanation] ?> </td></tr>
                            <?php
                            }
                            ?>
                        </table>
                    </td></tr>
            </table>
        </td></tr>
</table>
</td></tr>
<?php require 'include/footer.php'; ?>
