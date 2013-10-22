<?php
/* * *************************************************************************
 * File Name				:reviewpaymentdetails.php
 * File Created			:Wednesday, June 21, 2006
 * File Last Modified	:Wednesday, June 21, 2006
 * Copyright			:(C) 2001 AJ Square Inc
 * Email				:licence@ajsquare.net
 * Software Language	:PHP
 * Version Created		:V 4.3.2
 * Programmers worked	:S.Priya, B.ReenaKumari, K.Shanmuga priya
 * Modified By			:B.Reena
 * $Id                  : memberlist.php,v 1.36.2.12 2006/02/07 20:42:51 grahamje Exp $
 * ************************************************************************* */


/* * **************************************************************************

 *      Licence Agreement: 

 *     This program is a Commercial licensed software; 
 *     you are not authorized to redistribute it and/or modify/and or sell it under any publication 
 *     or license /or term it under the GNU General Public License as published by the Free Software Foundation;
 *     either user and developer versions of the License, or (at your option) 
 *     any later version is applicable for the same.

 * *************************************************************************** */
session_start();
require 'include/connect.php';

if (!isset($_SESSION['userid'])) {
    $link = "signin.php";
    $url = "pay.php";
    echo '<meta http-equiv="refresh" content="0;url=' . $link . '?url=' . $url . '">';
    exit();
}

$title = "Payment for item";
require 'include/top.php';

$item_id = $_REQUEST['item_id'];
$payid = $_REQUEST['paymentid_sel'];

$default_currency = "select * from admin_settings where set_id=59";
$default_res = mysql_query($default_currency);
$default_row = mysql_fetch_array($default_res);
$default_cur = $default_row['set_value'];

$default_currency_code = "select * from admin_settings where set_id=60";
$default_res_code = mysql_query($default_currency_code);
$default_row_code = mysql_fetch_array($default_res_code);
$default_cur_code = $default_row_code['set_value'];

/* $edit=$_REQUEST['edit'];
  $payment=$_REQUEST['payment'];
  $payid=$_REQUEST['payid']; */

/* if($edit=="edit")
  {
  $sql="update placing_item_bid set payment_gateway='$payment',payment_id='$payid' where item_id='$item_id'";
  $sqlquery=mysql_query($sql);
  if($sqlquery)
  echo '<meta http-equiv="refresh" content="0;url=reviewpaymentdetails.php?item_id='.$item_id.'">';
  exit();
  } */




$sql_user1 = "select * from placing_item_bid where item_id=$item_id";
$res_user1 = mysql_query($sql_user1);
$row = mysql_fetch_array($res_user1);

$item_title = $row[item_title];
/* $payid=$row[payment_gateway]; */
$query = "select * from user_registration where user_id =" . $row[user_id];
$table = mysql_query($query);
if ($seller_row = mysql_fetch_array($table)) {
    $seller_name = $seller_row['user_name'];
    $seller_email = $seller_row['email'];
}

$admin = "select * from admin_settings where set_id=1"; //sitename -> id=1
$admin_res = mysql_query($admin);
$admin_rec = mysql_fetch_array($admin_res);
$yoursite = $admin_rec[set_value];

$admin = "select * from admin_settings where set_id=3"; //sitename -> id=1
$admin_res = mysql_query($admin);
$admin_rec = mysql_fetch_array($admin_res);
$adminmail = $admin_rec[set_value];

$egold_sql = "select * from admin_settings where set_id=48";
$egold_res = mysql_query($egold_sql);
$egold_row = mysql_fetch_array($egold_res);
$egoldno = $egold_row['set_value'];

$egold_sql = "select * from admin_settings where set_id=49";
$egold_res = mysql_query($egold_sql);
$egold_row = mysql_fetch_array($egold_res);
$egoldname = $egold_row['set_value'];

$intgold_sql = "select * from admin_settings where set_id=50";
$intgold_res = mysql_query($intgold_sql);
$intgold_row = mysql_fetch_array($intgold_res);
$intgoldno = $intgold_row['set_value'];

$paypal_sql = "select * from admin_settings where set_id=11";
$paypal_res = mysql_query($paypal_sql);
$paypal_row = mysql_fetch_array($paypal_res);
$paypalno = $paypal_row['set_value'];

$strom_sql = "select * from admin_settings where set_id=51";
$strom_res = mysql_query($strom_sql);
$strom_row = mysql_fetch_array($strom_res);
$stormpayno = $strom_row['set_value'];

