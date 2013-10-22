<?php
/* * *************************************************************************
 * File Name				:view_mail.php
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

if (!isset($_SESSION['userid'])) {
    $link = "signin.php";
    $url = "mail.php";
    echo '<meta http-equiv="refresh" content="0;url=' . $link . '?url=' . $url . '">';
    exit();
}

$qst_id = $_REQUEST['qst_id'];
$mode = $_REQUEST['mode'];
$vm = $_REQUEST['vm'];
$user_id = $_SESSION['userid'];
$title = "Details of item";
require 'include/top.php';
require 'include/view_mail_inc.php';

if ($mode == "in") {
    $mail_sql = "select * from ask_question where to_id=$user_id and statusin!='delete'";
    $mail_res = mysql_query($mail_sql);
    $mailin_total_records = mysql_num_rows($mail_res);
} else {
    $mailout_sql = "select * from ask_question where from_id=$user_id and statusout!='delete'";
    $mailout_res = mysql_query($mailout_sql);
    $mailout_total_records = mysql_num_rows($mailout_res);
}

if ($mode == in) {
    $sel_mail_sql = "select * from ask_question where qst_id=$qst_id";
    $sel_mail_res = mysql_query($sel_mail_sql);
    $sel_mail_row = mysql_fetch_array($sel_mail_res);
    if ($sel_mail_row[status] != "notification") {
        $up_mail_sts = "update ask_question set status='read' where qst_id=$qst_id";
        mysql_query($up_mail_sts);
    }
    if ($sel_mail_row[status] == "notification") {
        $up_mail_sts = "update ask_question set notifystatus='read' where qst_id=$qst_id";
        mysql_query($up_mail_sts);
    }
}
$site_admin = "select * from admin_settings where set_id=47";
$site_admin_res = mysql_query($site_admin);
$site_admin_row = mysql_fetch_array($site_admin_res);
$fromid = $site_admin_row[set_value];
$fromsitename = $site_admin_row[set_value];
require'templates/view_mail.tpl';
require'include/footer.php';
?>

</body>
</html>