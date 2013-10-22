<?php
/***************************************************************************
 *File Name				:change_display_order.php
 *File Created				:Wednesday, June 21, 2006
 * File Last Modified			:Wednesday, June 21, 2006
 * Copyright				:(C) 2001 AJ Square Inc
 * Email				:licence@ajsquare.net
 * Software Language			:PHP
 * Version Created			:V 4.3.2
 * Programmers worked	        	:S.Priya, B.ReenaKumari, K.Shanmuga priya
 * $Id                                  : memberlist.php,v 1.36.2.12 2006/02/07 20:42:51 grahamje Exp $
 *
 ***************************************************************************/
 

/****************************************************************************
 
*      Licence Agreement: 
 
*     This program is a Commercial licensed software; 
*     you are not authorized to redistribute it and/or modify/and or sell it under any publication 
*     or license /or term it under the GNU General Public License as published by the Free Software Foundation;
*     either user and developer versions of the License, or (at your option) 
*     any later version is applicable for the same.
 
*****************************************************************************/
 ?>
<?php
require 'include/connect.php';
require 'include/top.php';
?>
<table align="center" width="100%" height="35">
  <tr><td align="center" colspan="3" height="35" bgcolor="#FFCF00"><font size=+1>
  Edit Categories</font></td></tr>
  </table>
  <table align="center" width="50%">
 <tr>
<td height="49"  bgcolor="#CCCCCC" class="style1" align="center">
Parent Categories
</td>
<td height="49"  bgcolor="#CCCCCC" class="style1" align="center">Category Name</td>
<td height="49"  bgcolor="#CCCCCC" class="style1" align="center">Priority</td>
</tr>
<?php
		$category_sql="select * from category_master where category_head_id=0";
		$category_result=mysql_query($category_sql);
		while($category_row=mysql_fetch_array($category_result))
		 {
		 ?>
		 <tr><td bgcolor="#CCCCCC">&nbsp;</td>
		 <td> <a href="change_cat_display.php?cat_id=<?php= $category_row[category_id]; ?>"><b><?php= $category_row[category_name]; ?></b></a></td>
         <td> <?php= $category_row[priority]; ?></td>
         </tr>
		<?php
		$categoryname= $category_row['category_name'];
	    $subcategory_sql="select * from category_master where category_head_id=".$category_row['category_id'];
		$subcategory_result=mysql_query($subcategory_sql);
		while($subcategory_row=mysql_fetch_array($subcategory_result))
		{
		  ?>
        <tr>
        <td bgcolor="#CCCCCC" align="right">&nbsp;&nbsp;&nbsp;&nbsp;
        <?php=$categoryname ?>  &nbsp; > &nbsp; </td>
		
  <td> <a href="change_cat_display.php?cat_id=<?php= $subcategory_row[category_id]; ?>"><?php= $subcategory_row[category_name]; ?></a></td>
  <td> <?php= $subcategory_row[priority]; ?></td>
  </tr>
 <?php
 }
 }
 ?>
<?php require'include/footer.php'; ?>