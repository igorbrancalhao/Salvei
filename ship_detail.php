<?php
/***************************************************************************
 *File Name				:ship_detail.php
 *File Created			:Wednesday, June 21, 2006
 * File Last Modified	:Wednesday, June 21, 2006
 * Copyright			:(C) 2001 AJ Square Inc
 * Email				:licence@ajsquare.net
 * Software Language	:PHP
 * Version Created		:V 4.3.2
 * Programmers worked	:S.Priya, B.ReenaKumari, K.Shanmuga priya
 * Modified By			:B.Reena
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
if(!isset($_SESSION['userid']))
{ 
$link="signin.php";
$url="sell.php";
echo '<meta http-equiv="refresh" content="0;url='.$link.'?url='.$url.'">';
//echo "You have been Re-Directed, if not please <a href=$link?$url>Click here</a>";
exit();
}
$sql_user_status="select status from user_registration where user_id=".$_SESSION['userid'];
$sqlqry_user_status=mysql_query($sql_user_status);
$sqlfetch_user_status=mysql_fetch_array($sqlqry_user_status);
$userstatus=$sqlfetch_user_status[0];
if($userstatus=='suspended')
{
echo '<meta http-equiv="refresh" content="0;url=suspendmode.php">';
exit();
}

if(empty($_SESSION['categoryid']))
{
$link="myauction.php";
echo '<meta http-equiv="refresh" content="0;url='.$link.'">';
//echo "You have been Re-Directed, if not please <a href=$link>Click here</a>";
exit();
}



require 'include/connect.php';
if($_GET['item_id'])
$_SESSION['item_id']=$_GET['item_id'];
if($_GET['mode'])
{
$mode=$_GET['mode'];
$_SESSION['mode']=$mode;
}
else if($_POST['mode'])
{
 $mode=$_POST['mode'];
 $_SESSION['mode']=$mode;
}
$mode=$_SESSION['mode'];
if($_SESSION['item_id'])
{
$item_id=$_SESSION['item_id'];
}
//$returns_accepted=1;
  $flag=$_POST['flag'];
  if($mode=="change")
  {
  $shipping_route=$_SESSION['shipping_route'];
  $shipping_amt=$_SESSION['shipping_amt'];
  $returns_accepted=$_SESSION['returns_accepted'];
  $refund_method=$_SESSION['refund_method'];
  $payment_instructions=$_SESSION['payment_instructions'];
  $returnpolicy_instructions=$_SESSION['returnpolicy_instructions'];
  $refund_days=$_SESSION['refund_days'];
  $tax=$_SESSION['tax'];
  }
  if($mode=="sellsimilar" and empty($flag))
  {
  $sql="select * from placing_item_bid where item_id=$item_id";
  $sqlqry=mysql_query($sql);
  $sqlfetch=mysql_fetch_array($sqlqry);
  $shipping_route=$sqlfetch['shipping_route']; 
  $shipping_amt=$sqlfetch['shipping_cost'];
  $returns_accepted=$sqlfetch['returns_accepted'];
  $refund_method=$sqlfetch['refund_method'];
  $payment_instructions=$sqlfetch['payment_instructions'];
  $returnpolicy_instructions=$sqlfetch['returnpolicy_instructions'];
  $refund_days=$sqlfetch['refund_days'];
  $tax=$sqlfetch['tax'];
  }
  
if($flag==1)
{
$world=$_POST['world'];
$payment=$_POST['payment'];
$shipping_amt=$_POST['txtship_amt'];
$tax=$_POST['tax'];
$returns_accepted=$_POST['chkreturns'];
$refund_method=$_POST['cborefund'];
$returnpolicy_instructions=$_POST['txtploicy'];
$payment_instructions=$_POST['txtpaymentins'];
$refund_days=$_POST['cboreturndays'];


if(empty($payment))
{
	$err_payment="Please enter the payment";
	$err_flag=1;
}
if(empty($_POST[payid]))
{
	$err_payid="Please enter the payment id";
	$err_flag=1;
}
if(!empty($returns_accepted))
{
	if(empty($refund_days))
	{
		$err_ref="Please enter the refund days";
		$err_flag=1;
	}
	if(empty($refund_method))
	{
		$err_method="Please enter the refund method";
		$err_flag=1;
	}
	
}
//shipping amount checking for special characters and to accept only numbers
$validZipExpr="^[0-9.]*$";
if(!empty($shipping_amt))
{
if(!eregi($validZipExpr,$shipping_amt))
		{
		$err_ship="Invalid shipping amount";
		$err_flag=1;
		}
		else if($shipping_amt=='0.00')
		{
		$err_ship="Invalid shipping amount";
		$err_flag=1;
		}
}

//tax checking to accept only numbers and not special characters
if(!empty($tax))
{
if(!eregi($validZipExpr,$tax))
		{
		$err_tax="Invalid tax amount";
		$err_flag=1;
		}
		else if($tax=='0.00')
		{
		$err_tax="Invalid tax amount";
		$err_flag=1;
		}
}


   $ship_sql="select * from shipping_location";
   $ship_res=mysql_query($ship_sql);
   $total1=mysql_num_rows($ship_res);
   $shipping_route=" ";
   
   for($s=0;$s<=$total1;$s++)
   {
   if($_REQUEST['ship'.$s])
   {
    
   $shipping_route.=$_REQUEST['ship'.$s];
   $shipping_route.=",";
   }
   }
  
  $shipping_route=rtrim($shipping_route,",");
  $_SESSION['shipping_route']=$shipping_route;

  if($err_flag!=1)
  {
  $_SESSION['shipping_route']=$shipping_route;
  $_SESSION['shipping_amt']=$shipping_amt;
  $_SESSION['tax']=$tax;
  $_SESSION['payid']=$_POST[payid];
  $_SESSION['payname']=$payment;
  $_SESSION['payment']=$_POST[payment];
  $_SESSION['returns_accepted']=$returns_accepted;
  $_SESSION['refund_method']=$refund_method;
  $_SESSION['payment_instructions']=$payment_instructions;
  $_SESSION['returnpolicy_instructions']=$returnpolicy_instructions;
  $_SESSION['refund_days']=$refund_days;
 

  echo '<meta http-equiv="refresh" content="0;url=preview.php">';
  echo "You have been Re-Directed, if not please <a href=preview.php>Click here</a>";
  exit();   
  //$sucess=1;  
  }
  }
   $Gallery=$_SESSION['Gallery'];
   $Border=$_SESSION['Border'];
   $Highlight=$_SESSION['Highlight'];
   $Bold=$_SESSION['Bold'];
   $Home=$_SESSION['Home'];
   $repost=$_SESSION['repost'];
   $Insertionfee=$_SESSION['Insertionfee'];
  
 
$title="Sell Your Item";
require 'include/top.php';
require'templates/ship_detail.tpl';
require 'include/footer.php';
?>

<script language="javascript">
function selectall()
{

if(document.ship.world.checked==false)
{
document.ship.aus.checked=false;
document.ship.america.checked=false;
document.ship.europe.checked=false;
document.ship.africa.checked=false;
document.ship.asia.checked=false;
}
else
{
document.ship.aus.checked=true;
document.ship.america.checked=true;
document.ship.europe.checked=true;
document.ship.africa.checked=true;
document.ship.asia.checked=true;
}
}
function pay_refresh()
{
	payment=document.ship.payment.value;
	if(payment=="") {
		pay.innerHTML="";
	}
	else if(payment==1){ 
		txt="<input type=text name=payid value=<?php=$payid;?>>";
		document.getElementById("pay").innerHTML="<font class=banner1 size=2><b>Paypal Id</b></font>"+txt;
		}
	else if(payment==2){ 
		txt="<input type=text name=payid value=<?php=$payid;?>>";
		document.getElementById("pay").innerHTML="<font class=banner1 size=2><b>INT-Gold Id</b></font> "+txt;
	}
	else if(payment==3){ 
		txt="<input type=text name=payid value=<?php=$payid;?>>";
		txtname="<input type=text name=payname value=<?php= $payname; ?>>";
		document.getElementById("pay").innerHTML="<font class=banner1 size=2><b>E-Gold Id</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "+txt+"<br><b>E-Gold name</b></font>"+txtname;
	}
	else if(payment==4){ 
		txt="<input type=text name=payid value=<?php=$payid;?>>";
		document.getElementById("pay").innerHTML="<font class=banner1 size=2><b>Money Bookers Id</b></font>"+txt;
	}
	else if(payment==5){ 
	txt="<input type=text name=payid value=<?php=$payid;?>>";
		txtname="<input type=text name=payname value=<?php= $payname; ?>>";
		document.getElementById("pay").innerHTML="<font class=banner1 size=2><b>E-Bullion Id</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "+txt+"<br><b>E-Bullion name</b></font>  "+txtname;
		}
    else if(payment==6){ 
		txt="<input type=text name=payid value=<?php=$payid;?>>";
		document.getElementById("pay").innerHTML="<font class=banner1 size=2><b>Stormpay Id</b></font>"+txt;
	}
}
</script>

