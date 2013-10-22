<?php session_start();
/***************************************************************************
 * File Name			:post_ad.php
 * File Created			:Wednesday, June 21, 2006
 * File Last Modified	:Wednesday, June 21, 2006
 * Copyright			:(C) 2001 AJ Square Inc
 * Email				:licence@ajsquare.net
 * Software Language	:PHP
 * Version Created		:V 4.3.2
 * Programmers worked	:S.Priya, B.ReenaKumari, K.Shanmuga priya
 * Modified By			:B.Reena
 * $Id                  : memberlist.php,v 1.36.2.12 2006/02/07 20:42:51 grahamje Exp $
 ***************************************************************************/
 /****************************************************************************
 
*      Licence Agreement: 
 
*     This program is a Commercial licensed software; 
*     you are not authorized to redistribute it and/or modify/and or sell it under any publication 
*     or license /or term it under the GNU General Public License as published by the Free Software Foundation;
*     either user and developer versions of the License, or (at your option) 
*     any later version is applicable for the same.
 
*****************************************************************************/
error_reporting(0);
require 'include/connect.php';
require 'upload_thumb.php';

if(!isset($_SESSION['userid']))
{ 
$link="signin.php";
$url="sell.php";
echo '<meta http-equiv="refresh" content="0;url='.$link.'?url='.$url.'">';
exit();
}

$sql_user_status="select status from user_registration where user_id=".$_SESSION['userid'];
$sqlqry_user_status=mysql_query($sql_user_status);
$sqlfetch_user_status=mysql_fetch_array($sqlqry_user_status);
$userstatus=$sqlfetch_user_status[0];
if($userstatus=='suspended')
{
echo '<meta http-equiv="refresh" content="0;url=suspendmode.php">';
exit();
}

if(empty($_SESSION['categoryid']))
{
$link="myauction.php";
echo '<meta http-equiv="refresh" content="0;url='.$link.'">';
//echo "You have been Re-Directed, if not please <a href=$link>Click here</a>";
exit();
}

$special_char=array('*','#','@','!','%','&','|','+','-','$','^');
$auction_query="select * from admin_settings where set_id=42";
$table=mysql_query($auction_query);
$row=mysql_fetch_array($table);
$bid_permission=$row['set_value'];
$mode=$_REQUEST['mode'];
if($_GET['item_id'])
{
$_SESSION['item_id']=$_GET['item_id'];
//$_SESSION['categoryid']=$_GET['cat_id'];
}

