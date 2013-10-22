<?php

session_start();
error_reporting(0);
require 'include/connect.php';
$user_id = $_SESSION['userid'];
$item_id = $_REQUEST['item_id'];
$mode = $_GET['mode'];
$err_flag = $_POST['err_flag'];

$sql_checkitemid = "select * from placing_item_bid where item_id=$item_id";
$result_checkitemid = mysql_query($sql_checkitemid);
$row_checkid = mysql_num_rows($result_checkitemid);
if ($row_checkid == 0) {
    echo '<meta http-equiv="refresh" content="0;url=noitem.php">';
    exit();
}




if ($mode == "watch") {
    if (empty($_SESSION['userid'])) {
        echo '<meta http-equiv="refresh" content="0;url=signin.php?url=detail.php&item_id=' . $item_id . '&mode=' . $mode . '">';
        exit();
    } else {
        $sql_watchchk = "select status as status from placing_item_bid where item_id=" . $item_id;
        $sqlqry_watchchk = mysql_query($sql_watchchk);
        $fetch_watchchk = mysql_fetch_array($sqlqry_watchchk);
        $watchitem_status = $fetch_watchchk['status'];
        if ($watchitem_status != 'Active') {
            $watch_flag = 1;
            $watch_flag_new = 3;
        } else {
            $watch_tot_sql = "select count(*) from watch_list where user_id=$user_id and item_id=$item_id";
            $watch_ins_sql = mysql_query($watch_tot_sql);
            $watch_res_sql = mysql_fetch_array($watch_ins_sql);
            $watch_tot = $watch_res_sql[0];
            if ($watch_tot == 0) {
                $sql = "insert into watch_list(item_id,user_id) values($item_id,$user_id)";
                $ins = mysql_query($sql);
                $watch_flag = 1;
                $watch_flag_new = 2;
            } else {
                $watch_flag = 1;
                $watch_flag_new = 1;
            }
        }
    }
}
if ($_POST) {
    require 'include/detail_action.php';
}
$sql = "select * from placing_item_bid where item_id=$item_id";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
$click = "update placing_item_bid set clicks=$row[clicks]+1 where item_id=$item_id";
$click_exe = mysql_query($click);
$cat = "select category_name from category_master where category_id=" . $row['category_id'];
$cat_res = mysql_query($cat);
$cat_row = mysql_fetch_array($cat_res);

function cat_display($cat_displayid, $cat_string) {
    $cat_sql1 = "select * from category_master where category_id=" . $cat_displayid;
    $cat_sql_res1 = mysql_query($cat_sql1);
    $cat_sql_row1 = mysql_fetch_array($cat_sql_res1);
    $cat_string.="<a href='category.php?cate_id=$cat_sql_row1[category_id]' class='header_text5'>$cat_sql_row1[category_name]</a>" . "|";
    if ($cat_sql_row1[category_head_id]) {
        cat_display($cat_sql_row1[category_head_id], $cat_string);
    } else {
        $cat_string = explode("|", $cat_string);
        $cat_count = count($cat_string);
        $cat_str = " ";
        for ($ci = $cat_count - 1; $ci >= 0; $ci--) {
            if ($cat_string[$ci]) {
                $cat_str = "$cat_str" . "$cat_string[$ci]" . "<span class='detail2txt'>&gt;</span>";
            }
        }
        echo "$cat_str";
    }
}

