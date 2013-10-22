<?php

session_start();
ob_start();
/* * *************************************************************************
 * File Name				:sell_item_desc.php
 * File Name				:wantitnow.php
 * File Created			:Wednesday, June 21, 2006
 * File Last Modified	:Wednesday, June 21, 2006
 * Copyright			:(C) 2001 AJ Square Inc
 * Email				:licence@ajsquare.net
 * Software Language	:PHP
 * Version Created		:V 4.3.2
 * Programmers worked	:S.Priya, B.ReenaKumari, K.Shanmuga priya
 * Modified By			:B.Reena
 * $Id                  : memberlist.php,v 1.36.2.12 2006/02/07 20:42:51 grahamje Exp $ 
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

require 'include/connect.php';
if (empty($_SESSION[userid])) {
    $link = "signin.php";
    $url = "wantitnow.php";
    echo '<meta http-equiv="refresh" content="0;url=' . $link . '?url=' . $url . '">';
    echo "You have been Re-Directed, if not please <a href=$link?$url>Click here</a>";
    exit();
}
$mode = $_REQUEST[mode];
$flag = $_POST[flag];
if ($mode == "change") {
    $content = $_SESSION[des];
}
if ($flag == 1) {
    $content = $_REQUEST[content];
    if (empty($content)) {
        $sell_sql = "select * from error_message where err_id =23";
        $sell_tab = mysql_query($sell_sql);
        $sell_row = mysql_fetch_array($sell_tab);
        $err_des = $sell_row['err_msg'];
        $err_flag = 1;
    }
    if ($err_flag != 1) {
        $_SESSION[des] = $content;
        if ($mode == "") {
            header("Location:wantitnow_preview.php");
            exit();
        }
        if ($mode == "change") {
            header("Location:wantitnow_preview.php");
            exit();
        }
    }
}
$title = "Want It Now Posting";
require 'include/top.php';
require 'templates/wantitnow_desc.tpl';
require 'include/footer.php';
?>