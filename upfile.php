<?php

require 'include/connect.php';

$sql = "DROP TABLE IF EXISTS `site_announcement`";
$sqlqry = mysql_query($sql);

$sql = "CREATE TABLE `site_announcement` (
  `id` int(11) NOT NULL default '0',
  `title` varchar(50) NOT NULL default '',
  `site_announcement` varchar(255) NOT NULL default '',
  UNIQUE KEY `index` (`id`)
) TYPE=MyISAM";
$sqlqry = mysql_query($sql);

$sql = "INSERT INTO `site_announcement` (`id`, `title`, `site_announcement`) VALUES (1, '', 'Auction is The World\'s Online Marketplace�, enabling trade on a local, national and international basis. With a diverse and passionate community of individuals and small businesses, AJ Auction offers an online platform for auction sale.')";
$sqlqry = mysql_query($sql);
?>
