<?php

/* * *************************************************************************
 * File Name				:transactions.php
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
if (!isset($_SESSION[userid])) {
    $link = "signin.php";
    $url = "transactions.php";
    echo '<meta http-equiv="refresh" content="0;url=' . $link . '?url=' . $url . '">';
    echo "You have been Re-Directed, if not please <a href=$link?$url>Click here</a>";
    exit();
}

$default_currency = "select * from admin_settings where set_id=59";
$default_res = mysql_query($default_currency);
$default_row = mysql_fetch_array($default_res);
$default_cur = $default_row['set_value'];

$user_id = $_SESSION[userid];
$pay_delete = $_REQUEST[pay_delete];

$pay_sql = "select * from pay_transaction where user_id=$user_id";
$pay_res = mysql_query($pay_sql);
$pay_total_records = mysql_num_rows($pay_res);
// require 'include/pay_inc.php'; 

$title = "Transaction Details";
require 'include/detail_top.php';

require'templates/transaction.tpl';
?>
