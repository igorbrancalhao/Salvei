<?php
/***************************************************************************
*File Name				:sitemap.tpl
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
                        <td width="933" class="detail3txt">Sitemap</td>
                    </tr>
                </table></td>
        </tr>
        <tr>
            <td><table  width="958" border="0" align="center" cellpadding="0" cellspacing="0" background="images/contentgrad.jpg" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom">
                    <tr>
                        <td width="670"> </td>
                    </tr>
                    <tr>
                        <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
                                            <tr>
                                                <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td height="4"></td>
                                                        </tr>
                                                        <tr>
                                                            <td><table width="231" border="0" align="center" cellpadding="0" cellspacing="0">
                                                                    <tr>
                                                                        <td><table width="231" height="24" border="0" cellpadding="0" cellspacing="0" background="images/sitegrad.jpg">
                                                                                <tr>
                                                                                    <td width="20">&nbsp;</td>
                                                                                    <td width="211" class="detail3txt">Buy</td>
                                                                                </tr>
                                                                            </table></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><table width="100%" height="50" border="0" cellpadding="0" cellspacing="0" background="images/contentgrad.jpg" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom">
                                                                                <tr>
                                                                                    <td width="20%"><div align="center"><img src="images/site1.jpg" alt="" width="6" height="7" /></div></td>
                                                                                    <td width="80%" class="sitemaptxt"><a href="browse_cate.php" class="sitemaptxt">Buy</a></td>
                                                                                </tr>

                                                                                <tr>
                                                                                    <td><div align="center"><img src="images/site1.jpg" alt="" width="6" height="7" /></div></td>
                                                                                    <td class="sitemaptxt"><a href="help.php#answer4" class="sitemaptxt">Learn How to Buy </a></td>
                                                                                </tr>
                                                                            </table></td>
                                                                    </tr>
                                                                </table></td>
                                                        </tr>
                                                        <tr>
                                                            <td height="7"></td>
                                                        </tr>
                                                        <tr>
                                                            <td><table width="231" border="0" align="center" cellpadding="0" cellspacing="0">
                                                                    <tr>
                                                                        <td><table width="231" height="24" border="0" cellpadding="0" cellspacing="0" background="images/sitegrad.jpg">
                                                                                <tr>
                                                                                    <td width="19">&nbsp;</td>
                                                                                    <td width="212" class="detail3txt">Categories</td>
                                                                                </tr>
                                                                            </table></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><table width="100%" height="500" border="0" cellpadding="0" cellspacing="0" background="images/contentgrad.jpg" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom">
                                                                                <?php $sql="select * from category_master where category_head_id=0 order by category_name"; 
                                                                                $res=mysql_query($sql);
                                                                                while($cat_row=mysql_fetch_array($res))
                                                                                {
                                                                                ?>
                                                                                <tr>
                                                                                    <td width="20%"><div align="center"><img src="images/site1.jpg" alt="" width="6" height="7" /></div></td>
                                                                                    <td width="80%" class="sitemaptxt"><a href="subcat.php?cate_id= <?php echo $cat_row['category_id'];?>" class="sitemaptxt"><?php echo $cat_row['category_name']; ?></a></td>
                                                                                </tr>
                                                                                <?php
                                                                                
                                                                                }
                                                                                ?>


                                                                            </table></td>
                                                                    </tr>
                                                                </table></td>
                                                        </tr>
                                                        <tr>
                                                            <td height="7"></td>
                                                        </tr>
                                                    </table></td>
                                                <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td height="4"></td>
                                                        </tr>
                                                        <tr>
                                                            <td><table width="231" border="0" align="center" cellpadding="0" cellspacing="0">
                                                                    <tr>
                                                                        <td><table width="231" height="24" border="0" cellpadding="0" cellspacing="0" background="images/sitegrad.jpg">
                                                                                <tr>
                                                                                    <td width="19">&nbsp;</td>
                                                                                    <td width="212" class="detail3txt">Sell</td>
                                                                                </tr>
                                                                            </table></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><table width="100%" height="50" border="0" cellpadding="0" cellspacing="0" background="images/contentgrad.jpg" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom">
                                                                                <tr>
                                                                                    <td width="20%"><div align="center"><img src="images/site1.jpg" alt="" width="6" height="7" /></div></td>
                                                                                    <td width="80%" class="sitemaptxt"><a href="sell_item_cate.php" class="sitemaptxt">Sell Your  Item</a></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><div align="center"><img src="images/site1.jpg" alt="" width="6" height="7" /></div></td>
                                                                                    <td class="sitemaptxt"><a href="help.php#answer5" class="sitemaptxt">Learn How to Sell </a></td>
                                                                                </tr>
                                                                            </table></td>
                                                                    </tr>
                                                                </table></td>
                                                        </tr>
                                                        <tr>
                                                            <td height="7"></td>
                                                        </tr>
                                                        <tr>
                                                            <td valign="top"><table width="231" border="0" align="center" cellpadding="0" cellspacing="0">
                                                                    <tr>
                                                                        <td><table width="231" height="24" border="0" cellpadding="0" cellspacing="0" background="images/sitegrad.jpg">
                                                                                <tr>
                                                                                    <td width="19">&nbsp;</td>
                                                                                    <td width="212" class="detail3txt">Registration</td>
                                                                                </tr>
                                                                            </table></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><table width="100%" height="50" border="0" cellpadding="0" cellspacing="0" background="images/contentgrad.jpg" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom">
                                                                                <?php
                                                                                if(empty($_SESSION['userid']))
                                                                                {
                                                                                ?>
                                                                                <tr>
                                                                                    <td width="20%"><div align="center"><img src="images/site1.jpg" alt="" width="6" height="7" /></div></td>
                                                                                    <td width="80%" class="sitemaptxt">
                                                                                        <a href="user_reg.php" class="sitemaptxt">Register now </a>


                                                                                    </td>
                                                                                </tr>
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                                <tr>
                                                                                    <td><div align="center"><img src="images/site1.jpg" alt="" width="6" height="7" /></div></td>
                                                                                    <td class="sitemaptxt"><a href="forgot.php" class="sitemaptxt">I forgot my   Password</a></td>
                                                                                </tr>
                                                                            </table></td>
                                                                    </tr>
                                                                </table></td>
                                                        </tr>
                                                        <tr>
                                                            <td height="7"></td>
                                                        </tr>
                                                        <tr>
                                                            <td><table width="231" border="0" align="center" cellpadding="0" cellspacing="0">
                                                                    <tr>
                                                                        <td><table width="231" height="24" border="0" cellpadding="0" cellspacing="0" background="images/sitegrad.jpg">
                                                                                <tr>
                                                                                    <td width="19">&nbsp;</td>
                                                                                    <td width="212" class="detail3txt">My Auction </td>
                                                                                </tr>
                                                                            </table></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><table width="100%" height="160" border="0" cellpadding="0" cellspacing="0" background="images/contentgrad.jpg" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom">
                                                                                <tr>
                                                                                    <td width="20%"><div align="center"><img src="images/site1.jpg" alt="" width="6" height="7" /></div></td>
                                                                                    <td width="80%" class="sitemaptxt"><div align="left"><a href="myauction.php?mode=watch" class="sitemaptxt">My Watchlist</a></div></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><div align="center"><img src="images/site1.jpg" alt="" width="6" height="7" /></div></td>
                                                                                    <td class="sitemaptxt"><div align="left"><a href="myauction.php?mode=sell&status=Active" class="sitemaptxt">My Selling   Items</a></div></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><div align="center"><img src="images/site1.jpg" alt="" width="6" height="7" /></div></td>
                                                                                    <td class="sitemaptxt"><div align="left"><a href="myauction.php?mode=bid" class="sitemaptxt">My Bidding Items </a></div></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><div align="center"><img src="images/site1.jpg" alt="" width="6" height="7" /></div></td>
                                                                                    <td class="sitemaptxt"><div align="left"><a href="changepassword.php" class="sitemaptxt">Change my password </a></div></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><div align="center"><img src="images/site1.jpg" alt="" width="6" height="7" /></div></td>
                                                                                    <td class="sitemaptxt"><div align="left"><a href="advanced_search.php" class="sitemaptxt">Advanced Search </a></div></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><div align="center"><img src="images/site1.jpg" alt="" width="6" height="7" /></div></td>
                                                                                    <td class="sitemaptxt"><div align="left"><a href="contact.php" class="sitemaptxt">Contact Us </a></div></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><div align="center"><img src="images/site1.jpg" alt="" width="6" height="7" /></div></td>
                                                                                    <td class="sitemaptxt"><div align="left"><a href="help.php" class="sitemaptxt">Help</a></div></td>
                                                                                </tr>


                                                                            </table></td>
                                                                    </tr>
                                                                </table></td>
                                                        </tr>
                                                        <tr>
                                                            <td height="4"></td>
                                                        </tr>
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