<?php
/***************************************************************************
 *File Name				:post_preview.php
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
session_start();
error_reporting(0);
require 'include/connect.php';

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

if(empty($_SESSION['item_name']) || empty($_SESSION['des']) || empty($_SESSION['categoryid']))
{
$link="myauction.php";
echo '<meta http-equiv="refresh" content="0;url='.$link.'">';
//echo "You have been Re-Directed, if not please <a href=$link>Click here</a>";
exit();
}

$tsql="select * from admin_settings where set_id=1"; 
$tres=mysql_query($tsql);
$trow=mysql_fetch_array($tres);
$site=$trow['set_value'];

//Fetching mail header image
$queryheader="select * from admin_settings where set_id = 61";
$tableheader=mysql_query($queryheader);
$rowheader=mysql_fetch_array($tableheader);
$mailheader = $site."/".$rowheader['set_value'];

//Fetching mail footer image
$queryfooter="select * from admin_settings where set_id = 62";
$tablefooter=mysql_query($queryfooter);
$rowfooter=mysql_fetch_array($tablefooter);
$mailfooter = $site."/".$rowfooter['set_value'];

   $Gallery=$_SESSION['Gallery'];
   $Border=$_SESSION['Border'];
   $Highlight=$_SESSION['Highlight'];
   $Bold=$_SESSION['Bold'];
   $Home=$_SESSION['Home'];
   $repost=$_SESSION['repost'];
   $Insertionfee=$_SESSION['Insertionfee'];
  
if($_SESSION[mode]=="repost")
{
$item_id=$_SESSION['item_id'];
$edit="select * from placing_item_bid where item_id=$item_id";
$edit_res=mysql_query($edit);
$edit_row=mysql_fetch_array($edit_res);
$fea_item="select * from featured_items where item_id=$item_id";
$fea_res=mysql_query($fea_item);
$fea_row=mysql_fetch_array($fea_res);
$_SESSION['item_name']=$edit_row['item_title'];
$_SESSION['des']=$edit_row['detailed_descrip'];
$_SESSION['sell_method']=$edit_row['selling_method'];
$_SESSION['currency']=$edit_row['currency'];
$_SESSION['size_of_qty']=$edit_row['size_of_quantity'];
$_SESSION['qty']=$edit_row['Quantity'];
$_SESSION['start_delay']=$edit_row['start_delay'];
$_SESSION['image1']=$edit_row['picture1'];
$_SESSION['image2']=$edit_row['picture2'];
$_SESSION['image3']=$edit_row['picture3'];
   $size_of_qty=$_SESSION['size_of_qty'];
   $start_delay=$_SESSION['start_delay'];
   $img1=$_SESSION['image1'];
   $img2=$_SESSION['image2'];
   $img3=$_SESSION['image3'];
   $img4=$_SESSION['image4'];
   $img5=$_SESSION['image5'];
   $videofileup=$_SESSION['uploadflv'];
   $videolinkup=$_SESSION['uploadvideolink'];
}

?>
<?php
  $flag=$_POST['flag'];
  if($flag==1)
{  
   $userid=$_SESSION['userid'];   
   if($_SESSION[subcat])
   $cat_id=$_SESSION['subcat'];
   else
   $cat_id=$_SESSION['categoryid'];
  
   $item_title=$_SESSION['item_name'];
   $subtitle=$_SESSION['subtitle'];
   $qty=$_SESSION['qty'];
   $itemdes=$_SESSION['des'];
   $currency=$_SESSION['currency'];
   $sell_method=$_SESSION['sell_method'];
   $dur=$_SESSION['dur'];
   $size_of_qty=$_SESSION['size_of_qty'];
   $start_delay=$_SESSION['start_delay'];
   $img1=$_SESSION['image1'];
   $img2=$_SESSION['image2'];
   $img3=$_SESSION['image3'];
   $img4=$_SESSION['image4'];
   $img5=$_SESSION['image5'];
    //payment
   $payment=$_SESSION['payment'];
   $payname=$_SESSION['payname'];
   $payid=$_SESSION['payid'];
   $repost=$_SESSION['repost'];
   $item_counter_style=$_SESSION['item_counter_style'];
   $videofileup=$_SESSION['uploadflv'];
   $videolinkup=$_SESSION['uploadvideolink'];
   
   function addDay($date,$interval) 
  { 
  if (!isset($date)) 
  $date = date("Y-m-d"); 
  $elts = explode("-", $date); 
  $inter=$interval*24*3600; 
  $dcour=mktime(1,0,0,$elts[1],$elts[2],$elts[0]); 
  $dres=$dcour+$inter; 
  $date1=date("Y-m-d",$dres);
  $sec=date("G:i:s");
  $ret_date="$date1"." "."$sec";
  return $ret_date; 
  }
   if($_SESSION[mode]!="repost" or $_SESSION[mode]="relist")
   {
   $bidding_start_date=date("Y-m-d");
   $bidding_start_date = addDay($bidding_start_date,$start_delay); 
   $interval =$dur +$start_delay;
   $expire_date = addDay($bidding_start_date,$interval); 
   $Gallery=$_SESSION[Gallery];
   $Border=$_SESSION[Border];
   $Highlight=$_SESSION[Highlight];
   $Bold=$_SESSION[Bold];
   $Home=$_SESSION[Home];
   $repost=$_SESSION[repost];
   $Insertion_fee=$_SESSION[Insertionfee];
   $subtitle=$_SESSION[subtitle];
   $itemdes=str_replace('"','\"',"$itemdes");
   $itemdes=str_replace("'","\'","$itemdes");
   
   
  if($_SESSION[total_fees]!='0' or $_SESSION[total_fees]!='0.00')
 {
   $sql="insert into placing_item_bid(user_id,category_id,item_title,quantity,detailed_descrip, currency ,selling_method,min_bid_amount,bid_increment,duration,reserve_price,quick_buy_price,bid_starting_date,picture1,picture2,picture3,picture4,picture5,size_of_quantity,start_delay,expire_date,shipping_route,shipping_cost,status,tax,payment_gateway,payment_name,payment_id,no_of_repost,item_counter_style,videofile,videolink)";
    $sql.="values('$userid','$cat_id','$item_title',$qty,'$itemdes','$currency','$sell_method','$min_amt','$bid_inc','$dur','$rev_price','$quick','$bidding_start_date','$img1','$img2','$img3','$img4','$img5','$size_of_qty',$start_delay,'$expire_date','$shipping_route','$shipping_amt','New','$tax','$payment','$payname','$payid','$repost',$item_counter_style,'$videofileup','$videolinkup')"; 
  }
  else
  {
 $sql="insert into placing_item_bid(user_id,category_id,item_title,quantity,detailed_descrip, currency ,selling_method,min_bid_amount,bid_increment,duration,reserve_price,quick_buy_price,bid_starting_date,picture1,picture2,picture3,picture4,picture5,size_of_quantity,start_delay,expire_date,shipping_route,shipping_cost,status,tax,payment_gateway,payment_name,payment_id,no_of_repost,videofile,videolink)";
   $sql.="values('$userid','$cat_id','$item_title',$qty,'$itemdes','$currency','$sell_method','$min_amt','$bid_inc','$dur','$rev_price','$quick','$bidding_start_date','$img1','$img2','$img3','$img4','$img5','$size_of_qty',$start_delay,'$expire_date','$shipping_route','$shipping_amt','Active','$tax','$payment','$payname','$payid','$repost','$videofileup','$videolinkup')"; 
  }
  //echo $sql;  
  $res=mysql_query($sql);  
  if($res)
{
$item_id=mysql_insert_id();

$user="select * from user_registration where user_id=$_SESSION[userid]";
$user_res=mysql_query($user);
$user_row=mysql_fetch_array($user_res);

$sqluser="select * from user_registration where user_id=$_SESSION[userid]";
$sqluserqry=mysql_query($sqluser);
$sqluserfetch=mysql_fetch_array($sqluserqry);
$to=$sqluserfetch['email'];
$sellername=$sqluserfetch['user_name'];

/* Category name */

