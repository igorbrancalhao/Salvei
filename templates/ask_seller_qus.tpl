<?php
/***************************************************************************
*File Name				:ask_seller_qus.tpl
*File Created			:Wednesday, June 21, 2006
* File Last Modified	:Wednesday, June 21, 2006
* Copyright			:(C) 2001 AJ Square Inc
* Email				:licence@ajsquare.net
* Software Language	:PHP
* Version Created		:V 4.3.2
* Programmers worked	:S.Priya, B.ReenaKumari, K.Shanmuga priya
* Modified By			:B.Reena
* $Id                  :memberlist.php,v 1.36.2.12 2006/02/07 20:42:51 grahamje Exp $
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
                &nbsp;&nbsp;Ask a Question</div> </b></font></td></tr>
    <tr><td colspan="2" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom"  background="images/contentgrad.jpg"> 
            <table cellpadding="5" cellspacing="2"  width=100%> 
                <tr><td>
                <tr><td><br /></td></tr>
                <tr>
                    <td valign="top" >

                        <? 
                        if(!empty($msg))
                        {
                        $sql_chk_item="select * from placing_item_bid where item_id=".$item_id;
                        $sqlqry_chk_item=mysql_query($sql_chk_item);
                        $sqlfetch_item=mysql_fetch_array($sqlqry_chk_item);
                        $sell_method=$sqlfetch_item['selling_method'];

                        ?>
                <tr><td align="center">
                        <br>
                        <font class="errormsg"><?= $msg; ?></font>
                        <br>
                        <?
                        if($sell_method=='ads')
                        {
                        ?>
                        <a href="classifide_ad.php?item_id=<?=$item_id?>" class="header_text">Back To Item Page</a>
                        <?
                        }
                        else if($sell_method=='want_it_now')
                        {
                        ?>
                        <a href="wantitnowdes.php?item_id=<?=$item_id?>" class="header_text">Back To Item Page</a>
                        <?
                        }
                        else
                        {
                        ?>
                        <a href="detail.php?item_id=<?=$item_id?>" class="header_text">Back To Item Page</a>
                        <?
                        }
                        ?>
                        <br>
                        <br>
                        <br>
                    </td></tr>
            </table></td></tr>
</table>
<? require 'include/footer.php'; 
exit();
}
?>

<? if($err_flag==1)
{ 
?>
<tr><td>
        <table cellpadding="0" cellspacing="0" width=600 align=center ><tr><td >
                    <img src="images/warning_39x35.gif"></td>
                <td><font class="errormsg">The following must be corrected before continuing:</font></td>
            </tr>
            <? if(!empty($err_subject))
            {
            ?>
            <tr><td>&nbsp;</td><td class="detail9txt"><a href="ask_seller_qus.php#messagetype" class="header_text">Enter your subject</a> - <?= $err_subject; ?></td></tr>
            <? 
            }
            ?>
            <? if(!empty($err_message))
            {
            ?>
            <tr><td>&nbsp;</td><td class="detail9txt"><a href="ask_seller_qus.php#message" class="header_text">Enter your question</a> - <?= $err_message; ?></td></tr>
            <? 
            }
            ?>
        </table>
    </td></tr>
<?
}
?>

<tr><td align="right" width=900><font class="errormsg">Fields marked with an asterisk (*) are required</font></td></tr>
<tr><td>
        <table cellSpacing="0" cellPadding="10" border="0" align="center"  width="70%">
            <tr>
                <td nowrap colspan="2" class="banner1"><font class="detail9txt"><b>To:&nbsp;&nbsp;&nbsp;</b></font><?= $user_rec[user_name];?></td>
            </tr>
            <tr>
                <td nowrap colspan="2" class="banner1"><font class="detail9txt"><b> Item:&nbsp;&nbsp;&nbsp;</b></font><?= $rec[item_title];?></td>
            </tr>
            <form name=form1 action="ask_seller_qus.php" method=post>
                <tr>
                    <td nowrap  valign="top" class="detail9txt"><b>Subject:</b><br>
                        <?
                        if($type=='w')
                        {
                        ?>
                        <input type="text" name="messagetype" value="<?=$subject?>" style="width:220px"/>
                        <?
                        }
                        else
                        {
                        ?>
                        <select name="messagetype">
                            <option value="General question about this item" <?if($subject=="General question about this item") echo "selected=selected";?>>General question</option>
                            <option value="Question about shipping for this item" <?if($subject=="Question about shipping for this item") echo "selected=selected";?>>Question about shipment</option>
                            <option value="Question about how to pay for this item" <?if($subject=="Question about how to pay for this item") echo "selected=selected";?>>Question about payment</option>
                            <option value="Question about combined shipping for multiple items" <?if($subject=="Question about combined shipping for multiple items") echo "selected=selected";?>>Question about combined shipping for multiple items</option></select></b>
                        <?
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td><font class="detail9txt"><b>Enter your question: </b></font><font color="#FF0000">*</font></b><br>
                        <textarea name="message" rows="4" cols="50"><?=$question?></textarea></td></tr>

                <tr><td>
                        <table align="center"><tr><td align="center">
                                    <input type=hidden name=canSend value=1>
                                    <input type=hidden name=type value="<?=$type?>"/>
                                    <input type="hidden" name="item_id" value="<?= $item_id;?>">
                                    <input type="hidden" name="to_id" value="<?= $rec[user_id];?>">
                                    <input type="image" src="images/send.gif" name="Image77" width="62" height="22" border="0" id="Image77" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image77', '', 'images/sendo.gif', 1)"/>
                                </td></tr>
                        </table>
            </form>
        </table>
    </td></tr>
</table></td></tr>
</table>