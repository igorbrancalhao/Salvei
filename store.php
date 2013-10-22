<?php
/***************************************************************************
 *File Name				:store.php
 *File Created				:Wednesday, June 21, 2006
 * File Last Modified			:Wednesday, June 21, 2006
 * Copyright				:(C) 2001 AJ Square Inc
 * Email				:licence@ajsquare.net
 * Software Language			:PHP
 * Version Created			:V 4.3.2
 * Programmers worked	        	:S.Priya, B.ReenaKumari, K.Shanmuga priya
 * $Id                                  : memberlist.php,v 1.36.2.12 2006/02/07 20:42:51 grahamje Exp $
 *
 ***************************************************************************/
 

/****************************************************************************
 
*      Licence Agreement: 
 
*     This program is a Commercial licensed software; 
*     you are not authorized to redistribute it and/or modify/and or sell it under any publication 
*     or license /or term it under the GNU General Public License as published by the Free Software Foundation;
*     either user and developer versions of the License, or (at your option) 
*     any later version is applicable for the same.
 
*****************************************************************************/
 ?>
<?php
session_start();
error_reporting(0);
require 'include/connect.php';
require 'include/top.php'; 
$userid=$_SESSION['userid'];
$id=$_GET[id];
$currec=$_GET[currec];
$store_sql="select * from storefronts where user_id=$id";
$store_res=mysql_query($store_sql);
$store_row=mysql_fetch_array($store_res);
$sql="select * from placing_item_bid  where  status=\"Active\" and selling_method!='want_it_now' and user_id=$id";
$result=@mysql_query($sql);
$total_records=@mysql_num_rows($result);

$rec_sql="select  * from admin_settings where set_id=54";
$rec_res=mysql_query($rec_sql);
$rec_row=mysql_fetch_array($rec_res); 
$limitsize=$rec_row[set_value]; 
 		
require 'templates/store.tpl';
?>
		  