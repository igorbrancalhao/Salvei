<?php
/***************************************************************************
 *File Name				:enterresponsetoseller.php
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
 if($res_success==1)
  {
  ?>
<table width="958" cellpadding="0" cellspacing="0" border=0 align="center">
<tr width=100>
<td colspan=2 background="images/contentbg1.jpg" height="25">
<font class="detail3txt"><div align="left">
&nbsp;&nbsp;Response Entered Successfully</div></font></td></tr>
<tr><td colspan="2" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom"  background="images/contentgrad.jpg"> 
 <table cellpadding="5" cellspacing="2"  width=100%> 
<tr><td style="padding-left:5px" >
<font class="detail9txt"><b>Transaction:</b></font><font class="banner1"> <?php= $sell['item_title'] ?> (#<?php= $bid[item_id] ?>) sold by <?php= $user['user_name'] ?> on
 <?php
  $custom_date=explode(" ",$bid_date);
  $custom_date1=$custom_date[0];
  $custom_time=$custom_date[1];
  $custom_date3=substr($custom_date1,"-2");
  $custom_date2=explode("-",$custom_date1);
  $custom_date1=$custom_date2[0];
  $custom_date2=$custom_date2[1];
  $custom_date4=$custom_date3."-"."$custom_date2"."-"."$custom_date1"." "."$custom_time";
  echo  $custom_date4;
?> .</font></td></tr> 
<tr><td style="padding-left:10px"><font class="detail9txt"><b> Dispute Status: </b></font>
<font class="banner1">Other's Party action Needed</font>
</td></tr> 
<tr><td style="padding-left:10px">
<font class="banner1">Your response has been entered successfully.we will inform the seller that their response is needed.</font>
</td></tr> 

<tr><td><hr></td></tr>
<tr><td style="padding-left:10px"><font class="detail9txt"><b> Where would you like to go? </b></font></td></tr>
<tr><td style="padding-left:20px"> <a href="viewdispute.php?type=notreceived" class="header_text">View Dispute Console</a></td></tr>
<tr><td style="padding-left:20px"> <a href="myauction.php" class="header_text">My Auction</a></td></tr>
</table></td></tr></table>
<?php
 require 'include/footer.php'; 
 exit();
  }
  else if($upsucess==1)
  {
  ?>
<table width="958" cellpadding="0" cellspacing="0" border=0 align="center">
<tr width=100>
<td colspan=2 background="images/contentbg1.jpg" height="25">
<font class="detail3txt"><div align="left">
&nbsp;&nbsp;Dispute Console Closed Successfully</div></font></td></tr>
<tr><td colspan="2" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom"  background="images/contentgrad.jpg"> 
 <table cellpadding="5" cellspacing="2"  width=100%> 
<tr><td style="padding-left:5px"><font class="detail9txt">
<b>Transaction:</b></font><font class="banner1"> <?php= $sell['item_title'] ?> (#<?php= $bid['item_id'] ?>) sold  by <?php= $sell['user_name'] ?> on
 <?php
  $custom_date=explode(" ",$bid_date);
  $custom_date1=$custom_date[0];
  $custom_time=$custom_date[1];
  $custom_date3=substr($custom_date1,"-2");
  $custom_date2=explode("-",$custom_date1);
  $custom_date1=$custom_date2[0];
  $custom_date2=$custom_date2[1];
  $custom_date4=$custom_date3."-"."$custom_date2"."-"."$custom_date1"." "."$custom_time";
  echo  $custom_date4;
?> .</font></td></tr> 
<tr><td style="padding-left:10px"><font class="detail9txt"><b> Dispute Status: </b></font>
<font class="banner1">Other's Party action Needed</font>
</td></tr> 
<tr><td style="padding-left:10px"><font class="banner1">
Your response has been entered successfully.we will inform the seller that their response is needed.</font>
</td></tr> 
<tr><td><hr></td></tr>
<tr><td style="padding-left:10px" class="detail9txt"> <b> Where would you like to go? </b></td></tr>
<tr><td style="padding-left:20px"> <a href="viewdispute.php?type=notreceived" class="header_text">View Dispute Console</a></td></tr>
<tr><td style="padding-left:20px"> <a href="myauction.php" class="header_text">My Auction</a></td></tr>
</table></td></tr></table>

<?php
require 'include/footer.php';
exit();
   }
?>
  
  
<table width="958" cellpadding="0" cellspacing="0" border=0 align="center">
<tr width=100>
<td colspan=2 background="images/contentbg1.jpg" height="25">
<font class="detail3txt"><div align="left">
&nbsp;&nbsp;Enter Response </div></font> </td></tr>
<tr><td colspan="2" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom"  background="images/contentgrad.jpg"> 
 <table cellpadding="5" cellspacing="2"  width=100%> 
<tr><td style="padding-left:5px"><font class="detail9txt"><b>Transaction: </b></font><font class="banner1"><?php= $sell['item_title'] ?> (#<?php= $bid['item_id'] ?>) sold to <?php= $user['user_name'] ?> on
 <?php
  $custom_date=explode(" ",$bid_date);
  $custom_date1=$custom_date[0];
  $custom_time=$custom_date[1];
  $custom_date3=substr($custom_date1,"-2");
  $custom_date2=explode("-",$custom_date1);
  $custom_date1=$custom_date2[0];
  $custom_date2=$custom_date2[1];
  $custom_date4=$custom_date3."-"."$custom_date2"."-"."$custom_date1"." "."$custom_time";
  echo  $custom_date4;
?> .</font></td></tr>

<tr><td style="padding-left:5px"><font class="banner1"> <?php= $_SESSION['site_name']  ?>  user <?php= $sell['user_name'] ?> has notified us of an Unpaid Item dispute regarding this item. </font></td></tr>



<tr><td style="padding-left:10px"><font class="detail9txt"><b> Dispute Status: </b></font>
<?php
if($dispute_row['dispute_status']=="open")
{
?>
<font class="banner1">Your action Needed</font>
<?php
}
?>
</td></tr>
<tr><td>
<table cellpadding="5" cellspacing="2" width=100%>
<tr><td width="39%"><table>
<form name="form1" action="enterresponsetoseller.php"  method="post">
<tr><td style="padding-left:10px">
<font class="detail9txt"> 
<b>Enter Your Response</b>
</font>
</td></tr>
<tr><td style="padding-left:10px"> 
<textarea name="txtresponse" cols="40" rows="5">
</textarea>
</td></tr>
<tr>
<td style="padding-left:10px"> 
<input type="hidden" name="bid_id" value="<?php= $bid_id ?>" />
<input type="hidden" name="dispute_id" value="<?php= $dispute_id ?>" />
</td></tr>
<input type="hidden" name="flag" value="1" />
<tr><td style="padding-left:10px">
<input type="image" src="images/submit.gif" name="Image85" width="62" height="22" border="0" id="Image85" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image85','','images/submito.gif',1)" value="Submit"/>

</td></tr>
</form></table></td>
<td  width=1> <table height=150><tr><td bgcolor="#cccccc"> </td></tr></table></td>
<td width="60%">
<form name="review_form" action="enterresponsetoseller.php"  method=post>
<table>
<tr><td><font class="detail9txt"><b>Close This Dispute</b>  </font>
</td></tr>
<tr><td class="banner1">
<ul type="disc">
<li><input type="radio" name=radclose value='closed'>My concerns have been resolved - I want to close this dispute. </li>
<li><input type="radio" name=radclose value='report'>I feel I have no other option but to escalate this to a claim.</li>
</ul>
</td></tr>
<tr><td>
<input type="hidden" name=closeflag value="close">
<input type="hidden" name="bid_id" value="<?php= $bid_id ?>" />
<input type="hidden" name="dispute_id" value="<?php= $dispute_id ?>" />
<input type="hidden" name="item_id"  value="<?php= $bid[item_id] ?>" />

<input type="image" src="images/closedispute.gif" name="Image94" width="114" height="22" border="0" id="Image94" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image94','','images/closedisputeo.gif',1)" value="Close Dispute"/>

</td></tr>
</table>
</td></form>

</tr> </table></td></tr>



<tr><td style="padding-left:10px">
<table cellpadding="0" cellspacing="0" border="0" width=100%>
<tr><td style="padding-left:10px" bgcolor="#B8DEEE" class="detail9txt"><b>Previous Message</b> </td> </tr>
<br />

<?php

$dispute_sql_1="select * from dispute_process where dispute_id=".$dispute_row['dispute_id'];
$dispute_res_1=mysql_query($dispute_sql_1);
if(mysql_num_rows($dispute_res_1) > 0)
{
?>
<tr><td>
<table cellpadding="0" cellspacing="0" border="0" width=100%>
<?php
while($dispute_row_1=mysql_fetch_array($dispute_res_1))
{

$user_sql="select * from user_registration where user_id=".$dispute_row_1['dispute_by'];
$user_res=mysql_query($user_sql);
$user=mysql_fetch_array($user_res);

?>
<tr><td valign="top" style="padding-left:10px" colspan="2"><font size="2" color="#CC99FF"><b>
<?php= $user['user_name'] ?></b></font>
</td></tr>

<tr><td valign="top" style="padding-left:10px" width="80%" class="banner1">
<?php= $dispute_row_1['dispute_explanations'] ?>
</td><td align="right" style="padding-right:5px" class="banner1"><?php= $dispute_row_1['dispute_date']  ?></td></tr>
<tr><td style="border-bottom:#999999" colspan="2">&nbsp;</td></tr>

<?php
}
?>
</table>
</td></tr>
<?php
}
?>

<tr><td valign="top"  style="padding-left:10px" class="detail9txt"><b>
<?php= $_SESSION['site_name']  ?></b>
</td></tr>
<tr><td style="padding-left:10px" class="banner1">An Unpaid Item dispute has been opened for the following item:  
<?php= $sell['item_title'] ?> (#<?php= $bid['item_id'] ?>) </td></tr>
<tr><td style="padding-left:10px" class="banner1">Reason given for Unpaid Item:<?php= $dispute_row['dispute_reason']  ?> </td></tr>
<tr><td style="padding-left:10px" class="banner1">Buyer actions reported by seller:<?php= $dispute_row['dispute_explanation']  ?> </td></tr>
</table>
</td></tr>
</table>
</td></tr>
</table>
</td></tr>
</table>
