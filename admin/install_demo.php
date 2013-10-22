<?php
/***************************************************************************
 *File Name				:install_demo.php
 *File Created				:Wednesday, June 21, 2006
 * File Last Modified			:Wednesday, June 21, 2006
 * Copyright				:(C) 2001 AJ Square Inc
 * Email				:licence@ajsquare.net
 * Software Language			:PHP
 * Version Created			:V 4.3.2
 * Programmers worked	        	:S.Priya, B.ReenaKumari, K.Shanmuga priya
 * $Id                                  : memberlist.php,v 1.36.2.12 2006/02/07 20:42:51 grahamje Exp $
 *
 ***************************************************************************/
 

/****************************************************************************
 
*      Licence Agreement: 
 
*     This program is a Commercial licensed software; 
*     you are not authorized to redistribute it and/or modify/and or sell it under any publication 
*     or license /or term it under the GNU General Public License as published by the Free Software Foundation;
*     either user and developer versions of the License, or (at your option) 
*     any later version is applicable for the same.
 
*****************************************************************************/
 ?>
<?php

require 'include/connect.php';

$sql="delete from user_registration";
$res=mysql_query($sql);
$sql="delete from placing_item_bid";
$res=mysql_query($sql);
$sql="delete from placing_bid_item";
$res=mysql_query($sql);
$sql="delete from ask_question";
$res=mysql_query($sql);
$sql="delete from feedback";
$res=mysql_query($sql);
$sql="delete from featured_items";
$res=mysql_query($sql);
$sql="delete from user_alert";
$res=mysql_query($sql);
$sql="delete from watch_list";
$res=mysql_query($sql);
$sql="delete from want_it_now";
$res=mysql_query($sql);


$sql="INSERT INTO `user_registration` (`user_id`, `intro_id`, `plan_id`, `member_account`, `user_name`, `email`, `first_name`, `last_name`, `html_profile`, `address`, `city`, `state`, `pin_code`, `country`, `home_phone`, `work_phone`, `password`, `verified`, `veri_code`, `status`, `date_of_registration`, `expire_date`, `last_login_date`, `Onlinestatus`, `ip_address`, `email_enable_status`, `paid`, `original_account`, `trusted`) VALUES (20, 0, 4, '2', 'demo', 'skpriyamari1@gmail.com', 'demo2341', 'demo2341', 'gdfgdfg', 'fghgjkd2341', 'tyughgd41', '3223', '123456', 41, 48362147, 2147483647, 'demo1234', 'yes',
 'fe01ce2a7fbac8f', 'Active', '2005-06-28', '0000-00-00', '2005-10-19', 'Online', '61.247.255.242', 'Yes', 'Yes', '1', 'inactive')";
 $result=mysql_query($sql);
 $sql="INSERT INTO `user_registration` (`user_id`, `intro_id`, `plan_id`, `member_account`, `user_name`, `email`, `first_name`, `last_name`, `html_profile`, `address`, `city`, `state`, `pin_code`, `country`, `home_phone`, `work_phone`, `password`, `verified`, `veri_code`, `status`, `date_of_registration`, `expire_date`, `last_login_date`, `Onlinestatus`, `ip_address`, `email_enable_status`, `paid`, `original_account`, `trusted`) VALUES (1, 0, 4, '2', 'admin', 'skpriyamari1@gmail.com', 'demo2341', 'demo2341', 'gdfgdfg', 'fghgjkd2341', 'tyughgd41', '3223', '123456', 41, 48362147, 2147483647, 'admin', 'yes',
 'fe01ce2a7fbac8f', 'Active', '2005-06-28', '0000-00-00', '2005-10-19', 'Online', '61.247.255.242', 'Yes', 'Yes', '1', 'trusted')";
 $result=mysql_query($sql);
 
 
 $sql="INSERT INTO `placing_item_bid` (`item_id`, `user_id`, `category_id`, `item_title`, `item_counter_style`, `Quantity`, `payment_gateway`, `detailed_descrip`, `selling_method`, `min_bid_amount`, `bid_increment`, `shipping_cost`, `who_pay_shipping`, `shipping_route`, `duration`, `currency`, `reserve_price`, `quick_buy_price`, `bid_starting_date`, `start_delay`, `status`, `picture1`, `picture2`, `picture3`, `picture4`, `picture5`, `payment_name`, `quantity_sold`, `clicks`, `expire_date`, `payment_id`, `size_of_quantity`, `tax`, `sniper`, `no_of_repost`) VALUES (569, 20, 23, 'car', '1', 2, '', 'good looking', 'auction', 10000.00, 100, 65, 'Inclusive', 'Australia Asia Americanada Europe Africa', 12, '$', 9865.00, 15000.00, '2005-10-19 07:18:59', 1, 'Active', '2B035.jpg', '', '', '', '', '', 0, 50, '2005-11-01 07:18:59', '', 'Pieces', 32, 'yes', 1)";
