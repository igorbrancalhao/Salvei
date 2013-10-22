<?php
/***************************************************************************
 *File Name				:close_dispute_seller.php
 *File Created				:Friday, July 13, 2007
 * File Last Modified			:Friday, July 13, 2007
 * Copyright				:(C) 2001 AJ Square Inc
 * Email				:licence@ajsquare.net
 * Software Language			:PHP
 * Version Created			:V 4.3.2
 * Programmers worked	        	:V.Sri Vidhya
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
<table width="958" cellpadding="0" cellspacing="0" border=0 align="center">
<tr width=100>
<td colspan=2 background="images/contentbg1.jpg" height="25">
<font class="detail3txt"><div align="left">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Close Dispute</div></font></td></tr>
<tr><td style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom"  background="images/contentgrad.jpg">
<table align="center" cellpadding="3" cellspacing="3" width="100%">
 <tr><td>&nbsp;</td></tr>
 
 <?
 if($user[status]=="suspended")
 {
 ?>
 <tr><td class="banner1" align="center"><font color="#FF0000">Sorry your account is suspended.</font></td></tr>
  <?
  }
  else
  {
$sql1="select to_days(now())-to_days(dispute_date) from disputeconsole where itemid=".$item_id;

$qry1=mysql_query($sql1);
$fetch1=mysql_fetch_array($qry1);
$fetchdays=$fetch1['0'];
$dis_sql="select * from disputeconsole where itemid=".$item_id;
$dis_qry=mysql_query($dis_sql);
$dis_row=mysql_fetch_array($dis_qry);
$dis_id=$dis_row['dispute_id'];
$bid_sql="select * from placing_bid_item where bid_id=".$dis_row['distute_bid_id'];
$bid_res=mysql_query($bid_sql);
$bid=mysql_fetch_array($bid_res);
if($bid[user_id]!=$_SESSION[userid])
{
$user_sql="select * from user_registration where user_id=".$bid['user_id'];
$user_res=mysql_query($user_sql);
$user=mysql_fetch_array($user_res);
}
$date_sql1=mysql_query("select date_add('$dis_row[dispute_date]',interval '$adminvalue' day) as day");
$date_qry1=mysql_fetch_array($date_sql1);
$added_date=$date_qry1[day];
$cust_date=explode("-",$added_date);
$disputedays=$adminvalue;

//$dis_reply_sql=mysql_query("select * from dispute_process where dispute_id=$dis_id and dispute_by!=$user[user_id]");
$dis_reply_sql="select * from disputeconsole a,dispute_process b where a.dispute_id=$dis_id and b.dispute_id=$dis_id and a.dispute_id=b.dispute_id and a.dispute_to=b.dispute_by";
$dis_reply_qry=mysql_query($dis_reply_sql); 
$dis_reply_rows=mysql_num_rows($dis_reply_qry);
if($dis_reply_rows > 0)
{
$dis_flag=1;
}
if(($fetchdays > $disputedays) or ($disputedays==0)) { $flag=1; }
if($flag==1 or $dis_flag==1)
{
?>
<form name="closefrm" action="close_dispute_seller.php" method="post">
 <tr><td class="banner1">Select an option to close the dispute<font color="#FF0000">*</font>
 </td></tr>
 <?
 if($err_flag==1)
 {
 if(!empty($err_msg))
 {
 ?>
 <tr><td class="banner1" align="center"><font color="#FF0000"><?=$err_msg?></font></td></tr>
 <?
 }
 }
 ?>
 <tr><td class="banner1"><input type="radio" name="close" value="1">Buyer has paid for the Item</td></tr>
 <tr><td class="banner1"><input type="radio" name="close" value="2">Buyer has not paid for the Item</td></tr>
 <tr><td class="banner1"><input type="radio" name="close" value="3">Cancel the transaction with mutual agreement</td></tr>
 <tr><td>&nbsp;</td></tr>
 <input type="hidden" name="cansave" value="1">
 <input type="hidden" name="item_id" value="<?=$item_id?>">
 <tr><td align="center"><input type="submit" name="submit" value="Close Dispute"></td></tr>
 </form>
 <?
 }
 else
{
?>
<tr><td><table border=0 align="center" cellpadding="0" cellspacing="3" width="100%">
<tr><td class="banner1" align="center"><font color="#FF0000">
<?
if($adminvalue > 1)
{
?>
You must wait <?= $adminvalue?> <? if($adminvalue==1){ echo "day";} 
else if($adminvalue > 1) {echo "days";}?>  to close the dispute</font>
<?
}
else
{
?>
You can close the dispute after getting the response from other party.
<?
}
?>
</td></tr>
</table></td></tr>
<?
}
}
?>
 </table></td></tr>
</table></td></tr>
 <? require 'include/footer.php';?>