<?php
/***************************************************************************
 *File Name				:connect.php
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
<?php
	require '../include/vars.php';	
	$sql=mysql_connect($dbhost,$dbuser,$dbpass);
 	if(!$sql)
   {
		echo "<h1>Unable to Establish Connection to the Server</h1><hr noshade size=2 color=#000000>";
		exit();
	}
	$db_sel=mysql_select_db($dbname,$sql);
	if(!$db_sel)
	{
		echo "<h1>Unable to Connect to the Database</h1><hr noshade size=2 color=#000000>";
		exit();
	}
?>