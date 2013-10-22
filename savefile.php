<?php require 'include/connect.php';
$sql="ALTER TABLE `admin_rates` CHANGE `gallery_price` `gallery_price` FLOAT( 5, 2 ) DEFAULT '0' NOT NULL ,
CHANGE `homepage_price` `homepage_price` FLOAT( 5, 2 ) DEFAULT '0' NOT NULL ,
CHANGE `subtitle_price` `subtitle_price` FLOAT( 5, 2 ) DEFAULT '0' NOT NULL ,
CHANGE `bold_price` `bold_price` FLOAT( 5, 2 ) DEFAULT '0' NOT NULL ,
CHANGE `highlight_price` `highlight_price` FLOAT( 5, 2 ) DEFAULT '0' NOT NULL ,
CHANGE `Insertion_fee` `Insertion_fee` FLOAT( 5, 2 ) DEFAULT '0' NOT NULL ,
CHANGE `Classified_fee` `Classified_fee` FLOAT( 5, 2 ) DEFAULT '0' NOT NULL ,
CHANGE `listing_designer_fee` `listing_designer_fee` FLOAT( 5, 2 ) DEFAULT '0' NOT NULL ,
CHANGE `Image_listing_fee` `Image_listing_fee` FLOAT( 5, 2 ) DEFAULT '0' NOT NULL ,
CHANGE `reserve_price_fee` `reserve_price_fee` FLOAT( 5, 2 ) DEFAULT '0' NOT NULL";
$sqlqry=mysql_query($sql); 
if($sqlqry)
echo "CHANGED";