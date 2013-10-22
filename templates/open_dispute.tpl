<?php
/***************************************************************************
*File Name				:open_dispute.php
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
                &nbsp;&nbsp; Describe Dispute</div></font></td></tr>

    <tr><td colspan="2" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom"  background="images/contentgrad.jpg"> 
            <table cellpadding="5" cellspacing="2"  width=100%> 
                <tr height=30>
                    <td><font size="3" class="detail9txt"><b> Open a Dispute: Describe Dispute </b>
                        </font> </td></tr>
                <tr><td><table border="0" align="center" cellpadding="3" cellspacing="0" width="100%" class="table_topless_border" >
                            <?php if($err_flag==1) 
                            {
                            ?>
                            <tr><td style="padding-left:10px"> Please enter your explanation in highlighted fields  below   </td> </tr>
                            <tr><td style="padding-left:10px"> 
                                    <ul type="disc">
                                        <?php 
                                        if($err_reason==1)
                                        {
                                        ?>
                                        <li>
                                            <font color="#FF0000" class="errormsg">
                                            Please select a reason for opening this dispute </font> 
                                        </li>
                                        <?php
                                        }
                                        ?>

                                        <?php 
                                        if($err_payment==1)
                                        {
                                        ?>
                                        <li>
                                            <font color="#FF0000" class="errormsg">
                                            Please select payment gateway.
                                            </font> 
                                        </li>
                                        <?php
                                        }
                                        ?>


                                        <?php 
                                        if($err_dob==1 || $err_month==1 || $err_year==1 || $err_day==1)
                                        {
                                        ?>
                                        <li>
                                            <font color="#FF0000" class="errormsg">
                                            Payment date must be after end of transaction and not greater than current date. 

                                            </font> 
                                        </li>
                                        <?php
                                        }
                                        ?>

                                    </ul> </td> </tr>
                            <?php
                            }
                            ?>
                            <tr>
                                <td style="padding-left:10px" class="banner1">We're sorry that you're having difficulty with this transaction. We've developed the Item Not Received or Significantly Not as Described process to help buyers and sellers resolve their problems through direct communication on <?php echo  $_SESSION[site_name] ?> Web site.   
                                </td>
                            </tr>
                            <tr><td style="padding-left:10px" class="banner1"> 
                                    Open a dispute for the transaction above if you paid for the item but didn't receive it, or you paid for and received the item, but it was significantly different from the item description.   
                                </td></tr>

                            <tr>
                                <td style="padding-left:10px" class="banner1"> The best way to solve transaction problems on <?php echo  $_SESSION[site_name] ?> is direct and open communication between buyers and sellers. There are some instances, however, where a transaction may actually take longer than usual time. </td>
                            </tr>
                            <tr><td style="padding-left:10px" class="banner1"><font class="detail9txt"><b>International Transactions:</b></font> Shipping and customs for international transactions can take time. International bank transfers can also take up to 14 days to complete. Please make sure to ask the seller for an estimate of the shipping time.      </td></tr>
                            <tr><td style="padding-left:10px" class="banner1"><font class="detail9txt"><b> Outdated Contact Information: </b></font> Please verify that your <?php echo  $_SESSION[site_name] ?> email account is updated and working. The seller may actually be trying to contact you but can't because they have the wrong information.  
                                </td></tr>
                            <tr>
                                <td style="padding-left:10px" class="banner1">
                                    If any of these instances apply to your transaction, you may wish to click "Cancel" below and wait for some more days. If you still want to file the dispute on <?php echo  $_SESSION[site_name] ?>, click Continue.  
                                </td>
                            </tr>

                            <tr><td style="padding-left:10px" > <font class="detail9txt"><b> Report an Item not received:</b></font><font class="banner1"> <?php echo  $sell[item_title] ?> (#<?php echo  $bid[item_id] ?>) sold by <?php echo  $user[user_name] ?> on
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
                                    ?>.   </font> </td></tr>
                            <form name="form1" action="open_dispute.php"  method=post>
                                <tr><td style="padding-left:10px"><font class="detail9txt"> <b>
                                            <?php if($err_reason==1) 
                                            {
                                            ?>
                                            <font color="#FF0000">
                                            Please select a reason for opening this dispute </font> 
                                            <?php
                                            }
                                            else
                                            { 
                                            ?> 
                                            Please select a reason for opening this dispute
                                            <?php
                                            }
                                            ?>
                                        </b> </font></td></tr>
                                <tr>
                                    <td style="padding-left:10px"> 
                                        <select name="cboDisputeReason"><option value="0">-- Select One --</option>
                                            <?php
                                            if($_REQUEST[cboDisputeReason]=="I have not received the item")
                                            {
                                            ?>
                                            <option value="I have not received the item" selected="selected">I have not received the item.</option>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                            <option value="I have not received the item">I have not received the item.</option>
                                            <?php
                                            }
                                            ?>
                                            <?php
                                            if($_REQUEST[cboDisputeReason]=="The item I received is significantly different from the item description")
                                            {
                                            ?>
                                            <option value="The item I received is significantly different from the item description">The item I received is significantly different from the item description</option>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                            <option value="The item I received is significantly different from the item description">The item I received is significantly different from the item description</option>
                                            <?php
                                            }
                                            ?>

                                        </select>
                                    </td></tr>
                                <tr><td style="padding-left:10px"><font class="detail9txt">
                                        <b>
                                            <?php if($err_payment==1) { ?>
                                            <font color="#FF0000">
                                            How did you pay for the transaction? </font> 
                                            <?php
                                            }
                                            else
                                            { 
                                            ?> 
                                            How did you pay for the transaction?
                                            <?php
                                            }
                                            ?></b></font>
                                    </td></tr>

                                <tr><td style="padding-left:10px">
                                        <?php
                                        $pay_sql="select * from payment_gateway where status='Yes'";
                                        $pay_res=mysql_query($pay_sql);
                                        ?>
                                        <select name="payment" onChange="pay_refresh()">
                                            <option value="">Select</option>
                                            <?php
                                            while($pay_row=mysql_fetch_array($pay_res))
                                            {
                                            if($pay_row[gateway_id]==$payment)
                                            {
                                            ?>
                                            <option value="<?php echo $pay_row['gateway_id'];?>" selected><?php echo $pay_row[payment_gateway];?> </option>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                            <option value="<?php echo $pay_row['gateway_id'];?>"><?php echo $pay_row[payment_gateway];?> </option>
                                            <?php
                                            }
                                            }
                                            ?>
                                        </select>
                                    </td></tr>

                                <tr><td style="padding-left:10px">
                                        <?php 
                                        if(!empty($err_day) or !empty($err_month) or !empty($err_year) or !empty($err_dob))
                                        {
                                        ?>
                                        <font size=2 color=red><?php echo  $err_email ; ?></font>
                                        <br>
                                        <b><font size=2 color=red class="detail9txt">Payment Date</font></b>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <b><font size=2 class="detail9txt">Payment Date</font></b>
                                        <?php
                                        }
                                        ?>
                                    </td></tr>
                                <tr><td style="padding-left:10px">

                                        <select name=cbomonth>
                                            <option value=0> Month </option>
                                            <?php 
                                            for($i=1;$i<=12;$i++)
                                            {
                                            if($month==$i)
                                            {
                                            ?>
                                            <option value=<?php echo  $i ?> selected > <?php echo  $i ?> </option>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                            <option value=<?php echo  $i ?> > <?php echo  $i ?> </option>
                                            <?php
                                            }
                                            }
                                            ?>
                                        </select> - <select name=cboday>
                                            <option value=0> Day </option>
                                            <?php for($i=1;$i<=31;$i++)
                                            {
                                            if($day==$i)
                                            {
                                            ?>
                                            <option value=<?php echo  $i ?> selected> <?php echo  $i ?> </option>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                            <option value=<?php echo  $i ?> > <?php echo  $i ?> </option>
                                            <?php
                                            }
                                            }
                                            ?>
                                        </select>  -
                                        <input type="text" name="txtYear" style="font-size:12px;font-family:arial;width:40;height:20" maxlength=4 value="<?php echo  $year ?>">
                                    </td>
                                </tr>

                                <input type="hidden" name="bid_id" value=<?php echo  $bid_id ?> />
                                       <input type="hidden" name="flag" value=1 />
                                <tr><td><hr></td></tr>
                                <tr><td style="padding-left:10px"><input type="image" src="images/continue.gif" name="Image71" width="81" height="24" border="0" id="Image71" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image71', '', 'images/continueo.gif', 1)"/>
                                        &nbsp;&nbsp;<a href="myauction.php" class="header_text">Cancel</a> </td></tr>
                            </form>
                        </table></td></tr>
            </table></td></tr>
</table></td></tr>