$sql_category="select * from category_master where category_id=$cat_id"; 
$res_category=mysql_query($sql_category);
$fetch_category=mysql_fetch_array($res_category);
$categor_name=$fetch_category['category_name'];

/* End of category name */



$sql="select * from mail_subjects where mail_id=15"; 
$sqlres=mysql_query($sql);
$sqlrow=mysql_fetch_array($sqlres);
$mailfrom=$sqlrow['mail_from'];
$subject=$sqlrow['mail_subject'];
$mailsubject=$sqlrow['mail_message'];
$subject=ereg_replace("<site>",$site,$subject);
$mailsubject=ereg_replace("<seller>",$sellername,$mailsubject);
$mailsubject=ereg_replace("<site>",$site,$mailsubject);
$mailsubject=ereg_replace("<auction_name>",$item_title,$mailsubject);
$mailsubject=ereg_replace("<auction_type>","Classifide Ad",$mailsubject);
$mailsubject=ereg_replace("<quantity>","$qty",$mailsubject);
$mailsubject=ereg_replace("<category>",$categor_name,$mailsubject);
$mailsubject=ereg_replace("<bid>","Not Applicable",$mailsubject);
$mailsubject=ereg_replace("<reserve>","Not Applicable",$mailsubject);
$mailsubject=ereg_replace("<reserve>","not Applicable",$mailsubject);
$mailsubject=ereg_replace("<closingdate>",$expire_date,$mailsubject);
$mailsubject=ereg_replace("detail.php","classifide_ad.php",$mailsubject);
$mailsubject=ereg_replace("<site>",$site,$mailsubject);
$mailsubject=ereg_replace("<item_id>","$item_id",$mailsubject);
$mailsubject=ereg_replace("<site>",$site,$mailsubject);
$mailsubject=str_replace("<imgh>" , $mailheader , $mailsubject);
$mailsubject=str_replace("<imgf>" , $mailfooter , $mailsubject);


