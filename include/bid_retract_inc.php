<?php
/***************************************************************************
 *File Name				:bid_retract_inc.php
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
require 'include/connect.php';
$flag=$_POST[flag];
$userid=$_SESSION[userid];
if(!isset($_SESSION[username]))
{ 
$link="signin.php";
$url="bid_retract.php";
echo '<meta http-equiv="refresh" content="0;url='.$link.'?url='.$url.'">';
echo "You have been Re-Directed, if not please <a href=$link?$url>Click here</a>";
exit();
}
if($flag)
{
$item_id=$_POST[ITEM];
$information=$_POST[INFO];
if($item_id)
{
$retractsql="select * from placing_bid_item where item_id='$item_id' and user_id='$userid'";
$retractres=mysql_query($retractsql);
$tot_rows=mysql_num_rows($retractres);
if($tot_rows > 0)
{
if(empty($information))
{
$inf_flag=1;
}
else
{
$retractsql="select max(bidding_amount) as amt from placing_bid_item where item_id='$item_id' and user_id='$userid' and deleted='No'";
$retractres=mysql_query($retractsql);
$retractrow=mysql_fetch_array($retractres);
$amt=$retractrow[amt];
$date=date("Y-m-d G:i:s");
$ins_retract="insert into retraction(retrack_date,retrack_amt,user_id,reason,item_id) values('$date','$amt','$userid','$information','$item_id') ";
mysql_query($ins_retract);
$up_sql="update placing_bid_item set deleted='Yes' where item_id=item_id and bidding_amount=$amt and user_id='$userid'";
mysql_query($up_sql);

/* Updation of current price */

$cursql="select max(bidding_amount) as amt from placing_bid_item where item_id='$item_id' and deleted='No'";
$curres=mysql_query($cursql);
$currow=mysql_fetch_array($curres);
$curamt=$currow['amt'];
if(empty($curamt) || $curamt=='0.00')
{
$sql_min="select min_bid_amount as curamt from placing_item_bid where item_id=".$item_id;
$sqlqry_min=mysql_query($sql_min);
$sqlfetch_min=mysql_fetch_array($sqlqry_min);
$curamt=$sqlfetch_min['curamt'];
}
$update_curprice="update placing_item_bid set curprice='$curamt' where item_id=".$item_id;
$updateqry_curprice=mysql_query($update_curprice);

/* End of Updation of current price */


$link="bidhistory.php";
echo '<meta http-equiv="refresh" content="0;url='.$link.'?item_id='.$item_id.'">';
echo "You have been Re-Directed, if not please <a href=$link?$item_id>Click here</a>";
exit();
}
}
else
{
$err_flag=1;
$item_id=0;
}
}
else
{
$err_flag=1;
$item_id=0;
}
}
?>