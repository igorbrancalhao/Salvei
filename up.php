<?php require 'include/connect.php';

$sql="ALTER TABLE `pay_transaction` CHANGE `trans_type` `trans_type` ENUM( 'Store Fee', 'Final Sale Value Fee', 'Featured Listing Fee', 'buyitem' ) DEFAULT 'Store Fee' NOT NULL";
$sqlqry=mysql_query($sql);

?>