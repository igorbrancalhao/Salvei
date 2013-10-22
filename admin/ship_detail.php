<?php
/***************************************************************************
 *File Name				:ship_detail.php
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
session_start();
/*
 file name:ship_detail.php;
 date	  :6.7.05
 Created by:priya
 Rights reserved by AJ Square inc
*/

$_SESSION[categoryid];
require 'include/connect.php';
if($_GET[item_id])
$_SESSION[item_id]=$_GET[item_id];
if($_GET[mode])
{
$mode=$_GET[mode];
$_SESSION[mode]=$mode;
}
else if($_POST[mode])
{
 $mode=$_POST[mode];
 $_SESSION[mode]=$mode;
}
$mode=$_SESSION[mode];
if($_SESSION[item_id])
{
$item_id=$_SESSION[item_id];
}
  $flag=$_POST[flag];
  if($mode=="change")
  {
  $shipping_route=$_SESSION[shipping_route];
  $shipping_amt=$_SESSION[shipping_amt];
  $returns_accepted=$_SESSION[returns_accepted];
  $refund_method=$_SESSION[refund_method];
  $payment_instructions=$_SESSION[payment_instructions];
  $returnpolicy_instructions=$_SESSION[returnpolicy_instructions];
  $refund_days=$_SESSION[refund_days];
  $tax=$_SESSION[tax];
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
$world=$_POST[world];
/* $payid=$_POST[payid];
$payname=$_POST[payname];
$payment=$_POST[payment]; */
$_SESSION[blockbuyercountries]=$_POST[blockbuyercountries];
$_SESSION[blockbuyerfeedbakscore]=$_POST[blockbuyerfeedbakscore];
$_SESSION[blockunpaidistrick]=$_POST[blockunpaidistrick];
$_SESSION[ItemLimit]=$_POST[ItemLimit];
$_SESSION[feedbackscore]=$_POST[feedbackscore];
$_SESSION[feedbackLimit]=$_POST[feedbackLimit];
$_SESSION[ItemLimitMinFeedback]=$_POST[ItemLimitMinFeedback];
$_SESSION[blockmerkatobid]=$_POST[blockmerkatobid];
$_SESSION[ItemLimitoption]=$_POST[ItemLimitoption];
$_SESSION[applytoalllistings]=$_POST[applytoalllistings];
if($_SESSION[blockbuyercountries] || $_SESSION[blockbuyerfeedbakscore] || $_SESSION[blockunpaidistrick] || $_SESSION[ItemLimit] ||$_SESSION[feedbackscore] || $_SESSION[feedbackLimit]  || $_SESSION[ItemLimitMinFeedback] || $_SESSION[blockmerkatobid] || $_SESSION[ItemLimitoption] || $_SESSION[applytoalllistings] )
{
$_SESSION[buyerrequirements]="yes";
}
$shipping_amt=$_POST[txtship_amt];
$tax=$_POST[tax];
$returns_accepted=$_POST[chkreturns];
$refund_method=$_POST[cborefund];
$returnpolicy_instructions=$_POST[txtploicy];
$payment_instructions=$_POST[txtpaymentins];
$refund_days=$_POST[cboreturndays];

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
  $_SESSION[shipping_route]=$shipping_route;

  if($err_flag!=1)
  {
  $_SESSION[shipping_route]=$shipping_route;
  $_SESSION[shipping_amt]=$shipping_amt;
  $_SESSION[tax]=$tax;
  $_SESSION[payid]=$_POST[payid];
  $_SESSION[payname]=$_POST[payname];
  $_SESSION[payment]=$_POST[payment];
  $_SESSION[returns_accepted]=$returns_accepted;
  $_SESSION[refund_method]=$refund_method;
  $_SESSION[payment_instructions]=$payment_instructions;
  $_SESSION[returnpolicy_instructions]=$returnpolicy_instructions;
  $_SESSION[refund_days]=$refund_days;
 
/*   if($_SESSION[total_setup_fee])
  {
    echo '<meta http-equiv="refresh" content="0;url=preview.php">';
	exit(); 
  } */
  echo '<meta http-equiv="refresh" content="0;url=preview.php">';
  echo "You have been Re-Directed, if not please <a href=preview.php>Click here</a>";
  exit();   
  //$sucess=1;  
  }
  }
   $Gallery=$_SESSION[Gallery];
   $Border=$_SESSION[Border];
   $Highlight=$_SESSION[Highlight];
   $Bold=$_SESSION[Bold];
   $Home=$_SESSION[Home];
   $repost=$_SESSION[repost];
   $Insertionfee=$_SESSION[Insertionfee];
  
 ?>
<link href="<?php= $ret1; ?>" rel="stylesheet" type="text/css">
<?php require'templates/ship_detail.tpl';?>
</table>
<tr><td align="center"><?php require 'include/footer.php'?></td></tr>
</body>
</html>
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
		pay.innerHTML="<b>Paypal Id</b>"+txt;
	}
	else if(payment==2){ 
		txt="<input type=text name=payid value=<?php=$payid;?>>";
		pay.innerHTML="<b>INT-Gold Id</b> "+txt;
	}
	else if(payment==3){ 
		txt="<input type=text name=payid value=<?php=$payid;?>>";
		txtname="<input type=text name=payname value=<?php= $payname; ?>>";
		pay.innerHTML="<b>E-Gold Id</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "+txt+"<br><b>E-Gold name</b>  "+txtname;
	}
	else if(payment==4){ 
		txt="<input type=text name=payid value=<?php=$payid;?>>";
		pay.innerHTML="<b>Money Bookers Id</b> "+txt;
	}
	else if(payment==5){ 
	txt="<input type=text name=payid value=<?php=$payid;?>>";
		txtname="<input type=text name=payname value=<?php= $payname; ?>>";
		pay.innerHTML="<b>E-Bullion Id</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "+txt+"<br><b>E-Bullion name</b>  "+txtname;
		}
    else if(payment==6){ 
		txt="<input type=text name=payid value=<?php=$payid;?>>";
		pay.innerHTML="<b>Stormpay Id</b> "+txt;
	}
	else if(payment==14){ 
		txt="<input type=text name=payid value=<?php=$payid;?>>";
		pay.innerHTML="<b>Credit Card Number</b> "+txt;
	}
	else if(payment==15){ 
	txt="<input type=text name=payid value=<?php=$payid;?>>";
		txtname="<input type=text name=payname value=<?php= $payname; ?>>";
		pay.innerHTML="<b>Netbilling Account Id</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "+txt+"<br><b>NetBilling Card Number</b>  "+txtname;
		}
}
</script>
