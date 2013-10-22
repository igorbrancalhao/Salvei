<?php
/***************************************************************************
 *File Name				:reviewdetails.tpl
 *File Created			:Wednesday, June 21, 2006
 * File Last Modified	:Wednesday, June 21, 2006
 * Copyright			:(C) 2001 AJ Square Inc
 * Email				:licence@ajsquare.net
 * Software Language	:PHP
 * Version Created		:V 4.3.2
 * Programmers worked	:S.Priya, B.ReenaKumari, K.Shanmuga priya
 * Modified By			:B.Reena
 * $Id                  : memberlist.php,v 1.36.2.12 2006/02/07 20:42:51 grahamje Exp $
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
<table width="958" cellpadding="0" cellspacing="0" border=0 align="center">
<tr width=100>
<td colspan=2 background="images/contentbg1.jpg" height="25">
<font class="detail3txt"><div align="left">
&nbsp;&nbsp;Review Your Purchase <?php= $buyer_det_fetch[user_name] ?> </div></font></td></tr>
<tr><td colspan="2" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom"  background="images/contentgrad.jpg"> 
 <table cellpadding="5" cellspacing="2"  width=100%><tr><td class="categories_fonttype">
	You are paying for&nbsp;<?php= $bid_det[quantity] ?> <?php if($bid_det[quantity]==1) { echo "item"; } else  {echo "items";} ?>&nbsp;total <?php=$row[currency]?><?php= $totalprice?> for <?php= $seller_name ?>.</td></tr>
	<tr><td class="categories_fonttype">
    To continue payment for <?php= $seller_name ?>, click the Continue button at the bottom of the page. 
	</td></tr>
   	<tr><td>&nbsp;</td></tr>	
	<tr><td height=25 class="detail9txt">
<div align="left">
&nbsp;&nbsp; Review Shipping Address </div>  </td></tr>
<tr><td>
<table cellpadding="2" cellspacing="2"  align="left" class="banner1">
<tr><td >
<b>Seller should ship to: &nbsp;</b>
</td>
<td align=left><b>
<?php=  $buyer_det_fetch[user_name]; ?>
</b></td>
</tr>
<tr>
<td>&nbsp;
</td>
<td><?php=  $buyer_det_fetch[address]; ?>,</td></tr>
<tr>
<td>&nbsp;
</td>
<td><?php=  $buyer_det_fetch[city]; ?>,</td></tr>
<?php
$country_name_sql="select * from country_master where country_id=".$buyer_det_fetch[country];
$country_name_sqlqry=mysql_query($country_name_sql);
$country_name_fetch=mysql_fetch_array($country_name_sqlqry);
?>
<tr>
<td>&nbsp;
</td>
<td><?php=  $country_name_fetch[country]; ?>,</td></tr>
<tr><td>&nbsp;
</td><td><?php=$buyer_det_fetch[pin_code]?></td></tr>
<tr>
<td>&nbsp;
</td>
<td>Phone No:<?php=  $buyer_det_fetch[home_phone]; ?>,<?php=  $buyer_det_fetch[work_phone]; ?>.</td></tr>
</table>
</td></tr>
<tr><td height=25 class="detail9txt">
<div align="left">
&nbsp;&nbsp; Review Payment Details</div>  </td></tr>
<tr><td><br /></td></tr>
<tr><td>
<table cellpadding="5" cellspacing="0" class="banner1">
<tr><td >
&nbsp;&nbsp;<b>Seller&nbsp;:&nbsp;<?php= $seller_name ?>&nbsp;</b>
</td>
<td>&nbsp;</td>
</tr>
<tr><td colspan="2" width=750>
<table cellpadding="5" cellspacing="2" width="30%">
<tr><td><b>Item Title:</b></td>
<td><a href="detail.php?item_id=<?php= $row[item_id]?>" class="header_text"><?php= $row[item_title] ?></a></td>
</tr>
<tr><td><b>Quantity:</b></td>
<td><?php= $bid_det[quantity] ?></td>
</tr>
<tr><td><b>Sale Price:</b></td>
<td><?php= $row[currency] ?><?php= $row[sale_price] ?></td>
</tr>
<tr><td><b>Shipping Amount:</b></td>
<td><?php= $row[currency] ?><?php= $row[shipping_cost] ?></td>
</tr>
<tr><td><b>Tax:</b></td>
<td><?php= $row[tax] ?>&nbsp;%</td>
</tr>
<tr><td><b>Total Price:</b></td>
<td>
<?php
$pricing=$pricing + $shipping + $tax;
$pricing=number_format($pricing,2,'.','');
?>
<?php= $row[currency] ?><?php=$pricing?></td>
</tr>
<?php $_SESSION['totalprice']=$pricing;?>
</table>
</td></tr>
</table></td></tr>
</td></tr>
<tr>
<td align="left">
<?php
if($payid==3)
{
						/* --------- Payment Option Selected is E-Gold	--------------------
						------------	E-Gold Payment Processings Starts Here ---------------
						*/
	$egoldname=$row[payment_name];
	$egoldno=$row[payment_id];

						
						
