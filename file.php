<?php require 'include/connect.php';


$sql="DROP TABLE IF EXISTS `staticbanners`";
$sqlqry=mysql_query($sql);
$sql="CREATE TABLE `staticbanners` (
  `banner_id` int(11) NOT NULL auto_increment,
  `banner_name` varchar(50) NOT NULL default '',
  `banner_path` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`banner_id`)
) TYPE=MyISAM";
$sqlqry=mysql_query($sql);


$sql="INSERT INTO `staticbanners` (`banner_id`, `banner_name`, `banner_path`) VALUES (1, 'staticbanner1', 'index6_02.gif'),
(2, 'staticbanner2', 'welcomebg1.jpg'),
(3, 'staticbanner3', 'ban.gif')";
$sqlqry=mysql_query($sql);


?>