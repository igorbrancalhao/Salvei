<?php
/***************************************************************************
*File Name				:subcribe_to_store.tpl
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
<table width="962" cellpadding="5" cellspacing="0" align="center">
    <tr>
        <td colspan="4" background="images/item_bg.gif">
            <font size="3"><b><div align="left">&nbsp;&nbsp;Store Subscription</div></b></font></td>
    </tr>
    <tr><td valign="top">
            <table width="100%" align="center" cellpadding="5" cellspacing="0" border=0>
                <tr><td colspan="3" height=30>
                        <font size="3" class="detail6txt">
                        <b><div align="left">
                                &nbsp;&nbsp; Subscribe to Stores : Payment </div> </b></font> </td></tr>
                <tr align="center">
                    <td width=5>&nbsp;</td>
                    <td  align="center">
                        <table cellpadding="0" cellspacing="5"><tr class="detail9txt"><td>
                                    You are paying $&nbsp;<b><?php echo  $amount ?></b> for Create Your Store&nbsp; .</td></tr>
                            <tr class="detail9txt"><td>
                                    Send your payment to the Administrator.Click the any one of the payment gateway to start the payment process. 
                                </td></tr>
                            <tr class="detail9txt"><td align="center"><font color="red" size="2"><b>Note:</b>
                                    To ensure correct processing, please DO NOT close the window until your payment has been confirmed.</font> </td></tr>
                        </table>
                    </td>
                    <td width=2>&nbsp;</td>
                </tr></table></td></tr>
    <tr><td>&nbsp;</td></tr>	

    <tr>
        <td align="left">
            <?php

            /* --------- Payment Option Selected is E-Gold	--------------------
            ------------	E-Gold Payment Processings Starts Here ---------------
            */
            ?>
            <table border=0 align=center cellpadding=5 cellspacing=2 width=75% class="subtable">
                <tr><td align=center>
                        <form action="https://www.e-gold.com/sci_asp/payments.asp" method="post">
                            <input type=hidden name="PAYMENT_AMOUNT" value="<?php echo $amount; ?>">
                            <input type=hidden name="SUGGESTED_MEMO" value = "Memo">
                            <input type="hidden" name="PAYEE_ACCOUNT" value="<?php echo $egoldno; ?>">
                            <input type="hidden" name="PAYEE_NAME" value="<?php echo $egoldname;?>">
                            <input type=hidden name="PAYMENT_UNITS" value=1>
                            <input type=hidden name="PAYMENT_METAL_ID" value=1>
                            <input type="hidden" name="STATUS_URL" value="mailto:<?php echo $adminmail;?>">
                            <input type="hidden" name="NOPAYMENT_URL" value="<?php echo $yoursite;?>/failure.php">
                            <input type="hidden" name="NOPAYMENT_URL_METHOD" value="POST">
                            <input type="hidden" name="PAYMENT_URL" value="<?php echo $yoursite;?>/storesuccess.php?payid=3">
                            <input type="hidden" name="PAYMENT_URL_METHOD" value="POST">
                            <input type="hidden" name="BAGGAGE_FIELDS" value="PROGL">
                            <input type="hidden" name="PROGL" value="01">
                            <input type=image src="images/gold.gif" alt="Make payments with e-gold - it's fast, free and secure!">
                        </form>	
                    </td></tr>
            </table>
            <?php	

            /* ---------Payment Option Selected is Int-Gold	--------------------
            ------------	Int-Gold Payment Processings Starts Here---------------
            */
            ?>
            <table border=0 align=center cellpadding=5 cellspacing=2 width=75% class="subtable">
                <tr><td align=center>
                        <form action="https://intgold.com/cgi-bin/webshoppingcart.cgi" target=_blank method="POST">
                            <input type="hidden" name="cmd" value="_xclick">
                            <input type="hidden" name="SELLERACCOUNTID" value="<?php echo $intgoldno; ?>">
                            <input type="hidden" name="RETURNURL" value="<?php echo $yoursite;?>/storesuccess.php?payid=2">
                            <input type="hidden" name="CANCEL_RETURN" value="<?php echo $yoursite;?>/failure.php">
                            <input type="hidden" name="CUSTOM1" value="amount">
                            <input type="hidden" name="CUSTOM2" value="status">
                            <input type="hidden" name="ITEM_NUMBER" value="121">
                            <input type="hidden" name="ITEM_NAME" value="<?php echo $intgoldname?>">
                            <input type="hidden" name="METHOD" value="POST">
                            <input type="hidden" name="RETURNPAGE" value="HTML">
                            <input type="hidden" name="AMOUNT" value=<?php echo $amount; ?>>
                                   <input type="image" src="images/intgold_logo.gif" name="submit" alt="Make payments with IntGold - it's fast, free and secure!">
                        </form>
                    </td></tr>
            </table>
            <?php	

            /* ---------Payment Option Selected is Paypal	--------------------
            ------------	Paypal Payment Processings Starts Here---------------
            */
            ?>
            <table border=0 align=center cellpadding=5 cellspacing=2 width=75% class="subtable">

                <tr><td align=center>
                        <!--<form action="https://www.paypal.com/cgi-bin/webscr" method="post">-->
                        <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
                            <input type="hidden" name="cmd" value="_xclick">
                            <input type="hidden" name="business" value="<?php echo $paypalno?>">
                            <input type="hidden" name="item_name" value="Store Fee Payment">
                            <input type="hidden" name="amount" value="<?php echo $amount;?>">
                            <input type="hidden" name="no_note" value="1">
                            <input type="hidden" name="currency_code" value="<?php echo $currencycode_admin?>">
                            <input type="hidden" name="rm" value="2">
                            <input type="hidden" name="return" value="<?php echo $yoursite?>/storesuccess.php?payid=1">
                            <input type="hidden" name="cancel_return" value="<?php echo $yoursite?>/failure.php">
                            <center><br><input type="image" src="images/x-click-but6.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!"></center>
                        </form>
                    </td></tr>
            </table>
            <?php	

            /* ---------Payment Option Selected is Strompay	--------------------
            ------------	Strompay Payment Processings Starts Here---------------
            */
            ?>
            <table border=0 align=center cellpadding=5 cellspacing=2 width=75% class="subtable">

                <tr><td align=center>
                        <form method="post" action="https://www.stormpay.com/stormpay/handle_gen.php">
                            <input type="hidden" name="generic" value="1">
                            <input type="hidden" name="payee_email" value="<?php echo $stormpayno;?>">
                            <input type="hidden" name="product_name" value="<?php echo  $strsite;?>-Deposit">
                            <input type="hidden" name="user_id" value=1>
                            <input type="hidden" name="amount" value=<?php echo $amount; ?>>
                                   <input type="hidden" name="quantity" value="1">
                            <input type="hidden" name="require_IPN" value="1">
                            <input type="hidden" name="notify_URL" value="<?php echo $yoursite;?>/index.php ?> ">
                            <input type="hidden" name="return_URL" value="<?php echo $yoursite;?>/storesuccess.php?payid=6">
                            <input type="hidden" name="cancel_URL" value="<?php echo $yoursite;?>/failure.php ?> ">
                            <input type="hidden" name="subject_matter" value="CashCocktail Payment">
                            <input type=image src="images/BuyNowSP1.gif" value="Make payments with stormpay - it's fast, free and secure!">
                        </form>
                    </td></tr>
            </table>
            <?php	

            /* ---------Payment Option Selected is E-Bullion	--------------------
            ------------	E-Bullion Payment Processings Starts Here---------------
            */
            ?>
            <table border=0 align=center cellpadding=5 cellspacing=2 width=75% class="subtable">

                <tr><td align=center>
                        <!-- e-Bullion<sup>&reg;</sup> ATIP Implementation -->
                        <form name="atip" method="post" action="https://atip.e-bullion.com/process.php">
                            <input type="hidden" name="ATIP_STATUS_URL" value="<?php echo $yoursite;?>">
                            <input type="hidden" name="ATIP_STATUS_URL_METHOD" value="POST">
                            <input type="hidden" name="ATIP_BAGGAGE_FIELDS" value="">
                            <input type="hidden" name="ATIP_SUGGESTED_MEMO" value="">
                            <input type="hidden" name="ATIP_FORCED_PAYER_ACCOUNT" value="">
                            <input type="hidden" name="ATIP_PAYER_FEE_AMOUNT" value="">
                            <input type="hidden" name="ATIP_PAYMENT_URL" value="<?php echo $yoursite;?>/storesuccess.php?payid=5">
                            <input type="hidden" name="ATIP_PAYMENT_URL_METHOD" value="POST">
                            <input type="hidden" name="ATIP_NOPAYMENT_URL" value="<?php echo $yoursite;?>/failure.php">
                            <input type="hidden" name="ATIP_NOPAYMENT_URL_METHOD" value="POST">
                            <input type="hidden" name="ATIP_PAYMENT_FIXED" value="1">
                            <input type="hidden" name="ATIP_PAYEE_ACCOUNT" value="<?php echo $ebull_no?>">
                            <input type="hidden" name="ATIP_PAYEE_NAME" value="<?php echo $ebull_name?>">
                            <input type="hidden" name="ATIP_BUTTON" value="1">
                            <input type="hidden" name="ATIP_PAYMENT_AMOUNT" value="<?php echo $amount?>" size="10"><br></font></span>
                            <input type="hidden" name="ATIP_PAYMENT_UNIT" value="1">
                            <input type="hidden" name="ATIP_PAYMENT_METAL" value="1">
                            <tr><td align=center>
                            <input type="image" name="pay" src="images/ebullion_button_1.gif" value="Make payments with moneybookers - it's fast, free and secure!"></form>
                    </td></tr>
            </table>
            <?php	
            /* ---------Payment Option Selected is Money Bookers	--------------------
            ------------	Money Bookers Payment Processings Starts Here---------------
            */
            ?>
            <table border=0 align=center cellpadding=5 cellspacing=2 width=75% class="subtable">

                <tr><td align=center>

                        <form action="https://www.moneybookers.com/app/payment.pl" target="_blank">
                            <input type="hidden" name="pay_to_email" value="<?php echo $moneybooker?>">
                            <input type="hidden" name="return_url" value="<?php echo $yoursite?>/storesuccess.php?payid=4">
                            <input type="hidden" name="cancel_url" value="<?php echo $yoursite?>/failure.php ?>">
                            <input type="hidden" name="language" value="EN">
                            <input type="hidden" name="amount" value="<?php echo $amount?>">
                            <input type="hidden" name="currency" value="<?php echo $currencycode_admin?>">
                            <input type="image" src="images/money.jpg" value="Make payments with moneybookers - it's fast, free and secure!" name="Pay">
                        </form>
                    </td></tr>
            </table>


        </td></tr>

