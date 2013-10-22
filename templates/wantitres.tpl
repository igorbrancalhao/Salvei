<?php
/***************************************************************************
*File Name				:wantitres.tpl
*File Created				:Wednesday, June 21, 2006
* File Last Modified			:Wednesday, June 21, 2006
* Copyright				:(C) 2001 AJ Square Inc
* Email				:licence@ajsquare.net
* Software Language			:PHP
* Version Created			:V 4.3.2
* Programmers worked	        	:S.Priya, B.ReenaKumari, K.Shanmuga priya
* $Id                                  : memberlist.php,v 1.36.2.12 2006/02/07 20:42:51 grahamje Exp $
*
***************************************************************************/


/****************************************************************************

*      Licence Agreement: 

*     This program is a Commercial licensed software; 
*     you are not authorized to redistribute it and/or modify/and or sell it under any publication 
*     or license /or term it under the GNU General Public License as published by the Free Software Foundation;
*     either user and developer versions of the License, or (at your option) 
*     any later version is applicable for the same.

*****************************************************************************/
if($in_res)
{
?>
<table width="958" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr><td background="images/contentbg1.jpg" height="25">
    <tr><td valign="top"> 
            <table width="958" cellpadding="5" cellspacing="2" background="images/contentgrad.jpg" align="center" border="0" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom">
                <tr height=40>
                    <td><font class="detail9txt"><b>
                            &nbsp;Sell Your Item: Congratulations</b></font></td></tr>
                <tr><td valign="top">
                        <table cellpadding="5" cellspacing="2" align="center" width="900">
                            <tr><td><font size="2" color=green><b>Congratulations, <?php= $_SESSION[username]; ?>! You have responded to a Want It Now post.</b></font></td></tr>
                            <tr><td class="detail9txt"><b> Where would you like to go next? </b>
                                </td></tr>
                            <tr><td>&nbsp;&nbsp;&nbsp;<a href="wantitnowdes.php?item_id=<?php= $item_id ?>" class="detail7txt">View the post you responded to </a></td></tr> 
                            <tr><td>&nbsp;&nbsp;&nbsp;<a href="wantitnow_homepage.php?item_id=<?php= $item_id ?>" class="detail7txt">Want It Now Home Page</a></td></tr> 
                        </table></td></tr>
            </table></td></tr>
</td></tr>
</table>
<?php
require 'include/footer.php';
exit();
}
else
{
?>
<table width="958" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr><td background="images/contentbg1.jpg" height="25">
    <tr><td valign="top"> 
            <table width="958" cellpadding="5" cellspacing="2" background="images/contentgrad.jpg" align="center" border="0" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom">
                <tr>
                    <td width="7" height="23">&nbsp;</td>
                    <td width="188" height="23" nowrap><b><font class="detail9txt">
                            <div align="left">
                                Haven't listed your item?
                            </div></font></b></td>
                    <td colspan="3" align="center" valign="bottom" height="23">&nbsp;</td>
                    <td width="546" height="23" nowrap><b><font class="detail9txt">
                            <div align="left">Already an Item listed on <?php= $_SESSION[site_name]  ?>?</div></font></b></td>
                </tr>
                <tr>
                    <td width="7">&nbsp;</td>
                    <td valign="top" width="188">
                        <form method="post" name="frmsell" action="sell.php">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                <BR>
                                <td valign="top">
                                    <input type="image" src="images/sell.gif" name="Image75" width="98" height="24" border="0" id="Image75" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image75', '', 'images/sello.gif', 1)"/>
                                    <!--<input type="submit" value="Sell Your Item" tabindex="3">--><BR><BR></td>
                                <BR>
                                <BR>

                                </tr>
                            </table>
                        </form>
                    </td>
                    <td width="50">&nbsp;</td>
                    <td width="1" align="center" valign="top" bgcolor="#cccccc"></td>
                    <td width="14">&nbsp;</td>
                    <td>
                        <form method="post" name="form" action="<?php $_SERVER['PHP_SELF']?>">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td valign="top" class="detail9txt">

                                        <BR>
                                        <BR>
                                        Enter the item number of an item that is already listed for sale on <?php= $_SESSION[site_name]  ?>. <br></td>
                                </tr>
                            </table>
                            <?php if(!empty($msg))
                            {
                            ?>
                            <table>
                                <tr>&nbsp;</tr>
                                <tr><td><font size="2" color="red"><b><?php= $msg; ?></b></font></td></tr></table>
                            <?php
                            }
                            ?>
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td valign="top" class="searchresult3txt">
                                        <b>
                                            <?php if($err_flag || $err_flag1 || $err_flag2) 
                                            {
                                            ?>
                                            <font color="red"> Item Number</font>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                            Item Number
                                            <?php
                                            }
                                            ?>
                                        </b>


                                        <br>
                                        <input type="text" name="txtResItem" maxlength="64" tabindex="1"  size="27"><br>
                                        <?php 
                                        if($err_flag) 
                                        {
                                        ?>
                                        <font color="red">
                                        Please Enter a valid Item Number
                                        </font>
                                        <?php
                                        }
                                        ?>
                                        <?php 
                                        if($err_flag1) 
                                        {
                                        ?>
                                        <font color="red">
                                        Please check.Item Id you entered is not a valid Item Number.
                                        </font>
                                        <?php
                                        }
                                        ?>
                                        <?php 
                                        if($err_flag2) 
                                        {
                                        ?>
                                        <font color="red">
                                        Item Id has been already entered
                                        </font>
                                        <?php
                                        }
                                        ?>
                                        <span class="help"></span></td>
                                </tr>
                            </table>
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td colspan="2">&nbsp;</td>
                                </tr>
                                <tr>
                                <input type="hidden" name=mode value="set">
                                <input type="hidden" value="<?php= $item_id; ?>" name="item_id">
                                <td width="35%"><input type="submit"  value="Respond" tabindex="2"></td>
                                </tr>
                            </table>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td width="7">&nbsp;</td>
                    <td colspan="5">&nbsp;
                    </td>
                </tr>
            </table>
        </td></tr></table>
</td></tr></table>
<?php
}
?>