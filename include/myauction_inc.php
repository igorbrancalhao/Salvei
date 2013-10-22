<?php
/***************************************************************************
 *File Name				:myauction_inc.php
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
error_reporting(0);
require 'include/connect.php';
$itemid=$_REQUEST['itemid'];
$mode=$_REQUEST['mode'];
$itemfind=$_REQUEST['itemfind'];
$status=$_REQUEST['status'];

$default_currency="select * from admin_settings where set_id=59";
$default_res=mysql_query($default_currency);
$default_row=mysql_fetch_array($default_res);
$default_cur=$default_row['set_value'];

//search in wantitnow///
if($itemid and ($mode=="want"))
{
$sql="select * from placing_item_bid where item_id=$itemid";
$sqlqry=mysql_query($sql);
$sqlfetch=mysql_fetch_array($sqlqry);
$catid=$sqlfetch['category_id'];
echo '<meta http-equiv="refresh" content="0;url=category.php?cate_id='.$catid.'&view=list&mode=want">';
exit();
}
//End of search in wantitnow//

 if($itemid and ($mode=="relist"))
{
function adddays12($date,$interval) 
{ 
 // if (!isset($date)) 
  $date = date("Y-m-d"); 
  $elts = explode("-", $date); 
  $inter=$interval*24*3600; 
  $dcour=mktime(1,0,0,$elts[1],$elts[2],$elts[0]); 
  $dres=$dcour+$inter; 
  $date1=date("Y-m-d",$dres);
  $sec=date("G:i:s");
  $ret_date="$date1"." "."$sec";
  return $ret_date; 
}
$query="SELECT * FROM `placing_item_bid` WHERE item_id=$itemid";
$tab=mysql_query($query);
while($row=mysql_fetch_array($tab))
{
$cur=date("Y-m-d G:i:s");
// $date=$row[expire_date];
$dur=$row[duration];
$expiredate=adddays12($cur,$dur);
$item_id=$row[item_id];
$query="update placing_item_bid set expire_date='$expiredate',no_of_repost=no_of_repost - 1,bid_starting_date='$cur'  where item_id ='$item_id'";
$qry=mysql_query($query);
}

if($qry)
{
echo '<meta http-equiv="refresh" content="0;url=myauction.php?mode=relisting">';
//echo "Your Item has been Relisted";
}
}
$itemid_close=$_REQUEST[item_id];

if($itemid_close and ($mode=="close_relist"))
{
function adddays123($date,$interval) 
{ 
  $date = date("Y-m-d"); 
  $elts = explode("-", $date); 
  $inter=$interval*24*3600; 
  $dcour=mktime(1,0,0,$elts[1],$elts[2],$elts[0]); 
  $dres=$dcour+$inter; 
  $date1=date("Y-m-d",$dres);
  $sec=date("G:i:s");
  $ret_date="$date1"." "."$sec";
  return $ret_date; 
}
$query="SELECT * FROM `placing_item_bid` WHERE status='Closed' and item_id=$itemid_close";
$tab=mysql_query($query);
while($row=mysql_fetch_array($tab))
{
$cur=date("Y-m-d G:i:s");
$date=$row['expire_date'];
$dur=$row['duration'];
$expiredate=adddays123($date,$dur);
$item_id=$row['item_id'];
$query=" update placing_item_bid set expire_date = '$expiredate',no_of_repost=no_of_repost - 1,bid_starting_date='$cur',status='Active'  where item_id ='$item_id'";
$qry=mysql_query($query);

if($row['selling_method']=='fix')
{
$query="update placing_item_bid set cur_price=".$row['quick_buy_price']." where item_id =".$item_id;
$qry=mysql_query($query);
}
else if(($row['selling_method']=='auction') || ($row['selling_method']=='dutch_auction'))
{
$query="update placing_item_bid set cur_price=".$row['min_bid_amount']." where item_id =".$item_id;
$qry=mysql_query($query);
}

$del_bidding="delete from placing_bid_item where item_id=".$item_id;
$delqry_bidding=mysql_query($del_bidding);

$del_askqus="delete from ask_question where item_id=".$item_id;
$delqry_askqus=mysql_query($del_askqus);
}
if($qry)
{
echo '<meta http-equiv="refresh" content="0;url=myauction.php?mode=close_relisting">';
//echo "Your Item has been Relisted";
exit();
}
}



//Add to Description///
if($itemid and ($mode=="des"))
{
 $sql="select * from placing_item_bid where item_id=$itemid";
 $sqlqry=mysql_query($sql);
 $sqlfetch=mysql_fetch_array($sqlqry);
 $expiry_date=$sqlfetch[expire_date];
 require 'ends.php';
 $string_difference;
 $sqlbid="select * from placing_bid_item where item_id=$itemid";
 $sqlqrybid=mysql_query($sqlbid);
 $sqlfetchrow=mysql_fetch_row($sqlqrybid);
if(empty($sqlfetchrow))
{
echo '<meta http-equiv="refresh" content="0;url=myauction.php">';
}
else
{
echo '<meta http-equiv="refresh" content="0;url=changedes.php?item_id='.$itemid.'">';
}
exit();
}
//End of Add Description//
$itemid=$_REQUEST['itemid'];
if($itemid and ($mode=="promote"))
{
echo '<meta http-equiv="refresh" content="0;url=crosspromote.php?item_id='.$itemid.'">';
exit();
}


$item_id=$_REQUEST['item_id'];
/* if($item_id)
{
echo '<meta http-equiv="refresh" content="0;url=detail.php?item_id='.$item_id.'">';
exit();
} */
$edit_status=$_REQUEST['edit_status'];
if(!isset($_SESSION['username']))
{ 
$link="signin.php";
$url="myauction.php";
echo '<meta http-equiv="refresh" content="0;url='.$link.'?url='.$url.'">';
echo "You have been Re-Directed, if not please <a href=$link?$url>Click here</a>";
exit();
}
$currec=$_GET['currec']; 

