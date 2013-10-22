<?php
/***************************************************************************
 *File Name				:comments.tpl
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
<table width="100%" align="center" cellpadding="0" cellspacing="10">
<tr><td>
<table width="958" align="center" cellpadding="4" cellspacing="0">
<tr>
<td colspan="3" background="images/contentbg.jpg" heifht=25>
<font size="3"><b><div align="left">&nbsp;&nbsp;My Auction</div></b></font>
</td></tr>
<tr>
<td width="19" valign="top">
<table cellpadding="0" cellspacing="0">
<tr align="center" height=35>
<td width=2>
<? require'include/my_list.php'; ?>
</td>
<td valign="top">
<table cellpadding="5" cellspacing="5" valign="top" width="580px">
<tr background="images/item_bg.gif"><td align="left"><b> <font class="detail9txt">Leave Feedback </font></b></td></tr>

<? 
if($in_res)
{
?>
<tr>
<td align="center" width=915><font size="2" color=red><b>Congratulations! You have left feedback for one transaction. </b></font>
</td></tr>

</table></td>
<td valign="top">
<?
require 'templates/right_menu.tpl';
?>
</td>
</tr>
</table>
<tr><td>
<? 
require 'include/footer.php';					
exit();
}
?>
<tr><td width=915>
<form action="<?= $_SERVER['PHP_SELF'] ?>" name="form1" method="post" onSubmit="return validate();" >
<table width="100%" class="tr_botborder">

 <tr class="detail9txt"><td>Item Number</td>
  <td> <? echo $row['item_id']; ?> </td></tr>
  <tr class="detail9txt"><td>User Id </td>
<td><? echo $toid ?> </td></tr>
 
<tr class="detail9txt"><td> Feedback </td> 
<td> <textarea name="txtcomment" cols=40 rows=4><?  if(isset($_REQUEST['alter'])) echo $_REQUEST['feedback']; else echo $row['feedback']; ?></textarea></td></tr>
<tr class="detail9txt"><td>Rating</td> 
<?
$array=array("Positive","Negative","Neutral");
$name ="cboradtype"; 
/* if(isset($_REQUEST['alter'])) 
$name ="cboradtype"; 
else 
$name=$row['feedback_type']; */ ?>
<td><?= select_tag_string("type", $array ,$name); ?> </td></tr>
<input type="hidden" name="radfeedback"  value="<?= $who; ?>">
<input type="hidden" name="item_id"  value="<?= $item_id; ?>">
<input type="hidden" name="seller_id"  value="<?= $id; ?>">
<input type="hidden" name="buyer_id"  value="<?= $id; ?>">
<input type="hidden" name="mode" value="1" />
<tr><td align="center" colspan="2">
<input type="image" src="images/leavefeedback.gif" name="Image92" width="126" height="22" border="0" id="Image92" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image92','','images/leavefeedbacko.gif',1)" value="Leave Feedback"/>

</td></tr>
</table>
</form>
</td></tr>
<!--//////////// won items //////////// -->
</table></td>
<td valign="top">
<?
require 'templates/right_menu.tpl';
?>
</td>
</tr>

<script>
function validate()
{
if(document.form1.txtcomment.value=="")
{
alert("Please enter a Comment");
document.form1.txtcomment.focus();
return false;
}
}
</script>
</body>
</html>

