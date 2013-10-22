<?php
/***************************************************************************
 *File Name				:auction_edit.php
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
if($_GET)
{
$item=$_GET['itemid'];
$_SESSION['itemid']=$item;
}
else
{
$item=$_POST['item_id'];
}
$flag=$_POST['flag'];
$cat=$_POST['cat'];
$sql="select * from placing_item_bid where item_id=$item";
$res=mysql_query($sql);
$row=mysql_fetch_array($res);

$fea_sql="select * from featured_items where item_id=$item";
$fea_res=mysql_query($fea_sql);
$fea_row=mysql_fetch_array($fea_res);

$gallery_feature=$fea_row['gallery_feature'];
$bo_ld=$fea_row['bold'];
$home_feature=$fea_row['home_feature'];
$bor_der=$fea_row['border'];
$highlight=$fea_row['highlight'];
$subtitle_feature=$fea_row['subtitle_feature'];
$sub_title=$fea_row['subtitle'];

$itemtitle=$row[item_title];
$item_des=$row[detailed_descrip];
$cur_rency=$row[currency];
$dur=$row[duration];
$sell_method=$row[selling_method];
$pay_gate=$row[payment_gateway];
$ship_route=$row[shipping_route];
$ship_amt=$row[shipping_cost];
$quick_buy_price=$row[quick_buy_price];
$min_bid_amount=$row[min_bid_amount];
$res_price=$row[reserve_price];
$bid_increment=$row[bid_increment];
$img1=$row[picture1];
$img2=$row[picture2];
$img3=$row[picture3];
$img4=$row[picture4];
$img5=$row[picture5];
$category=$row[category_id];
$category=$_POST['category'];
$subcategory=$_POST['subcategory'];
$item_title=$_POST['item_title'];
$itemdes=$_POST['itemdes'];
$currency=$_POST['currency'];
$world=$_POST['world'];
$shipping_cost=$_POST['shipping_cost'];
$selling=$_POST['selling'];
$quick=$_POST['quick']; 
$min_amt=$_POST['min_bid_amt'];
$reserve_price=$_POST['reserve_price'];
$bid_inc=$_POST['bid_inc'];
$img1=$_POST['img1'];
$img2=$_POST['img2'];
$img3=$_POST['img3'];
$img4=$_POST['img4'];
$img5=$_POST['img5'];

$feature=$_POST['feature'];
$gallery=$_POST['gallery'];
$bold=$_POST['bold'];
$border=$_POST['border'];
$high=$_POST['high'];
$home=$_POST['home'];
$subtitle=$_POST['subtitle'];
$sub=$_POST['sub'];

?>
<?php if($flag==2)
{
$category=$_POST['category'];
$subcategory=$_POST['subcategory'];
$item_title=$_POST['item_title'];
$itemdes=$_POST['itemdes'];
$selling=$_POST['selling'];
$sell_method=$_POST['selling'];
$currency=$_POST['currency'];
}
?>

<?php 
echo $cat=$_POST['cat'];
if($cat=='2')
{
$sql_cat="select * from category_master where category_head_id=0";
$res_cat=mysql_query($sql_cat);

$subcat_sql="select * from category_master where category_head_id=$category";
$subcat_res=mysql_query($sub_sql);
	
}
?> 
<?php
if($flag=='1')
{

$category=$_POST['category'];
$subcategory=$_POST['subcategory'];
$item_title=$_POST['item_title'];
$itemdes=$_POST['itemdes'];
$currency=$_POST['currency'];
$world=$_POST['world'];
$shipping_cost=$_POST['shipping_cost'];
$selling=$_POST['selling'];
$quick=$_POST['quick']; 
$min_amt=$_POST['min_bid_amt'];
$reserve_price=$_POST['reserve_price'];
$bid_inc=$_POST['bid_inc'];
$img1=$_POST['img1'];
$img2=$_POST['img2'];
$img3=$_POST['img3'];
$img4=$_POST['img4'];
$img5=$_POST['img5'];

$feature=$_POST['feature'];
$gallery=$_POST['gallery'];
$bold=$_POST['bold'];
$border=$_POST['border'];
$high=$_POST['high'];
$home=$_POST['home'];
$subtitle=$_POST['subtitle'];
$sub=$_POST['sub'];

if($world=="world")
{
$shipping_route="Asia Africa Australia America canada Europe";
}
else
{
$world=$_POST[world];
$aus=$_POST[aus];
$asia=$_POST[asia];
$america=$_POST[america];
$europe=$_POST[europe];
$africa=$_POST[africa];
$shipping_route="";
 if($aus=="aus")
  $shipping_route.="Australia ";
  if($asia=="asia")
 $shipping_route.="Asia ";
  if($america=="america")
 $shipping_route.="Americanada ";
  if($europe=="europe")
 $shipping_route.="Europe ";
  if($africa=="africa")
 $shipping_route.="Africa";
}



$payment=$_POST['payment'];
$payid=$_POST['pay_id'];
$payname=$_POST['pay_name'];

if(empty($payment))
  {
  $err_payment="Please select this information";
  $err_flag=1;
  }
else
{ 
if($payment=="3")
{ 
if(empty($payid))
  {
  $err_pay_id="Please Enter this information";
  $err_flag=1;
  }
 if(strlen($payname)==0)
  {
  $err_pay_name="Please Enter this information";
  $err_flag=1;
  }
 }  //if($payment=="E-Gold")
 else
 {
 if(empty($payid))
  {
  $err_pay_id="Please Enter this information";
  $err_flag=1;
  }
 }  // else of if($payment=="E-Gold")
}
if(empty($shipping_route))
  {
  $err_route="Please select this information";
  $err_flag=1;
  }
  
if(empty($shipping_amt))
  {
  $err_amt="Please enter this information";
  $err_flag=1;
  }
if(empty($item_title))
{
 $err_title="PLease Enter this Information";
	 $err_flag=1;
}
if(strlen($itemdes)==0)
{  
 $err_des="PLease Enter this Information";
	 $err_flag=1;
}
else
{
$err_flag=0;
}
if(empty($currency))
{
 $err_cur="PLease Select this Information";
	 $err_flag=1;
}

if($selling=="fix")
{
$quick=$_POST[quick]; 
 if(empty($quick))
 {
 $err_fix_price="PLease Enter this Information";
	 $err_flag=1; 
 }
 else
{
 if(!is_numeric($quick))
	{
      $err_fix_price="Your Quick Buy Price is invalid";
	  $err_flag=1;
	}
}

}
		else if($selling=="auction")
		{
			$min_amt=$_POST[min_bid_amt];
			$reserve_price=$_POST[reserve_price];
			$bid_inc=$_POST[bid_inc];
 			if(empty($min_amt))
			{
			 $err_min_amt="PLease Enter this Information";
			 $err_flag=1;
			}
			else
			{
			 if(!is_numeric($min_amt))
				{
   				   $err_min_amt="Your minimum bid amount is invalid";
				  $err_flag=1;
				}
			}
			 if(empty($reserve_price))
			{
			 $err_rev_price="PLease Enter this Information";
			 $err_flag=1;
			}
			else
			{
			 if(!is_numeric($reserve_price))
				{
  				    $err_rev_price="Your reserve price is invalid";
				  $err_flag=1;
				}
			}

 			if(empty($bid_inc))
			{
 				$err_bid_inc="PLease Enter this Information";
				 $err_flag=1;
			}
			else
			{
 			if(!is_numeric($bid_inc))
				{
   				   $err_bid_inc="Your Bid increment is invalid";
				  $err_flag=1;
				}
			}
	 } 

$duration=$_POST['duration'];
if(empty($duration))
{
$err_dur="Please select duration";  
 $err_flag=1;
 }
if(empty($shipping_cost))
{ 
$err_ship="Please select duration";  
 $err_flag=1;
 }
 
 $img1=$_FILES['img1']['name'];
if(!empty($img1))
{
$type1=$_FILES['img1']['type'];
 if($type1=="image/pjpeg" || $type1=="image/gif" || $type1=="image/jpeg" || $type1=="image/bmp")
 {
$img1=urlencode($img1);
$uploaddir="../images/$img1";
  move_uploaded_file($_FILES['img1']['tmp_name'], $uploaddir);
   }

 }

 $img2=$_FILES['img2']['name'];
if(!empty($img2))
{
 $type2=$_FILES['img2']['type'];
 if($type2=="image/pjpeg" || $type2=="image/gif" || $type2=="image/jpeg" || $type2=="image/bmp")
 {
  $img2=urlencode($img2);
  $uploaddir="../images/$img2";
  move_uploaded_file($_FILES['img2']['tmp_name'], $uploaddir);
 }
 
 }
 $img3=$_FILES['img3']['name'];
if(!empty($img3))
{
 $type3=$_FILES['img3']['type'];
 if($type3=="image/pjpeg" || $type3=="image/gif" || $type3=="image/jpeg" || $type3=="image/bmp")
 {
  $img3=urlencode($img3);
  $uploaddir="../images/$img3";
  move_uploaded_file($_FILES['img3']['tmp_name'], $uploaddir);
 }
 
 }
 $img4=$_FILES['img4']['name'];
if(!empty($img4))
{
 $type4=$_FILES['img4']['type'];
 if($type4=="image/pjpeg" || $type4=="image/gif" || $type4=="image/jpeg" || $type4=="image/bmp")
 {
  $img4=urlencode($img4);
  $uploaddir="../images/$img4";
  move_uploaded_file($_FILES['img4']['tmp_name'], $uploaddir);
 }
 
 }
 $img5=$_FILES['img5']['name'];
if(!empty($img5))
{
 $type5=$_FILES['img5']['type'];
 if($type5=="image/pjpeg" || $type5=="image/gif" || $type5=="image/jpeg" || $type5=="image/bmp")
 {
  $img5=urlencode($img5);
  $uploaddir="../images/$img5";
  move_uploaded_file($_FILES['img5']['tmp_name'], $uploaddir);
 }
 }
 

 
if($err_flag!=1)
{
$auction_insr="update placing_item_bid set item_title='$item_title',payment_gateway='$payment',selling_method='$selling',detailed_descrip='$itemdes',min_bid_amount='$min_amt',shipping_cost=$shipping_cost, ";
 $auction_insr.="quick_buy_price='$quick',bid_increment='$bid_inc',duration='$duration',currency='$currency',reserve_price='$reserve_price',payment_name='$payname',payment_id='$payid',shipping_route='$shipping_route' ";
 $auction_insr.=",picture1='$img1',picture2='$img2',picture3='$img3',picture4='$img4',picture5='$img5' where item_id=$item";
 $auction_res=mysql_query($auction_insr);

if($feature=='yes')
{
$sql="update featured_items set gallery_feature='$gallery',home_feature='$home',bold='$bold',border='$border',highlight='$high',subtitle_feature='$subtitle',subtitle='$sub' where item_id='$item'";
$res=mysql_query($sql);
}
echo ("<h2>Edited Sucessfully</h2>");

require 'include/footer.php';
exit();
echo '<meta http-equiv="refresh" content="0; url=auction.php">';
}



}

?>
<link href="include/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {
	color: #666666;
	font-weight: bold;
}
.style3 {color: #666666; font-size: 11px; font-family:Arial, Helvetica, sans-serif}
-->
</style>
<table align="center" width="100%" height="35" bgcolor="#FFCF00">
  <tr>
    <td width="20%" align="center"><a href="deposit.php" id="link3">Total Items Posted</a></td>
    <td width="20%" align="center"><a href="withdraw.php" id="link3">Sold Items </a></td>
    <td width="20%" align="center"><a href="bonus.php" id="link3">Live Items </a></td>
    <td width="20%" align="center"><a href="earnings.php" id="link3">Expired Items </a></td>
	<td align="center" width="20%"><b>Suspended Items</b></td>
  </tr>
</table>

<form name="auction_edit" method="post" action="auction_edit.php" enctype="multipart/form-data"> 

<html>
<head>
<title>Auction_Edit</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body onLoad="pay_refresh()">
<table width="552" class="tablebox">
<tr bgcolor="#CCCCCC"><td colspan="2" align="center" class="style1" ><b><font size="+1">Edit an Item</font></b></td></tr>
<tr bgcolor="eeeee1"><td>Category</td><td>
<?php
 $sql_cat="select * from category_master where category_head_id=0";
$res_cat=mysql_query($sql_cat);
$cat_row=mysql_fetch_array($res_cat);
$categoryid=$cat_row['category_id'];
?>
<select name="category" onChange="cat_change()">
<option value="0">Select</option>
<?php

  while($cat_row=mysql_fetch_array($res_cat))
 { 				
   ?>
  <option value="<?php= $cat_row['category_id'] ?>"  selected><?php= $cat_row['category_name']?></option>
  
   <?php }?>
  </select></td></tr>
  <tr bgcolor="eeeee1"><td>SubCategory</td><td><select name="subcategory"><option value="0">Select</option>

<?php 

 $subcat_sql="select * from category_master where category_head_id=$category";
		$subcat_res=mysql_query($sub_sql);
		
  while($subcat_row=mysql_fetch_array($subcat_res))
 {

    ?>
  <option value="<?php= $subcat_row['category_name'] ?>" selected><?php= $subcat_row['category_name']?></option>
  
<?php }
   ?>
  </select></td></tr>
  
<tr bgcolor="eeeee1"><td>
<?php  if(!empty($err_title))
 {
 ?>
<font size=2 color=red><?php= $err_title;?></font>
<br>
<font size=2 color=red>Item Title</font>
<?php
}else{
?>
Item Title
<?php }?></td><td><input type="text" name="item_title" value="<?php=$itemtitle;?>"></td></tr>
<tr bgcolor="eeeee1"><td>
<?php if(!empty($err_des))
 {
 ?>
<font size=2 color=red><?php= $err_des;?></font>
<br>
<font size=2 color=red>Item Description</font>
<?php
}else{
?>
Item Description
<?php }?></td><td><textarea name="itemdes"><?php=$item_des?></textarea></td></tr>


<tr bgcolor="eeeee1"><td><?php  if(!empty($err_cur))
 {
 ?>
<font size=2 color=red><?php= $err_cur;?></font>
<br>
<font size=2 color=red>Currency</font>
<?php
}else{
?>
Currency
<?php }?></td><td><select name="currency"><option value="0">Select</option>

<?php 
$cur_sql="select * from currency_master ";
$cur_res=mysql_query($cur_sql);


  while($currency_row=mysql_fetch_array($cur_res))
 {
echo $cur=$currency_row['currency'];
  if(trim($cur)==trim($cur_rency))
  {
   ?>
  <option value="<?php= $cur ?>" selected><?php= $cur?></option>
  <?php 
  }
  else
    {
	?>
  <option value="<?php= $cur ?>"><?php= $cur ?></option>
  <?php
  }
}
   ?>
  </select></td></tr>
  <tr bgcolor="eeeee1"><td>Selling Method
    </td>
  <td>
  <?php if($sell_method=="fix")
  {
  ?>
    <input type="radio" name=selling  value="fix" checked onClick="sel_method()">Fixed Sale Price
	<?php 
	}else
	{
	?>
	<input type="radio" name=selling  value="fix" onClick="sel_method()">
    Fixed Sale Price<?php }?>
	<?php if($sell_method=="auction"){?>
    <input type="radio" name=selling  value="auction" checked onClick="sel_method()">Auction
	<?php }else{?>
	<input type="radio" name=selling  value="auction" onClick="sel_method()">
    Auction<?php }?>
    </td></tr>
	<?php
	if($sell_method=="fix")
	{ ?>
	<tr bgcolor="eeeee1"><td><?php if(!empty($err_fix_price))
 { ?>
 <font size=2 color=red><?php= $err_fix_price; ?></font>
 <br>
 <b><font size=2 color=red>Quick Buy Price</font></b>
 <?php
  }
  else
  {
 ?>
  Quick Buy Price
   <?php }
   ?></td><td><input type="text" name="quick" value="<?php=$quick_buy_price?>"></td></tr>
	<?php }
	else
	{
	if($sell_method=="auction"){?>
	<tr bgcolor="eeeee1"><td><?php if(!empty($err_min_amt))
 {?>
 <font size=2 color=red><?php= $err_min_amt;?></font>
 <br>
 <b><font size=2 color=red>Minimum Bid Amount</font></b>
 <?php
 }
 else
 {
 ?>
 Minimum Bid Amount
 <?php
  }
 ?></td><td><input type="text" name="min_bid_amt" value="<?php=$min_bid_amount?>"></td></tr>
	<tr bgcolor="eeeee1"><td><?php if(!empty($err_rev_price))
 {?>
<font size=2 color=red><?php= $err_rev_price ;?></font>
 <br>
 <b><font size=2 color=red>Reserve Price</font></b>
 <?php
  }
  else
  {
 ?>
   Reserve Price
   <?php }
   ?> </td><td><input type="text" name="reserve_price" value="<?php=$res_price?>"></td></tr>
	<tr bgcolor="eeeee1"><td><?php if(!empty($err_bid_inc))
 {?>
<font size=2 color=red><?php= $err_bid_inc;?></font>
 <br>
 <b><font size=2 color=red>Bid Increment</font></b>
 <?php
  }
  else
  {
 ?>
   Bid Increment
   <?php }
   ?></td><td><input type="text" name="bid_inc" value="<?php=$bid_increment?>"></td></tr>
	<?php }
	}?>




 
 
<tr bgcolor="eeeee1">
   <td width="231"><?php if(!empty($err_dur))
 {?>
<font size=2 color=red><?php= $err_dur;?></font>
 <br>
 <b><font size=2 color=red>Duration</font></b>
 <?php
  }
  else
  {
 ?>
   Duration
   <?php }
   ?></td>
    <td width="261"><select name="duration">
	<option value=0>select</option>
	<?php if($dur==30)
	{?>
	<option value="30 days" selected >30 days</option>
	<?php
	}
	else
	{?>
	<option value="30 days">30 days</option>
	<?php }?>
	<?php if($dur==60)
	{?>
	<option value="60 days" selected >60 days</option>
	<?php
	}
	else
	{?>
	<option value="60 days">60 days</option>
	<?php }?>
	<?php if($dur==90)
	{?>
	<option value="90 days" selected >90 days</option>
	<?php
	}
	else
	{?>
	<option value="90 days">90 days</option>
	<?php }?>
	<?php if($dur==120)
	{?>
	<option value="120 days" selected >120 days</option>
	<?php
	}
	else
	{?>
	<option value="120 days">120 days</option>
	<?php }?>
	</select>
      
    </td>
  </tr>
  
  
  
<tr bgcolor="eeeee1"><td><?php if(!empty($err_payment))
 {?>
<font size=2 color=red><?php= $err_payment;?></font>
 <br>
 <b><font size=2 color=red>Payment Method</font></b>
 <?php
  }
  else
  {
 ?>
   Payment Method
   <?php }
   ?></td><td><select name="payment" onChange="pay_refresh()"><option value="0">Select</option>

<?php 
$pay_sql="select * from payment_gateway ";
$pay_res=mysql_query($pay_sql);
  while($pay_row=mysql_fetch_array($pay_res))
 {

  if(trim($pay_row['payment_gateway'])==trim($row[payment_gateway]))
  {
   ?>
  <option value="<?php= $pay_row['payment_gateway'] ;?>" selected><?php= $pay_row['payment_gateway']?></option>
  <?php 
  }
  else
    {
	?>
  <option value="<?php= $pay_row['payment_gateway']; ?>"><?php= $pay_row['payment_gateway']?></option>
  <?php
  }
}
   ?>
  </select></td></tr>
  
 
  
  
<tr bgcolor="eeeee1"><td><?php if(!empty($err_pay_id))
 {?>
<font size=2 color=red><?php= $err_pay_id;?></font>
 <br>
 <b><font size=2 color=red>Payment Id</font></b>
 <?php
  }
  else
  {
 ?>
   Payment Id
   <?php }
   ?> </td><td><input type="text" name="pay_id" value="<?php=$row[payment_id];?>"></td></tr>
   
  
   
<tr bgcolor="eeeee1"><td><?php if(!empty($err_pay_name))
 {?>
<font size=2 color=red><?php= $err_pay_name;?></font>
 <br>
 <b><font size=2 color=red>Payment Name</font></b>
 <?php
  }
  else
  {
 ?>
   Payment Name
   <?php }
   ?>  </td><td><input type="text" name="pay_name" value="<?php=$pay_gate?>"></td></tr>

<tr bgcolor="eeeee1"><td>Shipping Location</td><td>
<table>
<tr>
<td><input type="checkbox" name=world value="all" onClick="selectall()" <?php if($row['shipping_route']=='Australia Asia Americanada Europe Africa') echo 'Checked'?>>Worldwide</td>
<td><input type="checkbox" name=asia value="asia" <?php if($row['shipping_route']=='Australia Asia Americanada Europe Africa' || $row['shipping_route']=='Asia') echo 'checked'?>>Asia</td>
<td><input type="checkbox" name=aus value="aus" <?php if($row['shipping_route']=='Australia Asia Americanada Europe Africa' || $row['shipping_route']=='Australia') echo 'checked'?>>Australia</td></tr>
<tr><td><input type="checkbox" name=america value="america" <?php if($row['shipping_route']=='Australia Asia Americanada Europe Africa' || $row['shipping_route']=='America') echo 'checked'?>>America/Canada</td>
<td><input type="checkbox" name=africa value="africa" <?php if($row['shipping_route']=='Australia Asia Americanada Europe Africa' || $row['shipping_route']=='Africa') echo 'checked'?>>Africa</td>
<td><input type="checkbox" name=europe value="europe" <?php if($row['shipping_route']=='Australia Asia Americanada Europe Africa' || $row['shipping_route']=='Europe') echo 'checked'?>>Europe</td></tr>
</tr>
</table>
</td></tr>
<tr bgcolor="eeeee1"><td>
<?php if(!empty($err_ship))
 {?>
<font size=2 color=red><?php= $err_ship;?></font>
 <br>
 <b><font size=2 color=red>Shipping Amount</font></b>
 <?php
  }
  else
  {
 ?>
  Shipping Amount
   <?php }
   ?></td><td><input type="text" name="shipping_cost" value="<?php=$ship_amt?>"></td></tr>  

<tr bgcolor="eeeee1">
   <td >Image1</td>
   <td><input type="file" name="img1" value="<?php= $img1 ?>"><?php if(!empty($img1)){?>  <a href="full_size_image.php?img=<?php=$img1?>"><img src="../images/<?php=$img1?>" width=40 height="40"></a><?php }?></td></tr>
	<tr bgcolor="eeeee1">

   <td>Image2</td>
  
    <td><input type="file" name="img2" value=<?php=  $img2 ?>><?php if(!empty($img2)){?>   	<a href="full_size_image.php?img=<?php=$img2?>"><img src="../images/<?php=$img2?>" width=40 height="40"></a><?php }?></td></tr>
<tr bgcolor="eeeee1">

  <td>Image3</td>
   
  <td><input type="file" name="img3" value=<?php=  $img3  ?> ><?php if(!empty($img3)){?>   	<a href="full_size_image.php?img=<?php=$img3?>"><img src="../images/<?php=$img3?>" width=40 height="40"></a><?php }?> </td></tr>

<tr bgcolor="eeeee1">

   <td>Image4</td>
   
   <td> <input type="file" name="img4" value=<?php=  $img4 ?>><?php if(!empty($img4)){?>   	<a href="full_size_image.php?img=<?php=$img4?>"><img src="../images/<?php=$img4?>" width=40 height="40"></a><?php }?></td></tr>
<tr bgcolor="eeeee1">

   <td>Image5</td>
  
    <td><input type="file" name="img5" value=<?php=  $img5 ?>><?php if(!empty($img5)){?>   	<a href="full_size_image.php?img=<?php=$img5?>"><img src="../images/<?php=$img5?>" width=40 height="40"></a><?php }?></td></tr>

<tr bgcolor="eeeee1"><td></td><td>yes&nbsp;&nbsp;no</td></tr>
  
  <tr bgcolor="eeeee1"><td>Gallery Featured</td>
  <td>
  
    <input type="radio" name="gallery"  value="yes" <?php if($gallery_feature=='Yes'){?> checked <?php }?>>		
	<input type="radio" name="gallery"  value="no" <?php if($gallery_feature=='No'){?> checked <?php }?>>
		
	</td></tr> 
  
  
  <tr bgcolor="eeeee1"><td>Bold</td>
  <td>
    <input type="radio" name="bold"  value="yes" <?php if($bo_ld=='Yes'){?> checked <?php }?>>
	<input type="radio" name="bold"  value="no" <?php if($bo_ld=='No'){?> checked <?php }?>>
    </td></tr>
	  
  <tr bgcolor="eeeee1"><td>Home Feaured</td>
  <td>
  <input type="radio" name="home"  value="yes" <?php if($home_feature=='Yes'){?> checked <?php }?>>
  <input type="radio" name="home"  value="no" <?php if($home_feature=='No'){?> checked <?php }?>>
  </td></tr>
  <tr bgcolor="eeeee1"><td>Border</td>
  <td>
   <input type="radio" name="border" value="yes" <?php if($bor_der=='Yes'){?> checked <?php }?>>
  <input type="radio" name="border" value="no" <?php if($bor_der=='No'){?> checked <?php }?>>
  </td></tr>
  <tr bgcolor="eeeee1"><td>High Light</td>
  <td>
  <input type="radio" name="high"  value="yes" <?php if($highlight=='Yes'){?> checked <?php }?>>
  <input type="radio" name="high" value="no" <?php if($highlight=='No'){?> checked <?php }?>>
  </td></tr>
  <tr bgcolor="eeeee1"><td>Subtitle Featured</td>
  <td>
  <input type="radio" name="subtitle" value="yes" <?php if($subtitle_feature=='Yes'){?> checked <?php }?>>
  <input type="radio" name="subtitle" value="no" <?php if($subtitle_feature=='No'){?> checked <?php }?>>
  </td></tr>
  <tr bgcolor="eeeee1"><td>Subtitle</td><td><input type="text"  name="sub" value="<?php echo $sub_title ?>"></td></tr>

<input type="hidden" name="feature" value="yes">
 
<input type="hidden" name="flag" value="1">

<input type="hidden" name="cat" value="2">

<input type="hidden" name="item_id" value="<?php=$item;?> ">
   
    <tr><td colspan="2" align="center">
	<input type="submit" name="edit" value="Edit" class="button"></td></tr>
   
  
<?php

require 'include/footer.php';
?></table>
<script language="javascript">
function sel_method()
{

//document.auction_edit.item_id.value;
/*document.auction_edit.selling.value="auction";*/
document.auction_edit.flag.value=2;
document.auction_edit.submit();
}
function cat_change()
{
alert("hai");
//document.auction_edit.category.value;
document.auction_edit.cat.value=2; 
document.auction_edit.submit();
}

