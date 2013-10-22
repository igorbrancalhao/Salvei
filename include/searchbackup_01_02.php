<?php

/* * *************************************************************************
 * File Name				:search.php
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

function cat_display($ssid, $cat) {
    $cat = "category_id=$ssid or ";
    $_SESSION[catt] = $_SESSION[catt] . "$cat";
    $ss_sql = "select * from category_master where category_head_id=$ssid";
    $sub_res = mysql_query($ss_sql);
    while ($cat_row = mysql_fetch_array($sub_res)) {
        $cat = "category_id=$cat_row[category_id] or ";
        if ($cat_row['category_id']) {
            $ssid = $cat_row['category_id'];
            $_SESSION[catt] = $_SESSION[catt] . "$cat";
            cat_display($ssid, $cat);
        }
    }
}

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
    //echo $cat;
}

$userid = $_SESSION['userid'];
$mode = $_REQUEST['mode'];





if ($_REQUEST) {
    $prd = $_REQUEST['product'];
    $key_word = $_REQUEST['key_word'];
    $cboprice = $_REQUEST['cboprice'];
// advanced
    $category_id = $_REQUEST['category_id'];
    $k_word = $_REQUEST['k_word'];
    $min_cur = $_REQUEST['m_cur'];
    $max_cur = $_REQUEST['max_cur'];
    $item_status = $_REQUEST['item_status'];
    $seller = $_REQUEST['seller'];
    $seller_name = $_REQUEST['seller_name'];
    $ava_loc = $_REQUEST['ava_loc'];
    if ($ava_loc == "loc") {
        $location = $_REQUEST['loc_country'];
    } else if ($ava_loc == "ava") {
        $location = $_REQUEST['ava_country'];
    } else {
        $location = "all";
    }
}
$show = $_REQUEST['show_all'];
$cat_id = $_REQUEST['cbocat'];
if (empty($cat_id))
    $cat_id = $_REQUEST['cid'];

//// -----  paging .get current record and also get the relative arguments   --------------------- 


if ($_REQUEST['currec']) {
    $mode = $_REQUEST['mode'];
    if ($mode == "searchlist")
        $_REQUEST[chk] = 'yes';
    $key_word = $_REQUEST['key_word'];
    $cat_id = $_REQUEST['cid'];
    $prd = $_REQUEST['product'];
    $cboprice = $_REQUEST['cboprice'];
    $save_flag = $_REQUEST['save_flag'];
    $save_name = $_REQUEST['s_name'];
    $currec = $_REQUEST['currec'];
    $item_status = $_GET['item_status'];
    $show = $_REQUEST['show_all'];

//echo $location=$_REQUEST['cholocation'];

    $ava_loc = $_REQUEST['ava_loc'];
    $category_id = $_REQUEST['category_id'];
    $k_word = $_REQUEST['k_word'];
    $min_cur = $_REQUEST['min_cur'];
    $max_cur = $_REQUEST['max_cur'];
    $seller = $_REQUEST['seller'];
    $seller_name = $_REQUEST['seller_name'];
}



//// -----  paging .get current record and also get the relative arguments   --------------------- 
/////////// -----------------------  Searchlist     ----------------------------------------------------------

if ($mode == "searchlist") {
    if ($_REQUEST['chk'] == "yes") {
        $sql = "select * from placing_item_bid where  bid_starting_date <= now() and status='Active' and selling_method!='want_it_now' and selling_method!='ads' and ";
        if ($_REQUEST['chkitemspriced']) {
            $chkitemspriced = $_REQUEST['chkitemspriced'];
            $max_cur = $_REQUEST['txtpricedfrom'];
            $min_cur = $_REQUEST['txtpricedto'];
            $sql.=" (min_bid_amount >= $max_cur and min_bid_amount <= $min_cur) and ";
        }
        if ($_REQUEST['chkitemscondition']) {
            $chkitemscondition = $_REQUEST['chkitemscondition'];
            $itmcnd = $_REQUEST['cboitemcondition'];
            $sql.=" item_specify=\"$itmcnd\"  and ";
        }
        if ($_REQUEST['chkbuyitnow']) {
            $chkbuyitnow = $_REQUEST['chkbuyitnow'];
            $show = "buy";
            $sql.=" selling_method='fix'  and ";
        }
        if ($_REQUEST['chkitemslistedsingle']) {
            $chkitemslistedsingle = $_REQUEST['chkitemslistedsingle'];
            $show = "bid";
            $sql.=" selling_method='Auction'  and ";
        }
        if ($_REQUEST['chkitemslisteddouble']) {
            $chkitemslisteddouble = $_REQUEST['chkitemslisteddouble'];
            $show = "bid";
            $sql.=" selling_method='dutch_auction'  and ";
        }
        if ($_REQUEST['chklisted']) {
            $show = "bid";
            $sql.=" payment_gateway=''  and ";
        }
        if ($_REQUEST['chklocation']) {
            $chklocation = $_REQUEST['chklocation'];
            $ship = $_REQUEST['cbolocation'];
            $show = "bid";
            if ($ship == 1) {
                $sql.=" shipping_route like \"%$ship%\" and ";
            } else {
                $sql.=" shipping_route like \"%$ship%\" and ";
            }
        }
    }
    $sql = rtrim($sql, " and ") . " and expire_date >=now()";
    /* echo $sql;
      echo "<br>"; */
}





