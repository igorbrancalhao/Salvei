<?php
/* * *************************************************************************
 * File Name				:full_size_image.php
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
?>
<html>
    <head>
        <?php
        require 'include/connect.php';
        $img = $_GET[img];
        ?>
        <title><?php = $r1[item_title]; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    </head>
    <link rel="stylesheet" href="style/style.css" type="text/css">
    <body>
        <br>
        <br>
        <table align="center">
            <tr><td valign="middle">
                    <img src="..\images\<?php = $img; ?>"  border="1" align="middle"> 
                </td></tr>
            <tr><td align="center">
                    <a href="#" onClick="window.close();">
                        <font size=2>Close</font></a></td></tr></table>
    </body>
</html>
