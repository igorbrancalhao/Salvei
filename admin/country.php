<?php
/***************************************************************************
 *File Name				:country.php
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
$cat_id=$_GET['id'];
$mode=$_GET['mode'];
?>
<html>
<body>
<link href="include/style.css" rel="stylesheet" type="text/css">
<?php
require 'include/top.php';
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#cecfc8">
<tr><td>
<table border="0" cellpadding="0" cellspacing="0" width="760" align="center"  bgcolor="#E8E8E8">
<tr><td class="txt_users" height="24"><center>Country</center></td></tr>
<tr><td>
<table width="98%" border="0" cellpadding="5" cellspacing="1" class="border2" align="center">
<form name="country" method="post" action="addcountry.php">
         <tr bgcolor="#eeeee1">
        <td width="25%"><div align="center"><span ><b>Country</b> </span></div></td>
		
        <td width="27%"><div align="center"><span ><b>Edit</b></span></div></td>
        <td width="22%"><div align="center"><b>Delete</b></div></td>
		</tr>
<?php
if($mode=='delete')
{
$sql1="delete from country_master where country_id='$cat_id'";
$del=mysql_query($sql1);
if($del)
$message="Country Deleted Successfully";
else
$message="Country not deleted";
}
$mode='';
 if(!empty($message))
{
echo "<tr><td align=center colspan=3><font size=3 color=red>$message</font></td></tr>";
}
if($mode=='edit')
{
}
$sql="select * from country_master order by country asc";
$res=mysql_query($sql);
$row=mysql_fetch_array($res);
//print_r($row);
$countryid=$row['country_id'];
?>
<?php
	$total_records=mysql_num_rows($res);
	$curpage=$_GET['curpage'];
	if(strlen($_GET['curpage']) == 0) $curpage=1;
	$start=($curpage-1) * 10;
	$end=10;
	if($curpage==''|| $curpage==1)
	$i=1;
	else $i=$_GET['sno']+1;
	$sql.=" limit $start,$end";
	$res=mysql_query($sql);
 ?>


        <tr bgcolor="#eeeee1"> 
          <td align="right" colspan="5"> 
            <?php
	     if($curpage!=1) 
	     {
         ?>
            <a href="country.php?mode=<?php=$mode; ?>&curpage=<?php=($curpage-1);?>" id="link2">Prev</a> 
            | 
            <?php
            }
           ?>
            <?php
           if($total_records > ($start + $end)) 
		   {
           ?>
            <a href="country.php?mode=<?php=$mode; ?>&curpage=<?php=($curpage+1);?>" id="link2">Next</a> 
            <?php
            }
            ?>
          </td>
        </tr>

        <?php
         while($row=mysql_fetch_array($res))
        {
        ?>		
	   <tr bgcolor="eeeee1">
       	   <td height="41" align="left" style="padding-left:20px"><?php= $row['country'];?></td>
	   	   <td><div align="center" class="style3">
	    <a href="addcountry.php?id=<?php=$row['country_id']; ?>&mode=edit" style="text-decoration:none" id="link1">Edit</a></div></td>
	   <td><div align="center" class="style3">
	   <a href="country.php?id=<?php=$row['country_id']; ?>&mode=delete"  id="link1" style="text-decoration:none" onClick="javascript:return condelete();">Delete</a></div></td>
	   </tr>
	   <?php
         }
       ?>	
</td></tr>
	<tr bgcolor="eeeee1"><td align="center" colspan="3" style="text-align:center">
	<input type="submit" name="add" value="Add" class="button"></div>
	</td>
	
  </form>
</td>
	</tr>
</table></td></tr></table>
</td></tr></table>

<?php
	require 'include/footer1.php';
?>

</body></html>
<script language="JavaScript">
function condelete()
{
var confrm;
confrm=window.confirm("Are You sure you want to delete this country");
return confrm;
}
function cat_display()
{
document.country.action="change_display_order.php";
document.country.submit();
}

</script>