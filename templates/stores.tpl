<?php
/***************************************************************************
 *File Name				:stores.tpl
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
</style>
<table width="958" border="0" cellpadding="0" cellspacing="0" align="center" >
<tr>
<td colspan="4"  background="images/contentbg1.jpg" height="25">
<font class="detail3txt"><div align="left">&nbsp;&nbsp;Store Setup</div></b></font></td>
</tr>
  <?php
  if($row[status]=='disable')
  {
  $_SESSION['planid']=$row[planid];
  $fee_sql="select * from plan where plan_id=".$_SESSION['planid'];
  $fee_res=mysql_query($fee_sql);
  $fee_fetch=mysql_fetch_array($fee_res);
  $fee_amount=$fee_fetch['amount'];
  if($fee_amount=='0.00' || $fee_amount=='0' || empty($fee_amount))
  {
  $update_store=mysql_query("update storefronts set status='enable',statususer='active' where id=$row[id]");
  if($update_store)
  {
  echo '<meta http-equiv="refresh" content="0;url=stores.php">';
  exit();
  }
  }
  ?>
   <tr><td valign="top">
  <table border="0" align="center" cellpadding="5"  background="images/contentgrad.jpg" cellspacing="0" width="958" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom">
   <tr><td>
   <table border="0" align="center" cellpadding="3" cellspacing="0" width="100%">
   <tr height=40><td colspan="2"><font size="3"><b>
&nbsp;&nbsp;&nbsp;&nbsp;Stores</b></font> </td></tr>
   <tr><td align="center"><font class="errormsg">Your store has expired. To activate your store please <a href="store_renew.php" class="banner1">click here</a> to pay the renewal fee.</font></td></tr>
   <tr><td><br /></td></tr>
   
   </table></td></tr>
   </table></td></tr>
   <?php
  }
  else if($row[status]=='suspend')
  {
  ?>
  <tr><td valign="top">
  <table border="0" align="center" cellpadding="5"  background="images/contentgrad.jpg" cellspacing="0" width="958" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom">
   <tr><td>
   <table border="0" align="center" cellpadding="3" cellspacing="0" width="100%">
   <tr height=40><td colspan="2"><font size="3"><b>
&nbsp;&nbsp;&nbsp;&nbsp;Stores</b></font> </td></tr>
   <tr><td align="center"><font class="errormsg">Your store has been suspended. Please wait untill it is reactivated by site admin.</font></td></tr>
   <tr><td><br /></td></tr>
   
   </table></td></tr>
   </table></td></tr>
  
  <?php
   }
   else
  {
  ?>
  <tr><td valign="top">
  <table border="0" align="center" cellpadding="5"  background="images/contentgrad.jpg" cellspacing="0" width="958" style="border-left:1px solid #CCCCCC; border-right:1px solid #cccccc; border-bottom:1px solid #cccccc; background-repeat:repeat-x; background-position:bottom">
   <tr><td align="right"><font class="errormsg">Fields marked with an asterisk (*) are required</font></td></tr>
   <tr height=40><td colspan="2"><font size="3" class="detail9txt"><b>
&nbsp;&nbsp;&nbsp;&nbsp;Store Setup Page </b></font> </td></tr>
 <tr><td colspan="2" height=25 class="detail6txt"><STRONG> &nbsp; &nbsp; &nbsp; &nbsp; » &nbsp;SUBSCRIPTION 
             DETAILS</STRONG></TD></TR>
	

  <tr> 
     <td colspan="2" >

<table cellSpacing=5 cellPadding=0 width=100%
            border=0 align="left">
              <TBODY>
                      <TR>
                      <TD width="150" align="right" class="detail9txt">
					  <STRONG>STORE STATUS</STRONG>:</TD><td>
			 <IMG hspace=4 src="images/<?php if($aboutpage_type=='active') echo 'active.gif'; else echo 'inactive.gif'; ?>">
			 <SPAN class=redfont><?php if($aboutpage_type=='active') echo "<font color=green>active </font>"; else echo "<font color=red>Inactive </font>"; ?></SPAN></TD>
                </TR></TBODY></TABLE></TD></TR>
				<FORM action=stores.php method=post 
            encType=multipart/form-data name=RTEDemo onSubmit="return submitForm();">
			<INPUT type=hidden name=oldlogo> 
			<TR><TD><TABLE class=border cellSpacing=4 cellPadding=4 width="100%" border=0>
              <TBODY>
              <Tr class=c3>
                <TD align=right width=150 class="detail9txt">
				<?php
				if(!empty($err_type))
				{
				?>
				<font color="#FF0000"><b>Enable Store*</b></font>
				<?php
				}
				else
				{
				?>
				<B>Enable Store</B><font color="#FF0000"><b>*</b></font>
				<?php
				}
				?>
				</TD>
                <TD class=contentfont>
				  <?php 
				  if($aboutpage_type=="active")
				  {
				  ?>
				  <INPUT type=radio value="active"
                  name=aboutpage_type checked="checked"/> Yes 
				 <?php
				 }
				 else
				 {
				 ?> 
				  <INPUT type=radio value="active"
                  name=aboutpage_type> Yes 
				 <?php
				 }
				 ?>
 				  <?php if($aboutpage_type=="inactive")
				  {
				  ?>
				  <INPUT type=radio value="inactive"
                  name=aboutpage_type checked="checked"> No
				 <?php
				 }
				 else
				 {
				 ?> 
				  <INPUT type=radio value="inactive"
                  name=aboutpage_type> No
				 <?php
				 }
				 ?>
			 </TD></TR>
              <TR class=c2>
                <TD width=150></TD>
                <TD class="detail6txtnormal">By enabling the STORE page, you will 
                  have the option to list a number of auctions on the newly 
                  created store section.</TD></TR>
                <tr class=c2>
                <td align=right class="detail9txt">
				<?php
				if(!empty($err_name))
				{
				?>
				<font color="#FF0000"><b>Store Name*</b></font>
				<?php
				}
				else
				{
				?>
				<B>Store Name</B><font color="#FF0000">*<b></font>
				<?php
				}
				?>
				</td>
                <td class=contentfont><INPUT  id=store_name 
                  maxLength=50 size=50 name=store_name value="<?php= stripslashes($store_name) ?>"></TD></TR>
              <tr>
                <td vAlign=top align=right class="detail9txt">
				<?php
				if(!empty($err_des))
				{
				?>
				<font color="#FF0000"><b>Store Description*</b></font>
				<?php
				}
				else
				{
				?>
				<B>Store Description</B><font color="#FF0000">*<b></font>
				  <?php
				  }
				  ?>
				  </TD>
				  <script language="JavaScript" type="text/javascript" src="html2xhtml.js"></script>
	<script language="JavaScript" type="text/javascript" src="richtext_compressed.js"></script>
                <TD class=contentfont>
				<!-- <TEXTAREA id=content name=content rows=10 cols=45>   </TEXTAREA> -->
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
<script language="JavaScript" type="text/javascript">
<!--
//build new richTextEditor
var rte1 = new richTextEditor('rte1');
<?php
//format content for preloading
if (!(isset($_POST["rte1"]))) {
	$content = chr(13);
	$content = $_SESSION[itemdes];
	$content = rteSafe($content);
} else {
	//retrieve posted value
	$content=$_POST["rte1"];	
	$content = rteSafe($_POST["rte1"]);	
}
$content=stripslashes($content);
?>
rte1.html = '<?php=$content;?>';
//rte1.toggleSrc = false;
rte1.build();
//-->
</script></TD></TR>
				<?php
				if($logo1)
				{
				$img=$logo1;
				   list($width, $height, $type, $attr) = getimagesize("storefronts/".$img);
				   $h=$height;
				   $w=$width;
				   if($h>200)	
				   {
				   $nh=200;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>160)
				  {
				  $nw=160;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
				?>   
				<TR class=c3>
                <TD align=right class="detail9txt"><B>Current Logo</B></TD>
                <TD class=contentfont><img src="storefronts/<?php=$logo1?>" width="<?php=$w?>" height="<?php=$h?>"/></TD>
				</TR>
				<?php
				}
				?>  
                <TR >
                <TD align=right class="detail9txt"><B>Upload Store Logo</B></TD>
                <TD>
				<INPUT id=logo type=file size=40 name=logo></TD></TR>
				<TR>
                <TD align="middle" colspan="2" align="center"><center>
				<input type="hidden" name="cansave" value=1>
				<input type="hidden" name="content" value="">
				<input type="image" src="images/savesettings.gif" name="Image81" width="109" height="22" border="0" id="Image81" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image81','','images/savesettingso.gif',1)"/>
				<!--<INPUT type=submit value="Save Settings" name="submit">--></center></TD></TR></TBODY></TABLE>
				
				</FORM></TBODY></table></td></tr>
				<?php
				}
				?>
				</table>