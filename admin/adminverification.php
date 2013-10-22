<?php
/* * *************************************************************************
 * File Name				:addcountry.php
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
require 'include/connect.php';
$frm = $_POST["cate"];
$country = $_POST["cat"];
$mode = $_REQUEST[mode];
$countryid = $_REQUEST['id'];
?>
<html>
    <head>
        <title>Auction Admin Panel</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <style type="text/css">
            <!--
            @import url("stylesheet.css");
            .style1 {color: #FFFFFF}
            body {
                background-color: #999999;
            }
            -->
        </style>
    </head>
    <body >
        <div align="center">
            <!-- ImageReady Slices (auction_inner.psd) -->
            <table width="780" border="0" cellpadding="0" cellspacing="0" height="100">
                <tr>
                    <td><table id="Table_01" width="780"  border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td rowspan="2"><img src="images/index_01_01.jpg" width="109" height="125" alt=""></td>
                                <td rowspan="2"><img src="images/index_01_02.jpg" width="486" height="125" alt=""></td>
                                <td width="185" height="53" background="images/blackbg01.jpg" class="txt_header" style="padding-top:10px"><div align="center">Admin Control Panel V- 3.0</div></td>
                            </tr>
                            <tr>
                                <td width="185" background="images/blackbg02.jpg" style="padding-top:40px; padding-right:20px"><div align="right"><a href="logout.php"><img src="images/logout.gif" width="67" height="20" border="0"></a></div></td>
                            </tr>
                        </table></td>
                </tr>
                <tr>
                    <td><table id="Table_01" width="780"  border="0" cellpadding="0" cellspacing="0" height="10">
                            <tr>
                                <td ><table width="780" border="0" cellpadding="0" cellspacing="0" background="images/bg01.jpg">
                                        <tr>
                                            <td class="txt_welcomeadmin" style="padding-left:15px">Welcome Admin </td>
                                        </tr>
                                    </table></td>
                            </tr>
                            <tr>
                                <td><table id="Table_01" width="780"  border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td><table width="10" height="77" border="0" cellpadding="0" cellspacing="0" bgcolor="#cecfc8">
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                </table></td>
                                            <td><a href=home.php><img src="images/index_02_02_02.jpg" width="109" height="77" alt="" border=0 title="Home"></a></td>
                                            <td><a href=user.php><img src="images/index_02_02_03.jpg" width="105" height="77" alt="" border=0 title="Admin"></a></td>
                                            <td><a href=auction.php><img src="images/index_02_02_04.jpg" width="114" height="77" alt="" border=0 title="Auction"></a></td>
                                            <td><a href=mail.php?page=subjects>
                                                    <img src="images/index_02_02_05.jpg" width="94" height="77" alt="" border=0 title="Mail"></a></td>
                                            <td><a href=site.php?page=pay>
                                                    <img src="images/index_02_02_06.jpg" width="111" height="77" alt="" border=0 title="Finance"></a></td>
                                            <td><a href=ipblock.php><img src="images/index_02_02_07.jpg" width="107" height="77" alt="" border=0 title="Security"></a></td>
                                            <td><a href=frontpagebanner.php><img src="images/index_02_02_08.jpg" width="120" height="77" alt="" border=0 title="ControlManagement"></a></td>
                                            <td><table width="10" height="77" border="0" cellpadding="0" cellspacing="0" bgcolor="#cecfc8">
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                </table></td>
                                        </tr>
                                    </table></td>


                                <?php
//require 'include/top.php';
                                if (isset($_REQUEST['submit'])) {
                                    $verify_code = $_REQUEST['verifycode'];
                                    $sql_admin = "select * from admin where admin_id='1'";
                                    $sqlqry_admin = mysql_query($sql_admin);
                                    $fetch_admin = mysql_fetch_array($sqlqry_admin);
                                    $admin_verify = $fetch_admin['verifycode'];
                                    if ($admin_verify == $verify_code) {
                                        $user_id = $_SERVER['REMOTE_ADDR'];
                                        $today = date("y-m-d h:i:s");
                                        $sql_ins = "insert into tbl_ip(admin_id,user_ip,ip_date) values('1','$user_id','$today')";
                                        $sql_is = mysql_query($sql_ins);

                                        /*  Sending ip addres mail   */
