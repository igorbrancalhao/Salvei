<?php
/* * *************************************************************************
 * File Name				:sell_item_cate.php
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
/*
  file name:sell_item_cat.php;
  date	  :21.10.05
  Created by:priya
  Rights reserved by AJ Square inc
 */
session_start();
error_reporting(0);
require 'include/connect.php';

if (!isset($_SESSION['username'])) {
    $link = "signin.php";
    $url = "sell.php";
    echo '<meta http-equiv="refresh" content="0;url=' . $link . '?url=' . $url . '">';
    echo "You have been Re-Directed, if not please <a href=$link?$url>Click here</a>";
    exit();
}
if ($_POST['sell_format'])
    $_SESSION['sell_format'] = $_REQUEST['sell_format'];
if ($_GET['mode']) {
    $mode = $_GET['mode'];
} else {
    $mode = $_POST['mode'];
}

$sql = "select * from category_master where category_head_id=0 order by category_name";
$res = mysql_query($sql);
$cat_flag = $_POST['cat_flag'];
if ($cat_flag == 1) {
    $cat_id = $_POST['radio_cat'];
    $sell_format = $_POST['sell_format'];
    if (empty($cat_id)) {
        $err_cat = "Please Select Category";
        $err_flag = 1;
    } else {
        if ($_SESSION['sell_format'] == 4 || $_REQUEST['title'] == 'Wanted Ads') {
            $_SESSION[categoryid] = $cat_id;
            echo '<meta http-equiv="refresh" content="0;url=post_ad.php?cat_id=' . $cat_id . '&title=' . $_REQUEST['title'] . '">';
            echo "You have been Re-Directed, if not Please <a href=post_ad.phpcat_id=<?php echo  $cat_id ?>>Click here</a>";
            exit();
        }
        if ($mode == "") {
            echo '<meta http-equiv="refresh" content="0;url=sell_item_detail.php?cat_id=' . $cat_id . '&sell_format=' . $sell_format . '">';
            echo "<font size=+1>Loading </font>";
            $_SESSION['categoryid'] = $cat_id;
            exit();
        } else if ($mode == "change") {
            echo '<meta http-equiv="refresh" content="0;url=preview.php">';
            echo "<font size=+1>Loading </font>";
            $_SESSION['categoryid'] = $cat_id;
            exit();
        }
        $_SESSION['categoryid'] = $cat_id;
        exit();
    }
}
?>
<?php
if (!empty($warning)) {
    ?>
    <tr align="center"><td>
            <br>
            <br>
            <br>
            <table cellpadding="5" cellspacing="2" width="50%" class="table_border1">
                <th class="mylist">
                    Oops! 
                </th>
                <tr>
                    <td>
                        <font size=2 color="red"><?php echo $warning; ?></font>
                    </td></tr> </table>
            <br>
            <br>
            <br>
        </td></tr>
    <?php require'include/footer.php'; ?> 
    <?php
    exit();
}

$click = "sell";
if (empty($_REQUEST['title']))
    $title = "Sell Your Item";
else
    $title = $_REQUEST['title'];
require 'include/top.php';
require'templates/sell_item_cate.tpl';
require 'include/footer.php'
?>