/////////// -----------------------  end of searchlist    ----------------------------------------------------------
//---------------------------------  Linkmode Search  ---------------------------------------//
if ($mode == "linkmode") {
    $_SESSION['catt'] = "";
    $sql = "select * from placing_item_bid where  bid_starting_date <= now() and status='Active' and selling_method!='ads' and selling_method!='want_it_now' and (";
    if ($category_id) {
        $cat_sql1 = "select * from category_master where category_id=$category_id";
        $cat_sql1_res = mysql_query($cat_sql1);
        $tot_rec = mysql_num_rows($cat_sql1_res);
        $cat = "category_id=$cat_id or ";
        if ($tot_rec > 0) {
            $cat_row = mysql_fetch_array($cat_sql1_res);
            $ssid = $cat_row['category_id'];
            if ($ssid) {
                easy_cat_display($ssid, $cat);
            }
            $cat = $_SESSION['catt'];
            $cat = trim($cat, " or ");
        }
        $sql.=$cat;
    }

    $sql = rtrim($sql, "and ");
    $sql.=") and expire_date >= now()";

    $save_sql = $sql;
}
//----------------------------------- End of Linkmode Search -------------------------------//
//--------------------------------- keyword search -----------------------------------

if ($mode == "keysearch") {
    if (!empty($key_word)) {
        $key_word = trim($key_word);
        $sql = "select * from user_registration where user_name='$key_word' ";
        $table = mysql_query($sql);
        if ($row = mysql_fetch_array($table)) {
            $user_id = $row['user_id'];
        }
        $sql = "select * from placing_item_bid  where status=\"Active\" and selling_method!=\"want_it_now\" and  (item_title like \"%$key_word%\" or detailed_descrip like \"%$key_word%\" or  item_id=\"$key_word\" or user_id=\"$user_id\") and bid_starting_date <= now() and ";
    } else {
        $sql = "select * from placing_item_bid where status=\"Active\" and selling_method!=\"want_it_now\" and bid_starting_date <= now() and expire_date>=now()";
    }
    if (!empty($show)) {
        if ($show == "all")
            $sql.=" ( selling_method= \"auction\" or selling_method= \"dutch_auction\" or selling_method= \"fix\" ) ";
        else if ($show == "bid")
            $sql.=" ( selling_method= \"auction\" or selling_method= \"dutch_auction\") ";
        else if ($show == "buy")
            $sql.=" selling_method=\"fix\" ";
    }
    $sql = rtrim($sql, " and ");
    $save_sql = $sql;

    $save_sql = $sql;
}

//--------------------------------- advanced search -----------------------------------