$headers  = "MIME-Version: 1.0\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\n";
$headers .= "From: ". $mailfrom."\n";

 mail($to,$subject,$mailsubject,$headers); 
 



   if($_SESSION[subtitle])
   $sub_title="Yes";
if(!empty($Highlight) || !empty($Border) || !empty($Bold) || !empty($Gallery) || !empty($subtitle) || !empty($Home))
{ 
   $feature_sql="insert into featured_items(item_id,gallery_feature,home_feature,bold,border,highlight,subtitle_feature,subtitle)";
   $feature_sql.="values($item_id,'$Gallery','$Home','$Bold','$Border','$Highlight','$sub_title','$Subtitle_name')";
   $feature_res=mysql_query($feature_sql);
}   
 
 
/*$fee_sql="select * from admin_rates";
$fee_res=mysql_query($fee_sql);
$fee_row=mysql_fetch_array($fee_res);
if($_SESSION[Gallery])
$gallery_price=$fee_row[gallery_price];
if($_SESSION[Highlight])
$highlight_price=$fee_row[highlight_price];
if($_SESSION[Bold])
$bold_price=$fee_row[bold_price];
if($_SESSION[Home])
$homepage_price=$fee_row[homepage_price];
if($_SESSION[Insertionfee])
$insertion_fee=$fee_row[Classified_fee];
if($_SESSION[subtitle])
$subtitle_fee=$fee_row[subtitle_price];*/


$fee_sql="select * from admin_rates";
$fee_res=mysql_query($fee_sql);
$fee_row=mysql_fetch_array($fee_res);
if($_SESSION['Gallery'])
$gallery_price=$fee_row['gallery_price'];
else
$gallery_price='0.00';
if($_SESSION['Highlight'])
$highlight_price=$fee_row['highlight_price'];
else
$highlight_price='0.00';
if($_SESSION['Bold'])
$bold_price=$fee_row['bold_price'];
else
$bold_price='0.00';
if($_SESSION['Home'])
$homepage_price=$fee_row['homepage_price'];
else
$homepage_price='0.00';
if($_SESSION[Insertionfee])
$insertion_fee=$fee_row['Classified_fee'];
else
$insertion_fee='0.00';
if($_SESSION[subtitle])
$subtitle_fee=$fee_row[subtitle_price];
else
$subtitle_fee='0.00';



