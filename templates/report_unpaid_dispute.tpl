<?php
/***************************************************************************
*File Name				:unpaiddispute.php
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
                &nbsp;&nbsp;Report an Unpaid Item Dispute</div></font></td>
    </tr>
    <tr><td colspan="2" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom"  background="images/contentgrad.jpg"> 
            <table cellpadding="5" cellspacing="2"  width=100%> 
                <tr><td valign="top">
                        <table border="0" align="center" cellpadding="3" cellspacing="0" width="100%">
                            <tr height=30>
                                <td  ><font size="3" class="detail9txt"><b>Report an Unpaid Item Dispute </b>
                                    </font> </td></tr>
                            <?php if($err_reason or $err_explanation) 
                            {
                            ?>
                            <tr><td style="padding-left:10px" class="banner1"> Please enter your explanation in highlighted fields  below   </td> </tr>
                            <tr><td style="padding-left:10px"> 
                                    <ul type="disc"><li>
                                            <?php 
                                            if($err_reason==1)
                                            {
                                            ?>
                                            <font color="#FF0000" class="errormsg">
                                            Why are you reporting this Unpaid Item? </font> 
                                            <?php
                                            }
                                            ?>
                                        </li><li>
                                            <?php 
                                            if($err_explanation==1)
                                            {
                                            ?>
                                            <font color="#FF0000" class="errormsg">
                                            What has happened so far in the dispute? </font> 
                                            <?php
                                            }
                                            ?>
                                        </li>
                                    </ul> </td> </tr>
                            <?php
                            }
                            ?>
                            <tr><td style="padding-left:10px" class="banner1">Please answer the questions and Continue to report an Unpaid Item dispute. We also have tips to help you avoid Unpaid Items in the future. If the buyer returned the item, choose 'we have both agreed not to complete the transaction'. </td></tr>
                            <tr><td style="padding-left:10px" > <font class="detail9txt"><b> UnpaidItem:</b></font><font class="banner1"> <?php echo  $sell[item_title] ?> (#<?php echo  $bid[item_id] ?>) sold to <?php echo  $user[user_name] ?> on
                                    <?php
                                    $custom_date=explode(" ",$bid_date);
                                    $custom_date1=$custom_date[0];
                                    $custom_time=$custom_date[1];
                                    $custom_date3=substr($custom_date1,"-2");
                                    $custom_date2=explode("-",$custom_date1);
                                    $custom_date1=$custom_date2[0];
                                    $custom_date2=$custom_date2[1];
                                    $custom_date4=$custom_date3."-"."$custom_date2"."-"."$custom_date1"." "."$custom_time";
                                    echo  $custom_date4;
                                    ?>.    </font></td></tr>

                            <form name="form1" action="report_unpaid_dispute.php"  method=post>
                                <tr><td style="padding-left:10px"  class="detail9txt"> <b>
                                            <?php if($err_reason==1) { ?>
                                            <font color="#FF0000">
                                            Why are you reporting this Unpaid Item? </font> 
                                            <?php
                                            }
                                            else
                                            { 
                                            ?> 
                                            Why are you reporting this Unpaid Item?
                                            <?php
                                            }
                                            ?>
                                        </b> </td></tr>
                                <tr>
                                    <td style="padding-left:10px"> 
                                        <select name="cboDisputeReason"><option value="0">-- Select One --</option>
                                            <option value="The buyer has not paid for the item">The buyer has not paid for the item</option>
                                            <option value="We have both agreed not to complete the transaction">We have both agreed not to complete the transaction</option>
                                        </select>
                                    </td></tr>
                                <tr><td style="padding-left:10px"  class="detail9txt"> 
                                        <b>
                                            <?php if($err_explanation==1) { ?>
                                            <font color="#FF0000">
                                            What has happened so far in the dispute? </font> 
                                            <?php
                                            }
                                            else
                                            { 
                                            ?> 
                                            What has happened so far in the dispute? 
                                            <?php
                                            }
                                            ?></b> </td></tr>
                                <tr><td style="padding-left:10px">
                                        <select name="cboDisputeExplanation"><option value="0">-- Select One --</option><option value="The buyer has not responded">The buyer has not responded</option><option value="The buyer's payment has not been received">The buyer's payment has not been received</option><option value="The buyer's payment has not cleared">The buyer's payment has not cleared</option><option value="The buyer requested shipment to an unconfirmed address">The buyer requested shipment to an unconfirmed address</option><option value="22">The buyer requested an unauthorized payment method</option><option value="The buyer is no longer registered">The buyer is no longer registered</option><option value="Other reason">Other reason</option>
                                        </select>
                                        <input type="hidden" name="bid_id" value=<?php echo  $bid_id ?> />
                                               <input type="hidden" name="flag" value=1 />

                                    </td></tr>
                                <tr><td><hr></td></tr>
                                <tr><td style="padding-left:10px"><input type="image" src="images/continue.gif" name="Image71" width="81" height="24" border="0" id="Image71" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image71', '', 'images/continueo.gif', 1)"/> </td></tr>
                            </form>
                        </table></td></tr></table></td></tr></table>