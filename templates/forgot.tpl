<?php
/***************************************************************************
*File Name				:forgot.tpl
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
                &nbsp;&nbsp;Personal Information:: Forgot Password 
                &nbsp;&nbsp;</div></font></td>
    </tr> 
    <tr><td colspan="2" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom"  background="images/contentgrad.jpg"> 
            <table cellpadding="5" cellspacing="2"  width=100%> 
                <form name="frmPasswordhelp" action="forgot.php" method="post" onSubmit="this.canSend.value = 1;
                        return true">
                    <tr>
                        <td colspan="2" class="detail9txt"><div align="justify" style="line-height:15pt"><center>Just enter the Email Id given during registration.Your Password will be sent to your Email Address</center></div></td>
                    </tr>
                    <?php
                    if($status == 2)
                    {
                    echo "<tr><td colspan=2 align=center><font class='errormsg'><b>Please check your Email Id</b></font></td></tr>";
                    }
                    ?>
                    <?php
                    if($status == 1)
                    {
                    echo "<tr><td colspan=2 align=center><font class='errormsg'><b> $sent_message </b></font></td></tr>";
                    }
                    ?>
                    <tr>
                        <td width="45%" align="right"><font class="detail9txt">Email Id</font></td>
                        <td width="55%"><input type="text" name="txtEmail" class="txtbig"></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"> <input type=hidden name=canSend value=0>

                            <input type="image" src="images/sendmypassword.gif" name="Image90" width="151" height="22" border="0" id="Image90" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image90', '', 'images/sendmypasswordo.gif', 1)" value="Send My Password"/>
                        </td> </tr>
                </form>

            </table>
        </td></tr>
</table>
