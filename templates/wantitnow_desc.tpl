<?php
/***************************************************************************
 *File Name				:sell_item_desc.tpl
 *File Name				:wantitnow.php
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
 <style type="text/css">
<!--
.style1 {
	color: #669933;
	font-weight: bold;
}
.rteImage {
	background: #D3D3D3;
	border: 1px solid #D3D3D3;
	cursor: pointer;
	cursor: hand;
}

.rteImageRaised, .rteImage:hover {
	background: #D3D3D3;
	border: 1px outset;
	cursor: pointer;
	cursor: hand;
}

.rteImageLowered, .rteImage:active {
	background: #D3D3D3;
	border: 1px inset;
	cursor: pointer;
	cursor: hand;
}

.rteVertSep {
	margin: 0 4px 0 4px;
}

.rteBack {
	background: #D3D3D3;
	border: 1px outset;
	letter-spacing: 0;
	padding: 2px;
}

.rteBack tbody tr td, .rteBack tr td {
	background: #D3D3D3;
	padding: 0;
}

-->
</style>
<table width="958" cellpadding="0" cellspacing="0" border=0 align="center">
<tr width=100>
<td colspan=2 background="images/contentbg1.jpg" height="25">
<font class="detail3txt"><div align="left">
&nbsp;&nbsp;Want It Now:Title & Description</div></font>
</td></tr>
<tr><td colspan="2" background="images/contentgrad.jpg" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom"> 
<table cellpadding="0" cellspacing="0" width=950> 
<tr><td align="right" style="padding-right:5px"><font class="errormsg">Fields marked with an asterisk (*) are required</font></td></tr>
<tr><td valign="top"><table width="958" border="0" cellpadding="0" cellspacing="0" align="center">
<tr><td><table width="958" cellpadding="0" cellspacing="5" border="0" align="center">
<tr><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td></tr>
<?php if(!empty($err_des))
 {?>
 <tr class="detail9txt"><td>&nbsp;&nbsp;&nbsp;&nbsp;
 <img src="images/warning_9x10.gif">&nbsp;<font size=2 color=red><?php= $err_des ?></font>
 <br>
 <b><font size=2 color=red>&nbsp;&nbsp;&nbsp;&nbsp;Description
 *</font></b> </td>
 </tr>
 <?php
  }
  else
  {
 ?>
 <tr class="detail9txt"><td>&nbsp;&nbsp;&nbsp;&nbsp;
   <b><font size=2 >&nbsp;&nbsp;&nbsp;&nbsp;Description</font></b>
   <span class="style1">*</span></td>
 </tr>
   <?php 
   }
   ?>
<script language="JavaScript" type="text/javascript" src="html2xhtml.js"></script>
<script language="JavaScript" type="text/javascript" src="richtext_compressed.js"></script>
<form name="RTEDemo" action="wantitnow_desc.php" method="post" onSubmit="return submitForm();">
<tr><td align="center">
<script language="JavaScript" type="text/javascript">
<!--
function submitForm() {
	//make sure hidden and iframe values are in sync for all rtes before submitting form
	updateRTEs();
	//alert(document.RTEDemo.rte1.value);	
	document.RTEDemo.content.value=document.RTEDemo.rte1.value;
	
	return true;
}

//Usage: initRTE(imagesPath, includesPath, cssFile, genXHTML, encHTML)
initRTE("./images/", "./", "", true);
//-->
</script>
<noscript><p><b>Javascript must be enabled to use this form.</b></p></noscript>

<script language="JavaScript" type="text/javascript">
<!--
//build new richTextEditor
var rte1 = new richTextEditor('rte1');
<?php
//format content for preloading
if (!(isset($_POST["rte1"]))) {
	$content = chr(13);
	$content = $_SESSION[des];
	$content = rteSafe($content);
} else {
	//retrieve posted value
	$content=$_POST["rte1"];	
//	$content = rteSafe($_POST["rte1"]);	
}
?>
rte1.html = '<?php=$content;?>';
//rte1.toggleSrc = false;
rte1.build();
//-->
</script>
<p>
<input type="image" src="images/continue.gif" name="Image71" width="81" height="24" border="0" id="Image71" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image71','','images/continueo.gif',1)"/>
<!--<input type="submit" name="submit" value="Submit" />--></p>
<input type="hidden" name="flag" value="1">
<input type="hidden" name="content" value="">
<input type="hidden" name="mode" value="<?php=$mode?>">
</td></tr>
</form>
<?php
function rteSafe($strText) {
	//returns safe code for preloading in the RTE
	$tmpString = $strText;
	
	//convert all types of single quotes
	$tmpString = str_replace(chr(145), chr(39), $tmpString);
	$tmpString = str_replace(chr(146), chr(39), $tmpString);
	$tmpString = str_replace("'", "&#39;", $tmpString);
	
	//convert all types of double quotes
	$tmpString = str_replace(chr(147), chr(34), $tmpString);
	$tmpString = str_replace(chr(148), chr(34), $tmpString);
//	$tmpString = str_replace("\"", "\"", $tmpString);
	
	//replace carriage returns & line feeds
	$tmpString = str_replace(chr(10), " ", $tmpString);
	$tmpString = str_replace(chr(13), " ", $tmpString);
	
	return $tmpString;
}
?>
<?php //echo $content; ?>
  </table></td></tr>
  </table></td></tr>
  </table></td></tr>
  </table>
 