?>
					
					
					<tr><td align=center>
					<form action="https://www.e-gold.com/sci_asp/payments.asp" method=post>
					<input type=hidden name="PAYMENT_AMOUNT" value=<?php echo $pricing; ?>>
					<input type=hidden name="SUGGESTED_MEMO" value = "Memo">
					<input type="hidden" name="PAYEE_ACCOUNT" value=<?php echo $egoldno; ?>>
					<input type="hidden" name="PAYEE_NAME" value="<?php=$egoldname;?>">
					<input type=hidden name="PAYMENT_UNITS" value=1>
					<input type=hidden name="PAYMENT_METAL_ID" value=1>
					<input type="hidden" name="STATUS_URL" value="mailto:<?php=$seller_email;?>">
					<input type="hidden" name="NOPAYMENT_URL" value="<?php=$yoursite;?>/sell_cancel.php">
					<input type="hidden" name="NOPAYMENT_URL_METHOD" value="POST">
					<input type="hidden" name="PAYMENT_URL" value="<?php=$yoursite;?>/paysucess.php">
					<input type="hidden" name="PAYMENT_URL_METHOD" value="POST">
					<input type="hidden" name="BAGGAGE_FIELDS" value="PROGL">
					<input type="hidden" name="PROGL" value="01">
					<input type=image src="images/gold.gif" alt="Make payments with e-gold - it's fast, free and secure!">
					</form>	
					</td></tr>
					