if ($row['category_id']) {
    $cat_sql = "select * from category_master where category_id=" . $row['category_id'];
    $cat_sql_res = mysql_query($cat_sql);
    $cat_sql_row = mysql_fetch_array($cat_sql_res);
}
$user_sql = "select * from user_registration where user_id=" . $row['user_id'];
$user_res = mysql_query($user_sql);
$user = mysql_fetch_array($user_res);
$country_sql = "select * from country_master where country_id=" . $user['country'];
$country_res = mysql_query($country_sql);
$country = mysql_fetch_array($country_res);
$bid_sql = "select * from placing_bid_item where item_id=" . $row['item_id'] . " and deleted='No'";
$bid_res = mysql_query($bid_sql);
$bid = mysql_fetch_array($bid_res);
if (empty($bid[0])) {

    $bid_sql = "select * from placing_item_bid where item_id=" . $row['item_id'];
    $bid_res = mysql_query($bid_sql);
    $bid = mysql_fetch_array($bid_res);
//now $current_price=$bid['min_bid_amount']+$row['bid_increment'];
    $current_price = $bid['min_bid_amount'];
} else {
    $max_sql = "select * from placing_bid_item where item_id=" . $row['item_id'] . " and deleted='No' order by bid_id desc";
    $max_res = mysql_query($max_sql);
    $max = mysql_fetch_array($max_res);
    $noofbids = mysql_num_rows($max_res);
    $cur_sql = "select max(bidding_amount) from placing_bid_item where item_id=" . $row['item_id'] . " and deleted='No'";
    $cur_res = mysql_query($cur_sql);
    $cur_row = mysql_fetch_array($cur_res);
    $current_price = $cur_row['0'];
    if ($row['status'] == 'Closed') {
        $current_price = $row['cur_price'];
    }



    /* Bidincrement updatation */
    $sql_bid_status = "select set_value from admin_settings where set_id=42";
    $sqlqry_bid_status = mysql_query($sql_bid_status);
    $sqlfetch_staus = mysql_fetch_array($sqlqry_bid_status);
    if ($sqlfetch_staus[0] == 'no') {
        $qry_bid = "select * from bid_increment";
        $res_bid = mysql_query($qry_bid);
        while ($fetch_bid = mysql_fetch_array($res_bid)) {
            if ($current_price >= $fetch_bid['bid_from'] && $current_price <= $fetch_bid['bid_to']) {
                $bid_inc = $fetch_bid['bid_inc'];
                $update_bidvalue = "update placing_item_bid set bid_increment='$bid_inc' where item_id=" . $item_id;
                $updateqry_bidvalue = mysql_query($update_bidvalue);
                break;
            }
        }
    }

    /* End of bidincrement updatation */


    $max_sql1 = "select * from placing_bid_item where item_id=" . $row['item_id'] . " and bidding_amount=" . $cur_row[0] . " and deleted='No'";
    $max_res1 = mysql_query($max_sql1);
    $max1 = mysql_fetch_array($max_res1);
    $higherid = $max1[user_id];

    $highest_bidder_sql = "select * from user_registration where user_id=" . $higherid;
    $highest_bidder_res = mysql_query($highest_bidder_sql);
    $highest_bidder_res = mysql_fetch_array($highest_bidder_res);
    $highest_bidder = $highest_bidder_res[user_name];

    $high_feed_sql = "select count(*) as feedbacktotal from feedback where feedback_type='Positive' and  feedback_to=" . $max['user_id'];
    $high_feed_recordset = mysql_query($high_feed_sql);
    $high_feed_tot = mysql_fetch_array($high_feed_recordset);

    $feedbackicon_sql = "select * from membership_level where feedback_score_from <= " . " $high_feed_tot[feedbacktotal] " . " and  feedback_score_to >= " . " $high_feed_tot[feedbacktotal] ";
    $feedbackicon_res = mysql_query($feedbackicon_sql);
    $feedbackicon_row = mysql_fetch_array($feedbackicon_res);
    $feedback_highimg = $feedbackicon_row[icon];


    /*  if($high_feed_tot[feedbacktotal] >= 1)
      $feedback_highimg="green_star.gif";
      else if($high_feed_tot[feedbacktotal] >= 2)
      $feedback_highimg="yellowstar.gif";
      else
      $feedback_highimg="red_star.gif"; */
}
$tot_sql = "select count(*) from placing_bid_item where item_id=" . $row['item_id'] . " and deleted='No'";
$tot_res = mysql_query($tot_sql);
$tot = mysql_fetch_array($tot_res);

$feed_sql = "select count(*) as feedbacktotal from feedback where  feedback_to=" . $row['user_id'] . " and feedback_type='Positive'";
$feed_recordset = mysql_query($feed_sql);
$feed_tot = mysql_fetch_array($feed_recordset);

$feedbackicon_sql = "select * from membership_level where feedback_score_from <= " . " $feed_tot[feedbacktotal] " . " and  feedback_score_to >= " . " $feed_tot[feedbacktotal] ";
$feedbackicon_res = mysql_query($feedbackicon_sql);
$feedbackicon_row = mysql_fetch_array($feedbackicon_res);
$feedback_img = $feedbackicon_row[icon];

$positive_sql = "select count(*) as positive_total from feedback where feedback_type='Positive' and feedback_to=" . $row['user_id'];
$positive_recordset = mysql_query($positive_sql);
$positive_tot = mysql_fetch_array($positive_recordset);

if ($positive_tot[positive_total] != 0 and $feed_tot[feedbacktotal] != 0) {
    $positive_percentage = $positive_tot[positive_total] / $feed_tot[feedbacktotal] * 100;
} else {
    $positive_percentage = "0";
}

if ($row['themes_id']) {
    $theme_sql = "select * from themes_master where themes_id=$row[themes_id]";
    $theme_res = mysql_query($theme_sql);
    $theme_row = mysql_fetch_array($theme_res);
    $img = $theme_row['themes'];
    list($width, $height, $type, $attr) = getimagesize("images/$img");
    $theme_top = $theme_row[theme_top_img];
    $theme_bottom = $theme_row[theme_bottom_img];
    $theme_content = $theme_row[theme_content_img];
} else {
    $theme_top = "";
    $theme_bottom = "";
    $theme_content = "";
}
?>
<?php

$title = " detail ";
$click = "detail";
require 'include/detail_top.php';
require 'templates/detail.tpl';
require 'include/footer.php';
?>