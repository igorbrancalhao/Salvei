<?php
/* * *************************************************************************
 * File Name				:mail.php
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
require 'include/connect.php';
require 'include/top.php';
?>
<!--<link href="stylesheet.css" rel="stylesheet" type="text/css">

<table width="100%" align="center" bgcolor="#f7f7f7">
<tr bgcolor="#f7f7f7"><td><a href="mail.php?page=subjects" id="link2">Mail Subjects</a></td>
<td><a href="mail.php" id="link2">Send Mail</a></td>
<td><a href="mail.php?page=news" id="link2">News Letter</a></td>
</tr></table>-->
<?php
$page = $_GET['page'];
if ($page == 'subjects')
    include 'mailsubjects.php';
else if ($page == 'news')
    include 'newsletter.php';
else
    include 'sendmails.php';
require 'include/footer.php';
?>