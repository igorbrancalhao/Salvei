<?php
/***************************************************************************
 *File Name				:wantitnowdes.php
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
session_start();
error_reporting(0);
$title="Details of Wanted Ad";
require 'include/top.php';
require 'include/connect.php'; 
$user_id=$_SESSION[userid];
if($_GET)
$item_id=$_GET['item_id'];
else if($_POST) 
$item_id=$_POST['item_id'];
$mode=$_GET[mode];
$bid_sql="select * from placing_item_bid where item_id=".$item_id;
$bid_res=mysql_query($bid_sql);
$row=mysql_fetch_array($bid_res);

$high_feed_sql="select count(*) as feedbacktotal from feedback where feedback_to=".$row['user_id'];
$high_feed_recordset=mysql_query($high_feed_sql);
$high_feed_tot=mysql_fetch_array($high_feed_recordset);
$feedbackicon_sql="select * from membership_level where feedback_score_from <= "." $high_feed_tot[feedbacktotal] "." and  feedback_score_to >= "." $high_feed_tot[feedbacktotal] " ;  
 $feedbackicon_res=mysql_query($feedbackicon_sql);
 $feedbackicon_row=mysql_fetch_array($feedbackicon_res); 
 $feedback_img=$feedbackicon_row[icon];
   
   
   
 $tot_sql="select count(*) from placing_bid_item where item_id=".$item_id;
 $tot_res=mysql_query($tot_sql);
 $tot=mysql_fetch_array($tot_res);
 $feed_sql="select count(*) as feedbacktotal from feedback where feedback_to=".$row[user_id]." and feedback_type='Positive'";
 $feed_recordset=mysql_query($feed_sql);
 $feed_tot=mysql_fetch_array($feed_recordset);
   $feedbackicon_sql="select * from membership_level where feedback_score_from <= "." $high_feed_tot[feedbacktotal] "." and  feedback_score_to >= "." $high_feed_tot[feedbacktotal] " ;  
 $feedbackicon_res=mysql_query($feedbackicon_sql);
 $feedbackicon_row=mysql_fetch_array($feedbackicon_res); 
 $feedback_img=$feedbackicon_row[icon];
 
 
$user_sql="select * from user_registration where user_id=".$row['user_id'];
$user_res=mysql_query($user_sql);
$user=mysql_fetch_array($user_res);


// Fetching country name //
$countryid=$user['country'];
$sql_country="select * from country_master where country_id=".$countryid;
$sqlqry_country=mysql_query($sql_country);
$fetch_country=mysql_fetch_array($sqlqry_country);
$country=$fetch_country['country'];


// fetch  category name of the item

$cat="select category_name from category_master where category_id=".$row['category_id'];
$cat_res=mysql_query($cat);
$cat_row=mysql_fetch_array($cat_res);

if($row['category_id'])
{
$cat_sql="select * from category_master where category_id=".$row['category_id'];
$cat_sql_res=mysql_query($cat_sql);
$cat_sql_row=mysql_fetch_array($cat_sql_res);
if($cat_sql_row[category_head_id])
{
$cat_sql1="select * from category_master where category_id=".$cat_sql_row[category_head_id];
$cat_sql_res1=mysql_query($cat_sql1);
$cat_sql_row1=mysql_fetch_array($cat_sql_res1);
}

}

require'templates/wantitnowdes.tpl';
require 'include/footer.php';					
?>

