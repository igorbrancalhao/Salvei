<?php
/* * *************************************************************************
 * File Name				:sell_item_cate.php
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
error_reporting(0);
require 'include/connect.php';
require 'include/top.php';

if (!isset($_SESSION['userid'])) {
    $link = "signin.php";
    $url = "sell.php";
    echo '<meta http-equiv="refresh" content="0;url=' . $link . '?url=' . $url . '">';
//echo "You have been Re-Directed, if not please <a href=$link?$url>Click here</a>";
    exit();
}

$sql_user_status = "select status from user_registration where user_id=" . $_SESSION['userid'];
$sqlqry_user_status = mysql_query($sql_user_status);
$sqlfetch_user_status = mysql_fetch_array($sqlqry_user_status);
$userstatus = $sqlfetch_user_status[0];
if ($userstatus == 'suspended') {
    echo '<meta http-equiv="refresh" content="0;url=suspendmode.php">';
    exit();
}

if ($_POST['sell_format']) {
    $sell_format = $_REQUEST['sell_format'];
    $_SESSION['sell_format'] = $_REQUEST['sell_format'];
}

$mode = $_REQUEST['mode'];


$sql = "select * from category_master where category_head_id=0 order by category_name";
$res = mysql_query($sql);
$cat_flag = $_POST['cat_flag'];
if ($cat_flag == 1) {

    $sell_format = $_POST['sell_format'];
    $cat_subid1 = $_REQUEST['sub_cat1'];
    $cat_subid2 = $_REQUEST['sub_cat2'];
    $cat_subid3 = $_REQUEST['sub_cat3'];
    $cat_subid4 = $_REQUEST['sub_cat4'];
    $cat_subid5 = $_REQUEST['sub_cat5'];
    $cat_subid6 = $_REQUEST['sub_cat6'];
    $cat_subid7 = $_REQUEST['sub_cat7'];
    $cat_subid8 = $_REQUEST['sub_cat8'];


    if (empty($cat_subid1)) {
        $err_cat = "Please Select Category";
        $err_flag = 1;
    } else {
        if ($cat_subid8 == " ")
            $_SESSION['categoryid'] = $cat_subid7;
        else
            $_SESSION['categoryid'] = $cat_subid8;
        if ($cat_subid7 == " ")
            $_SESSION['categoryid'] = $cat_subid6;
        if (empty($cat_subid6))
            $_SESSION['categoryid'] = $cat_subid5;
        if ($cat_subid5 == " ")
            $_SESSION['categoryid'] = $cat_subid4;
        if ($cat_subid4 == " ")
            $_SESSION['categoryid'] = $cat_subid3;
        if ($cat_subid3 == " ")
            $_SESSION['categoryid'] = $cat_subid2;
        if ($cat_subid2 == " ")
            $_SESSION['categoryid'] = $cat_subid1;



        if ($_SESSION['sell_format'] == 4) {
            echo '<meta http-equiv="refresh" content="0;url=post_ad.php?cat_id=' . $cat_id . '&title=' . $_REQUEST[title] . '">';
            exit();
        }
        if (($mode == "") && ($_SESSION['sell_format'] != 4)) {
            echo '<meta http-equiv="refresh" content="0;url=sell_item_detail.php?cat_id=' . $cat_id . '&sell_format=' . $sell_format . '">';
            exit();
        }
    }
}
require'templates/sell_item_cate.tpl';
?>

<input type="hidden" name="cat_flag" value="1">
<input type="hidden" name="con_save" value="1">
<input type="hidden" name="mode" value="<?php echo $mode ?>">
<input type="hidden" name="sell_format" value="<?php echo $sell_format; ?>">
<input type="hidden" name="sub_cat1" id="sub_cat1" value="">
<input type="hidden" name="sub_cat2" id="sub_cat2" value="">
<input type="hidden" name="sub_cat3" id="sub_cat3" value="">
<input type="hidden" name="sub_cat4" id="sub_cat4" value="">
<input type="hidden" name="sub_cat5" id="sub_cat5" value="">
<input type="hidden" name="sub_cat6" id="sub_cat6" value="">
<input type="hidden" name="sub_cat7" id="sub_cat7" value="">
<input type="hidden" name="sub_cat8" id="sub_cat8" value="">

<tr><td align="center">
        <?php if ($mode == "") {
            ?>
            <input type="image" src="images/continue.gif" name="Image71" width="81" height="24" border="0" id="Image71" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image71', '', 'images/continueo.gif', 1)" onclick="return chk()"/>
            <?php
        } else if ($mode == "change") {
            ?>
            <input type="image" src="images/continue.gif" name="Image71" width="81" height="24" border="0" id="Image71" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image71', '', 'images/continueo.gif', 1)" onclick="return chk()"/>
            <?php
        }
        ?>
    </td></tr>
<tr><td><br /></td></tr>
</table>

</td></tr>
</table>

</td></tr>
</table>
</form>

<?php require 'include/footer.php'; ?>

