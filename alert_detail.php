<?php

/* * *************************************************************************
 * File Name				:alert_detail.php
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
error_reporting(0);
require 'include/connect.php';

if (!isset($_SESSION['userid'])) {
    $link = "signin.php";
    $url = "alert.php";
    echo '<meta http-equiv="refresh" content="0;url=' . $link . '?url=' . $url . '">';
    exit();
}

$item_id = $_GET[item_id];
$type = $_GET[type];
$seller_id = $_GET[seller_id];
$buyer_id = $_GET[buyer_id];
$alert_id = $_GET[alert_id];
$up_user_alert = "update user_alert set delmode='0' where alert_id='$alert_id'";
$upsql_user_alert = mysql_query($up_user_alert);

$item_sql = "select * from placing_item_bid where item_id=$item_id";
$recordset = mysql_query($item_sql);
$record = mysql_fetch_array($recordset);

$user_sql = "select * from user_registration where user_id=$buyer_id";
$user_recordset = mysql_query($user_sql);
$user_record = mysql_fetch_array($user_recordset);
require 'include/top.php';
require'templates/alert_detail.tpl';
require 'include/footer.php';
?>