/*echo $_SESSION[subtitle];

echo "high".$highlight_price;
echo "<br>";
echo "insert".$insertion_fee;
echo "<br>";
echo "bold".$bold_price;
echo "<br>";
echo "gallery".$gallery_price;
echo "<br>";
echo "home".$homepage_price;
echo "<br>";
echo "sub".$subtitle_fee;
*/


if($highlight_price!='0.00' || $insertion_fee!='0.00' || $bold_price!='0.00' || $gallery_price!='0.00' || $homepage_price!='0.00' || $subtitle_fee!='0.00')
 { 
 $paymode=1; 
  $feature_sql="insert into auction_fees(item_id,gallery_fee,homepage_featureditem_fee,boldlisting_fee,highlighted_fee,classifedad_fee,subtitlefee)";
 $feature_sql.="values('$item_id','$gallery_price','$homepage_price','$bold_price','$highlight_price','$insertion_fee','$subtitle_fee')";
 $feature_res=mysql_query($feature_sql);
  } 
else
$paymode=0;

$cat_sql="select * from cat_slave where category_id=$cat_id";
$res1=mysql_query($cat_sql);
$row=mysql_fetch_array($res1);
$tablename=$row[tablename];
$file_path=$row[file_path];
  if($tablename)
   { 
     	$tab_sql="select * from $tablename";
        $tab_res=mysql_query($tab_sql);
        $i =2; 
		$j=3;
		$in_sql="insert into $tablename(item_id,";
		$in_sql_value="values(' $item_id ', ";
 while ($i < mysql_num_fields($tab_res))
{
    $tab_col = mysql_fetch_field($tab_res, $i);
	$dummy=$tab_col->name;
	$in_sql.="$dummy ,";
	//if($i<$j)
   	$in_sql_value.="'$_SESSION[$dummy]',";
   // echo "sesssion"."<br>". $_SESSION[third]."<br>";
	$i++;
	// $j++;
}
$in_sql=rtrim($in_sql,", "); 
$in_sql_value=rtrim($in_sql_value,", "); 
$in_sql.=")".$in_sql_value.")";
$in_res=mysql_query($in_sql);
}
//$sucess=1;
} //if($res)
} //
if($res)
 $sucess=1;
 else
$fail=1;
 } 
if($sucess==1)
{
$_SESSION[des]="";
$_SESSION[sell_method]="";
$_SESSION[currency]="";
$_SESSION[min_amt]="";
 $_SESSION[quick_price] ="";
$_SESSION[rev_price]="";
$_SESSION[bid_inc]="";
$_SESSION[size_of_qty]="";
$_SESSION[qty]="";
$_SESSION[start_delay]="";
$_SESSION[image1]="";
$_SESSION[image2]="";
$_SESSION[image3]="";
$_SESSION[shipping_route]="";
$_SESSION[shipping_amt]="";
$_SESSION[tax]="";
$_SESSION[mode]="";
$_SESSION[Gallery]="";
$_SESSION[Border]="";
$_SESSION[Highlight]="";
$_SESSION[Bold]="";
$_SESSION[Home]="";
$_SESSION[repost]="";
$_SESSION[dur] ="";
$_SESSION[categoryid]="";
$_SESSION[img1]="";
$_SESSION[img2]="";
$_SESSION[img3]="";
$_SESSION[subtitle]="";
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

if($paymode==1)
{
echo '<meta http-equiv="refresh" content="0;url=reviewpaymentdetails.php?item_id='.$item_id.'">';
exit();
}

} // if($sucess==1)
 
$title="Post Your Ad";
require 'include/top.php';
require'templates/post_preview.tpl';
require 'include/footer.php'; ?>
<script language="JavaScript">
function cancel()
{
var where_to= confirm("Are U Sure U Want to cancel the items?");
if (where_to== true)
 {
 window.location="index.php";
 }
}
</script>

