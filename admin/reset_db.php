<?php
/***************************************************************************
 *File Name				:reset_db.php
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
session_start();
/*if(strlen($_SESSION["adminuser"])==0)
{
echo '<meta http-equiv="refresh" content="0; url=index.php">';
exit();
}*/
require 'include/connect.php';
if(isset($_POST['btn_Reset'])) {
	$tab_sql=mysql_list_tables($dbname);
	while ($row = mysql_fetch_row($tab_sql)) {
       $table_name=$row[0];
	   if($table_name=='admin_account' || $table_name=='admin_earnings' || $table_name=='admin_rates'
 || $table_name=='ask_question' ||  $table_name=='newsletter' ||   $table_name=='featured_items' || $table_name=='feedback' || $table_name=='font_settings' || $table_name=='layout_settings'  || $table_name=='mailsubject' || $table_name=='payment_details' ||  $table_name=='placing_bid_item' || $table_name=='placing_item_bid' || $table_name=='rate_value' || $table_name=='save_searchresult' || $table_name=='site_manager' || $table_name=='site_settings'  ||  $table_name=='sub_admin' || $table_name=='tbl_usermaster' ||  $table_name=='test' || $table_name=='user_alert' || $table_name=='user_option' || $table_name=='user_registration' || $table_name=='watch_list'
 ) 
 {
  	$del_query="delete from $table_name";
   // $del_result=mysql_query($del_query);
 }
 }
}
?>
<link rel=stylesheet type=text/css href=include/style.css>
<style type="text/css">
<!--
.style1 {
	color: #666666;
	font-weight: bold;
}
-->
</style>
<?php
require 'include/top.php';
?>
<br>
<table border="0" align="center" width="80%" cellpadding="5" cellspacing="2" class="tablebox">
<form name="frmReset" action="<?php $_SERVER['PHP_SELF']?>" method="post">
<tr bgcolor="#cccccc"><td class="style1">Resetting your Database will Remove all the Current Data from your Database,<br>
If you are sure to Reset Click the Button Below
</td></tr>
<tr bgcolor="#eeeee1">
<td align="center"><input type="submit" name="btn_Reset" value=" Reset " class="button"></td>
</tr>
</form>
</table>
<br>
<br>
<?php require'include/footer.php'; ?>