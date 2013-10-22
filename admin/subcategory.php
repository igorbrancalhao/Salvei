<?php
/* * *************************************************************************
 * File Name				:subcategory.php
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
session_start();
error_reporting(0);
require 'include/connect.php';
$cat_id = $_GET['id'];
$mode = $_GET['mode'];

function easy_cat_display($ssid, $cat) {
    $cat = "category_id=$ssid or ";
    $ss_sql = "select * from category_master where category_head_id=$ssid";
    $sub_res = mysql_query($ss_sql);
    while ($cat_row = mysql_fetch_array($sub_res)) {
        if ($cat_row['category_id']) {
            $cat.="category_id=" . $cat_row[category_id] . " or ";
            $ssid = $cat_row['category_id'];
            $_SESSION[catt] = $_SESSION[catt] . "$cat";
            easy_cat_display($ssid, $cat);
        }
    }
}
?>

<?php
require 'include/top.php';
?>
<link href="include/style.css" rel="stylesheet" type="text/css">
<table border="0" align="center" cellpadding="5" cellspacing="2" width="100%" background="images/bg08.jpg">
    <tr><td>
            <table width=100%>
                <tr><td width=93>
                        <table id="Table_01" width="93" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td><img src="images/links1_01.jpg" width="93" height="26" alt=""></td>
                            </tr>
                            <tr>
                                <td><a href=auction.php><img src="images/links1_02.jpg" width="93" height="70" alt="" border="0" title="AuctionMaster"></a></td>
                            </tr>
                            <tr>
                                <td><a href=site.php?page=auction><img src="images/links1_03.jpg" width="93" height="71" alt="" border="0" title="AuctionSettings"></a></td>
                            </tr>
                            <tr>
                                <td><a href=category.php><img src="images/links1_04.jpg" width="93" height="73" alt="" border="0" title="CategorySettings"></a></td>
                            </tr>
                            <tr>
                                <td><a href=subcategory.php><img src="images/links1_05.jpg" width="93" height="71" alt="" border="0" title="SubcategorySettings"></a></td>
                            </tr>
                            <tr>
                                <td><a href=custom_category.php><img src="images/links1_06.jpg" width="93" height="70" alt="" border="0" title="CustomCategory"></a></td>
                            </tr>
                            <tr>
                                <td><a href=insertion_fee_settings.php><img src="images/links1_07.jpg" width="93" height="66" alt="" border="0" title="AuctionFeeManagement"></a></td>
                            </tr>
                        </table></td><td width="792" align="left">

                        <table width="98%" border="0" cellpadding="5" cellspacing="1" class="border2" >
                            <form name="sub" method="post" action="add.php">

                                <tr bgcolor="#CCCCCC" class="style1">
                                    <td width="25%"><div align="center"><span class="txt_users">Category </span></div></td>
                                    <td width="25%"><div align="center"><span class="txt_users">SubCategory </span></div></td>
                                    <td width="27%"><div align="center"><span class="txt_users">Edit</span></div></td>
                                    <td width="22%" class="style1"><div class="txt_users">Delete</div></td>
                                </tr>

                                <?php
                                if ($mode == 'delete') {
                                    $_SESSION[catt] = "";
                                    $cat_sql1 = "select * from category_master where category_id=" . $cat_id;
                                    $cat_sql1_res = mysql_query($cat_sql1);
                                    $tot_rec = mysql_num_rows($cat_sql1_res);

                                    /* Deleting corresponding items in the specific category and subcategory */
                                    $cat = "category_id=" . $cat_id . " or ";
                                    if ($tot_rec > 0) {
                                        $cat_row = mysql_fetch_array($cat_sql1_res);
                                        $ssid = $cat_row['category_id'];
                                        if ($ssid) {
                                            easy_cat_display($ssid, $cat);
                                        }
                                        $cat.=$_SESSION['catt'];
                                        $cat = rtrim($cat, " or ");
                                    }
                                    $sql_items = "select * from placing_item_bid where ($cat)";
                                    $sqlqry_items = mysql_query($sql_items);
                                    $sqlqry_items_rows = mysql_num_rows($sqlqry_items);
                                    if ($sqlqry_items_rows > 0) {
                                        while ($sql_fetch_items = mysql_fetch_array($sqlqry_items)) {
                                            $sqldel_open = "select picture1,picture2,picture3,picture4,picture5,picture6,picture7 from placing_item_bid where item_id=" . $sql_fetch_items['item_id'];
                                            $sqlqrydel_open = mysql_query($sqldel_open);
                                            $sqlfetchdel_open = mysql_fetch_array($sqlqrydel_open);
                                            if (!empty($sqlfetchdel_open['picture1'])) {
                                                unlink("../images/" . $sqlfetchdel_open['picture1']);
                                                unlink("../thumbnail/" . $sqlfetchdel_open['picture1']);
                                            }
                                            if (!empty($sqlfetchdel_open['picture2'])) {
                                                unlink("../images/" . $sqlfetchdel_open['picture2']);
                                                unlink("../thumbnail/" . $sqlfetchdel_open['picture2']);
                                            }
                                            if (!empty($sqlfetchdel_open['picture3'])) {
                                                unlink("../images/" . $sqlfetchdel_open['picture3']);
                                                unlink("../thumbnail/" . $sqlfetchdel_open['picture3']);
                                            }
                                            if (!empty($sqlfetchdel_open['picture4'])) {
                                                unlink("../images/" . $sqlfetchdel_open['picture4']);
                                                unlink("../thumbnail/" . $sqlfetchdel_open['picture4']);
                                            }
                                            if (!empty($sqlfetchdel_open['picture5'])) {
                                                unlink("../images/" . $sqlfetchdel_open['picture5']);
                                                unlink("../thumbnail/" . $sqlfetchdel_open['picture5']);
                                            }
                                            if (!empty($sqlfetchdel_open['picture6'])) {
                                                unlink("../images/" . $sqlfetchdel_open['picture6']);
                                                unlink("../thumbnail/" . $sqlfetchdel_open['picture6']);
                                            }
                                            if (!empty($sqlfetchdel_open['picture7'])) {
                                                unlink("../images/" . $sqlfetchdel_open['picture7']);
                                                unlink("../thumbnail/" . $sqlfetchdel_open['picture7']);
                                            }


                                            $sql_del = "delete from placing_item_bid where item_id=" . $sql_fetch_items['item_id'];
                                            $sqlqry_del = mysql_query($sql_del);

                                            $sql_del = "delete from placing_bid_item where item_id=" . $sql_fetch_items['item_id'];
                                            $sqlqry_del = mysql_query($sql_del);

                                            $sql_del = "delete from featured_items where item_id=" . $sql_fetch_items['item_id'];
                                            $sqlqry_del = mysql_query($sql_del);

                                            $sql_del = "delete from auction_fees where item_id=" . $sql_fetch_items['item_id'];
                                            $sqlqry_del = mysql_query($sql_del);

                                            $sql_del = "delete from auction_fees where item_id=" . $sql_fetch_items['item_id'];
                                            $sqlqry_del = mysql_query($sql_del);

                                            $sql_del = "delete from disputeconsole where itemid=" . $sql_fetch_items['item_id'];
                                            $sqlqry_del = mysql_query($sql_del);

                                            $sql_del = "delete from watch_list where item_id=" . $sql_fetch_items['item_id'];
                                            $sqlqry_del = mysql_query($sql_del);
                                        }
                                    }
                                    /* End of Deleting corresponding items in the specific category and subcategory */

                                    $sql1 = "delete from category_master where ($cat)";
                                    $del = mysql_query($sql1);
                                    if ($del)
                                        $message = "Category deleted successfully";
                                    else
                                        $message = "Category not deleted ";
                                }
                                $mode = '';
                                if (!empty($message)) {
                                    echo "<tr bgcolor=#eeeee1><td align=center colspan=4><font color=red size=2>$message</font></td></tr>";
                                }

                                if ($mode == 'edit') {
                                    
                                }
                                $sql = "select * from category_master where category_head_id=0 and custom_cat='0' order by category_name ";
                                $res = mysql_query($sql);
                                $cat_row = mysql_fetch_array($res);
                                $categoryid = $row['category_id'];
                                ?>
                                <?php
                                $total_records = mysql_num_rows($res);
                                $curpage = $_GET['curpage'];
                                if (strlen($_GET['curpage']) == 0)
                                    $curpage = 1;
                                $start = ($curpage - 1) * 3;
                                $end = 3;
                                if ($curpage == '' || $curpage == 1)
                                    $i = 1;
                                else
                                    $i = $_GET['sno'] + 1;
                                $sql.=" limit $start,$end";
                                $res = mysql_query($sql);
                                ?>


                                <tr bgcolor="#eeeee1"> 
                                    <td align="right" colspan="5"> 
                                        <?php
                                        if ($curpage != 1) {
                                            ?>
                                            <a href="subcategory.php?mode=<?php = $mode; ?>&curpage=<?php = ($curpage - 1); ?>" id="link2">Prev</a> 
                                            | 
                                            <?php
                                        }
                                        ?>
                                        <?php
                                        if ($total_records > ($start + $end)) {
                                            ?>
                                            <a href="subcategory.php?mode=<?php = $mode; ?>&curpage=<?php = ($curpage + 1); ?>" id="link2">Next</a> 
                                            <?php
                                        }
                                        ?>
                                    </td>
                                </tr>

                                <?php
                                while ($cat_row = mysql_fetch_array($res)) {
                                    $sub_sql = "select * from category_master where category_head_id=$cat_row[category_id] order by category_name";
                                    $sub_res = mysql_query($sub_sql);
                                    ?>
                                    <tr bgcolor="eeeee1">

                                        <td height="41" align="left" style="padding-left:20px"><?php = $cat_row['category_name']; ?></td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>


                                    <?php
                                    while ($row = mysql_fetch_array($sub_res)) {

                                        $_SESSION[catt] = "";
                                        $cat_sql1 = "select * from category_master where category_id=" . $row['category_id'];
                                        $cat_sql1_res = mysql_query($cat_sql1);
                                        $tot_rec = mysql_num_rows($cat_sql1_res);

                                        /* To count no. of items */
                                        $cat = "category_id=" . $row['category_id'] . " or ";
                                        if ($tot_rec > 0) {
                                            $cat_row = mysql_fetch_array($cat_sql1_res);
                                            $ssid = $cat_row['category_id'];
                                            if ($ssid) {
                                                easy_cat_display($ssid, $cat);
                                            }
                                            $cat.=$_SESSION['catt'];
                                            $cat = rtrim($cat, " or ");
                                        }
                                        $sql_items = "select * from placing_item_bid where ($cat)";
                                        $sqlqry_items = mysql_query($sql_items);
                                        $sqlqry_rows = mysql_num_rows($sqlqry_items);


                                        /* End of counting no. of items */
                                        ?>
                                        <tr bgcolor="eeeee1">
                                            <td>&nbsp;</td>	

                                            <td class="txt_newuser"><a href="#" onclick=window.open('subcategory_view.php?id=<?php = $row['category_id'] ?>','my_win','width=550,height=300') class="txt_users"><?php = $row[category_name]; ?></a></td>		
                                            <td><div align="center" class="style3">
                                                    <a href="add.php?id=<?php = $row['category_id']; ?>&mode=edit" style="text-decoration:none" id="link1">Edit</a></div></td>
                                            <td><div align="center" class="style3">
                                                    <a href="subcategory.php?id=<?php = $row['category_id']; ?>&mode=delete"  id="link1" style="text-decoration:none" onClick="javascript:return condelete(<?php = $sqlqry_rows ?>);">Delete</a></div></td>
                                        </tr>
                                        <?php
                                    } //        while($row=mysql_fetch_array($sub_res))
                                } //          while($cat_row=mysql_fetch_array($res))
                                ?>	

                                <tr bgcolor="eeeee1">
                                    <td colspan="5">

                                        <input type="submit" name="add" value="Add Subcategory" class="button"></div>
                                    </td>
                                </tr>
                            </form></table></td></tr></table></td></tr></td></tr></table>
<script language="JavaScript">
    function condelete(items)
    {
        var confrm;
        alert("There are " + items + " postings in this category");
        confrm = window.confirm("Are You sure you want to delete this category.Deletion of category will remove the corresponding item posting under this category and subcategory");
        return confrm;
    }
</script>

<?php
require 'include/footer.php';
?>
</body></html>
