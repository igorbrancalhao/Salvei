<?php
/***************************************************************************
*File Name				:ship_detail.tpl
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
?>
<table width="958" cellpadding="0" cellspacing="0" border=0 align="center">
    <tr><td valign="top"> 
            <table width="958" cellpadding="5" cellspacing="2">
                <tr>
                    <td><table width="948" height="27" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#f0f2f5">
                            <tr>
                                <td height="30" colspan="2" class="banner1">
                                    1.Category&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.&nbsp;Title & Description &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.Pictures & Details <b>4.&nbsp;Shipping Details & Sales Tax</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5.&nbsp;Preview & Submit</td>
                            </tr></table></td></tr>
                <tr><td>
                        <table width="100%" cellpadding="5" cellspacing="0" align="center" border="0">

                            <?php
                            if($err_flag==1)
                            { 
                            ?>
                            <tr>
                                <td>
                                    <table align="center" width="948" background="images/contentgrad.jpg" style="border:1px solid #c4dbe7; background-repeat:repeat-x; background-position:bottom">
                                        <tr><td>
                                                <img src="images/warning_39x35.gif"></td>
                                            <td><font size=2 color="red">The following must be corrected before continuing:</font></td>
                                            <?php
                                            if(!empty($err_payment))
                                            {
                                            ?>
                                        <tr><td>&nbsp;</td>
                                            <td class="banner1"><a href="ship_detail.php#payment" class="header_text2">Payment Method</a> - <?php echo  $err_payment; ?></td></tr>
                                        <?php
                                        }
                                        if(!empty($err_payid))
                                        {
                                        ?>
                                        <tr><td>&nbsp;</td>
                                            <td class="banner1"><a href="ship_detail.php#payid" class="header_text2">Payment Id</a> - <?php echo  $err_payid; ?></td></tr>
                                        <?php
                                        }
                                        if(!empty($err_route))
                                        {
                                        ?>
                                        <tr><td>&nbsp;</td>
                                            <td class="banner1"><a href="ship_detail.php#world" class="header_text2">Shipping Location</a> - <?php echo  $err_route; ?></td></tr>
                                        <?php 
                                        }
                                        ?>
                                        <?php if(!empty($err_amt))
                                        {
                                        ?>
                                        <tr><td>&nbsp;</td>
                                            <td class="banner1"><a href="ship_detail.php#txtship_amt" class="header_text2">Shipping Amount</a> - <?php echo  $err_amt; ?></td></tr>
                                        <?php 
                                        }
                                        ?>
                                        <?php if(!empty($err_ship))
                                        {
                                        ?>
                                        <tr><td>&nbsp;</td>
                                            <td class="banner1"><a href="ship_detail.php#txtship_amt" onclick="sel('txtship_amt')" class="header_text2">Shipping Amount</a> - <?php echo  $err_ship; ?></td></tr>
                                        <?php 
                                        }
                                        ?>
                                        <?php if(!empty($err_tax))
                                        {
                                        ?>
                                        <tr><td>&nbsp;</td>
                                            <td class="banner1"><a href="ship_detail.php#tax" onclick="sel('tax')" class="header_text2">Sales Tax</a> - <?php echo  $err_tax; ?></td></tr>
                                        <?php 
                                        }
                                        if(!empty($err_ref))
                                        {
                                        ?>
                                        <tr><td>&nbsp;</td><td class="banner1"><a href="ship_detail.php#ref" onclick="sel('cboreturndays')" class="header_text2">Refund Days</a> - <?php echo $err_ref?></td></tr>
                                        <?php
                                        }
                                        ?>
                                    </table>
                                </td></tr>
                            <?php 
                            }
                            ?>


                            <tr><td><table width="948" background="images/contentgrad.jpg" style="border:1px solid #c4dbe7; background-repeat:repeat-x; background-position:bottom" align="center">
                                        <tr><td><font class="categories_fonttype"><b>Title:</b></font>&nbsp;&nbsp;<font class="banner1"><?php echo  $_SESSION[item_name]; ?></font></td></tr>
                                        <tr><td><font class="categories_fonttype"><b>Subtitle:</b></font>&nbsp;&nbsp;
                                                <font class="banner1"><?php echo  $_SESSION[subtitle]; ?></font>
                                            </td></tr>
                                    </table></td></tr>
                            <tr><td>
                                    <form name="ship" method="post" action="ship_detail.php">
                                        <table width="100%" cellpadding="5" cellspacing="2" border="0">

                                            <tr><td><table background="images/abtusbg.jpg" width="948" height="32" border="0" align="center" cellpadding="0" cellspacing="0">
                                                        <tr><td><b><font class="categories_fonttype">&nbsp;&nbsp;Payment</font></b></td></tr>
                                                    </table></td></tr>

                                            <tr><td><table width="943" border="0" align="center" cellpadding="0" cellspacing="5" background="images/contentgrad.jpg" style="border:1px solid #c4dbe7; background-repeat:repeat-x; background-position:bottom">
                                                        <tr><td>&nbsp;</td></tr>
                                                        <tr><td class="banner1"><noscript>Javascript must be enabled to enter the payment id.</noscript></td></tr>
                                                        <tr><td align="left" class="banner1"><font size="2"><b>Payment Method</b></font>

                                                                <?php

                                                                $pay_sql="select * from payment_gateway where status='Yes'";
                                                                $pay_res=mysql_query($pay_sql);
                                                                ?><select name="payment" onChange="pay_refresh()">
                                                                    <option value="0">Select</option>
                                                                    <?php
                                                                    while($pay_row=mysql_fetch_array($pay_res))
                                                                    {
                                                                    if($pay_row[gateway_id]==$payment)
                                                                    {
                                                                    ?>
                                                                    <option value="<?php echo $pay_row['gateway_id'];?>" selected><?php echo $pay_row[payment_gateway];?></option>
                                                                    <?php
                                                                    }
                                                                    else
                                                                    {
                                                                    ?>
                                                                    <option value="<?php echo $pay_row['gateway_id'];?>"><?php echo $pay_row[payment_gateway];?></option>
                                                                    <?php
                                                                    }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </td>
                                                        </tr>

                                                        <tr><td>&nbsp;</td></tr>
                                                        <tr><td align="left"><div id="pay"></div></td></tr> 
                                                    </table></td></tr>

                                            <tr><td>
                                                    <table background="images/abtusbg.jpg" width="948" height="32" border="0" align="center" cellpadding="0" cellspacing="0">
                                                        <tr><td class="categories_fonttype">&nbsp;&nbsp;Shipping Details</td></tr>
                                                    </table></td></tr>

                                            <tr><td><table width="948" background="images/contentgrad.jpg" style="border:1px solid #c4dbe7; background-repeat:repeat-x; background-position:bottom"cellpadding="0" cellspacing="5">
                                                        <tr><td class="banner1">
                                                                <?php if(!empty($err_ship_loc))
                                                                {?>
 <img src="images/warning_9x10.gif">&nbsp;<font class="moretxt"><?php echo  $err_ship_loc ?></font>
 <br>
 <b><font class="moretxt">Shipping Location</font></b>
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
                                                                            <input type="checkbox" name="ship<?php echo  $r ?>"  value="<?php echo $ship_row['ship_id'];?>" checked <?php if($ship_row['ship_id']==1){?> onclick="return selectall();" <?php } ?>><?php echo $ship_row[location];?>
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
                                                                                   <input type="checkbox" name="ship<?php echo $r  ?>"  value="<?php echo $ship_row['ship_id'];?>" onclick="return selectall();"><?php echo $ship_row[location];?>
                                                                            <?php
                                                                            }
                                                                            }
                                                                            $j=0;
                                                                            $r++;
                                                                            }
                                                                            ?>

                                                                </table>
                                                            </td></tr>
                                                        <!--<tr>
                                                        <td><b><font size="2" color="green">Shipping Cost</font></b></td></tr>-->
                                                        <tr><td align="left" class="banner1">
                                                                <?php if((!empty($err_amt))||(!empty($err_ship)))
                                                                {?>
 <img src="images/warning_9x10.gif">&nbsp;<font class="moretxt"><?php echo  $err_ship ?></font>
 <br>
 <b><font class="moretxt">Shipping Amount</font></b>
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
                                                                <input type="text" name=txtship_amt class="txtsmall" value="<?php echo $shipping_amt;?>"></td></tr>
                                                        <tr><td align="left" class="banner1"> 
                                                                <?php if(!empty($err_tax))
                                                                {?>
 <img src="images/warning_9x10.gif">&nbsp;<font class="moretxt"><?php echo  $err_tax ?></font>
 <br>
 <b><font class="moretxt">Tax Amount</font></b>
 <?php
                                                                }
                                                                else
                                                                {
                                                                ?>
                                                                <b><font size=2>Tax Amount</font></b>
                                                                <?php
                                                                }
                                                                ?>

                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
                                                                <input type="text" name=tax class="txtsmall" value="<?php echo $tax;?>"> <b> % </b> 
                                                            </td>
                                                        </tr>
                                                    </table></td></tr>

                                            <tr><td><table background="images/abtusbg.jpg" width="948" height="32" border="0" align="center" cellpadding="0" cellspacing="0">
                                                        <tr><td><b><font class="categories_fonttype">&nbsp;&nbsp;Return Policy</font></b></td></tr>
                                                    </table></td></tr>
                                            <tr><td><table width="948" background="images/contentgrad.jpg" style="border:1px solid #c4dbe7; background-repeat:repeat-x; background-position:bottom" cellpadding="0" cellspacing="10">
                                                        <tr><td class="banner1">
                                                                <input type="checkbox" name="chkreturns"  onclick="return val();" <?php if($returns_accepted) { echo "checked"; }?>>
                                                                       Returns Accepted - Specify a return policy.
                                                                       <a onClick="window.open('returnpolicy.php', 'My_Popup', 'width=700,height=700');" href="#" class="header_text">Learn More.</a> 
                                                            </td></tr>
                                                        <tr><td class="banner1">
                                                                <?php
                                                                if(!empty($err_ref))
                                                                echo '<img src="images/warning_9x10.gif">&nbsp;&nbsp;<font color=red>'.$err_ref.'</font><br><font color=red>Item must be returned within</font>';
                                                                else
                                                                echo 'Item must be returned within &nbsp;&nbsp;&nbsp;&nbsp;';   
                                                                ?>

                                                                <?php  
                                                                //modified query to display the duration in order
                                                                $auction_query="select * from auction_duration order by duration";
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
                                                                    <option value="<?php echo  $row['duration'] ?>" selected> <?php echo  $row['duration'] ?> Days</option>
                                                                    <?php
                                                                    }
                                                                    else
                                                                    {
                                                                    ?>
                                                                    <option value="<?php echo  $row['duration'] ?>" > <?php echo  $row['duration'] ?> Days</option>
                                                                    <?php
                                                                    }
                                                                    } // while($row=mysql_fetch_array($table))
                                                                    ?>
                                                                </select>
                                                            </td></tr>
                                                        <tr><td class="banner1">
                                                                <?php
                                                                if(!empty($err_method))
                                                                {
                                                                echo '<img src="images/warning_9x10.gif">&nbsp;<font color=red>'.$err_method.'</font><br><font color=red>Refund will be  as &nbsp;&nbsp;</font>';

                                                                }
                                                                else
                                                                echo "Refund will be given as &nbsp;&nbsp;";
                                                                ?>
                                                                <select name="cborefund">
                                                                    <option value="0">Select</option>
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

                                                        <tr><td class="banner1"><b>Return Policy Details</b></td></tr>

                                                        <tr><td>
                                                                <textarea name="txtploicy" cols="60" rows="6"><?php echo  $returnpolicy_instructions ?></textarea></td></tr>
                                                    </table></td></tr>
                                            <tr><td><table background="images/abtusbg.jpg" width="948" height="32" border="0" align="center" cellpadding="0" cellspacing="0">
                                                        <tr><td class="banner1"><font class="categories_fonttype"><b>&nbsp;&nbsp;Payment Instructions</b></font></td></tr>
                                                    </table></td></tr>
                                            <tr><td><table width="948" background="images/contentgrad.jpg" style="border:1px solid #c4dbe7; background-repeat:repeat-x; background-position:bottom" cellpadding="0" cellspacing="5">
                                                        <tr><td><font color="#999999">Give clear instructions to assist your buyer with payment and shipping.</font></td></tr>
                                                        <tr><td>
                                                                <textarea name="txtpaymentins" cols="60" rows="6" ><?php echo  $payment_instructions ?> </textarea>
                                                            </td></tr>
                                                        <tr><td align="center">

                                                                <input type="hidden" name="ItemLimitMinFeedback" value="">
                                                                <input type="hidden" name="ItemLimitoption" value="">
                                                                <input type="hidden" name="checkflag" value="">
                                                                <input type="hidden" name="flag" value="1">
                                                                <input type="image" src="images/submit.gif" name="Image85" width="62" height="22" border="0" id="Image85" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image85', '', 'images/submito.gif', 1)" onclick="return validate()"/>
                                                                <!--<input type="submit" name=submit value="Submit" class="buttonsearch" onclick="return validate();">--></td></tr>
                                                    </table></td></tr>
                                    </form>
                        </table>
                    </td></tr></table>
        </td></tr></table>
</td></tr></table>
</td></tr></table>


<script language="javascript1.1">
    function checkfun()
    {
        a = document.ship.chkreturns.checked;
        if (a == true)
        {
            document.ship.cboreturndays.style.visibility = "visible";
            document.ship.cborefund.style.visibility = "visible";
            document.ship.txtploicy.style.visibility = "visible";
            document.ship.item1.style.visibility = "visible";
            document.ship.item2.style.visibility = "visible";
            document.ship.item3.style.visibility = "visible";
        }
        else
        {
            document.ship.cboreturndays.style.visibility = "hidden";
            document.ship.cborefund.style.visibility = "hidden";
            document.ship.txtploicy.style.visibility = "hidden";
            document.ship.item1.style.visibility = "hidden";
            document.ship.item2.style.visibility = "hidden";
            document.ship.item3.style.visibility = "hidden";


        }
    }
    function validate()
    {

        if (document.ship.payment.value == 0)
        {
            alert("Please Select the Payment");
            document.ship.payment.focus();
            return false;
        }
        var payment_name = document.ship.payment.value;
        if (payment_name == 1 || payment_name == 2 || payment_name == 4 || payment_name == 6)
        {
            if (document.ship.payid.value == "")
            {
                alert("Please Enter the Payment ID");
                document.ship.payid.focus();
                return false;
            }
        }
        else {
            if (document.ship.payid.value == "")
            {
                alert("Please Enter the Payment ID");
                document.ship.payid.focus();
                return false;
            }
            else if (document.ship.payname.value == "")
            {
                alert("Please Enter the Payment ID");
                document.ship.payname.focus();
                return false;
            }
        }
        if (document.ship.chkreturns.checked == true)
        {
            if (document.ship.cboreturndays.value == 0)
            {
                alert("Please Select the Return Days");
                document.ship.cboreturndays.focus();
                return false;
            }
            if (document.ship.cborefund.value == 0)
            {
                alert("Please Select the Refund Type");
                document.ship.cborefund.focus();
                return false;
            }
        }

        return true;
    }

    function val()
    {
        if (document.ship.chkreturns.checked == true)
        {
            document.ship.cboreturndays.disabled = false;
            document.ship.cborefund.disabled = false;
            document.ship.txtploicy.disabled = false;
        }
        else
        {
            document.ship.cboreturndays.disabled = true;
            document.ship.cborefund.disabled = true;
            document.ship.txtploicy.disabled = true;
        }
        return true;
    }
    val();

    function sel(elementname)
    {
        var element_name = elementname;
        if (element_name == "txtship_amt")
            document.ship.txtship_amt.focus();
        if (element_name == "tax")
            document.ship.tax.focus();
        if (element_name == "cboreturndays")
            document.ship.cboreturndays.focus();
    }
</script>