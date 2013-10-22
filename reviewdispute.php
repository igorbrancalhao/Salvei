<?php
/***************************************************************************
 *File Name				:reviewdispute.php
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
//sitename
$sqlsite="select * from admin_settings where set_id=1";
$sqlqrysite=mysql_query($sqlsite);
$sqlfetchsite=mysql_fetch_array($sqlqrysite);
$site=$sqlfetchsite['set_value'];

//Fetching mail header image
$queryheader="select * from admin_settings where set_id = 61";
$tableheader=mysql_query($queryheader);
$rowheader=mysql_fetch_array($tableheader);
$mailheader = $site."/".$rowheader['set_value'];

//Fetching mail footer image
$queryfooter="select * from admin_settings where set_id = 62";
$tablefooter=mysql_query($queryfooter);
$rowfooter=mysql_fetch_array($tablefooter);
$mailfooter = $site."/".$rowfooter['set_value'];


$bid_id=$_SESSION['dispute_bid_id'];
$userid=$_SESSION['userid'];

$bid_sql="select * from placing_bid_item where  bid_id=".$bid_id;
$bid_res=mysql_query($bid_sql);
$bid=mysql_fetch_array($bid_res);
$bid_date=$bid['bidding_date'];
$buyerid=$bid['user_id'];

$sell_sql="select * from placing_item_bid where  item_id=".$bid[item_id];
$sell_res=mysql_query($sell_sql);
$sell=mysql_fetch_array($sell_res);
$itemtitle=$sell['item_title'];
$itemid=$sell['item_id'];

$admin_close_sql=mysql_query("select * from admin_settings where set_id=63");
$admin_close_qry=mysql_fetch_array($admin_close_sql);
$close_value=$admin_close_qry['set_value'];

$user_sql="select * from user_registration where user_id=".$sell['user_id'];
$user_res=mysql_query($user_sql);
$user=mysql_fetch_array($user_res);

        $admin="SELECT * FROM `admin_settings` WHERE set_id=58";
	    $admin_res=mysql_query($admin);
		$admin_row=mysql_fetch_array($admin_res);
		
		$admin_mail="SELECT * FROM `admin_settings` WHERE set_id=3";
	    $admin_mail_res=mysql_query($admin_mail);
		$admin_mail_row=mysql_fetch_array($admin_mail_res);
		$adminmail=$admin_mail_row['set_value'];
		
		
        $elasped_admin="SELECT * FROM `admin_settings` WHERE set_id=20";
	    $elasped_res=mysql_query($elasped_admin);
		$elasped_row=mysql_fetch_array($elasped_res);
		if($_SESSION['payment']==$_SESSION['countpay'])
		{
		$paymentgateway="Others";
		}
		else
		{
     	$pay_sql="select * from payment_gateway where gateway_id=".$_SESSION['payment'];
        $pay_res=mysql_query($pay_sql);
		$pay_row=mysql_fetch_array($pay_res);
		$paymentgateway=$pay_row[payment_gateway];
		}
		
	
		
		
if($_REQUEST[flag]==1)
{
$flag=$_REQUEST[flag];




$sqlmail="select * from mail_subjects where mail_id=17";
$sqlqrymail=mysql_query($sqlmail);
$sqlfetchmail=mysql_fetch_array($sqlqrymail);
$mailsubject=$sqlfetchmail['mail_subject'];
$mailbody=$sqlfetchmail['mail_message'];
$mailfrom=$sqlfetchmail['mail_from'];
$seller_name=$user['user_name'];
$mail_to=$user['email'];	
$buyer_name=$_SESSION[username];	
		
		//mail to seller that buyer has opened a dispute.../
$mailbody=str_replace("<Seller>",$seller_name,$mailbody);
$mailbody=str_replace("<buyer>",$buyer_name,$mailbody);
$mailbody=str_replace("<number>",$itemid,$mailbody);
$mailbody=str_replace("<site>",$site,$mailbody);
$mailbody=str_replace("<title1>",$itemtitle,$mailbody);
$mailbody=str_replace("<imgh>" , $mailheader , $mailbody);
$mailbody=str_replace("<imgf>" , $mailfooter , $mailbody);
	
$headers  = "MIME-Version: 1.0\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\n";
$headers .= "From: ".$mailfrom."\n";
mail($mail_to,$mailsubject,$mailbody,$headers);
		
		//---------------end of mail to seller-------//
		
		//mail to buyer that he has opened a dispute//
		$mail_sql="select * from mail_subjects where mail_id=26";
		$mail_qry=mysql_query($mail_sql);
		$mail_row=mysql_fetch_array($mail_qry);
		$message=$mail_row['mail_message'];
		$subject=$mail_row['mail_subject'];
		$mailfrom=$mail_row['mail_from'];
		$buyer_sql="select * from user_registration where user_id=".$_SESSION[userid];
		$buyer_qry=mysql_query($buyer_sql);
		$buyer_row=mysql_fetch_array($buyer_qry);
		$mail_to=$buyer_row['email'];
		$message=str_replace("<buyer>",$buyer_name,$message);
		$message=str_replace("<seller>",$seller_name,$message);
		$message=str_replace("<title1>",$itemtitle,$message);
		$message=str_replace("<number>",$itemid,$message);
	    $message=str_replace("<site>",$site,$message);
		$message=str_replace("<imgh>" , $mailheader , $message);
        $message=str_replace("<imgf>" , $mailfooter , $message);
					
		$headers  = "MIME-Version: 1.0\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\n";
		$headers .= "From: ". $mailfrom."\n";
     	mail($mail_to,$subject,$message,$headers);




// Mail to admin //
$mail_sql="select * from mail_subjects where mail_id=29";
$mail_qry=mysql_query($mail_sql);
$mail_row=mysql_fetch_array($mail_qry);
$message=$mail_row['mail_message'];
$subject=$mail_row['mail_subject'];
$mailfrom=$mail_row['mail_from'];
$message=str_replace("<name>",$buyer_name,$message);
$message=str_replace("<itemid>",$bid['item_id'],$message);
$message=str_replace("<site>",$site,$message);
$message=str_replace("<imgh>" , $mailheader , $message);
$message=str_replace("<imgf>" , $mailfooter , $message);

$headers  = "MIME-Version: 1.0\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\n";
$headers .= "From: ". $mailfrom."\n";
mail($adminmail,$subject,$message,$headers);
// End of mail to admin //






		//end of mail to buyer//
$date=date("Y-m-d");
//if(empty($_SESSION[Dispute_addttional_inf]))
//echo $_SESSION[Dispute_addttional_inf]="NIL";
/*if($_SESSION[DisputeReason]=="The item I received is significantly different from the item description")
{
$ins_sql="INSERT INTO disputeconsole(distute_bid_id ,dispute_by,dispute_to,dispute_date,dispute_type,dispute_status, dispute_reason,dispute_explanation,payment_gateway,payment_date,itemid) VALUES('$_SESSION[dispute_bid_id]','$userid','$sell[user_id]','$date','notreceived', 'notapplicable','$_SESSION[DisputeReason]','$_SESSION[Dispute_addttional_inf]','$paymentgateway','$_SESSION[dis_payment_date]','$bid[item_id]')";
}
else
{*/
$ins_sql="INSERT INTO disputeconsole(distute_bid_id ,dispute_by,dispute_to,dispute_date,dispute_type,dispute_status, dispute_reason,dispute_explanation,payment_gateway,payment_date,itemid,dispute_close_status) VALUES('$_SESSION[dispute_bid_id]','$userid','$sell[user_id]','$date','notreceived', 'open','$_SESSION[DisputeReason]','$_SESSION[Dispute_addttional_inf]','$paymentgateway','$_SESSION[dis_payment_date]','$bid[item_id]','notapplicable')";
//}
$res=mysql_query($ins_sql);
if($res)
{
$_SESSION[Dispute_addttional_inf]="";
$res_success=1;
}
}

