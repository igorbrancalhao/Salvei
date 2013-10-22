<?php session_start();
/***************************************************************************
 *File Name				:wantitnow.php
*File Created			:Wednesday, June 21, 2006
 * File Last Modified	:Wednesday, June 21, 2006
 * Copyright			:(C) 2001 AJ Square Inc
 * Email				:licence@ajsquare.net
 * Software Language	:PHP
 * Version Created		:V 4.3.2
 * Programmers worked	:S.Priya, B.ReenaKumari, K.Shanmuga priya
 * Modified By			:B.Reena
 * $Id                  : memberlist.php,v 1.36.2.12 2006/02/07 20:42:51 grahamje Exp $ ***************************************************************************/
 

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
$special_char=array('*','#','@','!','%','&','|','+','-','$','^');
if(!isset($_SESSION['userid']))
{ 
$link="signin.php";
$url="wantitnow.php";
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


$admin_start_sql="select * from admin_settings where set_id=23";
$admin_start_res=mysql_query($admin_start_sql);
$admin_start_row=mysql_fetch_array($admin_start_res);

$admin_end_sql="select * from admin_settings where set_id=24";
$admin_end_res=mysql_query($admin_end_sql);
$admin_end_row=mysql_fetch_array($admin_end_res);

$auction_query="select * from admin_settings where set_id=42";
$table=mysql_query($auction_query);
$row=mysql_fetch_array($table);
if($_GET['item_id'])
{
$_SESSION[item_id]=$_GET['item_id'];
$_SESSION[categoryid]=$_GET['cat_id'];
}
$item_id=$_SESSION['item_id'];
$sql123="select * from category_master where category_head_id=0 and custom_cat='0' order by category_name"; 
$res123=mysql_query($sql123);


$flag=$_POST['flag'];
$ownhtml=$_POST['own_html_flag'];
$item_id=$_POST['item_id'];
$item_title=$_POST['txttitle'];

$sell_format=$_SESSION['sell_format'];
$cat_subid1=$_REQUEST['sub_cat1'];
$cat_subid2=$_REQUEST['sub_cat2'];
$cat_subid3=$_REQUEST['sub_cat3'];
$cat_subid4=$_REQUEST['sub_cat4'];
$cat_subid5=$_REQUEST['sub_cat5'];
$cat_subid6=$_REQUEST['sub_cat6'];
$cat_subid7=$_REQUEST['sub_cat7'];
$cat_subid8=$_REQUEST['sub_cat8'];

if($flag==1)
{
 if(empty($cat_subid1))
 {
 $err_cat="Please Select Category";
 $err_flag=1;
 }
 else
 {
 if($cat_subid8==" ")
 $_SESSION['categoryid']=$cat_subid7;
 else
 $_SESSION['categoryid']=$cat_subid8;
 if($cat_subid7==" ")
 $_SESSION['categoryid']=$cat_subid6;
 if(empty($cat_subid6))
 $_SESSION['categoryid']=$cat_subid5;
 if($cat_subid5==" ")
 $_SESSION['categoryid']=$cat_subid4;
 if($cat_subid4==" ")
 $_SESSION['categoryid']=$cat_subid3;
 if($cat_subid3==" ")
 $_SESSION['categoryid']=$cat_subid2;
 if($cat_subid2==" ")
 $_SESSION['categoryid']=$cat_subid1;
 }


$userid=$_SESSION['userid'];
$category_id=$_SESSION['categoryid'];
/*$cat_sql="select * from cat_slave where category_id=$category_id";
if($res=mysql_query($cat_sql))
{
$row=mysql_fetch_array($res);
$tablename=$row['tablename'];
$file_path=$row['file_path'];
}
*/


    $sel_sql="select * from error_message where err_id =23";
	$sel_tab=mysql_query($sel_sql);
    $sel_row=mysql_fetch_array($sel_tab);

	$mode=$_POST['mode'];
	$item_id=$_POST['item_id'];
	$item_title=$_POST['txttitle'];
	$item_counter_style=$_POST['item_counter_style'];
	$dur=$_POST['cbodur'];
	
	
	$se_sql="select * from error_message where err_id =22";	
	$se_tab=mysql_query($se_sql);
	$se_row=mysql_fetch_array($se_tab);
	
	if(empty($item_title))
	{
		$err_title=$sel_row['err_msg'];
		$err_flag=1;
	}

	/*if($repost=='Select Repost')
	{
		$select_sql="select * from error_message where err_id =20";
		$select_tab=mysql_query($select_sql);
		$select_row=mysql_fetch_array($select_tab);
		$err_repost=$select_row['err_msg'];
		$err_flag=1;
	}*/
	
	if($admin_end_row['set_value']=='yes')
	{
		if(empty($dur))
		{
			$err_dur=$sel_row['err_msg'];
			$err_flag=1;
		}
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
			$_SESSION[img1]=$_FILES['img1']['name'];
			$_SESSION[image1]=$imgname1;
		 }
 		else
 		{
			$select_sql="select * from error_message where err_id =8";
			$select_tab=mysql_query($select_sql);
			$select_row=mysql_fetch_array($select_tab);
			$err_img1=$select_row['err_msg'];
			$err_flag=1;
 		}
	}

 

	if($err_flag!=1)
	{
  		$bid_starting_date=date("Y-m-d");
  		$sell_method="want_it_now";
  		$qty=1;
 		$img1=$_SESSION[image1];
  	
		if($admin_end_row['set_value']=='no')
		{
			$end_date="select * from admin_settings where set_id=26";
 			$end_res=mysql_query($end_date);
 			$end_row=mysql_fetch_array($end_res);
			$dur=$end_row['set_value'];
		}
  		$_SESSION['item_name']=$item_title;
   		$_SESSION['des']=$itemdes;
  		$_SESSION['sell_method']=$sell_method;
  		$_SESSION['dur']=$dur;
      //  $_SESSION['categoryid'];
	  
  
  		echo '<meta http-equiv="refresh" content="0;url=wantitnow_desc.php?item_id='.$item_id.'">';
  		echo "You have been Re-Directed, if not Please <a href=wantitnow_preview.php?item_id=$item_id>Click here</a>";
  		exit();
  		$_SESSION['item_name']="";
	    $_SESSION['des']="";
	    $_SESSION['sell_method']="";
	    $_SESSION['dur']="";
	    $_SESSION['img1']="";
   }
} 

$title="Wanted Item Posting";
require 'include/top.php';
require'templates/wantitnow.tpl'; 
require 'include/footer.php';
?>

<script language="javascript">
function sel_method()
{
document.form1.radselling.value="auction";
document.form1.flag.value=2;
document.form1.submit();
}
function ownhtml12()
{
document.form1.own_html_flag.value="yes";
document.form1.flag.value=0;
document.form1.submit();
}
function ownhtml13()
{
document.form1.own_html_flag.value="editor";
document.form1.flag.value=0;
document.form1.submit();
}
</script>
 