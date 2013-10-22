<?php
/* * *************************************************************************
 * File Name				:change_cat_display.php
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
require 'include/connect.php';
require 'include/top.php';
if ($_GET[cat_id])
$cat_id = $_GET[cat_id];
else
$cat_id = $_POST[cat_id];
if ($_POST[txtcategory]) {
$cat_name = $_POST[txtcategory];
$priority = $_POST[txtpriority];
$up = "update category_master set category_name='$cat_name', priority='$priority' where category_id=$cat_id";
$up_sql = mysql_query($up);
}
$category_sql = "select * from category_master where category_id=$cat_id";
$category_result = mysql_query($category_sql);
$category_row = mysql_fetch_array($category_result);
$categoryname = $category_row['category_name'];
?>
<table align="center" width="100%" height="35">
    <tr><td align="center" colspan="3" height="35" bgcolor="#FFCF00"><font size="+1"><b>Edit Categories</b></font></td></tr>
</table>
<form name=edit_cat action="change_cat_display.php" method=post>
    <table align="center" width="50%" cellpadding="5" cellspacing="2">
        <tr><td height="49" class="style1" align="center" colspan="2"><b>Category : <?php = $category_row['category_name']; ?></td></tr>
        <tr>
            <td class="style1" align="right"><b> Category ID </b>
            </td><td align="left"> <?php = $category_row['category_id']; ?> </td></tr>
        <tr>
            <td class="style1" align="right"><b> Category Name </b>
            </td><td align="left"><input type="text" name="txtcategory" value="<?php = $category_row['category_name']; ?>"></td></tr>
        <tr>
            <td class="style1" align="right"><b> Priority </b>
            </td><td align="left"><input type="text" name="txtpriority" value="<?php = $category_row['priority']; ?>"></td></tr>
        <tr>
            <td class="style1" align="center" colspan="2"><input type="submit" value=Save></td></tr>
        <input type="hidden" value=<?php = $cat_id; ?> name=cat_id>
        </form>
        <?php require'include/footer.php'; ?>