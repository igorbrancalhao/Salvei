<?php

/* * *************************************************************************
 * File Name				:crosspromote.php
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
$item_id = $_REQUEST['item_id'];
$flag = $_REQUEST['flag'];
if ($flag == 1) {
    $items = " ";
    $coid = $_REQUEST['chkSub'];
    foreach ($coid as $cnid) {
        $items.=$cnid . ",";
//$sql="update placing_item_bid set crosspromote=$item_id where item_id=".$cnid;
//$sqlqry=mysql_query($sql);
    }
    $items = rtrim($items, ",");
    $sql = "update placing_item_bid set crosspromote='$items' where item_id=" . $item_id;
    $sqlqry = mysql_query($sql);
}
$sql = "select * from placing_item_bid where item_id=$item_id";
$res = mysql_query($sql);
$row = mysql_fetch_array($res);
$img = $row['picture1'];
$itemtitle = $row['item_title'];
$item_id = $row['item_id'];
$price = $row['cur_price'];


require 'include/top.php';
require 'templates/crosspromote.tpl';
require 'include/footer.php';
?>