$result=mysql_query($sql);

$sql="INSERT INTO `placing_item_bid` (`item_id`, `user_id`, `category_id`, `item_title`, `item_counter_style`, `Quantity`, `payment_gateway`, `detailed_descrip`, `selling_method`, `min_bid_amount`, `bid_increment`, `shipping_cost`, `who_pay_shipping`, `shipping_route`, `duration`, `currency`, `reserve_price`, `quick_buy_price`, `bid_starting_date`, `start_delay`, `status`, `picture1`, `picture2`, `picture3`, `picture4`, `picture5`, `payment_name`, `quantity_sold`, `clicks`, `expire_date`, `payment_id`, `size_of_quantity`, `tax`, `sniper`, `no_of_repost`) VALUES (570, 20, 23, 'car', '1', 2, '', 'good looking', 'auction', 10000.00, 100, 65, 'Inclusive', 'Australia Asia Americanada Europe Africa', 12, '$', 9865.00, 15000.00, '2005-10-19 07:18:59', 1, 'Active', '2B035.jpg', '', '', '', '', '', 0, 50, '2005-11-01 07:18:59', '', 'Pieces', 32, 'yes', 1)";
$result=mysql_query($sql);

$sql="INSERT INTO `placing_item_bid` (`item_id`, `user_id`, `category_id`, `item_title`, `item_counter_style`, `Quantity`, `payment_gateway`, `detailed_descrip`, `selling_method`, `min_bid_amount`, `bid_increment`, `shipping_cost`, `who_pay_shipping`, `shipping_route`, `duration`, `currency`, `reserve_price`, `quick_buy_price`, `bid_starting_date`, `start_delay`, `status`, `picture1`, `picture2`, `picture3`, `picture4`, `picture5`, `payment_name`, `quantity_sold`, `clicks`, `expire_date`, `payment_id`, `size_of_quantity`, `tax`, `sniper`, `no_of_repost`) VALUES (571, 20, 23, 'car', '1', 2, '', 'good looking', 'auction', 10000.00, 100, 65, 'Inclusive', 'Australia Asia Americanada Europe Africa', 12, '$', 9865.00, 15000.00, '2005-10-19 07:18:59', 1, 'Active', '2B035.jpg', '', '', '', '', '', 0, 50, '2005-11-01 07:18:59', '', 'Pieces', 32, 'yes', 1)";
$result=mysql_query($sql);

