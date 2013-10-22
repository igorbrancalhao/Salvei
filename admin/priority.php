<?php

/* * *************************************************************************
 * File Name				:priority.php
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
$category_sql = "select * from category_master where category_head_id=0";
$category_result = mysql_query($category_sql);
$count = 1;
while ($category_row = mysql_fetch_array($category_result)) {
    $up = "update category_master set priority=$count where category_id=" . $category_row['category_id'];
    $up_res = mysql_query($up);
    $count = $count + 1;
    $subcategory_sql = "select * from category_master where category_head_id=" . $category_row['category_id'];
    $subcategory_result = mysql_query($subcategory_sql);
    while ($subcategory_row = mysql_fetch_array($subcategory_result)) {

        $up = "update category_master set priority=$count where category_id=" . $subcategory_row['category_id'];
        $up_res = mysql_query($up);
        $count = $count + 1;
        $subcategory_sql1 = "select * from category_master where category_head_id=" . $subcategory_row['category_id'];
        $subcategory_result1 = mysql_query($subcategory_sql1);
        while ($subcategory_row1 = mysql_fetch_array($subcategory_result1)) {

            $up = "update category_master set priority=$count where category_id=" . $subcategory_row1['category_id'];
            $up_res = mysql_query($up);
            $count = $count + 1;
        }
    }
}
?>