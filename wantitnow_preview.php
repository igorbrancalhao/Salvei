<?php
/***************************************************************************
 *File Name				:wantitnow_preview.php
 *File Name				:wantitnow.php
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

if(!isset($_SESSION['username']))
{ 
$link="signin.php";
$url="wantitnow.php";
echo '<meta http-equiv="refresh" content="0;url='.$link.'?url='.$url.'">';
exit();
}

$sql_user_status="select status from user_registration where user_id=".$_SESSION['userid'];
$sqlqry_user_status=mysql_query($sql_user_status);
$sqlfetch_user_status=mysql_fetch_array($sqlqry_user_status);
$userstatus=$sqlfetch_user_status[0];
if($userstatus=='suspended')
{
echo '<meta http-equiv="refresh" content="0;url=suspendmode.php">';
exit();
}

if(empty($_SESSION['item_name']) || empty($_SESSION['des']) || empty($_SESSION['categoryid']))
{
$link="myauction.php";
echo '<meta http-equiv="refresh" content="0;url='.$link.'">';
exit();
}


   $userid=$_SESSION['userid'];   
   $cat_id=$_SESSION['categoryid'];
   $item_title=$_SESSION['item_name'];
   $itemdes=$_SESSION['des'];
   $sell_method=$_SESSION['sell_method'];
   $dur=$_SESSION['dur'];
   $img1=$_SESSION['image1'];
 
   function addDay($date,$interval) 
{ 
  if (!isset($date)) 
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
   if($_SESSION['mode']!="repost" or $_SESSION['mode']="relist")
   {
   $bidding_start_date=date("Y-m-d");
   $bidding_start_date = addDay($bidding_start_date,$start_delay); 
   $interval =$dur +$start_delay;
   $expire_date = addDay($bidding_start_date,$interval); 
   $sell_method="want_it_now";
   $sql="insert into placing_item_bid(user_id,category_id,item_title,detailed_descrip, selling_method,duration,picture1,bid_starting_date,expire_date,status)";
    $sql.="values('$userid','$cat_id','$item_title','$itemdes','$sell_method','$dur','$img1','$bidding_start_date','$expire_date','Active')"; 
   $res=mysql_query($sql);  
   $item_id=mysql_insert_id();
   
  } //
if($res)
{
   $sucess=1;
}
 else
 $fail=1;

if($sucess==1)
{
	$_SESSION[des]="";
	$_SESSION[sell_method]="";
	$_SESSION[image1]="";
	$_SESSION[dur] ="";
	$_SESSION[categoryid]="";
} // if($sucess==1)
//$title="Better Things Better Price";
require 'include/top.php';
require'templates/wantitnow_preview.tpl';
require 'include/footer.php';
$_SESSION[item_name]="";
?>


 