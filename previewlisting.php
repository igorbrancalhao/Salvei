<?php
/* * *************************************************************************
 * File Name				:previewlistings.php
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
session_start();
error_reporting(0);
require 'include/connect.php';
$img = $_GET[themeimage];

$theme_sql = "select * from themes_master where themes='$img'";
$theme_res = mysql_query($theme_sql);
$theme_row = mysql_fetch_array($theme_res);
$theme_top = $theme_row[theme_top_img];
$theme_bottom = $theme_row[theme_bottom_img];
$theme_content = $theme_row[theme_content_img];
list($width, $height, $type, $attr) = getimagesize("images/$theme_top");
$h = $height;
$w = $width;
list($width, $height, $type, $attr) = getimagesize("images/$theme_top");
$bottmimg_h = $height;
$bottmimg_w = $width;
?>
<table width="950" cellpadding="0" cellspacing="0" align="left">
    <tr><td background="images/<?php = $theme_top ?>"  height=<?php = $h ?> width="<?php = w ?>" align="left"  > </td></tr>
    <tr><td background="images/<?php = $theme_content ?>" style="padding:50px">
            <?php = $_SESSION[des]; ?></td> </tr>
    <tr><td background="images/<?php = $theme_bottom ?>" height=<?php = $bottmimg_h ?> width="<?php = w ?>"  align="left"  > </td></tr>
</table>