function selectall()
{
if(document.auction_edit.world.checked==false)
{
document.auction_edit.aus.checked=false;
document.auction_edit.america.checked=false;
document.auction_edit.europe.checked=false;
document.auction_edit.africa.checked=false;
document.auction_edit.asia.checked=false;
}
else
{
document.auction_edit.aus.checked=true;
document.auction_edit.america.checked=true;
document.auction_edit.europe.checked=true;
document.auction_edit.africa.checked=true;
document.auction_edit.asia.checked=true;
}
}
function pay_refresh()
{
	payment=document.auction_edit.payment.value;
	if(payment=="") {
		pay.innerHTML="";
	}
	else if(payment==1){ 
		txt="<input type=text name=payid value=<?php=$payid;?>>";
		pay.innerHTML="<b>Paypal Id</b>"+txt;
	}
	else if(payment==2){ 
		txt="<input type=text name=payid value=<?php=$payid;?>>";
		pay.innerHTML="<b>INT-Gold Id</b> "+txt;
	}
	else if(payment==3){ 
		txt="<input type=text name=payid value=<?php=$payid;?>>";
		txtname="<input type=text name=payname value=<?php= $payname; ?>>";
		pay.innerHTML="<b>E-Gold Id</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "+txt+"<br><b>E-Gold name</b>  "+txtname;
	}
	else if(payment==4){ 
		txt="<input type=text name=payid value=<?php=$payid;?>>";
		pay.innerHTML="<b>Money Bookers Id</b> "+txt;
	}
	else if(payment==5){ 
	txt="<input type=text name=payid value=<?php=$payid;?>>";
		txtname="<input type=text name=payname value=<?php= $payname; ?>>";
		pay.innerHTML="<b>E-Bullion Id</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "+txt+"<br><b>E-Bullion name</b>  "+txtname;
		}
    else if(payment==6){ 
		txt="<input type=text name=payid value=<?php=$payid;?>>";
		pay.innerHTML="<b>Stormpay Id</b> "+txt;
	}
	
}
</script>
</body>
</html>
