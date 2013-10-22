<?php
/***************************************************************************
 *File Name				:sell_item_cate.php
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
if($_POST[sell_format])
$_SESSION[sell_format]=$_POST[sell_format];

//if($mode=="")
if($_GET[mode])
{
$mode=$_GET[mode];
//$_SESSION[sell_format]=$_GET[sell_format];
}
else
{
$mode=$_POST[mode];
}
/*
 file name:sell_item_cat.php;
 date	  :5.7.05
 Created by:priya
 Rights reserved by AJ Square inc
*/
 
 /* $sell_format=$_POST[sell_format];
 $member_acc="select * from user_registration where user_id=$_SESSION[userid]";
 $memebr_rec=mysql_query($member_acc);
 $member_res=mysql_fetch_array($memebr_rec);
if($member_res[member_account]==2)
{
$no_of_post=5;
}
else if($member_res[member_account]==1)
{
$no_of_post=3;
}
if($member_res[member_account]==2 or $member_res[member_account]==1)
{
 $post="select * from placing_item_bid where user_id=$_SESSION[userid] and status='Active'";
 $post_res=mysql_query($post);
 $no_of_posted=mysql_num_rows($post_res);

if($no_of_posted>=$no_of_post)
{
$warning="Sorry !You Have Already Posted $no_of_posted Items.Please Select Superior Account to Post More Items!.";
}
} */
 $sql="select * from category_master where category_head_id=0"; 
 $res=mysql_query($sql);
 $cat_flag=$_POST[cat_flag];
 if($cat_flag==1)
 {
 $cat_id=$_POST[radio_cat];
 $sell_format=$_POST[sell_format];
 
 if(empty($cat_id))
 {
 $err_cat="Please Select Category";
 $err_flag=1;
 }
 else
 {
 if($_SESSION[sell_format]==4)
{
echo '<meta http-equiv="refresh" content="0;url=post_ad.php">';
echo "You have been Re-Directed, if not Please <a href=post_ad.php>Click here</a>";
exit();
}
  
  if($mode=="")
  {
   echo '<meta http-equiv="refresh" content="0;url=sell_item_detail.php?cat_id='.$cat_id.'&sell_format='.$sell_format.'">';
   echo "You have been Re-Directed, if not please <a href=sell_item_detail.php?cat_id=$cat_id&sell_format='$sell_format'>Click here</a>"; 
 }
 else if($mode=="change")
 {
 echo '<meta http-equiv="refresh" content="0;url=preview.php">';
 echo "You have been Re-Directed, if not please <a href=preview.php>Click here</a>"; 
 }
 $_SESSION[categoryid]=$cat_id;
 exit(); 
 }
  }
?>
<html>
<head>
<title>Sell Your Item step 1 of 5:Select Category</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

</head>
<body>
<?php require 'include/top.php'; ?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#cecfc8">
<tr><td>
<table width="95%" border="0" cellpadding="0" cellspacing="0" align="center"  class="border2">
 
  <link href="<?php= $ret1; ?>" rel="stylesheet" type="text/css">
  <?php if(!empty($warning))
  {
  ?>
  <tr align="center"><td>
  <br>
  <br>
  <br>
    <table cellpadding="0" cellspacing="0" width="50%" class="table_border1">
	<th class="mylist">
	 Oops! 
	</th>
  <tr>
  <td>
  <font size=2 color="red"><?php= $warning; ?></font>
  </td></tr> </table>
  <br>
  <br>
  <br>
   </td></tr>
  <tr><td> <?php require'include/footer.php'; ?> </td></tr>
  <?php
  exit();
  }
  ?>
  
<table width="93%" cellpadding="0" cellspacing="0" align="center" border="0" class="border2">
<tr><td>
<?php if($err_flag==1)
{ 
?>
<table width="100%" align="center"><tr><td>
<img src="images/warning_39x35.gif"></td><td>
<font size=2 color="red">The following must be corrected before continuing:</font></td>
<?php if(!empty($err_cat))
 {
 ?>
<tr><td>&nbsp;</td><td><a href="sell_item_cate.php#cat_form">Category</a> - <?php= $err_cat; ?></td></tr>

<?php 
}
?>
<tr><td colspan="2"><hr noshade class="hr_color" size="1"></td></tr>
</td>
</tr></table>
<?php
}
 ?>

 <tr>
    <td colspan=2 align="center" bgcolor="#CCCCCC" class="style1" height="35">
	<font size=+1 color="#000000"><b><br>Select Category</b></font>
	<br></td>
  </tr>
  
  <tr bgcolor="#eeeee1">
  <td> <br><font size="3">
<b> 1.Category </b>     2. Tittle & Description      3.Pictures & Details 4. Shipping Details & Sales Tax      5. Preview & Submit
</font></td></tr>
  
<tr class="mylist" bgcolor="#eeeee1"><td>
<font size="3"><b><br>&nbsp;&nbsp;Select from all categories</b></font>
<br>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
What type of item are you selling?. 
Select the best category to help buyers find your item. 
Select a top-level category &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;and click <b>Continue</b>.
</td ></tr>

<tr bgcolor="#eeeee1"><td><p><font size="3"><b><br>


  &nbsp;&nbsp;<font color="#FF0000"> * </font> Main Category</b></font></p>
    </td></tr>
<tr bgcolor="#eeeee1"><td>
<form name="cat_form" action="sell_item_cate.php" method="post">
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#cecfc8">
<tr><td>
<table cellpadding="3" cellspacing="3" class="border2" width=100% border="0">
<?php  
$color=1;
 while($rec=mysql_fetch_array($res))
{ 
if($color==1)
{
$color=0;
?>
<tr bgcolor="#eeeee1">
<?php
}
else if($color==0)
{
$color=1;
 ?>
 <tr bgcolor="#eeeee1">
 <?php 
 }
  if( $rec[category_id] == $_SESSION[categoryid])
 {
 ?>
 <td><input type="radio" name="radio_cat" value="<?php=$rec[category_id];?>" checked></td><td>
 <?php=$rec[category_name]; ?> </td>
 <?php
 }
 else
 {
 ?>
 <td><input type="radio" name="radio_cat" value=<?php=$rec[category_id]; ?>></td><td>
 <?php=$rec[category_name]; ?> </td>
 <?php
 }
 ?>
 <td>
 <?php 
							$sub_count="1";
                            $sub="select * from category_master where category_head_id=".$rec['category_id'];
				        	$sub_res=mysql_query($sub);
							$tot_sub=mysql_num_rows($sub_res);
   						    while($sub_rec=mysql_fetch_array($sub_res))
							{
							$sub_count=$sub_count+1;
							echo $sub_rec[category_name];
							if($tot_sub>$sub_count)
							{
							echo " , ";
							}
					

}
  ?>
  </td></tr>
  <?php 
  }
  // }
  ?></table>
</td></tr>
<input type="hidden" name=cat_flag value=1>
<input type="hidden" name=mode value=<?php= $mode ?>>
<input type="hidden" name=sell_format value="<?php= $sell_format; ?>">
<tr bgcolor="#eeeee1"><td align="center">
<?php if($mode=="")
{ ?>
<input type="submit" name=catsub value="Continue" class="buttonbig">
<?php
 }
else if($mode=="change")
{
 ?>
<input type="submit" name=catsub value="SaveChanges" class="buttonbig">
<?php 
} 
?>

</td></tr>
<tr align="center"><td><?php require 'include/footer.php'?></td></tr>
</table>
</form>
</td></tr>
</table>
  </body>
</html>