$user_id=$_SESSION['userid'];
$mode=$_REQUEST['mode'];
$won_delete=$_REQUEST['won_delete'];
$want_delete=$_REQUEST['want_delete'];
$watch_delete=$_REQUEST['delete1'];
$open_delete=$_REQUEST['open_delete'];
$close_delete=$_REQUEST['close_delete'];
$bid_delete=$_REQUEST['bid_delete'];
    
//// -------------------- delete open item --------------
 if($open_delete)
 {
 $item_id=$_REQUEST['item_id'];
$sqldel_open="select picture1,picture2,picture3,picture4,picture5,picture6,picture7 from placing_item_bid where item_id=".$item_id;
 $sqlqrydel_open=mysql_query($sqldel_open);
 $sqlfetchdel_open=mysql_fetch_array($sqlqrydel_open);
 if(!empty($sqlfetchdel_open['picture1']))
 {
 unlink("images/".$sqlfetchdel_open['picture1']);
 unlink("thumbnail/".$sqlfetchdel_open['picture1']);
 }
  if(!empty($sqlfetchdel_open['picture2']))
 {
 unlink("images/".$sqlfetchdel_open['picture2']);
 unlink("thumbnail/".$sqlfetchdel_open['picture2']);
 }
  if(!empty($sqlfetchdel_open['picture3']))
 {
 unlink("images/".$sqlfetchdel_open['picture3']);
 unlink("thumbnail/".$sqlfetchdel_open['picture3']);
 }
  if(!empty($sqlfetchdel_open['picture4']))
 {
 unlink("images/".$sqlfetchdel_open['picture4']);
 unlink("thumbnail/".$sqlfetchdel_open['picture4']);
 }
  if(!empty($sqlfetchdel_open['picture5']))
 {
 unlink("images/".$sqlfetchdel_open['picture5']);
 unlink("thumbnail/".$sqlfetchdel_open['picture5']);
 }
  if(!empty($sqlfetchdel_open['picture6']))
 {
 unlink("images/".$sqlfetchdel_open['picture6']);
 unlink("thumbnail/".$sqlfetchdel_open['picture6']);
 }
  if(!empty($sqlfetchdel_open['picture7']))
 {
 unlink("images/".$sqlfetchdel_open['picture7']);
 unlink("thumbnail/".$sqlfetchdel_open['picture7']);
 }
 
 
 $del_sql="delete from watch_list where item_id=".$item_id;
 mysql_query($del_sql);
 $del_sql="delete from want_it_now where responseed_itemid=".$item_id;
 mysql_query($del_sql);
 $del_sql="delete from placing_item_bid where item_id=".$item_id;
 mysql_query($del_sql);
 $del_sql="delete from placing_bid_item where item_id=".$item_id;
 mysql_query($del_sql);
 $del_sql="delete from auction_fees where item_id=".$item_id;
 mysql_query($del_sql);
 $del_sql="delete from featured_items where item_id=".$item_id;
 mysql_query($del_sql);
 $del_sql="delete from ask_question where item_id=".$item_id;
 mysql_query($del_sql);
 $del_sql="delete from user_alert where item_id=".$item_id;
 mysql_query($del_sql);
 $del_sql="delete from want_it_now where item_id=".$item_id;
 mysql_query($del_sql);
 $mode="sell";
 $status="Active";
 }
 
 //-------------------------- delete close item -----------------------
 
 if($close_delete)
 {
 $item_id=$_REQUEST['item_id'];
 
 $sqldel_open="select picture1,picture2,picture3,picture4,picture5,picture6,picture7 from placing_item_bid where item_id=".$item_id;
 $sqlqrydel_open=mysql_query($sqldel_open);
 $sqlfetchdel_open=mysql_fetch_array($sqlqrydel_open);
 if(!empty($sqlfetchdel_open['picture1']))
 {
 unlink("images/".$sqlfetchdel_open['picture1']);
 unlink("thumbnail/".$sqlfetchdel_open['picture1']);
 }
  if(!empty($sqlfetchdel_open['picture2']))
 {
 unlink("images/".$sqlfetchdel_open['picture2']);
 unlink("thumbnail/".$sqlfetchdel_open['picture2']);
 }
  if(!empty($sqlfetchdel_open['picture3']))
 {
 unlink("images/".$sqlfetchdel_open['picture3']);
 unlink("thumbnail/".$sqlfetchdel_open['picture3']);
 }
  if(!empty($sqlfetchdel_open['picture4']))
 {
 unlink("images/".$sqlfetchdel_open['picture4']);
 unlink("thumbnail/".$sqlfetchdel_open['picture4']);
 }
  if(!empty($sqlfetchdel_open['picture5']))
 {
 unlink("images/".$sqlfetchdel_open['picture5']);
 unlink("thumbnail/".$sqlfetchdel_open['picture5']);
 }
  if(!empty($sqlfetchdel_open['picture6']))
 {
 unlink("images/".$sqlfetchdel_open['picture6']);
 unlink("thumbnail/".$sqlfetchdel_open['picture6']);
 }
  if(!empty($sqlfetchdel_open['picture7']))
 {
 unlink("images/".$sqlfetchdel_open['picture7']);
 unlink("thumbnail/".$sqlfetchdel_open['picture7']);
 }
 
 
 $del_sql="delete from watch_list where item_id=".$item_id;
 mysql_query($del_sql);
 $del_sql="delete from want_it_now where responseed_itemid=".$item_id;
 mysql_query($del_sql);
 $del_sql="delete from placing_item_bid where item_id=".$item_id;
 mysql_query($del_sql);
 $del_sql="delete from placing_bid_item where item_id=".$item_id;
 mysql_query($del_sql);
 $del_sql="delete from auction_fees where item_id=".$item_id;
 mysql_query($del_sql);
 $del_sql="delete from featured_items where item_id=".$item_id;
 mysql_query($del_sql);
 $del_sql="delete from ask_question where item_id=".$item_id;
 mysql_query($del_sql);
 $del_sql="delete from user_alert where item_id=".$item_id;
 mysql_query($del_sql);
 $del_sql="delete from want_it_now where item_id=".$item_id;
 mysql_query($del_sql);
 
 $mode="sell";
 $status="Closed";
 }
 
 
 
  //-------------------------- delete wantitnow item -----------------------
 
 if($want_delete)
 {
 $item_id=$_REQUEST['item_id'];
 $sqldel_open="select picture1 from placing_item_bid where item_id=".$item_id;
 $sqlqrydel_open=mysql_query($sqldel_open);
 $sqlfetchdel_open=mysql_fetch_array($sqlqrydel_open);
 if(!empty($sqlfetchdel_open['picture1']))
 {
 unlink("images/".$sqlfetchdel_open['picture1']);
 unlink("thumbnail/".$sqlfetchdel_open['picture1']);
 }

 $del_sql="delete from placing_item_bid where item_id=".$item_id;
 mysql_query($del_sql);
 $del_sql="delete from want_it_now where wanted_itemid=".$item_id;
 mysql_query($del_sql);
 $del_sql="delete from ask_question where item_id=".$item_id;
 mysql_query($del_sql);
 
 $mode="want";
 $status="Active";
 }
 
 
 
 //------------------------ delete bidding item--------------------------
 
 if($bid_delete)
 {
 echo '<meta http-equiv="refresh" content="0;url=bid_retract.php">';
 echo "You have been Re-Directed, if not please <a href=bid_retract.php>Click here</a>";
 exit();
 }
 
