<?php
/* * *************************************************************************
 * File Name				:cleanup.php
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
ob_start();
require 'include/connect.php';
require 'include/top.php';
//clean duration
$query = "select * from admin_settings where set_id = 20 ";
$tab = mysql_query($query);
if ($row = mysql_fetch_array($tab))
    $cleanup_duration = $row['set_value'];
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#cecfc8">
    <tr><td>
            <table border="0" cellpadding="0" cellspacing="0" width="760" align="center"  bgcolor="#E8E8E8">
                <tr><td><br></td></tr>
                <tr><td>
                        <table align="center" width="100%" height="35">
                            <tr><td align="center" class="txt_users"><center><strong>Old Item Clean Up</strong></center></td></tr>
            </table>

            <?php
            $page_query = "select * from admin_settings where set_id=22";
            $page_table = mysql_query($page_query);
            if ($page_row = mysql_fetch_array($page_table))
                ;
            $page_length = $page_row['set_value'];
            {

                $check = $_REQUEST['check1'];
                $delete1 = $_REQUEST['delete1'];
                $deleteall1 = $_REQUEST[deleteall1];

                if (($delete1 == 1) && (count($check) != 0)) {
                    $w = 0;
                    foreach ($check as $mycheck) {
                        $w++;
                        $del_bid_sql = "delete from placing_bid_item where item_id=$mycheck";
                        mysql_query($del_bid_sql);
                        $del_dispute_sql = "delete from disputeconsole where itemid=$mycheck";
                        mysql_query($del_dispute_sql);
                        $del_watch_sql = "delete from watch_list where item_id=$mycheck";
                        mysql_query($del_watch_sql);
                        $del_feed_sql = "delete from feedback where item_id=$mycheck";
                        mysql_query($del_feed_sql);
                        $del_fees_sql = "delete from auction_fees where item_id=$mycheck";
                        mysql_query($del_fees_sql);

                        $del_sql = "delete from ask_question where item_id=" . $mycheck;
                        mysql_query($del_sql);
                        $del_sql = "delete from user_alert where item_id=" . $mycheck;
                        mysql_query($del_sql);
                        $del_sql = "delete from want_it_now where item_id=" . $mycheck;
                        mysql_query($del_sql);

                        $items_sql = "select * from placing_item_bid where item_id=" . $mycheck;
                        $items_qry = mysql_query($items_sql);
                        while ($items_fetch = mysql_fetch_array($items_qry)) {
                            if (!empty($items_fetch['picture1'])) {
                                unlink("../images/" . $items_fetch['picture1']);
                                unlink("../thumbnail/" . $items_fetch['picture1']);
                            }
                            if (!empty($items_fetch['picture2'])) {
                                unlink("../images/" . $items_fetch['picture2']);
                                unlink("../thumbnail/" . $items_fetch['picture1']);
                            }
                            if (!empty($items_fetch['picture3'])) {
                                unlink("../images/" . $items_fetch['picture3']);
                                unlink("../thumbnail/" . $items_fetch['picture1']);
                            }
                            if (!empty($items_fetch['picture4'])) {
                                unlink("../images/" . $items_fetch['picture1']);
                                unlink("../thumbnail/" . $items_fetch['picture4']);
                            }
                            if (!empty($items_fetch['picture5'])) {
                                unlink("../images/" . $items_fetch['picture5']);
                                unlink("../thumbnail/" . $items_fetch['picture1']);
                            }
                            if (!empty($items_fetch['picture6'])) {
                                unlink("../images/" . $items_fetch['picture6']);
                                unlink("../thumbnail/" . $items_fetch['picture1']);
                            }
                            if (!empty($items_fetch['picture7'])) {
                                unlink("../images/" . $items_fetch['picture7']);
                                unlink("../thumbnail/" . $items_fetch['picture1']);
                            }
                        }
                        $del = "delete from placing_item_bid where item_id=$mycheck";
                        $res = mysql_query($del);
                    }
                    echo "<br><font color='#ff0000' ><strong><center>$w Rows Deleted On Successfully !</center></strong></font> ";
                }


                if (($deleteall1 == 1)) {
                    $item_fetch_sql = "select * from placing_item_bid where status='Closed' and(to_days(now()) - to_days(expire_date) > $cleanup_duration)";
                    $item_fetch_qry = mysql_query($item_fetch_sql);
                    while ($item_fetch_row = mysql_fetch_array($item_fetch_qry)) {
                        if (!empty($item_fetch_row['picture1'])) {
                            unlink("../images/" . $item_fetch_row['picture1']);
                            unlink("../thumbnail/" . $item_fetch_row['picture1']);
                        }
                        if (!empty($item_fetch_row['picture2'])) {
                            unlink("../images/" . $item_fetch_row['picture2']);
                            unlink("../thumbnail/" . $item_fetch_row['picture2']);
                        }
                        if (!empty($item_fetch_row['picture3'])) {
                            unlink("../images/" . $item_fetch_row['picture3']);
                            unlink("../thumbnail/" . $item_fetch_row['picture3']);
                        }
                        if (!empty($item_fetch_row['picture4'])) {
                            unlink("../images/" . $item_fetch_row['picture4']);
                            unlink("../thumbnail/" . $item_fetch_row['picture4']);
                        }
                        if (!empty($item_fetch_row['picture5'])) {
                            unlink("../images/" . $item_fetch_row['picture5']);
                            unlink("../thumbnail/" . $item_fetch_row['picture5']);
                        }
                        if (!empty($item_fetch_row['picture6'])) {
                            unlink("../images/" . $item_fetch_row['picture6']);
                            unlink("../thumbnail/" . $item_fetch_row['picture6']);
                        }
                        if (!empty($item_fetch_row['picture7'])) {
                            unlink("../images/" . $item_fetch_row['picture7']);
                            unlink("../thumbnail/" . $item_fetch_row['picture7']);
                        }


                        $del_dis_sql = "delete from disputeconsole where itemid=" . $item_fetch_row['item_id'];
                        mysql_query($del_dis_sql);
                        $del_bid_sql = "delete from placing_bid_item where item_id=" . $item_fetch_row['item_id'];
                        mysql_query($del_bid_sql);
                        $del_watch_sql = "delete from watchlist where item_id=" . $item_fetch_row['item_id'];
                        mysql_query($del_watch_sql);
                        $del_feed_sql = "delete from feedback where item_id=" . $item_fetch_row['item_id'];
                        mysql_query($del_feed_sql);
                        $del = "delete from placing_item_bid where item_id=" . $item_fetch_row['item_id'];
                        mysql_query($del);
                        $del_sql = "delete from ask_question where item_id=" . $item_fetch_row['item_id'];
                        mysql_query($del_sql);
                        $del_sql = "delete from user_alert where item_id=" . $item_fetch_row['item_id'];
                        mysql_query($del_sql);
                        $del_sql = "delete from want_it_now where item_id=" . $item_fetch_row['item_id'];
                        mysql_query($del_sql);
                    }
                    /* $del="delete from placing_item_bid where status='closed' and (to_days(now()) - to_days(expire_date) >$cleanup_duration)";
                      if($res=mysql_query($del)) */
                    echo "<br> <font color='#ff0000' ><strong> All	 Rows Deleted On Successfully ! </strong></font> ";
                }
            }
            ?>
            <form name="myform" method="post" action="<?php = $_SERVER['php_self'] ?>" >
                <?php
                $query = "select * from placing_item_bid where status='Closed' and (to_days(now()) - to_days(expire_date) > $cleanup_duration)";
                $tab = mysql_query($query);
                ?>
                <?php
                if (mysql_num_rows($tab) == 0) {
                    echo "<table width=98%>";
                    echo "<trheight=30 ><td align=center>";
                    echo "<center><strong> No Rows Selected <strong></center>";
                    echo "</td></tr>";
                    echo "<tr><td colspan=7 >";
                    echo "</td></tr>";
                    echo "</table>";
                    echo "</td></tr>";
                    echo "</table>";
                    require 'include/footer1.php';
                    echo "</td></tr>";
                    echo "</table>";
                    exit();
                }
                ?>


                <?php
                $total = mysql_num_rows($tab);
                $totalx = ($total / $page_length);

                $reminder = ($total % $page_length);
                settype($totalx, 'int');

                if (($reminder == 0) && ($total != 0))
                    $totalx = $totalx - 1;

                $set = $_REQUEST['set'];
                if ($set == "")
                    $set = 0;
                $href = "cleanup.php?";

                $href.="&set=";
                ?>
                <table width="98%" align="center" >
                    <tr><td colspan="8" align="center" >
                            <b>There are <?php = $total; ?> Rows Selected.</b>
                        </td>
                        <td>
                            <?php if ($set != 0) { ?>  <a href="<?php = $href . ($set - 1) ?>  style="text-decoration:none"  id="link1"">  <?php } ?>    Prev <?php if ($set != 0) { ?> </a>  <?php } ?>
                        </td><td>
