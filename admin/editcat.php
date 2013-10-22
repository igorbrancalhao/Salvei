<?php
/* * *************************************************************************
 * File Name				:aditcat.php
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
$action = $_POST['act'];
?>
<html>
    <head>
        <title>:::Auction:::Admin Area</title>
        <link rel="stylesheet" type="text/css" href="../style/style.css">
    </head>
    <body>
        <?php
        echo "as" . $action; // print_r($_POST);
        if ($action == 1) {

            /* $category=$_POST['txtCategory'];
              echo "ca".$cat_id=$_POST['chksub'];
              for($i=0;$i<count($);$i++)
              {
              echo $up_sql="delete from category_master where category_id=$cat_id[$i]";
              $up_res=mysql_query($up_sql);
              } */
        } else if ($action == 2) {
            $canUpdate = $_POST['canUpdate'];
            if ($canUpdate == 1) {
                $category = $_POST['txtCategory'];
                $cat_id = $_POST['catid'];
                $regionid = $_POST['cboRegion'];
                for ($i = 0; $i < count($category); $i++) {
                    $up_sql = "update category_master set category_name='$category[$i]' where category_id=$cat_id[$i]";
                    $up_res = mysql_query($up_sql);
                }
                ?>
                <table border=0 align="center" width="50%" cellspacing="2" cellpadding="5" class="box">
                    <tr><td><font color="red"><b>Categories Updated Sucessfully</b></font></td></tr>
                </table>
                <?php
                exit();
            }
        }
        if ($action == 2) {
            $catid = $_POST['chkSub'];
            foreach ($catid as $id) {
                $cat_sql = "select * from category_matser where category_id=$id";
                $cat_res = mysql_query($cat_sql);
                $cat_row = mysql_fetch_array($cat_res);
                $cat_id[] = $cat_row['category_id'];
                $catheadname[] = $cat_row['category_name'];
//			$regionid[]=$cat_row['region_id'];
            }
            ?>
            <table border="0" align="center" cellspacing="5" cellpadding="5" width="50%" class="box">
                <form name="frmCat" action="<?php $_SERVER['PHP_SELF'] ?>" method="post" onSubmit="return validate()">
                    <tr><td class="bigfont" colspan="2" align="center"><b>Edit Category</b></td></tr>

                    <tr><td><b>Category Name</b></td>
                        <td><b>Region</b></td>
                    </tr>
                    <?php
                    for ($i = 0; $i < count($catheadname); $i++) {
                        ?>
                        <tr><td>
                                <input type="hidden" name="catid[]" value="<?php = $cat_id[$i] ?>">
                                <input type="text" name="txtCategory[]" id="txtCategory" value="<?php = $catheadname[$i] ?>"></td>
                                <!-- <td>
                                <select name="cboRegion">
                            <?php
                            $reg_sql = "select * from region_master";
                            $reg_res = mysql_query($reg_sql);
                            while ($reg_row = mysql_fetch_array($reg_res)) {
                                if ($regionid[$i] == $reg_row['region_id'])
                                    echo "<option value=" . $reg_row['region_id'] . " selected>" . $reg_row['region_name'] . "</option>";
                                else
                                    echo "<option value=" . $reg_row['region_id'] . ">" . $reg_row['region_name'] . "</option>";
                            }
                            ?>
                                </select>
                                </td> -->
                        </tr>
                        <?php
                    }
                    ?>
                    <tr><td colspan="2" align="center">
                            <input type="hidden" name="canUpdate" value="0">
                            <input type="hidden" name="act" value="<?php = $action ?>">
                            <input type="submit" name="btn_Update" value=" Change "></td></tr>
                </form>
            </table>
            <?php
        }
        if ($action == 1) {
            ?>
            <table border="0" align="center" width="100%" cellspacing="5" cellpadding="5">
                <tr><td>Delete Categorys</td></tr>
            </table>
            <?php
        }
        ?>
    </body>
</html>
<script language="javascript">
    function validate() {
        len = document.frmCat.txtCategory.length;
        if (len > 1) {
            for (i = 0; i < len; i++) {
                if (document.frmCat.txtCategory[i].value == '') {
                    flag = 1;
                    break;
                }
                else {
                    flag = 0;
                }
            }
            if (flag == 1) {
                alert('Please Fill in All the Categories');
                document.frmCat.txtCategory[i].focus();
                return false;
            }
        }
        else {
            if (document.frmCat.txtCategory.value == '') {
                alert('Please Fill the Category')
                document.frmCat.txtCategory.focus();
                return false;
            }
        }
        document.frmCat.canUpdate.value = 1;
        return true;
    }
</script>