<?php

/* * *************************************************************************
 * File Name				:paysuccess.php
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
?>
<?php

session_start();
require 'include/connect.php';
if (strlen($_POST) > 0 || $_SESSION['amount'] != '') {
    $amount = $_SESSION['totalprice'];
    $user_id = $_SESSION['userid'];
    $account = $_SESSION['account'];
    $item_id = $_SESSION['item_id'];
    /* $up_sql="update placing_bid_item set payment_status='paid' where item_id=$item_id and user_id=$user_id";
      $res=mysql_query($up_sql); */
    $up_sql = "update placing_item_bid set payment_status='paid' where item_id=$item_id";
    $res = mysql_query($up_sql);
    $mode = "won";
    $getdate = date("Y-m-d");
    if ($res) {
        $getdate = date("Y:m:d");
        $up_sql = "insert into pay_transaction(user_id,itemid,trans_date,trans_amount,trans_type) values('$_SESSION[userid]','$item_id','$getdate','$amount','buyitem')";
        mysql_query($up_sql);
        echo '<meta http-equiv="refresh" content="0;url=detailstatistics.php?user_id=' . $user_id . '&mode=' . $mode . '">';
    }
    // exit(); 
    $_SESSION['amount'] = '';
    $_SESSION['payment'] = '';
} else {
    $err_message = "Sorry, Your Payment was not Made Sucessfully";
}
exit();
?>

