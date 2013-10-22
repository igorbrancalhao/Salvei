<?php
/* * *************************************************************************
 * File Name				:disputedescription.php
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

if ($_REQUEST['bid_id'])
$bid_id = $_REQUEST['bid_id'];
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
if (empty($_REQUEST[txtresponse]))
$err_explanation = 1;


if (empty($err_explanation)) {
$_SESSION[Dispute_addttional_inf] = $_REQUEST[txtresponse];
$_SESSION[dispute_bid_id] = $bid_id;


$link = "reviewdispute.php";
echo '<meta http-equiv="refresh" content="0;url=' . $link . '">';
echo "You have been Re-Directed, if not please <a href=$link>Click here</a>";
exit();
}
}

//	$title="Better Things Better Price";
require 'include/index_top.php';
?>
<table width="958" cellpadding="0" cellspacing="0" border=0 align="center">
    <tr width=100>
        <td colspan=2 background="images/contentbg1.jpg" height="25">
            <font class="detail3txt"><div align="left">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Open a Dispute: Provide Details for your dispute </div>
            </font></td></tr>
    <tr><td style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom"  background="images/contentgrad.jpg">
            <table align="center" cellpadding="3" cellspacing="3" width="100%">
                <?php
                if ($err_explanation) {
                ?>
                <tr><td style="padding-left:10px" class="banner1"> Please enter your explanation in highlighted fields  below   </td> </tr>
                <tr><td style="padding-left:10px" class="banner1"> 
                        <ul type="disc"><li>
                                <?php
                                if ($err_explanation == 1) {
                                ?>
                                <font color="#FF0000">
                                Additional details for <?php = $user[user_name] ?>  </font> 
                                <?php
                                }
                                ?>
                            </li>
                        </ul> </td> </tr>
                <?php
                }
                ?>
                <tr><td style="padding-left:20px" class="banner1"> An item is "Significantly Not as Described" if the seller clearly misrepresents the item in a way that affects its value or usability. Please refer back to the original item listing and describe how the item you received is significantly different. This information will be shared with <?php = $user[user_name] ?>.   
                    </td></tr>

                <tr><td style="padding-left:20px" class="banner1"> <b> Report an Item not received:</b> <?php = $sell[item_title] ?> (#<?php = $bid[item_id] ?>) sold by <?php = $user[user_name] ?> on
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
                <tr><td style="padding-left:10px" >
                        <table>
                            <form name="form1" action="disputedescription.php"  method=post>
                                <tr><td style="padding-left:10px" class="banner1"> 
                                        <b>Additional details for <?php = $user[user_name] ?> </b>
                                    </td></tr>
                                <tr><td style="padding-left:10px"> 
                                        <textarea name="txtresponse" cols="40" rows="5">
                                            <?php = $_SESSION[Dispute_addttional_inf] ?>
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
                            </form></table>
                    </td></tr></table></td></tr></table>
<?php require 'include/footer.php'; ?>
