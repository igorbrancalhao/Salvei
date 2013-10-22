<?php
/* * *************************************************************************
 * File Name				:viewdispute.php
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
?>
<?php
session_start();
error_reporting(0);
require 'include/viewdispute_inc.php';
?>
<?php
require 'include/top.php';
$site_admin = "select * from admin_settings where set_id=47";
$site_admin_res = mysql_query($site_admin);
$site_admin_row = mysql_fetch_array($site_admin_res);
$fromid = $site_admin_row['set_value'];

//deleting the dispute
if ($_REQUEST[id]) {
    $dispute_id = $_REQUEST[id];
//$del_sql="update disputeconsole set del_status='yes' where dispute_id=$dispute_id";
    $del_sql = "delete from disputeconsole where dispute_id=$dispute_id";
    mysql_query($del_sql);
}
?>
<table border="0" cellpadding="0" cellspacing="0" width="80%" bgcolor="#cecfc8">
<!--<tr><td>
<table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#cecfc8" style="width:600">-->
    <tr><td>
            <table border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#E8E8E8" width="760">
                <tr><td>
                        <table width="700" height="35" cellpadding="0" cellspacing="0" align="center" bgcolor="#E8E8E8" border="0"> 
                            <tr align="center">
                                <td width="10%"><center><br /><a href="viewdispute.php?type=unpaid" class="txt_users">Unpaid Items Dispute</a></center><br /></td>
                    <td width="13%"><center><br /><a href="viewdispute.php?type=notreceived" class="txt_users">Items Not Received Dispute</a></center><br /></td>
    </tr>


</table>
</td></tr>
<tr><td>
        <table valign="top " cellspacing="0" cellpadding="0" border="0" width="500" align="center" bgcolor="#E8E8E8">
            <!------ Unpaid Dispute ------------------------------>
            <?php
            if ($type == "unpaid") {
                ?>
                <tr><td>
                        <table cellpadding="0" cellspacing="2" class=border2 align="center" border="0">
                            <tr bgcolor="#eeeee1"><td height="30" width="100%" id="watchingdetails">
                                    <table cellpadding="0" cellspacing="0" width=650 align="center" border="0">
                                        <tr>
                                            <td align="left" class="font_white" bgcolor="#eeeee1"><b>&nbsp;&nbsp;Unpaid Items :&nbsp;&nbsp;&nbsp;</b>( 
                                                <?php
                                                if ($dispute_total_records == 1) {
                                                    echo "$dispute_total_records" . "&nbsp;" . Items;
                                                } else if ($dispute_total_records > 1) {
                                                    echo "$dispute_total_records" . "&nbsp;" . Dispute;
                                                } else
                                                    echo "No Dispute";
                                                ?> )</td>
                                    </table>
                            <tr><td>
                                    <table width="100%" cellpadding="0" cellspacing="2" align="center" border="0">
                                        <?php
                                        if ($dispute_total_records > 0) {
                                            ?>
                                            <form name="dispute_form" action="viewdispute.php" method=post>
                                                <tr bgcolor="#eeeee1">
                                                <input type="hidden" name="len" value="<?php = $dispute_total_records ?>">
                                                <input type="hidden" name="type" value="<?php = $type ?>">
                                                <td class="tr_botborder" ><b>Dispute opened on</b> </td>
                                                <td  class="tr_botborder" colspan="2" ><b>Party Ids </b>  </td>
                                                <td class="tr_botborder" colspan="2" ><b>Other's party Ids</b> </td>
                                                <td  class="tr_botborder" ><b>Credit Eligibility</b>  </td>
                                                <td  class="tr_botborder" ><b>Action</b>  </td>
                                                </tr>
                                                <?php
                                                $dispute_res = mysql_query($dispute_sql);
                                                while ($dispute_row = mysql_fetch_array($dispute_res)) {
                                                    if ($dispute_row['distute_bid_id']) {
                                                        $bid_sql = "select * from placing_bid_item where bid_id=" . $dispute_row['distute_bid_id'];
                                                        $bid_res = mysql_query($bid_sql);
                                                        $bid = mysql_fetch_array($bid_res);
                                                        if ($bid[user_id] != $userid) {
                                                            $user_sql = "select * from user_registration where user_id=" . $bid['user_id'];
                                                            $user_res = mysql_query($user_sql);
                                                            $user = mysql_fetch_array($user_res);
                                                            $disputed_by = "buyer";
                                                        }

                                                        $bid_sql = "select * from placing_item_bid where item_id=" . $dispute_row['itemid'];
                                                        $bid_res = mysql_query($bid_sql);
                                                        $bid = mysql_fetch_array($bid_res);

                                                        $seller_sql = "select * from user_registration where user_id=" . $bid['user_id'];
                                                        $seller_res = mysql_query($seller_sql);
                                                        $seller = mysql_fetch_array($seller_res);
                                                        $disputed_by = "seller";
                                                    }
                                                    ?>
                                                    <tr bgcolor="#eeeee1">
                                                        <td class="tr_botborder_1" >
                                                            <?php
                                                            $custom_date = explode(" ", $dispute_row[dispute_date]);
                                                            $custom_date1 = $custom_date[0];
                                                            $custom_time = $custom_date[1];
                                                            $custom_date3 = substr($custom_date1, "-2");
                                                            $custom_date2 = explode("-", $custom_date1);
                                                            $custom_date1 = $custom_date2[0];
                                                            $custom_date2 = $custom_date2[1];
                                                            $custom_date4 = $custom_date3 . "-" . "$custom_date2" . "-" . "$custom_date1" . " " . "$custom_time";
                                                            echo $custom_date4;
                                                            ?>
                                                        </td>
                                                        <td class="tr_botborder_1" colspan="2">
                                                            <a href="userdetails.php?id=<?php = $seller['user_id']; ?>&type=gen" style="color:#484848;text-decoration:none;" style="color:#484848;text-decoration:none;">
                                                                <?php
                                                                if ($seller['user_name'])
                                                                    echo $seller['user_name'];
                                                                ?>
                                                            </a>
                                                        </td>
                                                        <td class="tr_botborder_1" colspan="2">
                                                            <a href="userdetails.php?id=<?php = $user['user_id']; ?>&type=gen" style="color:#484848;text-decoration:none;" style="color:#484848;text-decoration:none;">
                                                                <?php if ($user['user_name']) echo $user['user_name']; ?>
                                                            </a>
                                                        </td>
                                                        <td class="tr_botborder_1"  style="padding-left:50px">
                                                            <?php
                                                            if ($dispute_row[dispute_status] == "open") {
                                                                $img_flag = "check(29).gif";
                                                            } else if ($dispute_row[dispute_close_status] == "granted") {
                                                                $img_flag = "checkout_arrow.gif";
                                                            } else if ($dispute_row[dispute_close_status] == "eligible") {
                                                                $img_flag = "check(359).gif";
                                                            }
                                                            if ($dispute_row[dispute_close_status] != "notapplicable") {
                                                                if (!empty($img_flag)) {
                                                                    ?>
                                                                    <img src="images/<?php = $img_flag ?>">
                                                                    <?php
                                                                }
                                                            } else
                                                                echo $img_flag = "--";
                                                            ?>

                                                        </td>

                                                        <td class="tr_botborder_1">
                                                            <a href="#" id="dislink" onClick="window.open('edit_dispute.php?dispute_id=<?php = $dispute_row[dispute_id] ?>&i=1', 'pop_up', 'toolbar=no, top=0,location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=500, height=400')" style="color:#484848;text-decoration:none">Edit dispute</a>
                                                        </td>
                                                    </tr>

                                                    <tr bgcolor="#eeeee1">
                                                        <td class="tr_botborder_1" colspan=5 align="left">
                                                            <a href="<?php if ($dispute_row[selling_method] != ads) { ?>item_details.php<?php } else { ?>item_details.php<?php } ?>?id=<?php = $dispute_row['item_id'] ?>" style="color:#484848;text-decoration:none">
                                                                <?php echo $bid['item_title']; ?></a>&nbsp;(<?php echo $dispute_row['itemid']; ?> )</td>
                                                        <td class="tr_botborder_1">&nbsp;</td> <td class="tr_botborder_1">
                                                            <a href="#" id="dislink" onClick="window.open('view_user_dispute.php?dispute_id=<?php = $dispute_row[dispute_id] ?>&i=1', 'pop_up', 'toolbar=no, top=0,location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=500, height=400')" style="color:#484848;text-decoration:none">View dispute</a>
                                                        </td> </tr>
                                                    <?php
                                                    /* if($dispute_row[dispute_status]=='closed')
                                                      { */
                                                    ?>
                                                    <tr bgcolor="#eeeee1">
                                                        <td class="tr_botborder_1" colspan=7 align="right" style="padding-right:30px;">
                                                            <a href="viewdispute.php?id=<?php = $dispute_row[dispute_id] ?>&type=unpaid" style="color:#484848;text-decoration:none">Delete Dispute</a>
                                                        </td> </tr>
                                                    <?php