//Fetching mail header image
                                        $queryheader = "select * from admin_settings where set_id = 61";
                                        $tableheader = mysql_query($queryheader);
                                        $rowheader = mysql_fetch_array($tableheader);
                                        $mailheader = $rowheader['set_value'];

//Fetching mail footer image
                                        $queryfooter = "select * from admin_settings where set_id = 62";
                                        $tablefooter = mysql_query($queryfooter);
                                        $rowfooter = mysql_fetch_array($tablefooter);
                                        $mailfooter = $rowfooter['set_value'];


                                        $admin_query = "select * from mail_subjects where mail_id=20";
                                        $admin_table = mysql_query($admin_query);
                                        if ($admin_row = mysql_fetch_array($admin_table)) {
                                            $message = $admin_row['mail_message'];
                                            $subject = $admin_row['mail_subject'];
                                            $mail_fro = $admin_row['mail_from'];
                                        }

                                        $site_query = "select * from admin_settings  where set_id='1'";
                                        $site_table = mysql_query($site_query);
                                        $site_row = mysql_fetch_array($site_table);
                                        $sitename = $site_row['set_value'];

                                        $ipaddress = $_SERVER['REMOTE_ADDR'];

                                        $message = str_replace("<site>", $sitename, $message);
                                        $message = str_replace("<ip>", $ipaddress, $message);
                                        $message = str_replace("<imgh>", $mailheader, $message);
                                        $message = str_replace("<imgf>", $mailfooter, $message);


                                        $sql_admin = "select * from admin_settings where set_id='3'";
                                        $sqlqry_admin = mysql_query($sql_admin);
                                        $sqlfetch_admin = mysql_fetch_array($sqlqry_admin);
                                        $mail_from = $sqlfetch_admin['set_value'];

                                        $headers = "MIME-Version: 1.0\n";
                                        $headers .= "Content-type: text/html; charset=iso-8859-1\n";
                                        $headers .= "From: " . $mail_fro . "\n";

                                        $mail = mail($mail_from, $subject, $message, $headers);

                                        /*  End of sending mail of ip address  */
                                        $_SESSION["adminuser"] = $_SESSION['username_admin'];
                                        echo '<meta http-equiv="refresh" content="0;url=home.php">';
                                        echo "<font size=+1 color=#003366>Loading....</font>";
                                        exit();
                                    } else {
                                        $err_flag = 1;
                                    }
                                }
                                ?>
                            <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" background="images/bg08.jpg">
                                <?php
                                if (!empty($err_flag)) {
                                    ?>
                                    <tr><td align="center"><font color="#FF0000"><br /><b>Verification code is Wrong.You cannot login into your account.</b></font></td></tr>
                                    <?php
                                }
                                ?>
                                <tr><td >
                                        <table width="90%"  border="0" cellpadding="10" cellspacing="0" align="center" height="90">
                                            <tr ><td align="center" class="txt_users">Admin Verification</td></tr>
                                            <tr><td align="center">A verification code has been send to your mail id.</td></tr>
                                            <tr><td align="center">Enter your Verification code to login into admin account</td></tr>
                                            <form name=verify action=adminverification.php method=post>
                                                <tr><td align="center"><strong>Verification Code:</strong><input type=text name=verifycode value=""></td></tr>
                                                <tr><td align="center"><input type=submit value="Submit" name=submit />
                                            </form>
                                        </table>
                                    </td></tr>
                            </table>

                            </form>
                            <?php
                            require 'include/footer1.php';
                            ?>