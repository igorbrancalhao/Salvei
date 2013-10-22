<?php
/***************************************************************************
 *File Name				:post_ad.php
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
<?php session_start();
require 'include/connect.php';
/*
 file name:ship_detail.php;
 date	  :6.7.05
 Created by:priya
 Rights reserved by AJ Square inc
*/
$admin_start_sql="select * from admin_settings where set_id=23";
$admin_start_res=mysql_query($admin_start_sql);
$admin_start_row=mysql_fetch_array($admin_start_res);

$admin_end_sql="select * from admin_settings where set_id=24";
$admin_end_res=mysql_query($admin_end_sql);
$admin_end_row=mysql_fetch_array($admin_end_res);

$userid=$_SESSION[userid];
$item_title=$_POST[txttitle];
$itemdes=$_POST['htmlcontent'];
$category_id=$_SESSION[categoryid];
$cat_sql="select * from cat_slave where category_id=$category_id";
$res=mysql_query($cat_sql);
$row=mysql_fetch_array($res);
$tablename=$row[tablename];
$file_path=$row[file_path];

$_SESSION[item_title]=$item_title;
$_SESSION[itemdes]=$itemdes;
?>
<html>
<head>
<title>Sell Your Item:Ship & Tax Detail</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<?php require 'include/top.php';?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#cecfc8">
<tr><td valign="top">

	<?php 
	$tilte="Better Things Better Price";
	?>
	</td>
  </tr>
  
  <?php
  
