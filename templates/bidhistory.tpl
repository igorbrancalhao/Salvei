<?php
/***************************************************************************
 *File Name				:bidhistory.tpl
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
 ?>
<table width="958" cellpadding="0" cellspacing="0" border=0 align="center">
<tr width=100>
<td colspan=2 background="images/contentbg1.jpg" height="25">
<font class="detail3txt"><div align="left">
&nbsp;&nbsp;Bid History</div></font></td></tr>
<tr><td colspan="2" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom"  background="images/contentgrad.jpg"> 
<table cellpadding="5" cellspacing="2"  width=100%>
<tr><td>
<table width=100% cellpadding="5" cellspacing="0" >
<tr><td align="right" height=30 colspan="2" class="banner1"><b>Item Number:<?= $item_id ?>&nbsp;&nbsp;</b></td></tr>
</table>
<tr><td><table width=100%>
<tr align="center" height=35>
<td width=2>&nbsp;</td>
    <?
	if($email_to_status)
	{
	?>
	<td align="center">
	<font class="errormsg">
    <b> &nbsp;&nbsp;&nbsp;<?= $email_to_status?>  </b></font>
	<?
	}
	else if($warning)
	{
	?>
	<td class="errormsg" align="center">
	<font size="2" color="red">
    <b> &nbsp;&nbsp;&nbsp; Item Purchased Successfully! </b></font>
	<?
	}
	else if($watch_flag==1)
    {
	$watch_tot_sql="select count(*) from watch_list where user_id=$user_id";
    $watch_ins_sql=mysql_query($watch_tot_sql);
	$watch_res_sql=mysql_fetch_array($watch_ins_sql);
	$watch_tot=$watch_res_sql[0];
    ?>
	<td align="center">
 <font class="errormsg">
<b> &nbsp;&nbsp;&nbsp;This item is being watched in My Auction  (<a href="watchlist.php" class="header_text"> <?= $watch_tot?> items </a>)</b></font>
   <?
   }
	else if(empty($_SESSION['userid']))
	{ 
	?> 
   <td align="left">
&nbsp;&nbsp;&nbsp;Bidder or seller of this item?</B>&nbsp;<A href="signin.php" class="header_text">Sign in</A> for your status &nbsp;
    <?
    }
	else
	{
	?>
	<td align="left" class="detail9txt">
&nbsp;&nbsp;&nbsp;	Welcome <?=$_SESSION['username'];?>
	<?
	}
    ?> 
	<span align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<?
	if($watch_flag!=1)
	{
	?>
    <a href="detail.php?item_id=<?= $row['item_id'] ?>&mode=watch" class="header_text">Watch this Item</a> &nbsp;&nbsp;
    <?
	$mode="";
	}
	?>
	 | &nbsp;&nbsp;	
<a href="forward_to_friend.php?item_id=<?= $row['item_id']; ?>" class="header_text">Forward to a Friend</a>
&nbsp;&nbsp;  | &nbsp;&nbsp;	
<a href="detail.php?item_id=<?= $row['item_id']; ?>" class="header_text">Back to item page</a>
&nbsp;&nbsp;		
</span>
</td>
<td width=2>&nbsp;</td>
</tr>
</table></td></tr>
<tr><td align="left" >
<table cellpadding="5" cellspacing="0" width="50%" >
 
          <tr>
		  <td width=2>&nbsp;</td>
          <td class="detail9txt">Item Title : </td>
		  <td class="banner1"><? echo $row['item_title'];?></td>
          </tr>

          <tr>
		  <td width=2>&nbsp;</td>
          <td class="detail9txt">Ending Time : </td>
		  <?
		  $expire_date=$row['expire_date'];
          require 'ends.php';
		  ?>
		  <td class="banner1"><? echo "$string_difference" ;?></td>
         </tr>
    </table>
</td></tr>
<tr><td align="center">
<table width="100%" cellpadding="5" cellspacing="0">
<tr><td colspan="3" class="detail9txt">
Only actual bids are shown upto date.
</td></tr>
		<? 
		if(mysql_num_rows($bid_res)>0)
		{
		?>
		<tr class="detail9txt"><td><b>Date of Bid</b></td><td><b>Bid Amount</b></td><td><b>User Id</b></td></tr>
		<?
		$dis=1;
		while($bid_det=mysql_fetch_array($bid_res))
		{
        $bidder_sql="select * from user_registration where user_id=$bid_det[user_id];";
		$bidder_res=mysql_query($bidder_sql);
		$bidder_row=mysql_fetch_array($bidder_res);
		$feed_sql="select count(*) as feedbacktotal from feedback where feedback_to=".$bidder_row['user_id']." and feedback_type='Positive'";
        $feed_recordset=mysql_query($feed_sql);
        $feed_tot=mysql_fetch_array($feed_recordset);
		
	$feed_pos_sql="select count(*) as feedbacktotal from feedback where feedback_type='Positive' and feedback_to=".$bidder_row['user_id'];
 $feed_pos_rec=mysql_query($feed_pos_sql);
 $feed_pos_tot=mysql_fetch_array($feed_pos_rec);
    $feedbackicon_sql="select * from membership_level where feedback_score_from <= "." $feed_pos_tot[feedbacktotal] "." and  feedback_score_to >= "." $feed_pos_tot[feedbacktotal] " ; 
 $feedbackicon_res=mysql_query($feedbackicon_sql);
 $feedbackicon_row=mysql_fetch_array($feedbackicon_res); 
 $feedback_img=$feedbackicon_row[icon];
		?>	
		<tr class="<? if($dis==1){$dis=2; echo tr_color_1;}else{ echo tr_color_2;  $dis=1;} ?>">
		<td class="detail9txt"><?= $bid_det[bidding_date];?></td>
		<td class="detail9txt"><?= $row[currency] ?>&nbsp;
		<?
		if($bidder_row['user_id']=="$userid" || $higher_userid==$userid)
		{
		echo $bid_det[bidding_amount];
		}
		else
		{
		//echo $bid_det[duplicate_bidding_amt];
		echo $bid_det[bidding_amount];
		}
		?>
		
		</td>
		<td class="detail9txt"><a href="feedback.php?user_id=<?=$bidder_row['user_id'];?>" class="header_text"><? echo $bidder_row['user_name'];?></a>&nbsp;&nbsp;&nbsp;&nbsp;( 	<a href="feedback.php?user_id=<?=$bidder_row['user_id'];?>" class="header_text"><? echo $feed_tot[feedbacktotal]; ?></a><? if($feedback_img!='') { ?><img src="images/<?=$feedback_img ?>" /><? } ?> )</td></tr>
		<?
		}
		}
		else
		{
		?>
		<tr><td colspan="3" align="center"><font class="errormsg">
		No Bids Have Been Placed On This Item.
		</font> </td></tr>
		<?
		}
		?>
		  
		<tr><td colspan="3">
		<br>
		<hr>
		
		</td></tr>
		<tr><td colspan="3"><table cellspacing="0" cellpadding="0" width="100%">
          <tbody>
            <tr>
              <td height="15" class="detail9txt"> If you and another bidder placed the same bid amount, the earlier bid takes priority. <br />
You can <a href="bid_retract.php" class="header_text" style="text-decoration:underline">retract your bid </a>under certain circumstances only.  

 </td>
          </tr>
          </tbody>
		  </table>
		  </td></tr><tr><td colspan="3">
		  <?
		  if($track_rows > 0)
		  {
		  ?>
		  <table cellspacing="1" cellpadding="0" width="100%" border="0">
          <tr class="detail9txt" height=30>
		  <td style="padding-left:4px;"><b>User Id</b></td>
		  <td style="padding-left:4px;"><b>Action / Explanation</b></td>
		  <td style="padding-left:4px;" ><b>Date of Bid and Retraction</b></td></tr>
 
		  <?
		  while($track_row=mysql_fetch_array($track_res))
		  {
		$bidder_sql="select * from user_registration where user_id=$track_row[user_id]";
		$bidder_res=mysql_query($bidder_sql);
		$bidder_row=mysql_fetch_array($bidder_res);
		$feed_sql="select count(*) as feedbacktotal from feedback where feedback_to=".$bidder_row['user_id']." and feedback_type='Positive'";
        $feed_recordset=mysql_query($feed_sql);
        $feed_tot=mysql_fetch_array($feed_recordset);
		$bid_sql="select * from placing_bid_item where item_id=$item_id and deleted='No' and user_id=$track_row[user_id]";
        $bid_res=mysql_query($bid_sql);
		$bid_row=mysql_fetch_array($bid_res);
   
		
		
		
        $feedbackicon_sql="select * from membership_level where feedback_score_from <= "." $feed_tot[feedbacktotal] "." and  feedback_score_to >= "." $feed_tot[feedbacktotal] " ; 
 $feedbackicon_res=mysql_query($feedbackicon_sql);
 $feedbackicon_row=mysql_fetch_array($feedbackicon_res); 
 $feedback_img=$feedbackicon_row['icon'];
 
		  ?>
		  <tr class="<? if($dis==1){$dis=2; echo tr_color_1;}else{ echo tr_color_2;  $dis=1;} ?>" >
		  <td  style="padding-left:4px;" class="detail9txt">
		  <a href="feedback.php?user_id=<?=$bidder_row['user_id'];?>" class="header_text" style="text-decoration:underline"><? echo $bidder_row['user_name'];?></a>&nbsp;&nbsp;&nbsp;&nbsp;( <a href="feedback.php?user_id=<?=$track_row['user_id'];?>" class="header_text">
		  <? echo $feed_tot['feedbacktotal']; ?></a><img src="images/<?= $feedback_img ?>" /> )</td>
		  <td style="padding-left:4px;" class="detail9txt">
		  <b>Retract :</b><?= $track_row['retrack_amt']; ?>
		  <br />
		  <b>Reason :</b><?= $track_row['reason'];?> </td>
		  <td style="padding-left:4px;" class="detail9txt"> <b>Bid :</b><?= $bid_row['bidding_date'];?>
		  <?
		  $retractdate=explode(" ",$track_row['retrack_date']);
		  ?>
		  <br />
		  <b>Retract :  </b> <?= $retractdate[0];?>  </td>
		  </tr>
		<?
		 }
		 ?>
		 </table>
		 <?
		 } 
		 ?>
		
		</td></tr>
		</table>
		</td></tr>
		</table>
		</td>
		</tr>
		</table>
		