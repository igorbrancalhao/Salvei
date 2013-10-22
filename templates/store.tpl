<?php
/***************************************************************************
 *File Name				:store.tpl
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
if($total_records==0)
{ 
?>
<table width="100%" border="0" cellpadding="5" cellspacing="0" align="center">
 <tr><td valign="top">
 <table cellspacing=0 cellpadding="5" align="center" width="962">
 <tr colspan="6"><td background="images/item_bg.gif"><font size="3"><b><div align="left">&nbsp;&nbsp;<?php= $store_row[store_name] ?></div></b></font></td></tr>
<tr>
               <td width="93%" align="center">
			   <br><br>
			   <font class="errormsg">
			   Sorry,  No results ! </font>
			    <br><br></td></tr>
</table>
</td>
</tr>
<tr><td><br>
<br>
<br>
<?php
require 'include/footer.php';
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
<table width="100%" cellpadding="5" cellspacing="0" align="center">
<tr><td>
<table cellspacing=0 cellpadding="5" align="center" width="962">
<tr colspan="6"><td background="images/item_bg.gif"><font size="3"><b><div align="left">&nbsp;&nbsp;>> Stores - <?php= $store_row[store_name] ?></div></b></font></td></tr>
 <tr><td width=100%>
 <table width="100%" cellpadding="5" cellspacing=2><tr><td align="center">
 <?php
  $img=$store_row[logo];
				   list($width, $height, $type, $attr) = getimagesize("storefronts/$img");
				   $h=$height;
				   $w=$width;
				   if($h>300)	
				   {
				   $nh=300;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>300)
				  {
				  $nw=300;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
 ?>
 <img src="storefronts/<?php= $store_row[logo] ?>" height="<?php=$h?>" width="<?php=$w?>"></td></tr>
 <tr><td class="searchresult3txt" align="center" width=100%> <?php= $store_row[description];  ?>
</td></tr>
 </table>
 </td></tr>
  <tr><td>
 <table align="center" width="100%" cellpadding="5" cellspacing="0">
 <tr><td colspan="4" class="errormsg">
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
<font  size="2">Currently Showing <?php echo $total_records;?>  from a total of <?php echo $total_records; ?> Record </font>
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
echo "<td align=right><a href=store.php?id=$id&currec=".($currec - 1)." style=text-decoration:none><font class=header_text2><b>Prev</b></font></a></td>";
}
$net=$total_records - ($currec*$limitsize+$end) + $end;
if($net >$limitsize) $net=$limitsize;
if($net <= 0) $net=$end;
if($total_records > ($start + $end)) 
{
?>
<td align="right" colspan="5"><a href="store.php?id=<?php=$id;?>&currec=<?php=$currec+1;?>" style="text-decoration:none"><font class="header_text2"><b> Next</b></font></a></td>
<?php
}
?>
</tr>
</table>
</td>
</tr>
<tr class="detail9txt">
                            <TD width="13%"></TD>
							  <TD width="13%"></TD>
                            <TD width="19%">Item </TD>
                            <TD width="17%"># of Bids </TD>
							
                            <TD width="19%">Price </TD>
							<?php
							?>
                            <TD align=middle width="32%">
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
  else if($item[selling_method]=="auction" or $item[selling_method]=="dutch_auction")
  {
$no_of_bid=$tot[0];
$bid_sql1="select MAX(duplicate_bidding_amt) as amt from placing_bid_item where item_id=".$item['item_id'];
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
 <a href="bidding.php?item_id=<?php  echo $item['item_id']; ?>">
  <img src="images/auction(5).gif" border="0" alt= "Click here to bid for this item"></a>
  <?php
  }
  else if($item[selling_method]=='ads')
  {
  ?>
  <!-- <a href="fixed_price_sale.php?item_id=<?php= $item['item_id'];?>&qty=1">
		<img src="images/hands(11).gif" border="0" alt="Click here to Buy this Item"></a> -->
		<a href="classifide_ad.php?item_id=<?php= $item['item_id'];?>&qty=1">
		<img src="images/hands(11).gif" border="0" alt="Click here"></a>
  <?php 
   } 
   else if($item[selling_method]=='fix')
   {
   ?>
  <a href="detail.php?item_id=<?php= $item['item_id'];?>&qty=1">
		<img src="images/buynow_icon.gif" border="0" alt="Click here to Buy this Item"></a>
  <?php
   }
  ?> </td>
  <td>
  <?php 
   if($item[selling_method]=="auction" or $item[selling_method]=="dutch_auction" or $item[selling_method]=="fix")
  {
  if(!empty($item[picture1]))
	{ ?>
	 <a href="detail.php?item_id=<?php echo $item['item_id'];?>">
	 <img height="80" width="80" src="images/<?php echo $item['picture1']; ?>" border=0  alt=Click here to view item description></a> 
	<?php
	 }
	 else
	 {
	 	?>
		 <a href="detail.php?item_id=<?php echo $item['item_id']; ?>" alt="Click here to view item description">
		 <img height="80" width="80" src="images/no-image.gif" border=0></a> 
 <?php 
 }
 }
 else
 {
  if(!empty($item[picture1]))
	{ ?>
	 <a href="classifide_ad.php?item_id=<?php echo $item['item_id'];?>">
	 <img height="80" width="80" src="images/<?php echo $item['picture1']; ?>" border=0  alt=Click here to view item description></a> 
	<?php
	 }
	 else
	 {
	 	?>
		 <a href="classifide_ad.php?item_id=<?php echo $item['item_id']; ?>" alt="Click here to view item description">
		 <img height="80" width="80" src="images/no-image.gif" border=0></a> 
 <?php 
 }
 }
 ?>		 
 
 
   </td>
  <td width=180 class="searchresult3txt">
 <?php if($item[selling_method]=="auction" or $item[selling_method]=="dutch_auction" or $item[selling_method]=="fix")
  {
 ?>
  <a href="detail.php?item_id=<?php  echo $item['item_id']; ?>" class="searchresult3txt">
  <?php if($fea[bold]=="Yes") echo "<b>".$item['item_title']."</b>"; else echo $item['item_title']; ?></a><br>
  <?php
  }
  else
  {
    ?>
 <a href="classifide_ad.php?item_id=<?php  echo $item['item_id']; ?>" class="searchresult3txt">
 <?php if($fea[bold]=="Yes") echo "<b>".$item['item_title']."</b>"; else echo $item['item_title']; ?></a><br>
  <?php
  }
  ?>
  &nbsp;&nbsp;<?php if($fea[subtitle_feature]=="Yes") echo $fea['subtitle']; ?>
  </td>
     <?php if($item[selling_method]=="auction" or $item[selling_method]=="dutch_auction")
  {
 ?>
  
  <td class="searchresult3txt_bold"><?php echo $no_of_bid; ?> </td>
  <td class="searchresult3txt_bold"><?php  echo  $item[currency]." ".$curprice; ?></td>
  <td class="searchresult3txt_bold"><?php echo "$string_difference" ;?></td>
      <?php 
	  }
	  else
	  {
	  ?>
							<td width="17%" class="detail8txt">-</TD>
				
                            <td class="searchresult3txt_bold" width="19%"><?php if($item[selling_method]=="fix")
  {
  echo $item[currency]." ".$item[quick_buy_price];
  }
  else
  {
  echo "-";
  }
  ?></td>
                          	<td class="searchresult3txt_bold"><?php echo "$string_difference" ;?></td>					
	<?php
      }
	  ?>
	   <tr>
       <td style="border-bottom:1px solid #cccccc" colspan="7"></td>
       <tr>
	  <?php
	  } 
	  }
	?>
	
  </tr> 
</table>
</td></tr>
</table>
<?php 
 require 'include/footer.php';					
?>
