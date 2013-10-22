<?php
/***************************************************************************
 *File Name				:edit_dispute.php
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
require'include/connect.php';
$dispute_id=$_REQUEST[dispute_id];

if($_REQUEST[flag]==1)
{
$permission=$_REQUEST[radpermission];

$dispute_sql="select * from disputeconsole where dispute_id=".$dispute_id;
$dispute_res=mysql_query($dispute_sql);
$dispute_row=mysql_fetch_array($dispute_res);


$bid_sql="select * from placing_bid_item where  bid_id=".$dispute_row['distute_bid_id'];
$bid_res=mysql_query($bid_sql);
$bid=mysql_fetch_array($bid_res);
$bid_date=$bid['bidding_date'];
$item_id=$bid['item_id'];
//changed the updation now
//$upsql="update disputeconsole set dispute_status='$_REQUEST[radpermission]' where dispute_id=$dispute_id";

$upsql="update disputeconsole set dispute_close_status='$_REQUEST[radpermission]' where dispute_id='$dispute_id'";
/*else
$upsql="update disputeconsole set dispute_status='$_REQUEST[radpermission]' where dispute_id=$dispute_id";*/
$status=mysql_query($upsql);
if($_REQUEST[radpermission]=="notapplicable")
{
 $fee_sql="update auction_fees set feestatus='0' where item_id=$item_id";
mysql_query($fee_sql);
}
 //$upsql="update auction_fees set paid='Disallow' where item_id=$item_id";
//$status=mysql_query($upsql);
if($_REQUEST[radpermission]=="granted")
{
 //$fee_sql="update finalsale_fee set feestatus='1' where item_id=$item_id";
  $fee_sql="update auction_fees set feestatus='1' where item_id=$item_id";
mysql_query($fee_sql);
}

}
?>
<table cellpadding="0" cellspacing="0" border="0" width=100% class="table_border1">
<br />
<?php
if($status)
{
?>
<font color="#FF0000">Updated Successfully................</font>
<form name=frm action="edit_dispute.php" method="post">
<input type="button" onClick="window.close()" value="Close">
</form>
<?php
exit();
}
?>
<tr><td> Final Value Fee Credit Eligibilty</td></tr>
<tr><td style="padding-left:10px">
<form name=frm action="edit_dispute.php" method="post">
<input type="hidden" name=flag  value=1>
<input type="radio" name=radpermission value="notapplicable" <?php if($permission=="notapplicable") echo "checked";?> >Non Eligible
<input type="radio" name=radpermission value="granted" <?php if($permission=="granted") echo "checked";?>>Eligible
<input type="hidden" name=dispute_id value=<?php= $dispute_id ?> >
<input type="submit" value=Update>&nbsp;&nbsp;
<input type="button" onClick="window.close()" value="Close">
</form>
</td></tr>
</table>
