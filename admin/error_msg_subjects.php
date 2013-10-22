<?php
/***************************************************************************
 *File Name				:error_msg_subjects.php
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
/*
	Filename : mailsubjects.php
	Modified by :Shunmuga prasath
	Date : 16-07-2005
	Copyright AJSquare
	All rights Reserved
*/
 
?>
<style type="text/css">
<!--
.style1 {
	color: #666666;
	font-weight: bold;
}
.style3 {color: #666666; font-size: 11px; font-family:Arial, Helvetica, sans-serif}
-->
</style>
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#cecfc8">
<tr><td>
<table border="0" cellpadding="0" cellspacing="0" width="760" align="center"  bgcolor="#E8E8E8">
 <tr><td height="27" colspan="3" class="txt_users"><center>Error Subjects</center></td></tr>
  <tr><td>
<table width="98%" border="0" align="center" cellpadding="5" cellspacing="2" class="border2">
 
      <?php
$cansave=$_POST['canSave'];
if($cansave==1)
{
	$errid = $_POST['errid'];
/*

	$mailtitle = $_POST["txtTitle"];
	$mailfrom = $_POST["txtFrom"];
	$mailsubject = $_POST["txtSubject"];*/
	$errmsg = $_POST["txtBody"];
	$sql = "update error_message set err_msg='".$errmsg."' where err_id=".$errid;
	$result = mysql_query($sql);
	if($result)
	$message="Error Subject Edited Sucessfully";
	else
	$message="Please Try Again";
}
?>
      <?php
$edit = $_GET["edit"];
if($edit==1)
{
	$errid = $_GET['errid'];
	$sql = "select * from error_message where err_id = ".$errid;
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	$errid = $row["err_id"];
	$errmsg = $row["err_msg"];

?>
<tr><td colspan="2" align="center"><font color="#FF0000" face="Arial, Helvetica, sans-serif"><?php=$message; ?></font></td></tr>

	<tr bgcolor="#eeeee1">
        <td colspan=2 style="text-align:center"><b>Edit Error Subject</tr>
	<form name=form1 action="<?php $_SERVER['PHP_SELF']; ?>" method="post"  onSubmit="return Validate();">
	<tr bgcolor="#eeeee1">
          <td valign=top style="text-align:align="center"><b>Subject</b>
<td><textarea name=txtBody rows=5 cols=25><?php echo $errmsg; ?></textarea>
</td></tr>

	<tr bgcolor="#eeeee1"><td colspan=2 align=center style="text-align:center"><p> 
                <input name="submit" type=submit    class="button" value=" Save ">
                <input type=button value=" cancel " class="button" onclick=window.location.href='error_msg.php'>
              </p></td></tr>
	<input type=hidden name=errid value=<?php echo $errid; ?>>
	<input type=hidden name=canSave value=1>

	</form>

<?php
}
else 
{
 ?>

	<?php
		$sql = "select * from error_message";
		$result = mysql_query($sql);
	?>
	      <?php
	  	$total_records=mysql_num_rows($result);
	$curpage=$_GET['curpage'];
	if(strlen($_GET['curpage']) == 0) $curpage=1;
	$start=($curpage-1) * 10;
	$end=10;
	if($curpage==''|| $curpage==1)
	$i=1;
	else $i=$_GET['sno']+1;
	$sql.=" limit $start,$end";
	$result=mysql_query($sql);
//	echo $sql;
 ?>
 	<tr bgcolor="#eeeee1">
	<td><b> Edit</b></td><td><b>Subject</b></td></tr>
	        <tr bgcolor="#eeeee1"> 
          <td align="right" colspan="10"> 
            <?php
	if($curpage!=1) {
?>
            <a href="error_msg.php?mode=<?php=$mode; ?>&curpage=<?php=($curpage-1);?>" style="color:#484848;text-decoration:none">Prev</a> 
            | 
            <?php
}
?>
            <?php
if($total_records > ($start + $end)) {
?>
            <a href="error_msg.php?mode=<?php=$mode; ?>&curpage=<?php=($curpage+1);?>" style="color:#484848;text-decoration:none">Next</a> 
            <?php
}
?>
          </td>
        </tr>
<?php 
		while($row=mysql_fetch_array($result))
		{

?>

	<tr bgcolor="#eeeee1"><td width="25"><a  href=error_msg.php?edit=1&errid=<?php echo $row["err_id"];?> class="txt_details1">Edit</a>
	<td><?php echo (strlen($row["err_msg"])==0) ? "&nbsp;" : $row["err_msg"]; ?>
	
	</td></tr>
	
		<?php } 
		} ?>
	
</table></td></tr>
</table>
</td></tr>
<script language="JavaScript" type='text/javascript'>
function condelete()
{
var confrm;
confrm=window.confirm("Are You sure you want to delete this country");
return confrm;
}
function Validate()
 {

if(document.form1.txtBody.value=="")
{
		alert("Invalid Subject! Please re-enter.");
		document.form1.txtBody.focus();
		return false;
}
}
</script>