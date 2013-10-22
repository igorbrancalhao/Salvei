<?php require 'include/connect.php';

$del="delete from mail_subjects where mail_id=26";
$sqlqry=mysql_query($del);
if($sqlqry)
echo "deleted";


$sql="INSERT INTO `mail_subjects` ( `mail_id` , `mail_title` , `mail_from` , `mail_subject` , `mail_message` )
VALUES (26, 'Confirmation to buyer that he has opened a dsipute', '$adminmail', 'you have opened a dispute', 'Dear <buyer>,<br>You have opened a dispute to seller <seller> of the following item:<br> <a href=\'<site>/detail.php?item_id=<number>\'><title1></a> <number><br>Regards,<br><site>')";
$sqlqry=mysql_query($sql);
if($sqlqry)
echo "inserted";


$sql="INSERT INTO `mail_subjects` ( `mail_id` , `mail_title` , `mail_from` , `mail_subject` , `mail_message` )
VALUES (23, 'Notification mail to admin for item not received by buyer', '$adminmail', 'closing dispute', '<table bgcolor=#F8F8FA style=border-top:2px solid #979BB3;border-bottom:2px solid #979BB3; cellpadding=5 cellspacing=2 width=50%><tr bgcolor=#EEEEF8><td><strong>A Buyer Closed his dispute </strong></td></tr><tr><td>Dear Admin,</td></tr><tr><td>The seller <seller> didnt send the item <itemtitle> number <number> to buyer <buyer>.</td></tr><tr><td>Thank You,</td></tr><tr><td><sitename></td></tr></table>')";
$sqlqry=mysql_query($sql);
if($sqlqry)
echo "inserted";

$up="update storefronts set status='enable' where id=9 or id=12 or id-13";
$qry=mysql_query($up);
if($qry)
echo "UPDATED";
?>