//	$title="Better Things Better Price";
require 'include/index_top.php';
if($flag==1)
{
?>
<table width="958" cellpadding="0" cellspacing="0" border=0 align="center">
<tr width=100>
<td colspan=2 background="images/contentbg1.jpg" height="25">
<font class="detail3txt"><div align="left">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dispute Opened: Notice Sent</b>
</div></font> </td></tr>
<tr><td style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom"  background="images/contentgrad.jpg"><table border="0" align="center" cellpadding="3" cellspacing="0" width="100%">
 <tr><td><br /></td></tr>
 
<tr height=30><td class="banner1">
Your dispute has been sent to the appropriate party. They’ve been alerted to the problem and given <?php=$close_value?> days to respond. Once they respond, you will be able to communicate further about how best to resolve this dispute
</td></tr></table></td></tr>
 <tr><td><br /></td></tr>
 </table></td></tr>
<?php require 'include/footer.php'; 
exit();
}
?>
<?php
if($res_success==1)
{
?>
<table width="958" cellpadding="0" cellspacing="0" border=0 align="center">
<tr width=100>
<td colspan=2 background="images/contentbg1.jpg" height="25">
<font class="detail3txt"><div align="left">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dispute Opened: Notice Sent</b>
</div></font> </td></tr>
<tr><td style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom"  background="images/contentgrad.jpg"><table>
<tr><td style="padding-left:5px" class="banner1">
<b>Transaction:</b> <?php= $sell[item_title] ?> (#<?php= $bid[item_id] ?>) sold by <?php= $user[user_name] ?> on
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
?> .</td></tr> 
<tr><td style="padding-left:10px" class="banner1"><b> Dispute Status: </b>
Other's Party action Needed
</td></tr> 
<tr><td style="padding-left:10px" class="banner1">
Your response has been entered successfully.we will inform the seller that their response is needed.

</td></tr>
<tr><td><hr></td></tr>
<tr><td style="padding-left:10px" class="banner1"> <b> Where would you like to go? </b></td></tr>
<tr><td style="padding-left:20px"> <a href="viewdispute.php" class="style1">View Dispute Console</a></td></tr>
<tr><td style="padding-left:20px"> <a href="myauction.php" class="style1">My Auction</a></td></tr>
</td></tr> 
</table>
</td></tr> 
</table>
<?php require 'include/footer.php'; 
exit();
}
?>
  
  
<table width="958" cellpadding="5" cellspacing="0" border=0 align="center">
<tr width=100>
<td colspan=2 background="images/contentbg1.jpg" height="25">
<font class="detail3txt"><div align="left">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Open Dispute : Review & Submit</b>
</div></font> </td></tr>
<tr><td style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom"  background="images/contentgrad.jpg"><table>
<tr><td style="padding-left:5px" class="banner1"> <b>Transaction:</b> <?php= $sell[item_title] ?> (#<?php= $bid[item_id] ?>) sold by <?php= $user[user_name] ?> on
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
?> .</td></tr>

<tr><td style="padding-left:10px" class="banner1"> 
We've included the information you provided in the message below. Please review it for accuracy and if you'd like to make a change, click Edit Message.  
</td></tr>

<tr><td style="padding-left:10px" class="banner1">  
Once you click Submit Dispute, Aj auction will share this information with the approprite party. They will be alerted to the problem and given <?php=$close_value;?> days to respond. Once they respond, you will be able to communicate further about how best to resolve this dispute.   
</td></tr>
<tr><td style="padding-left:10px">
<table cellpadding="0" cellspacing="0" border="0" width=100%>

<tr><td valign="top"  style="padding-left:10px" class="banner1" ><font size="2" color="#CC99FF"><b>
<?php= $_SESSION[username]  ?></b></font>
</td></tr>


<tr><td style="padding-left:10px" class="banner1">
<?php
if($_SESSION[DisputeReason]=="I have not received the item")
{
?>
Item Not Received
<?php
}
else
{
?>
Item Significantly Not As Described:
<?php
}
?>  <?php= $sell[item_title] ?> (#<?php= $bid[item_id] ?>) </td></tr>
<tr><td style="padding-left:10px" class="banner1">Payment Method:<?php= $paymentgateway  ?> </td></tr>
<tr><td style="padding-left:10px" class="banner1">Payment Date:<?php= $_SESSION[dis_payment_date]  ?> </td></tr>
<tr><td style="padding-left:10px" class="banner1">Additional Details:<?php= $_SESSION[Dispute_addttional_inf]  ?> </td></tr>
</table>
</td></tr>
<tr><td style="padding-left:10px">
<form name="form1" action="reviewdispute.php"  method=post>
<input type="hidden" name="flag" value="1">
<input type="submit" value="Submit Dispute"> &nbsp;<a href="disputedescription.php?bid_id=<?php= $_SESSION[dispute_bid_id] ?>" class="banner1" style="text-decoration:underline">Edit Message </a>
</form>
</td></tr>

</table>
</td></tr>
</table>
</td></tr>

 <?php require 'include/footer.php'; ?>