// ------------------ bidding items  ----------------

 $bidding_sql="select * from placing_bid_item a,placing_item_bid b where a.user_id=$user_id and user_pos='No' and a.item_id=b.item_id and b.status='Active' and a.deleted='No' group by a.item_id";
 $bid_res=mysql_query($bidding_sql);
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
// -------------- Delete Won items--------------------------

if($won_delete=="yes")
{
    $items=$_POST['chkbox'];
	$count=count($items);
    if($count!=0)
    {
	foreach($items as $item)
     {
	  $won_up="update placing_bid_item set won_status='1' where item_id=$item";
	  mysql_query($won_up);
     }   
   } 
}

// -------------- end of Delete Won items--------------------------



// -------------- Delete Watch items --------------------------

if($watch_delete=="del")
{
     $items=$_POST['chkbox'];
	 $count=count($items);
    if($count!=0)
    {
	foreach($items as $item)
     {
	   $del_sql="delete from watch_list where watchlist_id=".$item;
       mysql_query($del_sql);
     }   
	 
	 
    echo '<meta http-equiv="refresh" content="0;url=myauction.php?mode=watching">';
   // echo "You have been Re-Directed, if not please <a href=myauction.php?mode=watching>Click here</a>";
    exit();
   } 
}

// -------------- end of Delete Watch items--------------------------




