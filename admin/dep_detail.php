<?php
/* * *************************************************************************
 * File Name				:dep_detail.php
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
?>
<style type="text/css">
    <!--
    .style1 {
        color: #666666;
        font-weight: bold;
    }
    .style3 {color: #666666; font-size: 11px; font-family:Arial, Helvetica, sans-serif}
    -->
</style>
<link href="include/style.css" rel="stylesheet" type="text/css">
<?php
require 'include/connect.php';
require 'include/top.php';
$pay_id = $_GET['id'];
$mode = $_GET['mode'];
$secsql = "select * from pay_transaction order by trans_date";
$secres = mysql_query($secsql);
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#cecfc8">
    <tr><td>
            <table border="0" cellpadding="0" cellspacing="0" width="760" align="center"  bgcolor="#E8E8E8">
                <tr><td colspan="2" class="txt_users" style="text-align:center"><b><br />Transaction Detail<br /><br /></b></td></tr>
                <tr><td>
                        <table width="96%"  border="0" cellpadding="5" cellspacing="1" class="border2" align="center">
                            <tr bgcolor="#eeeee1"><td colspan="6" style="text-align:center"><b>Transaction Details</b></td></tr>
                            <tr bgcolor="#eeeee1"><td><b>User Id</b></td><td><b>Transaction Type</b><td><b>Transaction Date</b></td><td><b>Batch Number</b></td><td><b>Amount</b></td> <td><b>Delete</b></td></tr>

                            <?php
                            if ($mode == 'delete') {
                                $sql1 = "delete from pay_transaction where pay_id='$pay_id'";
                                $del = mysql_query($sql1);
                                if ($del)
                                    $message = "Transaction deleted sucessfully";
                                else
                                    $message = "Transaction not deleted ";
                            }
                            $mode = '';
                            if (!empty($message)) {
                                echo "<tr><td align=center colspan=3><font color=red size=2>$message</font></td></tr>";
                            }


                            if (mysql_num_rows($secres) > 0) {
                                while ($secrow = mysql_fetch_array($secres)) {
                                    ?>
                                    <tr bgcolor="eeeee1"><td><?php = $secrow['user_id'] ?></td><td><?php = $secrow['trans_type'] ?></td><td><?php = $secrow['trans_date'] ?></td><td><?php = $secrow['trans_batchnumber'] ?></td><td><?php = $secrow['trans_amount'] ?></td><td><div align="left" class="style3">
                                                <a href="dep_detail.php?id=<?php = $secrow['pay_id']; ?>&mode=delete"  id="link1" style="text-decoration:none" onClick="javascript:return condelete();">Delete</a></div></td></tr>
                                                <?php
                                            }
                                        } else
                                            echo "<tr bgcolor='eeeee1'><td align='center' colspan='4'><center>No Transactions</center></td></tr>";
                                        ?>
                        </table>
                    </td></tr></table>
        </td></tr>
    <?php
    require 'include/footer1.php';
    ?>
    <script language="JavaScript">
        function condelete()
        {
            var confrm;
            confrm = window.confirm("Are You sure you want to delete this transaction");
            return confrm;
        }

    </script>