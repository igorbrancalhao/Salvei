<?php

require 'include/connect.php';

/* $update="update currency_master set currency='&euro;' where currency='�'";
  $update_sql=mysql_query($update);
  if($update_sql)
  echo "Updated";

  $update="update placing_item_bid set currency='&euro;' where currency='�'";
  $update_sql=mysql_query($update);
  if($update_sql)
  echo "Updated"; */

$slqq = "update placing_item_bid set expire_date='2008-02-18 00:51:04pay' where item_id=11013";
$update_sql = mysql_query($slqq);
if ($update_sql)
    echo "Updated";

$slqq = "update placing_item_bid set expire_date='2008-02-18 00:51:04pay' where item_id=11050";
$update_sql = mysql_query($slqq);
if ($update_sql)
    echo "Updated";

$update = "update storefronts set status='disable',statususer='inactive' where status=' '";
$update_sql = mysql_query($update);
if ($update_sql)
    echo "Updated";
?>