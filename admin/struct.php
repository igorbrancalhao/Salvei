<?php
/***************************************************************************
 *File Name				:struct.php
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
<html>
<head>
<title>Admin</title>
<link href="include/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {
	color: #666666;
	font-weight: bold;
}
.style3 {color: #666666; font-size: 11px; font-family:Arial, Helvetica, sans-serif}
-->
</style></head>
<body background="images/bg.gif" topmargin="0">
<center>
<table width="100%"  border="0" cellspacing="0" cellpadding="0" bgcolor="<?php=$bg ?>">
<?php
 require 'include/connect.php'; 
 ?>
  <tr><td><?php require 'include/top.php'; ?></td></tr>
  <tr><td></td></tr>
  	<tr align="center">
<td colspan="9"><?php require 'include/footer.php'?></td></tr>

</table>

</center>
</body>
</html>
