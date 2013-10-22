<?php
/***************************************************************************
 *File Name				:advanced_search.tpl
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
<table width="058" border="0" cellpadding="5" cellspacing="0" align="center" >
<tr><td>
<table cellpadding="0" cellspacing="0" width="958" border="0">
<tr><td background="images/contentbg1.jpg" height="25"><font class="detail3txt"><div align="left">&nbsp;&nbsp;
Advanced Search
</div></b></font></td></tr>
<form name="adv_form" action="search.php" method="post">
<tr><td>
<table width="100%" cellpadding="5" cellspacing="0" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom">
<tr><td align="center">
<table cellpadding="5" cellspacing="2" width="500">
<tr>
<td class="detail9txt">Category</td>
<?php
	$sql="select * from category_master where category_head_id=0 order by category_name"; 
	$res=mysql_query($sql);
?>
      <td><select name="category_id" style="width:170px;">
	 <option value="all">All categories</option>
          <?php
		    while($row2=mysql_fetch_array($res))
		   {
		 ?>
          <option value="<?php echo $row2['category_id'];?>"><?php echo $row2['category_name']; ?></option>
          <?php 
		    } ?>
        </select></td></tr>
<tr><td class="detail9txt">Keyword</td><td><input type="text" name="k_word" size="10" style="width:170px">&nbsp;<!--<select name="item_status">
<option value="1">Current Listings</option>
<option value="2">Closed Listings</option>
</select>-->
<input type="hidden" name="item_status" value="1" />
</td></tr>
<tr><td colspan="2"><!--<font class="detail9txt">Item priced</font>--><br><hr>
</td><td>&nbsp;</td></tr>
<tr><td class="dealtxt">Search with item's Price</td></tr>
<tr><td class="detail9txt">Minimum:&nbsp; <?= $cur; ?>&nbsp; <input type="text" name="m_cur" size=5> &nbsp;&nbsp;</td>
<td class="detail9txt">Maximum:&nbsp; <?= $cur; ?>&nbsp; <input type="text" name="max_cur" size=5></td></tr>
 <tr>
                <td colspan="2"><br>
                <hr></td><td>&nbsp;</td></tr>
				<tr><td class="dealtxt">Specific Seller's Items(Select seller's username)</td></tr>
<tr><td colspan="2"><select name="seller"><option value="include">Include</option>
<option value="exclude">Exclude</option></select>&nbsp;&nbsp;&nbsp;&nbsp;
<!--<input type="text" name="seller_name" size="20">-->
<select name="seller_name" style="width:130px">
<option value="">Select</option>
<?
$sqlusers="select * from user_registration where status='Active' and verified='yes' order by user_name";
$sqlqryusers=mysql_query($sqlusers);
if(mysql_num_rows($sqlqryusers)>0)
{
while($sqlfetchrows=mysql_fetch_array($sqlqryusers))
{
?>
<option value="<?=$sqlfetchrows['user_name']?>"><?=$sqlfetchrows['user_name']?></option>
<?
}
}
?>
</select>
</td></tr>
<input type="hidden" value="advanced" name="mode">
<tr><td align="center" colspan="2">
<input type=image src="images/search1.gif" name="btnSearch" width="62" height="22" border="0" id="Image61" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image61','','images/searcho1.gif',1)"/>
</td><td>&nbsp;</td></tr>

</table></td></tr>
</table>
</td></tr>
</form></table></td></tr></table>