<?php
/***************************************************************************
*File Name				:alert_detail.tpl
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
<table width="958" cellpadding="5" cellspacing="0" align="center" >
    <tr><td background="images/contentbg.jpg" colspan="3">
            <font size="3"><b><div align="left">&nbsp;&nbsp;Alert Detail</div></b></font></td></tr>
    <tr>
    <tr>
        <td valign="top" width="2">
            <? require 'include/my_list.php'; ?>
        </td>
        <td valign="top" width="70%">
            <table align="center" cellpadding="5" cellspacing="0" width="550" bgcolor="#E8E8E8">
                <tr>
                    <td width="684" background="images/item_bg.gif" colspan="3">
                        <font size="3"><b><div align="left">&nbsp;&nbsp;Alert</div></b></font>
                    </td>
                </tr>
                <? if($type=="sell")
                {
                ?>
                <tr><td><table width="100%" align="center" bgcolor="#E8E8E8">
                            <tr><td class="detail9txt">
                                    <b>Subject:</b>&nbsp;<?= $_SESSION[site_name]  ?> Selling Item Reminder: #<?= $item_id;?></td></tr>
                            <tr><td class="detail9txt">
                                    <b>From:</b>&nbsp;<?= $_SESSION[site_name]  ?></td></tr>
                            <tr><td class="detail9txt"><b>Item_Id:</b>&nbsp;<a href="detail.php?item_id=<? echo $item_id; ?>"><?= $item_id; ?></a></td></tr>
                            <tr><td class="detail9txt">

                                    Dear <?= $_SESSION[username]; ?>:<br>
                                </td></tr>
                            <tr>
                                <td class="detail9txt">
                                    <?= $user_record[user_name]; ?> has bidded/bought the following item: 
                                    <?= $record[item_title]; ?>(# <?= $item_id; ?>).See your myauction account for further process.
                                    Till now no action is being taken at this time.</td></tr>
                            <tr><td class="detail9txt">
                                    <br>
                                    Regards,<br>
                                    <?= $_SESSION[site_name]  ?>
                                </td></tr>
                        </table>
                    </td></tr>
                <?
                }
                else 
                {
                $seller_sql="select * from user_registration where user_id=$seller_id"; 
                $seller_recordset=mysql_query($seller_sql);
                $seller_record=mysql_fetch_array($seller_recordset);

                ?>
                <tr bgcolor="#E8E8E8"><td class="detail9txt">
                        <b>Subject:</b>&nbsp;<?= $_SESSION[site_name]  ?> Unpaid Item Reminder: #<?= $item_id;?></td></tr>
                <tr bgcolor="#E8E8E8"><td class="detail9txt">
                        <b>From:</b>&nbsp;<?= $_SESSION[site_name]  ?></td></tr>
                <tr bgcolor="#E8E8E8"><td class="detail9txt">
                        <b>Item_Id:</b>&nbsp;<a href="detail.php?item_id=<? echo $item_id; ?>" class="header_text"><?= $item_id; ?></a></td></tr>

                <tr><td>
                        <table width="100%" align="center" bgcolor="#E8E8E8">
                            <tr><td class="detail9txt">
                                    Dear <?= $_SESSION[username]; ?>:<br>
                                    <br></td></tr>
                            <tr align=center>
                                <td class="detail9txt">
                                    <?=$seller_record[user_name];?> has informed us that they have not yet received your payment for the following item: 
                                    <?= $record[item_title]; ?>(# <?= $item_id; ?>)
                                    No action is being taken against your account at this time</td></tr>
                            <tr align="right"><td class="detail9txt"> 
                                    <br>
                                    Regards,<br>
                                    <?= $_SESSION[site_name]  ?>
                                </td></tr>
                        </table>
                    </td></tr>
                <?
                }
                ?>
            </table>


        </td>
        <td valign="top">
            <?
            require 'templates/right_menu.tpl';
            ?>
        </td>
    </tr>
</table>
