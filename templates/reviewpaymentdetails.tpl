<?php
/***************************************************************************
*File Name				:reviewpaymentdetails.tpl
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
        <td colspan=3 background="images/contentbg1.jpg" height="25">
            <font class="detail3txt"><div align="left">
                &nbsp;&nbsp; Review Your Payment Details For Listing Item <?php= $item_title ?>( # <?php= $item_id ?> )</div></font></td></tr>



    <tr><td colspan="2" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom"  background="images/contentgrad.jpg"> 
            <table cellpadding="5" cellspacing="2"  width=100%> 

                <tr><td class="categories_fonttype">To continue payment for <?php= $item_title ?>, select the Payment method at the bottom of the page. </td></tr>
                <tr><td><table width="100%" cellpadding="5" cellspacing="0" border=0 align="center">
                            <tr><td>&nbsp;</td></tr>	
                            <tr><td><table width="100%" cellpadding="5" cellspacing="0" border=0 align="center">
                                        <tr><td height=25 >
                                                <font size="2">
                                                <b><div align="left" class="detail9txt">
                                                        &nbsp;&nbsp; Review Payment Details</div> </b></font> </td></tr>
                                        <tr><td><br /></td></tr>
                                        <tr><td align="center" colspan="3">
                                                <table cellpadding="5" cellspacing="2" width=50% >
                                                    <?php 
                                                    if($fee_row[Insertion_fee])
                                                    {
                                                    ?>
                                                    <tr bgclor=#eeeeee><td align="right"  class="categories_fonttype"><b>Insertion Fee:</b></td><td align="left" class="banner1"><?php= $fee_row[Insertion_fee] ?>&nbsp;<?php= $default_cur_code ?></td>
                                                    </tr>
                                                    <?php
                                                    }
                                                    if($fee_row[classifedad_fee])
                                                    {
                                                    ?>
                                                    <tr bgclor=#eeeeee><td align="right"  class="categories_fonttype"><b>Insertion Fee:</b></td><td align="left" class="banner1"><?php= $fee_row[classifedad_fee] ?>&nbsp;<?php= $default_cur_code ?></td>
                                                    </tr>
                                                    <?php
                                                    }
                                                    if($fee_row[reserve_price_fee])
                                                    {
                                                    ?>
                                                    <tr bgclor=#eeeeee><td align="right"  class="categories_fonttype"><b>Reserve Price Fee</b></td><td align="left" class="banner1"><?php= $fee_row[reserve_price_fee] ?>&nbsp;<?php= $default_cur_code ?></td>
                                                    </tr>
                                                    <?php
                                                    }
                                                    if($fee_row[gallery_fee])
                                                    {
                                                    ?>
                                                    <tr bgclor=#eeeeee><td align="right"  class="categories_fonttype"><b>Gallery Item Fee:</b></td><td align="left" class="banner1"><?php= $fee_row[gallery_fee] ?>&nbsp;<?php= $default_cur_code ?></td>
                                                    </tr>
                                                    <?php
                                                    }
                                                    if($fee_row[boldlisting_fee])
                                                    {

                                                    ?>
                                                    <tr bgclor=white><td align="right"  class="categories_fonttype"><b>Bold Item Fee:</b></td><td align="left" class="banner1"><?php= $fee_row[boldlisting_fee] ?>&nbsp;<?php= $default_cur_code ?> </td>
                                                    </tr>
                                                    <?php
                                                    }
                                                    if($fee_row[highlighted_fee])
                                                    {

                                                    ?>
                                                    <tr bgclor=#eeeeee><td align="right"  class="categories_fonttype"><b>Highlight Item Fee:</b></td><td align="left" class="banner1"><?php= $fee_row[highlighted_fee] ?>&nbsp;<?php= $default_cur_code ?> </td>
                                                    </tr>
                                                    <?php
                                                    }
                                                    if($fee_row[subtitlefee])
                                                    {

                                                    ?>
                                                    <tr bgclor=white><td align="right"  class="categories_fonttype"><b>Subtitle Item Fee:</b></td>
                                                        <td align="left" class="banner1"><?php=$fee_row[subtitlefee] ?>&nbsp;<?php= $default_cur_code ?> </td>
                                                    </tr>
                                                    <?php
                                                    }
                                                    if($fee_row[homepage_featureditem_fee])
                                                    {
                                                    ?>
                                                    <tr bgclor=#eeeeee><td align="right"  class="categories_fonttype"><b>Homepage Featured Item Fee:</b></td><td align="left" class="banner1"><?php= $fee_row[homepage_featureditem_fee] ?>&nbsp;<?php= $default_cur_code ?></td>
                                                    </tr>
                                                    <?php
                                                    }
                                                    if($fee_row[addtional_pic_fee])
                                                    {
                                                    ?>
                                                    <tr bgclor=white><td align="right"  class="categories_fonttype"><b>Additional Pictures Fees:</b></td><td align="left" class="banner1"><?php= $fee_row[addtional_pic_fee] ?>&nbsp;<?php= $default_cur_code ?> </td>
                                                    </tr>
                                                    <?php
                                                    }
                                                    if($fee_row[listing_desinger_fee])
                                                    {

                                                    ?>
                                                    <tr bgclor=#eeeeee><td align="right" class="categories_fonttype"><b>Listing Designer Fee:</b></td><td align="left" class="banner1"><?php= $fee_row[listing_desinger_fee] ?>&nbsp;<?php= $default_cur_code ?> </td>
                                                    </tr>
                                                    <?php
                                                    }
                                                    $_SESSION[total_setup_fee]=$total_setup_fee;
                                                    $total_setup_fee=number_format($total_setup_fee,2);
                                                    ?>
                                                    <tr><td colspan="2"><hr /></td></tr>
                                                    <tr bgclor=white><td align="right" class="categories_fonttype"><b>Total Setup Fees:</b></td><td align="left" class="banner1"><?php= $total_setup_fee ?>&nbsp;<?php= $default_cur_code ?></td>
                                                    </tr>
                                                    <tr><td colspan="2"><hr /></td></tr>
                                                </table>
                                        <tr><td><font size="2">
                                                <b><div align="left" class="detail9txt">
                                                        &nbsp;&nbsp;Select Your payment option below</div></b></font></td></tr>
                                        <?php
                                        $sql_payment="select * from payment_gateway where status='Yes'";
                                        $sqlqry_payment=mysql_query($sql_payment);
                                        ?>
                                        <form name="payment" method=post>
                                            <tr><td align="center">
                                                    <select name="paymentoption" style="font-size:15px; height:20px; width:180px; color:#666666" onchange="selpayment(this.value)">
                                                        <option value="0">Select</option>
                                                        <?php
                                                        while($fetch_payment=mysql_fetch_array($sqlqry_payment))
                                                        {
                                                        ?>
                                                        <option value="<?php=$fetch_payment['gateway_id']?>" <?phpif($payid==$fetch_payment['gateway_id']) echo"selected=selected";?>><?php=$fetch_payment['payment_gateway']?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </td></tr>
                                            <input type="hidden" name="item_id" value="<?php=$item_id?>" />
                                            <input type="hidden" name="paymentid_sel" value="" />
                                        </form>
                                        <?php 
                                        if(!empty($payid))
                                        {
                                        ?>
                                        <tr><td height=25  class="detail9txt">
                                                <b><div align="left">
                                                        &nbsp;&nbsp; Notice </div> </b></font> </td></tr>
                                        <tr><td align="center"><font color="red" size="2"><b>
                                                    To ensure correct processing, please DO NOT close the window until your payment has been confirmed.</b></font> </td></tr>
                                        <?php
                                        }?>

                                        <?php
                                        if($payid==3)
                                        {
                                        /* --------- Payment Option Selected is E-Gold	--------------------
                                        ------------	E-Gold Payment Processings Starts Here ---------------
                                        */
                                        ?>      <tr>
                                            <td align="left">
                                                <table border=0 align=center cellpadding=5 cellspacing=2 width=75% >
                                                    <tr><td align=center>
                                                            <form action="https://www.e-gold.com/sci_asp/payments.asp" method=post>
                                                                <input type=hidden name="PAYMENT_AMOUNT" value=<?php echo $amount; ?>>
                                                                       <input type=hidden name="SUGGESTED_MEMO" value = "Memo">
                                                                <input type="hidden" name="PAYEE_ACCOUNT" value=<?php echo $egoldno; ?>>
                                                                       <input type="hidden" name="PAYEE_NAME" value="<?php=$egoldname;?>">
                                                                <input type=hidden name="PAYMENT_UNITS" value=1>
                                                                <input type=hidden name="PAYMENT_METAL_ID" value=1>
                                                                <input type="hidden" name="STATUS_URL" value="mailto:<?php=$adminmail;?>">
                                                                <input type="hidden" name="NOPAYMENT_URL" value="<?php=$yoursite;?>/failure.php">
                                                                <input type="hidden" name="NOPAYMENT_URL_METHOD" value="POST">
                                                                <input type="hidden" name="PAYMENT_URL" value="<?php=$yoursite;?>/success.php">
                                                                <input type="hidden" name="PAYMENT_URL_METHOD" value="POST">
                                                                <input type="hidden" name="BAGGAGE_FIELDS" value="PROGL">
                                                                <input type="hidden" name="PROGL" value="01">
                                                                <input type=image src="images/gold.gif" alt="Make payments with e-gold - it's fast, free and secure!">
                                                            </form>	
                                                        </td></tr>
                                                </table></td></tr>
                                        <?php	
                                        }
                                        if($payid==2)
                                        {
                                        /* ---------Payment Option Selected is Int-Gold	--------------------
                                        ------------	Int-Gold Payment Processings Starts Here---------------
                                        */
                                        ?>
                                        <tr>
                                            <td align="left"><table border=0 align=center cellpadding=5 cellspacing=2 width=75% class="subtable">
                                                    <tr><td align=center>
                                                            <form action="https://intgold.com/cgi-bin/webshoppingcart.cgi" target=_blank method="POST">
                                                                <input type="hidden" name="cmd" value="_xclick">
                                                                <input type="hidden" name="SELLERACCOUNTID" value="<?php echo $intgoldno; ?>">
                                                                <input type="hidden" name="RETURNURL" value="<?php=$yoursite;?>/success.php">
                                                                <input type="hidden" name="CANCEL_RETURN" value="<?php=$yoursite;?>/failure.php">
                                                                <input type="hidden" name="CUSTOM1" value="amount">
                                                                <input type="hidden" name="CUSTOM2" value="status">
                                                                <input type="hidden" name="ITEM_NUMBER" value="121">
                                                                <input type="hidden" name="ITEM_NAME" value="<?php=$intgoldname?>">
                                                                <input type="hidden" name="METHOD" value="POST">
                                                                <input type="hidden" name="RETURNPAGE" value="HTML">
                                                                <input type="hidden" name="AMOUNT" value=<?php echo $amount; ?>>
                                                                       <input type="image" src="images/intgold_logo.gif" name="submit" alt="Make payments with IntGold - it's fast, free and secure!">
                                                            </form>
                                                        </td></tr>
                                                </table></td></tr>
                                        <?php	
                                        }
                                        if($payid==1)
                                        {
                                        /* ---------Payment Option Selected is Paypal	--------------------
                                        ------------	Paypal Payment Processings Starts Here---------------
                                        */
                                        ?>
                                        <tr>
                                            <td align="left"><table border=0 align=center cellpadding=5 cellspacing=2 width=75% class="subtable">

                                                    <tr><td align=center>
                                                            <!--	<form action="https://www.paypal.com/cgi-bin/webscr" method="post">-->
                                                            <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
                                                                <input type="hidden" name="cmd" value="_xclick">
                                                                <input type="hidden" name="business" value="<?php echo $paypalno?>">
                                                                <input type="hidden" name="item_name" value="<?php= $row[item_id] ?>">
                                                                <input type="hidden" name="amount" value="<?php echo $amount;?>">
                                                                <input type="hidden" name="no_note" value="1">
                                                                <input type="hidden" name="currency_code" value="<?php= $default_cur_code ?>">
                                                                <input type="hidden" name="rm" value="2">
                                                                <input type="hidden" name="return" value="<?php=$yoursite?>/success.php?amt=<?php=$amount?>&pid=<?php=$payid?>&usrd=<?php=$_SESSION[userid]?>&itid=<?php=$row[item_id]?>">
                                                                <input type="hidden" name="cancel_return" value="<?php=$yoursite?>/failure.php">
                                                                <center><br><input type="image" src="images/x-click-but6.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!"></center>
                                                            </form>
                                                        </td></tr>
                                                </table></td></tr>
                                        <?php	
                                        }
                                        if($payid==6)
                                        {
                                        /* ---------Payment Option Selected is Strompay	--------------------
                                        ------------	Strompay Payment Processings Starts Here---------------
                                        */
                                        ?>
                                        <tr>
                                            <td align="left"><table border=0 align=center cellpadding=5 cellspacing=2 width=75% class="subtable">

                                                    <tr><td align=center>
                                                            <form method="post" action="https://www.stormpay.com/stormpay/handle_gen.php">
                                                                <input type="hidden" name="generic" value="1">
                                                                <input type="hidden" name="payee_email" value=<?php echo $stormpayno;?> >
                                                                       <input type="hidden" name="product_name" value="<?php= $strsite;?>-Deposit">
                                                                <input type="hidden" name="user_id" value=1>
                                                                <input type="hidden" name="amount" value=<?php echo $amount; ?>>
                                                                       <input type="hidden" name="quantity" value="1">
                                                                <input type="hidden" name="require_IPN" value="1">
                                                                <input type="hidden" name="notify_URL" value="<?php=$yoursite;?>/index.php">
                                                                <input type="hidden" name="return_URL" value="<?php=$yoursite;?>/success.php">
                                                                <input type="hidden" name="cancel_URL" value="<?php=$yoursite;?>/failure.php">
                                                                <input type="hidden" name="subject_matter" value="CashCocktail Payment">
                                                                <input type=image src="images/BuyNowSP1.gif" value="Make payments with stormpay - it's fast, free and secure!">
                                                            </form>
                                                        </td></tr>
                                                </table></td></tr>
                                        <?php	
                                        }
                                        if($payid==5)
                                        {
                                        /* ---------Payment Option Selected is E-Bullion	--------------------
                                        ------------	E-Bullion Payment Processings Starts Here---------------
                                        */
                                        ?>
                                        <tr>
                                            <td align="left">
                                                <table border=0 align=center cellpadding=5 cellspacing=2 width=75% class="subtable">
                                                    <tr><td align=center>
                                                            <!-- e-Bullion<sup>&reg;</sup> ATIP Implementation -->
                                                            <form name="atip" method="post" action="https://atip.e-bullion.com/process.php">
                                                                <input type="hidden" name="ATIP_STATUS_URL" value="<?php=$yoursite;?>">
                                                                <input type="hidden" name="ATIP_STATUS_URL_METHOD" value="POST">
                                                                <input type="hidden" name="ATIP_BAGGAGE_FIELDS" value="">
                                                                <input type="hidden" name="ATIP_SUGGESTED_MEMO" value="">
                                                                <input type="hidden" name="ATIP_FORCED_PAYER_ACCOUNT" value="">
                                                                <input type="hidden" name="ATIP_PAYER_FEE_AMOUNT" value="">
                                                                <input type="hidden" name="ATIP_PAYMENT_URL" value="<?php=$yoursite;?>/success.php">
                                                                <input type="hidden" name="ATIP_PAYMENT_URL_METHOD" value="POST">
                                                                <input type="hidden" name="ATIP_NOPAYMENT_URL" value="<?php=$yoursite;?>/failure.php">
                                                                <input type="hidden" name="ATIP_NOPAYMENT_URL_METHOD" value="POST">
                                                                <input type="hidden" name="ATIP_PAYMENT_FIXED" value="1">
                                                                <input type="hidden" name="ATIP_PAYEE_ACCOUNT" value="<?php=$ebull_no?>">
                                                                <input type="hidden" name="ATIP_PAYEE_NAME" value="<?php=$ebull_name?>">
                                                                <input type="hidden" name="ATIP_BUTTON" value="1">
                                                                <input type="hidden" name="ATIP_PAYMENT_AMOUNT" value="<?php=$amount?>" size="10"><br></font></span>
                                                                <input type="hidden" name="ATIP_PAYMENT_UNIT" value="1">
                                                                <input type="hidden" name="ATIP_PAYMENT_METAL" value="1">
                                                                <tr><td align=center>
                                                                <input type="image" name="pay" src="images/ebullion_button_1.gif" value="Make payments with moneybookers - it's fast, free and secure!"></form>
                                                        </td></tr>
                                                </table></td></tr>
                                        <?php	
                                        }
                                        if($payid==4)
                                        {
                                        /* ---------Payment Option Selected is Money Bookers	--------------------
                                        ------------	Money Bookers Payment Processings Starts Here---------------
                                        */
                                        ?>
                                        <tr>
                                            <td align="left">
                                                <table border=0 align=center cellpadding=5 cellspacing=2 width=75% class="subtable">

                                                    <tr><td align=center>

                                                            <form action="https://www.moneybookers.com/app/payment.pl" target="_blank">
                                                                <input type="hidden" name="pay_to_email" value="<?php=$moneybooker?>">
                                                                <input type="hidden" name="return_url" value="<?php=$yoursite?>/success.php">
                                                                <input type="hidden" name="cancel_url" value="<?php=$yoursite?>/failure.php">
                                                                <input type="hidden" name="language" value="EN">
                                                                <input type="hidden" name="amount" value="<?php=$amount?>">
                                                                <input type="hidden" name="currency" value="<?php= $default_cur_code ?>">
                                                                <input type="image" src="images/money.jpg" value="Make payments with moneybookers - it's fast, free and secure!" name="Pay">
                                                            </form>
                                                        </td></tr>
                                                </table></td></tr>
                                        <?php	
                                        }	

                                        ?>



                                    </table>	
                                </td></tr>
                        </table>	
                    </td></tr>
            </table>	
        </td></tr>
</table>	
<script language="javascript">
    function selpayment()
    {
        payid = document.payment.paymentoption.value;
        if (payid == "0")
            alert("Please select a payment option");
        else
        {
            document.payment.paymentid_sel.value = payid;
            document.payment.submit();
        }
    }
</script>