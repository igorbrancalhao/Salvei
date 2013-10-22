<?php
/* * *************************************************************************
 * File Name				:alert.php
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
require 'include/connect.php';
if (!isset($_SESSION['userid'])) {
    $link = "signin.php";
    $url = "alert.php";
    echo '<meta http-equiv="refresh" content="0;url=' . $link . '?url=' . $url . '">';
    exit();
}

if ($_POST['delete1']) {
    $chkbox = $_POST['chkbox'];
    $count = count($chkbox);
    if ($count != 0) {
        foreach ($chkbox as $alert) {
            $del = "update user_alert set alert_type='D' where alert_id=" . $alert;
            mysql_query($del);
            $msg = "Message(s) Successfully Deleted";
        }
    }
}
$title = "Alerts";
require 'include/top.php';
require 'templates/alert.tpl';
?>
<script language="javascript">
    function selectall()
    {
        len = document.alert_form.len.value;
        if (len == 1)
        {
            if (document.alert_form.chkMain.checked == true)
                document.alert_form.chkbox.checked = true;
            if (document.alert_form.chkMain.checked == false)
                document.alert_form.chkbox.checked = false;
        }
        else
        {
            for (i = 0; i <= len; i++)
            {
                if (document.alert_form.chkMain.checked == true)
                    document.alert_form.chkbox[i].checked = true;
                if (document.alert_form.chkMain.checked == false)
                    document.alert_form.chkbox[i].checked = false;
            }
        }

    }
    function del()
    {
        if (document.alert_form.chkbox.checked == false)
        {
            alert("Please select any item");
            return false;
        }
        var empty = 0;
        for (var k = 0; k < document.alert_form.chkbox.length; k++)
        {
            if (document.alert_form.chkbox[k].checked == false)
                empty = empty + 1;
        }
        if (document.alert_form.chkbox.length == empty)
        {
            alert("Please select Any item");
            return false;
        }
        var where_to = confirm("Are You Sure You Want to delete this alert?");
        if (where_to == true)
        {
            document.alert_form.delete1.value = "del";
            document.alert_form.submit();
        }
    }
</script>

