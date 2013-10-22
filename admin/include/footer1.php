<?php
/* * *************************************************************************
 * File Name				:footer1.php
 * File Created				:Wednesday, June 21, 2006
 * File Last Modified			:Wednesday, June 21, 2006
 * Copyright				:(C) 2001 AJ Square Inc
 * Email				:licence@ajsquare.net
 * Software Language			:PHP
 * Version Created			:V 4.3.2
 * Programmers worked	        	:S.Priya, B.ReenaKumari, K.Shanmuga priya
 * $Id                                  : memberlist.php,v 1.36.2.12 2006/02/07 20:42:51 grahamje Exp $
 *
 * ************************************************************************* */


/* * **************************************************************************

 *      Licence Agreement: 

 *     This program is a Commercial licensed software; 
 *     you are not authorized to redistribute it and/or modify/and or sell it under any publication 
 *     or license /or term it under the GNU General Public License as published by the Free Software Foundation;
 *     either user and developer versions of the License, or (at your option) 
 *     any later version is applicable for the same.

 * *************************************************************************** */
$sitename_sql = "select * from admin_settings where set_id='47'";
$sitename_sqlqry = mysql_query($sitename_sql);
$sitename_fetch = mysql_fetch_array($sitename_sqlqry);
$sitename = $sitename_fetch['set_value'];
?>
<tr>
    <td><table id="Table_01" width="780" height="30" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td><img src="images/index_02_04_01_c.jpg" width="30" height="30" alt=""></td>
                <td width="722" height="30" valign="top"><table width="722" height="30" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td background="images/bg13_c.jpg">&nbsp;</td>
                        </tr>
                    </table></td>
                <td><img src="images/index_02_04_03_c.jpg" width="28" height="30" alt=""></td>
            </tr>
        </table></td>
</tr>
<table width="780"  border="0" cellpadding="0" cellspacing="0" bgcolor="#30302d">
    <tr>
        <td><div align="center"><span class="txt_footer">copyright <?php = date("Y") ?>. All Rights Reserved. <?php = $sitename ?></span></div></td>
    </tr>
</table>