<?php
/* * *************************************************************************
 * File Name				:edit_auction_step3.php
 * File Created				:Wednesday, June 21, 2006
 * File Last Modified			:Wednesday, June 21, 2006
 * Copyright				:(C) 2001 AJ Square Inc
 * Email				:licence@ajsquare.net
 * Software Language			:PHP
 * Version Created			:V 4.3.2
 * Programmers worked	        	:S.Priya, B.ReenaKumari, K.Shanmuga priya
 * $Id                                  : memberlist.php,v 1.36.2.12 2006/02/07 20:42:51 grahamje Exp $
 *
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
error_reporting(0);
//$_SESSION['categoryid'];
require 'include/connect.php';
if ($_GET['item_id'])
$_SESSION['item_id'] = $_GET['item_id'];
$item_id = $_SESSION['item_id'];
$flag = $_POST['flag'];
$sql = "select * from placing_item_bid where item_id=$item_id";
$res = mysql_query($sql);
$row = mysql_fetch_array($res);
$payment = $row['payment_gateway'];
$shipping_route = $row['shipping_route'];
$_SESSION['shipping_route'] = $shipping_route;
$shipping_amt = $row['shipping_cost'];
$tax = $row['tax'];
$returns_accepted = $row['returns_accepted'];
$refund_days = $row['refund_days'];
$refund_method = $row['refund_method'];
$returnpolicy_instructions = $row['returnpolicy_instructions'];
$payment_instructions = $row['payment_instructions'];

if ($flag == 1) {
$payment = $_POST['payment'];
//$shipping_route=$_POST[];
$shipping_amt = $_POST[txtship_amt];
//shipping amount checking for special characters and to accept only numbers
$validZipExpr = "^[0-9.]*$";
if (!empty($shipping_amt)) {
if (!eregi($validZipExpr, $shipping_amt)) {
$err_ship = "Invalid shipping amount";
$err_flag = 1;
}
}
$tax = $_POST[tax];
//tax checking to accept only numbers and not special characters
if (!empty($tax)) {
if (!eregi($validZipExpr, $tax)) {
$err_tax = "Invalid tax amount";
$err_flag = 1;
}
}
$returns_accepted = $_POST[chkreturns];
$refund_method = $_POST[cborefund];
$returnpolicy_instructions = $_POST[txtploicy];
$payment_instructions = $_POST[txtpaymentins];
$refund_days = $_POST[cboreturndays];
$ship_sql = "select * from shipping_location";
$ship_res = mysql_query($ship_sql);
$total1 = mysql_num_rows($ship_res);
$shipping_route = " ";
for ($s = 0;
$s <= $total1;
$s++) {
if ($_REQUEST['ship' . $s]) {

$shipping_route.=$_REQUEST['ship' . $s];
$shipping_route.=",";
}
}
$shipping_route = rtrim($shipping_route, ",");
if ($err_flag != 1) {
$sql = "update placing_item_bid set shipping_route='$shipping_route',tax='$tax',shipping_cost='$shipping_amt',returns_accepted='$returns_accepted', refund_days='$refund_days',refund_method='$refund_method',payment_instructions='$payment_instructions',
returnpolicy_instructions='$returnpolicy_instructions' where item_id=$item_id";
$sqlqry = mysql_query($sql);
echo '<meta http-equiv="refresh" content="0;url=myauction.php">';
echo "You have been Re-Directed, if not Please <a href=myauction.php>Click here</a>";
exit();
}
}
?>
<script language="javascript">
    function selectall()
    {
        if (document.ship.world.checked == false)
        {
            document.ship.aus.checked = false;
            document.ship.america.checked = false;
            document.ship.europe.checked = false;
            document.ship.africa.checked = false;
            document.ship.asia.checked = false;
        }
        else
        {
            document.ship.aus.checked = true;
            document.ship.america.checked = true;
            document.ship.europe.checked = true;
            document.ship.africa.checked = true;
            document.ship.asia.checked = true;
        }
    }
    function pay_refresh()
    {
        payment = document.ship.payment.value;
        if (payment == "") {
            pay.innerHTML = "";
        }
        else if (payment == 1) {
            txt = "<input type=text name=payid value=<?php = $payid; ?>>";
            pay.innerHTML = "<font class=banner1><b>Paypal Id</b></font>" + txt;
        }
        else if (payment == 2) {
            txt = "<input type=text name=payid value=<?php = $payid; ?>>";
            pay.innerHTML = "<font class=banner1><b>INT-Gold Id</b></font> " + txt;
        }
        else if (payment == 3) {
            txt = "<input type=text name=payid value=<?php = $payid; ?>>";
            txtname = "<input type=text name=payname value=<?php = $payname; ?>>";
            pay.innerHTML = "<font class=banner1><b>E-Gold Id</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; " + txt + "<br><b>E-Gold name</b></font>  " + txtname;
        }
        else if (payment == 4) {
            txt = "<input type=text name=payid value=<?php = $payid; ?>>";
            pay.innerHTML = "<font class=banner1><b>Money Bookers Id</b></font> " + txt;
        }
        else if (payment == 5) {
            txt = "<input type=text name=payid value=<?php = $payid; ?>>";
            txtname = "<input type=text name=payname value=<?php = $payname; ?>>";
            pay.innerHTML = "<font class=banner1><b>E-Bullion Id</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; " + txt + "<br><b>E-Bullion name</b></font>  " + txtname;
        }
        else if (payment == 6) {
            txt = "<input type=text name=payid value=<?php = $payid; ?>>";
            pay.innerHTML = "<font class=banner1><b>Stormpay Id</b></font>" + txt;
        }
    }
</script>
<?php
require 'include/top.php';
require'templates/editshipdetail.tpl';
require 'include/footer.php';
?>
<script language="javascript">
    function selectall()
    {
        if (document.ship.world.checked == false)
        {
            document.ship.aus.checked = false;
            document.ship.america.checked = false;
            document.ship.europe.checked = false;
            document.ship.africa.checked = false;
            document.ship.asia.checked = false;
        }
        else
        {
            document.ship.aus.checked = true;
            document.ship.america.checked = true;
            document.ship.europe.checked = true;
            document.ship.africa.checked = true;
            document.ship.asia.checked = true;
        }
    }
    function pay_refresh()
    {
        payment = document.ship.payment.value;
        if (payment == "") {
            pay.innerHTML = "";
        }
        else if (payment == 1) {
            txt = "<input type=text name=payid value=<?php = $payid; ?>>";
            pay.innerHTML = "<b>Paypal Id</b>" + txt;
        }
        else if (payment == 2) {
            txt = "<input type=text name=payid value=<?php = $payid; ?>>";
            pay.innerHTML = "<b>INT-Gold Id</b> " + txt;
        }
        else if (payment == 3) {
            txt = "<input type=text name=payid value=<?php = $payid; ?>>";
            txtname = "<input type=text name=payname value=<?php = $payname; ?>>";
            pay.innerHTML = "<b>E-Gold Id</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; " + txt + "<br><b>E-Gold name</b>  " + txtname;
        }
        else if (payment == 4) {
            txt = "<input type=text name=payid value=<?php = $payid; ?>>";
            pay.innerHTML = "<b>Money Bookers Id</b> " + txt;
        }
        else if (payment == 5) {
            txt = "<input type=text name=payid value=<?php = $payid; ?>>";
            txtname = "<input type=text name=payname value=<?php = $payname; ?>>";
            pay.innerHTML = "<b>E-Bullion Id</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; " + txt + "<br><b>E-Bullion name</b>  " + txtname;
        }
        else if (payment == 6) {
            txt = "<input type=text name=payid value=<?php = $payid; ?>>";
            pay.innerHTML = "<b>Stormpay Id</b> " + txt;
        }
    }
</script>
