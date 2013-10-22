<?php require 'include/connect.php';

$sql="INSERT INTO `mail_subjects` ( `mail_id` , `mail_title` , `mail_from` , `mail_subject` , `mail_message` )
VALUES (26, 'Confirmation to buyer that he has opened a dsipute', 'admin@admin.com', 'you have opened a dispute', 'Dear <buyer>,<br>You have opened a dispute to seller <seller> of the following item:<br> <a href='<site>/detail.php?item_id=<number>'><title1></a> <number><br>Regards,<br><site>')";
$sqlqry=mysql_query($sql);
if($sqlqry)
echo "Inserted";



$sql="INSERT INTO `mail_subjects` ( `mail_id` , `mail_title` , `mail_from` , `mail_subject` , `mail_message` )
VALUES ('29', 'Dispute intimation mail to seller', 'admin@admin.com', 'Dispute intimation mail to seller', 'Dear Admin,<br> A dispute has been araised by <name> for the item(#<itemid>).Login into dispute section for further details.<br> Regards,<br> <site>.'
)";
$sqlqry=mysql_query($sql);
if($sqlqry)
echo "Inserted";



$sql="INSERT INTO `mail_subjects` ( `mail_id` , `mail_title` , `mail_from` , `mail_subject` , `mail_message` )
VALUES (23, 'Notification mail to admin for item not received by buyer', 'admin@admin.com', 'closing dispute', '<table bgcolor=#F8F8FA style=border-top:2px solid #979BB3;border-bottom:2px solid #979BB3; cellpadding=5 cellspacing=2 width=50%><tr bgcolor=#EEEEF8><td><strong>A Buyer Closed his dispute </strong></td></tr><tr><td>Dear Admin,</td></tr><tr><td>The seller <seller> didn''t send the item <itemtitle> number <number> to buyer <buyer>.</td></tr><tr><td>Thank You,</td></tr><tr><td><sitename></td></tr></table>')";
$sqlqry=mysql_query($sql);
if($sqlqry)
echo "Inserted";

$update="update placing_item_bid set expire_date='2008-02-14 09:22:03' where item_id='11027'";
$sqlqry=mysql_query($update);
if($sqlqry)
echo "updated1";
$update="update placing_item_bid set expire_date='2008-02-14 09:22:03' where item_id='11028'";
$sqlqry=mysql_query($update);
if($sqlqry)
echo "updated2";
$update="update placing_item_bid set expire_date='2008-02-14 09:22:03' where item_id='11029'";
$sqlqry=mysql_query($update);
if($sqlqry)
echo "updated3";
$update="update placing_item_bid set expire_date='2008-02-14 09:22:03' where item_id='11030'";
$sqlqry=mysql_query($update);
if($sqlqry)
echo "updated4";
$update="update placing_item_bid set expire_date='2008-02-14 09:22:03' where item_id='11031'";
$sqlqry=mysql_query($update);
if($sqlqry)
echo "updated5";
 


?>
