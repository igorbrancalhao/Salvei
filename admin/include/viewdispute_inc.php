<?php
/* * *************************************************************************
 * File Name				:viewdispute_inc.php
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
require 'include/connect.php';

$type = $_REQUEST[type];
if ($type == "unpaid") {
//$dispute_sql="select * from disputeconsole where dispute_type='unpaid' and dispute_status!='closed' group by dispute_id order by dispute_id desc";
    $dispute_sql = "select * from disputeconsole where dispute_type='unpaid' group by dispute_id order by dispute_id desc";
} else {
//$dispute_sql="select * from disputeconsole a , placing_item_bid b ,placing_bid_item c where dispute_type='notreceived' and dispute_status!='closed' and b.item_id=a.itemid group by dispute_id order by dispute_id desc ";
    $dispute_sql = "select * from disputeconsole a , placing_item_bid b ,placing_bid_item c where dispute_type='notreceived' and b.item_id=a.itemid group by dispute_id order by dispute_id desc ";
}

$dispute_res = mysql_query($dispute_sql);
$dispute_total_records = mysql_num_rows($dispute_res);
$dispute_conf = $_REQUEST[dispute_conf];
// -------------- Delete Inbox--------------------------

if ($dispute_conf == "yes") {
    $items = $_POST[chkbox];
    $count = count($items);
    if ($count != 0) {
        foreach ($items as $item) {
            $up_sql = "update disputeconsole set status='delete' where qst_id=$item";
            mysql_query($up_sql);
        }
        /* $select_sql="select * from error_message where err_id =32";
          $select_tab=mysql_query($select_sql);
          $select_row=mysql_fetch_array($select_tab);
          $conf=$select_row[err_msg]; */
    }
}

// --------------End of Inbox Deletion --------------------------
?>
<script language="javascript">
    function dispute_del()
    {
        var where_to = confirm("Are U Sure U Want to delete the items?");
        if (where_to == true)
        {
            document.dispute_form.dispute_conf.value = "yes";

            document.dispute_form.submit();
        }
    }
    function selectall()
    {

        len = document.dispute_form.len.value;
        if (len == 1)
        {
            if (document.dispute_form.chkMain.checked == true)
                document.dispute_form.chkbox.checked = true;
            if (document.dispute_form.chkMain.checked == false)
                document.dispute_form.chkbox.checked = false;
        }
        else
        {
            for (i = 0; i < len; i++)
            {
                if (document.dispute_form.chkMain.checked == true)
                    document.dispute_form.chkbox[i].checked = true;
                if (document.dispute_form.chkMain.checked == false)
                    document.dispute_form.chkbox[i].checked = false;
            }
        }

    }
</script>