<?php
/***************************************************************************
 *File Name				:report.php
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

session_start();
require 'include/connect.php';
require 'include/top.php';
$page_query="select * from admin_settings where set_id=22";
$page_table=mysql_query($page_query);
if($page_row=mysql_fetch_array($page_table));
$page_length=$page_row['set_value'];
?>
<table border="0" align="center" cellpadding="0" cellspacing="0" width="100%" background="images/bg08.jpg">
<tr><td>
<table border="0" width="96%" align="center">
<tr><td width="93"><table id="Table_01" width="93"  border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td><img src="images/index_02_03_03_01.jpg" width="93" height="26" alt=""></td>
                    </tr>
                    <tr>
 <td><a href="user.php"><img src="images/index_02_03_03_02.jpg" width="93" height="70" alt="" border="0" title="UserManagement"></a></td>
                    </tr>
                    <tr>
                      <td><a href="site.php"><img src="images/index_02_03_03_03.jpg" width="93" height="71" alt="" border="0" title="GeneralSettings"></a></td>
                    </tr>
                    <tr>
  <td><a href="site.php?page=bid"><img src="images/index_02_03_03_04.jpg" width="93" height="73" alt="" border="0" title="Bid increment Settings"></a></td>
                    </tr>
                <tr>
  <td><a href="report.php?page=reven"><img src="images/index_02_03_03_05.jpg" width="93" height="71" alt="" border="0" title="DetailReport"></a></td>
                    </tr>
                    <tr>
  <td><a href="store_manager.php"><img src="images/index_02_03_03_06.jpg" width="93" height="70" alt="" border="0" title="StoreManager"></a></td>
                    </tr>
                    <tr>
                      <td><a href="bulk_load.php"><img src="images/index_02_03_03_07.jpg" width="93" height="66" alt="" border="0" title="BulkLoader"></a></td>
                    </tr>
                </table></td><td width=793>
<table align="center" width="98%" height="35">
<tr>
<!-- <td align="center"><a href="report.php?page=out" id="link3">Outstanding Acounts</a></td> -->
<td align="center"><a href="report.php?page=reven" class=txt_users>Revenue</a></td>
<td align="center"><a href="report.php?page=top" class=txt_users>Top Sellers</a></td>
<td align="center"><a href="report.php?page=user" class=txt_users>Users Online</a></td>
</tr>
</table>
<br><br>
<?php
//if page= outstanding
if($_REQUEST['page']=="reven")
{
?>
<center><strong>Members Who have Paid the amount  comes under  Revenue List.</strong></center>
<br>
<?php
$query="select * from user_registration a , pay_transaction b where a.user_id = b.user_id group by b.user_id";
$tab=mysql_query($query);
if(mysql_num_rows($tab)==0)
{
 echo "<table width=98%>";
 echo "<tr  height=30 bgcolor=#CCCCCC><td align=center>";
 echo "<strong> No Rows Selected <strong>";
 echo "</td></tr></td></tr></table>";
 echo "</td></tr></table></td></tr></table>";
 require 'include/footer.php';
 exit();
}
?>




<?php

$total=mysql_num_rows($tab);
$totalx=($total/$page_length);

$reminder=($total%$page_length);
settype($totalx,'int');

if(($reminder==0)&&($total!=0))
$totalx=$totalx-1;

$set=$_REQUEST['set'];
if($set=="")$set=0;
$href ="report.php?";
$href .="&page=" .$_REQUEST['page'];

$href.="&set=";
?>
<table width="96%" align="center">
<tr bgcolor=#CCCCCC><td colspan="8" align="center" >
<b>There are <?php= $total; ?> Row Selected.</b>
</td>
<td>
<?php if($set!=0){ ?>  <a href="<?php=$href.($set-1) ?>  style="text-decoration:none"  id="link1"">  <?php }?>    Prev <?php if($set!=0) {?> </a>  <?php }?>
</td><td>
<?php if($set!=$totalx){ ?>  <a href="<?php=$href.($set+1) ?>  style="text-decoration:none"  id="link1"">  <?php }?>     Next  <?php if($set!=$totalx) {?> </a> <?php }?>
</td></tr>
</table>
<table align="center" width="96%" class="tablebox">
<tr bgcolor="#CCCCCC" >
<td align="center" class="txt_bold">Serial No</td>
<td align="center" class="txt_bold">User Name</td>
<td align="center" class="txt_bold">Email</td>
<!--<td align="center" class="txt_bold">Membership Account</td>-->
<td align="center" class="txt_bold">Date of Join</td>
<!--<td align="center" class="txt_bold">Payment Date</td>-->
<td align="center" class="txt_bold">Amount</td>
</tr>


<?php
$start= $set*$page_length +1;
$end=$set*$page_length +$page_length;
$i=0;
while($row=mysql_fetch_array($tab))
{
$sql_tot="select sum(trans_amount) as amt from pay_transaction where user_id=".$row['user_id'];
$sqlqry_tot=mysql_query($sql_tot);
$sqlfetch_tot=mysql_fetch_array($sqlqry_tot);
$tot_amount=$sqlfetch_tot['amt'];

$i++;
if(($i<$start)||($i>$end))
continue;
?>
<tr bgcolor="#eeeee1">
<td class="txt_sitedetails"><?php= $i; ?></td>

<?php 
 $seller_query="select * from user_registration where user_id ='$row[user_id]'";
 $seller_tab=mysql_query($seller_query);
 if($seller_row=mysql_fetch_array($seller_tab))
 $seller_name=$seller_row['user_name'];
 if($seller_row['member_account']==2)
 $account="Basic";
 else if($seller_row['member_account']==3)
 $account="Superior";
?>
<td class="txt_sitedetails"><?php= $seller_name; ?></td>
<td class="txt_sitedetails"><?php= $seller_row['email']; ?></td>
<td class="txt_sitedetails"><?php= $seller_row['date_of_registration']; ?></td>
<!--<td class="txt_sitedetails"><?php= $row['payment_date']; ?></td>-->
<td class="txt_sitedetails"><?php= $tot_amount; ?></td>
</tr>
<?php
}
?>

<tr>
<td colspan="8" >
</td>
</tr>
</table>
</td></tr></table>
<?php
}
if($_REQUEST['page']=="out")
{
?>
<center><strong>Members Who have not Paid the amount comes under Outstanding Account.</strong></center>
<br>
<?php
$query="select * from user_registration a , admin_earnings b where a.user_id != b.user_id group by b.user_id";
$tab=mysql_query($query);
$tot_records=mysql_num_rows($tab);
?>
<?php
if(mysql_num_rows($tab)==0)
{
 echo "<table width=98% align=center>";
 echo "<tr  height=30 bgcolor=#CCCCCC><td align=center>";
 echo "<strong> No Rows Selected <strong>";
 echo "</td></tr>";
 echo "</td></tr></table></td></tr></table>";
 require 'include/footer.php';
 //echo "</td></tr>";
 //echo "</table>";
 exit();
}
?>
<?php
$total=mysql_num_rows($tab);
$totalx=($total/$page_length);
$reminder=($total%$page_length);
settype($totalx,'int');
if(($reminder==0)&&($total!=0))
$totalx=$totalx-1;
$set=$_REQUEST['set'];
if($set=="")$set=0;
$href ="report.php?";
$href .="&page=" .$_REQUEST['page'];
$href.="&set=";
?>
<table width="96%" align="center">
<tr bgcolor=#CCCCCC><td colspan="8" align="center" >
<b>There are <?php= $total; ?>  Row Selected.</b>
</td>
<td>
<?php if($set!=0){ ?>  <a href="<?php=$href.($set-1) ?>  style="text-decoration:none"  id="link1"">  <?php }?>    Prev <?php if($set!=0) {?> </a>  <?php }?>
</td><td>
<?php if($set!=$totalx){ ?>  <a href="<?php=$href.($set+1) ?>  style="text-decoration:none"  id="link1"">  <?php }?>     Next  <?php if($set!=$totalx) {?> </a> <?php }?>

</td></tr>
</table>

<table align="center" width="96%" class="tablebox">
<tr bgcolor="#CCCCCC">
<td align="center" class="txt_bold">Serial No</td>
<td align="center" class="txt_bold">User Name</td>
<td align="center" class="txt_bold">Email</td>
<td align="center" class="txt_bold">Membership Account</td>
<td align="center" class="txt_bold">Date of Join</td>
<td align="center" class="txt_bold">Payment Date</td>
<td align="center" class="txt_bold">Amount</td>
</tr>


<?php
$start= $set*$page_length +1;
$end=$set*$page_length +$page_length;
$i=0;
while($row=mysql_fetch_array($tab))
{
$i++;
if(($i<$start)||($i>$end))
continue;
?>
<tr bgcolor="#eeeee1">
<td class="txt_sitedetails"><?php= $i; ?></td>
<?php 
 /*$item_query="select * from placing_item_bid where item_id ='$row[item_id]'";
 $item_tab=mysql_query($item_query); 
if($item_row=mysql_fetch_array($item_tab))
 $item_name=$item_row['item_title']; */
