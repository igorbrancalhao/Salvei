<?php
/* * *************************************************************************
 * File Name				:add1.php
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
require 'include/connect.php';
$sub_txt = $_POST['action'];
//$txt_add=$_POST['add'];
$sub_id = $_POST['subcategory'];
$subsub_id = $_POST['subsubcategory'];
$cat_id = $_REQUEST['id'];
$mode = $_REQUEST['mode'];
$categoryname = $_POST['subcat'];

function ret($ssid, $subsub_id) {
    $ss_sql = "select * from category_master where category_head_id=$ssid";
    $sub_res = mysql_query($ss_sql);
    while ($cat_row = mysql_fetch_array($sub_res)) {

        if ($subsub_id == $cat_row['category_id']) {
            ?>
            <option value="<?php = $cat_row['category_id']; ?>" selected ><?php = $cat_row['category_name']; ?></option>
            <?php
        } else {
            ?>
            <option value="<?php = $cat_row['category_id']; ?>">&nbsp;&nbsp;&nbsp;<?php = $cat_row['category_name']; ?></option>
            <?php
        }
        $ssid = $cat_row['category_id'];
        ret($ssid, $subsub_id);
    }
}

$sql = "select * from category_master where category_head_id=0";
$res = mysql_query($sql);

$sub_sql = "select * from category_master where category_head_id=$sub_id";
$sub_res = mysql_query($sub_sql);

if ($mode == "edit") {
    $edit_sql = "select * from category_master where category_id=$cat_id";
    $edit_res = mysql_query($edit_sql);
    $sub_row = mysql_fetch_array($edit_res);
}


if (isset($_POST['btnSubmit'])) {
    if ($mode == "edit") {
        $sql1 = "update category_master set category_name='$categoryname' where category_id=$cat_id";
        $res1 = mysql_query($sql1);
    }

    if ($subsub_id == 0) {
        $sql1 = "insert into category_master(category_name,category_head_id) values('$categoryname','$sub_id')";
        $res1 = mysql_query($sql1);
    }

    if ($subsub_id != 0) {
        $sql1 = "insert into category_master(category_name,category_head_id) values('$categoryname','$subsub_id')";
        $res1 = mysql_query($sql1);
    }
    echo '<meta http-equiv="refresh" content="0;url=subcategory.php">';
}
?>

<link href="include/style.css" rel="stylesheet" type="text/css">
<?php
require 'include/top.php';
?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="60%" height="242" border="0" align="center" cellpadding="5" cellspacing="0" class="tablebox">
    <form name="sub" method="post" action="add.php">
        <td height="40" colspan="2" bgcolor="#CCCCCC" class="style1" align="center">
            <?php
            if ($mode == 'edit') {
                echo ("<b>Edit Category</b>");
            } else {
                echo ("<b>Add Category</b>");
            }
            ?></td>

        <tr class="style1" bgcolor="eeeee1">
            <td align="center">
                <?php
                if ($mode == 'edit') {
                    echo ("<b>Category</b>");
                } else {
                    echo ("<b>Category</b>");
                }
                ?></td>

            <td align="center">

                <select name=subcategory onchange="this.form.submit()">
                    <option value="0">Select</option>
                    <?php
                    while ($cat_row = mysql_fetch_array($res)) {

                        if ($sub_id == $cat_row['category_id']) {
                            ?>
                            <option value="<?php = $cat_row['category_id']; ?>" selected><?php = $cat_row['category_name']; ?></option>
                            <?php
                        } else {
                            ?>
                            <option value="<?php = $cat_row['category_id']; ?>"  ><?php = $cat_row['category_name']; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select></td></tr>

        <tr class="style1" bgcolor="eeeee1">
            <td align="center">
                <?php
                if ($mode == 'edit') {
                    echo ("<b>SubCategory</b>");
                } else {
                    echo ("<b>SubCategory</b>");
                }
                ?></td>

            <td align="center">
                <select name=subsubcategory onchange="this.form.submit()">
                    <option value="0">Select</option>
                    <?php
                    while ($cat_row = mysql_fetch_array($sub_res)) {

                        if ($subsub_id == $cat_row['category_id']) {
                            ?>
                            <option value="<?php = $cat_row['category_id']; ?>" >
                                <?php = $cat_row['category_name']; ?>
                            </option>
                            <?php
                        } else {
                            ?>
                            <option value="<?php = $cat_row['category_id']; ?>" selected="selected"  >
                                <?php = $cat_row['category_name']; ?>
                            </option>
                            <?php
                        }
                        $ssid = $cat_row['category_id'];
                        ret($ssid, $subsub_id);
                    }
                    ?>
                </select></td>
        </tr>

        <tr class="style1" bgcolor="eeeee1">
            <td align="center">
                <?php
                if ($mode == 'edit') {
                    echo ("<b>SubCategory Name</b>");
                } else {
                    echo ("<b>SubCategory Name</b>");
                }
                ?></td>

            <td align="center">
                <input type="text" name="subcat" value="<?php = $sub_row['category_name']; ?>"></td>
        <tr class="style1" bgcolor="eeeee1">

        <input type="hidden" name="action" value="1">
        <input type="hidden" name="mode" value="<?php = $mode ?>">
        <input type="hidden" name="id" value="<?php = $cat_id ?>">
        <td align="center" colspan="2">
            <input type="submit" class="button" name="btnSubmit"></td>
        </tr>
    </form>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php
require 'include/footer.php'
?>

