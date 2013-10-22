<?php
/* * *************************************************************************
 * File Name				:content.php
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
<?php
$browser_name = $_SERVER['HTTP_USER_AGENT'];
if (substr_count($browser_name, 'Opera') == 1)
    $brow_name = 'opera';
else if (substr_count($browser_name, 'Netscape') == 1)
    $brow_name = 'netscape';
else if (substr_count($browser_name, 'Firefox') == 1)
    $brow_name = 'firefox';
else
    $brow_name = 'ie';
?>
<html>
    <head>
        <title>Auction Admin Panel</title>
    </head>
    <body>
        <?php
        if ($brow_name == 'netscape' || $brow_name == 'opera' || $brow_name == 'firefox')
            echo '<textarea name="edit1" cols="60" rows="15"></textarea>';
        else
            require 'include/content.php';
        ?>
    </body>
</html>
