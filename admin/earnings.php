<?php
session_start();
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
<link href="include/style.css" rel="stylesheet" type="text/css">

<?php
require 'include/connect.php';
require 'include/top.php';

?>
<table border="0" align="center" cellpadding="5" cellspacing="2" width="100%" background="images/bg08.jpg">
<tr><td>
<table >
<tr><td width=93><table id="Table_01" width="93"  border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td><img src="images/links5_01.jpg" width="93" height="25" alt=""></td>
                    </tr>
                    <tr>
                 <td><a href=site.php?page=pay><img src="images/links5_02.jpg" width="93" height="71" alt="" border=0 title="PaymentSettings"></a></td>
                    </tr>
                    <tr>
                      <td><a href=earnings.php><img src="images/links5_03.jpg" width="93" height="71" alt="" border=0 title="AdminEarnings"></a></td>
                    </tr>
                    <tr>
                      <td><a href=fee_setting.php><img src="images/links5_04.jpg" width="93" height="74" alt="" border=0 title="FeeSettings"></a></td>
                    </tr>
                   
                </table></td><td width=793>

<table align="center" width="100%" height="35">
  <tr>
    <td width="19%" align="center" bgcolor="#CCCCCC"><font size="2"> <b>Admin Earnings </b> </font> </td>
  </tr>
</table><br>
<table align="center" width="90%"><tr>
<!-- <td align="center"><a id="tablink" href="earnings.php?mode=end">End Auction Early</a></td> -->
<td align="center"><a class=txt_users href="earnings.php?mode=fea">Featured Item</a></td>
<td align="center"><a class=txt_users href="earnings.php?mode=store">Store</a></td>
<td align="center"><a class=txt_users href="earnings.php?mode=final">Final Sale Value Fee</a></td>
</tr></table><br />
<table width="98%"  border="0" cellpadding="5" cellspacing="1" class="border2" align="center">
 <tr bgcolor="#CCCCCC">
 <td colspan="5" class="txt_users">Earnings Details through 
 <?php $mode=$_REQUEST[mode];  
 if ($mode=="fea") 
 { echo "featured item";} 
 else if($mode=="store") 
 {
  echo "Store"; 
 }
 else if($mode=="final") 
 echo "final sale value fee"; 
 else if($mode=="")
 echo "featured item";
 ?></td></tr>
<?php

if($mode=='final')
{
$secsql="select * from pay_transaction where trans_type='Final Sale Value Fee' order by trans_date";
$tot_sql="select SUM(trans_amount) as total from pay_transaction where trans_type='Final Sale Value Fee' order by trans_date";
}
else if($mode=='store')
{
$secsql="select * from pay_transaction where (trans_type='Store Fee' || trans_type='Store renew') order by trans_date desc";
$tot_sql="select SUM(trans_amount) as total from pay_transaction where trans_type='Store Fee' order by trans_date desc";

}
else
{
$secsql="select * from pay_transaction where trans_type='Featured Listing Fee' order by trans_date";
$tot_sql="select SUM(trans_amount) as total from pay_transaction where trans_type='Featured Listing Fee' order by trans_date";
}

//echo $secsql;
$secres=mysql_query($secsql);
$tot_res=mysql_query($tot_sql);
$tot_row=mysql_fetch_array($tot_res);
$total=$tot_row[total];
if(mysql_num_rows($secres)>0)
{
?>

 <tr bgcolor="#CCCCCC">
 <td width="12%">Member Name</td>
 <td width="20%"><?php if($mode=="store") echo "Store Name"; else echo "Item Id";?></td>
 <td width="16%">Transaction Date</td>
 <td width="19%" align="center">Batch Number</td>
 <td width="33%" align="center">Amount</td>
 </tr>

 <?php
 while($secrow=mysql_fetch_array($secres))
 {
 // Fetching username //
  $mres=mysql_query("select * from user_registration where user_id=".$secrow['user_id']); 
  $mrow=mysql_fetch_array($mres);
 
 //fetching store name
$storename_sql="select * from storefronts where user_id=".$secrow['user_id'];
$storename_qry=mysql_query($storename_sql);
if($storename_row=mysql_fetch_array($storename_qry))
$store_name=$storename_row['store_name'];
 ?>
 <tr bgcolor="eeeee1"><td><?php=$mrow['user_name']?></td>
 <td>
   <?php if($mode=="store") echo $store_name; else echo $secrow[itemid] ?>
 </td>
 <?php
 $trans_amount=number_format($secrow['trans_amount'],2,'.','');
 
 $trans_date1=explode(" ",$secrow['trans_date']);
 $trans_date=$trans_date1[0];
 ?>
 <td><?php=$trans_date?></td><td align="right"><?php=$secrow['trans_batchnumber']?></td><td align="right"><?php=$trans_amount?></td></tr>
  <?php
 }
 $total=number_format($total,2,'.','');
 ?>
 <tr bgcolor="#CCCCCC" ><td style="padding:5px" align="right" colspan="4"><b>Total : </b> </td><td align="right"><b><!--$--> <?php= $total ?> </b></td></tr>
  <tr><td colspan="8" align="right">
<a href="#" onclick="window.open('download.php?mode=<?php=$mode?>','pop_up','toolbar=no, top=0,location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, height=500, width=500')" style="text-decoration:none; color:#CC6600; size:2px; font-weight:bold" title="Download Sold Auction details in Excel Format"> Download Details</a><a href="#" onclick="window.open('download.php?mode=<?php=$mode?>','pop_up','toolbar=no, top=0,location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, height=500, width=500')" style="text-decoration:none; color:#CC6600; size:2px"><img src="../images/download.gif" border="0"/></a></td></tr>
 
 <?php
 }
 else
 {
 ?>
 <tr bgcolor="eeeee1"> <td colspan="5" align="center"> <font color="#FF0000">No Results To Display </font></td></tr>
 <?php
 }
 ?>
 </table></td></tr></table></td></tr></table>
<?php
	require 'include/footer.php';
?>