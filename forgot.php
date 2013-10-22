<?php

/* * *************************************************************************
 * File Name				:forgot.php
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

$query_site = "select * from admin_settings where set_id = 1";
$table_site = mysql_query($query_site);
$fetch_site = mysql_fetch_array($table_site);
$site_name = $fetch_site['set_value'];

//Fetching mail header image
$queryheader = "select * from admin_settings where set_id = 61";
$tableheader = mysql_query($queryheader);
$rowheader = mysql_fetch_array($tableheader);
$mailheader = $site_name . "/" . $rowheader['set_value'];

//Fetching mail footer image
$queryfooter = "select * from admin_settings where set_id = 62";
$tablefooter = mysql_query($queryfooter);
$rowfooter = mysql_fetch_array($tablefooter);
$mailfooter = $site_name . "/" . $rowfooter['set_value'];

if ($_POST['canSend'] == 1) {
    $passwordhelp = $_POST['txtEmail'];
    $sql = "select user_name,password from user_registration where email='$passwordhelp'";
    $result = mysql_query($sql);

    $admin = "select * from admin_settings where set_id=3"; //sitename -> id=1
    $admin_res = mysql_query($admin);
    $admin_rec = mysql_fetch_array($admin_res);
    $mailfrom = $admin_rec['set_value'];



    if (mysql_num_rows($result) > 0) {
        $row = mysql_fetch_array($result);
        $username = $row['user_name'];
        $pasnum = rand(0, 100000);
        $password = $username . $pasnum;
        $pass1 = crypt($password);
        $up_pas_sql = "update user_registration set password='$pass1' where user_name='$username'";
        //mysql_query($up_pas_sql);
        $mailto = $passwordhelp;
        $admin = "select * from admin_settings where set_id=3";
        $admin_res = mysql_query($admin);
        $admin_row = mysql_fetch_array($admin_res);
        $mailfrom = $admin_row['set_value'];
        $mailsubject = "Your New Login Info";

        $mailbody = "<table width=700 style=\"border-left:1px solid #CCCCCC;border-top:1px solid #CCCCCC; 
border-right:1px solid #cccccc; border-bottom:1px solid #cccccc\"><tr><td><img src='<imgh>'></td></tr>";

        $mailbody .= "<tr><td>Dear $username,<br> Here is your new Login Info<br>If you wish you can login and change your password</td></tr>";
        $mailbody .= "<tr><td>User Name: " . $username . "</td></tr>";
        $mailbody .= "<tr><td>Password : " . $password . "</td></tr>";
        $mailbody .="<tr><td><img src='<imgf>'></td></tr></table>";
        $mailbody = str_replace("<imgh>", $mailheader, $mailbody);
        $mailbody = str_replace("<imgf>", $mailfooter, $mailbody);

        $headers = "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\n";
        $headers .= "From: " . $mailfrom . "\n";

        mail($mailto, $mailsubject, $mailbody, $headers);
        $status = 1; // send successfully
        $sent_message = "Your Login info has been sent to your Email Id";
    } else {
        $status = 2; // send failure;
    }
}
$title = "Forgot Password";
require 'include/top.php';
require 'templates/forgot.tpl';
require 'include/footer.php';
?>
