<?php
/***************************************************************************
 *File Name				:success_payment.tpl
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
session_start();
require 'include/top.php';
$success_flag=1;
 ?>
<table align="center" cellpadding="5" cellspacing="0"  width="962">
<tr>
<td colspan="4" background="images/item_bg.gif">
<font size="3"><b><div align="left">&nbsp;&nbsp;Store Subscription</div></b></font></td>
</tr>
<?php
if($success_flag==1)
{

        $start_date=date("Y-m-d G:i:s");
		$start_date1=date("Y-m-d");
		$plan_sql="select * from plan where plan_id=".$_SESSION['planid'];
		$plan_qry=mysql_query($plan_sql);
		$plan_row=mysql_fetch_array($plan_qry);
		$dur=$plan_row[period];
		$interval=$dur;
		if($plan_row['period_type']==1)
		{
		$day_sql="select date_add('$start_date1', interval '$dur' day) as day";
		$day_qry=mysql_query($day_sql);
		$day_row=mysql_fetch_array($day_qry);
		$expire_date=$day_row['day'];
		//$expire_date = addDay($start_date,$interval); 
		}
		if($plan_row['period_type']==2)
		{
		$month_sql="select date_add('$start_date1', interval '$dur' month) as month";
		$month_qry=mysql_query($month_sql);
		$month_row=mysql_fetch_array($month_qry);
		$expire_date=$month_row['month'];
		}
		if($plan_row['period_type']==3)
		{
		$year_sql="select date_add('$start_date1',interval '$dur' year) as year";
		$year_qry=mysql_query($year_sql);
		$year_row=mysql_fetch_array($year_qry);
		
		$expire_date=$year_row['year'];
		}
 $query="insert into storefronts (user_id,logo,description,store_name,status,planid,store_start_date,store_end_date)values('".$_SESSION[userid]."','".$_SESSION[logo1]."','".$_SESSION[itemdes]."','".$_SESSION[storename]."','enable','".$_SESSION[planid]."','$start_date','$expire_date')";
mysql_query($query);

$_SESSION['amount']='';
$_SESSION['item_id']='';
$_SESSION['payment_gateway']='';
$_SESSION[store_id]=" ";
$_SESSION['logo1']='';
$_SESSION['itemdes']='';
$_SESSION['storename']='';
$_SESSION['planid']='';
?>
<tr><td style="padding-left:10px;font_size:2" class="detail9txt"><b>Success Message</b></td></tr>
<tr><td style="padding-left:50px" class="detail6txt">Thank You!.Your Store has been created.<br /></td></tr>
<?php
}
?>
</table>
<?php
require 'include/footer.php';
?>