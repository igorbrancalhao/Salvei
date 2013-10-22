<?php
/***************************************************************************
*File Name				:watchall.tpl
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
            <div align="left">&nbsp;&nbsp;<font class="detail3txt">Watch All Items</font></div></td></tr>
    <tr><td valign="top"> 
            <table width="958" cellpadding="5" cellspacing="2"  background="images/contentgrad.jpg" align="center" border="0" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom">
                <?php 
                require 'include/connect.php';
                //require'include/getdatedifference.php'; 
                $user_id=$_SESSION[userid];
                $mode=$_GET[mode];
                $item_id=$_GET['item_id'];
                $currec=$_GET['currec'];
                if($mode=="del")
                {
                $del="delete from watch_list where item_id=".$item_id;
                mysql_query($del); 
                }
                $ver="select * from watch_list a, placing_item_bid b where a.user_id=$user_id and b.status='Active' and a.item_id=b.item_id";
                // $ver="select * from watch_list where user_id=".$user_id;
                $page1=mysql_query($ver);
                $chk=mysql_num_rows($page1);
                if($chk==0)
                {
                ?>
                <table align="left" width="100%" cellspacing="0" cellpadding="5">
                    <tr><td><table align="center"><tr><td>
                                        <font size=2 ><b>Where would you like to go next?</b></font>
                                    </td></tr>
                                <tr><td>&nbsp;&nbsp;
                                        <font size=2 >-<a href="watchlist.php">Recently viewed list of items</a> </font></td></tr>
                                <tr><td>&nbsp;&nbsp;
                                        <font size=2 >-<a href="myauction.php">My Auction</a> </font>
                                        <br>
                                        <br>
                                        <br></td></tr> </table></td></tr>
                </table>
            </table></td></tr></table>
<?php require'include/footer.php';
exit();
}
?>

<?php

if($chk>0)
{
/* $watid=0;
while($watch_fetch=mysql_fetch_array($page1))
{
echo $watid=$watch_fetch['item_id].",";
}
echo $watid=trim(",",$watid);*/
?>
<tr>
    <td align="right"> 
        <a href="watchall.php?mode=feweritems" class="header_text">Show Fewer Items</a> &nbsp;&nbsp;
        <a href="myauction.php?mode=watch" class="header_text">Back to Watchlist</a></td></tr>
