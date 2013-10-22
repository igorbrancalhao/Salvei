<?php
/***************************************************************************
 *File Name				:store_manager.php
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
<?php session_start(); ?>
<style type="text/css">
<!--

.style1 {
	color: #666666;
	font-weight: bold;
}
.style3 {color: #666666; font-size: 11px; font-family:Arial, Helvetica, sans-serif}
-->
</style>
<!--<link href="include/style.css" rel="stylesheet" type="text/css">-->
<?php
require 'include/connect.php';
require 'include/top.php';
$currec=$_GET['currec']; 
$mode=$_GET[mode];
$store_id=$_GET[store_id];
if($mode)
{
 $up_sql="update storefronts set status='$mode'  where  id='$store_id'";
$res=mysql_query($up_sql);
}
if($mode=="delete")
{
 $del_sql="delete from storefronts where id='$store_id'";
$res=mysql_query($del_sql);
}

 $store_sql="select * from storefronts "; 
 $store_res=mysql_query($store_sql);
 $store_row=mysql_query($store_sql);
?>
<table border="0" align="center" cellpadding="0" cellspacing="0" width="100%" background="images/bg08.jpg">
<tr><td>
<table>
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
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" height=40 >
<tr>
    <td width="10%" align="center"><center><a href="plan.php" id="link3" class="txt_users">Stores Fees</a></center></td>
    <td width="13%" align="center"><center><a href="store_manager.php" id="link3" class="txt_users">View Stores</a></center></td>
  </tr>
</table>
<table width="96%" border="0" cellpadding="0" cellspacing="0" align="center" class="border2">
<tr height=30><td bgcolor="#CCCCCC" align="left">
<font size=2><b>&nbsp;
View Stores 
</b></font></td><tr> 
 <tr>
 <td class="table_border" bgcolor="#eeeee1">
 <table cellpadding="5" cellspacing="2" width=100% border="0" >
 <?php
  $recordset=mysql_query($store_sql);
  $total_records=mysql_num_rows($recordset);
  $rec_sql="select  * from admin_settings where set_id=54";
$rec_res=mysql_query($rec_sql);
$rec_row=mysql_fetch_array($rec_res); 
$limitsize=$rec_row['set_value']; 
 if($total_records>0)
{ 
//get the total records
if(strlen($currec)==0) //check firstpage 
$currec = 1;  
$start = ($currec - 1) * $limitsize;
$end = $limitsize;
$store_sql .=" limit $start,$end";
}
if($total_records==0)
{
?>

<br>
<br>
<br>
<font size="2" color="red"><b>Sorry! No Stores Found.</b></font>
<br>
<br>
<br>
<?php // require 'include/footer.php'?>
</body></html>
<?php 
 exit();
} 
?>
<form name=frm1 action="store_manager.php" method="GET">
<tr bgcolor="#DDDDDD">
<td><b>Store Logo</b></font></td>
<td><b>Expire Date</b></font></td>
<td><b>Store Name</b></font></td>
<td><b>Owner</b></font></td>
<td><b>Store Description</b></font></td>
<td><b># Items Listed</b></font></td>
<td><b>Status</b></font></td>
<td><b>Delete</b></font></td>
</tr>
<?php
//if($view=="list")
//{
if($total_records > 0)
{
?>
<tr align="left" bgcolor="#eeeee1">
<?php 
$net=($currec-1*$limitsize+$end)-$total_records;
$dis=$limitsize+$start;
if($net <= 0) $net=$end;
if($dis<=$total_records)
{
?>
<td colspan=5 align="right" bgcolor="#eeeee1">
<font size="2">Showing  <?php echo $start+1; ?>
 <?php echo " - ". $dis; ?> of <?php echo $total_records; ?> Items </font></td>
<?php 
}
 else 
{
?>
<td colspan=5 align="right" bgcolor="#eeeee1">
<font size="2">Showing  <?php echo $start+1;?>  of <?php echo $total_records; ?> Item </font></td>
<?php
}
if($currec!=1)
{
?>
<td>
<a href="store_manager.php?currec=<?php=($currec - 1);?>&view=<?php=$view;?>&cate_id=<?php=$cate_id;?>" >
 <font size="2" color="red" face="Arial, Helvetica, sans-serif">Previous </font></a></td>
<?php
} 
$net=$total_records-($currec*$limitsize+$end) + $end;
if($net >$limitsize) $net=$limitsize;
if($net <= 0) $net=$end;
if($total_records > ($start + $end)) 
{
?>  
<td><a href="store_manager.php?currec=<?php=($currec + 1);?>&view=<?php=$view;?>&cate_id=<?php=$cate_id;?>" >
<font size=2 color="red" face="Arial, Helvetica, sans-serif"> Next </font> </a></td>
<?php
 }
 ?>
 </tr>
 <?php
} 
//} //if($view=="list");
?>
<?php
 $c=1;
 $recordset=mysql_query($store_sql);
 while($record=mysql_fetch_array($recordset))
 {
$auction_sql="select * from placing_item_bid where user_id=$record[user_id] and status='active'";
$auction_res=mysql_query($auction_sql);
$auction_row=mysql_fetch_array($auction_res);
$tot_auction=mysql_num_rows($auction_res);
  
  if($c==1)
  {
  $c=0;
  ?>
<tr class="tr_color_1" height="75" bgcolor="#eeeee1">  
  <?php
  }
  else
  {
  ?>
  <tr class="tr_color_2" height="75" bgcolor="#eeeee1">
  <?php 
  $c=1;
  }
  //} ?>
  
  <td  align=center bgcolor="#eeeee1">
  <?php 
  if($record[logo])
  {
  ?>
  <a href="#"  onClick="window.open('store.php?id=<?php= $record[user_id];?>&i=1','pop_up','toolbar=no, top=0,location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=650, height=700')" class="txt_users">
  <img src="../storefronts/<?php= $record[logo] ?>" border="0" alt= "Click here to View Stores Details" width="75" height=75 ></a>
  <?php
  }
  else 
  {
  ?>
  <a href="#"  onClick="window.open('store.php?id=<?php= $record[user_id];?>&i=1','pop_up','toolbar=no, top=0,location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=650, height=700')" class="txt_users">
  <img src="../images/no_image.gif" border="0" alt= "Click here to View Stores Details" width="75" height="75"></a>
<?php 
}
?>
 </td>
 <td class="txt_sitedetails">
 <?php
 $expdate=explode(" ",$record['store_end_date']);
 echo $expdate[0];
 ?>
 </td>
 <td align="center" bgcolor="#eeeee1" class="txt_sitedetails">
 <?php
  echo $record['store_name'];
 ?>		 
  </td>
  <td bgcolor="#eeeee1">
  <?php
 $member_acc="select * from user_registration where user_id=".$record['user_id'];
 $memebr_rec=mysql_query($member_acc);
 $member_res=mysql_fetch_array($memebr_rec);
 ?>
   <a href="#"  onClick="window.open('store.php?id=<?php= $record[user_id];?>&i=1','pop_up','toolbar=no, top=0,location=no,    directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=650, height=700')" class="txt_users"><?php  echo $member_res['user_name']; ?> </a>
 </td>
 <td width=50% bgcolor="#eeeee1" class="txt_sitedetails"><?php= $record[description]; ?></td>
<td bgcolor="#eeeee1" class="txt_sitedetails"><?php= $tot_auction; ?></td>
<?php
if($record[status]=="enable")
{
$status="Disable";
$mode="suspend";
}
if($record[status]=="suspend" or $record[status]=="disable" or $record[status]=="New" )
{
$status="Enable";
$mode="enable";
}
?>
<td bgcolor="#eeeee1"> <a href="store_manager.php?mode=<?php= $mode ?>&store_id=<?php= $record[id] ?>" id=link class="txt_users"><?php= $status ?></a></td>
<td bgcolor="#eeeee1"><div align="center" class="style3"><a href="store_manager.php?store_id=<?php=$record['id']; ?>&mode=delete"  id="link" style="text-decoration:none" onClick="javascript:return condelete();" class="txt_users">Delete</a></div></td>
 <input type="hidden" name="canDel" value="0">
</tr>
<?php
} //while($record=mysql_fetch_array($recordset))
//}
//if($view=="list")
//}
?>

</td></tr>
</form>
</table></td></tr>
<tr>
<!-- <form name="form2" action="stores.php">
<tr><td><input type="submit" value="Add Store" /></td></tr>
</form> -->
</table></td></tr>
</table></td></tr>
<?php require 'include/footer.php'?>
<script language="javascript">
function condelete()
{
var confrm;
confrm=window.confirm("Are You sure you want to delete this Store");
document.frm1.canDel.value=1;
return confrm;
}
</script>