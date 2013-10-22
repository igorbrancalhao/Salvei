<?php
/***************************************************************************
 *File Name				:store_inc.php
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
$special_char=array('*','#','@','!','%','&','|','+','-','$','^');
     $user_id=$_SESSION['userid'];
	 $cansave=$_POST['cansave'];
     $myquery="select * from storefronts where user_id='$user_id' and status!='New'";
	 $mytab=mysql_query($myquery);

	if($cansave!=1)
	{
	$row=mysql_fetch_array($mytab);
	$store_name=$row[store_name];
	$itemdes=$row[description];
	$_SESSION[itemdes]=$itemdes;
    $aboutpage_type=$row[statususer];
	$logo1=$row[logo];
	}
	if($cansave==1)
	{
  $store_name=$_POST[store_name];
  
   //$itemdes=$_POST[htmlcontent];
   $itemdes=$_REQUEST[content];
if(empty($itemdes))
$itemdes=$_SESSION[itemdes];
else
$_SESSION[itemdes]=$itemdes;


  $aboutpage_type=$_POST[aboutpage_type];
  
  $_SESSION[storename]=$store_name;
  $_SESSION[itemdes]=$itemdes;
  $_SESSION[aboutpage_type]=$aboutpage_type;
  //error message
  $err_sql="select * from error_message where err_id=16";
  $err_qry=mysql_query($err_sql);
  $err_row=mysql_fetch_array($err_qry);
  if(empty($store_name))
  {
  
  $err_name=$err_row['err_msg'];
  $err_flag=1;
  }
  if(empty($itemdes))
  {
  $err_des=$err_row['err_msg'];
  $err_flag=1;
  }
  if(empty($aboutpage_type))
  {
  $err_type=$err_row['err_msg'];
  $err_flag=1;
  }
  if(!empty($_FILES['logo']['name']))
  {
  $logo1=$_FILES['logo']['name'];
  $logo1=str_replace($special_char,'',$logo1);
  }
  else
  {
  $row=mysql_fetch_array($mytab);
  $logo1=$row['logo'];
  }	 
 
                     $uploaddir= getcwd(); 
 					 $updir=explode('/',$uploaddir);
					 $count=count($updir)-1;
					 for($i=0;$i<$count;$i++)
					 {
         			 $up_dir.=$updir[$i]."/";
					 }
$uploaddir=rtrim($up_dir,"/");
if(!empty($logo1))
{
 $type1=$_FILES['logo']['type'];
 if($type1=="image/pjpeg" || $type1=="image/gif" || $type1=="image/jpeg" || $type1=="image/bmp")
 {
  $logo1=urlencode($logo1);
  $logo1="$user_id"."$logo1";
  $uploaddir="storefronts/$logo1";
  move_uploaded_file($_FILES['logo']['tmp_name'],$uploaddir);
  chmod ("$uploaddir",0755); 
   
 }
 }
 $_SESSION[logo1]=$logo1;
 
     $count=mysql_num_rows($mytab);
	 if($err_flag!=1)
	 {
   	  if($count==0)
	  {
	  
	  $sql_plan="select * from plan where plan_id=".$_SESSION['planid'];
	  $sqlqry_plan=mysql_query($sql_plan);
	  $sqlfetch_plan=mysql_fetch_array($sqlqry_plan);
	  $plan_amount=$sqlfetch_plan['amount'];
	   if(($plan_amount=='0') || ($plan_amount=='0.00'))
	  {
/*$query="insert into storefronts         (user_id,logo,description,store_name,status,planid)values('$user_id','$logo1','$itemdes','$store_name','enable','$_SESSION[planid]')";
      mysql_query($query);
	  $_SESSION[store_id]=mysql_insert_id();*/
	  echo '<meta http-equiv="refresh" content="0;url=store_success.php">';
     /* echo "<font size=+1 color=#003366>Loading....</font>";*/
      exit();
	  }
	  
	  else
	  {
/*        $query="insert into storefronts         (user_id,logo,description,store_name,status,planid)values('$user_id','$logo1','$itemdes','$store_name','New','$_SESSION[planid]')";
      mysql_query($query);
	  $_SESSION[store_id]=mysql_insert_id();*/
	  echo '<meta http-equiv="refresh" content="0;url=subcribe_to_store.php">';
      echo "<font size=+1 color=#003366>Loading....</font>";
      exit();
	  }
	 }
	 else
	 {
	 if(empty($logo1))
	 $query="update storefronts set description ='$itemdes',store_name='$store_name',statususer='$aboutpage_type' where user_id='$user_id'";
	 else
	 $query="update storefronts set logo='$logo1', description ='$itemdes',store_name='$store_name',statususer='$aboutpage_type' where user_id='$user_id'";
	 mysql_query($query);
  	}
	}
	} //  if($cansave==1)
?>