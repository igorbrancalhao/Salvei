<?php
/***************************************************************************
 *File Name				:ratings.php
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
<table width="75%" height="114" border="0" align="center" cellpadding="5" cellspacing="2" style="border-top:1px solid #e9e9e9;border-left:1px solid #e9e9e9;border-right:1px solid #e9e9e9;border-bottom:1px solid #e9e9e9;">
<form name="value" action="ratings.php" method="post">
  <tr> 
    <td colspan="6"><strong><font color="#000000">Rate This Article</font></strong></td>
  </tr>
  <tr>
  
  <td><b>Excellent</b></td>
  <td><b>Very Good</b></td>
  <td><b>Good</b></td>
  <td><b>Normal</b></td>
  <td><b>Bad</b></td>
  </tr>
  <tr>
  
  
	
	<td><input  type="radio" name="trade" value="5" checked></td>
	<td><input type="radio" name="trade" value="4"></td>
	<td><input type="radio" name="trade" value="3"></td>
	<td><input type="radio" name="trade" value="2"></td>
	<td><input type="radio" name="trade" value="1"></td>
	<input type="hidden" name="type" value="add">
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<input type="hidden" name="arid" value="<?php echo $artid; ?>">
  </tr>
 <tr>
 <td align="center" colspan="6"> <input type="submit" name="submit" value="Rate" class="searchbutton"></td>
 </tr>
  	</form>
</table>
<br>