?>

<?php 
 $seller_query="select * from user_registration where user_id ='$row[user_id]'";
 $seller_tab=mysql_query($seller_query);
 if($seller_row=mysql_fetch_array($seller_tab))
 $seller_name=$seller_row['user_name'];
 if($seller_row['member_account']==2)
 $account="Basic";
 else if($seller_row['member_account']==3)
 $account="Superior";
?>
<td class="txt_sitedetails"><?php= $seller_name; ?> </td>
<td class="txt_sitedetails"><?php= $seller_row['email']; ?> </td>
<td class="txt_sitedetails"><?php= $account; ?></td>

<td class="txt_sitedetails"><?php= $seller_row['date_of_registration']; ?> </td>
<td class="txt_sitedetails"><?php= $row['payment_date']; ?> </td>
<td class="txt_sitedetails"><?php= $row['amount']; ?> </td>
</tr>

<?php
}
?>
<tr>
<td colspan="8" >
</td>
</tr>
</table>
</td></tr></table>
<?php
}
if($_REQUEST['page']=="top")
{
//finding Number of top seller from admin settings
$myquery="select * from admin_settings where set_id = 21";
$mytab=mysql_query($myquery);
if($row=mysql_fetch_array($mytab))
$range=$row['set_value'];

//
?>
<strong><center>Members who have Posted items more than or equal to <?php=$range?> come under Top Seller List</center></strong>
<br>

<?php

if(!empty($range))
{
 $query="SELECT user_id, count( user_id ) count_user FROM placing_item_bid  GROUP BY user_id having count(user_id) >=$range ORDER BY count_user DESC";
$tab=mysql_query($query);
$num_rows=mysql_num_rows($tab);
}
if(empty($range))
$num_rows=0
?>

<?php
if($num_rows==0)
{
 echo "<table width=100% >";
 echo "<tr  height=30 ><td  align=center >";
 echo "<strong> No Sellers meet the Top sellers criteria <strong>";
 echo "</td></tr>";
 echo "</td></tr></table></td></tr></table>";
 require 'include/footer.php';
// echo "</td></tr>";
 //echo "</table>";
 exit();
}
?>


<?php

$total=mysql_num_rows($tab);
$totalx=($total/$page_length);

$reminder=($total%$page_length);
settype($totalx,'int');

if(($reminder==0)&&($total!=0))
$totalx=$totalx-1;

$set=$_REQUEST['set'];
if($set=="")$set=0;
$href ="report.php?";
$href .="page=" .$_REQUEST['page'];
$href.="&set=";
?>
<table width="96%" align="center">
<tr bgcolor=#CCCCCC><td colspan="8" align="center" >
<!--<b>There are <?php= $total; ?> Row Selected.</b>-->
</td>
<td>
<?php if($set!=0){ ?>  <a href="<?php=$href.($set-1) ?>  style="text-decoration:none"  id="link1"">  <?php }?>    Prev <?php if($set!=0) {?> </a>  <?php }?>
</td><td>
<?php if($set!=$totalx){ ?>  <a href="<?php=$href.($set+1) ?>  style="text-decoration:none"  id="link1"">  <?php }?>     Next  <?php if($set!=$totalx) {?> </a> <?php }?>

</td></tr>
</table>
<table align="center" width="96%" class="border2">
<tr bgcolor="#CCCCCC">
<td align="center" class="txt_bold">Serial No</td>
<td align="center" class="txt_bold">User Id</td>
<td align="center" class="txt_bold">No .of items posted</td>
<td align="center" class="txt_bold">User Name</td>
<td align="center" class="txt_bold">Email Address </td>
<td align="center" class="txt_bold"> Country</td>
</tr>

<?php
$count=mysql_num_rows($tab);
$i=1;

$start= $set*$page_length +1;
$end=$set*$page_length +$page_length;
$w=0;
while($row=mysql_fetch_array($tab))
{
$w++;
if(($w<$start)||($w>$end))
continue;

$user_query="select * from user_registration where user_id = '$row[user_id]'";
$user_tab=mysql_query($user_query);
$user_row=mysql_fetch_array($user_tab);
?>
<tr bgcolor="#eeeee1">
<td class="txt_sitedetails"><?php= $i++; ?></td>
<td class="txt_sitedetails"><?php= $row['user_id']; ?></td>
<td class="txt_sitedetails"><?php= $row['count_user']; ?></td>
<td class="txt_sitedetails"><?php= $user_row['user_name']; ?></td>
<td class="txt_sitedetails"><?php= $user_row['email']; ?></td>
<?php
$country_query="select * from country_master where country_id ='$user_row[country]'";
$country_tab=mysql_query($country_query);
$country_row=mysql_fetch_array($country_tab);
?>
<td class="txt_sitedetails"> <?php= $country_row['country'] ?></td>
</tr>
<?php
}
?>
<tr>
<td colspan="8" >
</td>
</tr>
</table>
<br><br>
</td></tr></table>

<?php
}
if($_REQUEST['page']=="user")
{
?>


<strong><center>Members Who have Currently Login to our Site come under Users Online</center></strong>
<br>
<?php
$query="SELECT * from user_registration where onlinestatus='online'";
$tab=mysql_query($query);
?>
<?php
if(mysql_num_rows($tab)==0)
{
 echo "<table width=100% >";
 echo "<tr  height=30 ><td  align=center >";
 echo "<strong> No Rows Selected <strong>";
 echo "</td></tr>";
 echo "</td></tr></table></td></tr></table>";
 require 'include/footer.php';
 //echo "</td></tr>";
 //echo "</table>";
 exit();
}


$total=mysql_num_rows($tab);
$totalx=($total/$page_length);

$reminder=($total%$page_length);
settype($totalx,'int');

if(($reminder==0)&&($total!=0))
$totalx=$totalx-1;

$set=$_REQUEST['set'];
if($set=="")$set=0;
$href ="report.php?";
$href .="&page=" .$_REQUEST['page'];

$href.="&set=";
?>
<table width="96%" align="center">
<tr bgcolor=#CCCCCC><td colspan="8" align="center" >
<b>There are <?php= $total; ?> Row Selected.</b>
</td>
<td>
<?php if($set!=0){ ?>  <a href="<?php=$href.($set-1) ?>  style="text-decoration:none"  id="link1"">  <?php }?>    Prev <?php if($set!=0) {?> </a>  <?php }?>
</td><td>
<?php if($set!=$totalx){ ?>  <a href="<?php=$href.($set+1) ?>  style="text-decoration:none"  id="link1"">  <?php }?>     Next  <?php if($set!=$totalx) {?> </a> <?php }?>

</td></tr>
</table>






<table align="center" width="96%" class="border2">
<tr bgcolor="#CCCCCC">
<td align="center" class="txt_bold">Serial No</td>
<td align="center" class="txt_bold">User Id</td>
<td align="center" class="txt_bold">User Name</td>
<td align="center" class="txt_bold">Email Address </td>
<td align="center" class="txt_bold"> Country</td>
</tr>
<?php

$start= $set*$page_length +1;
$end=$set*$page_length +$page_length;
$i=0;
while($row=mysql_fetch_array($tab))
{
$i++;
if(($i<$start)||($i>$end))
continue;
?>
<tr bgcolor="#eeeee1">
<td class="txt_sitedetails"><?php= $i ?></td>
<td class="txt_sitedetails"><?php= $row['user_id']; ?></td>
<td class="txt_sitedetails"><?php= $row['user_name']; ?></td>
<td class="txt_sitedetails"><?php= $row['email']; ?></td>
<?php
$country_query="select * from country_master where country_id ='$row[country]'";
$country_tab=mysql_query($country_query);
$country_row=mysql_fetch_array($country_tab);
?>
<td class="txt_sitedetails"> <?php= $country_row['country'] ?></td>
</tr>
<?php
}
?>
<tr>
<td colspan="8" >
</td>
</tr>
</table>
<br><br>
</td></tr></table>
<?php
}
?>
</td></tr></table></td></tr></table>
<?php require 'include/footer.php'; ?>