if ($mode == "advanced") {
    $_SESSION['catt'] = "";
    $category_id = $_REQUEST['category_id'];
    if ($category_id == "all")
        $sql = "select * from placing_item_bid a, user_registration b where a.selling_method!=\"want_it_now\" and bid_starting_date <= now() and a.expire_date >=now() and ";
    else {
        $cat_sql1 = "select * from category_master where category_head_id=$category_id";
        $cat_sql1_res = mysql_query($cat_sql1);
        $tot_rec = mysql_num_rows($cat_sql1_res);
        if ($tot_rec > 0) {
            while ($cat_row = mysql_fetch_array($cat_sql1_res)) {
                $ssid = $cat_row['category_id'];
                if ($ssid) {
                    cat_display($ssid, $cat);
                }
                $cat = $_SESSION['catt'];

                //if(strlen($cat)== 1 and $ssid )
                $cat.=" category_id=" . $category_id;
                $cat = rtrim($cat, " or category_id=");
            }

            $cat.=" or a.category_id=$ssid or ";

            $cat = rtrim($cat, " or a.category_id=");
        } else {
            $cat = "a.category_id=$category_id";
        }


        $sql = "select * from placing_item_bid a,user_registration b where a.selling_method!=\"want_it_now\" and ($cat) and bid_starting_date <= now() and a.expire_date>=now() and ";
    }
    if ($item_status == 1)
        $sql.=" a.status=\"Active\" and";
    else if ($item_status == 2)
        $sql.=" a.status=\"Closed\" and";
    if (!empty($k_word)) {
        $k_word = trim($k_word);
        $sql.=" a.item_title like \"%$k_word%\" and";
    }
    if (!empty($max_cur) and !empty($min_cur)) {
        $sql.=" (a.cur_price between $min_cur  and  $max_cur) and";
        $s = 1;
// $sql.=" (a.reserve_price >= $max_cur or a.quick_buy_price <= $max_cur ) and";
    }
    if ($s != 1) {
        if (!empty($min_cur)) {
// $sql.=" (a.reserve_price >= $min_cur or a.quick_buy_price >= $min_cur ) and";
            $sql.=" (a.cur_price >= $min_cur ) and";
        }
        if (!empty($max_cur)) {
            $sql.=" (a.cur_price <= $max_cur ) and";
// $sql.=" (a.reserve_price >= $max_cur or a.quick_buy_price <= $max_cur ) and";
        }
    }
    if (!empty($seller) && !empty($seller_name)) {
        if ($seller == "include")
            $sql.=" b.user_name=\"$seller_name\" and a.user_id=b.user_id";
        else
            $sql.=" trim(b.user_name) !=trim('$seller_name') and a.user_id=b.user_id";
    }
    if (!empty($ava_loc)) {
        if ($ava_loc == "loc")
            $sql.=" b.country=\"$location\" and";
        else if ($ava_loc == "ava")
            $sql.=" a.shipping_route=\"$location\" and";
    }

    if (!empty($show)) {
        if ($show == "bid")
            $sql.=" a.selling_method= \"auction\" or a.selling_method= \"dutch_auction\" and";
        else
            $sql.=" a.selling_method=\"fix\" or a.selling_method= \"ads\" and";
    }
    if (!empty($seller) && !empty($seller_name)) {
        $sql.=" group by a.item_id";
    } else {
        $sql = rtrim($sql, "and ") . " group by a.item_id";
    }
    //$sql=rtrim($sql,"and");
    $save_sql = $sql;
}
//---------------------------------end of advanced search ----------------------------------- 
//echo $sql;
// easysearch
if ($mode == "easy") {
    $_SESSION['catt'] = " ";
    if (!empty($cat_id)) {

        if ($cat_id == "all")
            $sql = "select * from placing_item_bid  ";
        elseif ($_REQUEST[show_all] == "wanted")
            $sql = "select * from placing_item_bid  where  status=\"Active\" and  selling_method = \"wanted\" and bid_starting_date <= now() and selling_method!=\"want_it_now\" ";

        else {

            // echo $sql.="category_id=$cat_id or ";
            $cat_sql1 = "select * from category_master where category_id=$cat_id";
            $cat_sql1_res = mysql_query($cat_sql1);
            $tot_rec = mysql_num_rows($cat_sql1_res);

            $cat = "category_id=$cat_id or ";
            if ($tot_rec > 0) {
                $cat_row = mysql_fetch_array($cat_sql1_res);
                $ssid = $cat_row['category_id'];
                // $cat="$category_id".$ssid;
                if ($ssid) {
                    // $cat="category_id=$cat_id or ";
                    easy_cat_display($ssid, $cat);
                }
                $cat = $_SESSION['catt'];

                if (strlen($cat) == 1 and $ssid)
                    $cat.="category_id=" . $ssid;
                $cat = rtrim($cat, " or ");
            }
            else {
                $cat = "category_id=$cat_id";
            }
            if ($cat)
                $sql = "select * from placing_item_bid  where  selling_method!=\"want_it_now\" and status=\"Active\" and ($cat) and bid_starting_date <= now() and expire_date >= now()";
        }
        if (!empty($prd)) {
            $prd = str_replace('\"', '', $prd);
            $prd = trim($prd);

            if ($cat_id == "all")
                $sql.="where status=\"Active\" and selling_method!=\"want_it_now\" and bid_starting_date <= now() and";
            $sql.=" (item_title like \"%$prd%\" or detailed_descrip like \"%$prd%\") and expire_date >= now()";
        }
        if ($cboprice) {
            $price = explode(" ", $cboprice);
            $sql.=" ( reserve_price >= $price[1] and reserve_price <=$price[4] or quick_buy_price >= $price[1] and quick_buy_price <=$price[4] ) ";
        }

        if (!empty($show)) {
            if ($show == "all")
                $sql.=" ( selling_method= \"auction\" or selling_method= \"dutch_auction\" or selling_method= \"fix\" ) ";
            else if ($show == "bid")
                $sql.=" ( selling_method= \"auction\" or selling_method= \"dutch_auction\") ";
            else if ($show == "buy")
                $sql.=" selling_method=\"fix\" ";
        }

        if (strlen($sql) != 32)
            $sql = rtrim($sql, "and  ") . " group by item_id";
        else
            $sql = "select * from placing_item_bid where status='Active' and selling_method!='want_it_now' and bid_starting_date <= now() and expire_date >= now()";
    }
}




