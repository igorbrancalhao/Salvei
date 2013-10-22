<?php
/***************************************************************************
 *File Name				:view_user_dispute.php
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
require'include/connect.php';
$dispute_id=$_REQUEST[dispute_id];

?>
<table cellpadding="0" cellspacing="0" border="0" width=100% class="table_border1">
<tr><td style="padding-left:10px" bgcolor="#CCCCCC"><b>Messages</b> </td> </tr>
<br />
<?php

$dispute_sql="select * from disputeconsole where dispute_id=".$dispute_id;
$dispute_res=mysql_query($dispute_sql);
$dispute_row=mysql_fetch_array($dispute_res);

$bid_sql="select * from placing_bid_item where  bid_id=".$dispute_row[distute_bid_id];
$bid_res=mysql_query($bid_sql);
$bid=mysql_fetch_array($bid_res);
$bid_date=$bid['bidding_date'];
$buyerid=$bid['user_id'];

$sell_sql="select * from placing_item_bid where  item_id=".$bid[item_id];
$sell_res=mysql_query($sell_sql);
$sell=mysql_fetch_array($sell_res);


$dispute_sql_1="select * from dispute_process where dispute_id=".$dispute_id." order by process_id desc";
$dispute_res_1=mysql_query($dispute_sql_1);
if(mysql_num_rows($dispute_res_1) > 0)
{
?>
<tr><td>
<table cellpadding="0" cellspacing="0" border="1" width=100% class="table_border1">
<?php
while($dispute_row_1=mysql_fetch_array($dispute_res_1))
{

$user_sql="select * from user_registration where user_id=".$dispute_row_1[dispute_by];
$user_res=mysql_query($user_sql);
$user=mysql_fetch_array($user_res);

?>
<tr><td valign="top" style="padding-left:10px" colspan="2"><font size="2" color="#CC99FF"><b>
<?php= $user[user_name] ?></b></font>
</td></tr>

<tr><td valign="top" style="padding-left:10px" width="80%" >
<?php= $dispute_row_1[dispute_explanations] ?>
</td><td align="right" style="padding-right:5px"><?php= $dispute_row_1[dispute_date]  ?></td></tr>
<tr><td style="border-bottom:#999999" colspan="2">&nbsp;</td></tr>
<?php
}
?>
</table>
</td></tr>
<?php
}
?>

<tr><td valign="top"  style="padding-left:10px" ><b>
<?php= $_SESSION[site_name]  ?></b>
</td></tr>
<tr><td style="padding-left:10px"><b>An Unpaid Item dispute has been opened for the following item: </b>&nbsp; <?php= $sell[item_title] ?> (#<?php= $bid[item_id] ?>) </td></tr>
<tr><td style="padding-left:10px"><b>Reason given for Unpaid Item:</b>&nbsp;<?php= $dispute_row[dispute_reason]  ?> </td></tr>
<tr><td style="padding-left:10px"><b>Buyer actions reported by seller:</b>&nbsp;<?php= $dispute_row[dispute_explanation]  ?> </td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td style="padding-left:10px"><form name=frm action="view_user_dispute.php">
<input type="button" onClick="window.close()" value="Close">
</form>
</td></tr>
</table>
