<?php
/***************************************************************************
 *File Name				:trusted.php
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
$page_query="select * from admin_settings where set_id=22";
$page_table=mysql_query($page_query);
if($page_row=mysql_fetch_array($page_table));
$page_length=$page_row['set_value'];
$del_id=$_REQUEST['ckbox'];
$del=1;
if(isset($_REQUEST['modify_all']))
{
$del="update user_registration set trusted='trusted' where status='active' and trusted='active'";
$res=mysql_query($del);
echo "<b><font color='#ff0000'> All Rows Updated On Successfully  </font></b>";
}
if(isset($_REQUEST['modify'])&& ( count($del_id) >= 1 ) )
{
$w=0;
foreach($del_id as $del_id1)
{
$w++;
$del="update user_registration set trusted='trusted' where user_id=$del_id1";
$res=mysql_query($del);
}
echo "<b> $w Rows Updated On Successfully </b>";
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<table width="100%"><tr><td>
<table align="center" width="100%" height="35" bgcolor="#FFCF00">

<td align="center"><strong> InActive Trusted User </strong></td>
</tr>
</table>
<br>
<center><strong>
Memers who have Paid amount for Trusted Seal and not activate by administrator come under Inactive Trusted User.
</strong></center>	
<?php
$myquery="select * from user_registration where status='active' and trusted='active'";
$table=mysql_query($myquery);
if(mysql_num_rows($table)==0)
{
echo "<br><br><center><strong> No Rows Selected. </strong></center>";
}
else
{
?>
<br>
<?php

$total=mysql_num_rows($table);
$totalx=($total/$page_length);

$reminder=($total%$page_length);
settype($totalx,'int');

if(($reminder==0)&&($total!=0))
$totalx=$totalx-1;

$set=$_REQUEST['set'];
if($set=="")$set=0;
$href ="trusted.php?";
$href.="set=";
?>
<table width="90%" align="center">
<tr><td colspan="8" align="center" >
<b> <?php= $total; ?>  Rows Selected.</b>
</td>
<td>
<?php if($set!=0){ ?>  <a href="<?php=$href.($set-1) ?>  style="text-decoration:none"  id="link1"">  <?php }?>    Prev <?php if($set!=0) {?> </a>  <?php }?>
</td><td>
<?php if($set!=$totalx){ ?>  <a href="<?php=$href.($set+1) ?>  style="text-decoration:none"  id="link1"">  <?php }?>     Next  <?php if($set!=$totalx) {?> </a> <?php }?>

</td></tr>
</table>


<table align="center" width="70%" class="tablebox">
<tr bgcolor="#CCCCCC" class="style1">
<td align="center">User Id</td>
<td align="center">User Name</td>
<td align="center">Trusted</td>
</tr>
<form action="<?php= $_SERVER['php_self'] ?>" method="post" >
<?php

if(mysql_num_rows($table)>=1)
{
$start= $set*$page_length +1;
$end=$set*$page_length +$page_length;
$i=0;
   while($row=mysql_fetch_array($table))
   { 
   $i++;
if(($i<$start)||($i>$end))
continue;
?>
<tr  bgcolor="#eeeee1">
<td align="center"><?php= $row['user_id'] ?></td>
<td align="center"><?php= $row['user_name'] ?></td>
<td align="center"><input type="checkbox" name="ckbox[]" value="<?php= $row['user_id'];  ?>">Change as Trusted User</td>
</tr>  
<?php
   }
}

?>
<tr><td align="right" colspan="3"> <input type="submit" name="modify_all" value=" Moify All " class="button"> &nbsp;&nbsp;
<input type="submit" name="modify" value=" Moify " class="button"></td></tr>
</table>
</form>
<?php
}
?>
<br><br>
<?php require 'include/footer.php'; ?>
</body>
</html>
