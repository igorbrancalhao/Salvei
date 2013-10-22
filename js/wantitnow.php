<?php
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
session_start();
error_reporting(0);
require 'include/connect.php';
if(!isset($_SESSION[username]))
{ 
$link="signin.php";
$url="wantitnow.php";
echo '<meta http-equiv="refresh" content="0;url='.$link.'?url='.$url.'">';
echo "You have been Re-Directed, if not please <a href=$link?$url>Click here</a>";
exit();
}

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

$admin_start_sql="select * from admin_settings where set_id=23";
$admin_start_res=mysql_query($admin_start_sql);
$admin_start_row=mysql_fetch_array($admin_start_res);
$admin_end_sql="select * from admin_settings where set_id=24";
$admin_end_res=mysql_query($admin_end_sql);
$admin_end_row=mysql_fetch_array($admin_end_res);
$userid=$_SESSION['userid'];
$category_id=$_SESSION['categoryid'];
$cat_sql="select * from cat_slave where category_id=$category_id";
if($res=mysql_query($cat_sql))
{
$row=mysql_fetch_array($res);
$tablename=$row['tablename'];
$file_path=$row['file_path'];
}


/*if(!empty($sub_cat))
{
 $cat_sql1="select * from category_master where category_head_id=$sub_cat"; 
  $selectqry_sub=mysql_query($cat_sql1);
  $numrows_sub=mysql_num_rows($selectqry_sub);
}*/


		$sel_sql="select * from error_message where err_id =23";
		$sel_tab=mysql_query($sel_sql);
		$sel_row=mysql_fetch_array($sel_tab);

      /*  if($tablename) // this is for custom field category 
        {
  			$tab_sql="select * from $tablename";
  			$tab_res=mysql_query($tab_sql);
  			$i =2;
  			while ($i < mysql_num_fields($tab_res))
 			{
    			$tab_col = mysql_fetch_field($tab_res, $i);
    			if(!$tab_col) 
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
	 }*/ // if($tablename)
	$mode=$_POST['mode'];
	$item_id=$_POST['item_id'];
	/*$sub_cat=$subcate;
	$subcat1=$subcate;*/
	$item_title=$_POST['txttitle'];
	$item_counter_style=$_POST['item_counter_style'];
	
	$se_sql="select * from error_message where err_id =22";	
	$se_tab=mysql_query($se_sql);
	$se_row=mysql_fetch_array($se_tab);
	/*if($sub_cat==0)
	{
        $err_cat=$sel_row['err_msg'];
	 	$err_flag=1;
	}
	if($numrows_sub>0)
	{
		if($subcat1==0)
		{
			$err_subcat=$sel_row['err_msg'];
			$err_flag=1;
		}
	}*/
	if(empty($item_title))
	{
		$err_title=$sel_row['err_msg'];
		$err_flag=1;
	}

	if($repost=='Select Repost')
	{
		$select_sql="select * from error_message where err_id =20";
		$select_tab=mysql_query($select_sql);
		$select_row=mysql_fetch_array($select_tab);
		$err_repost=$select_row['err_msg'];
		$err_flag=1;
	}
	$dur=$_POST['cbodur'];
	if($admin_end_row['set_value']=='yes')
	{
		if(empty($dur))
		{
			$err_dur=$sel_row['err_msg'];
			$err_flag=1;
		}
	}

	$img1=$_FILES['img1']['name'];
	if(!empty($img1))
	{
		$type1=$_FILES['img1']['type'];
		if($type1=="image/pjpeg" || $type1=="image/gif" || $type1=="image/jpeg" || $type1=="image/bmp")
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
?>
<!--<input type="hidden" name="sell_format" value="<?php= $sell_format; ?>">
<input type="hidden" name="CatMenu_0" id="CatMenu_0" value="">
<input type="hidden" name="CatMenu_0" id="CatMenu_0" value="">
<input type="hidden" name="CatMenu_0" id="CatMenu_0" value="">
<input type="hidden" name="CatMenu_0" id="CatMenu_0" value="">
<input type="hidden" name="CatMenu_0" id="CatMenu_0" value="">
<input type="hidden" name="CatMenu_0" id="CatMenu_0" value="">
<input type="hidden" name="CatMenu_0" id="CatMenu_0" value="">
<input type="hidden" name="CatMenu_0" id="CatMenu_0" value="">-->
<?php
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
 