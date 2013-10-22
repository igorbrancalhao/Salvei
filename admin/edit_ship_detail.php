<?php
/***************************************************************************
 *File Name				:edit_ship_detail.php
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
<?php session_start();
error_reporting(0);
require 'include/connect.php';
require 'include/top.php';
/*
 file name:ship_detail.php;
 date	  :6.7.05
 Created by:priya
 Rights reserved by AJ Square inc
*/
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
 <table width="100%" cellpadding="5" cellspacing="0" align="center" border="0">
<?php
if(!empty($_GET[item_id]))
{
$item_id=$_GET[item_id];
$_SESSION[item_id]=$item_id;
}
else
{
$item_id=$_SESSION[item_id];
}
$sql="select * from placing_item_bid where item_id=$item_id";
$res=mysql_query($sql);
$row=mysql_fetch_array($res);
$flag=$_POST[flag];
if($flag==1)
{
$world=$_POST[world];

$payid=$_POST[payid];
$payname=$_POST[payname];
$payment=$_POST[payment];
$shipping_amt=$_POST[txtship_amt];
$tax=$_POST[tax];

if($world=="world")
{
$shipping_route="Asia Africa Australia Americanada Europe";
}
else
{
$aus=$_POST[aus];
$asia=$_POST[asia];
$america=$_POST[america];
$europe=$_POST[europe];
$africa=$_POST[africa];
$shipping_route="";
 if($aus=="aus")
  $shipping_route.="Australia ";
  if($asia=="asia")
 $shipping_route.="Asia ";
  if($america=="america")
 $shipping_route.="Americanada ";
  if($europe=="europe")
 $shipping_route.="Europe ";
  if($africa=="africa")
 $shipping_route.="Africa";
}

  if($err_flag!=1)
  {
    $bid_start=$row['bid_starting_date'];
	$start=$row['start_delay'];
    $bidding_start_date = AddDays($bid_start,$start); 
   
   
   //$bidding_start_date = $row['bid_starting_date'];
   $interval = $row['duration'];
   $expire_date = AddDays($bidding_start_date,$interval); 
   
     
   // insert to table
   $userid=$_SESSION[userid];   
   $cat_id=$_SESSION[categoryid];
//   $category_id=$_SESSION[categoryid];
   
   
   $item_title=$_SESSION[item_name];
   $qty=$_SESSION[qty];
   $itemdes=$_SESSION[des];
   $currency=$_SESSION[currency];
   $sell_method=$_SESSION[sell_method];
   $min_amt=$_SESSION[min_amt];  
   $bid_inc=$_SESSION[bid_inc];
   $dur=$_SESSION[dur];
   $rev_price=$_SESSION[rev_price];
   // $bid_starting_date=$_SESSION[bid_start];
   $quick=$_SESSION[quick_price];	  
   $size_of_qty=$_SESSION[size_of_qty];
   $start_delay=$_SESSION[start_delay];
   $img1=$_SESSION[image1];
   $img2=$_SESSION[image2];
   $img3=$_SESSION[image3];
   $img4=$_SESSION[image4];
   $img5=$_SESSION[image5];
   //$shipping_route=$_SESSION[shipping_route];
   //$shipping_amt=$_SESSION[shipping_amt];
   //$tax=$_SESSION[tax];
   //payment
   
   //$payment=$_SESSION[payment];
   //$payname=$_SESSION[payname];
   //$payid=$_SESSION[payid];
   $repost=$_SESSION[repost];
   //if($_SESSION[mode]!="repost" or $_SESSION[mode]="relist")
   {
   //$bidding_start_date=date("Y-m-d G:i:s");
   $bidding_start_date=date("Y-m-d");
   $bidding_start_date = AddDays($bidding_start_date,$start_delay); 
   $interval =$dur +$start_delay;
   $expire_date = AddDays($bidding_start_date,$interval); 
   $sql="insert into placing_item_bid(user_id,category_id,item_title,quantity,detailed_descrip, currency ,selling_method,min_bid_amount,bid_increment,duration,reserve_price,quick_buy_price,bid_starting_date,picture1,picture2,picture3,picture4,picture5,size_of_quantity,start_delay,expire_date,shipping_route,shipping_cost,status,tax,payment_gateway,payment_name,payment_id,no_of_repost)";
   $sql.="values('$userid','$cat_id','$item_title',$qty,'$itemdes','$currency','$sell_method','$min_amt','$bid_inc','$dur','$rev_price','$quick','$bidding_start_date','$img1','$img2','$img3','$img4','$img5','$size_of_qty',$start_delay,'$expire_date','$shipping_route','$shipping_amt','Active','$tax','$payment','$payname','$payid','$repost')"; 
   $res=mysql_query($sql);  
   }
// insert end




   
   
   
   
   
   
   
   
   
   $up="update placing_item_bid set expire_date='$expire_date',bid_starting_date='$bidding_start_date',shipping_route='$shipping_route',";
    $up.="shipping_cost='$shipping_amt',tax='$tax',payment_gateway='$payment',payment_name='$payname',payment_id='$payid', where item_id=".$item_id;  
  $up1=mysql_query($up);
   $item_sql="select * from placing_item_bid where item_id=$item_id";	
   $item_res=mysql_query($item_sql);
   $item_row=mysql_fetch_array($item_res);
  /* echo '<meta http-equiv="refresh" content="0;url=review.php?item_id='.$item_id.'">';
   echo "You have been Re-Directed, if not please <a href=review.php?item_id=$item_id>Click here</a>";
   exit();   */
   $sucess=1;  
	  }
  }
 ?>
 <body>
