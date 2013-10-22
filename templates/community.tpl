<?php 
/***************************************************************************
*File Name				:community.tpl
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
<div id="bidding1"><table width="958" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td><table width="958" height="25" border="0" cellpadding="0" cellspacing="0" background="images/contentbg.jpg">
                    <tr>
                        <td width="25">&nbsp;</td>
                        <td width="933" class="detail3txt">Community</td>
                    </tr>
                </table></td>
        </tr>
        <tr>
            <td><table  width="958" border="0" align="center" cellpadding="0" cellspacing="0" background="images/contentgrad.jpg" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom">
                    <tr>
                        <td width="670"> </td>
                    </tr>

                    <tr>
                        <td><table width="98%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td height="9"></td>
                                </tr>
                                <tr>
                                    <td><table width="635" height="70" border="0" align="center" cellpadding="0" cellspacing="0" background="images/commbg.gif" style="border:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom">
                                            <form name="sell" action="find_member.php" method="post">
                                                <tr>
                                                    <td width="19" rowspan="2">&nbsp;</td>
                                                    <td width="154"><label>
                                                            <input type="text" name="txtFindid"  />
                                                        </label></td>
                                                    <td width="469">
                                                        <input type="image" src="images/findmember.jpg" name="Image10" width="119" height="23" border="0" id="Image10" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image10', '', 'images/findmembero.jpg', 1)"/></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" class="myauction3txt">Enter the User ID or email address of the member you would like to find.</td>
                                                </tr>
                                        </table></td>
                                </tr>
                                <tr>
                                    <td><table width="98%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td height="8"></td>
                                            </tr>
                                            <tr>
                                                <td width="4%">&nbsp;</td>
                                                <td width="95%" class="categories_fonttype">Welcome to the Feedback Forum</td>
                                                <td width="1%" class="categories_fonttype">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td height="8"></td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td><p align="justify" class="banner1">A feedback forum is a place to view your opinion or to know   about your trading partners in terms of transactions. This is the place that   will allow the registered buyers and sellers to build their reputation in online   trading. The feedback forum provides the users with the ability to comment on   their experiences with an individual </p></td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td height="8"></td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td class="categories_fonttype">How to use the Feedback Forum</td>
                                                <td class="categories_fonttype">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td height="8"></td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td class="banner1">
                                                    Every <?=$sitename_fetch['set_value']?> member has a profile listed in the Feedback Forum. The profile of each member has the basic information and the comments by his/her trading partners related with the previous transaction experiences. The experiences listed in the feedback have volumes to say about the buyer or seller particularly in the field of trust.</td>
                                                <td class="banner1">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td height="8"></td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td class="banner1">The buyer or the seller can rate about the trading partners in terms of transactions in the feedback forum. The Feedback Form consist three ratings about the buyer or seller as positive, negative or neutral with a short comment, and this should be done in a honest manner for the benefit of the other community members. The feedback forum reflects what to expect from the particular member which becomes permanent comment in the profile.</td>
                                                <td class="banner1">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td height="8"></td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td class="categories_fonttype">Feedback scores and stars </td>
                                                <td class="categories_fonttype">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td height="8"></td>
                                            </tr>
                                            <tr>
                                                <td height="134">&nbsp;</td>
                                                <td class="banner1">Each member has rating which determines the scores of the members. The rating goes as add 1 if it is positive rating, subtract 1 if it is negative rating and no impact for neutral rating. If a member has high scores it is due to more positive rankings that they received from other members and a member can increase or decrease another members score by 1 for any number of transactions. The feedback score with the feedback star is displayed next to the members users id. A feedback of score 10 earns a yellow star and as the score increases you earn different color stars. The star next to the member users id reflects the trust and experience in the <?=$sitename_fetch['set_value']?> community.</td>
                                                <td class="banner1">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td height="8"></td>
                                            </tr>
                                        </table></td>
                                </tr>
                            </table></td>
                        <td valign="top" width="286"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td height="8"></td>
                                </tr>
                                <tr>
                                    <td><table width="279" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td><table width="279" height="28" border="0" cellpadding="0" cellspacing="0" background="images/siteannounce.jpg">
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                    </table></td>
                                            </tr>
                                            <tr>
                                                <td><table  background="images/contentgrad.jpg" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom" width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <?
                                                        $whatsnew_sql="select * from whatsnew";
                                                        $whatsnew_res=mysql_query($whatsnew_sql);
                                                        while($row=mysql_fetch_array($whatsnew_res))
                                                        {
                                                        ?>
                                                        <tr>
                                                            <td height="6"></td>
                                                        </tr>
                                                        <tr>
                                                            <td><div align="center"><img src="images/<?= $row[icon] ?>" height="50px" width="50px"/></div></td>
                                                            <td><a href="testing2" class="linksrollovertxt"><a href="<?= $row[link] ?>" class="linksrollovertxt">
                                                                        <?= $row[link_name] ?></a></td>
                                                        </tr>
                                                        <?
                                                        }
                                                        ?>
                                                    </table></td>
                                            </tr>
                                        </table></td>
                                </tr>
                            </table></td>
                    </tr>

                    <tr>
                        <td></td>
                    </tr>

                </table></td>
        </tr>
    </table>
</div>