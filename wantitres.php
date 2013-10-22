<?php
/***************************************************************************
 *File Name				:wantitres.php
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
require 'include/connect.php';
$userr_id=$_SESSION[userid];
$mode=$_POST[mode];
$item_id=$_POST['item_id'];
$responed_item_id=$_POST['txtResItem'];

if($mode=="set")
{
$item_sql="select * from placing_item_bid where item_id='$responed_item_id' and user_id='$userr_id' and status='Active' and bid_starting_date <= now()";
$item_res=mysql_query($item_sql);
$item_rows=mysql_num_rows($item_res);
if($item_rows > 0)
{
 $sqlitem="select count(*) from want_it_now where responseed_itemid=$responed_item_id and  wanted_itemid=".$item_id;
 $sqlqryitem=mysql_query($sqlitem);
 $sqlqryrow=mysql_fetch_array($sqlqryitem);
 $rows=$sqlqryrow[0];
 if($rows>=1)
 {
 $err_flag2=1;
 }
$item_row=mysql_fetch_array($item_res);
if($item_row['selling_method']=='want_it_now')
{
 $err_flag1="1";
}
}
else
{
$err_flag="1";
}


 if($err_flag!=1 && $err_flag1!=1 && $err_flag2!=1)
 {
 $date=date("Y-m-d h:i:s");
  $in_sql="insert into want_it_now(wanted_itemid,responseed_itemid,response_date) values('$item_id','$responed_item_id','$date')";
 $in_res=mysql_query($in_sql);
 }   
}

require 'include/top.php';
require 'templates/wantitres.tpl';
require 'include/footer.php';
?>
