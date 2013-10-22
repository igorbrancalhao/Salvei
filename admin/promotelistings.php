<?php
/***************************************************************************
 *File Name				:promotelistings.php
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
/*
 file name:sell_item_detail.php;
 date	  :5.6.06
 Created by:priya
 Rights reserved by AJ Square inc
*/
$userid=$_SESSION['adminuser'];
$mode=$_REQUEST['mode'];
$flag=$_POST[flag];
$sellitemid=$_REQUEST['item_id'];
if($mode=="sellsimilar" and empty($flag))
{
$sql="select * from placing_item_bid where item_id=$sellitemid";
$sqlqry=mysql_query($sql);
$sqlfetch=mysql_fetch_array($sqlqry);
$sqlfeature="select * from featured_items where item_id=$sellitemid";
$sqlqryfeature=mysql_query($sqlfeature);
$sqlfetchfeature=mysql_fetch_array($sqlqryfeature);
$dur=$sqlfetch['duration'];
$_SESSION[dur]=$dur;
$qty=$sqlfetch['Quantity'];
$_SESSION[qty]=$qty;
$min_amt=$sqlfetch['min_bid_amount']; 
$_SESSION[min_amt]=$min_amt;  
$rev_price=$sqlfetch['reserve_price'];
$_SESSION[rev_price]=$rev_price;
$quick=$sqlfetch['quick_buy_price'];
$_SESSION[quick_price]=$quick;	  
// $_SESSION[size_of_qty]=$size_of_qty;
// $_SESSION[start_delay]=$start_delay;
//$_SESSION[Border]=$Border;
//$_SESSION[repost]=$repost;
//$_SESSION[mode]=$mode;
$img1=$sqlfetch['picture1'];
$_SESSION[image1]=$img1;
$img2=$sqlfetch['picture2'];
$_SESSION[image2]=$img2;
$img3=$sqlfetch['picture3'];
$_SESSION[image3]=$img3;
$img4=$sqlfetch['picture4'];
$_SESSION[image4]=$img4;
$img5=$sqlfetch['picture5'];
$_SESSION[image5]=$img5;
$img6=$sqlfetch['picture6'];
$_SESSION[image6]=$img6;
$img7=$sqlfetch['picture7'];
$_SESSION[image7]=$img7;
$listingdesinger=$sqlfetch['listingdesinger'];
$_SESSION[listingdesinger]=$listingdesinger;
   $theme_sql="select * from themes_master where themes_id=".$sqlfetch['themes_id'];
   $theme_res=mysql_query($theme_sql);
   $theme_row=mysql_fetch_array($theme_res);
   $_SESSION[theme_id]=$theme_row[themes_id];
   $_SESSION[theme]=$theme_row[themes];
   $theme=$_SESSION[theme];
$_SESSION[theme]=$theme;
$layout=$sqlfetch['layout'];
$_SESSION[layout]=$layout;
$Gallery=$sqlfetchfeature['gallery_feature'];
$_SESSION[Gallery]=$Gallery;
$Home=$sqlfetchfeature['home_feature'];
$_SESSION[Home]=$Home;
$Bold=$sqlfetchfeature['bold'];
$_SESSION[Bold]=$Bold;
$Highlight=$sqlfetchfeature['highlight']; 
$_SESSION[Highlight]=$Highlight;
$item_counter_style=$sqlfetch['item_counter_style '];
// $_SESSION[item_counter_style]=$item_counter_style;
}


$auction_query="select * from admin_settings where set_id=42";
$table=mysql_query($auction_query);
$row=mysql_fetch_array($table);
$bid_permission=$row['set_value'];

        $sel_sql="select * from error_message where err_id =23";
		$sel_tab=mysql_query($sel_sql);
		$sel_row=mysql_fetch_array($sel_tab);


$admin_start_sql="select * from admin_settings where set_id=23";
$admin_start_res=mysql_query($admin_start_sql);
$admin_start_row=mysql_fetch_array($admin_start_res);

