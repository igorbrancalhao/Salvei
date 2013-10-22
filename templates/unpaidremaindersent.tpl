<?php
/***************************************************************************
*File Name				:unpaidremaindersent.php
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
                                <td><font size="3" class="detail9txt"><b>Unpaid Item Reminder Sent </b>
                                    </font> </td></tr>
                            <tr><td style="padding-left:10px" class="banner1">An unpaid item reminder has been sent to <a href="feedback.php?user_id=<?php echo  $user[user_id] ?>" class="header_text"><?php echo  $user[user_name] ?></a> for the following item:<?php echo  $sell[item_title] ?> (#<?php echo  $bid[item_id] ?>) 
                                </td></tr>
                            <tr>
                                <td style="padding-left:10px" class="detail9txt">Unpaid Item Policy </td>
                            </tr> 
                            <tr><td style="padding-left:10px" class="banner1"> You will need to take additional action before your Final Value Fee is credited. If the buyer does not respond, you will be eligible to receive a Final Value Fee credit  <?php echo  $admin_row[set_value] ?> days after this reminder is sent. Learn about this process in <?php echo  $_SESSION[site_name]  ?>'s Unpaid Item Policy.</td></tr>
                            <tr><td style="padding-left:10px"> </td></tr>

                            <tr><td><hr></td></tr>

                            <tr><td style="padding-left:10px" class="detail9txt"> <b> Where would you like to go? </b></td></tr>
                            <tr><td style="padding-left:20px"> <a href="viewdispute.php?type=unpaid" class="header_text">View Dispute Console</a></td></tr>
                            <tr><td style="padding-left:20px"> <a href="myauction.php" class="header_text">My Auction</a></td></tr>
                        </table></td></tr>
            </table></td></tr>
</table>

