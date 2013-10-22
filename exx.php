<?php require 'include/connect.php';



$chkqry="DROP TABLE IF EXISTS `themes_master`";
$chkqryex=mysql_query($chkqry);
if($chkqryex)
echo "Executed";

$chkqry="CREATE TABLE `themes_master` (
  `themes_id` bigint(20) NOT NULL auto_increment,
  `category_id` int(11) NOT NULL default '0',
  `theme_name` varchar(50) NOT NULL default '',
  `themes` varchar(100) NOT NULL default '',
  `theme_top_img` varchar(100) NOT NULL default '',
  `theme_content_img` varchar(100) NOT NULL default '',
  `theme_bottom_img` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`themes_id`)
) TYPE=MyISAM";
$chkqryex=mysql_query($chkqry);
if($chkqryex)
echo "Executed";

#
# Dumping data for table `themes_master`
#

$chkqry="INSERT INTO `themes_master` (`themes_id`, `category_id`, `theme_name`, `themes`, `theme_top_img`, `theme_content_img`, `theme_bottom_img`) VALUES (1, 23, 'Anitiques: Art', 'themes1.gif', 'theme_top.gif', 'theme_content.gif', 'theme_bot.gif'),
(2, 21, 'Anitiques: Art1', 'fram1_thump.jpg', 'fram3_01.jpg', 'fram3_03.jpg', 'fram3_04.jpg'),
(3, 0, 'Anitiques: Art2', 'thumnail3.gif', 'top.gif', 'bg.gif', 'bottom.gif'),
(4, 0, 'Anitiques: Art3', 'thumnail4.gif', 'theme2top.gif', 'theme2bg.gif', 'theme2bottom.gif'),
(5, 0, 'Anitiques: Art4', 'thumnail5.gif', 'theme3top.gif', 'theme3bg.gif', 'theme3bottom.gif')";

$chkqryex=mysql_query($chkqry);
if($chkqryex)
echo "Executed";


$chkqry=" ALTER TABLE `placing_item_bid` CHANGE `payment_id` `payment_id` VARCHAR( 100 ) DEFAULT '0' NOT NULL ";
$chkqryex=mysql_query($chkqry);
if($chkqryex)
echo "Executed";

?>