// --------- Didn't win -----------------------------------------
$didntwin_sql="select * from placing_bid_item a,placing_item_bid b where b.selling_method!='want_it_now' and  a.user_id=$user_id and a.item_id=b.item_id and a.user_pos='No' and b.status='Closed'";
$didntwin_res=mysql_query($didntwin_sql);
$didntwin_total_records=mysql_num_rows($didntwin_res);


// ----------------------- end of didn't win ---------------------


//------------------------ watching -----------------------------

//$watch_sql="select * from watch_list where user_id=$user_id";
$watch_sql="select * from watch_list a, placing_item_bid b where a.user_id=$user_id and b.status='Active' and a.item_id=b.item_id";
$watch=mysql_query($watch_sql);
$watch_total_records=mysql_num_rows($watch);

//------------------------ end of watching -----------------------------

// ------------------- Opened  Auction  -----------------------------------------

$sell_sql="select * from placing_item_bid where user_id=$user_id and status='Active' and selling_method!='want_it_now' and selling_method!='ads'";
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


// ------------------- Sold  Auction  -----------------------------------------------

$sold_sql="select * from placing_bid_item a,placing_item_bid b where b.user_id=$user_id and a.item_id=b.item_id and quantity_sold > 0 and b.selling_method!='want_it_now' and (user_pos='Yes' or user_pos='Delete') group by b.item_id order by  sale_date desc";
$sold_res=mysql_query($sold_sql);
$sold_row=mysql_fetch_array($sold_res);
$sold_total_records=mysql_num_rows($sold_res);

// ------------------- end of Sold  Auction -----------------------------------------


// ------------------- Want It Now(open)  -----------------------------------------

$want_sql="select * from placing_item_bid where user_id=$user_id and status='Active' and selling_method='want_it_now'";
$want=mysql_query($want_sql);
$want_row=mysql_fetch_array($want);
$want_total_records=mysql_num_rows($want);

// ------------------- end of  Want It Now(open) -----------------------------------------


//$wat_total=mysql_num_rows($watch);
if($total_records>0)
{ 
//get the total records
if(strlen($currec)==0) 
$currec = 1;  
$start = ($currec - 1) * $limitsize;
$end = $limitsize;
$watch_sql .=" limit $start,$end";
$watch=mysql_query($watch_sql);
} 
?>
