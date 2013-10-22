<?php
/***************************************************************************
 *File Name				:sell.php
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
session_start();
error_reporting(0);
$_SESSION['item_name']="";
$_SESSION['des']="";
$_SESSION['sell_method']="";
$_SESSION['currency']="";
$_SESSION['min_amt']="";
$_SESSION['quick_price'] ="";
$_SESSION['rev_price']="";
$_SESSION['bid_inc']="";
$_SESSION['size_of_qty']="";
$_SESSION['qty']="";
$_SESSION['start_delay']="";
$_SESSION['image1']="";
$_SESSION['image2']="";
$_SESSION['image3']="";
$_SESSION['image4']="";
$_SESSION['image5']="";
$_SESSION['image6']="";
$_SESSION['image7']="";
$_SESSION['shipping_route']="";
$_SESSION['shipping_amt']="";
$_SESSION['tax']="";
$_SESSION['mode']="";
$_SESSION['Gallery']="";
$_SESSION['Border']="";
$_SESSION['Highlight']="";
$_SESSION['Bold']="";
$_SESSION['Home']="";
$_SESSION['dur'] ="";
$_SESSION['categoryid']="";
$_SESSION['img1']="";
$_SESSION['img2']="";
$_SESSION['img3']="";
$_SESSION['img4']="";
$_SESSION['img5']="";
$_SESSION['img6']="";
$_SESSION['img7']="";
$_SESSION['dur'] ="";
$_SESSION['categoryid']="";
$_SESSION['subtitle']="";
$_SESSION['returns_accepted']="";
$_SESSION['refund_method']="";
$_SESSION['payment_instructions']="";
$_SESSION['listingdesinger']="";
$_SESSION['privatelistings']="";
$_SESSION['returnpolicy_instructions']="";
$_SESSION['refund_days']="";
$_SESSION['image4']="";
$_SESSION['image5']="";
$_SESSION['image6']="";
$_SESSION['image7']="";
$_SESSION['mode']="";
$_SESSION['description']="";
$_SESSION['theme_id']="";
$_SESSION['theme']="";
$_SESSION['layout']="";
$_SESSION['shipping_route']="";
$_SESSION['uploadvideolink']="";
$_SESSION['uploadflv']="";

$title="Sell";
$click="sell";
require 'include/top.php';

$sql_user_status="select status from user_registration where user_id=".$_SESSION['userid'];
$sqlqry_user_status=mysql_query($sql_user_status);
$sqlfetch_user_status=mysql_fetch_array($sqlqry_user_status);
$userstatus=$sqlfetch_user_status[0];
if($userstatus=='suspended')
{
echo '<meta http-equiv="refresh" content="0;url=suspendmode.php">';
exit();
}
require'templates/sell.tpl';
require 'include/footer.php';					
?>

