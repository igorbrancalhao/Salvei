<?php

require 'include/connect.php';
$sql = " ALTER TABLE `meta_tag` CHANGE `key_s` `key_s` TEXT NOT NULL ";
$query = mysql_query($sql);
if ($query)
    echo "aleterd";
?>