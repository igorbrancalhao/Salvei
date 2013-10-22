<?php
/* * *************************************************************************
 * File Name				:bid_details.php
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
?> 
<html>
    <head>
        <title>Admin</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link rel="stylesheet" type="text/css" href="style/style.css">
    </head>
    <body>
        <?php
        require 'include/top.php';
        $item_id = $_GET[item_id];
        $item_sql = "select * from placing_item_bid where item_id=" . $item_id;
        $item_res = mysql_query($item_sql);
        $item_result = mysql_fetch_array($item_res);
        ?>
        <table border="0" align="center" cellpadding="0" cellspacing="0" width="100%" bgcolor="#cecfc8">
            <tr valign="middle" bgcolor="#CCCCCC">
                <td height="34" class="txt_users">
            <center>Bidding Details of <?php = $item_result[item_title]; ?></center></td></tr>
    <tr><td>
            <table border="0" align="center" cellpadding="3" cellspacing="2" width="98%" class="border2">
                <tr bgcolor="#CCCCCC">
                    <td><b>Buyer Id </b></td>
                    <td><b> Bid Amount  </b> 
                    </td><td><b> Quantity  </b>  </td>
                    <td><b> Date </b>  </td>
                </tr>
                <?php
                if ($item_id == '') {
                    echo '<meta http-equiv="refresh" content="0;url=sorry.php">';
                    exit();
                }

                $sql = "select * from placing_bid_item where item_id=" . $item_id;
                $res = mysql_query($sql);
                while ($result = mysql_fetch_array($res)) {
                    $user = "select * from user_registration where user_id=$result[user_id]";
                    $user_res = mysql_query($user);
                    $user_rec = mysql_fetch_array($user_res);
                    ?> 
                    <tr bgcolor="eeeee1">
                        <td><?php = $user_rec[user_name]; ?></td>
                        <td align="center"><?php = $result[bidding_amount]; ?> </td>
                        <td><?php = $result[quantity] ?></td>
                        <td><?php = $result[bidding_date] ?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </td></tr>
    <tr><td><br></td></tr></table>
<?php require'include/footer.php'; ?>
</body>
</html>
