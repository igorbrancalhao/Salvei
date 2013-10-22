<?php
/***************************************************************************
*File Name				:choose_sell_format.tpl
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
<table width="958" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr><td background="images/contentbg1.jpg" height="25">
            <font class="detail3txt"><div align="left">&nbsp;&nbsp;Sell Your Item: Choose a Selling Format </div></b></font>
        </td></tr> 
    <tr><td valign="top" > 
            <table width="958" cellpadding="5" cellspacing="2"  background="images/contentgrad.jpg" align="center" border="0" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom">
                <tr><td valign="top" >
                        <table width="100%" align="center" cellpadding="10" cellspacing="0" border=0>
                            <form name="sell" action="sell_item_cate.php" method="post">
                                <tr class="detail9txt"><td>
                                        <input type="radio" value="1" name="sell_format" checked> <b> Sell item at online Auction</b>
                                        <br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Allows bidding on your item.<a href="#" onclick="window.open('auction_help.php?help=1', 'pop_up', 'toolbar=no, top=0,location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, width=400, height=400')" class="header_text"> Learn more</a>. 
                                    </td></tr>
                                <tr class="detail9txt"><td>
                                        <input type="radio" value="2" name="sell_format"> <b> Sell item at Dutch Auction</b>
                                        <br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Allows bidding on your items.<a href="#" onclick="window.open('auction_help.php?help=2', 'pop_up', 'toolbar=no, top=0,location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, width=400, height=400')" class="header_text"> Learn more</a>. 
                                    </td></tr> 
                                <tr class="detail9txt"><td>
                                        <input type="radio" value="3" name="sell_format"> <b>Fixed Price Sale</b>
                                        <br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Allows buyers to purchase your item 
                                        at a price you set.You can list your asking price. No bidding takes 
                                        place. <a href="#" onclick="window.open('auction_help.php?help=3', 'pop_up', 'toolbar=no, top=0,location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, width=400, height=400')" class="header_text"> Learn 
                                            more</a>. </td>
                                </tr>
                                <? /*  if($mem_rows[member_account]!=1)
                                { */ ?>
                                <tr class="detail9txt"><td>
                                        <input type="radio" value="4" name="sell_format"> <b>Classified Ads</b>
                                        <br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Allows advertising on your Item .<a href="#" onclick="window.open('auction_help.php?help=4', 'pop_up', 'toolbar=no, top=0,location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, width=400, height=400')" class="header_text"> Learn 
                                            more</a>. </td>
                                </tr>

                                <!--<tr><td> <hr> </td></tr>-->
                                <tr align="center"><td>
                                        <input type="hidden" value="<?= $mode; ?>" name="mode">
                                        <input type="image" src="images/continue.gif" name="Image71" width="81" height="24" border="0" id="Image71" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image71', '', 'images/continueo.gif', 1)"/>
                                    </td></tr>
                            </form>
                        </table>
                    </td></tr>
            </table>
        </td></tr>
</table>
</td></tr>