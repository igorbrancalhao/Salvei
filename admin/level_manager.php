<?php
/***************************************************************************
 *File Name				:level_manager.php
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
	require '../include/connect.php';
	$type=$_GET['type'];
	$level_query="select * from level_commission";
	$level_result=mysql_query($level_query);
?>
<style type="text/css">
<!--
.style1 {font-weight: bold}
-->
</style>
<?php
	if($type=='edit' || $type=='new') {
		$id=$_GET['id'];
		$canChange=$_POST['canChange'];
		if($canChange==1) {
			$levelname=$_POST['txtLevelname'];
			$commission=$_POST['txtLevelcommission'];
			if($type=="edit")
			$sql="update level_commission set level_name='$levelname',level_commission='$commission' where level_id=$id";
			else
			$sql="insert into level_commission(level_name,level_commission) values('$levelname','$commission')";
			$result=mysql_query($sql);
			echo '<meta http-equiv="refresh" content="0;url=site.php?page=level">';
			exit();
		}
			if($type=="edit") {
				$sql="select * from level_commission where level_id=$id";
				$result=mysql_query($sql);
				$row=mysql_fetch_array($result);
			}
?>
<table border="0" align="center" width="80%" cellpadding="5" cellspacing="2" class="tablebox">
<form name="frmLevel" action="<?php $_SERVER['PHP_SELF']?>" method="post" onSubmit="this.canChange.value=1;">
<tr bgcolor="#CCCCCC" class="style1"><td colspan="2"><?php if($type=="edit") echo 'Edit';else echo 'Add New';?> Level Manager</td></tr>
<tr bgcolor="eeeee1"><td>Level Name</td><td><input type="text" name="txtLevelname" value="<?php=$row['level_name']?>"></td></tr>
<tr bgcolor="eeeee1"><td>Level Commission</td><td><input type="text" name="txtLevelcommission" value="<?php=$row['level_commission']?>"></td></tr>
<tr><td colspan="2" align="center">
<input type="hidden" name="canChange" value="0"><input type="submit" name="btn_Change" value="Change" class="button">
</td></tr>
</form>
</table>
<?php		
	}
	else {
?>
<table border="0" align="center" width="80%" cellpadding="5" cellspacing="2" class="tablebox">
<tr bgcolor="#CCCCCC" class="style1"><td colspan="3"> Level Manager</td></tr>
<tr>
  <td colspan="3">
  Here you can Set your Level Commission Details.
  </td>
</tr>
<tr bgcolor="#CCCCCC" class="style1"><td align="center"><b>Level</b></td>
<td align="center" colspan="2"><b>Commission</b></td>
</tr>
<?php
	while($level_row=mysql_fetch_array($level_result)) {
?>
<tr bgcolor="eeeee1"><td align="center"><?php=$level_row['level_name']?></td><td align="center"><?php=$level_row['level_commission']?></td><td align="center"><a href="site.php?page=level&type=edit&id=<?php=$level_row['level_id']?>" id="link2">Edit</a></td></tr>
<?php
	}
?>
<tr>
  <td colspan="3" align="left"><a href="site.php?page=level&type=new" id="link2">Add New</a></td>
  </tr>
</table>
<?php
	}
?>