$ebull_sql = "select * from admin_settings where set_id=52";
$ebull_res = mysql_query($ebull_sql);
$ebull_row = mysql_fetch_array($ebull_res);
$ebull_no = $ebull_row['set_value'];

$ebull_sql = "select * from admin_settings where set_id=52";
$ebull_res = mysql_query($ebull_sql);
$ebull_row = mysql_fetch_array($ebull_res);
$ebull_name = $ebull_row['set_value'];

$moneybooker_sql = "select * from admin_settings where set_id=53";
$moneybooker_res = mysql_query($moneybooker_sql);
$moneybooker_row = mysql_fetch_array($moneybooker_res);
$moneybooker = $moneybooker_row['set_value'];

/* if($row[selling_method]=='ads')
  {
  $sqlgateway="select * from payment_gateway where status='Yes'";
  $sqlgatewayqry=mysql_query($sqlgateway);
  $sqlgatewayfetch=mysql_fetch_array($sqlgatewayqry);
  $payid=$sqlgatewayfetch['gateway_id'];
  } */


$fee_sql = "select * from auction_fees where item_id=" . $item_id;
$fee_res = mysql_query($fee_sql);
$fee_row = mysql_fetch_array($fee_res);
if ($row['selling_method'] != "ads") {
    $total_setup_fee = $fee_row['homepage_featureditem_fee'] + $fee_row['gallery_fee'] + $fee_row['boldlisting_fee'] + $fee_row['highlighted_fee'] + $fee_row['subtitlefee'] + $fee_row['listing_desinger_fee'] + $fee_row['addtional_pic_fee'] + $fee_row['reserve_price_fee'] +
            $fee_row['Insertion_fee'];
}
if ($row['selling_method'] == "ads") {
    $total_setup_fee = $fee_row['homepage_featureditem_fee'] + $fee_row['gallery_fee'] + $fee_row['boldlisting_fee'] + $fee_row['highlighted_fee'] + $fee_row['subtitlefee'] + $fee_row['listing_desinger_fee'] + $fee_row['addtional_pic_fee'] + $fee_row['reserve_price_fee'] +
            $fee_row['classifedad_fee'];
}
$amount = $total_setup_fee;

$_SESSION['amount'] = $total_setup_fee;
$_SESSION['item_id'] = $item_id;
$_SESSION['payment_gateway'] = $payid;

/* $sql_1="select * from placing_item_bid where item_id=$item_id";
  $sqlqry=mysql_query($sql_1);
  $sqlqryfetch=mysql_fetch_array($sqlqry);
  $paymentid=$sqlqryfetch['payment_id'];
  $payname=$sqlqryfetch['payment_name'];

 */

require'templates/reviewpaymentdetails.tpl';
require 'include/footer.php';
?>

<!--<script language="javascript">
function pay_refresh()
{
       payment=document.editpay.payment.value;
               if(payment=="") {
               pay.innerHTML="";
       }
       else if(payment==1){ 
               txt="<input type=text name=payid value=<?php = $paymentid; ?>>";
               pay.innerHTML="<b>Paypal Id</b>"+txt;
       }
       else if(payment==2){ 
               txt="<input type=text name=payid value=<?php = $paymentid; ?>>";
               pay.innerHTML="<b>Visa Card Id</b> "+txt;
       }
       else if(payment==3){ 
               txt="<input type=text name=payid value=<?php = $paymentid; ?>>";
               txtname="<input type=text name=payname value=<?php = $payname; ?>>";
               pay.innerHTML="<b>Master Card Id</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "+txt+"<br><b>Master Card name</b>  "+txtname;
       }
       else if(payment==4){ 
               txt="<input type=text name=payid value=<?php = $paymentid; ?>>";
               pay.innerHTML="<b>American Express Id</b> "+txt;
       }
       else if(payment==5){ 
       txt="<input type=text name=payid value=<?php = $paymentid; ?>>";
               txtname="<input type=text name=payname value=<?php = $payname; ?>>";
               pay.innerHTML="<b>Discover Card Id</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "+txt+"<br><b>Discover Card name</b>  "+txtname;
               }
   else if(payment==6){ 
               txt="<input type=text name=payid value=<?php = $payid; ?>>";
               pay.innerHTML="<b>Personal Check Id</b> "+txt;
       }
       else if(payment==14){ 
               pay.innerHTML="";
       }
}
</script>-->

