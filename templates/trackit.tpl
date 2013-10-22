<?php
/***************************************************************************
 *File Name				:trackit.tpl
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
<font size="3"><b><div align="left">&nbsp;&nbsp;Track Item</div></b></font>
</td></tr>
<tr><td>
<table cellpadding="0" cellspacing="0">
<tr align="center" height=35>
<td width=2>
<?php require'include/my_list.php'; ?>
</td></tr></table></td>
<td valign="top" width=100%>
<table valign="top " cellspacing="0" cellpadding="0" width=100%>
<tr><td width=100%>
<table cellpadding="0" cellspacing="0" width=100%>
<tr><td height=30 width=560 id=buyingtotals>
<table cellpadding="5" cellspacing="2" width=560>
<tr background="images/item_bg.gif"><td align="left" colspan="3" class="detail9txt">
<b>
&nbsp;&nbsp;Track Your Item:</b></td>
</tr></table>
</td></tr>
<tr>
<td>
<table cellpadding="2" cellspacing="5">
<?php
if($method=="dhl")
{
?>
<tr><td style="padding-left:10px">
<table cellpadding="2" cellspacing="5">
<form name="form1" method="get" action="http://track.dhl-usa.com/atrknav.asp" target="_blank">
<tr>
<td class="detail9txt"><b>Enter Your Track Number</b></td>
<td>
<input type="text" name="ShipmentNumber" size="11">
</td>
<tr><td colspan="2"  style="padding-left:155px">
<input type="image" src="images/submit.gif" name="Image85" width="62" height="22" border="0" id="Image85" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image85','','images/submito.gif',1)" onclick="return dhlvalidate()"/>
<input type="image" src="images/reset.gif" name="Image87" width="62" height="22" border="0" id="Image87" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image87','','images/reseto.gif',1)" onclick="return res();"/>
<!--<input type="reset" value="Reset"  >--></td></tr>
</form>
</table>
</td></tr>
<?php
}
else if($method=="fedex")
{
?>
<tr><td style="padding-left:10px">
<table cellpadding="2" cellspacing="5">
<form action="http://www.fedex.com/cgi-bin/tracking?" method="get" target="_blank" id="formFedex" name="formFedex" onsubmit="return validate();">
<tr>
<td class="detail9txt"><b>Enter Your Track Number</b></td>
<td>
<input name="tracknumbers" type="text" value="" onFocus="value=''" size="24" style="font-size: 10px;">
<font color="#FFFFFF"><b>Text_Above_Box</b></font>
<input type="hidden" name="action" value="track">
<input type="hidden" name="language" value="english">
</td></tr>
<tr><td colspan="2" style="padding-left:155px"><!-- <input type="image" src="/images/track.gif">-->
<input type="image" src="images/submit.gif" name="Image85" width="62" height="22" border="0" id="Image85" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image85','','images/submito.gif',1)"/>
<input type="image" src="images/reset.gif" name="Image87" width="62" height="22" border="0" id="Image87" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image87','','images/reseto.gif',1)" onclick="return res1();"/>
</td></tr>

<input type="hidden" name="cntry_code" value="us">
<input type="hidden" name="initial" value="x"> 
</form>
</table></td></tr>
<?php
}
else
{
?>
<tr><td style="padding-left:5px" class="detail9txt">
<?php
if($err_msg==1)
{
?>
<font class="errormsg">Please select the preferred shipping method to track on this Item.</font>
<?php
}
else
{
?>
Please select the preferred shipping method to track on this Item.
<?php
}
?>
</td></tr>
<form name="frmtrack" action="trackit.php" method="post">
<tr><td style="padding-left:80px" class="detail9txt"> 
<input type="radio" name="radtrack" value="dhl" />&nbsp;&nbsp;&nbsp; DHL
</td></tr>
<tr><td style="padding-left:80px" class="detail9txt"> 
<input type="radio" name="radtrack" value="fedex" />&nbsp;&nbsp;&nbsp; Fedex
</td></tr>
<tr><td style="padding-left:80px">
<!--<input type="image" src="images/continue.gif" name="Image71" width="81" height="24" border="0" id="Image71" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image71','','images/continueo.gif',1)"/>-->
<input type="submit" value="Continue" name="track" />
</td></tr>
</form>
<?php
}
?>
</table>

</td></tr>
</table>
</td></tr>



</table></td>
<td  valign="top">
<?php require 'templates/right_menu.tpl';?>
</td>
</tr>
</table>
<tr><td>
<?php 
 require 'include/footer.php';					
?>
</td></tr>
</table></td></tr>
<script>
function validate()
{
var trackid=document.formFedex.tracknumbers.value;
if(trackid=="")
{
alert("Please Enter the Track Id");
return false;
}
else
return true;
/*else if(isNaN(trackid))
{
alert("Please Enter an integer value");
return false;
}*/
}
function res()
{
document.form1.ShipmentNumber.value="";
return false;
}
function dhlvalidate()
{
if(document.form1.ShipmentNumber.value=="")
{
alert("Please Enter the Track Id");
return false;
}
else
return true;
}
function res1()
{
document.formFedex.tracknumbers.value="";
return false;
}
</script>