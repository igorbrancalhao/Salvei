<?php

require 'include/connect.php';
$sql = "ALTER TABLE `placing_item_bid` CHANGE `crosspromote` `crosspromote` TEXT NOT NULL";
$sqlqry = mysql_query($sql);
if ($sqlqry)
    echo "Altered";
?>