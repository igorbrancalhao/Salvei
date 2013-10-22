<?php require 'include/connect.php';

$sql="ALTER TABLE `ask_question` CHANGE `answer` `answer` LONGTEXT NOT NULL";
$sqlqry=mysql_query($sql); 


$sql="ALTER TABLE `retraction` CHANGE `retrack_amt` `retrack_amt` DOUBLE( 10, 2 ) DEFAULT '0' NOT NULL";
$sqlqry=mysql_query($sql);

$sql="ALTER TABLE `placing_bid_item` ADD `won_status` ENUM( '0', '1' ) DEFAULT '0' NOT NULL" ;
$sqlqry=mysql_query($sql);




?>