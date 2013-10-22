<?php
/***************************************************************************
 *File Name				:create_store.php
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
<?php session_start();
require 'include/connect.php'; 
$user_id=$_SESSION[userid];
if(!isset($_SESSION[username]))
{ 
$link="signin.php";
$url="create_store.php";
echo '<meta http-equiv="refresh" content="0;url='.$link.'?url='.$url.'">';
echo "You have been Re-Directed, if not please <a href=$link?$url>Click here</a>";
exit();
}
$myquery="select * from storefronts where user_id='$user_id' and status!='New'";
$mytab=mysql_query($myquery);
$count=mysql_num_rows($mytab);
if($count >= 1)
{
$link="stores.php";
echo '<meta http-equiv="refresh" content="0;url='.$link.'">';
echo "You have been Re-Directed, if not please <a href=$link?>Click here</a>";
exit();
}

if($_REQUEST[flag])
{
echo $_SESSION[planid]=$_REQUEST[rdPlans];
$link="stores.php";
echo '<meta http-equiv="refresh" content="0;url='.$link.'">';
echo "You have been Re-Directed, if not please <a href=$link>Click here</a>";
exit();
}
 require 'include/detail_top.php';
 require 'templates/create_store.tpl';
 ?>