<?php	
			}
			if($payid==2)
			{
				
			$intgoldname=$row[payment_name];
	        $intgoldno=$row[payment_id];
	
				
				
					/* ---------Payment Option Selected is Int-Gold	--------------------
					------------	Int-Gold Payment Processings Starts Here---------------
					*/
?>
					
										<tr><td align=center>
					<form action="https://intgold.com/cgi-bin/webshoppingcart.cgi" target=_blank method="POST">
					<input type="hidden" name="cmd" value="_xclick">
					<input type="hidden" name="SELLERACCOUNTID" value="<?php echo $intgoldno; ?>">
					<input type="hidden" name="RETURNURL" value="<?php=$yoursite;?>/paysucess.php">
					<input type="hidden" name="CANCEL_RETURN" value="<?php=$yoursite;?>/sell_cancel.php">
					<input type="hidden" name="CUSTOM1" value="amount">
					<input type="hidden" name="CUSTOM2" value="status">
					<input type="hidden" name="ITEM_NUMBER" value="121">
					<input type="hidden" name="ITEM_NAME" value="<?php=$intgoldname?>">
					<input type="hidden" name="METHOD" value="POST">
					<input type="hidden" name="RETURNPAGE" value="HTML">
					<input type="hidden" name="AMOUNT" value=<?php echo $pricing; ?>>
					<input type="image" src="images/intgold_logo.gif" name="submit" alt="Make payments with IntGold - it's fast, free and secure!">
					</form>
					</td></tr>
					
<?php	
			}
			if($payid==1)
			{
			$paypalno=$row[payment_id];
			
					/* ---------Payment Option Selected is Paypal	--------------------
					------------	Paypal Payment Processings Starts Here---------------
					*/
?>
					
					
					<tr><td align=center>
			<!--<form action="https://www.paypal.com/cgi-bin/webscr" method="post">-->
				<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
				<input type="hidden" name="cmd" value="_xclick">
				<input type="hidden" name="business" value="<?php echo $paypalno?>">
				<input type="hidden" name="item_name" value="Item Name(<?php=$row[item_title]?>)">
				<input type="hidden" name="shipping" value="">
				<input type="hidden" name="tax_X" value="">
				<input type="hidden" name="amount" value="<?php echo $pricing;?>">
				<input type="hidden" name="no_note" value="1">
				<input type="hidden" name="currency_code" value="<?php= $cur_code ?>">
				<input type="hidden" name="rm" value="2">
				<input type="hidden" name="return" value="<?php=$yoursite?>/paysucess.php?status=yes">
				<input type="hidden" name="cancel_return" value="<?php=$yoursite?>/sell_cancel.php?status=no"><br />
			<center><br><input type="image" src="images/x-click-but6.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!"></center>
					</form>
				
					</td></tr>
					
<?php	
			}
			if($payid==6)
			{
			$stormpayno=$row[payment_id];
			
					/* ---------Payment Option Selected is Strompay	--------------------
					------------	Strompay Payment Processings Starts Here---------------
					*/
?>
										
					<tr><td align=center>
					<form method="post" action="https://www.stormpay.com/stormpay/handle_gen.php">
					<input type="hidden" name="generic" value="1">
					<input type="hidden" name="payee_email" value=<?php echo $stormpayno;?> >
					<!-- <input type="hidden" name="product_name" value="<?php= $strsite;?>-Deposit"> -->
					<input type="hidden" name="user_id" value=1>
					<input type="hidden" name="amount" value=<?php echo $pricing; ?>>
					<input type="hidden" name="quantity" value="1">
					<input type="hidden" name="require_IPN" value="1">
					<input type="hidden" name="notify_URL" value="<?php=$yoursite;?>/index.php">
					<input type="hidden" name="return_URL" value="<?php=$yoursite;?>/paysucess.php">
					<input type="hidden" name="cancel_URL" value="<?php=$yoursite;?>/sell_cancel.php">
					<input type="hidden" name="subject_matter" value="CashCocktail Payment">
					<input type=image src="images/BuyNowSP1.gif" value="Make payments with stormpay - it's fast, free and secure!">
					</form>
					</td></tr>
				
<?php	
			}
			if($payid==5)
			{
			$ebull_name=$row[payment_name];
	        $ebull_no=$row[payment_id];
			
					/* ---------Payment Option Selected is E-Bullion	--------------------
					------------	E-Bullion Payment Processings Starts Here---------------
					*/
?>
										
					<tr><td align=center>
					<!-- e-Bullion<sup>&reg;</sup> ATIP Implementation -->
					<form name="atip" method="post" action="https://atip.e-bullion.com/process.php">
					<input type="hidden" name="ATIP_STATUS_URL" value="<?php=$yoursite;?>">
					<input type="hidden" name="ATIP_STATUS_URL_METHOD" value="POST">
					<input type="hidden" name="ATIP_BAGGAGE_FIELDS" value="">
					<input type="hidden" name="ATIP_SUGGESTED_MEMO" value="">
					<input type="hidden" name="ATIP_FORCED_PAYER_ACCOUNT" value="">
					<input type="hidden" name="ATIP_PAYER_FEE_AMOUNT" value="">
					<input type="hidden" name="ATIP_PAYMENT_URL" value="<?php=$yoursite;?>/paysucess.php">
					<input type="hidden" name="ATIP_PAYMENT_URL_METHOD" value="POST">
					<input type="hidden" name="ATIP_NOPAYMENT_URL" value="<?php=$yoursite;?>/sell_cancel.php">
					<input type="hidden" name="ATIP_NOPAYMENT_URL_METHOD" value="POST">
					<input type="hidden" name="ATIP_PAYMENT_FIXED" value="1">
					<input type="hidden" name="ATIP_PAYEE_ACCOUNT" value="<?php=$ebull_no?>">
					<input type="hidden" name="ATIP_PAYEE_NAME" value="<?php=$ebull_name?>">
					<input type="hidden" name="ATIP_BUTTON" value="1">
					<input type="hidden" name="ATIP_PAYMENT_AMOUNT" value="<?php=$pricing?>" size="10"><br></font></span>
					<input type="hidden" name="ATIP_PAYMENT_UNIT" value="1">
					<input type="hidden" name="ATIP_PAYMENT_METAL" value="1">
					<tr><td align=center>
					<input type="image" name="pay" src="images/ebullion_button_1.gif" value="Make payments with moneybookers - it's fast, free and secure!"></form>
					</td></tr>
				<?php	
			}
			if($payid==4)
			{
			$moneybooker=$row[payment_id];
			
					/* ---------Payment Option Selected is Money Bookers	--------------------
					------------	Money Bookers Payment Processings Starts Here---------------
					*/
?>
								
					<tr><td align=center>
					
					<form action="https://www.moneybookers.com/app/payment.pl" target="_blank">
					<input type="hidden" name="pay_to_email" value="<?php=$moneybooker?>">
					<input type="hidden" name="return_url" value="<?php=$yoursite?>/paysucess.php">
					<input type="hidden" name="cancel_url" value="<?php=$yoursite?>/sell_cancel.php">
					<input type="hidden" name="language" value="EN">
					<input type="hidden" name="amount" value="<?php=$pricing?>">
					<input type="hidden" name="currency" value="<?php= $cur_code ?>">
		<input type="image" src="images/money.jpg" value="Make payments with moneybookers - it's fast, free and secure!" name="Pay">
					</form>
					</td></tr>
				<?php	
			}	

?>

</td></tr>
</table>
</td></tr>
</table>
