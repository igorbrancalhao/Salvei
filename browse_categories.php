<?php

/* * *************************************************************************
 * File Name				:browse_cate.php
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
/*
  file name:browse_cate.php;
  date	  :6.7.05
  Created by:priya
  Rights reserved by AJ Square inc
 */
session_start();
require 'include/connect.php';

function cat_display($ssid, $cat) {
    $ss_sql = "select * from category_master where category_head_id=$ssid";
    $sub_res = mysql_query($ss_sql);
    while ($cat_row = mysql_fetch_array($sub_res)) {
        $cat_row[category_id];
        $cat = $cat_row[category_id] . " or category_id=";
        if ($cat_row['category_id']) {
            $ssid = $cat_row['category_id'];
            $_SESSION[catt] = $_SESSION[catt] . "$cat";
            cat_display($ssid, $cat);
        }
    }
}

$sql = "select * from category_master where category_head_id=0 order by category_name";
$res = mysql_query($sql);
$tot_rec = mysql_num_rows($res);
$first_part = round($tot_rec / 2);
$count = 1;

$title = "Browse Categories";
//require 'include/top.php';
require 'templates/browse_categories.tpl';
?>

