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
<table width="958" border="0" cellpadding="0" cellspacing="0" align="center">
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
<!--<tr><td>&nbsp;</td></td>
<tr><td  height="25">
<table width="948" height="32" border="0" align="center" cellpadding="0" cellspacing="0" background="images/abtusbg.jpg">
<tr>
<td>
<font class="categories_fonttype"><b>
&nbsp;<?phpif($_SESSION['sell_format']==4){ echo "Post Your Ad";}else { echo "Sell Your Item"; } ?>:Select Category</b></font> 
</td></tr> </table></td></tr>-->

<tr><td valign="top" > 
<table width="958" cellpadding="5" cellspacing="2" >
<tr><td>
<?php if($err_flag==1)
{ 
?>
<table align="center" width="948" height="80" border="0" cellpadding="0" cellspacing="0" background="images/contentgrad.jpg" style="border:1px solid #c4dbe7; background-repeat:repeat-x; background-position:bottom"><tr><td>
<img src="images/warning_39x35.gif"></td><td>
<font class="errormsg">The following must be corrected before continuing:</font></td></tr>
<?php if(!empty($err_cat))
 {
 ?>
<tr><td>&nbsp;</td><td class="detail6txt"><a href="sell_item_cate.php#cat_form" class="header_text2">Category</a> - <?php= $err_cat; ?></td></tr>

<?php 
}
?>
<!--<tr><td colspan="2"><hr noshade class="hr_color" size="1"></td></tr>-->
</table>
<?php
}
?>
</td></tr>
<tr>
<td><table width="948" height="32" border="0" align="center" cellpadding="0" cellspacing="0" background="images/abtusbg.jpg">
<tr><td class="categories_fonttype">
&nbsp;&nbsp;Select from all categories</td></tr></table></td></tr>
<tr><td>
<table width="948" height="80" border="0" align="center" cellpadding="0" cellspacing="0" background="images/contentgrad.jpg" style="border:1px solid #c4dbe7; background-repeat:repeat-x; background-position:bottom">
<tr><td class="banner1">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
What type of item are you selling?. 
Select the best category to help buyers find your item. 
Select a top-level category and click <b>Continue</b>.
</td></tr></table>
</td></tr>
<tr><td>
<table width="948" height="32" border="0" align="center" cellpadding="0" cellspacing="0" background="images/abtusbg.jpg">

<?php if(!empty($err_cat))
 {
 ?>
<tr><td><font class="categories_fonttype"><b>&nbsp;&nbsp;Main Category</b><font color="#FF0000"> * </font></font></td></tr> 
 <?php
 }
 else
 {
 ?>
<tr><td><font class="categories_fonttype"><b>&nbsp;&nbsp;Main Category</b><font color="#FF0000"> * </font></font></td></tr>
<?php
}
?>
</table></td></tr>
<tr><td>
<table width="948" height="80" border="0" align="center" cellpadding="0" cellspacing="0" background="images/contentgrad.jpg" style="border:1px solid #c4dbe7; background-repeat:repeat-x; background-position:bottom">
<tr><td>
<form name="cat_form" action="sell_item_cate.php?title=<?php=$title?>" method="post">
<table cellpadding="5" cellspacing="0" width=100% border="0">
<?php  
$color=1;
 while($rec=mysql_fetch_array($res))
{ 
if($color==1)
{
$color=0;
?>
<tr class="tr_color_3">
<?php
}
else if($color==0)
{
$color=1;
 ?>
 <tr>
 <?php 
 }
  if( $rec['category_id'] == $_SESSION['categoryid'])
 {
 ?>
 <td width="5px"><input type="radio" name="radio_cat" value="<?php=$rec['category_id'];?>" checked></td>
 <td class="detail9txt">
 <?php=$rec[category_name]; ?> </td>
 <?php
 }
 else
 {
 ?>
 <td><input type="radio" name="radio_cat" value=<?php=$rec['category_id']; ?>></td><td class="detail9txt">
 <?php=$rec['category_name']; ?> </td>
 <?php
 }
 ?>
 <td class="banner1">
 <?php 
							$sub_count="1";
                            $sub="select * from category_master where category_head_id=".$rec['category_id']." order by category_name";
				        	$sub_res=mysql_query($sub);
							$tot_sub=mysql_num_rows($sub_res);
   						    while($sub_rec=mysql_fetch_array($sub_res))
							{
							$sub_count=$sub_count+1;
							echo $sub_rec['category_name'];
							if($tot_sub>$sub_count)
							{
							echo " , ";
							}
	}
  ?>  </td></tr>
  <?php 
  }
   ?>
<input type="hidden" name="cat_flag" value="1">
<input type="hidden" name="con_save" value="1">
<input type="hidden" name="mode" value="<?php= $mode ?>">
<input type="hidden" name="sell_format" value="<?php= $sell_format; ?>">
<tr><td align="center" colspan="3">
<?php if($mode=="")
{ ?>
<input type="image" src="images/continue.gif" name="Image71" width="81" height="24" border="0" id="Image71" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image71','','images/continueo.gif',1)"/>
<!--<input type="submit" name="catsub" value="Continue" class="buttonbig">-->
<?php
 }
else if($mode=="change")
{
 ?>
<input type="submit" name="catsub" value="SaveChanges" class="buttonbig">
<?php 
} 
?>
</td></tr>
</table>
</form>
</td></tr>
</table>
</td></tr>
</table></td></tr>
</table>
</td></tr>
</table>
