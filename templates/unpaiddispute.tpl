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
                                <td><font size="3" class="detail9txt"><b>Report an Unpaid Item Dispute </b>
                                    </font> </td></tr>
                            <tr><td style="padding-left:5px"><font class="detail9txt"> <b>Transaction:</b></font><font class="banner1"> <?php echo  $sell[item_title] ?> (#<?php echo  $bid[item_id] ?>) sold by <?php echo  $user[user_name] ?> on
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
                                    ?>.  </font>  </td></tr>
                            <tr><td style="padding-left:5px" class="detail9txt">Use this form to:     </td></tr>
                            <tr><td style="padding-left:5px" class="banner1"> <ul type="disc" style="line-height:normal"><li >Report an Unpaid Item dispute: <?php echo  $_SESSION[site_name]  ?> will send an Unpaid Item reminder to your buyer, encouraging them to complete the transaction. If the buyer still does not pay, you can use this form to file for a Final Value Fee credit.</li>  <li>
                                            Request a Final Value Fee credit for returned item or uncompleted transaction: If you and the buyer have resolved the dispute (for example, the buyer has returned the item, or you and the buyer have mutually agreed not to complete the transaction).</li></ul> </td></tr>
                            <tr><td style="padding-left:5px" class="detail9txt"><b>Please note:</b>   </td></tr>
                            <tr><td style="padding-left:5px" class="banner1"><ul type="disc" style="line-height:normal"><li > Only transactions with a winning buyer are eligible for a Final Value Fee credit.   </li> <li>Some disputes can be reported immediately after the item closes, but most require a <?php echo  $admin_row[set_value] ?> day waiting period. You cannot report a dispute if more than <?php echo  $elasped_row[set_value] ?> days have elapsed. </li></ul>   </td></tr>
                            <tr><td style="padding-left:5px" class="banner1">  If you meet these conditions, please fill in the item number below and click <b> Continue </b> to report an Unpaid Item dispute. </td></tr>

                            <tr><td style="padding-left:10px" class="detail9txt"><b> Item number </b> </td></tr>

                            <form name="form1" action="report_unpaid_dispute.php"  method=post>
                                <tr>
                                    <td style="padding-left:10px"> 
                                        <input type="text" name="txtitemnumber" value=<?php echo  $bid[item_id] ?> disabled="disabled">
                                               <input type="hidden" name="bid_id" value=<?php echo  $bid_id ?> />
                                    </td></tr>
                                <tr><td style="padding-left:10px"><input type="image" src="images/continue.gif" name="Image71" width="81" height="24" border="0" id="Image71" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image71', '', 'images/continueo.gif', 1)"/> </td></tr>
                            </form>
                        </table></td></tr></table>
        </td></tr></table>