<?php
/* * *************************************************************************
 * File Name				:mail_inc.php
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
$mode = $_REQUEST['mode'];
if (empty($mode))
    $mode = "in";
if ($mode == "in") {
    $mail_sql = "select * from ask_question where to_id=$user_id and statusin!='delete'  order by qst_id desc";
    $mail_res = mysql_query($mail_sql);
    $mail_total_records = mysql_num_rows($mail_res);
}
if ($mode == "out") {
    $mail_sql = "select * from ask_question where from_id=$user_id and statusout='sent' order by qst_id desc";
    $mail_res = mysql_query($mail_sql);
    $mail_total_records = mysql_num_rows($mail_res);
}

$mail_conf = $_REQUEST[mail_conf];
$mail_conf1 = $_REQUEST[mail_conf1];

// -------------- Delete Inbox --------------------------

if ($mail_conf == "yes") {
    $items = $_POST[chkbox];
    $count = count($items);
    if ($count != 0) {
        foreach ($items as $item) {
            $up_sql = "update ask_question set statusin='delete' where qst_id=$item";
            mysql_query($up_sql);
        }

        /* $select_sql="select * from error_message where err_id =32";
          $select_tab=mysql_query($select_sql);
          $select_row=mysql_fetch_array($select_tab);
          $conf=$select_row[err_msg]; */
    }
}

// --------------End of Inbox Deletion --------------------------
// -------------- Delete Outbox--------------------------
if ($mail_conf1 == "yes") {
    $items = $_POST[chkbox];
    $count = count($items);
    if ($count != 0) {
        foreach ($items as $item) {
            $up_sql = "update ask_question set statusout='delete' where qst_id=$item";
            mysql_query($up_sql);
        }

        /* $select_sql="select * from error_message where err_id =32";
          $select_tab=mysql_query($select_sql);
          $select_row=mysql_fetch_array($select_tab);
          $conf=$select_row[err_msg]; */
    }
}
// --------------End of Outbox Deletion --------------------------
?>
<script language="javascript">
    function mail_del()
    {
        if (document.mail_form.chkbox.checked == false)
        {
            alert("Please select any item");
            return false;
        }
        var empty = 0;
        for (var k = 0; k < document.mail_form.chkbox.length; k++)
        {
            if (document.mail_form.chkbox[k].checked == false)
                empty = empty + 1;
        }
        if (document.mail_form.chkbox.length == empty)
        {
            alert("Please select Any Message");
            return false;
        }
        var where_to = confirm("Are U Sure U Want to delete the items?");
        if (where_to == true)
        {
            document.mail_form.mail_conf.value = "yes";
            document.mail_form.submit();
        }
        else
            return false;
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
    function mail_del1()
    {

        if (document.mail_form.chkbox.checked == false)
        {
            alert("Please select any item");
            return false;
        }
        var empty = 0;
        for (var k = 0; k < document.mail_form.chkbox.length; k++)
        {
            if (document.mail_form.chkbox[k].checked == false)
                empty = empty + 1;
        }
        if (document.mail_form.chkbox.length == empty)
        {
            alert("Please select Any Message");
            return false;
        }
        var where_to = confirm("Are U Sure U Want to delete the items?");
        if (where_to == true)
        {
            document.mail_form.mail_conf1.value = "yes";
            document.mail_form.submit();
        }
        else
            return false;

        /*var where_to= confirm("Are U Sure U Want to delete the items?");
         if (where_to== true)
         {
         document.mail_form.mail_conf1.value="yes";
         document.mail_form.submit();
         }*/
    }
</script>