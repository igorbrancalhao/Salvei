<?php
/***************************************************************************
 *File Name				:cat_inc.php
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
$_SESSION['catt']=" ";
$cat="category_id=";
 
                          function cat_display($ssid,$cat)
                            {
 							$ss_sql="select * from category_master where category_head_id=$ssid";
 							$sub_res=mysql_query($ss_sql);
    						while($cat_row=mysql_fetch_array($sub_res))
    						{
     						$cat_row['category_id'];
     						$cat=$cat_row[category_id]." or category_id=";
     						if($cat_row['category_id'])
	 						{
	  						$ssid=$cat_row['category_id'];
	  						$_SESSION['catt']=$_SESSION['catt']."$cat";
	  						cat_display($ssid,$cat);
	 						}
   							}
  							}

 if($tot_rec>0)
 {
     $_SESSION['catt']=" ";
     $cat="category_id=$cate_id or category_id= ";
	 $_SESSION['catt']=$cat;
	 while($cat_row=mysql_fetch_array($res))
     {
      $ssid=$cat_row['category_id'];
	  if($ssid)
      {
	  $cat=$ssid." or category_id=";
    //  cat_display($ssid,$cat);
      $cat=$_SESSION['catt'];
      }
	  $cat=rtrim($cat," or category_id=");
 }
 }
 else
 {
 $cat="category_id=$cate_id";
 }
if($view=="list")
{
  if($mode=='want')
  {
  if($cat!="category_id=")
  {
   $item_sql="select * from placing_item_bid where ( $cat ) and status='Active' and bid_starting_date and expire_date and selling_method='want_it_now' "; 
  }
  else
$item_sql="select * from placing_item_bid where status='Active' and bid_starting_date and expire_date and selling_method='want_it_now' "; 
  }
  else
  {
  if($cat!="category_id=")
  {
   $item_sql="select * from placing_item_bid where ( $cat ) and status='Active' and bid_starting_date and expire_date  and selling_method!='want_it_now' "; 
  }
  else
$item_sql="select * from placing_item_bid where status='Active' and bid_starting_date and expire_date and selling_method!='want_it_now' "; 
  } 
}
else
{

if($mode=='want')
  {
   if($cat!="category_id=")
  {
  $item_sql="select a.* from placing_item_bid a, featured_items b where $cat and gallery_feature='Yes' and a.item_id=b.item_id and status='Active' and bid_starting_date and expire_date and a.selling_method='want_it_now' group by a.item_id "; 
  }
  else
  {
  $item_sql="select a.* from placing_item_bid a, featured_items b where  gallery_feature='Yes' and a.item_id=b.item_id and status='Active' and bid_starting_date and expire_date and a.selling_method='want_it_now' group by a.item_id "; 
   }
   }
   else
   {
    if($cat!="category_id=")
  {
  $item_sql="select a.* from placing_item_bid a, featured_items b where ($cat) and gallery_feature='Yes' and a.item_id=b.item_id and status='Active' and bid_starting_date and expire_date and a.selling_method!='want_it_now' group by a.item_id "; 
  }
  else
  {
  $item_sql="select a.* from placing_item_bid a, featured_items b where  gallery_feature='Yes' and a.item_id=b.item_id and status='Active' and bid_starting_date and expire_date and a.selling_method!='want_it_now' group by a.item_id "; 
   }
   
   }
   
  
} 
 $item_sql.="order by expire_date"; 
// echo "test". "$item_sql";
 
 $recordset=mysql_query($item_sql);
 $total_records=mysql_num_rows($recordset);
 $rec_sql="select  * from admin_settings where set_id=54";
 $rec_res=mysql_query($rec_sql);
 $rec_row=mysql_fetch_array($rec_res); 
 $limitsize=$rec_row['set_value']; 
 //$limitsize=1;

 if($total_records>0)
 { 
//get the total records
if(strlen($currec)==0) //check firstpage 
$currec = 1;  
$start = ($currec - 1) * $limitsize;
$end = $limitsize;
$item_sql .=" limit $start,$end";
$recordset=mysql_query($item_sql);
//$total_records=mysql_num_rows($recordset);
}


 ?>
