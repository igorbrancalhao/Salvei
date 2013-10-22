<?php
/***************************************************************************
 *File Name				:repoprt_unpiad_dispute.php
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

if(!isset($_SESSION[username]))
{ 
$link="signin.php";
$url="myauction.php";
echo '<meta http-equiv="refresh" content="0;url='.$link.'?url='.$url.'">';
echo "You have been Re-Directed, if not please <a href=$link?$url>Click here</a>";
exit();
}

if($_REQUEST[bid_id])
$bid_id=$_REQUEST[bid_id];
else
$bid_id=$_SESSION[dispute_bid_id];

$bid_sql="select * from placing_bid_item where  bid_id=".$bid_id;
$bid_res=mysql_query($bid_sql);
$bid=mysql_fetch_array($bid_res);
$bid_date=$bid['bidding_date'];
$buyerid=$bid['user_id'];

$sell_sql="select * from placing_item_bid where  item_id=".$bid[item_id];
$sell_res=mysql_query($sell_sql);
$sell=mysql_fetch_array($sell_res);


$user_sql="select * from user_registration where user_id=".$bid[user_id];
$user_res=mysql_query($user_sql);
$user=mysql_fetch_array($user_res);


if($_REQUEST[flag])
{
if(empty($_REQUEST[cboDisputeExplanation]))
$err_explanation=1;
if(empty($_REQUEST[cboDisputeReason]))
$err_reason=1;

if(empty($err_explanation) or empty($err_reason))
{
$_SESSION[dispute_bid_id]=$bid_id;
$_SESSION[DisputeReason]=$_REQUEST[cboDisputeReason];
$_SESSION[DisputeExplanation]=$_REQUEST[cboDisputeExplanation];
$link="sendunpaiddispute.php";
echo '<meta http-equiv="refresh" content="0;url='.$link.'">';
echo "You have been Re-Directed, if not please <a href=$link>Click here</a>";
exit();
}

}
//$title="Better Things Better Price";
require 'include/index_top.php';
?>
<table width="958" cellpadding="0" cellspacing="0" border=0 align="center">
<tr width=100>
<td colspan=2 background="images/contentbg1.jpg" height="25">
<font class="detail3txt"><div align="left">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Report an Unpaid Item Dispute </div></font> </td></tr>
<tr><td style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom"  background="images/contentgrad.jpg">
<table align="center" cellpadding="3" cellspacing="3" width="100%">
<?php if($err_reason or $err_explanation) 
 {
?>
<tr><td style="padding-left:10px" class="banner1"> Please enter your explanation in highlighted fields  below   </td> </tr>
<tr><td style="padding-left:10px" class="banner1"> 
<ul type="disc"><li>
 <?php 
 if($err_reason==1)
 {
 ?>
 <font color="#FF0000">
  Why are you reporting this Unpaid Item? </font> 
 <?php
 }
 ?>
 </li><li>
 <?php 
 if($err_explanation==1)
 {
 ?>
 <font color="#FF0000">
   What has happened so far in the dispute? </font> 
 <?php
 }
 ?>
 </li>
 </ul> </td> </tr>
 <?php
 }
 ?>
<tr><td style="padding-left:10px" class="banner1">Please answer the questions and Continue to report an Unpaid Item dispute. We also have tips to help you avoid Unpaid Items in the future. If the buyer returned the item, choose 'we have both agreed not to complete the transaction'. </td></tr>
<tr><td style="padding-left:10px" class="banner1"> <b> UnpaidItem:</b> <?php= $sell[item_title] ?> (#<?php= $bid[item_id] ?>) sold to <?php= $user[user_name] ?> on
 <?php
  $custom_date=explode(" ",$bid_date);
  $custom_date1=$custom_date[0];
  $custom_time=$custom_date[1];
  $custom_date3=substr($custom_date1,"-2");
  $custom_date2=explode("-",$custom_date1);
  $custom_date1=$custom_date2[0];
  $custom_date2=$custom_date2[1];
  $custom_date4=$custom_date3."-"."$custom_date2"."-"."$custom_date1"." "."$custom_time";
  echo  $custom_date[0];
?>.    </td></tr>

<form name="form1" action="report_unpaid_dispute.php"  method=post>
<tr><td style="padding-left:10px" class="banner1"> <b>
<?php if($err_reason==1) { ?>
 <font color="#FF0000">
  Why are you reporting this Unpaid Item? </font> 
 <?php
 }
 else
 { 
 ?> 
  Why are you reporting this Unpaid Item?
 <?php
 }
 ?>
 </b> </td></tr>
<tr>
<td style="padding-left:10px" class="banner1"> 
<select name="cboDisputeReason"><option value="0">-- Select One --</option>
<option value="The buyer has not paid for the item">The buyer has not paid for the item</option>
<option value="We have both agreed not to complete the transaction">We have both agreed not to complete the transaction</option>
</select>
</td></tr>
<tr><td style="padding-left:10px" class="banner1"> 
<b>
<?php if($err_explanation==1) { ?>
 <font color="#FF0000">
 What has happened so far in the dispute? </font> 
 <?php
 }
 else
 { 
 ?> 
 What has happened so far in the dispute? 
 <?php
 }
 ?></b> </td></tr>
<tr><td style="padding-left:10px" class="banner1">
<select name="cboDisputeExplanation"><option value="0">-- Select One --</option><option value="The buyer has not responded">The buyer has not responded</option><option value="The buyer's payment has not been received">The buyer's payment has not been received</option><option value="The buyer's payment has not cleared">The buyer's payment has not cleared</option><option value="The buyer requested shipment to an unconfirmed address">The buyer requested shipment to an unconfirmed address</option><option value="22">The buyer requested an unauthorized payment method</option><option value="The buyer is no longer registered">The buyer is no longer registered</option><option value="Other reason">Other reason</option>
</select>
<input type="hidden" name="bid_id" value=<?php= $bid_id ?> />
<input type="hidden" name="flag" value=1 />

</td></tr>
<!--<tr><td><img src="images/Index_03.gif" width="800" alt=""></td></tr>-->

<tr><td style="padding-left:50px"><input type="submit" name=btnsubmit value="Continue"> </td></tr>
</form>
</table></td></tr>
</table></td></tr>
<?php require 'include/footer.php'; ?>
