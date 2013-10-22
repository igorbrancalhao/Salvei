<?php
/***************************************************************************
 *File Name				:choose_sell_format.php
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
session_start();
error_reporting(0);
require 'include/connect.php';
$click="Sell:Choosing Selling Format";
$title="Sell Your Item";
require 'include/top.php';
if(!isset($_SESSION['userid']))
{ 
$link="signin.php";
$url="choose_sell_format.php";
echo '<meta http-equiv="refresh" content="0;url='.$link.'?url='.$url.'">';
echo "You have been Re-Directed, if not please <a href=$link?$url>Click here</a>";
exit();
}
$mode=$_GET['mode'];
$usr_sql="select * from user_registration where user_name='$_SESSION[username]' and sell_permission='yes'";
$usr_result=mysql_query($usr_sql);
$usr_rows=mysql_num_rows($usr_result);
$usr_row=mysql_fetch_array($usr_result);
if($usr_rows==0) 
 echo "<center><font color=red>Sorry ".$_SESSION[username]." You are not permited to sell your product.</font></center>" ;
 else 
require 'templates/choose_sell_format.tpl';
require 'include/footer.php';
?>