$item_id=$_SESSION['item_id'];
$sell_format=$_SESSION['sell_format'];
$admin_start_sql="select * from admin_settings where set_id=23";
$admin_start_res=mysql_query($admin_start_sql);
$admin_start_row=mysql_fetch_array($admin_start_res);
$admin_end_sql="select * from admin_settings where set_id=24";
$admin_end_res=mysql_query($admin_end_sql);
$admin_end_row=mysql_fetch_array($admin_end_res);
$userid=$_SESSION['userid'];
$category_id=$_SESSION['categoryid'];
/*$sub_cat=$_SESSION[subcat];*/
$cat_sql="select * from cat_slave where category_id=$category_id";
if($res=mysql_query($cat_sql))
{
$row=mysql_fetch_array($res);
$tablename=$row['tablename'];
$file_path=$row['file_path'];
}
$flag=$_POST['flag'];
$ownhtml=$_POST['own_html_flag'];
if($ownhtml)
{
$item_id=$_POST['item_id'];
$sub_cat=$_POST['cbosubcat'];
$item_title=$_POST['txttitle'];
}
if($mode=="change")
{
   $item_title=$_SESSION['item_name'];
   $sub_title=$_SESSION['subtitle'];
   $qty=$_SESSION['qty'];
   //$category_id=$_SESSION['categoryid'];
   $itemdes=$_SESSION['des'];
   $currency=$_SESSION['currency'];
   $sell_method=$_SESSION['sell_method'];
   $dur=$_SESSION['dur'];
   $rev_price=$_SESSION['rev_price'];
   $bid_starting_date=$_SESSION['bid_start'];
   $img1=$_SESSION['image1'];
   $img2=$_SESSION['image2'];
   $img3=$_SESSION['image3'];
   $img4=$_SESSION['image4'];
   $img5=$_SESSION['image5'];
   $sell_format=$_SESSION['sell_format'];
   $Gallery=$_SESSION['Gallery'];
   $Border=$_SESSION['Border'];
   $Highlight=$_SESSION['Highlight'];
   $Bold=$_SESSION['Bold'];
   $Home=$_SESSION['Home'];
   $repost=$_SESSION['repost'];
   $item_counter_style=$_SESSION['item_counter_style'];
   $videofileup=$_SESSION['uploadflv']; 
   $videolinkup=$_SESSION['uploadvideolink']; 
   
}
if($flag==1)
{
		$sel_sql="select * from error_message where err_id =23";
		$sel_tab=mysql_query($sel_sql);
		$sel_row=mysql_fetch_array($sel_tab);

  if($tablename) // this is for custom field category 
  {
  $tab_sql="select * from $tablename";
  $tab_res=mysql_query($tab_sql);
  $i =2;
  while ($i < mysql_num_fields($tab_res))
 {
    $tab_col = mysql_fetch_field($tab_res, $i);
    if (!$tab_col) 
	{
$sell_sql="select * from error_message where err_id =28";
$sell_tab=mysql_query($sell_sql);
$sell_row=mysql_fetch_array($sell_tab);
echo '<b>'.$sell_row['err_msg'].'</b>\n';
    }
	else
	{
	  $dummy="$".$tab_col->name;
      $dummy=$_POST[$tab_col->name];
	    $_SESSION[$tab_col->name]=$_POST[$tab_col->name];		
		if(empty($_SESSION[$tab_col->name]))
        {
         $err_dummy=$sel_row['err_msg'];
	     $err_flag=1;
        }
		else
		{
		 $var_type=$tab_col->type;
		 if($var_type=="int" or $var_type=="tinyint")
		  {
		   if(!is_numeric($_SESSION[$tab_col->name]))
	        {
		    $err_flag=1;
	        }
		  }
		}
	   }
	$i++;
} // while
} // if($tablename)
$mode=$_POST[mode];
$item_id=$_POST[item_id];
$item_title=$_POST[txttitle];
$sub_title=$_POST[txtsubtitle];
$itemdes=$_REQUEST[content];
$_SESSION[des]=$itemdes;

$item_counter_style=$_POST['item_counter_style'];
$start_delay=$_POST['cbo_start_delay'];
//$currency="€";
$Gallery=$_POST['chkGallery'];
$Border=$_POST['chkBorder'];
$Highlight=$_POST['chkHighlight'];
$sell_format=$_SESSION[sell_format];
$Bold=$_POST['chkBold'];
$Subtitle=$_POST['chkSubtitle'];
$Subtitle_name=$_POST['txtSubtitle'];
$Home=$_POST['chkHome'];
$size_of_qty=$_POST['size_of_qty'];
$myprice=0;
if($_POST[chkGallery]=='yes')
{
 $gallery=$_POST['gallery'];
 $_SESSION[gallery_fee]=$gallery;
$myprice= $myprice + $gallery;
}
if($_POST[chkHome]=='yes')
{
 $home_page=$_POST['home_page'];
 $_SESSION[home_fee] =$home_page;
$myprice= $myprice + $home_page;
}
if($_POST[chkBold]=='yes')
{
 $bold=$_POST['bold'];
 $_SESSION[bold_fee]=$bold;
$myprice= $myprice + $bold;
}
if($_POST[chkHighlight]=='yes')
{
$highlight=$_POST['highlight'];
$_SESSION[highligt_fee]=$highlight;
$myprice= $myprice + $highlight;
}


$_SESSION['sale_price']=$myprice;

		$se_sql="select * from error_message where err_id =22";
		$se_tab=mysql_query($se_sql);
		$se_row=mysql_fetch_array($se_tab);

if(empty($item_title))
{
        $err_title=$sel_row[err_msg];
	 	$err_flag=1;
}

if(strlen($itemdes)==0)
{  

 $err_des=$sel_row['err_msg'];
 $err_flag=1;
}
else
{
$err_flag=0;
}

$dur=$_POST['cbodur'];
$currency=$_POST['cbocurrency'];
 if($admin_end_row[set_value]=='yes')
 {
 if($mode!="edit")
{
 if(empty($dur))
{
 $err_dur=$sel_row['err_msg'];
	 $err_flag=1;
}
} //  if($mode!="edit")
}

$img1=$_FILES['img1']['name'];
$img1=str_replace($special_char,'',$img1);
if(!empty($img1))
{
 $type1=$_FILES['img1']['type'];
 if($type1=="image/pjpeg" || $type1=="image/gif" || $type1=="image/jpeg")
 {
  srand();
  $rad1=substr(md5(rand(0,1000)),0,5); 
  $img1=urlencode($img1);
  $imgname1="$username"."$rad1"."$img1";
  $uploaddir="images/$imgname1";
  move_uploaded_file($_FILES['img1']['tmp_name'],$uploaddir);
  chmod ("$uploaddir",0755);
  
  /* Uploading thumbnail images */
  
  list($filewidth,$fileheight)=getimagesize($uploaddir);
  $thumbpath="thumbnail/".$imgname1;
  $uploadres=reduce_image($uploaddir,200,200,$thumbpath);
    
  /* End of uploading thumbnail images */
  
  $_SESSION[img1]=$_FILES['img1']['name'];
  $_SESSION[image1]=$imgname1;
  
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
 $qty=$_POST['txt_qty'];
 
 if(empty($qty))
 {
 $err_qty="Enter a valid Information";
 $err_flag=1;
 }
//echo $qty;
if(!is_numeric($qty))
 {
  $err_qty="Enter a valid Information";
 $err_flag=1;
 }
 
  $videolinkup=$_POST['videolink'];
  $videofileup=$_POST['videofile'];
  //$videofileup=htmlentities($videofileup);
  if(!empty($videofileup))
  $_SESSION['uploadflv']=$videofileup; 
  if(!empty($videolinkup))
  $_SESSION['uploadvideolink']=$videolinkup; 
    
/*else if(is_numeric($qty))
 {
  
$qtychk=strpos($qty,".");
if($qtychk==TRUE)
 {
$err_qty="Enter a valid Information";
$err_flag=1;
 }
 
$qtychk=strpos($qty,"-");
if($qtychk==TRUE)
{
$err_qty="Enter a valid Information";
$err_flag=1;
}

$qtychk=strpos($qty,"+");
if($qtychk==TRUE)
{
$err_qty="Enter a valid Information";
$err_flag=1;
 }
}*/


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
 // $qty=1;
  }
  $img1=$_SESSION[image1];
  $img2=$_SESSION[image2];
  $img3=$_SESSION[image3];
 
  if(!empty($sub_cat))  // check the user select the subcategory or not 
  $_SESSION[subcat]=$sub_cat;
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
   $_SESSION[item_name]=$item_title;
   $_SESSION[subtitle]=$sub_title;
   $_SESSION[qty]=$qty;
   $_SESSION[des]=$itemdes;
  /* $_SESSION[subcat]=$sub_cat;
   $_SESSION[categoryid]=$category_id;*/
   $_SESSION[currency]=$currency;
   $_SESSION[sell_method]=$sell_method;
   $_SESSION[dur]=$dur;
   $_SESSION[size_of_qty]=$size_of_qty;
   $_SESSION[start_delay]=$start_delay;
   $_SESSION[Gallery]=$Gallery;
   $_SESSION[Border]=$Border;
   $_SESSION[Highlight]=$Highlight;
   $_SESSION[Bold]=$Bold;
   $_SESSION[Home]=$Home;
   $_SESSION[mode]=$mode;
   $_SESSION[item_counter_style]=$item_counter_style;
   $_SESSION['uploadflv']=$videofileup; 
   $_SESSION['uploadvideolink']=$videolinkup; 
  // $_SESSION[quantity]=$qty;
   $_SESSION['Insertionfee']="yes";
   echo '<meta http-equiv="refresh" content="0;url=post_preview.php?item_id='.$item_id.'">';
   echo "You have been Re-Directed, if not Please <a href=post_preview.php?item_id=$item_id>Click here</a>";
   exit();
	}
	else if($mode=="change")
	{
   $_SESSION[item_name]=$item_title;
   $_SESSION[subtitle]=$sub_title;
   $_SESSION[qty]=$qty;
   $_SESSION[des]=$itemdes;
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
   $_SESSION[subcat]=$sub_cat;
   $_SESSION[item_counter_style]=$item_counter_style;
   $_SESSION['Insertionfee']="yes";
   $_SESSION['uploadflv']=$videofileup; 
   $_SESSION['uploadvideolink']=$videolinkup; 
   // $_SESSION[quantity]=$qty;
    echo '<meta http-equiv="refresh" content="0;url=post_preview.php">';
	echo "You have been Re-Directed, if not Please <a href=post_preview.php>Click here</a>";
	}
	exit();
    }
} //$flag==1

$sql="select * from admin_rates";
	$exe=mysql_query($sql);
	$ret=mysql_fetch_array($exe);
	$gret=$ret['gallery_price'];
    $hret=$ret['homepage_price'];
	$sret=$ret['subtitle_price'];
	$bret=$ret['bold_price'];
	$highret=$ret['highlight_price'];
	 
    $title="Post Your Ad";
    require 'include/top.php';
    require'templates/post_ad.tpl'; 
    require 'include/footer.php';
	?>
