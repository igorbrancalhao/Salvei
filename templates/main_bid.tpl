<?php
/***************************************************************************
 *File Name				:main_bid.tpl
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
  <table width="958" border="0" cellpadding="0" cellspacing="0" align="center" >
  <form name="bid" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="return validate()"  method=post> 
  <tr><td>
  <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr><td background="images/contentbg.jpg" height="25">
  <font class="detail3txt">&nbsp;&nbsp;&nbsp;Place a Bid </td></tr>
 <tr><td>
 </table></td></tr>
 <tr><td>
 <table width="100%" border="0" cellspacing="15" align="center"  background="images/contentgrad.jpg" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom">
<?php 
if($err)
{
	?>
	<tr><td align="center" colspan="2">
	<table cellpadding="0" cellspacing="0" width="100%" height=50>
	<tr>
	<td width="100%" align="center"><b><font class="errormsg"><?php= $err; ?></font></b></td></tr>
	</table></td></tr>
	<?php
}
else if($err_message)
{
 	?>
	<tr><td align="center" colspan="2">&nbsp;
	<font class="errormsg">
	<?php echo $err_message; ?></font>
	</td></tr>
	<?php
 }
?>
<tr class="detail6txt">
<td>Current Bid:</td>
<td align="left"><?php echo $row_user[currency]." ".$max_bid_amt_dis;?></td>
</tr>
<tr class="detail6txt">
<td> Bid Increment:</td>
<td><?php echo $row_user[currency]." ".$row['bid_increment']; ?></td>
</tr>
<tr class="detail6txt">
<td>Your Maximum Bid</td>
<td><input type="text" name="max_bid"></td></tr>
<tr><td>&nbsp;</td>
<td class="detail6txt">( Minimum Bid:<?php echo $row_user[currency]." ".($max_bid_amt_dis+$row['bid_increment']); ?> )</td>
</tr>
<!--<tr bgcolor="#F5F5F5">-->
<?php
if($row_user['Quantity'] > 1)
	{ 
	?>
	<input type="hidden" name="qty" value="<?php=$row_user['Quantity']?>">
	<!--<tr class="detail6txt">
    <td height="27">Quantity:</td>
    <td align="left"><select name=qty>
	 <option value="Quantity">Quantity</option>
	<?php for($i=1;$i<=$row_user[Quantity];$i++)
	 {
	 ?>
	 <option value="<?php= $i;?>"><?php= $i;?></option>
	 <?php 
	 }
	 ?></select></td>
 </tr>-->
  
 <?php
     }
	 else
	{ 
	 ?>
		 <input type="hidden" name=qty value=1>
	<?php
	}
	 ?>
	<tr class="detail6txt"><td align="left" colspan="2"><input name="chk" type="checkbox" value="chk">
                Email Remainder</td>
            </tr>

	
	<td colspan="2" align=center>
	<input type="image" src="images/placeabid.gif" name="Image23" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image23','','images/placeabido.gif',1)" width="97" height="25" border="0" id="Image23"/>
    <input type="hidden" name=flag value=1>
	<input type="hidden" name=quick_id value=<?php= $item_id; ?> >
	<input type="hidden" name=item_id value=<?php= $item_id; ?> >
	<input type="hidden" name=quick_qty value=<?php= $qty; ?>>
		 	</td></tr>
			
   </table>
   </td></tr>
  </form>
  </table>
