<?php
/***************************************************************************
 *File Name				:category.php
  *File Created			:Wednesday, June 21, 2006
 * File Last Modified	:Wednesday, June 21, 2006
 * Copyright			:(C) 2001 AJ Square Inc
 * Email				:licence@ajsquare.net
 * Software Language	:PHP
 * Version Created		:V 4.3.2
 * Programmers worked	:S.Priya, B.ReenaKumari, K.Shanmuga priya
 * Modified By			:B.Reena
 * $Id                  : memberlist.php,v 1.36.2.12 2006/02/07 20:42:51 grahamje Exp $
 ***************************************************************************/
/****************************************************************************
 
*      Licence Agreement: 
 
*     This program is a Commercial licensed software; 
*     you are not authorized to redistribute it and/or modify/and or sell it under any publication 
*     or license /or term it under the GNU General Public License as published by the Free Software Foundation;
*     either user and developer versions of the License, or (at your option) 
*     any later version is applicable for the same.
 
*****************************************************************************/
/*
 file name:browse_cate.php;
 date	  :6.7.05
 Created by:priya
 Rights reserved by AJ Square inc
*/
session_start();
error_reporting(0);
require 'include/connect.php';

$cate_id=$_GET['cate_id'];
$mode=$_GET['mode'];
$currec=$_GET['currec']; 
if($_GET['view'])
$view=$_GET['view'];
else
$view="list";
 
$sql="select * from category_master where category_head_id=$cate_id"; 
$res=mysql_query($sql);
$cat_res=mysql_query($sql);
$sql_tit="select * from category_master where category_id=$cate_id"; 
$res_tit=mysql_query($sql_tit);
$cat_tit=mysql_fetch_array($res_tit);
$tot_rec=mysql_num_rows($res);

 
$title="Browse Categories";
require 'include/top.php'; 
require 'templates/category.tpl';
require 'include/footer.php';

?>