$sql="INSERT INTO `placing_item_bid` (`item_id`, `user_id`, `category_id`, `item_title`, `item_counter_style`, `Quantity`, `payment_gateway`, `detailed_descrip`, `selling_method`, `min_bid_amount`, `bid_increment`, `shipping_cost`, `who_pay_shipping`, `shipping_route`, `duration`, `currency`, `reserve_price`, `quick_buy_price`, `bid_starting_date`, `start_delay`, `status`, `picture1`, `picture2`, `picture3`, `picture4`, `picture5`, `payment_name`, `quantity_sold`, `clicks`, `expire_date`, `payment_id`, `size_of_quantity`, `tax`, `sniper`, `no_of_repost`) VALUES (572, 20, 23, 'car', '1', 2, '', 'good looking', 'auction', 10000.00, 100, 65, 'Inclusive', 'Australia Asia Americanada Europe Africa', 12, '$', 9865.00, 15000.00, '2005-10-19 07:18:59', 1, 'Active', '2B035.jpg', '', '', '', '', '', 0, 50, '2005-11-01 07:18:59', '', 'Pieces', 32, 'yes', 1)";
$result=mysql_query($sql);
$sql="INSERT INTO `placing_item_bid` (`item_id`, `user_id`, `category_id`, `item_title`, `item_counter_style`, `Quantity`, `payment_gateway`, `detailed_descrip`, `selling_method`, `min_bid_amount`, `bid_increment`, `shipping_cost`, `who_pay_shipping`, `shipping_route`, `duration`, `currency`, `reserve_price`, `quick_buy_price`, `bid_starting_date`, `start_delay`, `status`, `picture1`, `picture2`, `picture3`, `picture4`, `picture5`, `payment_name`, `quantity_sold`, `clicks`, `expire_date`, `payment_id`, `size_of_quantity`, `tax`, `sniper`, `no_of_repost`) VALUES (573, 20, 23, 'car', '1', 2, '', 'good looking', 'auction', 10000.00, 100, 65, 'Inclusive', 'Australia Asia Americanada Europe Africa', 12, '$', 9865.00, 15000.00, '2005-10-19 07:18:59', 1, 'Active', '2B035.jpg', '', '', '', '', '', 0, 50, '2005-11-01 07:18:59', '', 'Pieces', 32, 'yes', 1)";
$result=mysql_query($sql);
$sql="INSERT INTO `placing_item_bid` (`item_id`, `user_id`, `category_id`, `item_title`, `item_counter_style`, `Quantity`, `payment_gateway`, `detailed_descrip`, `selling_method`, `min_bid_amount`, `bid_increment`, `shipping_cost`, `who_pay_shipping`, `shipping_route`, `duration`, `currency`, `reserve_price`, `quick_buy_price`, `bid_starting_date`, `start_delay`, `status`, `picture1`, `picture2`, `picture3`, `picture4`, `picture5`, `payment_name`, `quantity_sold`, `clicks`, `expire_date`, `payment_id`, `size_of_quantity`, `tax`, `sniper`, `no_of_repost`) VALUES (574, 20, 23, 'car', '1', 2, '', 'good looking', 'auction', 10000.00, 100, 65, 'Inclusive', 'Australia Asia Americanada Europe Africa', 12, '$', 9865.00, 15000.00, '2005-10-19 07:18:59', 1, 'Active', '2B035.jpg', '', '', '', '', '', 0, 50, '2005-11-01 07:18:59', '', 'Pieces', 32, 'yes', 1)";
$result=mysql_query($sql);
$sql="INSERT INTO `placing_item_bid` (`item_id`, `user_id`, `category_id`, `item_title`, `item_counter_style`, `Quantity`, `payment_gateway`, `detailed_descrip`, `selling_method`, `min_bid_amount`, `bid_increment`, `shipping_cost`, `who_pay_shipping`, `shipping_route`, `duration`, `currency`, `reserve_price`, `quick_buy_price`, `bid_starting_date`, `start_delay`, `status`, `picture1`, `picture2`, `picture3`, `picture4`, `picture5`, `payment_name`, `quantity_sold`, `clicks`, `expire_date`, `payment_id`, `size_of_quantity`, `tax`, `sniper`, `no_of_repost`) VALUES (575, 20, 23, 'car', '1', 2, '', 'good looking', 'auction', 10000.00, 100, 65, 'Inclusive', 'Australia Asia Americanada Europe Africa', 12, '$', 9865.00, 15000.00, '2005-10-19 07:18:59', 1, 'Active', '2B035.jpg', '', '', '', '', '', 0, 50, '2005-11-01 07:18:59', '', 'Pieces', 32, 'yes', 1)";
$result=mysql_query($sql);
$sql="INSERT INTO `placing_item_bid` (`item_id`, `user_id`, `category_id`, `item_title`, `item_counter_style`, `Quantity`, `payment_gateway`, `detailed_descrip`, `selling_method`, `min_bid_amount`, `bid_increment`, `shipping_cost`, `who_pay_shipping`, `shipping_route`, `duration`, `currency`, `reserve_price`, `quick_buy_price`, `bid_starting_date`, `start_delay`, `status`, `picture1`, `picture2`, `picture3`, `picture4`, `picture5`, `payment_name`, `quantity_sold`, `clicks`, `expire_date`, `payment_id`, `size_of_quantity`, `tax`, `sniper`, `no_of_repost`) VALUES (576, 20, 23, 'car', '1', 2, '', 'good looking', 'auction', 10000.00, 100, 65, 'Inclusive', 'Australia Asia Americanada Europe Africa', 12, '$', 9865.00, 15000.00, '2005-10-19 07:18:59', 1, 'Active', '2B035.jpg', '', '', '', '', '', 0, 50, '2005-11-01 07:18:59', '', 'Pieces', 32, 'yes', 1)";
$result=mysql_query($sql);
$sql="INSERT INTO `placing_item_bid` (`item_id`, `user_id`, `category_id`, `item_title`, `item_counter_style`, `Quantity`, `payment_gateway`, `detailed_descrip`, `selling_method`, `min_bid_amount`, `bid_increment`, `shipping_cost`, `who_pay_shipping`, `shipping_route`, `duration`, `currency`, `reserve_price`, `quick_buy_price`, `bid_starting_date`, `start_delay`, `status`, `picture1`, `picture2`, `picture3`, `picture4`, `picture5`, `payment_name`, `quantity_sold`, `clicks`, `expire_date`, `payment_id`, `size_of_quantity`, `tax`, `sniper`, `no_of_repost`) VALUES (577, 20, 23, 'car', '1', 2, '', 'good looking', 'auction', 10000.00, 100, 65, 'Inclusive', 'Australia Asia Americanada Europe Africa', 12, '$', 9865.00, 15000.00, '2005-10-19 07:18:59', 1, 'Active', '2B035.jpg', '', '', '', '', '', 0, 50, '2005-11-01 07:18:59', '', 'Pieces', 32, 'yes', 1)";
$result=mysql_query($sql);

