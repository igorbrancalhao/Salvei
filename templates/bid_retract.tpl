<?php
/***************************************************************************
*File Name				:bid_retract.tpl
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
                &nbsp;&nbsp;
                &nbsp;&nbsp;Bid Retractions :  </div></font> </td></tr>
    <tr><td colspan="2" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom"  background="images/contentgrad.jpg"> 
            <table cellpadding="5" cellspacing="2"  width=100%> 
                <tr><td class="detail9txt">
                        <form action="bid_retract.php" method="post">
                            <input type="hidden" name="flag" value="RetractBid">
                            <input type="hidden" name="userid" value="">
                            <input type="hidden" name="pass" value=""><p>
                                Item number:
                                <? if($err_flag==1)
                                {
                                ?>
                                <font class="errormsg">The item you requested ( <?= $item_id ?> ) is invalid, still pending, or no longer in our database. . Please check the number and try again. </font>
                                <? 
                                }
                                ?>
                                <br><input type="text" name="ITEM" size="40" value="<?= $item_id ?>" length="32"><br><br>Your explanation about the retraction:<br>
                                <? if($inf_flag==1)
                                {
                                ?>
                                <font class="errormsg">			
                                Please use the pull-down menu and select the reason for retracting your bid.
                                </font>
                                <?
                                }
                                ?>
                                <br>
                                <select name="INFO"><option value="0" selected> Choose one</option>
                                    <option value="Entered wrong amount"> Entered wrong amount</option>
                                    <option value="Seller changed the description of the item"> Seller changed the description of the item</option>
                                    <option value="Cannot contact the seller">Cannot contact the seller</option></select><p>
                                If you have a valid reason not listed above, you can:<br> Contact the seller through ask the seller question to cancel the bid.
                            </p>
                            <blockquote>

                                <input type="image" src="images/retract.gif" name="Image86" width="101" height="21" border="0" id="Image86" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image86', '', 'images/retracto.gif', 1)"/>

                            </blockquote>
                            </p>
                        </form>
                    </td></tr>
            </table></td></tr>
</table>
