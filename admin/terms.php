<?php
/***************************************************************************
 *File Name				:terms.php
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
require 'include/top.php';
?>
<?php
if(isset($_REQUEST['update1']))
{
 $query = "update terms set term_body='$_REQUEST[registration]' where term_id='1' ";
if(mysql_query($query))
echo "<table bgcolor=#cecfc8 width=100%><tr><td align=center><font color='#ff0000'><strong>   Updated Successfully ! </strong></font></td></tr></table>";
}

if(isset($_REQUEST['update2']))
{
 $query = "update terms set term_body='$_REQUEST[selling]' where term_id='2' ";
if(mysql_query($query))
echo "<br><font color='#ff0000'><strong>  Selling Detail Updated On Successfully ! </strong></font><br><br>";
}

if(isset($_REQUEST['update3']))
{
 $query = "update terms set term_body='$_REQUEST[buying]' where term_id='3' ";
if(mysql_query($query))
echo "<br><font color='#ff0000'><strong>  Buying Detail Updated On Successfully ! </strong></font><br><br>";
}
?>



<!-- <table align="center" width="100%" height="35" bgcolor="#FFCF00">
<tr><td align="center"><a href="terms.php?page=1" id="link3"><strong>Registration Terms</strong></a></td>
<td align="center"><a href="terms.php?page=2" id="link3"><strong>Selling Terms</strong></a></td>
<td align="center"><a href="terms.php?page=3" id="link3"><strong>Buying Terms</strong></a> </td>  </tr>    
</table> -->

<?php 
if($_REQUEST['page']==1)
{
?>   
<?php
$query="select * from terms where term_id=1";
$tab=mysql_query($query);
if($row=mysql_fetch_array($tab))
{
$registration=$row['term_body'];
}
?>
<table border="0" align="0"  width="100%" height="100" bgcolor="#cecfc8" cellpadding="0" cellspacing="0">
<tr><td>
<table border="0" align="center" cellpadding="5" cellspacing="2" width="760" bgcolor="#E8E8E8" height="100%">
<tr>
<td colspan="4" class="txt_users" height="24"><center>Registration Terms</center></td></tr>
<tr><td>
<table width="98%"  border="0" cellpadding="0" cellspacing="2" class="border2" align="center">
<form name="frmsearch" action="<?php= $_SERVER['php_self'] ?>" method="post">
<tr bgcolor="eeeee1"><td><Strong>Registration Terms </strong></td><td><textarea name="registration" cols=50 rows=10><?php= $registration; ?></textarea></td></tr>
<input type="hidden" name="term_id" value="1">
<tr bgcolor="#eeeee1"><td colspan="2" style="text-align:center"><input type="submit" name="update1" value="Update" class="button" value="<?php= $submit; ?>" onclick="return val();">
</td></tr>
</table></td></tr></table>
<?php
}
if($_REQUEST['page']==2)
{
?>
<?php
$query="select * from terms where term_id=2";
$tab=mysql_query($query);
if($row=mysql_fetch_array($tab))
{
$selling=$row['term_body'];
}
?>
<table width="80%"  border="0" cellpadding="5" cellspacing="1" class="tablebox" align="center">
<form name="frmsearch" method="post">
<tr bgcolor="#CCCCCC" class="style1">
<td colspan="4">Selling Terms</td>
<tr bgcolor="#eeeee1"><td><Strong>Selling Terms </strong></td><td><textarea name="selling" cols=50 rows=10><?php= $selling; ?></textarea></td></tr>
<input type="hidden" name="term_id" value="2">
<tr bgcolor="#eeeee1"><td colspan="2" style="text-align:center"><input type="submit" name="update2" value="Update" class="button" value="<?php= $submit; ?>"> </td></tr>
</table>
<?php
}
if($_REQUEST['page']==3)
{
?>
<?php
$query="select * from terms where term_id=3";
$tab=mysql_query($query);
if($row=mysql_fetch_array($tab))
{
$buying=$row['term_body'];
}
?>
<table width="80%"  border="0" cellpadding="0" cellspacing="2" class="tablebox" align="center">
<form name="frmsearch" method="post">
<tr bgcolor="#CCCCCC" class="style1">
<td colspan="4">Buying Terms</td>
<tr bgcolor="#eeeee1"><td><Strong>Buying Terms </strong></td><td><textarea name="buying" cols=50 rows=10><?php= $buying; ?></textarea></td></tr>
<input type="hidden" name="term_id" value="3">
<tr bgcolor="#eeeee1"><td colspan="2" style="text-align:center"><input type="submit" name="update3" value="Update" class="button" value="<?php= $submit; ?>"> </td></tr>
</table>


<?php
}
?>
<?php require 'include/footer1.php'; ?>
</body>
</html>
<script language="javascript">
function val()
{
	if(frmsearch.registration.value=="")
	{
		alert("Please Enter the Terms");
		frmsearch.registration.focus();
		return false;
	}
	return true;
}
</script>
