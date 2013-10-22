<?php
/***************************************************************************
 *File Name				:alert.tpl
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
 ?>
<table border="0" align="center" cellpadding="4" cellspacing="0" width="958">
<tr ><td background="images/contentbg.jpg" colspan="3" height=25>
<font size="3"><b><div align="left">&nbsp;&nbsp;Alert</div></b></font></td></tr>
<tr>
<td valign="top">
<?
require 'include/my_list.php';
?>
</td>
<td valign="top" width=600>
<table border="0" align="center" cellpadding="5" cellspacing="0" width="564">
<tr colspan="6"><td width="544" background="images/item_bg.gif">
<font size="3"><b>
<div align="left">&nbsp;&nbsp;Alert Messages</div></b></font></td></tr>
<tr><td>
<table cellpadding="15" cellspacing="0" align="center" width="100%">
<form name="alert_form" action="alert.php" method="post">
<? if($msg)
{
?>
<tr><td colspan=3 class="tr_botborder"><font size="2" class="errormsg"><b><?= $msg; ?></b></font></td></tr>
<?
$msg="";
}
?>
<?
	$alert_tot_sql="select * from user_alert where alert_type='P' or alert_type='R' and seller_id=$_SESSION[userid]"; 
	$alert_recordset_tot=mysql_query($alert_tot_sql);
	$alert_tot=mysql_num_rows($alert_recordset_tot);

if ($alert_tot > 0)
	{
	 $alert_sql="select * from user_alert where alert_type='P' and seller_id=$_SESSION[userid]"; 
	 $alert_recordset=mysql_query($alert_sql);
//	 $alert_tot=mysql_num_rows($alert_recordset);
	// $numrow=mysql_num_rows($alert_recorset);
	
	?>
<tr height=10 class="detail9txt">
<td  class="tr_botborder"><input type="checkbox" name="chkMain" id="chkbox" onClick="selectall()"></td><td  class="tr_botborder">From </td>
<td  class="tr_botborder">Subject</td> 
</tr>

<?    while($alert_records=mysql_fetch_array($alert_recordset))
	{
?>
<tr class="header_text">
<td class="tr_botborder"><input type="checkbox" name="chkbox[]" id="chkbox" value="<?=$alert_records[alert_id];?>"></td>
<td class="tr_botborder">
<?= $_SESSION[site_name]  ?>
</td>
<td  class="tr_botborder">
<a href="alert_detail.php?item_id=<?= $alert_records[item_id]; ?>&type=unpaid&seller_id=<?= $alert_records[seller_id];?>&alert_id=<?=$alert_records[alert_id];?>" class="header_text2"><?= $_SESSION[site_name]  ?> Unpaid Item Reminder:#<?= $alert_records[item_id]; ?></a></td></tr>
<?
}
 	$sell_sql="select * from user_alert where alert_type='R' and seller_id=$_SESSION[userid]"; 
	$sell_recordset=mysql_query($sell_sql);
	$sell_tot=mysql_num_rows($sell_recordset);
	while($sell_record=mysql_fetch_array($sell_recordset))
	{
	$delmode= $sell_record['delmode'];
  	if(!empty($sell_record[item_id]))
	{
	?>
	<tr class="header_text">
<td <?if($delmode==0){?> bgcolor="#E0E0E0" <?}?> class="tr_botborder">
<input type="checkbox" name="chkbox[]" id="chkbox" value=<?=$sell_record[alert_id]; ?>></td>
<td <?if($delmode==0){?> bgcolor="#E0E0E0" <?}?>  class="tr_botborder">
<?= $_SESSION[site_name]?>
</td>
<td <?if($delmode==0){?> bgcolor="#E0E0E0" <?}?>  class="tr_botborder"><a href="alert_detail.php?item_id=<?= $sell_record[item_id]; ?>&type=sell&buyer_id=<?= $sell_record[buyer_id]; ?>&alert_id=<?=$sell_record[alert_id];?>" class="header_text2"><?= $_SESSION[site_name]?> Selling Reminder:#<?= $sell_record[item_id]; ?></a></td></tr>
	<?
	    }
 		} 
	?>
	<input type="hidden" name="delete1">
	<input type="hidden" name="len" value="<?= $alert_tot+$sell_tot; ?>">
<tr><td align="center" colspan="3"><input type="button" value="Delete" onClick="del()"></td></tr>
</form>
</table>

<? }
else
{ ?>
<table cellpadding="0" cellspacing="0" align="center" width=100%>
<tr><td align="center" class="tr_botborder"><font class="detail9txt"><b>You Don't have any Alert Messages</b></font></td></tr>
</table>
<? }?>



<td width="2">
</tr></table>
</td>
<td valign="top">
<?
require 'templates/right_menu.tpl';
?>
</td>
</tr></table>


<? require 'include/footer.php'?>