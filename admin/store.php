<?php
/***************************************************************************
 *File Name				:store.php
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
<link href="include/style.css" rel="stylesheet" type="text/css">
<?php
require 'include/connect.php';
require 'include/getdatedifference.php';
$userid=$_SESSION['userid'];
$id=$_GET[id];
$currec=$_GET[currec];
$store_sql="select * from storefronts where user_id=$id";
$store_res=mysql_query($store_sql);
$store_row=mysql_fetch_array($store_res);
$sql="select * from placing_item_bid  where  status=\"Active\" and selling_method!='want_it_now' and user_id=$id";
$limitsize=5;//pagelimit
$result=@mysql_query($sql);
$total_records=@mysql_num_rows($result);
?>
<?php
if($total_records==0)
{ 
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" valign="top">
 <tr><td>
 <TABLE cellSpacing=2 cellpadding="5" align="center" width="100%" >
 <th class="tr_border" colspan="6" ><font size="3"><b><div align="left">
&nbsp;&nbsp;<?php= $store_row[store_name] ?></div></b></font> </th>
<TR><td width="93%" align="center">
			   <br><br>
			   <font size="2" face="Arial, Helvetica, sans-serif" color="red">
			   Sorry,  No results ! </font>
    		   <br><br></td></tr>
</table>
</td>
</tr>
<br>
<br>
<br>
</table>
<?php
exit();
}
else if($total_records>0)
{ 
//get the total records
if(strlen($currec)==0) //check firstpage 
$currec = 1;  
$start = ($currec - 1) *$limitsize;
$end = $limitsize;
$sql.=" limit $start,$end";
$res=mysql_query($sql);
$c=1;
?>
<table width="100%" border="1" cellpadding="5" cellspacing="0" align="center"  >
 <tr ><td class="tr_border">
 <font size="3"><b><div align="left">
 &nbsp;&nbsp;Store Manager - <?php= $store_row[store_name] ?></div></b></font> </td></tr>
 <tr><td class="table_border">
 <TABLE cellSpacing=0 cellpadding="5" align="center" width="100%" >
 <tr><td class="table_border1">
 <table width="100%" cellpadding="5" cellspacing=2><tr><td align="center">
 <img src="../storefronts/<?php= $store_row[logo] ?>"</td></tr>
 <tr><td class="tr_color_2" align="center"> <?php= $store_row[description];  ?>
</td></tr>
 </table>
 </td></tr>
  <tr><td>
 <TABLE align="center" width="100%" cellpadding="5" cellspacing="0"  border=1>
 <tr><td colspan="4">
<?php 
$net=($currec-1*$limitsize+$end)-$total_records;
$dis=$limitsize+$start;
if($net <= 0) $net=$end;
if($dis<=$total_records)
{
?>
<font size="2">Currently Showing <?php echo $start+1;?> <?php echo "-".  $dis; ?> from a total of <?php echo $total_records; ?> Records</font>
<?php
}
else
{
?>
<font  size="2">Currently Showing <?php echo $start+1;?>  from a total of <?php echo $total_records; ?> Record </font>
<?php
} 
?>
</td>
<td align="right" colspan="2">
<table border="0" align="right" cellpadding="5" cellspacing="2" width="30">
<tr>
<?php
if($currec != 1)
{
echo "<td align=right><a href=store.php?id=$id&currec=".($currec - 1)." style=text-decoration:none><font size=2 color=red>Prev</font></a></td>";
}
$net=$total_records - ($currec*$limitsize+$end) + $end;
if($net >$limitsize) $net=$limitsize;
if($net <= 0) $net=$end;
if($total_records > ($start + $end)) 
{
echo "<td align=right colspan=5><a href=store.php?id=$id&currec=".($currec + 1)." style=text-decoration:none><font size=2 color=red> Next</font></a></td>";
}
?>
</tr>
</table>
</td>
</tr>

<!--  <tr align="left"><img src="images\search-results.gif"></tr> -->
       <TR class="table_head">
                            <TD width="13%"></TD>
							 <TD class=normal width="19%">Item </TD>
                            <TD class=normal width="17%"># of Bids </TD>
							
                            <TD class=normal width="19%">Price </TD>
							<?php
							?>
                            <TD align=middle width="32%" class="normal">
                              Ends</TD></TR>		
<tr>
<?php 
 $c=1;
?>
 <?php 
 while($item=mysql_fetch_array($res))
  {
  $expire_date=$item['expire_date'];
  require 'ends.php';
  $bid_sql="select * from placing_bid_item where item_id=".$item['item_id'];
  $bid_res=mysql_query($bid_sql);
  $bid=mysql_fetch_array($bid_res);
  $tot_sql="select count(*) from placing_bid_item where item_id=".$item['item_id'];
  $tot_res=mysql_query($tot_sql);
  $tot=mysql_fetch_array($tot_res);
  $fea_sql="select * from featured_items where item_id=".$item['item_id'];
  $fea_res=mysql_query($fea_sql);
  $fea=mysql_fetch_array($fea_res);
  if(($fea[border]=="Yes") && ($fea[highlight]=="Yes"))
  $both="Yes";
  else if ($fea[border]=="Yes")
  $both="border";
  else if ($fea[highlight]=="Yes")
  $both="highlight";
  if($tot[0]==0)
  {
  if($item[selling_method]=="auction" or $item[selling_method]=="dutch_auction")
  {
  $curprice=$item[min_bid_amount];
  }
  $no_of_bid="No Bid";
  }
  else if($item[selling_method]="auction" or $item[selling_method]="dutch_auction")
  {
$no_of_bid=$tot[0];
$bid_sql1="select MAX(bidding_amount) as amt from placing_bid_item where item_id=".$item['item_id'];
$bid_res1=mysql_query($bid_sql1);
$bid_row1=mysql_fetch_array($bid_res1);
$curprice=$bid_row1['amt'];
  }
   if($c==1)
  {
  $c=0;
  ?>
   <tr class="tr_color_1">  
 <?php
  }
else
  {
  $c=1;
  ?>
<tr class="tr_color_2">  
  <?php
  }
  ?>
  <td width=30 align=center>
  <?php 
  if($item[selling_method]=="auction" or $item[selling_method]=="dutch_auction")
  {
  ?>
   <img src="../images/auction(5).gif" border="0" alt= "Click here to bid for this item">
  <?php
  }
  else if($item[selling_method]=='ads')
  {
  ?>
  <!-- <a href="fixed_price_sale.php?item_id=<?php= $item['item_id'];?>&qty=1">
		<img src="images/hands(11).gif" border="0" alt="Click here to Buy this Item"></a> -->
		
		<img src="../images/hands(11).gif" border="0" >
  <?php 
   } 
   else if($item[selling_method]=='fix')
   {
   ?>
		<img src="../images/buynow_icon.gif" border="0" >
  <?php
   }
  ?> </td>
   <td width=180>
 <a href="item_details.php?id=<?php  echo $item['item_id']; ?>">
 <?php
  echo $item['item_title']; ?></a>
  </td>
     <?php if($item[selling_method]=="auction" or $item[selling_method]=="dutch_auction")
  {
 ?>
  
  <td><?php echo $no_of_bid; ?> </td>
  <td><?php  echo  $item[currency]." ".$curprice; ?></td>
  <td><?php echo "$string_difference" ;?></td>
      <?php 
	  }
	  else
	  {
	  ?>
							<TD class=normal width="17%">-</TD>
				            <TD class=normal width="19%">
							<?php if($item[selling_method]=="fix")
  {
  echo $item[currency]." ".$item[quick_buy_price];
  }
  else
  {
  echo "-";
  }
  ?></TD>
                          	<td><?php echo "$string_difference" ;?></td>					
	<?php
      }
	  } 
	  }
	?>
	
  </tr> 
</table >
</td></tr>
<!--  </TABLE> -->
</td></tr>
</table>
</tr></td></table>
 </body></html>          