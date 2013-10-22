<?php
/***************************************************************************
*File Name				:editshipdetail.tpl
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
<table width="958" cellpadding="0" cellspacing="5" border=0 align="center">
    <tr>
        <td><table width="948" height="27" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#f0f2f5">
                <tr>
                    <td height="30" colspan="2" class="banner1">
                        1.Category&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.&nbsp;Title & Description &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.Pictures & Details <b>4.&nbsp;Shipping Details & Sales Tax</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5.&nbsp;Preview & Submit</td>
                </tr>
            </table></td></tr>

    <?php
    if($err_flag==1)
    { 
    ?>
    <tr><td><table width="948" background="images/contentgrad.jpg" style="border:1px solid #c4dbe7; background-repeat:repeat-x; background-position:bottom; padding-left:20px">
                <tr><td>
                        <img src="images/warning_39x35.gif"></td>
                    <td><font class="banner1" color="red">The following must be corrected before continuing:</font></td>
                    <?php
                    if(!empty($err_route))
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
                <?php if(!empty($err_ship))
                {
                ?>
                <tr><td>&nbsp;</td>
                    <td><a href="edit_auction_step3.php#txtship_amt">Shipping Amount</a> - <?php= $err_ship; ?></td></tr>
                <?php 
                }
                ?>
                <?php if(!empty($err_tax))
                {
                ?>
                <tr><td>&nbsp;</td>
                    <td><a href="edit_auction_step3.php#tax">Shipping Amount</a> - <?php= $err_tax; ?></td></tr>
                <?php 
                }
                ?>
            </table>
        </td></tr>
    <?php 
    }
    ?>
</td></tr>
<tr><td><table width="948" background="images/contentgrad.jpg" style="border:1px solid #c4dbe7; background-repeat:repeat-x; background-position:bottom; padding-left:20px">
            <tr><td class="banner1"> <font class="banner1"><b>Title:</b></font>&nbsp;&nbsp;<?php= $_SESSION[item_name]; ?></td></tr>
            <tr><td class="banner1"><font class="banner1"><b>Subtitle:</b></font>&nbsp;&nbsp;<?php= $_SESSION[subtitle]; ?></td></tr>
        </table></td></tr>


<form name="ship" method="post" action="edit_auction_step3.php">

    <tr>
        <td colspan="2" height="32" border="0" align="center" cellpadding="0" cellspacing="0">
            <table background="images/abtusbg.jpg" width="948" height="32" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr><td><font class="categories_fonttype">&nbsp;&nbsp;Payment</font></td></tr>
            </table></td></tr>
    <tr><td><table width="948" background="images/contentgrad.jpg" style="border:1px solid #c4dbe7; background-repeat:repeat-x; background-position:bottom; padding-left:20px" height=100>
                <tr><td align="left"><font class="banner1"><b>Payment Method</b></font>
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
                <tr><td align="left" class=banner1><div id="pay"></div></td></tr> 
            </table></td></tr>
    <tr><td>
            <table background="images/abtusbg.jpg" width="948" height="32" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr><td class="categories_fonttype">&nbsp;&nbsp;Shipping Details</td></tr></table></td></tr>
    <tr><td><table width="948" background="images/contentgrad.jpg" style="border:1px solid #c4dbe7; background-repeat:repeat-x; background-position:bottom; padding-left:20px" cellpadding="5" cellspacing="5">
                <tr><td>
                        <?php if(!empty($err_ship_loc))
                        {?>
 <img src="images/warning_9x10.gif">&nbsp;<font class="banner1" color=red><?php= $err_ship_loc ?></font>
 <br>
 <b><font class="banner1" color=red>Shipping Location</font></b>
 <?php
                        }
                        else
                        {
                        ?>
                        <b><font class="banner1">Shipping Location</font></b>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table align="left" width="430" cellpadding="5" cellspacing="2">
                            <?php
                            $ship_sql="select * from shipping_location";
                            $ship_res=mysql_query($ship_sql);
                            $total=mysql_num_rows($ship_res);
                            $j=0;
                            $r=0;
                            $shipping_route=explode(",",$_SESSION[shipping_route]);
                            while($ship_row=mysql_fetch_array($ship_res))
                            {
                            for($s=0;$s<=$total;$s++)
                            {
                            ?>
                            <tr><td class="banner1">
                                    <?php
                                    if($ship_row['ship_id']==$shipping_route[$s])
                                    {
                                    ?>
                                    <input type="checkbox" name="ship<?php= $r ?>"  value="<?php=$ship_row['ship_id'];?>" checked><?php=$ship_row[location];?>
                                    <?php
                                    break;
                                    }
                                    else
                                    {
                                    $j++;
                                    }
                                    if($j==$total)
                                    {
                                    ?>
                                    <input type="checkbox" name="ship<?php=$r  ?>"  value="<?php=$ship_row['ship_id'];?>"><?php=$ship_row[location];?>
                                    <?php
                                    }
                                    }
                                    $j=0;
                                    $r++;
                                    }
                                    ?>

                        </table>
                <tr>
                    <td class="tr_bottomless_border"><font class="banner1"><b>Shipping Cost</b></font></td></tr>
                <tr><td align="left">
                        <?php if(!empty($err_amt))
                        {?>
 <img src="images/warning_9x10.gif">&nbsp;<font class="banner1" color=red><?php= $err_amt ?></font>
 <br>
 <b><font class="banner1" color=red>Shipping Amount</font></b>
 <?php
                        }
                        else
                        {
                        ?>
                        <b><font class="banner1">Shipping Amount</font></b>
                        <?php
                        }
                        ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="text" name=txtship_amt class="txtsmall" value=<?php= $shipping_amt;?>></td></tr>
                <tr >
                    <td><font class="banner1"><b>Sales Tax </b></font></td>
                </tr>
                <tr><td align="left"> 
                        <font class="banner1">
                        <b>Tax percentage</b></font>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
                        <input type="text" name=tax class="txtsmall" value="<?php=$tax;?>"> <b> % </b> 
                    </td>
                </tr>


            </table></td></tr>

    <tr><td><table background="images/abtusbg.jpg" width="948" height="32" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr><td class="categories_fonttype">&nbsp;&nbsp;Return Policy</td></tr>
            </table></td></tr>
    <tr><td><table width="948" background="images/contentgrad.jpg" style="border:1px solid #c4dbe7; background-repeat:repeat-x; background-position:bottom; padding-left:20px" cellpadding="5" cellspacing="5">
                <tr><td class="banner1">  
                        <input type="checkbox" name="chkreturns" onclick="return val();" <?php if($returns_accepted) { ?>checked="checked" <?php } ?>/>Returns Accepted - Specify a return policy.<a href="returnpolicy.php" class="header_text">Learn More.</a> 
                    </td></tr>
                <tr><td class="banner1">Item must be returned within&nbsp;&nbsp;
                        <?php  
                        $auction_query="select * from auction_duration order by duration_id";
                        $table=mysql_query($auction_query);
                        ?>
                        <select name="cboreturndays">
                            <option value="0">Select</option>
                            <?php
                            while($row=mysql_fetch_array($table))
                            {
                            ?>
                            <?php if($refund_days==$row['duration'])
                            {
                            ?>
                            <option value="<?php= $row['duration'] ?>" selected> <?php= $row['duration'] ?> Days</option>
                            <?php
                            }
                            else
                            {
                            ?>
                            <option value="<?php= $row['duration'] ?>" > <?php= $row['duration'] ?> Days</option>
                            <?php
                            }
                            } // while($row=mysql_fetch_array($table))
                            ?>
                        </select>
                    </td></tr>
                <tr><td class="banner1">
                        Refund will be given as&nbsp;&nbsp;<select name="cborefund">
                            <?php 
                            if($refund_method=="Exchange")
                            {
                            ?>
                            <option value="Exchange" selected="selected">Exchange</option>
                            <?php
                            }
                            else
                            {
                            ?>
                            <option value="Exchange">Exchange</option>
                            <?php
                            }
                            ?>
                            <?php 
                            if($refund_method=="Money Back")
                            {
                            ?>
                            <option value="Money Back" selected="selected">Money Back</option>
                            <?php
                            }
                            else
                            {
                            ?>
                            <option value="Money Back">Money Back</option>
                            <?php
                            }
                            ?>
                            <?php 
                            if($refund_method=="Merchandise Credit")
                            {
                            ?>
                            <option value="Merchandise Credit" selected="selected">Merchandise Credit</option>
                            <?php
                            }
                            else
                            {
                            ?>
                            <option value="Merchandise Credit">Merchandise Credit</option>
                            <?php
                            }
                            ?>
                        </select></td></tr>

                <tr><td class="banner1">Return Policy Details</td></tr>
                <tr><td>
                        <textarea name="txtploicy" cols="60" rows="6"><?php= $returnpolicy_instructions ?></textarea>
                    </td></tr>
            </table></td></tr>
    <tr><td><table background="images/abtusbg.jpg" width="948" height="32" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr><td><font class="categories_fonttype">&nbsp;&nbsp;Payment Instructions</font></td></tr>
            </table></td></tr>
    <tr><td><table width="948" background="images/contentgrad.jpg" style="border:1px solid #c4dbe7; background-repeat:repeat-x; background-position:bottom; padding-left:20px" cellpadding="5" cellspacing="5">
                <tr><td class="banner1">Give clear instructions to assist your buyer with payment and shipping.</td></tr>
                <tr><td>
                        <textarea name="txtpaymentins" cols="60" rows="6"><?php= $payment_instructions ?> </textarea>
                    </td></tr>
                <!--<tr><td>
                <input type="text" name="blockpreferencesoption" id=blockpreferencesoption style="border:#FFFFFF;width:500" />
                </td></tr>
                <tr><td>
                <input type="text" name="blockbuyercountries" id=blockcountryid style="border:#FFFFFF;width:500"  value="<?php= $_SESSION[blockbuyercountries] ?>"/></td></tr>
                <tr><td>
                <input type="hidden" name="feedbackscore"  />
                <input type="text" name="blockbuyerfeedbakscore" id=blockbuyerfeedbakscore style="border:#FFFFFF;width:500" /></td></tr>
                <tr><td>
                <input type="text" name="blockunpaidistrick" id=blockcountryid style="border:#FFFFFF;width:500" /></td></tr>
                <tr><td>
                <input type="text" name="ItemLimit" id=blockcountryid style="border:#FFFFFF;width:500" /></td></tr>
                <tr><td>
                <input type="text" name="blockmerkatobid" id=blockmerkatobid style="border:#FFFFFF;width:500" /></td></tr>
                -->
                <tr><td align="center">

                        <input type="hidden" name="ItemLimitMinFeedback" value="">
                        <input type="hidden" name="ItemLimitoption" value="">
                        <input type="hidden" name="flag" value="1">
                        <input type="image" src="images/submit.gif" name="Image85" width="62" height="22" border="0" id="Image85" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image85', '', 'images/submito.gif', 1)" onclick="return validate()"/></td></tr>
</form>
</table>
</td></tr>

<script>
    function val()
    {
        if (ship.chkreturns.checked == true)
        {
            ship.cboreturndays.disabled = false;
            ship.cborefund.disabled = false;
            ship.txtploicy.disabled = false;
        }
        else
        {
            ship.cboreturndays.disabled = true;
            ship.cborefund.disabled = true;
            ship.txtploicy.disabled = true;
        }
        return true;
    }
    val();
</script>