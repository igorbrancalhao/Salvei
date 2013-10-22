<?php 
/***************************************************************************
*File Name				:reportitemnotreceived.php
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
                &nbsp;&nbsp;Report an Unpaid Item </div></font></td>
    <tr><td colspan="2" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom"  background="images/contentgrad.jpg"> 
            <table cellpadding="5" cellspacing="2"  width=100%> 
                <tr height=30>
                    <td><font size="3" class="detail9txt"><b>Item not Received </b>
                        </font> </td></tr>
                <tr><td><table border=0 align="center" cellpadding="0" cellspacing="3" width="100%">
                            <tr><td style="padding-left:5px"> <font class="detail9txt"><b>Transaction:</b></font><font class="banner1"> <?php echo  $sell[item_title] ?> (#<?php echo  $bid[item_id] ?>) sold by <?php echo  $user[user_name] ?> on
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
                                    ?>.</font>    </td></tr>
                            <tr><td style="padding-left:5px" class="banner1">Use this process when:     </td></tr>
                            <tr><td style="padding-left:5px" class="banner1"> <ul type="disc" style="line-height:normal"><li >You paid for an item but didn't receive it, or  </li>  <li>
                                            You paid and received an item, but it was significantly different from the item description.</li></ul> </td></tr>
                            <tr><td style="padding-left:5px" class="detail9txt"><b>Please note:</b>   </td></tr>
                            <tr><td style="padding-left:5px" class="banner1"><ul type="disc" style="line-height:normal">
                                        <li > Review the item listing carefully. </li> 
                                        <li>Email and call your seller. </li>
                                        <li>Ensure <?php echo  $_SESSION[site_name] ?> has your correct contact information. </li>
                                        <li>Check your spam filter for missed emails.  </li>
                                    </ul>   </td></tr>
                            <tr><td style="padding-left:5px" class="banner1">  If you meet these conditions, Click <b> Continue </b> to to get started. </td></tr>

                            <tr><td style="padding-left:10px" class="detail9txt"><b> Item number </b> </td></tr>

                            <form name="form1" action="open_dispute.php"  method=post>
                                <tr>
                                    <td style="padding-left:10px"> 
                                        <input type="text" name="txtitemnumber" value=<?php echo  $bid[item_id] ?> disabled="disabled">
                                               <input type="hidden" name="bid_id" value=<?php echo  $bid_id ?> />
                                    </td></tr>
                                <tr><td style="padding-left:10px">
                                        <input type="image" src="images/continue.gif" name="Image71" width="81" height="24" border="0" id="Image71" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image71', '', 'images/continueo.gif', 1)"/>
                                    </td></tr>
                            </form>
                        </table></td></tr>
            </table></td></tr>
</table>

