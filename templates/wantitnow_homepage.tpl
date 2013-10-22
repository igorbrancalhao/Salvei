<?php
/***************************************************************************
*File Name				:wantitnow_homepage.tpl
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
<table cellpadding="0" cellspacing="0" width="958" align="center">
    <tr><td>
            <table width="958" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td><img src="images/header.jpg" width="955" height="56"></td>
                </tr>
                <tr><td><table cellpadding="0" cellspacing="0" width="958" align="center" >
                            <tr>
                                <td><table width="616" height="142" border="0" cellpadding="0" cellspacing="0" >
                                        <tr>
                                            <td width="44">&nbsp;</td>
                                            <td width="228">
                                                <table width="206" height="112" border="0" align="left" cellpadding="0" cellspacing="0" background="images/buy_bx.jpg">
                                                    <tr>
                                                        <td colspan="3">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3" style="padding-left:3px" class="banner1">Create a Want It Now Post and tell Millions of Sellers what you want? </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="40">&nbsp;</td>
                                                    <form name="wantitnow_frm" action="wantitnow.php">
                                                        <td width="125"><input type=image src="images/post.jpg" alt="" width="120" height="23"></td>
                                                    </form>
                                                    <td width="41">&nbsp;</td>
                                        </tr>
                                    </table></td>
                                <td width="206"><table width="206" height="112" border="0" cellpadding="0" cellspacing="0" background="images/sell_bx.jpg">
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td style="padding-left:5px" class="banner1">Browse Want it Now and find out what buyers want it now.</td>
                                        </tr>
                                        <tr>
                                            <td style="padding-left:5px" class="banner1">Find more buyers for your items. </td>
                                        </tr>
                                    </table></td>
                                <td width="138" bgcolor="#F8F8F8">&nbsp;</td>
                            </tr>
                        </table></td>
                </tr>
                <tr><td>
                        <table cellpadding="0" cellspacing="0" width=958 border="0">
                            <tr>
                                <td background="images/contentbg1.jpg" colspan=2 height="25">
                                    <font class="detail3txt"><div align="left">&nbsp;&nbsp;
                                        &nbsp;&nbsp;Browse Want It Now</div></font>
                                </td></tr>
                            <tr><td valign="top"> 
                                    <table width="958" cellpadding="0" cellspacing="0" background="images/contentgrad.jpg" align="center" border="0" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom">
                                        <tr>
                                            <td width="45%"  valign="top">
                                                <table width=50%><tr><td valign="top">
                                                            <?php   while($rec=mysql_fetch_array($res))
                                                            { 
                                                            $count=$count+1;

                                                            $ssid=$rec[category_id];
                                                            $_SESSION[catt]=" ";
                                                            if($ssid)
                                                            {
                                                            $cat="category_id=$ssid or category_id= ";
                                                            $_SESSION[catt]=$cat;
                                                            cat_display($ssid,$cat);
                                                            $cat=$_SESSION[catt];
                                                            }
                                                            $cat=rtrim($cat," or category_id=");

                                                            $count_item_sql="select * from placing_item_bid where selling_method=\"want_it_now\" and ($cat) and status='Active' and bid_starting_date <= now() and expire_date>=now()";
                                                            $count_item_res=mysql_query($count_item_sql);
                                                            $count_item_total=mysql_num_rows($count_item_res); 



                                                            ?>

                                                    <tr><td class="detail9txt"><a href="wantitnow_browse.php?cate_id=<?php=$rec[category_id]; ?>&view=list" class="header_text"><?php=$rec[category_name]; ?></a>&nbsp; ( <?php= $count_item_total ?> ) </td></tr>

                                                    <?php if($count == $first_part)
                                                    {
                                                    ?>
                                                </table>
                                            </td>
                                            <td width="65%" valign="top">
                                                <table ><tr><td  valign="top">
                                                            <?php
                                                            }
                                                            } 
                                                            ?>

                                                </table></td></tr>

                                    </table></td></tr>
                        </table></td></tr>
            </table></td></tr>
</table></td></tr>
</table>



