<?php
/***************************************************************************
 *File Name				:wantitnow.tpl
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
<script src="js/wantitnow.js">
</script>
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
<table width="958" cellpadding="0" cellspacing="0" border=0 align="center">
<tr width=100>
<td background="images/contentbg1.jpg" height="25">
<font class="detail3txt"><div align="left">
&nbsp;&nbsp;Want It Now:Title & Description</div></font>
</td></tr>
<tr><td colspan="2" background="images/contentgrad.jpg" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom"> 
<table cellpadding="5" cellspacing="2"  width=100%> 
<tr><td align="right"><font class="errormsg">Fields marked with an asterisk (*) are required</font></td></tr>
<tr><td>
<?php if($err_flag==1)
{ 
?>
<table width="100%" align="center"><tr><td>
<img src="images/warning_39x35.gif"></td>
<td><font size=2 color="red">The following must be corrected before continuing: </font></td>
<?php if(!empty($err_cat))
 {
 ?>
<tr class="detail6txt"><td>&nbsp;</td>
<td><a href="wantitnow.php#cbosubcat" onclick="sel('cbosubcat')" class="header_text2">Category</a> - <?php= $err_cat; ?></td></tr>
<?php 
}
?>
<?php if(!empty($err_title))
 {
 ?>
<tr class="detail6txt"><td>&nbsp;</td>
<td><a href="wantitnow.php#" onclick="sel('txttitle')" class="header_text2">Item Title</a> - <?php= $err_title; ?></td></tr>
<?php 
}
?>
<?php if(!empty($err_dur))
{
?>
<tr class="detail6txt"><td>&nbsp;</td><td><a href="wantitnow.php#cbodur" onclick="sel('cbodur')" class="header_text2">Duration</a> - <?php= $err_dur; ?></td></tr>
<?php 
}
?>
<?php if(!empty($err_img1))
 {
 ?>
<tr class="detail6txt"><td>&nbsp;</td><td><a href="wantitnow.php#img1" onclick="sel('img1')" class="header_text2">Image1</a> - <?php= $err_img1; ?></td></tr>
<?php 
}
?>

</table></td></tr>
<tr><td>
<hr size="1" noshade class="hr_color"></td></tr>
<?php
}
 ?>
<tr>
<td> 
<form name="form1" action="wantitnow.php"  method=post enctype="multipart/form-data">
<table width="100%" cellpadding="5" cellspacing="0">
<tr>
<td><table width="95%" height="80" border="0" align="center" cellpadding="5" cellspacing="5">
 <tr><td  class="detail9txt">
<?php if(!empty($err_cat))
 {?>
 <img src="images/warning_9x10.gif">&nbsp;<font size=2 color=red><?php= $err_cat ?></font>
 <br>
 <b><font size=2 color=red>Category</font></b>
 <span class="style1">*</span> 
 <?php
  }
  else
  {
 ?>
   <b><font size=2 >Category</font></b>
   <span class="style1">*</span>
   <?php 
   }
   ?>
 <b><font size=2 >  <noscript>Javascript must be enabled to view Subcategories</noscript></font></b>
 </td>
 </tr>
<tr><td>
<table cellpadding="5" cellspacing="5" width=100% border="0">
<tr>
<td width="2%" valign="top"><strong>1.</strong></td>
<td width="5%" valign="top">
<?php
$res123 = mysql_query($sql123);
?>
<select id="CatMenu_0" name="CatMenu_0" size="8" style="width:184px" onclick="changeMenu(this.value,1);" >
  <?php

 while($rec=mysql_fetch_array($res123))
{ 
?>
  <option value="<?php= $rec[category_id];?>">  <?php= $rec[category_name];?>  </option>
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
</div></td>
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
<?php if(!empty($err_title))
 {?>
 <tr class="detail9txt"><td>
 <img src="images/warning_9x10.gif">&nbsp;<font size=2 color=red><?php= $err_title ?></font>
 <br>
 <b><font size=2 color=red>I am searching for</font></b>
 <span class="style1">*</span> </td>
 </tr>
 <?php
  }
  else
  {
 ?>
 <tr class="detail9txt"><td>
   <b><font size=2>I am searching for</font></b>
   <span class="style1">*</span></td>
 </tr>
   <?php 
   }
   ?>
   
 
 <tr><td width=965><input type="text" name="txttitle" class="txtbig" value="<?php= $item_title; ?>">
 </td></tr>
 
 <tr class="detail9txt">
 <?php 
 if($admin_end_row['set_value']=="yes")
 {
 ?>
 <td>
 <?php if(!empty($err_dur))
 { 
 ?>
 <img src="images/warning_9x10.gif">&nbsp;<font size=2 color=red><?php= $err_dur; ?></font>
 <br>
 <b><font size=2 color=red>Duration</font></b>
 <span class="style1">*</span>
 <?php
   }
  else
  {
 ?>
   <b><font size=2 >Duration</font></b>
   <span class="style1">*</span>
   <?php 
   }
    } //  if($admin_end_row=='yes')
   ?> </td>
</tr>
<tr>
 <td width=965>
<?php
if($admin_end_row['set_value']=='yes')
{
$auction_query="select * from auction_duration order by duration";
$table=mysql_query($auction_query);
?>
<select name="cbodur">
<option value="0">Select</option>
<?php
while($row=mysql_fetch_array($table))
{
?>
<?php if($dur==$row['duration_id'])
{
?>
<option value="<?php= $row['duration'] ?>" selected><?php= $row['duration'] ?> Days</option>
<?php
}
else
{
?>
<option value="<?php= $row['duration'] ?>" ><?php= $row['duration'] ?> Days</option>
<?php
}
} // while($row=mysql_fetch_array($table))
?>
</select>
</td>
 <?php
 }  // if($admin_end_row=='yes')
 ?>
 </tr>
<tr class="detail9txt"><td colspan="2">
<?php if(!empty($err_img1))
 {?>
 <img src="images/warning_9x10.gif">&nbsp;<font size=2 color=red><?php= $err_img1; ?></font>
 <br>
 <b><font size=2 color=red>Image1</font></b>
 <?php
  }
  else
  {
 ?>
  <b><font size=2>Image1</font></b>
   <?php 
   }
   ?>
    <input type="file" name="img1" value="<?php= $img1; ?>" id="img1">
	<?php if(!empty($_SESSION[image1]))
	{
	?>
	<img src="images/<?php=$_SESSION[image1]?>" width="25" height="25">
	<?php
	}
	?></td></tr>
	
	<input type="hidden" name="flag" value="1">
	<input type="hidden" name="cat_id" value="<?php= $cat_id; ?>">
	<input type="hidden" name="mode" value="<?php= $mode; ?>">
	<input type="hidden" name="sell_format" value="<?php= $sell_format; ?>">
	<input type="hidden" name="item_id" value="<?php= $item_id; ?>">
	
	<input type="hidden" name="sub_cat1" id="sub_cat1" value="">
    <input type="hidden" name="sub_cat2" id="sub_cat2" value="">
    <input type="hidden" name="sub_cat3" id="sub_cat3" value="">
    <input type="hidden" name="sub_cat4" id="sub_cat4" value="">
    <input type="hidden" name="sub_cat5" id="sub_cat5" value="">
    <input type="hidden" name="sub_cat6" id="sub_cat6" value="">
    <input type="hidden" name="sub_cat7" id="sub_cat7" value="">
    <input type="hidden" name="sub_cat8" id="sub_cat8" value="">
	
	
    <tr><td colspan="2" align="center">
	<input type="image" src="images/continue.gif" name="Image71" width="81" height="24" border="0" id="Image71" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image71','','images/continueo.gif',1)"/>
	</td></tr>
   </table>
   </form>
   </td></tr>
   </table>
   </td></tr>
   </table>
   </td></tr>
   </table>
<script language="javascript">
function selectsub()
{
document.form1.cat_id.value=document.form1.cbosubcat.value;
document.form1.flag.value="0";
document.form1.submit();
}
function sel(elementname)
{
var element_name=elementname;
if(element_name=="txttitle")
document.form1.txttitle.focus();
if(element_name=="cbodur")
document.form1.cbodur.focus();
if(element_name=="cbosubcat")
document.form1.cbosubcat.focus();
if(element_name=="cbosubcat1")
document.form1.cbosubcat1.focus();
if(element_name=="img1")
document.form1.img1.focus();
}
</script>
