<?php
/***************************************************************************
*File Name				:transaction.tpl
*File Created			:Wednesday, June 21, 2006
* File Last Modified	:Wednesday, June 21, 2006
* Copyright			:(C) 2001 AJ Square Inc
* Email				:licence@ajsquare.net
* Software Language	:PHP
* Version Created		:V 4.3.2
* Programmers worked	:S.Priya, B.ReenaKumari, K.Shanmuga priya
* Modified By			:B.Reena
* $Id                  : memberlist.php,v 1.36.2.12 2006/02/07 20:42:51 grahamje Exp $
* ***************************************************************************/


/****************************************************************************

*      Licence Agreement: 

*     This program is a Commercial licensed software; 
*     you are not authorized to redistribute it and/or modify/and or sell it under any publication 
*     or license /or term it under the GNU General Public License as published by the Free Software Foundation;
*     either user and developer versions of the License, or (at your option) 
*     any later version is applicable for the same.

*****************************************************************************/
?>
<table width="100%" align="center" cellpadding="0" cellspacing="10">
    <tr><td>
            <table width="958" align="center" cellpadding="4" cellspacing="0">
                <tr>
                    <td colspan="3" background="images/contentbg.jpg" height=25>
                        <font size="3"><b><div align="left">&nbsp;&nbsp;Transactions</div></b></font>
                    </td></tr>
                <tr>
                    <td valign="top">
                        <table cellpadding="0" cellspacing="0">
                            <tr align="center" height=35>
                                <td width=2>
                                    <?php require'include/my_list.php'; ?>
                                </td></tr></table></td>
                    <td valign="top" >
                        <table valign="top" cellspacing="0" cellpadding="0">
                            <tr><td width="800" colspan="3">
                                    <table width="100%" cellpadding="0" cellspacing="0">
                                        <tr><td height=30 width="100%" id="paydetails" colspan="3">
                                                <table cellpadding="5" cellspacing="0" width="100%">
                                                    <tr>
                                                        <td align="left" class="detail9txt">
                                                            <div class="myauction_bg">
                                                                <b>&nbsp;&nbsp;Viewing Transactions Details : &nbsp;&nbsp;</b>(<?php echo  $pay_total_records; ?>&nbsp; Records)</b></div></td>
                                                        <!--<td align="right" width=10>
                                                        <a href="myauction.php?#paydetails">
                                                        <img src="images/leasing-arrows-up.gif" border=0></a></td>
                                                        <td align="right" width=10  >
                                                        <a href="myauction.php?#didntwindetails">
                                                        <img src="images/leasing-arrows-dn.gif" border=0>
                                                        </a></td>-->
                                                    </tr></table>
                                            </td></tr>
                                        <tr>
                                            <td >
                                                <table cellspacing="0" cellpadding="5" width="550">
                                                    <?php
                                                    if($pay_total_records > 0)
                                                    { 
                                                    ?>
                                                    <form name="pay_frm" action="pay.php" method=post>
                                                        <tr class="detail9txt">
                                                            <td class="tr_botborder">&nbsp;</td> 
                                                            <td class="tr_botborder"><b>Transaction Id</b> </td>
                                                            <td class="tr_botborder"><b>Item Id</b> </td>
                                                            <td class="tr_botborder" colspan=2><b>Date</b> </td>
                                                            <td class="tr_botborder" colspan="2"><b>Batch Number</b>  </td>
                                                            <td class="tr_botborder" colspan="3"><b>Amount</b>  </td>
                                                        </tr>
                                                        <?php
                                                        $pay_res=mysql_query($pay_sql);
                                                        while($pay_row=mysql_fetch_array($pay_res))
                                                        {

                                                        $sql_user1="select * from placing_item_bid where item_id=".$pay_row['itemid'];
                                                        $res_user1=mysql_query($sql_user1);
                                                        $row1=mysql_fetch_array($res_user1);


                                                        if($trans_type=='buyitem')
                                                        $currency=$row1['currency'];
                                                        else
                                                        $currency=$default_cur;
                                                        // seller information
                                                        ?>
                                                        <tr class="detail9txt">
                                                            <td class="tr_botborder" ><?php echo $pay_row[trans_type]?></td>
                                                            <td class="tr_botborder" >
                                                                <?php echo $pay_row['pay_id'];?>
                                                            </td>
                                                            <td class="tr_botborder"><?php  echo $pay_row['itemid']; ?> </td>
                                                            <td class="tr_botborder" colspan="2" ><?php  echo $pay_row[trans_date]; ?> </td>
                                                            <td class="tr_botborder" colspan="2" ><?php  echo $pay_row['trans_batchnumber']; ?> </td>
                                                            <td class="tr_botborder"><?php echo $currency?> <?php  echo $pay_row['trans_amount']; ?> </td>
                                                        </tr>
                                                        <?php
                                                        } // while
                                                        ?>
                                                        <input type="hidden" name="pay_delete" />
                                                        <input type="hidden" name="seller_id"  />
                                                        <input type="hidden" name="item_id"  />
                                                        <tr>
                                                            <td colspan="8" class=tr_botborder> <!-- 
                                                            <input type="button" value=Delete name="conf" onClick="del()" class=buttonbig> -->
                                                            </td>
                                                        </tr>
                                                    </form>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                    <tr>
                                                        <td class="tr_botborder" colspan=8 align="left">
                                                            You do not have any transaction details to display at this time. 
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </table>
                                            </td></tr>
                                    </table>
                                </td></tr>
                        </table></td>
                    <td valign="top">
                        <?php
                        require 'templates/right_menu.tpl';
                        ?>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<?php 
require 'include/footer.php';					
?>


