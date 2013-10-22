<div id="content">
    <div id="myauctionleft">
        <?php require 'include/my_list.php';?>
    </div>
    <div id="myauctionright">
        <div id="myauctionright_left">
            <?php
            if($mode=="relisting")
            {
            ?>
            <tr><td ><font color="green" size="4">Your Item Relisted Successfully</font></td></tr>
            <?php
            $mode="sell";
            $status='Active';
            }
            ?>
            <?php
            if($mode=="watching")
            {
            ?>
            <tr><td><font color="green" size="4">Your Watched Items are deleted Successfully</font></td></tr>
            <?php
            $mode="watch";
            }
            ?>
            <?php
            if($mode=="close_relisting")
            {
            ?>
            <tr><td ><font color="green" size="4">Your Item Relisted Successfully</font></td></tr>
            <?php
            $mode="sell";
            $status="Closed";
            }
            ?>

            <div id="myauctionleft1">
                <?php if($mode=="watch" or $mode=="won" or $mode=="didntwin" or $mode=="bid" or $mode=="")
                {
                ?>
                <div class="myauction_bg">Bidding Totals </div>
                <div class="superbg">
                    <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="3%">&nbsp;</td>
                            <td width="19%" class="detail9txt">Bidding on:<?php echo $bid_total_records; ?> </td>
                            <td width="11%" class="detail9txt">Won:<?php echo $won_total_records ?></td>
                            <td width="67%" class="detail9txt">Amount:<?php if($won_items_amt > 0) { ?><?php echo $default_cur ?> <?php echo $won_items_amt ?><?php }else{echo " - ";} ?> </td>
                        </tr>
                    </table>
                </div>

                <?php
                }
                ?>

            </div>
            <div id="myauctionleft1">
                <div class="myauction_bg">Buying Remainders </div>
                <?php
                $total_feedback=$won_total_records+$sold_total_records;
                $paid_sql="select * from placing_bid_item a,placing_item_bid b where a.user_id=$user_id and a.item_id=b.item_id and a.user_pos='Yes' and b.payment_status='unpaid' group by b.item_id";
                $paid_res=mysql_query($paid_sql);
                $paid_records=mysql_num_rows($paid_res);

                $leave_row="select * from feedback where buyer_id=$user_id";
                $leave_row_res=mysql_query($leave_row);
                $leave_row=mysql_num_rows($leave_row_res);
                $leave_row1="select * from feedback where seller_id=$user_id";
                $leave_row1_res=mysql_query($leave_row1);
                $leave_row1=mysql_num_rows($leave_row1_res);
                $total_feedback=$total_feedback-($leave_row+$leave_row1);
                ?>
                <div class="superbg">
                    <table width="100%" height="50" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td height="5"></td>
                        </tr>
                        <tr>
                            <td width="3%">&nbsp;</td>
                            <td width="5%"><img src="images/dollar.gif" alt="" width="17" height="25" /></td>
                            <td width="92%"> <span class="myauction3txt">I need to pay for</span> <span class="myauction4txt"><a href="myauction.php?mode=won&#wondetails" class="header_text"><?php echo  $paid_records; ?> item </a></span></td>
                        </tr>
                        <tr>
                            <td height="5"></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><img src="images/feedback.gif" alt="" width="19" height="19" /></td>
                            <td> <span class="myauction3txt">I need to leave feedback for</span> <span class="header_text"><!--<a href="#" class="header_text">--><?php echo  $total_feedback; ?> item<!--</a>--> </span></td>
                        </tr>
                        <tr>
                            <td height="5"></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div id="myauctionleft1">
                <?php
                if($mode=="sell" and $status=='Active')
                {
                ?>
                <div class="myauction_bg">Items I'am Selling: ( 
                    <?php if($sell_total_records == 1 )
                    { echo "$sell_total_records"."&nbsp;".Items; } else if($sell_total_records > 1)
                    { echo "$sell_total_records"."&nbsp;".Item; } else echo "No Items";?> )</div>
                <?php
                if($sell_total_records > 0)
                { 
                $rec_sql="select  * from admin_settings where set_id=54";
                $rec_res=mysql_query($rec_sql);
                $rec_row=mysql_fetch_array($rec_res); 
                $limitsize=$rec_row[set_value]; 
                //$limitsize=1;
                //get the total records
                if(strlen($currec)==0) //check firstpage 
                $currec = 1;  
                $start = ($currec - 1) * $limitsize;
                $end = $limitsize;
                if(!empty($itemfind))
                {
                $sell_sql.=" and item_id=$itemfind";
                }
                else
                {

                $sell_sql .=" order by bid_starting_date desc limit $start,$end";
                }
                $sell1=mysql_query($sell_sql);
                $sell_row=mysql_fetch_array($sell1);
                $sell_total_records1=mysql_num_rows($sell1);
                if($sell_total_records1>0)
                {
                ?>
                <div class="superbg">
                    <table cellspacing="0" cellpadding="5" width=100%>
                        <form name="sell_form" action="myauction.php" method="post">
                            <tr bgcolor="#B8DEEE">
                                <td width=3%>
                                    <input type="hidden" name="len" value="<?php echo  $sell_total_records?>">
                                </td>
                                <td width=10% class="detail9txt"><b>Picture</b> </td>
                                <td width=10% class="detail9txt"><b>Current bid</b> </td>
                                <td width="13%" class="detail9txt" ><b>Highbid id</b> </td>
                                <td width="7%" class="detail9txt"><b>Bids</b>  </td>
                                <td width="14%" class="detail9txt"><b>no. of Watchers</b>  </td>
                                <td width="20%" class="detail9txt"><b>End date</b>  </td>
                                <td width="23%" colspan="3" class="detail9txt"><b>Action </b> </td>
                            </tr>
                            <tr><td colspan="8" align="right">
                                    <a href="#" onclick="window.open('downloads.php?idu=<?php echo $_SESSION['userid']?>&md=1', 'pop_up', 'toolbar=no, top=0,location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, height=500, width=500')" style="text-decoration:none; color:#CC6600; size:2px; font-weight:bold" title="Download selling details in Excel Format"> Download selling Details</a><a href="#" onclick="window.open('downloads.php?idu=<?php echo $_SESSION['userid']?>&md=1', 'pop_up', 'toolbar=no, top=0,location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, height=500, width=500')" style="text-decoration:none; color:#CC6600; size:2px"><img src="images/download.gif" border="0"/></a></td></tr>
                            <?php
                            if($sell_total_records > 0)
                            {
                            ?>
                            <tr align="left" class="detail9txt">
                                <?php 
                                $net=($currec-1*$limitsize+$end)-$sell_total_records;
                                $dis=$limitsize+$start;
                                if($net <= 0) $net=$end;
                                if($dis<=$sell_total_records)
                                {
                                ?>
                                <td colspan=7 align="right" class="tr_botborder">
                                    <font size="2">Showing  <?php echo $start+1; ?>
                                    <?php echo " - ". $dis; ?> of <?php echo $sell_total_records; ?> Items </font></td>
                                <?php 
                                }
                                else 
                                {
                                ?>
                            <tr align="left" class="detail9txt"><td colspan=5 align="right" class="tr_botborder">
                                    <font size="2">Showing  <?php echo $start+1;?>  of <?php echo $sell_total_records; ?> Item </font></td>
                                <?php
                                }
                                if($currec!=1)
                                {
                                ?>
                                <td class="tr_botborder">
                                    <a href="myauction.php?mode=sell&status=Active&currec=<?php echo ($currec - 1);?>" style="text-decoration:none">
                                        <font size="2" color="red" face="Arial, Helvetica, sans-serif" >Previous </font></a></td>
                                <?php
                                } 
                                $net=$sell_total_records-($currec*$limitsize+$end) + $end;
                                if($net >$limitsize) $net=$limitsize;
                                if($net <= 0) $net=$end;
                                if($sell_total_records > ($start + $end)) 
                                {
                                ?>  
                                <td class="tr_botborder"><a href="myauction.php?mode=sell&status=Active&currec=<?php echo ($currec + 1);?>" style="text-decoration:none">
                                        <font size=2 color="red" face="Arial, Helvetica, sans-serif"> Next </font> </a></td>
                                <?php
                                }
                                ?>
                                <td colspan="5" class="tr_botborder">&nbsp;</td><!--<form name=pagecount action="myauction.php" method=get>-->

                            </tr>
                            <tr class="detail9txt"><td colspan="8" align="right" ><strong>Enter Item no : </strong>
                                    <input type="text" name="itemfind" size="8"  />
                                    <input type="hidden" name="status" value="" />
                                    <input type="button" name="sub" value="GO"  onclick="val()"/>
                                </td>
                                <?php
                                } 
                                $sell_res=mysql_query($sell_sql);
                                while($sell_row=mysql_fetch_array($sell_res))
                                {
                                $user_sql="select * from user_registration where user_id=".$sell_row['user_id'];
                                $user_res=mysql_query($user_sql);
                                $user=mysql_fetch_array($user_res);

                                // seller information
                                $sellername=$user[user_name];
                                $expire_date = $sell_row[expire_date];
                                require 'ends.php';


                                // count no of bids for this items
                                $tot_bid_sql="select count(*) from placing_bid_item where item_id=".$sell_row[item_id]." and deleted='No'";
                                $tot_bid_res=mysql_query($tot_bid_sql);
                                $tot_bids=mysql_fetch_array($tot_bid_res);

                                // current bid amount


                                $bid_sql_max="select MAX(bidding_amount) as amt from placing_bid_item where item_id=".$sell_row[item_id]." and deleted='No'";
                                $bid_res_max=mysql_query($bid_sql_max);
                                $bidrow_max=mysql_fetch_array($bid_res_max);
                                $max_item_bid=$bidrow_max['amt'];

                                if(empty($max_item_bid))
                                { 
                                $max_item_bid=$sell_row[min_bid_amount];
                                }
                                // maximum bid userid
                                if(empty($max_item_bid))
                                {
                                $highuserid="no bid";
                                }
                                else
                                {
                                //$sqlbid_id="select * from placing_bid_item where duplicate_bidding_amt=".$max_item_bid;
                                $sqlbid_id="select * from placing_bid_item where bidding_amount=".$max_item_bid." and item_id=".$sell_row['item_id']." and deleted='No'";
                                $sqlqrybid_id=mysql_query($sqlbid_id);
                                $sqlrowbid_id=mysql_fetch_array($sqlqrybid_id);
                                $highuserid=$sqlrowbid_id['user_id'];  
                                }
                                //no. of watchers
                                $tot_watch_sql="select count(*) from watch_list where item_id=".$sell_row[item_id];
                                $tot_watch_res=mysql_query($tot_watch_sql);
                                $tot_watch=mysql_fetch_array($tot_watch_res); 
                                //no. of questions
                                $tot_qus_sql="select count(*) from ask_question where item_id=".$sell_row[item_id]." and answer=''";;
                                $tot_qus_res=mysql_query($tot_qus_sql);
                                $tot_qus=mysql_fetch_array($tot_qus_res);   

                                ?>
                            <tr class="detail9txt">
                                <td class="tr_botborder" width=3%>&nbsp;
                                </td>
                                <td class="tr_botborder">
                                    <?php
                                    if(!empty($sell_row['picture1']))
                                    {
                                    $img=$sell_row['picture1'];
                                    list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
                                    $h=$height;
                                    $w=$width;
                                    if($h>50)	
                                    {
                                    $nh=50;
                                    $nw=($w/$h)*$nh;
                                    $h=$nh;
                                    $w=$nw;
                                    }
                                    if($w>50)
                                    {
                                    $nw=50;
                                    $nh=($h/$w)*$nw;
                                    $h=$nh;
                                    $w=$nw;
                                    }
                                    ?>
                                    <img name="runimg" src="thumbnail/<?php echo $sell_row['picture1']; ?>" border=1 width=<?php echo $w; ?> height=<?php echo $h?> >
                                         <?php 
                                         }
                                         else
                                         {
                                         ?>
                                         <img src="images/no_image.gif" border=1  name="runimg" >
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td class="tr_botborder">
                                    <?php echo $sell_row[currency];?>
                                    <?php if($sell_row['selling_method']=="auction" or $sell_row['selling_method']=="dutch_auction")
                                    {
                                    ?>
                                    <?php echo number_format(($max_item_bid),2,'.',''); ?>
                                    <?php
                                    }
                                    else if($sell_row['selling_method']=="fix")
                                    {
                                    echo  number_format(($sell_row['quick_buy_price']),2,'.','');  
                                    }

                                    else
                                    {
                                    echo "-";
                                    }
                                    ?>
                                    </a>
                                </td>

                                <td class="tr_botborder">

                                    <?php if($sell_row['selling_method']=="auction" or $sell_row['selling_method']=="dutch_auction")
                                    {
                                    if($highuserid)
                                    {
                                    ?>
                                    <?php  echo $highuserid; ?> 
                                    <?php
                                    }
                                    else 
                                    echo "-";
                                    }
                                    else if($sell_row['selling_method']=="fix")
                                    {
                                    ?>
                                    -
                                    <?php
                                    }
                                    else
                                    echo "-";
                                    ?>



                                </td>
                                <td class="tr_botborder">
                                    <?php
                                    if($sell_row[selling_method]!='ads')
                                    {
                                    if($tot_bids[0]!=0)
                                    {
                                    ?>
                                    <a href="bidhistory.php?item_id=<?php echo  $sell_row['item_id']?> " class="header_text"><?php echo $tot_bids[0];?></a>
                                    <?php
                                    }
                                    else
                                    {
                                    echo $tot_bids[0];
                                    }
                                    }
                                    else
                                    {
                                    echo "-";
                                    }
                                    ?>
                                </td>
                                <td class="tr_botborder">
                                    <?phpif($sell_row[selling_method]!='ads')
                                    {
                                    echo $tot_watch[0];
                                    }
                                    else
                                    {
                                    echo "-";
                                    }
                                    ?>
                                </td>
                                <td width="20%" class="tr_botborder"><?php echo $string_difference; ?></td>
                                <td class="tr_botborder" colspan="3">

                                    <select name=cbowonaction style="width:100px;" onchange="go_page(this.value, < ?php = $sell_row[item_id]; ? > )">
                                        <option value="0">Action</option>
                                        <?php
                                        if($sell_row[selling_method]!="ads" and $sell_row[selling_method]!="want_it_now")
                                        {
                                        ?>
                                        <option value="9">Sell Similar</option>
                                        <option value="10">Search in Want It Now</option>
                                        <?php
                                        $itemcheck=$sell_row[item_id];
                                        $sql_row="select * from placing_bid_item where item_id=$itemcheck";
                                        $sqlqry_row=mysql_query($sql_row);
                                        $rowcheck=mysql_num_rows($sqlqry_row);
                                        if($rowcheck==0)
                                        {
                                        ?>
                                        <option value="1">Revise Auction</option>
                                        <?php
                                        }
                                        ?>
                                        <option value="12">Cross Promotions</option>

                                        <option value="2">End Auction</option>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        if($sell_row['selling_method']=="ads")
                                        {
                                        ?>
                                        <option value="20">Edit Ad</option>
                                        <?php
                                        }

                                        ?>

                                        <option value="3">Delete Auction</option>
                                        <?php
                                        $re="select * from placing_item_bid where item_id=$sell_row[item_id]";
                                        $re_row=mysql_query($re);
                                        $relist=mysql_fetch_array($re_row);
                                        $repost=$relist[no_of_repost];

                                        if($string_difference=="Duration Expired" && $repost>0)
                                        {
                                        ?>
                                        <option value="13">Relist</option>
                                        <?php
                                        }
                                        ?>
                                    </select>  

                                </td></tr>
                            <tr>
                                <td class="tr_botborder_1">&nbsp;  </td>
                                <td class="tr_botborder_1" colspan=9 align="left">
                                    <a href="<?php if($sell_row[selling_method]!=ads) {  ?>detail.php<?php }else{?>classifide_ad.php<?php}?>?item_id=<?php echo  $sell_row['item_id']?>" class="header_text">
                                        <?php  echo $sell_row['item_title']; ?></a>&nbsp;<font class="detail9txt">(<?php  echo $sell_row['item_id']; ?> )</font></td>
                            </tr>
                            <?php
                            } // while
                            ?>
                            <input type="hidden" name="open_delete" />
                            <input type="hidden" name="item_id" />
                            <input type="hidden" name="itemid" />
                            <input type="hidden" name="sellitemid" />
                            <input type="hidden" name="mode" />
                            <tr>
                                <td colspan="9" class=tr_botborder>
                                    <input type="hidden" name="delete1" value=0>	
                                </td>
                            </tr>
                        </form>
                    </table>
                </div>
                <?php
                }
                else
                {
                ?>
                <div class="superbg">
                    <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="3%">&nbsp;</td>
                            <td width="97%" class="myauction3txt">Invalid Item Id.</td>
                        </tr>
                    </table>
                </div>
                <?php
                }
                }
                else
                {
                ?>
                <div class="superbg">
                    <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="3%">&nbsp;</td>
                            <td width="97%" class="myauction3txt">There are no items in this section</td>
                        </tr>
                    </table>
                </div>
                <?php
                }
                }
                ?>
            </div>

            <div id="myauctionleft1">
                <?php
                if($mode=="sell" and  $status=="Closed")
                {
                ?>
                <div class="myauction_bg">Closed Auctions: ( 
                    <?php if($close_total_records == 1 )
                    { echo "$close_total_records"."&nbsp;".Items; } else if($close_total_records > 1)
                    { echo "$close_total_records"."&nbsp;".Item; } else echo "No Items";?> )</div>
                <?php
                if($close_total_records > 0)
                { 
                ?>
                <div class="superbg">
                    <table cellspacing="0" cellpadding="5" width=100%>
                        <form name="close_form" action="myauction.php" method="post">
                            <tr bgcolor="#B8DEEE">
                                <td width=5%>
                                    <input type="hidden" name="len" value="<?php echo  $close_total_records?>">
                                </td>
                                <td width=14% class="detail9txt"><b>Picture</b> </td>
                                <td width="14%" class="detail9txt"><b>Current bid</b> </td>
                                <td width="13%" class="detail9txt"><!--<b>Bids</b> --> </td>
                                <td width="20%" class="detail9txt"><b>Started</b>  </td>
                                <td width="11%" class="detail9txt"><b>End date</b>  </td>
                                <td colspan="2" class="detail9txt"><b>Action </b> </td>
                            </tr>
                            <tr><td colspan="8" align="right">
                                    <a href="#" onclick="window.open('downloads.php?idu=<?php echo $_SESSION['userid']?>&md=3', 'pop_up', 'toolbar=no, top=0,location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, height=500, width=500')" style="text-decoration:none; color:#CC6600; size:2px; font-weight:bold" title="Download Closed Auction details in Excel Format"> Download Closed Auction Details</a><a href="#" onclick="window.open('downloads.php?idu=<?php echo $_SESSION['userid']?>&md=3', 'pop_up', 'toolbar=no, top=0,location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, height=500, width=500')" style="text-decoration:none; color:#CC6600; size:2px"><img src="images/download.gif" border="0"/></a></td></tr>
                            <?php
                            $close_res=mysql_query($close_sql);
                            while($close_row=mysql_fetch_array($close_res))
                            {

                            $user_sql="select * from user_registration where user_id=".$close_row['user_id'];
                            $user_res=mysql_query($user_sql);
                            $user=mysql_fetch_array($user_res);

                            // seller information
                            $sellername=$user[user_name];
                            $expire_date = $close_row[expire_date];
                            require 'ends.php';


                            // count no of bids for this items
                            $tot_bid_sql="select count(*) from placing_bid_item where item_id=".$close_row[item_id];
                            $tot_bid_res=mysql_query($tot_bid_sql);
                            $tot_bids=mysql_fetch_array($tot_bid_res);

                            // current bid amount


                            $bid_sql_max="select MAX(bidding_amount) as amt from placing_bid_item where item_id=".$close_row[item_id];
                            $bid_res_max=mysql_query($bid_sql_max);
                            $bidrow_max=mysql_fetch_array($bid_res_max);
                            $max_item_bid=$bidrow_max['amt'];
                            if(empty($max_item_bid))
                            { 
                            $max_item_bid=$close_row[min_bid_amount];
                            }


                            if($close_row['selling_method']=='fix')
                            $max_item_bid=$close_row['quick_buy_price'];
                            // feedback score



                            ?>
                            <tr class="detail9txt">
                                <td class="tr_botborder" width=5%>&nbsp;

                                </td>
                                <td class="tr_botborder">

                                    <?php
                                    if(!empty($close_row['picture1']))
                                    {
                                    $img=$close_row['picture1'];
                                    list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
                                    $h=$height;
                                    $w=$width;
                                    if($h>50)	
                                    {
                                    $nh=50;
                                    $nw=($w/$h)*$nh;
                                    $h=$nh;
                                    $w=$nw;
                                    }
                                    if($w>50)
                                    {
                                    $nw=50;
                                    $nh=($h/$w)*$nw;
                                    $h=$nh;
                                    $w=$nw;
                                    }
                                    ?>
                                    <img name="runimg" src="thumbnail/<?php echo $close_row['picture1']; ?>" border=1 width=<?php echo  $w; ?> height=<?php echo $h?> >
                                         <?php 
                                         }
                                         else
                                         {
                                         ?>
                                         <img src="images/no_image.gif" border=1  name="runimg" >
                                    <?php
                                    }
                                    ?>


                                </td>
                                <td class="tr_botborder">
                                    <?php  echo $close_row[currency]; ?> <?php echo  number_format(($max_item_bid),2,'.',''); ?> 
                                </td>
                                <td class="tr_botborder">&nbsp;
                                </td>
                                <td class="tr_botborder" width=14%>


                                    <?php
                                    $custom_date=explode(" ",$close_row[bid_starting_date]);
                                    $custom_date1=$custom_date[0];
                                    $custom_time=$custom_date[1];
                                    $custom_date3=substr($custom_date1,"-2");
                                    $custom_date2=explode("-",$custom_date1);
                                    $custom_date1=$custom_date2[0];
                                    $custom_date2=$custom_date2[1];
                                    $custom_date4=$custom_date3."-"."$custom_date2"."-"."$custom_date1"." "."$custom_time";
                                    echo  $custom_date[0];
                                    ?>



                                </td>
                                <td width="11%" class="tr_botborder"><?php  echo $string_difference; ?></td>
                                <td width="23%" class="tr_botborder">
                                    <select name=cbowonaction style="width:100px;" onchange="go_page(this.value, < ?php = $close_row[item_id]; ? > )">
                                        <option value="0">Action</option>
                                        <option value="4">Delete Auction</option>
                                        <?php
                                        $re="select * from placing_item_bid where item_id=$close_row[item_id]";
                                        $re_row=mysql_query($re);
                                        $relist=mysql_fetch_array($re_row);
                                        $repost=$relist[no_of_repost];
                                        if($repost>0)
                                        {
                                        ?>
                                        <option value="14">Relist</option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </td></tr>
                            <tr>
                                <td class="tr_botborder_1">&nbsp;  </td>
                                <td class="tr_botborder_1" colspan=5 align="left">
                                    <a href="<?php if($close_row[selling_method]!=ads) {  ?>detail.php<?php }else{?>classifide_ad.php<?php}?>?item_id=<?php echo  $close_row['item_id']?>" class="header_text">
                                        <?php  echo $close_row['item_title']; ?></a>&nbsp;<font class="detail9txt">(<?php  echo $close_row['item_id']; ?> )</font></td>
                                <td class="tr_botborder_1">&nbsp;  </td></tr>
                            <?php
                            } // while
                            ?>
                            <input type="hidden" name="close_delete" />
                            <input type="hidden"  name=item_id id=item_id />
                            <input type="hidden"  name=itemid />
                            <input type="hidden" name=sellitemid />
                            <input type="hidden" name=mode />
                            <tr>
                                <td colspan="7" class=tr_botborder>
                                    <input type="hidden" name="delete1" value=0>	 
                                </td>
                            </tr>
                        </form>
                    </table>
                </div>
                <?php
                }
                else
                {
                ?>
                <div class="superbg">
                    <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="3%">&nbsp;</td>
                            <td width="97%" class="myauction3txt">There are no items in this section</td>
                        </tr>
                    </table>
                </div>
                <?php
                }
                }
                ?>

            </div>

            <div id="myauctionleft1">

                <?php 
                if($mode=="sell" and  $status=="sold")
                {
                ?>
                <div class="myauction_bg">Item's I've Sold: (<?php echo  $sold_total_records; ?> Items)</div>
                <?php
                if($sold_total_records > 0)
                { 
                $sold_res=mysql_query($sold_sql);
                $sold_row=mysql_fetch_array($sold_res);
                ?>
                <div class="superbg">
                    <table cellspacing="0" cellpadding="5" width=100%>
                        <form name="won_frm" action="myauction.php" method=post>
                            <tr bgcolor="#B8DEEE">
                                <td width=5%>
                                    <input type="hidden" name="len" value="<?php echo mysql_num_rows($won_res)?>">
                                </td>
                                <td width=12% class="detail9txt"><b>Picture</b> </td>
                                <td width="7%" class="detail9txt"><b>Qty </b> </td>
                                <td width="11%" class="detail9txt"><b>Sale Price</b>  </td>
                                <td width="9%" class="detail9txt"><b>Total Price</b>  </td>
                                <td width="10%" class="detail9txt"><b>Sold Date </b> </td>
                                <td width="20%" class="detail9txt"><b>Buyer Id </b> </td>

                                <td width="26%" class="detail9txt"><b>Action </b> </td>
                            </tr>
                            <tr><td colspan="8" align="right">
                                    <a href="#" onclick="window.open('downloads.php?idu=<?php echo $_SESSION['userid']?>&md=2', 'pop_up', 'toolbar=no, top=0,location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, height=500, width=500')" style="text-decoration:none; color:#CC6600; size:2px; font-weight:bold" title="Download Sold Auction details in Excel Format"> Download Sold Auction Details</a><a href="#" onclick="window.open('downloads.php?idu=<?php echo $_SESSION['userid']?>&md=2', 'pop_up', 'toolbar=no, top=0,location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, height=500, width=500')" style="text-decoration:none; color:#CC6600; size:2px"><img src="images/download.gif" border="0"/></a></td></tr>
                            <?php
                            $sold_res=mysql_query($sold_sql);
                            while($sold_row=mysql_fetch_array($sold_res))
                            {
                            // buyer information

                            // $bid_sql="select * from placing_bid_item where user_pos='Yes' and item_id=".$sold_row[item_id];
                            $bid_sql="select * from placing_bid_item where bid_id=".$sold_row[bid_id];
                            $bid_res=mysql_query($bid_sql);
                            $bid=mysql_fetch_array($bid_res);
                            $bid_date=$bid['bidding_date'];
                            $buyerid=$bid['user_id'];
                            //
                            $user_sql="select * from user_registration where user_id=".$buyerid;
                            $user_res=mysql_query($user_sql);
                            $user=mysql_fetch_array($user_res);
                            $buyername=$user[user_name];

                            $feed_sql="select count(*) as feedbacktotal from feedback where feedback_type='Positive' and  feedback_to=".$buyerid;
                            $feed_recordset=mysql_query($feed_sql);
                            $feed_tot=mysql_fetch_array($feed_recordset);


                            $feedbackicon_sql="select * from membership_level where feedback_score_from <= "." $feed_tot[feedbacktotal] "." and  feedback_score_to >= "." $feed_tot[feedbacktotal] " ;
                            $feedbackicon_res=mysql_query($feedbackicon_sql);
                            $feedbackicon_row=mysql_fetch_array($feedbackicon_res); 
                            $feedback_img=$feedbackicon_row[icon];


                            $sql_dispute_sold="select * from disputeconsole where itemid=".$sold_row['item_id']." and dispute_by=".$_SESSION['userid'];
                            $sqlqry_dispute_sold=mysql_query($sql_dispute_sold);
                            $dispute_rows_sold=mysql_num_rows($sqlqry_dispute_sold);



                            ?>
                            <tr class="detail9txt">
                                <td class="tr_botborder" width=5%>&nbsp; 
                                </td>
                                <td class="tr_botborder">

                                    <?php
                                    if(!empty($sold_row['picture1']) && file_exists("thumbnail/".$sold_row['picture1']))
                                    {
                                    $img=$sold_row['picture1'];
                                    list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
                                    $h=$height;
                                    $w=$width;
                                    if($h>50)	
                                    {
                                    $nh=50;
                                    $nw=($w/$h)*$nh;
                                    $h=$nh;
                                    $w=$nw;
                                    }
                                    if($w>50)
                                    {
                                    $nw=50;
                                    $nh=($h/$w)*$nw;
                                    $h=$nh;
                                    $w=$nw;
                                    }
                                    ?>
                                    <img name="runimg" src="thumbnail/<?php echo $sold_row['picture1']; ?>" border=1 width=<?php echo  $w; ?> height=<?php echo $h?> >
                                         <?php 
                                         }
                                         else
                                         {
                                         ?>
                                         <img src="images/no_image.gif" border=1  name="runimg" >
                                    <?php
                                    }
                                    ?>


                                </td>

                                <td class="tr_botborder"><?php  echo $sold_row['quantity']; ?> </td>
                                <td class="tr_botborder"><?php  echo $sold_row['currency']; ?>&nbsp;<?php echo number_format(($sold_row['sale_price']),2,'.','');   ?> </td>
                                <td class="tr_botborder"><?php  echo $sold_row['currency']; ?>&nbsp;<?php  echo number_format(($sold_row['quantity']* $sold_row['sale_price']),2,'.',''); ?> </td>
                                <td class="tr_botborder">
                                    <?php
                                    $custom_date=explode(" ",$sold_row['sale_date']);
                                    $custom_date1=$custom_date[0];
                                    $custom_time=$custom_date[1];
                                    $custom_date3=substr($custom_date1,"-2");
                                    $custom_date2=explode("-",$custom_date1);
                                    $custom_date1=$custom_date2[0];
                                    $custom_date2=$custom_date2[1];
                                    $custom_date4=$custom_date3."-"."$custom_date2"."-"."$custom_date1"." "."$custom_time";
                                    echo  $custom_date[0];
                                    ?>
                                </td>
                                <td class="tr_botborder">&nbsp;
                                    <a href="feedback.php?user_id=<?php echo $buyerid;?>" class="header_text">
                                        <?php echo $user['user_name']; ?></a>
                                    <?php 
                                    if($feed_tot[feedbacktotal]!=0)
                                    {
                                    ?>
                                    <!--&nbsp;&nbsp;&nbsp;&nbsp;( <a href="feedback.php?user_id=<?php echo $buyerid;?>" class="header_text"><?php echo $feed_tot[feedbacktotal];?></a><img src="images/<?php echo  $feedback_img ?>"/>)-->
                                    <?php
                                    }
                                    ?>
                                </td>

                                <td class="tr_botborder">
                                    <select name=select style="width:100px;" onchange="go_page_link1(this.value, '<?php echo  $sold_row[item_id]; ?>', < ?php = $buyerid ? > , < ?php = $bid['bid_id']; ? > )">
                                        <option value="0">Action</option>
                                        <?php 
                                        $leave="select * from feedback where seller_id=$user_id and item_id=".$sold_row[item_id];
                                        $leave_res=mysql_query($leave);
                                        $leave_row=mysql_num_rows($leave_res);
                                        if($leave_row==0)
                                        {
                                        ?>
                                        <option value="7">Leave Feedback</option>
                                        <?php
                                        }
                                        if($dispute_rows_sold==0)
                                        {
                                        ?>
                                        <option value="9">Report an Unpaid Item</option>
                                        <?php
                                        }
                                        ?>


                                    </select></td> 
                            </tr>
                            <tr>
                                <td class="tr_botborder_1">&nbsp;  </td>
                                <td class="tr_botborder_1" colspan=6 align="left">
                                    <a href="<?php if($sold_row[selling_method]!=ads) {  ?>detail.php<?php }else{?>classifide_ad.php<?php}?>?item_id=<?php echo  $sold_row['item_id']?>" class="header_text">
                                        <?php  echo $sold_row['item_title']; ?></a>&nbsp;<font class="detail9txt">(<?php  echo $sold_row['item_id']; ?> )</font></td>
                                <td class="tr_botborder_1"><font color="#FF0000" size="2px"><b><?phpif($sold_row['payment_status']=='paid'){echo "Payment Done";}?></b></font>&nbsp;  </td></tr>
                            <?php
                            } // while
                            ?>
                            <input type="hidden" name="buyer_id"  />
                            <input type="hidden" name="item_id"  />
                            <input type="hidden" name="bid_id"  />
                            <input type="hidden" name="radfeedback"  />
                            <input type="hidden" name="won_delete" />
                            <input type="hidden" name="itemdelievered"  />
                            <tr> <td colspan="9" class=tr_botborder> <!-- <input type="button" value=Delete name="conf" onClick="del()" class=buttonbig>-->&nbsp;
                                </td> 
                            </tr>
                        </form>
                    </table>
                </div>
                <?php
                }
                else
                {
                ?>
                <div class="superbg">
                    <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="3%">&nbsp;</td>
                            <td width="97%" class="myauction3txt">There are no items in this section</td>
                        </tr>
                    </table>
                </div>
                <?php
                }
                ?>






                <?php
                }
                ?>  
            </div>



            <div id="myauctionleft1">
                <?php 
                if($mode=="won" or $mode=="")
                {
                $total_feedback=$won_total_records+$sold_total_records;
                $paid_sql="select * from placing_bid_item a,placing_item_bid b where a.user_id=$user_id and a.item_id=b.item_id and a.user_pos='Yes' and b.payment_status='unpaid' group by b.item_id";
                $paid_res=mysql_query($paid_sql);
                $paid_records=mysql_num_rows($paid_res);

                $leave_row="select * from feedback where buyer_id=$user_id";
                $leave_row_res=mysql_query($leave_row);
                $leave_row=mysql_num_rows($leave_row_res);
                $leave_row1="select * from feedback where seller_id=$user_id";
                $leave_row1_res=mysql_query($leave_row1);
                $leave_row1=mysql_num_rows($leave_row1_res);
                $total_feedback=$total_feedback-($leave_row+$leave_row1);
                ?>
                <div class="myauction_bg">Item&rsquo;s I&rsquo;ve Won: (<?php if ($won_total_records > 0) echo $won_total_records; else echo "No";?>&nbsp;Items)</div>

                <div class="superbg"> 
                    <!--<table cellpadding="5" cellspacing="2" width=100%>
                    <tr>
                    <td align="left"  height=30 width =560>
                    <font class="searchresult3txt"><b>Buying Remainders</b></font></td></tr>
                    <tr class="searchresult3txt"><td>&nbsp;<img src="images/ico-dollar.gif" border=0/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I need to pay for <a href="myauction.php?mode=won&#wondetails" class="header_text"><?php echo  $paid_records; ?> item</a></td></tr>
                    <tr class="searchresult3txt"><td><img src="images/folders(37).gif" border=0/>&nbsp;&nbsp;&nbsp;I need to leave feedback for <a href="myauction.php?mode=won&#wondetails" class="header_text"><?php echo  $total_feedback; ?> item</a></td></tr>
                    </table>
                    
                    <table cellpadding="0" cellspacing="0" width=100%>
                    <tr><td  height=30 width=100% id=wondetails>
                    
                    <table cellpadding="5" cellspacing="2" width=100% >
                    <tr class="tr_botborder">
                    <td align="left" width=100% class="detail9txt">
                    <b>&nbsp;&nbsp;Item's I've Won:&nbsp;&nbsp;&nbsp;</b>(<?php if ($won_total_records > 0) echo $won_total_records; else echo "No";?>&nbsp;Items)</b></td>-->
                    <td align="right" width=10>
                        <!--<a href="myauction.php?#wondetails">
                        <img src="images/leasing-arrows-up.gif" border=0></a>--></td>
                    <td align="right" width=10>
                        <!--<a href="myauction.php?#didntwindetails">
                        <img src="images/leasing-arrows-dn.gif" border=0>
                        </a>--></td>
                    </tr></table>
                    </td></tr></table>
                </div>
                <?php
                if($won_total_records > 0)
                { 
                ?>
                <div class="superbg">
                    <table cellspacing="0" cellpadding="5" width=100%>
                        <form name="won_frm" action="myauction.php" method=post>
                            <tr bgcolor="#B8DEEE">
                                <td width=5% class="detail9txt">
                                    <input type="hidden" name="len" value="<?php echo mysql_num_rows($won_res)?>">
                                    <input type="checkbox" name="chkMain" onClick="won_selectall()" id="chkMain"> </td>
                                <td width=22% class="detail9txt"><b>Seller Id</b> </td>
                                <td width="5%" class="detail9txt"><b>Qty </b> </td>
                                <td width="15%" class="detail9txt"><b>Sale Price</b>  </td>
                                <td width="16%" class="detail9txt"><b>Total Price</b>  </td>
                                <td width="15%" class="detail9txt"><b>Sale Date </b> </td>
                                <td width="22%" class="detail9txt"><b>Action </b> </td>
                            </tr>
                            <?php
                            $won_res=mysql_query($won_sql);
                            while($won_row=mysql_fetch_array($won_res))
                            {
                            // seller information
                            $user_sql="select * from user_registration where user_id=".$won_row['user_id'];
                            $user_res=mysql_query($user_sql);
                            $user=mysql_fetch_array($user_res);
                            $sellername=$user[user_name];

                            $feed_sql="select count(*) as feedbacktotal from feedback where feedback_type='Positive' and  feedback_to=".$won_row['user_id'];
                            $feed_recordset=mysql_query($feed_sql);
                            $feed_tot=mysql_fetch_array($feed_recordset);
                            $feedbackicon_sql="select * from membership_level where feedback_score_from <= "." $feed_tot[feedbacktotal] "." and      feedback_score_to >= "." $feed_tot[feedbacktotal] " ;
                            $feedbackicon_res=mysql_query($feedbackicon_sql);
                            $feedbackicon_row=mysql_fetch_array($feedbackicon_res); 
                            $feedback_img=$feedbackicon_row[icon];

                            $sql_dispute_won="select * from disputeconsole where itemid=".$won_row['item_id']." and dispute_by=".$_SESSION['userid'];
                            $sqlqry_dispute_won=mysql_query($sql_dispute_won);
                            $dispute_rows_won=mysql_num_rows($sqlqry_dispute_won);


                            ?>
                            <tr class="detail9txt">
                                <td class="tr_botborder" width=5%>
                                    <input type="checkbox" name=chkbox[] id="chkbox" value="<?php  echo $won_row['item_id']; ?>"></td>
                                <td class="tr_botborder" width=22%>
                                    <a href="feedback.php?user_id=<?php echo $won_row['user_id'];?>" class="header_text">
                                        <?php echo $user['user_name'];?></a>
                                    <?php 
                                    if($feed_tot[feedbacktotal]!=0)
                                    {
                                    ?>
                                    &nbsp;&nbsp;&nbsp;&nbsp;( <a href="feedback.php?user_id=<?php echo $won_row['user_id'];?>" class="header_text"><?php echo $feed_tot[feedbacktotal]; ?></a><img src="images/<?php echo  $feedback_img ?>"/>)
                                    <?php
                                    }
                                    ?></td>
                                <td class="tr_botborder"><?php  echo $won_row['quantity']; ?></td>
                                <td class="tr_botborder"><?php  echo $won_row['currency']; ?>&nbsp;
                                    <?php echo  number_format(($won_row['sale_price']),2,'.',''); ?>
                                </td>
                                <td class="tr_botborder"><?php  echo $won_row['currency']; ?>&nbsp;
                                    <?php echo  number_format(($won_row['quantity'] * $won_row['sale_price']),2,'.',''); ?> </td>
                                <td class="tr_botborder">


                                    <?php // echo $won_row['bidding_date']; ?>


                                    <?php

                                    $custom_date=explode(" ",$won_row[sale_date]);
                                    $custom_date1=$custom_date[0];
                                    $custom_time=$custom_date[1];
                                    $custom_date3=substr($custom_date1,"-2");
                                    $custom_date2=explode("-",$custom_date1);
                                    $custom_date1=$custom_date2[0];
                                    $custom_date2=$custom_date2[1];
                                    $custom_date4=$custom_date3."-"."$custom_date2"."-"."$custom_date1"." "."$custom_time";
                                    echo  $custom_date[0];

                                    ?></td>
                                <td class="tr_botborder">
                                    <?php $var=$won_row[user_id]."-".$won_row[item_id]; ?>
                                    <select name=select style="width:100px; font-size:10px;" onchange="go_page_link2(this.value, '<?php echo  $won_row[item_id]; ?>', < ?php = $won_row[user_id] ? > , < ?php = $won_row[bid_id] ? > )">
                                        <option value="0">Action</option>
                                        <?php
                                        if($won_row['payment_status']=='unpaid')
                                        {
                                        ?>
                                        <option value="4">Pay Now</option>
                                        <?php
                                        }
                                        ?>
                                        <option value="5">Sellers' Other Items</option>
                                        <option value="8">Track This Item</option>
                                        <!--<option value="11">Mark as Paid</option>-->
                                        <?php
                                        if($dispute_rows_won==0)
                                        {
                                        ?>
                                        <option value="10">Report an Item Not Received</option>
                                        <?php
                                        }
                                        ?>
                                        <?php 
                                        $leave="select * from feedback where buyer_id=$user_id and item_id=".$won_row[item_id];
                                        $leave_res=mysql_query($leave);
                                        $leave_row=mysql_num_rows($leave_res);
                                        if($leave_row==0)
                                        {
                                        ?>
                                        <option value="6">Leave Feedback</option>
                                        <?php
                                        }
                                        ?>
                                    </select></td>
                            </tr>
                            <tr>
                                <td class="tr_botborder_1">&nbsp;  </td>
                                <td class="tr_botborder_1" colspan=4 align="left">
                                    <a href="<?php if($won_row[selling_method]!=ads) {  ?>detail.php<?php }else{?>classifide_ad.php<?php}?>?item_id=<?php echo  $won_row['item_id']?>" class="header_text">
                                        <?php  echo $won_row['item_title']; ?></a>&nbsp;<font class="detail9txt">(<?php  echo $won_row['item_id']; ?> )</font></td>
                                <td colspan="2" align="right"><font color="#FF0000" size="2px"><b><?phpif($won_row['payment_status']=='paid'){echo "Payment Done";}?></b></font>&nbsp;</td>
                            </tr>
                            <?php
                            } // while
                            ?>
                            <input type="hidden" name="won_delete" />
                            <input type="hidden" name="seller_id"  />
                            <input type="hidden" name="item_id"  />
                            <input type="hidden" name="bid_id"  />
                            <input type="hidden" name="radfeedback"  />
                            <input type="hidden" name="itempaid"  />
                            <input type="hidden" name="mode" />
                            <tr><td colspan="8" class=tr_botborder align="center">
                                    <input type=image src="images/delete.gif" name="Image76" width="62" height="22" border="0" id="Image76" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image76', '', 'images/deleteo.gif', 1)" onClick="return del()"/>
                                </td>
                            </tr>
                        </form>
                    </table></div>
                <?php
                }
                else
                {
                ?>

                <div class="superbg">
                    <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="3%">&nbsp;</td>
                            <td width="97%" class="myauction3txt"> <div align="left">You do not have any Won items to display at this time.</div></td>
                        </tr>
                    </table>
                </div>

                <?php
                }
                }
                ?>


            </div>


            <div id="myauctionleft1">
                <?php
                if($mode=="didntwin" or $mode=="")
                {
                ?>

                <div class="myauction_bg">Item&rsquo;s I Didn&rsquo;t Win:( 
                    <?php if($didntwin_total_records==1 ) { echo "$didntwin_total_records"."&nbsp;".Items; } else if($didntwin_total_records > 1)
                    { echo "$didntwin_total_records"."&nbsp;".Item; } else echo "No Items";?> )</div>
                <div class="superbg">
                    <table width="100%" height="70" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="3%">&nbsp;</td>
                            <td width="97%" class="myauction3txt"><span class="searchresult9txt">This is your &quot;Items I Didn't Win&quot; view.</span> Details about all of the items you bid on but didn't win will <br />
                                display here. From this view, you'll be able to see the ending price of the items you bid on, as <br />
                                well as look for similar items. </td>
                        </tr>
                    </table>
                </div>


                <?php
                if($didntwin_total_records > 0)
                { 
                ?>
                <div class="superbg">
                    <table cellspacing="0" cellpadding="5" width=100%>
                        <form name="didntwin_frm" action="myauction.php" method=post>
                            <tr bgcolor="#B8DEEE">
                                <td  width=14% class="detail9txt"><b>Sale Price</b> </td>
                                <td width="12%" class="detail9txt"><b>My Maxbid</b> </td>
                                <td width="6%" class="detail9txt"><b>Bids</b>  </td>
                                <td width="9%" class="detail9txt"><b>End date</b>  </td>
                                <td colspan="3" class="detail9txt"><b> Action </b> </td>
                            </tr>
                            <?php

                            $didntwin_res=mysql_query($didntwin_sql);
                            while($didntwin_row=mysql_fetch_array($didntwin_res))
                            {

                            $count_items_sql="select * from placing_bid_item where user_id=$user_id and user_pos='Yes' and item_id=".$didntwin_row[item_id];
                            $count_items_res=mysql_query($count_items_sql);
                            $count_items=mysql_num_rows($count_items_res);

                            if($count_items==0)
                            {
                            // seller information
                            $user_sql="select * from user_registration where user_id=".$didntwin_row['user_id'];
                            $user_res=mysql_query($user_sql);
                            $user=mysql_fetch_array($user_res);
                            $sellername=$user[user_name];

                            $expire_date=substr($didntwin_row['expire_date']," ");
                            $expire_date=$expire_date[0];
                            require 'ends.php';
                            // count no of bids for this items
                            $tot_bid_sql="select count(*) from placing_bid_item where item_id=".$didntwin_row[item_id];
                            $tot_bid_res=mysql_query($tot_bid_sql);
                            $tot_bids=mysql_fetch_array($tot_bid_res);

                            $bid_sql_max="select MAX(bidding_amount) as amt from placing_bid_item where item_id=".$didntwin_row[item_id]." and user_id=".$_SESSION[userid]." and deleted='No'";
                            $bid_res_max=mysql_query($bid_sql_max);
                            $bidrow_max=mysql_fetch_array($bid_res_max);
                            $max_item_bid=$bidrow_max['amt']; 

                            ?>
                            <tr class="detail9txt">
                                <td class="tr_botborder"><?php  echo $didntwin_row['currency']; ?>&nbsp;<?php echo  number_format(($didntwin_row['sale_price']),2,'.',''); ?> </td>
                                <td class="tr_botborder"><?php  echo $didntwin_row['currency']; ?>&nbsp;<?php echo  number_format($max_item_bid,2,'.',''); ?> </td>
                                <td class="tr_botborder">
                                    <a href="bidhistory.php?item_id=<?php echo  $didntwin_row['item_id']?>" class="header_text"><?php echo $tot_bids[0];?></a>
                                </td>
                                <td width="9%" class="tr_botborder"><?php$saledate_didwin=explode(" ",$didntwin_row['sale_date']); echo $saledate_didwin[0];?></td>
                                <td class="tr_botborder" colspan="3">
                                    <a href="search.php?seller_id=<?php echo $didntwin_row['user_id']; ?>&mode=sellers_item" class="header_text">Seller's other items</a>  </td>
                            </tr>
                            <tr>
                                <td class="tr_botborder_1" colspan=5 align="left">
                                    <a href="<?php if($didntwin_row[selling_method]!=ads) {  ?>detail.php<?php }else{?>classifide_ad.php<?php}?>?item_id=<?php echo  $didntwin_row['item_id']?>" class="header_text">
                                        <?php  echo $didntwin_row['item_title']; ?></a>&nbsp;<font class="detail9txt">(<?php  echo $didntwin_row['item_id']; ?> )</font></td>
                                <td width="17%" class="tr_botborder_1">&nbsp;  </td>
                            </tr>
                            <?php
                            }
                            } // while
                            ?>
                            <input type="hidden" name="didnt_delete" />
                        </form>
                    </table>
                </div>
                <?php
                }
                else
                {
                ?>
                <div class="superbg">
                    <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="3%">&nbsp;</td>
                            <td width="97%" class="myauction3txt"> <div align="left">You do not have any Didn't Win items to display at this time.</div></td>
                        </tr>
                    </table>
                </div>
                <?php
                }
                }
                ?>
            </div>


            <div id="myauctionleft1">
                <?php
                if($mode=="bid" or $mode=="")
                {
                ?>

                <div class="myauction_bg">Items I'm Bidding On: ( 
                    <?php if($bid_total_records == 1 ) { echo "$bid_total_records"."&nbsp;".Items; } else if($bid_total_records > 1)
                    { echo "$bid_total_records"."&nbsp;".Item; } else echo "No Items";?> ) </div>
                <?php
                if($bid_total_records > 0)
                { 
                ?>
                <div class="superbg">
                    <table cellspacing="0" cellpadding="5" width=100%>
                        <form name="bid_frm" action="myauction.php" method=post>
                            <tr bgcolor="#B8DEEE">
                                <td width=5% class="detail9txt">
                                    <input type="hidden" name="len" value="<?php echo mysql_num_rows($won_res)?>">
                                <td width="9%" class="detail9txt"><b>My Maxbid</b> </td>
                                <td  width=4% class="detail9txt"><b>Qty</b> </td>
                                <td width="30%" class="detail9txt"><b>Tot. Bidding Amount</b>  </td>
                                <td width="14%" class="detail9txt"><b>Bid date</b>  </td>
                                <td width="18%" class="detail9txt"><b>Expire date</b>  </td>
                                <td  colspan="2" class="detail9txt"><b>Action </b> </td>
                            </tr>
                            <?php
                            $bid_res=mysql_query($bidding_sql);
                            while($bid_row=mysql_fetch_array($bid_res))
                            {
                            // seller information
                            $user_sql="select * from user_registration where user_id=".$bid_row['user_id'];
                            $user_res=mysql_query($user_sql);
                            $user=mysql_fetch_array($user_res);
                            $sellername=$user[user_name];
                            //$expire_date1=explode(" ",$bid_row['expire_date']);
                            $expire_date=$bid_row['expire_date'];
                            require 'ends.php';

                            // count no of bids for this items
                            $tot_bid_sql="select count(*) from placing_bid_item where item_id=".$bid_row[item_id]." and deleted='No'";
                            $tot_bid_res=mysql_query($tot_bid_sql);
                            $tot_bids=mysql_fetch_array($tot_bid_res);

                            //maxbid for the item
                            $max_bid_sql="select max(bidding_amount) from placing_bid_item where item_id=".$bid_row['item_id']." and user_id=".$_SESSION[userid]." and deleted='No'";
                            $max_bid_qry=mysql_query($max_bid_sql);
                            $max_bid_row=mysql_fetch_array($max_bid_qry);
                            ?>
                            <tr class="detail9txt">
                                <td class="tr_botborder" width=5%>
                                </td>

                                <td class="tr_botborder"><?php  echo $bid_row['currency']; ?>
                                    <?php echo  number_format(($max_bid_row[0]),2,'.',''); ?> </td>
                                <td class="tr_botborder"><?php  echo $bid_row['quantity']; ?> </td>
                                <td class="tr_botborder"><?php  echo $bid_row['currency']; ?>
                                    <?php echo  number_format(($max_bid_row[0] * $bid_row['quantity']),2,'.',''); ?></a> </td>
                                <td width="14%" class="tr_botborder">
                                    <?php
                                    $custom_date=explode(" ",$bid_row[bidding_date]);
                                    $custom_date1=$custom_date[0];
                                    $custom_time=$custom_date[1];
                                    $custom_date3=substr($custom_date1,"-2");
                                    $custom_date2=explode("-",$custom_date1);
                                    $custom_date1=$custom_date2[0];
                                    $custom_date2=$custom_date2[1];
                                    $custom_date4=$custom_date3."-"."$custom_date2"."-"."$custom_date1"." "."$custom_time";
                                    echo  $custom_date[0];
                                    ?></td>
                                <td width="18%" class="tr_botborder"><?php  echo $string_difference; ?></td>
                                <td width="20%" class="tr_botborder">
                                    <select name=cbowonaction style="width:100px; font-size:10px;" onchange="go_page_link(this.value, '<?php echo  $bid_row['item_id']; ?>', '<?php echo  $bid_row['user_id']; ?>')">
                                        <option value="0">Action</option>
                                        <option value="1">Sellers' Other Items</option>
                                        <option value="2">Contact Sellers</option>
                                        <option value="3">Bid Retract</option> 
                                    </select>
                                </td>

                            </tr>
                            <tr>
                                <td class="tr_botborder">&nbsp;  </td>
                                <td class="tr_botborder" colspan=5 align="left">
                                    <a href="<?php if($bid_row[selling_method]!=ads) {  ?>detail.php<?php }else{?>classifide_ad.php<?php}?>?item_id=<?php echo  $bid_row['item_id']?>" class="header_text">
                                        <?php  echo $bid_row['item_title']; ?></a>&nbsp;<font class="detail9txt">(<?php  echo $bid_row['item_id']; ?> )</font></td>
                                <td class="tr_botborder">&nbsp;  </td></tr>
                            <?php
                            } // while
                            ?>
                            <input type="hidden" name="bid_delete" />
                            <input type="hidden" name="item_id" />
                            <input type="hidden" name="seller_id" />
                            <input type="hidden" name="go_link" />
                            <input type="hidden" name="mode" />
                            <tr><td colspan="7" class=tr_botborder>
                            </tr>
                        </form>
                    </table>
                </div>
                <?php
                }
                else
                {
                ?>
                <div class="superbg">
                    <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="3%">&nbsp;</td>
                            <td width="97%" class="myauction3txt">There are no items in this section</td>
                        </tr>
                    </table>
                </div>
                <?php
                }
                }
                ?>
            </div>

            <div id="myauctionleft1">
                <?php
                if($mode=="watch" or $mode=="")
                {
                ?>
                <div class="myauction_bg">Items I'm Watching: ( 
                    <?php if($watch_total_records == 1 ) { echo "$watch_total_records"."&nbsp;".Items; } else if($watch_total_records > 1)
                    { echo "$watch_total_records"."&nbsp;".Items; } else echo "No Item";?> ) </div>

                <?php
                if($watch_total_records > 0)
                { 
                ?>
                <div class="superbg">
                    <table cellspacing="0" cellpadding="5" width=100%>
                        <form name="watch_form" action="myauction.php" method=post>
                            <tr bgcolor="#B8DEEE">
                                <td width=4%>
                                    <input type="hidden" name="len" value="<?php echo  $watch_total_records?>">
                                    <input type="checkbox" name="chkMain" onClick="selectall()" id="chkMain"> </td>
                                <td  width=13% class="detail9txt"><b>Picture</b> </td>
                                <td width="19%" class="detail9txt"><b>Current bid</b> </td>
                                <td width="6%" class="detail9txt"><b>Bids</b>  </td>
                                <td width="22%" class="detail9txt"><b>Seller Id</b>  </td>
                                <td width="16%" class="detail9txt"><b>End date</b>  </td>
                                <td colspan="2" class="detail9txt"><b>Action </b> </td>
                            </tr>
                            <?php

                            $watch_res=mysql_query($watch_sql);
                            while($watch_row=mysql_fetch_array($watch_res))
                            {
                            $sql="select * from placing_item_bid where item_id=$watch_row[item_id]";
                            $result=mysql_query($sql);
                            $row=mysql_fetch_array($result);

                            $user_sql="select * from user_registration where user_id=".$row['user_id'];
                            $user_res=mysql_query($user_sql);
                            $user=mysql_fetch_array($user_res);

                            // seller information
                            $sellername=$user[user_name];
                            $expire_date = $row[expire_date];
                            require 'ends.php';
                            // count no of bids for this items

                            $tot_bid_sql="select count(*) from placing_bid_item where item_id=".$watch_row[item_id];
                            $tot_bid_res=mysql_query($tot_bid_sql);
                            $tot_bids=mysql_fetch_array($tot_bid_res);

                            // current bid amount
                            //$bid_sql_max="select MAX(duplicate_bidding_amt) as amt from placing_bid_item where item_id=".$watch_row[item_id];
                            $bid_sql_max="select MAX(bidding_amount) as amt from placing_bid_item where item_id=".$watch_row[item_id];
                            $bid_res_max=mysql_query($bid_sql_max);
                            $bidrow_max=mysql_fetch_array($bid_res_max);
                            $max_item_bid=$bidrow_max['amt'];
                            if($row['selling_method']=="auction" or $row['selling_method']=="dutch_auction")
                            {
                            if(empty($max_item_bid))
                            { 
                            $max_item_bid=$row[min_bid_amount];
                            }
                            }
                            else
                            {
                            $max_item_bid=$row['quick_buy_price'];
                            }

                            // feedback score


                            $feed_sql="select count(*) as feedbacktotal from feedback where feedback_type='Positive' and  feedback_to=".$row['user_id'];
                            $feed_recordset=mysql_query($feed_sql);
                            $feed_tot=mysql_fetch_array($feed_recordset);

                            $feedbackicon_sql="select * from membership_level where feedback_score_from <= "." $feed_tot[feedbacktotal] "." and  feedback_score_to >= "." $feed_tot[feedbacktotal] " ;
                            $feedbackicon_res=mysql_query($feedbackicon_sql);
                            $feedbackicon_row=mysql_fetch_array($feedbackicon_res); 
                            $feedback_img=$feedbackicon_row[icon];

                            ?>
                            <tr class="detail9txt">
                                <td class="tr_botborder" width=4%>
                                    <input type="checkbox" name=chkbox[] id="chkbox" value="<?php  echo $watch_row['watchlist_id']; ?>">
                                </td>
                                <td class="tr_botborder">

                                    <?php			   if(!empty($row['picture1']))
                                    {
                                    $img=$row['picture1'];
                                    list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
                                    $h=$height;
                                    $w=$width;
                                    if($h>50)	
                                    {
                                    $nh=50;
                                    $nw=($w/$h)*$nh;
                                    $h=$nh;
                                    $w=$nw;
                                    }
                                    if($w>50)
                                    {
                                    $nw=50;
                                    $nh=($h/$w)*$nw;
                                    $h=$nh;
                                    $w=$nw;
                                    }
                                    ?>
                                    <img name="runimg" src="thumbnail/<?php echo $row['picture1']; ?>" border=1 width=<?php echo  $w; ?> height=<?php echo $h?> >
                                         <?php 
                                         }
                                         else
                                         {
                                         ?>
                                         <img src="images/no_image.gif" border=1  name="runimg" >
                                    <?php
                                    }
                                    ?>


                                </td>
                                <td class="tr_botborder">
                                    <?php  echo $row[currency]; ?> <?php echo  number_format(($max_item_bid),2,'.',''); ?> 
                                </td>
                                <td class="tr_botborder">
                                    <?php
                                    if($tot_bids[0]!=0)
                                    {
                                    ?>
                                    <a href="bidhistory.php?item_id=<?php echo  $row['item_id']?> " alt="Click here to view Bid details"><?php echo $tot_bids[0];?></a>
                                    <?php
                                    }
                                    else
                                    {
                                    echo $tot_bids[0];
                                    }
                                    ?>
                                </td>
                                <td class="tr_botborder" width=22%>
                                    <a href="feedback.php?user_id=<?php echo $watch_row['user_id'];?>" class="header_text">
                                        <?php echo $user['user_name'];?> </a>
                                    <?php 
                                    if($feed_tot[feedbacktotal]!=0)
                                    {
                                    ?>
                                    &nbsp;&nbsp;( <a href="feedback.php?user_id=<?php echo $watch_row['user_id'];?>" class="header_text">
                                        <?php echo $feed_tot[feedbacktotal]; ?></a><img src="images/<?php echo  $feedback_img ?>"/>)
                                    <?php
                                    }
                                    ?></td>
                                <td width="16%" class="tr_botborder"><?php  echo $string_difference; ?></td>
                                <td class="tr_botborder" colspan="2">
                                    <select name=cbowonaction style="width:100px; font-size:10px;" onchange="go_page(this.value, < ?php = $watch_row[user_id]; ? > )" >
                                        <option value="0">Action</option>
                                        <option value="5">Sellers' Other Items</option>
                                    </select>
                                </td>

                            </tr>
                            <tr>
                                <td class="tr_botborder_1">&nbsp;  </td>
                                <td class="tr_botborder_1" colspan=7 align="left">
                                    <a href="<?php if($row[selling_method]!=ads) {  ?>detail.php<?php }else{?>classifide_ad.php<?php}?>?item_id=<?php echo  $row['item_id']?>" class="header_text">
                                        <?php  echo $row['item_title']; ?></a>&nbsp;<font class="detail9txt">(<?php  echo $row['item_id']; ?> )</font></td>
                                <!--<td width="4%" class="tr_botborder_1">&nbsp;  </td>
                                <td width="16%" class="tr_botborder_1">&nbsp;  </td>-->
                            </tr>
                            <?php
                            } // while
                            ?>
                            <input type="hidden" name="won_delete" />
                            <input type="hidden" name="seller_id" />
                            <input type="hidden" name="mode" />

                            <tr><td colspan="8" class=tr_botborder align="center">

                                    <input type="image" src="images/compare.gif" name="Image74" width="81" height="24" border="0" id="Image74" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image74', '', 'images/compareo.gif', 1)" onClick="com()"/>

                                    <input type="image" src="images/delete.gif" name="Image76" width="62" height="22" border="0" id="Image76" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image76', '', 'images/deleteo.gif', 1)" onClick="return watch_del()"/>


                                    <input type="image" src="images/deleteall.gif" name="Image72" width="81" height="24" border="0" id="Image72" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image72', '', 'images/deleteallo.gif', 1)" onClick="return watch_del1()"/>

                                    <input type="image" src="images/watchall.gif" name="Image73" width="81" height="24" border="0" id="Image73" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image73', '', 'images/watchallo.gif', 1)" onClick="watch_all()"/> 

                                    <input type="hidden" name="watch" value=<?php echo  $user_id; ?>>
                                           <input type="hidden" name="item_id" />
                                    <input type="hidden" name="delete1" value=0>	
                                </td>
                            </tr>
                        </form>
                    </table>
                </div>
                <?php
                }
                else
                {
                ?>
                <div class="superbg">
                    <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="3%">&nbsp;</td>
                            <td width="97%" class="myauction3txt">There are no items in this section</td>
                        </tr>
                    </table>
                </div>
                <?php
                }
                }
                ?>
            </div>

            <div id="myauctionleft1">
                <?php
                if($mode=="want" and $status=='Active')
                {
                ?>
                <div class="myauction_bg">Item&rsquo;s Posted Under Wanted Ad  (
                    <?php if($want_total_records == 1 )
                    { echo "$want_total_records"."&nbsp;".Items; } else if($want_total_records > 1)
                    { echo "$want_total_records"."&nbsp;".Item; } else echo "No Items";?> )</div>

                <?php
                if($want_total_records > 0)
                { 
                ?>
                <div class="superbg">
                    <table cellspacing="0" cellpadding="5" width=100%>
                        <form name="want_form" action="myauction.php" method=post>
                            <tr bgcolor="#B8DEEE" class="detail9txt">
                                <td width=3%>
                                    <input type="hidden" name="len" value="<?php echo  $want_total_records?>">
                                </td>
                                <td width=12%><b>Picture</b> </td>
                                <td width="13%"><b>Responses</b>  </td>
                                <td colspan="2"><b>Last Response Date</b>  </td>
                                <td width="19%"><b>Time Left</b>  </td>
                                <td colspan="2"><b>Action </b> </td>
                            </tr>
                            <?php
                            $want_res=mysql_query($want_sql);
                            while($want_row=mysql_fetch_array($want_res))
                            {
                            $user_sql="select * from user_registration where user_id=".$want_row['user_id'];
                            $user_res=mysql_query($user_sql);
                            $user=mysql_fetch_array($user_res);

                            // seller information
                            $sellername=$user[user_name];
                            $expire_date = $want_row[expire_date];
                            require 'ends.php';

                            // count no of wanted  for this items //

                            $tot_bid_sql="select count(*) from want_it_now where wanted_itemid=".$want_row[item_id];
                            $tot_bid_res=mysql_query($tot_bid_sql);
                            $tot_bids=mysql_fetch_array($tot_bid_res);

                            //  Last Responded Date //
                            $sql_last_date="select max(response_date) from want_it_now where wanted_itemid=".$want_row[item_id];
                            $sqlqry_last_date=mysql_query($sql_last_date);
                            $fetch_last_date=mysql_fetch_array($sqlqry_last_date);
                            $lastdate=$fetch_last_date[0];

                            // current bid amount //

                            $bid_sql_max="select MAX(bidding_amount) as amt from placing_bid_item where item_id=".$want_row[item_id];
                            $bid_res_max=mysql_query($bid_sql_max);
                            $bidrow_max=mysql_fetch_array($bid_res_max);
                            $max_item_bid=$bidrow_max['amt'];
                            if(empty($max_item_bid))
                            { 
                            $max_item_bid=$row[min_bid_amount];
                            }

                            // feedback score
                            ?>
                            <tr class="detail9txt">
                                <td class="tr_botborder" width=3%>&nbsp;</td>
                                <td class="tr_botborder">
                                    <?php
                                    if(!empty($want_row['picture1']))
                                    {
                                    $img=$want_row['picture1'];
                                    list($width, $height, $type, $attr) = getimagesize("images/$img");
                                    $h=$height;
                                    $w=$width;
                                    if($h>50)	
                                    {
                                    $nh=50;
                                    $nw=($w/$h)*$nh;
                                    $h=$nh;
                                    $w=$nw;
                                    }
                                    if($w>50)
                                    {
                                    $nw=50;
                                    $nh=($h/$w)*$nw;
                                    $h=$nh;
                                    $w=$nw;
                                    }
                                    ?>
                                    <img name="runimg" src="images/<?php echo $want_row['picture1']; ?>" border=1 width=<?php echo  $w; ?> height=<?php echo $h?> >
                                         <?php 
                                         }
                                         else
                                         {
                                         ?>
                                         <img src="images/no_image.gif" border=1  name="runimg" >
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td class="tr_botborder" colspan="2">
                                    <?php
                                    if($tot_bids[0]!=0)
                                    {
                                    ?>
                                    <a href="wantitnowdes.php?item_id=<?php echo  $want_row['item_id']?> " class="header_text"><?php echo $tot_bids[0];?></a>
                                    <?php
                                    }
                                    else
                                    {
                                    echo $tot_bids[0];
                                    }
                                    ?>
                                </td>
                                <td width="28%" class="tr_botborder">
                                    <?php
                                    if(!empty($lastdate))
                                    echo $lastdate;
                                    else
                                    echo "-";
                                    ?></td>
                                <td width="19%" class="tr_botborder"><?php  echo $string_difference; ?></td>
                                <td width="20%" class="tr_botborder">

                                    <select name=cbowonaction style="width:100px;" onchange="go_page(this.value, < ?php = $want_row[item_id]; ? > )">
                                        <option value="0">Action</option>
                                        <option value="8">Delete Post</option>
                                    </select>  

                                </td></tr>
                            <tr>
                                <td class="tr_botborder_1">&nbsp;  </td>
                                <td class="tr_botborder_1" colspan=5 align="left">
                                    <a href="wantitnowdes.php?item_id=<?php echo  $want_row['item_id']?>" class="header_text">
                                        <?php  echo $want_row['item_title']; ?></a>&nbsp;<font class="detail9txt">(<?php  echo $want_row['item_id']; ?> )</font></td>
                                <td class="tr_botborder_1">&nbsp;  </td></tr>
                            <?php
                            } // while
                            ?>
                            <input type="hidden" name="want_delete" />
                            <input type="hidden"  name=item_id   />
                            <tr>
                                <td colspan="7" class=tr_botborder>
                                    <input type="hidden" name="delete1" value=0>	
                                </td>
                            </tr>
                        </form>
                    </table></div>
                <?php
                }
                else
                {
                ?>
                <div class="superbg">
                    <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="3%">&nbsp;</td>
                            <td width="97%" class="myauction3txt">There are no items in this section</td>
                        </tr>
                    </table>
                </div>
                <?php
                }
                }
                ?>
            </div>
        </div>

        <div id="myauctionright_right">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td><img src="images/auctionadd.gif" alt="" width="160" height="600" /></td>
                </tr>
            </table>
        </div>
    </div>
</div>
<script language="javascript">
            function del()
            {
            if (document.won_frm.chkbox.checked == false)
            {
            alert("Please select any item");
                    return false;
            }
            var empty = 0;
                    for (var k = 0; k < document.won_frm.chkbox.length; k++)
            {
            if (document.won_frm.chkbox[k].checked == false)
                    empty = empty + 1;
            }
            if (document.won_frm.chkbox.length == empty)
            {
            alert("Please select Any item");
                    return false;
            }

            var where_to = confirm("Are you Sure you Want to delete the items?");
                    if (where_to == true)
            {
            document.won_frm.won_delete.value = "yes";
                    document.won_frm.submit();
            }
            else
                    return false;
            }
    function won_selectall()
    {
    len = document.won_frm.len.value;
            if (len == 1)
    {
    if (document.won_frm.chkMain.checked == true)
            document.won_frm.chkbox.checked = true;
            if (document.won_frm.chkMain.checked == false)
            document.won_frm.chkbox.checked = false;
    }
    else
    {
    for (i = 0; i < len; i++)
    {
    if (document.won_frm.chkMain.checked == true)
            document.won_frm.chkbox[i].checked = true;
            if (document.won_frm.chkMain.checked == false)
            document.won_frm.chkbox[i].checked = false;
    }
    }

    }



    function selectall()
    {

    len = document.watch_form.len.value;
            if (len == 1)
    {
    if (document.watch_form.chkMain.checked == true)
            document.watch_form.chkbox.checked = true;
            if (document.watch_form.chkMain.checked == false)
            document.watch_form.chkbox.checked = false;
    }
    else
    {
    for (i = 0; i < len; i++)
    {
    if (document.watch_form.chkMain.checked == true)
            document.watch_form.chkbox[i].checked = true;
            if (document.watch_form.chkMain.checked == false)
            document.watch_form.chkbox[i].checked = false;
    }
    }

    }

    function watch_del()
    {
    if (document.watch_form.chkbox.checked == false)
    {
    alert("Please select any item");
            return false;
    }
    var empty = 0;
            for (var k = 0; k < document.watch_form.chkbox.length; k++)
    {
    if (document.watch_form.chkbox[k].checked == false)
            empty = empty + 1;
    }
    if (document.watch_form.chkbox.length == empty)
    {
    alert("Please select any item");
            return false;
    }

    var where_to = confirm("Are You Sure You Want to delete the item[s]?");
            if (where_to == true)
    {
    document.watch_form.delete1.value = "del";
            document.watch_form.submit();
    }
    else
            return false;
    }

    function watch_del1()
    {
    len = document.watch_form.len.value;
            document.watch_form.chkMain.checked = true;
            if (len == 1)
    {
    if (document.watch_form.chkMain.checked == true)
            document.watch_form.chkbox.checked = true;
            if (document.watch_form.chkMain.checked == false)
            document.watch_form.chkbox.checked = false;
    }
    else
    {
    for (i = 0; i < len; i++)
    {
    if (document.watch_form.chkMain.checked == true)
            document.watch_form.chkbox[i].checked = true;
            if (document.watch_form.chkMain.checked == false)
            document.watch_form.chkbox[i].checked = false;
    }
    }




    var where_to = confirm("Are You Sure You Want to delete the item[s]?");
            if (where_to == true)
    {
    document.watch_form.delete1.value = "del";
            document.watch_form.submit();
    }
    else
            return false;
    }


    function com()
    {
    document.watch_form.action = "compare.php";
            document.watch_form.submit();
    }
    function delete_all()
    {
    var where_to = confirm("Are you Sure you Want to delete all the items?");
            if (where_to == true)
    {
    document.watch_form.delete1.value = "all";
            document.watch_form.action = "watchlist.php";
            document.watch_form.submit();
    }
    else
    {
    window.location = "watchlist.php";
            document.watch_form.submit();
    }
    }
    function watch_all()
    {
//document.watch_form.delete1.value="all";
    document.watch_form.action = "watchall.php";
            document.watch_form.submit();
    }

    function go_page(action_id, id)
    {
    if (action_id == 1)
    {
    document.sell_form.item_id.value = id;
            document.sell_form.action = "edit_auction.php";
            document.sell_form.submit();
    }

    if (action_id == 2)
    {
    document.sell_form.item_id.value = id;
            document.sell_form.action = "close.php";
            document.sell_form.submit();
    }

    if (action_id == 3)
    {
    var where_to = confirm("Are you Sure you Want to delete the items?");
            if (where_to == true)
    {
    document.sell_form.open_delete.value = "yes";
            document.sell_form.item_id.value = id;
            document.sell_form.action = "myauction.php";
            document.sell_form.submit();
    }
    }

    if (action_id == 4)
    {
    var where_to = confirm("Are you Sure you Want to delete the items?");
            if (where_to == true)
    {
    document.close_form.close_delete.value = "yes";
            document.close_form.item_id.value = id;
            document.close_form.action = "myauction.php";
            document.close_form.submit();
    }
    }
    if (action_id == 14)
    {
    document.close_form.item_id.value = id;
            document.close_form.mode.value = "close_relist";
            document.close_form.submit();
    }
    if (action_id == 5)
    {
    document.watch_form.seller_id.value = id;
            document.watch_form.action = "search.php";
            document.watch_form.mode.value = "sellers_item";
            document.watch_form.submit();
    }
    if (action_id == 7)
    {
    var str = id;
            var position = document.write(str.search(/-/));
            document.won_frm.seller_id.value = id;
            document.won_frm.action = "sellers_othersitem.php";
            document.won_frm.submit();
    }

    if (action_id == 8)
    {
    var where_to = confirm("Are you Sure you Want to delete the items?");
            if (where_to == true)
    {
    document.want_form.want_delete.value = "yes";
            document.want_form.item_id.value = id;
            document.want_form.action = "myauction.php";
            document.want_form.submit();
    }
    }

    if (action_id == 9)
    {
    document.sell_form.sellitemid.value = id;
            document.sell_form.mode.value = "sellsimilar";
            document.sell_form.action = "sellsimilaritem.php";
            document.sell_form.submit();
    }
    if (action_id == 10)
    {

    document.sell_form.itemid.value = id;
            document.sell_form.mode.value = "want";
            document.sell_form.submit();
    }
    if (action_id == 11)
    {
    document.sell_form.itemid.value = id;
            document.sell_form.mode.value = "des";
            document.sell_form.submit();
    }
    if (action_id == 12)
    {

    document.sell_form.itemid.value = id;
            document.sell_form.mode.value = "promote";
            document.sell_form.submit();
    }
    if (action_id == 13)
    {
    document.sell_form.itemid.value = id;
            document.sell_form.mode.value = "relist";
            document.sell_form.submit();
    }
    if (action_id == 20)
    {
    document.sell_form.itemid.value = id;
            document.sell_form.mode.value = "edit";
            document.sell_form.action = "edit_ad.php";
            document.sell_form.submit();
    }
    }



    function go_page_link(action_id, id, seller_id)
    {
    if (action_id == 1)
    {
    document.bid_frm.seller_id.value = seller_id;
            document.bid_frm.action = "search.php";
            document.bid_frm.mode.value = "sellers_item";
            document.bid_frm.submit();
    }
    if (action_id == 2)
    {
    document.bid_frm.item_id.value = id;
            document.bid_frm.go_link.value = "yes";
            document.bid_frm.action = "ask_seller_qus.php";
            document.bid_frm.submit();
    }
    if (action_id == 3)
    {
    var where_to = confirm("Are you Sure you Want to Retract your Bid?");
            if (where_to == true)
    {
    document.bid_frm.bid_delete.value = "yes";
            document.bid_frm.item_id.value = id;
            document.bid_frm.action = "myauction.php";
            document.bid_frm.submit();
    }
    }
    }

    function go_page_link1(action_id, id, seller_id, bid_id)
    {
    if (action_id == 7)
    {
    document.won_frm.item_id.value = id;
            document.won_frm.buyer_id.value = seller_id;
            document.won_frm.radfeedback.value = "buyer";
            document.won_frm.action = "comments.php";
            document.won_frm.submit();
    }
    if (action_id == 11)
    {
    document.won_frm.item_id.value = id;
            document.won_frm.buyer_id.value = seller_id;
            document.won_frm.radfeedback.value = "buyer";
            document.won_frm.action = "ask_buyer_qus.php";
            document.won_frm.submit();
    }
    if (action_id == 9)
    {
    document.won_frm.item_id.value = id;
            document.won_frm.bid_id.value = bid_id;
            document.won_frm.action = "unpaiddispute.php";
            document.won_frm.submit();
    }
    if (action_id == 10)
    {
    var item_deliever = confirm("Are you Sure you Want to mark the item as delievered");
            if (item_deliever == true)
    {
    document.won_frm.item_id.value = id;
            document.won_frm.itemdelievered.value = "yes";
            document.won_frm.action = "myauction.php";
            document.won_frm.submit();
    }
    }
    }

    function go_page_link2(action_id, id, seller_id, bid_id)
    {
    if (action_id == 5)
    {
    document.won_frm.seller_id.value = seller_id;
            document.won_frm.mode.value = "sellers_item";
            document.won_frm.action = "search.php";
            document.won_frm.submit();
    }
    if (action_id == 4)
    {
    document.won_frm.item_id.value = id;
            document.won_frm.action = "reviewdetails.php";
            document.won_frm.submit();
    }
    if (action_id == 8)
    {
    document.won_frm.item_id.value = id;
            document.won_frm.action = "trackit.php";
            document.won_frm.submit();
    }
    if (action_id == 10)
    {
    document.won_frm.bid_id.value = bid_id;
            document.won_frm.action = "reportitemnotreceived.php";
            document.won_frm.submit();
    }
    if (action_id == 6)
    {
    document.won_frm.item_id.value = id;
            document.won_frm.seller_id.value = seller_id;
            document.won_frm.radfeedback.value = "seller";
            document.won_frm.action = "comments.php";
            document.won_frm.submit();
    }
    if (action_id == 11)
    {
    var item_paid = confirm("Are you Sure you Want to mark the item as paid");
            if (item_paid == true)
    {
    document.won_frm.item_id.value = id;
            document.won_frm.itempaid.value = "yes";
//document.won_frm.radfeedback.value="seller";
            document.won_frm.action = "myauction.php";
            document.won_frm.submit();
    }
    }
    }

    function retrieve(id, itemid)
    {
    document.watch_form.item_id.value = itemid;
            document.watch_form.submit();
    }

    function val()
    {
    document.sell_form.mode.value = "sell";
            document.sell_form.status.value = "Active";
            document.sell_form.submit();
    }


</script>