$sql="INSERT INTO `placing_item_bid` (`item_id`, `user_id`, `category_id`, `item_title`, `item_counter_style`, `Quantity`, `payment_gateway`, `detailed_descrip`, `selling_method`, `min_bid_amount`, `bid_increment`, `shipping_cost`, `who_pay_shipping`, `shipping_route`, `duration`, `currency`, `reserve_price`, `quick_buy_price`, `bid_starting_date`, `start_delay`, `status`, `picture1`, `picture2`, `picture3`, `picture4`, `picture5`, `payment_name`, `quantity_sold`, `clicks`, `expire_date`, `payment_id`, `size_of_quantity`, `tax`, `sniper`, `no_of_repost`) VALUES (578, 20, 23, 'car', '1', 2, '', 'good looking', 'auction', 10000.00, 100, 65, 'Inclusive', 'Australia Asia Americanada Europe Africa', 12, '$', 9865.00, 15000.00, '2005-10-19 07:18:59', 1, 'Active', '2B035.jpg', '', '', '', '', '', 0, 50, '2005-11-01 07:18:59', '', 'Pieces', 32, 'yes', 1)";
$result=mysql_query($sql);
$sql="INSERT INTO `placing_item_bid` (`item_id`, `user_id`, `category_id`, `item_title`, `item_counter_style`, `Quantity`, `payment_gateway`, `detailed_descrip`, `selling_method`, `min_bid_amount`, `bid_increment`, `shipping_cost`, `who_pay_shipping`, `shipping_route`, `duration`, `currency`, `reserve_price`, `quick_buy_price`, `bid_starting_date`, `start_delay`, `status`, `picture1`, `picture2`, `picture3`, `picture4`, `picture5`, `payment_name`, `quantity_sold`, `clicks`, `expire_date`, `payment_id`, `size_of_quantity`, `tax`, `sniper`, `no_of_repost`) VALUES (579, 20, 23, 'car', '1', 2, '', 'good looking', 'auction', 10000.00, 100, 65, 'Inclusive', 'Australia Asia Americanada Europe Africa', 12, '$', 9865.00, 15000.00, '2005-10-19 07:18:59', 1, 'Active', '2B035.jpg', '', '', '', '', '', 0, 50, '2005-11-01 07:18:59', '', 'Pieces', 32, 'yes', 1)";
$result=mysql_query($sql);
$sql="INSERT INTO `placing_item_bid` (`item_id`, `user_id`, `category_id`, `item_title`, `item_counter_style`, `Quantity`, `payment_gateway`, `detailed_descrip`, `selling_method`, `min_bid_amount`, `bid_increment`, `shipping_cost`, `who_pay_shipping`, `shipping_route`, `duration`, `currency`, `reserve_price`, `quick_buy_price`, `bid_starting_date`, `start_delay`, `status`, `picture1`, `picture2`, `picture3`, `picture4`, `picture5`, `payment_name`, `quantity_sold`, `clicks`, `expire_date`, `payment_id`, `size_of_quantity`, `tax`, `sniper`, `no_of_repost`) VALUES (580, 20, 23, 'car', '1', 2, '', 'good looking', 'auction', 10000.00, 100, 65, 'Inclusive', 'Australia Asia Americanada Europe Africa', 12, '$', 9865.00, 15000.00, '2005-10-19 07:18:59', 1, 'Active', '2B035.jpg', '', '', '', '', '', 0, 50, '2005-11-01 07:18:59', '', 'Pieces', 32, 'yes', 1)";
$result=mysql_query($sql);
$sql="INSERT INTO `placing_item_bid` (`item_id`, `user_id`, `category_id`, `item_title`, `item_counter_style`, `Quantity`, `payment_gateway`, `detailed_descrip`, `selling_method`, `min_bid_amount`, `bid_increment`, `shipping_cost`, `who_pay_shipping`, `shipping_route`, `duration`, `currency`, `reserve_price`, `quick_buy_price`, `bid_starting_date`, `start_delay`, `status`, `picture1`, `picture2`, `picture3`, `picture4`, `picture5`, `payment_name`, `quantity_sold`, `clicks`, `expire_date`, `payment_id`, `size_of_quantity`, `tax`, `sniper`, `no_of_repost`) VALUES (581, 20, 23, 'car', '1', 2, '', 'good looking', 'auction', 10000.00, 100, 65, 'Inclusive', 'Australia Asia Americanada Europe Africa', 12, '$', 9865.00, 15000.00, '2005-10-19 07:18:59', 1, 'Active', '2B035.jpg', '', '', '', '', '', 0, 50, '2005-11-01 07:18:59', '', 'Pieces', 32, 'yes', 1)";
$result=mysql_query($sql);
$sql="INSERT INTO `placing_item_bid` (`item_id`, `user_id`, `category_id`, `item_title`, `item_counter_style`, `Quantity`, `payment_gateway`, `detailed_descrip`, `selling_method`, `min_bid_amount`, `bid_increment`, `shipping_cost`, `who_pay_shipping`, `shipping_route`, `duration`, `currency`, `reserve_price`, `quick_buy_price`, `bid_starting_date`, `start_delay`, `status`, `picture1`, `picture2`, `picture3`, `picture4`, `picture5`, `payment_name`, `quantity_sold`, `clicks`, `expire_date`, `payment_id`, `size_of_quantity`, `tax`, `sniper`, `no_of_repost`) VALUES (582, 20, 23, 'car', '1', 2, '', 'good looking', 'auction', 10000.00, 100, 65, 'Inclusive', 'Australia Asia Americanada Europe Africa', 12, '$', 9865.00, 15000.00, '2005-10-19 07:18:59', 1, 'Active', '2B035.jpg', '', '', '', '', '', 0, 50, '2005-11-01 07:18:59', '', 'Pieces', 32, 'yes', 1)";
$result=mysql_query($sql);