<?php 
 if($sucess==1)
{
?>
<tr ><td align="center">
<br>
<br>
<br>
<font size="2" color="red"><b>You have successfully listed your item.</b></font>
<br>
<br>
<br>
 </td></tr>
 </table>
 <?php
 require 'include/footer.php';
 exit();
 }
 ?>
<!-- <tr align="center"><td align="center"><a href="pay.php">Pay Now</a></td></tr> -->

<tr>
<td>

<?php if($err_flag==1)
{ 
?>
<table width="100%" align="center"><tr><td>
<img src="images/warning_39x35.gif"></td>
<td><font size=2 color="red">The following must be corrected before continuing:</font></td>

<?php if(!empty($err_route))
 {
 ?>
<tr><td>&nbsp;</td>
<td><a href="ship_detail.php#world">Shipping Location</a> - <?php= $err_route; ?></td></tr>
<?php 
}
?>
<?php if(!empty($err_amt))
 {
 ?>
<tr><td>&nbsp;</td>
<td><a href="ship_detail.php#txtship_amt">Shipping Amount</a> - <?php= $err_amt; ?></td></tr>
 <?php 
 }
 ?>

</table>
<?php 
}
?>
</td></tr>

<tr><td>
<form name="ship" method="post" action="ship_detail.php">
<table width="100%" cellpadding="5" cellspacing="2" border="0">
<tr><td><font size=2><b>Title:</b></font>&nbsp;&nbsp;<?php= $row[item_title]; ?></td></tr>

<tr class="tr_border"><td><font size="2"><b>Payment</b></font></td></tr>
<tr><td align="center"><font size="2"><b>Payment Method</b></font>
<?php
$pay_sql="select * from payment_gateway where status='Yes'";
$pay_res=mysql_query($pay_sql);
?><select name="payment" onChange="pay_refresh()">
<option value="">Select</option>
<?php
while($pay_row=mysql_fetch_array($pay_res))
{
if($pay_row[gateway_id]==$payment)
{
?>
<option value="<?php=$pay_row['gateway_id'];?>" selected><?php=$pay_row[payment_gateway];?></option>
<?php
}
else
{
?>
<option value="<?php=$pay_row['gateway_id'];?>"><?php=$pay_row[payment_gateway];?></option>
<?php
}
}
?>
</select>
</td>
</tr>
<tr><td align="center"><div id="pay"></div></td></tr> 




<tr class="tr_border"><td>
 <?php if(!empty($err_ship_loc))
 {?>
 <img src="images/warning_9x10.gif">&nbsp;<font size=2 color=red><?php= $err_ship_loc ?></font>
 <br>
 <b><font size=2 color=red>Shipping Location</font></b>
 <?php
  }
  else
  {
 ?>
   <b><font size=2>Shipping Location</font></b>
   <?php
   }
   ?>
  </td>
</tr>
<tr><td>
<table align="center" width="250" cellpadding="5" cellspacing="2">
<tr><td>

<?php if($world=="all")
{
?>
<input type="checkbox" name=world value="all" onClick="selectall()" checked>Worldwide</td>
<?php
}
else
{
?>
<input type="checkbox" name=world value="all" onClick="selectall()">Worldwide</td>
<?php
}
if($asia=="asia")
{
?>
<td><input type="checkbox" name=asia value="asia" checked>Asia</td>
<?php
}
else
{
?>
<td><input type="checkbox" name=asia value="asia">Asia</td>
<?php
}
if($aus=="aus")
{
?>
<td><input type="checkbox" name=aus value="aus" checked>Australia</td></tr>
<?php
}
else
{
?>
<td><input type="checkbox" name=aus value="aus">Australia</td></tr>
<?php
}
if($america=="america")
{
?>
<tr><td><input type="checkbox" name=america value="america" checked>America/Canada</td>
<?php
}
else
{
?>
<tr><td><input type="checkbox" name=america value="america">America/Canada</td>
<?php
}
if($africa=="africa")
{
?>
<td><input type="checkbox" name=africa value="africa" checked>Africa</td>
<?php
}
else
{
?>
<td><input type="checkbox" name=africa value="africa">Africa</td>
<?php
}
if($europe=="europe")
{
?>
<td><input type="checkbox" name=europe value="europe" checked>Europe</td></tr>
<?php
}
else
{
?>
<td><input type="checkbox" name=europe value="europe">Europe</td></tr>
<?php
}
?>
</table>

<tr class="tr_border"><td><font size="2"><b>Shipping Cost</b></font></td></tr>
<tr><td align="center">
<?php if(!empty($err_amt))
 {?>
 <img src="images/warning_9x10.gif">&nbsp;<font size=2 color=red><?php= $err_amt ?></font>
 <br>
 <b><font size=2 color=red>Shipping Amount</font></b>
 <?php
  }
  else
  {
 ?>
   <b><font size=2>Shipping Amount</font></b>
   <?php
   }
   ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="text" name=txtship_amt class="txtsmall" value=<?php= $shipping_amt;?>></td></tr>

<tr class="tr_border">
          <td><font size="2"><b>Sales Tax </b></font></td>
        </tr>
<tr>
          <td align="center"> <font size="2"><b>Tax Amouunt</b></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
            <input type="text" name=tax class="txtsmall" value=<?php= $tax; ?>> <b> % </b> 
</td>
</tr>

  <br>
<input type="hidden" name=flag value=1>
<tr><td align="center">
<input type="submit" name=submit value="submit" class="buttonsearch"></td></tr>
</table>
</form>
</td></tr>
</table>
<?php require 'include/footer.php'?>
</table>
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
}



</script>
