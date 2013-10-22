<?php
/* * *************************************************************************
 * File Name				:view_mail_inc.php
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
require 'include/connect.php';
$user_id = $_SESSION['userid'];
$mode1 = $_REQUEST['mailmode'];
$checkmode = $_REQUEST['checkmode'];
$curpage = $_REQUEST['curpage'];
$mail_sql = "select * from ask_question where qst_id=$qst_id";

if ($curpage == '')
    $curpage = 1;
$start = ($curpage - 1) * 1;
$end = 1;
if ($curpage == '' || $curpage == 1)
    $i = 1;
else
    $i = $_GET['sno'] + 1;

$mail_res = mysql_query($mail_sql);
$mail_row = mysql_fetch_array($mail_res);
$mail_total_records = mysql_num_rows($mail_res);


if ($mail_row[from_id]) {
    $user_sql = "select * from user_registration where user_id=" . $mail_row[from_id];
    $user_res = mysql_query($user_sql);
    if ($user_res) {
        $user_row = mysql_fetch_array($user_res);
    } else {
        $user_row[user_name] = "Admin";
    }
}

$to_user_sql = "select * from user_registration where user_id=" . $mail_row[to_id];
$to_user_res = mysql_query($to_user_sql);
$to_user_row = mysql_fetch_array($to_user_res);

$item_sql = "select * from placing_item_bid where item_id=" . $mail_row[item_id];
$item_res = mysql_query($item_sql);
$item_row = mysql_fetch_array($item_res);


if (empty($mail_row['answer']) and !empty($mail_row['question']))
    $message = $mail_row['question'];
else if (!empty($mail_row['answer']) and !empty($mail_row['question']))
    $message = $mail_row['answer'];

// -------------- Delete Inbox--------------------------


if ($mail_conf == "yes") {
    $items = $_POST[chkbox];
    $count = count($items);
    if ($count != 0) {
        foreach ($items as $item) {
            $up_sql = "update ask_question set status='delete' where qst_id=$item";
            mysql_query($up_sql);
        }
    }
}

// --------------End of Inbox Deletion --------------------------
// -------------- Delete Inbox--------------------------


if ($mode1 == "delete") {

    $item = $_REQUEST['qst_id'];
    if ($checkmode == "in")
        $up_sql = "update ask_question set statusin='delete' where qst_id=$item";
    else {
        $up_sql = "update ask_question set statusout='delete' where qst_id=$item";
        $checkmode = 'out';
    }
    mysql_query($up_sql);
    echo '<meta http-equiv="refresh" content="0;url=mail.php?mode=' . $checkmode . '">';
    /* echo "You have been Re-Directed, if not Please <a href=mail.php?mode=in>Click here</a>"; */
    exit();
}

// --------------End of Inbox Deletion --------------------------
?>
<script language="javascript">
    function mail_del()
    {
        var where_to = confirm("Are U Sure U Want to delete the items?");
        if (where_to == true)
        {
            document.mail_form.mail_conf.value = "yes";
            document.mail_form.submit();
        }
    }
    function selectall()
    {

        len = document.mail_form.len.value;
        if (len == 1)
        {
            if (document.mail_form.chkMain.checked == true)
                document.mail_form.chkbox.checked = true;
            if (document.mail_form.chkMain.checked == false)
                document.mail_form.chkbox.checked = false;
        }
        else
        {
            for (i = 0; i < len; i++)
            {
                if (document.mail_form.chkMain.checked == true)
                    document.mail_form.chkbox[i].checked = true;
                if (document.mail_form.chkMain.checked == false)
                    document.mail_form.chkbox[i].checked = false;
            }
        }

    }
</script>