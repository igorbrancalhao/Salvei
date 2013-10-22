<?php
/***************************************************************************
 *File Name				:search_gallary_view.tpl
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
<tr bgcolor="#DDDDDD"><td colspan="6">&nbsp;
<table cellpadding="5" cellspacing="2" width="700">
<?php
$count=0;
/*$chk_gallery=0;*/
while($item=mysql_fetch_array($result))
{
$fea_sql="select * from featured_items where item_id=".$item['item_id'];
$fea_res=mysql_query($fea_sql);
$fea=mysql_fetch_array($fea_res);
$both="";
if($fea[highlight]=="Yes")
$both="highlight";
$gal_sql="select * from featured_items where item_id=".$item['item_id']." and gallery_feature='Yes'";
$gal_qry=mysql_query($gal_sql);
$gal_rows=mysql_num_rows($gal_qry);
/*if($gal_rows > 0)
{
*/
/*$chk_gallery=$chk_gallery+1;*/
$count=$count+1;
if($mode=="advanced")
{
$expire_date=$item[34];
}
else
{
$expire_date=$item['expire_date'];
}
require 'ends.php';
$bid_sql="select * from placing_bid_item where item_id=".$item['item_id']." and deleted='No'";
$bid_res=mysql_query($bid_sql);
$bid=mysql_fetch_array($bid_res);
$tot_sql="select count(*) from placing_bid_item where item_id=".$item['item_id']." and deleted='No'";
$tot_res=mysql_query($tot_sql);
$tot=mysql_fetch_array($tot_res);

  if($tot[0]==0)
  {
  $no_of_bid="No Bid";
  }
  if($item[selling_method]=="auction" or $item[selling_method]=="dutch_auction" or $item[selling_method]=="fix")
  {
$no_of_bid=$tot[0];
$bid_sql1="select * from placing_bid_item where item_id=".$item['item_id']." and deleted='No'";
$bid_res1=mysql_query($bid_sql1);
if(mysql_num_rows($bid_res1) > 0)
{
$bid_sql1="select MAX(bidding_amount) as amt from placing_bid_item where item_id=".$item['item_id']." and deleted='No'";
$bid_res1=mysql_query($bid_sql1);
$bid_row1=mysql_fetch_array($bid_res1);
$curprice=$bid_row1['amt'];
}
else
$curprice=$item[min_bid_amount];
}
else
{
$curprice="-";
}

$fea_sql="select * from featured_items where item_id=".$item['item_id'];
$fea_res=mysql_query($fea_sql);
$fea=mysql_fetch_array($fea_res);
 if($count==1)
  {
  ?>
  <tr>
  <?php
  }
   if($c==1)
  {
  ?>
  <td <?phpif($fea[gallery_feature]=='Yes'){?>class="tr_color_3"<?php}else{?>class="tr_color_1"<?php}?> <?phpif ($fea[highlight]=="Yes"){?>style="border:1px solid #000066; background-repeat:repeat-x; background-position:bottom; padding-left:20px"<?php}?> >  
  <?php
  }
  else
  {
  $c=1;
  ?>
  <td <?php if ($fea[gallery_feature]=='Yes'){?>class="tr_color_3"<?php}else{?>class="tr_color_1"<?php}?> <?php if ($fea[highlight]=="Yes"){?>style="border:1px solid #000066; background-repeat:repeat-x; background-position:bottom; padding-left:20px"<?php}?>>  
  <?php
  }  
  ?>
  
  <table cellpadding="5" cellspacing="2" width=100%>
  <tr><td width="30%">
  
  <p>
  <?php 
  if($item[selling_method]=="auction" or $item[selling_method]=="dutch_auction" or $item[selling_method]=="fix")
  {
    if(!empty($item[picture1]) and file_exists('thumbnail/'.$item['picture1']))
	{
    			   $img=$item['picture1'];
				   list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
				   $h=$height;
				   $w=$width;
				   if($h>150)	
				   {
				   $nh=150;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>150)
				  {
				  $nw=150;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
	            
	
	 ?>
      <a href="detail.php?item_id=<?php echo $item['item_id'];?>">
        <img width=<?php echo  $w; ?> height=<?php echo $h?>  src="thumbnail/<?php echo $item['picture1']; ?>" border=0  alt=Click here to view item description></a> 
      <?php
	 }
	 else
	 {
	 ?>
      <a href="detail.php?item_id=<?php echo $item['item_id']; ?>" alt="Click here to view item description">
          <img height="50" width="50" src="images/no-image.gif" border=0></a> 
        <?php 
     }
   }
  else
  {
    if(!empty($item[picture1]) and file_exists('thumbnail/'.$item['picture1']))
	{ 
	
	              $img=$item['picture1'];
				   list($width, $height, $type, $attr) = getimagesize("thumbnail/$img");
				   $h=$height;
				   $w=$width;
				   if($h>150)	
				   {
				   $nh=150;
				   $nw=($w/$h)*$nh;
				   $h=$nh;
				   $w=$nw;
				   }
				  if($w>150)
				  {
				  $nw=150;
				  $nh=($h/$w)*$nw;
				  $h=$nh;
				  $w=$nw;
				  }
	
   ?>
        <a href="classifide_ad.php?item_id=<?php echo $item['item_id'];?>">
          <img width=<?php echo  $w; ?> height=<?php echo $h?>  src="thumbnail/<?php echo $item['picture1']; ?>" border=0  alt=Click here to view item description></a> 
        <?php
	 }
	 else
	 {
	 	?>
        <a href="classifide_ad.php?item_id=<?php echo $item['item_id']; ?>" alt="Click here to view item description">
          <img height="50" width="50" src="images/no-image.gif" border=0></a> 
              <?php 
     }
 }
 ?>		 
        </p></td>

<td width="70%" class="detail8txt">
<?php if($item[selling_method]=="auction" or $item[selling_method]=="dutch_auction" or $item[selling_method]=="fix")
   {
?>
  <a href="detail.php?item_id=<?php  echo $item['item_id']; ?>" class="searchresult3txt">
  <?php if($fea[bold]=="Yes") echo "<b>".$item['item_title']."</b>"; else echo $item['item_title']; ?></a>
  <?php
  }
  else
  {
  ?>
 <a href="classifide_ad.php?item_id=<?php  echo $item['item_id']; ?>" class="searchresult3txt">
 <?php if($fea[bold]=="Yes") echo "<b>".$item['item_title']."</b>"; else echo $item['item_title']; ?></a>
  <?php
  }
  ?>
  <?php if(!empty($item[sub_title])) echo "<br><font class=detail8txt>".$item['sub_title']."</font>" ?>
<br>
<?php if($item[selling_method]=="auction" or $item[selling_method]=="dutch_auction" )
{
echo "Bids:".$no_of_bid; 
}
else if($item[selling_method]=="fix")
{
$curprice=$item[quick_buy_price];
?>
<img src="images/buyitnow.gif" />
<?php
}
?>
<br>
  <?php
  if($curprice)
  {
  ?>
  <?php  echo  $item[currency]." ".$curprice; ?>
  <?php
  }
  else
  {
  ?>
  <?php echo $curprice; ?>
  <?php
  }
  ?>
  <br>
  
  <?php echo "$string_difference"; ?></td>
</tr></table></td>
  
<?php
if($count==2)
  {
  echo "</tr>";
  $count=0;
  }
$both="";
/*}*/
}
?>
</table></td></tr>
<!--<?php
if($chk_gallery==0)
{
?>
<tr><td height="10px">&nbsp;</td></tr>
<tr><td class="searchresultitemtxt">No Items in the search result have the Picture Gallery option</td></tr>
<tr><td height="10px">&nbsp;</td></tr>

<?php
}
?>-->