<?php
/***************************************************************************
 *File Name				:custom_category.php
 *File Created				:Wednesday, June 21, 2006
 * File Last Modified			:Wednesday, June 21, 2006
 * Copyright				:(C) 2001 AJ Square Inc
 * Email				:licence@ajsquare.net
 * Software Language			:PHP
 * Version Created			:V 4.3.2
 * Programmers worked	        	:A.G. Sridevl Lakshmi
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
session_start();
/***************************************************************************
 *                               
 *                            -------------------
 *   begin                : Saturday, September 19, 2005
 *   copyright            : (C) 2005 AJ Square Inc
 *   email                : support@ajsquare.com
 *
 *  
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   You cannot redistribute this software and/or modify
 *   it.All rights are reserved for AJ Square Inc.
 *
 ***************************************************************************/
	require 'include/connect.php';
    require 'include/top.php';
	?>
	<table border="0" align="center" cellpadding="5" cellspacing="2" width="100%" background="images/bg08.jpg">
<tr><td>
<table>
<tr><td width=93>
<?php
//require 'leftauction.php';
?>
<?php
$id=$_GET['id'];
$sql=mysql_query("select * from category_master where category_id=".$id);
$qry=mysql_fetch_array($sql);
$name=$qry['category_name'];
$query=mysql_query("select * from ".$name);
//$res=mysql_fetch_array($query);
?>
</td><td width=793>
<table border="0" align="center" cellpadding="5" cellspacing="2" width="98%">
<tr><td align="right"><a href="custom_category.php" style="text-decoration:none" id="link1" class="txt_users">Back</a></td></tr>
</table>
<table border="0" align="center" cellpadding="5" cellspacing="2" width="98%" class=border2>
<tr><td bgcolor="#CCCCCC" class="txt_users" colspan="3">Custom Category <?php=$name; ?></td></tr>
<tr bgcolor="#CCCCCC" class="txtsitedetails">
<td><b>Field Name</b></td>
<td><b>Data Type</b></td>
<td><b>Length</b></td>
</tr>
<?php
$i=2;
while($i < mysql_num_fields($query))
{
?>
<tr bgcolor="#eeeee1" class="txtsitedetails">
<td><?php=mysql_field_name($query, $i); ?></td>
<td><?php=mysql_field_type($query, $i); ?></td>
<td><?php=mysql_field_len($query, $i); ?></td>
</tr>
<?php
$i=$i+1;
}
?>
</table></td></tr></table>
</td></tr></table>
<?php
require 'include/footer.php'; 
?>