<?php

require 'include/connect.php';

$sql = "ALTER TABLE `user_registration` CHANGE `home_phone` `home_phone` VARCHAR( 50 ) DEFAULT '0' NOT NULL ,
CHANGE `work_phone` `work_phone` VARCHAR( 50 ) DEFAULT '0' NOT NULL";
$sqlqry = mysql_query($sql);
if ($sqlqry)
    echo "aletered";


$sql = "ALTER TABLE `pay_transaction` CHANGE `trans_batchnumber` `trans_batchnumber` VARCHAR( 50 ) DEFAULT '0' NOT NULL";
$sqlqry = mysql_query($sql);
if ($sqlqry)
    echo "aletered";



$sql = "INSERT INTO `mail_subjects` ( `mail_id` , `mail_title` , `mail_from` , `mail_subject` , `mail_message` )
VALUES (
'24', 'Notification mail to admin for refund', '$adminmail', 'refund for final sale value fee', '<table bgcolor=#F8F8FA style=border-top:2px solid #979BB3;border-bottom:2px solid #979BB3; cellpadding=5 cellspacing=2 width=50% >\\r\\n<tr bgcolor=#EEEEF8><td><strong>A Seller Closed his dispute </strong></td></tr>\\r\\n<tr ><td>Dear Admin,\\r\\n</td></tr>\\r\\n<tr><td>The buyer <buyer> didn\'\'t pay for the item <itemtitle> number <number> for seller <seller>.Please refund the final sale value fee of <amount> <currency>.\\r\\n</td></tr>\\r\\n<tr><td>Thank You,\\r\\n</td></tr>\\r\\n<tr><td><sitename></td></tr>\\r\\n</table>'
)";
$sqlqry = mysql_query($sql);
if ($sqlqry)
    echo "aletered";




$sql = "INSERT INTO `mail_subjects` ( `mail_id` , `mail_title` , `mail_from` , `mail_subject` , `mail_message` )
VALUES (
'25', 'Confirmation mail to seller for open dispute', '$adminmail', 'You have opened a dispute', 'Dear <seller>,<br>\\r\\n You have opened a dispute to <buyer> of the following item:<br>\\r\\n<a href=<sitename>/detail.php?item_id=<number>><title1></a><number>\\r\\n<br>\\r\\nRegards,<br>\\r\\n<sitename>'
)";
$sqlqry = mysql_query($sql);
if ($sqlqry)
    echo "aletered";



$sql = "INSERT INTO `mail_subjects` ( `mail_id` , `mail_title` , `mail_from` , `mail_subject` , `mail_message` )
VALUES (
'27', 'Dispute reply message mail', '$adminmail', 'reply for dispute number <disputeid>', 'Dear <user>,<br>\\r\\nThe other party reply a new message in your dispute console about item <a href=<site>/detail.php?item_id=<number>><title1></a> <number><br>\\r\\nRegards,<br>\\r\\n<site>'
)";
$sqlqry = mysql_query($sql);
if ($sqlqry)
    echo "aletered";


$sql = "INSERT INTO `mail_subjects` ( `mail_id` , `mail_title` , `mail_from` , `mail_subject` , `mail_message` )
VALUES (
'28', 'Mail for Close Dispute', '$adminmail', 'dispute has been closed', 'Dear <user>,<br>\\r\\n The other party close the dispute for the item <a href=<site>/detail.php?item_id=<number>><title1></a> <number>.<br>\\r\\nRegards,<br>\\r\\n<site>'
)";
$sqlqry = mysql_query($sql);
if ($sqlqry)
    echo "aletered";


$sql = "update `admin_settings` set set_name='Open dispute waiting period',set_value='2' where set_id=58";
$result = mysql_query($sql);
if ($result)
    echo "aletered_admin settings";

$sql = "INSERT INTO `admin_settings` (`set_id`, `set_name`, `set_value`) VALUES (63, 'Close dispute waiting period', '2')";
$result = mysql_query($sql);
if ($result)
    echo "inserted into admin settings";


$sql = "DROP TABLE IF EXISTS `disputeconsole`";
$result = mysql_query($sql);


$sql = "CREATE TABLE `disputeconsole` (
  `dispute_id` int(11) NOT NULL auto_increment,
  `dispute_by` int(11) NOT NULL default '0',
  `dispute_to` int(11) NOT NULL default '0',
  `distute_bid_id` bigint(20) NOT NULL default '0',
  `dispute_date` date NOT NULL default '0000-00-00',
  `dispute_type` enum('unpaid','notreceived') NOT NULL default 'unpaid',
  `dispute_status` enum('open','closed') NOT NULL default 'open',
  `dispute_reason` varchar(200) NOT NULL default '',
  `dispute_explanation` varchar(250) NOT NULL default '',
  `payment_gateway` varchar(100) NOT NULL default '',
  `payment_date` date NOT NULL default '0000-00-00',
  `itemid` int(10) NOT NULL default '0',
  `del_status` enum('yes','no') NOT NULL default 'no',
  `dispute_close_status` enum('processing','granted','eligible','notapplicable') NOT NULL default 'processing',
  PRIMARY KEY  (`dispute_id`)
) TYPE=MyISAM  AUTO_INCREMENT=70";
$result = mysql_query($sql);
if ($result)
    echo "inserted into admin settings";
?>