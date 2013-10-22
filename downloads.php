<?php
/***************************************************************************
 *File Name				:downloads.php
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
 ?><?php
/***************************************************************************
 *File Name				:interest.php
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
$md=$_REQUEST['md'];
$id=$_REQUEST['idu'];
if($md==1)
$mode="Active";
if($md==2)
$mode="sold";
if($md==3)
$mode=="Closed";

 ?>
<form name="download_frm" action="download.php" method="post">
<table cellpadding="5" cellspacing="2" width="100%" bgcolor="#EFEFEF" >

<tr><td colspan="2"><font size="+1"><b>
<?php 
if($mode=="Active")
echo "Opened Auctions";
else if($mode=="sold")
echo "Sold Auctions";
else if($mode=="Closed")
echo "Colsed  Auctions";
?>
</b></font>  </td></tr>
<tr><td align="center" ><b>Date From&nbsp;&nbsp;</b></td><td align="center"><b>Date To&nbsp;&nbsp;</b></td></tr>
<tr><td align="center"><input type="text" name="txtdatefrom"  /></td>
<td align="center"><input type="text" name="txtdateto"  /></td></tr>
<tr><td colspan="2" align="center">Format is "2006-07-23"</td></tr>
<input type="hidden" name="mode" value="<?php= $mode ?>" />
<input type="hidden" name="id" value="<?php= $id ?>" />
<tr><td colspan="2" align="center"><input type="submit" value="Download" name="subbut" />
&nbsp;&nbsp;
<input type="button" value="Close" onclick="window.close()" /></td></tr>
</table></form>
