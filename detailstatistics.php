<?php
/* * *************************************************************************
 * File Name				:detailstatistics.php
 * File Created			:Wednesday, June 21, 2006
 * File Last Modified	:Wednesday, June 21, 2006
 * Copyright			:(C) 2001 AJ Square Inc
 * Email				:licence@ajsquare.net
 * Software Language	:PHP
 * Version Created		:V 4.3.2
 * Programmers worked	:S.Priya, B.ReenaKumari, K.Shanmuga priya
 * Modified By			:B.Reena
 * $Id                  : memberlist.php,v 1.36.2.12 2006/02/07 20:42:51 grahamje Exp $
 * ************************************************************************* */


/* * **************************************************************************

 *      Licence Agreement: 

 *     This program is a Commercial licensed software; 
 *     you are not authorized to redistribute it and/or modify/and or sell it under any publication 
 *     or license /or term it under the GNU General Public License as published by the Free Software Foundation;
 *     either user and developer versions of the License, or (at your option) 
 *     any later version is applicable for the same.

 * *************************************************************************** */
session_start();
require 'include/connect.php';
require 'include/top.php';
if (!isset($_SESSION['userid'])) {
    $link = "signin.php";
    $url = "myauction.php";
    echo '<meta http-equiv="refresh" content="0;url=' . $link . '?url=' . $url . '">';
    echo "You have been Re-Directed, if not please <a href=$link?$url>Click here</a>";
    exit();
}
$currec = $_GET['currec'];
?>
<table width="958" align="center" cellpadding="0" cellspacing="10">
    <tr><td>
            <table width="958" align="center" cellpadding="4" cellspacing="0">
                <tr>
                    <td colspan="3" background="images/contentbg.jpg" height=25>
                        <font size="3"><b><div align="left">&nbsp;&nbsp;Detail Statistics</div></b></font></td></tr>
                <table border="0" align="center" cellpadding="3" cellspacing="0" width="100%">
                    <tr>
                        <td valign="top" width="30%">
                            <?php require 'include/my_list.php'; ?>
                        </td>
                        <td valign="top" width="30%">

                            <?php
                            $user_id = $_SESSION['userid'];
                            $mode = $_GET['mode'];
                            if ($mode == "won" || $mode == '') {
// $watch_sql="select * from placing_bid_item a,placing_item_bid b where a.user_id=$user_id and a.item_id=b.item_id and a.user_pos='Yes' and status='Sold'";
                                $watch_sql = "select * from placing_bid_item a,placing_item_bid b where a.user_id=$user_id and a.item_id=b.item_id and a.user_pos='Yes' and b.payment_status='paid' group by b.item_id";
                                $watch = mysql_query($watch_sql);
                                $total_records = mysql_num_rows($watch);
                                if ($total_records > 0) {
                                    $select_sql = "select * from error_message where err_id =69";
                                    $select_tab = mysql_query($select_sql);
                                    $select_row = mysql_fetch_array($select_tab);
                                    $dis_tit = $select_row[err_msg];
//$dis_tit="U'r Won";
                                } else {
                                    $select_sql = "select * from error_message where err_id =64";
                                    $select_tab = mysql_query($select_sql);
                                    $select_row = mysql_fetch_array($select_tab);
                                    $err_tit = $select_row[err_msg];
//$err_tit="There are no items to display in this view .";
                                }
                                $select_sql = "select * from error_message where err_id =71";
                                $select_tab = mysql_query($select_sql);
                                $select_row = mysql_fetch_array($select_tab);
                                $title = $select_row[err_msg];
//$title="Won Items:";
                            }
                            if ($mode == "notwin") {
                                $watch_sql = "select * from placing_bid_item a,placing_item_bid b where a.user_id=$user_id and a.item_id=b.item_id and a.user_pos='No' and b.Quantity=0";
                                $watch = mysql_query($watch_sql);
                                $total_records = mysql_num_rows($watch);
                                if ($total_records > 0) {
                                    $select_sql = "select * from error_message where err_id =60";
                                    $select_tab = mysql_query($select_sql);
                                    $select_row = mysql_fetch_array($select_tab);
                                    $dis_tit = $select_row[err_msg];
//$dis_tit="Not Won:";
                                } else {
                                    $select_sql = "select * from error_message where err_id =61";
                                    $select_tab = mysql_query($select_sql);
                                    $select_row = mysql_fetch_array($select_tab);
                                    $err_tit = $select_row[err_msg];
//$err_tit="There are no items to display in this view for the selected time period. Items may display in this view for 60 days, or until you remove them.";
                                }
                                $select_sql = "select * from error_message where err_id =62";
                                $select_tab = mysql_query($select_sql);
                                $select_row = mysql_fetch_array($select_tab);
                                $title = $select_row[err_msg];

//$title="Items Not Won:";
                            }
                            if ($mode == "sold") {
//$watch_sql="select * from placing_bid_item a,placing_item_bid b where b.user_id=$user_id and a.item_id=b.item_id and status='Sold'";
                                $watch_sql = "select * from placing_bid_item a,placing_item_bid b where b.user_id=$user_id and a.item_id=b.item_id and quantity_sold > 0";
//$watch_sql="select * from payment_details where seller_id=$user_id";
                                $watch = mysql_query($watch_sql);
                                $total_records = mysql_num_rows($watch);
                                $wat_arr = mysql_fetch_array($watch);
//$wat_total=$wat_arr[quantity]-$wat_arr[quantity_sold];
                                $wat_total = $total_records;
//$total_records=$wat_arr[quantity_sold];
                                if ($total_records > 0) {
                                    $select_sql = "select * from error_message where err_id =63";
                                    $select_tab = mysql_query($select_sql);
                                    $select_row = mysql_fetch_array($select_tab);
                                    $dis_tit = $select_row[err_msg];

//$dis_tit="U'r Sold";
                                } else {
                                    $select_sql = "select * from error_message where err_id =64";
                                    $select_tab = mysql_query($select_sql);
                                    $select_row = mysql_fetch_array($select_tab);
                                    $err_tit = $select_row[err_msg];

//$err_tit="There are no items to display in this view .";
                                }
                                $select_sql = "select * from error_message where err_id =65";
                                $select_tab = mysql_query($select_sql);
                                $select_row = mysql_fetch_array($select_tab);
                                $title = $select_row[err_msg];

//$title="Sold Items:";
                            }
                            if ($mode == "unsold") {
                                $watch_sql = "select * from placing_bid_item a,placing_item_bid b where b.user_id=$user_id and a.item_id=b.item_id and a.user_pos='Yes' and status='Active'";
                                $watch = mysql_query($watch_sql);
                                $total_records = mysql_num_rows($watch);
                                if ($total_records > 0) {
                                    $select_sql = "select * from error_message where err_id =66";
                                    $select_tab = mysql_query($select_sql);
                                    $select_row = mysql_fetch_array($select_tab);
                                    $dis_tit = $select_row['err_msg'];
//$dis_tit="U'r Live Items";
                                } else {
                                    $select_sql = "select * from error_message where err_id =64";
                                    $select_tab = mysql_query($select_sql);
                                    $select_row = mysql_fetch_array($select_tab);
                                    $err_tit = $select_row['err_msg'];

//$err_tit="There are no items to display in this view .";
                                }
                                $select_sql = "select * from error_message where err_id =68";
                                $select_tab = mysql_query($select_sql);
                                $select_row = mysql_fetch_array($select_tab);
                                $title = $select_row['err_msg'];

//$title="Live Items:";
                            }
                            if ($mode == "sold")
                                $wat_total = $wat_total;
                            else
                                $wat_total = mysql_num_rows($watch);
                            $limitsize = 2; //pagelimit
                            if ($total_records > 0) {
//get the total records
                                if (strlen($currec) == 0)
                                    $currec = 1;
                                $start = ($currec - 1) * $limitsize;
                                $end = $limitsize;
                                $watch_sql .=" limit $start,$end";
                                $watch = mysql_query($watch_sql);
                            }
                            ?>


                            <form name="auction_form" action="$_SERVER['PHP_SELF']" method="get">

                                <table cellpadding="1" cellspacing="1" align="center" width=540>
                                    <?php
                                    if ($total_records > 0) {
                                        ?>
                                        <td>
                                            <table cellpadding="5" cellspacing="0" align="center" width=540 >
                                                <?php
                                                $net = ($currec - 1 * $limitsize + $end) - $total_records;
                                                $dis = $limitsize + $start;
                                                if ($net <= 0)
                                                    $net = $end;
                                                if ($dis <= $total_records) {
                                                    ?>
                                                    <tr align="left"><td colspan=7 class="header_text">
                                                            <font size="3" class="font_tit_color" >Showing  <?php echo $start + 1; ?> 
                                                            <?php echo " - " . $dis; ?> of <?php echo $total_records; ?> Items &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; </font>
                                                            <?php
                                                        } else {
                                                            ?>
                                                    <tr align="left"><td colspan=7 class="header_text"><font size="3" class="font_tit_color">Showing  <?php echo $start + 1; ?>  of <?php echo $total_records; ?> Item </font>
                                                            <?php
                                                            if ($currec != 1) {
                                                                $ver = 1;
                                                                ?>
                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="category.php?currec=<?php = ($currec - 1); ?>&cat_id=<?php = $cat_id; ?>&cate_id=<?php = $cate_id; ?>" >
                                                                    <font size="2" class="font_tit_color" face="Arial, Helvetica, sans-serif">Previous </font></a>
                                                                <?php
                                                            }
                                                        }
                                                        ?>

                                                        <?php
                                                        if ($currec != 1 and $ver != 1) {
                                                            ?>
                                                            <a href="detailstatistics.php?currec=<?php = ($currec - 1); ?>&cat_id=<?php = $cat_id; ?>&cate_id=<?php = $cate_id; ?>&mode=<?php = $mode; ?>" style="textdecoration:none">
                                                                <font size=2 class="font_tit_color" face="Arial, Helvetica, sans-serif">Previous </font></a>
                                                            <?php
                                                        }
                                                        $net = $total_records - ($currec * $limitsize + $end) + $end;
                                                        if ($net > $limitsize)
                                                            $net = $limitsize;
                                                        if ($net <= 0)
                                                            $net = $end;
                                                        if ($total_records > ($start + $end)) {
                                                            ?>  
                                                            &nbsp;&nbsp;&nbsp;&nbsp;<a href="detailstatistics.php?currec=<?php = ($currec + 1); ?>&cat_id=<?php = $cat_id; ?>&cate_id=<?php = $cate_id; ?>&mode=<?php = $mode; ?>" ><font size=2 color="#003366" face="Arial, Helvetica, sans-serif"> Next </font> </a>
                                                            <?php
                                                        }
                                                        ?></td></tr>
                                                </tr>
                                                <tr background="images/item_bg.gif">
                                                    <td colspan=7><font class="detail9txt"><b><?php = $dis_tit; ?> <?php = $wat_total; ?> Items</b> </font></td></tr>
                                                <?php
                                            } else if ($wat_total == 0) {
                                                ?>
                                                <tr><td valign="top">
                                                        <table align="center" width=540>
                                                            <tr align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <font size="2" class="warning_font_color"><?php = $err_tit; ?></font></tr>
                                                <br>
                                            </table></td></tr>
                                        <?php
// exit();
                                    }
                                    ?>
                                    <b>
                                        <?php if ($total_records > 0) {
                                            ?>
                                            <tr class="detail9txt">
                                                <td class="tr_botborder">&nbsp;</td>
                                                <td class="tr_botborder">Item</td>
                                                <?php
                                                if ($mode == "won") {
                                                    ?>
                                                    <td class="tr_botborder">Quantity</td> 
                                                    <td class="tr_botborder">Price</td>
                                                    <td class="tr_botborder">Date</td>

                                                    <td class="tr_botborder">Ends</td>
                                                    <?php
                                                }
                                                if ($mode == "notwin") {
                                                    ?>
                                                    <td class="tr_botborder">Price</td>
                                                    <td class="tr_botborder">Date</td>
                                                    <td class="tr_botborder">Ends</td>
                                                    <?php
                                                }
                                                if ($mode == "sold") {
                                                    ?>
                                                    <td class="tr_botborder">Sold Amount</td> 
                                                    <td class="tr_botborder">Buyer Id</td>
                                                    <td class="tr_botborder">Sold date</td>
                                                    <?php
                                                }

                                                if ($mode == "unsold") {
                                                    ?>
                                                    <td class="tr_botborder">Current Price</td>
                                                    <td class="tr_botborder"># of Bids</td>
                                                    <td class="tr_botborder">Ends</td>
                                                    <?php
                                                }
                                                ?>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </b>
                                    <?php
                                    $c = 1;
                                    while ($watch_row = mysql_fetch_array($watch)) {
                                        $sql = "select * from placing_item_bid where item_id=$watch_row[item_id]";
                                        $result = mysql_query($sql);
                                        $row = mysql_fetch_array($result);
                                        $user_sql = "select * from user_registration where user_id=" . $row['user_id'];
                                        $user_res = mysql_query($user_sql);
                                        $user = mysql_fetch_array($user_res);
                                        $item_id = $row[item_id];
                                        $bid_sql = "select * from placing_bid_item where item_id=" . $item_id;
                                        $bid_res = mysql_query($bid_sql);
                                        $bid = mysql_fetch_array($bid_res);
                                        $bid_date = $bid['bidding_date'];
                                        $buyerid = $bid['user_id'];
                                        if ($mode == "sold") {
                                            $user_sql1 = "select * from user_registration where user_id=" . $buyerid;
                                            $user_res1 = mysql_query($user_sql1);
                                            $user1 = mysql_fetch_array($user_res1);
                                            $buyerid = $user1['user_name'];
                                        }
                                        $current_price = $row['sale_price'];
                                        $tot_sql = "select count(*) from placing_bid_item where item_id=" . $item_id;
                                        $tot_res = mysql_query($tot_sql);
                                        $tot = mysql_fetch_array($tot_res);
                                        if (!isset($bid[0])) {
                                            $current_price = $row['min_bid_amount'];
                                        }
                                        $bidding_start_date = $bid['bid_starting_date'];
                                        $interval = $bid['duration'] + $bid['start_delay'];
                                        $expire_date = $row['expire_date'];
//$expire_date = AddDays($bidding_start_date, $interval); 
                                        require 'ends.php';
                                        if ($c == 1) {
                                            $c = 0;
                                            ?>
                                            <tr class="tr_color_1">
                                                <?php
                                            } else {
                                                $c = 1;
                                                ?>
                                            <tr class="tr_color_2">
                                                <?php
                                            }
                                            ?>
                            <!--  <td><input type="checkbox" name=chkbox[] value="<?php echo $row['item_id']; ?>"></td> -->
                                            <td>

                                                <?php
                                                if (!empty($row[picture1]) and file_exists("thumbnail/" . $row['picture1'])) {
                                                    ?>
                                                    <a href="detail.php?item_id=<?php echo $row['item_id']; ?>">
                                                        <img height="80" width="80" src="thumbnail/<?php echo $row['picture1']; ?>" border="0"  class="header_text"></a> 
                                                    <?php
                                                } else {
                                                    ?>
                                                    <a href="detail.php?item_id=<?php echo $row['item_id']; ?>">
                                                        <img height="80" width="80" src="images/no-image.gif" border="0" class="header_text"></a> 
                                                    <?php
                                                }
                                                ?>		 

                                            </td>
                                            <td> <a href="detail.php?item_id=<?php echo $row['item_id']; ?>" class="header_text">
                                                    <?php echo substr($row['item_title'], 0, 10); ?>...
                                                </a> </td>
                                            <?php
                                            if ($mode == "unsold") {
                                                ?>
                                                <td  class="detail9txt"><?php echo $current_price; ?>
                                                </td>
                                                <td  class="detail9txt">
                                                    <?php
                                                    if ($tot[0] == 0) {
                                                        $tot = "No Bid";
                                                    } else
                                                        $tot = $tot[0];
                                                    ?>
                                                    <a href="detail_statistics.php?item_id=<?php echo $row['user_id']; ?>" class="header_text"><?php echo $tot; ?></a></td>
                                                <td  class="detail9txt"><?php echo "$string_difference"; ?></td>
                                                <?php
                                            }
                                            if ($mode == "won") {
                                                ?>
                                                <td  class="detail9txt"><?php echo $row['quantity_sold']; ?>
                                                </td>
                                                <td  class="detail9txt"><?php echo $current_price; ?>
                                                </td>
                                                <td  class="detail9txt"><?php echo $bid_date; ?></td>
                                                    <!-- <td><a href="paynow.php?item_id=<?php = $row['item_id'] ?>">Paynow</a></td> -->
                                                <td  class="detail9txt"><?php echo "$string_difference"; ?></td>
                                            </tr>
                                            <?php
                                        }
                                        if ($mode == "notwin") {
                                            ?>
                                            <td  class="detail9txt"><?php echo $current_price; ?>
                                            </td>
                                            <td  class="detail9txt"><?php echo $bid_date; ?></td>
                                            <td  class="detail9txt"><?php echo "$string_difference"; ?></td>


                                            <?php
                                        }
                                        if ($mode == "sold") {
                                            ?>
                                            <td class="detail9txt"><?php echo $current_price; ?>
                                            </td>
                                            <td class="detail9txt"><?php echo $bid_date; ?></td>


                                            <?php
                                        }
                                    }
                                    ?>
                                    </tr>
                                </table>
                        </td></tr></table>
                <td valign="top">
                    <?php
                    require 'templates/right_menu.tpl';
                    ?>
                </td></tr>
</table>
</td></tr></table>
</table>
<?php
require 'include/footer.php';
?>
