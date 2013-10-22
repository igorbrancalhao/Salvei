<?php
/***************************************************************************
 *File Name				:hotitems_list.php
 *File Created			:Wednesday, June 21, 2006
 * File Last Modified	:Wednesday, June 21, 2006
 * Copyright			:(C) 2001 AJ Square Inc
 * Email				:licence@ajsquare.net
 * Software Language	:PHP
 * Version Created		:V 4.3.2
 * Programmers worked	:S.Priya, B.ReenaKumari, K.Shanmuga priya
 * Modified By			:B.Reena
 * $Id                  : memberlist.php,v 1.36.2.12 2006/02/07 20:42:51 grahamje Exp $
 ***************************************************************************/
 

/****************************************************************************
 
*      Licence Agreement: 
 
*     This program is a Commercial licensed software; 
*     you are not authorized to redistribute it and/or modify/and or sell it under any publication 
*     or license /or term it under the GNU General Public License as published by the Free Software Foundation;
*     either user and developer versions of the License, or (at your option) 
*     any later version is applicable for the same.
 
*****************************************************************************/
session_start();
error_reporting(0);
require 'include/connect.php';
require 'include/top.php';
$query="select * from placing_item_bid where status='Active' and picture1!='' and selling_method!='want_it_now' and selling_method!='ads'";

//$query="select * from placing_item_bid p, featured_items f where p.status='Active' and p.picture1!='' and p.bid_starting_date<=now() and p.expire_date>=now() and p.selling_method!='ads' and p.selling_method!='want_it_now' and f.home_feature='Yes' and p.item_id=f.item_id";
$currec=$_REQUEST['currec'];
$tab=mysql_query($query);
$count=mysql_num_rows($tab);
require 'templates/hotitems_list.tpl';
require 'include/footer.php';
?>
