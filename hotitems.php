<?php

require 'include/connect.php';

$pag = $_GET['pag'];

$hotitems_sql = "select * from placing_item_bid p, featured_items f where p.status='Active' and p.picture1!='' and p.bid_starting_date<=now() and p.expire_date>=now() and p.selling_method!='ads' and p.selling_method!='want_it_now' and f.home_feature='Yes' and p.item_id=f.item_id limit $pag,6";

//$hotitems_sql="select * from placing_item_bid where status='Active' and picture1!='' and selling_method!='want_it_now' and selling_method!='ads' limit $pag,6";

$hotitems = "<html>param = [";
$hotitems_sqlqry = mysql_query($hotitems_sql);
$i = 0;
while ($hotitems_fetch = mysql_fetch_array($hotitems_sqlqry)) {
    if (!empty($hotitems_fetch['sub_title']))
        $item_subtitle = $hotitems_fetch['sub_title'];
    else
        $item_subtitle = substr($hotitems_fetch['item_title'], 0, 20);
    $item_subtitle = str_replace("'", " ", $item_subtitle);
    $item_title = substr($hotitems_fetch['item_title'], 0, 30);
    $item_title = str_replace("'", " ", $item_title);
    $hotitems.="['" . $item_subtitle . "','images/" . $hotitems_fetch['picture1'] . "','" . $item_title . "','" . $hotitems_fetch['currency'] . $hotitems_fetch['min_bid_amount'] . "','" . $hotitems_fetch['item_id'] . "'],";
}
$hotitems = trim($hotitems, ",");
echo $hotitems.="]</html>";
?>