<?php if ($set != $totalx) { ?>  <a href="<?php = $href . ($set + 1) ?>  style="text-decoration:none"  id="link1"">  <?php } ?>     Next  <?php if ($set != $totalx) { ?> </a> <?php } ?>

                        </td></tr>
                </table>
                <table align="center" width="98%" class=border2>
                    <tr bgcolor="#CCCCCC">
                        <td width="4%">	</td>
                        <td align="center"><b>Item Id</b></td>
                        <td align="center"><b>Item Name</b></td>
                        <td align="center"><b>Seller Name</b></td>
                        <td align="center"><b>Quantity</b></td>
                        <td align="center"><b>Expire Date</b></td>
                        <td align="center"><b>Location</b></td>
                    </tr>
                    <?php
                    $start = $set * $page_length + 1;
                    $end = $set * $page_length + $page_length;
                    $i = 0;
                    while ($row = mysql_fetch_array($tab)) {
                        $i++;
                        if (($i < $start) || ($i > $end))
                            continue;
                        ?>
                        <tr bgcolor="#eeeee1">
                            <td><input name="check1[]" id="chkSub" type="checkbox" class="check" value="<?php echo $row['item_id']; ?>"></td>
                            <td><?php = $row['item_id']; ?></td>
                            <td><?php = $row['item_title']; ?></td>

                            <?php
                            $queryx = "select * from user_registration where user_id ='" . $row['user_id'] . "'";
                            $tabx = mysql_query($queryx);
                            if ($rowx = mysql_fetch_array($tabx))
                                ;
                            $user_name = $rowx['user_name'];
                            ?>
                            <td><?php = $user_name ?></td>
                            <td><?php = $row['Quantity']; ?></td>
                            <td><?php = $row['expire_date']; ?></td>
                            <?php
                            $item_sql = "select * from placing_item_bid where item_id=" . $row['item_id'];
                            $item_res = mysql_query($item_sql);
                            $item_row = mysql_fetch_array($item_res);
                            $item_sqll = "select * from user_registration where user_id=" . $item_row['user_id'];
                            $item_ress = mysql_query($item_sqll);
                            $item_roww = mysql_fetch_array($item_ress);
                            if ($rowx['country']) {
                                $item_country = "select * from country_master where country_id=" . $rowx['country'];
                                $country = mysql_query($item_country);
                                $country_row = mysql_fetch_array($country);
                            }
                            ?>	
                            <td><?php = $country_row['country'] ?></td>



                        </tr>
                        <?php
                    }
                    ?>
                    <tr bgcolor="#eeeee1">
                        <td colspan="8" style="text-align:center">
                            <input type="hidden" name="del" value="1">
