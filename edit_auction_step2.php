<?php
/***************************************************************************
 *File Name				:edit_auction_step2.php
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
error_reporting(0);
require 'include/connect.php';
if($_GET['item_id'])
$_SESSION['item_id']=$_GET['item_id'];
$flag=$_POST['flag'];
if($_SESSION['item_id'])
{
$item_id=$_SESSION['item_id'];
}
if(empty($flag))
{
$sql="select * from placing_item_bid where item_id=$item_id";
$res=mysql_query($sql);
$row=mysql_fetch_array($res); 
$fea_item="select * from featured_items where item_id=$item_id";
$fea_res=mysql_query($fea_item);
$fea_row=mysql_fetch_array($fea_res);
$admin_end_sql="select * from admin_settings where set_id=24";
$admin_end_res=mysql_query($admin_end_sql);
$admin_end_row=mysql_fetch_array($admin_end_res);
$auction_query="select * from admin_settings where set_id=42";
$table=mysql_query($auction_query);
$rowtab=mysql_fetch_array($table);
$bid_permission=$rowtab['set_value'];
$sell_format=$_SESSION[sell_format];
$start_delay=$_SESSION[start_delay];
$_SESSION[quick]=$row[quick_buy_price]; 
$quick=$_SESSION[quick];
$_SESSION[min_amt]=$row[min_bid_amount];
$min_amt=$_SESSION[min_amt];
$_SESSION[rev_price]=$row[reserve_price];
$rev_price=$_SESSION[rev_price];
$_SESSION[bid_inc]=$row[bid_increment];
$bid_inc=$_SESSION[bid_inc];
$_SESSION[privatelistings]=$row[privatelistings];
$bid_permission=$_SESSION[privatelistings];
$_SESSION[listingdesinger]=$listingdesinger;
$listingdesinger=$row[listingdesinger];

$theme_sql="select * from themes_master where themes_id=".$row['themes_id'];
$theme_res=mysql_query($theme_sql);
$theme_rows=mysql_num_rows($theme_res);
if($theme_rows>0)
{
$theme_row=mysql_fetch_array($theme_res);
$_SESSION[theme_id]=$theme_row[themes_id];
$_SESSION[theme]=$theme_row[themes];
}
else
{
$_SESSION[theme_id]='0';
$_SESSION[theme]="none.gif";
}
$theme=$_SESSION[theme];
$_SESSION[layout]=$row[layout];
$layout=$_SESSION[layout];
$_SESSION[$qty]=$row[Quantity];
$qty=$_SESSION[$qty];
$_SESSION[image1]=$row[picture1];
$img1=$_SESSION[img1];
$_SESSION[image2]=$row[picture2];
$img2=$_SESSION[img2];
$_SESSION[image3]=$row[picture3];
$img3=$_SESSION[img3];
$_SESSION[image4]=$row[picture4];
$img4=$_SESSION[img4];
$_SESSION[image5]=$row[picture5];
$img5=$_SESSION[img5];
$_SESSION[$image6]=$row[picture6];
$img6=$_SESSION[img6];
$_SESSION[image7]=$row[picture7];
$img7=$_SESSION[img7];
//$_SESSION['uploadflv']=$row[videofile];
$videofileup=$row[videofile];
$videolinkup=$row[videolink];
//$_SESSION['uploadflv']=$videofileup; 
$_SESSION[gallery_feature]=$fea_row[gallery_feature];
$Gallery=$_SESSION[gallery_feature]; 
$_SESSION[highlight]=$fea_row[highlight];
$Highlight=$_SESSION[highlight];
$_SESSION[Bold]=$fea_row[bold];
$Bold=$_SESSION[Bold];
//$_SESSION[Subtitle]=$fea_row[subtitle_feature];
//$subtitle=
//_SESSION[Subtitle_name]=$fea_row[subtitle];
$_SESSION[Home]=$fea_row[home_feature];
$Home=$_SESSION[Home];
$_SESSION[item_counter_style]=$row[item_counter_style];
$item_counter_style=$_SESSION[item_counter_style];

$_SESSION[size_of_qty]=$edit_row[size_of_quantity];
$_SESSION[sell_method]=$edit_row[selling_method];
//$_SESSION[shipping_route]=$edit_row[shipping_route];
//$_SESSION[shipping_amt]=$edit_row[shipping_cost];
//$_SESSION[tax]=$edit_row[tax];
//$shipping_amt=$row[shipping_cost];
//$tax=$row[tax];
}
if($flag==1)
{
 //$interval=$_POST['cbodur'];
 $min_amt=$_POST['txt_min_amt'];
 $rev_price=$_POST['txt_rev_price'];
 $quick=$_POST['txt_quick'];
 $privatelistings=$_POST['chkprivatelisting'];

//$currency=$_POST['cbocurrency'];
 $item_counter_style=$_POST['item_counter_style'];
$start_delay=$_POST['cbo_start_delay'];
$Gallery=$_POST['chkGallery'];
$_SESSION[Gallery]=$Gallery;
//$Border=$_POST['chkBorder'];
 $Highlight=$_POST['chkHighlight'];
$_SESSION[Highlight]=$Highlight;
//$sell_format=$_SESSION[sell_format];
 $Bold=$_POST['chkBold'];
$_SESSION[Bold]=$Bold;

//$subtitlepromoting=$_POST['chkSubtitle'];
// $subtitle=$_POST['txtSubtitle'];
 $Home=$_POST['chkHome'];
$_SESSION[Home]=$Home;
if($_POST[chklisting])
{
$listingdesinger=$_POST[chklisting];
$theme=$_POST[cbotheme];
$layout=$_POST[cbolayout];
}

//$quick=$_POST[txt_quick];
//$privatelistings=$_POST[chkprivatelisting];
$img1=$_FILES['img1']['name'];
$img2=$_FILES['img2']['name'];
$img3=$_FILES['img3']['name'];
$img4=$_FILES['img4']['name'];
$img5=$_FILES['img5']['name'];
$img6=$_FILES['img6']['name'];
$img7=$_FILES['img7']['name'];
if(!empty($img1))
{
 $type1=$_FILES['img1']['type'];
  
 if($type1=="image/pjpeg" || $type1=="image/gif" || $type1=="image/jpeg" || $type1=="image/bmp")
 {
  srand();
  $rad1=substr(md5(rand(0,1000)),0,5); 
  $img1=urlencode($img1);
  $date_con=date("Y-m-d"); 
  $img_name1="$date_con"."_"."$rad1"."_"."$img1";
  $uploaddir="images/$img_name1";
  move_uploaded_file($_FILES['img1']['tmp_name'],$uploaddir);
  chmod ("$uploaddir",0755); 
  $_SESSION[img1]=$_FILES['img1']['name'];
  $_SESSION[image1]=$img_name1;
  $img1=$_SESSION[image1];

 }
 else
 {
$select_sql="select * from error_message where err_id =8";
$select_tab=mysql_query($select_sql);
$select_row=mysql_fetch_array($select_tab);
$err_img1=$select_row[err_msg];
$err_flag=1;
 }
 }
else
{
$img1=$_SESSION[image1]; 
}
if(!empty($img2))
{
 $type2=$_FILES['img2']['type'];
 if($type2=="image/pjpeg" || $type2=="image/gif" || $type2=="image/jpeg" || $type2=="image/bmp")
 {
  srand();
  $rad1=substr(md5(rand(0,1000)),0,5); 
  $img2=urlencode($img2);
 $date_con=date("Y-m-d"); 
  $img_name2="$date_con"."_"."$rad1"."_"."$img2";
  $uploaddir="images/$img_name2";
  move_uploaded_file($_FILES['img2']['tmp_name'],$uploaddir);
  chmod ("$uploaddir",0755); 
  $_SESSION[img2]=$_FILES['img2']['name'];
  $_SESSION[image2]=$img_name2;
  $img2=$_SESSION[image2];
 }
 else
 {
  $select_sql="select * from error_message where err_id =8";
  $select_tab=mysql_query($select_sql);
  $select_row=mysql_fetch_array($select_tab);
  $err_img2=$select_row[err_msg];
  $err_flag=1;
 }
 }
else
{
$img2=$_SESSION[image2]; 
} 

if(!empty($img3))
{
 $type3=$_FILES['img3']['type'];
 if($type3=="image/pjpeg" || $type3=="image/gif" || $type3=="image/jpeg" || $type3=="image/bmp")
 {
  $rad1=substr(md5(rand(0,1000)),0,5);  
  $img3=urlencode($img3);
  $date_con=date("Y-m-d"); 
  $img_name3="$date_con"."_"."$rad1"."_"."$img3";
  $uploaddir="images/$img_name3";
  move_uploaded_file($_FILES['img3']['tmp_name'], $uploaddir);
  chmod ("$uploaddir",0755); 
  $_SESSION[img3]=$_FILES['img3']['name'];
  $_SESSION[image3]=$img_name3;
  $img3=$_SESSION[image3];
}
else
{
$select_sql="select * from error_message where err_id =8";
$select_tab=mysql_query($select_sql);
$select_row=mysql_fetch_array($select_tab);
$err_img3=$select_row[err_msg];
$err_flag=1;
}
}
else
{
$img3=$_SESSION[image3]; 
}

if(!empty($img4))
{
 $type2=$_FILES['img4']['type'];
 if($type2=="image/pjpeg" || $type2=="image/gif" || $type2=="image/jpeg" || $type2=="image/bmp")
 {
  srand();
  $rad1=substr(md5(rand(0,1000)),0,5); 
  $img4=urlencode($img4);
  $date_con=date("Y-m-d"); 
  $img_name="$date_con"."_"."$rad1"."_"."$img4";
  $uploaddir="images/$img_name";
  move_uploaded_file($_FILES['img4']['tmp_name'],$uploaddir);
  chmod ("$uploaddir",0755); 
  $_SESSION[img4]=$_FILES['img4']['name'];
  $_SESSION[image4]=$img_name;
  $img4=$_SESSION[image4];
 }
 else
 {
  $select_sql="select * from error_message where err_id =8";
  $select_tab=mysql_query($select_sql);
  $select_row=mysql_fetch_array($select_tab);
  $err_img4=$select_row[err_msg];
  $err_flag=1;
 }
 }
else
{
$img4=$_SESSION[image4]; 
}

if(!empty($img5))
{
  $type2=$_FILES['img5']['type'];
 if($type2=="image/pjpeg" || $type2=="image/gif" || $type2=="image/jpeg" || $type2=="image/bmp")
 {
  srand();
  $rad1=substr(md5(rand(0,1000)),0,5); 
  $img5=urlencode($img5);
  $date_con=date("Y-m-d"); 
  $img_name="$date_con"."_"."$rad1"."_"."$img5";
  $imgname="$username"."$rad1"."$img5";
  $uploaddir="images/$imgname";
  move_uploaded_file($_FILES['img5']['tmp_name'],$uploaddir);
  chmod ("$uploaddir",0755); 
  $_SESSION[img5]=$_FILES['img5']['name'];
  $_SESSION[image5]=$imgname;
  $img5=$_SESSION[image5];

 }
 else
 {
  $select_sql="select * from error_message where err_id =8";
  $select_tab=mysql_query($select_sql);
  $select_row=mysql_fetch_array($select_tab);
  $err_img5=$select_row[err_msg];
  $err_flag=1;
 }
 }
 else
{
$img5=$_SESSION[image5]; 
}


if(!empty($img6))
{
 $type2=$_FILES['img6']['type'];
 if($type2=="image/pjpeg" || $type2=="image/gif" || $type2=="image/jpeg" || $type2=="image/bmp")
 {
  srand();
  $rad1=substr(md5(rand(0,1000)),0,5); 
  $img6=urlencode($img6);
  $date_con=date("Y-m-d"); 
  $img_name6="$date_con"."_"."$rad1"."_"."$img6";
  $uploaddir="images/$img_name6";
  move_uploaded_file($_FILES['img6']['tmp_name'],$uploaddir);
  chmod ("$uploaddir",0755); 
  $_SESSION[img6]=$_FILES['img6']['name'];
  $_SESSION[image6]=$img_name6;
  $img6=$_SESSION[image6];
 }
 else
 {
  $select_sql="select * from error_message where err_id =8";
  $select_tab=mysql_query($select_sql);
  $select_row=mysql_fetch_array($select_tab);
  $err_img6=$select_row[err_msg];
  $err_flag=1;
 }
 }
 else
{
$img6=$_SESSION[image6]; 
}

if(!empty($img7))
{
 $type2=$_FILES['img7']['type'];
 if($type2=="image/pjpeg" || $type2=="image/gif" || $type2=="image/jpeg" || $type2=="image/bmp")
 {
  srand();
  $rad1=substr(md5(rand(0,1000)),0,5); 
  $img7=urlencode($img7);
  $date_con=date("Y-m-d"); 
  $img_name7="$date_con"."_"."$rad1"."_"."$img7";
  $uploaddir="images/$img_name7";
  move_uploaded_file($_FILES['img7']['tmp_name'],$uploaddir);
  chmod ("$uploaddir",0755); 
  $_SESSION[img7]=$_FILES['img7']['name'];
  $_SESSION[image7]=$img_name7;
  $img7=$_SESSION[image7];
 }
 else
 {
  $select_sql="select * from error_message where err_id =8";
  $select_tab=mysql_query($select_sql);
  $select_row=mysql_fetch_array($select_tab);
  $err_img7=$select_row[err_msg];
  $err_flag=1;
 }
 }
 else
{
$img7=$_SESSION[image7]; 
}

$videolinkup=$_POST['videolink'];
$videofileup=$_POST['videofile'];
//$videofileup=htmlentities($videofileup);





// $subtitle=$_POST['txtSubtitle'];
//$Home=$_POST['chkHome'];
if(!empty($quick))
{
if(!is_numeric($quick))
{
$select_sql="select * from error_message where err_id =21";
$select_tab=mysql_query($select_sql);
$select_row=mysql_fetch_array($select_tab);
    $err_fix_price=$select_row[err_msg];
	  $err_flag=1;
	}
}
if($_SESSION[sell_format]!="3")
{
$min_amt=$_POST[txt_min_amt];
$rev_price=$_POST[txt_rev_price];
$bid_inc=$_POST[txt_bid_inc];
 if(empty($min_amt))
{
$select_sql="select * from error_message where err_id =21";
$select_tab=mysql_query($select_sql);
$select_row=mysql_fetch_array($select_tab);
$err_min_amt=$select_row['err_msg'];
 $err_flag=1;
}
else
{
 if(!is_numeric($min_amt))
	{
$select_sql="select * from error_message where err_id =18";
$select_tab=mysql_query($select_sql);
$select_row=mysql_fetch_array($select_tab);

      $err_min_amt=$select_row[err_msg];
	  $err_flag=1;
	}
}

if(!empty($rev_price))
{
 if(!is_numeric($rev_price))
	{
$select_sql="select * from error_message where err_id =16";
$select_tab=mysql_query($select_sql);
$select_row=mysql_fetch_array($select_tab);
$err_rev_price=$select_row[err_msg];
$err_flag=1;
	}
}

if($bid_permission=='yes')
{
 if(empty($bid_inc))
{
$select_sql="select * from error_message where err_id =21";
$select_tab=mysql_query($select_sql);
$select_row=mysql_fetch_array($select_tab);
 $err_bid_inc=$select_row['err_msg'];
	 $err_flag=1;
}
else
{
 if(!is_numeric($bid_inc))
	{
	$select_sql="select * from error_message where err_id =12";
	$select_tab=mysql_query($select_sql);
	$select_row=mysql_fetch_array($select_tab);

      $err_bid_inc=$select_row['err_msg'];
	  $err_flag=1;
	}
}
}
} // if($_SESSION[sell_method]!="fix")
if($_SESSION[sell_method]=='dutch_auction')
{
$qty=$_POST[txt_qty];
 if(empty($qty))
{
$select_sql="select * from error_message where err_id =21";
$select_tab=mysql_query($select_sql);
$select_row=mysql_fetch_array($select_tab);
 $err_qty=$select_row[err_msg];
	 $err_flag=1;
}
else
{
 if(!is_numeric($qty))
	{
$select_sql="select * from error_message where err_id =10";
$select_tab=mysql_query($select_sql);
$select_row=mysql_fetch_array($select_tab);
     $err_qty=$select_row[err_msg];
	  $err_flag=1;
	}
}
}
  if($err_flag!=1)
  {
  	
   if($theme)
   {
   $theme_sql="select * from themes_master where themes='$theme'";
   $theme_res=mysql_query($theme_sql);
   $theme_row=mysql_fetch_array($theme_res);
   $theme_id=$theme_row[themes_id];
   }
   
   
   //$_SESSION[listingdesinger]=$listingdesinger;
   //$_SESSION[privatelistings]=$privatelistings;
   //d$_SESSION['Insertionfee']="yes";
   
$up="update placing_item_bid set min_bid_amount='$min_amt',
reserve_price='$rev_price',quick_buy_price='$quick',picture1='$img1',picture2='$img2',picture3='$img3',picture4='$img4',
picture5='$img5',picture6='$img6',picture7='$img7',themes_id='$theme_id',item_counter_style='$item_counter_style',
listingdesinger='$listingdesinger',privatelistings='$privatelistings',layout='$layout',videofile='$videofileup',videolink='$videolinkup' where item_id=$item_id";

$upqry=mysql_query($up);
//checking whether the item has already been listed in featured items
$fea_sql=mysql_query("select * from featured_items where item_id=$item_id");
$fea_num=mysql_num_rows($fea_sql);
if($fea_num > 0)
{
 $feature_sql="update featured_items set gallery_feature='$Gallery',home_feature='$Home',bold='$Bold',
highlight='$Highlight' where item_id=$item_id";
$re_res=mysql_query($feature_sql);
 }
 else
 {
 $feature_sql="insert into featured_items (gallery_feature,home_feature,bold,highlight,item_id) values('$Gallery','$Home','$Bold','$Highlight','$item_id')";
 mysql_query($feature_sql);
 } 
  
  
$fee_sql="select * from admin_rates";
$fee_res=mysql_query($fee_sql);
$fee_row=mysql_fetch_array($fee_res);
if($_SESSION[gallery])
$gallery_price=$fee_row[gallery_price];
if($_SESSION[Highlight])
$highlight_price=$fee_row[highlight_price];
if($_SESSION[Bold])
$bold_price=$fee_row[bold_price];
if($_SESSION[Home])
$homepage_price=$fee_row[homepage_price];
// $insertion_fee=$fee_row[Insertion_fee];
 if($_SESSION[listingdesinger])
 $listing_desinger_fee=$fee_row[listing_designer_fee];
 //if($Subtitle)
 //$subtitlefee=$fee_row[subtitle_price];
 //if($rev_price)
// $reserve_fee=$fee_row[reserve_price_fee];
 $feature_sql="update auction_fees set gallery_fee='$gallery_price',homepage_featureditem_fee='$homepage_price', boldlisting_fee='$bold_price',highlighted_fee='$highlight_price',listing_desinger_fee='$listing_desinger_fee' where item_id=$item_id";
 $feature_res=mysql_query($feature_sql);
  
  echo '<meta http-equiv="refresh" content="0;url=edit_auction_step3.php?item_id='.$item_id.'">';
  echo "You have been Re-Directed, if not Please <a href=edit_auction_step3.php?item_id=$item_id>Click here</a>";
  exit();
    } 

  }

require 'include/top.php';
require 'templates/editpromotionlistings.tpl'; 
require 'include/footer.php';

?>


<script language="javascript">
function selectall()
{
if(document.ship.world.checked==false)
{
document.ship.aus.checked=false;
document.ship.america.checked=false;
document.ship.europe.checked=false;
document.ship.africa.checked=false;
document.ship.asia.checked=false;
}
else
{
document.ship.aus.checked=true;
document.ship.america.checked=true;
document.ship.europe.checked=true;
document.ship.africa.checked=true;
document.ship.asia.checked=true;
}
}
</script>
<script language="javascript">
function chk()
{
videofile=document.promote_frm.videofile.value;
videolink=document.promote_frm.videolink.value;
if((videolink!='') && (videofile!=''))
{
alert("Enter any one value for video(Video Code/Video Path)");
return false;
}
else
return true;
}
</script>