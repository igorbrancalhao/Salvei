<?php
/* * *************************************************************************
 * File Name				:addcategory.php
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
$frm = $_POST["cate"];
$category = $_POST["cat"];
$mode = $_REQUEST[mode];
$categoryid = $_REQUEST['id'];
require 'include/top.php';
if ($mode == 'edit') {
    $cat_sql = "select * from category_master where category_id=$categoryid";
    $cat_res = mysql_query($cat_sql);
    $cat_row = mysql_fetch_array($cat_res);
}
if ($frm == 1) {
    if ($mode == "edit") {
        $category = str_replace('"', '\"', "$category");
        $category = str_replace("'", "\'", "$category");

        $sq = mysql_query("select * from category_master where category_id=$categoryid");
        $sq1 = mysql_fetch_array($sq);
        $cat = $sq1['category_name'];

        $s = mysql_query("select * from category_master where category_name='$category' and category_id!=$categoryid and category_head_id=0");
        $cat_row = mysql_num_rows($s);
        if ($cat_row == 1) {
            $message = "Category Name Already Exist";
        } else {

            $sql1 = "update category_master set category_name='$category' where category_id=$categoryid";
            $res1 = mysql_query($sql1);
            $message = "Category Edited Successfully";
        }
    } else {
        $category = str_replace('"', '\"', "$category");
        $category = str_replace("'", "\'", "$category");

        $s = mysql_query("select * from category_master where category_name='$category'");
        $cat_row = mysql_num_rows($s);
        if ($cat_row == 1) {
            $message = "Category Name Already Exist";
        } else {
            $sql = "insert into category_master(category_name) values('$category')";
            $res = mysql_query($sql);
            $message = "Category Added Successfully";
        }
    }

    echo '<meta http-equiv="refresh" content="4;url=category.php">';
}
?>
<table border="0" align="center" cellpadding="5" cellspacing="2" width="100%" background="images/bg08.jpg">
    <form action="addcategory.php" method="post" name="f1">
        <tr><td>
                <table id="Table_01" width="762"  border="0" cellpadding="0" cellspacing="0">
                    <tr><td width=93>
                            <table id="Table_01" width="93"  border="0" cellpadding="0" cellspacing="0">
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
                            </table></td><td width="98%"> 
                            <table align="center" width="650" height="200" class="border2">
                                <tr>
                                    <td bgcolor="#CCCCCC" align="center" class="txt_users">
                                        <?php
                                        if ($mode == 'edit') {
                                            echo ("Edit Category");
                                        } else {
                                            echo ("Add Category");
                                        }
                                        ?>
                                    </td></tr>
                                <tr bgcolor="#FFFFFF">
                                    <td colspan="2" align="center"><font color="#FF0000">
                                        <?php
                                        if ($message != '')
                                            echo $message;
                                        ?></font>
                                    </td></tr>
                                <tr bgcolor="eeeee1">
                                    <td align="center"><span class="txt_sitedetails">
                                            Category Name</span>&nbsp;&nbsp;
                                        <input type="text" name="cat" value="<?php = $cat_row[category_name]; ?>" style="width:300;" >
                                        <input type="hidden" name="cate" value=1>
                                        <input type="hidden" name="mode" value=<?php = $mode; ?> >
                                        <input type="hidden" name="id" value=<?php = $categoryid; ?> >
                                        <br><br><input  type="submit" name="add" value="Submit" class="button" onclick="return val();">
                                    </td></tr>

                            </table></td></tr>
                </table></td></tr></form></table></td></tr>

<?php
require 'include/footer.php';
?>
<script language="javascript">
    function val()
    {
        if (f1.cat.value == "")
        {
            alert("Please Enter the Category Name");
            f1.cat.focus();
            return false;
        }
        return true;
    }
</script>