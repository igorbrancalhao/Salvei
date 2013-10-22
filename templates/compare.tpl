<?php
/***************************************************************************
*File Name				:compare.tpl
* File Created			:Wednesday, June 21, 2006
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

            <?
            if($count >0)
            {
            foreach($items as $item)
            {
            $wat="select * from watch_list where watchlist_id=".$item;
            $wat_rec=mysql_query($wat);
            $wat_tot=mysql_num_rows($wat_rec);
            if($wat_tot!=0)
            { 
            $ver=1;
            }
            }   
            if($ver==1)
            { 
            ?>
            <div align="left">&nbsp;&nbsp;<font class="detail3txt">Compare Items</font></div></td></tr>
    <tr><td valign="top" > 
            <table width="958" cellpadding="5" cellspacing="2"  background="images/contentgrad.jpg" align="center" border="0" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom">
                <tr>
                    <td>
                        <form>
                            <table width="100%" cellpadding="5" cellspacing="0">
                                <tr align="right">
                                    <td><br><a href="myauction.php" class="header_text">
                                            Back to My Auction</a>
                                    </td></tr>
                            </table>
                        </form>
                    </td></tr>
                <tr><td>
                        <table cellpadding="5" cellspacing="0"  width="100%" border="0">
                            <tr><td valign="top">
                                    <table align="center" cellpadding="5" cellspacing="0" width="100%">
                                        <tr class="detail9txt">
                                            <td colspan="2" align="justify" ><br><br><br><br>
                                                Item<br><br><br>
                                            </td></tr>
                                        <tr class="detail9txt">
                                            <td><br>

                                                <br>Current price:</td>
                                        </tr>
                                        <tr class="detail9txt">
                                            <td>Starting bid:</td>
                                        </tr>
                                        <tr class="detail9txt">
                                            <td>Quantity:</td>
                                        </tr>
                                        <tr class="detail9txt">
                                            <td>No of Bids:</td>
                                        </tr>
                                        <tr class="detail9txt">
                                            <td>Ends
                                            </td>
                                        </tr>

                                        <tr class="detail9txt">
                                            <td>Seller: </td>
                                        </tr>
                                        <tr class="detail9txt">
                                            <td>Shipping Cost: </td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;
                                            </td></tr>
                                    </table>
                                    </font></td>
                                <?
                                } //if($ver==1)
                                foreach($items as $item)
                                {
                                $wat="select * from watch_list where watchlist_id=".$item;
                                $wat_rec=mysql_query($wat);
                                $wat_tot=mysql_num_rows($wat_rec);
                                if($wat_tot!=0)
                                //if($item!=$del_id)
                                {
                                $rec_count=1;
                                $item_rec=mysql_fetch_array($wat_rec);
                                $item=$item_rec[item_id];
                                $sql="select * from placing_item_bid where item_id=".$item;
                                $result=mysql_query($sql);
                                $row=mysql_fetch_array($result);
                                $cat="select category_name from category_master where category_id=".$row['category_id'];
                                $cat_res=mysql_query($cat);
                                $cat_row=mysql_fetch_array($cat_res);
                                $user_sql="select * from user_registration where user_id=".$row['user_id'];
                                $user_res=mysql_query($user_sql);
                                $user=mysql_fetch_array($user_res);
                                /* $country_sql="select * from country_master where country_id=".$user['country'];
                                $country_res=mysql_query($country_sql);
                                $country=mysql_fetch_array($country_res); */
                                $bid_sql="select * from placing_bid_item where item_id=".$row['item_id'];
                                $bid_res=mysql_query($bid_sql);
                                $bid=mysql_fetch_array($bid_res);
                                $current_price=$bid['bidding_amount'];
                                if(!isset($bid[0]))
                                {
                                $bid_sql="select * from placing_item_bid where item_id=".$row['item_id'];
                                $bid_res=mysql_query($bid_sql);
                                $bid=mysql_fetch_array($bid_res);
                                $current_price=$bid['min_bid_amount'];
                                }
                                $tot_sql="select count(*) from placing_bid_item where item_id=".$row['item_id']." and deleted='No'";
                                $tot_res=mysql_query($tot_sql);
                                $tot=mysql_fetch_array($tot_res);
                                $expire_date=$row['expire_date'];
                                require 'ends.php';
                                ?>
                                <td valign="top">
                                    <table align="center" cellpadding="5" cellspacing="0" width="100%" style="border-left:1px solid #CCCCCC;">
                                        <tr>
                                            <td colspan="2" align="justify">
                                                <a href="compare.php?item_id=<?= $row['item_id']; ?>&mode=del" class="header_text">Remove Item</a><br>
                                                <br>
                                                <? if(!empty($row['picture1']) and file_exists('thumbnail/'.$row['picture1']))
                                                {
                                                ?>
                                                <a href="detail.php?item_id=<? echo $row['item_id']; ?>">
                                                    <img src="thumbnail/<? echo $row['picture1']; ?>" border=0 height="70" width="70"></a>
                                                <?
                                                }
                                                else
                                                {	
                                                ?>
                                                <a href="detail.php?item_id=<? echo $row['item_id']; ?>">
                                                    <img src="images/no-image.gif" height="70" width="70" border="0"></a>
                                                <?
                                                }
                                                ?>
                                                <br>
                                                <a href="detail.php?item_id=<? echo $row['item_id']; ?>" class="header_text"><? echo substr($row['item_title'],0,10); ?>..</a>
                                            </td></tr>
                                        <tr>
                                            <td class="banner1"><br><br><? echo $row[currency].' '.$row[cur_price] ?></td>
                                        </tr>
                                        <tr>
                                            <? if($row[selling_method]=='fix')
                                            {
                                            $start_bid=$bid['quick_buy_price'];
                                            }
                                            else
                                            {
                                            $start_bid=$row['min_bid_amount'];
                                            }
                                            ?>
                                            <td class="banner1"><? echo $row[currency].' '.$start_bid;?></td>
                                        </tr>
                                        <tr>
                                            <td class="banner1"><? echo $row['Quantity'];?></td>
                                        </tr>
                                        <tr>
                                            <? if($tot[0]==0)
                                            {
                                            ?>
                                            <td class="banner1"><? echo "-"; ?></td>
                                            <?
                                            }
                                            else
                                            {
                                            ?>
                                            <td class="banner1"><? echo $tot[0];?></td>
                                            <?
                                            }
                                            ?>
                                        </tr>
                                        <tr>

                                            <td class="banner1"><br><? echo "$string_difference" ;?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="banner1"> <? echo $user['user_name'];?> </td>
                                        </tr>
                                        <tr>
                                            <? if(!empty($row['shipping_cost']))
                                            {
                                            ?>
                                            <td class="banner1"><? echo $row[currency].' '.$row['shipping_cost'];?></td>
                                            <? 
                                            }
                                            else
                                            {
                                            ?>
                                            <td class="banner1"><? echo "-" ;?></td>
                                            <? }
                                            ?>
                                        </tr>
                                        <tr><td>
                                                <a href="<? if($row['selling_method']=="fix") { ?> detail.php<?}else {?>detail.php<?}?>?item_id=<?= $row[item_id]; ?>">
                                                   <? if($row['selling_method']=="fix") {?><img src="images/buynow_icon.gif" border="0"><?}else{?><img src="images/Auction(12).gif" border="0"><?}?></a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <?
                                }
                                } //if($wat_tot!=0)
                                // else
                                if($rec_count!=1)
                                {
                                ?>
                            <font class="detail3txt"><div align="left">&nbsp;&nbsp;Compare Items</div></font>
                            <tr><td valign="top"> 
                                    <table width="958" cellpadding="5" cellspacing="2"  background="images/contentgrad.jpg" align="center" border="0" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom">
                                        <tr><td><table align="center"><tr><td>
                                                            <font size=2 class="detail9txt"><b>Where would you like to go next?</b></font>
                                                        </td></tr>
                                                    <tr><td>&nbsp;&nbsp;<font size=2 class="header_text">-<a href="myauction.php?mode=watch" class="header_text">Recently viewed list of items</a> </font></td></tr>
                                                    <tr><td>&nbsp;&nbsp;<font size=2 class="header_text">-<a href="myauction.php" class="header_text">My Auction</a> </font>
                                                            <br>
                                                            <br>
                                                            <br></td></tr> </table></td></tr>
                                    </table></td></tr></table>
                        <? require'include/footer.php';
                        exit();
                        }
                        }
                        if($count==0)
                        {
                        ?>
                        <div align="left">&nbsp;&nbsp;<font class="detail3txt">Compare Items</font></div></td>
                </tr>
                <tr><td valign="top"> 
                        <table width="958" cellpadding="5" cellspacing="2"  background="images/contentgrad.jpg" align="center" border="0" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom">
                            <tr align="center">
                                <td><font size=3 class="detail9txt"><b>No Items Selected</b></font></td></tr>
                            <tr align="center">
                                <td>
                                    <font size=3 color="#003366">
                                    To Compare Items,Select checkboxes and click the compare button.</font></td></tr>
                            <tr align="center"><td>
                                    <a href="myauction.php?mode=watch" class="header_text">Back to My Watchlist</a>
                                </td></tr>
                        </table>
                    </td></tr>
                <? 
                } 
                ?>
            </table></td></tr>
</table></td></tr>
</table></td></tr>


