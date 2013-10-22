<?php
/***************************************************************************
 *File Name				:sendunpaiddispute.php
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
$url="myauction.php";
echo '<meta http-equiv="refresh" content="0;url='.$link.'?url='.$url.'">';
echo "You have been Re-Directed, if not please <a href=$link?$url>Click here</a>";
exit();
}

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
$bid_sql="select * from placing_bid_item where  bid_id=".$bid_id;
$bid_res=mysql_query($bid_sql);
$bid=mysql_fetch_array($bid_res);
$bid_date=$bid['bidding_date'];
$buyerid=$bid['user_id'];

$sell_sql="select * from placing_item_bid where  item_id=".$bid['item_id'];
$sell_res=mysql_query($sell_sql);
$sell=mysql_fetch_array($sell_res);
$itemtitle=$sell['item_title'];
$seller_id=$sell[user_id];

//
$user_sql="select * from user_registration where user_id=".$bid['user_id'];
$user_res=mysql_query($user_sql);
$user=mysql_fetch_array($user_res);

$seller_sql="select * from user_registration where user_id=".$sell['user_id'];
$seller_res=mysql_query($seller_sql);
$seller_row=mysql_fetch_array($seller_res);


$admin="SELECT * FROM `admin_settings` WHERE set_id=63";
$admin_res=mysql_query($admin);
$admin_row=mysql_fetch_array($admin_res);



if($_REQUEST[flag]==1)
{
////  insert record into disputeconsole table ////////////////////////////////////////////////////////

$date=date("Y-m-d");
//$_SESSION[DisputeExplanation]=str_replace("'","\'",$_SESSION[DisputeExplanation]);




$ins_sql="INSERT INTO disputeconsole (distute_bid_id,dispute_to,dispute_by,dispute_date,dispute_type ,dispute_status, dispute_reason,dispute_explanation,itemid) 
VALUES ('$_SESSION[dispute_bid_id]','$buyerid','$seller_id', '$date','unpaid', 'open', '$_SESSION[DisputeReason]','$_SESSION[DisputeExplanation]','$sell[item_id]')";
$res=mysql_query($ins_sql);

////  insert record into disputeconsole table ////////////////////////////////////////////////////////

//// mail to buyer (unpaid item remainder) ////////////////////////////////////////



$sqlmail="select * from mail_subjects where mail_id=16";
$sqlqrymail=mysql_query($sqlmail);
$sqlfetchmail=mysql_fetch_array($sqlqrymail);
$mailsubject=$sqlfetchmail['mail_subject'];
$mailbody=$sqlfetchmail['mail_message'];
$mailfrom=$sqlfetchmail['mail_from'];
$user_id=$sqlfetcharray['user_id'];
$msg=$seller_row['user_name'];



$mailTo=$user['email'];
//$mailfrom = $_POST["txtFrom"];
$mailbody=str_replace("<buyer>" , $user['user_name'],$mailbody);
$mailbody=str_replace("<item_no>" ,$bid[item_id], $mailbody);
$mailbody=str_replace("<title1>",$itemtitle,$mailbody);
$mailbody=str_replace("<msg>" ,$msg, $mailbody);
$mailbody=str_replace("<site>" ,$site, $mailbody);
$mailbody=str_replace("<admin>" ,$mailfrom, $mailbody);
$mailbody=str_replace("<imgh>" , $mailheader , $mailbody);
$mailbody=str_replace("<imgf>" , $mailfooter , $mailbody);

$headers  = "MIME-Version: 1.0\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\n";
$headers .= "From: ". $mailfrom."\n";
$mail=mail($mailTo,$mailsubject ,$mailbody,$headers);


//// end of mail to buyer (unpaid item remainder) ////////////////////////////////////////

//....................mail to seller that he has opened a dispute.........................//
//seller mail id
$seller_sql="select * from user_registration where user_id=".$_SESSION['userid'];
$seller_qry=mysql_query($seller_sql);
$seller_row=mysql_fetch_array($seller_qry);
$mail_to=$seller_row['email'];
$seller_name=$_SESSION[username];
$open_mail_sql="select * from mail_subjects where mail_id=25";
$open_mail_qry=mysql_query($open_mail_sql);
$open_mail_row=mysql_fetch_array($open_mail_qry);
$open_mail_msg=$open_mail_row['mail_message'];
$open_mail_sub=$open_mail_row['mail_subject'];
$open_mail_from=$open_mail_row['mail_from'];
$open_mail_msg=str_replace("<seller>",$seller_name,$open_mail_msg);
$open_mail_msg=str_replace("<buyer>",$user['user_name'],$open_mail_msg);
$open_mail_msg=str_replace("<title1>",$itemtitle,$open_mail_msg);
$open_mail_msg=str_replace("<number>",$bid[item_id],$open_mail_msg);
$open_mail_msg=str_replace("<sitename>",$site,$open_mail_msg);
$open_mail_msg=str_replace("<imgh>" , $mailheader , $open_mail_msg);
$open_mail_msg=str_replace("<imgf>" , $mailfooter , $open_mail_msg);


$headers  = "MIME-Version: 1.0\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\n";
$headers .= "From: ". $open_mail_from."\n";

mail($mail_to,$open_mail_sub,$open_mail_msg,$headers);
//...............end of mail to seller..................................//

// Mail to admin //
$admin_mail="SELECT * FROM `admin_settings` WHERE set_id=3";
$admin_mail_res=mysql_query($admin_mail);
$admin_mail_row=mysql_fetch_array($admin_mail_res);
$adminmail=$admin_mail_row['set_value'];
		

$mail_sql="select * from mail_subjects where mail_id=29";
$mail_qry=mysql_query($mail_sql);
$mail_row=mysql_fetch_array($mail_qry);
$message=$mail_row['mail_message'];
$subject=$mail_row['mail_subject'];
$mailfrom=$mail_row['mail_from'];
$message=str_replace("<name>",$seller_name,$message);
$message=str_replace("<itemid>",$bid['item_id'],$message);
$message=str_replace("<site>",$site,$message);
$message=str_replace("<imgh>" , $mailheader , $message);
$message=str_replace("<imgf>" , $mailfooter , $message);


$headers  = "MIME-Version: 1.0\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\n";
$headers .= "From: ". $mailfrom."\n";
mail($adminmail,$subject,$message,$headers);
// End of mail to admin //



$link="unpaidremaindersent.php";
if($res)
{
echo '<meta http-equiv="refresh" content="0;url='.$link.'">';
echo "You have been Re-Directed, if not please <a href=$link>Click here</a>";
exit();
}
}



		

$title="Better Things Better Price";
require 'include/index_top.php';
?>
<table width="958" cellpadding="0" cellspacing="0" border=0 align="center">
<tr width=100>
<td colspan=2 background="images/contentbg1.jpg" height="25">
<font class="detail3txt"><div align="left">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Send the Unpaid Item Reminder </b>
</div></font> </td></tr>
<tr><td style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom"  background="images/contentgrad.jpg">
<table cellpadding="5" cellspacing="5" border=0 align="center">
<tr><td style="padding-left:10px" class="banner1">Clicking the button below will send <a href="feedback.php?user_id=<?php= $user[user_id] ?>" class="banner1" style="padding-left:0px; text-decoration:underline"><?php= $user[user_name] ?></a> an email reminder that an Unpaid Item dispute has been reported to <?php= $_SESSION[site_name]  ?> for item: <?php= $sell[item_title] ?> (#<?php= $bid[item_id] ?>) 


 </td></tr>
 <tr><td style="padding-left:10px" class="banner1">
Communication with your buyer is the best way to resolve this dispute. <?php= $_SESSION[site_name]  ?> encourages you to use the dispute message thread to work out an agreement so that you can complete your transaction.
</td></tr> 
<tr><td style="padding-left:10px" class="banner1"> You will need to take additional action before your Final Value Fee is credited. If the buyer does not respond, you will be eligible to receive a Final Value Fee credit <?php if($admin_row[set_value] > 0){?> <?php= $admin_row[set_value] ?><?php if($admin_row[set_value]> 1) echo "days"; else echo "day";?> <?php }?>after this reminder is sent. Learn about this process in <?php= $_SESSION[site_name]  ?>'s </td></tr>
<tr><td style="padding-left:10px"> </td></tr>
<form name="form1" action="sendunpaiddispute.php"  method=post>
<tr><td><hr></td></tr>
<tr><td style="padding-left:10px">
<input type="hidden" name="flag" value=1 />
<input type="submit" name=btnsubmit value="Send Reminder"> &nbsp;&nbsp;&nbsp;<a href="report_unpaid_dispute.php" class="banner1">cancel</a></td></tr>
</form>
</table></td></tr>
</table></td></tr>

<?php require 'include/footer.php'; ?>
