<?php
/***************************************************************************
*File Name				:ship_detail.tpl
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
<?php require 'include/top.php'; ?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#cecfc8">
    <tr><td>
            <table width="95%" border="0" cellpadding="0" cellspacing="0" align="center" class="border2">
                <tr height=40  bgcolor="#eeeee1">
                    <td class="tr_border"><font size="3"><b>
                            &nbsp;Sell Your Item:Shipping Details &amp; Sales Tax</b></font> </td></tr>
                <tr  bgcolor="#eeeee1">
                    <td height="30" colspan="2">
                        1.Category&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.&nbsp;Tittle & Description &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.Pictures & Details <b>4.&nbsp;Shipping Details & Sales Tax</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5.&nbsp;Preview & Submit</td>
                </tr>
                <tr  bgcolor="#eeeee1"><td>
                        <table width="100%" cellpadding="5" cellspacing="0" align="center" border="0">
                            <tr  bgcolor="#eeeee1">
                                <td>
                                    <?php
                                    if($err_flag==1)
                                    { 
                                    ?>
                                    <table width="758" align="center">
                                        <tr><td>
                                                <img src="images/warning_39x35.gif"></td>
                                            <td><font size=2 color="red">The following must be corrected before continuing:</font></td>
                                            <?php
                                            if(!empty($err_route))
                                            {
                                            ?>
                                        <tr><td>&nbsp;</td>
                                            <td><a href="ship_detail.php#world">Shipping Location</a> - <?php echo  $err_route; ?></td></tr>
                                        <?php 
                                        }
                                        ?>
                                        <?php if(!empty($err_amt))
                                        {
                                        ?>
                                        <tr><td>&nbsp;</td>
                                            <td><a href="ship_detail.php#txtship_amt">Shipping Amount</a> - <?php echo  $err_amt; ?></td></tr>
                                        <?php 
                                        }
                                        ?>
                                    </table>
                                    <?php 
                                    }
                                    ?>
                                </td></tr>
                            <tr><td><font size=2><b>Title:</b></font>&nbsp;&nbsp;<?php echo  $_SESSION[item_name]; ?></td></tr>
                            <tr><td><font size=2><b>Subtitle:</b></font>&nbsp;&nbsp;<?php echo  $_SESSION[subtitle]; ?></td></tr>
                            <tr><td>
                                    <form name="ship" method="post" action="ship_detail.php" onsubmit="return chk();">
                                        <table width="100%" cellpadding="5" cellspacing="2" border="0">

                                            <tr ><td class="tr_bottomless_border"><font size="2"><b>Payment</b></font></td></tr>
                                            <tr><td align="left"><font size="2"><b>Payment Method</b></font>
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
                                            <tr><td align="left"><div id="pay"></div></td></tr> 
                                            <tr ><td class="tr_bottomless_border">
                                                    <?php if(!empty($err_ship_loc))
                                                    {?>
 <img src="images/warning_9x10.gif">&nbsp;<font size=2 color=red><?php echo  $err_ship_loc ?></font>
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
                                                        <tr><td>
                                                                <?php
                                                                if($ship_row['ship_id']==$shipping_route[$s])
                                                                {
                                                                ?>
                                                                <input type="checkbox" name="ship<?php echo  $r ?>"  value="<?php echo $ship_row['ship_id'];?>" checked><?php echo $ship_row[location];?>
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
                                                                <input type="checkbox" name="ship<?php echo $r  ?>"  value="<?php echo $ship_row['ship_id'];?>"><?php echo $ship_row[location];?>
                                                                <?php
                                                                }
                                                                }
                                                                $j=0;
                                                                $r++;
                                                                }
                                                                ?>

                                                    </table>
                                            <tr>
                                                <td class="tr_bottomless_border"><font size="2"><b>Shipping Cost</b></font></td></tr>
                                            <tr><td align="left">
                                                    <?php if(!empty($err_amt))
                                                    {?>
 <img src="images/warning_9x10.gif">&nbsp;<font size=2 color=red><?php echo  $err_amt ?></font>
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
                                                    <input type="text" name=txtship_amt class="txtsmall" value=<?php echo  $shipping_amt;?>></td></tr>
                                            <tr >
                                                <td class="tr_bottomless_border"><font size="2"><b>Sales Tax </b></font></td>
                                            </tr>
                                            <tr><td align="left"> 
                                                    <font size="2">
                                                    <b>Tax Amount</b></font>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
                                                    <input type="text" name=tax class="txtsmall" value="<?php echo $tax;?>"> <b> % </b> 
                                                </td>
                                            </tr>

                                            <tr><td class="tr_bottomless_border"><font size="2"><b>Return Policy</b></font></td></tr>
                                            <!--<tr><td>  
                                            <?php //if($returns_accepted) { checked="checked" } ?>
                                            <input type="checkbox" name="chkreturns"  />Returns Accepted - Specify a return policy.<a onClick="window.open('returnpolicy.php','My_Popup','width=700,height=700');" href="#">Learn More.</a> 
                                            </td></tr>-->
                                            <tr><td>Item must be returned within&nbsp;&nbsp;
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
                                            <tr><td>
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

                                            <tr><td><b>Return Policy Details</b></td></tr>
                                            <tr><td>
                                                    <textarea name="txtploicy" cols="60" rows="6"><?php echo  $returnpolicy_instructions ?></textarea>
                                                </td></tr>
                                            <tr><td class="tr_bottomless_border"><font size="2"><b>Payment Instructions</b></font></td></tr>
                                            <tr><td>Give clear instructions to assist your buyer with payment and shipping.</td></tr>
                                            <tr><td>
                                                    <textarea name="txtpaymentins" cols="60" rows="6"><?php echo  $payment_instructions ?> </textarea>
                                                </td></tr>
                                            <!--<tr><td class="tr_bottomless_border">
                                            <table width="100%" >
                                             <tr><td><font size="2"><b>Buyer Requirements</b></font></td><td align="right">
                                            <a href=# onClick="window.open('buyerblockpreferences.php','pop_up','toolbar=no, top=0,location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=780, height=600')">Edit Preferences</a></td></table>
                                            </td></tr> 
                                            <tr><td>
                                            <input type="text" name="blockpreferencesoption" id=blockpreferencesoption style="border:#FFFFFF;width:500" />
                                            </td></tr>
                                            <tr><td>
                                            <input type="text" name="blockbuyercountries" id=blockcountryid style="border:#FFFFFF;width:500"  value="<?php echo  $_SESSION[blockbuyercountries] ?>"/></td></tr>
                                            <tr><td>
                                            <input type="hidden" name="feedbackscore"  />
                                            <input type="text" name="blockbuyerfeedbakscore" id=blockbuyerfeedbakscore style="border:#FFFFFF;width:500" /></td></tr>
                                            <tr><td>
                                            <input type="text" name="blockunpaidistrick" id=blockcountryid style="border:#FFFFFF;width:500" /></td></tr>
                                            <tr><td>
                                            <input type="text" name="ItemLimit" id=blockcountryid style="border:#FFFFFF;width:500" /></td></tr>
                                            <tr><td>
                                            <input type="text" name="blockmerkatobid" id=blockmerkatobid style="border:#FFFFFF;width:500" /></td></tr> 
                                            
                                            <tr><td align="center">
                                            
                                            <input type="hidden" name="ItemLimitMinFeedback" value="">
                                            <input type="hidden" name="ItemLimitoption" value=""> -->
                                            <tr><td align="center">
                                                    <input type="hidden" name="flag" value="1"> 
                                                    <input type="submit" name=submit value="Submit" class="buttonsearch"></td></tr>
                                    </form>
                        </table>
                        <script language="JavaScript">
                            function chk() {
                                if (document.ship.chkreturns.checked == true) {
                                    if (document.ship.cboreturndays.value == 0) {
                                        alert("Select the Return Days");
                                        return false;
                                    } else
                                    if (document.ship.cborefund.value == 0) {
                                        alert("Select Money Refund Type");
                                        return false;
                                    } else
                                    if (document.ship.txtploicy.value == "") {
                                        alert("Please Fill Policy Details ");
                                        return false;
                                    }
                                    return true;
                                }
                                return true;
                            }
                        </script>