//}
                                                } // while
                                                ?>

                                            </form>

                                            <tr bgcolor="#eeeee1"><td colspan="4" style="padding-left:5px"><b>Legend :</b>Final Value Fee credit eligibility: </td>
                                                <td colspan="3" align="center">&nbsp;-- Not applicable &nbsp;<img src="images/check(29).gif">&nbsp;&nbsp;Pending&nbsp;<img src="images/check(359).gif">&nbsp;&nbsp;Eligible&nbsp;<img src="images/checkout_arrow.gif">&nbsp;&nbsp;Granted  </td>
                                            </tr>
                                            <tr bgcolor="#eeeee1"> <td class="tr_botborder_1" colspan="7">&nbsp;</td> </tr>
                                            <?php
                                        } else {
                                            ?>
                                            <tr bgcolor="#eeeee1">
                                                <td class="tr_botborder_1" colspan=5 align="left">There are no dispute in this section</td>
                                            </tr>
                                            <?php
                                        }
                                        ?>

                                    </table>
                                </td></tr>
                        </table>
                    </td></tr>
                <?php
            }  // if($type=="in") 
            ?>

            <!------ Inbox ------------------------------>

            <!------ Outbox ------------------------------>
            <?php
            if ($type == "notreceived") {
                ?>
                <tr><td>
                        <table cellpadding="0" cellspacing="0" class=border2>
                            <tr><td class="tr_border" height=30 width=750 id=watchingdetails>
                                    <table cellpadding="5" cellspacing="2" width=650>
                                        <tr bgcolor="#eeeee1">
                                            <td align="left" class="font_white" bgcolor="#eeeee1" colspan="2"><b>&nbsp;&nbsp;Items not Received  :&nbsp;&nbsp;&nbsp;</b>( 
                                                <?php
                                                if ($dispute_total_records == 1) {
                                                    echo "$dispute_total_records" . "&nbsp;" . Items;
                                                } else if ($dispute_total_records > 1) {
                                                    echo "$dispute_total_records" . "&nbsp;" . Dispute;
                                                } else
                                                    echo "No Dispute";
                                                ?> )</td>
                                            </td></tr></table>
                                </td></tr>
                            <tr>
                                <td>
                                    <table width="100%" cellpadding="5" cellspacing="0" >
                                        <?php
                                        if ($dispute_total_records > 0) {
                                            ?>
                                            <form name="dispute_form" action="viewdispute.php" method=post>
                                                <tr>
                                                <input type="hidden" name="len" value="<?php = $dispute_total_records ?>">
                                                <input type="hidden" name="type" value="<?php = $type ?>">
                                                <td class="tr_botborder" style="text-align:center"><b>Dispute opened on</b> </td>
                                                <td  class="tr_botborder" colspan="2" style="text-align:center"><b>Party Ids </b>  </td>
                                                <td class="tr_botborder" colspan="2" style="text-align:center"><b>Other party's Id</b> </td>
                                                <td  class="tr_botborder" style="text-align:center"><b>Credit Eligibility</b>  </td>
                                                <td  class="tr_botborder" style="text-align:center"><b>Action</b>  </td>
                                                </tr>
                                                <?php
//echo $dispute_sql;
                                                $dispute_res = mysql_query($dispute_sql);
                                                while ($dispute_row = mysql_fetch_array($dispute_res)) {
                                                    if ($dispute_row['distute_bid_id']) {
                                                        $bid_sql = "select * from placing_bid_item where bid_id=" . $dispute_row['distute_bid_id'];
                                                        $bid_res = mysql_query($bid_sql);
                                                        $bid = mysql_fetch_array($bid_res);
                                                        if ($bid[user_id] != $userid) {
                                                            $user_sql = "select * from user_registration where user_id=" . $bid['user_id'];
                                                            $user_res = mysql_query($user_sql);
                                                            $user = mysql_fetch_array($user_res);
                                                            $disputed_by = "buyer";
                                                        }

                                                        $bid_sql = "select * from placing_item_bid where item_id=" . $dispute_row['itemid'];
                                                        $bid_res = mysql_query($bid_sql);
                                                        $bid = mysql_fetch_array($bid_res);

                                                        $seller_sql = "select * from user_registration where user_id=" . $bid['user_id'];
                                                        $seller_res = mysql_query($seller_sql);
                                                        $seller = mysql_fetch_array($seller_res);
                                                        $disputed_by = "seller";
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td class="tr_botborder_1" >
                                                            <?php
                                                            $custom_date = explode(" ", $dispute_row[dispute_date]);
                                                            $custom_date1 = $custom_date[0];
                                                            $custom_time = $custom_date[1];
                                                            $custom_date3 = substr($custom_date1, "-2");
                                                            $custom_date2 = explode("-", $custom_date1);
                                                            $custom_date1 = $custom_date2[0];
                                                            $custom_date2 = $custom_date2[1];
                                                            $custom_date4 = $custom_date3 . "-" . "$custom_date2" . "-" . "$custom_date1" . " " . "$custom_time";
                                                            echo $custom_date4;
                                                            ?>
                                                        </td>
                                                        <td class="tr_botborder_1" colspan="2">
                                                            <a href="userdetails.php?id=<?php = $user['user_id']; ?>&type=gen" style="text-decoration:none; color:#000000">
                                                                <?php if ($user['user_name']) echo $user['user_name']; ?>
                                                            </a>
                                                        </td>
                                                        <td class="tr_botborder_1" colspan="2">
                                                            <a href="userdetails.php?id=<?php = $seller['user_id']; ?>&type=gen" style="text-decoration:none; color:#000000">
                                                                <?php if ($seller['user_name']) echo $seller['user_name']; ?>
                                                            </a>
                                                        </td>

                                                        <td class="tr_botborder_1"  style="padding-left:50px">
                                                            <?php
                                                            /* if($dispute_row[dispute_status]=="open")
                                                              {
                                                              $img_flag="check(29).gif";
                                                              }
                                                              else if($dispute_row[dispute_status]=="granted")
                                                              {
                                                              $img_flag="checkout_arrow.gif";
                                                              }
                                                              else if($dispute_row[dispute_status]=="eligible")
                                                              {
                                                              $img_flag="check(359).gif";
                                                              }
                                                              if(!empty($img_flag))
                                                              { */
                                                            ?>
                                                        <!--<img src="images/<?php = $img_flag ?>">-->
                                                            <?php
                                                            /* }
                                                              else */
                                                            echo $img_flag = "--";
                                                            ?>

                                                        </td>

                                                        <td class="tr_botborder_1">
                                                            <a href="#" id="dislink" onClick="window.open('suspend_seller.php?dispute_id=<?php = $dispute_row[dispute_id] ?>&i=1', 'pop_up', 'toolbar=no, top=0,location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=500, height=400')">Suspend Seller Account</a>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="tr_botborder_1" colspan=5 align="left">
                                                            <a href="<?php if ($dispute_row[selling_method] != ads) { ?>item_details.php<?php } else { ?>item_details.php<?php } ?>?id=<?php = $dispute_row[11] ?>">
                                                                <?php echo $dispute_row['item_title']; ?></a>&nbsp;(<?php echo $dispute_row[11]; ?> )</td>
                                                        <td class="tr_botborder_1">&nbsp;</td> <td class="tr_botborder_1">
                                                            <a href="#" id="dislink" onClick="window.open('view_user_dispute.php?dispute_id=<?php = $dispute_row[dispute_id] ?>&i=1', 'pop_up', 'toolbar=no, top=0,location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=500, height=400')"  style="text-decoration:none; color:#000000">View dispute</a>
                                                        </td> </tr>
                                                    <!--adding delete option for dispute which has been closed.-->
                                                    <?php
                                                    /* if($dispute_row[dispute_status]=='closed')
                                                      { */
                                                    ?>
                                                    <tr>
                                                        <td class="tr_botborder_1" colspan=7 align="right" style="padding-right:70px;">
                                                            <a href="viewdispute.php?id=<?php = $dispute_row[dispute_id] ?>&type=notreceived" style="color:#484848;text-decoration:none">Delete Dispute</a>
                                                        </td> </tr>
                                                    <?php
//}
                                                } // while
                                                ?>

                                            </form>

                                            <tr><td colspan="4" style="padding-left:5px"><b>Legend :</b>Final Value Fee credit eligibility: </td></tr>
                                            <tr><td colspan="3" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-- Not applicable<br /> &nbsp;<img src="images/check(29).gif">&nbsp;&nbsp;Pending<br />&nbsp;<img src="images/check(359).gif">&nbsp;&nbsp;Eligible<br />&nbsp;<img src="images/checkout_arrow.gif">&nbsp;&nbsp;Granted<br />  </td>
                                            </tr>
                                            <tr> <td class="tr_botborder_1" colspan="7">&nbsp;</td> </tr>
                                            <?php
                                        } else {
                                            ?>
                                            <tr bgcolor="#eeeee1">
                                                <td class="tr_botborder_1" colspan=5 style="text-align:center">There are no dispute in this section</td>
                                            </tr>
                                            <?php
                                        }
                                        ?>

                                    </table>
                                </td></tr>
                        </table>
                    </td></tr>
                <?php
            }
            ?>
            <!------ Outbox ------------------------------>
        </table>

    </table>
</td></tr>


<?php require 'include/footer1.php'; ?>
</body>
</html>