<tr><td>
        <table cellpadding="5" cellspacing="0" align=center width="100%">
            <tr><td valign="top">
                    <table width="100%" align="center" cellpadding="5" cellspacing="1">
                        <tr>
                            <td colspan="2" align="justify" class="detail9txt"><br><br><br><br>
                                Item<br><br><br><br><br></td></tr>
                        <tr><td><br /></td></tr>
                        <tr>
                            <td class="detail9txt">current price:</td>
                        </tr>
                        <tr>
                            <td class="detail9txt">Starting bid:</td>
                        </tr>
                        <tr>
                            <td class="detail9txt">Quantity:</td>
                        </tr>
                        <tr>
                            <td class="detail9txt">No of Bids:</td>
                        </tr>
                        <tr>
                            <td class="detail9txt">Ends</td>
                        </tr>
                        <tr>
                            <td class="detail9txt">bid_starting_date</td>
                        </tr>
                        <tr>
                            <td class="detail9txt">Seller: </td>
                        </tr>
                        <tr>
                            <td class="detail9txt">Shipping Cost: </td>
                        </tr>
                        <tr>
                            <td>&nbsp;
                            </td></tr>
                    </table></td>
                <?php
                }
                $wat="select * from watch_list a, placing_item_bid b where a.user_id=$user_id and b.status='Active' and a.item_id=b.item_id";
                //$wat="select * from watch_list where user_id=".$user_id;
                $page=mysql_query($wat);
                $total_records1 = mysql_num_rows($page);
                if($total_records1>5)
                $mode="feweritems";
                //$wat_rec=mysql_query($wat);
                if($mode=="feweritems")
                {
                $limitsize=4;//pagelimit
                $page_res=mysql_query($wat);
                $total_records = mysql_num_rows($page_res);
                if($total_records>0)
                { 
                //get the total records
                if(strlen($currec)==0) //check firstpage 
                $currec = 1;  
                $start = ($currec - 1) *$limitsize;
                $end = $limitsize;
                $wat .=" limit $start,$end";
                $page=mysql_query($wat);
                }
                }
                while($wat_res=mysql_fetch_array($page))
                {
                $sql="select * from placing_item_bid where item_id=".$wat_res[item_id];
                $result=mysql_query($sql);
                $row=mysql_fetch_array($result);
                $cat="select category_name from category_master where category_id=".$row['category_id'];
                $cat_res=mysql_query($cat);
                $cat_row=mysql_fetch_array($cat_res);
                $user_sql="select * from user_registration where user_id=".$row['user_id'];
                $user_res=mysql_query($user_sql);
                $user=mysql_fetch_array($user_res);
                $bid_sql="select * from placing_bid_item where item_id=".$row['item_id'];
                $bid_res=mysql_query($bid_sql);
                $bid=mysql_fetch_array($bid_res);
                $current_price=$bid['bidding_amount'];
                if(!isset($bid[0]))
                {
                $bid_sql="select * from placing_item_bid where item_id=".$row['item_id'];
                $bid_res=mysql_query($bid_sql);
                $bid=mysql_fetch_array($bid_res);
                if($bid['selling_method']=="auction" or $bid['selling_method']=="dutch_auction")
                $current_price=$bid['min_bid_amount'];
                else
                $current_price=$bid['quick_buy_price'];
                }

                $tot_sql="select count(*) as bid_tot from placing_bid_item where item_id=".$row['item_id']." and deleted='No'";
                $tot_res=mysql_query($tot_sql);
                $tot=mysql_fetch_array($tot_res);
                $expire_date=$row['expire_date'];
                require 'ends.php';
                ?>
                <td valign="top">
                    <table align="center" cellpadding="5" cellspacing="0" width="100%">
                        <tr height="50px"><td>&nbsp;</td></tr>

                        <tr>
                            <td colspan="2" valign="top">
                                <a href="watchall.php?item_id=<?php= $row['item_id']; ?>&mode=del&currec=1" class="header_text">Remove From Watchlist</a><br>
                                <br>
                                <?php if(!empty($row['picture1']) and file_exists('thumbnail/'.$row['picture1']))
                                {
                                ?>
                                <a href="detail.php?item_id=<?php echo $row['item_id']; ?>">
                                    <img src="thumbnail/<?php echo $row['picture1']; ?>" border=0 height="80" width="80"></a><?php 
                                }
                                else
                                {
                                ?>
                                <a href="detail.php?item_id=<?php echo $row['item_id']; ?>">
                                    <img src="images/no-image.gif" border=0 height="80" width="80"></a><?php
                                }
                                ?>
                            </td></tr>
                        <tr><td>
                                <a href="detail.php?item_id=<?php echo $row['item_id']; ?>" class="header_text">
                                    <?php echo substr($row['item_title'],0,10); ?>..</a></td></tr>
                        <br />
                        <tr>
                            <td class="banner1"><?php echo $row['cur_price']; ?></td>
                        </tr>
                        <tr>
                            <td class="banner1"><?php if($row['selling_method']=="auction" or $row['selling_method']=="dutch_auction") echo $row['min_bid_amount']; else echo "No Bid";?></td>
                        </tr>
                        <tr>
                            <td class="banner1"><?php echo $row['Quantity'];?></td>
                        </tr>
                        <tr>
                            <?php if($tot[0]==0)
                            {
                            ?>
                            <td class="banner1"><?php echo "-"; ?></td>
                            <?php
                            }
                            else
                            {
                            ?>
                            <td class="banner1"><?php echo $tot[0];?></td>
                            <?php
                            }
                            ?>
                        </tr>
                        <tr>
                            <td class="banner1"><?php echo "$string_difference" ;?></td>
                        </tr>
                        <?php
                        $biddate=explode(" ",$row['bid_starting_date']);
                        ?>
                        <tr>
                            <td class="banner1"><?php echo $biddate[0];?></td>
                        </tr>
                        <tr>
                            <td class="banner1"><?php echo $user['user_name'];?></td>
                        </tr>
                        <tr>
                            <?php if(isset($row['shipping_cost']))
                            {
                            ?>
                            <td class="banner1"><?php echo $row['shipping_cost'];?></td>
                            <?php 
                            }
                            else
                            {
                            ?>
                            <td class="banner1"><?php echo "-" ;?></td>
                            <?php
                            }
                            ?>
                        </tr>

                        <tr>
                            <td class="banner1">
                                <?php
                                if($row['selling_method']=="fix")
                                { ?>
                                <a href="detail.php?item_id=<?php=$row['item_id']?>"><img src="images/buynow_icon.gif" border="0"></a>
                                <?php 
                                }
                                if($row['selling_method']=="ads")
                                {
                                ?>
                                <a href="detail.php?item_id=<?php=$row['item_id'] ?>"><img src="images/hands(11).gif" border="0"></a>
                                <?php 
                                }
                                else if($row['selling_method']=="auction" || $row['selling_method']=="dutch_auction")
                                {
                                ?>
                                <a href="detail.php?item_id=<?php=$row['item_id'] ?>"><img src="images/Auction(12).gif" border="0"></a>
                                <?php
                                }
                                ?>
                            </td>
                        </tr>
                    </table>
                </td>
                <?php
                }
                ?>
            </tr>
            <?php 
            if(isset($mode))
            {
            $net=($currec-1*$limitsize+$end)-$total_records;
            $dis=$limitsize+$start;
            if($net <= 0) $net=$end;
            if($dis<=$total_records)
            {
            ?>
            <font class="header_text">Currently Showing <?php echo $start+1; ?> <?php echo "-". $dis; ?> from a total of <?php echo $total_records; ?> Records
            <?php
            }
            else
            {
            ?>
            <font class="header_text">Currently Showing <?php echo $start+1;?>  from a total of <?php echo $total_records; ?> Record</font>
            <?php
            }
            if($currec != 1)
            {
            echo "<a href=watchall.php?currec=".($currec - 1)."&mode=feweritems style=text-decoration:none class=errormsg>  Prev  </a>";
            }
            $net=$total_records - ($currec*$limitsize+$end) + $end;
            if($net >$limitsize) $net=$limitsize;
            if($net <= 0) $net=$end;
            if($total_records > ($start + $end)) 
            {
            echo "<a href=watchall.php?currec=".($currec + 1)."&mode=feweritems style=text-decoration:none class=errormsg>  Next  </a>";
            }
            }
            ?>
        </table>
    </td></tr></table>
</td></tr></table>
