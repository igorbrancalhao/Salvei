<?php
/* * *************************************************************************
 * File Name				:Speciality.php
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
?>
<link href="include/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
    <!--
    .style1 {
        color: #666666;
        font-weight: bold;
    }
    .style3 {color: #666666; font-size: 11px; font-family:Arial, Helvetica, sans-serif}
    -->
</style>
<?php
require 'include/connect.php';
require 'include/top.php';
$mode = $_REQUEST[mode];
if ($mode == "mail") {
    $itemid = $_REQUEST['itemid'];
    $userid = $_REQUEST['userid'];

    $admin_sql = "select * from admin_settings where set_id='3'";
    $admin_sqlqry = mysql_query($admin_sql);
    $admin_fetch = mysql_fetch_array($admin_sqlqry);
    $adminmail = $admin_fetch['set_value'];

    $useremailid = "select * from user_registration where user_id='$userid'";
    $user_email_res = mysql_query($useremailid);
    $user_email_row = mysql_fetch_array($user_email_res);
    $seller_name = $user_email_row['user_name'];
    $mail_to = $user_email_row['email'];


    $mailsubject = "Finalsalevaluefee Remainder";
    $mailbody = "Dear " . $seller_name . ",<br>This is a finalsalevalue fee payment remainder for the item id:" . $itemid . ".<br>Please Login to your account and click the pay link to make the payment.<br>Regards,<br>Admin<br>";

    $headers = "MIME-Version: 1.0\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\n";
    $headers .= "From: " . $adminmail . "\n";

    $mail = mail($mail_to, $mailsubject, $mailbody, $headers);
//$mail=1;
    if ($mail)
        $mes = "Mail send Successfully to the user";
}

$get_res = mysql_query("select * from placing_item_bid a,auction_fees b,placing_bid_item c where status='Closed' and a.item_id=b.item_id and a.item_id=c.item_id and c.item_id=b.item_id and b.feestatus='0' and (b.finalsalevalue_fee!=0 and b.finalsalevalue_fee!='0.00' and b.finalsalevalue_fee!=' ') group by c.item_id");
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#cecfc8">
    <tr><td>
            <table border="0" cellpadding="0" cellspacing="0" width="760" align="center"  bgcolor="#E8E8E8">
                <tr> 
                    <td height="24" colspan="2" class="txt_users"><center>Finalvalue Fee Payment</center></td>
    </tr><tr><td>
            <table align="center" width="98%" class="border2" cellpadding="2">
                <form name="frm" method="post" enctype="multipart/form-data" action="whatsnew.php">
                    <tr bgcolor="#eeeee1" > 
                        <td height="24" colspan="5"><b>You Can view the Finalsalevalue fee payment fee pending by Sellers.</b></td>
                    </tr>
                    <tr bgcolor="#eeeee1" > 
                        <td colspan="5" align="center"><font color="#FF0000">
                            <?php
                            if ($mes != '')
                                echo $mes;
                            ?>
                            </font>
                        </td></tr>
                    <tr bgcolor="#eeeee1"> 
                        <td height="24" ><b>Item Id</b></td>
                        <td height="24"><b>User name</b></td>
                        <td height="24"><b>Amount</b></td>
                        <td height="24"><b>Date</b></td>
                        <td height="24"><b>Action</b></td>
                    </tr>

                    <?php
                    while ($get_row = mysql_fetch_array($get_res)) {
                        $useremailid = "select * from user_registration where user_id=" . $get_row['1'];
                        $user_email_res = mysql_query($useremailid);
                        $user_email_row = mysql_fetch_array($user_email_res);
                        $seller_name = $user_email_row['user_name'];
                        ?>
                        <tr bgcolor="eeeee1">
                            <td>#<?php = $get_row['0']; ?></td>
                            <td><?php = $seller_name; ?></td>
                            <td><?php = $get_row['finalsalevalue_fee']; ?></td>
                            <td><?php = $get_row['sale_date']; ?></td>
                            <td><span style="background-color:#FFCC00; text-decoration:none" id="link3"><a href="finalfeeview.php?mode=mail&itemid=<?php = $get_row['0']; ?>&userid=<?php = $get_row['1']; ?>" id="link3">Send Remainder</a></span></td>
                        </tr>
                        <?php
                    }
                    ?>
          <!--<tr bgcolor="eeeee1"><td colspan="3" style="text-align:center">
          <a href="#" style="text-decoration:none"  onclick="window.open('addspeciality.php','pop_up','toolbar=no, top=0,location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, width=500, height=400')"><span style="background-color:#FFCC00; text-decoration:none" id="link3"><b>Add</b></span></a>
          </td></tr>	-->
                    <!--</form>-->
            </table></td></tr></table>
</td></tr></table>		
<?php
require 'include/footer1.php';
?>
