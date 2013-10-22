<?php
/* * *************************************************************************
 * File Name				:subcat.php
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
/*
  file name:browse_cate.php;
  date	  :6.7.05
  Created by:priya
  Rights reserved by AJ Square inc
 */
session_start();
error_reporting(0);
require 'include/connect.php';
if (is_numeric($_GET[cate_id])) {
    $cat_id = $_GET[cate_id];
    $sql = "select * from category_master where category_head_id=$cat_id order by category_name";
    $res = mysql_query($sql);
    $tot_rec = mysql_num_rows($res);

    $sql_tit = "select * from category_master where category_id=$cat_id order by category_name ";
    $res_tit = mysql_query($sql_tit);
    $cat_tit = mysql_fetch_array($res_tit);

    $first_part = round($tot_rec / 2);
    $count = 0;

    function cat_display($ssid, $cat) {
        $ss_sql = "select * from category_master where category_head_id=$ssid order by category_name";
        $sub_res = mysql_query($ss_sql);
        while ($cat_row = mysql_fetch_array($sub_res)) {
            $cat_row[category_id];
            $cat = $cat_row[category_id] . " or category_id=";
            if ($cat_row['category_id']) {
                $ssid = $cat_row['category_id'];
                $_SESSION[catt] = $_SESSION[catt] . "$cat";
                cat_display($ssid, $cat);
            }
        }
    }

    function ret($ssid) {
        $ss_sql = "select * from category_master where category_head_id=$ssid order by category_name";
        $sub_res = mysql_query($ss_sql);
        while ($cat_row = mysql_fetch_array($sub_res)) {

            $ssid = $cat_row[category_id];
            $_SESSION[catt] = " ";
            if ($ssid) {
                $cat = "category_id=$ssid or category_id= ";
                $_SESSION[catt] = $cat;
                cat_display($ssid, $cat);
                $cat = $_SESSION[catt];
            }
            $cat = rtrim($cat, " or category_id=");

            $count_item_sql = "select * from placing_item_bid where ($cat) and status='Active' and selling_method!='want_it_now' and bid_starting_date  and expire_date ";
            $count_item_res = mysql_query($count_item_sql);
            $count_item_total = mysql_num_rows($count_item_res);


            $count_sql = "select * from placing_item_bid where category_id=$cat_row[category_id] and selling_method!='want_it_now' and status='Active' and bid_starting_date  and expire_date";
            $count_sqlqry = mysql_query($count_sql);
            $count_num = mysql_num_rows($count_sqlqry);
            ?>



            <tr><td class="detail9txt"><a href="category.php?cate_id=<?php = $cat_row[category_id]; ?>&view=list" class="detail7txt"><font size="1"><b>
                            <?php = $cat_row[category_name]; ?></b></font></a>&nbsp;( <?php = $count_num ?> )</td></tr>	
                            <?php
                            $ssid = $cat_row['category_id'];
                            ret($ssid);
                        }
                    }

                    if ($tot_rec == 0) {
                        echo '<meta http-equiv="refresh" content="0;url=category.php?cate_id=' . $cat_id . '&view=list">';
                        exit();
                    }


                    $title = "$cat_tit[category_name]";
                    require 'include/top.php';
                    require 'templates/subcat.tpl';
                    require 'include/footer.php';
                } else {
                    $title = "$cat_tit[category_name]";
                    require 'include/top.php';
                    echo "<font color='red'><center><strong>Invalid Category ... Don't try to enter illegal way. </strong></center></font>";
                    require 'include/footer.php';
                }
                ?>