if ($mode == 'sellers_item') {
    $sellers_userid = $_REQUEST['seller_id'];
    $sql = "select * from placing_item_bid where status='Active' and selling_method!='want_it_now' and bid_starting_date <= now() and expire_date >= now() and user_id=" . $sellers_userid;
}


$rec_sql = "select  * from admin_settings where set_id=54";
$rec_res = mysql_query($rec_sql);
$rec_row = mysql_fetch_array($rec_res);
$limitsize = $rec_row['set_value'];
//$limitsize=2;

/* $view=$_REQUEST[view];
  if(empty($view))
  $view="list";
  if($view=='gallery')
  {
  if($mode=='advanced')
  $sql=str_replace("select * from placing_item_bid a","select * from placing_item_bid a,featured_items f",$sql);
  else
  $sql=str_replace("select * from placing_item_bid","select * from placing_item_bid a,featured_items f",$sql);
  echo $sql.=" and f.gallery_feature='Yes' and a.item_id=f.item_id";
  } */

//echo $sql;

$result = @mysql_query($sql);
$total_records = @mysql_num_rows($result);

if ($save_flag == 1) {
    if (!empty($_SESSION['userid'])) {
        $sql_save = "select * from save_searchresult where save_name='$save_name' and user_id=$_SESSION[userid]";
        $save_1 = mysql_query($sql_save);
        $tot_save = mysql_num_rows($save_1);
        if ($tot_save > 0) {
            $select_sql = "select * from error_message where err_id =67";
            $select_tab = mysql_query($select_sql);
            $select_row = mysql_fetch_array($select_tab);
            $dis_save = $select_row[err_msg];
            $save_flag = 0;
            $ver = 1;
        } else {
            $sqlu = "insert into save_searchresult(user_id,save_name,save_query)  values('$userid','$save_name','$save_sql')";
            $resu = mysql_query($sqlu);
            $save_flag = 0;
            $ver = 1;
        }
    }
}


//Added for ordering the result by latest posted first //
$sql.=" order by bid_starting_date desc";

if (strlen($currec) == 0) //check firstpage 
    $currec = 1;
$start = ($currec - 1) * $limitsize;
$end = $limitsize;
$sql.=" limit $start,$end";
$result = mysql_query($sql);
//$total_records=mysql_num_rows($result);
?>