<?php echo $row['item_id']; ?>
                            <input type="hidden" name="del_id" value="<?php echo $row['item_id']; ?>">
                            <input type="hidden" name="delete1" value="0">	
                            <input type="hidden" name="deleteall1" vlalue="0">
                            <input type="button" name="delete" value="Delete" class="button"  onclick="mydel()" >
                            <input type="button" name="delete_all" value="Delete All" class="button"  onclick="mydelall()" >
                        </td>
                    </tr>

                </table>
            </form>
        </td></tr></table>
</td></tr></table>
<?php
require 'include/footer1.php';
?>
<script language="javascript">
    function mydel()
    {
        if (document.myform.check1.checked == false)
        {
            alert("Please select any item");
            return false;
        }
        var empty = 0;
        for (var k = 0; k < document.myform.check1.length; k++)
        {
            if (document.myform.check1[k].checked == false)
                empty = empty + 1;
        }
        if (document.myform.check1.length == empty)
        {
            alert("Please select any item");
            return false;
        }

        var where_to = confirm("Are you sure you want to delete the items?");
        if (where_to == true)
        {
            document.myform.delete1.value = 1;
            document.myform.submit();
        }
        else
        {
            window.location = "cleanup.php";
            document.myform.submit();
        }
    }

    function mydelall()
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
        var where_to = confirm("Are you sure you want to delete the items?");
        if (where_to == true)
        {
            document.myform.deleteall1.value = 1;
            document.myform.submit();
        }
        else
        {
            window.location = "cleanup.php";
            document.myform.submit();
        }
    }

</script>