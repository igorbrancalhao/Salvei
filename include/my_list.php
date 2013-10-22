<?php
/***************************************************************************
 *File Name				:my_list.php
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
<?php  // error_reporting(0);
	$user_id=$_SESSION[userid];
    $reg_sql="select * from user_registration where user_id=$_SESSION[userid]";
	$reg_res=mysql_query($reg_sql);
	$reg_row=mysql_fetch_array($reg_res);
	$member_account=$reg_row[member_account];
	
	// ------------------ bidding items  ----------------
	
$bid_sql="select * from placing_bid_item a,placing_item_bid b where a.user_id=$user_id and user_pos='No' and a.item_id=b.item_id and b.status='Active' and a.deleted='No' group by a.item_id";
$bid_res=mysql_query($bid_sql);
$bid_total_records=mysql_num_rows($bid_res);

// ------------------- Won items -------------------------

 $won_sql="select * from placing_bid_item a,placing_item_bid b where a.user_id=$user_id and a.item_id=b.item_id and a.user_pos='Yes' and a.won_status='0' group by b.item_id";
$won_res=mysql_query($won_sql);
$won_total_records=mysql_num_rows($won_res);
if($won_total_records > 0)
{   
   $won_items_amt=0;
   while($won_row=mysql_fetch_array($won_res))
   {
       $won_items_amt+=($won_row['sale_price']*$won_row[3]);
   }
} 


//echo $didntwin_sql="select * from placing_bid_item a,placing_item_bid b where b.selling_method!='want_it_now' and  a.user_id=$user_id and a.item_id=b.item_id and a.user_pos='No' and b.status='Closed'";
$didntwin_sql="select * from placing_bid_item a,placing_item_bid b where a.user_id=$user_id and a.item_id=b.item_id and a.user_pos='No' and b.status='Closed' group by b.item_id";
$didntwin_res=mysql_query($didntwin_sql);
$didntwin_total_records=mysql_num_rows($didntwin_res);


//------------------------ watching -----------------------------

//$watch_sql="select * from watch_list where user_id=$user_id";
$watch_sql="select * from watch_list a, placing_item_bid b where a.user_id=$user_id and b.status='Active' and a.item_id=b.item_id";
$watch=mysql_query($watch_sql);
$watch_total_records=mysql_num_rows($watch);

//------------------------ end of watching -----------------------------

// ------------------- Opened  Auction  -----------------------------------------

$sell_sql="select * from placing_item_bid where user_id=$user_id and status='Active' and selling_method!='want_it_now'";
$sell=mysql_query($sell_sql);
$sell_row=mysql_fetch_array($sell);
$sell_total_records=mysql_num_rows($sell);

// ------------------- end of Opened  Auction   -----------------------------------------


// ------------------- Closed  Auction  -----------------------------------------

$close_sql="select * from placing_item_bid where user_id=$user_id and status='Closed' and selling_method!='want_it_now' and quantity_sold=0";
$close_res=mysql_query($close_sql);
$close_row=mysql_fetch_array($close_res);
$close_total_records=mysql_num_rows($close_res);

// ------------------- end of Closed  Auction -----------------------------------------


// ------------------- Sold  Auction  -----------------------------------------

$sold_sql="select * from placing_bid_item a,placing_item_bid b where b.user_id=$user_id and a.item_id=b.item_id and quantity_sold > 0 and b.selling_method!='want_it_now' and (user_pos='Yes' or user_pos='Delete') group by b.item_id order by  sale_date desc";
$sold_res=mysql_query($sold_sql);
$sold_row=mysql_fetch_array($sold_res);
$sold_total_records=mysql_num_rows($sold_res);

// ------------------- end of Sold  Auction -----------------------------------------


// ------------------- Inbox Calculation  -----------------------------------------
 $inbox_mail_sql="select * from ask_question where to_id=$user_id and statusin!='delete'  order by qst_id desc";

// $inbox_mail_sql="select * from ask_question where to_id=$user_id and status!='delete' ";
$inbox_mail_res=mysql_query($inbox_mail_sql);
$inbox_mail_total_records=mysql_num_rows($inbox_mail_res);

// ------------------- End Of Inbox Calculation  -----------------------------------------

// ------------------- Inbox Calculation -----------------------------------------
$outbox_mail_sql="select * from ask_question where from_id=$user_id and statusout='sent' order by qst_id desc";

// $outbox_mail_sql="select * from ask_question where from_id=$user_id and status='reply' ";
$outbox_mail_res=mysql_query($outbox_mail_sql);
$outbox_mail_total_records=mysql_num_rows($outbox_mail_res);

// ------------------- End Of Outbox Calculation -----------------------------------------

require 'templates/mylist.tpl';
?>
      
				       
