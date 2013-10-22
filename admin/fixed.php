<?php
/* * *************************************************************************
 * File Name				:fixed.php
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
$adate = $_SESSION['adate'];
$bdate = $_SESSION['bdate'];
$cdate = $_SESSION['cdate'];
$ddate = $_SESSION['ddate'];
$iid = $_SESSION['iid'];
/*
  file name:auction.php;
  date	  :21.10.05
  Created by:priya
  Rights reserved by AJ Square inc
 */
require 'include/connect.php';
require 'include/top.php';
$val = $_GET['val'];
if ($val == '')
    $val = 'actv';
$uid = $_POST['uid'];
$amnt = $_POST['amnt'];
$pthru = $_POST['pthru'];
$mode = $_GET['mode'];
$catid = $_GET['id'];

if ($mode == "Active" or $mode == "paid") {
    $item_id = $_GET[item_id];
    $up_sql = "update placing_item_bid set status='Active' where item_id=$item_id";
    $up_res = mysql_query($up_sql);

    $sq = mysql_query("select * from placing_item_bid where item_id=$item_id");
    $sq1 = mysql_fetch_array($sq);
    $cat = "Activated the following item " . $sq1['item_title'];

    $msg = "<b><font size=2 color=red>Updated Successfully</font></b><br>";
}
if ($mode == "close") {
    $item_id = $_GET[item_id];
    $up_sql = "update placing_item_bid set status='Closed' where item_id=$item_id";
    $up_res = mysql_query($up_sql);

    $sq = mysql_query("select * from placing_item_bid where item_id=$item_id");
    $sq1 = mysql_fetch_array($sq);
    $cat = "Closed the following item " . $sq1['item_title'];


    $msg = "<b><font size=2 color=red>Updated Successfully</font></b><br>";
}
if ($val == 'exp')
    $sql = "select * from placing_item_bid where status='Closed' and selling_method='fix'";
else if ($val == 'today')
    $sql = "select * from placing_item_bid  where TO_DAYS((bid_starting_date))=TO_DAYS( NOW( )) and selling_method='fix' ";
else if ($val == 'actv')
    $sql = "select * from placing_item_bid  where status='Active' and selling_method='fix' ";
else if ($val == 'sold')
    $sql = "select * from placing_item_bid where quantity_sold > 0 and selling_method='fix'";
else if ($val == 'unpaid')
    $sql = "select * from placing_item_bid where status='new' and selling_method='fix'";

