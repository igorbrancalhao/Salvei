<?php
/* * *************************************************************************
 * File Name				:userdetails.php
 * File Created				:Wednesday, June 21, 2006
 * File Last Modified			:Wednesday, June 21, 2006
 * Copyright				:(C) 2001 AJ Square Inc
 * Email				:licence@ajsquare.net
 * Software Language			:PHP
 * Version Created			:V 4.3.2
 * Programmers worked	        	:S.Priya, B.ReenaKumari, K.Shanmuga priya
 * $Id                                  : memberlist.php,v 1.36.2.12 2006/02/07 20:42:51 grahamje Exp $
 *
 * ************************************************************************* */


/* * **************************************************************************

 *      Licence Agreement: 

 *     This program is a Commercial licensed software; 
 *     you are not authorized to redistribute it and/or modify/and or sell it under any publication 
 *     or license /or term it under the GNU General Public License as published by the Free Software Foundation;
 *     either user and developer versions of the License, or (at your option) 
 *     any later version is applicable for the same.

 * *************************************************************************** */
?>
<?php
session_start();
error_reporting(0);
if (strlen($_SESSION['adminuser']) == 0) {
echo '<meta http-equiv="refresh" content="0;url=index.php">';
exit();
}
?>
<style type="text/css">
    <!--
    .style1 {
        color: #666666;
        font-weight: bold;
    }
    .style3 {color: #666666; font-size: 11px; font-family:Arial, Helvetica, sans-serif}
    -->
</style>
<?php
require 'include/connect.php';
$limitsize = 5;
$currec = $_GET[currec];

function getReferral_details($userid, $level) {
$select_referral_query = "select * from user_registration where intro_id=$userid";
$select_referral_result = mysql_query($select_referral_query);
/* $select_level_query="select max(level_id) from level_commission";
  $select_level_result=mysql_query($select_level_query);
  $select_level_row=mysql_fetch_array($select_level_result);
  $level_limit=$select_level_row[0]; */
if (mysql_num_rows($select_referral_result) > 0) {
$level+=1;
while ($select_referral_row = mysql_fetch_array($select_referral_result)) {
echo "<tr align=center><td>$level</td><td>" . $select_referral_row['user_name'] . "</td><td>" . $select_referral_row['date_of_registration'] . "</td></tr>";
$intro_id = $select_referral_row['user_id'];
getReferral_details($intro_id, $level);
}
} else {
//echo "<tr><td colspan=3>No Users found in your Downline</td></tr>";
}
}
?>

<?php
require 'include/top.php';
$type = $_GET['type'];
$id = $_GET['id'];
$mode = $_GET['mode'];
?>  



<table border="0" align="center" cellpadding="5" cellspacing="2" width="100%" background="images/bg08.jpg">
    <tr><td>
            <table>
                <tr><td width="93">
                <!--<tr><td>
                <table border="0" align="center" cellpadding="5" cellspacing="2" width="100%">
                <tr align="center"><td align="center"><a href="userdetails.php?id=<?php = $id ?>&type=gen">General</a></td>
                <td><a href="userdetails.php?id=<?php = $id ?>&type=per">Personal</a></td>
                <td><a href="userdetails.php?id=<?php = $id ?>&type=sell">Selling Details</a></td>
                <td><a href="userdetails.php?id=<?php = $id ?>&type=buy">Buying Details</a></td>
                <!-- <td><a href="userdetails.php?id=<?php = $id ?>&type=account">Account Details</a></td> 
                <td><a href="userdetails.php?id=<?php = $id ?>&type=ref">Refferal Details</a></td>  -->
                        <!--</tr>
                        </table>
                        </td></tr>-->
                        <table id="Table_01" width="93"  border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td><img src="images/index_02_03_03_01.jpg" width="93" height="26" alt=""></td>
                            </tr>
                            <tr>
                                <td><a href="user.php"><img src="images/index_02_03_03_02.jpg" width="93" height="70" title="User Management" border="0"></a></td>
                            </tr>
                            <tr>
                                <td><a href="site.php"><img src="images/index_02_03_03_03.jpg" width="93" height="71" title="General Settings" border="0"></a></td>
                            </tr>
                            <tr>
                                <td><a href="site.php?page=bid"><img src="images/index_02_03_03_04.jpg" width="93" height="73" title="Bid increment settings" border="0"></a></td>
                            </tr>
                            <tr>
                                <td><a href="report.php?page=reven"><img src="images/index_02_03_03_05.jpg" width="93" height="71" title="DetailReport" border="0"></a></td>
                            </tr>
                            <tr>
                                <td><a href="store_manager.php"><img src="images/index_02_03_03_06.jpg" width="93" height="70" title="StoreManager" border="0"></a></td>
                            </tr>
                            <tr>
                                <td><a href="bulk_load.php"><img src="images/index_02_03_03_07.jpg" width="93" height="66" title="Bulk Load" border="0"></a></td>
                            </tr>
                        </table></td>
                    <?php
                    if ($type == "gen") {
                    $mem_sql = "select * from user_registration where user_id=$id";
                    $mem_res = mysql_query($mem_sql);
                    $mem_row = mysql_fetch_array($mem_res);
                    $username = $mem_row['user_name'];
                    $member_since = $mem_row['date_of_registration'];
                    $member_since = explode('-', $member_since);
                    $member_since = date('M-d-Y', mktime(0, 0, 0, $member_since[1], $member_since[2], $member_since[0]));
                    $won_sql = "select * from placing_bid_item a,placing_item_bid b where a.user_id=$id and a.item_id=b.item_id and a.user_pos='Yes'";
                    $won = mysql_query($won_sql);
                    $total_won = mysql_num_rows($won);
                    $live_sql = "select * from placing_item_bid where user_id=$id and status='Active' and selling_method!='want_it_now'";
                    $live = mysql_query($live_sql);
                    $total_live = mysql_num_rows($live);

                    $want_sql = "select * from placing_item_bid where user_id=$id and selling_method='want_it_now'";
                    $want = mysql_query($want_sql);
                    $total_want = mysql_num_rows($want);

                    $bid_sql = "select * from placing_bid_item where user_id=$id and user_pos='No'";
                    $bid = mysql_query($bid_sql);
                    $total_bid = mysql_num_rows($bid);
                    $lost_sql = "select * from placing_bid_item a,placing_item_bid b where a.user_id=$id and a.user_id=b.user_id and a.item_id=b.item_id and a.user_pos='No'";
                    $lost = mysql_query($lost_sql);
                    $total_lost = mysql_num_rows($lost);
                    $watch_sql = "select * from watch_list where user_id=$id";
                    $watch = mysql_query($watch_sql);
                    $total_watch = mysql_num_rows($watch);
                    $sold_sql = "select * from placing_bid_item a,placing_item_bid b where b.user_id=$id and a.item_id=b.item_id and b.quantity_sold > 0";
                    $sold = mysql_query($sold_sql);
                    $total_sold = mysql_num_rows($sold);

                    $norec = "No Items Found";
                    ?>
                    <td width="792">
                        <table border="0" cellpadding="5" cellspacing="2" width="96%" bgcolor="#E3E4DF" class=border2>
                            <tr bgcolor="#CCCCCC"><td align="center" colspan="2" class="txt_users">Auction Details of <?php = $username ?></td></tr>
                            <tr bgcolor="#eeeee1"><td class="txt_bold"><b>Member Since</b></td><td class="txt_bold"><?php = $member_since ?></td></tr>
                            <tr bgcolor="#CCCCCC"><td class="txt_users" colspan="2">Selling Details</td></tr>
                            <tr bgcolor="#eeeee1"><td class="txt_sitedetails"><b># of Sold Items</b></td><td class="txt_sitedetails">
                                    <?php
                                    if ($total_sold != 0) echo $total_sold;
                                    else echo $norec;
                                    ?>
                                </td></tr>
                            <tr bgcolor="#eeeee1"><td class="txt_sitedetails"><b># of Live Items</b></td><td class="txt_sitedetails">
                                    <?php
                                    if ($total_live != 0) echo $total_live;
                                    else echo $norec;
                                    ?>
                                </td></tr>
                            <tr bgcolor="#eeeee1"><td class="txt_sitedetails"><b># of Want it Now Items</b></td><td class="txt_sitedetails">
                                    <?php
                                    if ($total_want != 0) echo $total_want;
                                    else echo $norec;
                                    ?>
                                </td></tr>
                            <tr bgcolor="#CCCCCC"><td class="txt_users" colspan="2">Buying Details</td></tr>
                            <tr bgcolor="#eeeee1"><td class="txt_sitedetails"><b># of Bidding Items</b></td><td class="txt_sitedetails">
                                    <?php
                                    if ($total_bid != 0) echo $total_bid;
                                    else echo $norec;
                                    ?>
                                </td></tr>
                            <tr bgcolor="#eeeee1"><td class="txt_sitedetails"><b># of Won Items</b></td>
                                <td class="txt_sitedetails">
                                    <?php
                                    if ($total_won != 0) echo $total_won;
                                    else echo $norec;
                                    ?></td></tr>
                            <tr bgcolor="#eeeee1" ><td class="txt_sitedetails"><b># of Watching Items</b></td>
                                <td class="txt_sitedetails">
                                    <?php
                                    if ($total_watch != 0) echo $total_watch;
                                    else echo $norec;
                                    ?></td></tr>
                            <tr bgcolor="#eeeee1"><td class="txt_sitedetails"><b># of Lost Items</b></td>
                                <td class="txt_sitedetails">
                                    <?php
                                    if ($total_lost != 0) echo $total_lost;
                                    else echo $norec;
                                    ?>
                                </td></tr>
                            <tr bgcolor="#eeeee1"><td colspan="2">&nbsp;</td>
                            </tr>
                        </table>
                    </td></tr></table></td></tr>
    <?php
    }
    if ($type == "per") {
    $sql = "select * from user_registration where user_id=$id";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);

    $username = $row['user_name'];
    $firstname = $row['first_name'];
    $lastname = $row['last_name'];
    $memberemail = $row['email'];
    /* $introid=$row['intro_id'];

      $intro_sql="select * from members where member_id=$introid";
      $intro_res=mysql_query($intro_sql);
      $intro_row=mysql_fetch_array($intro_res);
      $introname=$intro_row['username']; */
    if (!$introname)
    $introname = 'None';
    $address = $row['address'];
    $city = $row['city'];
    $state = $row['state'];
    $country = $row['country'];
    $coun_sql = "select * from country_master where country_id=$country";
    $coun_res = mysql_query($coun_sql);
    $coun_row = mysql_fetch_array($coun_res);
    $country = $coun_row['country'];
    $zipcode = $row['pin_code'];
    $date = explode("-", $row['date_of_birth']);
    $date_of_birth = $date[2] . "-" . $date[1] . "-" . $date[0];
    $mobile_no = explode("-", $row['work_phone']);
    $work_phone = $mobile_no[0] . "-" . $mobile_no[1];
    $phone_no = explode("-", $row['home_phone']);
    $home_phone = $phone_no[0] . "-" . $phone_no[1] . "-" . $phone_no[2];
    $date_join = $row['date_of_registration'];
    $payment_method = $row['payment_method'];
    $last_login_date = $row['last_login_date'];
    $ip = $row['ip_address'];
    /* $pay_sql="select * from payment_process where payment_id=$payment_method";
      $pay_res=mysql_query($pay_sql);
      $pay_row=mysql_fetch_array($pay_res);
      $payment=$pay_row['payment_name']; */

    $account_no = $row['account_no'];
    ?>
    <td width="792">
        <table border="0" cellpadding="5" cellspacing="2" width="96%" class=border2 height=448>
            <tr><td align="center" colspan="2" class="txt_users" bgcolor="#CCCCCC">
                    Personal Details of <?php = $username ?></td></tr>
            <tr bgcolor="#eeeee1"><td class="txt_sitedetails">Username</td><td class="txt_sitedetails"><?php = $username ?></td></tr>
            <tr bgcolor="#eeeee1"><td class="txt_sitedetails">Firstname</td><td class="txt_sitedetails"><?php = $firstname ?></td></tr>
            <tr bgcolor="#eeeee1"><td class="txt_sitedetails">Lastname</td><td class="txt_sitedetails"><?php = $lastname ?></td></tr>
            <tr bgcolor="#eeeee1"><td class="txt_sitedetails">Member Email</td><td class="txt_sitedetails"><?php = $memberemail ?></td></tr>
            <tr bgcolor="#eeeee1"><td class="txt_sitedetails">Date Of Birth</td><td class="txt_sitedetails"><?php = $date_of_birth ?></td></tr>
            <!--<tr bgcolor="#eeeee1"><td class="txt_sitedetails">Referred By</td><td class="txt_sitedetails"><?php //=$introname    ?></td></tr>-->
            <tr bgcolor="#eeeee1"><td class="txt_sitedetails">Address</td><td class="txt_sitedetails"><?php = $address ?></td></tr>
            <tr bgcolor="#eeeee1"><td class="txt_sitedetails">City</td><td class="txt_sitedetails"> <?php = $city ?></td></tr>
            <tr bgcolor="#eeeee1" ><td class="txt_sitedetails">State</td><td class="txt_sitedetails"><?php = $state ?></td></tr>
            <tr bgcolor="#eeeee1"><td class="txt_sitedetails">Country</td><td class="txt_sitedetails"><?php = $country ?></td></tr>
            <tr bgcolor="#eeeee1"><td class="txt_sitedetails">Zipcode</td><td class="txt_sitedetails"><?php = $zipcode ?></td></tr>
            <tr bgcolor="#eeeee1"><td class="txt_sitedetails">IP Address</td><td class="txt_sitedetails"><?php = $ip ?></td></tr>
            <tr bgcolor="#eeeee1"><td class="txt_sitedetails">Phone Number</td><td class="txt_sitedetails"><?php = $home_phone ?></td></tr>
            <tr bgcolor="#eeeee1"><td class="txt_sitedetails">Mobile Number</td><td class="txt_sitedetails"><?php = $work_phone ?></td></tr>
            <tr bgcolor="#eeeee1" >
                <td class="txt_sitedetails">Date of Joining</td>
                <td class="txt_sitedetails"><?php = $date_join ?></td></tr>
            <tr bgcolor="#eeeee1"><td class="txt_sitedetails">Last login Date </td><td class="txt_sitedetails"><?php = $last_login_date; ?></td></tr>
        </table></td></tr></td></tr></table></td></tr>
<?php
}
if ($type == "sell") {
$member_sql = "select * from user_registration where user_id=$id";
$member_result = mysql_query($member_sql);
$member_row = mysql_fetch_array($member_result);
$username = $member_row['user_name'];
$sell_sql = "select * from placing_item_bid where user_id=$id and status='Active' and selling_method!='want_it_now'";
$sell = mysql_query($sell_sql);
if ($mode == 'live')
$sell_sql = "select * from placing_item_bid where user_id=$id and status='Active' and selling_method!='want_it_now'";
else if ($mode == 'sold')
$sell_sql = "select * from placing_item_bid where user_id=$id and quantity_sold > 0";
else if ($mode == 'unsold')
$sell_sql = "select * from placing_item_bid where user_id=$id and quantity_sold=0 and selling_method!='want_it_now'";
else if ($mode == 'want')
$sell_sql = "select * from placing_item_bid where user_id=$id and quantity_sold=0 and selling_method='want_it_now'";

$sell = mysql_query($sell_sql);
$total_records = mysql_num_rows($sell);
if ($total_records > 0) {
//get the total records
if (strlen($currec) == 0)
$currec = 1;
$start = ($currec - 1) * $limitsize;
$end = $limitsize;
$sell_sql .=" limit $start,$end";
$sell = mysql_query($sell_sql);
}
?>
<td width="792">
    <table border="0" cellpadding="5" cellspacing="2" width="97%" >
        <tr> 
            <td> <table border="0" align="center" cellpadding="5" cellspacing="2" width="100%" class=border2>
                    <tr> 
                        <td> <table border="0" align="center" cellpadding="5" cellspacing="2" width="100%">
                                <tr> 
                                    <td align="center"><a href="userdetails.php?id=<?php = $id ?>&type=sell&mode=live" class="txt_heading">Live 
                                            Items</a></td>
                                    <td align="center"><a href="userdetails.php?id=<?php = $id ?>&type=sell&mode=sold" class="txt_heading">Sold 
                                            Items</a></td>
                                    <td align="center"><a href="userdetails.php?id=<?php = $id ?>&type=sell&mode=unsold" class="txt_heading">Unsold 
                                            Items</a></td>
                                    <td align="center"><a href="userdetails.php?id=<?php = $id ?>&type=sell&mode=want" class="txt_heading">Want it Now 
                                            Items</a></td>					  
                                </tr>
                            </table></td>
                    </tr>
                    <tr bgcolor="CCCCCC" > 
                        <td align="center" colspan="2" class="txt_heading1"> 
                            <?php
                            if ($mode != '') {
                            $mode1 = $mode;
                            $mode = $mode . " Items";
                            ?>
                            <?php = ucwords($mode) ?>
                            <?php
                            } else {
                            ?>
                            Selling 
                            <?php
                            }
                            ?>
                            Details of 
                            <?php = $username; ?>
                            </font></b></td>
                    </tr>
                    <?php
                    if (($total_records) > 0) {
                    ?>
                    <tr  bgcolor="eeeee1"> 
                        <td><table cellpadding="0" cellspacing="0" align="center" width="100%">
                                <?php
                                $net = ($currec - 1 * $limitsize + $end) - $total_records;
                                $dis = $limitsize + $start;
                                if ($net <= 0)
                                $net = $end;
                                if ($dis <= $total_records) {
                                ?>
                                <tr align="left"  bgcolor="eeeee1"> 
                                    <td> <font size="2"> Showing <?php echo $start + 1; ?> <?php echo " - " . $dis; ?> 
                                        of <?php echo $total_records; ?> Items </font> </td>
                                    <?php
                                    } else {
                                    ?>
                                <br>
                                <br>
                                <tr align="left"  bgcolor="eeeee1"> 
                                    <td> <font size="2" class="font_tit_color">Showing <?php echo $start + 1; ?> 
                                        of <?php echo $total_records; ?> Item </font></td>
                                    <?php
                                    if ($currec != 1) {
                                    $ver = 1;
                                    ?>
                                    <td> <a href="userdetails.php?currec=<?php = ($currec - 1); ?>&type=sell&id=<?php = $id ?>&mode=<?php = $mode1; ?>" style="text-decoration:none;"> 
                                            <font size="2" face="Arial, Helvetica, sans-serif" class="font_tit_color">Previous 
                                            </font></a></td>
                                    <?php
                                    }
                                    }
                                    ?>
                                    <?php
                                    if ($currec != 1 and $ver != 1) {
                                    ?>
                                    <td><a href="userdetails.php?currec=<?php = ($currec - 1); ?>&type=sell&id=<?php = $id ?>&mode=<?php = $mode1; ?>" style="text-decoration:none;"> 
                                            <font size=2 class="font_tit_color" face="Arial, Helvetica, sans-serif">Previous 
                                            </font></a></td>
                                    <?php
                                    }
                                    $net = $total_records - ($currec * $limitsize + $end) + $end;
                                    if ($net > $limitsize)
                                    $net = $limitsize;
                                    if ($net <= 0)
                                    $net = $end;
                                    if ($total_records > ($start + $end)) {
                                    ?>
                                    <td> <a href="userdetails.php?currec=<?php = ($currec + 1); ?>&type=sell&id=<?php = $id ?>&mode=<?php = $mode1; ?>" style="text-decoration:none;" > 
                                            <font size=2 color="#003366" face="Arial, Helvetica, sans-serif"> 
                                            Next </font> </a></td>
                                    <?php
                                    }
                                    ?>
                                </tr>
                                <?php
                                }
                                ?>
                                <?php
                                if (mysql_num_rows($sell) > 0) {
                                ?>
                                <tr> 
                                    <td colspan="3"><table border="0" align="center" width="100%" cellpadding="5" cellspacing="0" class="tablebox">
                                            <tr bgcolor="#cccccc"> 
                                                <td>&nbsp;</td>
                                                <td><b>Item</b></td>
                                                <td><b>Current Price</b></td>
                                                <td><b>Quantity</b></td>
                                                <td><b>Ends</b></td>
                                                <td><b># of Bids</b></td>
                                            </tr>
                                            <?php
                                            while ($sell_row = mysql_fetch_array($sell)) {
                                            $sql = "select * from placing_item_bid where item_id=" . $sell_row[item_id];
                                            $result = mysql_query($sql);
                                            $row = mysql_fetch_array($result);
                                            $user_sql = "select * from user_registration where user_id=" . $row['user_id'];
                                            $user_res = mysql_query($user_sql);
                                            $user = mysql_fetch_array($user_res);
                                            $item_id = $row[item_id];
                                            $bid_sql = "select * from placing_bid_item where item_id=" . $item_id;
                                            $bid_res = mysql_query($bid_sql);
                                            $bid = mysql_fetch_array($bid_res);
                                            $total_bid = mysql_num_rows($bid_res);
                                            $bid_date = $bid['bidding_date'];
                                            $current_price = $bid['bidding_amount'];
                                            $tot_sql = "select count(*) from placing_bid_item where item_id=" . $item_id;
                                            $tot_res = mysql_query($tot_sql);
                                            $tot = mysql_fetch_array($tot_res);
                                            if ($row[selling_method] == "auction" or $row[selling_method] == "dutch_auction") {
                                            if ($total_bid > 0) {
                                            $current_price = $bid['bidding_amount'];
                                            } else {
                                            $current_price = $row['min_bid_amount'];
                                            }
                                            } else if ($row[selling_method] == 'fix') {
                                            $current_price = $row['quick_buy_price'];
                                            } else {
                                            $current_price = "N/A";
                                            }


                                            $expire_date = $row['expire_date'];
                                            require 'ends.php';

                                            if ($c == 1) {
                                            $c = 0;
                                            ?>
                                            <tr bgcolor="#EEEEE1"> 
                                                <?php
                                                } else {
                                                $c = 1;
                                                ?>
                                            <tr bgcolor="white"> 
                                                <?php
                                                }
                                                ?>
                                                <td> <a href="item_details.php?id=<?php echo $row['item_id']; ?>" alt="Click here to view item Description"> 
                                                        <?php
                                                        if (!empty($row[picture1])) {
                                                        ?>
                                                    </a><a href="item_details.php?id=<?php echo $row['item_id']; ?>">
                                                        <img height="40" width="40" src="../images/<?php echo $row['picture1']; ?>" border=0></a> 
                                                    <?php
                                                    } else {
                                                    ?>
                                                    <a href="item_details.php?id=<?php echo $row['item_id']; ?>">
                                                        <img height="40" width="40" src="../images/no-image.gif" border=0></a> 
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td> <a href="item_details.php?id=<?php echo $row['item_id']; ?>" class="txt_users"> 
                                                        <?php echo $row['item_title']; ?>
                                                    </a> </td>
                                                <td class="txt_sitedetails"> 
                                                    <?php echo $current_price; ?>
                                                </td>
                                                <td class="txt_sitedetails"> 
                                                    <?php = $row[Quantity] ?>
                                                </td>
                                                <td class="txt_sitedetails"> 
                                                    <?php = $string_difference ?>
                                                </td>
                                                <td class="txt_sitedetails"> 
                                                    <?php
                                                    if ($tot[0] == 0) {
                                                    $tot = "No Bid";
                                                    echo $tot;
                                                    } else {
                                                    $tot = $tot[0];
                                                    ?>
                                                    <a href="bid_detail.php?item_id=<?php echo $row['item_id']; ?>" id="link1" alt="Click here to view Bid details" class="txt_users"> 
                                                        <?php echo $tot; ?>
                                                    </a> 
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                            }
                                            } else {
                                            ?>
                                            <tr bgcolor="eeeee1"> 
                                                <td colspan="7" align="center"><b>There is no items display 
                                                        in this view</b></td>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                        </table></td>
                                </tr>
                            </table> 
                </table></td></tr>
    </table></td></tr></table></td></tr>
<?php
}
if ($type == "buy") {
$member_sql = "select * from user_registration where user_id=$id";
$member_result = mysql_query($member_sql);
$member_row = mysql_fetch_array($member_result);
$username = $member_row['user_name'];
$bid_sql = "select * from placing_bid_item where user_id=$id and user_pos='No'";
$bid = mysql_query($bid_sql);
$total_records = mysql_num_rows($bid);

if (!$mode)
$mode = 'bid';
if ($mode == 'bid')
$buy_sql = "select * from placing_bid_item where user_id=$id and user_pos='No'";
else if ($mode == 'won')
$buy_sql = "select * from placing_bid_item a,placing_item_bid b where a.user_id=$id and a.item_id=b.item_id and a.user_pos='Yes'";
else if ($mode == 'notwin')
$buy_sql = "select * from placing_bid_item a,placing_item_bid b where a.user_id=$id and a.item_id=b.item_id and a.user_pos='No' and b.status='Closed'";
$buy = mysql_query($buy_sql);
?>

<td width="792"> <table border="0" align="center" cellpadding="5" cellspacing="2" width="96%" class=border2>
        <tr> 
            <td><table border="0" align="center" cellpadding="5" cellspacing="2" width="100%">
                    <tr align="center"> 
                        <td align="center"><a href="userdetails.php?id=<?php = $id ?>&type=buy&mode=bid" class="txt_heading">Bidding Items</a></td>
                        <td align="center"><a href="userdetails.php?id=<?php = $id ?>&type=buy&mode=won" class="txt_heading">Won Items</a></td>
                        <td align="center"><a href="userdetails.php?id=<?php = $id ?>&type=buy&mode=notwin" class="txt_heading">Lost Items</a></td>
                    </tr>
                </table></td>
        </tr>
        <tr bgcolor="#CCCCCC"> 
            <td align="center" colspan="2" width="110%" class=txt_heading1> 
                Buying Details of 
                <?php = $username ?>
            </td>
        </tr>
        <?php
        $buy_tot = mysql_num_rows($buy);
        if ($buy_tot > 0) {
        ?>
        <tr> 
            <td colspan="2"> 
                <table border="0" align="center" width="100%" cellpadding="5" cellspacing="0" class="border2">
                    <tr bgcolor="#CCCCCC"> 
                        <td><b>Item</b></td>
                        <td><b>Bid Amount</b></td>
                        <td><b>Quantity</b></td>
                        <td><b>Total Amount</b></td>
                        <td><b>Bid Date</b></td>
                        <td><b>Ends</b></td>
                    </tr>
                    <?php
                    $c = 1;
                    while ($bid_row = mysql_fetch_array($buy)) {
                    $sql = "select * from placing_item_bid where item_id=" . $bid_row[item_id];
                    $result = mysql_query($sql);
                    $row = mysql_fetch_array($result);
                    $user_sql = "select * from user_registration where user_id=" . $row['user_id'];
                    $user_res = mysql_query($user_sql);
                    $user = mysql_fetch_array($user_res);
                    $item_id = $row[item_id];
                    $bid_sql = "select * from placing_bid_item where item_id=" . $item_id;
                    $bid_res = mysql_query($bid_sql);
                    $bid = mysql_fetch_array($bid_res);
                    $total_bid = mysql_num_rows($bid_res);
                    $bid_date = $bid['bidding_date'];
                    $current_price = $bid['bidding_amount'];
                    $tot_sql = "select count(*) from placing_bid_item where item_id=" . $item_id;
                    $tot_res = mysql_query($tot_sql);
                    $tot = mysql_fetch_array($tot_res);
                    if ($total_bid > 0) {
                    $current_price = $bid['bidding_amount'];
                    } else {
                    $current_price = $row['min_bid_amount'];
                    }
                    $expire_date = $row['expire_date'];
                    require 'ends.php';





                    if ($c == 1) {
                    $c = 0;
                    ?>
                    <tr bgcolor="white"> 

                        <?php
                        } else {
                        $c = 1;
                        ?>
                    <tr bgcolor="eeeee1"> 
                        <?php
                        }
                        ?>
                        <td class="txt_sitedetails"> 
                            <?php = $row[item_title]; ?>
                        </td>
                        <td class="txt_sitedetails"> 
                            <?php = $bid[bidding_amount]; ?>
                        </td>

                        <td class="txt_sitedetails"> 
                            <?php = $bid[quantity]; ?>
                        </td>

                        <td class="txt_sitedetails"><?php = ($bid[bidding_amount] * $bid[quantity]) ?></td>
                        <td class="txt_sitedetails"> 
                            <?php = $bid_date; ?>
                        </td>
                        <td class="txt_sitedetails"> 
                            <?php = $string_difference; ?>
                        </td>

                    </tr>
                    <?php
                    }
                    } else if (mysql_num_rows($buy) == 0) {
                    ?>
                    <tr bgcolor="eeeee1"> 
                        <td colspan="7" align="center"><b>There is no items display in 
                                this view</b></td>
                    </tr>
                    <?php
                    }
                    ?>
                </table></td>
        </tr>
    </table></td>
</tr></table></td></tr>
<?php
}
/* 	if($type=='feed')
  {
  $member_sql="select * from user_registration where user_id=$id";
  $member_result=mysql_query($member_sql);
  $member_row=mysql_fetch_array($member_result);
  $username=$member_row['user_name'];

  ?>
  <tr>
  <td> <table border="0" align="center" cellpadding="5" cellspacing="2" width="100%">
  <tr>
  <td> <table border="0" align="center" cellpadding="5" cellspacing="2" width="100%">
  <tr>
  <td align="center"><a href="userdetails.php?id=<?php echo $id?>&type=bon&mode=bonus">Bonus</a></td>
  <td align="center"><a href="userdetails.php?id=<?php echo $id?>&type=bon&mode=penalty">Penalty</a></td>
  </tr>
  </table></td>
  </tr>
  <tr>
  <td align="center" colspan="2"><b><font size="+2">
  <?php echo ucwords($mode)?>
  Details of
  <?php echo $username?>
  </font></b></td>
  </tr>
  <tr>
  <td colspan="2"> <table border="0" align="center" width="100%" cellpadding="5" cellspacing="2" class="tablebox">
  <tr>
  <td><b>Amount</b></td>
  <td><b>
  <?php echo ucwords($mode)?>
  Date</b></td>
  <td><b>Description</b></td>
  </tr>
  <?php
  if(mysql_num_rows($result)>0) {
  while($row=mysql_fetch_array($result)) {
  $amount=$row['amount'];
  $date=$row['date'];
  $description=$row['description'];
  ?>
  <tr>
  <td>
  <?php echo $amount?>
  </td>
  <td>
  <?php echo $date?>
  </td>
  <td>
  <?php echo $description?>
  </td>
  </tr>
  <?php
  }
  }
  else {
  ?>
  <tr>
  <td colspan="7" align="center">No
  <?php echo ucwords($mode)?>
  Found</td>
  </tr>
  <?php
  }
  ?>
  </table></td>
  </tr>
  </table></td>
  </tr>
  <?php
  } */
if ($type == 'ref') {
$member_sql = "select * from user_registration where user_id=$id";
$member_result = mysql_query($member_sql);
$member_row = mysql_fetch_array($member_result);
$username = $member_row['user_name'];
?>

<td width="792" height="157"><table border="0" align="center" cellpadding="5" cellspacing="2" width="100%">
        <tr> 
            <td align="center" colspan="2"><b><font size="+2">Referrals Details 
                    of 
                    <?php = $username ?>
                    </font></b></td>
        </tr>
        <tr align="center"> 
            <td> <table border="0" align="center" width="80%" cellpadding="5" cellspacing="2" class="tablebox">
                    <tr align="center"> 
                        <td><b>Level</b></td>
                        <td><b>Username</b></td>
                        <td><b>Join Date</b></td>
                    </tr>
                    <?php getReferral_details($id, 0) ?>
                </table></td>
        </tr>
    </table>
<tr align="center"> 
    <td height="35"> 
        <?php
        } else if ($type == 'account') {
        $member_sql = "select * from user_registration where user_id=$id";
        $member_result = mysql_query($member_sql);
        $member_row = mysql_fetch_array($member_result);
        $username = $member_row['user_name'];
        ?>
        <table border="0" cellpadding="2" cellspacing="0" width=550>
            <tr height=20><td></td></tr>
            <?php
            //calculate total Fund amount
            $query = "select * from addfunds where member_id='$id'";
            $table = mysql_query($query);
            $total_fund_amount = 0;
            if (mysql_num_rows($table) > 0)
            while ($row = mysql_fetch_array($table))
            $total_fund_amount +=$row['fund_amount'];
            //calculate total referral amount
            $query = "select * from referral_commission where user_id='$id'";
            $table = mysql_query($query);
            $total_referral_commission = 0;

            if (mysql_num_rows($table) > 0) {
            while ($row = mysql_fetch_array($table))
            $total_referral_commission +=$row['referral_commission'];
            }
            //calculate credit
            $query = "select * from my_credit where user_id='$id'";
            $table = mysql_query($query);
            $credit = 0;
            if (mysql_num_rows($table) > 0) {
            while ($row = mysql_fetch_array($table))
            $credit +=$row['amount'];
            }
            ?>
            <tr>
                <td align="center">
                    <table width="80%" class="table_border">
                        <tr class="mylist" height=30><td align="center" colspan="2"><b><font size="+2">Account Details of <?php = $username ?></b></font></td></tr>
                        <tr height=30><td><br><b>Available Cash</td>  <td><b>$ <?php echo $total_fund_amount; ?></td></tr>
                        <tr height=30><td><b>Referral Income</td> <td><b>$ <?php echo $total_referral_commission; ?></td></tr>
                        <tr height=30><td><b>Credits by posting Items</td> <td><b>$ <?php echo $credit ?></td></tr>
                        <tr><td colspan="2"><hr></td></tr>
                        <tr height=30><td><b>Total Amount</td>
                            <td><b>$ <?php echo ($total_fund_amount + $total_referral_commission - $credit); ?></td></tr>
                    </table>
                </td>
            </tr>
        </table>		  
        <?php
        }
        ?>		  
<tr bgcolor="#CCCCCC"><td colspan="2">
        <table border="0" align="center" cellpadding="5" cellspacing="2" width="85%" >
            <tr align="center" class="txt_heading"><td align="center"><a href="userdetails.php?id=<?php = $id ?>&type=gen" class="txt_heading">General</a></td>
                <td class="txt_heading"><a href="userdetails.php?id=<?php = $id ?>&type=per" class="txt_heading">Personal</a></td>
                <td class="txt_heading"><a href="userdetails.php?id=<?php = $id ?>&type=sell" class="txt_heading">Selling Details</a></td>
                <td class="txt_heading"><a href="userdetails.php?id=<?php = $id ?>&type=buy" class="txt_heading">Buying Details</a></td>
                <!-- <td><a href="userdetails.php?id=<?php = $id ?>&type=account">Account Details</a></td> 
                <td><a href="userdetails.php?id=<?php = $id ?>&type=ref">Refferal Details</a></td>  -->
            </tr>
        </table>
    </td></tr></table></td></tr>		  


<?php
require 'include/footer.php';
?>