$admin_end_sql="select * from admin_settings where set_id=24";
$admin_end_res=mysql_query($admin_end_sql);
$admin_end_row=mysql_fetch_array($admin_end_res);
$sell_format=$_SESSION[sell_format];

$select_sql="select * from error_message where err_id =23";
$select_tab=mysql_query($select_sql);
$select_row=mysql_fetch_array($select_tab);

if($mode=="change")
{
   $currency=$_SESSION[currency];
   $min_amt=$_SESSION[min_amt];  
   $bid_inc=$_SESSION[bid_inc];
   $dur=$_SESSION[dur];
   $rev_price=$_SESSION[rev_price];
   $bid_starting_date=$_SESSION[bid_start];
   $quick=$_SESSION[quick_price];	  
   $img1=$_SESSION[image1];
   $img2=$_SESSION[image2];
   $img3=$_SESSION[image3];
   $img4=$_SESSION[image4];
   $img5=$_SESSION[image5];
   $img6=$_SESSION[image6];
   $img7=$_SESSION[image7];
   $Gallery=$_SESSION[Gallery];
   $Border=$_SESSION[Border];
   $Highlight=$_SESSION[Highlight];
   $Bold=$_SESSION[Bold];
   $Home=$_SESSION[Home];
   $repost=$_SESSION[repost];
   $qty=$_SESSION[qty];
   $theme=$_SESSION[theme];
   $layout=$_SESSION[layout];
   $listingdesinger=$_SESSION[listingdesinger];
   $privatelistings=$_SESSION[privatelistings];
  $item_counter_style=$_SESSION[item_counter_style];
 
 
   
}
if($flag==1)
{
$currency=$_POST['cbocurrency'];
  $item_counter_style=$_POST['item_counter_style'];
  $_SESSION[item_counter_style]=$item_counter_style;
 
 
$start_delay=$_POST['cbo_start_delay'];
$Gallery=$_POST['chkGallery'];
$Border=$_POST['chkBorder'];
$Highlight=$_POST['chkHighlight'];
$sell_format=$_SESSION[sell_format];
$Bold=$_POST['chkBold'];
$subtitlepromoting=$_POST['chkSubtitle'];
// $subtitle=$_POST['txtSubtitle'];
$Home=$_POST['chkHome'];
if($_POST[chklisting])
{
$listingdesinger=$_POST[chklisting];
$theme=$_POST[cbotheme];
$layout=$_POST[cbolayout];
}
$quick=$_POST[txt_quick];
$privatelistings=$_POST[chkprivatelisting];
if($repost=='Select Repost')
{
$select_sql="select * from error_message where err_id =20";
$select_tab=mysql_query($select_sql);
$select_row=mysql_fetch_array($select_tab);
$err_repost=$select_row[err_msg];
$err_flag=1;
}
$repost=$_POST[repost];
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
$err_min_amt=$sel_row[err_msg];
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
if(!empty($quick) && $quick!='0.00')
{
if($quick<$min_amt)
{
$select_sql="select * from error_message where err_id =90";
$select_tab=mysql_query($select_sql);
$select_row=mysql_fetch_array($select_tab);
$err_quickprice=$select_row[err_msg];
$err_flag=1;
	}
	if(!is_numeric($quick))
{
$select_sql="select * from error_message where err_id =92";
$select_tab=mysql_query($select_sql);
$select_row=mysql_fetch_array($select_tab);
    $err_fix_price=$select_row[err_msg];
	  $err_flag=1;
	}
}
if(!empty($rev_price) && $rev_price!='0.00')
{
 if($rev_price<$min_amt)
	{
$select_sql="select * from error_message where err_id =91";
$select_tab=mysql_query($select_sql);
$select_row=mysql_fetch_array($select_tab);
$err_revprice=$select_row[err_msg];
$err_flag=1;
	}
	if(!is_numeric($rev_price))
	{
$select_sql="select * from error_message where err_id =92";
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
 $err_bid_inc=$sel_row[err_msg];
	 $err_flag=1;
}
else
{
 if(!is_numeric($bid_inc))
	{
	$select_sql="select * from error_message where err_id =12";
	$select_tab=mysql_query($select_sql);
	$select_row=mysql_fetch_array($select_tab);

      $err_bid_inc=$select_row[err_msg];
	  $err_flag=1;
	}
}
}
} // if($_SESSION[sell_method]!="fix")
if($_SESSION[sell_format]=="2")
{
$qty=$_POST[txt_qty];
 if(empty($qty))
{
 $err_qty=$sel_row[err_msg];
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
$dur=$_POST[cbodur];
$currency=$_POST['cbocurrency'];
 if($admin_end_row[set_value]=='yes')
 {
 if($mode!="edit")
{
 if(empty($dur))
{
 $err_dur=$sel_row[err_msg];
	 $err_flag=1;
}
} //  if($mode!="edit")
}

$img1=$_FILES['img1']['name'];
$img2=$_FILES['img2']['name'];
$img3=$_FILES['img3']['name'];
$img4=$_FILES['img4']['name'];
$img5=$_FILES['img5']['name'];
$img6=$_FILES['img6']['name'];
$img7=$_FILES['img7']['name'];



/* if($img1 || $img2 || $img3 || $img4 || $img5 || $img6 || $img7) //  when user upload any images folder create for that particular user.
 {
   $path=getcwd();
   $username=$_SESSION[username];
   $path="$path"."\images\\"."$username";
    mkdir("$path",0777);
  }   
  
  */



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
  $uploaddir="../images/$img_name1";
  move_uploaded_file($_FILES['img1']['tmp_name'],$uploaddir);
  chmod ("$uploaddir",0755); 
  $_SESSION[img1]=$_FILES['img1']['name'];
  $_SESSION[image1]=$img_name1;

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
  $uploaddir="../images/$img_name2";
  move_uploaded_file($_FILES['img2']['tmp_name'],$uploaddir);
  chmod ("$uploaddir",0755); 
  $_SESSION[img2]=$_FILES['img2']['name'];
  $_SESSION[image2]=$img_name2;
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
 

if(!empty($img3))
{
 $type3=$_FILES['img3']['type'];
 if($type3=="image/pjpeg" || $type3=="image/gif" || $type3=="image/jpeg" || $type3=="image/bmp")
 {
  
  $rad1=substr(md5(rand(0,1000)),0,5);  
  $img3=urlencode($img3);
  $date_con=date("Y-m-d"); 
  $img_name3="$date_con"."_"."$rad1"."_"."$img3";
  $uploaddir="../images/$img_name3";
  move_uploaded_file($_FILES['img3']['tmp_name'], $uploaddir);
  chmod ("$uploaddir",0755); 
  $_SESSION[img3]=$_FILES['img3']['name'];
  $_SESSION[image3]=$img_name3;
}
else
{
$select_sql="select * from error_message where err_id =8";
$select_tab=mysql_query($select_sql);
$select_row=mysql_fetch_array($select_tab);
$err_img3=$select_row[err_msg];
$err_flag=1;
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
  $uploaddir="../images/$img_name";
  move_uploaded_file($_FILES['img4']['tmp_name'],$uploaddir);
  chmod ("$uploaddir",0755); 
  $_SESSION[img4]=$_FILES['img4']['name'];
  $_SESSION[image4]=$img_name;
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
  $uploaddir="../images/$imgname";
  move_uploaded_file($_FILES['img5']['tmp_name'],$uploaddir);
  chmod ("$uploaddir",0755); 
  $_SESSION[img5]=$_FILES['img5']['name'];
  $_SESSION[image5]=$imgname;

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
  $uploaddir="../images/$img_name6";
  move_uploaded_file($_FILES['img6']['tmp_name'],$uploaddir);
  chmod ("$uploaddir",0755); 
  $_SESSION[img6]=$_FILES['img6']['name'];
  $_SESSION[image6]=$img_name6;
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
  $uploaddir="../images/$img_name7";
  move_uploaded_file($_FILES['img7']['tmp_name'],$uploaddir);
  chmod ("$uploaddir",0755); 
  $_SESSION[img7]=$_FILES['img7']['name'];
  $_SESSION[image7]=$img_name7;
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

 }
  if($err_flag!=1)
  {
  $bid_starting_date=date("Y-m-d");
  if($sell_format==1)
  {
  $sell_method="auction";
  }
  else if($sell_format==2)
  {
  $sell_method="dutch_auction";
  }
  else if($sell_format==3)
  {
  $sell_method="fix";
  }
  else if($sell_format==4)
  {
  $sell_method="ads";
  $qty=1;
  }
  $img1=$_SESSION[image1];
  $img2=$_SESSION[image2];
  $img3=$_SESSION[image3];
  $img4=$_SESSION[image4];
  $img5=$_SESSION[image5];
  $img6=$_SESSION[image6];
  $img7=$_SESSION[image7];
 
  if(!empty($sub_cat))  // check the user select the subcategory or not 
  $_SESSION[categoryid]=$sub_cat;
 if($admin_start_row['set_value']=='no')
 {
 $start_date="select * from admin_settings where set_id=25";
 $start_res=mysql_query($start_date);
 $start_row=mysql_fetch_array($start_res);
 $start_delay=$start_row[set_value];
 }
 if($admin_end_row['set_value']=='no')
 {
 $end_date="select * from admin_settings where set_id=26";
 $end_res=mysql_query($end_date);
 $end_row=mysql_fetch_array($end_res);
 $dur=$end_row[set_value];
 }
 
 


   if($mode=="") 
   {
   $_SESSION[qty]=$qty;
   $_SESSION[currency]=$currency;
   $_SESSION[sell_method]=$sell_method;
   $_SESSION[min_amt]=$min_amt;  
   $_SESSION[bid_inc]=$bid_inc;
   $_SESSION[dur]=$dur;
   $_SESSION[rev_price]=$rev_price;
   $_SESSION[bid_start]=$bid_starting_date;
   $_SESSION[quick_price]=$quick;	  
   $_SESSION[size_of_qty]=$size_of_qty;
   $_SESSION[start_delay]=$start_delay;
   $_SESSION[Gallery]=$Gallery;
   $_SESSION[Border]=$Border;
   $_SESSION[Highlight]=$Highlight;
   $_SESSION[Bold]=$Bold;
   $_SESSION[Home]=$Home;
   $_SESSION[repost]=$repost;
   $_SESSION[mode]=$mode;
   $_SESSION[theme]=$theme;
   $_SESSION[layout]=$layout;
  $_SESSION[item_counter_style]=$item_counter_style;
 
   if($theme)
   {
     
   $theme_sql="select * from themes_master where themes='$theme'";
   $theme_res=mysql_query($theme_sql);
   $theme_row=mysql_fetch_array($theme_res);
   $_SESSION[theme_id]=$theme_row[themes_id];
   $_SESSION[theme]=$theme_row[theme_name];
   }
   $_SESSION[layout]=$layout;
   $_SESSION[listingdesinger]=$listingdesinger;
   $_SESSION[privatelistings]=$privatelistings;
   $_SESSION['Insertionfee']="yes";
   echo '<meta http-equiv="refresh" content="0;url=ship_detail.php?item_id='.$sellitemid.'">';
   echo "You have been Re-Directed, if not Please <a href=ship_detail.php?item_id=$item_id>Click here</a>";
   exit();
   }
   else if($mode=="change")
   {
   $_SESSION[qty]=$qty;
   $_SESSION[currency]=$currency;
   $_SESSION[min_amt]=$min_amt;  
   $_SESSION[bid_inc]=$bid_inc;
   $_SESSION[dur]=$dur;
   $_SESSION[rev_price]=$rev_price;
   $_SESSION[bid_start]=$bid_starting_date;
   $_SESSION[quick_price]=$quick;	  
   $_SESSION[size_of_qty]=$size_of_qty;
   $_SESSION[start_delay]=$start_delay;
   $_SESSION[image1]=$img1;
   $_SESSION[image2]=$img2;
   $_SESSION[image3]=$img3;
   $_SESSION[image4]=$img4;
   $_SESSION[image5]=$img5;
   $_SESSION[Gallery]=$Gallery;
   $_SESSION[Border]=$Border;
   $_SESSION[Highlight]=$Highlight;
   $_SESSION[Bold]=$Bold;
   $_SESSION[Home]=$Home;
   $_SESSION[repost]=$repost;
   
   
    if($theme)
   {
   $theme_sql="select * from themes_master where themes='$theme'";
   $theme_res=mysql_query($theme_sql);
   $theme_row=mysql_fetch_array($theme_res);
   $_SESSION[theme_id]=$theme_row[themes_id];
   $_SESSION[theme]=$theme_row[theme_name];
   }
   $_SESSION[layout]=$layout;
   $_SESSION[listingdesinger]=$listingdesinger;
   $_SESSION[privatelistings]=$privatelistings;
   echo '<meta http-equiv="refresh" content="0;url=preview.php">';
   echo "You have been Re-Directed, if not Please <a href=preview.php>Click here</a>";
   exit();
   }
   
   
   if($mode=="sellsimilar") 
   {
    if($theme)
   {
   $theme_sql="select * from themes_master where themes='$theme'";
   $theme_res=mysql_query($theme_sql);
   $theme_row=mysql_fetch_array($theme_res);
   $_SESSION[theme_id]=$theme_row[themes_id];
   $_SESSION[theme]=$theme_row[theme_name];
   }
   $_SESSION[layout]=$layout;
   $_SESSION[listingdesinger]=$listingdesinger;
   $_SESSION[privatelistings]=$privatelistings;
   $_SESSION['Insertionfee']="yes";
   echo '<meta http-equiv="refresh" content="0;url=ship_detail.php?item_id='.$sellitemid.'&mode='.sellsimilar.'">';
   echo "You have been Re-Directed, if not Please <a href=ship_detail.php?item_id=$item_id>Click here</a>";
   exit();
   }
  } 
 }  
 $qry="select * from admin_settings where set_id=37";
 $repost_table=mysql_query($qry);
 $repost_row=mysql_fetch_array($repost_table);
 $repost=$repost_row['set_value'];  
 
    $sql="select * from admin_rates";
	$exe=mysql_query($sql);
	$ret=mysql_fetch_array($exe);
	$gret=$ret['gallery_price'];
    $hret=$ret['homepage_price'];
	$sret=$ret['subtitle_price'];
	$bret=$ret['bold_price'];
	$highret=$ret['highlight_price'];
	$listing_designer_fee=$ret[listing_designer_fee];
	$img_listing_fee=$ret['Image_listing_fee'];
	$subtitle_price=$ret[subtitle_price];
	$reserve_fee=$ret[reserve_price_fee];
    require 'templates/promotelistings.tpl';


?>
<script language="javascript">
function show(theme)
{
document.promote_frm.themeimg.src="../images/"+theme;
/*document.promote_frm.themeimg.style.display="inline";
document.promote_frm.themeimg.style.visibility="visible"; */
}
function showlayout(layout)
{
document.promote_frm.layoutimg.src="../images/"+layout;
/* document.promote_frm.layoutimg.style.display="inline";
document.promote_frm.layoutimg.style.visibility="visible";*/ 
}
function preview()
{
var themeimage=document.promote_frm.cbotheme.options[document.promote_frm.cbotheme.selectedIndex].value;
window.open("previewlisting.php?themeimage="+themeimage);
}
</script>