$res = mysql_query($sql);
$id = $_POST['id'];
if (isset($_POST['btn_release'])) {
    $coid = $_POST['chkSub'];
    foreach ($coid as $cnid) {

        $sq = mysql_query("select * from placing_item_bid where item_id=$cnid");
        $sq1 = mysql_fetch_array($sq);
        $cat = $cat . $sq1['item_title'] . "<br>";

        $masql = "delete from placing_item_bid where item_id=$cnid";
        $mares = mysql_query($masql);
        $masql = "delete from placing_bid_item where item_id=$cnid";
        $mares = mysql_query($masql);
        $masql = "delete from watch_list where item_id=$cnid";
        $mares = mysql_query($masql);
        $masql = "delete from featured_items where item_id=$cnid";
        $mares = mysql_query($masql);
        $message = "Items deleted sucessfully";
    }
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
<link href="include/style.css" rel="stylesheet" type="text/css">
<table border="0" align="center" cellpadding="5" cellspacing="2" width="100%" background="images/bg08.jpg">
    <tr><td>   
            <table>
                <tr><td width="93" bgcolor="#FFFFFF"><table id="Table_01" width="93"  border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td><img src="images/index_02_03_03_01.jpg" width="93" height="26" alt=""></td>
                            </tr>
                            <tr>
                                <td><a href="user.php"><img src="images/index_02_03_03_02.jpg" width="93" height="70" alt="" border="0" title="UserManagement"></a></td>
                            </tr>
                            <tr>
                                <td><a href="site.php"><img src="images/index_02_03_03_03.jpg" width="93" height="71" alt="" border="0" title="GeneralSettings"></a></td>
                            </tr>
                            <tr>
                                <td><a href="item_user.php"><img src="images/index_02_03_03_04.jpg" width="93" height="73" alt="" border="0" title="AddItem"></a></td>
                            </tr>
                            <tr>
                                <td><a href="report.php?page=out"><img src="images/index_02_03_03_05.jpg" width="93" height="71" alt="" border="0" title="DetailReport"></a></td>
                            </tr>
                            <tr>
                                <td><a href="store_manager.php"><img src="images/index_02_03_03_06.jpg" width="93" height="70" alt="" border="0" title="StoreManager"></a></td>
                            </tr>
                            <tr>
                                <td><a href="bulk_load.php"><img src="images/index_02_03_03_07.jpg" width="93" height="66" alt="" border="0" title="BulkLoader"></a></td>
                            </tr>
                            <tr bgcolor="#ffffff">
                                <td height="100">&nbsp;</td>
                            </tr>
                        </table></td>
                    <td width=793>
                        <table align="center" width="95%" height="35" >

                            <?php require 'include/search.php' ?>
                            <tr bgcolor="#CCCCCC">
                                <td width="10%" align="center"><a href="auction.php" id="link3">Simple Auction </a></td>
                                <td width="13%" align="center"><a href="dutch_auction.php" id="link3"> Dutch Auction </a></td>
                                <td width="18%" align="center"><a href="fixed.php" id="link3">Fixed Price Sale </a></td>
                                <td width="12%" align="center"><a href="classified.php" id="link3">Classified Ads</a></td>
                             <!--   <td width="12%" align="center"><a href="want_it_now.php" id="link3">Want it Now</a></td>-->		
                            </tr>
                        </table>
                        <?php
                        if ($msg) {
                            ?>
                            <table width="100%"> <tr align="center"><td colspan="2"><br> <?php = $msg; ?> </td></tr></table>
                            <?php
                            $msg = "";
                        }
                        ?>

                        <form name="frm1" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"> 
                            <table align="center" width="100%"> 
                                <tr> 
                                    <td align="center"><a href="fixed.php?val=today" class="txt_users">New Items</a></td> 
                                    <td align="center"><a href="fixed.php?val=actv" class="txt_users">Live Items</a></td> 
                                    <td align="center"><a href="fixed.php?val=unpaid" class="txt_users">Unpaid Items</a></td> 
                                    <td align="center"><a href="fixed.php?val=sold" class="txt_users">Sold Items</a></td> 
                                    <td align="center"><a href="fixed.php?val=exp" class="txt_users">Expired Items</a></td> 

                                </tr> 
                            </table> 
                            <table align="center" width="98%" class="border2"> 
                                <tr bgcolor="#CCCCCC"><td height="24" colspan="8" align="center"><b>Fixed Price Sale</b></td></tr>  
                                <tr bgcolor="#CCCCCC" align="center"> 
                                    <td height="24" colspan="8"><b><?php if ($val == 'today') echo 'New ';else if ($val == 'actv') echo 'Live';else if ($val == 'sold') echo 'Sold';else if ($val == 'exp') echo 'Expired '; else if ($val == 'unpaid') echo "Unpaid"; ?> Items</b></td> 
                                </tr> 
                                <tr bgcolor="#CCCCCC" class="style1"> 
                                    <td width="4%"><input type="checkbox" name="chkMain" onClick="chkall();" class="check" value=1></td> 
                                    <td width="23%">Item Name</td> 
                                    <td width="23%">
                                        <?php if ($val != "sold") echo "Buy Now Price"; else if ($val == "sold") echo "Sold Amount"; ?> </td> 

                                    <td width="25%">Seller</td> 

                                    <td width="13%">
                                        <?php if ($val != "sold") echo "Ends"; else if ($val == "sold") echo "Buyer"; ?> 
                                    </td> 
                                <!-- <td width="11%"># of Bids</td>  -->
                                    <td width="21%"># of Clicks</td> 

                                    <?php
                                    if ($val != "sold") {
                                        ?> 
                                        <td width="21%">Status</td> 
                                        <?php
                                    }
                                    ?> 

                                </tr> 
                                <?php
                                if ($catid != "") {
                                    $cat_sql = "select * from category_master where category_head_id=$catid";
                                    $cat_res = mysql_query($cat_sql);
                                    $tot_rec = mysql_num_rows($cat_res);

                                    $cat = "category_id=";
                                    if ($tot_rec > 0) {
                                        while ($cat_row = mysql_fetch_array($cat_res)) {
                                            $cat = $cat . $cat_row['category_id'] . " or category_id=";
                                        }
                                        $cat = rtrim($cat, " or category_id=");
                                    } else {
                                        $cat = "category_id=$cate_id";
                                    }

                                    $sql = "select * from placing_item_bid where ( $cat ) and status='Active'";
                                }
                                if ($adate != '' && $adate != '--')
                                    $sql.="and  bid_starting_date >='$adate' ";
                                if ($bdate != '' && $bdate != '--')
                                    $sql.="and  bid_starting_date <='$bdate' ";

                                if ($cdate != '' && $cdate != '--')
                                    $sql.="and  expire_date  >='$cdate'  ";
                                if ($ddate != '' && $ddate != '--')
                                    $sql.=" and expire_date  <='$ddate' ";

                                if ($iid != '')
                                    $sql.=" and item_id=$iid ";


                                $tot = mysql_num_rows($res);
                                $curpage = $_GET['curpage'];
                                if (strlen($_GET['curpage']) == 0)
                                    $curpage = 1;

                                /* $page=mysql_query("select * from admin_settings where set_id=75");
                                  $perpage=mysql_fetch_array($page);
                                 */
                                $start = ($curpage - 1) * 10;
                                $end = 10;

                                $sql.=" limit $start,$end";
                                $res = mysql_query($sql);
                                ?> 
                                <tr bgcolor="#eeeee1"> 
                                    <td align="right" colspan="8"> <?php
                                        if ($curpage != 1) {
                                            ?> 
                                            <a href="fixed.php?curpage=<?php = ($curpage - 1); ?>&val=<?php = $val ?>" id="link2">Prev</a> |
                                            <?php
                                        }
                                        ?> 
                                        <?php
                                        if ($tot > ($start + $end)) {
                                            ?> 
                                            <a href="fixed.php?curpage=<?php = ($curpage + 1); ?>&val=<?php = $val ?>" id="link2">Next</a> 
                                            <?php
                                        }
                                        ?> </td> 
                                </tr> 
                                <?php
                                if ($tot > 0) {
                                    while ($row = mysql_fetch_array($res)) {
                                        ?> 
                                        <tr bgcolor="#eeeee1" align="center"> 
                                            <td ><input name="chkSub[]" id="chkSub" type="checkbox" class="check" value="<?php echo $row['item_id']; ?>">
                                                <input type="hidden" name="id" value="<?php = $row['deposit_id']; ?>"></td> 
                                            <td><a href="item_details.php?id=<?php = $row[item_id] ?>" id="link3"><?php
                                                    echo $row['item_title'];
                                                    ?></a></td> 
                                            <td>
                                                <?php
                                                echo $row[currency] . "&nbsp;";
                                                $cur_sql = "select MAX(bidding_amount) from placing_bid_item where item_id=" . $row['item_id'];
                                                $cur_res = mysql_query($cur_sql);
                                                $cur_row = mysql_fetch_array($cur_res);
                                                if ($val != "sold") {
                                                    /* if(!empty($cur_row[0]))
                                                      echo $cur_row['bidding_amount'];
                                                      else
                                                      echo $row['min_bid_amount']; */
                                                    echo $row['quick_buy_price'];
                                                } else if ($val == "sold") {
                                                    $cur_sql = "select * from placing_bid_item where user_pos='yes' and item_id=" . $row['item_id'];
                                                    $cur_res = mysql_query($cur_sql);
                                                    $cur_row = mysql_fetch_array($cur_res);
                                                    echo $cur_row['bidding_amount'];
                                                }
                                                ?>
                                            </td>
                                            <td><a href="userdetails.php?id=<?php = $row[user_id] ?>&type=gen" id="link3">
                                                    <?php
                                                    $mres = mysql_query("select * from user_registration where user_id=" . $row['user_id']);
                                                    $mrow = mysql_fetch_array($mres);
                                                    echo $mrow['user_name'];
                                                    ?></a>
                                            </td> 
                                            <td>
                                                <?php
                                                if ($val != "sold") {
                                                    $expire_date = $row['expire_date'];
                                                    require 'ends.php';
                                                    echo "$string_difference";
                                                } else if ($val == "sold") {
                                                    $cur_sql = "select * from placing_bid_item where  user_pos='yes' and item_id=" . $row['item_id'];
                                                    $cur_res = mysql_query($cur_sql);
                                                    $cur_row = mysql_fetch_array($cur_res);
                                                    $mres = mysql_query("select * from user_registration where user_id=" . $cur_row['user_id']);
                                                    $mrow = mysql_fetch_array($mres);
                                                    ?>
                                                    <a href="userdetails.php?id=<?php = $row[user_id] ?>&type=gen" id="link3">
                                                        <?php
                                                        echo $mrow['user_name'];
                                                        ?>
                                                    </a>
                                                    <?php
                                                }
                                                ?></td> 
                                <!-- <td>
                                    <a href="bid_detail.php?item_id=<?php = $row['item_id']; ?>" id="link3"><?php
                                            $bid_sql = "select * from placing_bid_item where item_id=" . $row['item_id'];
                                            $bid_res = mysql_query($bid_sql);
                                            $bid_row = mysql_fetch_array($bid_res);
                                            $no_of_bid = mysql_num_rows($bid_res);
                                            ?>
                                            <?php = $no_of_bid; ?> </a></td> 
                               <td width="3%"> <?php
                                            if ($row['clicks'] == 0)
                                                echo "-";
                                            else
                                                echo $row['clicks'];
                                            ?></td>  -->
                                            <?php
                                            if ($val != "sold") {
                                                ?>
                                                <td>
                                                    <?php
                                                    if ($row['clicks'] == 0)
                                                        echo "-";
                                                    else
                                                        echo $row['clicks'];
                                                    ?> 
                                                </td>

                                                <td>
                                                    <?php
                                                    if ($row[status] == "Active") {
                                                        ?>
                                                        <a href="fixed.php?item_id=<?php = $row['item_id']; ?>&mode=close" id="link3"> <?php = "Close" ?> </a>
                                                        <?php
                                                    } else if ($row[status] == "Suspend") {
                                                        ?>
                                                        <a href="fixed.php?item_id=<?php = $row['item_id']; ?>&mode=Active" id="link3"> <?php = "Active" ?> </a>
                                                        <?php
                                                    } else if ($row[status] == "Closed") {
                                                        ?>
                                                        <a href="fixed.php?item_id=<?php = $row['item_id']; ?>&mode=Active" id="link3"> <?php = "Active" ?> </a>
                                                        <?php
                                                    } else if ($row[status] == "new") {
                                                        ?>
                                                        <a href="fixed.php?item_id=<?php = $row['item_id']; ?>&mode=paid" id="link3"> Paid </a>
                                                        <?php
                                                    }
                                                    ?>

                                                </td>
                                                <?php
                                            } else {
                                                ?>
                                                <td>
                                                    <?php
                                                    if ($row['clicks'] == 0)
                                                        echo "-";
                                                    else
                                                        echo $row['clicks'];
                                                    ?> 
                                                </td>
                                                <?php
                                            }
                                            ?>
                                        </tr>
                                        <input type="hidden" name="uid"  value="<?php = $row['member_id']; ?>">
                                        <input type="hidden" name="amnt"  value="<?php = $row['amount']; ?>">
                                        <input type="hidden" name="pthru"  value="<?php = $row['payment_thro']; ?>">
                                        <?php
                                    }
                                    ?> 
                                    <?php if ($val != 'actv') { ?> 
                                        <tr bgcolor="#eeeee1"> 
                                            <td colspan="8"> 
                                                <input type="submit" name="<?php
                                                if ($val == 'new')
                                                    echo 'btn_new'; else if ($val == 'mature')
                                                    echo 'btn_mature';
                                                else
                                                    echo 'btn_release';
                                                ?>" value="<?php
                                                       if ($val == 'new')
                                                           echo 'Activate';
                                                       else
                                                           echo 'Delete';
                                                       ?>" class="button"></td> 
                                        </tr> 
                                    <?php } ?> 

                                    <?php
                                } else
                                    echo '<tr align=center bgcolor="#eeeee1"><td colspan=7><font color=#FF0000>No items Found</font></td></tr>';
                                ?> 
                            </table> 
                        </form> </td></tr></table></td></tr></table> 
<?php
require 'include/footer.php';
?> 
<script language="JavaScript">
    function chkall() {
        len = document.frm1.chkSub.length;
        if (len > 1) {
            for (i = 0; i < len; i++) {
                if (document.frm1.chkMain.checked == true) {
                    document.frm1.chkSub[i].checked = true;
                }
                else {
                    document.frm1.chkSub[i].checked = false;
                }
            }
        }
        else {
            if (document.frm1.chkMain.checked == true) {
                document.frm1.chkSub.checked = true;
            }
            else {
                document.frm1.chkSub.checked = false;
            }

        }
    }

    function condelete()
    {
        var confrm;
        confrm = window.confirm("Are You sure you want to delete");
        return confrm;
    }
</script> 
