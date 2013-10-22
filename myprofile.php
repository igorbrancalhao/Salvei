<?php
/***************************************************************************
 *File Name				:myprofile.php
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

if(!isset($_SESSION['username']))
{ 
$link="signin.php";
$url="myprofile.php";
echo '<meta http-equiv="refresh" content="0;url='.$link.'?url='.$url.'">';
/*echo "You have been Re-Directed, if not please <a href=$link?$url>Click here</a>";*/
exit();
}
$step=$_POST[step];
$member=$_GET[member];
$user_sql="select * from user_registration where user_id=$_SESSION[userid]";
$user_result=mysql_query($user_sql);
$row=mysql_fetch_array($user_result);
$first=$row[first_name];
$last=$row[last_name];
$address=$row[address];
$city=$row[city];
$state=$row[state];
$country=$row[country];
$code=$row[pin_code];
//$primary2=$row[home_phone];
$primary=explode("-",$row[home_phone]);
$primary1=$primary[0];
$primary2=$primary[1];
$primary=$primary[2];
/*$pri_count=strlen($primary2);
$primary1=substr($primary2, 0, 3); 
$primary=substr($primary2, 3, $pri_count); */
//$secondary2=$row[work_phone];
$secondary_phone=explode("-",$row[work_phone]);
$secondary1=$secondary_phone[0];
$secondary=$secondary_phone[1];
$zipcode=$row[pin_code];
$country=$row[country];
/*$sec_count=strlen($secondary2);
$secondary1=substr($secondary2, 0, 3); 
$secondary=substr($secondary2, 3,$sec_count); */
$email=$row[email];
$html_profile=$row[html_profile];
$reemail=$row[email];
if($step==1)
{
 $html_profile=$_REQUEST['html_profile'];
$first=$_POST[txtfirst];
$last=$_POST[txtlast];
$member=$_POST[member];
$address=$_POST[txtaddress];
$country=$_POST[cbocountry];
$city=$_POST[txtcity];
$state=$_POST[txtstate];
$zipcode=$_POST[txtzip];
$primary=$_POST[txtprimary];
$primary1=$_POST[txtprimary1];
$primary2=$_POST[txtprimary2];
$secondary=$_POST[txtsecondary];
$secondary1=$_POST[txtsecondary1];
$email=$_POST[txtemail];
$reemail=$_POST[txtreemail];
$terms=$_POST[chkterms];
$validEmailExpr= "^[0-9a-z~!#$%&_-]([.]?[0-9a-z~!#$%&_-])*"."@[0-9a-z~!#$%&_-]([.]?[0-9a-z~!#$%&_-])*$";
$email_enable_status=$_POST[email_status];
  if(empty($first))
  {
  $err_first="Please enter this information";
  $err_flag=1;
  }
  if(empty($last))
  {
  $err_last="Please enter this information";
  $err_flag=1;
  }
  if(empty($address))
  {
  $err_add="Please enter this information";
  $err_flag=1;
  }
  if(empty($state))
	{
   $err_city_sql="select err_msg from error_message where err_id=23";
   $err_city_res=mysql_query($err_city_sql);
   $err_city_row=mysql_fetch_array($err_city_res);
   $err_state=$err_city_row[err_msg];
   $err_flag=1;
	}
  if(empty($zipcode))
   {
   $err_code="Please enter this information";
   $err_flag=1;
   }
   if(is_string($zipcode))
   {
   $len=strlen($zipcode);
   for($i=0;$i<=$len;$i++)
   {
   $tr=substr($zipcode,$i,1);
   if (strcmp($tr,":")==0 or strcmp($tr,"?")==0 
   or strcmp($tr,"'")==0 or strcmp($tr,";")==0 or strcmp($tr,"#")==0
   or strcmp($tr,"@")==0 or strcmp($tr,"!")==0 or strcmp($tr,"$")==0 
   or strcmp($tr,"%")==0 or strcmp($tr,"^")==0 or strcmp($tr,"&")==0 
   or strcmp($tr,"*")==0 or strcmp($tr,",")==0 or strcmp($tr,"(")==0
   or strcmp($tr,")")==0 or strcmp($tr,"_")==0 or strcmp($tr,"-")==0
   or strcmp($tr,"+")==0 or strcmp($tr,"=")==0 or strcmp($tr,"|")==0
   or strcmp($tr,"/")==0 or strcmp($tr,"{")==0 or strcmp($tr,"}")==0
   or strcmp($tr,"[")==0 or strcmp($tr,"]")==0 or strcmp($tr,">")==0
   or strcmp($tr,"<")==0 or strcmp($tr,",")==0 or strcmp($tr,"\\")==0)
   $c=1;
   }
   if($c==1)
   {
   $err_code="Your Zipcode is Invalid (Only alphanumeric keys accepted) ";
   $err_flag=1;
   }
   }
    if(empty($city))
	{
	  $err_city="Please enter this information";
	  $err_flag=1;
	}
	
    if(empty($primary))
   {
     $err_primary="Please enter this information";
	 $err_flag=1;
   }
   if((strlen($primary)<6) || !is_numeric($primary))
   {
    $err_primary="Your Primary Phoneno is invalid";
    $err_flag=1;
	}
	 if(empty($primary1))
   {
     $err_primary="Please enter this information";
	   $err_flag=1;
   }
   if((strlen($primary1)<2) || !is_numeric($primary1))
   {
    $err_primary="Your Primary Phoneno is invalid";
    $err_flag=1;
	}
	 if(empty($primary2))
   {
     $err_primary="Please enter this information";
	   $err_flag=1;
   }
   if((strlen($primary2)<2) || !is_numeric($primary2))
   {
    $err_primary="Your Primary Phoneno is invalid";
    $err_flag=1;
	}
    if(empty($secondary))
   {
    $err_secondary="Please enter this information";
    $err_flag=1;
	}
    if(strlen($secondary)<7 || !is_numeric($secondary))
	{
      $err_secondary="Your Secondary Phoneno is invalid";
	  $err_flag=1;
	}
	if(empty($secondary1))
   {
    $err_secondary="Please enter this information";
    $err_flag=1;
	}
    if(strlen($secondary1)<3 || !is_numeric($secondary1))
	{
      $err_secondary="Your Secondary Phoneno is invalid";
	  $err_flag=1;
	}
	if(empty($email))
   {
    $err_email="Please enter this information";
    $err_flag=1;
	}
  else
   {
    if(!eregi($validEmailExpr,$email))
	{
	 $err_email="Your Email address id invalid ";
	 $err_flag=1;
	}
	}
   if(empty($reemail))
   {
  $err_reemail="Please enter this information";
    $err_flag=1;
	}
  else
  {
    if(!eregi($validEmailExpr,$reemail))
	{
	 $err_reemail="Your Email address id invalid ";
	 $err_flag=1;
	}
	}
   
   if(empty($err_email) && empty($err_reemail))
	{
	if($email!=$reemail)
	{
	   $err_email="Your email entries must match. Please check both.";
	   $err_remail="Your email entries must match. Please check both.";
	   $err_flag=1;
	}
	}
  if($err_flag!=1)
  {
   $html_profile=$_REQUEST['html_profile'];
   $date_of_registration=date('Y-m-d');
   $ip=$_SERVER['REMOTE_ADDR'];
   $temp_account=1; 
   $primary=$primary1."-".$primary2."-".$primary;
   $secondary=$secondary1."-".$secondary;
   $sql="update user_registration set first_name='$first',last_name='$last',";
   $sql.="html_profile='$uploaddir' , address='$address', ";
   $sql.="city='$city',state='$state',country='$country',pin_code='$zipcode',home_phone='$primary',";
   $sql.=" work_phone='$secondary',email='$reemail',html_profile ='$html_profile' where user_id=".$_SESSION['userid'];
   $res=mysql_query($sql);
   if($res)
   $status=1;
  } 
} //step==1
?>
<?php $title="Myprofile";
require 'include/top.php'; 
require 'templates/myprofile.tpl';
require'include/footer.php';
?>

