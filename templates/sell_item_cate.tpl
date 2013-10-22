<?php
/***************************************************************************
 *File Name				:sell_item_cate.tpl
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
<script src="js/sell.js">
</script>
<table width="958" border="0" cellpadding="0" cellspacing="0" align="center">
<form name="cat_form" action="sell_item_cate.php?title=<?php=$title?>" method="post">
<tr><td valign="top" > 
<table width="958" cellpadding="5" cellspacing="2">
<tr>
<td><table width="948" height="27" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#f0f2f5">
<tr>
<?php
if($_SESSION[sell_format]==4)
{
?><td height="30" colspan="2" bgcolor="#f0f2f5" class="banner1">
<b>1.Category&nbsp;&nbsp;</b>2.&nbsp;Title & Description &nbsp;&nbsp;3.&nbsp;Preview & Submit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#FF0000" class="moretxt">Fields marked with an asterisk (*) are required</font>
</td>

<?php
}
else
{
?>
<td height="30" colspan="2" bgcolor="#f0f2f5" class="banner1">
<b>1.Category&nbsp;&nbsp;</b>2.&nbsp;Title & Description  &nbsp;&nbsp;3.&nbsp;Pictures & Details &nbsp;&nbsp;4.&nbsp;Shipping Details & Sales Tax  &nbsp;&nbsp;5.&nbsp;Preview & Submit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#FF0000" class="moretxt">Fields marked with an asterisk (*) are required</font>
</td>
<?php
}
?>
</tr>
</table></td></tr>
 <tr>
<td><table width="943" height="80" border="0" align="center" cellpadding="0" cellspacing="4" background="images/contentgrad.jpg" style="border:1px solid #c4dbe7; background-repeat:repeat-x; background-position:bottom">
<tr><td class="banner1">
<font size="3"><b>Select from all categories</b></font>
<br>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
What type of item are you selling?. 
Select the best category to help buyers find your item. 
Select a more specific category and click <b>Continue</b>.
</td>
</tr>
</table></td></tr>
<tr>
<td><table width="948" height="32" border="0" align="center" cellpadding="0" cellspacing="0" background="images/abtusbg.jpg">
<tr><td><font class="categories_fonttype">&nbsp;&nbsp;Category<font color="#FF0000"> * </font><noscript>Javascript must be enabled to view Subcategories</noscript></font></td></tr>
</table></td></tr>
 <tr>
<td><table width="943" height="80" border="0" align="center" cellpadding="0" cellspacing="0" background="images/contentgrad.jpg" style="border:1px solid #c4dbe7; background-repeat:repeat-x; background-position:bottom">
<tr><td>

<table cellpadding="5" cellspacing="5" width=100% border="0">
<?php
 if(!empty($err_flag))
 {
 	echo '<tr><td colspan=2 class="banner1" align=center><font color=red><b>'.$err_cat.'</b></font></td></tr>';
 }
?>
<tr>

<td width="2%" valign="top"><strong>1.</strong></td>
<td width="5%" valign="top"><select id="CatMenu_0" name="CatMenu_0" size="8" style="width:184px" onClick="changeMenu(this.value,1);" >
<?php

 while($rec=mysql_fetch_array($res))
{ 
?>
 <option value="<?php= $rec[category_id];?>"><?php= $rec[category_name];?></option>
 <?php
 }
 ?>
 </select></td>
<td width="2%" valign="top"><strong>2</strong>.</td>
<td width="26%" valign="top"><div id="subcat1">
<select id="CatMenu_1" name="CatMenu_1" size="8" style="width:184px" onClick="changeMenu(this.value,2);" disabled="disabled">
<!--<option>---------------------------------------</option>-->
</select></div></td>
<td width="2%" valign="top"><strong>3.</strong></td>
<td width="26%" valign="top"><div id="subcat2">
<select id="CatMenu_2" name="CatMenu_2" size="8" style="width:184px" onClick="changeMenu(this.value,3);" disabled="disabled">
<!--<option>---------------------------------------</option>-->
</select></div></td>
<td width="1%" valign="top"><strong>4.</strong></td>
<td width="36%" valign="top"><div id="subcat3">
<select id="CatMenu_3" size="8" name="CatMenu_3" style="width:184px" onClick="changeMenu(this.value,4);" disabled="disabled">
<!--<option>---------------------------------------</option>-->
</select></div></td>
</tr>
<tr>

<td width="2%" valign="top"><strong>5.</strong></td>
<td width="5%" valign="top"><div id="subcat4">
<select id="CatMenu_4" name="CatMenu_4" size="8" style="width:184px" onClick="changeMenu(this.value,5);" disabled="disabled">
<!--<option>---------------------------------------</option>-->
</select>
</div>
</td>
<td width="2%" valign="top"><strong>6.</strong>.</td>
<td width="26%" valign="top"><div id="subcat5">
<select id="CatMenu_5" name="CatMenu_5" size="8" style="width:184px" onClick="changeMenu(this.value,6);" disabled="disabled">
<!--<option>---------------------------------------</option>-->
</select>
</div></td>
<td width="2%" valign="top"><strong>7.</strong></td>
<td width="26%" valign="top"><div id="subcat6">
<select id="CatMenu_6" name="CatMenu_6" size="8" style="width:184px" onClick="changeMenu(this.value,7);" disabled="disabled">
<!--<option>---------------------------------------</option>-->
</select></div></td>
<td width="1%" valign="top"><strong>8.</strong></td>
<td width="36%" valign="top"><div id="subcat7">
<select id="CatMenu_7" size="8" name="CatMenu_7" style="width:184px" disabled="disabled">
<!--<option>---------------------------------------</option>-->
</select></div></td>
</tr>
</table>
</td></tr>


