<?php
/***************************************************************************
 *File Name				:user_reg_inc.php
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
$step=$_POST[step];
$member=$_GET[member];
if($step==1)
{
$first=$_POST[txtfirst];
$last=$_POST[txtlast];
$member=$_POST[member];
$address=$_POST[txtaddress];
$address=stripslashes($address);
$city=$_POST[txtcity];
$state=$_POST[txtstate];
$code=$_POST[txtzipcode];
$primary=$_POST[txtprimary];
$primary1=$_POST[txtprimary1];
$primary2=$_POST[txtprimary2];
$secondary=$_POST[txtsecondary];
$secondary1=$_POST[txtsecondary1];
$country=$_POST[cbocountry];
$day=$_POST[cboday];
$month=$_POST[cbomonth];
$year=$_POST[txtYear];
$dob=$year."-".$month."-".$day;
$introid=$_POST['introid'];
if($introid=='') $introid=0;
$_SESSION[introid]=$introid;
$email=$_POST[txtemail];
$email=stripslashes($email);
$reemail=$_POST[txtreemail];
$reemail=stripslashes($reemail);
$terms=$_POST[chkterms];
$re_user    = "^[a-z0-9\._-]+"; 
$re_delim   = "@"; 
$re_domain  = "[a-z0-9][a-z0-9_-]*(\.[a-z0-9_-]+)*"; 
$re_tld     = "\.([a-z]{2}|aero|arpa|biz|com|coop|edu|gov|info|" . "int|mil|museum|name|net|org|pro)$"; 
$validEmailExpr=$re_user.$re_delim.$re_domain.$re_tld;
	
$email_enable_status=$_POST[email_status];
if(empty($terms))
 {
   $err_terms_sql="select * from error_message where err_id=23";
   $err_terms_res=mysql_query($err_terms_sql);
   $err_terms_row=mysql_fetch_array($err_terms_res);
   $err_terms=$err_terms_row['err_msg'];
   $err_flag=1;
 }
  if(empty($first))
   {
   $err_first_sql="select * from error_message where err_id=23";
   $err_first_res=mysql_query($err_first_sql);
   $err_first_row=mysql_fetch_array($err_first_res);
   $err_first=$err_first_row[err_msg];
   $err_flag=1;
  }
  else
  {
   $validfirstname="^[a-z]$";
   //echo $chk=eregi($validfirstname,$first);
   if(eregi($validfirstname,$first))
	{
	$err_flag=1;
	exit();
	}
  }
  if(empty($last))
  {
  $err_last_sql="select * from error_message where err_id=23";
  $err_last_res=mysql_query($err_last_sql);
  $err_last_row=mysql_fetch_array($err_last_res);
  $err_last=$err_last_row[err_msg];
  $err_flag=1;
  }
  if(empty($address))
  {
   $err_add_sql="select * from error_message where err_id=23";
   $err_add_res=mysql_query($err_add_sql);
   $err_add_row=mysql_fetch_array($err_add_res);
   $err_add=$err_add_row[err_msg];
   $err_flag=1;
  }
    if(empty($city))
	{
   $err_city_sql="select * from error_message where err_id=23";
   $err_city_res=mysql_query($err_city_sql);
   $err_city_row=mysql_fetch_array($err_city_res);
   $err_city=$err_city_row[err_msg];
    $err_flag=1;
	}
	if(empty($state))
	{
   $err_city_sql="select * from error_message where err_id=23";
   $err_city_res=mysql_query($err_city_sql);
   $err_city_row=mysql_fetch_array($err_city_res);
   $err_state=$err_city_row[err_msg];
   $err_flag=1;
	}
	if(empty($country))
	{
   $err_city_sql="select * from error_message where err_id=23";
   $err_city_res=mysql_query($err_city_sql);
   $err_city_row=mysql_fetch_array($err_city_res);
   $err_country=$err_city_row[err_msg];
   $err_flag=1;
	}
    if(empty($primary))
   {
   $err_primary_sql="select * from error_message where err_id=23";
   $err_primary_res=mysql_query($err_primary_sql);
   $err_primary_row=mysql_fetch_array($err_primary_res);
   $err_primary=$err_primary_row[err_msg];
   $err_prime=1;
   $err_flag=1;
   }
   if(!is_numeric($primary))
   {
   $err_primary_sql="select * from error_message where err_id=7";
   $err_primary_res=mysql_query($err_primary_sql);
   $err_primary_row=mysql_fetch_array($err_primary_res);
   $err_primary=$err_primary_row[err_msg];
   $err_prime=1;
   $err_flag=1;
   }
	
   if(empty($code))
   {
   $err_code="Please enter this information";
   $err_flag=1;
   }
   
   if(is_string($code))
   {
   $len=strlen($code);
   for($i=0;$i<=$len;$i++)
   {
   $tr=substr($code,$i,1);
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
   		
   if(empty($primary1))
   {
   $err_primary_sql="select * from error_message where err_id=23";
   $err_primary_res=mysql_query($err_primary_sql);
   $err_primary_row=mysql_fetch_array($err_primary_res);
   $err_primary=$err_primary_row[err_msg];
   $err_prime1=1;
	   $err_flag=1;
   }
   if(!is_numeric($primary1))
   {
   $err_primary_sql="select * from error_message where err_id=7";
   $err_primary_res=mysql_query($err_primary_sql);
   $err_primary_row=mysql_fetch_array($err_primary_res);
   $err_primary=$err_primary_row[err_msg];
   $err_prime1=1;
   $err_flag=1;
   }
   
   if(empty($primary2))
   {
   $err_primary_sql="select * from error_message where err_id=23";
   $err_primary_res=mysql_query($err_primary_sql);
   $err_primary_row=mysql_fetch_array($err_primary_res);
   $err_primary=$err_primary_row[err_msg];
   $err_prime2=1;
	   $err_flag=1;
   }
   if(!is_numeric($primary2))
   {
   $err_primary_sql="select * from error_message where err_id=7";
   $err_primary_res=mysql_query($err_primary_sql);
   $err_primary_row=mysql_fetch_array($err_primary_res);
   $err_primary=$err_primary_row[err_msg];
   $err_prime2=1;
   $err_flag=1;
   }

   
   
    if(empty($secondary))
   {
   $err_secondary_sql="select * from error_message where err_id=23";
   $err_secondary_res=mysql_query($err_secondary_sql);
   $err_secondary_row=mysql_fetch_array($err_secondary_res);
   $err_secondary=$err_secondary_row[err_msg];
   $err_sec=1;
   $err_flag=1;
   }
   if(!is_numeric($secondary))
   {
   $err_secondary_sql="select * from error_message where err_id=9";
   $err_secondary_res=mysql_query($err_secondary_sql);
   $err_secondary_row=mysql_fetch_array($err_secondary_res);
   $err_secondary=$err_secondary_row[err_msg];
   $err_sec=1;
   $err_flag=1;
   }
   if(empty($secondary1))
   {
   $err_secondary_sql="select * from error_message where err_id=23";
   $err_secondary_res=mysql_query($err_secondary_sql);
   $err_secondary_row=mysql_fetch_array($err_secondary_res);
   $err_secondary=$err_secondary_row[err_msg];
   $err_sec1=1;
   $err_flag=1;
   }
    if(!is_numeric($secondary1))
	{
   $err_secondary_sql="select * from error_message where err_id=9";
   $err_secondary_res=mysql_query($err_secondary_sql);
   $err_secondary_row=mysql_fetch_array($err_secondary_res);
   $err_secondary=$err_secondary_row[err_msg];
     $err_sec1=1;
	  $err_flag=1;
	}
   if(empty($email))
   {
   $err_email_sql="select * from error_message where err_id=23";
   $err_email_res=mysql_query($err_email_sql);
   $err_email_row=mysql_fetch_array($err_email_res);
   $err_email=$err_email_row[err_msg];
   $err_flag=1;
   }
   else
   {
   
   	$doma=explode('@',$email);
	$domain_table=mysql_query("select * from  blocked_domain where blocked_domain like \"%$doma[1]%\"");
	$domain_avl=mysql_num_rows($domain_table);
    if(!eregi($validEmailExpr,$email))
	{
   $err_email_sql="select * from error_message where err_id=13";
   $err_email_res=mysql_query($err_email_sql);
   $err_email_row=mysql_fetch_array($err_email_res);
   $err_email=$err_email_row[err_msg];
   $err_flag=1;
	}
	elseif($domain_avl>0)
	{
   $err_email_sql="select * from error_message where err_id=86";
   $err_email_res=mysql_query($err_email_sql);
   $err_email_row=mysql_fetch_array($err_email_res);
   $err_email2=$err_email_row[err_msg];
   $err_email_sql1="select * from error_message where err_id=87";
   $err_email_res1=mysql_query($err_email_sql1);
   $err_email_row1=mysql_fetch_array($err_email_res1);
   $err_email1=$err_email_row1[err_msg];
   $err_email="$err_email2".$doma[1]."$err_email1".$doma[1];
   $err_flag=1;
	}
	}
   if(empty($reemail))
   {
  $err_reemail_sql="select * from error_message where err_id=23";
  $err_reemail_res=mysql_query($err_reemail_sql);
  $err_reemail_row=mysql_fetch_array($err_reemail_res);
  $err_reemail=$err_reemail_row[err_msg];
   $err_flag=1;
	}
  else
  {
    if(!eregi($validEmailExpr,$reemail))
	{
  $err_reemail_sql="select * from error_message where err_id=13";
  $err_reemail_res=mysql_query($err_reemail_sql);
  $err_reemail_row=mysql_fetch_array($err_reemail_res);
  $err_reemail=$err_reemail_row[err_msg];
  $err_flag=1;
	}
	}
   
    if((empty($err_email)) && (empty($err_reemail)))
	{
	if($email!=$reemail)
	{
	  $err_email_sql="select * from error_message where err_id=14";
      $err_email_res=mysql_query($err_email_sql);
      $err_email_row=mysql_fetch_array($err_email_res);
      $err_email=$err_email_row[err_msg];
	  $err_remail=$err_email_row[err_msg];
	  $err_flag=1;
	}
	else
	{
	 $chk_email="select * from user_registration where email='$email'";
	 $chk_res=mysql_query($chk_email);
	 if(mysql_num_rows($chk_res) > 0)
	 {
		 $err_flag=1;
	  $err_email_sql="select * from error_message where err_id=15";
      $err_email_res=mysql_query($err_email_sql);
      $err_email_row=mysql_fetch_array($err_email_res);
      $err_email=$err_email_row[err_msg];
	 }
	
	}
	
	
	
	}
	
	
	
	
   if(empty($day))
  {
  $err_reday_sql="select * from error_message where err_id=23";
  $err_reday_res=mysql_query($err_reday_sql);
  $err_reday_row=mysql_fetch_array($err_reday_res);
  $err_day=$err_reday_row[err_msg];
  
  // $err_day="Please select this information";
  $err_flag=1;
  }
  if(empty($month))
  {
  
  $err_remonth_sql="select * from error_message where err_id=23";
  $err_remonth_res=mysql_query($err_remonth_sql);
  $err_remonth_row=mysql_fetch_array($err_remonth_res);
  $err_month=$err_remonth_row[err_msg];
  
  // $err_month="Please select this information";
  $err_flag=1;
  }
  if(empty($year))
  {
  $err_reyear_sql="select * from error_message where err_id=23";
  $err_reyear_res=mysql_query($err_reyear_sql);
  $err_reyear_row=mysql_fetch_array($err_reyear_res);
  $err_year=$err_reyear_row[err_msg];
  
  // $err_year="Please enter this information";
  $err_flag=1;
  }
  if(!is_numeric($year))
  {
  $err_reyear_sql="select * from error_message where err_id=23";
  $err_reyear_res=mysql_query($err_reyear_sql);
  $err_reyear_row=mysql_fetch_array($err_reyear_res);
  $err_year=$err_reyear_row[err_msg];
  
  $err_year="Please enter a valid information";
  $err_flag=1;
  }
  if(empty($err_day) and empty($err_year) and empty($err_month))
  {
  $chk_year=date("Y:m:d");
  $chk_dob="$year".":"."$month".":"."$day";
  if(($chk_year-$chk_dob) < 18 )
  {
  $err_redob_sql="select * from error_message where err_id=23";
  $err_redob_res=mysql_query($err_redob_sql);
  $err_redob_row=mysql_fetch_array($err_redob_res);
  $err_dob=$err_redob_row[err_msg];
  
  
 $err_dob="you are too young to sign up!";
  $err_flag=1;
  }
  }
   if($err_flag!=1)
  {
   $address=str_replace('"','\"',"$address");
   $address=str_replace("'","\'","$address");
 
   
   $date_of_registration=date('Y-m-d h:i:s');
   $ip=$_SERVER['REMOTE_ADDR'];
   $temp_account=1; 
   $primary=$primary1."-".$primary2."-".$primary;
   $secondary=$secondary1."-".$secondary;
   $sql="insert into user_registration(date_of_birth,email , first_name , last_name , html_profile , ";
   $sql.="address , city , state , pin_code , country , home_phone , work_phone , status , date_of_registration, ";
   $sql.="member_account , ip_address , email_enable_status , original_account)";
   $sql.= "values('$dob','$reemail','$first','$last','$html_profile','$address','$city',";
   $sql.="'$state','$code','$country','$primary','$secondary','Active','$date_of_registration', ";
   $sql.="$temp_account,'$ip','$email_enable_status','$member')";
 
  $res=mysql_query($sql);
   if($res)
   {
   $user_id=mysql_insert_id();
    echo '<meta http-equiv="refresh" content="0;url=account_reg.php?user_id='.$user_id.'">';
    echo "You have been Re-Directed, if not please <a href=account_reg?user_id=$user_id>Click here</a>";
   exit();
   }
   else
   {
   $err_dup_email_sql="select * from error_message where err_id=15";
   $err_dup_email_res=mysql_query($err_dup_email_sql);
   $err_dup_email_row=mysql_fetch_array($err_dup_email_res);
   $err_dup_email=$err_dup_email_row[err_msg];
   $err_flag=1;
   }
   } 
} //step==1
$state_sql="select * from state_master where country_id=38 ";
$state_res=mysql_query($state_sql);
$country_sql="select * from country_master";
$country_res=mysql_query($country_sql);
?>
