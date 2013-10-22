<?php
/***************************************************************************
 *File Name				:site_manager.php
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
	/*if(isset($_POST['but_Hide'])) {
		$cj_sql="select * from site_manager where status='yes'";
		$cj_res=mysql_query($cj_sql);
		while($cj_row=mysql_fetch_array($cj_res)) {
			$id=$cj_row['feature_id'];
			$up_sql="update site_manager set status='no' where feature_id=$id";
			$up_res=mysql_query($up_sql);
		}
	}
	if(isset($_POST['but_Show'])) {
		$cj_sql="select * from site_manager where status='no'";
		$cj_res=mysql_query($cj_sql);
		while($cj_row=mysql_fetch_array($cj_res)) {
			$id=$cj_row['feature_id'];
			$up_sql="update site_manager set status='yes' where feature_id=$id";
			$up_res=mysql_query($up_sql);
		}
	}
	if(isset($_POST['but_Hidesel'])) {
		$fid=$_POST['chkSub'];
		foreach($fid as $id) {
			$up_sql="update site_manager set status='no' where feature_id=$id";
			$up_res=mysql_query($up_sql);
		}
	}
	if(isset($_POST['but_Showsel'])) {
		$fid=$_POST['chkSub'];
		foreach($fid as $id) {
			$up_sql="update site_manager set status='yes' where feature_id=$id";
			$up_res=mysql_query($up_sql);
		}
	}
*/
if(isset($_POST['btnShowall']))
{
	$usql="Update site_manager set status='yes'";
	$ures=mysql_query($usql);
}
if(isset($_POST['btnHideall']))
{
	$usql="Update site_manager set status='no'";
	$ures=mysql_query($usql);
}
if(isset($_POST['btnSave']))
{
$co_res=mysql_query("select * from site_manager");
$count=mysql_num_rows($co_res);
$rdarr=array($_POST['rdVal1'],$_POST['rdVal2'],$_POST['rdVal3'],$_POST['rdVal4'],$_POST['rdVal5'],$_POST['rdVal6'],$_POST['rdVal7'],$_POST['rdVal8'],$_POST['rdVal9']);
for($i=0;$i<$count;$i++)
{
$j=$i+1;
$selsql="update site_manager set status='$rdarr[$i]' where feature_id=$j";
$selres=mysql_query($selsql);
}
}
?>
<table border="0" align="center" width="80%" cellpadding="5" cellspacing="2" class="tablebox">
<tr bgcolor="#CCCCCC" class="style1"><td colspan="2"> Site Manager</td></tr>
<tr>
  <td colspan="2">
  Here you can Enable or Disable Additional Features that normally comes with HYIP.
  </td>
</tr>
<!--<tr><td><a href="site_manager.php?type=cs">Currently Showing</a></td><td><a href="site_manager.php?type=ns">Not Showing</a></td></tr> -->
<?php
	$type=$_GET['type'];
	if(!$type) $type='cs';
?>
<tr>
  <td colspan="2">
  <table border="0" align="center" cellpadding="5" cellspacing="2" width="100%">
  <form name="frmSite" action="<?php $_SERVER['PHP_SELF']?>" method="post">
  <tr bgcolor="#CCCCCC" class="style1"><td align="left"><b>Feature</b></td>
  <td align="left"><b>Description</b></td>
  <td align="left" colspan="2"><b>&nbsp;&nbsp;&nbsp;&nbsp;Select</b><br>Show&nbsp;&nbsp;&nbsp;&nbsp;Hide</td></tr>
  <?php
		//if($type=='cs') 
		$sql="select * from site_manager";
		//else if($type=='ns') $sql="select * from site_manager where status='no'";
		$result=mysql_query($sql);
		$i=1;
		while($row=mysql_fetch_array($result)) {
  ?>
  <tr bgcolor="eeeee1"><td align="left"><b><?php=$row['feature_name']?></b></td><td align="left"><b><?php=$row['description']?></b></td>
  <td align="center">
  <?php if($row['status']=='yes') { ?>
  <input type="radio" name="rdVal<?php=$i; ?>" value="yes" checked><?php } else { ?><input type="radio" name="rdVal<?php=$i; ?>" value="Yes"><?php } ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?php if($row['status']=='no') { ?>
	<input type="radio" name="rdVal<?php=$i; ?>" value="no" checked><?php } else { ?><input type="radio" name="rdVal<?php=$i; ?>" value="no"><?php } ?>
</td></tr>
  <?php
  		$i++;
		}
  ?>
  <tr><td colspan="2" align="right"><input type="submit" name="btnShowall" value="Show All" class="button">&nbsp;&nbsp;<input type="submit" name="btnHideall" value="Hide All" class="button">&nbsp;&nbsp;<input type="submit" name="btnSave" value="  Save  " class="button"></td></tr>
  </form>
  </table>
  </td>
  </tr>
</table>
</body>
</html>
<script language="javascript">
function chkall(frm,val)
{
	if(frm.chkMain.checked==true) val=1;
	else if(frm.chkMain.checked==false) val=0;
	if(!frm.chkSub.length) {
	frm.chkSub.checked = val;
	}
	else {
	for(i=0;i<frm.chkSub.length;i++)
	frm.chkSub[i].checked = val;
	}
	}
</script>