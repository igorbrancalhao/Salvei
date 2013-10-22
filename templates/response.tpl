<?php
/***************************************************************************
*File Name				:response.tpl
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
<table width="960" cellpadding="0" cellspacing="0" border=0 align="center">
    <tr width=100>
        <td width="960" height="25" colspan=2 background="images/contentbg1.jpg">
            <font class="detail3txt">
            <div align="left">
                &nbsp;&nbsp;My Messages: Reply To Member</div> </b></font> </td></tr>
    <tr><td colspan="2" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom"  background="images/contentgrad.jpg"> 
            <table cellpadding="5" cellspacing="2"  width=100%> 
                <form name=form1 action="response.php" method=post>
                    <?php 
                    if(!empty($msg))
                    {
                    ?>
                    <tr><td align="center">
                            <br>
                            <br>
                            <br>
                            <font size="2" color="red"><?php= $msg; ?></font>
                            <br>
                            <br>
                            <br>
                        </td></tr>
                    <?php
                    }
                    ?>
                    <tr><td>
                            <table cellSpacing="0" cellPadding="10" border="0" align="center"  >
                                <tr><td align="right" colspan=2 > <font class="errormsg">Fields marked with an asterisk (*) are required</font></td></tr>

                                <?php if($err_flag==1)
                                { 
                                ?>
                                <tr><td colspan="2">
                                        <table cellpadding="0" cellspacing="0" width=600 align=center ><tr><td >
                                                    <img src="images/warning_39x35.gif"></td>
                                                <td><font class="errormsg">The following must be corrected before continuing:</font></td>
                                            </tr>
                                            <?php if(!empty($err_response))
                                            {
                                            ?>
                                            <tr><td>&nbsp;</td><td class="detail9txt"><a href="response.php#message" class="header_text">Enter Your Response</a> - <?php= $err_response; ?></td></tr>
                                            <?php 
                                            }
                                            ?>
                                        </table>
                                    </td></tr>
                                <?php
                                }
                                ?>

                                <tr>
                                    <td width="12%" nowrap class="detail9txt"><b>To:&nbsp;&nbsp;&nbsp;</b></td>
                                    <td width="88%" align="left" class="banner1"><?php= $user_from;?></td>
                                </tr>
                                <tr>
                                    <td nowrap width="12%" class="detail9txt"><b> Item:&nbsp;&nbsp;&nbsp;</b></td>
                                    <td align="left" class="banner1"><?php= $rec[item_title];?> </td>
                                </tr>
                                <tr>
                                    <td nowrap  valign="top" width="12%" class="detail9txt"><b>Subject:</b></td>
                                    <td class="banner1">Message From <?php= $_SESSION[username] ?> 
                                    </td>
                                </tr>
                                <tr>
                                    <td nowrap  valign="top" width="12%" class="detail9txt"><b>Question:</b></td>
                                    <td class="banner1"><?php= $message ?> 
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="detail9txt">
                                        <b>Enter your Response:</b>
                                        <font color="#FF0000">*</font><br />
                                        <textarea name="message" rows="4" cols="50"></textarea><br />
                                        <font color="#999999">No HTML, asterisks, or quotes.</font>
                                    </td></tr>
                            </table>
                    <tr><td>
                            <table align="center"><tr><td align="center">
                                        <input type=hidden name=canSend value=1>
                                        <input type="hidden" name="item_id" value=<?php= $item_id; ?> >
                                               <input type="hidden" name="to_id" value=<?php= $ask_row[from_id]; ?> >
                                               <input type="hidden" name="qst_id" value=<?php= $qst_id ?> >
                                               <input type="image" src="images/send.gif" name="Image77" width="62" height="22" border="0" id="Image77" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image77', '', 'images/sendo.gif', 1)"/></td></tr>
                            </table>
                </form>
            </table></td></tr>
</table>