<?php
/***************************************************************************
 *File Name				:auction_setting.php
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
<?php // require 'include/connect.php'; ?>
<table border="0" align="center" cellpadding="5" cellspacing="2" width="100%" background="images/bg08.jpg">
<tr><td>
<table>
<tr><td width=93>
<table id="Table_01" width="93"  border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td><img src="images/links1_01.jpg" width="93" height="26" alt=""></td>
                    </tr>
                     <tr>
                      <td><a href=auction.php><img src="images/links1_02.jpg" width="93" height="70" alt="" border="0" title="AuctionMaster"></a></td>
                    </tr>
                    <tr>
             <td><a href=site.php?page=auction><img src="images/links1_03.jpg" width="93" height="71" alt="" border="0" title="AuctionSettings"></a></td>
                    </tr>
                    <tr>
                   <td><a href=category.php><img src="images/links1_04.jpg" width="93" height="73" alt="" border="0" title="CategorySettings"></a></td>
                    </tr>
                    <tr>
                      <td><a href=subcategory.php><img src="images/links1_05.jpg" width="93" height="71" alt="" border="0" title="SubcategorySettings"></a></td>
                    </tr>
                    <tr>
                      <td><a href=custom_category.php><img src="images/links1_06.jpg" width="93" height="70" alt="" border="0" title="CustomCategory"></a></td>
                    </tr>
                    <tr>
                      <td><a href=insertion_fee_settings.php><img src="images/links1_07.jpg" width="93" height="66" alt="" border="0" title="AuctionFeeManagement"></a></td>
                    </tr>
                </table></td><td width=793>
<table border="0" align="center" width="98%" class="border2">
<tr bgcolor="#CCCCCC" ><td colspan="2" class="txt_users"> Auction Settings</td></tr>
<?php
$auction_query="select * from admin_settings where set_id=23";
$table=mysql_query($auction_query);
$row=mysql_fetch_array($table);
$start_date=$row['set_value'];

$auction_query="select * from admin_settings where set_id=24";
$table=mysql_query($auction_query);
$row=mysql_fetch_array($table);
$end_date=$row['set_value'];

$auction_query="select * from admin_settings where set_id=25";
$table=mysql_query($auction_query);
$row=mysql_fetch_array($table);
$start_delay=$row['set_value'];

$auction_query="select * from admin_settings where set_id=26";
$table=mysql_query($auction_query);
$row=mysql_fetch_array($table);
$duration=$row['set_value'];

?>
<form  action="<?php $_SERVER['PHP_SELF']?>" method="post" name="frm12">
<tr bgcolor="#eeeee1">
<td colspan="2" align="center">
<font color="#FF0000">
<?php
if($suc_mes!='')
echo $suc_mes;
?></font>
</td>
</tr>
<tr bgcolor="#eeeee1"><td> Allow sellers to specify Start Date </td> 
                      <td> <input type="radio" name="start_date" value="no" <?php if($start_date=="no") echo"checked"; ?>>No 
					   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					   <input type="radio" name="start_date" value="yes" <?php if($start_date=="yes") echo"checked"; ?>>Yes </td>
</tr>

<tr bgcolor="#eeeee1"><td> Allow sellers to specify End Date</td> 
                      <td> <input type="radio" name="end_date" value="no" <?php if($end_date=="no") echo"checked"; ?>>No 
          				  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					   <input type="radio" name="end_date" value="yes" <?php if($end_date=="yes") echo"checked"; ?>>Yes 
					  </td>
</tr>




<tr bgcolor="#eeeee1">
<td>Start Delay &nbsp;&nbsp;&nbsp;(Admin to specify Start Delay )</td> 
<td><input type="text" name="start_delay" value="<?php= $start_delay ?>" onKeyPress="return numbersonly(event);" maxlength="3"> Days
</td>
</tr>
<tr bgcolor="#eeeee1">
<td>Duration &nbsp;&nbsp;&nbsp; ( Admin to specify Duration)</td> 
<td><input type="text" name="duration" value="<?php= $duration ?>" onKeyPress="return numbersonly(event);" maxlength="3"> Days</td>
</tr>
<tr bgcolor="#eeeee1" ><td align="center" colspan="2"><input type="submit" value=" Modify " name="auction_modify" class="button" onclick="return val();"></td>
</tr>
</form>
</table></td></tr></table></td></tr></table>

<script language="javascript">
function checkpermission(val)
{
if(val=='yes')
{
	document.frm12.bid_inc.disabled=true;
}
if(val=='no')
{
	document.frm12.bid_inc.disabled=false;
}
}
function numbersonly(e){
var unicode=e.charCode? e.charCode : e.keyCode
if (unicode!=8 && unicode!=46 && unicode!=9){ //if the key isn't the backspace key (which we should allow)
if (unicode<48||unicode>57) //if not a number
return false //disable key press
}
}

function val()
{
	if(frm12.start_delay.value=="")
	{
		alert("Please Enter the Start Delay");
		frm12.start_delay.focus();
		return false;
	}
	if(frm12.duration.value=="")
	{
		alert("Please Enter the Duration");
		frm12.duration.focus();
		return false;
	}
	return true;	
}
</script>