$sql="INSERT INTO featured_items VALUES (9, 572, 'No', 'Yes', 'No', 'No', 'No', 'Yes', '')";
$result=mysql_query($sql);
$sql="INSERT INTO featured_items VALUES (10, 573, 'No', 'Yes', 'No', 'No', 'No', 'Yes', '')";
$result=mysql_query($sql);
$sql="INSERT INTO featured_items VALUES (11, 574, 'No', 'Yes', 'No', 'No', 'No', 'Yes', '')";
$result=mysql_query($sql);
$sql="INSERT INTO featured_items VALUES (12, 575, 'No', 'Yes', 'No', 'No', 'No', 'Yes', '')";
$result=mysql_query($sql);
$sql="INSERT INTO featured_items VALUES (13, 576, 'No', 'Yes', 'No', 'No', 'No', 'Yes', '')";
$result=mysql_query($sql);
$sql="INSERT INTO featured_items VALUES (14, 577, 'No', 'Yes', 'No', 'No', 'No', 'Yes', '')";
$result=mysql_query($sql);
$sql="INSERT INTO featured_items VALUES (15, 578, 'No', 'Yes', 'No', 'No', 'No', 'Yes', '')";
$result=mysql_query($sql);
$sql="INSERT INTO featured_items VALUES (16, 579, 'No', 'Yes', 'No', 'No', 'No', 'Yes', '')";
$result=mysql_query($sql);
$sql="INSERT INTO featured_items VALUES (17, 580, 'No', 'Yes', 'No', 'No', 'No', 'Yes', '')";
$result=mysql_query($sql);
$sql="INSERT INTO featured_items VALUES (18, 581, 'No', 'Yes', 'No', 'No', 'No', 'Yes', '')";
$result=mysql_query($sql);
	











?>