$flag=$_POST[flag];
$sub_cat=$_POST[cbosubcat];
if($flag==1)
{
  if($tablename)
  {
  $tab_sql="select * from $tablename";
  $tab_res=mysql_query($tab_sql);
  $i =2;
  while ($i < mysql_num_fields($tab_res))
  {
    $tab_col = mysql_fetch_field($tab_res, $i);
    if (!$tab_col) 
	{
        echo "No information available<br/>\n";
    }
	else
	{
	  $dummy="$".$tab_col->name;
      $dummy=$_POST[$tab_col->name];
	    $_SESSION[$tab_col->name]=$_POST[$tab_col->name];		
		if(empty($_SESSION[$tab_col->name]))
        {
         $err_dummy="Please Enter this Information";
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
} //
if(!empty($sub_cat))  // check the user select the subcategory or not 
  $_SESSION[categoryid]=$sub_cat; 
if(empty($item_title))
{
 $err_title="Please Enter this Information";
	 $err_flag=1;
}

if(strlen($itemdes)==0)
{  
 $err_des="Please Enter this Information";
	 $err_flag=1;
}
else
{
$err_flag=0;
}

/*
$img1=$_FILES['img1']['name'];

 $type1=$_FILES['img1']['type'];
 if(!empty($img1))
 {
 if($type1=="image/pjpeg" || $type1=="image/gif" || $type1=="image/jpeg" || $type1=="image/bmp")
 {
  $img1=urlencode($img1);
  $uploaddir="images/$img1";
   move_uploaded_file($_FILES['img1']['tmp_name'],$uploaddir);
  $_SESSION[img1]=$_FILES['img1']['name'];
   }
 else
 {
  //$err_img1="Please select image File";
  //$err_flag=1;
 }
 }
*/
/*
$uploaddir="";
$img1=$_FILES['img1']['name'];
if(!empty($img1))
{
 $type1=$_FILES['img1']['type'];
 if($type1=="image/pjpeg" || $type1=="image/gif" || $type1=="image/jpeg" || $type1=="image/bmp")
 {
  $img1=urlencode($img1);
  $uploaddir="images/$img1";
   if(move_uploaded_file($_FILES['img1']['tmp_name'],$uploaddir))
    $_SESSION[img1]=$_FILES['img1']['name'];
   }
 else
 {
  $err_img1="Please select image File";
  $err_flag=1;
 }
 }
*/

$img1=$_FILES['img1']['name'];
$img1=urlencode($img1);
 $uploaddir="images/$img1";

if(($_FILES['img1']['type']=='image/pjpeg')||($_FILES['photo']['type']=='image/gif'))
{
if(move_uploaded_file($_FILES['photo']['tmp_name'],$uploaddir))
{
 
}
else
{
$uploaddir="";
}
} 
else
{
$uploaddir="";
}


 $_SESSION[image]=$img1;
 if($err_flag!=1)
 {
 //////////
 


/////////
 $bid_starting_date=date("Y-m-d");
 if($admin_end_row['set_value']=='no')
 {
 $end_date="select * from admin_settings where set_id=26";
 $end_res=mysql_query($end_date);
 $end_row=mysql_fetch_array($end_res);
 $dur=$end_row[set_value];
 }
  $expire_date = AddDays($bid_starting_date,$dur);  
  $sql="insert into placing_item_bid(user_id,item_title,detailed_descrip,selling_method,duration,bid_starting_date,picture1,expire_date,category_id,status)";
  $sql.="values('$userid','$item_title','$itemdes','ads','$dur','$bid_starting_date','$img1','$expire_date','$_SESSION[categoryid]','Active')"; 
  $res=mysql_query($sql);
   if($res)
   $item_id=mysql_insert_id(); 
  
  if($tablename)
  {
  $tab_sql="select * from $tablename";
  $tab_res=mysql_query($tab_sql);
  $i =2;
  $up_cat="update $tablename set ";
  $in_sql="insert into $tablename(item_id,";
  $in_sql_value="values(' $item_id ', ";
while ($i < mysql_num_fields($tab_res))
{
      $tab_col = mysql_fetch_field($tab_res, $i);
   	  $dummy=$tab_col->name;
	  
      $table_sql="select * from $tablename where item_id=$item_id";
	  $table_res=mysql_query($table_sql);
      $var_value=$table_row[$tab_col->name];
	  if(mysql_num_rows($table_res)==0)
	  {
	    $in_sql.="$tab_col->name ,";
     	$in_sql_value.="'$_SESSION[$dummy]',";
	    // $table_row=mysql_fetch_array($table_res);
	  }
	  else
	  {	   
	  $up_cat.=$tab_col->name.'='."'".$_SESSION[$tab_col->name] ."'".", ";
	  }
	 // $_SESSION[$tab_col->name]=$table_row[$tab_col->name];
	  $i++;
} // while
if(mysql_num_rows($table_res) > 0)
{
$up_cat=rtrim($up_cat,", ");
$up_cat.=" where item_id=".$item_id;
$in_res=mysql_query($up_cat);
}
else
{
$in_sql=rtrim($in_sql,", "); 
$in_sql_value=rtrim($in_sql_value,", "); 
 $in_sql.=")".$in_sql_value.")";

 $in_res=mysql_query($in_sql);
}
 $up_cat;
} // if($tablename)
  
  
  
  if($res)
  $sucess=1;
  else
  $fail=1;
  

  //$sucess=1;
  
  
  
  }
}

 

  ?>
  <link href="<?php= $ret1; ?>" rel="stylesheet" type="text/css">
 <tr><td>
<table width="100%" cellpadding="5" cellspacing="0" align="center" border="0">
<tr height=40>
        <td class="tr_border"><font size="3"><b> Sell Your Item:Enter Your Item 
          Deatils</b></font> </td>
      </tr>
<tr><td>
<?php 
 if($sucess==1)
{
if($tablename)
  {
  $tab_sql="select * from $tablename";
  $tab_res=mysql_query($tab_sql);
  $i =2;
while ($i < mysql_num_fields($tab_res))
{
    $tab_col = mysql_fetch_field($tab_res, $i);
    if (!$tab_col) 
	{
        echo "";
    }
	else
	{
	  $dummy="$".$tab_col->name;
      $dummy=$_POST[$tab_col->name];
	  $_SESSION[$tab_col->name]="";		
    }
	$i++;
} // while
} // if($tablename)
?>

<tr><td valign="top">
<table cellpadding="5" cellspacing="2" align="center" class="table_topless_border" width="95%">
<tr><td><center><font size="2" color="#FF0000"><b>You have successfully listed your item.</b></font></td></tr>
<!-- <tr><td><b>View your listing:</b>&nbsp;<a href="review.php?item_id=<?php= $item_id ?> "><?php= $item_row[item_title]; ?></a></td></tr> -->

 
</table>
</td></tr>
<tr><td><?php require 'include/footer.php'; ?></td></tr>
</table>
<?php  
$sucess=0;
exit();
}
?>
<?php 
 if($fail==1)
{
?>
<tr><td ><br>
<br>
<br>
<table align="center" class="table_border1_with_bg" cellpadding="15">
<tr class="tdhead">
<td align="center"><font size="2"><b>Oop's!</b></font> </td></tr>
<tr><td><font size="2"><b>Problems In listing your item.Please Try Again Later!</b></font>
 </td></tr>
<!-- <tr><td><b>View your listing:</b>&nbsp;<a href="review.php?item_id=<?php= $item_id ?> "><?php= $item_row[item_title]; ?></a></td></tr> -->
</table><br>
<br>
<br></td></tr>
<!-- <tr align="center"><td align="center"><a href="pay.php">Pay Now</a></td></tr> -->
</table>
</td></tr>
<tr><td><?php require 'include/footer.php'; ?></td></tr>
</table>
<?php  
exit();
}
?>

<?php if($err_flag==1)
{ 
?>
<tr>
<img src="images/warning_39x35.gif">
<td><font size=2 color="red">The following must be corrected before continuing:</font></td>
</tr>
<?php if($tablename)
		{
		$tab_sql="select * from $tablename";
        $tab_res=mysql_query($tab_sql);
        $i =2; 
 while ($i < mysql_num_fields($tab_res))
{
    $tab_col = mysql_fetch_field($tab_res, $i);
	$dummy=$tab_col->name;
if(empty($_SESSION[$tab_col->name]))
        {
     ?>
	  <tr><td><a href="post_ad.php#<?php= $tab_col->name ?>"><?php= $tab_col->name ?></a>-Please Enter this Information </td></tr>
	 <?php
	    }
		else
		{
		echo $var_type=$tab_col->type;
		if($var_type=="int" or $var_type=="tinyint")
		{
		if(!is_numeric($_SESSION[$tab_col->name]))
	    {
	    ?>
		 <tr><td><a href="post_ad.php#<?php= $tab_col->name ?>"><?php= $tab_col->name ?></a>-Please Enter this Information </td></tr>
		<?php
		}
		}
		}
	$i++;
}
}  ?>




<?php if(!empty($err_title))
 {
 ?>
<tr>
<td><a href="post_ad.php#txttitle">Item Title</a> - <?php= $err_title; ?></td></tr>
<?php 
}
?>
<?php if(!empty($err_des))
 {
 ?>
<tr><td><a href="post_ad.php#areades">Item Description</a> - <?php= $err_des; ?></td></tr>
<?php 
}
?>

<?php
}
?>
</td></tr>
<form name="form1" action="post_ad.php" method="post" enctype="multipart/form-data">



<?php
  if($_SESSION[categoryid])
 {
  $sub_sql="select * from category_master where category_head_id=$_SESSION[categoryid]";
  $sub_res=mysql_query($sub_sql);
  $sub_tot=mysql_num_rows($sub_res);
 }
if($sub_tot!=0)
{ 
?>
<tr><td><font size=2><b>Sub Category</b></font></td></tr>
<tr><td><select name=cbosubcat><option value="0">Select</option>
<?php while($sub_row=mysql_fetch_array($sub_res))
 {
  if(trim($sub_row['category_id'])==trim($sub_cat))
  {
   ?>
  <option value="<?php= $sub_row['category_id'] ?>" selected><?php= $sub_row['category_name']?></option>
  <?php 
  }
  else
    {
	?>
  <option value="<?php= $sub_row['category_id'] ?>"><?php= $sub_row['category_name']?></option>
  <?php
  }
  }
  ?>
  </select>
 </td></tr>
 <?php 
 }
 else
 { 
  if($file_path)
  require "$file_path";
 }
 ?>
<tr><td>
<?php if(!empty($err_title))
 {?>
 <img src="images/warning_9x10.gif">&nbsp;<font size=2 color=red><?php= $err_title ?></font>
 <br>
 <b><font size=2 color=red>Item title</font></b>
 <?php
  }
  else
  {
 ?>
   <b><font size=2 >Item title</font></b>
   <?php }
   ?>
 </td></tr>
 
 
 
 
 <tr><td width=250><input type="text" name="txttitle" class="txtbig" value=<?php= $item_title; ?>>
 </td></tr>
 <tr><td>
<?php if(!empty($err_des))
 {
 ?>
 <img src="images/warning_9x10.gif">&nbsp;
 <font size=2 color=red><?php= $err_des; ?></font>
 <br>
 <b><font size=2 color=red>Item Description</font></b>
 <?php
  }
  else
  {
   ?>
   <b><font size=2 >Item Description</font></b>
   <?php }
   ?>
 </td></tr>

 <tr><td width="96%">
 <?php
 
   	$browser_name=$_SERVER['HTTP_USER_AGENT'];
	if(substr_count($browser_name,'Opera')==1) $brow_name='opera';
	else if(substr_count($browser_name,'Netscape')==1) $brow_name='netscape';
	else if(substr_count($browser_name,'Firefox')==1) $brow_name='firefox';
	else $brow_name='ie';
	if($brow_name=='netscape'||$brow_name=='opera'||$brow_name=='firefox') 
	echo '<textarea name="htmlcontent" cols="60" rows="15">' . $itemdes . '</textarea>';
	else require 'include/content.php'; 
?>
 <br>
<font size=2 class="hint_font">Describe your items features, benefits, 
and condition. Be sure to include in your description: Condition (new, used, etc.)</font></td>
</tr>
 <?php if($admin_end_row['set_value']=='yes')
 {
 ?>
 <td>
<?php if(!empty($err_dur))
 { 
 if($mode!="edit")
 { 
 ?>
 <img src="images/warning_9x10.gif">&nbsp;<font size=2 color=red><?php= $err_dur; ?></font>

 <br>
 <b><font size=2 color=red>Duration</font></b>
 <?php
  }
  else
  {
 ?>
   <b><font size=2 >Duration</font></b>
   <?php 
   }
   } //  if($mode=='edit')
   } //  if($admin_end_row=='yes')
   ?>
   
 </td>
</tr>



<tr>
<td width=250>
<?php  if($admin_end_row['set_value']=='yes')
{
if($mode!="edit")
{
?>
<select name="cbodur">
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
</select>
</td>
 <?php
 } //if($mode=="edit")
 
 }  // if($admin_end_row=='yes')
 ?></tr>


<tr><td >
<?php if(!empty($err_img1))
 {?>
 <img src="images/warning_9x10.gif">&nbsp;<font size=2 color=red><?php= $err_img1; ?></font>
 <br>
 <b><font size=2 color=red>Image</font></b>
 <?php
  }
  else
  {
 ?>
   <b><font size=2 >Image</font></b>
   <?php 
   }
   ?></td></tr><tr><td>
    <input type="file" name="img1" value="<?php= $img1; ?>">
	<?php if(!empty($_SESSION[img1]))
	{
	?>
	<img src="images/gallery.png" width=10 height=10>
	<?php
	}
	?></td></tr>
	<?php
	     $admin_query="select * from admin_settings where set_id=39";
         $admin_table=mysql_query($admin_query);
         $admin_row=mysql_fetch_array($admin_table);
         $ad_fee=$admin_row['set_value'];
        
		 
         $query="select * from user_registration where user_id ='$userid'";
         $tab=mysql_query($query);
         if($row=mysql_fetch_array($tab))
         {
           $mem=$row['member_account'];
          		 }  
   ?>		   
<input type="hidden" name=flag value=1>
<tr align="center"><td><br><input type="submit" name=detsub value="Save" class="buttonbig"></td></tr>
</form>

<tr align="center"><td><?php require 'include/footer.php'?></td></tr>
</table>