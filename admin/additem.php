<?php
/***************************************************************************
 *File Name				:additem.php
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
//echo"dd".$_SESSION['aid']=$aid;
$additem=$_POST['item_det'];
$admin_id=$_SESSION['admin_id'];
if($_GET[cat_id])
{
$cat_id=$_GET[cat_id];
$_SESSION[cat_id]=$cat_id;
}
else
{
$cat_id=$_SESSION[cat_id];
}
$sell_method=$_GET[radselling];
$flag=$_POST[flag];
if($flag==2)
{
$sub_cat=$_POST[cbosubcat];
$item_title=$_POST[txttitle];
$itemdes=$_POST['areades'];
$sell_method=$_POST[radselling];
$currency=$_POST[cbocurrency];
$size_of_qty=$_POST['size_of_qty'];
echo '<meta http-equiv="refresh" content="0;url=additem.php#txt_min_amt">';

if($flag==3)
{
$cat=$_POST[cat];
echo '<meta http-equiv="refresh" content="0;url=additem.php#cbosubcat">';
}
?>


<?php
}
if($flag==1)
{
$sub_cat=$_POST[cbosubcat];
$item_title=$_POST[txttitle];
$itemdes=$_POST['areades'];
$currency=$_POST['cbocurrency'];
$Gallery=$_POST['chkGallery'];
$Border=$_POST['chkBorder'];
$Highlight=$_POST['chkHighlight'];
$Bold=$_POST['chkBold'];
$Subtitle=$_POST['chkSubtitle'];
$Subtitle_name=$_POST['txtSubtitle'];
$Home=$_POST['chkHome'];

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

$sell_method=$_POST[radselling];
if($sell_method=="fix")
{
 $quick=$_POST[txt_quick]; 
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
else if($sell_method=="auction")
{
$min_amt=$_POST[txt_min_amt];
$rev_price=$_POST[txt_rev_price];
$bid_inc=$_POST[txt_bid_inc];
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
 if(empty($rev_price))
{
 $err_rev_price="PLease Enter this Information";
	 $err_flag=1;
}
else
{
 if(!is_numeric($rev_price))
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
 }  // else if($sell_method=="auction")
$qty=$_POST[txt_qty];
 if(empty($qty))
{
 $err_qty="PLease Enter this Information";
	 $err_flag=1;
}
else
{
 if(!is_numeric($qty))
	{
      $err_qty="Your Quantity is invalid";
	  $err_flag=1;
	}
}
$dur=$_POST[cbodur];
$currency=$_POST['cbocurrency'];
 if(empty($dur))
{
 $err_dur="PLease Enter this Information";
	 $err_flag=1;
}
 if(empty($currency))
{
 $err_cur="PLease Select this Information";
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
 else
 {
  $err_img1="PLease select image File";
  $err_flag=1;
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
 else
 {
  $err_img2="PLease select image File";
  $err_flag=1;
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
 else
 {
  $err_img3="PLease select image File";
  $err_flag=1;
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
 else
 {
  $err_img4="PLease select image File";
  $err_flag=1;
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
 else
 {
  $err_img5="Please select image File";
  $err_flag=1;
 }
 }

 if($err_flag!=1)
  {
  
  if(!empty($sub_cat))
  $cat_id=$sub_cat;
  $bid_starting_date=date("Y-m-d");
  $size_of_qty=$_POST['size_of_qty'];
   //$item_title=urlencode($item_title);
  $sql="insert into placing_item_bid(user_id,category_id,item_title,quantity,detailed_descrip, currency ,selling_method,min_bid_amount,bid_increment,duration,reserve_price,quick_buy_price,bid_starting_date,picture1,picture2,picture3,picture4,picture5,size_of_quantity)";
 	$sql.="values('$admin_id',$cat_id,'$item_title',$qty,'$itemdes','$currency ','$sell_method','$min_amt','$bid_inc','$dur','$rev_price','$quick','$bid_starting_date','$img1','$img2','$img3','$img4','$img5','$size_of_quantity')";
  $res=mysql_query($sql); 
  
 if($res)
   {
   $item_id=mysql_insert_id();
   if(!empty($Highlight) || !empty($Border) || !empty($Bold) || !empty($Gallery) || !empty($Subtitle) || !empty($Home))
   {
   $feature_sql="insert into featured_items(item_id,gallery_feature,home_feature,bold,border,highlight,subtitle_feature,subtitle)";
   $feature_sql.="values($item_id,'$Gallery','$Home','$Bold','$Border','$Highlight','$Subtitle','$Subtitle_name')";
   $feature_res=mysql_query($feature_sql);
   }
   echo "<b>Item Inserted</b>";
   exit();
   }
  }
 } //$flag==1
 $cat_id=$_POST['cat'];
?>
<link rel="stylesheet" href="include/style.css" type="text/css">
<style type="text/css">
<!--
.style1 {
	color: #666666;
	font-weight: bold;
}
.style3 {color: #666666; font-size: 11px; font-family:Arial, Helvetica, sans-serif}
-->
</style>
<form name="item_det" action="additem.php" method=post enctype="multipart/form-data">
  <table width="80%" cellpadding="5" cellspacing="2" bgcolor=#EEEEE1 align="center" class="tablebox">
        <tr>
      <td bgcolor="#cccccc" class="style1" colspan="2">Add a New Item</td>
    </tr>

      <?php
$sql="select *from category_master where category_head_id=0";
$exe=mysql_query($sql);
?>
    <tr>
      <td><strong>Category</strong></td>
    </tr>
    <tr>
      <td><select name="cat" onChange="category_ref()">
          <option value="0">Select</option>
          <?php 
while($ret=mysql_fetch_array($exe))
 {
  if(trim($ret['category_id'])==trim($cat_id))
  {
   ?>
          <option value="<?php= $ret['category_id'] ?>" selected>
          <?php= $ret['category_name']?>
          </option>
          <?php 
  }
 else
  {
	?>
          <option value="<?php= $ret['category_id'] ?>">
          <?php= $ret['category_name']?>
          </option>
          <?php
  }
 }
  ?>
        </select></td>
    </tr>
    <?php
 if($cat_id)
 {
  $sub_sql="select * from category_master where category_head_id=$cat_id";
 //$sub_sql="select * from category_master";
  $sub_res=mysql_query($sub_sql);
  $sub_tot=mysql_num_rows($sub_res);
 }
?>
    <tr>
      <td><font size=2 ><b>Sub Category</b></font></td>
    </tr>
    <tr>
      <td><select name=cbosubcat>
          <option value="0">Select</option>
          <?php
 while($sub_row=mysql_fetch_array($sub_res))
 {
  if(trim($sub_row['category_head_id'])==trim($cat_id))
  {
   ?>
          <option value="<?php= $sub_row['category_id'] ?>" selected>
          <?php= $sub_row['category_name']?>
          </option>
          <?php 
  }
  else
    {
	?>
          <option value="<?php= $sub_row['category_id'] ?>">
          <?php= $sub_row['category_name']?>
          </option>
          <?php
  }
  }
  ?>
        </select> </td>
    </tr>
    <tr>
      <td> 
        <?php if(!empty($err_title))
 {?>
        <img src="images/warning_9x10.gif">&nbsp;<font size=2 color=red>
        <?php= $err_title ?>
        </font> <br> <b><font size=2 color=red>Item title</font></b> 
        <?php
  }
  else
  {
 ?>
        <b><font size=2 >Item title</font></b> 
        <?php }
   ?>
      </td>
    </tr>
    <tr>
      <td width=250><input type="text" name="txttitle" class="txtbig" value=<?php= $item_title; ?>> 
      </td>
    </tr>
    <tr>
      <td> 
        <?php if(!empty($err_des))
 {
 ?>
        <img src="images/warning_9x10.gif">&nbsp;<font size=2 color=red>
        <?php= $err_des; ?>
        </font> <br> <b><font size=2 color=red>Item Description</font></b> 
        <?php
  }
  else
  {
   ?>
        <b><font size=2 >Item Description</font></b> 
        <?php }
   ?>
      </td>
    </tr>
    <tr>
      <td width="100%"> <textarea rows="5" cols="35" name="areades"><?php= $itemdes; ?></textarea>
        <br> <font size=2 class="hint_font">Describe your items features, benefits, 
        and condition. Be sure to include in your description: Condition (new, 
        used, etc.)</font></td></td>
    </tr>
    <tr class="tr_border" width=758>
      <td colspan="2"><font size="2"><b>Selling Method</b></font></td>
    </tr>
    <?php if(!empty($err_cur))
 {
 ?>
    <tr>
      <td><font size=2 color=red><b>Currency</b></font></td>
    </tr>
    <?php
}
else
{
?>
    <tr>
      <td><font size=2 ><b>Currency</b></font></td>
    </tr>
    <?php
}
?>
    <tr>
      <td><select name=cbocurrency>
          <option value=0>Select</option>
          <?php 
$cur_sql="select * from currency_master";
$cur_res=mysql_query($cur_sql);
  while($currency_row=mysql_fetch_array($cur_res))
 {
  if(trim($currency_row['currency'])==trim($currency))
  {
   ?>
          <option value="<?php= $currency_row['currency'] ?>" selected>
          <?php= $currency_row['currency']?>
          </option>
          <?php 
  }
  else
    {
	?>
          <option value="<?php= $currency_row['currency'] ?>">
          <?php= $currency_row['currency']?>
          </option>
          <?php
  }
  }
  ?>
        </select> </td>
    </tr>
    <?php 
 $flag;
 if(empty($flag))
{
?>
    <tr>
      <td><input type="radio" name=radselling  value="fix" checked> <font size="2"><b>Fixed 
        Sale Price</b></font> <input type="radio" name=radselling onClick="sel_method()" value="auction"> 
        <font size="2"><b>Auction</b></font></td>
    </tr>
    <tr>
      <td> 
        <?php if(!empty($err_fix_price))
 {?>
        <img src="images/warning_9x10.gif">&nbsp;<font size=2 color=red>
        <?php= $err_fix_price; ?>
        </font> <br> <b><font size=2 color=red>Quick Buy Price</font></b> 
        <?php
  }
  else
  {
 ?>
        <b><font size=2 >Quick Buy Price</font></b> 
        <?php }
   ?>
      </td>
    </tr>
    <tr>
      <td width=250 ><input type="text" name="txt_quick" class="txtsmall" value=<?php= $quick; ?>></td>
    </tr>
    <?php
}

if($sell_method=="fix")
{
?>
    <tr>
      <td><input type="radio" onClick="sel_method()"  name=radselling  value="auction" > 
        <font size="2"><b>Auction</b></font> <input type="radio" name=radselling onClick="sel_method()" value="fix" checked> 
        <font size="2"><b>Fixed Sale Price</b></font></td>
    </tr>
    <tr>
      <td> 
        <?php if(!empty($err_fix_price) )
 {?>
        <img src="images/warning_9x10.gif">&nbsp;<font size=2 color=red>
        <?php= $err_fix_price; ?>
        </font> <br> <b><font size=2 color=red>Quick Buy Price</font></b> 
        <?php
  }
  else
  {
 ?>
        <b><font size=2 >Quick Buy Price</font></b> 
        <?php }
   ?>
      </td>
    </tr>
    <tr >
      <td width=250 > <input type="text" name="txt_quick" class="txtsmall" value=<?php= $quick; ?>></td>
    </tr>
    <?php
}
else if(trim($sell_method)==trim("auction"))
{
?>
    <tr>
      <td><input type="radio" name=radselling onClick="sel_method()" value="auction" checked> 
        <font size="2"><b>Auction</b></font> <input type="radio" name=radselling onClick="sel_method()" value="fix"> 
        <font size="2"><b>Fixed Sale Price</b></font></td>
    </tr>
    <tr>
      <td width="250"> 
        <?php if(!empty($err_min_amt))
 {?>
        <img src="images/warning_9x10.gif">&nbsp;<font size=2 color=red>
        <?php= $err_min_amt?>
        </font> <br> <b><font size=2 color=red>Minimum Bid Amount</font></b> 
        <?php
 }
 else
 {
 ?>
        <b><font size=2 >Minimum Bid Amount</font></b> 
        <?php
  }
 ?>
      </td>
      <td> 
        <?php if(!empty($err_rev_price))
 {?>
        <img src="images/warning_9x10.gif">&nbsp;<font size=2 color=red>
        <?php= $err_rev_price?>
        </font> <br> <b><font size=2 color=red>Reserve Price</font></b> 
        <?php
  }
  else
  {
 ?>
        <b><font size=2 >Reserve Price</font></b> 
        <?php }
  ?>
      </td>
    </tr>
    <tr>
      <td width=250><input type="text" name="txt_min_amt" class="txtsmall" value=<?php= $min_amt; ?>></td>
      <td width=250><input type="text" name="txt_rev_price" class="txtsmall" value=<?php= $rev_price; ?>></td>
    </tr>
    <tr>
      <td> 
        <?php if(!empty($err_bid_inc))
 {?>
        <img src="images/warning_9x10.gif">&nbsp;<font size=2 color=red>
        <?php= $err_bid_inc?>
        </font> <br> <b><font size=2 color=red>Bid Increment</font></b> 
        <?php
  }
  else
  {
 ?>
        <b><font size=2>Bid Increment</font></b> 
        <?php }
   ?>
      </td>
    </tr>
    <tr>
      <td width=250><input type="text" name="txt_bid_inc" class="txtsmall" value=<?php= $bid_inc; ?>></td>
    </tr>
    <?php 
}
  ?>
    <tr>
      <td> 
        <?php if(!empty($err_qty))
   {
 ?>
        <img src="images/warning_9x10.gif">&nbsp;<font size=2 color=red>
        <?php= $err_qty?>
        </font> <br> <b><font size=2 color=red>Quantity</font></b> 
        <?php
  }
  else
  { ?>
        <b><font size=2 >Quantity</font></b> 
        <?php }
   ?>
      </td>
      <td> 
        <?php if(!empty($err_dur))
 {?>
        <img src="images/warning_9x10.gif">&nbsp;<font size=2 color=red>
        <?php= $err_dur; ?>
        </font> <br> <b><font size=2 color=red>Duration</font></b> 
        <?php
  }
  else
  {
 ?>
        <b><font size=2 >Duration</font></b> 
        <?php 
   }
   ?>
      </td>
    </tr>
    <tr>
      <td width=250><input type="text" name="txt_qty" class="txtsmall" value=<?php= $qty; ?>></td>
      <td width=250><select name="cbodur">
          <option value="0">Select</option>
          <?php if($dur==30)
{
?>
          <option value=30 selected>30 Days</option>
          <?php
}
else
{
 ?>
          <option value=30>30 Days</option>
          <?php
 }
  ?>
          <?php if($dur==60)
{
?>
          <option value=60 selected>60 Days</option>
          <?php
}
else
{
 ?>
          <option value=60>60 Days</option>
          <?php
 }
  ?>
          <?php if($dur==90)
{
?>
          <option value=90 selected>90 Days</option>
          <?php
}
else
{
 ?>
          <option value=90>90 Days</option>
          <?php
 }
  ?>
          <?php if($dur==120)
{
?>
          <option value=120 selected>120 Days</option>
          <?php
}
else
{
 ?>
          <option value=120>120 Days</option>
          <?php
 }
  ?>
        </select></td>
    </tr>
    <?php $size=$_POST['size_of_qty'];
if($size)
{?>
    <tr>
      <td>Size of Selling</td>
    </tr>
    <tr>
      <td><select name="size_of_qty">
          <option value="Select">Select</option>
          <option value="Pieces">Pieces</option>
          <option value="Dozens">Dozens</option>
        </select> 
        <?php
}else
{
//echo ("pls select size of quantity");
}?>
      </td>
    </tr>
    <tr class="tr_border" width=758>
      <td colspan="2"><font size="2"><b>Add Images</font></b></td>
    </tr>
    <tr>
      <td colspan="2"> 
        <?php if(!empty($err_img1))
 {?>
        <img src="images/warning_9x10.gif">&nbsp;<font size=2 color=red>
        <?php= $err_img1; ?>
        </font> <br> <b><font size=2 color=red>Image1</font></b> 
        <?php
  }
  else
  {
 ?>
        <b><font size=2 >Image1</font></b> 
        <?php }
   ?>
        <input type="file" name="img1" value="<?php= $img1; ?>"></td>
    </tr>
    <tr>
      <td colspan="2"> 
        <?php if(!empty($err_img2))
 {?>
        <img src="images/warning_9x10.gif">&nbsp;<font size=2 color=red>
        <?php= $err_img2; ?>
        </font> <br> <b><font size=2 color=red>Image2</font></b> 
        <?php
  }
  else
  {
 ?>
        <b><font size=2 >Image2</font></b> 
        <?php }
   ?>
        <input type="file" name="img2" value=<?php= $img2; ?>></td>
    </tr>
    <tr>
      <td colspan="2"> 
        <?php if(!empty($err_img3))
 {?>
        <img src="images/warning_9x10.gif">&nbsp;<font size=2 color=red>
        <?php= $err_img3; ?>
        </font> <br> <b><font size=2 color=red>Image3</font></b> 
        <?php
  }
  else
  {
 ?>
        <b><font size=2 >Image3</font></b> 
        <?php }
   ?>
        <input type="file" name="img3" value=<?php= $img3; ?>></td>
    </tr>
    <tr>
      <td colspan="2"> 
        <?php if(!empty($err_img4))
 {?>
        <img src="images/warning_9x10.gif">&nbsp;<font size=2 color=red>
        <?php= $err_img4; ?>
        </font> <br> <b><font size=2 color=red>Image4</font></b> 
        <?php
  }
  else
  {
 ?>
        <b><font size=2 >Image4</font></b> 
        <?php }
 ?>
        <input type="file" name="img4" value=<?php= $img4; ?>></td>
    </tr>
    <tr>
      <td colspan="2"> 
        <?php if(!empty($err_img5))
 {?>
        <img src="images/warning_9x10.gif">&nbsp;<font size=2 color=red>
        <?php= $err_img5; ?>
        </font> <br> <b><font size=2 color=red>Image5</font></b> 
        <?php
  }
  else
  {
 ?>
        <b><font size=2 >Image5</font></b> 
        <?php 
   }
   ?>
        <input type="file" name="img5" value=<?php= $img5; ?>></td>
    </tr>
    <tr class="tr_border" width=758>
      <td height="38" colspan="2"><font size="2"><b> Increase your item's visibility 
        </font></b></td>
    </tr>
    <tr>
      <td> <br> </td>
    </tr>
    <tr>
      <td> 
        <?php if(!empty($Gallery))
	{
	?>
        <input type="checkbox" name=chkGallery value="yes" checked> 
        <?php
	}
	else
	{
	?>
        <input type="checkbox" name=chkGallery value="yes"> 
        <?php
	}
	$sql="select * from admin_rates";
	$exe=mysql_query($sql);
	$ret=mysql_fetch_array($exe);
	$gret=$ret['gallery_price'];
    $hret=$ret['homepage_price'];
	$sret=$ret['subtitle_price'];
	$bret=$ret['bold_price'];
	$highret=$ret['highlight_price'];
	?>
        <font size=2 >Gallery $(
        <?php=$gret; ?>
        ) [Requires a picture,<a href="additem.php#img1"> add a picture now </a>] 
        <br>
        Add a small version of your first picture to Search and Listings. </font> 
      </td>
    </tr>
    <tr>
      <td> 
        <?php if(!empty($Home))
	{
	?>
        <input type="checkbox" name=chkHome value="yes" checked> 
        <?php
	}
	else
	{
	?>
        <input type="checkbox" name=chkHome value="yes"> 
        <?php
	}
	?>
        <font size=2> Home Page Featured $(
        <?php=$hret; ?>
        ) for 1 item, 
        <?php=$hret*$hret; ?>
        &nbsp; for 2 or more items) </font> </td>
    </tr>
    <tr>
      <td> 
        <?php 
	if(!empty($Subtitle))
	{
	?>
        <input type="checkbox" name=chkSubtitle value="yes" checked> 
        <?php
	}
	else
	{
	?>
        <input type="checkbox" name=chkSubtitle value="yes"> 
        <?php
	}
	?>
        <font size=2 >SubTitle $(
        <?php=$sret; ?>
        )<br>
        Add a Subtitle to give buyers more information. </font> </td>
    </tr>
    <tr>
      <td width=250 > <input type="text" name="txtSubtitle" class="txtbig" value=<?php= $Subtitle_name; ?>></td>
    </tr>
    <tr>
      <td> 
        <?php if(!empty($Bold))
	{
	?>
        <input type="checkbox" name=chkBold value="yes" checked> 
        <?php
	}
	else
	{
	?>
        <input type="checkbox" name=chkBold value="yes"> 
        <?php
	}
	?>
        <font size=2 >Bold $(
        <?php=$bret ?>
        ) <br>
        Attract buyers' attention and set your listing apart - use <b>Bold</b>. 
        </font> </td>
    </tr>
    <!--	<tr><td>
	<?php if(!empty($Border))
	{
	?>
	<input type="checkbox" name=chkBorder value="yes" checked>
	<?php
	}
	else
	{
	?>
	<input type="checkbox" name=chkBorder value="yes">
	<?php
	}
	?>
     <font size=2 >	Border ($3.00) <br>
    Get noticed - outline your listing with an eye-catching frame. 
    </font>
 	</td></tr> -->
    <tr>
      <td> 
        <?php if(!empty($Highlight))
	{
	?>
        <input type="checkbox" name=chkHighlight value="yes" checked> 
        <?php
	}
	else
	{
	?>
        <input type="checkbox" name=chkHighlight value="yes"> 
        <?php
	}
	?>
        <font size=2>Highlight $(
        <?php=$highret; ?>
        ) <br>
        Make your listing stand out with a colored band in Search results. </font> 
      </td>
    </tr>
    <input type="hidden" name=flag value="1">
    <tr>
      <td colspan="2" align="center"> <input type="submit" name=detsub value=Continue></td>
    </tr>
  </table>
   </form>
   <?php require 'include/footer.php'; ?>
   
<script language="javascript">
function sel_method()
{
document.item_det.radselling.value="auction";
document.item_det.flag.value=2;
document.item_det.submit();
}
function category_ref()
{

document.item_det.flag.value=3;
document.item_det.submit();
}

</script>
  </body>
</html>