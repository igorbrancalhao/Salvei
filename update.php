<?php require 'include/connect.php';
$sql="DROP TABLE IF EXISTS `small_banner`";
$sqlqry=mysql_query($sql);

$slq="CREATE TABLE `small_banner` (
  `banid` int(11) NOT NULL auto_increment,
  `banner` varchar(100) NOT NULL default '',
  `url` varchar(100) NOT NULL default '',
  `status` enum('enable','disable') NOT NULL default 'enable',
  PRIMARY KEY  (`banid`)
) TYPE=MyISAM";
$sqlqry=mysql_query($slq);

#
# Dumping data for table `small_banner`
#

$sql="INSERT INTO `small_banner` (`banid`, `banner`, `url`, `status`) VALUES (1, 'images/banner1.jpg', 'http://www.ajauctionpro.com', 'enable'),
(2, 'images/banner5.jpg', 'http://www.ajclassifieds.com', 'enable'),
(3, 'images/banner4.jpg', 'http://www.ajmatrix.com', 'enable'),
(4, 'images/banner2.jpg', 'http://www.ajmatrix.com', 'enable'),
(5, 'images/2007-12-15_6d0f8_index6_02.gif', 'http://www.ajsquare.com', 'enable')";
$slqqry=mysql_query($sql);


?>
