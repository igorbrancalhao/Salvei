<?php
/* * *************************************************************************
 * File Name				:suspend_seller.php
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
require'include/connect.php';
$dispute_id = $_REQUEST[dispute_id];

if ($_REQUEST[flag] == 1) {
    $dispute_sql = "select * from disputeconsole where dispute_id=" . $dispute_id;
    $dispute_res = mysql_query($dispute_sql);
    $dispute_row = mysql_fetch_array($dispute_res);


    $bid_sql = "select * from placing_bid_item where  bid_id=" . $dispute_row[distute_bid_id];
    $bid_res = mysql_query($bid_sql);
    $bid = mysql_fetch_array($bid_res);
    $bid_date = $bid['bidding_date'];
    $item_id = $bid['item_id'];

    $bid_sql = "select * from placing_item_bid where item_id=" . $bid['item_id'];
    $bid_res = mysql_query($bid_sql);
    $bid = mysql_fetch_array($bid_res);

    if ($_REQUEST[radpermission] == "suspended") {
        $upsql = "update user_registration set status='$_REQUEST[radpermission]' where user_id=" . $bid['user_id'];
        $status = mysql_query($upsql);

        $upsql = mysql_query("update placing_item_bid set status='suspended' where user_id=$bid[user_id] and status='Active'");
        $mailTo_qry = mysql_query("select * from user_registration where user_id=$bid[user_id]");
        $mailTo_res = mysql_fetch_array($mailTo_qry);
        $mailTo = $mailTo_res['email'];


        $sitename_qry = mysql_query("select * from admin_settings where set_id='1'");
        $sitename_res = mysql_fetch_array($sitename_qry);
        $sitename = $sitename_res['set_value'];

        $mailfrom_qry = mysql_query("select * from admin_settings where set_id='3'");
        $mailfrom_res = mysql_fetch_array($mailfrom_qry);
        $mailfrom = $mailfrom_res['set_value'];
        $mailSubject = "Account Suspended";
        $mailbody = "Your account has been suspended from " . $sitename;


        $headers = "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\n";
        $headers .= "From: " . $mailfrom . "\n";



        $mail = mail($mailTo, $mailSubject, $mailbody, $headers);
    }
    if ($_REQUEST[radpermission] == "Active") {
        $upsql = "update user_registration set status='$_REQUEST[radpermission]' where user_id=" . $bid['user_id'];
        $status = mysql_query($upsql);
    }
}
?>
<table cellpadding="0" cellspacing="0" border="0" width=100% class="table_border1">
    <br />
    <?php
    if ($status) {
        ?>
        <font color="#FF0000">Updated Successfully................</font>
        <form name=frm action="suspend_seller.php" method="post">
            <input type="button" onClick="window.close()" value="Close">
        </form>
        <?php
        exit();
    }
    ?>
    <tr><td>Are you sure do you want to suspend the user? </td></tr>
    <tr><td style="padding-left:10px">
            <form name=frm action="suspend_seller.php" method="post">
                <input type="hidden" name=flag  value=1>
                <input type="radio" name=radpermission value="Active">No
                <input type="radio" name=radpermission value="suspended">Yes
                <input type="hidden" name=dispute_id value=<?php = $dispute_id ?> ></td></tr>
                <tr><td>
                        <input type="submit" value=Update>&nbsp;&nbsp;
                        <input type="button" onClick="window.close()" value="Close">
            </form>
        </td></tr>
</table>
