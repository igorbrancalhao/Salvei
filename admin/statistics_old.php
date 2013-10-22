<?php
/***************************************************************************
 *File Name				:statistics_old.php
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
session_start();
require 'include/connect.php';


if(isset($_POST['btn_Modify'])) {
	$siteval=$_POST['txtSiteval'];
	$statid=$_POST['statid'];
	$count=count($statid);
	for($i=0;$i<$count;$i++) {
		$up_sql="update site_statistics set site_val='$siteval[$i]' where stat_id=$statid[$i]";
		$up_res=mysql_query($up_sql);
	}
}
?>
<link rel=stylesheet type=text/css href=include/style.css>
<style type="text/css">
<!--
.style1 {
	color: #666666;
	font-weight: bold;
}
-->
</style>
<html>
<head>
<title>AJ HYIP::: Admin Area</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<?php
	require 'include/top.php';
?>
<br>
<table border="0" align="center" width="80%" cellpadding="5" cellspacing="2">
<form name="frmStatistics" action="<?php $_SERVER['PHP_SELF']?>" method="post">
<tr bgcolor="#cccccc"><td colspan="2" class="style1">Site Statistics</td></tr>
<?php
	$stat_sql="select * from site_statistics";
	$stat_res=mysql_query($stat_sql);
	while($stat_row=mysql_fetch_array($stat_res)) {
?>
<tr bgcolor="#cccccc"><td class="style1"><?php=$stat_row['site_stat']?></td>
<td class="style1">
<?php
	if($stat_row['stat_id']==1 || $stat_row['stat_id']==6) {
?>
<input type="text" name="txtSiteval[]" value="<?php=$stat_row['site_val']?>" class="text">
<input type="hidden" name="statid[]" value="<?php=$stat_row['stat_id']?>">
<?php
	}
	else echo $stat_row['stat_id'];
?>

</td>
</tr>
<?php
}
?>
<tr><td colspan="2" align="center"><input type="submit" name="btn_Modify" value=" Modify " class="button"></td></tr>
</form>
</table>
<?php
	require 'include/footer.php';
?>
</body>
</html>
